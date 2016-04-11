<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["user_img_1_img"]) && !empty($_POST["user_img_1_img"]) && isset($_POST["user_img_1_tit"]) && !empty($_POST["user_img_1_tit"])) ? $user_img_1=sqlesc($_POST["user_img_1_img"]."[+]".$_POST["user_img_1_tit"]) : $user_img_1=false;
    (isset($_POST["user_img_2_img"]) && !empty($_POST["user_img_2_img"]) && isset($_POST["user_img_2_tit"]) && !empty($_POST["user_img_2_tit"])) ? $user_img_2=sqlesc($_POST["user_img_2_img"]."[+]".$_POST["user_img_2_tit"]) : $user_img_2=false;
    (isset($_POST["user_img_3_img"]) && !empty($_POST["user_img_3_img"]) && isset($_POST["user_img_3_tit"]) && !empty($_POST["user_img_3_tit"])) ? $user_img_3=sqlesc($_POST["user_img_3_img"]."[+]".$_POST["user_img_3_tit"]) : $user_img_3=false;
    (isset($_POST["user_img_4_img"]) && !empty($_POST["user_img_4_img"]) && isset($_POST["user_img_4_tit"]) && !empty($_POST["user_img_4_tit"])) ? $user_img_4=sqlesc($_POST["user_img_4_img"]."[+]".$_POST["user_img_4_tit"]) : $user_img_4=false;
    (isset($_POST["user_img_5_img"]) && !empty($_POST["user_img_5_img"]) && isset($_POST["user_img_5_tit"]) && !empty($_POST["user_img_5_tit"])) ? $user_img_5=sqlesc($_POST["user_img_5_img"]."[+]".$_POST["user_img_5_tit"]) : $user_img_5=false;
    (isset($_POST["user_img_6_img"]) && !empty($_POST["user_img_6_img"]) && isset($_POST["user_img_6_tit"]) && !empty($_POST["user_img_6_tit"])) ? $user_img_6=sqlesc($_POST["user_img_6_img"]."[+]".$_POST["user_img_6_tit"]) : $user_img_6=false;
    (isset($_POST["user_img_7_img"]) && !empty($_POST["user_img_7_img"]) && isset($_POST["user_img_7_tit"]) && !empty($_POST["user_img_7_tit"])) ? $user_img_7=sqlesc($_POST["user_img_7_img"]."[+]".$_POST["user_img_7_tit"]) : $user_img_7=false;
    (isset($_POST["user_img_8_img"]) && !empty($_POST["user_img_8_img"]) && isset($_POST["user_img_8_tit"]) && !empty($_POST["user_img_8_tit"])) ? $user_img_8=sqlesc($_POST["user_img_8_img"]."[+]".$_POST["user_img_8_tit"]) : $user_img_8=false;
    (isset($_POST["user_img_9_img"]) && !empty($_POST["user_img_9_img"]) && isset($_POST["user_img_9_tit"]) && !empty($_POST["user_img_9_tit"])) ? $user_img_9=sqlesc($_POST["user_img_9_img"]."[+]".$_POST["user_img_9_tit"]) : $user_img_9=false;
    (isset($_POST["user_img_10_img"]) && !empty($_POST["user_img_10_img"]) && isset($_POST["user_img_10_tit"]) && !empty($_POST["user_img_10_tit"])) ? $user_img_10=sqlesc($_POST["user_img_10_img"]."[+]".$_POST["user_img_10_tit"]) : $user_img_10=false;
    (isset($_POST["user_img_11_img"]) && !empty($_POST["user_img_11_img"]) && isset($_POST["user_img_11_tit"]) && !empty($_POST["user_img_11_tit"])) ? $user_img_11=sqlesc($_POST["user_img_11_img"]."[+]".$_POST["user_img_11_tit"]) : $user_img_11=false;
    (isset($_POST["user_img_12_img"]) && !empty($_POST["user_img_12_img"]) && isset($_POST["user_img_12_tit"]) && !empty($_POST["user_img_12_tit"])) ? $user_img_12=sqlesc($_POST["user_img_12_img"]."[+]".$_POST["user_img_12_tit"]) : $user_img_12=false;
    (isset($_POST["user_img_13_img"]) && !empty($_POST["user_img_13_img"]) && isset($_POST["user_img_13_tit"]) && !empty($_POST["user_img_13_tit"])) ? $user_img_13=sqlesc($_POST["user_img_13_img"]."[+]".$_POST["user_img_13_tit"]) : $user_img_13=false;
    (isset($_POST["user_img_14_img"]) && !empty($_POST["user_img_14_img"]) && isset($_POST["user_img_14_tit"]) && !empty($_POST["user_img_14_tit"])) ? $user_img_14=sqlesc($_POST["user_img_14_img"]."[+]".$_POST["user_img_14_tit"]) : $user_img_14=false;
    (isset($_POST["user_img_15_img"]) && !empty($_POST["user_img_15_img"]) && isset($_POST["user_img_15_tit"]) && !empty($_POST["user_img_15_tit"])) ? $user_img_15=sqlesc($_POST["user_img_15_img"]."[+]".$_POST["user_img_15_tit"]) : $user_img_15=false;
    (isset($_POST["user_img_16_img"]) && !empty($_POST["user_img_16_img"]) && isset($_POST["user_img_16_tit"]) && !empty($_POST["user_img_16_tit"])) ? $user_img_16=sqlesc($_POST["user_img_16_img"]."[+]".$_POST["user_img_16_tit"]) : $user_img_16=false;
    (isset($_POST["user_img_17_img"]) && !empty($_POST["user_img_17_img"]) && isset($_POST["user_img_17_tit"]) && !empty($_POST["user_img_17_tit"])) ? $user_img_17=sqlesc($_POST["user_img_17_img"]."[+]".$_POST["user_img_17_tit"]) : $user_img_17=false;

    if($user_img_1 && $user_img_1!=$btit_settings["user_img_1"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_1."' WHERE `key`='user_img_1'", true);
    if($user_img_2 && $user_img_2!=$btit_settings["user_img_2"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_2."' WHERE `key`='user_img_2'", true);
    if($user_img_3 && $user_img_3!=$btit_settings["user_img_3"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_3."' WHERE `key`='user_img_3'", true);
    if($user_img_4 && $user_img_4!=$btit_settings["user_img_4"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_4."' WHERE `key`='user_img_4'", true);
    if($user_img_5 && $user_img_5!=$btit_settings["user_img_5"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_5."' WHERE `key`='user_img_5'", true);
    if($user_img_6 && $user_img_6!=$btit_settings["user_img_6"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_6."' WHERE `key`='user_img_6'", true);
    if($user_img_7 && $user_img_7!=$btit_settings["user_img_7"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_7."' WHERE `key`='user_img_7'", true);
    if($user_img_8 && $user_img_8!=$btit_settings["user_img_8"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_8."' WHERE `key`='user_img_8'", true);
    if($user_img_9 && $user_img_9!=$btit_settings["user_img_9"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_9."' WHERE `key`='user_img_9'", true);
    if($user_img_10 && $user_img_10!=$btit_settings["user_img_10"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_10."' WHERE `key`='user_img_10'", true);
    if($user_img_11 && $user_img_11!=$btit_settings["user_img_11"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_11."' WHERE `key`='user_img_11'", true);
    if($user_img_12 && $user_img_12!=$btit_settings["user_img_12"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_12."' WHERE `key`='user_img_12'", true);
    if($user_img_13 && $user_img_13!=$btit_settings["user_img_13"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_13."' WHERE `key`='user_img_13'", true);
    if($user_img_14 && $user_img_14!=$btit_settings["user_img_14"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_14."' WHERE `key`='user_img_14'", true);
    if($user_img_15 && $user_img_15!=$btit_settings["user_img_15"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_15."' WHERE `key`='user_img_15'", true);
    if($user_img_16 && $user_img_16!=$btit_settings["user_img_16"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_16."' WHERE `key`='user_img_16'", true);
    if($user_img_17 && $user_img_17!=$btit_settings["user_img_17"])
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$user_img_17."' WHERE `key`='user_img_17'", true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=user_images");
}

$user_images=array();
$i=0;

foreach($btit_settings as $key => $value)
{
    if(substr($key,0,9)=="user_img_")
    {
        $value_split=explode("[+]", $value);
        $user_images[$i]["key"]=$key;        
        $user_images[$i]["number"]=(int)((strlen($key)==10)?substr($key,9,1):substr($key,9,2));
        $user_images[$i]["img"]=$value_split[0];
        $user_images[$i]["desc"]=$value_split[1];
        $i++;
    }
}

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("user_images",$user_images);

?>