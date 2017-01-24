<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["ulri_edit"]) && $_POST["ulri_edit"]=="yes") ? $ulri_edit="yes" : $ulri_edit="no";
    (isset($_POST["ulri_delete"]) && $_POST["ulri_delete"]=="yes") ? $ulri_delete="yes" : $ulri_delete="no";
    
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$ulri_edit."' WHERE `key`='ulri_edit'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$ulri_delete."' WHERE `key`='ulri_delete'", true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=ulrights");
}

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("edit_yes",(($btit_settings["ulri_edit"]=="yes")?true:false),true);
$admintpl->set("edit_no",(($btit_settings["ulri_edit"]=="no")?true:false),true);
$admintpl->set("delete_yes",(($btit_settings["ulri_delete"]=="yes")?true:false),true);
$admintpl->set("delete_no",(($btit_settings["ulri_delete"]=="no")?true:false),true);

?>