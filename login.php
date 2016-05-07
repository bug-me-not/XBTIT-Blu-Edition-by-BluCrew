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

if (!defined("IN_BTIT"))
  die("non direct access!");

session_name("BluRG");
session_start();
$_SESSION=array();
setcookie("BluRG", "", time()-3600, "/");
session_destroy();

require_once(load_language("lang_login.php"));

function xbtit_login()
{
   global $language, $logintpl, $btit_settings, $user_location;

   $logintpl->set("language",$language);
   $language["INSERT_USERNAME"]=AddSlashes($language["INSERT_USERNAME"]);
   $language["INSERT_PASSWORD"]=AddSlashes($language["INSERT_PASSWORD"]);

   $login=array();
   $login["action"]="index.php?page=login&amp;returnto=".urlencode("index.php")."";
   $login["username"]=$user;
   $login["create"]="index.php?page=signup";
   $login["recover"]="index.php?page=recover";
   $logintpl->set("login",$login);

   if($btit_settings["fmhack_site_offline"]=="enabled")
   {
    if ($btit_settings["site_offline"])
    {
        $logintpl->set("SITE_OFFLINE",true,true);
        $logintpl->set("offline_msg",$btit_settings["offline_msg"]);
    }
    else
        $logintpl->set("SITE_OFFLINE",false,true);
}
}

function login_redirect($name, $value)
{
    echo "<html><head></head>
    <body> 
    <form name='dir' action='/login_new.php' method='post'>
        <input type=hidden name='{$name}' value='{$value}' />
        <input type=hidden name='submitter' value='true' />
        <input type=hidden name='cmd' value='test' />
    </form>
    <script>
        document.dir.submit();
    </script>
    </body></html>";
}

$logintpl=new bTemplate();

