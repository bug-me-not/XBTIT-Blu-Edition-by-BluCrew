<?php
if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



$save=isset($_GET["act"])?htmlentities($_GET["act"]):$save='';

switch($save)
{
case 'update';
if($_SERVER["REQUEST_METHOD"]=="POST")
{
$sub=isset($_POST["SUB"])?htmlspecialchars(sql_esc($_POST["SUB"])):$sub='';
$msg=isset($_POST["MSG"])?htmlentities(sql_esc($_POST["MSG"])):$msg='';
$msg=str_replace("&amp;","&",$msg);
if(!empty($sub) && !empty($msg))
{
quickQuery("UPDATE {$TABLE_PREFIX}welcome_msg SET `value`='$sub' WHERE `key`='fm_welcome_sub'",true);
quickQuery("UPDATE {$TABLE_PREFIX}welcome_msg  SET `value`='$msg' WHERE `key`='fm_welcome_msg'",true);
}
redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=welcome_msg");
}
break;
case'':
default;
$msg_settings=get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}welcome_msg");
$admintpl->set("lang",$language);
$admintpl->set("wmset",$msg_settings);
$admintpl->set("wmprevsub",$msg_settings["fm_welcome_sub"]);
$msg_settings["fm_welcome_msg"]=str_replace("amp;","",$msg_settings["fm_welcome_msg"]);
$admintpl->set("wmprev",format_comment($msg_settings["fm_welcome_msg"]));
$admintpl->set("wmbb",textbbcode("welcome","MSG",$msg_settings["fm_welcome_msg"]));
$admintpl->set("wmact","index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=welcome_msg&act=update");
break;
}
?>
