<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    quickQuery("DELETE FROM `{$TABLE_PREFIX}settings` WHERE `key` IN('snatched_prefixcolor','snatched_suffixcolor','leeching_prefixcolor','leeching_suffixcolor','seeding_prefixcolor','seeding_suffixcolor','hide_down_img')", true);
    quickQuery("INSERT INTO {$TABLE_PREFIX}settings (`key`, `value`) VALUES ('snatched_prefixcolor', '".((isset($_POST["snatched_prefixcolor"]))?sqlesc(unesc($_POST["snatched_prefixcolor"])):"")."'), ('snatched_suffixcolor', '".((isset($_POST["snatched_suffixcolor"]))?sqlesc(unesc($_POST["snatched_suffixcolor"])):"")."'), ('leeching_prefixcolor', '".sql_esc(unesc($_POST["leeching_prefixcolor"]))."'), ('leeching_suffixcolor', '".sql_esc(unesc($_POST["leeching_suffixcolor"]))."'), ('seeding_prefixcolor', '".sql_esc(unesc($_POST["seeding_prefixcolor"]))."'), ('seeding_suffixcolor', '".sql_esc(unesc($_POST["seeding_suffixcolor"]))."'), ('hide_down_img', '".((isset($_POST["hide_down_img"]) && $_POST["hide_down_img"]=="yes")?"yes":"no")."')", true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=toractcou");
}

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("settings", $btit_settings);
$admintpl->set("checkedYes", (($btit_settings["hide_down_img"]=="no")?false:true), true);
$admintpl->set("checkedNo", (($btit_settings["hide_down_img"]=="no")?true:false), true);
$admintpl->set("downTorrEnabled1", (($btit_settings["fmhack_downloaded_torrents"]=="enabled")?true:false), true);
$admintpl->set("downTorrEnabled2", (($btit_settings["fmhack_downloaded_torrents"]=="enabled")?true:false), true);

?>