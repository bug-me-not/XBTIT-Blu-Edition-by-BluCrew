<?php
if(!defined("IN_BTIT"))
    die("non direct access!");
if(!defined("IN_ACP"))
    die("non direct access!");

if(isset($_POST) && !empty($_POST))
{
    $reseed_minSeeds=(isset($_POST["reseed_minSeeds"]) && is_numeric($_POST["reseed_minSeeds"]) && $_POST["reseed_minSeeds"]>=0) ? (int)0+$_POST["reseed_minSeeds"]: 0;
    $reseed_minFinished=(isset($_POST["reseed_minFinished"]) && is_numeric($_POST["reseed_minFinished"]) && $_POST["reseed_minFinished"]>=1) ? (int)0+$_POST["reseed_minFinished"]: 1;
    $reseed_minLeechers=(isset($_POST["reseed_minLeechers"]) && is_numeric($_POST["reseed_minLeechers"]) && $_POST["reseed_minLeechers"]>=1) ? (int)0+$_POST["reseed_minLeechers"]: 1;
    $reseed_minTorrentAgeInDays=(isset($_POST["reseed_minTorrentAgeInDays"]) && is_numeric($_POST["reseed_minTorrentAgeInDays"]) && $_POST["reseed_minTorrentAgeInDays"]>=1) ? (int)0+$_POST["reseed_minTorrentAgeInDays"]: 1;
    $reseed_minDaysSinceLast=(isset($_POST["reseed_minDaysSinceLast"]) && is_numeric($_POST["reseed_minDaysSinceLast"]) && $_POST["reseed_minDaysSinceLast"]>=1) ? (int)0+$_POST["reseed_minDaysSinceLast"]: 1;

    quickQuery("DELETE FROM `{$TABLE_PREFIX}settings` WHERE `key` LIKE 'reseed_%'", true);
    quickQuery("INSERT INTO `{$TABLE_PREFIX}settings` (`key`, `value`) VALUES ('reseed_minSeeds', '".$reseed_minSeeds."'), ('reseed_minFinished', '".$reseed_minFinished."'), ('reseed_minLeechers', '".$reseed_minLeechers."'), ('reseed_minTorrentAgeInDays', '".$reseed_minTorrentAgeInDays."'), ('reseed_minDaysSinceLast', '".$reseed_minDaysSinceLast."');", true);

    foreach(glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=reseed");
}

$admintpl->set("reseed_minSeeds", $btit_settings["reseed_minSeeds"]);
$admintpl->set("reseed_minFinished", $btit_settings["reseed_minFinished"]);
$admintpl->set("reseed_minLeechers", $btit_settings["reseed_minLeechers"]);
$admintpl->set("reseed_minTorrentAgeInDays", $btit_settings["reseed_minTorrentAgeInDays"]);
$admintpl->set("reseed_minDaysSinceLast", $btit_settings["reseed_minDaysSinceLast"]);
$admintpl->set("uid", $CURUSER["uid"]);
$admintpl->set("random", $CURUSER["random"]);
$admintpl->set("language", $language);
?>