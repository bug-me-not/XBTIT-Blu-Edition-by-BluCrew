<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["req_onoff"]) && $_POST["req_onoff"]=="true") ? $req_onoff="true" : $req_onoff="false";
    (isset($_POST["req_shout"]) && $_POST["req_shout"]=="true") ? $req_shout="true" : $req_shout="false";
    (isset($_POST["req_limit"]) && is_numeric($_POST["req_limit"]) && $_POST["req_limit"]>0) ? $req_limit=(int)0+$_POST["req_limit"] : $req_limit=0;
    (isset($_POST["req_prune"]) && is_numeric($_POST["req_prune"]) && $_POST["req_prune"]>0) ? $req_prune=(int)0+$_POST["req_prune"] : $req_prune=0;
    (isset($_POST["req_page"]) && is_numeric($_POST["req_page"]) && $_POST["req_page"]>0) ? $req_page=(int)0+$_POST["req_page"] : $req_page=0;
    (isset($_POST['req_level']) && is_numeric($_POST['req_level']) && $_POST['req_level']>0) ? $req_level=(int)0+$_POST['req_level'] : $req_level=0;
    (isset($_POST["req_bon"]) && is_numeric($_POST["req_bon"]) && $_POST["req_bon"]>0) ? $req_bon=(int)0+$_POST["req_bon"] : $req_bon=0;
    (isset($_POST['req_tax']) && is_numeric($_POST['req_tax']) && $_POST['req_tax']>0) ? $req_tax=(int)0+$_POST['req_tax'] : $req_tax=0;

    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$req_onoff."' WHERE `key`='req_onoff'", true); //done
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$req_shout."' WHERE `key`='req_shout'", true); //done
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$req_limit."' WHERE `key`='req_limit'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$req_prune."' WHERE `key`='req_prune'", true); 
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$req_page."' WHERE `key`='req_page'", true); //done
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$req_level."' WHERE `key`='req_level'",true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$req_bon."' WHERE `key`='req_bon'", true); //done req_bon 
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$req_tax."' WHERE `key`='req_tax'",true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=requests");
}

$btit_settings["req_shoutyes"]=($btit_settings["req_shout"]?"checked=\"checked\"":"");
$btit_settings["req_shoutno"]=(!$btit_settings["req_shout"]?"checked=\"checked\"":"");
$btit_settings["req_onoffyes"]=($btit_settings["req_onoff"]?"checked=\"checked\"":"");
$btit_settings["req_onoffno"]=(!$btit_settings["req_onoff"]?"checked=\"checked\"":"");

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("config", $btit_settings);

?>