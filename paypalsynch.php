<?php
// Please encrypt me

require_once("include/functions.php");
dbconn();
global $BASEURL, $CURUSER, $language, $btit_settings, $TABLE_PREFIX;

if(!isset($CURUSER) || !is_array($CURUSER))
{
    session_name("Blu-torrents");
    session_start();
    $CURUSER=$_SESSION["CURUSER"];
}

$THIS_BASEPATH=dirname(__FILE__);

if($btit_settings["fmhack_SEO_panel"]=="enabled")
{
    $active_seo_pp = get_result("SELECT `activated_user`, `str`, `strto` FROM `{$TABLE_PREFIX}seo` WHERE `id`='1'", true, $btit_settings["cache_duration"]);
    $res_seo_pp=$active_seo_pp[0];
}

// get settings
$zap_pp = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}paypal_settings WHERE id ='1'",true);
$settings = $zap_pp->fetch_array();

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';

$tx_token = $_GET['tx'];
$auth_token = $settings["identity_token"];
$req .= "&tx=$tx_token&at=$auth_token";

if($settings["test"]=="true")
    $dttest='on';
else
    $dttest='off';

// post back to PayPal system to validate
$header .= "POST cgi-bin/webscr HTTP/1.1\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Host: www.paypal.com\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$header .= "Connection: close\r\n\r\n";


$ipnexec = curl_init();
curl_setopt($ipnexec, CURLOPT_URL, "https://www".($settings['test']=='true'?'.sandbox':'').".paypal.com/cgi-bin/webscr"); // test url
curl_setopt($ipnexec, CURLOPT_HEADER, $header);
curl_setopt($ipnexec, CURLOPT_USERAGENT, 'Server Software: '.@$_SERVER['SERVER_SOFTWARE'].' PHP Version: '.phpversion());
curl_setopt($ipnexec, CURLOPT_REFERER, $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].@$_SERVER['QUERY_STRING']);
curl_setopt($ipnexec, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ipnexec, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ipnexec, CURLOPT_POST, 1);
curl_setopt($ipnexec, CURLOPT_POSTFIELDS, $req);
curl_setopt($ipnexec, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ipnexec, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ipnexec, CURLOPT_TIMEOUT, 60);
$ipnresult = trim(curl_exec($ipnexec));
$ipnresult = "status=".$ipnresult;
curl_close($ipnexec);

