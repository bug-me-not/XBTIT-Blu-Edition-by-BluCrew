<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
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
  if ($CURUSER["uid"] > 1)
    {
  if (!isset($CURUSER)) global $CURUSER;
?>

<table class=lista width="500" align="center">
<tr><td><center><H1>NAT ( connectable ) info</H1></center></td></tr>
<tr><td><br><center>  It is very importend that you forward your torrent client port , if your port is not open , down and uploads will be slow as peers can not connect</center></td></tr>
<tr><td><br><center>Here is a link to a site what explain all you need to know <A HREF=http://www.portforward.com>Portforwarding</A></center></td></tr>
</table>
  <table class=lista width="475" align="center">
  <tr>
    <td class=header align=center width="450"><center>Explanation</center></td>
    <td class=header align=center width="26"><center>Pictures</center></td>
   </tr>

<?php

//nat - max torrents
$resuser=do_sqlquery("SELECT connectable FROM {$TABLE_PREFIX}users WHERE id=".$CURUSER["uid"]);
$con= $resuser->fetch_array();

if($rowuser["connectable"]=="yes")
    $conn="<img src=\"images/good.png\">";
elseif($rowuser["connectable"]=="no")
    $conn="<img src=\"images/nat.png\">";
else
    $conn="<img src=\"images/unknow.png\">";
//nat
    ?>

           <tr>
          <td class=lista align=center><b><center>Good , your port is open</center></b></td>
          <td class=lista><b><center><img src=images/good.png ></b></center></td>
            </tr>
                      <tr>
          <td class=lista align=center><b><center>Bad , your port is closed !</center></b></td>
          <td class=lista><b><center><img src=images/nat.png ></b></center></td>
            </tr>
                         <tr>
          <td class=lista align=center><b><center>Not tested yet</center></b></td>
          <td class=lista><b><center><img src=images/unknow.png ></b></center></td>
            </tr>

</table>
<?php
echo "<br><center><b><font color = red >YOUR PORT</font></b></center>";
?>
  <table class=lista width="474" align="center">
  <tr>
    <td class=header align=center width="319"><center>What about you</center></td>
    <td class=header align=center width="100"><center>NAT check</center></td>
   </tr>
<?php
  global $CURUSER;
  $uid=$CURUSER['uid'];
  $sq=do_sqlquery("SELECT id_level FROM {$TABLE_PREFIX}users WHERE id=$uid" );
  $dat=$sq->fetch_assoc();
  $so=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users_level WHERE id=$dat[id_level]" );
  $da=$so->fetch_assoc();
  $user=$da["prefixcolor"] .$CURUSER['username']. $da["sufixcolor"];

    ?>
           <tr>
          <td class=lista align=center><b><center><?php echo $user ?></center></b></td>
          <td class=lista><b><center><?php echo $conn ?></b></center></td>
          </tr>
</table> </br>

<?php

}



else
    print("<div align=\"center\">\n
           <br />".$language["ERR_PERM_DENIED"]."</div>");

$module_out=ob_get_contents();
ob_end_clean();
?>
