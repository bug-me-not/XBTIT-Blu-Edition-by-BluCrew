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
block_begin("Latest Requests");

global $btit_settings ;

$number = $btit_settings["req_number"];

$res = do_sqlquery("SELECT users.id_level,users.downloaded, users.uploaded, users.username, requests.filled, requests.filledby, requests.id, requests.userid, requests.request, requests.added, requests.hits, categories.image as catimg, categories.name as cat FROM {$TABLE_PREFIX}requests requests inner join {$TABLE_PREFIX}categories categories on requests.cat = categories.id inner join {$TABLE_PREFIX}users users on requests.userid = users.id ORDER BY requests.id DESC, requests.id DESC LIMIT $number") or sqlerr();
$num = sql_num_rows($res);

print("<table border=0 width=100% align=center cellspacing=1 cellpadding=0>\n");
print("<tr><td class=header align=center>Torrent File</td><td class=header align=center>Cat.</td><td class=header align=center>Added</td><td class=header align=center>By</td><td class=header align=center>Filled</td><td class=header align=center>Votes</td>\n");

for ($i = 0; $i < $num; ++$i)
{
 $arr = $res->fetch_assoc();

$rep=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users_level WHERE id =".$arr['id_level']);
$rept=$rep->fetch_array();

$name=stripslashes($rept['prefixcolor']) . $arr['username'] . stripslashes($rept['suffixcolor']);

$privacylevel = $arr["privacy"];

if ($arr["downloaded"] > 0)
   {
     $ratio = number_format($arr["uploaded"] / $arr["downloaded"], 2);
     //$ratio = "<font color=" . get_ratio_color($ratio) . "><b>$ratio</b></font>";
   }
   else if ($arr["uploaded"] > 0)
       $ratio = "Inf.";
   else
       $ratio = "---";

$res3 = do_sqlquery("SELECT username from {$TABLE_PREFIX}users where id=" . $arr['filledby']);
$arr3 = $res3->fetch_assoc();
if ($arr3['username'])
$filledby = $arr3['username'];
else
$filledby = " ";

if (!$CURUSER || $CURUSER["delete_torrents"]=="no"){
if (!$CURUSER || $CURUSER["view_users"]=="yes"){
			$addedby = "<td class=lista align=center><center><a href=index.php?page=userdetails&id=".$arr['userid']." title=\"Request By : ".$arr['username']." (".$ratio.")\"><b>$name</b></a></td>";
		}else{
			$addedby = "<td class=lista align=center><center><a href=index.php?page=userdetails&id=".$arr['userid']." title=\"Request By : ".$arr['username']." (".$ratio.")\"><b>$name</b></a></td>";
		}
}else{
			$addedby = "<td class=lista align=center><center><a href=index.php?page=userdetails&id=".$arr['userid']." title=\"Request By : ".$arr['username']." (".$ratio.")\"><b>$name</b></a></td>";
}

$filled = $arr['filled'];
if ($filled){
$filled = "<a href=$filled><font color=green title=\"Filled By: ".$arr3['username']."\"><b>Yes</b></font></a>";
}
else{
$filled = "<a href=index.php?page=reqdetails&id=$arr[id] title=\"Request Details :".$arr['request']."\"><font color=red><b>No</b></font></a>";
}

$reqname = $arr['request'];

//Name of Request too Big Hack Start
   if (strlen($arr['request'])>45)
  {
  $extension = "...";
  $arr['request'] = substr($arr['request'], 0, 45)."$extension";
  }
//Name of Request too Big Hack Stop
  print("<tr><td class=lista align=center width=240><center><a href=index.php?page=reqdetails&id=".$arr['id']." title=\"Request Name :".$reqname."\"><b>".$arr['request']."</b></a></td>");
 print("<td class=lista align=left ><center>".image_or_link(($arr['catimg']==''?'':'style/xbtit_default/images/categories/'.$arr['catimg']),' title=\'Catagory : '.$arr['cat'].'\'',$arr['cat'])."</td>");
print("<td class=lista align=center><center><font title=\"Added : ".$arr['added']."\">".$arr["added"]."</font></td>$addedby<td class=lista align=center><center>$filled</td><td class=lista align=center><center><a href=index.php?page=votesview&requestid=".$arr['id']." title=\"Votes : ".$arr['hits']."\"><b>".$arr['hits']."</b></a></td></tr>\n");
}
print("</table>\n");

block_end();
?>
