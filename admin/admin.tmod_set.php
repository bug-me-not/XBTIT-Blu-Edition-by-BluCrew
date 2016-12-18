<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["mod_app_pm"]) && ($_POST["mod_app_pm"]=="yes" || $_POST["mod_app_pm"]=="no") && $btit_settings["fmhack_torrent_moderation"]=="enabled") ? $mod_app_pm=$_POST["mod_app_pm"] : $mod_app_pm="yes";
    (isset($_POST["mod_app_sa"]) && ($_POST["mod_app_sa"]=="yes" || $_POST["mod_app_sa"]=="no") && $btit_settings["fmhack_torrent_moderation"]=="enabled") ? $mod_app_sa=$_POST["mod_app_sa"] : $mod_app_sa="yes";

    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$mod_app_pm."' WHERE `key`='mod_app_pm'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$mod_app_sa."' WHERE `key`='mod_app_sa'", true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=tmod_set");
}

$btit_settings["mod_app_pm_1"]=(($btit_settings["mod_app_pm"]=="yes")?"selected='selected'":"");
$btit_settings["mod_app_pm_2"]=(($btit_settings["mod_app_pm"]=="no")?"selected='selected'":"");
$btit_settings["mod_app_pm_color"]=(($btit_settings["mod_app_pm"]=="yes")?"#00FF00;":"#FF0000;");
$btit_settings["mod_app_sa_1"]=(($btit_settings["mod_app_sa"]=="yes")?"selected='selected'":"");
$btit_settings["mod_app_sa_2"]=(($btit_settings["mod_app_sa"]=="no")?"selected='selected'":"");
$btit_settings["mod_app_sa_color"]=(($btit_settings["mod_app_sa"]=="yes")?"#00FF00;":"#FF0000;");

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("config", $btit_settings);

?>