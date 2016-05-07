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
    stderr($language["ERROR"],$language["SB_ACC_DEN"]);

$betfinishtpl = new bTemplate();
$betfinishtpl->set("language", $language);

$active = get_result("SELECT `bg`.`heading`, `bo`.`text`,`bg`.`undertext`, `bo`.`id`, `bo`.`odds`, `bo`.`gameid` FROM `{$TABLE_PREFIX}betgames` `bg` LEFT JOIN `{$TABLE_PREFIX}betoptions` `bo` ON `bg`.`id` =`bo`.`gameid` WHERE `bg`.`active` = 0 AND `bg`.`endtime` <UNIX_TIMESTAMP() ORDER BY `bg`.`endtime` DESC",true,$btit_settings["cache_duration"]);

if(count($active)>0)
{
    $betfinishtpl->set("result",true,true);
    $loop1=array();
    $i=0;
    $j=0;
    $firstrun=true;
    $gameid=0;
    foreach($active as $active1)
    {
        if($firstrun===true)
        {
            $gameid=$active1["gameid"];
            $firstrun=false;
        }
        if($active1["gameid"]!=$gameid)
        {
            $i++;
            $j=0;
            $gameid=$active1["gameid"];
        }

        $odds = $active1['odds'];
        switch(strlen($odds))
        {
            case 1:
            $odds = $odds.".00";
            break;
            case 3:
            $odds = $odds."0";
            break;
        }

        $loop1[$i]["heading"]=htmlspecialchars($active1['heading']."-".$active1['undertext']);
        $loop1[$i]["extra"][$j]["id"]=$active1['id'];
        $loop1[$i]["extra"][$j]["text"]=htmlspecialchars($active1['text']);
        $loop1[$i]["extra"][$j]["odds"]=htmlspecialchars($odds);
        $j++;
    }
    $betfinishtpl->set("loop1",$loop1);
}
else
    $betfinishtpl->set("result",false,true);
?>