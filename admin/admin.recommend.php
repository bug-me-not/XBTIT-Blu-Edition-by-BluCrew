<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["recommended"]) && !empty($_POST["recommended"]) && is_numeric($_POST["recommended"]) && $_POST["recommended"]>=1) ? $recommended=(int)0+$_POST["recommended"] : $recommended=1;

    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$recommended."' WHERE `key`='recommended'", true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=recommend");
}

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("recommended",$btit_settings["recommended"]);

?>