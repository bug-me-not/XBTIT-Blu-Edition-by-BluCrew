<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
// Torrent Request & Vote by miskotes  - converted to XBTIT-2 by DiemThuy - March 2009
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

// DT no TPL file needed - file = 100 done

if (!defined("IN_BTIT"))
    die("non direct access!");



$requestid = (int)$_GET["id"];
$userid = (int)$CURUSER["uid"];
$res = get_result("SELECT * FROM {$TABLE_PREFIX}addedrequests WHERE requestid=$requestid and userid = $userid",true,$btit_settings["cache_duration"]);
$voted = $res[0];

if ($voted)
{
    stderr($language["ERROR"],$language["TRAV_ALREADY_VOTED"]);
    stdfoot();
    die;
}
else
{
    quickQuery("UPDATE {$TABLE_PREFIX}requests SET hits = hits + 1 WHERE id=$requestid",true);
    quickQuery("INSERT INTO {$TABLE_PREFIX}addedrequests VALUES(0, $requestid, $userid)",true);
    information_msg($language["TRAV_SUC_VOTED"],"<p>".$language["TRAV_SUC_VOTED_1"]." $requestid</p><p>".$language["TRAV_SUC_VOTED_2"]."</p>");
    stdfoot();
    exit();
}

?>