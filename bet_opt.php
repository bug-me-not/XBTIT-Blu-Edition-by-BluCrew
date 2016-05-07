<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//   SPORT BETTING HACK , orginal TBDEV 2009 by Soft & Bigjoos 
//   XBTIT conversion by DiemThuy , April 2010
//
//    This file is part of xbtit.
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

global $BASEURL, $CURUSER, $language, $btit_settings;

if(!isset($CURUSER) || !is_array($CURUSER))
{
    session_name("BluRG");
    session_start();
    $CURUSER=$_SESSION["CURUSER"];
}

$betopttpl = new bTemplate();
$betopttpl->set("language", $language);

if ($CURUSER["admin_access"]=="no")
    stderr($language["ERROR"], $language["SB_ACC_DEN"]);

$id = isset($_GET['id']) && is_valid_id($_GET['id']) ? $_GET['id'] : 0;

$betopttpl->set("id", $id);

$a = get_result("SELECT * FROM {$TABLE_PREFIX}betgames WHERE id =".sqlesc($id),true,$btit_settings["cache_duration"]);

$loop1=array();
$i=0;
foreach($a as $b)
{
    $loop1[$i]["heading"]=htmlspecialchars($b['heading']);
    $loop1[$i]["undertext"]=htmlspecialchars($b['undertext']);
    $i++;
}

$betopttpl->set("loop1",$loop1);

$res = get_result("SELECT id, gameid, text FROM {$TABLE_PREFIX}betoptions WHERE gameid =".sqlesc($id)." ORDER BY id asc",true,$btit_settings["cache_duration"]);

$loop2=array();
$i=0;
foreach ($res as $arr)
{
    $loop2[$i]["text"]=htmlspecialchars($arr['text']);
    $loop2[$i]["id1"]=$arr['id'];
    $loop2[$i]["id2"]=$id;
    $i++;
}

$betopttpl->set("loop2",$loop2);

?>