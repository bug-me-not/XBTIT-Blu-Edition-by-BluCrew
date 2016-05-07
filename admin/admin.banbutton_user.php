<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
// Ban Button by DiemThuy  - oct 2009
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
if(!defined("IN_ACP"))
    die("non direct access!");


if(!isset($CURUSER) || !is_array($CURUSER))
{
    session_name("BluRG");
    session_start();
    $CURUSER = $_SESSION["CURUSER"];
}
if(isset($_GET["action"]))
    $action = $_GET["action"];
else
    $action = "";
if($action == "unban")
{
    (isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] > 0)?$id = (int)0 + $_GET["id"]:$id = 0;
    if($id != 0)
    {
        if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_banbut"] == "enabled")
        {
            $res = get_result("SELECT `username`, `user_notes` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$id, true, $btit_settings["cache_duration"]);
            if(isset($res[0]["user_notes"]) && !empty($res[0]["user_notes"]))
                $usernotes = unserialize(unesc($res[0]["user_notes"]));
            else
                $usernotes = array();
            $usernotes[] = base64_encode($res[0]["username"]." ".$language["UN_BAN_BUT_2"]."<+>".$CURUSER["uid"]."<+>".unesc($CURUSER["prefixcolor"].$CURUSER["username"].$CURUSER["suffixcolor"])."<+>".time());
            $new_notes = serialize($usernotes);
        }
        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `ban` = 'no', `ban_added`='', `ban_added_by`='',	`ban_comment`=''".(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_banbut"] ==
            "enabled")?", `user_notes`='".sql_esc($new_notes)."'":"")." WHERE `id`=".$id, true);
        if($XBTT_USE)
            quickQuery("UPDATE `xbt_users` SET `can_announce`=1 WHERE `uid`=".$id, true);
    }
    else
        redirect("index.php");
}
$getbanned = get_result("SELECT `u`.`id` `banned_id` , `ul`.`prefixcolor` `banned_prefixcolor` , `u`.`username` `banned_username` , `ul`.`suffixcolor` `banned_suffixcolor` , `u`.`ban_added_by` `banner_id` , `ul2`.`prefixcolor` `banner_prefixcolor` , `u2`.`username` `banner_username` , `ul2`.`suffixcolor` `banner_suffixcolor` , `u`.`ban_added` , `u`.`ban_comment` , `s`.`id` `signup_ip` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level` = `ul`.`id` LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `u`.`ban_added_by` = `u2`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul2` ON `u2`.`id_level` = `ul2`.`id` LEFT JOIN `{$TABLE_PREFIX}signup_ip_block` `s` ON `u`.`ban_comment` = `s`.`comment` WHERE `u`.`ban` = 'yes' ORDER BY `u`.`username` ASC", true,
    $btit_settings["cache_duration"]);
$admintpl->set("language", $language);
if(count($getbanned) == 0)
{
    $banbutton_user[$i]["username"] = ("<center><b><span style='color:green'>".$language["BB_NONE_YET_1"]."</span></b></center>");
    $banbutton_user[$i]["added"] = ("<center><b><span style='color:green'>".$language["BB_NONE_YET_2"]."</span></b></center>");
    $banbutton_user[$i]["by"] = ("<center><b><span style='color:green'>".$language["BB_NONE_YET_3"]."</span></b></center>");
    $banbutton_user[$i]["comment"] = ("<center><b><span style='color:green'>".$language["BB_NONE_YET_4"]."</span></b></center>");
    $banbutton_user[$i]["range"] = ("<center><b><span style='color:green'>".$language["BB_USERS"]."</span></b></center>");
    $banbutton_user[$i]["remove"] = ("<center><b><span style='color:green'>".$language["BB_NONE_YET_7"]."</span></b></center>");
}
else
{
    $i = 0;
    foreach($getbanned as $arr)
    {
        if(!is_null($arr["signup_ip"]))
        {
            $rang = '<span style=\'color:green\'><b>'.$language["YES"].'</b></span>';
        }
        else
        {
            $rang = '<span style=\'color:green\'><b>'.$language["BB_NOT_ANYMORE"].'</b></span>';
        }
        $banbutton_user[$i]["username"] = "<a href='".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated_user"] == "true")?$arr["banned_id"]."_".strtr($arr["banned_username"], $res_seo["str"],
            $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["banned_id"])."'>".unesc($arr["banned_prefixcolor"].$arr['banned_username'].$arr["banned_suffixcolor"])."</a>";
        $banbutton_user[$i]["added"] = get_date_time($arr['ban_added']);
        $banbutton_user[$i]["by"] = "<a href='".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated_user"] == "true")?$arr["banner_id"]."_".strtr($arr["banner_username"], $res_seo["str"],
            $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["banner_id"])."'>".unesc($arr["banner_prefixcolor"].$arr['banner_username'].$arr["banner_suffixcolor"])."</a>";
        $banbutton_user[$i]["comment"] = $arr['ban_comment'];
        $banbutton_user[$i]["range"] = $rang;
        $banbutton_user[$i]["remove"] = "<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=banbutton_user&amp;action=unban&amp;id=".$arr["banned_id"]."\" onclick=\"return confirm('".
            str_replace("'", "\'", $language["DELETE_CONFIRM"])."')\">".image_or_link("$STYLEPATH/images/delete.png", "", $language["DELETE"])."</a>";
        $i++;
    }
}
$admintpl->set("banbutton_user", $banbutton_user);

?>