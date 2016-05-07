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

      if($btit_settings['fmhack_games']=='disabled')
      {
        stderr("Closed",'The Games section is closed.');
        die();
      }

require_once("include/functions.php");

global $BASEURL, $CURUSER, $language, $btit_settings;

if(!isset($CURUSER) || !is_array($CURUSER))
{
    session_name("BluRG");
    session_start();
    $CURUSER=$_SESSION["CURUSER"];
}

$bettpl = new bTemplate();
$bettpl->set("language", $language);
$bettpl->set("BASEURL", $BASEURL);
$bettpl->set("ADMIN_ACCESS",(($CURUSER["admin_access"]=="yes")?true:false),true);

quickQuery("UPDATE `{$TABLE_PREFIX}betgames` set `active` =0 WHERE `endtime` < UNIX_TIMESTAMP()",true);

$res = get_result("SELECT `bg`.`heading`, `bg`.`undertext`, `bg`.`endtime`, `bo`.`text`, `bo`.`id`, `bo`.`odds`, `bo`.`gameid` FROM `{$TABLE_PREFIX}betgames` `bg` LEFT JOIN `{$TABLE_PREFIX}betoptions` `bo` ON `bg`.`id`=`bo`.`gameid` WHERE `bg`.`active`=1 ORDER BY `bg`.`endtime` ASC", true, $btit_settings["cache_duration"]);
if(count($res)==0)
{
    $bettpl->set("NOTHING_TO_SEE", true, true);
}
else
{
    $bettpl->set("NOTHING_TO_SEE", false, true);
    $loop1=array();
    $i=0;
    $j=0;
    $firstrun=true;
    $gameid=0;
    foreach($res as $a)
    {
        if($firstrun===true)
        {
            $gameid=$a["gameid"];
            $firstrun=false;
        }
        if($a["gameid"]!=$gameid)
        {
            $i++;
            $j=0;
            $gameid=$a["gameid"];
        }
        $loop1[$i]["heading"]=htmlspecialchars($a["heading"]);
        $loop1[$i]["undertext"]=htmlspecialchars($a["undertext"]);
        $odds = $a['odds'];
        switch(strlen($odds))
        {
            case 1:
            $odds = $odds.".00";
            break;
            case 3:
            $odds = $odds."0";
            break;
        }
        $loop1[$i]["date"]=date('l jS F Y \a\\t g:ia',$a['endtime']);
        $loop1[$i]["endsin"]=NewDateFormat(round($a['endtime']-time()));
        $loop1[$i]["extra"][$j]["text"]=htmlspecialchars($a['text']);
        $loop1[$i]["extra"][$j]["odds"]=htmlspecialchars($odds);
        $loop1[$i]["extra"][$j]["id"]=$a['id'];
        $j++;
    }
    $bettpl->set("loop1", $loop1);
}

?>
