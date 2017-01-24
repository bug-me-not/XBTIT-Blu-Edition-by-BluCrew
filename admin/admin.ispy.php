<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
//    Converted from TorrentTrader code to BTI code by teesee64
//    Converted from BTI code to XBTIT-2 code by DiemThuy ( nov 2008 )
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

if(!isset($language["SYSTEM_USER"]))
    $language["SYSTEM_USER"]="System";
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
#FLUSH ALL PM'S
if($action=="preflush")
{
information_msg($language["SPY_INFO"],$language["SPY_INFO_MSG"]);
}
if ($action == "flush")
{
        if(substr($FORUMLINK, 0, 3) == "smf")
        {
            do_sqlquery("TRUNCATE TABLE `{$db_prefix}personal_messages`", true);
            do_sqlquery("TRUNCATE TABLE `{$db_prefix}pm_recipients`", true);
            if($FORUMLINK == "smf")
                quickQuery("UPDATE `{$db_prefix}members` SET `instantMessages`=0,`unreadMessages`=0", true);
            else
                quickQuery("UPDATE `{$db_prefix}members` SET `instant_messages`=0,`unread_messages`=0", true);
        }
        elseif($FORUMLINK == "ipb")
        {
$del = "TRUNCATE TABLE `{$ipb_prefix}message_posts` ";
$do_del = do_sqlquery($del);

if (!$do_del)
{
stderr($language["ERROR"],$language["SPY_ERR_MSG"]);
exit();
}
else
{
$del_topics = "TRUNCATE TABLE `{$ipb_prefix}message_topics` ";
$do_del_topics = do_sqlquery($del_topics);
$do_del_topics1 = do_sqlquery("TRUNCATE TABLE `{$ipb_prefix}message_topic_user_map`");
$do_del_topics2 = do_sqlquery("UPDATE `{$ipb_prefix}members` SET `msg_count_new`=0, `msg_count_total`=0, `msg_count_reset`=1");
$num_del_topics = sql_affected_rows();
if (!$do_del_topics || !$do_del_topics1 || !$do_del_topics2)
{
stderr($language["ERROR"],$language["SPY_ERR_MSG"]);
exit();
}
else
{
#continue
}
}
}else{
do_sqlquery("TRUNCATE TABLE `{$TABLE_PREFIX}messages`", true);
}
success_msg($language["SUCCESS"],$language["SPY_SUCCESS"]);
}
//prune messages
if($action == "prune" && $_SERVER["REQUEST_METHOD"]=="POST")
{
foreach($_POST["pm"] as $pm)
{
$pm=intval(0+$pm);
    if(!empty($pm))
    {
        if(substr($FORUMLINK, 0, 3) == "smf")
        {
            $recsmf = do_sqlquery("SELECT ".(($FORUMLINK == "smf")?"`ID_MEMBER`":"`id_member`")." FROM `{$db_prefix}pm_recipients` WHERE ".(($FORUMLINK == "smf")?"`ID_PM`":"`id_pm`")."=".$pm, true);
            $give = $recsmf->fetch_array();
            quickQuery("DELETE FROM `{$db_prefix}personal_messages` WHERE ".(($FORUMLINK == "smf")?"`ID_PM`":"`id_pm`")."=".$pm, true);
            quickQuery("DELETE FROM `{$db_prefix}pm_recipients` WHERE ".(($FORUMLINK == "smf")?"`ID_PM`":"`id_pm`")."=".$pm, true);
            if($FORUMLINK == "smf")
                quickQuery("UPDATE `{$db_prefix}members` SET `instantMessages`=`instantMessages`-1,`unreadMessages`=`unreadMessages`-1 WHERE `ID_MEMBER`=".$give["ID_MEMBER"], true);
            else
                quickQuery("UPDATE `{$db_prefix}members` SET `instant_messages`=`instant_messages`-1,`unread_messages`=`unread_messages`-1 WHERE `id_member`=".$give["id_member"], true);
        }
        elseif($FORUMLINK == "ipb")
        {
            $recipb = do_sqlquery("SELECT `p`.`msg_topic_id`, `t`.`mt_invited_members`, `t`.`mt_to_member_id` FROM `{$ipb_prefix}message_posts` `p` LEFT JOIN `{$ipb_prefix}message_topics` `t` ON `p`.`msg_topic_id`=`t`.`mt_id` WHERE `p`.`msg_id`=".
                $pm, true);
            $give = $recipb->fetch_array();
            $memberlist = $give["mt_to_member_id"].",";
            $inv = unserialize($give["mt_invited_members"]);
            if(is_array($inv) && !empty($inv))
            {
                foreach($inv as $v)
                    $memberlist .= $v.",";
            }
            $memberlist = trim($memberlist, ",");
            quickQuery("DELETE FROM `{$ipb_prefix}message_topics` WHERE `mt_id`=".$give["msg_topic_id"], true);
            quickQuery("DELETE FROM `{$ipb_prefix}message_topic_user_map` WHERE `map_topic_id`=".$give["msg_topic_id"], true);
            quickQuery("DELETE FROM `{$ipb_prefix}message_posts` WHERE `msg_topic_id`=".$give["msg_topic_id"], true);
            quickQuery("UPDATE `{$ipb_prefix}members` SET `msg_count_new`=`msg_count_new`-1, `msg_count_total`=`msg_count_total`-1, `msg_count_reset`=1 WHERE `member_id` IN(".$memberlist.")", true);
        }
        else
            quickQuery("DELETE FROM `{$TABLE_PREFIX}messages` WHERE `id`=".$pm, true);
    }
}
success_msg($language["SUCCESS"],$language["SPY_SUCCESS"]);
}

