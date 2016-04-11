<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["quantity"]) && !empty($_POST["quantity"]) && is_numeric($_POST["quantity"]) && $_POST["quantity"]>=1 && $_POST["quantity"]<=99) ? $quantity=(int)0+$_POST["quantity"] : $quantity=false;
    (isset($_POST["timeframe"]) && !empty($_POST["timeframe"]) && is_numeric($_POST["timeframe"]) && $_POST["timeframe"]>=1 && $_POST["timeframe"]<=3) ? $timeframe=(int)0+$_POST["timeframe"] : $timeframe=false;

    if($quantity===false || $timeframe===false)
    {
        $quantity=7;
        $timeframe=2;
    }

    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$quantity."-".$timeframe."' WHERE `key`='archive_time'", true);
 
    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=archive");
}

$currset=explode("-", $btit_settings["archive_time"]);

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("quantity", $currset[0]);
$admintpl->set("selected1", (($currset[1]==1)?true:false), true);
$admintpl->set("selected2", (($currset[1]==2)?true:false), true);
$admintpl->set("selected3", (($currset[1]==3)?true:false), true);

?>