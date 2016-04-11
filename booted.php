<?php
if(!function_exists('booted_expiration'))
{
    function booted_expiration($timestamp = 0)
    {
        return gmdate('Y-m-d H:i:s', $timestamp);
    }
}

# first check for direct linking
if(!defined("IN_BTIT"))
    die('non direct access!');


require_once("include/functions.php");

global $BASEURL, $CURUSER, $language, $btit_settings;

if(!isset($CURUSER) || !is_array($CURUSER))
{
    session_name("Blu-torrents");
    session_start();
    $CURUSER=$_SESSION["CURUSER"];
}

# check if allowed and die if not
if($CURUSER['can_boot'] == 'no')
    stderr($language["ERROR"], $language["ERR_500"]);

# inits
(isset($_GET["id"]) && is_numeric($_GET["id"]))?$id = (int)0 + $_GET["id"]:$id = 0;
(isset($_POST["booted"]) && !empty($_POST["booted"]))?$booted = addslashes($_POST["booted"]):$booted = false;
(isset($_POST["whybooted"]) && !empty($_POST["whybooted"]))?$whybooted = addslashes($_POST["whybooted"]):$whybooted = false;
(isset($_POST["days"]) && is_numeric($_POST["days"]))?$addbooted = booted_expiration((time() + (((int)0 + $_POST["days"]) * 86400))):$addbooted = false;
(isset($_POST["returnto"]) && !empty($_POST["returnto"]))?$returnto = $_POST["returnto"]:$returnto = "index.php";
$whobooted = addslashes($CURUSER['username']);

# get the username of booted dude
$res = get_result("SELECT `username`".(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_booted"] == "enabled")?", `user_notes`":"")." FROM `{$TABLE_PREFIX}users` WHERE `id`=".$id.
    " LIMIT 1", true, $btit_settings["cache_duration"]);
if(count($res) > 0)
{
    $bootededuser = $res[0]['username'];

    $subj = sqlesc($language['BOOT_GIVE']);
    $msg = sqlesc('[b]'.$language['BOOT_GIVE_REA'].' '.$whybooted.' '.$language['BOOT_GIVE_WHO'].' '.$CURUSER['username'].'[/b]. '.$language['BOOT_GIVE_EXP'].': '.$addbooted.'.');

    if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_booted"] == "enabled")
    {
        if(isset($res[0]["user_notes"]) && !empty($res[0]["user_notes"]))
            $usernotes = unserialize(unesc($res[0]["user_notes"]));
        else
            $usernotes = array();
        $usernotes[] = base64_encode($bootededuser." ".$language["UN_MAN_BOOTED_1"]." [b]".$addbooted."[/b] ".$language["UN_MAN_BOOTED_2"]." [b]".$whybooted."[/b]<+>".$CURUSER["uid"]."<+>".unesc($CURUSER["prefixcolor"].
            $CURUSER["username"].$CURUSER["suffixcolor"])."<+>".time());
        $new_notes = serialize($usernotes);
    }
    # process it in one line as to not stress the database server
    quickQuery("UPDATE {$TABLE_PREFIX}users SET booted='yes', whybooted='".$whybooted."',whobooted='".$whobooted."',addbooted='".$addbooted."'".(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_booted"] ==
        "enabled")?", `user_notes`='".sql_esc($new_notes)."'":"")." WHERE id=".$id, true);
    # message him
    send_pm(0, $id, $subj, $msg);
    # log it
    write_log('booted User: '.$bootededuser.'. Reason: '.$whybooted, 'booted');
}
# send back to original page
header('Location: '.$returnto);
die();

?>