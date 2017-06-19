<?php

require_once ("include/functions.php");
require_once ("include/config.php");
dbconn();
session_name("BluRG");
session_start();

global $CURUSER, $TABLE_PREFIX, $THIS_BASEPATH, $db_prefix, $FORUMLINK, $ipb_prefix;

if ($CURUSER["uid"] > 1)
{
    require_once(dirname(__FILE__).load_language("lang_main.php"));
    if(!isset($language["SYSTEM_USER"]))
        $language["SYSTEM_USER"]="System";

    $uid=$CURUSER['uid'];
    $c=$CURUSER["seedbonus"];
    if($c>=$GLOBALS["price_ct"])
    {
        if (isset($_POST["title"]))
            $custom=sqlesc($_POST["title"]);
        else
            $custom = "";

        $p=$GLOBALS["price_ct"];
//var_dump($custom);
        if ($custom == "")
        {
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `custom_title`='', `seedbonus`=`seedbonus`-".$p." WHERE `id`=".$uid, true);
            if(substr($FORUMLINK,0,3)=="smf")
                quickQuery("UPDATE `{$db_prefix}members` SET `usertitle`='' WHERE ".(($FORUMLINK=="smf")?"`ID_MEMBER`":"`id_member`")."=".$CURUSER["smf_fid"], true);
            elseif($FORUMLINK=="ipb")
                quickQuery("UPDATE `{$ipb_prefix}members` SET `title`='' WHERE `member_id`=".$CURUSER["ipb_fid"], true);
        }
        else
        {
//$sql = "UPDATE `{$TABLE_PREFIX}users` SET `custom_title`='".htmlspecialchars($custom)."', `seedbonus`=`seedbonus`-".$p." WHERE `id`=".$uid;
//var_dump($sql);
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `custom_title`=".htmlspecialchars($custom).", `seedbonus`=`seedbonus`-".$p." WHERE `id`=".$uid, true);
            if(substr($FORUMLINK,0,3)=="smf")
                quickQuery("UPDATE `{$db_prefix}members` SET `usertitle`=".htmlspecialchars($custom)." WHERE ".(($FORUMLINK=="smf")?"`ID_MEMBER`":"`id_member`")."=".$CURUSER["smf_fid"], true);
            elseif($FORUMLINK=="ipb")
                quickQuery("UPDATE `{$ipb_prefix}members` SET `title`=".htmlspecialchars($custom)." WHERE `member_id`=".$CURUSER["ipb_fid"], true);
        }
        $_SESSION["CURUSER"]["seedbonus"]-=$p;

        if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_bonus"]=="enabled")
        {
            if(isset($CURUSER["user_notes"]) && !empty($CURUSER["user_notes"]))
                $usernotes=unserialize(unesc($CURUSER["user_notes"]));
            else
                $usernotes=array();

            $usernotes[]=base64_encode("[b]".$CURUSER["username"]."[/b] ".$language["UN_BONUS_GENERAL_1"]." [b]".(int)$p."[/b] ".$language["UN_BONUS_GENERAL_2"]." ".$language["UN_UL_TITLE"]." [b]".$custom."[/b]<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
            $new_notes=serialize($usernotes); 
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$uid); 
        }
    }
    header("Location: index.php?page=modules&module=seedbonus");
}
else
    header("Location: index.php");

?>