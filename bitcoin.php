<?php
// Please encrypt me
require_once ("include/functions.php");
dbconn();
$THIS_BASEPATH=dirname(__FILE__);
$res = get_result("SELECT * FROM `{$TABLE_PREFIX}paypal_settings` WHERE `id`=1", true);
$bitcoinSettings = $res[0];

$invoice_id = (int)0 + $_GET["invoice"];
$tracker_id = (int)0 + $_GET["id"];
$secret = base64_decode($_GET["secret"]);
$input_address = $_GET["input_address"];

quickQuery("DELETE FROM `{$TABLE_PREFIX}bitcoin_invoices` WHERE `added`<(UNIX_TIMESTAMP()-604800) AND `lastupdate`=0");
$res = get_result("SELECT * FROM `{$TABLE_PREFIX}bitcoin_invoices` WHERE `invoice_id`='".$invoice_id."' AND `tracker_id`='".$tracker_id."' AND `secret`='".sql_esc($secret)."' AND `input_address`='".sql_esc($input_address)."'");
if(count($res) == 1)
{
    $row = $res[0];
    $transaction_hash = $_GET["transaction_hash"];
    $input_transaction_hash = $_GET["input_transaction_hash"];
    $value_in_satoshi = $_GET["value"];
    $value_in_btc = $value_in_satoshi / 100000000;
    $confirmation_count = (int)0 + $_GET["confirmations"];

    if($row["secret"] != $secret)
    {
        return;
    }
    if($_GET['test'] == true)
    {
        return;
    }
    if($_GET['destination_address'] != $bitcoinSettings["bitcoin_address"])
    {
        return;
    }
    if($row["lastupdate"]>0 && $confirmation_count >= 6)
    {
        quickQuery("UPDATE `{$TABLE_PREFIX}bitcoin_invoices` SET `confirmation_count`='".$confirmation_count."', `state`='completed', `lastupdate`=UNIX_TIMESTAMP() WHERE `invoice_id`='".$invoice_id."' AND `tracker_id`='".$tracker_id."' AND `secret`='".sql_esc($secret)."' AND `input_address`='".$input_address."'");

        // find username
        $zap_usr = get_result("SELECT `u`.`username`, `u`.`id_level`, `l`.`language_url`".(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_donate"] == "enabled")?", `u`.`user_notes`":"")." FROM `{$TABLE_PREFIX}users` `u` INNER JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language`=`l`.`id` WHERE `u`.`id`=".$tracker_id);
        $wyn_usr = $zap_usr[0];

        $englang = "language/english";
        require_once ($THIS_BASEPATH."/".$englang."/lang_main.php");
        require_once ($THIS_BASEPATH."/".$englang."/lang_aads.php");
        if($wyn_usr["language_url"] != $englang)
        {
            require_once ($THIS_BASEPATH."/".$wyn_usr["language_url"]."/lang_main.php");
            require_once ($THIS_BASEPATH."/".$wyn_usr["language_url"]."/lang_aads.php");
         }
        if(!isset($language["SYSTEM_USER"]))
            $language["SYSTEM_USER"] = "System";

        $item_number = $row["product_type"];
        $payment_amount = $row["received_in_currency"];
        $payment_currency = $row["currency"];

        if($item_number == 1 || $item_number == 2 || $item_number == 4 || $item_number == 5)
            $first_name_site = $wyn_usr["username"];
        else
            $first_name_site = "anonymous";

        if($payment_amount <= $bitcoinSettings["today"])
            $vipdays = floor($payment_amount * $bitcoinSettings["vip_days"]);
        elseif($payment_amount > $bitcoinSettings["today"] && $payment_amount <= $bitcoinSettings["todayb"])
            $vipdays = floor($payment_amount * $bitcoinSettings["vip_daysb"]);
        else
            $vipdays = floor($payment_amount * $bitcoinSettings["vip_daysc"]);

        if($payment_amount <= $bitcoinSettings["togb"])
        {
            $bonus = (1073741824 * $bitcoinSettings["gb"]);
            $pm_bonus = ($payment_amount * $bitcoinSettings["gb"]);
        }
        elseif($payment_amount > $bitcoinSettings["togb"] && $payment_amount <= $bitcoinSettings["togbb"])
        {
            $bonus = (1073741824 * $bitcoinSettings["gbb"]);
            $pm_bonus = ($payment_amount * $bitcoinSettings["gbb"]);
        }
        else
        {
            $bonus = (1073741824 * $bitcoinSettings["gbc"]);
            $pm_bonus = ($payment_amount * $bitcoinSettings["gbc"]);
        }
        $bc = "Bitcoin";

        // write to database
        $query = "INSERT INTO `{$TABLE_PREFIX}donors` (`id`, `system`, `test`, `userid`, `first_name`, `last_name`, `payers_email`, `mc_gross`, `date`, `country`, `item`)VALUES (NULL, '".$bc."', 'off', '".$tracker_id."', '".$first_name_site."', '', '', '".$payment_amount."', NOW() ,'' , '".$item_number."')";
        do_sqlquery($query);
        $bct = ($bitcoinSettings["received"] + $payment_amount);
        quickQuery("UPDATE `{$TABLE_PREFIX}paypal_settings` SET `received`='".$bct."' WHERE `id`='1'");

        // upload bonus
        if($item_number == 2)
        {
            $bonus_user = ($payment_amount * $bonus);
            // send pm here
            $mesg = $language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"].",\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM1_TEXT_3_BC']." ".$pm_bonus." ".$language['AADS_PM1_TEXT_4']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
            send_pm(0, $tracker_id, sqlesc($language['AADS_PM_SUBJ']), sqlesc($mesg));
            quickQuery("UPDATE `".(($XBTT_USE)?"xbt_":$TABLE_PREFIX)."users` SET `uploaded` = `uploaded` +".$bonus_user." WHERE `".(($XBTT_USE)?"u":"")."id` = '".$tracker_id."' ");

            if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_donate"] == "enabled")
            {
                if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                    $usernotes = unserialize(unesc($wyn_usr["user_notes"]));
                else
                    $usernotes = array();

                $usernotes[] = base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_2"]." [b]".makesize($bonus_user)."[/b] ".$language["UN_DONATE_3"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                $new_notes = serialize($usernotes);
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$tracker_id);
            }
        }
        //timed ranks start
        if($item_number == 0 || $item_number == 1 || $item_number == 4)
        {
            // staff demote protection
            $staff = $wyn_usr["id_level"];
            $zap_usr_st = get_result("SELECT id_level FROM {$TABLE_PREFIX}users_level WHERE id =$staff");
            $wyn_usr_st = $zap_usr_st[0];

            if($wyn_usr_st["id_level"] <= 6 && ($item_number == 1 || $item_number == 4))
            {
                if($item_number == 1)
                {
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET  `old_rank` = `id_level` WHERE `id`=".$tracker_id);

                    $pet2 = "yes";
                    $pet3 = $bitcoinSettings["vip_rank"];
                    $pet4 = $vipdays;
                    $pet1 = rank_expiration_dt(time() + ($pet4 * 86400));
                    $queryjoin = "";
                    $querymod = "";
                    if(($btit_settings["fmhack_torrents_limit"] == "enabled" || $btit_settings["fmhack_enhanced_wait_time"] == "enabled" || $btit_settings["fmhack_VIP_freeleech"] == "enabled") && $XBTT_USE)
                    {
                        $queryjoin .= "LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON ".$pet3."=`ul`.`id` ";
                        $queryjoin .= "LEFT JOIN `xbt_users` `xu` ON `u`.`id`=`xu`.`uid` ";
                        $querymod .= (($btit_settings["fmhack_torrents_limit"] == "enabled")?"`u`.`custom_torr_limit`='no', `xu`.`torrents_limit`=`ul`.`torrents_limit`,":"").(($btit_settings["fmhack_enhanced_wait_time"] == "enabled")?"`u`.`custom_wait_time`='no', `xu`.`wait_time`=IF(`ul`.`WT`>0,(`ul`.`WT`*3600),0),":"").(($btit_settings["fmhack_VIP_freeleech"] == "enabled")?"`u`.`vipfl_down`=IF(`ul`.`freeleech`='yes', `xu`.`downloaded`, '0'), `u`.`vipfl_date`=IF(`ul`.`freeleech`='yes', UNIX_TIMESTAMP(), '0'),":"");
                    }
                    // send pm here
                    $mesg = $language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"]." ,\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM2_TEXT_1_BC']." ".$vipdays." ".$language['AADS_PM2_TEXT_2']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                    send_pm(0, $tracker_id, sqlesc($language['AADS_PM_SUBJ']), sqlesc($mesg));

                    if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_donate"] == "enabled")
                    {
                        if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                            $usernotes = unserialize(unesc($wyn_usr["user_notes"]));
                        else
                            $usernotes = array();

                        $usernotes[] = base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_2"]." ".$language["UN_DONATE_4"]." [b]".$vipdays."[/b] ".$language["UN_DONATE_5"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                        $new_notes = serialize($usernotes);
                    }
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` `u` ".$queryjoin." SET ".$querymod." `u`.`timed_rank`='".$pet1."', `u`.`rank_switch`='".$pet2."', `u`.`id_level`='".$pet3."'".(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_donate"] == "enabled")?" `u`.`user_notes`='".sql_esc($new_notes)."'":"")." WHERE `u`.`id`=".$tracker_id);
                    global $FORUMLINK;
                    if(substr($FORUMLINK, 0, 3) == "smf")
                    {
                        $smf = get_result("SELECT `smf_fid` FROM `{$TABLE_PREFIX}users` WHERE `id` =".$tracker_id);
                        $smf_user = $smf[0];
                        quickQuery("UPDATE `{$db_prefix}members` SET ".(($FORUMLINK == "smf")?"`ID_GROUP`":"`id_group`")." = ".$bitcoinSettings["smf"]." WHERE ".(($FORUMLINK == "smf")?"`ID_MEMBER`":"`id_member`")."=".$smf_user["smf_fid"]);
                    }
                    elseif($FORUMLINK == "ipb")
                    {
                        $ipb = get_result("SELECT `ipb_fid` FROM `{$TABLE_PREFIX}users` WHERE `id` =".$tracker_id);
                        $ipb_user = $ipb[0];
                        quickQuery("UPDATE `{$ipb_prefix}members` SET `member_group_id`= ".$bitcoinSettings["smf"]." WHERE `member_id`=".$ipb_user["ipb_fid"]);
                    }
                }
                elseif($item_number == 4)
                {
                    $petr1 = get_result("SELECT `rank_switch`, `old_rank`, UNIX_TIMESTAMP(`timed_rank`) `timed_rank` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$tracker_id);
                    $fied = $petr1[0];

                    if($fied["timed_rank"] > 0)
                        $new_expire_time = date("Y-m-d H:i:s", ($fied["timed_rank"] + ($vipdays * 86400)));
                    else
                        $new_expire_time = date("Y-m-d H:i:s", (time() + ($vipdays * 86400)));

                    if($fied["rank_switch"] == "yes")
                    {
                        // send pm here
                        $mesg = $language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"]." ,\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM2_TEXT_1_BC']." ".$language['AADS_PM2_TEXT_1A']." ".$vipdays." ".$language['AADS_PM2_TEXT_2']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                        send_pm(0, $tracker_id, sqlesc($language['AADS_PM_SUBJ']), sqlesc($mesg));

                        if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_donate"] == "enabled")
                        {
                            if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                                $usernotes = unserialize(unesc($wyn_usr["user_notes"]));
                            else
                                $usernotes = array();

                            $usernotes[] = base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_2"]." ".$language["UN_DONATE_6"]." [b]".$vipdays."[/b] ".$language["UN_DONATE_5"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                            $new_notes = serialize($usernotes);
                        }
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `timed_rank`='".$new_expire_time."'".(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_donate"] == "enabled")?" `user_notes`='".sql_esc($new_notes)."'":"")." WHERE `id`=".$tracker_id);
                    }
                }
            }
            else
            {
                $mesg = $language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"]." ,\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM3_TEXT_1_BC']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                send_pm(0, $tracker_id, sqlesc($language['AADS_PM_SUBJ']), sqlesc($mesg));

                if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_donate"] == "enabled")
                {
                    if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                        $usernotes = unserialize(unesc($wyn_usr["user_notes"]));
                    else
                        $usernotes = array();

                    $usernotes[] = base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_7"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                    $new_notes = serialize($usernotes);
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$tracker_id);
                }
            }
        }
        //timed ranks end

        if($item_number == 5 && $btit_settings["fmhack_freeleech_slots"] == "enabled" && $bitcoinSettings["fl_slot"] == "true" && $bitcoinSettings["fl_slot_cost"] > 0)
        {
            $numberOfSlots = floor($payment_amount / $bitcoinSettings["fl_slot_cost"]);
            if($numberOfSlots >= 1)
            {
                $mesg = $language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"]." ,\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM4_TEXT_1']." Bitcoin ".$language['AADS_PM4_TEXT_2']." [b]".$numberOfSlots."[/b] ".$language['AADS_PM4_TEXT_3']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                send_pm(0, $tracker_id, sqlesc($language['AADS_PM_SUBJ']), sqlesc($mesg));

                if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_donate"] == "enabled")
                {
                    if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                        $usernotes = unserialize(unesc($wyn_usr["user_notes"]));
                    else
                        $usernotes = array();

                    $usernotes[] = base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_2"]." [b]".$numberOfSlots."[/b] ".$language["UN_DONATE_8"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                    $new_notes = serialize($usernotes);
                }
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `freeleech_slots`=`freeleech_slots`+".$numberOfSlots.(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_donate"] == "enabled")?" `user_notes`='".sql_esc($new_notes)."'":"")." WHERE `id`=".$tracker_id);
            }
        }
        // simple donor display bridge
        if($bitcoinSettings["don_star"] == "true")
        {
            quickQuery("UPDATE {$TABLE_PREFIX}users SET donor = '".(($first_name_site == "anonymous")?"no":"yes")."' WHERE id =".$tracker_id);
        }
        // donation history bridge
        if($bitcoinSettings["historie"] == "true")
        {
            $donation = get_result("SELECT * FROM {$TABLE_PREFIX}don_historie WHERE don_id ='$tracker_id'");
            $dh = $donation[0];

            if(empty($dh["don_ation"]))
                do_sqlquery('insert INTO '.$TABLE_PREFIX.'don_historie SET donate_date=NOW(),don_ation="'.$payment_amount.'" ,don_id='.$tracker_id);
            elseif(empty($dh["don_ation_1"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_1="'.$payment_amount.'",donate_date_1=NOW() WHERE don_id='.$tracker_id);
            elseif(empty($dh["don_ation_2"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_2="'.$payment_amount.'",donate_date_2=NOW() WHERE don_id='.$tracker_id);
            elseif(empty($dh["don_ation_3"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_3="'.$payment_amount.'",donate_date_3=NOW() WHERE don_id='.$tracker_id);
            elseif(empty($dh["don_ation_4"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_4="'.$payment_amount.'",donate_date_4=NOW() WHERE don_id='.$tracker_id);
            elseif(empty($dh["don_ation_5"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_5="'.$payment_amount.'",donate_date_5=NOW() WHERE don_id='.$tracker_id);
            elseif(empty($dh["don_ation_6"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_6="'.$payment_amount.'",donate_date_6=NOW() WHERE don_id='.$tracker_id);
            elseif(empty($dh["don_ation_7"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_7="'.$payment_amount.'",donate_date_7=NOW() WHERE don_id='.$tracker_id);
            elseif(empty($dh["don_ation_8"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_8="'.$payment_amount.'",donate_date_8=NOW() WHERE don_id='.$tracker_id);
            elseif(empty($dh["don_ation_9"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_9="'.$payment_amount.'",donate_date_9=NOW() WHERE don_id='.$tracker_id);
            elseif(empty($dh["don_ation_10"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_10="'.$payment_amount.'",donate_date_10=NOW() WHERE don_id='.$tracker_id);
        }
        echo "*ok*";
    }
    else
    {
        $received_in_currency=(($value_in_btc!=$row["price_in_btc"])?round((($value_in_btc/$row["price_in_btc"])*$row["price_in_currency"]),2):$row["price_in_currency"]);
        quickQuery("UPDATE `{$TABLE_PREFIX}bitcoin_invoices` SET `confirmation_count`='".$confirmation_count."', `transaction_hash`='".sql_esc($transaction_hash)."', `input_transaction_hash`='".sql_esc($input_transaction_hash)."', `received_in_btc`='".sql_esc($value_in_btc)."', `received_in_currency`='".$received_in_currency."', `lastupdate`=UNIX_TIMESTAMP() WHERE `invoice_id`='".$invoice_id."' AND `tracker_id`='".$tracker_id."' AND `secret`='".sql_esc($secret)."' AND `input_address`='".$input_address."'");
    }
}
else
    return;

?>