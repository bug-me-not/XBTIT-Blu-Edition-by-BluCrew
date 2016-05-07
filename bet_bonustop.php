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

$betbonustpl = new bTemplate();
$betbonustpl->set("language", $language);
$betbonustpl->set("id",$CURUSER["uid"]);
$betbonustpl->set("username",$CURUSER["username"]);
$betbonustpl->set("user",unesc($CURUSER["prefixcolor"].$CURUSER["username"].$CURUSER["suffixcolor"]));

$order = isset($_GET['a']) && is_valid_id($_GET['a']) ? $_GET['a'] : 0;

if($order == 1)
    $order = "ASC";
else
    $order = "DESC";

$res = get_result("SELECT `bonus` FROM `{$TABLE_PREFIX}bettop` WHERE `userid` = ".$CURUSER["uid"],true,$btit_settings["cache_duration"]);

if(count($res)>0)
{
    $betbonustpl->set("result1",true,true);    
    $loop1=array();
    $i=0;
    foreach($res as $arr)
    {
        $loop1[$i]["bonus"]=htmlspecialchars($arr["bonus"]);
        $i++;
    }
    $betbonustpl->set("loop1",$loop1);
}
else
    $betbonustpl->set("result1",false,true);

  $res = get_result("SELECT `u`.`username`, `ul`.`prefixcolor`, `ul`.`suffixcolor`, `bt`.`userid`, `bt`.`bonus` FROM `{$TABLE_PREFIX}bettop` `bt` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `bt`.`userid` = `u`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` ORDER BY `bt`.`bonus` $order LIMIT 50",true,$btit_settings["cache_duration"]);

if(count($res)>0)
{
    $betbonustpl->set("result2",true,true);
    $betbonustpl->set("desc",(($order == "DESC")?true:false),true);

    $i=0;
    $loop2=array();
    foreach($res as $arr)
    {
        $loop2[$i]["userid"]=$arr["userid"];
        $loop2[$i]["username"]=unesc($arr["prefixcolor"].$arr["username"].$arr["suffixcolor"]);
        $loop2[$i]["bonus"]=htmlspecialchars($arr["bonus"]);
        $loop2[$i]["number"]=($i+1);
        $i++;
    }
    $betbonustpl->set("loop2",$loop2);
}
else
    $betbonustpl->set("result2",false,true);   

?>