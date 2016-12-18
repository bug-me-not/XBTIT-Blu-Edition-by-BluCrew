<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");



$admintpl->set("language",  $language);
$admintpl->set("CURUSER", $CURUSER);
$admintpl->set("btit_settings", $btit_settings);
$admintpl->set("wad_enabled", (($btit_settings["warn_auto_down_enable"]=="yes")?true:false), true);
$admintpl->set("booted_enabled", (($btit_settings["fmhack_booted"]=="enabled")?true:false), true);
$admintpl->set("ban_button_enabled", (($btit_settings["fmhack_ban_button"]=="enabled")?true:false), true);
$admintpl->set("tna_checked", false, true);
$admintpl->set("bam_checked", false, true);


if($btit_settings["fmhack_booted"]=="enabled")
{
    if($btit_settings["warn_bantype"]=="no_action_at_max")
        $admintpl->set("tna_checked", true, true);
    elseif($btit_settings["warn_bantype"]=="boot_at_max")
        $admintpl->set("bam_checked", true, true);
}
elseif($btit_settings["fmhack_booted"]=="disabled")
    $admintpl->set("tna_checked", true, true);

if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["warn_max"]) && !empty($_POST["warn_max"]) && is_numeric($_POST["warn_max"]) && $_POST["warn_max"]>0) ? $warn_max=(int)0+$_POST["warn_max"] : $warn_max=10;
    (isset($_POST["warn_auto_decrease"]) && !empty($_POST["warn_auto_decrease"]) && is_numeric($_POST["warn_auto_decrease"]) && $_POST["warn_auto_decrease"]>0) ? $warn_auto_decrease=(int)0+$_POST["warn_auto_decrease"] : $warn_auto_decrease=1;
    (isset($_POST["warn_auto_down_enable"]) && !empty($_POST["warn_auto_down_enable"]) && $_POST["warn_auto_down_enable"]=="on") ? $warn_auto_down_enable="yes" : $warn_auto_down_enable="no";
    (isset($_POST["warn_bantype"]) && !empty($_POST["warn_bantype"]) && ($_POST["warn_bantype"]=="no_action_at_max" || $_POST["warn_bantype"]=="boot_at_max")) ? $warn_bantype=$_POST["warn_bantype"] : $warn_bantype="no_action_at_max";
    (isset($_POST["warn_booted_days"]) && !empty($_POST["warn_booted_days"]) && is_numeric($_POST["warn_booted_days"]) && $_POST["warn_booted_days"]>0 && $warn_bantype=="boot_at_max") ? $warn_booted_days=(int)0+$_POST["warn_booted_days"] : $warn_booted_days=0;
    if($warn_bantype=="boot_at_max" && $warn_booted_days==0)
        $warn_bantype="no_action_at_max";

    if($warn_max!=$btit_settings["warn_max"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` set `value`='".$warn_max."' WHERE `key`='warn_max'",true);
    if($warn_auto_decrease!=$btit_settings["warn_auto_decrease"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` set `value`='".$warn_auto_decrease."' WHERE `key`='warn_auto_decrease'",true);
    if($warn_auto_down_enable!=$btit_settings["warn_auto_down_enable"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` set `value`='".$warn_auto_down_enable."' WHERE `key`='warn_auto_down_enable'",true);
    if($warn_bantype!=$btit_settings["warn_bantype"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` set `value`='".$warn_bantype."' WHERE `key`='warn_bantype'",true);
    if($warn_booted_days!=$btit_settings["warn_booted_days"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` set `value`='".$warn_booted_days."' WHERE `key`='warn_booted_days'",true);

    // Clear the cache files to force an instant update
    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);

    // redirect so that we see the new settings straight away
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=warn_settings");
} 

?>