<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM .
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

require_once("include/functions.php");
dbconn(false);
global $CURUSER, $db_prefix, $XBTT_USE;

if ($XBTT_USE)
   {
    $udownloaded="u.downloaded+IFNULL(x.downloaded,0)";
    $uuploaded="u.uploaded+IFNULL(x.uploaded,0)";
    $utables="{$TABLE_PREFIX}users u LEFT JOIN xbt_users x ON x.uid=u.id";
   }
else
    {
    $udownloaded="u.downloaded";
    $uuploaded="u.uploaded";
    $utables="{$TABLE_PREFIX}users u";
}
$resuser=do_sqlquery("SELECT $udownloaded as downloaded,$uuploaded as uploaded FROM $utables WHERE u.id=".$CURUSER["uid"]);
$rowuser= $resuser->fetch_array();
$money = makesize($rowuser[uploaded]);
$slotstpl=new bTemplate();
if (!$CURUSER)
   {

       // anonymous=guest
   stderr("Sorry","You need to be logged in to play!");
   }
elseif ($CURUSER["uid"]==1)
       // anonymous=guest
    {
   stderr("Sorry","You need to be logged in to play!");
    }
elseif ($money> 0)
    {
  $start="<center><b>Welcome to Blu Slots!</b><br><br><img src=images/slots/virtualslots.gif><br><br>
Your Bank:&nbsp;".$money."<br>
<form action=\"index.php?page=slotsgo\" method=\"post\">
      <input type=\"hidden\" name=\"money\" value=\"$money\">
      <button type=\"submit\" style=\"width: 92px; height: 37px; margin-top: 13px;\">Play</button>
     </form><br><li>Pressing this button will take the first shot.</li><br><li>Each shot costs 10mb of your upload credit.</li></center>";
$slotstpl->set("start",$start);

    }else{

$start="<center><b>Welcome to Blu Slots!</b><br><br><img src=images/slots/virtualslots.gif><br><br>
Your Bank:&nbsp;".$money."<br><br>
<form action=\"index.php?page=slotsgo\" method=\"post\">
      <input type=\"button\" name=myButton value=\"disabled\" disabled>
     </form><br>Sorry you are out of credit!</center>";
   $slotstpl->set("start",$start);
}


?>
