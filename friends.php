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

require_once("include/functions.php");

global $BASEURL, $CURUSER, $language, $btit_settings;

if(!isset($CURUSER) || !is_array($CURUSER))
{
    session_name("BluRG");
    session_start();
    $CURUSER=$_SESSION["CURUSER"];
}

(isset($_GET["frid"]) && is_numeric($_GET["frid"]))?$friend_id = (int)0 + $_GET["frid"]:$friend_id = 0;

$friendstpl = new bTemplate();
$friendstpl->set("language", $language);
$friendstpl->set("have_friends", false, true);
$friendstpl->set("mutual_enabled_1", (($friend_id!=$CURUSER["uid"])?true:false), true);
$friendstpl->set("mutual_enabled_2", (($friend_id!=$CURUSER["uid"])?true:false), true);
$friendstpl->set("mutual_enabled_3", (($friend_id!=$CURUSER["uid"])?true:false), true);

$name = get_result("SELECT `username` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$friend_id, true, $btit_settings["cache_duration"]);
if(count($name) > 0)
{
    $nam = $name[0];
    $friendstpl->set("un", $nam["username"]);

    $myFriendList=array();    
    $myFrends=get_result("SELECT `user_id`, `friend_id` FROM `{$TABLE_PREFIX}friendlist` WHERE (`user_id`=".$CURUSER["uid"]." OR `friend_id`=".$CURUSER["uid"].") AND `confirmed`='yes' AND rejected='no'", true, $btit_settings["cache_duration"]);
    if(count($myFrends)>0)
    {
        foreach($myFrends as $value)
        {
            $myFriendList[]=(($value["user_id"]==$CURUSER["uid"])?$value["friend_id"]:$value["user_id"]);
        }
    }
    $res = get_result("SELECT `f`.`id`, `f`.`user_id`, `o1`.`lastaction` `user_lastaction`, `ul1`.`prefixcolor` `user_prefixcolor`, `ul1`.`suffixcolor` `user_suffixcolor`, `ul1`.`level` `user_level`, `u1`.`username` `user_username`, `u1`.`avatar` `user_avatar`, UNIX_TIMESTAMP(`u1`.`lastconnect`) `user_lastconnect`,  `f`.`friend_id`, `o2`.`lastaction` `friend_lastaction`, `ul2`.`prefixcolor` `friend_prefixcolor`, `ul2`.`suffixcolor` `friend_suffixcolor`, `ul2`.`level` `friend_level`, `u2`.`username` `friend_username`, `u2`.`avatar` `friend_avatar`, UNIX_TIMESTAMP(`u2`.`lastconnect`) `friend_lastconnect`, UNIX_TIMESTAMP(`f`.`friend_date`) `friend_date` FROM `{$TABLE_PREFIX}friendlist` `f` LEFT JOIN `{$TABLE_PREFIX}users` `u1` ON `f`.`user_id`=`u1`.`id` LEFT JOIN `{$TABLE_PREFIX}online` `o1` ON `u1`.`id`=`o1`.`user_id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul1` ON `u1`.`id_level`=`ul1`.`id` LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `f`.`friend_id`=`u2`.`id` LEFT JOIN `{$TABLE_PREFIX}online` `o2` ON `u2`.`id`=`o2`.`user_id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul2` ON `u2`.`id_level`=`ul2`.`id` WHERE `f`.`rejected`='no' AND `f`.`confirmed`='yes' AND (`f`.`user_id` = ".$friend_id." OR `f`.`friend_id` = ".$friend_id.")", true, $btit_settings["cache_duration"]);
    if(count($res)>0)
    {
        $friendstpl->set("have_friends", true, true);
        $friend = array();
        $i = 0;

        foreach($res as $row)
        {
            $type = (($row["friend_id"] == $friend_id)?1:2);
            $id = $row[(($type == 1)?"user":"friend")."_id"];
            $username = $row[(($type == 1)?"user":"friend")."_username"];
            if($friend_id!=$CURUSER["uid"])
                $friend[$i]["mutual"]=(($row["friend_id"] == $CURUSER["uid"] || $row["user_id"] == $CURUSER["uid"])?$language["FL_THISISU"]:((in_array($row["friend_id"], $myFriendList) || in_array($row["user_id"], $myFriendList))?$language["YES"]:$language["NO"]));
            (is_null($row[(($type == 1)?"user":"friend")."_lastaction"])?$lastseen = $row[(($type == 1)?"user":"friend")."_lastconnect"]:$lastseen = $row[(($type == 1)?"user":"friend")."_lastaction"]);
            $friend[$i]["online_img"] = "images/o".((time() - $lastseen > 900)?"ff":"n")."line.gif";
            $friend[$i]["online_alt"] = $language["FL_O".((time() - $lastseen > 900)?"FF":"N")."LINE"];
            $friend[$i]["id"] = $row["id"];
            $friend[$i]["avatar"] = ($row[(($type == 1)?"user":"friend")."_avatar"] && $row[(($type == 1)?"user":"friend")."_avatar"] != ""?htmlspecialchars($row[(($type == 1)?"user":"friend")."_avatar"]):htmlspecialchars($STYLEURL."/images/default_avatar.gif"));
            $friend[$i]["name"] = ("<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$id."_".strtr($username, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$id)."'>".unesc($row[(($type == 1)?"user":"friend")."_prefixcolor"].$row[(($type == 1)?"user":"friend")."_username"].$row[(($type == 1)?"user":"friend")."_suffixcolor"])."</a>");
            $friend[$i]["level"] = $row[(($type == 1)?"user":"friend")."_level"];
            $friend[$i]["acces"] = date("d/m/Y H:i:s", $row['friend_date']);
            $i++;
        }
    }
    $friendstpl->set("friend", $friend);
}
else
{
    redirect("index.php");
    die();
}

?>