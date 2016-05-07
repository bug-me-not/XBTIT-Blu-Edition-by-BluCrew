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

if(is_integer($btit_settings["min_bet"]) || substr($btit_settings["min_bet"], 0, 4)!="lro-")
    stderr($language["ERROR"], $language["ERR_NEEDS_RECONFIG_1"]." <b>Sport Betting</b> ".$language["ERR_NEEDS_RECONFIG_2"].(($CURUSER["admin_access"]=="no")?"<br /><br />".$language["ERR_NEEDS_RECONFIG_3"]:""));

$lroPerms=explode("-", $btit_settings["min_bet"]);
if($btit_settings["fmhack_logical_rank_ordering"]=="enabled")
{
    if($lroPerms[1]==1 && $lroPerms[2]>0)
        $rankUnder=(($CURUSER["logical_rank_order"]<$lroPerms[2])?true:false);
    else
        stderr($language["ERROR"], $language["ERR_NEEDS_RECONFIG_1"]." <b>Sport Betting</b> ".$language["ERR_NEEDS_RECONFIG_2"].(($CURUSER["admin_access"]=="no")?"<br /><br />".$language["ERR_NEEDS_RECONFIG_3"]:""));
}
elseif($btit_settings["fmhack_logical_rank_ordering"]=="disabled")
{
    if($lroPerms[1]==0 && $lroPerms[2]>0)
        $rankUnder=(($CURUSER["id_level"]<$lroPerms[2])?true:false);
    else
        stderr($language["ERROR"], $language["ERR_NEEDS_RECONFIG_1"]." <b>Sport Betting</b> ".$language["ERR_NEEDS_RECONFIG_2"].(($CURUSER["admin_access"]=="no")?"<br /><br />".$language["ERR_NEEDS_RECONFIG_3"]:""));
}
if ($rankUnder)
    stderr($language["SB_SORRY"], $language["SB_NO_ACCESS"]);

$id = isset($_POST['id']) && is_valid_id($_POST['id']) ? $_POST['id'] : 0;
(isset($_POST["bonus"]) && is_numeric($_POST["bonus"])) ? $bonus = (int) $_POST['bonus'] : $bonus=0;

$resdt = get_result("SELECT seedbonus from {$TABLE_PREFIX}users where id =".$CURUSER["uid"],true,$btit_settings["cache_duration"]);
$dts = $resdt[0];

if($dts['seedbonus'] < $bonus)
    stderr($language["SB_SORRY"], $language["SB_NOT_ENOUGH_POINTS"]);

if($bonus <=0)
    stderr($language["SB_SORRY"], $language["SB_BET_TOO_LOW"]);

if($bonus > $btit_settings['max_bon_bet'] )
    stderr($language["SB_SORRY"], $language["SB_MAX_BET_1"] . " " . $btit_settings['max_bon_bet'] . " " . $language["SB_MAX_BET_2"]);

$res = get_result("SELECT * FROM {$TABLE_PREFIX}betoptions WHERE id =".sqlesc($id),true,$btit_settings["cache_duration"]);
$a = $res[0];
$gameid = (int) $a['gameid'];

if($gameid== 0)
{
    header("location: $BASEURL/index.php?page=bet");
    exit;
}

$res2 = get_result("SELECT * from {$TABLE_PREFIX}betgames where id =".sqlesc($gameid),true,$btit_settings["cache_duration"]);
$s = $res2[0];

if($s['active'] == 0)
{
    header("location: $BASEURL/index.php?page=bet");
    exit;
}

$k = get_result("SELECT * FROM {$TABLE_PREFIX}bets WHERE optionid = ".sqlesc($a["id"])." AND userid =".sqlesc($CURUSER["uid"]),true,$btit_settings["cache_duration"]);
if(count($k) > 0)
    stderr($language["SB_SORRY"], $language["SB_ALREADY_BET"]);

$tid = time();

quickQuery("INSERT INTO {$TABLE_PREFIX}bets(gameid,bonus,optionid,userid,date) VALUES(".sqlesc($gameid).", ".sqlesc($bonus).", ".sqlesc($id).", ".sqlesc($CURUSER["uid"]).", '$tid')",true);
quickQuery("UPDATE {$TABLE_PREFIX}users SET seedbonus = seedbonus -".sqlesc($bonus)." WHERE id =".sqlesc($CURUSER["uid"]),true);
quickQuery("INSERT INTO {$TABLE_PREFIX}betlog(userid,date,msg,bonus) VALUES($CURUSER[uid], '$tid', 'Bet. ".$s['heading']." -> ".$a['text']."-".$bonus." Points.',-$bonus)",true);

$e = get_result("SELECT * FROM {$TABLE_PREFIX}betoptions WHERE gameid =".sqlesc($gameid),true,$btit_settings["cache_duration"]);
foreach($e as $f)
{
    $optionid = $f['id'];
    $total = 0;
    $optiontotal = 0;

    $b = get_result("SELECT * FROM {$TABLE_PREFIX}bets WHERE gameid = ".sqlesc($gameid),true,$btit_settings["cache_duration"]);
    foreach($b as $c)
    {
        $total += $c['bonus'];
        if($c['optionid'] == $optionid)
        $optiontotal += $c['bonus'];
    }
    if($optiontotal == 0)
        $odds = 0.00;
    else
        $odds = number_format($total/$optiontotal, 2, '.', '');
    quickQuery("UPDATE {$TABLE_PREFIX}betoptions SET odds = ".sqlesc($odds)." WHERE id = ".sqlesc($optionid),true);
}

header("location: index.php?page=betcoupon");
?>