// delete messages
if($action == "delete")
{
    (isset($_GET["id"]) && !empty($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] > 0)?$mess_id = (int)0 + $_GET["id"]:$mess_id = false;
    if($mess_id !== false)
    {
        if(substr($FORUMLINK, 0, 3) == "smf")
        {
            $recsmf = do_sqlquery("SELECT ".(($FORUMLINK == "smf")?"`ID_MEMBER`":"`id_member`")." FROM `{$db_prefix}pm_recipients` WHERE ".(($FORUMLINK == "smf")?"`ID_PM`":"`id_pm`")."=".$mess_id, true);
            $give = $recsmf->fetch_array();
            quickQuery("DELETE FROM `{$db_prefix}personal_messages` WHERE ".(($FORUMLINK == "smf")?"`ID_PM`":"`id_pm`")."=".$mess_id, true);
            quickQuery("DELETE FROM `{$db_prefix}pm_recipients` WHERE ".(($FORUMLINK == "smf")?"`ID_PM`":"`id_pm`")."=".$mess_id, true);
            if($FORUMLINK == "smf")
                quickQuery("UPDATE `{$db_prefix}members` SET `instantMessages`=`instantMessages`-1,`unreadMessages`=`unreadMessages`-1 WHERE `ID_MEMBER`=".$give["ID_MEMBER"], true);
            else
                quickQuery("UPDATE `{$db_prefix}members` SET `instant_messages`=`instant_messages`-1,`unread_messages`=`unread_messages`-1 WHERE `id_member`=".$give["id_member"], true);
        }
        elseif($FORUMLINK == "ipb")
        {
            $recipb = do_sqlquery("SELECT `p`.`msg_topic_id`, `t`.`mt_invited_members`, `t`.`mt_to_member_id` FROM `{$ipb_prefix}message_posts` `p` LEFT JOIN `{$ipb_prefix}message_topics` `t` ON `p`.`msg_topic_id`=`t`.`mt_id` WHERE `p`.`msg_id`=".
                $mess_id, true);
            $give = $recipb->fetch_array();
            $memberlist = $give["mt_to_member_id"].",";
            $inv = unserialize($give["mt_invited_members"]);
            if(is_array($inv) && !empty($inv))
            {
                foreach($inv as $v)
                    $memberlist .= $v.",";
            }
            $memberlist = trim($memberlist, ",");
            quickQuery("DELETE FROM `{$ipb_prefix}message_topics` WHERE `mt_id`=".$give["msg_topic_id"], true);
            quickQuery("DELETE FROM `{$ipb_prefix}message_topic_user_map` WHERE `map_topic_id`=".$give["msg_topic_id"], true);
            quickQuery("DELETE FROM `{$ipb_prefix}message_posts` WHERE `msg_topic_id`=".$give["msg_topic_id"], true);
            quickQuery("UPDATE `{$ipb_prefix}members` SET `msg_count_new`=`msg_count_new`-1, `msg_count_total`=`msg_count_total`-1, `msg_count_reset`=1 WHERE `member_id` IN(".$memberlist.")", true);
        }
        else
            quickQuery("DELETE FROM `{$TABLE_PREFIX}messages` WHERE `id`=".$mess_id, true);
    }
}
if(substr($FORUMLINK, 0, 3) == "smf")
    $res2 = do_sqlquery("SELECT COUNT(*) FROM `{$db_prefix}personal_messages`", true);
