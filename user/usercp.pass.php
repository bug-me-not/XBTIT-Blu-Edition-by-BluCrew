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

$uid=$CURUSER['uid'];

switch ($action)
{
    case 'post':

        $pass_to_test=$_POST["new_pwd"];
        $pass_min_req=explode(",", $btit_settings["secsui_pass_min_req"]);

        $lct_count=0;
        $uct_count=0;
        $num_count=0;
        $sym_count=0;
        $pass_end=(int)(strlen($pass_to_test)-1);
        $pass_position=0;
        $pattern1='#[a-z]#';
        $pattern2='#[A-Z]#';
        $pattern3='#[0-9]#';
        $pattern4='/[�!"�$%^&*()`{}\[\]:@~;\'#<>?,.\/\\-=_+\|]/';

        for($pass_position=0;$pass_position<=$pass_end;$pass_position++)
        {
            if(preg_match($pattern1,substr($pass_to_test,$pass_position,1),$matches))
                $lct_count++;
            elseif(preg_match($pattern2,substr($pass_to_test,$pass_position,1),$matches))
                $uct_count++;
            elseif(preg_match($pattern3,substr($pass_to_test,$pass_position,1),$matches))
                $num_count++;
            elseif(preg_match($pattern4,substr($pass_to_test,$pass_position,1),$matches))
                $sym_count++;
        }
        if ($_POST["old_pwd"]=="")
            stderr($language["ERROR"],$language["INS_OLD_PWD"]);
        elseif ($_POST["new_pwd"]=="")
            stderr($language["ERROR"],$language["INS_NEW_PWD"]);
        elseif ($_POST["new_pwd"]!=$_POST["new_pwd1"])
            stderr($language["ERROR"],$language["DIF_PASSWORDS"]);
        elseif(strlen($pass_to_test)<$pass_min_req[0])
            stderr($language["ERROR"],$language["ERR_PASS_LENGTH_1"]." <b><span style=\"color:blue;\">".$pass_min_req[0]."</span></b> ".$language["ERR_PASS_LENGTH_2"]);
        elseif($lct_count<$pass_min_req[1] || $uct_count<$pass_min_req[2] || $num_count<$pass_min_req[3] || $sym_count<$pass_min_req[4])
        {
            $newpassword=pass_the_salt(20);
            stderr($language["ERROR"],$language["ERR_PASS_TOO_WEAK_1"].":<br /><br />".(($pass_min_req[1]>0)?"<li><span style='color:blue;font-weight:bold;'>".$pass_min_req[1]."</span> ".(($pass_min_req[1]==1)?$language["ERR_PASS_TOO_WEAK_2"]:$language["ERR_PASS_TOO_WEAK_2A"])."</li>":"").(($pass_min_req[2]>0)?"<li><span style='color:blue;font-weight:bold;'>".$pass_min_req[2]."</span> ".(($pass_min_req[2]==1)?$language["ERR_PASS_TOO_WEAK_3"]:$language["ERR_PASS_TOO_WEAK_3A"])."</li>":"").(($pass_min_req[3]>0)?"<li><span style='color:blue;font-weight:bold;'>".$pass_min_req[3]."</span> ".(($pass_min_req[3]==1)?$language["ERR_PASS_TOO_WEAK_4"]:$language["ERR_PASS_TOO_WEAK_4A"])."</li>":"").(($pass_min_req[4]>0)?"<li><span style='color:blue;font-weight:bold;'>".$pass_min_req[4]."</span> ".(($pass_min_req[4]==1)?$language["ERR_PASS_TOO_WEAK_5"]:$language["ERR_PASS_TOO_WEAK_5A"])."</li>":"")."<br />".$language["ERR_PASS_TOO_WEAK_6"].":<br /><br /><span style='color:blue;font-weight:bold;'>".$newpassword."</span><br />");
        }
        else
        {
            $testpass=hash_generate(array("salt" => $CURUSER["salt"]), $_POST["old_pwd"], $CURUSER["username"]);
            $respwd = do_sqlquery("SELECT * FROM `{$TABLE_PREFIX}users` WHERE `id`=$uid AND `password`='".sql_esc($testpass[$CURUSER["pass_type"]]["hash"])."' AND username=".sqlesc($CURUSER["username"])."",true);
            if (!$respwd || sql_num_rows($respwd)==0)
                stderr($language["ERROR"],$language["ERR_RETR_DATA"]);
            else
            {
                $arr=$respwd->fetch_assoc();
                $multipass=hash_generate(array("salt" => ""), $_POST["new_pwd"], $CURUSER["username"]);
                $i=$btit_settings["secsui_pass_type"];
                quickQuery("UPDATE {$TABLE_PREFIX}users SET `password`='".sql_esc($multipass[$i]["rehash"])."', `salt`='".sql_esc($multipass[$i]["salt"])."', `pass_type`='".$i."', `dupe_hash`='".sql_esc($multipass[$i]["dupehash"])."' WHERE id=$uid AND password='".sql_esc($testpass[$CURUSER["pass_type"]]["hash"])."' AND username=".sqlesc($CURUSER["username"])."",true);
                if(substr($GLOBALS["FORUMLINK"],0,3)=="smf")
                {
                    $passhash=smf_passgen($CURUSER["username"], $_POST["new_pwd"]);
                    quickQuery("UPDATE `{$db_prefix}members` SET `passwd`='$passhash[0]', `password".(($GLOBALS["FORUMLINK"]=="smf")?"S":"_s")."alt`='$passhash[1]' WHERE ".(($GLOBALS["FORUMLINK"]=="smf")?"`ID_MEMBER`":"`id_member`")."=".$arr["smf_fid"],true);
                }
                elseif($GLOBALS["FORUMLINK"]=="ipb")
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
 	  	            $ipbhash=ipb_passgen($_POST["new_pwd"]);
 	  	            IPSMember::save($arr["ipb_fid"], array("members" => array("member_login_key" => "", "member_login_key_expire" => "0", "members_pass_hash" => "$ipbhash[0]", "members_pass_salt" => "$ipbhash[1]")));
 	            }
                success_msg($language["PWD_CHANGED"], "".$language["NOW_LOGIN"]."<br /><a href=\"index.php?page=login\">Go</a>");
                stdfoot(true,false);
                exit;
            }
        }
    break;

    case '':
    case 'change':
    default:
        $pwdtpl=array();
        $pwdtpl["frm_action"]="index.php?page=usercp&amp;do=pwd&amp;action=post&amp;uid=".$uid."";
        $pwdtpl["frm_cancel"]="index.php?page=usercp&amp;uid=".$uid."";
        $usercptpl->set("pwd",$pwdtpl);
        $pass_min_req=explode(",", $btit_settings["secsui_pass_min_req"]);
        $usercptpl->set("pass_min_char",$pass_min_req[0]);
        $usercptpl->set("pass_min_lct",$pass_min_req[1]);
        $usercptpl->set("pass_min_uct",$pass_min_req[2]);
        $usercptpl->set("pass_min_num",$pass_min_req[3]);
        $usercptpl->set("pass_min_sym",$pass_min_req[4]);
        $usercptpl->set("pass_char_plural", (($pass_min_req[0]==1)?false:true),true);
        $usercptpl->set("pass_lct_plural", (($pass_min_req[1]==1)?false:true),true);
        $usercptpl->set("pass_uct_plural", (($pass_min_req[2]==1)?false:true),true);
        $usercptpl->set("pass_num_plural", (($pass_min_req[3]==1)?false:true),true);
        $usercptpl->set("pass_sym_plural", (($pass_min_req[4]==1)?false:true),true);
        $usercptpl->set("pass_lct_set", (($pass_min_req[1]>0)?true:false),true);
        $usercptpl->set("pass_uct_set", (($pass_min_req[2]>0)?true:false),true);
        $usercptpl->set("pass_num_set", (($pass_min_req[3]>0)?true:false),true);
        $usercptpl->set("pass_sym_set", (($pass_min_req[4]>0)?true:false),true);
    break;
}
?>