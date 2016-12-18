<?php
# first check for direct linking
if(!defined('IN_BTIT'))die('non direct access!');


require_once("include/functions.php");

if(!isset($CURUSER) || !is_array($CURUSER))
{
    session_name("BluRG");
    session_start();
    $CURUSER=$_SESSION["CURUSER"];
}
# check if allowed and die if not
if($CURUSER['can_boot']=='no')
    stderr($language["ERROR"], $language["ERR_500"]);
# inits
$booted=addslashes($_POST['booted']);
$id=(int)$_GET['id'];
$returnto = $_POST["returnto"];
$res=get_result("SELECT `username`".(($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_booted"]=="enabled")?", `user_notes`":"")." FROM `{$TABLE_PREFIX}users` WHERE `id`=".$id." LIMIT 1;", false, $btit_settings["cache_duration"]);
$booteduser=$res[0]['username'];
$subj=sqlesc($language['BOOT_RM_SUB']);
$msg=sqlesc('[b]'.$language['BOOT_RM_MSG'].'[/b].');

if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_booted"]=="enabled")
{
    if(isset($res[0]["user_notes"]) && !empty($res[0]["user_notes"]))
        $usernotes=unserialize(unesc($res[0]["user_notes"]));
    else
        $usernotes=array();

    $usernotes[]=base64_encode($booteduser." ".$language["UN_UNBOOTED"]."<+>".$CURUSER["uid"]."<+>".unesc($CURUSER["prefixcolor"].$CURUSER["username"].$CURUSER["suffixcolor"])."<+>".time()); 
    $new_notes=serialize($usernotes); 
}

# process it 
quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `booted`='no', `whybooted`='', `addbooted`='0000-00-00 00:00:00', `whobooted`=''".(($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_booted"]=="enabled")?", `user_notes`='".sql_esc($new_notes)."'":"")." WHERE `id`=".$id);
# message him
quickQuery('INSERT INTO '.$TABLE_PREFIX.'messages (sender, receiver, added, msg, subject) VALUES(0,'.$id.',UNIX_TIMESTAMP(),'.$msg.','.$subj.')')or sqlerr(__FILE__,__LINE__);  
# log it
write_log("Warning canceled for ".$booteduser." by: ".$CURUSER['username'].""," Warning removed");
# send back to original page
header('Location: '.$returnto);
die();
?>