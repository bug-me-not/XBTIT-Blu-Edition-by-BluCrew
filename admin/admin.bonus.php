<?php

if (!defined("IN_BTIT")) {
    die("non direct access!");
}

if (!defined("IN_ACP")) {
    die("non direct access!");
}



if (!$CURUSER || $CURUSER["admin_access"]!="yes") {
    err_msg($language["ERROR"], $language["NOT_ADMIN_CP_ACCESS"]);
    stdfoot();
    exit;
} else {
    $i=0;
    $r=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}bonus");
    while ($row = $r->fetch_array()) {
        $traffic=number_format($row["traffic"]/1073741824, 0);
        $traf[$i]["traffic"]=$traffic;
        $traf[$i]["points"]=$row["points"];
        $traf[$i]["name"]=$row["name"];
        $i++;
    }
    $admintpl->set("language", $language);
    $admintpl->set("price_vip", $btit_settings["price_vip"]);
    $admintpl->set("price_ct", $btit_settings["price_ct"]);
    $admintpl->set("price_name", $btit_settings["price_name"]);
    $admintpl->set("bonus", $btit_settings["bonus"]);
    $admintpl->set("traf", $traf);
    $admintpl->set("random", $CURUSER["random"]);
    $admintpl->set("uid", $CURUSER["uid"]);
    $admintpl->set("firstview", (($_POST["action"]=="Update")?false:true), true);
    $admintpl->set("gb_enable", (($btit_settings["gb_enable"]=="true")?true:false), true);
    $admintpl->set("vip_enable", (($btit_settings["vip_enable"]=="true")?true:false), true);
    $admintpl->set("ct_enable", (($btit_settings["ct_enable"]=="true")?true:false), true);
    $admintpl->set("uname_enable", (($btit_settings["uname_enable"]=="true")?true:false), true);
    $admintpl->set("show_inv", (($btit_settings["fmhack_invitation_system"]=="enabled")?true:false), true);
    $admintpl->set("inv_enable", (($btit_settings["inv_enable"]=="true" && $btit_settings["fmhack_invitation_system"]=="enabled")?true:false), true);
    $admintpl->set("price_inv", $btit_settings["price_inv"]);
    $admintpl->set("price_inv3", $btit_settings["price_inv3"]);
    $admintpl->set("price_inv5", $btit_settings["price_inv5"]);
    $admintpl->set("all", (($GLOBALS["bonus_type"]=="all")?true:false), true);
    $admintpl->set("one", (($GLOBALS["bonus_type"]=="one")?true:false), true);
    $admintpl->set("upl_enable", (($btit_settings["upl_enable"]=="true")?true:false), true);
    $admintpl->set("bonus_upl", $btit_settings["bonus_upl"]);
    $admintpl->set("bonus_upl_delay", $btit_settings["bonus_upl_delay"]);
    $admintpl->set("comm_enable", (($btit_settings["comm_enable"]=="true")?true:false), true);
    $admintpl->set("bonus_comm", $btit_settings["bonus_comm"]);
    $admintpl->set("timed_ranks_enabled_1", (($btit_settings["fmhack_timed_ranks"]=="enabled")?true:false), true);
    $admintpl->set("timed_ranks_enabled_2", (($btit_settings["fmhack_timed_ranks"]=="enabled")?true:false), true);
    $admintpl->set("vip_timeframe", $btit_settings["vip_timeframe"]);
    $admintpl->set("opt1", (($btit_settings["vip_timeframe"]==0)?true:false), true);
    $admintpl->set("opt2", (($btit_settings["vip_timeframe"]==7)?true:false), true);
    $admintpl->set("opt3", (($btit_settings["vip_timeframe"]==14)?true:false), true);
    $admintpl->set("opt4", (($btit_settings["vip_timeframe"]==21)?true:false), true);
    $admintpl->set("opt5", (($btit_settings["vip_timeframe"]==30)?true:false), true);
    $admintpl->set("opt6", (($btit_settings["vip_timeframe"]==61)?true:false), true);
    $admintpl->set("opt7", (($btit_settings["vip_timeframe"]==91)?true:false), true);
    $admintpl->set("opt8", (($btit_settings["vip_timeframe"]==182)?true:false), true);
    $admintpl->set("opt9", (($btit_settings["vip_timeframe"]==365)?true:false), true);
    $admintpl->set("forpost_enable", (($btit_settings["forpost_enable"]=="true")?true:false), true);
    $admintpl->set("bonus_forpost", $btit_settings["bonus_forpost"]);
    $admintpl->set("sb_speed_enable", (($btit_settings["sb_speed_enable"]=="true")?true:false), true);
    $admintpl->set("bonus_min_uprate", $btit_settings["bonus_min_uprate"]);
    $admintpl->set("sb_max_ph_enable", (($btit_settings["sb_max_ph_enable"]=="true")?true:false), true);
    $admintpl->set("bonus_max_per_hour", $btit_settings["bonus_max_per_hour"]);
    $admintpl->set("sb_shout_enable", (($btit_settings["sb_shout_enable"]=="true")?true:false), true);
    $admintpl->set("bonus_make_a_shout", $btit_settings["bonus_make_a_shout"]);
    $admintpl->set("radio_enabled", (($btit_settings["fmhack_shoutcast_stats_and_DJ_application"]=="enabled")?true:false), true);
    $admintpl->set("sb_radio_enable", (($btit_settings["sb_radio_enable"]=="true")?true:false), true);
    $admintpl->set("bonus_listen2radio", $btit_settings["bonus_listen2radio"]);
    $admintpl->set("sb_gift_enable", (($btit_settings["sb_gift_enable"]=="true")?true:false), true);
    $admintpl->set("bonus_giftmax", $btit_settings["bonus_giftmax"]);
    $admintpl->set("show_hnr", (($btit_settings["fmhack_warning_system"]=="enabled" && $btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")?true:false), true);
    $admintpl->set("hnr_enable", (($btit_settings["hnr_enable"]=="true" && $btit_settings["fmhack_warning_system"]=="enabled" && $btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")?true:false), true);
    $admintpl->set("price_hnr", $btit_settings["price_hnr"]);
    $admintpl->set("archive_enable", (($btit_settings["archive_enable"]=="true" && $btit_settings["fmhack_archive_torrents"]=="enabled")?true:false), true);
    $admintpl->set("arc_enabled", (($btit_settings["fmhack_archive_torrents"]=="enabled")?true:false), true);
    $admintpl->set("bonus_archive", $btit_settings["bonus_archive"]);
    $admintpl->set("flshot_enable", (($btit_settings["flshot_enable"]=="true" && $btit_settings["fmhack_freeleech_slots"]=="enabled")?true:false), true);
    $admintpl->set("show_fls", (($btit_settings["fmhack_freeleech_slots"]=="enabled")?true:false), true);
    $admintpl->set("bonus_flslot", $btit_settings["bonus_flslot"]);

    if ($_POST["action"]==$language["UPDATE"]) {
        // Award Points
        (isset($_POST["sb_type"]) && $_POST["sb_type"]=="all")?$sb_type="all":$sb_type="one";
        // Points awarded per hour
        (isset($_POST["bonus"]) && !empty($_POST["bonus"]) && is_numeric($_POST["bonus"]))?$bonus=0+$_POST["bonus"]:$bonus=0;
        // Maximum Points per hour
        (isset($_POST["sb_max_ph_enable"]) && $_POST["sb_max_ph_enable"]=="on") ?$sb_max_ph_enable="true":$sb_max_ph_enable="false";
        (isset($_POST["bonus_max_per_hour"]) && !empty($_POST["bonus_max_per_hour"]) && is_numeric($_POST["bonus_max_per_hour"]))?$bonus_max_per_hour=0+$_POST["bonus_max_per_hour"]:$bonus_max_per_hour=0;
        // if actually uploaded
        (isset($_POST["sb_speed_enable"]) && $_POST["sb_speed_enable"]=="on") ?$sb_speed_enable="true":$sb_speed_enable="false";
        (isset($_POST["bonus_min_uprate"]) && !empty($_POST["bonus_min_uprate"]) && is_numeric($_POST["bonus_min_uprate"]))?$bonus_min_uprate=0+$_POST["bonus_min_uprate"]:$bonus_min_uprate=0;
        // gift to other members
        (isset($_POST["sb_gift_enable"]) && $_POST["sb_gift_enable"]=="on") ?$sb_gift_enable="true":$sb_gift_enable="false";
        (isset($_POST["bonus_giftmax"]) && !empty($_POST["bonus_giftmax"]) && is_numeric($_POST["bonus_giftmax"]))?$bonus_giftmax=0+$_POST["bonus_giftmax"]:$bonus_giftmax=0;
        // awarded per shout
        (isset($_POST["sb_shout_enable"]) && $_POST["sb_shout_enable"]=="on") ?$sb_shout_enable="true":$sb_shout_enable="false";
        (isset($_POST["bonus_make_a_shout"]) && !empty($_POST["bonus_make_a_shout"]) && is_numeric($_POST["bonus_make_a_shout"]))?$bonus_make_a_shout=0+$_POST["bonus_make_a_shout"]:$bonus_make_a_shout=0;
        // uploading a new torrent
        (isset($_POST["upl_enable"]) && $_POST["upl_enable"]=="on") ?$upl_enable="true":$upl_enable="false";
        (isset($_POST["bonus_upl"]) && !empty($_POST["bonus_upl"]) && is_numeric($_POST["bonus_upl"]))?$bonus_upl=0+$_POST["bonus_upl"]:$bonus_upl=0;
        (isset($_POST["bonus_upl_delay"]) && !empty($_POST["bonus_upl_delay"]) && is_numeric($_POST["bonus_upl_delay"]))?$bonus_upl_delay=0+$_POST["bonus_upl_delay"]:$bonus_upl_delay=0;
        // comment on a torrent
        (isset($_POST["comm_enable"]) && $_POST["comm_enable"]=="on") ?$comm_enable="true":$comm_enable="false";
        (isset($_POST["bonus_comm"]) && !empty($_POST["bonus_comm"]) && is_numeric($_POST["bonus_comm"]))?$bonus_comm=0+$_POST["bonus_comm"]:$bonus_comm=0;
        // forum post
        (isset($_POST["forpost_enable"]) && $_POST["forpost_enable"]=="on") ?$forpost_enable="true":$forpost_enable="false";
        (isset($_POST["bonus_forpost"]) && !empty($_POST["bonus_forpost"]) && is_numeric($_POST["bonus_forpost"]))?$bonus_forpost=0+$_POST["bonus_forpost"]:$bonus_forpost=0;
        // price per gb
        (isset($_POST["gb_enable"]) && $_POST["gb_enable"]=="on") ?$gb_enable="true":$gb_enable="false";
        (isset($_POST["gb1"]) && !empty($_POST["gb1"]) && is_numeric($_POST["gb1"]))?$gb1=0+$_POST["gb1"]:$gb1=0;
        (isset($_POST["pts1"]) && !empty($_POST["pts1"]) && is_numeric($_POST["pts1"]))?$pts1=0+$_POST["pts1"]:$pts1=0;
        (isset($_POST["gb2"]) && !empty($_POST["gb2"]) && is_numeric($_POST["gb2"]))?$gb2=0+$_POST["gb2"]:$gb2=0;
        (isset($_POST["pts2"]) && !empty($_POST["pts2"]) && is_numeric($_POST["pts2"]))?$pts2=0+$_POST["pts2"]:$pts2=0;
        (isset($_POST["gb3"]) && !empty($_POST["gb3"]) && is_numeric($_POST["gb3"]))?$gb3=0+$_POST["gb3"]:$gb3=0;
        (isset($_POST["pts3"]) && !empty($_POST["pts3"]) && is_numeric($_POST["pts3"]))?$pts3=0+$_POST["pts3"]:$pts3=0;
        // vip rank
        (isset($_POST["vip_enable"]) && $_POST["vip_enable"]=="on") ?$vip_enable="true":$vip_enable="false";
        (isset($_POST["price_vip"]) && !empty($_POST["price_vip"]) && is_numeric($_POST["price_vip"]))?$price_vip=0+$_POST["price_vip"]:$price_vip=0;
        (isset($_POST["vip_timeframe"]) && !empty($_POST["vip_timeframe"]) && is_numeric($_POST["vip_timeframe"]))?$vip_timeframe=0+$_POST["vip_timeframe"]:$vip_timeframe=0;
        // custom rank
        (isset($_POST["ct_enable"]) && $_POST["ct_enable"]=="on") ?$ct_enable="true":$ct_enable="false";
        (isset($_POST["price_ct"]) && !empty($_POST["price_ct"]) && is_numeric($_POST["price_ct"]))?$price_ct=0+$_POST["price_ct"]:$price_ct=0;
        // username change
        (isset($_POST["uname_enable"]) && $_POST["uname_enable"]=="on") ?$uname_enable="true":$uname_enable="false";
        (isset($_POST["price_name"]) && !empty($_POST["price_name"]) && is_numeric($_POST["price_name"]))?$price_name=0+$_POST["price_name"]:$price_name=0;
        // hnr enable
        (isset($_POST["hnr_enable"]) && $_POST["hnr_enable"]=="on") ?$hnr_enable="true":$hnr_enable="false";
        (isset($_POST["price_hnr"]) && !empty($_POST["price_hnr"]) && is_numeric($_POST["price_hnr"]))?$price_hnr=0+$_POST["price_hnr"]:$price_hnr=0;
        // price for freeleech
        (isset($_POST["flshot_enable"]) && $_POST["flshot_enable"]=="on") ?$flshot_enable="true":$flshot_enable="false";
        (isset($_POST["bonus_flslot"]) && !empty($_POST["bonus_flslot"]) && is_numeric($_POST["bonus_flslot"]))?$bonus_flslot=0+$_POST["bonus_flslot"]:$bonus_flslot=0;

        // extras
        (isset($_POST["archive_enable"]) && $_POST["archive_enable"]=="on") ?$archive_enable="true":$archive_enable="false";
        (isset($_POST["bonus_archive"]) && !empty($_POST["bonus_archive"]) && is_numeric($_POST["bonus_archive"]))?$bonus_archive=0+$_POST["bonus_archive"]:$bonus_archive=0;
        (isset($_POST["inv_enable"]) && $_POST["inv_enable"]=="on" && $btit_settings["fmhack_invitation_system"]=="enabled") ?$inv_enable="true":$inv_enable="false";
        (isset($_POST["inv1"]) && !empty($_POST["inv1"]) && is_numeric($_POST["inv1"]))?$price_inv=0+$_POST["inv1"]:$price_inv=0;
        (isset($_POST["inv3"]) && !empty($_POST["inv3"]) && is_numeric($_POST["inv3"]))?$price_inv3=0+$_POST["inv3"]:$price_inv3=0;
        (isset($_POST["inv5"]) && !empty($_POST["inv5"]) && is_numeric($_POST["inv5"]))?$price_inv5=0+$_POST["inv5"]:$price_inv5=0;
        //Needs to be removed
        (isset($_POST["sb_radio_enable"]) && $_POST["sb_radio_enable"]=="on") ?$sb_radio_enable="true":$sb_radio_enable="false";
        (isset($_POST["bonus_listen2radio"]) && !empty($_POST["bonus_listen2radio"]) && is_numeric($_POST["bonus_listen2radio"]))?$bonus_listen2radio=0+$_POST["bonus_listen2radio"]:$bonus_listen2radio=0;

        $gbinbytes1=$gb1*1024*1024*1024;
        $gbinbytes2=$gb2*1024*1024*1024;
        $gbinbytes3=$gb3*1024*1024*1024;

        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$gb_enable' WHERE `key`='gb_enable'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$vip_enable' WHERE `key`='vip_enable'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$ct_enable' WHERE `key`='ct_enable'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$uname_enable' WHERE `key`='uname_enable'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$inv_enable' WHERE `key`='inv_enable'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$price_vip' WHERE `key`='price_vip'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$price_ct' WHERE `key`='price_ct'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$price_name' WHERE `key`='price_name'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$bonus' WHERE `key`='bonus'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$bonus_archive' WHERE `key`='bonus_archive'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$archive_enable' WHERE `key`='archive_enable'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$bonus_flslot' WHERE `key`='bonus_flslot'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$flshot_enable' WHERE `key`='flshot_enable'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$price_inv' WHERE `key`='price_inv'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$price_inv3' WHERE `key`='price_inv3'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$price_inv5' WHERE `key`='price_inv5'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$sb_type' WHERE `key`='bonus_type'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$upl_enable' WHERE `key`='upl_enable'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$bonus_upl' WHERE `key`='bonus_upl'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$bonus_upl_delay' WHERE `key`='bonus_upl_delay'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$comm_enable' WHERE `key`='comm_enable'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$bonus_comm' WHERE `key`='bonus_comm'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$vip_timeframe' WHERE `key`='vip_timeframe'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$forpost_enable' WHERE `key`='forpost_enable'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$bonus_forpost' WHERE `key`='bonus_forpost'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$sb_speed_enable' WHERE `key`='sb_speed_enable'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$bonus_min_uprate' WHERE `key`='bonus_min_uprate'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$sb_max_ph_enable' WHERE `key`='sb_max_ph_enable'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$bonus_max_per_hour' WHERE `key`='bonus_max_per_hour'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$sb_shout_enable' WHERE `key`='sb_shout_enable'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$bonus_make_a_shout' WHERE `key`='bonus_make_a_shout'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$sb_radio_enable' WHERE `key`='sb_radio_enable'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$bonus_listen2radio' WHERE `key`='bonus_listen2radio'", true);
        $test = quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$sb_gift_enable' WHERE `key`='sb_gift_enable'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$bonus_giftmax' WHERE `key`='bonus_giftmax'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$price_hnr' WHERE `key`='price_hnr'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$hnr_enable' WHERE `key`='hnr_enable'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}bonus` SET `points`='$pts1', `gb`='$gb1', `traffic`='$gbinbytes1' WHERE `name`='1'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}bonus` SET `points`='$pts2', `gb`='$gb2', `traffic`='$gbinbytes2' WHERE `name`='2'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}bonus` SET `points`='$pts3', `gb`='$gb3', `traffic`='$gbinbytes3' WHERE `name`='3'", true);

        if (substr($FORUMLINK, 0, 3)=="smf" && $forpost_enable=="true") {
            $petr1=do_sqlquery("SELECT `u`.`id`, `m`.`posts` FROM `{$TABLE_PREFIX}users` `u` INNER JOIN `{$db_prefix}members` `m` ON `u`.`smf_fid`=`m`.".(($FORUMLINK=="smf")?"`ID_MEMBER`":"`id_member`")." WHERE `u`.`smf_postcount`!=`m`.`posts`", true);
            if (@sql_num_rows($petr1)>0) {
                while ($fied=$petr1->fetch_assoc()) {
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `smf_postcount`=".$fied["posts"]." WHERE `id`=".$fied["id"], true);
                }
            }
        } elseif ($FORUMLINK=="ipb" && $forpost_enable=="true") {
            $petr1=do_sqlquery("SELECT `u`.`id`, `m`.`posts` FROM `{$TABLE_PREFIX}users` `u` INNER JOIN `{$ipb_prefix}members` `m` ON `u`.`ipb_fid`=`m`.`member_id` WHERE `u`.`ipb_postcount`!=`m`.`posts`", true);
            if (@sql_num_rows($petr1)>0) {
                while ($fied=$petr1->fetch_assoc()) {
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `ipb_postcount`=".$fied["posts"]." WHERE `id`=".$fied["id"], true);
                }
            }
        }
        foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename) {
            unlink($filename);
        }
    }
}
