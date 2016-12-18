<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
//    Invite list - by DiemThuy apr 2013 
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

if (!$CURUSER || $CURUSER["view_torrents"]=="no")
   {
    err_msg(ERROR.NOT_AUTHORIZED." ",SORRY."...");
    stdfoot();
    exit();
   }
else
    {

$id = (int)$_GET["id"];
  
echo "<br><center><b><font color = red >Accepted Invite List</font></b></center>";

?>
  <table class=lista width="570" align="center">
  <tr>
    <td class=header align=center width="320"><center>Username</center></td>
    <td class=header align=center width="150"><center>Joinded</center></td>
   </tr>
   
<?php

  $sql="SELECT * FROM {$TABLE_PREFIX}users WHERE invited_by = ".$id;
  $row = do_sqlquery($sql,true);
  
if (mysql_num_rows($row)==0)
{
?>

           <tr>
          <td class=lista align=center><b><center>No Users Invited</center></b></td>
          <td class=lista><b><center>By This User</b></center></td>
            </tr>
<?php	
	
}
else
{
      while ($data=mysql_fetch_array($row))

      {
        $rec=mysql_query("SELECT * FROM {$TABLE_PREFIX}users_level WHERE id=$data[id_level]" );
        $recc=mysql_fetch_assoc($rec);
        $users=$recc["prefixcolor"] .$data["username"]. $recc["sufixcolor"];
        $userss="<a href='index.php?page=userdetails&id=".$data[id]."'>".$users."</a>";
    ?>

           <tr>
          <td class=lista align=center><b><center><?php echo $userss ?></center></b></td>
          <td class=lista><b><center><?php echo $data['joined'] ?></b></center></td>
            </tr>
<?php

}
}
}
$module_out=ob_get_contents();
ob_end_clean();
?>