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


// load language file
require(load_language("lang_lottery.php"));

$query  = get_result("SELECT * FROM `{$TABLE_PREFIX}lottery_config` WHERE id=1",true,$btit_settings["cache_duration"]);
$config = $query[0];
$expire_date = $config['lot_expire_date'];
$number_winners = $config['lot_number_winners'];
$number_to_win = $config['lot_number_to_win'];
$enabled = $config['lot_status'];
$minupload = $config['lot_amount'];
$limit_buy = $config['limit_buy'];

$numwinners = $number_winners;
$expire = strtotime ($expire_date);
$now = strtotime("now");
$ticketnumbers="";

$purch = (($CURUSER["uploaded"]==0)?0:floor($CURUSER["uploaded"]/$minupload));
$me = get_result("SELECT(SELECT COUNT(*) FROM `{$TABLE_PREFIX}lottery_tickets`) as `tc`, (SELECT COUNT(*) FROM `{$TABLE_PREFIX}lottery_tickets` WHERE `user`=".$CURUSER['uid'].") as `my`",true,$btit_settings["cache_duration"]);
$total = $me[0]["tc"];
$me = $me[0]["my"];
$pot = $total * $minupload;
$pot += $number_to_win;
$me2 = get_result("SELECT `id` FROM `{$TABLE_PREFIX}lottery_tickets` WHERE `user`=".$CURUSER['uid']." ORDER BY `id` ASC",true,$btit_settings["cache_duration"]);
foreach ($me2 as $myrow){
    $ticketnumbers .=  $myrow['id'].", ";
}

if($me >= $limit_buy) {
    $purchaseable = 0;
} else {
    if ($me == 0) {
        if($purch >= $limit_buy) {
            $purchaseable = $limit_buy;
        } else {
            $purchaseable = $purch;
        }
    } else {
        $purchaseable = ($limit_buy-$me);
    }
}
    
if ($now >= $expire || $enabled != 'yes'){
    $purchaseable = 0;
}

$ticketstpl = new bTemplate();
$ticketstpl-> set("frm_action", "index.php?page=lottery_purchase");
$ticketstpl-> set("last_winners", "index.php?page=lottery_winners");
$ticketstpl-> set("language", $language);
$ticketstpl-> set("min_upload_cost", makesize($minupload));

if ($enabled == 'yes') {
    $ticketstpl-> set("expire_date", $language["LOTT_TICK_MSG6"]." ".$expire_date);
    $ticketstpl-> set("own_ticket_numbers", "<li>".$language["LOTT_TICK_MSG12"]." ".$ticketnumbers."</li>");
} else {
    $ticketstpl-> set("expire_date", $language["LOTT_CLOSED"]);
    $ticketstpl-> set("own_ticket_numbers", "");
}
$ticketstpl-> set("number_winners", $number_winners);
$ticketstpl-> set("amount_to_win", makesize((($pot==0)?0:$pot/$number_winners)));
$ticketstpl-> set("amount_in_pot", makesize($pot));
$ticketstpl-> set("amount_purchased_total", $total);
$ticketstpl-> set("amount_purchased_you", $me);
$ticketstpl-> set("amount_can_buy", $purchaseable);

if ($now >= $expire || $enabled != 'yes')
    $ticketstpl-> set("competition_closed", true, true);
else
    $ticketstpl-> set("competition_closed", false, true);

if ($purch < 1)
    $ticketstpl-> set("need_upload", true, true);
else
    $ticketstpl-> set("need_upload", false, true);

if ($purchaseable >= 1)
    $ticketstpl-> set("can_purchase", true, true);
else
    $ticketstpl-> set("can_purchase", false, true);
?>