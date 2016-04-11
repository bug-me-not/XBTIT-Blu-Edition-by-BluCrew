<?php
$admintpl->set("config_saved",false,true);
$admintpl->set("xbtt_error",false,true);
require_once (load_language("lang_file_hosting.php"));

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
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=file_hosting");        
}
$i=0;
$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
switch ($action)
    {
    case 'write':
      if ($_POST["write"]==$language["FRM_CONFIRM"])
        {

// file host start
        $btit_settings["fhost_file_limit"]=$_POST["fhost_file_limit"];
        $btit_settings["fhost_del"]=$_POST["fhost_del"];
        $btit_settings["fhost_upload"]=$_POST["fhost_upload"];
        $btit_settings["fhost_level_upload"]=$_POST["fhost_level_upload"];
        $btit_settings["fhost_level_download"]=$_POST["fhost_level_download"];
        $btit_settings["fhost_title"]=$_POST["fhost_title"];
        $btit_settings["fhost_page_limit"]=$_POST["fhost_page_limit"];        
//file host end        

        foreach($btit_settings as $key=>$value)
          {
              if (is_bool($value))
               $value==true ? $value='true' : $value='false';

            $values[]="(".sqlesc($key).",".sqlesc($value).")";
        }

        quickQuery("DELETE FROM {$TABLE_PREFIX}settings") or stderr($language["ERROR"],sql_error());
        quickQuery("INSERT INTO {$TABLE_PREFIX}settings (`key`,`value`) VALUES ".implode(",",$values).";") or stderr($language["ERROR"],sql_error());

        unset($values);    

        $admintpl->set("config_saved",true,true);
        }

    case 'read':
    case '':
    default:
        $admintpl->set("language",$language);
        $btit_settings=get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}settings");
                
if($btit_settings["fhost_upload"]=="enabled")
{
$admintpl->set("fhost_upload_enabled", (($btit_settings["fhost_upload"]=="enabled" && $btit_settings["fhost_upload"]=="enabled")?true:false), true);

}
else{
$admintpl->set("fhost_upload_disabled", (($btit_settings["fhost_upload"]=="disabled" && $btit_settings["fhost_upload"]=="enabled")?true:false), true);

}
$admintpl->set("fhost_upload_enabled", (($btit_settings["fhost_upload"]=="enabled")?true:false),true);
$admintpl->set("fhost_upload_disabled", (($btit_settings["fhost_upload"]=="disabled")?true:false),true);
$admintpl->set("fhost_upload_color", (($btit_settings["fhost_upload"]=="enabled")?"#00FF00;":"#FF0000;"));
$admintpl->set("config",$btit_settings);
$admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=config&amp;action=write");
}

?>