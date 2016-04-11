<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["type_chat"]) && ($_POST["type_chat"]=="image" || $_POST["type_chat"]=="text" || $_POST["type_chat"]=="both")) ? $type_chat=$_POST["type_chat"] : $type_chat="both";
    (isset($_POST["don_chat"]) && is_numeric($_POST["don_chat"]) && $_POST["don_chat"]>0) ? $don_chat=(int)0+$_POST["don_chat"] : $don_chat=10;

    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$type_chat."' WHERE `key`='type_chat'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$don_chat."' WHERE `key`='don_chat'", true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=img_in_shout");

}

$btit_settings["chat_checked1"]=(($btit_settings["type_chat"]=="image")?"checked='checked'":"");
$btit_settings["chat_checked2"]=(($btit_settings["type_chat"]=="text")?"checked='checked'":"");
$btit_settings["chat_checked3"]=(($btit_settings["type_chat"]=="both")?"checked='checked'":"");

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("config", $btit_settings);

?>