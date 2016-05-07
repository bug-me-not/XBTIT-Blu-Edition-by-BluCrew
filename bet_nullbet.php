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

$betbacktpl = new bTemplate();
$betbacktpl->set("language", $language);

if ($CURUSER["admin_access"]=="no")
    stderr($language["ERROR"], $language["SB_ACC_DEN"]);

$id = isset($_GET['id']) && is_valid_id($_GET['id']) ? $_GET['id'] : 0;

$res = get_result("SELECT `heading` FROM `{$TABLE_PREFIX}betgames` WHERE `id` = ".sqlesc($id),true,$btit_settings["cache_duration"]);
if(count($res)==0)
    stderr($language["ERROR"],$language["SB_BAD_ID"]);
$res = $res[0];
$message = $res["heading"];

$res1 = get_result("SELECT COUNT(*) `count` FROM `{$TABLE_PREFIX}bets` where `gameid` = ".sqlesc($id),true,$btit_settings["cache_duration"]);
if($res1[0]["count"]==0)
    stderr($language["ERROR"],$language["SB_BAD_ID"]);
$bets = $res1[0]["count"];

$a = get_result("SELECT * FROM `{$TABLE_PREFIX}betlog` WHERE `msg` LIKE '%".$message."%'",true, $btit_settings["cache_duration"]);
if(count($a) < 1 || count($a) > 1000)
stderr($language["ERROR"], $language["SB_NO_BON_LOG"]);

$whoopsie = 0;

$log = count($a);

if(isset($_GET["shite"]))
    $shite = 1;
else
    $shite = 0;

$res3 = get_result("SELECT * FROM {$TABLE_PREFIX}bets where gameid = ".sqlesc($id),true,$btit_settings["cache_duration"]);
$bets = count($res3);
if($log != $bets && $shite == 0)
{
    stderr($language["ERROR"], $language["SB_OP_LOG_1"] . htmlspecialchars($log ). " ".$language["SB_OP_LOG_2"]." ".htmlspecialchars($bets)."<br />".$language["SB_OP_LOG_3"]." <a href='index.php?page=betback&id=".$id."&amp;shite=1'><u>".$language["SB_OP_LOG_4"]."</u></a>");
}
else
{
    $added = sqlesc(time());
    $output=array();
    foreach($a as $res3)
	{
        $uid = (int) $res3['userid'];
        $s = strrpos($res3['msg'], "-");
        $points = substr($res3['msg'], $s);
        $s = strpos($points,"Points");
        $points = substr($points, 0, $s);	
        $HTMLOUT .="".$points." -> ";
        $HTMLOUT .="".$res3['msg']."<br />";	
        quickQuery("UPDATE {$TABLE_PREFIX}users SET seedbonus = seedbonus-".sqlesc($points)." WHERE id =".sqlesc($uid)." LIMIT 1",true);
        $subject = sqlesc($language["SB_BET_REBATE"]);
        $msg = sqlesc($language["SB_RET_POINTS_1"]." ".$points." ".$language["SB_RET_POINTS_2"]." ".$message." ".$language["SB_RET_POINTS_3"]);	
        send_pm (0,$uid, $subject, $msg);
        $msg2 = sqlesc($language["SB_BBAS"].": ".$message." <b>".$points." ".$language["SB_POINTS"]."</b>");
        quickQuery("INSERT INTO {$TABLE_PREFIX}betlog(userid,msg,date,bonus) VALUES($uid, $msg2, $added, $points)",true);
        $whoopsie -= $points;
	}
    quickQuery("DELETE FROM {$TABLE_PREFIX}betgames WHERE id =".sqlesc($id),true);
    quickQuery("DELETE FROM {$TABLE_PREFIX}bets WHERE gameid = ".sqlesc($id),true);
    quickQuery("DELETE FROM {$TABLE_PREFIX}bets WHERE id = ".sqlesc($id),true);
    quickQuery("DELETE FROM {$TABLE_PREFIX}betoptions WHERE gameid = ".sqlesc($id),true);
    quickQuery("DELETE FROM {$TABLE_PREFIX}betlog WHERE msg LIKE '%".$message."%'",true);

    $betbacktpl->set("betback", $HTMLOUT);

}

?>