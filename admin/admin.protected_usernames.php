<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    $unarray=explode("\r\n", $_POST["protusers"]);
    $unarray2=$unarray;
    foreach($unarray2 as $key => $value)
    {
       if(empty($value))
           unset($unarray[$key]);
    }
    $newBannedList=implode(",", $unarray);

    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".sql_esc($newBannedList)."' WHERE `key`='banned_usernames'", true);
 
    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=protuser");
}

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("banned_usernames", str_replace(",", "\r\n",$btit_settings["banned_usernames"]));

?>