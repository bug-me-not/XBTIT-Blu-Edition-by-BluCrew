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

if ($CURUSER["admin_access"]=="no")
    stderr($language["ERROR"], $language["SB_ACC_DEN"]);

$betgameinfotpl = new bTemplate();
$betgameinfotpl->set("language", $language);

$out1=array();
$i=0;

$a = get_result("SELECT `id`, `heading` FROM `{$TABLE_PREFIX}betgames` ORDER BY `id` ASC",true,$btit_settings["cache_duration"]);
foreach($a as $b)
{
    $out1[$i]["id"]=$b["id"];
    $out1[$i]["heading"]=htmlspecialchars($b['heading']);
    $i++;
}
$betgameinfotpl->set("out1",$out1);
$betgameinfotpl->set("showgames",false,true);

if(isset($_GET['showgames']))
{
    $betgameinfotpl->set("showgames",true,true);
    (isset($_GET["showgames"]) && is_numeric($_GET["showgames"])) ? $gameid = $_GET['showgames'] : $gameid=0;
    $a = get_result("SELECT `b`.`date`, `b`.`userid`, `ul`.`prefixcolor`, `u`.`username`, `ul`.`suffixcolor`, `bo`.`text` `optionid`, `b`.`bonus` FROM `{$TABLE_PREFIX}bets` `b` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `b`.`userid`=`u`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` LEFT JOIN `{$TABLE_PREFIX}betoptions` `bo` ON (`b`.`gameid`=`bo`.`gameid` AND `b`.`optionid`=`bo`.`id`) WHERE `b`.`gameid`=".$gameid." ORDER BY `b`.`date` DESC",true,$btit_settings["cache_duration"]);

    $out2=array();
    $i=0;
    foreach($a as $b)
    {
        $out2[$i]["date"]=date('l dS F Y \a\\t g:ia',$b['date']);
        $out2[$i]["userid"]=$b["userid"];
        $out2[$i]["username"]=unesc($b["prefixcolor"].$b["username"].$b["suffixcolor"]);
        $out2[$i]["optionid"]=htmlspecialchars($b["optionid"]);
        $out2[$i]["bonus"]=htmlspecialchars($b["bonus"]);
        $i++;
    }
    $betgameinfotpl->set("out2",$out2);
}

?>