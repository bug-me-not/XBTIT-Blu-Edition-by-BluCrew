<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["highswitch"]) && $_POST["highswitch"]=="true") ? $highswitch="true" : $highswitch="false";
    (isset($_POST["highonce"]) && $_POST["highonce"]=="true") ? $highonce="true" : $highonce="false";
    (isset($_POST["highspeed"]) && is_numeric($_POST["highspeed"]) && $_POST["highspeed"]>0) ? $highspeed=(int)0+$_POST["highspeed"] : $highspeed=1000;

    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$highswitch."' WHERE `key`='highswitch'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$highonce."' WHERE `key`='highonce'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$highspeed."' WHERE `key`='highspeed'", true);


    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=rep_high_ul");
}

$btit_settings["highswitchyes"]=($btit_settings["highswitch"]?"checked=\"checked\"":"");
$btit_settings["highswitchno"]=(!$btit_settings["highswitch"]?"checked=\"checked\"":"");
$btit_settings["highonceyes"]=($btit_settings["highonce"]?"checked=\"checked\"":"");
$btit_settings["highonceno"]=(!$btit_settings["highonce"]?"checked=\"checked\"":"");

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("config", $btit_settings);

?>