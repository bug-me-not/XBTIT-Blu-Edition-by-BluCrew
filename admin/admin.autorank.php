<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");

if(isset($_POST) && $_POST["submit"]==$language["SUBMIT"])
{
    (isset($_POST["fullcheck"]) && is_numeric($_POST["fullcheck"]) && $_POST["fullcheck"] >=0 && $_POST["fullcheck"] <=23) ? $fullcheck=$_POST["fullcheck"] : $fullcheck=FALSE;
    (isset($_POST["send_pm"]) && $_POST["send_pm"]=="yes") ? $send_pm="yes" : $send_pm="no";

    if($btit_settings["autorank_sendpm"]!=$send_pm)
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$send_pm."' WHERE `key`='autorank_sendpm'");

    if($fullcheck!==FALSE)
    {
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`=$fullcheck WHERE `key`='autorank_fullcheck'");

        foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
            unlink($filename);
        redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=autorank");
    }
    else
    {
        err_msg($language["ERROR"],$language["AUTORANK_INVALID"]);
        stdfoot();
        exit;
    }
}

$admintpl->set("language",  $language);
$admintpl->set("autorank_action", "index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=autorank");
$admintpl->set("autorank_main",  "index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=groups&action=read");
$admintpl->set("autorank_fullcheck", $btit_settings["autorank_fullcheck"]);
$admintpl->set("selected1", (($btit_settings["autorank_sendpm"]=="no")?true:false), true);
$admintpl->set("selected2", (($btit_settings["autorank_sendpm"]=="yes")?true:false), true);
$admintpl->set("startcol", (($btit_settings["autorank_sendpm"]=="no")?"#FF0000":"#00FF00"));

?>