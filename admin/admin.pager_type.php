<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["pager_type"]) && $_POST["pager_type"]=="old") ? $pager_type="old" : $pager_type="new";

    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$pager_type."' WHERE `key`='pager_type'", true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=pgtype");
}

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("pg_old",(($btit_settings["pager_type"]=="old")?true:false),true);
$admintpl->set("pg_new",(($btit_settings["pager_type"]=="new")?true:false),true);

?>