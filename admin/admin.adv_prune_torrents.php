<?php
if(!defined("IN_BTIT"))
    die("non direct access!");
if(!defined("IN_ACP"))
    die("non direct access!");

if(isset($_POST) && !empty($_POST))
{
    $advprunet_del_torrents=(isset($_POST["advprunet_del_torrents"]) && is_numeric($_POST["advprunet_del_torrents"])) ? (int)0+$_POST["advprunet_del_torrents"]: 30;

    quickQuery("DELETE FROM `{$TABLE_PREFIX}settings` WHERE `key`='advprunet_del_torrents'", true);
    quickQuery("INSERT INTO `{$TABLE_PREFIX}settings` (`key`, `value`) VALUES ('advprunet_del_torrents', '".$advprunet_del_torrents."');", true);

    foreach(glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=adv_prunet");
}

$admintpl->set("advprunet_del_torrents", $btit_settings["advprunet_del_torrents"]);
$admintpl->set("uid", $CURUSER["uid"]);
$admintpl->set("random", $CURUSER["random"]);
$admintpl->set("language", $language);
?>