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




require_once(load_language("lang_usercp.php"));
global $CURUSER, $language, $usercptpl;

if (isset($_GET["what"]) && $_GET["what"])
      $what=$_GET["what"];
else $what = "inbox";

if (isset($_GET["action"]) && $_GET["action"])
      $action=$_GET["action"];
else $action = "";

if (isset($_GET["preview"]) && $_GET["preview"])
      $preview=$_GET["preview"];
else $preview = "";

$uid=(isset($_GET["uid"])?intval($_GET["uid"]):1);

if ($CURUSER["uid"]!=$uid || $CURUSER["uid"]==1)
   {
       err_msg($language["ERROR"],$language["ERR_USER_NOT_USER"]);
       stdfoot();
       exit;
   }
else
    {
    $utorrents=max(0,$CURUSER["torrentsperpage"]);
    if (isset($_GET["do"])) $do=$_GET["do"];
      else $do = "";
    if (isset($_GET["action"]))
       $action=$_GET["action"];

$USER_PATH=dirname(__FILE__);

require_once("$USER_PATH/usercp.menu.php");
$menucptpl=new bTemplate();
$menucptpl->set("usercp_menu",$usercp_menu);
$tpl->set("main_left",set_block($language["USER_CP_1"],"center",$menucptpl->fetch(load_template("usercp.menu.tpl"))));

$usercptpl=new bTemplate();
$usercptpl->set("language",$language);

switch ($do)
    {
    case 'pm':
    include("$USER_PATH/usercp.pmbox.php");
    $tpl->set("main_content",set_block($language["MNU_UCP_PM"],"center",$usercptpl->fetch(load_template("usercp.pmbox.tpl"))));
    break;

    case 'user':
    include("$USER_PATH/usercp.profile.php");
    $tpl->set("main_content",set_block($language["ACCOUNT_EDIT"],"center",$usercptpl->fetch(load_template("usercp.profile.tpl"))));
    break;

    case 'pwd':
    include("$USER_PATH/usercp.pass.php");
    $tpl->set("main_content",set_block($language["MNU_UCP_CHANGEPWD"],"center",$usercptpl->fetch(load_template("usercp.pass.tpl"))));
    break;

    case 'pid_c':
    include("$USER_PATH/usercp.pidchange.php");
    $tpl->set("main_content",set_block($language["CHANGE_PID"],"center",$usercptpl->fetch(load_template("usercp.pidchange.tpl"))));
    break;
    case 'invite':
    include("$USER_PATH/usercp.invitations.php");
    $tpl->set("main_content",set_block($language["MNU_UCP_INVITATIONS"],"center",$usercptpl->fetch(load_template("usercp.invitations.tpl"))));
    break;
    case 'user_extras':
    include("$USER_PATH/usercp.extras.php");
    $tpl->set("main_content",set_block($language['SIG_n_STUFF'],"center",$usercptpl->fetch(load_template("usercp.extra.tpl"))));
    break;
    case 'avatar':
    include("$USER_PATH/usercp.avatar.php");
    $tpl->set("main_content",set_block($language["MNU_UCP_AVATAR"],"center",$usercptpl->fetch(load_template("usercp.avatar.tpl"))));
    break;
	case 'teampic':
	require(load_language("lang_teams.php"));
    include("$USER_PATH/usercp.teampic.php");
    $tpl->set("main_content",set_block($language['TEAMPIC_EDIT'],"center",$usercptpl->fetch(load_template("usercp.teampic.tpl"))));
    break;
    default:
    include("$USER_PATH/usercp.main.php");
    $tpl->set("main_content",set_block($language["MNU_UCP_HOME"],"center",$usercptpl->fetch(load_template("usercp.main.tpl"))));
    break;
}


// Reverify Mail Hack by Petr1fied - Start --->
// Update the members e-mail account if the validation link checks out
// ==========================================================================================
    // If both "do=verify" and "action=changemail" are in the url

    if ($do=="verify" && $action=="changemail")
       {
       if($GLOBALS["FORUMLINK"]=="ipb")
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
       }
       // Get the other values we need from the url
       $newmail=$_GET["newmail"];
       (isset($_GET["uid"]) && !empty($_GET["uid"]) && is_numeric($_GET["uid"]) && $_GET["uid"]>0) ? $id=max(0,$_GET["uid"]) : $id=0;
       if($id==0)
           stderr($language["ERROR"], $language["BAD_ID"]);
       $random=max(0,$_GET["random"]);
       $idlevel=$CURUSER["id_level"];

       // Get the members random number, current email and temp email from their record
       $getacc=do_sqlquery("SELECT `u`.`random`, `u`.`email`, `u`.`temp_email`".((substr($GLOBALS["FORUMLINK"],0,3)=="smf")?", `u`.`smf_fid`, `ul`.`smf_group_mirror`":(($GLOBALS["FORUMLINK"]=="ipb")?", `u`.`ipb_fid`, `ul`.`ipb_group_mirror`":""))." FROM `{$TABLE_PREFIX}users` `u` ".((substr($GLOBALS["FORUMLINK"],0,3)=="smf" || $GLOBALS["FORUMLINK"]=="ipb")?"LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON 3=`ul`.`id`":"")." WHERE `u`.`id`=".$id,true)->fetch_assoc();
       $oldmail=$getacc["email"];
       $dbrandom=$getacc["random"];
       $mailcheck=$getacc["temp_email"];

       // If the random number in the url matches that in the member record
       if ($random==$dbrandom)
       {

           // Verify the email address in the url is the address we sent the mail to
           if ($newmail!=$mailcheck) {
             err_msg($language["ERROR"],$language["NOT_MAIL_IN_URL"]);
             stdfoot();
             exit;
           }

            // Update their tracker member record with the now verified email address
            quickQuery("UPDATE {$TABLE_PREFIX}users SET email='".sql_esc($newmail)."' WHERE id='".$id."'",true);

            // If using SMF, update their record on that too.
            if(substr($GLOBALS["FORUMLINK"],0,3)=="smf")
            {
                $basedir=substr(str_replace("\\", "/", dirname(__FILE__)), 0, strrpos(str_replace("\\", "/", dirname(__FILE__)), '/'));
                $language2=$language;
                require_once($basedir."/smf/Settings.php");
                $language=$language2;
                quickQuery("UPDATE `{$db_prefix}members` SET `email".(($GLOBALS["FORUMLINK"]=="smf")?"A":"_a")."ddress`='".sql_esc($newmail)."' WHERE ".(($GLOBALS["FORUMLINK"]=="smf")?"`ID_MEMBER`":"`id_member`")."=".$getacc["smf_fid"],true);
            }
            elseif($GLOBALS["FORUMLINK"]=="ipb")
                IPSMember::save($getacc["ipb_fid"], array("members" => array("email" => "$newmail")));

            // Print a message stating that their email has been successfully changed
            success_msg($language["SUCCESS"],$language["REVERIFY_CONGRATS1"]." ".$oldmail." ".$language["REVERIFY_CONGRATS2"]." ".$newmail." ".$language["REVERIFY_CONGRATS3"]."<a href=\"".$BASEURL."\">".$language["MNU_INDEX"]."</a>");
            stdfoot(true,false);
            // If the member clicking the link is validating...
            if ($idlevel==2)
            {
                // ...we may as well upgrade their rank to member whilst we're at it.
                quickQuery("UPDATE {$TABLE_PREFIX}users SET id_level=3 WHERE id='".$id."'");
                if(substr($GLOBALS["FORUMLINK"],0,3)=="smf")
                    quickQuery("UPDATE {$db_prefix}members SET ".(($GLOBALS["FORUMLINK"]=="smf")?"`ID_GROUP`":"`id_group`")."=".(($getacc["smf_group_mirror"]>0)?$getacc["smf_group_mirror"]:"13")." WHERE ".(($GLOBALS["FORUMLINK"]=="smf")?"`ID_MEMBER`":"`id_member`")."=".$getacc["smf_fid"]);
                elseif($GLOBALS["FORUMLINK"]=="ipb")
 	  	        {
 	  	            $ipblev=(($getacc["ipb_group_mirror"]>0)?$getacc["ipb_group_mirror"]:"3");
 	  	            IPSMember::save($getacc["ipb_fid"], array("members" => array("member_group_id" => "$ipblev")));
 	  	        }
            }
       }
       // If the random number in the url is incorrect print an error message
       else
         {
         err_msg($language["REVERIFY_FAILURE"]."<a href=\"".$BASEURL."\">".$language["MNU_INDEX"]."</a>");
         stdfoot();
         exit;
       }
       // End the block and add a couple of linespaces afterwards.

       }
// <--- Reverify Mail Hack by Petr1fied - End

     }
?>
