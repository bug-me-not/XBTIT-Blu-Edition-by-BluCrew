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



if (!$CURUSER || ($CURUSER["admin_access"]!="yes" && $CURUSER["edit_users"]!="yes"))
{
   err_msg($language["ERROR"],$language["NOT_ADMIN_CP_ACCESS"]);
   stdfoot();
   exit;
}

// Additional admin check by miskotes
$aid = max(0, $_GET["user"]);
$arandom = max(0,$_GET["code"]);
if (!$aid || empty($aid) || $aid==0 || !$arandom || empty($arandom) || $arandom==0)
{
   err_msg($language["ERROR"],$language["NOT_ADMIN_CP_ACCESS"]);
   stdfoot();
   exit;
}
//if ($arandom!=$ranid["random"] || $aid!=$ranid["id"])
//{
$mqry=do_sqlquery("select u.id, ul.admin_access from {$TABLE_PREFIX}users u INNER JOIN {$TABLE_PREFIX}users_level ul on ul.id=u.id_level WHERE u.id=$aid AND random=$arandom AND (admin_access='yes' OR edit_users='yes') AND username=".sqlesc($CURUSER["username"]),true);

if (sql_num_rows($mqry)<1)
{
   err_msg($language["ERROR"],$language["NOT_ADMIN_CP_ACCESS"]);
   stdfoot();
   exit;
}
else
   $mres=$mqry->fetch_assoc();
$moderate_user=($mres["admin_access"]=="no");
// EOF

define("IN_ACP",true);


if (isset($_GET["do"])) $do=$_GET["do"];
else $do = "";
if (isset($_GET["action"]))
   $action=$_GET["action"];

$ADMIN_PATH=dirname(__FILE__);

include(load_language("lang_admin.php"));

if ($do!="users"  && $do!="masspm"  && $do!=(($btit_settings["fmhack_advanced_prune_users_and_torrents"]=="enabled")?"adv_":"")."pruneu"  && $do!="searchdiff" && $moderate_user)
{
   err_msg($language["ERROR"],$language["NOT_ADMIN_CP_ACCESS"]);
   stdfoot();
   exit;
}


if($btit_settings["fmhack_staffpanel"]=="enabled")
{
   // --------> modpanel
   // check the permissions if id_level<8
   if ($CURUSER['id_level']<8 && $do!='' && $do!="users"  && $do!="masspm"  && $do!=(($btit_settings["fmhack_advanced_prune_users_and_torrents"]=="enabled")?"adv_":"")."pruneu"  && $do!="searchdiff")
   {
      if ($CURUSER['admin_access']!='yes')
      {
         err_msg($language["ERROR"],$language["NOT_ADMIN_CP_ACCESS"]);
         stdfoot();
         exit;
      }
      // check access in the table
      $ra=do_sqlquery("SELECT access FROM {$TABLE_PREFIX}adminpanel WHERE section='$do' AND id_level=".$CURUSER['id']);
      // row don't exists
      if (!$ra)
      {
         err_msg($language["ERROR"],$language["NO_SECTION_ACCESS"]);
         stdfoot();
         exit;
      }
      $rar=$ra->fetch_assoc();
      // access is not set to ok
      if ($rar['access']!='1')
      {
         err_msg($language["ERROR"],$language["NO_SECTION_ACCESS"]);
         stdfoot();
         exit;
      }
   }
   // --------> modpanel
}
include("$ADMIN_PATH/admin.menu.php");

$menutpl=new bTemplate();
$menutpl->set("admin_menu",$admin_menu);
$tpl->set("main_left",set_block($language["ACP_MENU"],"center",$menutpl->fetch(load_template("admin.menu.tpl"))));

$admintpl=new bTemplate();

