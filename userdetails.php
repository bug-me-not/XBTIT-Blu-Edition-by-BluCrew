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
if(!defined("IN_BTIT"))
    die("non direct access!");

// load language file
require (load_language("lang_userdetails.php"));
if(!isset($language["SYSTEM_USER"]))
    $language["SYSTEM_USER"]="System";
$id = intval(0 + $_GET["id"]);
if(!isset($_GET["returnto"]))
    $_GET["returnto"] = "";
$link = rawurlencode($_GET["returnto"]);
if($CURUSER["uid"]!=$id && $CURUSER["view_users"] != "yes")
{
    err_msg($language["ERROR"], $language["NOT_AUTHORIZED"]." ".$language["MEMBERS"]);
    stdfoot();
    die();
}
if($id == 1)
{ // trying to view guest details?
    err_msg($language["ERROR"], $language["GUEST_DETAILS"]);
    stdfoot();
    die();
}
if($XBTT_USE)
{
    $tseeds = "f.seeds+ifnull(x.seeders,0)";
    $tleechs = "f.leechers+ifnull(x.leechers,0)";
    $tcompletes = "f.finished+ifnull(x.completed,0)";
    $ttables = "{$TABLE_PREFIX}files f LEFT JOIN xbt_files x ON x.info_hash=f.bin_hash";
    $udownloaded = "u.downloaded+IFNULL(x.downloaded,0)";
    $uuploaded = "u.uploaded+IFNULL(x.uploaded,0)";
    $utables = "{$TABLE_PREFIX}users u LEFT JOIN xbt_users x ON x.uid=u.id";
}
else
{
    $tseeds = "f.seeds";
    $tleechs = "f.leechers";
    $tcompletes = "f.finished";
    $ttables = "{$TABLE_PREFIX}files f";
    $udownloaded = "u.downloaded";
    $uuploaded = "u.uploaded";
    $utables = "{$TABLE_PREFIX}users u";
}
if($id > 1)
{
    if($btit_settings["fmhack_torrent_moderation"] == "enabled")
    {
        // strange, $only is not used anywhere. What's the point of this?
        if($CURUSER['trusted'])
            $only = "AND 1=1";
        else
            $only = "AND moder='ok'";
    }
    $query1_select = "`ul`.`id_level` `base_level`,";
    $query1_join = "";
    $query1_and = "";
    if($btit_settings["fmhack_custom_title"] == "enabled")
        $query1_select .= "u.custom_title,";
    if($btit_settings["fmhack_bonus_system"] == "enabled")
        $query1_select .= "u.seedbonus,";
    if($btit_settings["fmhack_simple_donor_display"] == "enabled")
        $query1_select .= "u.donor,";
    if($btit_settings["fmhack_avatar_signature_sync"] == "enabled")
        $query1_select .= "`u`.`sig`,";
    if($btit_settings["fmhack_timed_ranks"] == "enabled")
    {
        $query1_select .= "`u`.`id_level`, `u`.`old_rank`, `u`.`timed_rank`, `ul1`.`prefixcolor` `tr_prefixcolor`, `ul1`.`suffixcolor` `tr_suffixcolor`, `ul1`.`level` `tr_level`, ";
        $query1_join .= "LEFT JOIN `{$TABLE_PREFIX}users_level` `ul1` ON `u`.`old_rank`=`ul1`.`id` ";
    }
    if($btit_settings["fmhack_advanced_auto_donation_system"] == "enabled")
        $query1_select .= "u.rank_switch,";
    // Warn System -->
    if($btit_settings["fmhack_warning_system"] == "enabled")
        $query1_select .= "u.warn_lev,";
    // <-- Warn System
    // Booted -->
    if($btit_settings["fmhack_booted"] == "enabled")
        $query1_select .= "u.booted, u.whybooted, u.whobooted, u.addbooted,";
    // <-- Booted

    if($btit_settings["fmhack_group_colours_overall"] == "enabled")
    {
        $query1_select .= "ul.prefixcolor, ul.suffixcolor,";
        if($btit_settings["fmhack_booted"] == "enabled")
        {
            $query1_select .= "`ul3`.`prefixcolor` `booted_prefixcolor`, `ul3`.`suffixcolor` `booted_suffixcolor`,";
            $query1_join .= "LEFT JOIN `{$TABLE_PREFIX}users` `u3` ON `u`.`whobooted`=`u3`.`username` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul3` ON `u3`.`id_level`=`ul3`.`id` ";
        }
    }
    if($btit_settings["fmhack_torrents_limit"] == "enabled" || $btit_settings["fmhack_enhanced_wait_time"] == "enabled")
    {
        if($XBTT_USE)
        {
            $query1_select .= (($btit_settings["fmhack_torrents_limit"] == "enabled")?"`x`.`torrents_limit`, ":"")."u.id_level `il`,".(($btit_settings["fmhack_enhanced_wait_time"] == "enabled")?" `x`.`wait_time`, ":"");
        }
        else
        {
            $query1_select .= (($btit_settings["fmhack_torrents_limit"] == "enabled")?"`u`.`php_cust_torr_limit`, `u`.`custom_torr_limit`, `ul`.`torrents_limit`, ":"")."`u`.`id_level` `il`, ".(($btit_settings["fmhack_enhanced_wait_time"] == "enabled")?"`u`.`custom_wait_time`, `u`.`php_cust_wait_time`, `ul`.`WT`, ":"");
        }
    }
    if($btit_settings["fmhack_ban_button"] == "enabled")
        $query1_select .= "`u`.`ban`,";
    if($btit_settings["fmhack_teams"] == "enabled")
        $query1_select .= "`u`.`team`,";
    if($btit_settings["fmhack_hide_online_status"] == "enabled")
        $query1_select .= "`u`.`invisible`,";
    if($btit_settings["fmhack_birthdays"] == "enabled")
        $query1_select .= "`u`.`dob`,";
    if($btit_settings["fmhack_low_ratio_ban_system"] == "enabled")
        $query1_select .= "`u`.`bandt`,";
    if($btit_settings["fmhack_user_notes"] == "enabled")
        $query1_select .= "`u`.`user_notes`,";
    if($btit_settings["fmhack_IP_to_country"] == "enabled")
        $query1_select .= "`u`.`country_name`, `u`.`country_flag`,";
    if($btit_settings["fmhack_user_images"] == "enabled")
        $query1_select .= "`u`.`user_images`,";
    if($btit_settings["fmhack_about_me"] == "enabled")
        $query1_select .= "`u`.`about_me`,";
    if($btit_settings["fmhack_user_watch_list"] == "enabled")
        $query1_select .= "`u`.`IS_WATCHED`,";
    if($btit_settings["fmhack_private_profile"] == "enabled")
        $query1_select .= "`u`.`profileview`,";
    if($btit_settings["fmhack_signature_on_internal_forum"] == "enabled")
        $query1_select .= "`u`.`signature`,";
    if($btit_settings["fmhack_VIP_freeleech"] == "enabled")
        $query1_select .= "`ul`.`freeleech`, `u`.`vipfl_down`, `u`.`vipfl_date`,";
    if($btit_settings["fmhack_logical_rank_ordering"] == "enabled")
        $query1_select .= "`ul`.`logical_rank_order`,";
    if($btit_settings["fmhack_freeleech_slots"] == "enabled")
        $query1_select .= "`u`.`freeleech_slots`,";
    if($btit_settings["fmhack_previous_usernames"]=="enabled")
        $query1_select.="`u`.`previous_names`,";
    $res = get_result("SELECT ".$query1_select." u.avatar,u.browser,u.email,u.cip,u.username,$udownloaded as downloaded,$uuploaded as uploaded,UNIX_TIMESTAMP(u.joined) as joined,UNIX_TIMESTAMP(u.lastconnect) as lastconnect,ul.level, u.flag, c.name, c.flagpic, u.pid, u.time_offset, u.smf_fid, u.ipb_fid FROM $utables INNER JOIN {$TABLE_PREFIX}users_level ul ON ul.id=u.id_level LEFT JOIN {$TABLE_PREFIX}countries c ON u.flag=c.id ".$query1_join." WHERE u.id=$id", true, $btit_settings['cache_duration']);
    $num = count($res);
    if($num == 0)
    {
        err_msg($language["ERROR"], $language["BAD_ID"]);
        stdfoot();
        die();
    }
    else
    {
        $row = $res[0];
        if($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled" && $CURUSER["admin_access"]=="yes")
        {
            $hnr=get_result("SELECT COUNT(*) `count` FROM ".(($XBTT_USE)?"`xbt_files_users`":"`{$TABLE_PREFIX}history`")." WHERE `hit`='yes' AND `uid`=".$id, true, $btit_settings["cache_duration"]);
            $row["hnr_count"]=$hnr[0]["count"];
        }
        if($btit_settings["fmhack_VIP_freeleech"] == "enabled")
        {
            if($row["freeleech"] == "yes")
            {
                $row["downloaded"] = $row["vipfl_down"];
            }
        }
    }
}
else
{
    err_msg($language["ERROR"], $language["BAD_ID"]);
    stdfoot();
    die();
}

if($btit_settings["fmhack_logical_rank_ordering"] == "enabled" && $CURUSER["logical_rank_order"]>0 && $row["logical_rank_order"]>0)
    $rankOverOrEqual=(($CURUSER["logical_rank_order"] >= $row["logical_rank_order"])?true:false);
else
    $rankOverOrEqual=(($CURUSER["id_level"] >= $row["base_level"])?true:false);

if($btit_settings["fmhack_torrents_limit"] == "enabled")
{
    if($CURUSER["edit_users"] == "yes" && $id != $CURUSER["uid"] && $rankOverOrEqual)
    {
        (isset($_POST["tlimit"]) && is_numeric($_POST["tlimit"]))?$tlimit = (int)0 + $_POST["tlimit"]:$tlimit = "bad";
        if($tlimit != "bad")
        {
            if($tlimit < 0)
            {
                $q = do_sqlquery("SELECT `torrents_limit` FROM `{$TABLE_PREFIX}users_level` WHERE `id`=".$row["il"], true);
                $r = $q->fetch_array();
            }
            if($XBTT_USE)
            {
                quickQuery("UPDATE `xbt_users` SET `torrents_limit`=".(($tlimit < 0)?$r[0]:$tlimit)." WHERE `uid`=$id", true);
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `custom_torr_limit`='".(($tlimit < 0)?"no":"yes")."',`php_cust_torr_limit`=0 WHERE `id`=$id", true);
            }
            else
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `custom_torr_limit`='".(($tlimit < 0)?"no":"yes")."', `php_cust_torr_limit`=".(($tlimit < 0)?"0":$tlimit)." WHERE `id`=$id", true);
            redirect((($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated_user"] == "true")?$id."_".strtr($row["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$id));
        }
    }
}
if($btit_settings["fmhack_enhanced_wait_time"] == "enabled")
{
    if($CURUSER["edit_users"] == "yes" && $id != $CURUSER["uid"] && $rankOverOrEqual)
    {
        (isset($_POST["WT"]) && is_numeric($_POST["WT"]))?$wait_time = (int)0 + $_POST["WT"]:$wait_time = "bad";
        if($wait_time != "bad")
        {
            if($wait_time < 0)
            {
                $q = do_sqlquery("SELECT `WT` FROM `{$TABLE_PREFIX}users_level` WHERE `id`=".$row["il"], true);
                $r = $q->fetch_array();
            }
            if($XBTT_USE)
            {
                quickQuery("UPDATE `xbt_users` SET `wait_time`=".(($wait_time < 0)?($r[0] * 3600):($wait_time * 3600))." WHERE `uid`=$id", true);
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `custom_wait_time`='".(($wait_time < 0)?"no":"yes")."',`php_cust_wait_time`=0 WHERE `id`=$id", true);
            }
            else
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `custom_wait_time`='".(($wait_time < 0)?"no":"yes")."', `php_cust_wait_time`=".(($wait_time < 0)?"0":$wait_time)." WHERE `id`=$id", true);
            redirect((($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated_user"] == "true")?$id."_".strtr($row["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$id));
        }
    }
}
if($btit_settings["fmhack_private_profile"] == "enabled")
{
    if($row["profileview"] == 1 && $CURUSER["id_level"] <= 5 && $CURUSER["uid"] != $id)
    {
        redirect("index.php?page=private&id=$id");
    }
}
include ("include/offset.php");
//Profile Status 
    $status_sql = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}profile_status WHERE userid = ".sqlesc($id));
    if (sql_num_rows($status_sql)) 
        $profile_status = $status_sql->fetch_assoc();
    else 
        $profile_status = array('last_status' => '',
                                         'last_update' => 0
    );
    //Profile Status End
if($btit_settings["fmhack_ban_button"] == "enabled" || $btit_settings["fmhack_low_ratio_ban_system"] == "enabled")
{
    if($row["ban"] == 'yes' || $row["bandt"] == "yes")
    {
        $banp = "<img src='images/ban.gif'>";
    }
    else
    {
        $banp = "";
    }
}
// user's ratio
if(intval($row["downloaded"]) > 0)
{
    $sr = $row["uploaded"] / $row["downloaded"];
    if($sr >= 4)
        $s = "images/smilies/thumbsup.gif";
    elseif($sr >= 2)
        $s = "images/smilies/grin.gif";
    elseif($sr >= 1)
        $s = "images/smilies/smile1.gif";
    elseif($sr >= 0.5)
        $s = "images/smilies/noexpression.gif";
    elseif($sr >= 0.25)
        $s = "images/smilies/sad.gif";
    else
        $s = "images/smilies/thumbsdown.gif";
    $ratio = number_format($sr, 2)."&nbsp;&nbsp;<img src=\"$s\" alt=\"\" />";
}
else
    $ratio = '&#8734;';
$utorrents = intval($CURUSER["torrentsperpage"]);
$userdetailtpl = new bTemplate();
$userdetailarr=array();
$userdetailarr["id"] = $id;
$userdetailtpl->set("fls_enabled", (($btit_settings["fmhack_freeleech_slots"] == "enabled")?true:false), true);
if($btit_settings["fmhack_freeleech_slots"] == "enabled")
    $userdetailarr["fls"]=$row["freeleech_slots"];
if($btit_settings["fmhack_social_network"] == "enabled")
{
    $curr_friend = get_result("SELECT `id` FROM `{$TABLE_PREFIX}friendlist` WHERE (`user_id`=".$CURUSER["uid"]." OR `friend_id`=".$CURUSER["uid"].") AND (`user_id`=".$id." OR `friend_id`=".$id.")", true, $btit_settings["cache_duration"]);
    $userdetailarr["friend"] = ((count($curr_friend) > 0 || $CURUSER["uid"] == $id)?"":"<a href='index.php?page=friendlist&do=add&friend_id=".$id."'><i class='fa fa-user-plus fa-2x'></i></a>&nbsp;&nbsp;&nbsp;");
    $userdetailarr["showfriend"] = "<a href='index.php?page=friends&frid=".$id."'><i class='fa fa-users fa-2x'></i></a>";
}
$userdetailtpl->set("social_network_enabled", (($btit_settings["fmhack_social_network"] == "enabled")?true:false), true);
$userdetailtpl->set("about_me_enabled", (($btit_settings["fmhack_about_me"] == "enabled")?true:false), true);
if($btit_settings["fmhack_about_me"] == "enabled")
{
    $userdetailarr["about_me"] = format_comment($row["about_me"]);
}
if($btit_settings["fmhack_user_images"] == "enabled")
{
    $selected_images = explode(",", $row["user_images"]);
    $j = 1;
    $image_count = 0;
    $my_img_list = "";
    foreach($btit_settings as $key => $value)
    {
        if(substr($key, 0, 9) == "user_img_")
        {
            $value_split = explode("[+]", $value);
            if(in_array($j, $selected_images))
            {
                $image_count++;
                $my_img_list .= "&nbsp;<img src='images/user_images/".$value_split[0]."' alt='".$value_split[1]."' title='".$value_split[1]."' />";
            }
            $j++;
        }
    }
    $userdetailarr["img_list"] = (($image_count >= 1)?$my_img_list:(($CURUSER["uid"] == $id)?$language["UIMG_NO_ICONS"]:$language["UIMG_TM_NO_ICONS"]));
}
$userdetailtpl->set("birthdays_enabled", (($btit_settings["fmhack_birthdays"] == "enabled")?true:false), true);
if($btit_settings["fmhack_birthdays"] == "enabled")
{
    if($row["dob"] != "0000-00-00")
    {
        $dob = explode("-", $row["dob"]);
        $age = userage($dob[0], $dob[1], $dob[2]);
    }
    else
        $age = $language["NA"];
    $userdetailarr["age"] = $age;
}
$userdetailtpl->set("show_notes", (($btit_settings["fmhack_user_notes"] == "enabled" && isset($row["user_notes"]) && !empty($row["user_notes"]) && $CURUSER["edit_users"] == "yes")?true:false), true);
$userdetailtpl->set("notes_pager_needed", false, true);

if($btit_settings["fmhack_user_notes"] == "enabled" && $CURUSER["edit_users"] == "yes")
{
    if(isset($row["user_notes"]) && !empty($row["user_notes"]))
        $usernotes = unserialize(unesc($row["user_notes"]));
    else
        $usernotes = array();
    (isset($_GET["notepage"]) && !empty($_GET["notepage"]) && is_numeric($_GET["notepage"]))?$notepage = (int)0 + $_GET["notepage"]:$notepage = 1;
    $notecount = count($usernotes);
    $notesperpage = ((isset($btit_settings["un_notesperpage"]) && !empty($btit_settings["un_notesperpage"]) && is_numeric($btit_settings["un_notesperpage"]) && $btit_settings["un_notesperpage"] > 0)?(int)0 + $btit_settings["un_notesperpage"]:10);
    if($notecount <= $notesperpage)
    {
        $pages = 1;
        $firstkey = 0;
        $lastkey = $notecount - 1;
    }
    else
    {
        $pages = ceil($notecount / $notesperpage);
        $lastkey = ($notecount);
        $firstkey = $lastkey - ($notepage * $notesperpage);
        $lastkey = (($firstkey + $notesperpage) - 1);
    }
    if($firstkey < 0)
        $firstkey = 0;
    $un = 0;
    foreach($usernotes as $v)
    {
        $usernotes[$un] = base64_decode($v);
        $un++;
    }
    while($firstkey <= $lastkey)
    {
        $splitnote = explode("<+>", $usernotes[$firstkey]);
        if($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated_user"] == "true")
        {
            $first_char = strpos($splitnote[2], ">") + 1;
            $last_char = strpos($splitnote[2], "</");
            if($first_char && $last_char)
                $clean_name = substr($splitnote[2], $first_char, ($last_char - $first_char));
            else
                $clean_name = $splitnote[2];
            unset($first_char, $last_char);
            $first_char = strpos($splitnote[5], ">") + 1;
            $last_char = strpos($splitnote[5], "</");
            if($first_char && $last_char)
                $clean_edit = substr($splitnote[5], $first_char, ($last_char - $first_char));
            else
                $clean_edit = $splitnote[5];
            unset($first_char, $last_char);
        }
        $final_notes[$firstkey]["addedby_link"] = (($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated_user"] == "true")?$splitnote[1]."_".strtr($clean_name, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$splitnote[1]);
        $final_notes[$firstkey]["noteid"] = $firstkey;
        $final_notes[$firstkey]["note"] = format_comment($splitnote[0]);
        $final_notes[$firstkey]["uid"] = $splitnote[1];
        $final_notes[$firstkey]["username"] = $splitnote[2];
        $final_notes[$firstkey]["date"] = date("j/n/Y \a\\t g:i a", $splitnote[3]);
        if(isset($splitnote[4]) && isset($splitnote[5]) && isset($splitnote[6]))
            $final_notes[$firstkey]["edited"] = "<br /><i><span style='font-size:6pt;color:gray;'>(".$language["UN_EDBY"]." <a href='".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated_user"] == "true")?$splitnote[4]."_".strtr($clean_edit, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$splitnote[4])."'>".$splitnote[5]."</a> ".$language["UN_ON"]." ".date("j/n/Y \a\\t g:i a", $splitnote[6]).")</span></i>";
        else
            $final_notes[$firstkey]["edited"] = "";
        $firstkey += 1;
        unset($splitnote);
    }
    $note_pager = "";
    $i = 1;
    if($pages > 1)
    {
        while($pages >= $i)
        {
            if($notepage != $i)
                $note_pager .= "&nbsp;<a href='index.php?page=userdetails&id=".$id."&notepage=".$i."'>$i</a>";
            else
                $note_pager .= "&nbsp;<b>$i</b>";
            $i++;
        }
    }
    $userdetailtpl->set("user_notes", $final_notes);
    $userdetailarr["cuid"] = $CURUSER["uid"];
    $userdetailarr["crand"] = $CURUSER["random"];
    $userdetailarr["csurl"] = $STYLEURL;
    $userdetailarr["un_id"] = $id;
    $userdetailarr["un_returnto"] = urlencode(base64_encode("index.php?page=userdetails&id=".$id));
    $userdetailarr["note_pager"] = $note_pager;
    $userdetailtpl->set("notes_pager_needed", ((isset($note_pager) && !empty($note_pager))?true:false), true);
    unset($i);
}

$userdetailtpl->set("ban_button_enabled", (($btit_settings["fmhack_ban_button"] == "enabled")?true:false), true);
$userdetailtpl->set("whois_enabled", (($btit_settings["fmhack_show_members_whois_record_on_userdetails"] == "enabled" && ($CURUSER["edit_users"] == "yes" || $CURUSER["admin_access"] == "yes"))?true:false), true);
// Report users & Torrents by DiemThuy -->
$userdetailtpl->set("ruat", (($btit_settings["fmhack_report_users_and_torrents"] == "enabled" && $id!=$CURUSER["uid"])?true:false), true);
if($btit_settings["fmhack_report_users_and_torrents"] == "enabled")
    $userdetailarr["rep"] = "<a href=index.php?page=report&user=".$id."><button class='btn btn-labeled btn-danger' type='button'>
<span class='btn-label'><i class='fa fa-flag'></i></span>Report User</button></a>";
// <-- Report users & Torrents by DiemThuy
$userdetailtpl->set("timed_ranks_enabled", (($btit_settings["fmhack_timed_ranks"] == "enabled")?true:false), true);
if($btit_settings["fmhack_timed_ranks"] == "enabled" && $CURUSER["edit_users"] == "yes")
{
    //  timed Rank by DT start
    $oldrank = (($row["tr_level"] == $row["level"])?$language["NA"]:unesc($row["tr_prefixcolor"].$row["tr_level"].$row["tr_suffixcolor"]));
    $userdetailarr["old_rank"] = $oldrank;
    $opts['name'] = 'level';
    $opts['complete'] = true;
    $opts['id'] = 'id';
    $opts['value'] = 'level';
    $opts['default'] = $row['id_level'];
    $ranks = rank_list((($btit_settings["fmhack_logical_rank_ordering"] == "enabled" && $CURUSER["logical_rank_order"]>0  && $row["logical_rank_order"]>0 && $CURUSER["logical_rank_order"]!=$row["logical_rank_order"])?true:false));
    $userdetailarr["rank_combo"] = get_combodt($ranks, $opts);
    $userdetailtpl->set("edit_allowed", (($id == $CURUSER["uid"] || !$rankOverOrEqual)?false:true), true);
}
else
    $userdetailtpl->set("edit_allowed", false, true);
//  timed Rank by DT end
$userdetailtpl->set("language", $language);
$userdetailarr["userdetail_username"] = (($btit_settings["fmhack_group_colours_overall"] == "enabled")?unesc($row["prefixcolor"].$row["username"].$row["suffixcolor"]):unesc($row["username"])).(($btit_settings["fmhack_simple_donor_display"] == "enabled")?get_user_icons($row, true):"").(($btit_settings["fmhack_warning_system"] == "enabled")?warn($row, true):"").(($btit_settings["fmhack_booted"] == "enabled")?booted($row, true):"").(($btit_settings["fmhack_ban_button"] == "enabled" || $btit_settings["fmhack_low_ratio_ban_system"] == "enabled")?$banp:"");

$userdetailtpl->set("pka_enabled", (($btit_settings["fmhack_previous_usernames"]=="enabled" && $row["previous_names"]!="" && $CURUSER["admin_access"]=="yes")?true:false), true);
if($btit_settings["fmhack_previous_usernames"]=="enabled")
{
    $userdetailarr["userdetail_aliases"] = (($row["previous_names"]!="")?str_replace(",", ", ", $row["previous_names"]):"");
}
//$userdetailtpl-> set("userdetail_no_guest", $CURUSER["uid"]>1, TRUE);
if($CURUSER["uid"] > 1 && $id != $CURUSER["uid"])
    $userdetailarr["userdetail_send_pm"] = "&nbsp;<a href=\"".(substr($GLOBALS["FORUMLINK"], 0, 3) == "smf"?"index.php?page=forum&amp;action=pm;sa=send;u=".$row["smf_fid"]."":"index.php?page=usercp&amp;do=pm&amp;action=edit&amp;uid=".$CURUSER["uid"]."&amp;what=new&amp;to=".urlencode(unesc($row["username"]))."")."\"><button class='btn btn-xs btn-primary' type='button'>PM</button></a>";
if($CURUSER["edit_users"] == "yes" && $id != $CURUSER["uid"])
    $userdetailarr["userdetail_edit"] = "&nbsp;<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=users&amp;action=edit&amp;uid=$id&amp;returnto=".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated_user"] == "true")?$id."_".strtr($row["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$id)."\"><button class='btn btn-xs btn-primary' type='button'>Edit</button></a>";
if($CURUSER["delete_users"] == "yes" && $id != $CURUSER["uid"])
    $userdetailarr["userdetail_delete"] = "&nbsp;<a onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\" href=index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=users&amp;action=delete&amp;uid=$id&amp;smf_fid=".$row["smf_fid"]."&amp;returnto=".urlencode("index.php?page=users")."><button class='btn btn-xs btn-primary' type='button'>Delete</button></a>";
if($btit_settings["fmhack_ban_button"] == "enabled")
{
    if(is_integer($btit_settings["banbutton"]) || substr($btit_settings["banbutton"], 0, 4)!="lro-" || $btit_settings["banbutton"]=="lro-0-0")
        $banButtonAllow=true;
    else
    {
        $banButtonPerms=explode("-", $btit_settings["banbutton"]);
        if($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $banButtonPerms[1]==1 && $banButtonPerms[2]>0)
            $banButtonAllow=(($CURUSER["logical_rank_order"]>=$banButtonPerms[2])?true:false);
        elseif($btit_settings["fmhack_logical_rank_ordering"]=="disabled" && $banButtonPerms[1]==0 && $banButtonPerms[2]>0)
            $banButtonAllow=(($CURUSER["id_level"]>=$banButtonPerms[2])?true:false);
    }
    if($id!=$CURUSER["uid"] && $rankOverOrEqual && $row["ban"]=="no" && $banButtonAllow)
        $userdetailarr["userdetail_banbutton"] = "&nbsp;<a href=index.php?page=banbutton&ban_id=".$id."><button class='btn btn-xs btn-primary' type='button'>IP Ban</button></a>";
}
$userdetailtpl->set("userdetail_has_avatar", $row["avatar"] && $row["avatar"] != "", true);
$userdetailarr["userdetail_avatar"] = "<img border=\"0\" style=\"height: 188px; width: 138px;\" src=\"".htmlspecialchars($row["avatar"])."\" alt=\"\" />";
if($btit_settings["fmhack_avatar_signature_sync"] == "enabled")
{
    $sigshit = array('[img]', '[/img]');
    $sigshit2 = array('', '');
    $prev_sig = str_replace($sigshit, $sigshit2, $row["sig"]);
    if(!empty($row["sig"]))
    {
        $userdetailarr["userdetail_sig"] = "<img border=\"0\" onload=\"resize_sig(this);\" src=\"".htmlspecialchars($prev_sig)."\" alt=\"\" />";
    }
    else
    {
        $userdetailarr["userdetail_sig"] = "";
    }
}
$userdetailtpl->set("userdetail_edit_admin", $CURUSER["edit_users"] == "yes" || $CURUSER["admin_access"] == "yes", true);
if($CURUSER["edit_users"] == "yes" || $CURUSER["admin_access"] == "yes")
{
    $userdetailarr["userdetail_email"] = "<a href=\"mailto:".$row["email"]."\">".$row["email"]."</a>";
    /* Last Browser */
    $userdetailtpl-> set("browser", ($row["browser"]));
    /* Last Browser */
    $userdetailtpl-> set("browser", ($row["browser"]));
    // ip to country
    $userdetailtpl->set("ip2c_view", (($btit_settings["fmhack_IP_to_country"] == "enabled" && $CURUSER["delete_users"] == "yes")?true:false), true);
    if($btit_settings["fmhack_IP_to_country"] == "enabled")
    {
        $flagimg = "<img src='images/flag/unknown.gif' alt='".$language["UNKNOWN"]."' title='".$language["UNKNOWN"]."'>";
        $userdetailarr["IP_country"] = $language["UNKNOWN"]." ".$flagimg;
        if($row["country_name"] != "unknown")
        {
            $flagimg = "<img src='images/flag/".$row["country_flag"]."' alt='".$row["country_name"]."' title='".$row["country_name"]."'>";
            $userdetailarr["IP_country"] = $row["country_name"]." ".$flagimg;
        }
        else
        {
            $sqlquery = "SELECT c.name, c.flagpic ";
            $sqlquery .= "FROM {$TABLE_PREFIX}countries AS c ";
            $sqlquery .= "LEFT JOIN {$TABLE_PREFIX}ip2country AS i ON i.country_code2 = c.domain ";
            $sqlquery .= "WHERE i.ip_from <= INET_ATON('".$row["cip"]."') ";
            $sqlquery .= "AND i.ip_to >= INET_ATON('".$row["cip"]."')  ";
            $ip2c_res = get_result($sqlquery, true, $btit_settings["cache_duration"]);
            if(count($ip2c_res) > 0)
            {
                $ip2c_row = $ip2c_res[0];
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `country_name`=".sqlesc($ip2c_row["name"]).", `country_flag`=".sqlesc($ip2c_row["flagpic"])." WHERE `id`=".$id, true);
                $flagimg = "<img src='images/flag/".$ip2c_row["flagpic"]."' alt='".$ip2c_row["name"]."' title='".$ip2c_row["name"]."'>";
            }
            $userdetailarr["IP_country"] = $ip2c_row["name"]." ".$flagimg;
        }
    }
    // ip to country
    // Donation History by DiemThuy -->
    $userdetailtpl->set("donation_history_enabled", (($btit_settings["fmhack_donation_history"] == "enabled" && ($CURUSER["edit_users"] == "yes" || $CURUSER["admin_access"] == "yes") && $id !=$CURUSER["uid"])?true:false), true);
    if($btit_settings["fmhack_donation_history"] == "enabled" && ($CURUSER["edit_users"] == "yes" || $CURUSER["admin_access"] == "yes") && $id !=$CURUSER["uid"])
    {
        $currency = "";
        if($btit_settings["fmhack_advanced_auto_donation_system"] == "enabled")
        {
            $petr1 = do_sqlquery("SELECT `units` FROM `{$TABLE_PREFIX}paypal_settings` WHERE `id`=1");
            if(@sql_num_rows($petr1) > 0)
            {
                $fied = $petr1->fetch_assoc();
                $currency = $fied["units"];
            }
        }
        if($currency == "")
        {
            $sign = (($btit_settings["dh_unit"] == "true")?"&#8364;":"&#36;");
            $sign_left = true;
            $sign_right = false;
        }
        else
        {
            if($currency == "AUD" || $currency == "CAD" || $currency == "HKD" || $currency == "NZD" || $currency == "SGD" || $currency == "USD")
            {
                $sign = "&#36;";
                $sign_left = true;
                $sign_right = false;
            }
            elseif($currency == "CZK")
            {
                $sign = "K&#269;";
                $sign_left = false;
                $sign_right = true;
            }
            elseif($currency == "DKK" || $currency == "NOK" || $currency == "SEK")
            {
                $sign = "kr";
                $sign_left = false;
                $sign_right = true;
            }
            elseif($currency == "EUR")
            {
                $sign = "&#8364;";
                $sign_left = true;
                $sign_right = false;
            }
            elseif($currency == "HUF")
            {
                $sign = "Ft";
                $sign_left = false;
                $sign_right = true;
            }
            elseif($currency == "ILS")
            {
                $sign = "&#8362;";
                $sign_left = true;
                $sign_right = false;
            }
            elseif($currency == "JPY")
            {
                $sign = "&#165;";
                $sign_left = true;
                $sign_right = false;
            }
            elseif($currency == "MXN")
            {
                $sign = "&#36;";
                $sign_left = false;
                $sign_right = true;
            }
            elseif($currency == "PLN")
            {
                $sign = "z&#322;";
                $sign_left = false;
                $sign_right = true;
            }
            elseif($currency == "GBP")
            {
                $sign = "&#163;";
                $sign_left = true;
                $sign_right = false;
            }
            elseif($currency == "CHF")
            {
                $sign = "CHF";
                $sign_left = false;
                $sign_right = true;
            }
            elseif($currency == "BRL")
            {
                $sign = "R&#36;";
                $sign_left = true;
                $sign_right = false;
            }
            elseif($currency == "MYR")
            {
                $sign = "RM";
                $sign_left = true;
                $sign_right = false;
            }
            elseif($currency == "PHP")
            {
                $sign = "&#8369;";
                $sign_left = true;
                $sign_right = false;
            }
            elseif($currency == "TWD")
            {
                $sign = "NT&#36;";
                $sign_left = true;
                $sign_right = false;
            }
            elseif($currency == "THB")
            {
                $sign = "&#3647;";
                $sign_left = true;
                $sign_right = false;
            }
        }
        $don = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}don_historie WHERE don_id ='$id'");
        $dh = $don->fetch_assoc();
        if($btit_settings["dh_unit"] == true)
            $unit = "&#8364;";
        elseif($btit_settings["dh_unit"] == false)
            $unit = "&#36;";
        $aa = ("<span style='color:steelblue'>".$language['AMOUNT']." : </span>".(($sign_left === true)?$sign:"").($dh["don_ation"]).(($sign_right === true)?$sign:"")."&nbsp;&nbsp; <span style='color:steelblue'>date : </span>".substr($dh['donate_date'], 8, -9)."-".substr($dh['donate_date'], 5, -12)."-".substr($dh['donate_date'], 0, 4));
        $bb = ("<br><span style='color:steelblue'>".$language['AMOUNT']." : </span>".(($sign_left === true)?$sign:"").($dh["don_ation_1"]).(($sign_right === true)?$sign:"")."&nbsp;&nbsp; <span style='color:steelblue'>".$language['DATE'].": </span>".substr($dh['donate_date_1'], 8, -9)."-".substr($dh['donate_date_1'], 5, -12)."-".substr($dh['donate_date_1'], 0, 4));
        $cc = ("<br><span style='color:steelblue'>".$language['AMOUNT']." : </span>".(($sign_left === true)?$sign:"").($dh["don_ation_2"]).(($sign_right === true)?$sign:"")."&nbsp;&nbsp; <span style='color:steelblue'>".$language['DATE'].": </span>".substr($dh['donate_date_2'], 8, -9)."-".substr($dh['donate_date_2'], 5, -12)."-".substr($dh['donate_date_2'], 0, 4));
        $dd = ("<br><span style='color:steelblue'>".$language['AMOUNT']." : </span>".(($sign_left === true)?$sign:"").($dh["don_ation_3"]).(($sign_right === true)?$sign:"")."&nbsp;&nbsp; <span style='color:steelblue'>".$language['DATE'].": </span>".substr($dh['donate_date_3'], 8, -9)."-".substr($dh['donate_date_3'], 5, -12)."-".substr($dh['donate_date_3'], 0, 4));
        $ee = ("<br><span style='color:steelblue'>".$language['AMOUNT']." : </span>".(($sign_left === true)?$sign:"").($dh["don_ation_4"]).(($sign_right === true)?$sign:"")."&nbsp;&nbsp; <span style='color:steelblue'>".$language['DATE'].": </span>".substr($dh['donate_date_4'], 8, -9)."-".substr($dh['donate_date_4'], 5, -12)."-".substr($dh['donate_date_4'], 0, 4));
        $ff = ("<br><span style='color:steelblue'>".$language['AMOUNT']." : </span>".(($sign_left === true)?$sign:"").($dh["don_ation_5"]).(($sign_right === true)?$sign:"")."&nbsp;&nbsp; <span style='color:steelblue'>".$language['DATE'].": </span>".substr($dh['donate_date_5'], 8, -9)."-".substr($dh['donate_date_5'], 5, -12)."-".substr($dh['donate_date_5'], 0, 4));
        $gg = ("<br><span style='color:steelblue'>".$language['AMOUNT']." : </span>".(($sign_left === true)?$sign:"").($dh["don_ation_6"]).(($sign_right === true)?$sign:"")."&nbsp;&nbsp; <span style='color:steelblue'>".$language['DATE'].": </span>".substr($dh['donate_date_6'], 8, -9)."-".substr($dh['donate_date_6'], 5, -12)."-".substr($dh['donate_date_6'], 0, 4));
        $hh = ("<br><span style='color:steelblue'>".$language['AMOUNT']." : </span>".(($sign_left === true)?$sign:"").($dh["don_ation_7"]).(($sign_right === true)?$sign:"")."&nbsp;&nbsp; <span style='color:steelblue'>".$language['DATE'].": </span>".substr($dh['donate_date_7'], 8, -9)."-".substr($dh['donate_date_7'], 5, -12)."-".substr($dh['donate_date_7'], 0, 4));
        $ii = ("<br><span style='color:steelblue'>".$language['AMOUNT']." : </span>".(($sign_left === true)?$sign:"").($dh["don_ation_8"]).(($sign_right === true)?$sign:"")."&nbsp;&nbsp; <span style='color:steelblue'>".$language['DATE'].": </span>".substr($dh['donate_date_8'], 8, -9)."-".substr($dh['donate_date_8'], 5, -12)."-".substr($dh['donate_date_8'], 0, 4));
        $jj = ("<br><span style='color:steelblue'>".$language['AMOUNT']." : </span>".(($sign_left === true)?$sign:"").($dh["don_ation_9"]).(($sign_right === true)?$sign:"")."&nbsp;&nbsp; <span style='color:steelblue'>".$language['DATE'].": </span>".substr($dh['donate_date_9'], 8, -9)."-".substr($dh['donate_date_9'], 5, -12)."-".substr($dh['donate_date_9'], 0, 4));
        $kk = ("<br><span style='color:steelblue'>".$language['AMOUNT']." : </span>".(($sign_left === true)?$sign:"").($dh["don_ation_10"]).(($sign_right === true)?$sign:"")."&nbsp;&nbsp; <span style='color:steelblue'>".$language['DATE'].": </span>".substr($dh['donate_date_10'], 8, -9)."-".substr($dh['donate_date_10'], 5, -12)."-".substr($dh['donate_date_10'], 0, 4));
        if(empty($dh["don_ation"]))
            $userdetailarr["donations"] = $language['NO_DON_HIST'];
        elseif(empty($dh["don_ation_1"]))
            $userdetailarr["donations"] = $aa;
        elseif(empty($dh["don_ation_2"]))
        {
            $don = ($aa.$bb);
            $userdetailarr["donations"] =  $don;
        }
        elseif(empty($dh["don_ation_3"]))
        {
            $don = ($aa.$bb.$cc);
            $userdetailarr["donations"] = $don;
        }
        elseif(empty($dh["don_ation_4"]))
        {
            $don = ($aa.$bb.$cc.$dd);
            $userdetailarr["donations"] = $don;
        }
        elseif(empty($dh["don_ation_5"]))
        {
            $don = ($aa.$bb.$cc.$dd.$ee);
            $userdetailarr["donations"] = $don;
        }
        elseif(empty($dh["don_ation_6"]))
        {
            $don = ($aa.$bb.$cc.$dd.$ee.$ff);
            $userdetailarr["donations"] = $don;
        }
        elseif(empty($dh["don_ation_7"]))
        {
            $don = ($aa.$bb.$cc.$dd.$ee.$ff.$gg);
            $userdetailarr["donations"] = $don;
        }
        elseif(empty($dh["don_ation_8"]))
        {
            $don = ($aa.$bb.$cc.$dd.$ee.$ff.$gg.$hh);
            $userdetailarr["donations"] = $don;
        }
        elseif(empty($dh["don_ation_9"]))
        {
            $don = ($aa.$bb.$cc.$dd.$ee.$ff.$gg.$hh.$ii);
            $userdetailarr["donations"] = $don;
        }
        elseif(empty($dh["don_ation_10"]))
        {
            $don = ($aa.$bb.$cc.$dd.$ee.$ff.$gg.$hh.$ii.$jj);
            $userdetailarr["donations"] = $don;
        }
    }
    // <-- Donation History by DiemThuy
    $userdetailarr["userdetail_last_ip"] = $row["cip"];
    if($btit_settings["fmhack_show_members_whois_record_on_userdetails"] == "enabled")
    {
        // Start - Whois check by Petr1fied
        include_once ("whois/whois.main.php");
        $whois = new Whois();
        $result = $whois->Lookup($row["cip"]);
        $output = "<pre>";
        $i = 0;
        while($i < count($result["rawdata"]))
        {
            $i++;
            $output .= $result["rawdata"][$i]."<br />";
        }
        $output .= "</pre>";
        $userdetailarr["userdetail_whois"] = $output;
        // End - Whois check by Petr1fied
    }
    $userdetailarr["userdetail_level_admin"] = (($btit_settings["fmhack_group_colours_overall"] == "enabled")?unesc($row["prefixcolor"].$row["level"].$row["suffixcolor"]):($row["level"]));
    $userdetailarr["userdetail_colspan"] = "2";
}
else
{
    $userdetailarr["userdetail_level"] = (($btit_settings["fmhack_group_colours_overall"] == "enabled")?unesc($row["prefixcolor"].$row["level"].$row["suffixcolor"]):($row["level"]));
    $userdetailarr["userdetail_colspan"] = "0";
}
$userdetailarr["userdetail_joined"] = ($row["joined"] == 0?"N/A":get_date_time($row["joined"]));
$userdetailtpl->set("custom_title_enabled", false, true);
if($btit_settings["fmhack_custom_title"] == "enabled")
{
    $userdetailtpl->set("custom_title_enabled", true, true);
    $userdetailarr["custom_title"] = (!$row["custom_title"]?"":unesc($row["custom_title"]));
}
$userdetailtpl->set("aads_enabled", (($btit_settings["fmhack_advanced_auto_donation_system"] == "enabled")?true:false), true);
if($btit_settings["fmhack_advanced_auto_donation_system"] == "enabled")
{
    $userdetailarr["timed_rank_header"] = ($row["rank_switch"] == "no"?"":"<tr><td class=header>".$language['AADS_TRE']."</td>");
    $userdetailarr["timed_rank_title"] = ($row["rank_switch"] == "no"?"":"<td class=lista ".(($row["avatar"] && $row["avatar"] != "")?" colspan=\"2\"":"")."><span style=\"color:red\"><b>".unesc($row["timed_rank"]."</b></span></td></tr>"));
}
$userdetailarr["userdetail_lastaccess"] = ($row["lastconnect"] == 0?"N/A":get_date_time($row["lastconnect"]));
$userdetailarr["userdetail_country"] = ($row["flag"] == 0?"":unesc($row['name']))."&nbsp;&nbsp;<img src=\"images/flag/".(!$row["flagpic"] || $row["flagpic"] == ""?"unknown.gif":$row["flagpic"])."\" alt=\"".($row["flag"] == 0?"unknown":unesc($row['name']))."\" />";
$userdetailtpl->set("hos_enabled", (($btit_settings["fmhack_hide_online_status"] == "enabled" && ($CURUSER["see_hidden"] == "yes" || ($CURUSER["uid"] == $id && $CURUSER["can_hide"] == "yes")))?true:false), true);
if($btit_settings["fmhack_hide_online_status"] == "enabled" && ($CURUSER["see_hidden"] == "yes" || ($CURUSER["uid"] == $id && $CURUSER["can_hide"] == "yes")))
    $userdetailarr["userdetail_invisible"] = (($row["invisible"] == "yes")?$language["YES"]:$language["NO"]);
$userdetailarr["userdetail_local_time"] = (date("d/m/Y H:i:s", time() - $offset)."&nbsp;(GMT".($row["time_offset"] > 0?" +".$row["time_offset"]:($row["time_offset"] == 0?"":" ".$row["time_offset"])).")");
$userdetailarr["userdetail_downloaded"] = makesize($row["downloaded"]);
$userdetailarr["userdetail_uploaded"] = makesize($row["uploaded"]);
$userdetailarr["userdetail_ratio"] = $ratio;
if($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")
    $userdetailarr["userdetail_hnr"] = $row["hnr_count"];
$userdetailtpl->set("bonus_system_enabled", (($btit_settings["fmhack_bonus_system"] == "enabled")?true:false), true);
if($btit_settings["fmhack_bonus_system"] == "enabled")
    $userdetailarr["userdetail_bonus"] = number_format($row["seedbonus"], 2);
$userdetailtpl->set("signature_enabled", (($btit_settings["fmhack_signature_on_internal_forum"] == "enabled")?true:false), true);
if($btit_settings["fmhack_signature_on_internal_forum"] == "enabled")
    $userdetailarr["userdetail_signature"] = format_comment($row["signature"]);
$userdetailtpl->set("userdetail_forum_internal", ($GLOBALS["FORUMLINK"] == '' || $GLOBALS["FORUMLINK"] == 'internal' || substr($GLOBALS["FORUMLINK"], 0, 3) == 'smf' || $GLOBALS["FORUMLINK"] == 'ipb'), true);
$userdetailtpl->set("torrlim_enabled", (($btit_settings["fmhack_torrents_limit"] == "enabled")?true:false), true);
if($btit_settings["fmhack_torrents_limit"] == "enabled")
{
    if($XBTT_USE)
        $userdetailarr["torrents_limit"] = $row["torrents_limit"];
    else
    {
        if($row["custom_torr_limit"] == "yes")
            $userdetailarr["torrents_limit"] = $row["php_cust_torr_limit"];
        else
            $userdetailarr["torrents_limit"] = $row["torrents_limit"];
    }
    $userdetailtpl->set("tlimit_access", (($CURUSER["edit_users"] == "yes" && $id != $CURUSER["uid"] && $rankOverOrEqual)?true:false), true);

}
$userdetailtpl->set("waittime_enabled", (($btit_settings["fmhack_enhanced_wait_time"] == "enabled")?true:false), true);
if($btit_settings["fmhack_enhanced_wait_time"] == "enabled")
{
    if($XBTT_USE)
        $userdetailarr["wait_time"] = ($row["wait_time"] / 3600);
    else
    {
        if($row["custom_wait_time"] == "yes")
            $userdetailarr["wait_time"] = $row["php_cust_wait_time"];
        else
            $userdetailarr["wait_time"] = $row["WT"];
    }
    $userdetailtpl->set("waittime_access", (($CURUSER["edit_users"] == "yes" && $id != $CURUSER["uid"] && $rankOverOrEqual)?true:false), true);
}
// Only show if forum is internal
if($GLOBALS["FORUMLINK"] == '' || $GLOBALS["FORUMLINK"] == 'internal')
{
    $sql = get_result("SELECT count(*) as tp FROM {$TABLE_PREFIX}posts p INNER JOIN {$TABLE_PREFIX}users u ON p.userid = u.id WHERE u.id = ".$id, true, $btit_settings['cache_duration']);
    $posts = $sql[0]['tp'];
    unset($sql);
    $memberdays = max(1, round((time() - $row['joined']) / 86400));
    $posts_per_day = number_format(round($posts / $memberdays, 2), 2);
    $userdetailarr["userdetail_forum_posts"] = $posts." &nbsp; [".sprintf($language["POSTS_PER_DAY"], $posts_per_day)."]";
}
elseif(substr($GLOBALS["FORUMLINK"], 0, 3) == "smf")
{
    $forum = get_result("SELECT `date".(($GLOBALS["FORUMLINK"] == "smf")?"R":"_r")."egistered`, `posts` FROM `{$db_prefix}members` WHERE ".(($GLOBALS["FORUMLINK"] == "smf")?"`ID_MEMBER`":"`id_member`")."=".$row["smf_fid"], true, $btit_settings['cache_duration']);
    $forum = $forum[0];
    $memberdays = max(1, round((time() - (($GLOBALS["FORUMLINK"] == "smf")?$forum["dateRegistered"]:$forum["date_registered"])) / 86400));
    $posts_per_day = number_format(round($forum["posts"] / $memberdays, 2), 2);
    $userdetailarr["userdetail_forum_posts"] = $forum["posts"]." &nbsp; [".sprintf($language["POSTS_PER_DAY"], $posts_per_day)."]";
    unset($forum);
}
elseif($GLOBALS["FORUMLINK"] == "ipb")
{
    $forum = get_result("SELECT `joined`, `posts` FROM `{$ipb_prefix}members` WHERE `member_id`=".$row["ipb_fid"], true, $btit_settings['cache_duration']);
    $forum = $forum[0];
    $memberdays = max(1, round((time() - $forum["joined"]) / 86400));
    $posts_per_day = number_format(round($forum["posts"] / $memberdays, 2), 2);
    $userdetailarr["userdetail_forum_posts"] = $forum["posts"]." &nbsp; [".sprintf($language["POSTS_PER_DAY"], $posts_per_day)."]";
    unset($forum);
}
//booted
$userdetailtpl->set("booted_enabled", (($btit_settings["fmhack_booted"] == "enabled")?true:false), true);
if($btit_settings["fmhack_booted"] == "enabled")
{
    $userdetailtpl->set("booted_access", (($row["booted"] == "yes" && $CURUSER["can_boot"] == "yes" && $rankOverOrEqual && $CURUSER["uid"]!=$id)?true:false), true);
    $userdetailarr["whybooted"] = (!$row["whybooted"]?"":unesc($row["whybooted"]));
    $userdetailarr["addbooted"] = (!$row["addbooted"]?"":unesc($row["addbooted"]));
    $userdetailarr["whobooted"] = (!$row["whobooted"]?"":(($btit_settings["fmhack_group_colours_overall"] == "enabled")?unesc($row["booted_prefixcolor"].$row["whobooted"].$row["booted_suffixcolor"]):unesc($row["whobooted"])));
    $userdetailtpl->set("rebooted_access", (($row["booted"] == "yes")?true:false), true);
    $userdetailtpl->set("adminrebooted_access", (($CURUSER["can_boot"] == "yes" && $rankOverOrEqual && $CURUSER["uid"]!=$id)?true:false), true);
    $userdetailtpl->set("nobooted_access", (($CURUSER["can_boot"] == "yes" && $rankOverOrEqual && $CURUSER["uid"]!=$id)?true:false), true);
    $userdetailtpl->set("booted0_access", (($row["booted"] == "no")?true:false), true);
    $userdetailarr["booted"] = ($row["booted"] = "yes"?"checked=\"checked\"":"");
    $userdetailarr["whybooted"] = $row["whybooted"];
}
else
{
    $userdetailtpl->set("booted_access", false, true);
    $userdetailtpl->set("rebooted_access", false, true);
    $userdetailtpl->set("adminrebooted_access", false, true);
    $userdetailtpl->set("nobooted_access", false, true);
    $userdetailtpl->set("booted0_access", false, true);
}
// <-- Booted
// Warn System -->
$userdetailtpl->set("warn_enabled", (($btit_settings["fmhack_warning_system"] == "enabled")?true:false), true);
$userdetailtpl->set("warn_enabled2", (($btit_settings["fmhack_warning_system"] == "enabled")?true:false), true);
if($btit_settings["fmhack_warning_system"] == "enabled")
{
    $userdetailtpl->set("warn_access", (($row["warn_lev"] > 0)?true:false), true);
    $userdetailtpl->set("warn_edit_allowed_1", (($CURUSER["uid"] != $id && $rankOverOrEqual && $CURUSER["edit_users"] == "yes")?true:false), true);
    $userdetailtpl->set("warn_edit_allowed_2", (($CURUSER["uid"] != $id && $rankOverOrEqual && $CURUSER["edit_users"] == "yes")?true:false), true);
    $userdetailtpl->set("warn_log_allowed_1", (($CURUSER["uid"] == $id || ($rankOverOrEqual && $CURUSER["edit_users"] == "yes"))?true:false), true);
    $userdetailtpl->set("warn_log_allowed_2", (($CURUSER["uid"] == $id || ($rankOverOrEqual && $CURUSER["edit_users"] == "yes"))?true:false), true);
    $userdetailtpl->set("warn_dec_allowed_1", (($row["warn_lev"] > 0)?true:false), true);
    $userdetailtpl->set("warn_dec_allowed_2", (($row["warn_lev"] > 0)?true:false), true);
    $userdetailtpl->set("warn_inc_allowed_1", (($row["warn_lev"] < $btit_settings["warn_max"])?true:false), true);
    $userdetailtpl->set("warn_inc_allowed_2", (($row["warn_lev"] < $btit_settings["warn_max"])?true:false), true);
    $stage4=$btit_settings["warn_max"];
    $stage3=round($btit_settings["warn_max"]*0.75);
    $stage2=round($btit_settings["warn_max"]*0.5);
    $stage1=round($btit_settings["warn_max"]*0.25);
    $stage0=0;
    if($row["warn_lev"] >= $stage4)
        $userdetailarr["w_level"] = "<img src='images/warned/warn_max.png' alt='".$row["warn_lev"]."/".$stage4."' title='".$row["warn_lev"]."/".$stage4."' />";
    elseif($row["warn_lev"] >= $stage3)
        $userdetailarr["w_level"] = "<img src='images/warned/warn_3.png' alt='".$row["warn_lev"]."/".$stage4."' title='".$row["warn_lev"]."/".$stage4."' />";
    elseif($row["warn_lev"] >= $stage2)
        $userdetailarr["w_level"] = "<img src='images/warned/warn_2.png' alt='".$row["warn_lev"]."/".$stage4."' title='".$row["warn_lev"]."/".$stage4."' />";
    elseif($row["warn_lev"] >= $stage1)
        $userdetailarr["w_level"] = "<img src='images/warned/warn_1.png' alt='".$row["warn_lev"]."/".$stage4."' title='".$row["warn_lev"]."/".$stage4."' />";
    else
        $userdetailarr["w_level"] = "<img src='images/warned/warn_0.png' alt='".$row["warn_lev"]."/".$stage4."' title='".$row["warn_lev"]."/".$stage4."' />";
}
else
{
    $userdetailtpl->set("warn_access", false, true);
    $userdetailtpl->set("rewarn_access", false, true);
    $userdetailtpl->set("adminwarn_access", false, true);
    $userdetailtpl->set("nowarn_access", false, true);
    $userdetailtpl->set("warns_access", false, true);
}
// <-- Warn System
$query3_where = "";
$query3_select = "";
$query3_join = "";
if($btit_settings["fmhack_torrent_moderation"] == "enabled")
{
    if($btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes")
    {
        $query3_select .= "`u2`.`username` `approved_by`,";
        $query3_join .= "LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `f`.`approved_by`=`u2`.`id` ";
    }
    if($CURUSER["moderate_trusted"] != "yes")
    {
        if($CURUSER["uid"] != $id)
            $query3_where .= "AND `f`.`moder`='ok' ";
    }
}
if($btit_settings["fmhack_teams"] == "enabled")
{
    $query3_select .= "`t`.`name` `teamname`, `t`.`id` `teamsid`, `t`.`image` `teamimage`, `f`.`team`,";
    $query3_join .= "LEFT JOIN `{$TABLE_PREFIX}teams` `t` ON `f`.`team` = `t`.`id` ";
    if($btit_settings["team_state"] == "private")
    {
        $query3_where .= "AND (".$CURUSER['team']." = f.team OR f.team = 0 OR '".$CURUSER['all_teams']."'='yes' OR '".$CURUSER['sel_team']."'=`f`.`team`) ";
    }
}
if($btit_settings["fmhack_SEO_panel"] == "enabled")
{
    $query3_select .= "`f`.`id` `seoid`,";
}
if($btit_settings["fmhack_view_peer_details"] == "enabled" && $CURUSER["view_userdetails_torrents"] == "no" && $CURUSER["uid"] != $id)
    $numtorrent = 0;
else
{
    $resuploaded = get_result("SELECT count(*) as tf FROM {$TABLE_PREFIX}files f WHERE uploader=$id AND f.anonymous = \"false\" ".$query3_where." ORDER BY data DESC", true, $btit_settings['cache_duration']);
    $numtorrent = $resuploaded[0]['tf'];
    unset($resuploaded);
}
$userdetailarr["pagertop"] = "";
if($numtorrent > 0)
{
    list($pagertop, $pagerbottom, $limit) = pager(($utorrents == 0?15:$utorrents), $numtorrent, $_SERVER["PHP_SELF"]."?page=userdetails&amp;id=$id&amp;pagename=uploaded&amp;".(($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?"ordup=".(int)0+$_GET["ordup"]."&amp;dirup=".(int)0+$_GET["dirup"]."&amp;ordac=".(int)0+$_GET["ordac"]."&amp;dirac=".(int)0+$_GET["dirac"]."&amp;ordhi=".(int)0+$_GET["ordhi"]."&amp;dirhi=".(int)0+$_GET["dirhi"]."&amp;":""), array("pagename" => "uploaded"));
    $userdetailarr["pagertop"] = $pagertop;
    $orderBy = "`f`.`data`";
    $direction = "DESC";
    $userdetailtpl->set("upsort1", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("upsort2", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("upsort3", false, true);
    $userdetailtpl->set("upsort4", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("upsort5", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("upsort6", false, true);
    $userdetailtpl->set("upsort7", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("upsort8", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("upsort9", false, true);
    $userdetailtpl->set("upsort10", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("upsort11", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("upsort12", false, true);
    $userdetailtpl->set("upsort13", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("upsort14", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("upsort15", false, true);
    $userdetailtpl->set("upsort16", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("upsort17", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("upsort18", false, true);
    if($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")
    {
        $ordup = (isset($_GET["ordup"]) && !empty($_GET["ordup"]) && $_GET["ordup"] >= 1 && $_GET["ordup"] <= 6)?(int)0 + $_GET["ordup"]:false;
        $dirup = (isset($_GET["dirup"]) && !empty($_GET["dirup"]) && $_GET["dirup"] >= 1 && $_GET["dirup"] <= 2)?(int)0 + $_GET["dirup"]:false;
        $udupsorturl1 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordup=1&amp;dirup=";
        $udupsorturl2 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordup=2&amp;dirup=";
        $udupsorturl3 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordup=3&amp;dirup=";
        $udupsorturl4 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordup=4&amp;dirup=";
        $udupsorturl5 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordup=5&amp;dirup=";
        $udupsorturl6 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordup=6&amp;dirup=";
        switch($ordup)
        {
            case 1:
            $orderBy = "`f`.`filename`";
            $userdetailtpl->set("upsort3", true, true);
            break;
            case 3:
            $orderBy = "`f`.`size`";
            $userdetailtpl->set("upsort9", true, true);
            break;
            case 4:
            $orderBy = (($XBTT_USE)?"`x`.`seeders`":"`f`.`seeds`");
            $userdetailtpl->set("upsort12", true, true);
            break;
            case 5:
            $orderBy = (($XBTT_USE)?"`x`":"`f`").".`leechers`";
            $userdetailtpl->set("upsort15", true, true);
            break;
            case 6:
            $orderBy = (($XBTT_USE)?"`x`.`completed`":"`f`.`finished`");
            $userdetailtpl->set("upsort18", true, true);
            break;
            case 2:
            default:
            $orderBy = "`f`.`data`";
            $userdetailtpl->set("upsort6", true, true);
            break;
        }
        switch($dirup)
        {
            case 2:
            $direction = "ASC";
            $udupsorturl .= "&amp;dirup=1";
            $userdetailarr["uarrow"] = "&nbsp;&uarr;";
            $userdetailarr["udupsorturl1"] = $udupsorturl1 .= "1";
            $userdetailarr["udupsorturl2"] = $udupsorturl2 .= "1";
            $userdetailarr["udupsorturl3"] = $udupsorturl3 .= "1";
            $userdetailarr["udupsorturl4"] = $udupsorturl4 .= "1";
            $userdetailarr["udupsorturl5"] = $udupsorturl5 .= "1";
            $userdetailarr["udupsorturl6"] = $udupsorturl6 .= "1";
            break;
            case 1:
            default:
            $direction = "DESC";
            $udupsorturl .= "&amp;dirup=2";
            $userdetailarr["uarrow"] = "&nbsp;&darr;";
            $userdetailarr["udupsorturl1"] = $udupsorturl1 .= "2";
            $userdetailarr["udupsorturl2"] = $udupsorturl2 .= "2";
            $userdetailarr["udupsorturl3"] = $udupsorturl3 .= "2";
            $userdetailarr["udupsorturl4"] = $udupsorturl4 .= "2";
            $userdetailarr["udupsorturl5"] = $udupsorturl5 .= "2";
            $userdetailarr["udupsorturl6"] = $udupsorturl6 .= "2";
            break;
        }
    }
    $resuploaded = get_result("SELECT ".$query3_select." `f`.`info_hash`, `f`.`filename`, UNIX_TIMESTAMP(`f`.`data`) `added`, `f`.`size`, ".$tseeds." `seeds`, ".$tleechs." `leechers`, ".$tcompletes." `finished` FROM ".$ttables." ".$query3_join." WHERE `f`.`uploader`=".$id." AND `f`.`anonymous` = 'false' ".$query3_where." ORDER BY ".$orderBy." ".$direction." ".$limit, true, $btit_settings["cache_duration"]);
}
else
{
    $userdetailtpl->set("upsort1", false, true);
    $userdetailtpl->set("upsort2", false, true);
    $userdetailtpl->set("upsort3", false, true);
    $userdetailtpl->set("upsort4", false, true);
    $userdetailtpl->set("upsort5", false, true);
    $userdetailtpl->set("upsort6", false, true);
    $userdetailtpl->set("upsort7", false, true);
    $userdetailtpl->set("upsort8", false, true);
    $userdetailtpl->set("upsort9", false, true);
    $userdetailtpl->set("upsort10", false, true);
    $userdetailtpl->set("upsort11", false, true);
    $userdetailtpl->set("upsort12", false, true);
    $userdetailtpl->set("upsort13", false, true);
    $userdetailtpl->set("upsort14", false, true);
    $userdetailtpl->set("upsort15", false, true);
    $userdetailtpl->set("upsort16", false, true);
    $userdetailtpl->set("upsort17", false, true);
    $userdetailtpl->set("upsort18", false, true);
}
if($resuploaded && $numtorrent > 0)
{
    $userdetailtpl->set("RESULTS", true, true);
    $uptortpl = array();
    $i = 0;
    foreach($resuploaded as $ud_id => $rest)
    {
        $rest["filename"] = unesc($rest["filename"]);
        $filename = cut_string($rest["filename"], intval($btit_settings["cut_name"]));
        if($btit_settings["fmhack_teams"] == "enabled")
        {
            $fteam = $rest["team"];
            if(isset($fteam) && !empty($fteam))
                $team = "<a href='index.php?page=teaminfo&team=".$rest["teamsid"]."&action=view'><img src='".$rest["teamimage"]."' border='0' title='".$rest["teamname"]."' style='width:25px;'></a>";
            else
                $team = "";
        }
        if($GLOBALS["usepopup"])
        {
            if($btit_settings["fmhack_torrent_moderation"] == "enabled")
            {
                $moder = getmoderstatusbyhash($rest['info_hash']);

                $uptortpl[$i]["moder"] = "<a title=\"".$moder["moder"].(($btit_settings["mod_app_sa"]=="yes" && $CURUSER["admin_access"]=="yes" && $moder["username"]!=$language["SYSTEM_USER"] && $moder["moder"]!="um")?(($moder["moder"]=="ok")?" (".$language["TMOD_APPROVED_BY"]." ".$moder["username"].")":" (".$language["TMOD_REJECTED_BY"]." ".$moder["username"].")"):"")."\" href=\"index.php?page=edit&info_hash=".$rest["info_hash"]."\">".(($moder["moder"]=="ok")?"<button class='btn btn-labeled btn-success' type='button'><span class='btn-label'><i class='fa fa-thumbs-up'></i></span>Approved</button>":"<button class='btn btn-labeled btn-danger' type='button'><span class='btn-label'><i class='fa fa-thumbs-down'></i></span>Denied</button>")."</a>";
            }
            $uptortpl[$i]["filename"] = "<a href=\"javascript:popdetails('".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated"] == "true")?strtr($rest["filename"], $res_seo["str"], $res_seo["strto"])."-".$rest["seoid"].".html":"index.php?page=torrent-details&id=".$rest["info_hash"])."')\" title=\"".$language["VIEW_DETAILS"].": ".$rest["filename"].(($btit_settings["fmhack_torrent_moderation"] == "enabled" && $btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes" && $rest["approved_by"] != $language["SYSTEM_USER"])?" (".$language["TMOD_APPROVED_BY"]." ".$rest["approved_by"].")":"")."\">".$filename."</a>".(($btit_settings["fmhack_teams"] == "enabled" && $team != "")?"&nbsp;".$team."&nbsp;":"");
            $uptortpl[$i]["added"] = date("d/m/Y", $rest["added"] - $offset);
            $uptortpl[$i]["size"] = makesize($rest["size"]);
            $uptortpl[$i]["seedcolor"] = linkcolor($rest["seeds"]);
            $uptortpl[$i]["seeds"] = "<a href=\"javascript:poppeer('index.php?page=peers&amp;id=".$rest["info_hash"]."')\">".$rest["seeds"]."</a>";
            $uptortpl[$i]["leechcolor"] = linkcolor($rest["leechers"]);
            $uptortpl[$i]["leechs"] = "<a href=\"javascript:poppeer('index.php?page=peers&amp;id=".$rest["info_hash"]."')\">".$rest["leechers"]."</a>";
            if($rest["finished"] > 0)
                $uptortpl[$i]["completed"] = "<a href=\"javascript:poppeer('index.php?page=torrent_history&amp;id=".$rest["info_hash"]."')\">".$rest["finished"]."</a>";
            else
                $uptortpl[$i]["completed"] = "---";
            $i++;
        }
        else
        {
            if($btit_settings["fmhack_torrent_moderation"] == "enabled")
            {
                $moder = getmoderstatusbyhash($rest['info_hash']);

                $uptortpl[$i]["moder"] = "<a title=\"".$moder["moder"].(($btit_settings["mod_app_sa"]=="yes" && $CURUSER["admin_access"]=="yes" && $moder["username"]!=$language["SYSTEM_USER"] && $moder["moder"]!="um")?(($moder["moder"]=="ok")?" (".$language["TMOD_APPROVED_BY"]." ".$moder["username"].")":" (".$language["TMOD_REJECTED_BY"]." ".$moder["username"].")"):"")."\" href=\"index.php?page=edit&info_hash=".$rest["info_hash"]."\">".(($moder["moder"]=="ok")?"<button class='btn btn-labeled btn-success' type='button'><span class='btn-label'><i class='fa fa-thumbs-up'></i></span>Approved</button>":"<button class='btn btn-labeled btn-danger' type='button'><span class='btn-label'><i class='fa fa-thumbs-down'></i></span>Denied</button>")."</a>";
            }
            $uptortpl[$i]["filename"] = "<a href=\"".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated"] == "true")?strtr($rest["filename"], $res_seo["str"], $res_seo["strto"])."-".$rest["seoid"].".html":"index.php?page=torrent-details&id=".$rest["info_hash"])."\" title=\"".$language["VIEW_DETAILS"].": ".$rest["filename"].(($btit_settings["fmhack_torrent_moderation"] == "enabled" && $btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes" && $rest["approved_by"] != $language["SYSTEM_USER"])?" (".$language["TMOD_APPROVED_BY"]." ".$rest["approved_by"].")":"")."\">".$filename."</a>".(($btit_settings["fmhack_teams"] == "enabled" && $team != "")?"&nbsp;".$team."&nbsp;":"");
            $uptortpl[$i]["added"] = date("d/m/Y", $rest["added"] - $offset);
            $uptortpl[$i]["size"] = makesize($rest["size"]);
            $uptortpl[$i]["seedcolor"] = linkcolor($rest["seeds"]);
            $uptortpl[$i]["seeds"] = "<a href=\"index.php?page=peers&amp;id=".$rest{"info_hash"}."\">".$rest["seeds"]."</a>";
            $uptortpl[$i]["leechcolor"] = linkcolor($rest["leechers"]);
            $uptortpl[$i]["leechs"] = "<a href=\"index.php?page=peers&amp;id=".$rest{"info_hash"}."\">".$rest["leechers"]."</a>";
            if($rest["finished"] > 0)
                $uptortpl[$i]["completed"] = "<a href=\"index.php?page=torrent_history&amp;id=".$rest["info_hash"]."\">".$rest["finished"]."</a>";
            else
                $uptortpl[$i]["completed"] = "---";
            $i++;
        }
    }
    $userdetailtpl->set("uptor", $uptortpl);
}
else
{
    $userdetailtpl->set("RESULTS", false, true);
}
$query4_select = "";
$query4_join = "";
$query4_where = "";
if($btit_settings["fmhack_torrent_moderation"] == "enabled" || $btit_settings["fmhack_teams"] == "enabled")
{
    if($XBTT_USE)
        $query4_join .= "INNER JOIN `xbt_files` `xf` ON `xfu`.`fid`=`xf`.`fid` INNER JOIN `{$TABLE_PREFIX}files` `f` ON `xf`.`info_hash`=`f`.`bin_hash`";
}
if($btit_settings["fmhack_torrent_moderation"] == "enabled")
{
    if($btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes")
    {
        $query4_select .= "`u2`.`username` `approved_by`,";
        $query4_join .= "LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `f`.`approved_by`=`u2`.`id` ";
    }
    if($CURUSER["moderate_trusted"] != "yes")
        $query4_where .= "AND `f`.`moder`='ok'";
}
if($btit_settings["fmhack_teams"] == "enabled")
{
    $query4_select = "`t`.`name` `teamname`, `t`.`id` `teamsid`, `t`.`image` `teamimage`, `f`.`team`,";
    $query4_join .= "LEFT JOIN `{$TABLE_PREFIX}teams` `t` ON `f`.`team` = `t`.`id` ";
    if($btit_settings["team_state"] == "private")
    {
        $query4_where .= "AND (".$CURUSER['team']." = f.team OR f.team = 0 OR '".$CURUSER['all_teams']."'='yes' OR '".$CURUSER['sel_team']."'=`f`.`team`) ";
    }
}
if($btit_settings["fmhack_SEO_panel"] == "enabled")
{
    $query4_select .= "`f`.`id` `seoid`,";
}
if($btit_settings["fmhack_view_peer_details"] == "enabled" && $CURUSER["view_userdetails_torrents"] == "no" && $CURUSER["uid"] != $id)
    $anq[0]['tp'] = 0;
else
{
    if($XBTT_USE)
        $anq = get_result("SELECT count(*) `tp` FROM `xbt_files_users` `xfu` ".$query4_join." WHERE `xfu`.`active`=1 AND `xfu`.`uid`=$id ".$query4_where, true, $btit_settings['cache_duration']);
    else
    {
        if($PRIVATE_ANNOUNCE)
            $anq = get_result("SELECT count(*) as tp FROM {$TABLE_PREFIX}peers p INNER JOIN {$TABLE_PREFIX}files f ON f.info_hash = p.infohash WHERE p.pid='".$row["pid"]."' ".$query4_where, true, $btit_settings['cache_duration']);
        else
            $anq = get_result("SELECT count(*) as tp FROM {$TABLE_PREFIX}peers p INNER JOIN {$TABLE_PREFIX}files f ON f.info_hash = p.infohash WHERE p.ip='".($row["cip"])."' ".$query4_where, true, $btit_settings['cache_duration']);
    }
}
$userdetailarr["pagertopact"] = "";
// active torrents
if($anq[0]['tp'] > 0)
{
    $userdetailtpl->set("RESULTS_1", true, true);
    $tortpl = array();
    $i = 0;
    list($pagertop, $pagerbottom, $limit) = pager(($utorrents == 0?15:$utorrents), $anq[0]['tp'], "index.php?page=userdetails&amp;id=$id&amp;pagename=active&amp;".(($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?"ordup=".(int)0+$_GET["ordup"]."&amp;dirup=".(int)0+$_GET["dirup"]."&amp;ordac=".(int)0+$_GET["ordac"]."&amp;dirac=".(int)0+$_GET["dirac"]."&amp;ordhi=".(int)0+$_GET["ordhi"]."&amp;dirhi=".(int)0+$_GET["dirhi"]."&amp;":""), array("pagename" => "active"));
    $userdetailarr["pagertopact"] = $pagertop;
    $orderBy = (($XBTT_USE)?"":"`p`.")."`status`";
    $direction = "DESC";
    $userdetailtpl->set("acsort1", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort2", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort3", false, true);
    $userdetailtpl->set("acsort4", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort5", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort6", false, true);
    $userdetailtpl->set("acsort7", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort8", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort9", false, true);
    $userdetailtpl->set("acsort10", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort11", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort12", false, true);
    $userdetailtpl->set("acsort13", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort14", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort15", false, true);
    $userdetailtpl->set("acsort16", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort17", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort18", false, true);
    $userdetailtpl->set("acsort19", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort20", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort21", false, true);
    $userdetailtpl->set("acsort22", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort23", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort24", false, true);
    $userdetailtpl->set("acsort25", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort26", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort27", false, true);
    $userdetailtpl->set("acsort28", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && $btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort29", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && $btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort30", false, true);
    $userdetailtpl->set("acsort31", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && $btit_settings["fmhack_torrent_times"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort32", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && $btit_settings["fmhack_torrent_times"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort33", false, true);
    $userdetailtpl->set("acsort34", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && $btit_settings["fmhack_torrent_times"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort35", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && $btit_settings["fmhack_torrent_times"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort36", false, true);
    $userdetailtpl->set("acsort37", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && $btit_settings["fmhack_torrent_times"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort38", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && $btit_settings["fmhack_torrent_times"] == "enabled")?true:false), true);
    $userdetailtpl->set("acsort39", false, true);
    if($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")
    {
        $ordac = (isset($_GET["ordac"]) && !empty($_GET["ordac"]) && $_GET["ordac"] >= 1 && $_GET["ordac"] <= 13)?(int)0 + $_GET["ordac"]:false;
        $dirac = (isset($_GET["dirac"]) && !empty($_GET["dirac"]) && $_GET["dirac"] >= 1 && $_GET["dirac"] <= 2)?(int)0 + $_GET["dirac"]:false;
        $udacsorturl1 = "index.php?page=userdetails&id=".$id."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordac=1&amp;dirac=";
        $udacsorturl2 = "index.php?page=userdetails&id=".$id."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordac=2&amp;dirac=";
        $udacsorturl3 = "index.php?page=userdetails&id=".$id."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordac=3&amp;dirac=";
        $udacsorturl4 = "index.php?page=userdetails&id=".$id."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordac=4&amp;dirac=";
        $udacsorturl5 = "index.php?page=userdetails&id=".$id."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordac=5&amp;dirac=";
        $udacsorturl6 = "index.php?page=userdetails&id=".$id."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordac=6&amp;dirac=";
        $udacsorturl7 = "index.php?page=userdetails&id=".$id."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordac=7&amp;dirac=";
        $udacsorturl8 = "index.php?page=userdetails&id=".$id."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordac=8&amp;dirac=";
        $udacsorturl9 = "index.php?page=userdetails&id=".$id."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordac=9&amp;dirac=";
        $udacsorturl10 = "index.php?page=userdetails&id=".$id."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordac=10&amp;dirac=";
        $udacsorturl11 = "index.php?page=userdetails&id=".$id."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordac=11&amp;dirac=";
        $udacsorturl12 = "index.php?page=userdetails&id=".$id."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordac=12&amp;dirac=";
        $udacsorturl13 = "index.php?page=userdetails&id=".$id."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordac=13&amp;dirac=";
        switch($ordac)
        {
            case 1:
            $orderBy = "`f`.`filename`";
            $userdetailtpl->set("acsort3", true, true);
            break;
            case 2:
            $orderBy = "`f`.`size`";
            $userdetailtpl->set("acsort6", true, true);
            break;
            case 4:
            $orderBy = "`p`.`downloaded`";
            $userdetailtpl->set("acsort12", true, true);
            break;
            case 5:
            $orderBy = "`p`.`uploaded`";
            $userdetailtpl->set("acsort15", true, true);
            break;
            case 6:
            $orderBy = "(`p`.`uploaded`/`p`.`downloaded`)";
            $userdetailtpl->set("acsort18", true, true);
            break;
            case 7:
            $orderBy = (($XBTT_USE)?"`x`.`seeders`":"`f`.`seeds`");
            $userdetailtpl->set("acsort21", true, true);
            break;
            case 8:
            $orderBy = (($XBTT_USE)?"`x`":"`f`").".`leechers`";
            $userdetailtpl->set("acsort24", true, true);
            break;
            case 9:
            $orderBy = (($XBTT_USE)?"`x`.`completed`":"`f`.`finished`");
            $userdetailtpl->set("acsort27", true, true);
            break;
            case 10:
            if($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")
            {
                $orderBy = (($XBTT_USE)?"`p`.`seeding_time`":"`h`.`seed`");
                $userdetailtpl->set("acsort30", true, true);
            }
            break;

            case 11:
            if($btit_settings["fmhack_torrent_times"]=="enabled")
            {
                $orderBy = (($XBTT_USE)?"`p`":"`h`").".`started_time`";
                $userdetailtpl->set("acsort33", true, true);
            }
            break;
            case 12:
            if($btit_settings["fmhack_torrent_times"]=="enabled")
            {
                $orderBy = (($XBTT_USE)?"`p`":"`h`").".`completed_time`";
                $userdetailtpl->set("acsort36", true, true);
            }
            break;
            case 13:
            if($btit_settings["fmhack_torrent_times"]=="enabled")
            {
                $orderBy = (($XBTT_USE)?"`p`.`mtime`":"`h`.`date`");
                $userdetailtpl->set("acsort39", true, true);
            }
            break;
            case 3:
            default:
            $orderBy =(($XBTT_USE)?"":"`p`.")."`status`";
            $userdetailtpl->set("acsort9", true, true);
            break;
        }
        switch($dirac)
        {
            case 2:
            $direction = "ASC";
            $userdetailarr["uarrow2"] = "&nbsp;&uarr;";
            $userdetailarr["udacsorturl1"] = $udacsorturl1 .= "1";
            $userdetailarr["udacsorturl2"] = $udacsorturl2 .= "1";
            $userdetailarr["udacsorturl3"] = $udacsorturl3 .= "1";
            $userdetailarr["udacsorturl4"] = $udacsorturl4 .= "1";
            $userdetailarr["udacsorturl5"] = $udacsorturl5 .= "1";
            $userdetailarr["udacsorturl6"] = $udacsorturl6 .= "1";
            $userdetailarr["udacsorturl7"] = $udacsorturl7 .= "1";
            $userdetailarr["udacsorturl8"] = $udacsorturl8 .= "1";
            $userdetailarr["udacsorturl9"] = $udacsorturl9 .= "1";
            $userdetailarr["udacsorturl10"] = $udacsorturl10 .= "1";
            $userdetailarr["udacsorturl11"] = $udacsorturl11 .= "1";
            $userdetailarr["udacsorturl12"] = $udacsorturl12 .= "1";
            $userdetailarr["udacsorturl13"] = $udacsorturl13 .= "1";
            break;
            case 1:
            default:
            $direction = "DESC";
            $userdetailarr["uarrow2"] = "&nbsp;&darr;";
            $userdetailarr["udacsorturl1"] = $udacsorturl1 .= "2";
            $userdetailarr["udacsorturl2"] = $udacsorturl2 .= "2";
            $userdetailarr["udacsorturl3"] = $udacsorturl3 .= "2";
            $userdetailarr["udacsorturl4"] = $udacsorturl4 .= "2";
            $userdetailarr["udacsorturl5"] = $udacsorturl5 .= "2";
            $userdetailarr["udacsorturl6"] = $udacsorturl6 .= "2";
            $userdetailarr["udacsorturl7"] = $udacsorturl7 .= "2";
            $userdetailarr["udacsorturl8"] = $udacsorturl8 .= "2";
            $userdetailarr["udacsorturl9"] = $udacsorturl9 .= "2";
            $userdetailarr["udacsorturl10"] = $udacsorturl10 .= "2";
            $userdetailarr["udacsorturl11"] = $udacsorturl11 .= "2";
            $userdetailarr["udacsorturl12"] = $udacsorturl12 .= "2";
            $userdetailarr["udacsorturl13"] = $udacsorturl13 .= "2";
            break;
        }
    }
    if($XBTT_USE)
    {
        $query4_join = "";
        if($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")
            $query4_select .= "`p`.`seeding_time`,";
        if(($btit_settings["fmhack_torrent_moderation"] == "enabled" || $btit_settings["fmhack_teams"] == "enabled"))
        {
            if($btit_settings["fmhack_torrent_moderation"] == "enabled" && $btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes")
                $query4_join .= "LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `f`.`approved_by`=`u2`.`id` ";
            $query4_join .= "INNER JOIN `xbt_files` `xf` ON `p`.`fid`=`xf`.`fid` ";
        }
        if($btit_settings["fmhack_teams"] == "enabled")
            $query4_join .= "LEFT JOIN `{$TABLE_PREFIX}teams` `t` ON `f`.`team` = `t`.`id` ";
        if($btit_settings["fmhack_VIP_freeleech"] == "enabled" || $btit_settings["fmhack_torrent_times"]=="enabled")
        {
            $query4_select .= "`p`.`mtime`,";
        }
        if($btit_settings["fmhack_torrent_times"]=="enabled")
        {
            $query4_select .= "`p`.`completed_time`, `p`.`started_time`,";
        }
        $anq = get_result("SELECT ".$query4_select." INET_NTOA(`ipa`) as ip, f.info_hash as infohash, f.filename, f.size, IF(p.left=0,'seeder','leecher') as status, p.downloaded, p.uploaded, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished
            FROM xbt_files_users p INNER JOIN xbt_files x ON p.fid=x.fid INNER JOIN {$TABLE_PREFIX}files f ON f.bin_hash = x.info_hash ".$query4_join."
            WHERE p.uid=$id AND p.active=1 ".$query4_where." ORDER BY $orderBy $direction $limit", true, $btit_settings['cache_duration']);
    }
    else
    {
        if($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled" || $btit_settings["fmhack_torrent_times"]=="enabled")
        {
            if($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")
            {
                $query4_select .= "`h`.`seed` `seeding_time`,";
            }
            if($btit_settings["fmhack_torrent_times"] == "enabled")
            {
                $query4_select .= "`h`.`date` `mtime`, `h`.`completed_time`, `h`.`started_time`,";
            }
            $query4_join .= "LEFT JOIN `{$TABLE_PREFIX}history` `h` ON (`p`.`infohash`=`h`.`infohash` AND `h`.`uid`='".$id."') ";
        }
        if($PRIVATE_ANNOUNCE)
            $anq = get_result("SELECT ".$query4_select." p.ip, p.infohash, f.filename, f.size, p.status, p.downloaded, p.uploaded, f.seeds, f.leechers, f.finished
                FROM {$TABLE_PREFIX}peers p INNER JOIN {$TABLE_PREFIX}files f ON f.info_hash = p.infohash ".$query4_join."
                WHERE p.pid='".$row["pid"]."' ".$query4_where." ORDER BY $orderBy $direction $limit", true, $btit_settings['cache_duration']);
        else
            $anq = get_result("SELECT ".$query4_select." p.ip, p.infohash, f.filename, f.size, p.status, p.downloaded, p.uploaded, f.seeds, f.leechers, f.finished
                FROM {$TABLE_PREFIX}peers p INNER JOIN {$TABLE_PREFIX}files f ON f.info_hash = p.infohash ".$query4_join."
                WHERE p.ip='".($row["cip"])."' ".$query4_where." ORDER BY $orderBy $direction $limit", true, $btit_settings['cache_duration']);
    }
    foreach($anq as $torlist)
    {
        if($torlist['ip'] != "")
        {
            if($btit_settings["fmhack_VIP_freeleech"] == "enabled" && $XBTT_USE)
            {
                if($row["freeleech"] == "yes" && $torlist["mtime"] >= $row["vipfl_date"])
                    $torlist["downloaded"] = 0;
            }
            $torlist['filename'] = unesc($torlist['filename']);
            $filename = cut_string($torlist['filename'], intval($btit_settings["cut_name"]));
            if($btit_settings["fmhack_teams"] == "enabled")
            {
                $fteam = $torlist["team"];
                if(isset($fteam) && !empty($fteam))
                    $team = "<a href='index.php?page=teaminfo&team=".$torlist["teamsid"]."&action=view'><img src='".$torlist["teamimage"]."' border='0' title='".$torlist["teamname"]."' style='width:25px;'></a>";
                else
                    $team = "";
            }
            if($GLOBALS["usepopup"])
            {
                if($btit_settings["fmhack_torrent_times"]=="enabled")
                {
                    $tortpl[$i]["mtime"]=date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["mtime"]);
                    $tortpl[$i]["completed_time"]=(($torlist["completed_time"]==-1)?$language["NA"]:date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["completed_time"]));
                    $tortpl[$i]["started_time"]=(($torlist["started_time"]==-1)?$language["NA"]:date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["started_time"]));
                }
                if($btit_settings["fmhack_torrent_moderation"] == "enabled")
                {
                    $tortpl[$i]["moder"] = getmoderdetails(getmoderstatusbyhash($torlist["infohash"]), $torlist["infohash"]);
                }
                $tortpl[$i]["filename"] = "<a href=\"javascript:popdetails('".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated"] == "true")?strtr($torlist["filename"], $res_seo["str"], $res_seo["strto"])."-".$torlist["seoid"].".html":"index.php?page=torrent-details&id=".$torlist["infohash"])."')\" title=\"".$language["VIEW_DETAILS"].": ".$torlist['filename'].(($btit_settings["fmhack_torrent_moderation"] == "enabled" && $btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes" && $torlist["approved_by"] != $language["SYSTEM_USER"])?" (".$language["TMOD_APPROVED_BY"]." ".$torlist["approved_by"].")":"")."\">".$filename."</a>".(($btit_settings["fmhack_teams"] == "enabled" && $team != "")?"&nbsp;".$team."&nbsp;":"");
                $tortpl[$i]["size"] = makesize($torlist['size']);
                $tortpl[$i]["status"] = unesc($torlist['status']);
                $tortpl[$i]["downloaded"] = makesize($torlist['downloaded']);
                $tortpl[$i]["uploaded"] = makesize($torlist['uploaded']);
                if($torlist['downloaded'] > 0)
                    $peerratio = number_format($torlist['uploaded'] / $torlist['downloaded'], 2);
                else
                    $peerratio = '&#8734;';
                $tortpl[$i]["peerratio"] = unesc($peerratio);
                $tortpl[$i]["seedscolor"] = linkcolor($torlist['seeds']);
                $tortpl[$i]["seeds"] = "<a href=\"javascript:poppeer('index.php?page=peers&amp;id=".$torlist['infohash']."')\">".$torlist['seeds']."</a>";
                $tortpl[$i]["leechcolor"] = linkcolor($torlist['leechers']);
                $tortpl[$i]["leechs"] = "<a href=\"javascript:poppeer('index.php?page=peers&amp;id=".$torlist['infohash']."')\">".$torlist['leechers']."</a>";
                $tortpl[$i]["completed"] = "<a href=\"javascript:poppeer('index.php?page=torrent_history.php&amp;id=".$torlist['infohash']."')\">".$torlist['finished']."</a>";
                if($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")
                {
                    $tortpl[$i]["seeding_time"]=NewDateFormat($torlist["seeding_time"]);
                }
                $i++;
            }
            else
            {
                if($btit_settings["fmhack_torrent_times"]=="enabled")
                {
                    $tortpl[$i]["mtime"]=date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["mtime"]);
                    $tortpl[$i]["completed_time"]=(($torlist["completed_time"]==-1)?$language["NA"]:date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["completed_time"]));
                    $tortpl[$i]["started_time"]=(($torlist["started_time"]==-1)?$language["NA"]:date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["started_time"]));
                }
                if($btit_settings["fmhack_torrent_moderation"] == "enabled")
                {
                    $tortpl[$i]["moder"] = getmoderdetails(getmoderstatusbyhash($torlist["infohash"]), $torlist["infohash"]);
                }
                $tortpl[$i]["filename"] = "<a href=\"".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated"] == "true")?strtr($torlist["filename"], $res_seo["str"], $res_seo["strto"])."-".$torlist["seoid"].".html":"index.php?page=torrent-details&id=".$torlist["infohash"])."\" title=\"".$language["VIEW_DETAILS"].": ".$torlist['filename'].(($btit_settings["fmhack_torrent_moderation"] == "enabled" && $btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes" && $torlist["approved_by"] != $language["SYSTEM_USER"])?" (".$language["TMOD_APPROVED_BY"]." ".$torlist["approved_by"].")":"")."\">".$filename."</a>".(($btit_settings["fmhack_teams"] == "enabled" && $team != "")?"&nbsp;".$team."&nbsp;":"");
                $tortpl[$i]["size"] = makesize($torlist['size']);
                $tortpl[$i]["status"] = unesc($torlist['status']);
                $tortpl[$i]["downloaded"] = makesize($torlist['downloaded']);
                $tortpl[$i]["uploaded"] = makesize($torlist['uploaded']);
                if($torlist['downloaded'] > 0)
                    $peerratio = number_format($torlist['uploaded'] / $torlist['downloaded'], 2);
                else
                    $peerratio = '&#8734;';
                $tortpl[$i]["peerratio"] = unesc($peerratio);
                $tortpl[$i]["seedscolor"] = linkcolor($torlist['seeds']);
                $tortpl[$i]["seeds"] = "<a href=\"index.php?page=peers&amp;id=".$torlist['infohash']."\">".$torlist['seeds']."</a>";
                $tortpl[$i]["leechcolor"] = linkcolor($torlist['leechers']);
                $tortpl[$i]["leechs"] = "<a href=\"index.php?page=peers&amp;id=".$torlist['infohash']."\">".$torlist['leechers']."</a>";
                $tortpl[$i]["completed"] = "<a href=\"index.php?page=torrent_history&amp;id=".$torlist['infohash']."\">".$torlist['finished']."</a>";
                if($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")
                {
                    $tortpl[$i]["seeding_time"]=NewDateFormat($torlist["seeding_time"]);
                }
                $i++;
            }
        }
    }
    $userdetailtpl->set("tortpl", $tortpl);
}
else
{
    $userdetailtpl->set("RESULTS_1", false, true);
    $userdetailtpl->set("acsort1", false, true);
    $userdetailtpl->set("acsort2", false, true);
    $userdetailtpl->set("acsort3", false, true);
    $userdetailtpl->set("acsort4", false, true);
    $userdetailtpl->set("acsort5", false, true);
    $userdetailtpl->set("acsort6", false, true);
    $userdetailtpl->set("acsort7", false, true);
    $userdetailtpl->set("acsort8", false, true);
    $userdetailtpl->set("acsort9", false, true);
    $userdetailtpl->set("acsort10", false, true);
    $userdetailtpl->set("acsort11", false, true);
    $userdetailtpl->set("acsort12", false, true);
    $userdetailtpl->set("acsort13", false, true);
    $userdetailtpl->set("acsort14", false, true);
    $userdetailtpl->set("acsort15", false, true);
    $userdetailtpl->set("acsort16", false, true);
    $userdetailtpl->set("acsort17", false, true);
    $userdetailtpl->set("acsort18", false, true);
    $userdetailtpl->set("acsort19", false, true);
    $userdetailtpl->set("acsort20", false, true);
    $userdetailtpl->set("acsort21", false, true);
    $userdetailtpl->set("acsort22", false, true);
    $userdetailtpl->set("acsort23", false, true);
    $userdetailtpl->set("acsort24", false, true);
    $userdetailtpl->set("acsort25", false, true);
    $userdetailtpl->set("acsort26", false, true);
    $userdetailtpl->set("acsort27", false, true);
    $userdetailtpl->set("acsort28", false, true);
    $userdetailtpl->set("acsort29", false, true);
    $userdetailtpl->set("acsort30", false, true);
    $userdetailtpl->set("acsort31", false, true);
    $userdetailtpl->set("acsort32", false, true);
    $userdetailtpl->set("acsort33", false, true);
    $userdetailtpl->set("acsort34", false, true);
    $userdetailtpl->set("acsort35", false, true);
    $userdetailtpl->set("acsort36", false, true);
    $userdetailtpl->set("acsort37", false, true);
    $userdetailtpl->set("acsort38", false, true);
    $userdetailtpl->set("acsort39", false, true);
}
unset($anq);
$query5_join = "";
$query5_where = "";
if($btit_settings["fmhack_torrent_moderation"] == "enabled" || $btit_settings["fmhack_teams"] == "enabled")
{
    if($XBTT_USE)
        $query5_join .= "INNER JOIN `{$TABLE_PREFIX}files` `xf` ON `f`.`info_hash`=`xf`.`bin_hash`";
}
if($btit_settings["fmhack_torrent_moderation"] == "enabled")
{
    if($btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes")
    {
        $query5_select .= "`u2`.`username` `approved_by`,";
        $query5_join .= "LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `".(($XBTT_USE)?"x":"")."f`.`approved_by`=`u2`.`id` ";
    }
    if($CURUSER["moderate_trusted"] != "yes")
        $query5_where .= "AND `".(($XBTT_USE)?"x":"")."f`.`moder`='ok' ";
}
if($btit_settings["fmhack_teams"] == "enabled" && $btit_settings["team_state"] == "private")
    $query5_where .= "AND (".$CURUSER['team']." = `".(($XBTT_USE)?"x":"")."f`.`team` OR `".(($XBTT_USE)?"x":"")."f`.`team` = 0 OR '".$CURUSER['all_teams']."'='yes' OR '".$CURUSER['sel_team']."'=`".(($XBTT_USE)?"x":"")."f`.`team`) ";
if($btit_settings["fmhack_view_peer_details"] == "enabled" && $CURUSER["view_userdetails_torrents"] == "no" && $CURUSER["uid"] != $id)
    $anq[0]['th'] = 0;
else
{
    if($XBTT_USE)
        $anq = get_result("SELECT count(h.fid) as th FROM xbt_files_users h INNER JOIN xbt_files f ON h.fid=f.fid ".$query5_join." WHERE h.uid=$id ".$query5_where, true, $btit_settings['cache_duration']);
    else
        $anq = get_result("SELECT count(h.infohash) as th FROM {$TABLE_PREFIX}history h INNER JOIN {$TABLE_PREFIX}files f ON h.infohash=f.info_hash WHERE h.uid=$id ".$query5_where, true, $btit_settings['cache_duration']);
}
$userdetailarr["pagertophist"] = "";
if($anq[0]['th'] > 0)
{
    $userdetailtpl->set("RESULTS_2", true, true);
    $torhistory = array();
    $i = 0;
    list($pagertop, $pagerbottom, $limit) = pager(($utorrents == 0?15:$utorrents), $anq[0]['th'], "index.php?page=userdetails&amp;id=$id&amp;pagename=history&amp;".(($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?"ordup=".(int)0+$_GET["ordup"]."&amp;dirup=".(int)0+$_GET["dirup"]."&amp;ordac=".(int)0+$_GET["ordac"]."&amp;dirac=".(int)0+$_GET["dirac"]."&amp;ordhi=".(int)0+$_GET["ordhi"]."&amp;dirhi=".(int)0+$_GET["dirhi"]."&amp;":""), array("pagename" => "history"));
    $userdetailarr["pagertophist"] = $pagertop;
    $orderBy = (($XBTT_USE)?"`h`.`mtime`":"`date`");
    $direction = "DESC";
    $userdetailtpl->set("hisort1", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort2", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort3", false, true);
    $userdetailtpl->set("hisort4", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort5", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort6", false, true);
    $userdetailtpl->set("hisort7", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort8", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort9", false, true);
    $userdetailtpl->set("hisort10", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort11", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort12", false, true);
    $userdetailtpl->set("hisort13", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort14", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort15", false, true);
    $userdetailtpl->set("hisort16", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort17", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort18", false, true);
    $userdetailtpl->set("hisort19", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort20", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort21", false, true);
    $userdetailtpl->set("hisort22", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort23", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort24", false, true);
    $userdetailtpl->set("hisort25", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort26", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $userdetailtpl->set("hisort27", false, true);
    $userdetailtpl->set("hisort28", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && $btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")?true:false), true);
    $userdetailtpl->set("hisort29", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && $btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")?true:false), true);
    $userdetailtpl->set("hisort30", false, true);
    $userdetailtpl->set("hisort31", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && $btit_settings["fmhack_torrent_times"]=="enabled")?true:false), true);
    $userdetailtpl->set("hisort32", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && $btit_settings["fmhack_torrent_times"]=="enabled")?true:false), true);
    $userdetailtpl->set("hisort33", false, true);
    $userdetailtpl->set("hisort34", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && $btit_settings["fmhack_torrent_times"]=="enabled")?true:false), true);
    $userdetailtpl->set("hisort35", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && $btit_settings["fmhack_torrent_times"]=="enabled")?true:false), true);
    $userdetailtpl->set("hisort36", false, true);
    $userdetailtpl->set("hisort37", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && $btit_settings["fmhack_torrent_times"]=="enabled")?true:false), true);
    $userdetailtpl->set("hisort38", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && $btit_settings["fmhack_torrent_times"]=="enabled")?true:false), true);
    $userdetailtpl->set("hisort39", false, true);
    if($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")
    {
        $ordhi = (isset($_GET["ordhi"]) && !empty($_GET["ordhi"]) && $_GET["ordhi"] >= 1 && $_GET["ordhi"] <= 13)?(int)0 + $_GET["ordhi"]:false;
        $dirhi = (isset($_GET["dirhi"]) && !empty($_GET["dirhi"]) && $_GET["dirhi"] >= 1 && $_GET["dirhi"] <= 2)?(int)0 + $_GET["dirhi"]:false;
        $udhisorturl1 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=1&amp;dirhi=";
        $udhisorturl2 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=2&amp;dirhi=";
        $udhisorturl3 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=3&amp;dirhi=";
        $udhisorturl4 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=4&amp;dirhi=";
        $udhisorturl5 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=5&amp;dirhi=";
        $udhisorturl6 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=6&amp;dirhi=";
        $udhisorturl7 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=7&amp;dirhi=";
        $udhisorturl8 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=8&amp;dirhi=";
        $udhisorturl9 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=9&amp;dirhi=";
        $udhisorturl10 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=10&amp;dirhi=";
        $udhisorturl11 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=11&amp;dirhi=";
        $udhisorturl12 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=12&amp;dirhi=";
        $udhisorturl13 = "index.php?page=userdetails&id=".$id."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=13&amp;dirhi=";
        switch($ordhi)
        {
            case 1:
            $orderBy = "`f`.`filename`";
            $userdetailtpl->set("hisort3", true, true);
            break;
            case 2:
            $orderBy = "`f`.`size`";
            $userdetailtpl->set("hisort6", true, true);
            break;
            case 3:
            $orderBy = "`h`.`active`";
            $userdetailtpl->set("hisort9", true, true);
            break;
            case 4:
            $orderBy = "`h`.`downloaded`";
            $userdetailtpl->set("hisort12", true, true);
            break;
            case 5:
            $orderBy = "`h`.`uploaded`";
            $userdetailtpl->set("hisort15", true, true);
            break;
            case 6:
            $orderBy = "(`h`.`uploaded`/`h`.`downloaded`)";
            $userdetailtpl->set("hisort18", true, true);
            break;
            case 7:
            $orderBy = (($XBTT_USE)?"`h`.`seeding_time`":"`h`.`seed`");
            $userdetailtpl->set("hisort21", true, true);
            break;
            case 8:
            $orderBy = (($XBTT_USE)?"`x`.`seeders`":"`f`.`seeds`");
            $userdetailtpl->set("hisort24", true, true);
            break;
            case 9:
            $orderBy = (($XBTT_USE)?"`x`":"`f`").".`leechers`";
            $userdetailtpl->set("hisort27", true, true);
            break;
            case 10:
            if($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")
            {
                $orderBy = (($XBTT_USE)?"`x`.`completed`":"`f`.`finished`");
                $userdetailtpl->set("hisort30", true, true);
            }
            break;
            case 11:
            if($btit_settings["fmhack_torrent_times"]=="enabled")
            {
                $orderBy = "`h`.`started_time`";
                $userdetailtpl->set("hisort33", true, true);
            }
            break;
            case 12:
            if($btit_settings["fmhack_torrent_times"]=="enabled")
            {
                $orderBy = "`h`.`completed_time`";
                $userdetailtpl->set("hisort36", true, true);
            }
            break;
            case 13:
            if($btit_settings["fmhack_torrent_times"]=="enabled")
            {
                $orderBy = (($XBTT_USE)?"`h`.`mtime`":"`h`.`date`");
                $userdetailtpl->set("hisort39", true, true);
            }
            break;
            default:
            $orderBy = (($XBTT_USE)?"`h`.`mtime`":"`date`");
            break;
        }
        switch($dirhi)
        {
            case 2:
            $direction = "ASC";
            $userdetailarr["uarrow3"] = "&nbsp;&uarr;";
            $userdetailarr["udhisorturl1"] = $udhisorturl1 .= "1";
            $userdetailarr["udhisorturl2"] = $udhisorturl2 .= "1";
            $userdetailarr["udhisorturl3"] = $udhisorturl3 .= "1";
            $userdetailarr["udhisorturl4"] = $udhisorturl4 .= "1";
            $userdetailarr["udhisorturl5"] = $udhisorturl5 .= "1";
            $userdetailarr["udhisorturl6"] = $udhisorturl6 .= "1";
            $userdetailarr["udhisorturl7"] = $udhisorturl7 .= "1";
            $userdetailarr["udhisorturl8"] = $udhisorturl8 .= "1";
            $userdetailarr["udhisorturl9"] = $udhisorturl9 .= "1";
            $userdetailarr["udhisorturl10"] = $udhisorturl10 .= "1";
            $userdetailarr["udhisorturl11"] = $udhisorturl11 .= "1";
            $userdetailarr["udhisorturl12"] = $udhisorturl12 .= "1";
            $userdetailarr["udhisorturl13"] = $udhisorturl13 .= "1";
            break;
            case 1:
            default:
            $direction = "DESC";
            $userdetailarr["uarrow3"] = "&nbsp;&darr;";
            $userdetailarr["udhisorturl1"] = $udhisorturl1 .= "2";
            $userdetailarr["udhisorturl2"] = $udhisorturl2 .= "2";
            $userdetailarr["udhisorturl3"] = $udhisorturl3 .= "2";
            $userdetailarr["udhisorturl4"] = $udhisorturl4 .= "2";
            $userdetailarr["udhisorturl5"] = $udhisorturl5 .= "2";
            $userdetailarr["udhisorturl6"] = $udhisorturl6 .= "2";
            $userdetailarr["udhisorturl7"] = $udhisorturl7 .= "2";
            $userdetailarr["udhisorturl8"] = $udhisorturl8 .= "2";
            $userdetailarr["udhisorturl9"] = $udhisorturl9 .= "2";
            $userdetailarr["udhisorturl10"] = $udhisorturl10 .= "2";
            $userdetailarr["udhisorturl11"] = $udhisorturl11 .= "2";
            $userdetailarr["udhisorturl12"] = $udhisorturl12 .= "2";
            $userdetailarr["udhisorturl13"] = $udhisorturl13 .= "2";
            break;
        }
    }
    $query2_select = "";
    $query2_where = "";
    if($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")
        $query2_select .= (($XBTT_USE)?"`h`.`seeding_time` `seed`,":"`h`.`seed`,");
    if($btit_settings["fmhack_torrent_moderation"] == "enabled")
    {
        if($btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes")
        {
            $query2_select .= "`u2`.`username` `approved_by`,";
            $query2_join .= "LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `f`.`approved_by`=`u2`.`id` ";
        }
        if($CURUSER["moderate_trusted"] != "yes")
            $query2_where .= "AND `f`.`moder`='ok' ";
    }
    if($btit_settings["fmhack_teams"] == "enabled")
    {
        $query2_select .= "`t`.`name` `teamname`, `t`.`id` `teamsid`, `t`.`image` `teamimage`, `f`.`team`,";
        $query2_join .= "LEFT JOIN `{$TABLE_PREFIX}teams` `t` ON `f`.`team` = `t`.`id` ";
        if($btit_settings["team_state"] == "private")
        {
            $query2_where .= "AND (".$CURUSER['team']." = `f`.`team` OR `f`.`team` = 0 OR '".$CURUSER['all_teams']."'='yes' OR '".$CURUSER['sel_team']."'=`f`.`team`) ";
        }
    }
    if($btit_settings["fmhack_SEO_panel"] == "enabled")
        $query2_select .= "`f`.`id` `seoid`,";
    if(($btit_settings["fmhack_VIP_freeleech"] == "enabled" || $btit_settings["fmhack_torrent_times"]=="enabled") && $XBTT_USE)
        $query2_select .= "`h`.`mtime`,";
    if($btit_settings["fmhack_torrent_times"]=="enabled")
        $query2_select .= ((!$XBTT_USE)?"`h`.`date` `mtime`, ":"")."`h`.`completed_time`, `h`.`started_time`,";
    if($XBTT_USE)
        $anq = get_result("SELECT ".$query2_select." f.filename, f.size, f.info_hash, IF(h.active=1,'yes','no') `active`, LOWER(HEX(`h`.`peer_id`)) as agent, h.downloaded, h.uploaded, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished
           FROM $ttables INNER JOIN xbt_files_users h ON h.fid=x.fid ".$query2_join." WHERE h.uid=$id ".$query2_where." ORDER BY $orderBy $direction $limit", true, $btit_settings['cache_duration']);
    else
        $anq = get_result("SELECT ".$query2_select." f.filename, f.size, f.info_hash, h.active, h.agent, h.downloaded, h.uploaded, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished
          FROM $ttables INNER JOIN {$TABLE_PREFIX}history h ON h.infohash=f.info_hash ".$query2_join." WHERE h.uid=$id ".$query2_where." ORDER BY $orderBy $direction $limit", true, $btit_settings['cache_duration']);
    //    print("<div align=\"center\">$pagertop</div>");
    foreach($anq as $torlist)
    {
        if($btit_settings["fmhack_VIP_freeleech"] == "enabled" && $XBTT_USE)
        {
            if($row["freeleech"] == "yes" && $torlist["mtime"] >= $row["vipfl_date"])
                $torlist["downloaded"] = 0;
        }
        if($XBTT_USE)
            $torlist['agent'] = getagent("", $torlist['agent']);
        $torlist['filename'] = unesc($torlist['filename']);
        $filename = cut_string($torlist['filename'], intval($btit_settings["cut_name"]));
        if($btit_settings["fmhack_teams"] == "enabled")
        {
            $fteam = $torlist["team"];
            if(isset($fteam) && !empty($fteam))
                $team = "<a href='index.php?page=teaminfo&team=".$torlist["teamsid"]."&action=view'><img src='".$torlist["teamimage"]."' border='0' title='".$torlist["teamname"]."' style='width:25px;'></a>";
            else
                $team = "";
        }
        if($GLOBALS["usepopup"])
        {
            if($btit_settings["fmhack_torrent_times"]=="enabled")
            {
                $torhistory[$i]["mtime"]=date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["mtime"]);
                $torhistory[$i]["completed_time"]=(($torlist["completed_time"]==-1)?$language["NA"]:date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["completed_time"]));
                $torhistory[$i]["started_time"]=(($torlist["started_time"]==-1)?$language["NA"]:date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["started_time"]));
            }
            if($btit_settings["fmhack_torrent_moderation"] == "enabled")
            {
                $torhistory[$i]["moder"] = getmoderdetails(getmoderstatusbyhash($torlist["info_hash"]), $torlist["info_hash"]);
            }
            $torhistory[$i]["filename"] = "<a href=\"javascript:popdetails('".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated"] == "true")?strtr($torlist["filename"], $res_seo["str"], $res_seo["strto"])."-".$torlist["seoid"].".html":"index.php?page=torrent-details&id=".$torlist["info_hash"])."')\" title=\"".$language["VIEW_DETAILS"].": ".$torlist['filename'].(($btit_settings["fmhack_torrent_moderation"] == "enabled" && $btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes" && $torlist["approved_by"] != $language["SYSTEM_USER"])?" (".$language["TMOD_APPROVED_BY"]." ".$torlist["approved_by"].")":"")."\">".$filename."</a>".(($btit_settings["fmhack_teams"] == "enabled" && $team != "")?"&nbsp;".$team."&nbsp;":"");
            $torhistory[$i]["size"] = makesize($torlist['size']);
            $torhistory[$i]["agent"] = htmlspecialchars($torlist['agent']);
            $torhistory[$i]["status"] = ($torlist['active'] == 'yes'?$language["ACTIVATED"]:'Stopped');
            $torhistory[$i]["downloaded"] = makesize($torlist['downloaded']);
            $torhistory[$i]["uploaded"] = makesize($torlist['uploaded']);
            if($torlist['downloaded'] > 0)
                $peerratio = number_format($torlist['uploaded'] / $torlist['downloaded'], 2);
            else
                $peerratio = '&#8734;';
            $torhistory[$i]["ratio"] = unesc($peerratio);
            $torhistory[$i]["seedscolor"] = linkcolor($torlist['seeds']);
            $torhistory[$i]["seeds"] = "<a href=\"javascript:poppeer('index.php?page=peers&amp;id=".$torlist['info_hash']."')\">".$torlist['seeds']."</a>";
            $torhistory[$i]["leechcolor"] = linkcolor($torlist['leechers']);
            $torhistory[$i]["leechs"] = "<a href=\"javascript:poppeer('index.php?page=peers&amp;id=".$torlist['info_hash']."')\">".$torlist['leechers']."</a>";
            $torhistory[$i]["completed"] = "<a href=\"javascript:poppeer('index.php?page=torrent_history&amp;id=".$torlist['info_hash']."')\">".$torlist['finished']."</a>";
            if($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")
                $torhistory[$i]["SEEDING_TIME"] = NewDateFormat($torlist["seed"]);
            $i++;
        }
        else
        {
            if($btit_settings["fmhack_torrent_times"]=="enabled")
            {
                $torhistory[$i]["mtime"]=date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["mtime"]);
                $torhistory[$i]["completed_time"]=(($torlist["completed_time"]==-1)?$language["NA"]:date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["completed_time"]));
                $torhistory[$i]["started_time"]=(($torlist["started_time"]==-1)?$language["NA"]:date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["started_time"]));
            }
            if($btit_settings["fmhack_torrent_moderation"] == "enabled")
            {
                $torhistory[$i]["moder"] = getmoderdetails(getmoderstatusbyhash($torlist["info_hash"]), $torlist["info_hash"]);
            }
            $torhistory[$i]["filename"] = "<a href=\"".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated"] == "true")?strtr($torlist["filename"], $res_seo["str"], $res_seo["strto"])."-".$torlist["seoid"].".html":"index.php?page=torrent-details&id=".$torlist["info_hash"])."\" title=\"".$language["VIEW_DETAILS"].": ".$torlist['filename'].(($btit_settings["fmhack_torrent_moderation"] == "enabled" && $btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes" && $torlist["approved_by"] != $language["SYSTEM_USER"])?" (".$language["TMOD_APPROVED_BY"]." ".$torlist["approved_by"].")":"")."\">".$filename."</a>".(($btit_settings["fmhack_teams"] == "enabled" && $team != "")?"&nbsp;".$team."&nbsp;":"");
            $torhistory[$i]["size"] = makesize($torlist['size']);
            $torhistory[$i]["agent"] = htmlspecialchars($torlist['agent']);
            $torhistory[$i]["status"] = ($torlist['active'] == 'yes'?$language["ACTIVATED"]:'Stopped');
            $torhistory[$i]["downloaded"] = makesize($torlist['downloaded']);
            $torhistory[$i]["uploaded"] = makesize($torlist['uploaded']);
            if($torlist['downloaded'] > 0)
                $peerratio = number_format($torlist['uploaded'] / $torlist['downloaded'], 2);
            else
                $peerratio = '&#8734;';
            $torhistory[$i]["ratio"] = unesc($peerratio);
            $torhistory[$i]["seedscolor"] = linkcolor($torlist['seeds']);
            $torhistory[$i]["seeds"] = "<a href=\"index.php?page=peers&amp;id=".$torlist['info_hash']."\">".$torlist['seeds']."</a>";
            $torhistory[$i]["leechcolor"] = linkcolor($torlist['leechers']);
            $torhistory[$i]["leechs"] = "<a href=\"index.php?page=peers&amp;id=".$torlist['info_hash']."\">".$torlist['leechers']."</a>";
            $torhistory[$i]["completed"] = "<a href=\"index.php?page=torrent_history&amp;id=".$torlist['info_hash']."\">".$torlist['finished']."</a>";
            if($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")
                $torhistory[$i]["SEEDING_TIME"] = NewDateFormat($torlist['seed']);
            $i++;
        }
    }
    $userdetailtpl->set("torhistory", $torhistory);
}
else
{
    $userdetailtpl->set("RESULTS_2", false, true);
    $userdetailtpl->set("hisort1", false, true);
    $userdetailtpl->set("hisort2", false, true);
    $userdetailtpl->set("hisort3", false, true);
    $userdetailtpl->set("hisort4", false, true);
    $userdetailtpl->set("hisort5", false, true);
    $userdetailtpl->set("hisort6", false, true);
    $userdetailtpl->set("hisort7", false, true);
    $userdetailtpl->set("hisort8", false, true);
    $userdetailtpl->set("hisort9", false, true);
    $userdetailtpl->set("hisort10", false, true);
    $userdetailtpl->set("hisort11", false, true);
    $userdetailtpl->set("hisort12", false, true);
    $userdetailtpl->set("hisort13", false, true);
    $userdetailtpl->set("hisort14", false, true);
    $userdetailtpl->set("hisort15", false, true);
    $userdetailtpl->set("hisort16", false, true);
    $userdetailtpl->set("hisort17", false, true);
    $userdetailtpl->set("hisort18", false, true);
    $userdetailtpl->set("hisort19", false, true);
    $userdetailtpl->set("hisort20", false, true);
    $userdetailtpl->set("hisort21", false, true);
    $userdetailtpl->set("hisort22", false, true);
    $userdetailtpl->set("hisort23", false, true);
    $userdetailtpl->set("hisort24", false, true);
    $userdetailtpl->set("hisort25", false, true);
    $userdetailtpl->set("hisort26", false, true);
    $userdetailtpl->set("hisort27", false, true);
    $userdetailtpl->set("hisort28", false, true);
    $userdetailtpl->set("hisort29", false, true);
    $userdetailtpl->set("hisort30", false, true);
    $userdetailtpl->set("hisort31", false, true);
    $userdetailtpl->set("hisort32", false, true);
    $userdetailtpl->set("hisort33", false, true);
    $userdetailtpl->set("hisort34", false, true);
    $userdetailtpl->set("hisort35", false, true);
    $userdetailtpl->set("hisort36", false, true);
    $userdetailtpl->set("hisort37", false, true);
    $userdetailtpl->set("hisort38", false, true);
    $userdetailtpl->set("hisort39", false, true);
}
unset($sanq);
$userdetailarr["userdetail_back"] = "<a  href=\"javascript: history.go(-1);\">".$language["BACK"]."</a>";
$userdetailtpl->set("hnr_enabled", (($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")?true:false), true);
$userdetailtpl->set("hnr_enabled2", (($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")?true:false), true);
$userdetailtpl->set("hnr_enabled3", (($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")?true:false), true);
$userdetailtpl->set("hnr_enabled4", (($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")?true:false), true);
$userdetailtpl->set("hnr_enabled7", (($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled" && $CURUSER["admin_access"]=="yes")?true:false), true);
$userdetailtpl->set("tmod1_enabled", (($btit_settings["fmhack_torrent_moderation"] == "enabled")?true:false), true);
$userdetailtpl->set("tmod2_enabled", (($btit_settings["fmhack_torrent_moderation"] == "enabled")?true:false), true);
$userdetailarr["colspan"] = (($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")?11:10);
if($btit_settings["fmhack_torrent_times"]=="enabled")
    $userdetailarr["colspan"]+=3;
$userdetailarr["colspan2"] = (($btit_settings["fmhack_torrent_moderation"] == "enabled")?7:6);
$userdetailarr["colspan3"] = (($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")?10:9);
if($btit_settings["fmhack_torrent_times"]=="enabled")
    $userdetailarr["colspan3"]+=3;

$userdetailarr["colspan4"] = (($btit_settings["fmhack_torrent_moderation"] == "enabled")?7:6);
$userdetailarr["colspan5"] = (($btit_settings["fmhack_torrent_moderation"] == "enabled")?7:6);

if($btit_settings["fmhack_torrent_times"]=="enabled")
    $userdetailarr["colspan3"]+=3;
$userdetailtpl->set("birthdays_enabled", (($btit_settings["fmhack_birthdays"] == "enabled")?true:false), true);
$userdetailtpl->set("avatar_signature_sync_enabled", (($btit_settings["fmhack_avatar_signature_sync"] == "enabled")?true:false), true);
$userdetailtpl->set("note_admin_1", (($btit_settings["fmhack_user_notes"] == "enabled" && $CURUSER["edit_users"] == "yes" && $CURUSER["admin_access"] == "yes")?true:false), true);
$userdetailtpl->set("note_admin_2", (($btit_settings["fmhack_user_notes"] == "enabled" && $CURUSER["edit_users"] == "yes" && $CURUSER["admin_access"] == "yes")?true:false), true);
$userdetailtpl->set("user_img_enabled", (($btit_settings["fmhack_user_images"] == "enabled")?true:false), true);
$userdetailtpl->set("ttimes_enabled_1", (($btit_settings["fmhack_torrent_times"] == "enabled")?true:false), true);
$userdetailtpl->set("ttimes_enabled_2", (($btit_settings["fmhack_torrent_times"] == "enabled")?true:false), true);
$userdetailtpl->set("ttimes_enabled_3", (($btit_settings["fmhack_torrent_times"] == "enabled")?true:false), true);
$userdetailtpl->set("ttimes_enabled_4", (($btit_settings["fmhack_torrent_times"] == "enabled")?true:false), true);
//Having an avatar can break the table, this should hopefully fix it in all cases
if($row["avatar"] && $row["avatar"] != "")
{
    $rowspan = 1;
    if($btit_settings["fmhack_user_images"] == "enabled")
        $rowspan++;
    if($btit_settings["fmhack_birthdays"] == "enabled")
        $rowspan++;
    if($btit_settings["fmhack_warning_system"] == "enabled")
        $rowspan++;
    // Email
    $userdetailarr["avatar_colspan_1"] = (($rowspan >= 4)?" colspan=\"2\"":"");
    $rowspan++;
    // Last IP
    $userdetailarr["avatar_colspan_2"] = (($rowspan >= 4)?" colspan=\"2\"":"");
    $rowspan++;
    if($btit_settings["fmhack_IP_to_country"] == "enabled" && ($CURUSER["edit_users"] == "yes" || $CURUSER["admin_access"] == "yes") && $CURUSER["delete_users"] == "yes")
        $rowspan++;
    $userdetailarr["avatar_colspan_3"] = (($rowspan >= 4)?" colspan=\"2\"":"");
    if($btit_settings["fmhack_show_members_whois_record_on_userdetails"] == "enabled" && ($CURUSER["edit_users"] == "yes" || $CURUSER["admin_access"] == "yes"))
        $rowspan++;
    $userdetailarr["avatar_colspan_4"] = (($rowspan >= 4)?" colspan=\"2\"":"");
    if($btit_settings["fmhack_timed_ranks"] == "enabled" && ($CURUSER["edit_users"] == "yes" || $CURUSER["admin_access"] == "yes") && $rankOverOrEqual && $id != $CURUSER["uid"])
    {
        $rowspan++;
        $userdetailarr["avatar_colspan_5"] = (($rowspan >= 4)?" colspan=\"3\"":" colspan=\"2\"");
        $rowspan++;
        $userdetailarr["avatar_colspan_6"] = (($rowspan >= 4)?" colspan=\"2\"":"");
        $rowspan++;
        $userdetailarr["avatar_colspan_7"] = (($rowspan >= 4)?" colspan=\"2\"":"");
        $rowspan++;
        $userdetailarr["avatar_colspan_8"] = (($rowspan >= 4)?" colspan=\"2\"":"");
    }
    if($btit_settings["fmhack_donation_history"] == "enabled" && ($CURUSER["edit_users"] == "yes" || $CURUSER["admin_access"] == "yes") && $id !=$CURUSER["uid"])
    {
        $rowspan++;
        $userdetailarr["avatar_colspan_9"] = (($rowspan >= 4)?" colspan=\"3\"":" colspan=\"2\"");
        $rowspan++;
        $userdetailarr["avatar_colspan_10"] = (($rowspan >= 4)?" colspan=\"2\"":"");
        $rowspan++;
        $userdetailarr["avatar_colspan_11"] = (($rowspan >= 4)?" colspan=\"2\"":"");
        $rowspan++;
        $userdetailarr["avatar_colspan_12"] = (($rowspan >= 4)?" colspan=\"3\"":" colspan=\"2\"");
    }
    // Rank
    $userdetailarr["avatar_colspan_13"] = (($rowspan >= 4)?" colspan=\"2\"":"");
    $rowspan++;
    $userdetailarr["avatar_colspan_14"] = " colspan=\"2\"";
    $userdetailarr["avatar_colspan_15"] = " colspan=\"2\"";
}
else
{
    $userdetailarr["avatar_colspan_1"] = "";
    $userdetailarr["avatar_colspan_2"] = "";
    $userdetailarr["avatar_colspan_3"] = "";
    $userdetailarr["avatar_colspan_4"] = "";
    $userdetailarr["avatar_colspan_5"] = "colspan=\"3\"";
    $userdetailarr["avatar_colspan_6"] = "";
    $userdetailarr["avatar_colspan_7"] = "";
    $userdetailarr["avatar_colspan_8"] = "";
    $userdetailarr["avatar_colspan_9"] = "colspan=\"3\"";
    $userdetailarr["avatar_colspan_10"] = "";
    $userdetailarr["avatar_colspan_11"] = "";
    $userdetailarr["avatar_colspan_12"] = "colspan=\"3\"";
    $userdetailarr["avatar_colspan_13"] = "";
    $userdetailarr["avatar_colspan_14"] = "";
    $userdetailarr["avatar_colspan_15"] = "";
}
if($btit_settings["fmhack_user_watch_list"] == "enabled")
{
    $userdetailtpl->set("watch_1", (($CURUSER["edit_users"] == "yes" && $CURUSER["uid"]!=$id)?true:false), true);
    $userdetailtpl->set("watch", (($row["IS_WATCHED"] == "yes") && ($CURUSER["edit_users"] == "yes")?true:false), true);
    $userdetailarr["watchid"] = $id;
}
else
{
    $userdetailtpl->set("watch_1", false, true);
    $userdetailtpl->set("watch", false, true);
}
$userdetailtpl->set("watched_enabled", (($btit_settings["fmhack_user_watch_list"] == "enabled")?true:false), true);
$userdetailtpl->set("userdetailarr", $userdetailarr);
//Port/Client Info
$userdetailtpl-> set("userdetail_clientinfo", (($CURUSER["edit_users"]=="yes") ? TRUE : FALSE), TRUE);

if($CURUSER["edit_users"]=="yes")
{
    if(empty($row["clientinfo"]))
    {
        $userdetailtpl-> set("client_history_text", "No client history available yet");
    }
    else
    {
        $client_history_text="";
        $clientinfo=unserialize($row["clientinfo"]);
        foreach($clientinfo as $k => $v)
        {
            if($k==0)
            {
                $info=explode("[X]",$v);
                $client_history_text.="<a href='index.php?page=users&client=".urlencode($info[0])."'>".$info[0] . "</a> ".$language["PEER_PORT"].": <a href='index.php?page=users&port=$info[1]'>".$info[1]."</a> (<a href='index.php?page=users&client=".urlencode($info[0])."&port=$info[1]'>Pair</a>)";
            }
            if($k!=0 && ($k==2 || $k==4 || $k==6  || $k==8 || $k==10 || $k==12 || $k==14  || $k==16  || $k==18))
            {
                $client_history_text.="<br />";
                $info=explode("[X]",$v);
                $client_history_text.="<a href='index.php?page=users&client=".urlencode($info[0])."'>".$info[0] . "</a> ".$language["PEER_PORT"].": <a href='index.php?page=users&port=$info[1]'>".$info[1]."</a> (<a href='index.php?page=users&client=".urlencode($info[0])."&port=$info[1]'>Pair</a>)";
            }
            if($k==1 || $k==3 || $k==5 || $k==7  || $k==9 || $k==11 || $k==13 || $k==15 || $k==17  || $k==19)
            {
                $info1=explode("[X]",$v);
                $client_history_text.=" - recorded on " . get_date_time($info1[0]) . " from $info1[1]";
            }
        }
        $userdetailtpl-> set("client_history_text", $client_history_text);
    }
}
//Port/Client Info

//My Uploads
    $res_up = do_sqlquery("SELECT count( * ) AS Count FROM {$TABLE_PREFIX}files WHERE uploader = {$id} AND anonymous='false' GROUP BY info_hash");
    $up_count = sql_num_rows($res_up);
    $userdetailtpl->set("uploads",$up_count);
//My Uploads End

// Seeding/Leeching hack
    $res = do_sqlquery("SELECT count( * ) AS Count FROM {$TABLE_PREFIX}peers WHERE status = 'seeder' AND pid ='".$row["pid"]."' GROUP BY infohash");
    $res1 = do_sqlquery("SELECT count( * ) AS Count FROM {$TABLE_PREFIX}peers WHERE status = 'leecher' AND pid ='".$row["pid"]."' GROUP BY infohash");
//$num = $res->fetch_array(); $num1 = $res1->fetch_array();
    $seeder=sql_num_rows($res); $leecher=sql_num_rows($res1); 
    $userdetailtpl->set("seeding",$seeder);
    $userdetailtpl->set("leeching",$leecher);
// END Seeding/Leeching hack

//Snatched torrents
    $res_com = do_sqlquery("SELECT Count(*) as Count FROM {$TABLE_PREFIX}history WHERE uid = {$id} GROUP BY infohash");
    $comp_count = sql_num_rows($res_com);
    $userdetailtpl->set("snatched",$comp_count);
//Snatched torrents

//Profile Status
$userdetailtpl -> set("userdetail_has_status", $profile_status["last_status"] && $profile_status["last_status"]!="", TRUE);
$userdetailtpl -> set("userdetail_profile_status", format_comment($profile_status["last_status"]));
$userdetailtpl -> set("userdetail_status_time", time_ago($profile_status["last_update"]));
//Profile Status Ends
?>
