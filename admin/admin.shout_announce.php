<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["shoutann_display_uploader"]) && $_POST["shoutann_display_uploader"]=="yes") ? $shoutann_display_uploader="yes" : $shoutann_display_uploader="no";

    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$shoutann_display_uploader."' WHERE `key`='shoutann_display_uploader'", true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=shout_announce");
}

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("sdu_yes",(($btit_settings["shoutann_display_uploader"]=="yes")?true:false),true);
$admintpl->set("sdu_no",(($btit_settings["shoutann_display_uploader"]=="no")?true:false),true);

?>