$parameter_value_array = explode("\n", $ipnresult);
$value_array =array();
foreach ($parameter_value_array as $key=>$value) {
$key_values = explode("=", $value);
$keyarray[$key_values[0]] = $key_values[1];
}
if(array_key_exists("status", $keyarray) && $keyarray['status'] == 'SUCCESS') {


        // check the payment_status is Completed
        // check that txn_id has not been previously processed
        // check that receiver_email is your Primary PayPal email
        // check that payment_amount/payment_currency are correct
        // process payment

        $item_name = $keyarray['item_name'];
        (isset($keyarray["mc_gross"]) && is_numeric($keyarray["mc_gross"])) ? $payment_amount = 0+$keyarray['mc_gross'] : $payment_amount=0;
        (isset($keyarray["item_number"]) && is_numeric($keyarray["item_number"])) ? $item_number = $keyarray['item_number'] : $item_number=FALSE;
        $payment_currency = $keyarray['mc_currency'];
        $anonymous=$keyarray['custom'];
        $payer_email = sql_esc($keyarray['payer_email']);
        $first_name = $keyarray['first_name'];
        $last_name = sql_esc($keyarray['last_name']);
        $country = sql_esc($keyarray['address_country']);
        $payment_type = $keyarray['payment_type'];
        $addamt=round($amount);
        $score=(0 + $addamt);
        if($CURUSER["uid"]<=1)
        {
        send_pm(0,2,sqlesc("Donor Issue"),sqlesc("Donator issue the id came back as guest here is the returned information for you amount=>".$payment_amount."&nbsp;item=>".$item_number."&nbsp;email=>".$payer_email));
        redirect("index.php");
        exit();
        }
        // find username
        $zap_usr = do_sqlquery("SELECT `u`.`username`, `u`.`id_level`, `l`.`language_url`".(($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_donate"]=="enabled")?", `u`.`user_notes`":"")." FROM `{$TABLE_PREFIX}users` `u` INNER JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language`=`l`.`id` WHERE `u`.`id`=".$CURUSER["uid"]."");
        $wyn_usr = $zap_usr->fetch_array();

        $englang="language/english";
        require_once($THIS_BASEPATH."/".$englang."/lang_aads.php");
        require_once($THIS_BASEPATH."/".$englang."/lang_main.php");
        if($wyn_usr["language_url"]!=$englang)
            require_once($THIS_BASEPATH."/".$wyn_usr["language_url"]."/lang_main.php");
        if(!isset($language["SYSTEM_USER"]))
            $language["SYSTEM_USER"]="System";

        if ($item_number == 1 || $item_number == 2  || $item_number == 4 || $item_number == 5)
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

        $cid=$CURUSER["uid"];
        $pp="PayPal";
        // write to database
        $query = "INSERT INTO {$TABLE_PREFIX}donors (id, system, test, userid, first_name, last_name, payers_email, mc_gross, date, country, item)VALUES (NULL, '$pp', '$dttest', '$cid', '$first_name_site', '$last_name', '$payer_email', '$payment_amount', NOW() ,'$country' , '$item_number')";

        $ppt=($settings["received"]+ $payment_amount);
        quickQuery("UPDATE {$TABLE_PREFIX}paypal_settings SET received='$ppt' WHERE id='1'");

        // upload bonus
        if ($item_number == 2 )
        {
            $bonus_user = ($payment_amount * $bonus );
            // send pm here
            $mesg=$language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"].",\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM1_TEXT_3']." ".$pm_bonus." ".$language['AADS_PM1_TEXT_4']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
            send_pm(0,$cid,sqlesc($language['AADS_PM_SUBJ']),sqlesc($mesg));
            quickQuery("UPDATE `".(($XBTT_USE)?"xbt_":$TABLE_PREFIX)."users` SET `uploaded` = `uploaded` +".$bonus_user." WHERE `".(($XBTT_USE)?"u":"")."id` = '".$cid."' ");

            if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_donate"]=="enabled")
            {
                if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                    $usernotes=unserialize(unesc($wyn_usr["user_notes"]));
                else
                    $usernotes=array();

                $usernotes[]=base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_2"]." [b]".makesize($bonus_user)."[/b] ".$language["UN_DONATE_3"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                $new_notes=serialize($usernotes);
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$cid);
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
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET  `old_rank` = `id_level` WHERE `id`=".$CURUSER["uid"]);

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
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` `u` ".$queryjoin." SET ".$querymod." `u`.`timed_rank`='".$dt1."', `u`.`rank_switch`='".$dt2."', `u`.`id_level`='".$dt3."' WHERE `u`.`id`=".$CURUSER["uid"]);

                    //smf rank
                    global $FORUMLINK ;
                    if(substr($FORUMLINK,0,3)=="smf")
                    {
                        quickQuery("UPDATE `{$db_prefix}members` SET ".(($FORUMLINK=="smf")?"`ID_GROUP`":"`id_group`")." = ".$settings["smf"]." WHERE ".(($FORUMLINK=="smf")?"`ID_MEMBER`":"`id_member`")."=".$CURUSER["smf_fid"]);
                    }
                    elseif($FORUMLINK=="ipb")
                    {
                        quickQuery("UPDATE `{$ipb_prefix}members` SET `member_group_id`= ".$settings["smf"]." WHERE `member_id`=".$CURUSER["ipb_fid"]);
                    }

                    // send pm here
                    $mesg=$language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"]." ,\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM2_TEXT_1']." ".$vipdays." ".$language['AADS_PM2_TEXT_2']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                    send_pm(0,$CURUSER["uid"],sqlesc($language['AADS_PM_SUBJ']),sqlesc($mesg));

                    if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_donate"]=="enabled")
                    {
                        if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                            $usernotes=unserialize(unesc($wyn_usr["user_notes"]));
                        else
                            $usernotes=array();

                        $usernotes[]=base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_2"]." ".$language["UN_DONATE_4"]." [b]".$vipdays."[/b] ".$language["UN_DONATE_5"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                        $new_notes=serialize($usernotes);
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$cid);
                    }
                }
                elseif($item_number == 4)
                {
                    $petr1=do_sqlquery("SELECT `rank_switch`, `old_rank`, UNIX_TIMESTAMP(`timed_rank`) `timed_rank` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$CURUSER["uid"]);
                    $fied=$petr1->fetch_assoc();

                    if($fied["timed_rank"]>0)
                        $new_expire_time=date("Y-m-d H:i:s", ($fied["timed_rank"]+($vipdays*86400)));
                    else
                        $new_expire_time=date("Y-m-d H:i:s", (time()+($vipdays*86400)));

                    if($fied["rank_switch"]=="yes")
                    {
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `timed_rank`='".$new_expire_time."' WHERE `id`=".$CURUSER["uid"]);

                        // send pm here
                        $mesg=$language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"]." ,\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM2_TEXT_1']." ".$language['AADS_PM2_TEXT_1A']." ".$vipdays." ".$language['AADS_PM2_TEXT_2']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                        send_pm(0,$CURUSER["uid"],sqlesc($language['AADS_PM_SUBJ']),sqlesc($mesg));
                    }
                    if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_donate"]=="enabled")
                    {
                        if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                            $usernotes=unserialize(unesc($wyn_usr["user_notes"]));
                        else
                            $usernotes=array();

                        $usernotes[]=base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_2"]." ".$language["UN_DONATE_6"]." [b]".$vipdays."[/b] ".$language["UN_DONATE_5"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                        $new_notes=serialize($usernotes);
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$cid);
                    }
                }
            }
            else
            {
                $mesg=$language['AADS_PM1_TEXT_1']." ".$wyn_usr["username"]." ,\n\n ".$language['AADS_PM1_TEXT_2']." ".$payment_amount." (".$payment_currency.") ".$language['AADS_PM3_TEXT_1']." ".$SITENAME." ".$language['AADS_PM1_TEXT_5'];
                send_pm(0,$CURUSER["uid"],sqlesc($language['AADS_PM_SUBJ']),sqlesc($mesg));

                if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_donate"]=="enabled")
                {
                    if(isset($wyn_usr["user_notes"]) && !empty($wyn_usr["user_notes"]))
                        $usernotes=unserialize(unesc($wyn_usr["user_notes"]));
                    else
                        $usernotes=array();

                    $usernotes[]=base64_encode("[b]".$wyn_usr["username"]."[/b] ".$language["UN_DONATE_1"]." [b]".$payment_amount." (".$payment_currency.")[/b] ".$language["UN_DONATE_7"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                    $new_notes=serialize($usernotes);
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$cid);
                }
            }
        }
        //timed ranks end

        if($item_number == 5 && $btit_settings["fmhack_freeleech_slots"]=="enabled" && $settings["fl_slot"]=="true" && $settings["fl_slot_cost"]>0)
        {
            $numberOfSlots=floor($payment_amount/$settings["fl_slot_cost"]);
            if($numberOfSlots>=1)
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `freeleech_slots`=`freeleech_slots`+".$numberOfSlots." WHERE `id`=".$CURUSER["uid"]);
        }

        $result = do_sqlquery($query) or die ("Could not execute query : $query." . sql_error());

        // donation star bridge
        if ($settings["don_star"]=="true")
        {
            quickQuery("UPDATE {$TABLE_PREFIX}users SET donor = '".(($first_name_site=="anonymous")?"no":"yes")."' WHERE id =".$CURUSER["uid"]);
        }
        // donation historie bridge
        if ($settings["historie"]=="true")
        {
            $donation = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}don_historie WHERE don_id =".$CURUSER["uid"]);
            $dh = $donation->fetch_assoc();

            if(empty($dh["don_ation"]))
                do_sqlquery('insert '.$TABLE_PREFIX.'don_historie SET donate_date=NOW(),don_ation="'.$payment_amount.'" ,don_id='.$CURUSER["uid"]);
            else if(empty($dh["don_ation_1"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_1="'.$payment_amount.'",donate_date_1=NOW() WHERE don_id='.$CURUSER["uid"]);
            else if(empty($dh["don_ation_2"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_2="'.$payment_amount.'",donate_date_2=NOW() WHERE don_id='.$CURUSER["uid"]);
            else if(empty($dh["don_ation_3"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_3="'.$payment_amount.'",donate_date_3=NOW() WHERE don_id='.$CURUSER["uid"]);
            else if(empty($dh["don_ation_4"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_4="'.$payment_amount.'",donate_date_4=NOW() WHERE don_id='.$CURUSER["uid"]);
            else if(empty($dh["don_ation_5"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_5="'.$payment_amount.'",donate_date_5=NOW() WHERE don_id='.$CURUSER["uid"]);
            else if(empty($dh["don_ation_6"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_6="'.$payment_amount.'",donate_date_6=NOW() WHERE don_id='.$CURUSER["uid"]);
            else if(empty($dh["don_ation_7"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_7="'.$payment_amount.'",donate_date_7=NOW() WHERE don_id='.$CURUSER["uid"]);
            else if(empty($dh["don_ation_8"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_8="'.$payment_amount.'",donate_date_8=NOW() WHERE don_id='.$CURUSER["uid"]);
            else if(empty($dh["don_ation_9"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_9="'.$payment_amount.'",donate_date_9=NOW() WHERE don_id='.$CURUSER["uid"]);
            else if(empty($dh["don_ation_10"]))
                do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_10="'.$payment_amount.'",donate_date_10=NOW() WHERE don_id='.$CURUSER["uid"]);
        }
        // don historie end

        redirect("index.php?page=complete&fname=$first_name&lname=$last_name&item=$item_name&amt=$payment_amount&curr=$payment_currency");
    }
    else if ($keyarray['status']=="FAIL")
    {

        $msg = 'Non verified paypal access: Username: <a href="'.$BASEURL.'/'.(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo_pp["activated_user"]=="true")?$CURUSER["uid"]."_".strtr($CURUSER["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$CURUSER["uid"]).'">'.unesc($CURUSER["prefixcolor"] . $CURUSER["username"] . $CURUSER["suffixcolor"]).'</a> - UserID: ' . $CURUSER["uid"] . ' - UserIP : ' . getip ();
        write_log ($msg,"delete");
        if (!$language['ERROR'])
            $language['ERROR']='Error';
        ext_err_msg(sprintf($language["ERROR"]),$msg);
    }
?>
