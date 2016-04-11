<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
//    Advanced Auto Donation System [AlertPay Version] by DiemThuy ( jan 2011 )
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

$apmail= $settings['alertpay_email'];
$apcode= $settings['alertpay_code'];
 
define("IPN_SECURITY_CODE", $apcode);
define("MY_MERCHANT_EMAIL", $apmail);

//Setting information about the transaction
$receivedSecurityCode = urldecode($_POST['ap_securitycode']);
$receivedMerchantEmailAddress = urldecode($_POST['ap_merchant']);    
$transactionStatus = urldecode($_POST['ap_status']);
$testModeStatus = urldecode($_POST['ap_test']);     
$purchaseType = urldecode($_POST['ap_purchasetype']);
$totalAmountReceived = urldecode($_POST['ap_totalamount']);
$feeAmount = urldecode($_POST['ap_feeamount']);
$netAmount = urldecode($_POST['ap_netamount']);
$transactionReferenceNumber = urldecode($_POST['ap_referencenumber']);
$currency = urldecode($_POST['ap_currency']);     
$transactionDate= urldecode($_POST['ap_transactiondate']);
$transactionType= urldecode($_POST['ap_transactiontype']);
    
//Setting the customer's information from the IPN post variables
$customerFirstName = urldecode($_POST['ap_custfirstname']);
$customerLastName = urldecode($_POST['ap_custlastname']);
$customerAddress = urldecode($_POST['ap_custaddress']);
$customerCity = urldecode($_POST['ap_custcity']);
$customerState = urldecode($_POST['ap_custstate']);
$customerCountry = urldecode($_POST['ap_custcountry']);
$customerZipCode = urldecode($_POST['ap_custzip']);
$customerEmailAddress = urldecode($_POST['ap_custemailaddress']);
    
//Setting information about the purchased item from the IPN post variables
$myItemName = urldecode($_POST['ap_itemname']);
$myItemCode = urldecode($_POST['ap_itemcode']);
$myItemDescription = urldecode($_POST['ap_description']);
$myItemQuantity = urldecode($_POST['ap_quantity']);
$myItemAmount = urldecode($_POST['ap_amount']);
    
//Setting extra information about the purchased item from the IPN post variables
$additionalCharges = urldecode($_POST['ap_additionalcharges']);
$shippingCharges = urldecode($_POST['ap_shippingcharges']);
$taxAmount = urldecode($_POST['ap_taxamount']);
$discountAmount = urldecode($_POST['ap_discountamount']);
     
//Setting your customs fields received from the IPN post variables
$myCustomField_1 = urldecode($_POST['apc_1']);
$myCustomField_2 = urldecode($_POST['apc_2']);
$myCustomField_3 = urldecode($_POST['apc_3']);
$myCustomField_4 = urldecode($_POST['apc_4']);
$myCustomField_5 = urldecode($_POST['apc_5']);
$myCustomField_6 = urldecode($_POST['apc_6']);

