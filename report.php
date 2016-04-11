<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
// Report torrent/user hack by DiemThuy - march 2009
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

global $CURUSER;
if($CURUSER["uid"]<=1)
stderr($language["ERROR"],$language["ERROR"],$language['ERR_500']);

$reporttpl = new bTemplate();

(isset($_POST["user"]) && is_numeric($_POST["user"]) && $_POST["user"]>1) ? $takeuser=$_POST["user"] : $takeuser = FALSE;
(isset($_POST["torrent"]) && strlen($_POST["torrent"])==40) ? $taketorrent=sql_esc($_POST["torrent"]) : $taketorrent = FALSE;
(isset($_POST["reason"]) && $_POST["reason"]!="") ? $takereason=sql_esc($_POST["reason"]) : $takereason = FALSE;
(isset($_GET["user"]) && is_numeric($_GET["user"]) && $_GET["user"]>1) ? $user=$_GET["user"] : $user = FALSE;
(isset($_GET["torrent"]) && strlen($_GET["torrent"])==40) ? $torrent=sql_esc($_GET["torrent"]) : $torrent = FALSE;
$reporter = $CURUSER["uid"];

if($user ===FALSE && $takeuser===FALSE && $torrent===FALSE && $taketorrent===FALSE)
{
        stderr($language["ERROR"], $language["REP_ERR"]);
        stdfoot();
        exit();
}
if($takereason===FALSE && ($taketorrent!==FALSE || $takeuser!==FALSE))
{
        stderr($language["ERROR"], $language["REP_NEED_REASON"]);
        stdfoot();
        exit();
}

if ($takeuser!==FALSE && $takereason!==FALSE)
{
    $res = do_sqlquery("SELECT `id` FROM `{$TABLE_PREFIX}reports` WHERE `addedby`= '$reporter' AND `votedfor` = '$takeuser' AND `type` = 'user'",true);// or sqlerr();
    if (@sql_num_rows($res) == 0)
    {
        quickQuery("INSERT INTO `{$TABLE_PREFIX}reports` (`addedby`,`votedfor`,`type`,`reason`) VALUES ('$reporter','$takeuser','user', '$takereason')");// or sqlerr();
        $res2 = get_result("SELECT `username` FROM `{$TABLE_PREFIX}users` WHERE `id` = '$takeuser'",true,$btit_settings["cache_duration"]);
        $name = $res2[0]["username"];

        information_msg($language["REP_SUC_REP"],"<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$takeuser."_".strtr($name, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$takeuser)."'>".$name."</a><br /><br />".$language["REP_STAFF_WILL_CHECK"]);
        stdfoot();
        exit();
    }
    else
    {
        $res2 = get_result("SELECT `username` FROM `{$TABLE_PREFIX}users` WHERE `id` = '$takeuser'",true,$btit_settings["cache_duration"]);
        $name = $res2[0]["username"];

        stderr($language["ERROR"], $language["REP_ALR_REP"]." <a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$takeuser."_".strtr($name, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$takeuser)."'>".$name."</a>");
        stdfoot();
        exit();
    }
}
if ($taketorrent!==FALSE && $takereason!==FALSE)
{
    $res = get_result("SELECT `id` FROM `{$TABLE_PREFIX}reports` WHERE `addedby` = '$reporter' AND `votedfor` = '$taketorrent' AND `type` = 'torrent'",true,$btit_settings["cache_duration"]);
    if (count($res) == 0)
    {
        quickQuery("INSERT INTO `{$TABLE_PREFIX}reports` (`addedby`,`votedfor`,`type`,`reason`) VALUES ('$reporter','$taketorrent','torrent', '$takereason')");
        $res2 = get_result("SELECT `filename` FROM `{$TABLE_PREFIX}files` WHERE `info_hash` = '$taketorrent'",true,$btit_settings["cache_duration"]);
        $name = $res2[0]["filename"];

        information_msg($language["REP_SUC_REP"],"<a href=index.php?page=details&id=$taketorrent>$name</a><br /><br />".$language["REP_STAFF_WILL_CHECK"]);
        stdfoot();
        exit();
    }
    else
    {
        $res2 = get_result("SELECT `filename` FROM `{$TABLE_PREFIX}files` WHERE `info_hash` = '$taketorrent'",true,$btit_settings["cache_duration"]);
        $name = $res2[0]["filename"];

        stderr($language["ERROR"],$language["REP_ALR_REP"]."<br /><a href=index.php?page=details&id=$taketorrent>$name</a>");
        stdfoot();
        exit();

    }
}
if ($user!==FALSE)
{
    $res = get_result("SELECT `id`, `username`, `id_level` FROM `{$TABLE_PREFIX}users` WHERE `id`='$user'",true,$btit_settings["cache_duration"]);
    if (count($res) == 0)
    {
        stderr($language["REP_ERR"],$language["REP_INV_ID"]." (".$user.")");
        stdfoot();
        exit();
    }
    $arr = $res[0];

    if ($arr["id_level"] > 5 && $arr["id_level"] < 9)
    {
        stderr($language["REP_ERR"],$language["REP_NO_STAFF"]);
        stdfoot();
        exit();
    }
	elseif ($reporter==$user)
	{
        stderr($language["REP_ERR"],$language["REP_NOT_SELF"]);
        stdfoot();
        exit();
	}
    else
    {
        information_msg($language["REP_USER"],$language["REP_CONF_1"]." <a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$arr["id"]."_".strtr($arr["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["id"])."'><b>".$arr["username"]."</b></a>?<br /><br />".$language["REP_CONF_2"]."<form method='post' action='index.php?page=report'><input type='hidden' name='user' value='".$user."'><input type='text' size='100' name='reason'><br /><br /><input type='submit' class='btn' value='".$language["FRM_CONFIRM"]."'></form>");
        stdfoot();
        exit();
    }
}
if ($torrent!==FALSE)
{
    $res = get_result("SELECT `filename` FROM `{$TABLE_PREFIX}files` WHERE `info_hash`='$torrent'",true,$btit_settings["cache_duration"]);
    if (count($res) == 0)
    {
        stderr($language["REP_ERR"],$language["REP_INV_TORR"]." (".$torrent.")");
        stdfoot();
        exit();

    }
    $arr = $res[0];

    information_msg($language["REP_TORR"],$language["REP_CONF_1"]." <a href='index.php?page=details&id=".$torrent."'><b>".$arr["filename"]."</b></a>?<br /><br /><b>".$language["REP_CONF_3"]."</b><form method='post' action='index.php?page=report'><input type='hidden' name='torrent' value='".$torrent."'><input type='text' size='100' name='reason'><br /><br /><input type='submit' class='btn' value='".$language["FRM_CONFIRM"]."'></form>");
    stdfoot();
    exit();
}

?>
