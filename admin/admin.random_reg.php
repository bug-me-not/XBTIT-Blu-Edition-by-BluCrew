<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["rreg_open_for"]) && !empty($_POST["rreg_open_for"]) && is_numeric($_POST["rreg_open_for"]) && $_POST["rreg_open_for"]>0) ? $rreg_open_for=(int)0+$_POST["rreg_open_for"] : $rreg_open_for=5;
    (isset($_POST["rreg_min"]) && !empty($_POST["rreg_min"]) && is_numeric($_POST["rreg_min"]) && $_POST["rreg_min"]>0) ? $rreg_min=(int)0+$_POST["rreg_min"] : $rreg_min=15;
    (isset($_POST["rreg_max"]) && !empty($_POST["rreg_max"]) && is_numeric($_POST["rreg_max"]) && $_POST["rreg_max"]>0) ? $rreg_max=(int)0+$_POST["rreg_max"] : $rreg_max=60;

    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$rreg_open_for."' WHERE `key`='rreg_open_for'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$rreg_min."' WHERE `key`='rreg_min'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$rreg_max."' WHERE `key`='rreg_max'", true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=random_reg");
}

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("config", $btit_settings);

?>