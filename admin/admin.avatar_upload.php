<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["img_file_size"]) && is_numeric($_POST["img_file_size"]) && $_POST["img_file_size"]>0) ? $img_file_size=(int)0+$_POST["img_file_size"] : $img_file_size=0;
    (isset($_POST["img_size_width"]) && is_numeric($_POST["img_size_width"]) && $_POST["img_size_width"]>0) ? $img_size_width=(int)0+$_POST["img_size_width"] : $img_size_width=0;
    (isset($_POST["img_size_height"]) && is_numeric($_POST["img_size_height"]) && $_POST["img_size_height"]>0) ? $img_size_height=(int)0+$_POST["img_size_height"] : $img_size_height=0;
    
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$img_file_size."' WHERE `key`='img_file_size'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$img_size_width."' WHERE `key`='img_size_width'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$img_size_height."' WHERE `key`='img_size_height'", true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=avatar_upload");
}

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("img_file_size", $btit_settings["img_file_size"]);
$admintpl->set("img_size_width", $btit_settings["img_size_width"]);
$admintpl->set("img_size_height", $btit_settings["img_size_height"]);

?>