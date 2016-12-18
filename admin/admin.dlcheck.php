<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["mindlratio"]) && is_numeric($_POST["mindlratio"]) && $_POST["mindlratio"]>0) ? $mindlratio=(float)0+$_POST["mindlratio"] : $mindlratio=0.001;

    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$mindlratio."' WHERE `key`='mindlratio'", true);


    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=dlcheck");
}

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("config", $btit_settings);

?>