elseif($FORUMLINK == "ipb")
    $res2 = do_sqlquery("SELECT COUNT(*) FROM `{$ipb_prefix}message_posts`", true);
else
    $res2 = do_sqlquery("SELECT COUNT(*) FROM `{$TABLE_PREFIX}messages`", true);
$row = $res2->fetch_array();
$count = $row[0];
$perpage = ((isset($CURUSER["torrentsperpage"]) && $CURUSER["torrentsperpage"] > 0)?$CURUSER["torrentsperpage"]:15);
list($pagertop, $pagerbottom, $limit) = pager($perpage, $count, "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=ispy&amp;");
$admintpl->set("pager_needed_1", ((isset($pagertop) && !empty($pagertop))?true:false), true);
$admintpl->set("pager_needed_2", ((isset($pagerbottom) && !empty($pagerbottom))?true:false), true);
$admintpl->set("language", $language);
$admintpl->set("pager_top", $pagertop);
$admintpl->set("pager_bottom", $pagerbottom);
if(substr($FORUMLINK, 0, 3) == "smf")
    $res = get_result("SELECT `pm`.".(($FORUMLINK == "smf")?"`ID_PM`":"`id_pm`")." `id`, `pm`.".(($FORUMLINK == "smf")?"`ID_MEMBER_FROM`":"`id_member_from`").
        " `sender`, `u1`.`id` `sender_tracker_id`, `ul1`.`prefixcolor` `sender_tracker_prefixcolor`, `u1`.`username` `sender_tracker_username`, `ul1`.`suffixcolor` `sender_tracker_suffixcolor`, `pmr`.".(($FORUMLINK ==
        "smf")?"`ID_MEMBER`":"`id_member`").
        " `receiver`, `u2`.`id` `receiver_tracker_id`, `ul2`.`prefixcolor` `receiver_tracker_prefixcolor`, `u2`.`username` `receiver_tracker_username`, `ul2`.`suffixcolor` `receiver_tracker_suffixcolor`, `pm`.`msgtime` `added`, `pm`.`subject`, `pm`.`body` `msg`, IF(`pmr`.`is_read`=1,'yes','no') `readed`, `pm`.`from".
        (($FORUMLINK == "smf")?"N":"_n")."ame` `sendername` FROM `{$db_prefix}personal_messages` `pm` LEFT JOIN `{$db_prefix}pm_recipients` `pmr` ON `pm`.".(($FORUMLINK == "smf")?"`ID_PM`":"`id_pm`").
        "=`pmr`.".(($FORUMLINK == "smf")?"`ID_PM`":"`id_pm`")." LEFT JOIN `{$TABLE_PREFIX}users` `u1` ON `pm`.".(($FORUMLINK == "smf")?"`ID_MEMBER_FROM`":"`id_member_from`")."=`u1`.`smf_fid` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul1` ON `u1`.`id_level`=`ul1`.`id` LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `pmr`.".
        (($FORUMLINK == "smf")?"`ID_MEMBER`":"`id_member`")."=`u2`.`smf_fid` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul2` ON `u2`.`id_level`=`ul2`.`id` WHERE `pmr`.`deleted`!=1 ORDER BY `added` DESC $limit", true,
        $btit_settings["cache_duration"]);
elseif($FORUMLINK == "ipb")
    $res = get_result("SELECT `p`.`msg_id` `id`, `p`.`msg_author_id` `sender`, `u1`.`id` `sender_tracker_id`, `ul1`.`prefixcolor` `sender_tracker_prefixcolor`, `u1`.`username` `sender_tracker_username`, `ul1`.`suffixcolor` `sender_tracker_suffixcolor`, `t`.`mt_to_member_id` `receiver`, `u2`.`id` `receiver_tracker_id`, `ul2`.`prefixcolor` `receiver_tracker_prefixcolor`, `u2`.`username` `receiver_tracker_username`, `ul2`.`suffixcolor` `receiver_tracker_suffixcolor`, `p`.`msg_date` `added`, `t`.`mt_title` `subject`, `p`.`msg_post` `msg`, IF(`um`.`map_read_time`>=`p`.`msg_date`,'yes','no') `readed` FROM `{$ipb_prefix}message_posts` `p` LEFT JOIN `{$ipb_prefix}message_topics` `t` ON `p`.`msg_topic_id`=`t`.`mt_id` LEFT JOIN `{$ipb_prefix}message_topic_user_map` `um` ON `p`.`msg_topic_id`=`um`.`map_topic_id` LEFT JOIN `{$TABLE_PREFIX}users` `u1` ON `p`.`msg_author_id`=`u1`.`ipb_fid` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul1` ON `u1`.`id_level`=`ul1`.`id` LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `t`.`mt_to_member_id`=`u2`.`ipb_fid` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul2` ON `u2`.`id_level`=`ul2`.`id` WHERE `mt_to_member_id`=`map_user_id` AND `t`.`mt_is_deleted`!=1 ORDER BY `added` DESC $limit", true,
        $btit_settings["cache_duration"]);
