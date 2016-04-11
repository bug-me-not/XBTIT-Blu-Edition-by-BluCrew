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

$expectid = (int)$_GET["id"];
$userid = $CURUSER["uid"];
$res = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}addedexpected WHERE expectid=$expectid and userid = $userid") or sqlerr();
$arr = $res->fetch_assoc();
$voted = $arr;

$ress = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}addedexpectedmin WHERE expectid=$expectid and userid = $userid") or sqlerr();
$arrr = $ress->fetch_assoc();
$votedmin = $arrr;

if ($voted OR $votedmin) {

      stderr($language["ERROR"],$language["TEXT_DTA"]);
      stdfoot();
      die;

}else {
quickQuery("UPDATE {$TABLE_PREFIX}expected SET hitsmin = hitsmin + 1 WHERE id=$expectid") or sqlerr();
@quickQuery("INSERT INTO {$TABLE_PREFIX}addedexpectedmin VALUES(0, $expectid, $userid)") or sqlerr();


        information_msg($language["TEXT_DTB"],$language["TEXT_DTC"]);
        stdfoot();
        exit();
}


?>
