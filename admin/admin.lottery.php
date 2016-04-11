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

if (!defined("IN_ACP"))
      die("non direct access!");



$action = $_GET['action'];
$returnto = "index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=lottery_settings";

if($action == 'send')
{
	$expire_date = $_POST['expire_date'];
	$expire_time = $_POST['expire_time'];
	$val1	= 	$expire_date." ".$expire_time.":00:00";
	$val2	=	$_POST['number_winners'];
	$val3	=	$_POST['min_amout_to_win']*1024*1024*1024;	// Gb
	$val4	=	$_POST['amount_to_pay']*1024*1024;		// Mb
	$val5	=	$_POST["enabled"]?"yes":"no";
	$val6	=	$_POST['limit_buy'];
	$val7	=	$_POST['sender_id'];
	quickQuery("UPDATE `{$TABLE_PREFIX}lottery_config` SET `lot_expire_date`='".$val1."', `lot_number_winners`='".$val2."', `lot_number_to_win`='".$val3."', `lot_amount`='".$val4."', `lot_status`='".$val5."', `limit_buy`='".$val6."', `sender_id`=".$val7." WHERE `id`=1", true);
	header("Location: $BASEURL/$returnto");
}
else
{
	$query = do_sqlquery("SELECT * FROM `{$TABLE_PREFIX}lottery_config` WHERE `id`=1", true);
	$row = $query->fetch_array();

	$admintpl->set("language",$language);
	$admintpl->set("frm_action", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=lottery_settings&amp;action=send");
	$admintpl->set("expire_date", substr($row["lot_expire_date"], 0 , -9));
	$admintpl->set("expire_time", substr($row["lot_expire_date"], -8, -6));
	$admintpl->set("number_winners", $row["lot_number_winners"]);
	$admintpl->set("amount_to_pay", substr(makesize($row["lot_amount"]), 0, -6));
	$admintpl->set("amount_to_win", substr(makesize($row["lot_number_to_win"]), 0, -6));
	$admintpl->set("limit_to_buy", $row["limit_buy"]);
	$admintpl->set("sender_id", $row["sender_id"]);
	$admintpl->set("lottery_enabled", ($row["lot_status"]=="yes"?"checked=\"checked\"":""));
	$admintpl->set("view_selled_tickets", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=view_selled_tickets");
}

?>
