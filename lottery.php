<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
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

if (!defined('IN_BTIT'))
	  die('non direct access!');

	  
global $CURUSER, $TABLE_PREFIX, $SITENAME;

if ($CURUSER && $CURUSER["id_level"] >= '3') {

	// load language file
	require(load_language("lang_lottery.php"));

	$query	= do_sqlquery("SELECT * FROM `{$TABLE_PREFIX}lottery_config` WHERE id=1", true);
	$config = $query->fetch_array();
	$expire_date = $config['lot_expire_date'];
	$number_winners = $config['lot_number_winners'];
	$number_to_win = $config['lot_number_to_win'];
	$minupload = $config['lot_amount'];
	$limit_buy = $config['limit_buy'];
	$enabled = $config['lot_status'];
	$now = strtotime("now");
	$expire = strtotime($expire_date);
	$date = substr($expire_date, 8, -9)."-".substr($expire_date, 5, -12);
	$time = substr($expire_date, 11, -3);
	$total = sql_num_rows(do_sqlquery("SELECT * FROM `{$TABLE_PREFIX}lottery_tickets`", true));
	$me = sql_num_rows(do_sqlquery("SELECT * FROM `{$TABLE_PREFIX}lottery_tickets` WHERE user=".$CURUSER['uid']."", true));
	$pot = $total * $minupload;
	$pot += $number_to_win;
	$res = do_sqlquery("SELECT downloaded, uploaded FROM `{$TABLE_PREFIX}users` WHERE id=".$CURUSER['uid']."", true);
	$result = $res->fetch_assoc();
	$purch = floor($result["uploaded"]/$minupload);

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

	$outlot = "<br/> <br/> <br/>";
	$outlot.= "<table class=lista width=50% cellspacing=0 align=center>";
	$outlot.= "<tr><td colspan=2 align=center class=lista style='text-align:center;'>".$SITENAME."</a></td></tr>";
	$outlot.= "<tr><td align=left class=lista style='border-bottom: solid 1px #9BAEBF;width:65%;font-size:x-small;'>".$language["LOTT_EXPIRE_DATE"].":</td><td align=right class=lista style='border-bottom: solid 1px #9BAEBF;width:35%;font-size:x-small;'>".$date."</td></tr>";
	$outlot.= "<tr><td align=left class=lista style='border-bottom: solid 1px #9BAEBF;width:65%;font-size:x-small;'>".$language["LOTT_EXPIRE_TIME"].":</td><td align=right class=lista style='border-bottom: solid 1px #9BAEBF;width:35%;font-size:x-small;'>".$time."</td></tr>";
	$outlot.= "<tr><td align=left class=lista style='border-bottom: solid 1px #9BAEBF;width:65%;font-size:x-small;'>".$language["LOTT_TOTAL_IN_POT"].":</td><td align=right class=lista style='border-bottom: solid 1px #9BAEBF;width:35%;font-size:x-small;'>".makesize($pot)."</td></tr>";
	$outlot.= "<tr><td align=left class=lista style='border-bottom: solid 1px #9BAEBF;width:65%;font-size:x-small;'>".$language["LOTT_TOTAL_TICKETS_SELLED"].":</td><td align=right class=lista style='border-bottom: solid 1px #9BAEBF;width:35%;font-size:x-small;'>".$total."</td></tr>";
	$outlot.= "<tr><td align=left class=lista style='border-bottom: solid 1px #9BAEBF;width:65%;font-size:x-small;'>".$language["LOTT_YOUR_TICKETS"].":</td><td align=right class=lista style='border-bottom: solid 1px #9BAEBF;width:35%;font-size:x-small;'>".$me."</td></tr>";
	$outlot.= "<tr><td align=left class=lista style='border-bottom: solid 1px #9BAEBF;width:65%;font-size:x-small;'>".$language["LOTT_PURCHASEABLE"].":</td><td align=right class=lista style='border-bottom: solid 1px #9BAEBF;width:35%;font-size:x-small;'>".$purchaseable."</td></tr>";
	if ($now >= $expire || $enabled != 'yes'){
		$outlot.= "<tr><td colspan=2 class=lista><h1><font color=red>".$language["LOTT_CLOSED"]."</font></h1></td></tr>";
	}
	if ($purchaseable > 0){
		$outlot.= "<tr><td class=lista colspan=2 align=center><form method=post action=index.php?page=lottery_purchase><font size=-6><center>".$language["LOTT_PURCHASE"]."  </font><input type=text name=number size=1><font size=-6>  ".$language["LOTT_TICKETS"]."</font><br><br><input type=submit class=btn value=".$language["LOTT_PURCHASE"]."></center></form></td></tr>";
	}

	$outlot.= "<tr></tr><tr></tr><tr></tr>";
	$outlot.= ("<tr><td align=center colspan=2><a href=\"index.php?page=lottery_tickets\"><center><img src='images/ticket.png'  /></center></a></td></tr><tr><td align=center colspan=2><a href=\"index.php?page=lottery_winners\" id='lotwin'><center>Previous Winners</center></a></td></tr></table>");

	$tpl->set("main_content",$outlot);
}
?>
