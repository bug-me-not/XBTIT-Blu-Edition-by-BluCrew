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

if (!defined("IN_BTIT"))
      die("non direct access!");


require_once("include/functions.php");

global $BASEURL, $CURUSER, $language, $btit_settings;

if(!isset($CURUSER) || !is_array($CURUSER))
{
    session_name("BluRG");
    session_start();
    $CURUSER=$_SESSION["CURUSER"];
}

if(is_integer($btit_settings["banbutton"]) || substr($btit_settings["banbutton"], 0, 4)!="lro-")
    stderr($language["ERROR"], $language["ERR_NEEDS_RECONFIG_1"]." <b>Ban Button</b> ".$language["ERR_NEEDS_RECONFIG_2"].(($CURUSER["admin_access"]=="no")?"<br /><br />".$language["ERR_NEEDS_RECONFIG_3"]:""));

$lroPerms=explode("-", $btit_settings["banbutton"]);
if($btit_settings["fmhack_logical_rank_ordering"]=="enabled")
{
    if($lroPerms[1]==1 && $lroPerms[2]>0)
        $rankUnder=(($CURUSER["logical_rank_order"]<$lroPerms[2])?true:false);
    else
        stderr($language["ERROR"], $language["ERR_NEEDS_RECONFIG_1"]." <b>Ban Button</b> ".$language["ERR_NEEDS_RECONFIG_2"].(($CURUSER["admin_access"]=="no")?"<br /><br />".$language["ERR_NEEDS_RECONFIG_3"]:""));
}
elseif($btit_settings["fmhack_logical_rank_ordering"]=="disabled")
{
    if($lroPerms[1]==0 && $lroPerms[2]>0)
        $rankUnder=(($CURUSER["id_level"]<$lroPerms[2])?true:false);
    else
        stderr($language["ERROR"], $language["ERR_NEEDS_RECONFIG_1"]." <b>Ban Button</b> ".$language["ERR_NEEDS_RECONFIG_2"].(($CURUSER["admin_access"]=="no")?"<br /><br />".$language["ERR_NEEDS_RECONFIG_3"]:""));
}
if ($rankUnder)
{
    redirect("index.php?page=users"); // redirects to users.php if no staff
    exit();
}

$do = $_GET["do"];
$ban_id = (int)0+$_GET["ban_id"];

$banbuttontpl= new bTemplate();
$banbuttontpl-> set("language",$language);
$banbuttontpl->set("form","<form method=post action=index.php?page=banbutton&do=add&ban_id=".$ban_id.">");

// Add member to banlist

if ($do=="add")
{
    (isset($_GET["ban_id"]) && is_numeric($_GET["ban_id"])) ? $ban_id=(int)0+$_GET["ban_id"]  : $ban_id=0;

    $qry = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users WHERE id = '$ban_id'");
    $res = $qry->fetch_array();

    $user = $res["username"];
    $comment =$_POST["comment"];
    $info =  ($user. ' - ' .$comment);
    $by = $CURUSER["uid"];

    if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_banbut"]=="enabled")
    {
        if(isset($res["user_notes"]) && !empty($res["user_notes"]))
            $usernotes=unserialize(unesc($res["user_notes"]));
        else
            $usernotes=array();

        $usernotes[]=base64_encode($res["username"]." ".$language["UN_BAN_BUT_1"]." [b]".$comment."[/b]<+>".$CURUSER["uid"]."<+>".unesc($CURUSER["prefixcolor"].$CURUSER["username"].$CURUSER["suffixcolor"])."<+>".time());
        $new_notes=serialize($usernotes);
    }
    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `ban` ='yes', `ban_comment`='".sql_esc($info)."', `ban_added_by`=".$by.", `ban_added`=UNIX_TIMESTAMP()".(($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_banbut"]=="enabled")?", `user_notes`='".sql_esc($new_notes)."'":"")." WHERE `id`=".$ban_id );
    signup_ip_ban(long2ip($res["lip"]),$info);

    if($XBTT_USE)
        quickQuery("UPDATE `xbt_users` SET `can_announce`=0 WHERE `uid`=".$ban_id);

    redirect("index.php?page=users");
}

?>