if (!$CURUSER || $CURUSER["uid"]==1)
{
    if (isset($_POST["uid"]) && $_POST["uid"])
        $user=$_POST["uid"];
    else
        $user="";
    if (isset($_POST["pwd"]) && $_POST["pwd"])
        $pwd=$_POST["pwd"];
    else
        $pwd="";

    if (isset($_POST["uid"]) && isset($_POST["pwd"]))
    {
        if (substr($FORUMLINK,0,3)=="smf")
            $smf_pass = sha1(strtolower($user) . $pwd);

        $query1_select="";
        if($btit_settings["fmhack_booted"]=="enabled")
            $query1_select.="`u`.`booted`, `u`.`whybooted`, `u`.`addbooted`,";

        $res = do_sqlquery("SELECT ".$query1_select." `u`.`salt`, `u`.`pass_type`, `u`.`username`, `u`.`id`, `u`.`random`, `u`.`password`".((substr($FORUMLINK,0,3)=="smf") ? ", `u`.`smf_fid`, `s`.`passwd`":(($FORUMLINK=="ipb")?", `u`.`ipb_fid`, `i`.`members_pass_hash`":""))." FROM `{$TABLE_PREFIX}users` `u` ".((substr($FORUMLINK,0,3)=="smf") ? "LEFT JOIN `{$db_prefix}members` `s` ON `u`.`smf_fid`=`s`.".(($FORUMLINK=="smf")?"`ID_MEMBER`":"`id_member`")."":(($FORUMLINK=="ipb")?"LEFT JOIN `{$ipb_prefix}members` `i` ON `u`.`ipb_fid`=`i`.`member_id`":""))." WHERE `u`.`username` ='".AddSlashes($user)."'",true);
        $row = $res->fetch_assoc();

        if (!$row)
        {
            $logintpl->set("FALSE_USER",true,true);
            $logintpl->set("FALSE_PASSWORD",false,true);
            $logintpl->set("login_username_incorrect",$language["ERR_USERNAME_INCORRECT"]);
            if($btit_settings["fmhack_alternate_login"]=="enabled")
            {
                if($user_location=="" || $user_location=="index.php?page=login")
                {
                    //redirect("login_new.php?cr=1");
                    login_redirect("cr",1);
                }
            }
            else
            {
                xbtit_login();
            }
        }
        else
        {
            $passtype=hash_generate($row, $pwd, $user);
            if($row["password"]==$passtype[$row["pass_type"]]["hash"])
            {
                // We have a correct password entry

                // If stored password type is not the same as the current set type
                if($row["pass_type"]!=$btit_settings["secsui_pass_type"])
                {
                    // We need to update the password
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `password`='".sql_esc($passtype[$btit_settings["secsui_pass_type"]]["rehash"])."', `salt`='".sql_esc($passtype[$btit_settings["secsui_pass_type"]]["salt"])."', `pass_type`='".sql_esc($btit_settings["secsui_pass_type"])."', `dupe_hash`='".sql_esc($passtype[$btit_settings["secsui_pass_type"]]["dupehash"])."' WHERE `id`=".$row["id"],true);
                    $row["pass_type"]=$btit_settings["secsui_pass_type"];
                    $row["password"]=$passtype[$btit_settings["secsui_pass_type"]]["rehash"];
                    $row["salt"]=$passtype[$btit_settings["secsui_pass_type"]]["salt"];

                }

                if($btit_settings["fmhack_booted"]=="enabled")
                {
                    if ($row["booted"] == "yes")
                    {
                        if($btit_settings["fmhack_alternate_login"]=="enabled")
                        {
                            if($user_location=="" || $user_location=="index.php?page=login")
                            {
                                //redirect("login_new.php?bo={$row['id']}");
                                login_redirect("bo",$row['id']);
                            }
                        }
                        else
                        {
                            stderr ($language["ERR_PERM_DENIED"],"<b>".$language["BOOTED"]." <br>".$language["BOOTEDUT"]." ".$row["addbooted"]."<br>".$language["WHYBOOTED"]."&nbsp;&nbsp;".$row["whybooted"]."</b>
                        </br> </br> <a href='index.php?page=contact'>Contact us</a>");
                            xbtit_login();
                        }
                    }
                }
                // If we've reached this point we can set the cookies

                // Just clear out any old cookies for good meaure first
                logoutcookie();
                logincookie($row, $user);

                if (substr($FORUMLINK,0,3)=="smf" && $smf_pass==$row["passwd"])
                {
                    $new_smf_salt=substr(md5(rand()), 0, 4);
                    quickQuery("UPDATE `{$db_prefix}members` SET ".(($FORUMLINK=="smf")?"`passwordSalt`":"`password_salt`")."='".$new_smf_salt."' WHERE ".(($FORUMLINK=="smf")?"`ID_MEMBER`":"`id_member`")."=".$row["smf_fid"],true);
                    set_smf_cookie($row["smf_fid"], $row["passwd"], $new_smf_salt);
                }
                elseif (substr($FORUMLINK,0,3)=="smf" && $row["pass_type"]==1 && $row["password"]==$row["passwd"])
                {
                    $salt=substr(md5(rand()), 0, 4);
                    quickQuery("UPDATE `{$db_prefix}members` SET `passwd`='$smf_pass', ".(($FORUMLINK=="smf")?"`passwordSalt`='$salt' WHERE `ID_MEMBER`":"`password_salt`='$salt' WHERE `id_member`")."=".$row["smf_fid"]);
                    set_smf_cookie($row["smf_fid"], $smf_pass, $salt);
                }
                elseif (substr($FORUMLINK,0,3)=="smf" && $row["passwd"]=="ffffffffffffffffffffffffffffffffffffffff")
                {
                    $fix_pass=smf_passgen($user, $pwd);
                    quickQuery("UPDATE `{$db_prefix}members` SET `passwd`='".$fix_pass[0]."', ".(($FORUMLINK=="smf")?"`passwordSalt`='".$fix_pass[1]."' WHERE `ID_MEMBER`":"`password_salt`='".$fix_pass[1]."' WHERE `id_member`")."=".$row["smf_fid"]);
                    set_smf_cookie($row["smf_fid"], $fix_pass[0], $fix_pass[1]);
                }
                elseif($FORUMLINK=="ipb")
                {
                    if ($row["members_pass_hash"]=="ffffffffffffffffffffffffffffffff")
                    {
                        if(!defined('IPS_ENFORCE_ACCESS'))
                            define('IPS_ENFORCE_ACCESS', true);
                        if(!defined('IPB_THIS_SCRIPT'))
                            define('IPB_THIS_SCRIPT', 'public');

                        if(!isset($THIS_BASEPATH) || empty($THIS_BASEPATH))
                            $THIS_BASEPATH=dirname(__FILE__);
                        require_once($THIS_BASEPATH. '/ipb/initdata.php' );
                        require_once( IPS_ROOT_PATH . 'sources/base/ipsRegistry.php' );
                        require_once( IPS_ROOT_PATH . 'sources/base/ipsController.php' );
                        $registry = ipsRegistry::instance();
                        $registry->init();

                        $password=IPSText::parseCleanValue(urldecode(trim($pwd)));
                        $ipbhash=md5(md5($row["members_pass_salt"]).md5($password));
                        $salt=pass_the_salt(5);
                        $rehash=md5(md5($salt).md5($password));

                        IPSMember::save($row["ipb_fid"], array("members" => array("member_login_key" => "", "member_login_key_expire" => "0", "members_pass_hash" => "$rehash", "members_pass_salt" => "$salt")));
                        set_ipb_cookie($row["ipb_fid"]);
                    }
                    else
                        set_ipb_cookie($row["ipb_fid"]);
                }
                if (isset($_GET["returnto"]))
                    $url=urldecode($_GET["returnto"]);
                else
                    $url="index.php";
                redirect($url);
                die();
            }
            else
            {
                // We have a bad password entry
                $logintpl->set("FALSE_USER",false,true);
                $logintpl->set("FALSE_PASSWORD",true,true);
                $logintpl->set("login_password_incorrect",$language["ERR_PASSWORD_INCORRECT"]);

                if($btit_settings["fmhack_alternate_login"]=="enabled")
                {
                    if($user_location=="" || $user_location=="index.php?page=login")
                    {
                        //redirect("login_new.php?cr=1");
                        login_redirect("cr",1);
                    }
                }
                else
                {
                    xbtit_login();
                }
            }
        }
    }
    else
    {
        $logintpl->set("FALSE_USER",false,true);
        $logintpl->set("FALSE_PASSWORD",false,true);

        if($btit_settings["fmhack_alternate_login"]=="enabled")
        {
            if($user_location=="" || $user_location=="index.php?page=login")
            {
                //redirect("login_new.php?cr=1");
                login_redirect("cr",1);
            }
        }
        else
        {
            xbtit_login();
        }
    }
}
else
{
    if (isset($_GET["returnto"]))
        $url=urldecode($_GET["returnto"]);
    else
        $url="index.php";
    redirect($url);
    die();
}

?>
