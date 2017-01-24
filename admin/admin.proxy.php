<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
//    Proxy Detector by DiemThuy ( nov 2009 )
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



$action = $_GET["action"];

if($action =="change")
{
    (isset($_GET["id"]) && !empty($_GET["id"]) && is_numeric($_GET["id"])) ? $ms=(int)0+$_GET["id"] : $ms=0;
    if ($ms==0)
        stderr($language["ERROR"],$language["INVALID_ID"]);

    $user = do_sqlquery("SELECT `allowdownload` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$ms);
    $ar=$user->fetch_assoc();

    if ($ar["allowdownload"]=='yes')
    {
        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `allowdownload`='no' WHERE `id`=".$ms);
        $subj=sqlesc($language["PROX_SUBJ_1"]);
        $msg=sqlesc($language["PROX_MSG_1"]);
        send_pm($CURUSER["uid"],$ms,$subj,$msg);
	}
    else
    {
        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `allowdownload`='yes' WHERE `id`=".$ms);
        $subj=sqlesc($language["PROX_SUBJ_2"]);
        $msg=sqlesc($language["PROX_MSG_2"]);
        send_pm($CURUSER["uid"],$ms,$subj,$msg);
    }
	redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=proxy");
	exit();
}
$proxy = get_result("SELECT u.id, u.username, u.email, u.lastconnect, u.allowdownload, ul.prefixcolor, ul.suffixcolor FROM {$TABLE_PREFIX}users u LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE u.proxy = 'yes'", true, $btit_settings["cache_duration"]);

$log=array();
$i=0;

$admintpl->set("language",$language);

if (count($proxy)==0)
{
    $log[$i]["username"]="<span style='color:green;'>".$language["PROX_NOTHING_1"]."</span>";
    $log[$i]["email"]="<span style='color:red;'>".$language["PROX_NOTHING_2"]."</span>";
    $log[$i]["last"]="<span style='color:green;'>".$language["PROX_NOTHING_3"]."</span>";
    $log[$i]["allow"]="<span style='color:red;'>".$language["PROX_NOTHING_4"]."</span>";
    $log[$i]["change"]="<span style='color:green;'>".$language["PROX_NOTHING_5"]."</span>";
}
else
{
    foreach($proxy as $arr)
    {
        $log[$i]["username"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$arr["id"]."_".strtr($arr["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["id"])."'>".unesc($arr["prefixcolor"].$arr['username'].$arr["suffixcolor"])."</a>";
        $log[$i]["email"]=$arr['email'];
        $log[$i]["last"]=$arr['lastconnect'];
        $log[$i]["allow"]=$arr['allowdownload'];
        $log[$i]["change"]="<center><a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=proxy&amp;action=change&amp;id=".$arr["id"]."\" onclick=\"return confirm('".AddSlashes($language["CHANGE_CONFIRM"])."')\">".image_or_link("$STYLEPATH/images/change.gif","",$language["CHANGED"])."</center></a>";
        $i++;
    }
}
$admintpl->set("proxy",$log);
?>
