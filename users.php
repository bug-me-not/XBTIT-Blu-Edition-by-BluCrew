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

if($CURUSER["view_users"] == "no")
{ // start 'view_users'
    err_msg($language["ERROR"], $language["NOT_AUTHORIZED"]." ".$language["MEMBERS"]."!");
    stdfoot();
    exit;
}
else
{
    global $CURUSER, $STYLEPATH, $CURRENTPATH, $TABLE_PREFIX, $XBTT_USE;
    if($XBTT_USE)
    {
        $udownloaded = "u.downloaded+IFNULL(x.downloaded,0)";
        $uuploaded = "u.uploaded+IFNULL(x.uploaded,0)";
        $utables = "{$TABLE_PREFIX}users u LEFT JOIN xbt_users x ON x.uid=u.id";
    }
    else
    {
        $udownloaded = "u.downloaded";
        $uuploaded = "u.uploaded";
        $utables = "{$TABLE_PREFIX}users u";
    }
    if(!isset($_GET["searchtext"]))
        $_GET["searchtext"] = "";
    if(!isset($_GET["level"]))
        $_GET["level"] = "";
    $previous_usernames=($btit_settings["fmhack_previous_usernames"]=="enabled" && isset($_GET["previous_usernames"]) && $_GET["previous_usernames"]=="on" && $CURUSER["admin_access"]=="yes") ? true : false;
    $search = htmlspecialchars($_GET["searchtext"]);
    $addparams = "";
    if($search != "")
    {
        $where = " AND ".(($btit_settings["fmhack_previous_usernames"]=="enabled" && $previous_usernames)?"`u`.`previous_names`":"`u`.`username`")." LIKE '%".htmlspecialchars(sql_esc($_GET["searchtext"]))."%'";
        $addparams = "searchtext=$search";
    }
    else
        $where = "";
    $level = intval(0 + $_GET["level"]);
    if($level > 0)
    {
        $where .= " AND u.id_level=$level";
        if($addparams != "")
            $addparams .= "&amp;level=$level";
        else
            $addparams = "level=$level";
    }
    $order_param = 3;
    // getting order
    if(isset($_GET["order"]))
    {
        $order_param = (int)$_GET["order"];
        switch($order_param)
        {
            case 1:
                $order = "username";
                break;
            case 2:
                $order = "level";
                break;
            case 3:
                $order = "joined";
                break;
            case 4:
                $order = "lastconnect";
                break;
            case 5:
                $order = "flag";
                break;
            case 6:
                $order = "ratio";
                break;
            case 7:
                $order = "country_name";
                break;
            default:
                $order = "joined";
        }
    }
    else
        $order = "joined";
    $by_param = 1;
    if(isset($_GET["by"]))
    {
        $by_param = (int)$_GET["by"];
        $by = ($by_param == 1?"ASC":"DESC");
    }
    else
        $by = "ASC";
    if($addparams != "")
        $addparams .= "&amp;";

    # Search by ip, email, pid # 1
    if ($CURUSER["admin_access"]=="yes")
    {
    $searchip=htmlspecialchars(sql_esc($_GET["sip"]));
    if ($searchip!="") $where.=" AND (u.cip LIKE '%$searchip%')";

    $searchmail=htmlspecialchars(sql_esc($_GET["smail"]));
    if ($searchmail!="") $where.=" AND u.email LIKE '%$searchmail%'";

    $getpid=htmlspecialchars(sql_esc($_GET["pid"]));
    if ($getpid!="") $where.=" AND u.pid LIKE '%$getpid%'";

    }
    # Search by ip, email, pid # 1

    $scriptname = htmlspecialchars($_SERVER["PHP_SELF"]."?page=users");
    $res = get_result("select COUNT(*) as tu FROM {$TABLE_PREFIX}users u INNER JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE u.id>1 $where", true, $btit_settings['cache_duration']);
    $count = $res[0]['tu'];
    list($pagertop, $pagerbottom, $limit) = pager(20, $count, $scriptname."&amp;".$addparams.(strlen($addparam) > 0?"&amp;":"")."order=$order_param&amp;by=$by_param&amp;");
    if($by == "ASC")
        $mark = "&nbsp;&uarr;";
    else
        $mark = "&nbsp;&darr;";
    // load language file
    require (load_language("lang_users.php"));
    $userstpl = new bTemplate();
    $userstpl->set("pun_enabled", (($btit_settings["fmhack_previous_usernames"]=="enabled" && $CURUSER["admin_access"]=="yes")?true:false), true);
    $userstpl->set("pun_checked", (($btit_settings["fmhack_previous_usernames"]=="enabled" && $previous_usernames)?true:false), true);
    $userstpl->set("language", $language);
    $userstpl->set("users_search", $search);
	 # Search by ip, email, pid # 2 # last
    $userstpl->set("smail", $searchmail);
    $userstpl->set("sip", $searchip);
    $userstpl->set("pid", $getpid);
   # Search by ip, email, pid # 2 # last

    $userstpl->set("users_search_level", $level == 0?" selected=\"selected\" ":"");
    $res = get_result("SELECT id,level FROM {$TABLE_PREFIX}users_level WHERE id_level>1 ORDER BY ".(($btit_settings["fmhack_logical_rank_ordering"] == "enabled")?"`logical_rank_order`":"`id_level`")." ASC", true, $btit_settings['cache_duration']);
    $select = "";
    foreach($res as $row)
    { // start while
        $select .= "<option value='".$row["id"]."'";
        if($level == $row["id"])
            $select .= "selected=\"selected\"";
        $select .= ">".$row["level"]."</option>\n";
    } // end while
    $userstpl->set("users_search_select", $select);
    $userstpl->set("users_pagertop", $pagertop);
    $userstpl->set("users_sort_username", "<a href=\"$scriptname&amp;$addparam".(strlen($addparam) > 0?"&amp;":"")."order=1&amp;by=".($order == "username" && $by == "ASC"?"2":"1")."\">".$language["USER_NAME"]."</a>".($order == "username"?$mark:""));
    $userstpl->set("users_sort_userlevel", "<a href=\"$scriptname&amp;$addparam".(strlen($addparam) > 0?"&amp;":"")."order=2&amp;by=".($order == "level" && $by == "ASC"?"2":"1")."\">".$language["USER_LEVEL"]."</a>".($order == "level"?$mark:""));
    $userstpl->set("users_sort_joined", "<a href=\"$scriptname&amp;$addparam".(strlen($addparam) > 0?"&amp;":"")."order=3&amp;by=".($order == "joined" && $by == "ASC"?"2":"1")."\">".$language["USER_JOINED"]."</a>".($order == "joined"?$mark:""));
    $userstpl->set("users_sort_lastaccess", "<a href=\"$scriptname&amp;$addparam".(strlen($addparam) > 0?"&amp;":"")."order=4&amp;by=".($order == "lastconnect" && $by == "ASC"?"2":"1")."\">".$language["USER_LASTACCESS"]."</a>".($order == "lastconnect"?$mark:""));
    $userstpl->set("users_sort_country", "<a href=\"$scriptname&amp;$addparam".(strlen($addparam) > 0?"&amp;":"")."order=5&amp;by=".($order == "flag" && $by == "ASC"?"2":"1")."\">".$language["USER_COUNTRY"]."</a>".($order == "flag"?$mark:""));
    $userstpl->set("users_sort_ratio", "<a href=\"$scriptname&amp;$addparam".(strlen($addparam) > 0?"&amp;":"")."order=6&amp;by=".($order == "ratio" && $by == "ASC"?"2":"1")."\">".$language["RATIO"]."</a>".($order == "ratio"?$mark:""));
    if($btit_settings["fmhack_IP_to_country"] == "enabled")
    {
        $userstpl->set("rcountry", "<a href=\"$scriptname&amp;$addparam".(strlen($addparam) > 0?"&amp;":"")."order=7&amp;by=".($order == "country_name" && $by == "ASC"?"2":"1")."\">".$language["REALCOUNTRY"]."</a>".($order == "country_name"?$mark:""));
    }
    if($CURUSER["uid"] > 1)
        $userstpl->set("users_pm", $language["USERS_PM"]);
    if($CURUSER["edit_users"] == "yes")
        $userstpl->set("users_edit", $language["EDIT"]);
    if($CURUSER["delete_users"] == "yes")
        $userstpl->set("users_delete", $language["DELETE"]);
    if($btit_settings["fmhack_ban_button"] == "enabled")
    {
        $userstpl->set("users_ban", $language["DTBAN"]);
    }
    $query1_select = "`u`.`id_level` `base_level`,";
    if($btit_settings["fmhack_simple_donor_display"] == "enabled")
        $query1_select .= "`u`.`donor`,";
    if($btit_settings["fmhack_booted"] == "enabled")
        $query1_select .= "`u`.`booted`,";
    if($btit_settings["fmhack_warning_system"] == "enabled")
        $query1_select .= "`u`.`warn_lev`,";
    if($btit_settings["fmhack_ban_button"] == "enabled")
        $query1_select .= "`u`.`ban`,";
    if($btit_settings["fmhack_uploader_medals"] == "enabled")
        $query1_select .= "`u`.`up_med`,";
    if($btit_settings["fmhack_IP_to_country"] == "enabled")
        $query1_select .= "`u`.`country_name`, `u`.`country_flag`,";
    if($btit_settings["fmhack_user_images"] == "enabled")
        $query1_select .= "`u`.`user_images`,";
    if($btit_settings["fmhack_private_profile"] == "enabled")
        $query1_select .= "`u`.`profileview`,";
    if($btit_settings["fmhack_VIP_freeleech"] == "enabled")
        $query1_select .= "`ul`.`freeleech`, `u`.`vipfl_down`,";
    if($btit_settings["fmhack_logical_rank_ordering"] == "enabled")
        $query1_select .= "`ul`.`logical_rank_order`,";
        $query1_select .= "FORMAT(".($XBTT_USE?'`x`':'`u`').".`uploaded` / ".($XBTT_USE?'`x`':'`u`').".`downloaded` , 2 ) `ratio`,";
    $query = "select ".$query1_select." prefixcolor, suffixcolor, u.id, $udownloaded as downloaded, $uuploaded as uploaded, IF($udownloaded>0,$uuploaded/$udownloaded,0) as ratio, username, level, UNIX_TIMESTAMP(joined) AS joined,UNIX_TIMESTAMP(lastconnect) AS lastconnect, flag, flagpic, c.name as name, u.smf_fid FROM $utables INNER JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id LEFT JOIN {$TABLE_PREFIX}countries c ON u.flag=c.id WHERE u.id>1 $where ORDER BY $order $by $limit";
    $rusers = get_result($query, true, $btit_settings['cache_duration']);
    $userstpl->set("no_users", ($count == 0), true);
    include ("$CURRENTPATH/offset.php");
    $users = array();
    $i = 0;
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
    }
    foreach($rusers as $row_user)
    { // start while
        if($btit_settings["fmhack_logical_rank_ordering"] == "enabled" && $CURUSER["logical_rank_order"]>0 && $row_user["logical_rank_order"]>0)
            $rankOverOrEqual=(($CURUSER["logical_rank_order"] >= $row_user["logical_rank_order"])?true:false);
        else
            $rankOverOrEqual=(($CURUSER["id_level"] >= $row_user["base_level"])?true:false);
        if($btit_settings["fmhack_VIP_freeleech"] == "enabled")
        {
            if($row_user["freeleech"] == "yes")
            {
                $row_user["downloaded"] = $row_user["vipfl_down"];
            }
        }
        if($btit_settings["fmhack_private_profile"] == "enabled")
        {
            //private profile MrFix
            if($row_user["profileview"] == 0)
            {
                $joined = (($row_user["joined"] == 0)?$language["NOT_AVAILABLE"]:date("d/m/Y H:i:s", $row_user["joined"] - $offset));
                $lastconnect = (($row_user["lastconnect"] == 0)?$language["NOT_AVAILABLE"]:date("d/m/Y H:i:s", $row_user["lastconnect"] - $offset));
                $flag = (($row_user["flag"] == 0)?"<img src='images/flag/unknown.gif' alt='".$language["UNKNOWN"]."' title='".$language["UNKNOWN"]."' />":"<img src='images/flag/".$row_user['flagpic']."' alt='".$row_user['name']."' title='".$row_user['name']."' />");
                $private = "<i class=\"fa fa-eye\" aria-hidden=\"true\" title=\"".$language["PP_PUBLIC"]."\"</i>";
            }
            elseif($row_user["profileview"] == 1)
            {
                $joined = "<i class=\"fa fa-ban\" aria-hidden=\"true\" title=\"".$language["PP_PRIVATE"]."\"</i>";
                $lastconnect = "<i class=\"fa fa-ban\" aria-hidden=\"true\" title=\"".$language["PP_PRIVATE"]."\"</i>";
                $flag = "<i class=\"fa fa-ban\" aria-hidden=\"true\" title=\"".$language["PP_PRIVATE"]."\"</i>";
                $private = "<i class=\"fa fa-ban\" aria-hidden=\"true\" title=\"".$language["PP_PRIVATE"]."\"</i>";
            }
            $users[$i]["private"] = $private;
            //private profile MrFix
        }
        if($btit_settings["fmhack_user_images"] == "enabled")
        {
            $selected_images = explode(",", $row_user["user_images"]);
            $j = 1;
            $my_img_list = "";
            foreach($btit_settings as $key => $value)
            {
                if(substr($key, 0, 9) == "user_img_")
                {
                    $value_split = explode("[+]", $value);
                    if(in_array($j, $selected_images))
                    {
                        $my_img_list .= "&nbsp;<img src='images/user_images/".$value_split[0]."' alt='".$value_split[1]."' title='".$value_split[1]."' />";
                    }
                    $j++;
                }
            }
            $users[$i]["user_images"] = $my_img_list;
        }
        if($btit_settings["fmhack_ban_button"] == "enabled" && $row_user["id"]!=$CURUSER["uid"] && $rankOverOrEqual && $row_user["ban"]=="no" && $banButtonAllow)
        {
            if($row_user["ban"] == 'yes')
            {
                $banp = "<i class=\"fa fa-ban\" aria-hidden=\"true\"></i>";
            }
            else
            {
                $banp = "";
            }
        }
        if($btit_settings["fmhack_warning_system"] == "enabled")
        {
            if($btit_settings["warn_max"] == 0)
                $btit_settings["warn_max"] = 10;
            $stage4=$btit_settings["warn_max"];
            $stage3=round($btit_settings["warn_max"]*0.75);
            $stage2=round($btit_settings["warn_max"]*0.5);
            $stage1=round($btit_settings["warn_max"]*0.25);
            $stage0=0;
            if($row_user["warn_lev"] >= $stage4)
                $wl = (($CURUSER["edit_users"] == "yes" || $CURUSER["uid"] == $row_user["id"])?"<a href='index.php?page=warnlog&id=".$row_user["id"]."'>":"")."<img src='images/warned/warn_max.png' alt='".$row_user["warn_lev"]."/".$stage4."' title='".$row_user["warn_lev"]."/".$stage4."' />".(($CURUSER["edit_users"] == "yes" || $CURUSER["uid"] == $row_user["id"])?"</a>":"");
            elseif($row_user["warn_lev"] >= $stage3)
                $wl = (($CURUSER["edit_users"] == "yes" || $CURUSER["uid"] == $row_user["id"])?"<a href='index.php?page=warnlog&id=".$row_user["id"]."'>":"")."<img src='images/warned/warn_3.png' alt='".$row_user["warn_lev"]."/".$stage4."' title='".$row_user["warn_lev"]."/".$stage4."' />".(($CURUSER["edit_users"] == "yes" || $CURUSER["uid"] == $row_user["id"])?"</a>":"");
            elseif($row_user["warn_lev"] >= $stage2)
                $wl = (($CURUSER["edit_users"] == "yes" || $CURUSER["uid"] == $row_user["id"])?"<a href='index.php?page=warnlog&id=".$row_user["id"]."'>":"")."<img src='images/warned/warn_2.png' alt='".$row_user["warn_lev"]."/".$stage4."' title='".$row_user["warn_lev"]."/".$stage4."' />".(($CURUSER["edit_users"] == "yes" || $CURUSER["uid"] == $row_user["id"])?"</a>":"");
            elseif($row_user["warn_lev"] >= $stage1)
                $wl = (($CURUSER["edit_users"] == "yes" || $CURUSER["uid"] == $row_user["id"])?"<a href='index.php?page=warnlog&id=".$row_user["id"]."'>":"")."<img src='images/warned/warn_1.png' alt='".$row_user["warn_lev"]."/".$stage4."' title='".$row_user["warn_lev"]."/".$stage4."' />".(($CURUSER["edit_users"] == "yes" || $CURUSER["uid"] == $row_user["id"])?"</a>":"");
            else
                $wl = "<img src='images/warned/warn_0.png' alt='".$row_user["warn_lev"]."/".$stage4."' title='".$row_user["warn_lev"]."/".$stage4."' />";
            $users[$i]["warns"] = $wl;
        }
        if($btit_settings["fmhack_uploader_medals"] == "enabled")
        {
// DT Uploader Medals
if($btit_settings["fmhack_uploader_medals"]=="enabled")
    {
        if ($CURUSER["up_med"] >= $btit_settings["UPB"])
            $up_med="<i class=\"fa fa-trophy\" aria-hidden=\"true\" title=\"BRONZE MEDAL\" /></i>";
        if ($CURUSER["up_med"] >= $btit_settings["UPS"])
            $up_med="<i class=\"fa fa-trophy\" aria-hidden=\"true\" title=\"SILVER MEDAL\" /></i>";
        if ($CURUSER["up_med"] >= $btit_settings["UPG"])
            $up_med="<i class=\"fa fa-trophy\" aria-hidden=\"true\" title=\"GOLD MEDAL\" /></i>";
    }
// DT Uploader Medals END
        }
        // Xbtit seo by Atmoner
        if($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated_user"] == "true")
            $users[$i]["username"] = "<a href=\"".$row_user["id"]."_".$row_user["username"].".html\">".unesc($row_user["prefixcolor"].$row_user["username"].$row_user["suffixcolor"]).(($btit_settings["fmhack_simple_donor_display"] == "enabled")?get_user_icons($row_user):"").(($btit_settings["fmhack_warning_system"] == "enabled")?warn($row_user):"").(($btit_settings["fmhack_ban_button"] == "enabled")?$banp:"").(($btit_settings["fmhack_uploader_medals"] == "enabled")?$upr:"")."</a>";
        else
            $users[$i]["username"] = "<a href=\"".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated_user"] == "true")?$row_user["id"]."_".strtr($row_user["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$row_user["id"])."\">".unesc($row_user["prefixcolor"].$row_user["username"].$row_user["suffixcolor"]).(($btit_settings["fmhack_simple_donor_display"] == "enabled")?get_user_icons($row_user):"").(($btit_settings["fmhack_warning_system"] == "enabled")?warn($row_user):"").(($btit_settings["fmhack_ban_button"] == "enabled")?$banp:"").(($btit_settings["fmhack_uploader_medals"] == "enabled")?$upr:"")."</a>";
        // Xbtit seo by Atmoner
        $users[$i]["userlevel"] = (($btit_settings["fmhack_group_colours_overall"] == "enabled")?unesc($row_user["prefixcolor"].$row_user["level"].$row_user["suffixcolor"]):$row_user["level"]);
        $users[$i]["joined"] = (($btit_settings["fmhack_private_profile"] == "enabled")?$joined:(($row_user["joined"] == 0)?$language["NOT_AVAILABLE"]:date("d/m/Y H:i:s", $row_user["joined"] - $offset)));
        $users[$i]["lastconnect"] = (($btit_settings["fmhack_private_profile"] == "enabled")?$lastconnect:(($row_user["lastconnect"] == 0)?$language["NOT_AVAILABLE"]:date("d/m/Y H:i:s", $row_user["lastconnect"] - $offset)));
        $users[$i]["flag"] = (($btit_settings["fmhack_private_profile"] == "enabled")?$flag:(($row_user["flag"] == 0)?"<img src='images/flag/unknown.gif' alt='".$language["UNKNOWN"]."' title='".$language["UNKNOWN"]."' />":"<img src='images/flag/".$row_user['flagpic']."' alt='".$row_user['name']."' title='".$row_user['name']."' />"));
        if($btit_settings["fmhack_IP_to_country"] == "enabled")
        {
            $users[$i]["country"] = $row_user["country_name"] == 'unknown'?"<img src='images/flag/unknown.gif' alt='".$language["UNKNOWN"]."' title='".$language["UNKNOWN"]."' />":"<img src='images/flag/".$row_user['country_flag']."' alt='".$row_user['country_name']."' title='".$row_user['country_name']."' />";
        }
        //user ratio
        if($btit_settings["fmhack_IP_to_country"] == "enabled")
        {
            if($row_user["profileview"] == 0)
            {
                if(intval($row_user["downloaded"]) > 0)
                    $ratio = number_format($row_user["uploaded"] / $row_user["downloaded"], 2);
                else
                    $ratio = '&#8734;';
            }
            else
            {
                $ratio = "<i class=\"fa fa-ban\" aria-hidden=\"true\" title=\"".$language["PP_PRIVATE"]."\"</i>";
            }
        }
        else
        {
            if(intval($row_user["downloaded"]) > 0)
                $ratio = number_format($row_user["uploaded"] / $row_user["downloaded"], 2);
            else
                $ratio = '&#8734;';
        }
        $users[$i]["ratio"] = $ratio;
        if($CURUSER["uid"] > 1 && $CURUSER["uid"] != $row_user["id"])
            $users[$i]["pm"] = "<a href=\"".(substr($GLOBALS["FORUMLINK"], 0, 3) == "smf"?"index.php?page=forum&amp;action=pm;sa=send;u=".$row_user["smf_fid"]."":"index.php?page=usercp&amp;do=pm&amp;action=edit&amp;uid=$CURUSER[uid]&amp;what=new&amp;to=".urlencode(unesc($row_user["username"]))."")."\"><i class=\"fa fa-envelope\" aria-hidden=\"true\" title=\"PM User\"</i></a>";
        if($CURUSER["edit_users"] == "yes" && $CURUSER["uid"] != $row_user["id"])
            $users[$i]["edit"] = "<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=users&amp;action=edit&amp;uid=".$row_user["id"]."\">".image_or_link("$STYLEPATH/images/edit.png", "", $language["EDIT"])."</a>";
        if($CURUSER["delete_users"] == "yes" && $CURUSER["uid"] != $row_user["id"])
            $users[$i]["delete"] = "<a onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\" href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=users&amp;action=delete&amp;uid=".$row_user["id"]."&amp;smf_fid=".$row_user["smf_fid"]."&amp;returnto=".urlencode("index.php?page=users")."\">".image_or_link("$STYLEPATH/images/delete.png", "", $language["DELETE"])."</a>";
        if($btit_settings["fmhack_ban_button"] == "enabled" && $row_user["id"]!=$CURUSER["uid"] && $rankOverOrEqual && $row_user["ban"]=="no" && $banButtonAllow)
            $users[$i]["ban"] = "<a href=index.php?page=banbutton&ban_id=".$row_user["id"]."><span style='color:green'>".image_or_link("$STYLEPATH/images/trash.png", "", $language["DTBAN"])."</span></a>";
        $i++;
    } // end while
    $userstpl->set("users", $users);
    $userstpl->set("warn_enabled", (($btit_settings["fmhack_warning_system"] == "enabled")?true:false), true);
    $userstpl->set("warn_enabled2", (($btit_settings["fmhack_warning_system"] == "enabled")?true:false), true);
    $userstpl->set("ban_button_enabled", (($btit_settings["fmhack_ban_button"] == "enabled" && $row_user["id"]!=$CURUSER["uid"] && $rankOverOrEqual && $row_user["ban"]=="no" && $banButtonAllow)?true:false), true);
    $userstpl->set("ban_button_enabled2", (($btit_settings["fmhack_ban_button"] == "enabled" && $row_user["id"]!=$CURUSER["uid"] && $rankOverOrEqual && $row_user["ban"]=="no" && $banButtonAllow)?true:false), true);
    $userstpl->set("ip2c_enabled1", (($btit_settings["fmhack_IP_to_country"] == "enabled" && $CURUSER["delete_users"] == "yes")?true:false), true);
    $userstpl->set("ip2c_enabled2", (($btit_settings["fmhack_IP_to_country"] == "enabled" && $CURUSER["delete_users"] == "yes")?true:false), true);
    $userstpl->set("user_img_enabled", (($btit_settings["fmhack_user_images"] == "enabled")?true:false), true);
    $userstpl->set("privprof_enabled", (($btit_settings["fmhack_private_profile"] == "enabled")?true:false), true);
    $userstpl->set("privprof_enabled2", (($btit_settings["fmhack_private_profile"] == "enabled")?true:false), true);
    $userstpl->set("extra_staff",(($CURUSER['admin_access']=="yes")?true:false),true);
} // end 'view_users'

?>
