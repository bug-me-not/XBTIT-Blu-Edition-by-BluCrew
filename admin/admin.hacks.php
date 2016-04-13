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


      
$ip2c=get_result("SELECT COUNT(*) `count` FROM `{$TABLE_PREFIX}ip2country`",true,$btit_settings["cache_duration"]);
if(count($ip2c)>0)
    $ip2c_count=$ip2c[0]["count"];
else
    $ip2c_count=0;

if($ip2c_count > 0 && $ip2c_count < 120778)
    $ip2c_count=0;

if(isset($_POST) && !empty($_POST))
{
    $enable_all=$_POST["enable_all"];
    unset($_POST["enable_all"]);

    if($enable_all=="enable_all")
    {
        $post=$_POST;
        foreach($post as $k => $v)
        {
            if($v=="disabled")
                $_POST[$k]="enabled";
        }
    }
    elseif($enable_all=="disable_all")
    {
        $post=$_POST;
        foreach($post as $k => $v)
        {
            if($v=="enabled")
                $_POST[$k]="disabled";
        }
    }
    // Turn prerequisites back on if they're disabled when a parent hack is enabled    
    if($_POST["fmhack_custom_title"]=="disabled" && $_POST["fmhack_bonus_system"] == "enabled")
    {
        $_POST["fmhack_custom_title"]="enabled";
    }
    if(($_POST["fmhack_donation_history"]=="disabled" || $_POST["fmhack_simple_donor_display"]=="disabled" || $_POST["fmhack_timed_ranks"]=="disabled") && $_POST["fmhack_advanced_auto_donation_system"]=="enabled")
    {
        $_POST["fmhack_donation_history"]="enabled";
        $_POST["fmhack_simple_donor_display"]="enabled";
        $_POST["fmhack_timed_ranks"]="enabled";
    }
    if($_POST["fmhack_warning_system"]=="disabled" && ($_POST["fmhack_anti_hit_and_run_system"]=="enabled" || $_POST["fmhack_low_ratio_ban_system"]=="enabled"))
    {
        $_POST["fmhack_warning_system"]="enabled";
    }
    if($_POST["fmhack_report_users_and_torrents"]=="disabled" && $_POST["fmhack_high_UL_speed_report"] == "enabled")
    {
        $_POST["fmhack_report_users_and_torrents"]="enabled";
    }
    if($_POST["fmhack_twitter_update"]=="enabled" && !extension_loaded("curl"))
    {
        $_POST["fmhack_twitter_update"]="disabled";
    }
    if($_POST["fmhack_torrent_image_upload"]=="disabled" && $_POST["fmhack_balloons_on_mouseover"] == "enabled")
    {
        $_POST["fmhack_torrent_image_upload"]="enabled";
    }
    if($_POST["fmhack_torrent_image_upload"]=="disabled" && $_POST["fmhack_circling_last_torrents"] == "enabled")
    {
        $_POST["fmhack_torrent_image_upload"]="enabled";
    }
    if($_POST["fmhack_xbtit_->_SMF_style_bridge"]=="enabled" && substr($FORUMLINK,0,3)!="smf")
    {
        $_POST["fmhack_xbtit_->_SMF_style_bridge"]="disabled";
    }
    if($_POST["fmhack_allow_and_disallow_users_to_up_and_download"]=="disabled" && $_POST["fmhack_detect_and_blacklist_proxy"] == "enabled")
    {
        $_POST["fmhack_allow_and_disallow_users_to_up_and_download"]="enabled";
    }
    if($_POST["fmhack_view_edit_delete_preview_shoutBox_comments"]=="disabled" && $_POST["fmhack_comments_layout"] == "enabled")
    {
        $_POST["fmhack_view_edit_delete_preview_shoutBox_comments"]="enabled";
    }
    if($_POST["fmhack_IP_to_country"]=="enabled" && $ip2c_count < 120778)
    {
        $_POST["fmhack_IP_to_country"]="disabled";
    }
    if($_POST["fmhack_faq_with_groups"]=="disabled" && $_POST["fmhack_forced_FAQ"] == "enabled")
    {
        $_POST["fmhack_faq_with_groups"]="enabled";
    }
    if($_POST["fmhack_last_download_block"]=="enabled" && $_POST["fmhack_IP_to_country"]=="disabled" && $ip2c_count < 120778)
    {
        $_POST["fmhack_last_download_block"]="disabled";
    }
    elseif($_POST["fmhack_last_download_block"]=="enabled" && $_POST["fmhack_IP_to_country"]=="disabled" && $ip2c_count == 120778)
    {
        $_POST["fmhack_IP_to_country"]="enabled";
    }
    if($_POST["fmhack_file_hosting"]=="disabled" && $_POST["fmhack_file_hosting"] == "enabled")
    {
        $_POST["fmhack_file_hosting"]="enabled";
    }     
    if($btit_settings["fmhack_invitation_system"]=="disabled" && $_POST["fmhack_invitation_system"]=="enabled" && ($btit_settings["fmhack_user_signup_agreement"]=="enabled" || $_POST["fmhack_user_signup_agreement"]=="enabled"))
    {
        $_POST["fmhack_user_signup_agreement"]="disabled";
    }
    elseif($btit_settings["fmhack_user_signup_agreement"]=="disabled" && $_POST["fmhack_user_signup_agreement"]=="enabled" && ($btit_settings["fmhack_invitation_system"]=="enabled" || $_POST["fmhack_invitation_system"]=="enabled"))
    {
        $_POST["fmhack_invitation_system"]="disabled";
    }
    if($_POST["fmhack_forced_FAQ"] == "enabled")
    {
        $quick=get_result("SELECT COUNT(*) `count` FROM `{$TABLE_PREFIX}faq` `f` INNER JOIN `{$TABLE_PREFIX}faq_group` `fg` ON `f`.`cat_id`=`fg`.`id`", true, $btit_settings["cache_duration"]);
        if(count($quick)==0 || $quick[0]["count"]==0)
            $_POST["fmhack_forced_FAQ"]="disabled";
    }
    if($_POST["fmhack_poll_from_integrated_forum"] == "enabled" && $FORUMLINK!="smf2" && $FORUMLINK!="ipb")
    {
        $_POST["fmhack_poll_from_integrated_forum"] = "disabled";
    }
    if($_POST["fmhack_SEO_panel"] == "enabled" && $btit_settings["fmhack_SEO_panel"]=="disabled")
    {
        if(!is_mod_rewrite_enabled())
            $_POST["fmhack_SEO_panel"] = "disabled";
    }
    if($_POST["fmhack_magnet_links"] == "enabled" && $btit_settings["fmhack_magnet_links"]=="disabled")
    {
        if($DHT_PRIVATE || $PRIVATE_ANNOUNCE)
            $_POST["fmhack_magnet_links"] = "disabled";
    }
    if($_POST["fmhack_block_signup_from_certain_countries"] == "enabled" && $btit_settings["fmhack_block_signup_from_certain_countries"]=="disabled"  && $ip2c_count < 120778)
    {
        $_POST["fmhack_block_signup_from_certain_countries"] = "disabled";
    }
    if($_POST["fmhack_permissions_for_external_torrents"] == "enabled" && $btit_settings["fmhack_permissions_for_external_torrents"]=="disabled"  && !$EXTERNAL_TORRENTS)
    {
        $_POST["fmhack_permissions_for_external_torrents"] = "disabled";
    }
   
    foreach($_POST as $k => $v)
    {
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".sql_esc($v)."' WHERE `key`='".sql_esc($k)."'");

        if($k=="fmhack_anti_hit_and_run_system" && $v!=$btit_settings["fmhack_anti_hit_and_run_system"])
            quickQuery("UPDATE `{$TABLE_PREFIX}blocks` SET `status`=".(($v=="enabled")?1:0)." WHERE `content`='hit_run'");
        if($k=="fmhack_torrent_request_and_vote" && $v!=$btit_settings["fmhack_torrent_request_and_vote"])
            quickQuery("UPDATE `{$TABLE_PREFIX}blocks` SET `status`=".(($v=="enabled")?1:0)." WHERE `content`='request'");
        if($k=="fmhack_lottery" && $v!=$btit_settings["fmhack_lottery"])
            quickQuery("UPDATE `{$TABLE_PREFIX}blocks` SET `status`=".(($v=="enabled")?1:0)." WHERE `content`='lottery'");
        if($k=="fmhack_sport_betting" && $v!=$btit_settings["fmhack_sport_betting"])
            quickQuery("UPDATE `{$TABLE_PREFIX}blocks` SET `status`=".(($v=="enabled")?1:0)." WHERE `content`='bet'");
        if($k=="fmhack_uploader_medals" && $v!=$btit_settings["fmhack_uploader_medals"])
            quickQuery("UPDATE `{$TABLE_PREFIX}blocks` SET `status`=".(($v=="enabled")?1:0)." WHERE `content`='topup'");
        if($k=="fmhack_torrent_moderation")
            do_sqlquery("ALTER TABLE `{$TABLE_PREFIX}files` CHANGE `moder` `moder` ENUM( 'um', 'bad', 'ok' ) NOT NULL DEFAULT '".(($v=="enabled")?"um":"ok")."'");
        if($k=="fmhack_report_users_and_torrents" && $btit_settings["fmhack_report_users_and_torrents"]=="disabled" &&  $v=="enabled")
            quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `shout_announced`=1",true);
        if($k=="fmhack_circling_last_torrents" && $v!=$btit_settings["fmhack_circling_last_torrents"])
            quickQuery("UPDATE `{$TABLE_PREFIX}blocks` SET `status`=".(($v=="enabled")?1:0)." WHERE `content`='circleimages'");
        if($k=="fmhack_private_shouts" && $btit_settings["fmhack_private_shouts"]=="enabled" && $v=="disabled")
            quickQuery("DELETE FROM `{$TABLE_PREFIX}chat` WHERE `private`='yes'");
        if($k=="fmhack_booted" && $btit_settings["fmhack_booted"]=="enabled" && $v=="disabled")
        {
            if($btit_settings["warn_bantype"]=="boot_at_max")
                quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='no_action_at_max' WHERE `key`='warn_bantype'");
            if($btit_settings["warn_booted_days"]>0)
                quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`=0 WHERE `key`='warn_booted_days'");
        }
        if($k=="fmhack_low_ratio_ban_system" && $v!=$btit_settings["fmhack_low_ratio_ban_system"])
            quickQuery("UPDATE `{$TABLE_PREFIX}blocks` SET `status`=".(($v=="enabled")?1:0)." WHERE `content`='lrb'");
        if($k=="fmhack_birthdays" && $v!=$btit_settings["fmhack_birthdays"])
            quickQuery("UPDATE `{$TABLE_PREFIX}blocks` SET `status`=".(($v=="enabled")?1:0)." WHERE `content`='birthday'");
        if($k=="fmhack_partners_page" && $v!=$btit_settings["fmhack_partners_page"])
            quickQuery("UPDATE `{$TABLE_PREFIX}blocks` SET `status`=".(($v=="enabled")?1:0)." WHERE `content`='links'");
        if($k=="fmhack_last_download_block" && $v!=$btit_settings["fmhack_last_download_block"])
            quickQuery("UPDATE `{$TABLE_PREFIX}blocks` SET `status`=".(($v=="enabled")?1:0)." WHERE `content`='last'");
        if($k=="fmhack_bump_torrents" && $btit_settings["fmhack_bump_torrents"]=="disabled" && $v=="enabled")
            quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `bumpdate`=UNIX_TIMESTAMP(`data`)");
        if($k=="fmhack_logical_rank_ordering" && $btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $v=="disabled")
        {
            $res=get_result("SELECT * FROM `{$TABLE_PREFIX}settings` WHERE `value` LIKE'lro-%'");
            if(count($res)>0)
            {
                foreach($res as $lroKey => $lroValue)
                {
                    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='lro-0-0' WHERE `key`='".sql_esc($lroKey)."'");
                }
            }
            quickQuery("UPDATE `{$TABLE_PREFIX}blocks` SET `use_lro`='no', `lro_minclassview`=0, `lro_maxclassview`=0", true);
        }
        if($k=="fmhack_torrent_of_the_week" && $v!=$btit_settings["fmhack_torrent_of_the_week"])
            quickQuery("UPDATE `{$TABLE_PREFIX}blocks` SET `status`=".(($v=="enabled")?1:0)." WHERE `content`='torrentoftheweek'");
    }

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
}

$admintpl->set("language", $language);

$res=get_result("SELECT `h`.`title`, `h`.`version`, `h`.`author`, `h`.`prerequisite`, `s`.`value` `state` FROM `{$TABLE_PREFIX}hacks` `h` LEFT JOIN `{$TABLE_PREFIX}settings` `s` ON `h`.`title`=`s`.`key` ORDER BY `h`.`title` ASC", true, $btit_settings["cache_duration"]);

$i=0;
$cases=array("enabled", "disabled");

foreach($res as $row)
{
    $hack[$i]["shortname"]=$row["title"];
    $hack[$i]["longname"]=ucwords(str_replace(array("fmhack_","_"),array(""," "),$row["title"])) . (($row["prerequisite"]!="no")?"&nbsp;&nbsp;<a href='#' title='".$language["PRE_OF"]." ". ucwords(str_replace(array("fmhack_","_","|"),array(""," ", " & "),$row["prerequisite"]))."'><img src=images/info.png alt='".$language["PRE_OF"]." ". ucwords(str_replace(array("fmhack_","_"),array(""," "),$row["prerequisite"]))."'></a>":"") . (($row["title"]=="fmhack_twitter_update" && !extension_loaded("curl"))?"<br />".$language["TWIT_CURL_REQ"]:"") . (($row["title"]=="fmhack_xbtit_->_SMF_style_bridge" && substr($FORUMLINK,0,3)!="smf")?"<br />".$language["SMF_IS_REQ"]:"") . ((($row["title"]=="fmhack_IP_to_country" || $row["title"]=="fmhack_last_download_block" || $row["title"]=="fmhack_block_signup_from_certain_countries") && $ip2c_count < 120778)?"<br />".$language["IP2C_DB_REQ1"]."<a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=ip2c_import'>".$language["IP2C_DB_REQ2"]."</a> ".$language["IP2C_DB_REQ3"]:"") . (($row["title"]=="fmhack_SEO_panel" && !is_mod_rewrite_enabled())?"<br />".$language["SEO_MODRW_REQ"]:"").(($row["title"]=="fmhack_magnet_links" && ($DHT_PRIVATE || $PRIVATE_ANNOUNCE))?"<br />".$language["MAGNET_NO_ENABLE"]:"").(($row["title"]=="fmhack_permissions_for_external_torrents" && !$EXTERNAL_TORRENTS)?"<br />".$language["PFET_NO_ENABLE"]:"");
    $hack[$i]["author"]=$row["author"];
    $hack[$i]["version"]=$row["version"];
    $hack[$i]["case"]=$row["state"];
    $i++;
}

$admintpl->set_cloop("hack", $hack, $cases);
$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);

?>