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

require_once (load_language("lang_account.php"));
if(!isset($_POST["language"]))
    $_POST["language"] = max(1, $btit_settings["default_language"]);
$idlang = intval($_POST["language"]);
if(isset($_GET["uid"]))
    $id = intval($_GET["uid"]);
else
    $id = "";
if(isset($_GET["returnto"]))
    $link = urldecode($_GET["returnto"]);
else
    $link = "";
if(isset($_GET["act"]))
    $act = $_GET["act"];
else
    $act = "signup";
if(isset($_GET["language"]))
    $idlangue = intval($_GET["language"]);
else
    $idlangue = max(1, $btit_settings["default_language"]);
if(isset($_GET["style"]))
    $idstyle = intval($_GET["style"]);
else
    $idstyle = max(1, $btit_settings["default_style"]);
if(isset($_GET["flag"]))
    $idflag = intval($_GET["flag"]);
else
    $idflag = "";
if(isset($_POST["uid"]) && isset($_POST["act"]))
{
    if(isset($_POST["uid"]))
        $id = intval($_POST["uid"]);
    else
        $id = "";
    if(isset($_POST["returnto"]))
        $link = urldecode($_POST["returnto"]);
    else
        $link = "";
    if(isset($_POST["act"]))
        $act = $_POST["act"];
    else
        $act = "";
}
if($btit_settings["fmhack_block_signup_from_certain_countries"]=="enabled")
{
    if(!$_POST["conferma"])
    {
        if($btit_settings["blocked_signup_countries"]!="")
        {
            $blockedCountries=explode(",", $btit_settings["blocked_signup_countries"]);
            if(count($blockedCountries)>0)
            {
                $countryCodes=array();
                foreach($blockedCountries as $key => $value)
                {
                    $countryCodes[]=substr($value, 1, 2);
                }
                if(count($countryCodes)>0)
                {
                    $checkCountry=get_result("SELECT `country_code2` FROM {$TABLE_PREFIX}ip2country WHERE `ip_from` <= INET_ATON('".getip()."') AND `ip_to` >= INET_ATON('".getip()."')", true, $btit_settings["cache_duration"]);
                    $foundCountryCode=((count($checkCountry)==1)?$checkCountry[0]["country_code2"]:"ZZ");
                    if(in_array($foundCountryCode, $countryCodes))
                    {
                        stderr($language["ERROR"], $language["CSIGN_ERR"]);
                    }
                }
            }
        }
    }
}
if($btit_settings["fmhack_registration_open_randomly"] == "enabled")
{
    if(!$_POST["conferma"])
    {
        if($act != "invite")
        {
            $taskres = get_result("SELECT `last_time` FROM `{$TABLE_PREFIX}tasks` WHERE `task`='rreg'", true, $btit_settings["cache_duration"]);
            $open = (int)(0 + $taskres[0]["last_time"]);
            $close = (int)(0 + ($taskres[0]["last_time"] + ($btit_settings["rreg_open_for"] * 60)));
            if(time() < $open || time() > $close)
            {
                $err_msg = $language["RREG_CLOSED_1"];
                if($btit_settings["fmhack_invitation_system"] == "enabled")
                    $err_msg .= "<br /><br />".$language["RREG_CLOSED_2"];
                stderr($language["ERROR"], $err_msg);
            }
        }
    }
}
//start Invitation System by dodge
if($btit_settings["fmhack_invitation_system"] == "enabled")
{
    if(!$_POST["conferma"] && $INVITATIONSON)
    {
        if($act == "invite")
        {
            $code = sql_esc(strtolower(preg_replace("/[^A-Fa-f0-9]/", "", $_GET["invitationnumber"])));
            $res = do_sqlquery("SELECT `inviter`, `confirmed` FROM `{$TABLE_PREFIX}invitations` WHERE `hash` = '".$code."'", true);
            @$inv = $res->fetch_assoc();
            $inviter = $inv["inviter"];
            $confirmed = $inv["confirmed"];
            if(!$inv || $confirmed == "true")
                stderr($language["ERROR"], $code."<br>".$language["INVALID_INVITATION"]."<br>".$language["ERR_INVITATION"]);
        }
        else
            stderr($language["ERROR"], $language["INVITATION_ONLY"]);
    }
}
//end Invitation System by dodge
// already logged?
if($act == "signup" && isset($CURUSER["uid"]) && $CURUSER["uid"] != 1)
{
    $url = "index.php";
    redirect($url);
}
$nusers = get_result("SELECT count(*) as tu FROM {$TABLE_PREFIX}users WHERE id>1", true, $btit_settings['cache_duration']);
$numusers = $nusers[0]['tu'];
if($btit_settings["fmhack_invitation_system"] == "enabled")
{
    if($act == "signup" && $MAX_USERS != 0 && $numusers >= $MAX_USERS && !$INVITATIONSON)
    {
        stderr($language["ERROR"], $language["REACHED_MAX_USERS"]);
    }
}
else
{
    if($act == "signup" && $MAX_USERS != 0 && $numusers >= $MAX_USERS)
    {
        stderr($language["ERROR"], $language["REACHED_MAX_USERS"]);
    }
}
if($act == "confirm")
{
    global $FORUMLINK, $db_prefix, $THIS_BASEPATH, $btit_settings;
    $querymod="";
    if($btit_settings["fmhack_VIP_freeleech"] == "enabled")
    {
        $res = get_result("SELECT `freeleech` FROM `{$TABLE_PREFIX}users_level` WHERE `id`=3", true, $btit_settings["cache_duration"]);
        if(count($res) > 0)
        {
            if($res[0]["freeleech"] == "yes")
                $querymod .= "`vipfl_date`=UNIX_TIMESTAMP(),";
        }
    }
    $random = intval($_GET["confirm"]);
    $random2 = rand(10000, 60000);
    $res = do_sqlquery("UPDATE `{$TABLE_PREFIX}users` SET ".$querymod." `id_level`=3".((substr($FORUMLINK, 0, 3) == "smf" || $FORUMLINK == "ipb")?", `random`=$random2":"")." WHERE `id_level`=2 AND `random`=$random", true);
    if(!$res)
        die("ERROR: ".sql_error()."\n");
    else
    {
        if(substr($FORUMLINK, 0, 3) == "smf")
        {
            $get = get_result("SELECT `u`.`smf_fid`, `ul`.`smf_group_mirror` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `u`.`id_level`=3 AND `u`.`random`=$random2", true,
                $btit_settings['cache_duration']);
            if(count($get) > 0)
            {
                quickQuery("UPDATE `{$db_prefix}members` SET ".(($FORUMLINK == "smf")?"`ID_GROUP`":"`id_group`")."=".(($get[0]["smf_group_mirror"] > 0)?$get[0]["smf_group_mirror"]:13)." WHERE ".(($FORUMLINK == "smf")?
                    "`ID_MEMBER`":"`id_member`")."=".$get[0]["smf_fid"], true);
            }
        }
        elseif($FORUMLINK == "ipb")
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
            $get = get_result("SELECT `u`.`ipb_fid`, `ul`.`ipb_group_mirror` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `u`.`id_level`=3 AND `u`.`random`=$random2", true,
                $btit_settings['cache_duration']);
            if(count($get) > 0)
            {
                $forum_level = (($get[0]["ipb_group_mirror"] > 0)?$get[0]["ipb_group_mirror"]:3);
                IPSMember::save($get[0]["ipb_fid"], array("members" => array("member_group_id" => "$forum_level")));
            }
        }
        success_msg($language["ACCOUNT_CREATED"], $language["ACCOUNT_CONGRATULATIONS"]);
        stdfoot();
        exit;
    }
}
if($_POST["conferma"])
{
    if($act == "signup" || $act == "invite")
    {
        $ret = aggiungiutente();
        $pass_min_req = explode(",", $btit_settings["secsui_pass_min_req"]);
        if($ret == 0)
        {
            if($btit_settings["fmhack_invitation_system"] == "enabled")
            {
                if($INVITATIONSON == "true")
                {
                    if($VALID_INV == "true")
                    {
                        success_msg($language["ACCOUNT_CREATED"], $language["INVITE_EMAIL_SENT1"]." (".htmlspecialchars($_POST["email"])."). ".$language["INVITE_EMAIL_SENT2"]);
                        stdfoot();
                        exit();
                    }
                    else
                    {
                        success_msg($language["ACCOUNT_CREATED"], $language["INVITE_EMAIL_SENT3"]." (".htmlspecialchars($_POST["email"])."). ".$language["INVITE_EMAIL_SENT4"]);
                        stdfoot();
                        exit();
                    }
                }
                else
                {
                    if($VALIDATION == "user")
                    {
                        success_msg($language["ACCOUNT_CREATED"], $language["EMAIL_SENT"]);
                        stdfoot();
                        exit();
                    }
                    else
                        if($VALIDATION == "none")
                        {
                            success_msg($language["ACCOUNT_CREATED"], $language["ACCOUNT_CONGRATULATIONS"]);
                            stdfoot();
                            exit();
                        }
                        else
                        {
                            success_msg($language["ACCOUNT_CREATED"], $language["WAIT_ADMIN_VALID"]);
                            stdfoot();
                            exit();
                        }
                }
            }
            else
            {
                if($VALIDATION == "user")
                {
                    success_msg($language["ACCOUNT_CREATED"], $language["EMAIL_SENT"]);
                    stdfoot();
                    exit();
                }
                else
                    if($VALIDATION == "none")
                    {
                        success_msg($language["ACCOUNT_CREATED"], $language["ACCOUNT_CONGRATULATIONS"]);
                        stdfoot();
                        exit();
                    }
                    else
                    {
                        success_msg($language["ACCOUNT_CREATED"], $language["WAIT_ADMIN_VALID"]);
                        stdfoot();
                        exit();
                    }
            }
        }
        elseif($ret == -1)
            stderr($language["ERROR"], $language["ERR_MISSING_DATA"]);
        elseif($ret == -2)
            stderr($language["ERROR"], $language["ERR_EMAIL_ALREADY_EXISTS"]);
        elseif($ret == -3)
            stderr($language["ERROR"], $language["ERR_NO_EMAIL"]);
        elseif($ret == -4)
            stderr($language["ERROR"], $language["ERR_USER_ALREADY_EXISTS"]);
        elseif($ret == -7)
            stderr($language["ERROR"], $language["ERR_NO_SPACE"]."<span style=\"color:red;font-weight:bold;\">".preg_replace('/\ /', '_', sql_esc($_POST["user"]))."</span><br />");
        elseif($ret == -8)
            stderr($language["ERROR"], $language["ERR_SPECIAL_CHAR"]);
        elseif($ret == -9)
            stderr($language["ERROR"], $language["ERR_PASS_LENGTH_1"]." <span style=\"color:blue;font-weight:bold;\">".$pass_min_req[0]."</span> ".$language["ERR_PASS_LENGTH_2"]);
        elseif($ret == -10)
            stderr($language["ERROR"], $language["ERR_NAME_BANNED"]);
        elseif($ret == -99)
            stderr($language["ERROR"], $language["ERR_REG_IP_BANNED"]);
        elseif($ret == -98)
            stderr($language["ERROR"], $language["ERR_IP_ALREADY_EXISTS_1"]." (".getip().") ".$language["ERR_IP_ALREADY_EXISTS_2"]);
        elseif($ret == -97)
        {
            $errorOutput="";
            if($btit_settings["email_allowed"]!="")
            {
                $allowedMail=unserialize($btit_settings["email_allowed"]);
                $emailCount=count($allowedMail);
                if($emailCount>0)
                {
                    $errorOutput=$language["OASED_ERR_MSG_1"]." ".(($emailCount==1)?$language["OASED_ERR_MSG_2"]:$language["OASED_ERR_MSG_3"]).":<br /><br />";
                    foreach($allowedMail as $key => $value)
                    {
                        $errorOutput.=$value."<br />";
                    }
                }
            }
            stderr($language["ERROR"], $errorOutput);
        }
        elseif($ret == -998)
        {
            $newpassword = pass_the_salt(20);
            stderr($language["ERROR"], $language["ERR_PASS_TOO_WEAK_1"].":<br /><br />".(($pass_min_req[1] > 0)?"<li><span style='color:blue;font-weight:bold;'>".$pass_min_req[1]."</span> ".(($pass_min_req[1] ==
                1)?$language["ERR_PASS_TOO_WEAK_2"]:$language["ERR_PASS_TOO_WEAK_2A"])."</li>":"").(($pass_min_req[2] > 0)?"<li><span style='color:blue;font-weight:bold;'>".$pass_min_req[2]."</span> ".(($pass_min_req[2] ==
                1)?$language["ERR_PASS_TOO_WEAK_3"]:$language["ERR_PASS_TOO_WEAK_3A"])."</li>":"").(($pass_min_req[3] > 0)?"<li><span style='color:blue;font-weight:bold;'>".$pass_min_req[3]."</span> ".(($pass_min_req[3] ==
                1)?$language["ERR_PASS_TOO_WEAK_4"]:$language["ERR_PASS_TOO_WEAK_4A"])."</li>":"").(($pass_min_req[4] > 0)?"<li><span style='color:blue;font-weight:bold;'>".$pass_min_req[4]."</span> ".(($pass_min_req[4] ==
                1)?$language["ERR_PASS_TOO_WEAK_5"]:$language["ERR_PASS_TOO_WEAK_5A"])."</li>":"")."<br />".$language["ERR_PASS_TOO_WEAK_6"].":<br /><br /><span style='color:blue;font-weight:bold;'>".$newpassword.
                "</span><br />");
        }
        elseif($ret == -999)
            stderr($language["ERROR"], $language["DOMAIN_BANNED"]);
        else
            stderr($language["ERROR"], $language["ERR_USER_ALREADY_EXISTS"]);
    }
}
else
{
    $tpl_account = new bTemplate();
    tabella($act);
}
function tabella($action, $dati = array())
{
    global $btit_settings;
    if($btit_settings["fmhack_invitation_system"] == "enabled")
        global $SITENAME, $INVITATIONSON, $code, $inviter;
    global $idflag, $link, $idlangue, $idstyle, $CURUSER, $USE_IMAGECODE, $TABLE_PREFIX, $language, $tpl_account, $THIS_BASEPATH;
    $pass_min_req = explode(",", $btit_settings["secsui_pass_min_req"]);
    $tpl_account->set("pass_min_char", $pass_min_req[0]);
    $tpl_account->set("pass_min_lct", $pass_min_req[1]);
    $tpl_account->set("pass_min_uct", $pass_min_req[2]);
    $tpl_account->set("pass_min_num", $pass_min_req[3]);
    $tpl_account->set("pass_min_sym", $pass_min_req[4]);
    $tpl_account->set("pass_char_plural", (($pass_min_req[0] == 1)?false:true), true);
    $tpl_account->set("pass_lct_plural", (($pass_min_req[1] == 1)?false:true), true);
    $tpl_account->set("pass_uct_plural", (($pass_min_req[2] == 1)?false:true), true);
    $tpl_account->set("pass_num_plural", (($pass_min_req[3] == 1)?false:true), true);
    $tpl_account->set("pass_sym_plural", (($pass_min_req[4] == 1)?false:true), true);
    $tpl_account->set("pass_lct_set", (($pass_min_req[1] > 0)?true:false), true);
    $tpl_account->set("pass_uct_set", (($pass_min_req[2] > 0)?true:false), true);
    $tpl_account->set("pass_num_set", (($pass_min_req[3] > 0)?true:false), true);
    $tpl_account->set("pass_sym_set", (($pass_min_req[4] > 0)?true:false), true);
    if($action == "signup" || $action == "invite")
    {
        $tpl_account->set("BY_INVITATION", false, true);
        $dati["username"] = "";
        $dati["email"] = "";
        $dati["language"] = $idlangue;
        $dati["style"] = $idstyle;
    }
    // avoid error with js
    $language["DIF_PASSWORDS"] = AddSlashes($language["DIF_PASSWORDS"]);
    $language["INSERT_PASSWORD"] = AddSlashes($language["INSERT_PASSWORD"]);
    $language["USER_PWD_AGAIN"] = AddSlashes($language["USER_PWD_AGAIN"]);
    $language["INSERT_USERNAME"] = AddSlashes($language["INSERT_USERNAME"]);
    $language["ERR_NO_EMAIL"] = AddSlashes($language["ERR_NO_EMAIL"]);
    $language["ERR_NO_EMAIL_AGAIN"] = AddSlashes($language["ERR_NO_EMAIL_AGAIN"]);
    $language["DIF_EMAIL"] = AddSlashes($language["DIF_EMAIL"]);
    $tpl_account->set("language", $language);
    $tpl_account->set("account_action", $action);
    $tpl_account->set("account_form_actionlink", htmlspecialchars("index.php?page=signup&act=$action&returnto=$link"));
    $tpl_account->set("account_uid", $dati["id"]);
    $tpl_account->set("account_returnto", urlencode($link));
    if($btit_settings["createacc_language"]!="disabled")
       $tpl_account->set("account_IDlanguage",$idlang);
    if($btit_settings["createacc_style"]!="disabled")
       $tpl_account->set("account_IDstyle",$idstyle);
    $tpl_account->set("account_IDcountry", $idflag);
    $tpl_account->set("account_username", $dati["username"]);
    $tpl_account->set("dati", $dati);
    $tpl_account->set("DEL", $action == "delete", true);
    $tpl_account->set("DISPLAY_FULL", $action == "signup" || $action == "invite", true);
    $tpl_account->set("createacc_language_enabled", (($btit_settings["createacc_language"]=="enabled")?true:false), true);
    $tpl_account->set("createacc_style_enabled", (($btit_settings["createacc_style"]=="enabled")?true:false), true);
    $tpl_account->set("createacc_language_enabled_1", (($btit_settings["createacc_language"]=="enabled")?true:false), true);
    $tpl_account->set("createacc_style_enabled_1", (($btit_settings["createacc_style"]=="enabled")?true:false), true);
    $tpl_account->set("birthdays_enabled", (($btit_settings["fmhack_birthdays"] == "enabled")?true:false), true);
    $tpl_account->set("ssl_enabled", (($btit_settings["fmhack_force_ssl"] == "enabled")?true:false), true);
    //begin invitation system by dodge
    if($btit_settings["fmhack_invitation_system"] == "enabled")
    {
        if($INVITATIONSON)
        {
            $tpl_account->set("BY_INVITATION", true, true);
            $tpl_account->set("account_IDcode", $code);
            $tpl_account->set("account_IDinviter", $inviter);
        }
    }
    else
        $tpl_account->set("BY_INVITATION", false, true);
    //end invitation system
    if($action == "del")
        $tpl_account->set("account_from_delete_confirm", "<input type=\"submit\" name=\"elimina\" value=\"".$language["FRM_DELETE"]."\" />&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"elimina\" value=\"".
            $language["FRM_CANCEL"]."\" />");
    else
        $tpl_account->set("account_from_delete_confirm", "<input type=\"submit\" name=\"conferma\" value=\"".$language["FRM_CONFIRM"]."\" />&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" name=\"annulla\" value=\"".
            $language["FRM_CANCEL"]."\" />");
    if($btit_settings["createacc_language"] != "disabled")
    {
        $lres = language_list();
        $option = "\n<select name=\"language\" size=\"1\">";
        foreach($lres as $langue)
        {
            $option .= "\n<option ";
            if($langue["id"] == $dati["language"])
                $option .= "selected=\"selected\"  ";
            $option .= "value=\"".$langue["id"]."\">".$langue["language"]."</option>";
        }
        $option .= "\n</select>";
        $tpl_account->set("account_combo_language", $option);
    }
    if($btit_settings["createacc_style"] != "disabled")
    {
        $sres = style_list();
        $option = "\n<select name=\"style\" size=\"1\">";
        foreach($sres as $style)
        {
            $option .= "\n<option ";
            if($style["id"] == $dati["style"])
                $option .= "selected=\"selected\"  ";
            $option .= "value=\"".$style["id"]."\">".$style["style"]."</option>";
        }
        $option .= "\n</select>";
        $tpl_account->set("account_combo_style", $option);
    }
    $fres = flag_list();
    $option = "\n<select name=\"flag\" size=\"1\">\n<option value='0'>---</option>";
    $thisip = $_SERVER["REMOTE_ADDR"];
    $remotedns = gethostbyaddr($thisip);
    if($remotedns != $thisip)
    {
        $remotedns = strtoupper($remotedns);
        preg_match('/^(.+)\.([A-Z]{2,3})$/', $remotedns, $tldm);
        if(isset($tldm[2]))
            $remotedns = sql_esc($tldm[2]);
    }
    foreach($fres as $flag)
    {
        $option .= "\n<option ";
        if($flag["id"] == $dati["flag"] || ($flag["domain"] == $remotedns && $action == "signup"))
            $option .= "selected=\"selected\"  ";
        $option .= "value=\"".$flag["id"]."\">".$flag["name"]."</option>";
    }
    $option .= "\n</select>";
    $tpl_account->set("account_combo_country", $option);
    $zone = date('Z', time());
    $daylight = date('I', time()) * 3600;
    $os = $zone - $daylight;
    if($os != 0)
    {
        $timeoff = $os / 3600;
    }
    else
    {
        $timeoff = 0;
    }
    if(!$CURUSER || $CURUSER["uid"] == 1)
        $dati["time_offset"] = $timeoff;
    $tres = timezone_list();
    $option = "<select name=\"timezone\">";
    foreach($tres as $timezone)
    {
        $option .= "\n<option ";
        if($timezone["difference"] == $dati["time_offset"])
            $option .= "selected=\"selected\" ";
        $option .= "value=\"".$timezone["difference"]."\">".unesc($timezone["timezone"])."</option>";
    }
    $option .= "\n</select>";
    $tpl_account->set("account_combo_timezone", $option);
    // -----------------------------
    // Captcha hack
    // -----------------------------
    // if set to use secure code: try to display imagecode
    if($USE_IMAGECODE && $action != "mod")
    {
        if(extension_loaded('gd'))
        {
            $arr = gd_info();
            if($arr['FreeType Support'] == 1)
            {
                $p = new ocr_captcha();
                $tpl_account->set("CAPTCHA", true, true);
                $tpl_account->set("account_captcha", $p->display_captcha(true));
                $private = $p->generate_private();
            }
            else
            {
                include ("$THIS_BASEPATH/include/security_code.php");
                $scode_index = rand(0, count($security_code) - 1);
                $scode = "<input type=\"hidden\" name=\"security_index\" value=\"$scode_index\" />\n";
                $scode .= $security_code[$scode_index]["question"];
                $tpl_account->set("scode_question", $scode);
                $tpl_account->set("CAPTCHA", false, true);
            }
        }
        else
        {
            include ("$THIS_BASEPATH/include/security_code.php");
            $scode_index = rand(0, count($security_code) - 1);
            $scode = "<input type=\"hidden\" name=\"security_index\" value=\"$scode_index\" />\n";
            $scode .= $security_code[$scode_index]["question"];
            $tpl_account->set("scode_question", $scode);
            $tpl_account->set("CAPTCHA", false, true);
        }
    }
    elseif($action != "mod")
    {
        include ("$THIS_BASEPATH/include/security_code.php");
        $scode_index = rand(0, count($security_code) - 1);
        $scode = "<input type=\"hidden\" name=\"security_index\" value=\"$scode_index\" />\n";
        $scode .= $security_code[$scode_index]["question"];
        $tpl_account->set("scode_question", $scode);
        // we will request simple operation to user
        $tpl_account->set("CAPTCHA", false, true);
    }
    // -----------------------------
    // Captcha hack
    // -----------------------------
}
function aggiungiutente()
{
    global $btit_settings;
    if($btit_settings["fmhack_invitation_system"] == "enabled")
        global $INVITATIONSON, $VALID_INV;
    global $SITENAME, $SITEEMAIL, $BASEURL, $VALIDATION, $USERLANG, $USE_IMAGECODE, $TABLE_PREFIX, $XBTT_USE, $language, $THIS_BASEPATH, $FORUMLINK, $db_prefix, $res_seo;
    if(!isset($language["SYSTEM_USER"]))
        $language["SYSTEM_USER"]="System";
    if($btit_settings["fmhack_birthdays"] == "enabled")
    {
        $dobday = str_pad(intval($_POST["dobday"]), 2, 0, STR_PAD_LEFT);
        $dobmonth = str_pad(intval($_POST["dobmonth"]), 2, 0, STR_PAD_LEFT);
        $dobyear = str_pad(intval($_POST["dobyear"]), 4, 0, STR_PAD_LEFT);
    }
    if($btit_settings["fmhack_force_ssl"] == "enabled")
    {
        $force = isset($_POST["force"])?"yes":"no";
    }
    $utente = sql_esc($_POST["user"]);
    $pwd = sql_esc($_POST["pwd"]);
    $pwd1 = sql_esc($_POST["pwd1"]);
    $email = sql_esc($_POST["email"]);
if (isset($_POST["language"]))
    $idlangue=intval($_POST["language"]);
else
    $idlangue=max(1,$btit_settings["default_language"]);

if (isset($_POST["style"]))
    $idstyle=intval($_POST["style"]);
else
    $idstyle=max(1,$btit_settings["default_style"]);
    $idflag = intval($_POST["flag"]);
    $timezone = intval($_POST["timezone"]);
    if(strtoupper($utente) == strtoupper("Guest"))
    {
        err_msg($language["ERROR"], $language["ERR_GUEST_EXISTS"]);
        stdfoot();
        exit;
    }
    if($pwd != $pwd1)
    {
        err_msg($language["ERROR"], $language["DIF_PASSWORDS"]);
        stdfoot();
        exit;
    }
    if($VALIDATION == "none")
        $idlevel = 3;
    else
        $idlevel = 2;
    //begin invitation system by dodge
    if($btit_settings["fmhack_invitation_system"] == "enabled")
    {
        if($INVITATIONSON == "true")
        {
            if($VALID_INV == "true")
                $idlevel = 2;
            else
                $idlevel = 3;
        }
    }
    //end invitation system
    # Create Random number
    $floor = 100000;
    $ceiling = 999999;
    srand((double)microtime() * 1000000);
    $random = rand($floor, $ceiling);
    if($utente == "" || $pwd == "" || $email == "")
    {
        return - 1;
        exit;
    }
    $res = do_sqlquery("SELECT email FROM {$TABLE_PREFIX}users WHERE email='$email'", true);
    if(sql_num_rows($res) > 0)
    {
        return - 2;
        exit;
    }
    // valid email check - by vibes
    $regex = '/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/i';
    if(!preg_match($regex, $email))
    {
        return - 3;
        exit;
    }
    if($btit_settings["fmhack_only_allow_specified_email_domains"]=="enabled")
    {
        if($btit_settings["email_allowed"]!="")
        {
            $allowedMail=unserialize($btit_settings["email_allowed"]);
            if(count($allowedMail)>0)
            {
                $mailSplit=explode("@", $email);
                if(!in_array($mailSplit[1], $allowedMail))
                {
                    return -97;
                    exit;
                }
            }
        }
    }
    // valid email check end
    // duplicate username
    $res = do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users WHERE username='$utente'", true);
    if(sql_num_rows($res) > 0)
    {
        return - 4;
        exit;
    }
    // duplicate username
    if($btit_settings["fmhack_protected_usernames"] == "enabled" && !empty($btit_settings["banned_usernames"]))
    {
        $usernameToEval=strtolower($utente);
        $bannedUsers = explode(",", strtolower($btit_settings["banned_usernames"]));
        if(count($bannedUsers) > 0)
        {
            foreach($bannedUsers as $bannedUser)
            {
                if($usernameToEval == $bannedUser)
                {
                    return -10;
                    exit;
                }
                elseif(strpos($usernameToEval, $bannedUser)!==false)
                {
                    return -10;
                    exit;
                }
            }
        }
    }
    if(strpos($utente, " ") == true)
    {
        return - 7;
        exit;
    }
    if($USE_IMAGECODE)
    {
        if(extension_loaded('gd'))
        {
            $arr = gd_info();
            if($arr['FreeType Support'] == 1)
            {
                $public = $_POST['public_key'];
                $private = $_POST['private_key'];
                $p = new ocr_captcha();
                if($p->check_captcha($public, $private) != true)
                {
                    err_msg($language["ERROR"], $language["ERR_IMAGE_CODE"]);
                    stdfoot();
                    exit;
                }
            }
            else
            {
                include ("$THIS_BASEPATH/include/security_code.php");
                $scode_index = intval($_POST["security_index"]);
                if($security_code[$scode_index]["answer"] != $_POST["scode_answer"])
                {
                    err_msg($language["ERROR"], $language["ERR_IMAGE_CODE"]);
                    stdfoot();
                    exit;
                }
            }
        }
        else
        {
            include ("$THIS_BASEPATH/include/security_code.php");
            $scode_index = intval($_POST["security_index"]);
            if($security_code[$scode_index]["answer"] != $_POST["scode_answer"])
            {
                err_msg($language["ERROR"], $language["ERR_IMAGE_CODE"]);
                stdfoot();
                exit;
            }
        }
    }
    else
    {
        include ("$THIS_BASEPATH/include/security_code.php");
        $scode_index = intval($_POST["security_index"]);
        if($security_code[$scode_index]["answer"] != $_POST["scode_answer"])
        {
            err_msg($language["ERROR"], $language["ERR_IMAGE_CODE"]);
            stdfoot();
            exit;
        }
    }
    $bannedchar = array(
        "\\",
        "/",
        ":",
        "*",
        "?",
        "\"",
        "@",
        "$",
        "'",
        "`",
        ",",
        ";",
        ".",
        "<",
        ">",
        "!",
        "�",
        "%",
        "^",
        "&",
        "(",
        ")",
        "+",
        "=",
        "#",
        "~");
    if(straipos($utente, $bannedchar) == true)
    {
        return - 8;
        exit;
    }
    $pass_to_test = $_POST["pwd"];
    $pass_min_req = explode(",", $btit_settings["secsui_pass_min_req"]);
    if(strlen($pass_to_test) < $pass_min_req[0])
    {
        return - 9;
        exit;
    }
    $lct_count = 0;
    $uct_count = 0;
    $num_count = 0;
    $sym_count = 0;
    $pass_end = (int)(strlen($pass_to_test) - 1);
    $pass_position = 0;
    $pattern1 = '#[a-z]#';
    $pattern2 = '#[A-Z]#';
    $pattern3 = '#[0-9]#';
    $pattern4 = '/[�!"�$%^&*()`{}\[\]:@~;\'#<>?,.\/\\-=_+\|]/';
    for($pass_position = 0; $pass_position <= $pass_end; $pass_position++)
    {
        if(preg_match($pattern1, substr($pass_to_test, $pass_position, 1), $matches))
            $lct_count++;
        elseif(preg_match($pattern2, substr($pass_to_test, $pass_position, 1), $matches))
            $uct_count++;
        elseif(preg_match($pattern3, substr($pass_to_test, $pass_position, 1), $matches))
            $num_count++;
        elseif(preg_match($pattern4, substr($pass_to_test, $pass_position, 1), $matches))
            $sym_count++;
    }
    if($lct_count < $pass_min_req[1] || $uct_count < $pass_min_req[2] || $num_count < $pass_min_req[3] || $sym_count < $pass_min_req[4])
    {
        return - 998;
        exit;
    }
    if($btit_settings["fmhack_ban_cheapmail_domains"] == "enabled")
    {
        $exploded = explode("@", $email);
        $exploded2 = explode(".", $exploded[1]);
        $cheapmail = sql_esc($exploded[1]);
        $cheapmail2 = sql_esc("@".$exploded2[0].".");
        $mailischeap = do_sqlquery("SELECT `domain` FROM `{$TABLE_PREFIX}cheapmail` WHERE `domain`='".$cheapmail."' OR `domain`='".$cheapmail2."'", true);
        if(@sql_num_rows($mailischeap) > 0)
            return - 999;
    }
    if($btit_settings["fmhack_ban_button"] == "enabled")
    {
        $userip = getip();
        $signupipblock = @do_sqlquery("SELECT `id` FROM `{$TABLE_PREFIX}signup_ip_block` WHERE `first_ip` <=INET_ATON('$userip') AND `last_ip` >=INET_ATON('$userip')")->fetch_assoc();
        if($signupipblock)
        {
            return - 99;
            exit();
        }
    }
    if($btit_settings["fmhack_disable_user_registration_with_duplicate_IP"] == "enabled")
    {
        $userip = getip();
        $i = @do_sqlquery("SELECT COUNT(*) `count` FROM `{$TABLE_PREFIX}users` WHERE `cip`='$userip'")->fetch_assoc();
        if($i["count"] > 0)
        {
            return - 98;
            exit();
        }
    }
    if($btit_settings["fmhack_signup_bonus_upload"] == "enabled")
    {
        $uploaded = 0;
        $result = get_result("SELECT (SELECT `value` FROM `{$TABLE_PREFIX}settings` WHERE `key` = 'donate_upload') as `donate_upload`, (SELECT `value` FROM `{$TABLE_PREFIX}settings` WHERE `key` = 'unit') AS `unit`", true,
            $btit_settings["cache_duration"]);
        $result = $result[0];
        $credit = $result['donate_upload'];
        $unit = $result['unit'];
        $kb = 1024;
        $mb = 1024 * 1024;
        $gb = 1024 * 1024 * 1024;
        $tb = 1024 * 1024 * 1024 * 1024;
        if($unit == 'Kb')
            $uploaded = $credit * $kb;
        elseif($unit == 'Mb')
            $uploaded = $credit * $mb;
        elseif($unit == 'Gb')
            $uploaded = $credit * $gb;
        elseif($unit == 'Tb')
            $uploaded = $credit * $tb;
    }
    if($btit_settings["fmhack_birthdays"] == "enabled")
    {
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
    $multipass = hash_generate(array("salt" => ""), $_POST["pwd"], $_POST["user"]);
    $i = $btit_settings["secsui_pass_type"];
    $pid = md5(uniqid(rand(), true));
    $key.="";
    $value.="";
    if($btit_settings["fmhack_VIP_freeleech"] == "enabled")
    {
        $res=get_result("SELECT `freeleech` FROM `{$TABLE_PREFIX}users_level` WHERE `id`=".$idlevel);
        if(count($res[0])>0)
        {
            if($res[0]["freeleech"]=="yes")
            {
                $key.=",`vipfl_date`";
                $value.=", UNIX_TIMESTAMP()";
            }
        }
    }
    if($btit_settings["createacc_language"]=="disabled")
    {
	$idlangue=$btit_settings["default_language"];
    }
    quickQuery("INSERT INTO {$TABLE_PREFIX}users (`username`, `password`, `salt`, `pass_type`, `dupe_hash`, `random`, `id_level`, `email`, `style`, `language`, `flag`, `joined`, `lastconnect`, `pid`, `time_offset`".
        (($btit_settings["fmhack_signup_bonus_upload"] == "enabled" && !$XBTT_USE)?", `uploaded`":"").(($btit_settings["fmhack_birthdays"] == "enabled")?", `dob`":"").(($btit_settings["fmhack_force_ssl"] ==
        "enabled")?", `force_ssl`":"").$key.") VALUES ('".$utente."', '".sql_esc($multipass[$i]["rehash"])."', '".sql_esc($multipass[$i]["salt"])."', '".$i."', '".
        sql_esc($multipass[$i]["dupehash"])."', ".$random.", ".$idlevel.", '".$email."', ".$idstyle.", ".$idlangue.", ".$idflag.", NOW(), NOW(),'".$pid."', '".$timezone."'".(($btit_settings["fmhack_signup_bonus_upload"] ==
        "enabled" && !$XBTT_USE)?", ".$uploaded:"").(($btit_settings["fmhack_birthdays"] == "enabled")?", '".$dob."'":"").(($btit_settings["fmhack_force_ssl"] == "enabled")?", '".$force."'":"").$value.")", true);
    $newuid = sql_insert_id();
    if($btit_settings["fmhack_shoutbox_member_and_torrent_announce"] == "enabled")
    {
        // begin - announce new confirmed user in shoutbox
        system_shout((sql_esc($language["ANN_NEW_USER"])." [url=".$BASEURL."/index.php?page=userdetails&id=".$newuid."]".$utente."[/url]"), false,true);
        // end - announce new confirmed user in shoutbox
        if($btit_settings["fmhack_IMG_in_SB_after_x_shouts"] == "enabled")
            auto_shout(sql_insert_id());
    }
    //begin invitation system by dodge
    if($btit_settings["fmhack_invitation_system"] == "enabled")
    {
        if($INVITATIONSON == "true")
        {
            $inviter = 0 + $_POST["inviter"];
            $code = unesc($_POST["code"]);
            $res = do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users WHERE id = $inviter", true);
            $arr = $res->fetch_assoc();
            $invusername = $arr["username"];
            quickQuery("UPDATE {$TABLE_PREFIX}users SET invited_by='".$inviter."' WHERE id='".$newuid."'", true);
            quickQuery("UPDATE {$TABLE_PREFIX}invitations SET confirmed='true' WHERE hash='$code'", true);
            if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_invite"] == "enabled")
            {
                $usernotes = array();
                $usernotes[] = base64_encode($language["UN_INV_ACC_1"]." ".$invusername." ".$language["UN_INV_ACC_2"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                $new_notes = serialize($usernotes);
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$newuid, true);
            }
        }
    }
    //end invitation system
    // Continue to create smf members if they disable smf mode
    if(!isset($db_prefix))
        $db_prefix="smf_";
    $test = do_sqlquery("SHOW TABLES LIKE '{$db_prefix}members'", true);
    if(substr($FORUMLINK, 0, 3) == "smf" || sql_num_rows($test))
    {
        $smfver_res = do_sqlquery("SELECT `value` FROM `{$db_prefix}settings` WHERE `variable`='smfVersion'");
        $smfver_row = $smfver_res->fetch_assoc();
        $smf_type = (((int)(substr($smfver_row["value"], 0, 1)) == 1)?"smf":"smf2");
        $smfpass = smf_passgen($utente, $pwd);
        $fetch = get_result("SELECT `smf_group_mirror` FROM `{$TABLE_PREFIX}users_level` WHERE `id`=".$idlevel, true, $btit_settings["cache_duration"]);
        $flevel = (($fetch[0]["smf_group_mirror"] > 0)?$fetch[0]["smf_group_mirror"]:$idlevel + 10);
        if($smf_type == "smf")
            quickQuery("INSERT INTO `{$db_prefix}members` (`memberName`, `dateRegistered`, `ID_GROUP`, `realName`, `passwd`, `emailAddress`, `memberIP`, `memberIP2`, `is_activated`, `passwordSalt`) VALUES ('$utente', UNIX_TIMESTAMP(), $flevel, '$utente', '$smfpass[0]', '$email', '".
                getip()."', '".getip()."', 1, '$smfpass[1]')", true);
        else
            quickQuery("INSERT INTO `{$db_prefix}members` (`member_name`, `date_registered`, `id_group`, `real_name`, `passwd`, `email_address`, `member_ip`, `member_ip2`, `is_activated`, `password_salt`) VALUES ('$utente', UNIX_TIMESTAMP(), $flevel, '$utente', '$smfpass[0]', '$email', '".
                getip()."', '".getip()."', 1, '$smfpass[1]')", true);
        $fid = sql_insert_id();
        quickQuery("UPDATE `{$db_prefix}settings` SET `value` = $fid WHERE `variable` = 'latestMember'", true);
        quickQuery("UPDATE `{$db_prefix}settings` SET `value` = '$utente' WHERE `variable` = 'latestRealName'", true);
        quickQuery("UPDATE `{$db_prefix}settings` SET `value` = UNIX_TIMESTAMP() WHERE `variable` = 'memberlist_updated'", true);
        quickQuery("UPDATE `{$db_prefix}settings` SET `value` = `value` + 1 WHERE `variable` = 'totalMembers'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `smf_fid`=$fid WHERE `id`=$newuid", true);
    }
    // Continue to create ipb members if they disable ipb mode
    if(!isset($ipb_prefix))
        $ipb_prefix="ipb_";
    $test = do_sqlquery("SHOW TABLES LIKE '{$ipb_prefix}members'");
    if($FORUMLINK == "ipb" || sql_num_rows($test))
    {
        ipb_create($utente, $email, $pwd, $idlevel, $newuid);
    }

    //welcome msg probs best here incase we need an fid for send_pm
    if($btit_settings["fmhack_welcome_pm"]=="enabled")
    {
        $msg_settings=get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}welcome_msg");
        if(!empty($msg_settings["fm_welcome_sub"]) && !empty($msg_settings["fm_welcome_msg"]))
        send_pm(0,$newuid,sqlesc($msg_settings["fm_welcome_sub"]),sqlesc($msg_settings["fm_welcome_msg"]));
    }

    // xbt
    if($XBTT_USE)
    {
        $resin = do_sqlquery("INSERT INTO xbt_users (uid, torrent_pass".(($btit_settings["fmhack_signup_bonus_upload"] == "enabled")?", uploaded":"").") VALUES ($newuid,'$pid'".(($btit_settings["fmhack_signup_bonus_upload"] ==
            "enabled")?", $uploaded":"").")", true);
    }
    if($btit_settings["fmhack_invitation_system"] == "enabled")
    {
        if($INVITATIONSON == "true")
        {
            if($VALID_INV == "true")
            {
                send_mail($email, $SITENAME." ".$language["REG_CONFIRM"], $language["INVIT_MSGINFO"].$language["INVIT_MSGINFO1"].$language["INVIT_MSGINFO2A"]." ".$utente."\n".$language["INVIT_MSGINFO2B"]." ".$pwd."\n\n".
                    $language["INVIT_MSGINFO3"]);
            }
            else
                send_mail($email, $SITENAME." ".$language["REG_CONFIRM"], $language["INVIT_MSGINFO"].$language["INVIT_MSGINFO2A"]." $utente\n".$language["INVIT_MSGINFO2B"]." ".$pwd."\n\n".$language["INVIT_MSG_AUTOCONFIRM3"]);
            write_log("Signup new user $utente ($email)", "add");
        }
    }
    else
    {
        if($VALIDATION == "user")
        {
            ini_set("sendmail_from", "");
            if(sql_errno() == 0)
            {
                send_mail($email, $language["ACCOUNT_CONFIRM"], $language["ACCOUNT_MSG"]."\n\n".$BASEURL."/index.php?page=account&act=confirm&confirm=$random&language=$idlangue");
                write_log("Signup new user $utente ($email)", "add");
            }
            else
                die(sql_error());
        }
    }
    return sql_errno();
}

?>
