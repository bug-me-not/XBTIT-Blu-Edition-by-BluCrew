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


$id2 = (int)$_POST["id"];
$res = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}expected WHERE id=$id2");
$row = $res->fetch_array();

if ($CURUSER["uid"] == $row["userid"] || $CURUSER["can_upload"] == "yes")
{
   $expecttitle = sqlesc($_POST["expecttitle"]);
   $descr = $_POST["description"];
   $date = sqlesc($_POST["date"]);
   $cat = sql_esc($_POST["category"]);
   $id = (int)$_POST["id"];
   $uploaded = sqlesc($_POST["uploaded"]?"yes":"no");
   $torrenturl = sqlesc($_POST["torrenturl"]);
   $type = sqlesc($_POST["type"]);

   if ($expecttitle=="" || $cat==0 || $descr=="" )
   {
      stderr($language["ERROR"],$language["ERR_MISSING_DATA"]);
      stdfoot();
      die();
   }

   $expect = $expecttitle;
   $descr = sql_esc($descr);
   $date = $date;
   $cat = $cat;
   $upl = $uploaded;
   $torurl = $torrenturl;
   $tpe = $type;


   quickQuery("UPDATE {$TABLE_PREFIX}expected SET expect_offer=$tpe, cat=$cat, expect=$expect, descr=\"$descr\", date=$date, uploaded=$upl, torrenturl=$torurl WHERE id=$id");

   //pm
   if($type=='yes' AND $uploaded=='yes')
   {
      $ms=sqlesc("Some time ago, you voted for the torrent: ".$expecttitle."\n\n
      We like to lett you know it is uploaded and you can get it here :\n\n
      [url]".$torrenturl."[/url]\n\n
      [color=red][b]THIS IS AN AUTOMATIC SYSTEM MESSAGE PLEASE DON,T REPLY[/b][/color]");

      $res = do_sqlquery("select userid from {$TABLE_PREFIX}addedexpected where expectid = ".$id) or die(sql_error());
      while($row = $res->fetch_array())
      {
         $kk=$row["userid"];
         send_pm(0,$kk,sqlesc('Voted offer is uploaded'),$ms);
      }
   }
   //pm end

   redirect("index.php?page=viewexpected");
}
else
{

   stderr($language["ERROR"],$language["ERR_NOT_AUTH"]);
   stdfoot();
   die();
}

?>
