<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
//    Advanced Auto Donation System by DiemThuy ( sept 2009 )
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
$THIS_BASEPATH=dirname(__FILE__);
require("$THIS_BASEPATH/include/functions.php");

dbconn(true);

// get settings
$zap_pp = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}paypal_settings WHERE id ='1'");
$settings = $zap_pp->fetch_array();

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value)
{
    $value = urlencode(stripslashes($value));
    $req .= "&$key=$value";
}

// post back to PayPal system to validate
$header = "POST /cgi-bin/webscr HTTP/1.1\r\n";


// If testing on Sandbox use:
if ($settings["test"]=="true")
    $header .= "Host: www.sandbox.paypal.com:80\r\n";
if ($settings["test"]=="false")
    $header .= "Host: www.paypal.com:80\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Connection: close\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

// If testing on Sandbox use:
if ($settings["test"]=="true")
{
    $fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);
    $ppmail= $settings["sandbox_email"];
    $dttest='on';
}
else
{
	  $fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
    $ppmail= $settings["sandbox_email"];
    $dttest='on';
}
if ($settings["test"]=="false")
{
    $fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
    $ppmail= $settings["paypal_email"];
    $dttest='off';
}
else
{
	  $fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
    $ppmail= $settings["paypal_email"];
    $dttest='on';
}

// assign posted variables to local variables
$item_name = $_POST['item_name'];
(isset($_POST["item_number"]) && is_numeric($_POST["item_number"])) ? $item_number = $_POST['item_number'] : $item_number=FALSE;
$payment_status = $_POST['payment_status'];
(isset($_POST["mc_gross"]) && is_numeric($_POST["mc_gross"])) ? $payment_amount = $_POST['mc_gross'] : $payment_amount=0;
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$anonymous=$_POST['custom'];
$receiver_email = $_POST['receiver_email'];
(isset($_POST["custom"]) && is_numeric($_POST["custom"])) ? $custom = $_POST['custom'] : $custom=0;
$payer_email = sql_esc($_POST['payer_email']);
$first_name = $_POST['first_name'];
$last_name = sql_esc($_POST['last_name']);
$country = sql_esc($_POST['address_country']);
$payment_type = $_POST['payment_type'];

// block pending echecks. paypal posts payments again when echecks clear, blocks double credits.
if ($payment_type == "echeck" && $payment_status == "Pending") die;

