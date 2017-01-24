<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
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


$query  = get_result("SELECT * FROM `{$TABLE_PREFIX}lottery_config` WHERE id=1",true,$btit_settings["cache_duration"]);
$config = $query[0];
$expire_date = $config['lot_expire_date'];
$enabled = $config['lot_status'];
$limit_buy = $config['limit_buy'];
$minupload = $config['lot_amount'];
$expire = strtotime ($expire_date);
$now = strtotime("now");

$purchaseable = floor($CURUSER["uploaded"]/$minupload);
$num_tickets = get_result("SELECT COUNT(*) `tc` FROM `{$TABLE_PREFIX}lottery_tickets` WHERE `user`=".$CURUSER["uid"],true,0);
$user_tickets = $num_tickets[0]["tc"];

if ($CURUSER['id_level'] < 3)
{
       err_msg($language["ERROR"],$language["NOT_AUTHORIZED"]." ".$language["NOT_USER_CLASS"]);
       stdfoot();
       die();
}

if ($now >= $expire || $enabled != 'yes')
{
       err_msg($language["ERROR"], $language["CANNOT_SELL_CLOSED"]);
       stdfoot();
       die();
}

if ($_POST['number'] > $purchaseable || $_POST['number'] < 1)
{
    err_msg($language["ERROR"], $language["LOTT_LIMIT_PURCHASE"]." ".$purchaseable);
    stdfoot();
    die;
}

if ($_POST['number'] + $user_tickets > $limit_buy)
{
    err_msg($language["ERROR"], $language["LOTT_LIMIT_BUY"]." ".$limit_buy);
    stdfoot();
    die;
} 

$upload = $CURUSER["uploaded"] - ($minupload * (int)$_POST['number']);
$_SESSION["CURUSER"]["uploaded"]=$upload;
if ($XBTT_USE)
{
   quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=0 WHERE `id`=".$CURUSER['uid'], true);
   quickQuery("UPDATE `xbt_users` SET `uploaded`=".$upload." WHERE `uid`=".$CURUSER['uid'], true);
}
else
   quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=".$upload." WHERE `id`=".$CURUSER['uid']."", true);
$tickets = $_POST['number'];

for ($i = 0; $i < $tickets; $i++)
    quickQuery("INSERT INTO {$TABLE_PREFIX}lottery_tickets(user) VALUES(".$CURUSER['uid'].")", true);

$me = get_result("SELECT COUNT(*) `tc` FROM `{$TABLE_PREFIX}lottery_tickets` WHERE user=".$CURUSER['uid'],true,$btit_settings["cache_duration"]);
$me = $me[0]["tc"];

// load language file
require(load_language("lang_lottery.php"));

$ticketstpl = new bTemplate();
$ticketstpl-> set("language", $language);
$ticketstpl-> set("nr_tickets", $tickets);
$ticketstpl-> set("total_tickets", $me);
$ticketstpl-> set("new_upload", makesize($upload));

header("Refresh: 5; URL=index.php?page=lottery_tickets");

?>