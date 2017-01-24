<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $pubkey=isset($_POST["pubkey"])?htmlspecialchars($_POST["pubkey"]):$pubkey='';
    $privkey=isset($_POST["privkey"])?htmlspecialchars($_POST["privkey"]):$privkey='';

    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$pubkey."' WHERE `key`='comment_captcha_pub'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$privkey."' WHERE `key`='comment_captcha_priv'", true);
    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=comment_captcha");
}

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("priv_key",$btit_settings["comment_captcha_priv"]);
$admintpl->set("pub_key",$btit_settings["comment_captcha_pub"]);

?>