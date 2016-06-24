<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
// Redistribution and use in source and binary forms, with or without modification,
// are permitted provided that the following conditions are met:
//
//   1. Redistributions of source code must retain the above copyright notice,
//      this list of conditions and the following disclaimer.
//   2. Redistributions in binary form must reproduce the above copyright notice,
//      this list of conditions and the following disclaimer in the documentation
//      and/or other materials provided with the distribution.
//   3. The name of the author may not be used to endorse or promote products
//      derived from this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
// WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
// MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
// IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
// TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
// PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
// LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
// NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
// EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
////////////////////////////////////////////////////////////////////////////////////
if(!defined("IN_BTIT"))
    die("non direct access!");

switch($action)
{
    case 'post':
        $idlangue = (isset($_POST["language"])?intval(0 + $_POST["language"]):0);
        $idstyle = (isset($_POST["style"])?intval(0 + $_POST["style"]):0);
        $email = AddSlashes($_POST["email"]);
        $avatar = str_replace(array(
            '\t',
            '%25',
            '%00'), array(
            '',
            '',
            ''), htmlspecialchars(AddSlashes($_POST["avatar"])));
        if($btit_settings["fmhack_signature_on_internal_forum"] == "enabled")
        {
            $signature = str_replace(array(
                '\t',
                '%25',
                '%00'), array(
                '',
                '',
                ''), htmlspecialchars(AddSlashes($_POST["signature"])));
        }
        $idflag = intval(0 + $_POST["flag"]);
        $timezone = intval($_POST["timezone"]);
        if($btit_settings["fmhack_about_me"] == "enabled")
        {
            (isset($_POST["about_me"]) && !empty($_POST["about_me"]))?$about_me = sql_esc($_POST["about_me"]):$about_me = "";
        }
        if($btit_settings["fmhack_birthdays"] == "enabled")
        {
            $dobday = str_pad(intval($_POST["dobday"]), 2, 0, STR_PAD_LEFT);
            $dobmonth = str_pad(intval($_POST["dobmonth"]), 2, 0, STR_PAD_LEFT);
            $dobyear = str_pad(intval($_POST["dobyear"]), 4, 0, STR_PAD_LEFT);
            $realdate = checkdate($dobmonth, $dobday, $dobyear);
            if($realdate)
            {
                $dob = $dobyear."-".$dobmonth."-".$dobday;
                $age = userage($dobyear, $dobmonth, $dobday);
                $dobtime = mktime(0, 0, 0, $dobmonth, $dobday, $dobyear);
                if($dobtime > time())
                {
                    err_msg($language["ERROR"], $language["ERR_BORN_IN_FUTURE"]);
                    stdfoot();
                    exit();
                }
                elseif($age < $btit_settings["birthday_lower_limit"])
                {
                    err_msg($language["ERROR"], $language["ERR_DOB_1"].$age.$language["ERR_DOB_2"]);
                    stdfoot();
                    exit();
                }
                elseif($age > $btit_settings["birthday_upper_limit"])
                {
                    err_msg($language["ERROR"], $language["ERR_DOB_1"].$age.$language["ERR_DOB_2"]);
                    stdfoot();
                    exit();
                }
            }
            else
            {
                err_msg($language["ERROR"], $language["INVALID_DOB_1"].$dobday."/".$dobmonth."/".$dobyear.$language["INVALID_DOB_2"]);
                stdfoot();
                exit();
            }
        }
        if($btit_settings["fmhack_hide_online_status"] == "enabled" && $CURUSER["can_hide"] == "yes")
            $invisible = $_POST["invisible"]?"yes":"no";
        if($btit_settings["fmhack_show_or_hide_porn"] == "enabled")
            $showporn = $_POST["showporn"]?"yes":"no";
        if($btit_settings["fmhack_force_ssl"] == "enabled")
            $force = $_POST["force"]?"yes":"no";
        // Password confirmation required to update user record
        (isset($_POST["passconf"]))?$passcheck = hash_generate(array("salt" => $CURUSER["salt"]), $_POST["passconf"], $CURUSER["username"]):$passcheck = array();
        if(isset($passcheck[$btit_settings["secsui_pass_type"]]) && is_array($passcheck[$btit_settings["secsui_pass_type"]]))
            $password = $passcheck[$btit_settings["secsui_pass_type"]]["hash"];
        else
            $password = "";
        if($password == "" || $CURUSER["password"] != $password)
        {
            stderr($language["ERROR"], $language["ERR_PASS_WRONG"]);
            stdfoot();
            exit();
        }
        // Password confirmation required to update user record
        // check avatar is a valid image and one of the supported file types
        if($avatar && $avatar != "")
        {
            $imagearr = @getimagesize($avatar);
            if(!is_array($imagearr) || !in_array($imagearr["mime"], array(
                "image/bmp",
                "image/jpeg",
                "image/pjpeg",
                "image/gif",
                "image/x-png",
                "image/png")))
                stderr($language["ERROR"], $language["ERR_AVATAR_EXT"]);
        }
        if($email == "")
        {
            err_msg($language["ERROR"], $language["ERR_NO_EMAIL"]);
            stdfoot();
            exit;
        }
        else
        {
            // Reverify Mail Hack by Petr1fied - Start --->
            if($VALIDATION == "user")
            {
                // Send a verification e-mail to the e-mail address they want to change it to
                if(($email != "") && ($email != $CURUSER["email"]))
                {
                    $id = $CURUSER["uid"];
                    // Generate a random number between 10000 and 99999
                    $floor = 100000;
                    $ceiling = 999999;
                    srand((double)microtime() * 1000000);
                    $random = rand($floor, $ceiling);
                    // Update the members record with the random number and store the email they want to change to
                    quickQuery("UPDATE {$TABLE_PREFIX}users SET random='".$random."', temp_email='".$email."' WHERE id='".$id."'", true);
                    // Send the verification email
                    @ini_set("sendmail_from", "");
                    if(sql_errno() == 0)
                        send_mail($email, $language["EMAIL_VERIFY"], $language["EMAIL_VERIFY_MSG"]."\n\n".$BASEURL."/index.php?page=usercp&do=verify&action=changemail&newmail=".$email."&uid=".$id."&random=".$random."",
                            "From: ".$SITENAME." <".$SITEEMAIL.">") or stderr($language["ERROR"], $language["EMAIL_FAILED"]);
                }
            }
            $set = array();
            if($VALIDATION != "user")
            {
                if($email != "")
                {
                    $set[] = "email='$email'";
                    if(substr($GLOBALS["FORUMLINK"], 0, 3) == "smf")
                    {
                        quickQuery("UPDATE `{$db_prefix}members` SET `email".(($GLOBALS["FORUMLINK"] == "smf")?"A":"_a")."ddress`='".$email."' WHERE ".(($GLOBALS["FORUMLINK"] == "smf")?"`ID_MEMBER`":"`id_member`")."=".$CURUSER["smf_fid"]);
                    }
                    elseif($GLOBALS["FORUMLINK"] == "ipb")
                    {
                        if(!defined('IPS_ENFORCE_ACCESS'))
                            define('IPS_ENFORCE_ACCESS', true);
                        if(!defined('IPB_THIS_SCRIPT'))
                            define('IPB_THIS_SCRIPT', 'public');
                        require_once ($THIS_BASEPATH.'/ipb/initdata.php');
                        require_once (IPS_ROOT_PATH.'sources/base/ipsRegistry.php');
                        require_once (IPS_ROOT_PATH.'sources/base/ipsController.php');
                        $registry = ipsRegistry::instance();
                        $registry->init();
                        IPSMember::save($CURUSER["ipb_fid"], array("members" => array("email" => "$email")));
                    }
                }
            }
            // <--- Reverify Mail Hack by Petr1fied - End

            //Profile Status Start
    if (isset($_POST['status']) && ($status = $_POST['status']) && !empty($status)) {
        do_sqlquery("INSERT INTO {$TABLE_PREFIX}profile_status (userid, last_status, last_update) VALUES (".sqlesc($CURUSER['uid']).", ".sqlesc($status).", ".time().") ON DUPLICATE KEY UPDATE last_status = values(last_status), last_update = values(last_update)") or sqlerr(__FILE__, __LINE__);
    }
    //Profile Status End

            if($idlangue > 0)
                $set[] = "language=$idlangue";
            if($idstyle > 0)
                $set[] = "style=$idstyle";
            if($idflag > 0)
                $set[] = "flag=$idflag";
            if($btit_settings["fmhack_about_me"] == "enabled")
                $set[] = "about_me='".$about_me."'";
            $set[] = "time_offset='$timezone'";
            $set[] = "avatar='$avatar'";
            if($btit_settings["fmhack_signature_on_internal_forum"] == "enabled")
            {
                $set[] = "signature='$signature'";
            }
            $set[] = "topicsperpage=".intval(0 + $_POST["topicsperpage"]);
            $set[] = "postsperpage=".intval(0 + $_POST["postsperpage"]);
            $set[] = "torrentsperpage=".intval(0 + $_POST["torrentsperpage"]);
            if($btit_settings["fmhack_pM_notification_on_torrent_comment"]=="enabled")
            {
                $commentpm = isset($_POST["commentpm"])?"true":"false";
                $set[]="commentpm='".$commentpm."'";
            }
            if($btit_settings["fmhack_birthdays"] == "enabled")
            {
                if(isset($dob))
                    $set[] = "dob='$dob'";
            }
            if($btit_settings["fmhack_account_parked"] == "enabled")
                $set[] = "is_parked=".((isset($_POST["parkme"]) && $_POST["parkme"] == "on")?"'yes'":"'no'");
            if($btit_settings["fmhack_hide_online_status"] == "enabled" && $CURUSER["can_hide"] == "yes")
                $set[] = "invisible='$invisible'";
            if($btit_settings["fmhack_force_ssl"] == "enabled")
                $set[] = "force_ssl='$force'";
            if($btit_settings["fmhack_show_or_hide_porn"] == "enabled")
                $set[] = "showporn='$showporn'";
            if($btit_settings["fmhack_private_profile"] == "enabled")
                $set[] = "profileview=".intval(0 + $_POST["profileview"]);
            if($btit_settings["fmhack_default_cat_browse"]=="enabled")
                $set[]="catins='".((isset($_POST["cat_groups"]) && !empty($_POST["cat_groups"]))?implode(",",$_POST["cat_groups"]):"")."'";
            $updateset = implode(",", $set);
            // Reverify Mail Hack by Petr1fied - Start --->
            // If they've tried to change their e-mail, give them a message telling them as much
            if(($email != "") && ($VALIDATION == "user") && ($email != $CURUSER["email"]))
            {
                success_msg($language["EMAIL_VERIFY_BLOCK"], "".$language["EMAIL_VERIFY_SENT1"]." ".$email." ".$language["EMAIL_VERIFY_SENT2"]."<a href=\"".$BASEURL."\">".$language["MNU_INDEX"]."</a>");
                stdfoot(true, false);
                exit;
            }
            elseif($updateset != "") // <--- Reverify Mail Hack by Petr1fied - End
            {
                quickQuery("UPDATE {$TABLE_PREFIX}users SET $updateset WHERE id='".$uid."'", true);
                if($idlangue!=$CURUSER["language"] || $idstyle!=$CURUSER["style"])
                {
                    session_name("BluRG");
                    session_start();
                    unset($_SESSION["CURUSER"], $_SESSION["CURUSER_EXPIRE"]);
                }
                success_msg($language["SUCCESS"], $language["INF_CHANGED"]."<br /><a href=\"index.php?page=usercp&amp;uid=".$uid."\">".$language["BCK_USERCP"]."</a>");
                stdfoot(true, false);
                exit;
            }
        }
        break;
    case '':
    case 'change':
    default:
        $usercptpl->set("AVATAR", false, true);
        $usercptpl->set("USER_VALIDATION", false, true);
        $usercptpl->set("INTERNAL_FORUM", false, true);
        $profiletpl = array();
        if($btit_settings["fmhack_default_cat_browse"]=="enabled")
        {
            $catlist=get_result('SELECT * FROM '.$TABLE_PREFIX.'categories ORDER BY id', true, $CACHE_DURATION);
            $cat_checks='';
            if (count($catlist))
            {
                $bl=0;
                $cat_checks.='<table><tr>';
                foreach($catlist as $id => $meow)
                {
                    $list = explode(",", $CURUSER['catins']);
                    $bl++;
                    $cat_checks.='<td><input type="checkbox" name="cat_groups[]" '.(in_array($meow['id'],$list,true)?' checked="checked" ':'').'value="'.$meow['id'].'" />&nbsp;'.$meow['name']."</td>\n";
                    if ($bl % 8 == 0)
                    $cat_checks.='</tr><tr>';
                }
                while ($bl % 8 !=0 )
                {
                    $cat_checks.='<td>&nbsp;</td>';
                    $bl++;
                }
                $cat_checks.='</tr></table><br />';
            }
            $usercptpl->set("catlist", $cat_checks);
        }
        if($btit_settings["fmhack_birthdays"] == "enabled")
        {
            $usercptpl->set("DOBEDIT", ($CURUSER["dob"] == "0000-00-00")?true:false, true);
            $dob = explode("-", $CURUSER["dob"]);
            $profiletpl["dobday"] = $dob[2];
            $profiletpl["dobmonth"] = $dob[1];
            $profiletpl["dobyear"] = $dob[0];
        }
        $profiletpl["frm_action"] = "index.php?page=usercp&amp;do=user&amp;action=post&amp;uid=".$uid."";
        $profiletpl["username"] = (($btit_settings["fmhack_group_colours_overall"] == "enabled")?unesc($CURUSER["prefixcolor"].$CURUSER["username"].$CURUSER["suffixcolor"]):unesc($CURUSER["username"]));
        //avatar
        if($CURUSER["avatar"] && $CURUSER["avatar"] != "")
        {
            $usercptpl->set("AVATAR", true, true);
            $profiletpl["avatar"] = "<img border=\"0\" onload=\"resize_avatar(this);\" src=\"".htmlspecialchars(unesc($CURUSER["avatar"]))."\" alt=\"\" />";
        }
        $profiletpl["avatar_field"] = unesc($CURUSER["avatar"]);
        $profiletpl["email"] = unesc($CURUSER["email"]);
        if($btit_settings["fmhack_signature_on_internal_forum"] == "enabled")
        {
            $profiletpl["signature"] = unesc($CURUSER["signature"]);
        }
        //Reverify Mail Hack by Petr1fied - Start
        if($VALIDATION == "user")
        {
            //Display a message informing users that they will have
            //to verify their e-mail address if they attempt to change it
            $usercptpl->set("USER_VALIDATION", true, true);
        }
        //Reverify Mail Hack by Petr1fied - End
        if($btit_settings["usercp_language"]!="disabled")
        {
            //language list
            $lres = language_list();
            $langtpl = array();
            foreach($lres as $langue)
            {
                $langtpl["language_combo"] .= "\n<option ";
                if($langue["id"] == $CURUSER["language"])
                    $langtpl["language_combo"] .= "selected=\"selected\" ";
                $langtpl["language_combo"] .= "value=\"".$langue["id"]."\">".unesc($langue["language"])."</option>";
                $langtpl["language_combo"] .= ($option);
            }
            unset($lres);
            $usercptpl->set("lang", $langtpl);
        }
        if($btit_settings["usercp_style"]!="disabled")
        {
            //style list
            $sres = style_list();
            $styletpl = array();
            foreach($sres as $style)
            {
                $styletpl["style_combo"] .= "\n<option ";
                if($style["id"] == $CURUSER["style"])
                    $styletpl["style_combo"] .= "selected=\"selected\" ";
                $styletpl["style_combo"] .= "value=\"".$style["id"]."\">".unesc($style["style"])."</option>";
                $styletpl["style_combo"] .= ($option);
            }
            unset($sres);
            $usercptpl->set("style", $styletpl);
        }
        //flag list
        $fres = flag_list();
        $flagtpl = array();
        foreach($fres as $flag)
        {
            $flagtpl["flag_combo"] .= "\n<option ";
            if($flag["id"] == $CURUSER["flag"])
                $flagtpl["flag_combo"] .= "selected=\"selected\" ";
            $flagtpl["flag_combo"] .= "value=\"".$flag["id"]."\">".unesc($flag["name"])."</option>";
            $flagtpl["flag_combo"] .= ($option);
        }
        unset($fres);
        $usercptpl->set("flag", $flagtpl);
        $usercptpl->set("hos_enabled", (($btit_settings["fmhack_hide_online_status"] == "enabled" && $CURUSER["can_hide"] == "yes")?true:false), true);
        if($btit_settings["fmhack_hide_online_status"] == "enabled" && $CURUSER["can_hide"] == "yes")
            $usercptpl->set("invisible_checked", ($CURUSER["invisible"] == "yes"?"checked=\"checked\"":""));
        if($btit_settings["fmhack_force_ssl"] == "enabled")
            $usercptpl->set("ssl_checked", ($CURUSER["force_ssl"] == "yes"?"checked=\"checked\"":""));
        $usercptpl->set("showporn_enabled", (($btit_settings["fmhack_show_or_hide_porn"] == "enabled")?true:false), true);
        if($btit_settings["fmhack_show_or_hide_porn"] == "enabled")
            $usercptpl->set("showporn_checked", ($CURUSER["showporn"] == "yes"?"checked=\"checked\"":""));
        //timezone list
        $tres = timezone_list();
        $tztpl = array();
        foreach($tres as $timezone)
        {
            $tztpl["tz_combo"] .= "\n<option ";
            if($timezone["difference"] == $CURUSER["time_offset"])
                $tztpl["tz_combo"] .= "selected=\"selected\" ";
            $tztpl["tz_combo"] .= "value=\"".$timezone["difference"]."\">".unesc($timezone["timezone"])."</option>";
            $tztpl["tz_combo"] .= ($option);
        }
        unset($tres);
        $usercptpl->set("tz", $tztpl);
        if($FORUMLINK == "" || $FORUMLINK == "internal")
        {
            $usercptpl->set("INTERNAL_FORUM", true, true);
            $profiletpl["topicsperpage"] = $CURUSER["topicsperpage"];
            $profiletpl["postsperpage"] = $CURUSER["postsperpage"];
        }
        $profiletpl["torrentsperpage"] = $CURUSER["torrentsperpage"];
        if($btit_settings["fmhack_pM_notification_on_torrent_comment"]=="enabled")
        {
            $profiletpl["commentpm"]=($CURUSER["commentpm"]=="true"?"checked=\"checked\"":"");
        }
        $profiletpl["frm_cancel"] = "index.php?page=usercp&amp;uid=".$uid."";
        $usercptpl->set("profile", $profiletpl);
        $usercptpl->set("parked_enabled", (($btit_settings["fmhack_account_parked"] == "enabled")?true:false), true);
        $usercptpl->set("park_checked", (($btit_settings["fmhack_account_parked"] == "enabled" && $CURUSER["parked"] == "yes")?true:false), true);
        $usercptpl->set("usercp_language_enabled", (($btit_settings["usercp_language"] == "enabled")?true:false), true);
        $usercptpl->set("usercp_style_enabled", (($btit_settings["usercp_style"] == "enabled")?true:false), true);
        $usercptpl->set("birthdays_enabled", (($btit_settings["fmhack_birthdays"] == "enabled")?true:false), true);
        $usercptpl->set("about_me_enabled", (($btit_settings["fmhack_about_me"] == "enabled")?true:false), true);
        $usercptpl->set("default_cats_enabled", (($btit_settings["fmhack_default_cat_browse"]=="enabled")?true:false), true);
        if($btit_settings["fmhack_about_me"] == "enabled")
            $usercptpl->set("frm_about_me", textbbcode("utente", "about_me", $CURUSER["about_me"]));
        $usercptpl->set("ssl_enabled", (($btit_settings["fmhack_force_ssl"] == "enabled")?true:false), true);
        $usercptpl->set("privprof_enabled", (($btit_settings["fmhack_private_profile"] == "enabled")?true:false), true);
        if($btit_settings["fmhack_private_profile"] == "enabled")
        {
            $usercptpl->set("show_profile", (($CURUSER["profileview"] == 0)?true:false), true);
            $usercptpl->set("hide_profile", (($CURUSER["profileview"] == 1)?true:false), true);
        }
        $usercptpl->set("signature_enabled", (($btit_settings["fmhack_signature_on_internal_forum"] == "enabled")?true:false), true);
        $usercptpl->set("torrcomm_enabled", (($btit_settings["fmhack_pM_notification_on_torrent_comment"]=="enabled")?true:false), true);
        break;
}

?>
