<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["prefix"]) && !empty($_POST["prefix"])) ? $prefix=sqlesc($_POST["prefix"]) : $prefix="";
    (isset($_POST["suffix"]) && !empty($_POST["suffix"])) ? $suffix=sqlesc($_POST["suffix"]) : $suffix="";
    
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$prefix."' WHERE `key`='download_prefix'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$suffix."' WHERE `key`='download_suffix'", true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=dlpresuf");
}

$after=$language["DPS_EXAMPLE_TORR"];
if(isset($btit_settings["download_prefix"]) && !empty($btit_settings["download_prefix"]))
    $after="<span style='font-weight:bold;'>".$btit_settings["download_prefix"]."</span>".$after;
if(isset($btit_settings["download_suffix"]) && !empty($btit_settings["download_suffix"]))
    $after=str_replace(".torrent", "", $after)."<span style='font-weight:bold'>".$btit_settings["download_suffix"]."</span>.torrent";

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("prefix",$btit_settings["download_prefix"]);
$admintpl->set("suffix",$btit_settings["download_suffix"]);
$admintpl->set("after",$after);

?>