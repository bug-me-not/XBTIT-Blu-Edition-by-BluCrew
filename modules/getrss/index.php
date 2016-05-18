<?php    
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2012  Btiteam
//
//    This file is part of xbtit.
//
//    Torrent RSS by DiemThuy ( jul 2012 ) TBDEV conversion with some improvements 
//
// Redistribution and use in source and binary forms, with or without modification,
// are permitted provided that the following conditions are met:
//
//   1. Redistributions of source code must retain the above copyright notice,
//      this list of conditions and the following disclaimer.
//   2. Redistributions in binary form must reproduce the above copyright notice,
//      this list of conditions and the following disclaimer in the documentation
//      and/or other materials provided with the distribution.
//   3. The name of the author may not be used to endorse or promote products
//      derived from this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
// WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
// MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
// IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
// TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
// PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
// LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
// NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
// EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
////////////////////////////////////////////////////////////////////////////////////
ob_start();

if (!defined("IN_BTIT"))
      die("non direct access!");

require_once("include/functions.php");
require_once("include/config.php");
    dbconn();
$i=-1;
?>

 
<?php 

$risultato = do_sqlquery("select * from {$TABLE_PREFIX}categories where (sub!='0') ORDER BY sort_index ASC");

while ($cat = $risultato->fetch_array()){


$id = $cat["id"];
$name = $cat["name"];
$res = do_sqlquery("select count(*) as allincat FROM {$TABLE_PREFIX}files where seeds!=0 AND category=".$id);
                if ($res)
                {
                $row=$res->fetch_array();
                $tot=$row['allincat'];
} else {
$tot=0;

}
$i++;
if ($i% 10==0)
{
$catoptions .= "<tr></tr>";
}
$catoptions .= "<td>";
//$catoptions .= "<a href=\"index.php?page=torrents&amp;category=$id\" title=\"$name\" alt=\"$name\">" . image_or_link( ($cat["image"] == "" ? "" : "$STYLEPATH/images/categories/" . $cat["image"]), "", $cat["name"]) ."</a><center>$tot</center></td><td>&nbsp;</td>";
$catoptions .= "<a href=\"index.php?page=torrents&amp;category=$cat[id]\">".image_or_link(($cat["image"]==""?"":"$STYLEPATH/images/categories/" . $cat["image"]),"",$cat["name"])."</a><center>Seeds: $tot<br><input type=\"checkbox\" name=\"cat[]\" value=\"$cat[id]\" " .(strpos($CURUSER['notifs'], "[cat$cat[id]]") !== false ? " checked" : "") ."/></center>";
        
}

?>

<?php

 if ($_SERVER['REQUEST_METHOD'] == "POST") {
         
        if (empty($_POST['cat']))
stderr("Error", "You need to chose at least one category !!");

         if (empty($_POST['feed']))
stderr("Error", "You need to chose a feed type !!");

        $link = "$BASEURL/rss_torrents.php";
        if ($_POST['feed'] == "dl")
            $query[] = "feed=dl";
        foreach($_POST['cat'] as $cat)
            $query[] = "cat[]=$cat";
            
            $row =get_result("SELECT pid FROM {$TABLE_PREFIX}users WHERE id=".$CURUSER['uid'],true,$btit_settings['cache_duration']);
             $pid=$row[0]["pid"];
      
            $query[] = "pid=$pid";
        $queries = implode("&", $query);
        if ($queries)
            $link .= "?$queries";
            
        if ($_POST['feed'] == "dl")
        {           
        information_msg("RSS Link","Use the following url in your RSS reader:<br><b>$link</b><br>");
        stdfoot();
        exit();
        }else
        header("Refresh: 0; url=".$link."");        
}

?>

 <div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Categories To Retrieve</h4>
</div>

<center><table class="table table-bordered">


<form method="POST" action="index.php?page=modules&module=getrss">
    
            <?php echo $catoptions?>
     
     
     </table></center><br>   
     <center>
      <table class="table table-bordered">
     <tr>
            <td align="center" width="50%" class="header">Feed Type:&nbsp;
            <input type="radio" name="feed" value="web" />Web Link
             &nbsp;&nbsp;&nbsp;<input type="radio" name="feed" value="dl" />Download link</td>
             <td align="left" width="50%"><button  type="submit" class="btn btn-primary btn-md">Get RSS</button></td>
        </tr>
        </table>
        </center>
</form>
</div>
   
<?php    
$module_out=ob_get_contents();
ob_end_clean();
?>
