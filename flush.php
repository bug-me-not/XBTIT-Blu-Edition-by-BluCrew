<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
//
// Flush Ghost Torrents by DiemThuy and Cooly , bonus hack for private , may 2009
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

require_once("include/functions.php");
dbconn(false);

global $CURUSER ,$btit_settings, $XBTT_USE;

$id=$CURUSER["uid"];

if(!$id){
stderr("Error","Bad ID!");
}
if($CURUSER["uid"]==$id){
$timeout=time()-(intval($GLOBALS["report_interval"]+$btit_settings["ghost"]));
$flush=do_sqlquery("SELECT pid FROM {$TABLE_PREFIX}users WHERE id ='".$CURUSER["uid"]."'");
$update=$flush->fetch_row();

if($XBTT_USE)
    quickQuery("UPDATE `xbt_files_users` SET `active`=0 WHERE `mtime` < ".$timeout." AND `uid`=".$CURUSER["uid"]);
else
    quickQuery("DELETE FROM {$TABLE_PREFIX}peers where lastupdate < ".$timeout." AND pid=".$update["pid"]);

information_msg("Success","Your Ghost Peers Are Flushed!");
}
?>
