<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["online_timeout"]) && !empty($_POST["online_timeout"]) && is_numeric($_POST["online_timeout"]) && $_POST["online_timeout"]>0) ? $online_timeout=(int)0+($_POST["online_timeout"]*60) : $online_timeout=false;
 
    if($online_timeout!==false)
    {   
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$online_timeout."' WHERE `key`='online_timeout'", true);
 
        foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
            unlink($filename);
        redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=online");
    }
}

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);

$admintpl->set("online_timeout", ($btit_settings["online_timeout"]/60));
?>