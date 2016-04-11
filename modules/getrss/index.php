<?php    
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
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
    
    $res = mysql_query("SELECT id, name , image FROM {$TABLE_PREFIX}categories ORDER BY name");
    while($cat = mysql_fetch_assoc($res))
    
if($cat["image"]=="")
{
$catoptions .=""; 
}
else
{    

        $catoptions .= "<a href=\"index.php?page=torrents&amp;category=$cat[id]\">".image_or_link(($cat["image"]==""?"":"$STYLEPATH/images/categories/" . $cat["image"]),"",$cat["name"])."</a><input type=\"checkbox\" name=\"cat[]\" value=\"$cat[id]\" " .(strpos($CURUSER['notifs'], "[cat$cat[id]]") !== false ? " checked" : "") ."/>";
		}
        
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

<form method="POST" action="index.php?page=modules&module=getrss">
    <table class="header" width="93%" align="center">
        <tr>
            <td class="header" width="16%">Categories to retrieve:</td>
            <td class="lista" width="50%"><?php echo $catoptions?></td>
        </tr>
       <tr><td width="16%"><br></td></tr>
        <tr>
            <td class="header">Feed type:</td>
            <td><input type="radio" name="feed" value="web" />Web link
                <input type="radio" name="feed" value="dl" />Download link<br></td>

        </tr>
    
          <tr>
     <td style="text-align:center"><br><button type="submit">Get RSS<br></button></td></tr></table>
</form>
    
<?php    
$module_out=ob_get_contents();
ob_end_clean();
?>