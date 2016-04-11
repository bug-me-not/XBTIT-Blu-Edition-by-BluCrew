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
    session_name("Blu-torrents");
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

$betcoupontpl = new bTemplate();
$betcoupontpl->set("language", $language);

$main = get_result("SELECT `b`.`bonus`, `bo`.odds, `bg`.`heading`, `bo`.`text` FROM `{$TABLE_PREFIX}bets` `b` LEFT JOIN `{$TABLE_PREFIX}betoptions` `bo` ON `b`.`optionid`=`bo`.`id` LEFT JOIN `{$TABLE_PREFIX}betgames` `bg` ON `bo`.`gameid`=`bg`.`id` WHERE `b`.`userid`=".(int)$CURUSER["uid"],true,$btit_settings["cache_duration"]);
if(count($main)==0)
    $betcoupontpl->set("result",false,true);
else
{
    $betcoupontpl->set("result",true,true);
    $loop1=array();
    foreach($main as $more)
    {
        $odds = $more['odds'];
        switch(strlen($odds))
        {
            case 1:
            $odds = $odds.".00";
            break;
            case 3:
            $odds = $odds."0";
            break;
        }
        $loop1[$i]["odds"]=$odds;
        $loop1[$i]["heading"]=$more["heading"];
        $loop1[$i]["text"]=$more["text"];
        $loop1[$i]["bonus"]=$more["bonus"];
        $loop1[$i]["potential"]=round(($more['bonus']*$more['odds'])*0.97);
        $i++;
    }
    $betcoupontpl->set("loop1",$loop1);
}

?>