<?php

require_once ("include/functions.php");
require_once ("include/config.php");
dbconn();
session_name("Blu-torrents");
session_start();

global $CURUSER, $TABLE_PREFIX, $db_prefix, $THIS_BASEPATH, $language, $btit_settings;

if ($CURUSER["uid"] > 1)
{
    require_once(dirname(__FILE__).load_language("lang_main.php"));
    if(!isset($language["SYSTEM_USER"]))
        $language["SYSTEM_USER"]="System";
    $uid=$CURUSER['uid'];
    $c=$CURUSER["seedbonus"];

    if($c>=$GLOBALS["price_name"])
    {
        if (isset($_POST["name"]))
        {
            $custom=sql_esc($_POST["name"]);
        }
        else
            $custom = "";
        if ($custom=="")
        {
        }
        else
        {
            $res=do_sqlquery("SELECT `id` FROM `{$TABLE_PREFIX}users` WHERE `username`='".htmlspecialchars($custom)."'",true);
            if (@sql_num_rows($res) > 0)
            {
            }
            else
            {
                $p=$GLOBALS["price_name"];
                if($btit_settings["fmhack_protected_usernames"] == "enabled" && !empty($btit_settings["banned_usernames"]))
                {
                    $usernameToEval=strtolower($custom);
                    $bannedUsers = explode(",", strtolower($btit_settings["banned_usernames"]));
                    if(count($bannedUsers) > 0)
                    {
                        foreach($bannedUsers as $bannedUser)
                        {
                            if($usernameToEval == $bannedUser)
                            {
                                die($language["ERR_NAME_BANNED"]);
                            }
                            elseif(strpos($usernameToEval, $bannedUser)!==false)
                            {
                                die($language["ERR_NAME_BANNED"]);
                            }
                        }
                    }
                }
                if($btit_settings["fmhack_previous_usernames"]=="enabled")
                {
                    if($CURUSER["previous_names"]!="")
                    {
                        $oldNames1=explode(",", $CURUSER["previous_names"]);
                        $oldNames2=$oldNames1;
                        foreach($oldNames2 as $key => $value)
                        {
                            if(strtolower($value)==strtolower($custom))
                            {
                                unset($oldNames1[$key]);
                                break;
                            }
                        }
                        $CURUSER["previous_names"]=((count($oldNames1)==0)?"":implode(",",$oldNames1));
                    }
                }
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `username`='".htmlspecialchars($custom)."', `seedbonus`=`seedbonus`-".$p.(($btit_settings["fmhack_previous_usernames"]=="enabled")?", previous_names=".sqlesc((($CURUSER["previous_names"]!="")?$CURUSER["previous_names"].",":"").$CURUSER["username"]):"")."  WHERE `id`=".$uid);
                if (substr($FORUMLINK,0,3)=="smf")
                {
                    quickQuery("UPDATE `{$db_prefix}members` SET  `member".(($FORUMLINK=="smf")?"N":"_n")."ame`='".htmlspecialchars($custom)."' WHERE ".(($FORUMLINK=="smf")?"`ID_MEMBER`":"`id_member`")."=".$CURUSER["smf_fid"]);
                }
                elseif($FORUMLINK=="ipb")
                {
                    if(!defined('IPS_ENFORCE_ACCESS'))
                        define('IPS_ENFORCE_ACCESS', true);
                    if(!defined('IPB_THIS_SCRIPT'))
                        define('IPB_THIS_SCRIPT', 'public');

                    require_once($THIS_BASEPATH. '/ipb/initdata.php' );
                    require_once( IPS_ROOT_PATH . 'sources/base/ipsRegistry.php' );
                    require_once( IPS_ROOT_PATH . 'sources/base/ipsController.php' );
                    $registry = ipsRegistry::instance();
                    $registry->init();
                    $new_username=$custom;
                    $new_l_username=strtolower($new_username);
                    $new_seoname=IPSText::makeSeoTitle($new_username);
                    IPSMember::save($CURUSER["ipb_fid"], array("members" => array("name" => "$new_username", "members_display_name" => "$new_username", "members_l_display_name" => "$new_l_username", "members_l_username" => "$new_l_username", "members_seo_name" => "$new_seoname")));
                }

                if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_bonus"]=="enabled")
                {
                    if(isset($CURUSER["user_notes"]) && !empty($CURUSER["user_notes"]))
                        $usernotes=unserialize(unesc($CURUSER["user_notes"]));
                    else
                        $usernotes=array();

                    $usernotes[]=base64_encode("[b]".$CURUSER["username"]."[/b] ".$language["UN_BONUS_GENERAL_1"]." [b]".(int)$p."[/b] ".$language["UN_BONUS_GENERAL_2"]." ".$language["UN_UL_USERNAME"]." [b]".$custom."[/b]<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                    $new_notes=serialize($usernotes);
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$uid);
                }
                $_SESSION["CURUSER"]["seedbonus"]-=$p;
                $_SESSION["CURUSER"]["username"]=$custom;
                if($btit_settings["fmhack_previous_usernames"]=="enabled")
                {
                    $_SESSION["CURUSER"]["previous_names"]=$CURUSER["previous_names"];
                }
            }
        }
    }
    header("Location: index.php?page=modules&module=seedbonus");
}
else header("Location: index.php");
?>