if ($receivedMerchantEmailAddress != MY_MERCHANT_EMAIL)
{
    // The data was not meant for the business profile under this email address.
    // Take appropriate action 
    $test="email wrong ".MY_MERCHANT_EMAIL." check in your acp !!";
    send_pm(0,2,sqlesc('test'),sqlesc($test));
}
else
{    
    //Check if the security code matches
    if ($receivedSecurityCode != IPN_SECURITY_CODE)
    {
        // The data is NOT sent by AlertPay.
        // Take appropriate action.
        $test="pin wrong ".IPN_SECURITY_CODE." pay attention there is not a space before the code in your acp !!";
        send_pm(0,2,sqlesc('test'),sqlesc($test));
    }
    else
    {
        if ($transactionStatus == "Success")
        {
            if ($testModeStatus == "1")
            {
                $dttest='on';
            }
            else
            {
                $dttest='off';
            }
            // This REAL transaction is complete and the amount was paid successfully.
            // find username
            $zap_usr = do_sqlquery("SELECT `u`.`username`, `u`.`id_level`, `l`.`language_url`".(($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_donate"]=="enabled")?", `u`.`user_notes`":"")." FROM `{$TABLE_PREFIX}users` `u` INNER JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language`=`l`.`id` WHERE `u`.`id`=$myCustomField_1");
            $wyn_usr = $zap_usr->fetch_array();

            $englang="language/english";
            require_once($THIS_BASEPATH."/".$englang."/lang_main.php");
            if($wyn_usr["language_url"]!=$englang)
                require_once($THIS_BASEPATH."/".$wyn_usr["language_url"]."/lang_main.php");
            if(!isset($language["SYSTEM_USER"]))
                $language["SYSTEM_USER"]="System";

            if ($myCustomField_2 == 1 || $myCustomField_2 == 2 || $myCustomField_2 == 4 || $myCustomField_2 == 5)
                $first_name_site = $wyn_usr["username"];
            else
                $first_name_site="anonymous";

            if ($totalAmountReceived  <= $settings["today"])
                $vipdays = floor($totalAmountReceived  * $settings["vip_days"]);
            elseif ($totalAmountReceived  > $settings["today"] AND $totalAmountReceived  <= $settings["todayb"])
                $vipdays = floor($totalAmountReceived  * $settings["vip_daysb"]);
            else
                $vipdays = floor($totalAmountReceived  * $settings["vip_daysc"]);

            if ($totalAmountReceived  <= $settings["togb"])
            {
                $bonus =(1073741824*$settings["gb"]);
                $pm_bonus =( $totalAmountReceived  * $settings["gb"] );
            }
            elseif ($totalAmountReceived  > $settings["togb"] AND $totalAmountReceived  <= $settings["togbb"])
            {
                $bonus =(1073741824*$settings["gbb"]);
                $pm_bonus =( $totalAmountReceived  * $settings["gbb"] );
            }
            else
            {
                $bonus =(1073741824*$settings["gbc"]);
                $pm_bonus =( $totalAmountReceived  * $settings["gbc"] );
            }
            $pz='Payza';

            // write to database
            $query = "INSERT INTO {$TABLE_PREFIX}donors (id, system, test,userid, first_name, last_name, payers_email, mc_gross, date, country, item)VALUES ('','$pz','$dttest', '$myCustomField_1', '$first_name_site', '$customerLastName', '$customerEmailAddress', '$totalAmountReceived', NOW() ,'$customerCountry' , '$myCustomField_2')";
            do_sqlquery($query);
            $ppt=($settings["received"]+ $totalAmountReceived);
            if ($myCustomField_2>=1 && $myCustomField_2<=5)
            {
                quickQuery("UPDATE {$TABLE_PREFIX}paypal_settings SET received='$ppt' WHERE id='1'");
            }
            // upload bonus
            if ($myCustomField_2 == 2 )
            {
                $bonus_user = ($payment_amount * $bonus );
                // send pm here
                $mesg=$language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"].",\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM1_TEXT_3_AL']." ".$pm_bonus." ".$language['AADS_PM1_TEXT_4']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                send_pm(0,$myCustomField_1,sqlesc($language['AADS_PM_SUBJ']),sqlesc($mesg));
                quickQuery("UPDATE `".(($XBTT_USE)?"xbt_":$TABLE_PREFIX)."users` SET `uploaded` = `uploaded` +".$bonus_user." WHERE `".(($XBTT_USE)?"u":"")."id` = '".$myCustomField_1."' ");

                if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_donate"]=="enabled")
                {
                    if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                        $usernotes=unserialize(unesc($wyn_usr["user_notes"]));
                    else
                        $usernotes=array();

                    $usernotes[]=base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_2"]." [b]".makesize($bonus_user)."[/b] ".$language["UN_DONATE_3"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time()); 
                    $new_notes=serialize($usernotes); 
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$myCustomField_1);
                }
            }
            //timed ranks start
            if ($myCustomField_2 == 0 || $myCustomField_2 == 1 || $myCustomField_2 == 4)
            {
                // staff demote protection
                $staff = $wyn_usr["id_level"];
                $zap_usr_st = do_sqlquery("SELECT id_level FROM {$TABLE_PREFIX}users_level WHERE id =$staff");
                $wyn_usr_st = $zap_usr_st->fetch_array();

                if  ($wyn_usr_st["id_level"] <=6 && ($myCustomField_2 == 1 || $myCustomField_2 == 4))
                {
                    if($myCustomField_2 == 1)
                    {
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET  `old_rank` = `id_level` WHERE `id`=".$myCustomField_1);

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
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` `u` ".$queryjoin." SET ".$querymod." `u`.`timed_rank`='".$dt1."', `u`.`rank_switch`='".$dt2."', `u`.`id_level`='".$dt3."' WHERE `u`.`id`=".$myCustomField_1);
                        
                        //smf rank
                        global $FORUMLINK ;
                        if(substr($FORUMLINK,0,3)=="smf")
                        {
                            $smf=do_sqlquery("SELECT `smf_fid` FROM `{$TABLE_PREFIX}users` WHERE `id` =".$myCustomField_1);
                            $smf_user = $smf->fetch_array();
                            quickQuery("UPDATE `{$db_prefix}members` SET ".(($FORUMLINK=="smf")?"`ID_GROUP`":"`id_group`")." = ".$settings["smf"]." WHERE ".(($FORUMLINK=="smf")?"`ID_MEMBER`":"`id_member`")."=".$smf_user["smf_fid"]);
                        }
                        elseif($FORUMLINK=="ipb")
                        {
                            $ipb=do_sqlquery("SELECT `ipb_fid` FROM `{$TABLE_PREFIX}users` WHERE `id` =".$myCustomField_1);
                            $ipb_user = $ipb->fetch_array();
                            quickQuery("UPDATE `{$ipb_prefix}members` SET `member_group_id`= ".$settings["smf"]." WHERE `member_id`=".$ipb_user["ipb_fid"]);
                        }

                        // send pm here
                        $mesg=$language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"]." ,\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM2_TEXT_1_AL']." ".$vipdays." ".$language['AADS_PM2_TEXT_2']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                        send_pm(0,$myCustomField_1,sqlesc($language['AADS_PM_SUBJ']),sqlesc($mesg));

                        if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_donate"]=="enabled")
                        {
                            if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                                $usernotes=unserialize(unesc($wyn_usr["user_notes"]));
                            else
                                $usernotes=array();

                            $usernotes[]=base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_2"]." ".$language["UN_DONATE_4"]." [b]".$vipdays."[/b] ".$language["UN_DONATE_5"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time()); 
                            $new_notes=serialize($usernotes); 
                            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$myCustomField_1);
                        }
                    }
                    elseif($myCustomField_2 == 4)
                    {
                        $petr1=do_sqlquery("SELECT `rank_switch`, `old_rank`, UNIX_TIMESTAMP(`timed_rank`) `timed_rank` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$myCustomField_1);
                        $fied=$petr1->fetch_assoc();
                            
                        if($fied["timed_rank"]>0)
                            $new_expire_time=date("Y-m-d H:i:s", ($fied["timed_rank"]+($vipdays*86400)));
                        else
                            $new_expire_time=date("Y-m-d H:i:s", (time()+($vipdays*86400)));
                            
                        if($fied["rank_switch"]=="yes")
                        {
                            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `timed_rank`='".$new_expire_time."' WHERE `id`=".$myCustomField_1);

                            // send pm here
                            $mesg=$language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"]." ,\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM2_TEXT_1_AL']." ".$language['AADS_PM2_TEXT_1A']." ".$vipdays." ".$language['AADS_PM2_TEXT_2']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                            send_pm(0,$myCustomField_1,sqlesc($language['AADS_PM_SUBJ']),sqlesc($mesg));

                            if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_donate"]=="enabled")
                            {
                                if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                                    $usernotes=unserialize(unesc($wyn_usr["user_notes"]));
                                else
                                    $usernotes=array();

                                $usernotes[]=base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_2"]." ".$language["UN_DONATE_6"]." [b]".$vipdays."[/b] ".$language["UN_DONATE_5"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time()); 
                                $new_notes=serialize($usernotes); 
                                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$myCustomField_1);
                            }
                        }     
                    }
                }
                else
                {
                    $mesg=$language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"]." ,\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM3_TEXT_1_AL']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                    send_pm(0,$myCustomField_1,sqlesc($language['AADS_PM_SUBJ']),sqlesc($mesg));

                    if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_donate"]=="enabled")
                    {
                        if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                            $usernotes=unserialize(unesc($wyn_usr["user_notes"]));
                        else
                            $usernotes=array();

                        $usernotes[]=base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_7"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time()); 
                        $new_notes=serialize($usernotes); 
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$myCustomField_1);
                    }
                }
            }
            //timed ranks end
            if($myCustomField_2 == 5 && $btit_settings["fmhack_freeleech_slots"] == "enabled" && $settings["fl_slot"] == "true" && $settings["fl_slot_cost"] > 0)
            {
                $numberOfSlots = floor($payment_amount / $settings["fl_slot_cost"]);
                if($numberOfSlots >= 1)
                {
                    $mesg = $language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"]." ,\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM4_TEXT_1']." PayPal ".$language['AADS_PM4_TEXT_2']." [b]".$numberOfSlots."[/b] ".$language['AADS_PM4_TEXT_3']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                    send_pm(0, $myCustomField_1, sqlesc($language['AADS_PM_SUBJ']), sqlesc($mesg));

                    if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_donate"] == "enabled")
                    {
                        if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                            $usernotes = unserialize(unesc($wyn_usr["user_notes"]));
                        else
                            $usernotes = array();

                        $usernotes[] = base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_2"]." [b]".$numberOfSlots."[/b] ".$language["UN_DONATE_8"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                        $new_notes = serialize($usernotes);
                    }
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `freeleech_slots`=`freeleech_slots`+".$numberOfSlots.(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_donate"] == "enabled")?" `user_notes`='".sql_esc($new_notes)."'":"")." WHERE `id`=".$myCustomField_1);
                }
            }
            // donation star bridge
            if ($settings["don_star"]=="true")
            {
                quickQuery("UPDATE {$TABLE_PREFIX}users SET donor = '".(($first_name_site=="anonymous")?"no":"yes")."' WHERE id =".$myCustomField_1);
            }
            // donation historie bridge
            if ($settings["historie"]=="true")
            {
                $donation = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}don_historie WHERE don_id ='$myCustomField_1'");
                $dh = $donation->fetch_assoc();

                if(empty($dh["don_ation"]))
                    do_sqlquery('insert '.$TABLE_PREFIX.'don_historie SET donate_date=NOW(),don_ation="'.$totalAmountReceived.'" ,don_id='.$myCustomField_1);
                elseif(empty($dh["don_ation_1"]))
                    do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_1="'.$totalAmountReceived.'",donate_date_1=NOW() WHERE don_id='.$myCustomField_1);
                elseif(empty($dh["don_ation_2"]))
                    do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_2="'.$totalAmountReceived.'",donate_date_2=NOW() WHERE don_id='.$myCustomField_1);
                else if(empty($dh["don_ation_3"]))
                    do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_3="'.$totalAmountReceived.'",donate_date_3=NOW() WHERE don_id='.$myCustomField_1);
                else if(empty($dh["don_ation_4"]))
                    do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_4="'.$totalAmountReceived.'",donate_date_4=NOW() WHERE don_id='.$myCustomField_1);
                else if(empty($dh["don_ation_5"]))
                    do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_5="'.$totalAmountReceived.'",donate_date_5=NOW() WHERE don_id='.$myCustomField_1);
                else if(empty($dh["don_ation_6"]))
                    do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_6="'.$totalAmountReceived.'",donate_date_6=NOW() WHERE don_id='.$myCustomField_1);
                else if(empty($dh["don_ation_7"]))
                    do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_7="'.$totalAmountReceived.'",donate_date_7=NOW() WHERE don_id='.$myCustomField_1);
                else if(empty($dh["don_ation_8"]))
                    do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_8="'.$totalAmountReceived.'",donate_date_8=NOW() WHERE don_id='.$myCustomField_1);
                else if(empty($dh["don_ation_9"]))
                    do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_9="'.$totalAmountReceived.'",donate_date_9=NOW() WHERE don_id='.$myCustomField_1);
                else if(empty($dh["don_ation_10"]))
                    do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_10="'.$totalAmountReceived.'",donate_date_10=NOW() WHERE don_id='.$myCustomField_1);
            }
            // end real transaction
        }
        else
        {
            // Transaction was cancelled or an incorrect status was returned.
            // Take appropriate action.
            send_pm(0,2,sqlesc('test'),sqlesc('Transaction was cancelled or an incorrect status was returned'));
        }
    }
}

?>