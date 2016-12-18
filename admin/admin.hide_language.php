<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if($btit_settings["fmhack_alternate_login"]=="enabled")
{
$admintpl->set("alternate_login_enabled", (($btit_settings["fmhack_alternate_login"]=="enabled" && $btit_settings["alternate_login"]=="enabled")?false:true), true);		
}
else{
$admintpl->set("alternate_login_enabled", (($btit_settings["fmhack_alternate_login"]=="enabled" && $btit_settings["alternate_login"]=="enabled")?true:false), true);		
}

if($btit_settings["fmhack_add_new_users_in_adminCP"]=="enabled")
{
$admintpl->set("add_new_users_in_adminCP_enabled", (($btit_settings["fmhack_add_new_users_in_adminCP"]=="enabled" && $btit_settings["add_new_users_in_adminCP"]=="enabled")?false:true), true);		
}
else{
$admintpl->set("add_new_users_in_adminCP_enabled", (($btit_settings["fmhack_add_new_users_in_adminCP"]=="enabled" && $btit_settings["add_new_users_in_adminCP"]=="enabled")?true:false), true);		
}

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
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=hide_language");        
}
$i=0;
$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("single", (($btit_settings["loginpagetype"]=="single")?true:false), true);
$admintpl->set("rotating", (($btit_settings["loginpagetype"]=="rotating")?true:false), true);

$admintpl->set("usercp_language_enabled", (($btit_settings["usercp_language"]=="enabled")?true:false),true);
$admintpl->set("usercp_language_disabled", (($btit_settings["usercp_language"]=="disabled")?true:false),true);
$admintpl->set("usercp_language_color", (($btit_settings["usercp_language"]=="enabled")?"#00FF00;":"#FF0000;"));

$admintpl->set("userinfo_language_enabled", (($btit_settings["userinfo_language"]=="enabled")?true:false),true);
$admintpl->set("userinfo_language_disabled", (($btit_settings["userinfo_language"]=="disabled")?true:false),true);
$admintpl->set("userinfo_language_color", (($btit_settings["userinfo_language"]=="enabled")?"#00FF00;":"#FF0000;"));

$admintpl->set("usertoolbar_language_enabled", (($btit_settings["usertoolbar_language"]=="enabled")?true:false),true);
$admintpl->set("usertoolbar_language_disabled", (($btit_settings["usertoolbar_language"]=="disabled")?true:false),true);
$admintpl->set("usertoolbar_language_color", (($btit_settings["usertoolbar_language"]=="enabled")?"#00FF00;":"#FF0000;"));

$admintpl->set("createacc_language_enabled", (($btit_settings["createacc_language"]=="enabled")?true:false),true);
$admintpl->set("createacc_language_disabled", (($btit_settings["createacc_language"]=="disabled")?true:false),true);
$admintpl->set("createacc_language_color", (($btit_settings["createacc_language"]=="enabled")?"#00FF00;":"#FF0000;"));

$admintpl->set("add_new_user_language_enabled", (($btit_settings["add_new_user_language"]=="enabled")?true:false),true);
$admintpl->set("add_new_user_language_disabled", (($btit_settings["add_new_user_language"]=="disabled")?true:false),true);
$admintpl->set("add_new_user_language_color", (($btit_settings["add_new_user_language"]=="enabled")?"#00FF00;":"#FF0000;"));

$admintpl->set("sbg_login_language_enabled", (($btit_settings["sbg_login_language"]=="enabled")?true:false),true);
$admintpl->set("sbg_login_language_disabled", (($btit_settings["sbg_login_language"]=="disabled")?true:false),true);
$admintpl->set("sbg_login_language_color", (($btit_settings["sbg_login_language"]=="enabled")?"#00FF00;":"#FF0000;"));

$admintpl->set("rbg_login_language_enabled", (($btit_settings["rbg_login_language"]=="enabled")?true:false),true);
$admintpl->set("rbg_login_language_disabled", (($btit_settings["rbg_login_language"]=="disabled")?true:false),true);
$admintpl->set("rbg_login_language_color", (($btit_settings["rbg_login_language"]=="enabled")?"#00FF00;":"#FF0000;"));
?>