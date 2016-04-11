<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
	$settings["oa_one_text"]=$_POST["oa_one_text"];
	$settings["oa_two_text"]=$_POST["oa_two_text"];
    $settings["oa_three_text"]=$_POST["oa_three_text"];
    $settings["oa_four_text"]=$_POST["oa_four_text"];
    foreach($settings as $key=>$value)
          {
              if (is_bool($value))
               $value==true ? $value='true' : $value='false';

            $values[]="(".sqlesc($key).",".sqlesc($value).")";
        }
quickQuery("DELETE FROM {$TABLE_PREFIX}settings WHERE `key` REGEXP 'oa_[a-z]'") or stderr($language["ERROR"],sql_error());
quickQuery("INSERT INTO {$TABLE_PREFIX}settings (`key`,`value`) VALUES ".implode(",",$values).";") or stderr($language["ERROR"],sql_error());		
redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=admin_agree");
}
$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$fresh_settings=get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}settings WHERE `key` REGEXP 'oa_[a-z]'");
$admintpl->set("config",$fresh_settings);

?>