switch ($do)
{ case 'sticky':
include("$ADMIN_PATH/admin.sticky.php");
$tpl->set("main_content",set_block($language["STICKY_SETTINGS"],"center",$admintpl->fetch(load_template("admin.sticky.tpl"))));
break;

/*Mod by losmi - rules*/
case 'rules':
include("$ADMIN_PATH/admin.rules.php");
$tpl->set("main_content",set_block($language["ACP_RULES"],"center",$admintpl->fetch(load_template("admin.rules.tpl"))));
break;
case 'rules_cat':
include("$ADMIN_PATH/admin.rules.categories.php");
$tpl->set("main_content",set_block($language["ACP_RULES_GROUP"],"center",$admintpl->fetch(load_template("admin.rules.categories.tpl"))));
break;
/*End mod by losmi - rules*/


   // --------> modpanel
case 'modpanel':
$admintpl->set("usercode",$CURUSER['random']);
$admintpl->set("userid",$CURUSER['uid']);
$tpl->set("main_content",set_block($language["ACP_MODPANEL"],"center",$admintpl->fetch(load_template("admin.modpanel.tpl"))));
break;
   // --------> modpanel

case 'read_messages':
include("$ADMIN_PATH/admin.read_messages.php");
$tpl->set("main_content",set_block($language["SUPPORT"],"center",$admintpl->fetch(load_template("admin.read_messages.tpl"))));
break;


case 'gold':
include("$ADMIN_PATH/admin.gold.php");
$tpl->set("main_content",set_block($language["ACP_GOLD"],"center",$admintpl->fetch(load_template("admin.gold.tpl"))));
break;


case 'invitations':
include("$ADMIN_PATH/admin.invitations.php");
$tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.invitations.tpl"))));
break;

case 'ads_setup':
include("$ADMIN_PATH/admin.ads.php");
$tpl->set("main_content",set_block($language["ADS_CONF"],"center",$admintpl->fetch(load_template("admin.ads.tpl"))));
break;

case 'comment_captcha':
include("$ADMIN_PATH/admin.captcha.php");
$tpl->set("main_content",set_block($language["CAPTCHA_CONFIG"],"center",$admintpl->fetch(load_template("admin.captcha.tpl"))));
break;

case 'welcome_msg':
include("$ADMIN_PATH/admin.welcome_pm.php");
$tpl->set("main_content",set_block($language["SETUP_MSG2"],"center",$admintpl->fetch(load_template("admin.welcome_pm.tpl"))));
break;

case 'imageflow_settings':
include("$ADMIN_PATH/admin.imageflowconf.php");
$tpl->set("main_content",set_block("Imageflow Settings","center",$admintpl->fetch(load_template("imageflow.config.tpl"))));
break;

case 'language':
include("$ADMIN_PATH/admin.languages.php");
$tpl->set("main_content",set_block($language["LANGUAGE_SETTINGS"],"center",$admintpl->fetch(load_template("admin.languages.tpl"))));
break;

case 'searchdiff':
include("$ADMIN_PATH/admin.search_diff.php");
$tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.search_diff.tpl"))));
break;

case 'forum':
include("$ADMIN_PATH/admin.forums.php");
$tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.forums.tpl"))));
break;

case 'masspm':
include("$ADMIN_PATH/admin.masspm.php");
$tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.masspm.tpl"))));
break;

case 'pruneu':
include("$ADMIN_PATH/admin.prune_users.php");
$tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.prune_users.tpl"))));
break;

case 'dbutil':
include("$ADMIN_PATH/admin.dbutil.php");
$tpl->set("main_content",set_block($language["DBUTILS_TABLES"]." ".$language["DBUTILS_STATUS"],"center",$admintpl->fetch(load_template("admin.dbutil.tpl"))));
break;

case 'logview':
include("$ADMIN_PATH/admin.sitelog.php");
$tpl->set("main_content",set_block($language["SITE_LOG"],"center",$admintpl->fetch(load_template("admin.sitelog.tpl"))));
break;case 'booted_users':
include("$ADMIN_PATH/admin.booted_users.php");
$tpl->set("main_content",set_block($language["ACP_BOOTED"],"center",$admintpl->fetch(load_template("admin.booted_users.tpl"))));
break;
case 'warned_users':
include("$ADMIN_PATH/admin.warned_users.php");
$tpl->set("main_content",set_block("Warned users","center",$admintpl->fetch(load_template("admin.warned_users.tpl"))));
break;

case 'mysql_stats':
$content="";
include("$ADMIN_PATH/admin.mysql_stats.php");
$tpl->set("main_content",set_block($language["MYSQL_STATUS"],"center",$content));
break;

case 'prunet':
include("$ADMIN_PATH/admin.prune_torrents.php");
$tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.prune_torrents.tpl"))));
break;

case 'groups':
include("$ADMIN_PATH/admin.groups.php");
$tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.groups.tpl"))));
break;
         // Hit & Run -->
case 'hitrun':
include("$ADMIN_PATH/admin.hitrun.php");
$tpl->set("main_content",set_block($language["ACP_HITRUN"],"center",$admintpl->fetch(load_template("admin.hitrun.tpl"))));
break;
         // <-- Hit & Run

case 'free':
include("$ADMIN_PATH/admin.freecontrol.php");
$tpl->set("main_content",set_block($language["ACP_FREECTRL"],"center",$admintpl->fetch(load_template("admin.freecontrol.tpl"))));
break;


case 'poller':
include("$ADMIN_PATH/admin.polls.php");
$tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.polls.tpl"))));
break;

case 'badwords':
include("$ADMIN_PATH/admin.censored.php");
$tpl->set("main_content",set_block($language["ACP_CENSORED"],"center",$admintpl->fetch(load_template("admin.censored.tpl"))));
break;

case 'blocks':
include("$ADMIN_PATH/admin.blocks.php");
$tpl->set("main_content",set_block($language["BLOCKS_SETTINGS"],"center",$admintpl->fetch(load_template("admin.blocks.tpl"))));
break;

case 'style':
include("$ADMIN_PATH/admin.styles.php");
$tpl->set("main_content",set_block($language["STYLE_SETTINGS"],"center",$admintpl->fetch(load_template("admin.styles.tpl"))));
break;

case 'category':
include("$ADMIN_PATH/admin.categories.php");
$tpl->set("main_content",set_block($language["CATEGORY_SETTINGS"],"center",$admintpl->fetch(load_template("admin.categories.tpl"))));
break;


case 'config':
include("$ADMIN_PATH/admin.config.php");
$tpl->set("main_content",set_block($language["TRACKER_SETTINGS"],"center",$admintpl->fetch(load_template("admin.config.tpl"))));
break;

case 'banip':
include("$ADMIN_PATH/admin.banip.php");
$tpl->set("main_content",set_block($language["ACP_BAN_IP"],"center",$admintpl->fetch(load_template("admin.banip.tpl"))));
break;

case 'module_config':
include("$ADMIN_PATH/admin.module_config.php");
$tpl->set("main_content",set_block($language["ACP_MODULES_CONFIG"],"center",$admintpl->fetch(load_template("admin.module_config.tpl"))));
break;

case 'hacks':
include("$ADMIN_PATH/admin.hacks.php");
$tpl->set("main_content",set_block($language["ACP_HACKS_CONFIG"],"center",$admintpl->fetch(load_template("admin.hacks.tpl"))));
break;

case 'users':
include("$ADMIN_PATH/admin.users.tools.php");
$tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.users.tools.tpl"))));
break;
case 'lottery_settings':
include("$ADMIN_PATH/admin.lottery.php");
$tpl->set("main_content",set_block($language["LOTT_SETTINGS"],"center",$admintpl->fetch(load_template("admin.lottery.tpl"))));
break;

case 'view_selled_tickets':
include("$ADMIN_PATH/admin.view_tickets.php");
$tpl->set("main_content",set_block($language["ACP_SELLED_TICKETS"],"center",$admintpl->fetch(load_template("admin.view_tickets.tpl"))));
break;

case 'xtd':
include($ADMIN_PATH.'/admin.xtd.php');
$tpl->set('main_content',set_block($language['XTD_ACP'],'center',$admintpl->fetch(load_template('admin.xtd.tpl'))));
break;

         // Donation History by DiemThuy -->
case 'don_hist':
include("$ADMIN_PATH/admin.don_hist.php");
$tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.don_hist.tpl"))));
break;

case 'don_edit':
include("$ADMIN_PATH/admin.don_edit.php");
$tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.don_edit.tpl"))));
break;
         // <-- Donation History by DiemThuy

case 'seedbonus':
include("$ADMIN_PATH/admin.bonus.php");
$tpl->set("main_content",set_block($language["ACP_SEEDBONUS"],"center",$admintpl->fetch(load_template("admin.bonus.tpl"))));
break;


case 'donate':
include("$ADMIN_PATH/admin.donate.php");
$tpl->set("main_content",set_block($language["ACP_DONATE"],"center",$admintpl->fetch(load_template("admin.donate.tpl"))));
break;

case 'autorank':
include("$ADMIN_PATH/admin.autorank.php");
$tpl->set("main_content",set_block($language["ACP_AUTORANK"],"center",$admintpl->fetch(load_template("admin.autorank.tpl"))));
break;

case 'offline':
include("$ADMIN_PATH/admin.offline.php");
$tpl->set("main_content",set_block($language["ACP_OFFLINE"],"center",$admintpl->fetch(load_template("admin.offline.tpl"))));
break;

case 'radio_settings':
include("$ADMIN_PATH/admin.radioconf.php");
$tpl->set("main_content",set_block($language["RAD_SETTINGS"],"center",$admintpl->fetch(load_template("radio.config.tpl"))));
break;

         //messagespy
case 'ispy':
include("$ADMIN_PATH/admin.ispy.php");
$tpl->set("main_content",set_block($language["ACP_ISPY"],"center",$admintpl->fetch(load_template("admin.ispy.tpl"))));
break;
         //messagespy

case 'newuser':
include("$ADMIN_PATH/admin.users.new.php");
$tpl->set("main_content",set_block($language["ACP_ADD_USER"],"center",$admintpl->fetch(load_template("admin.users.new.tpl"))));
break;

case 'banclient':
include("$ADMIN_PATH/admin.ban_client.php");
$tpl->set("main_content",set_block($language["BAN_CLIENT"],"center",$admintpl->fetch(load_template("admin.ban_client.tpl"))));
break;

case 'clearclientban':
include("$ADMIN_PATH/admin.client_clearban.php");
$tpl->set("main_content",set_block($language["REMOVE_CLIENTBAN"],"center",$admintpl->fetch(load_template("admin.client_clearban.tpl"))));
break;

case 'banbutton':
include("$ADMIN_PATH/admin.banbutton.php");
$tpl->set("main_content",set_block($language["ACP_BB"],"center",$admintpl->fetch(load_template("admin.banbutton.tpl"))));
break;

case 'banbutton_user':
include("$ADMIN_PATH/admin.banbutton_user.php");
$tpl->set("main_content",set_block($language["ACP_BB_USER"],"center",$admintpl->fetch(load_template("admin.banbutton_user.tpl"))));
break;

case 'ratio-editor':
include("$ADMIN_PATH/admin.ratio-editor.php");
$tpl->set("main_content",set_block($language["ACP_RATIO_EDITOR"],"center",$admintpl->fetch(load_template("admin.ratio-editor.tpl"))));
break;

case 'duplicates':
include("$ADMIN_PATH/admin.duplicates.php");
$tpl->set("main_content",set_block($language["DUPLICATES"],"center",$admintpl->fetch(load_template("admin.duplicates.tpl"))));
break;

case 'warn':
include("$ADMIN_PATH/admin.warn.php");
$tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.warn.tpl"))));
break;

case 'twitter':
include("$ADMIN_PATH/admin.twitter.php");
$tpl->set("main_content",set_block($language["TWIT_REG"],"center",$admintpl->fetch(load_template("admin.twitter.tpl"))));
break;

case 'teams':
require(load_language("lang_teams.php"));
include("$ADMIN_PATH/admin.team.php");
$tpl->set("main_content",set_block($language["TEAM_HEAD_H"],"center",$admintpl->fetch(load_template("admin.team.tpl"))));
break;

case 'team_users':
require(load_language("lang_teams.php"));
include("$ADMIN_PATH/admin.teams.php");
$tpl->set("main_content",set_block($language["TEAM_HEAD_U"],"center",$admintpl->fetch(load_template("admin.teams.tpl"))));
break;

case 'style_bridge':
include("$ADMIN_PATH/admin.style_bridge.php");
$tpl->set("main_content",set_block($language["STYLE_BRIDGE"],"center",$admintpl->fetch(load_template("admin.style_bridge.tpl"))));
break;

case 'signup_bonus':
include("$ADMIN_PATH/admin.signup.bonus.php");
$tpl->set("main_content",set_block($language["SETTINGS_UPLOAD"],"center",$admintpl->fetch(load_template("admin.signup.bonus.tpl"))));
break;

case 'image_upload':
include("$ADMIN_PATH/admin.image.upload.php");
$tpl->set("main_content",set_block($language["IMAGE_SETTING"],"center",$admintpl->fetch(load_template("admin.image.upload.tpl"))));
break;

case 'don_hist_set':
include("$ADMIN_PATH/admin.don.hist.php");
$tpl->set("main_content",set_block($language["ACP_DON_HIST_SET"],"center",$admintpl->fetch(load_template("admin.don.hist.tpl"))));
break;

case 'hrb_conf':
include("$ADMIN_PATH/admin.hitrun.block.php");
$tpl->set("main_content",set_block($language["HNR_BLOCK_SETTINGS"],"center",$admintpl->fetch(load_template("admin.hitrun.block.tpl"))));
break;

case 'sb_use':
include("$ADMIN_PATH/admin.seedbox.use.php");
$tpl->set("main_content",set_block($language["SB_SS_SETTINGS"],"center",$admintpl->fetch(load_template("admin.seedbox.use.tpl"))));
break;

case 'warn_settings':
include("$ADMIN_PATH/admin.warn_settings.php");
$tpl->set("main_content",set_block($language["WS_WARN_SETTINGS"],"center",$admintpl->fetch(load_template("admin.warn_settings.tpl"))));
break;

case 'lrb':
include("$ADMIN_PATH/admin.lrb.php");
$tpl->set("main_content",set_block($language["ACP_LRB"],"center",$admintpl->fetch(load_template("admin.lrb.tpl"))));
break;

case 'multi':
include("$ADMIN_PATH/admin.multi.php");
$tpl->set("main_content",set_block($language["UPM_SETTINGS"],"center",$admintpl->fetch(load_template("admin.multi.tpl"))));
break;

case 'proxy':
include("$ADMIN_PATH/admin.proxy.php");
$tpl->set("main_content",set_block($language["ACP_PROXY"],"center",$admintpl->fetch(load_template("admin.proxy.tpl"))));
break;

case 'blacklist':
include("$ADMIN_PATH/admin.blacklist.php");
$tpl->set("main_content",set_block($language["ACP_BLACKLIST"],"center",$admintpl->fetch(load_template("admin.blacklist.tpl"))));
break;


/*Mod by losmi - faq*/
case 'faq_group':
include("$ADMIN_PATH/admin.faq.group.php");
$tpl->set("main_content",set_block($language["ACP_FAQ_GROUP"],"center",$admintpl->fetch(load_template("admin.faq.group.tpl"))));
break;


case 'faq_question':
include("$ADMIN_PATH/admin.faq.question.php");
$tpl->set("main_content",set_block($language["ACP_FAQ_QUESTION"],"center",$admintpl->fetch(load_template("admin.faq.question.tpl"))));
break;
/*End mod by losmi - faq*/

         // gifts
case 'gifts':
include("$ADMIN_PATH/admin.gifts.php");
$tpl->set("main_content",set_block($language["ACP_GIFTS"],"center",$admintpl->fetch(load_template("admin.gifts.tpl"))));
break;
            // gifts

case 'ipb_new_member':
include("$ADMIN_PATH/admin.ipb_new_member.php");
break;

case 'staff_control':
include("$ADMIN_PATH/admin.staff_control.php");
$tpl->set("main_content",set_block($language['ACP_STAFF_CONTROL'],"center",$admintpl->fetch(load_template("admin.staff_control.tpl"))));
break;

case 'birthday':
include("$ADMIN_PATH/admin.birthday.php");
$tpl->set("main_content",set_block($language["ACP_BIRTHDAY"],"center",$admintpl->fetch(load_template("admin.birthday.tpl"))));
break;

case 'dlpresuf':
include("$ADMIN_PATH/admin.dl_prefix_or_suffix.php");
$tpl->set("main_content",set_block($language["ACP_DPS_SETTINGS"],"center",$admintpl->fetch(load_template("admin.dl_prefix_or_suffix.tpl"))));
break;

case 'ulrights':
include("$ADMIN_PATH/admin.upload_rights.php");
$tpl->set("main_content",set_block($language["ACP_UPL_RIGHTS"],"center",$admintpl->fetch(load_template("admin.upload_rights.tpl"))));
break;

case 'pgtype':
include("$ADMIN_PATH/admin.pager_type.php");
$tpl->set("main_content",set_block($language["ACP_PG_SETT"],"center",$admintpl->fetch(load_template("admin.pager_type.tpl"))));
break;

case 'block_cheapmail':
include("$ADMIN_PATH/admin.pd-block_cheapmail.php");
$tpl->set("main_content",set_block($language["BAN_CHEAPMAIL"],"center",$admintpl->fetch(load_template("admin.pd-block_cheapmail.tpl"))));
break;

case 'uploader_control':
include("$ADMIN_PATH/admin.uploader_control.php");
$tpl->set("main_content",set_block($language["UP_CONTROL"],"center",$admintpl->fetch(load_template("admin.uploader_control.tpl"))));
break;

case 'ip2c_import':
include("$ADMIN_PATH/admin.ip2country_import.php");
break;

case 'avatar_upload':
include("$ADMIN_PATH/admin.avatar_upload.php");
$tpl->set("main_content",set_block($language["AVATAR_UPLOAD"],"center",$admintpl->fetch(load_template("admin.avatar_upload.tpl"))));
break;

case 'requests':
include("$ADMIN_PATH/admin.requests.php");
$tpl->set("main_content",set_block($language["TRAV_REQ_SET"],"center",$admintpl->fetch(load_template("admin.requests.tpl"))));
break;

case 'dlcheck':
include("$ADMIN_PATH/admin.dlcheck.php");
$tpl->set("main_content",set_block($language["SETTING_CUSTOM_SETTINGS"],"center",$admintpl->fetch(load_template("admin.dlcheck.tpl"))));
break;

case 'sport_bet':
include("$ADMIN_PATH/admin.sport_bet.php");
$tpl->set("main_content",set_block($language["SB_SETTINGS"],"center",$admintpl->fetch(load_template("admin.sport_bet.tpl"))));
break;

case 'ban_button':
include("$ADMIN_PATH/admin.ban_button.php");
$tpl->set("main_content",set_block($language["BB_SETTINGS"],"center",$admintpl->fetch(load_template("admin.ban_button.tpl"))));
break;

case 'rep_high_ul':
include("$ADMIN_PATH/admin.rep_high_ul.php");
$tpl->set("main_content",set_block($language["RHUS_HIGH_UL_SUP"],"center",$admintpl->fetch(load_template("admin.rep_high_ul.tpl"))));
break;

case 'up_med':
include("$ADMIN_PATH/admin.up_med.php");
$tpl->set("main_content",set_block($language["UM_UPLOADER_MED"],"center",$admintpl->fetch(load_template("admin.up_med.tpl"))));
break;

case 'img_in_shout':
include("$ADMIN_PATH/admin.img_in_shout.php");
$tpl->set("main_content",set_block($language["IMGSB_SETTINGS"],"center",$admintpl->fetch(load_template("admin.img_in_shout.tpl"))));
break;

case 'user_notes':
include("$ADMIN_PATH/admin.user_notes.php");
$tpl->set("main_content",set_block($language["UN_SETTINGS"],"center",$admintpl->fetch(load_template("admin.user_notes.tpl"))));
break;

case 'notemod':
include("$ADMIN_PATH/admin.notemod.php");
$tpl->set("main_content",set_block($language["UN_NOTEMOD"],"center",$admintpl->fetch(load_template("admin.notemod.tpl"))));
break;

case 'tmod_set':
include("$ADMIN_PATH/admin.tmod_set.php");
$tpl->set("main_content",set_block($language["ACP_TMOD_SET"],"center",$admintpl->fetch(load_template("admin.tmod_set.tpl"))));
break;

case 'random_reg':
include("$ADMIN_PATH/admin.random_reg.php");
$tpl->set("main_content",set_block($language["RREG_SETTINGS"],"center",$admintpl->fetch(load_template("admin.random_reg.tpl"))));
break;

case 'smf_select':
include("$ADMIN_PATH/admin.cats.forum.php");
$tpl->set("main_content",set_block($language["ACP_CATFORUM_CONFIG"],"center",$admintpl->fetch(load_template("admin.cats.forum.tpl"))));
break;

case 'reencode':
include("$ADMIN_PATH/admin.reencode.php");
$tpl->set("main_content",set_block($language["ACP_REENC_SET"],"center",$admintpl->fetch(load_template("admin.reencode.tpl"))));
break;

case 'shout_announce':
include("$ADMIN_PATH/admin.shout_announce.php");
$tpl->set("main_content",set_block($language["ACP_SHOUTANN_SET"],"center",$admintpl->fetch(load_template("admin.shout_announce.tpl"))));
break;

case 'seo':
require_once(load_language("lang_seo.php"));
include("$ADMIN_PATH/admin.seo.php");
$tpl->set("main_content",set_block($language["ACP_SEO"],"center",$admintpl->fetch(load_template("admin.seo.tpl"))));
break;

case 'scommdet':
include("$ADMIN_PATH/admin.staff_comm_on_details.php");
$tpl->set("main_content",set_block($language["ACP_STCOMM_SET"],"center",$admintpl->fetch(load_template("admin.staff_comm_on_details.tpl"))));
break;

case 'recommend':
include("$ADMIN_PATH/admin.recommend.php");
$tpl->set("main_content",set_block($language["ACP_RECOMMEND_SET"],"center",$admintpl->fetch(load_template("admin.recommend.tpl"))));
break;

case 'user_images':
include("$ADMIN_PATH/admin.user_images.php");
$tpl->set("main_content",set_block($language["ACP_UIMG_SET"],"center",$admintpl->fetch(load_template("admin.user_images.tpl"))));
break;

case 'security_suite':
include("$ADMIN_PATH/admin.security_suite.php");
$tpl->set("main_content",set_block($language["ACP_SECSUI_SET"],"center",$admintpl->fetch(load_template("admin.security_suite.tpl"))));
break;

case 'dbbackup':
include("$ADMIN_PATH/admin_db_backup.php");
$tpl->set("main_content",set_block($language["ACP_BUDB"],"center",$admintpl->fetch(load_template("admin.dbbackup.tpl"))));
break;

case 'backup':
include("$ADMIN_PATH/admin.backup.php");
$tpl->set("main_content",set_block($language["ACP_BUFILES"],"center",$admintpl->fetch(load_template("admin.backup.tpl"))));
break;

case 'watched_users':
include("$ADMIN_PATH/admin.watched_users.php");
$tpl->set("main_content",set_block($language["Watchu"],"center",$admintpl->fetch(load_template("admin.watched_users.tpl"))));
break;

case 'php_log':
include("$ADMIN_PATH/admin.php_errors_log.php");
$tpl->set("main_content",set_block($language["LOGS_PHP"],"center",$admintpl->fetch(load_template("admin.php_errors_log.tpl"))));
break;

case 'balloons':
include("$ADMIN_PATH/admin.balloons.php");
$tpl->set("main_content",set_block($language["ACP_BALL_SET"],"center",$admintpl->fetch(load_template("admin.balloons.tpl"))));
break;

case 'online':
include("$ADMIN_PATH/admin.online.php");
$tpl->set("main_content",set_block($language["ACP_ONLINE_SET"],"center",$admintpl->fetch(load_template("admin.online.tpl"))));
break;

case 'showporn':
include("$ADMIN_PATH/admin.showporn.php");
$tpl->set("main_content",set_block($language["ACP_SHOWPORN_SET"],"center",$admintpl->fetch(load_template("admin.showporn.tpl"))));
break;

case 'admin_agree':
require(load_language("lang_agree.php"));
require("$ADMIN_PATH/admin.agree.php");
$tpl->set("main_content",set_block($language["ACP_USER_SIGNUP_AGREEMENT"],"center",$admintpl->fetch(load_template("admin.agree.tpl"))));
break;

case 'archive':
require("$ADMIN_PATH/admin.archive.php");
$tpl->set("main_content",set_block($language["ACP_ARCHIVE_SET"],"center",$admintpl->fetch(load_template("admin.archive.tpl"))));
break;

case 'fls':
require("$ADMIN_PATH/admin.fls.php");
$tpl->set("main_content",set_block($language["FLS_ACP_ADMIN"],"center",$admintpl->fetch(load_template("admin.fls.tpl"))));
break;

case 'tow':
require("$ADMIN_PATH/admin.torofweek.php");
$tpl->set("main_content",set_block($language["ACP_TOW_SETTINGS"],"center",$admintpl->fetch(load_template("admin.torofweek.tpl"))));
break;

case 'protuser':
require("$ADMIN_PATH/admin.protected_usernames.php");
$tpl->set("main_content",set_block($language["ACP_PROTUSER_SETTINGS"],"center",$admintpl->fetch(load_template("admin.protected_usernames.tpl"))));
break;

case 'intforumpoll':
require("$ADMIN_PATH/admin.integrated_forum_poll.php");
$tpl->set("main_content",set_block($language["ACP_INTFORUMPOLL_SETTINGS"],"center",$admintpl->fetch(load_template("admin.integrated_forum_poll.tpl"))));
break;

case 'toractcou':
require("$ADMIN_PATH/admin.toractcou.php");
$tpl->set("main_content",set_block($language["ACP_TAC_SETTINGS"],"center",$admintpl->fetch(load_template("admin.toractcou.tpl"))));
break;

case 'tvdb':
require("$ADMIN_PATH/admin.tvdb.php");
$tpl->set("main_content",set_block($language["ACP_TVDB_SETTINGS"],"center",$admintpl->fetch(load_template("admin.tvdb.tpl"))));
break;

case 'adv_pruneu':
include("$ADMIN_PATH/admin.adv_prune_users.php");
$tpl->set("main_content",set_block($language["ACP_PRUNE_USERS"],"center",$admintpl->fetch(load_template("admin.adv_prune_users.tpl"))));
break;

case 'adv_prunet':
include("$ADMIN_PATH/admin.adv_prune_torrents.php");
$tpl->set("main_content",set_block($language["ACP_PRUNE_TORRENTS"],"center",$admintpl->fetch(load_template("admin.adv_prune_torrents.tpl"))));
break;

case 'reseed':
include("$ADMIN_PATH/admin.reseed.php");
$tpl->set("main_content",set_block($language["ACP_RESEED_SETTINGS"],"center",$admintpl->fetch(load_template("admin.reseed.tpl"))));
break;

case 'introb4down':
include("$ADMIN_PATH/admin.intro_before_download.php");
$tpl->set("main_content",set_block($language["IBD_SETTINGS"],"center",$admintpl->fetch(load_template("admin.intro_before_download.tpl"))));
break;

case 'specmail':
include("$ADMIN_PATH/admin.specified_email_domains.php");
$tpl->set("main_content",set_block($language["OASED_SETTINGS"],"center",$admintpl->fetch(load_template("admin.specified_email_domains.tpl"))));
break;

case 'nocoldisp':
include("$ADMIN_PATH/admin.no_columns.php");
$tpl->set("main_content",set_block($language["NOCOL_SETTINGS"],"center",$admintpl->fetch(load_template("admin.no_columns.tpl"))));
break;

case 'csignup':
include("$ADMIN_PATH/admin.country_signup.php");
$tpl->set("main_content",set_block($language["CSIGN_SETTINGS"],"center",$admintpl->fetch(load_template("admin.country_signup.tpl"))));
break;

case 'gallery':
include("$ADMIN_PATH/admin.gallery.php");
$tpl->set("main_content",set_block($language["GALLERY_SET"],"center",$admintpl->fetch(load_template("admin.gallery.tpl"))));
break;

case 'smilies':
include("$ADMIN_PATH/admin.smilies.php");
$tpl->set("main_content",set_block($language["SMILE_MENU"],"center",$admintpl->fetch(load_template("admin.smilies.tpl"))));
break;

case 'integrity':
include("$ADMIN_PATH/admin.integrity.php");
$tpl->set("main_content",set_block($language["INTEGRITY_SETUP"],"center",$admintpl->fetch(load_template("admin.integrity.tpl"))));
break;

case 'hide_style':
require(load_language("lang_style_lang.php"));
include("$ADMIN_PATH/admin.hide_style.php");
$tpl->set("main_content",set_block($language["ACP_HIDE_STYLES"],"center",$admintpl->fetch(load_template("admin.hide_style.tpl"))));
break;

case 'hide_language':
require(load_language("lang_style_lang.php"));
include("$ADMIN_PATH/admin.hide_language.php");
$tpl->set("main_content",set_block($language["ACP_HIDE_LANGUAGES"],"center",$admintpl->fetch(load_template("admin.hide_language.tpl"))));
break;

case 'file_hosting':
require(load_language("lang_file_hosting.php"));
include("$ADMIN_PATH/admin.file_hosting.php");
$tpl->set("main_content",set_block($language["ACP_FHOST"],"center",$admintpl->fetch(load_template("admin.file_hosting.tpl"))));
break;

case 'flush':
include("$ADMIN_PATH/admin.flush.php");
break;

               //login log hack
case 'loglog':
include("$ADMIN_PATH/admin.loglog.php");
$tpl->set("main_content",set_block($language["ACP_LOGLOG"],"center",$admintpl->fetch(load_template("admin.loglog.tpl"))));
break;
               //login log hack

               //Medi Seedbox IP's
case 'seedip':    include("$ADMIN_PATH/admin.seedip.php");    $tpl->set("main_content",set_block("Seedbox IPs","center",$admintpl->fetch(load_template("admin.seedip.tpl"))));    break;
               //Medi Seedbox IP's

			   //Featured Torrent
case 'featured':
include("$ADMIN_PATH/admin.featured.php");
$tpl->set("main_content",set_block($language["FEATURED_SETTINGS"],"center",$admintpl->fetch(load_template("admin.featured.tpl"))));
break;
	   			//Featured Torrent

case 'apply_membership':
require(load_language("lang_apply_membership.php"));
include("$ADMIN_PATH/admin.apply_membership.php");
$tpl->set("main_content",set_block($language["ACP_APPLY_MEMBERSHIP_SET"],"center",$admintpl->fetch(load_template("admin.apply_membership.tpl"))));
break;

case 'sanity':
require_once("$THIS_BASEPATH/include/sanity.php");

$now = time();

$res = do_sqlquery("SELECT last_time FROM {$TABLE_PREFIX}tasks WHERE task='sanity'");
$row = $res->fetch_row();
if (!$row)
   quickQuery("INSERT INTO {$TABLE_PREFIX}tasks (task, last_time) VALUES ('sanity',$now)");
else
{
   $ts = $row[0];
   quickQuery("UPDATE {$TABLE_PREFIX}tasks SET last_time=$now WHERE task='sanity' AND last_time = $ts");
}
do_sanity($ts);


default:
include("$ADMIN_PATH/admin.main.php");
$tpl->set("main_content",set_block($language["WELCOME_ADMINCP"],"center",$admintpl->fetch(load_template("admin.main.tpl"))));
break;

}

?>