if (!$fp)
{
    // HTTP ERROR
}
else
{
    fputs ($fp, $header . $req);
    while (!feof($fp))
    {
        $res = fgets ($fp, 1024);
        $res = trim ($res);
        if (strcmp ($res, "VERIFIED") == 0)
        {
            // process payment
            if ($receiver_email == $ppmail)
            {
                // find username
                $zap_usr = do_sqlquery("SELECT `u`.`username`, `u`.`id_level`, `l`.`language_url`".(($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_donate"]=="enabled")?", `u`.`user_notes`":"")." FROM `{$TABLE_PREFIX}users` `u` INNER JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language`=`l`.`id` WHERE `u`.`id`=$custom");
                $wyn_usr = $zap_usr->fetch_array();

                $englang="language/english";
                require_once($THIS_BASEPATH."/".$englang."/lang_main.php");
                require_once($THIS_BASEPATH."/".$englang."/lang_aads.php");
                if($wyn_usr["language_url"]!=$englang)
                    require_once($THIS_BASEPATH."/".$wyn_usr["language_url"]."/lang_main.php");
                if(!isset($language["SYSTEM_USER"]))
                    $language["SYSTEM_USER"]="System";
                if ($item_number == 1 || $item_number == 2 || $item_number == 4 || $item_number == 5)
                    $first_name_site = $wyn_usr["username"];
                else
                    $first_name_site="anonymous";

                if ($payment_amount <= $settings["today"])
                    $vipdays = floor($payment_amount * $settings["vip_days"]);
                else if ($payment_amount > $settings["today"] AND $payment_amount <= $settings["todayb"])
                    $vipdays = floor($payment_amount * $settings["vip_daysb"]);
                else
                    $vipdays = floor($payment_amount * $settings["vip_daysc"]);

                if ($payment_amount <= $settings["togb"])
                {
                    $bonus =(1073741824*$settings["gb"]);
                    $pm_bonus =( $payment_amount * $settings["gb"] );
                }
                else if ($payment_amount > $settings["togb"] AND $payment_amount <= $settings["togbb"])
                {
                    $bonus =(1073741824*$settings["gbb"]);
                    $pm_bonus =( $payment_amount * $settings["gbb"] );
                }
                else
                {
                    $bonus =(1073741824*$settings["gbc"]);
                    $pm_bonus =( $payment_amount * $settings["gbc"] );
                }
                $pp="PayPal";

                // write to database
                $query = "INSERT INTO {$TABLE_PREFIX}donors (id, system, test, userid, first_name, last_name, payers_email, mc_gross, date, country, item)VALUES (NULL, '$pp', '$dttest', '$custom', '$first_name_site', '$last_name', '$payer_email', '$payment_amount', NOW() ,'$country' , '$item_number')";
                do_sqlquery($query);
                $ppt=  ($settings["received"]+ $payment_amount);
                quickQuery("UPDATE {$TABLE_PREFIX}paypal_settings SET received='$ppt' WHERE id='1'");

                // upload bonus
                if ($item_number == 2 )
                {
                    $bonus_user = ($payment_amount * $bonus );
                    // send pm here
                    $mesg=$language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"].",\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM1_TEXT_3']." ".$pm_bonus." ".$language['AADS_PM1_TEXT_4']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                    send_pm(0,$custom,sqlesc($language['AADS_PM_SUBJ']),sqlesc($mesg));
                    quickQuery("UPDATE `".(($XBTT_USE)?"xbt_":$TABLE_PREFIX)."users` SET `uploaded` = `uploaded` +".$bonus_user." WHERE `".(($XBTT_USE)?"u":"")."id` = '".$custom."' ");

                    if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_donate"]=="enabled")
                    {
                        if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                            $usernotes=unserialize(unesc($wyn_usr["user_notes"]));
                        else
                            $usernotes=array();

                        $usernotes[]=base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_2"]." [b]".makesize($bonus_user)."[/b] ".$language["UN_DONATE_3"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                        $new_notes=serialize($usernotes);
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$custom);
                    }
                }
                //timed ranks start
                if ($item_number == 0 || $item_number == 1 || $item_number == 4)
                {
                    // staff demote protection
                    $staff = $wyn_usr["id_level"];
                    $zap_usr_st = do_sqlquery("SELECT id_level FROM {$TABLE_PREFIX}users_level WHERE id =$staff");
                    $wyn_usr_st = $zap_usr_st->fetch_array();

                    if  ($wyn_usr_st["id_level"] <=6 && ($item_number == 1 || $item_number == 4))
                    {
                        if($item_number == 1)
                        {
                            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET  `old_rank` = `id_level` WHERE `id`=".$custom);

                            $dt2 = "yes";
                            $dt3 = $settings["vip_rank"];
                            $dt4 = $vipdays;
                            $dt1=rank_expiration_dt(time()+($dt4*86400));
                            $queryjoin = "";
                            $querymod = "";
                            if(($btit_settings["fmhack_torrents_limit"] == "enabled" || $btit_settings["fmhack_enhanced_wait_time"] == "enabled" || $btit_settings["fmhack_VIP_freeleech"]=="enabled") && $XBTT_USE)
                            {
                                $queryjoin .= "LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON ".$dt3."=`ul`.`id` ";
                                $queryjoin .= "LEFT JOIN `xbt_users` `xu` ON `u`.`id`=`xu`.`uid` ";
                                $querymod .= (($btit_settings["fmhack_torrents_limit"] == "enabled")?"`u`.`custom_torr_limit`='no', `xu`.`torrents_limit`=`ul`.`torrents_limit`,":"").(($btit_settings["fmhack_enhanced_wait_time"] == "enabled")?"`u`.`custom_wait_time`='no', `xu`.`wait_time`=IF(`ul`.`WT`>0,(`ul`.`WT`*3600),0),":"").(($btit_settings["fmhack_VIP_freeleech"]=="enabled")?"`u`.`vipfl_down`=IF(`ul`.`freeleech`='yes', `xu`.`downloaded`, '0'), `u`.`vipfl_date`=IF(`ul`.`freeleech`='yes', UNIX_TIMESTAMP(), '0'),":"");
                            }
                            quickQuery("UPDATE `{$TABLE_PREFIX}users` `u` ".$queryjoin." SET ".$querymod." `u`.`timed_rank`='".$dt1."', `u`.`rank_switch`='".$dt2."', `u`.`id_level`='".$dt3."' WHERE `u`.`id`=".$custom);

                            //smf rank
                            global $FORUMLINK ;
                            if(substr($FORUMLINK,0,3)=="smf")
                            {
                                $smf=do_sqlquery("SELECT `smf_fid` FROM `{$TABLE_PREFIX}users` WHERE `id` =".$custom);
                                $smf_user = $smf->fetch_array();
                                quickQuery("UPDATE `{$db_prefix}members` SET ".(($FORUMLINK=="smf")?"`ID_GROUP`":"`id_group`")." = ".$settings["smf"]." WHERE ".(($FORUMLINK=="smf")?"`ID_MEMBER`":"`id_member`")."=".$smf_user["smf_fid"]);
                            }
                            elseif($FORUMLINK=="ipb")
                            {
                                $ipb=do_sqlquery("SELECT `ipb_fid` FROM `{$TABLE_PREFIX}users` WHERE `id` =".$custom);
                                $ipb_user = $ipb->fetch_array();
                                quickQuery("UPDATE `{$ipb_prefix}members` SET `member_group_id`= ".$settings["smf"]." WHERE `member_id`=".$ipb_user["ipb_fid"]);
                            }

                            // send pm here
                            $mesg=$language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"]." ,\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM2_TEXT_1']." ".$vipdays." ".$language['AADS_PM2_TEXT_2']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                            send_pm(0,$custom,sqlesc($language['AADS_PM_SUBJ']),sqlesc($mesg));

                            if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_donate"]=="enabled")
                            {
                                if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                                    $usernotes=unserialize(unesc($wyn_usr["user_notes"]));
                                else
                                    $usernotes=array();

                                $usernotes[]=base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_2"]." ".$language["UN_DONATE_4"]." [b]".$vipdays."[/b] ".$language["UN_DONATE_5"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                                $new_notes=serialize($usernotes);
                                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$custom);
                            }
                        }
                        elseif($item_number == 4)
                        {
                            $petr1=do_sqlquery("SELECT `rank_switch`, `old_rank`, UNIX_TIMESTAMP(`timed_rank`) `timed_rank` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$custom);
                            $fied=$petr1->fetch_assoc();

                            if($fied["timed_rank"]>0)
                                $new_expire_time=date("Y-m-d H:i:s", ($fied["timed_rank"]+($vipdays*86400)));
                            else
                                $new_expire_time=date("Y-m-d H:i:s", (time()+($vipdays*86400)));

                            if($fied["rank_switch"]=="yes")
                            {
                                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `timed_rank`='".$new_expire_time."' WHERE `id`=".$custom);

                                // send pm here
                                $mesg=$language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"]." ,\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM2_TEXT_1']." ".$language['AADS_PM2_TEXT_1A']." ".$vipdays." ".$language['AADS_PM2_TEXT_2']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                                send_pm(0,$custom,sqlesc($language['AADS_PM_SUBJ']),sqlesc($mesg));

                                if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_donate"]=="enabled")
                                {
                                    if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                                        $usernotes=unserialize(unesc($wyn_usr["user_notes"]));
                                    else
                                        $usernotes=array();

                                    $usernotes[]=base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_2"]." ".$language["UN_DONATE_6"]." [b]".$vipdays."[/b] ".$language["UN_DONATE_5"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                                    $new_notes=serialize($usernotes);
                                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$custom);
                                }
                            }
                        }
                    }
                    else
                    {
                        $mesg=$language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"]." ,\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM3_TEXT_1']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                        send_pm(0,$custom,sqlesc($language['AADS_PM_SUBJ']),sqlesc($mesg));

                        if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_donate"]=="enabled")
                        {
                            if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                                $usernotes=unserialize(unesc($wyn_usr["user_notes"]));
                            else
                                $usernotes=array();

                            $usernotes[]=base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_7"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                            $new_notes=serialize($usernotes);
                            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$custom);
                        }
                    }
                }
                //timed ranks end

                if($item_number == 5 && $btit_settings["fmhack_freeleech_slots"] == "enabled" && $settings["fl_slot"] == "true" && $settings["fl_slot_cost"] > 0)
                {
                    $numberOfSlots = floor($payment_amount / $settings["fl_slot_cost"]);
                    if($numberOfSlots >= 1)
                    {
                        $mesg = $language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"]." ,\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM4_TEXT_1']." PayPal ".$language['AADS_PM4_TEXT_2']." [b]".$numberOfSlots."[/b] ".$language['AADS_PM4_TEXT_3']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                        send_pm(0, $custom, sqlesc($language['AADS_PM_SUBJ']), sqlesc($mesg));

                        if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_donate"] == "enabled")
                        {
                            if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                                $usernotes = unserialize(unesc($wyn_usr["user_notes"]));
                            else
                                $usernotes = array();

                            $usernotes[] = base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_2"]." [b]".$numberOfSlots."[/b] ".$language["UN_DONATE_8"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                            $new_notes = serialize($usernotes);
                        }
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `freeleech_slots`=`freeleech_slots`+".$numberOfSlots.(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_donate"] == "enabled")?" `user_notes`='".sql_esc($new_notes)."'":"")." WHERE `id`=".$custom);
                    }
                }
                // simple donor display bridge
                if ($settings["don_star"]=="true")
                {
                    quickQuery("UPDATE {$TABLE_PREFIX}users SET donor = '".(($first_name_site=="anonymous")?"no":"yes")."' WHERE id =".$custom);
                }
                // donation history bridge
                if ($settings["historie"]=="true")
                {
                    $donation = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}don_historie WHERE don_id ='$custom'");
                    $dh = $donation->fetch_assoc();

                    if(empty($dh["don_ation"]))
                        do_sqlquery('insert INTO '.$TABLE_PREFIX.'don_historie SET donate_date=NOW(),don_ation="'.$payment_amount.'" ,don_id='.$custom);
                    elseif(empty($dh["don_ation_1"]))
                        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_1="'.$payment_amount.'",donate_date_1=NOW() WHERE don_id='.$custom);
                    elseif(empty($dh["don_ation_2"]))
                        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_2="'.$payment_amount.'",donate_date_2=NOW() WHERE don_id='.$custom);
                    elseif(empty($dh["don_ation_3"]))
                        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_3="'.$payment_amount.'",donate_date_3=NOW() WHERE don_id='.$custom);
                    elseif(empty($dh["don_ation_4"]))
                        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_4="'.$payment_amount.'",donate_date_4=NOW() WHERE don_id='.$custom);
                    elseif(empty($dh["don_ation_5"]))
                        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_5="'.$payment_amount.'",donate_date_5=NOW() WHERE don_id='.$custom);
                    elseif(empty($dh["don_ation_6"]))
                        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_6="'.$payment_amount.'",donate_date_6=NOW() WHERE don_id='.$custom);
                    elseif(empty($dh["don_ation_7"]))
                        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_7="'.$payment_amount.'",donate_date_7=NOW() WHERE don_id='.$custom);
                    elseif(empty($dh["don_ation_8"]))
                        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_8="'.$payment_amount.'",donate_date_8=NOW() WHERE don_id='.$custom);
                    elseif(empty($dh["don_ation_9"]))
                        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_9="'.$payment_amount.'",donate_date_9=NOW() WHERE don_id='.$custom);
                    elseif(empty($dh["don_ation_10"]))
                        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_10="'.$payment_amount.'",donate_date_10=NOW() WHERE don_id='.$custom);
                }
                // don history end
            }
        }
    }
    fclose ($fp);
}
?>
