<?php
if(!defined("IN_BTIT"))
    die("non direct access!");
if(!defined("IN_ACP"))
    die("non direct access!");

$admintpl->set("priority1_iu", true, true);
$admintpl->set("priority1_imdb", false, true);
$admintpl->set("priority1_tvdb", false, true);
$admintpl->set("priority2_iu", false, true);
$admintpl->set("priority2_imdb", true, true);
$admintpl->set("priority2_tvdb", false, true);
$admintpl->set("priority3_iu", false, true);
$admintpl->set("priority3_imdb", false, true);
$admintpl->set("priority3_tvdb", true, true);
$admintpl->set("std_checked", false, true);
$admintpl->set("imdb_checked", false, true);
if(isset($_POST) && !empty($_POST))
{
    $priority1 = (isset($_POST["priority1"]) && is_numeric($_POST["priority1"]))?intval(0 + $_POST["priority1"]):false;
    $priority2 = (isset($_POST["priority2"]) && is_numeric($_POST["priority2"]))?intval(0 + $_POST["priority2"]):false;
    $priority3 = (isset($_POST["priority3"]) && is_numeric($_POST["priority3"]))?intval(0 + $_POST["priority3"]):false;
    if($priority1 === false || $priority2 === false || $priority3 === false)
    {
        stderr($language["ERROR"], $language["TVDB_PRIORITY_ERR1"]);
    }
    elseif($priority1 == $priority2 || $priority1 == $priority3 || $priority2 == $priority3)
    {
        stderr($language["ERROR"], $language["TVDB_PRIORITY_ERR2"]);
    }
    $balloontype = sql_esc($priority1.",".$priority2.",".$priority3);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$balloontype."' WHERE `key`='balloontype'", true);
    foreach(glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=balloons");
}
if($btit_settings["balloontype"] == "imageupload" || $btit_settings["balloontype"] == "imdb" || $btit_settings["balloontype"] == "")
{
}
else
{
    $priority_order = explode(",", $btit_settings["balloontype"]);
    $admintpl->set("priority1_iu", (($priority_order[0] == 1)?true:false), true);
    $admintpl->set("priority1_imdb", (($priority_order[0] == 2)?true:false), true);
    $admintpl->set("priority1_tvdb", (($priority_order[0] == 3)?true:false), true);
    $admintpl->set("priority2_iu", (($priority_order[1] == 1)?true:false), true);
    $admintpl->set("priority2_imdb", (($priority_order[1] == 2)?true:false), true);
    $admintpl->set("priority2_tvdb", (($priority_order[1] == 3)?true:false), true);
    $admintpl->set("priority3_iu", (($priority_order[2] == 1)?true:false), true);
    $admintpl->set("priority3_imdb", (($priority_order[2] == 2)?true:false), true);
    $admintpl->set("priority3_tvdb", (($priority_order[2] == 3)?true:false), true);
}
$admintpl->set("uid", $CURUSER["uid"]);
$admintpl->set("random", $CURUSER["random"]);
$admintpl->set("language", $language);
?>
