<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  XBtiteam
//
//    This file is part of xbtit.
//
// Social Network Hack by DiemThuy - Nov 2010
// (Major rewrite for xbtitFM by Petr1fied - 29 September 2012)
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
require_once ("include/functions.php");
global $BASEURL, $CURUSER, $language, $btit_settings;
if(!isset($CURUSER) || !is_array($CURUSER))
{
    session_name("BluRG");
    session_start();
    $CURUSER = $_SESSION["CURUSER"];
}
$friendtpl = new bTemplate();
$friendtpl->set("language", $language);
$friendtpl->set("have_pending", false, true);
$friendtpl->set("have_requests", false, true);
$friendtpl->set("have_confirmed", false, true);
$friendtpl->set("have_rejected", false, true);
$do = $_GET["do"];
(isset($_GET["friend_id"]) && is_numeric($_GET["friend_id"]))?$friend_id = (int)0 + $_GET["friend_id"]:$friend_id = false;
(isset($_GET["id"]) && is_numeric($_GET["id"]))?$msg = (int)0 + $_GET["id"]:$msg = false;
if(($do == "add" && $friend_id === false) || (($do == "rem" || $do == "fadd" || $do == "badd" || $do == "del") && $msg === false))
{
    stderr($language["ERROR"], $language["BAD_ID"]);
    exit();
}
// Add member to friendlist
if($do == "add")
{
    $hmm = get_result("SELECT `id` FROM `{$TABLE_PREFIX}friendlist` WHERE `friend_id` = ".$friend_id." AND `user_id` = ".$CURUSER["uid"], true, $btit_settings["cache_duration"]);
    if(count($hmm) > 0)
    {
        stderr($language["ERROR"], $language["FL_ALRFR"]);
        exit();
    }
    if($friend_id == $CURUSER["uid"])
    {
        stderr($language["ERROR"], $language["FL_SELFFR"]);
        exit();
    }
    $qry = get_result("SELECT `username` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$friend_id, true, $btit_settings["cache_duration"]);
    if(count($qry) > 0)
    {
        $res = $qry[0];
        // here we add the un-fooled info in the db
        quickQuery("INSERT INTO {$TABLE_PREFIX}friendlist (user_id, friend_id, friend_name, friend_date, username) VALUES ('".$CURUSER["uid"]."', '".$friend_id."', '".$res["username"]."',NOW(),'".$CURUSER["username"].
            "')", true);
        $subj = sqlesc($language["FL_FRREQ"]);
        $mesg = sqlesc($CURUSER["username"]." ".$language["FL_W2BF2"]);
        send_pm(0, $friend_id, $subj, $mesg);
    }
    redirect("index.php?page=friendlist");
    exit();
}
// Remove pending friend
elseif($do == "rem")
{
    $pme = get_result("SELECT `username`, `friend_id` FROM `{$TABLE_PREFIX}friendlist` WHERE `id`=".$msg, true, $btit_settings["cache_duration"]);
    if(count($pme) > 0)
    {
        $pmoe = $pme[0];
        $subj = sqlesc($language["FL_REQDEL"]);
        $mesg = sqlesc($pmoe["username"]." ".$language["FL_DELREQ_1"]." ".$pmoe["username"]." ".$language["FL_DELREQ_2"]." ".$pmoe["username"]." ".$language["FL_DELREQ_3"].$language["FL_AUTOMSG"]);
        send_pm(0, $pmoe["friend_id"], $subj, $mesg);
        quickQuery("DELETE FROM `{$TABLE_PREFIX}friendlist` WHERE `id`=".$msg, true);
    }
    redirect("index.php?page=friendlist");
    exit();
}
// Add friend
elseif($do == "fadd")
{
    $pm = get_result("SELECT `user_id`, `friend_name` FROM `{$TABLE_PREFIX}friendlist` WHERE `id`=".$msg, true, $btit_settings["cache_duration"]);
    if(count($pm) > 0)
    {
        $pmok = $pm[0];
        $subj = sqlesc($language["FL_FRACC_SUBJ"]);
        $mesg = sqlesc($pmok["friend_name"]." ".$language["FL_FRACC_MSG"].$language["FL_FRCOMMON"].$language["FL_AUTOMSG"]);
        send_pm(0, $pmok["user_id"], $subj, $mesg);
        quickQuery("UPDATE `{$TABLE_PREFIX}friendlist` SET `rejected`='no' , `confirmed` ='yes' , `friend_date` = NOW() WHERE `id`=".$msg, true);
    }
    redirect("index.php?page=friendlist");
    exit();
}
// Add Back
elseif($do == "badd")
{
    $pm = get_result("SELECT `user_id`, `username`, `friend_id`, `friend_name` FROM `{$TABLE_PREFIX}friendlist` WHERE `id`=".$msg, true, $btit_settings["cache_duration"]);
    if(count($pm) > 0)
    {
        $pmok = $pm[0];
        $subj = sqlesc($language["FL_FRREQ"]);
        $mesg = sqlesc($pmok["username"]." ".$language["FL_CHANGEDMIND"].$language["FL_AUTOMSG"]);
        $switch = (($CURUSER["uid"] != $pmok["user_id"])?"yes":"no");
        $one = sqlesc((($switch == "yes")?$pmok["username"]:$pmok["friend_name"]));
        $two = sqlesc((($switch == "yes")?$pmok["friend_name"]:$pmok["username"]));
        $three = (($switch == "yes")?(int)0 + $pmok["user_id"]:(int)0 + $pmok["friend_id"]);
        $four = (($switch == "yes")?(int)0 + $pmok["friend_id"]:(int)0 + $pmok["user_id"]);
        quickQuery("UPDATE `{$TABLE_PREFIX}friendlist` SET `friend_name`='".$one."', `username` ='".$two."', `friend_id` ='".$three."', `user_id` ='".$four.
            "', `rejected`='no' , `confirmed` ='no' , `friend_date` = NOW() WHERE `id`=".$msg, true);
        send_pm(0, $three, $subj, $mesg);
    }
    redirect("index.php?page=friendlist");
    exit();
}
// Unfriend
elseif($do == "del")
{
    $pmm = get_result("SELECT * FROM {$TABLE_PREFIX}friendlist WHERE id=".$msg, true, $btit_settings["cache_duration"]);
    if(count($pmm) > 0)
    {
        $lmok = $pmm[0];
        (($lmok["user_id"] == $CURUSER["uid"])?$rejector = sqlesc($lmok["username"]):(($lmok["friend_id"] == $CURUSER["uid"])?$rejector = sqlesc($lmok["friend_name"]):$rejector = false));
        (($lmok["user_id"] == $CURUSER["uid"])?$var = (int)0 + $lmok["friend_id"]:(($lmok["friend_id"] == $CURUSER["uid"])?$var = (int)0 + $lmok["user_id"]:$var = false));
        if($rejector !== false && $var !== false)
        {
            $subj = sqlesc($language["FL_FRREJ_SUBJ"]);
            $mesg = sqlesc($rejector." ".$language["FL_FRREJ_MSG"].$language["FL_AUTOMSG"]);
            send_pm(0, $var, $subj, $mesg);
            quickQuery("UPDATE `{$TABLE_PREFIX}friendlist` SET `rejected` ='yes', `friend_date` = NOW() WHERE `id`=".$msg, true);
        }
    }
    redirect("index.php?page=friendlist");
    exit();
}
// Main friendlist page
else
{
    // pending
    $qrr = get_result("SELECT `f`.`friend_id` , `f`.`id` , UNIX_TIMESTAMP( `f`.`friend_date` ) `friend_date` , `o`.`lastaction` , `ul`.`prefixcolor` , `ul`.`suffixcolor` , `ul`.`level` , `u`.`username` , `u`.`avatar` , UNIX_TIMESTAMP( `u`.`lastconnect` ) `lastconnect` FROM `{$TABLE_PREFIX}friendlist` `f` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `f`.`friend_id` = `u`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level` = `ul`.`id` LEFT JOIN `{$TABLE_PREFIX}online` `o` ON `u`.`id` = `o`.`user_id` WHERE `f`.`rejected` = 'no' AND `f`.`confirmed` = 'no' AND `f`.`user_id` =".
        $CURUSER["uid"], true, $btit_settings["cache_duration"]);
    if(count($qrr) > 0)
    {
        $friendtpl->set("have_pending", true, true);
        $pending = array();
        $i = 0;
        foreach($qrr as $resrr)
        {
            (is_null($resrr["lastaction"])?$lastseen = $resrr["lastconnect"]:$lastseen = $resrr["lastaction"]);
            $pending[$i]["avatar"] = ($resrr["avatar"] && $resrr["avatar"] != ""?htmlspecialchars($resrr["avatar"]):htmlspecialchars($STYLEURL."/images/default_avatar.gif"));
            $pending[$i]["online_img"] = "images/o".((time() - $lastseen > 900)?"ff":"n")."line.gif";
            $pending[$i]["online_alt"] = $language["FL_O".((time() - $lastseen > 900)?"FF":"N")."LINE"];
            $pending[$i]["id"] = $resrr["id"];
            $pending[$i]["name"] = ("<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$resrr["friend_id"]."_".strtr($resrr["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$resrr["friend_id"])."'>".unesc($resrr["prefixcolor"].$resrr["username"].$resrr["suffixcolor"])."</a>");
            $pending[$i]["level"] = $resrr['level'];
            $pending[$i]["acces"] = date("d/m/Y H:i:s", $resrr['friend_date']);
            $pending[$i]["pm"] = "<a href='index.php?page=usercp&amp;do=pm&amp;action=edit&amp;uid=".$CURUSER["uid"]."&amp;what=new&amp;to=".urlencode(unesc($resrr["username"]))."'>".image_or_link("images/pm.gif",
                "", $language["USERS_PM"])."</a>";
            $pending[$i]["delete"] = ("<a href='index.php?page=friendlist&do=rem&amp;id=".$pending[$i]["id"]."' onclick=\"return confirm('".AddSlashes($language["FL_REMOVE"])."')\">".image_or_link("images/user_remove.png",
                "", $language["DELETE"])."</a>");
            $i++;
        }
    }
    $friendtpl->set("pending", $pending);
    //  friend requests
    $qry = get_result("SELECT `f`.`id`, `f`.`user_id`, UNIX_TIMESTAMP(`f`.`friend_date`) `friend_date`, `o`.`lastaction`, `ul`.`prefixcolor`, `ul`.`suffixcolor`, `ul`.`level`, `u`.`username`, `u`.`avatar`, UNIX_TIMESTAMP(`u`.`lastconnect`) `lastconnect` FROM `{$TABLE_PREFIX}friendlist` `f` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `f`.`user_id`=`u`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` LEFT JOIN `{$TABLE_PREFIX}online` `o` ON `u`.`id` = `o`.`user_id` WHERE `f`.`rejected`='no' AND `f`.`confirmed`='no' AND `f`.`friend_id` = ".
        $CURUSER["uid"], true, $btit_settings["cache_duration"]);
    $friend = array();
    $i = 0;
    if(count($qry) > 0)
    {
        $friendtpl->set("have_requests", true, true);
        foreach($qry as $ret)
        {
            (is_null($ret["lastaction"])?$lastseen = $ret["lastconnect"]:$lastseen = $ret["lastaction"]);
            $friend[$i]["avatar"] = ($ret["avatar"] && $ret["avatar"] != ""?htmlspecialchars($ret["avatar"]):htmlspecialchars($STYLEURL."/images/default_avatar.gif"));
            $friend[$i]["online_img"] = "images/o".((time() - $lastseen > 900)?"ff":"n")."line.gif";
            $friend[$i]["online_alt"] = $language["FL_O".((time() - $lastseen > 900)?"FF":"N")."LINE"];
            $friend[$i]["id"] = $ret["id"];
            $friend[$i]["name"] = ("<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$ret["user_id"]."_".strtr($ret["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$ret["user_id"])."'>".unesc($ret["prefixcolor"].$ret["username"].$ret["suffixcolor"])."</a>");
            $friend[$i]["level"] = $ret['level'];
            $friend[$i]["acces"] = date("d/m/Y H:i:s", $ret['friend_date']);
            $friend[$i]["pm"] = "<a href='index.php?page=usercp&amp;do=pm&amp;action=edit&amp;uid=".$CURUSER["uid"]."&amp;what=new&amp;to=".urlencode(unesc($ret["username"]))."'>".image_or_link("images/pm.gif",
                "", $language["USERS_PM"])."</a>";
            $friend[$i]["add"] = ("<a href=\"index.php?page=friendlist&do=fadd&amp;id=".$friend[$i]["id"]."\" onclick=\"return confirm('".AddSlashes($language["FL_REFRIEND"])."')\">".image_or_link("images/user_accept.png",
                "", $language["ADD"])."</a>");
            $friend[$i]["delete"] = ("<a href=\"index.php?page=friendlist&do=del&amp;id=".$friend[$i]["id"]."\" onclick=\"return confirm('".AddSlashes($language["FL_REJECT"])."')\">".image_or_link("images/user_remove.png",
                "", $language["DELETE"])."</a>");
            $i++;
        }
    }
    $friendtpl->set("friend", $friend);
    // confirmed friends
    $qdt = get_result("SELECT `f`.`id`, `f`.`user_id`, `o1`.`lastaction` `user_lastaction`, `ul1`.`prefixcolor` `user_prefixcolor`, `ul1`.`suffixcolor` `user_suffixcolor`, `ul1`.`level` `user_level`, `u1`.`username` `user_username`, `u1`.`avatar` `user_avatar`, UNIX_TIMESTAMP(`u1`.`lastconnect`) `user_lastconnect`,  `f`.`friend_id`, `o2`.`lastaction` `friend_lastaction`, `ul2`.`prefixcolor` `friend_prefixcolor`, `ul2`.`suffixcolor` `friend_suffixcolor`, `ul2`.`level` `friend_level`, `u2`.`username` `friend_username`, `u2`.`avatar` `friend_avatar`, UNIX_TIMESTAMP(`u2`.`lastconnect`) `friend_lastconnect`, UNIX_TIMESTAMP(`f`.`friend_date`) `friend_date` FROM `{$TABLE_PREFIX}friendlist` `f` LEFT JOIN `{$TABLE_PREFIX}users` `u1` ON `f`.`user_id`=`u1`.`id` LEFT JOIN `{$TABLE_PREFIX}online` `o1` ON `u1`.`id`=`o1`.`user_id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul1` ON `u1`.`id_level`=`ul1`.`id` LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `f`.`friend_id`=`u2`.`id` LEFT JOIN `{$TABLE_PREFIX}online` `o2` ON `u2`.`id`=`o2`.`user_id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul2` ON `u2`.`id_level`=`ul2`.`id` WHERE `f`.`rejected`='no' AND `f`.`confirmed`='yes' AND (`f`.`user_id` = ".
        $CURUSER["uid"]." OR `f`.`friend_id` = ".$CURUSER["uid"].")", true, $btit_settings["cache_duration"]);
    if(count($qdt) > 0)
    {
        $friendtpl->set("have_confirmed", true, true);
        $friends = array();
        $i = 0;
        foreach($qdt as $rdt)
        {
            $type = (($rdt["friend_id"] == $CURUSER["uid"])?1:2);
            $id = $rdt[(($type == 1)?"user":"friend")."_id"];
            $username = $rdt[(($type == 1)?"user":"friend")."_username"];
            $friends[$i]["id"] = $rdt["id"];
            (is_null($rdt[(($type == 1)?"user":"friend")."_lastaction"])?$lastseen = $rdt[(($type == 1)?"user":"friend")."_lastconnect"]:$lastseen = $rdt[(($type == 1)?"user":"friend")."_lastaction"]);
            $friends[$i]["avatar"] = ($rdt[(($type == 1)?"user":"friend")."_avatar"] && $rdt[(($type == 1)?"user":"friend")."_avatar"] != ""?htmlspecialchars($rdt[(($type == 1)?"user":"friend")."_avatar"]):
                htmlspecialchars($STYLEURL."/images/default_avatar.gif"));
            $friends[$i]["online_img"] = "images/o".((time() - $lastseen > 900)?"ff":"n")."line.gif";
            $friends[$i]["online_alt"] = $language["FL_O".((time() - $lastseen > 900)?"FF":"N")."LINE"];
            $friends[$i]["name"] = ("<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$id."_".strtr($username, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$id)."'>".unesc($rdt[(($type == 1)?"user":"friend")."_prefixcolor"].$rdt[(($type == 1)?"user":"friend")."_username"].$rdt[(($type == 1)?
                "user":"friend")."_suffixcolor"])."</a>");
            $friends[$i]["level"] = $rdt[(($type == 1)?"user":"friend")."_level"];
            $friends[$i]["acces"] = date("d/m/Y H:i:s", $rdt['friend_date']);
            $friends[$i]["pm"] = "<a href='index.php?page=usercp&amp;do=pm&amp;action=edit&amp;uid=".$CURUSER["uid"]."&amp;what=new&amp;to=".urlencode(unesc($rdt[(($type == 1)?"user":"friend")."_username"])).
                "'>".image_or_link("images/pm.gif", "", $language["USERS_PM"])."</a>";
            $friends[$i]["delete"] = ("<a href=\"index.php?page=friendlist&do=del&amp;id=".$friends[$i]["id"]."\" onclick=\"return confirm('".AddSlashes($language["FL_UNFRIEND"])."')\">".image_or_link("images/user_remove.png",
                "", $language["DELETE"])."</a>");
            $i++;
        }
    }
    $friendtpl->set("friends", $friends);
    // rejected & unfriend friends
    $qdtt = get_result("SELECT `f`.`id`, `f`.`user_id`, `o1`.`lastaction` `user_lastaction`, `ul1`.`prefixcolor` `user_prefixcolor`, `ul1`.`suffixcolor` `user_suffixcolor`, `ul1`.`level` `user_level`, `u1`.`username` `user_username`, `u1`.`avatar` `user_avatar`, UNIX_TIMESTAMP(`u1`.`lastconnect`) `user_lastconnect`,  `f`.`friend_id`, `o2`.`lastaction` `friend_lastaction`, `ul2`.`prefixcolor` `friend_prefixcolor`, `ul2`.`suffixcolor` `friend_suffixcolor`, `ul2`.`level` `friend_level`, `u2`.`username` `friend_username`, `u2`.`avatar` `friend_avatar`, UNIX_TIMESTAMP(`u2`.`lastconnect`) `friend_lastconnect`, UNIX_TIMESTAMP(`f`.`friend_date`) `friend_date` FROM `{$TABLE_PREFIX}friendlist` `f` LEFT JOIN `{$TABLE_PREFIX}users` `u1` ON `f`.`user_id`=`u1`.`id` LEFT JOIN `{$TABLE_PREFIX}online` `o1` ON `u1`.`id`=`o1`.`user_id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul1` ON `u1`.`id_level`=`ul1`.`id` LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `f`.`friend_id`=`u2`.`id` LEFT JOIN `{$TABLE_PREFIX}online` `o2` ON `u2`.`id`=`o2`.`user_id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul2` ON `u2`.`id_level`=`ul2`.`id` WHERE `f`.`rejected`='yes' AND (`f`.`user_id` = ".
        $CURUSER["uid"]." OR `f`.`friend_id` = ".$CURUSER["uid"].")", true, $btit_settings["cache_duration"]);
    if(count($qdtt) > 0)
    {
        $friendtpl->set("have_rejected", true, true);
        $unfriends = array();
        $i = 0;
    }
    foreach($qdtt as $rdtt)
    {
        $type = (($rdtt["friend_id"] == $CURUSER["uid"])?1:2);
        $id = $rdtt[(($type == 1)?"user":"friend")."_id"];
        $username = $rdtt[(($type == 1)?"user":"friend")."_username"];
        $unfriends[$i]["id"] = $rdtt["id"];
        (is_null($rdtt[(($type == 1)?"user":"friend")."_lastaction"])?$lastseen = $rdtt[(($type == 1)?"user":"friend")."_lastconnect"]:$lastseen = $rdtt[(($type == 1)?"user":"friend")."_lastaction"]);
        $unfriends[$i]["avatar"] = ($rdtt[(($type == 1)?"user":"friend")."_avatar"] && $rdtt[(($type == 1)?"user":"friend")."_avatar"] != ""?htmlspecialchars($rdtt[(($type == 1)?"user":"friend")."_avatar"]):
            htmlspecialchars($STYLEURL."/images/default_avatar.gif"));
        $unfriends[$i]["online_img"] = "images/o".((time() - $lastseen > 900)?"ff":"n")."line.gif";
        $unfriends[$i]["online_alt"] = $language["FL_O".((time() - $lastseen > 900)?"FF":"N")."LINE"];
        $unfriends[$i]["name"] = ("<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$id."_".strtr($username, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$id)."'>".unesc($rdtt[(($type == 1)?"user":"friend")."_prefixcolor"].$rdtt[(($type == 1)?"user":"friend")."_username"].$rdtt[(($type ==
            1)?"user":"friend")."_suffixcolor"])."</a>");
        $unfriends[$i]["level"] = $rdtt[(($type == 1)?"user":"friend")."_level"];
        $unfriends[$i]["acces"] = date("d/m/Y H:i:s", $rdtt['friend_date']);
        $unfriends[$i]["pm"] = "<a href='index.php?page=usercp&amp;do=pm&amp;action=edit&amp;uid=".$CURUSER["uid"]."&amp;what=new&amp;to=".urlencode(unesc($rdtt[(($type == 1)?"user":"friend")."_username"])).
            "'>".image_or_link("images/pm.gif", "", $language["USERS_PM"])."</a>";
        $unfriends[$i]["delete"] = ("<a href=\"index.php?page=friendlist&do=badd&amp;id=".$unfriends[$i]["id"]."\" onclick=\"return confirm('".AddSlashes($language["FL_REFRIEND"])."')\">".image_or_link("images/user_accept.png",
            "", $language["ADD"])."</a>");
        $i++;
    }
}
$friendtpl->set("unfriends", $unfriends);

?>