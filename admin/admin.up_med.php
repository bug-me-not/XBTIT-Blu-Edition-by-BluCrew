<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["UPC"]) && $_POST["UPC"]=="true") ? $UPC="true" : $UPC="false";
    (isset($_POST["UPD"]) && is_numeric($_POST["UPD"]) && $_POST["UPD"]>0) ? $UPD=(int)0+$_POST["UPD"] : $UPD=20;
    (isset($_POST["UPB"]) && is_numeric($_POST["UPB"]) && $_POST["UPB"]>0) ? $UPB=(int)0+$_POST["UPB"] : $UPB=1;
    (isset($_POST["UPS"]) && is_numeric($_POST["UPS"]) && $_POST["UPS"]>0) ? $UPS=(int)0+$_POST["UPS"] : $UPS=3;
    (isset($_POST["UPG"]) && is_numeric($_POST["UPG"]) && $_POST["UPG"]>0) ? $UPG=(int)0+$_POST["UPG"] : $UPG=5;
    (isset($_POST["UPBL"]) && is_numeric($_POST["UPBL"]) && $_POST["UPBL"]>0) ? $UPBL=(int)0+$_POST["UPBL"] : $UPBL=10;

    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$UPC."' WHERE `key`='UPC'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$UPD."' WHERE `key`='UPD'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$UPB."' WHERE `key`='UPB'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$UPS."' WHERE `key`='UPS'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$UPG."' WHERE `key`='UPG'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$UPBL."' WHERE `key`='UPBL'", true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=up_med");
}

$btit_settings["UPCyes"]=($btit_settings["UPC"]?"checked=\"checked\"":"");
$btit_settings["UPCno"]=(!$btit_settings["UPC"]?"checked=\"checked\"":"");

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("config", $btit_settings);

?>