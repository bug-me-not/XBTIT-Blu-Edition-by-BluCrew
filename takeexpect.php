<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
//
// Expected & To Offer Torrents by DiemThuy oct 2010 based on Jboy,s BTI version
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
if (!defined("IN_BTIT"))
      die("non direct access!");

require_once ("include/functions.php");
require_once ("include/config.php");
dbconn();

if (!$CURUSER || $CURUSER["can_upload"]=="no")
{
     stderr($language["ERROR"],$language["ERR_NOT_AUTH"]);
     stdfoot();
 	 die();
}
else
{
$expecttitle = sql_esc($_POST["expecttitle"]);
$descr = sql_esc($_POST["description"]);
$date = sql_esc($_POST["date"]);
$cat = 0+sql_esc($_POST["category"]);
$type = sql_esc($_POST["type"]);

if($type=="yes")
    $text = "To Offer";
else
	$text = "Expected";

if (!$expecttitle)
  {
     stderr($language["ERROR"],$language["NO_NAME"]);
     stdfoot();
 	 die();
}

$cat = 0+$_POST["category"];
      if ($cat==0)
  {
     stderr($language["ERROR"],$language["WRITE_CATEGORY"]);
     stdfoot();
 	 die();
}

$descr = $_POST["description"];
if (!$descr)
  {
     stderr($language["ERROR"],$language["NO_DESCR"]);
     stdfoot();
 	 die();
}

$expect = $expecttitle;
$descr = $descr;
$date = $date;
$cat = $cat;
$type = $type;
quickQuery("INSERT INTO {$TABLE_PREFIX}expected (expect_offer,hits,userid, cat, expect, descr, added, date) VALUES('$type',1,".$CURUSER['uid'].", '$cat', '$expect', '$descr', NOW(), '$date')") or sqlerr(__FILE__,__LINE__);

global $BASEURL;
$url=("[color=RED]New ".$text." Torrent: [/color][url=$BASEURL/index.php?page=viewexpected]".$expecttitle."[/url] [color=RED]Added By: [/color] [url=$BASEURL/index.php?page=userdetails&id=".$CURUSER['uid']."]". $CURUSER["username"]."[/url]");

system_shout($url);
write_log("$expect " . $language["EXP_ADD_SUCCES"] . "");

redirect("index.php?page=viewexpected");
}

?>
