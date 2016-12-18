<?php
if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");

require_once("include/functions.php");
$admintpl->set("config_saved",false,true);
$admintpl->set("xbtt_error",false,true);
require_once (load_language("lang_apply_membership.php"));
global $BASEURL, $CURUSER, $language, $btit_settings, $SITENAME, $USE_IMAGECODE,$THIS_BASEPATH;
$applytpl=new bTemplate();
$applytpl->set("language",$language);

if(isset($_POST) && !empty($_POST))
{
    $enable_all=$_POST["enable_all"];
    unset($_POST["enable_all"]);

    if($enable_all=="enable_all")
    {
        $post=$_POST;
        foreach($post as $k => $v)
        {
            if($v=="disabled")
                $_POST[$k]="enabled";
        }
    }
    elseif($enable_all=="disable_all")
    {
        $post=$_POST;
        foreach($post as $k => $v)
        {
            if($v=="enabled")
                $_POST[$k]="disabled";
        }
    }

    foreach($_POST as $k => $v)
    {
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".sql_esc($v)."' WHERE `key`='".sql_esc($k)."'");

    }

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=apply_membership");        
}
$i=0;
$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);

switch ($action)
    {
    case 'write':
      if ($_POST["write"]==$language["FRM_CONFIRM"])
        {
	    	 $btit_settings["apply_all"]=$_POST["apply_all"];
         $btit_settings["apply_id"]=$_POST["apply_id"];     
	    	 $btit_settings["apply_rules_text"]=$_POST["apply_rules_text"];
         
        foreach($btit_settings as $key=>$value)
          {
              if (is_bool($value))
               $value==true ? $value='true' : $value='false';

            $values[]="(".sqlesc($key).",".sqlesc($value).")";
        }


        quickQuery("INSERT INTO {$TABLE_PREFIX}settings (`key`,`value`) VALUES ".implode(",",$values).";") or stderr($language["ERROR"],sql_error());

        unset($values);    

        $admintpl->set("config_saved",true,true);
        }

    case 'read':
    case '':
    default:
        $admintpl->set("language",$language);
        $btit_settings=get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}settings");
                

$admintpl->set("apply_all_enabled", (($btit_settings["apply_all"]=="enabled")?true:false),true);
$admintpl->set("apply_all_disabled", (($btit_settings["apply_all"]=="disabled")?true:false),true);
$admintpl->set("apply_all_color", (($btit_settings["apply_all"]=="enabled")?"#00FF00;":"#FF0000;"));
$admintpl->set("apply_rules_text",$btit_settings["apply_rules_text"]);

$admintpl->set("config",$btit_settings);
$admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=config&amp;action=write");
}

?>