else
    $res = get_result("SELECT `m`.`id`, `m`.`sender`, `m`.`sender` `sender_tracker_id`, `ul1`.`prefixcolor` `sender_tracker_prefixcolor`, `u1`.`username` `sender_tracker_username`, `ul1`.`suffixcolor` `sender_tracker_suffixcolor`, `m`.`receiver`, `m`.`receiver` `receiver_tracker_id`, `ul2`.`prefixcolor` `receiver_tracker_prefixcolor`, `u2`.`username` `receiver_tracker_username`, `ul2`.`suffixcolor` `receiver_tracker_suffixcolor`, `m`.`added`, `m`.`subject`, `m`.`msg`, `m`.`readed` FROM `{$TABLE_PREFIX}messages` `m` LEFT JOIN `{$TABLE_PREFIX}users` `u1` ON `m`.`sender` = `u1`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul1` ON `u1`.`id_level` = `ul1`.`id` LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `m`.`receiver` = `u2`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul2` ON `u2`.`id_level` = `ul2`.`id` ORDER BY `m`.`added` DESC $limit", true,
        $btit_settings["cache_duration"]);
$spy = array();
$i = 0;
include ("$THIS_BASEPATH/include/offset.php");
if(count($res) > 0)
{
    foreach($res as $arr)
    {
        $spy[$i]["id"] = $arr["id"];
        if($arr["sender_tracker_id"] == 0 || is_null($arr["sender_tracker_username"]))
            $spy[$i]["sender"] = ("<b>".$language["SYSTEM_USER"]."</b>");
        else
        {
            $spy[$i]["sender"] = "<a href='".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated_user"] == "true")?$arr["sender_tracker_id"]."_".strtr($arr["sender_tracker_username"], $res_seo["str"],
                $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["sender_tracker_id"])."'><b>".unesc($arr["sender_tracker_prefixcolor"].$arr["sender_tracker_username"].$arr["sender_tracker_suffixcolor"]).
                "</b></a>".((substr($FORUMLINK, 0, 3) == "smf")?" (<a href='index.php?page=forum&action=profile;u=".$arr["sender"]."'>".$language["FORUM"]."</a>)":(($FORUMLINK == "ipb")?
                " (<a href='index.php?page=forum&action=showuser&userid=".$arr["sender"]."'>".$language["FORUM"]."</a>)":""));
        }
        $spy[$i]["receiver"] = "<a href='".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated_user"] == "true")?$arr["receiver_tracker_id"]."_".strtr($arr["receiver_tracker_username"], $res_seo["str"],
            $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["receiver_tracker_id"])."'><b>".unesc($arr["receiver_tracker_prefixcolor"].$arr["receiver_tracker_username"].$arr["receiver_tracker_suffixcolor"]).
            "</b></a>".((substr($FORUMLINK, 0, 3) == "smf")?" (<a href='index.php?page=forum&action=profile;u=".$arr["receiver"]."'>".$language["FORUM"]."</a>)":(($FORUMLINK == "ipb")?
            " (<a href='index.php?page=forum&action=showuser&userid=".$arr["receiver"]."'>".$language["FORUM"]."</a>)":""));
        $spy[$i]["subject"] = format_comment(unesc($arr["subject"]));
        $spy[$i]["msg"] = format_comment(unesc($arr["msg"]));
        $spy[$i]["added"] = date("d/m/Y H:i:s", $arr["added"] - $offset);
        $spy[$i]["readed"] = $arr["readed"];
        $spy[$i]["delete"] = ("<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=ispy&amp;action=delete&amp;id=".$spy[$i]["id"]."\" onclick=\"return confirm('".
            AddSlashes($language["DELETE_CONFIRM"])."')\">".image_or_link("$STYLEPATH/images/delete.png", "", $language["DELETE"])."</a>");
        $i++;
    }
}
$admintpl->set("frmdel", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=ispy&amp;action=prune");
$admintpl->set("flushurl", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=ispy&amp;action=preflush");
$admintpl->set("spy", $spy);
unset($arr);
unset($spy);
?>
