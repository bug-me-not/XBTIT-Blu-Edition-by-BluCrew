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
if(!defined("IN_ACP"))
die("non direct access!");

$admintpl->set("add_new", false, true);
$admintpl->set("autorank", (($btit_settings["fmhack_auto_rank"] == "enabled")?true:false), true);
$admintpl->set("autorank2", (($btit_settings["fmhack_auto_rank"] == "enabled")?true:false), true);
$admintpl->set("autorank3", (($btit_settings["fmhack_auto_rank"] == "enabled")?true:false), true);
$admintpl->set("dlratiocheck", (($btit_settings["fmhack_download_ratio_checker"] == "enabled")?true:false), true);
$admintpl->set("dlratiocheck2", (($btit_settings["fmhack_download_ratio_checker"] == "enabled")?true:false), true);
$admintpl->set("dlratiocheck3", (($btit_settings["fmhack_download_ratio_checker"] == "enabled")?true:false), true);
$admintpl->set("torrlim_enabled", (($btit_settings["fmhack_torrents_limit"] == "enabled")?true:false), true);
$admintpl->set("torrlim_enabled2", (($btit_settings["fmhack_torrents_limit"] == "enabled")?true:false), true);
$admintpl->set("torrlim_enabled3", (($btit_settings["fmhack_torrents_limit"] == "enabled")?true:false), true);
$admintpl->set("torr_mod1_enabled", (($btit_settings["fmhack_torrent_moderation"] == "enabled")?true:false), true);
$admintpl->set("torr_mod2_enabled", (($btit_settings["fmhack_torrent_moderation"] == "enabled")?true:false), true);
$admintpl->set("torr_mod3_enabled", (($btit_settings["fmhack_torrent_moderation"] == "enabled")?true:false), true);
$admintpl->set("teams_enabled", (($btit_settings["fmhack_teams"] == "enabled")?true:false), true);
$admintpl->set("teams_enabled2", (($btit_settings["fmhack_teams"] == "enabled")?true:false), true);
$admintpl->set("teams_enabled3", (($btit_settings["fmhack_teams"] == "enabled")?true:false), true);
$admintpl->set("vedsc_enabled_1", (($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"] == "enabled")?true:false), true);
$admintpl->set("vedsc_enabled_2", (($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"] == "enabled")?true:false), true);
$admintpl->set("vedsc_enabled_3", (($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"] == "enabled")?true:false), true);
$admintpl->set("smf_in_use_1", ((substr($FORUMLINK, 0, 3) == "smf")?true:false), true);
$admintpl->set("smf_in_use_2", ((substr($FORUMLINK, 0, 3) == "smf")?true:false), true);
$admintpl->set("smf_in_use_3", ((substr($FORUMLINK, 0, 3) == "smf")?true:false), true);
$admintpl->set("ipb_in_use_1", (($FORUMLINK == "ipb")?true:false), true);
$admintpl->set("ipb_in_use_2", (($FORUMLINK == "ipb")?true:false), true);
$admintpl->set("ipb_in_use_3", (($FORUMLINK == "ipb")?true:false), true);
$admintpl->set("peers_enabled_1", (($btit_settings["fmhack_view_peer_details"] == "enabled")?true:false), true);
$admintpl->set("peers_enabled_2", (($btit_settings["fmhack_view_peer_details"] == "enabled")?true:false), true);
$admintpl->set("peers_enabled_3", (($btit_settings["fmhack_view_peer_details"] == "enabled")?true:false), true);
$admintpl->set("nfo_enabled_1", (($btit_settings["fmhack_NFO_uploader_-_viewer"] == "enabled")?true:false), true);
$admintpl->set("nfo_enabled_2", (($btit_settings["fmhack_NFO_uploader_-_viewer"] == "enabled")?true:false), true);
$admintpl->set("nfo_enabled_3", (($btit_settings["fmhack_NFO_uploader_-_viewer"] == "enabled")?true:false), true);
$admintpl->set("reenc_enabled_1", (($btit_settings["fmhack_offer_to_re-encode"] == "enabled")?true:false), true);
$admintpl->set("reenc_enabled_2", (($btit_settings["fmhack_offer_to_re-encode"] == "enabled")?true:false), true);
$admintpl->set("reenc_enabled_3", (($btit_settings["fmhack_offer_to_re-encode"] == "enabled")?true:false), true);
$admintpl->set("req_enabled_1", (($btit_settings["fmhack_torrent_request_and_vote"] == "enabled")?true:false), true);
$admintpl->set("req_enabled_2", (($btit_settings["fmhack_torrent_request_and_vote"] == "enabled")?true:false), true);
$admintpl->set("req_enabled_3", (($btit_settings["fmhack_torrent_request_and_vote"] == "enabled")?true:false), true);
$admintpl->set("ddl_enabled_1", (($btit_settings["fmhack_direct_download"] == "enabled")?true:false), true);
$admintpl->set("ddl_enabled_2", (($btit_settings["fmhack_direct_download"] == "enabled")?true:false), true);
$admintpl->set("ddl_enabled_3", (($btit_settings["fmhack_direct_download"] == "enabled")?true:false), true);
$admintpl->set("vipfl_enabled_1", (($btit_settings["fmhack_VIP_freeleech"] == "enabled")?true:false), true);
$admintpl->set("vipfl_enabled_2", (($btit_settings["fmhack_VIP_freeleech"] == "enabled")?true:false), true);
$admintpl->set("vipfl_enabled_3", (($btit_settings["fmhack_VIP_freeleech"] == "enabled")?true:false), true);
$admintpl->set("hos_enabled_1", (($btit_settings["fmhack_hide_online_status"] == "enabled")?true:false), true);
$admintpl->set("hos_enabled_2", (($btit_settings["fmhack_hide_online_status"] == "enabled")?true:false), true);
$admintpl->set("hos_enabled_3", (($btit_settings["fmhack_hide_online_status"] == "enabled")?true:false), true);
$admintpl->set("bump_enabled_1", (($btit_settings["fmhack_bump_torrents"] == "enabled")?true:false), true);
$admintpl->set("bump_enabled_2", (($btit_settings["fmhack_bump_torrents"] == "enabled")?true:false), true);
$admintpl->set("bump_enabled_3", (($btit_settings["fmhack_bump_torrents"] == "enabled")?true:false), true);
$admintpl->set("um_enabled_1", (($btit_settings["fmhack_upload_multiplier"] == "enabled")?true:false), true);
$admintpl->set("um_enabled_2", (($btit_settings["fmhack_upload_multiplier"] == "enabled")?true:false), true);
$admintpl->set("um_enabled_3", (($btit_settings["fmhack_upload_multiplier"] == "enabled")?true:false), true);
$admintpl->set("at_enabled_1", (($btit_settings["fmhack_archive_torrents"] == "enabled")?true:false), true);
$admintpl->set("at_enabled_2", (($btit_settings["fmhack_archive_torrents"] == "enabled")?true:false), true);
$admintpl->set("at_enabled_3", (($btit_settings["fmhack_archive_torrents"] == "enabled")?true:false), true);
$admintpl->set("lro_enabled_1", (($btit_settings["fmhack_logical_rank_ordering"] == "enabled")?true:false), true);
$admintpl->set("lro_enabled_2", (($btit_settings["fmhack_logical_rank_ordering"] == "enabled")?true:false), true);
$admintpl->set("lro_enabled_3", (($btit_settings["fmhack_logical_rank_ordering"] == "enabled")?true:false), true);
$admintpl->set("booted_enabled_1", (($btit_settings["fmhack_booted"] == "enabled")?true:false), true);
$admintpl->set("booted_enabled_2", (($btit_settings["fmhack_booted"] == "enabled")?true:false), true);
$admintpl->set("booted_enabled_3", (($btit_settings["fmhack_booted"] == "enabled")?true:false), true);
$admintpl->set("ibd_enabled_1", (($btit_settings["fmhack_download_requires_introduction"] == "enabled")?true:false), true);
$admintpl->set("ibd_enabled_2", (($btit_settings["fmhack_download_requires_introduction"] == "enabled")?true:false), true);
$admintpl->set("ibd_enabled_3", (($btit_settings["fmhack_download_requires_introduction"] == "enabled")?true:false), true);
$admintpl->set("pfet_enabled_1", (($btit_settings["fmhack_permissions_for_external_torrents"] == "enabled")?true:false), true);
$admintpl->set("pfet_enabled_2", (($btit_settings["fmhack_permissions_for_external_torrents"] == "enabled")?true:false), true);
$admintpl->set("pfet_enabled_3", (($btit_settings["fmhack_permissions_for_external_torrents"] == "enabled")?true:false), true);

if($btit_settings["fmhack_teams"] == "enabled")
require_once (load_language("lang_teams.php"));
switch($action)
{
   case 'delete':
   $id = max(0, $_GET["id"]);
   // controle if this level can be cancelled
   $rcanc = do_sqlquery("SELECT can_be_deleted FROM {$TABLE_PREFIX}users_level WHERE id=$id");
   if(!$rcanc || sql_num_rows($rcanc) == 0)
   {
      err_msg($language["ERROR"], $language["ERR_CANT_FIND_GROUP"]);
      stdfoot(false, false, true);
      die;
   }
   $rcancanc = $rcanc->fetch_array();
   if($rcancanc["can_be_deleted"] == "yes")
   {
      quickQuery("DELETE FROM {$TABLE_PREFIX}users_level WHERE id=$id", true);
      success_msg($language["SUCCESS"], $language["GROUP_DELETED"]."<br />\n<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=groups\">".$language["ACP_USER_GROUP"].
      "</a>");
      stdfoot(false, false, true);
      die;
   }
   else
   {
      err_msg($language["ERROR"], $language["CANT_DELETE_GROUP"]);
      stdfoot(false, false, true);
      die;
   }
   break;
   case 'edit':
   $block_title = $language["GROUP_EDIT_GROUP"];
   $gid = max(0, $_GET["id"]);
   $admintpl->set("list", false, true);
   $admintpl->set("frm_action", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=groups&amp;action=save&amp;id=$gid");
   $admintpl->set("language", $language);
   $rgroup = get_result("SELECT * FROM {$TABLE_PREFIX}users_level WHERE id=$gid", true);
   $current_group = $rgroup[0];
   unset($rgroup);
   $current_group["prefixcolor"] = unesc($current_group["prefixcolor"]);
   $current_group["suffixcolor"] = unesc($current_group["suffixcolor"]);
   $current_group["level"] = unesc($current_group["level"]);
   $current_group["view_torrents"] = ($current_group["view_torrents"] == "yes"?"checked=\"checked\"":"");
   $current_group["edit_torrents"] = ($current_group["edit_torrents"] == "yes"?"checked=\"checked\"":"");
   $current_group["delete_torrents"] = ($current_group["delete_torrents"] == "yes"?"checked=\"checked\"":"");
   $current_group["view_users"] = ($current_group["view_users"] == "yes"?"checked=\"checked\"":"");
   $current_group["edit_users"] = ($current_group["edit_users"] == "yes"?"checked=\"checked\"":"");
   $current_group["delete_users"] = ($current_group["delete_users"] == "yes"?"checked=\"checked\"":"");
   $current_group["view_news"] = ($current_group["view_news"] == "yes"?"checked=\"checked\"":"");
   $current_group["edit_news"] = ($current_group["edit_news"] == "yes"?"checked=\"checked\"":"");
   if($btit_settings["fmhack_permissions_for_external_torrents"] == "enabled")
   {
      $current_group["external_upload"] = ($current_group["external_upload"] == "yes"?"checked=\"checked\"":"");
      $current_group["external_refresh"] = ($current_group["external_refresh"] == "yes"?"checked=\"checked\"":"");
   }
   if($btit_settings["fmhack_download_requires_introduction"] == "enabled")
   {
      $current_group["down_req_intro"] = ($current_group["down_req_intro"] == "yes"?"checked=\"checked\"":"");
   }
   if($btit_settings["fmhack_booted"] == "enabled")
   {
      $current_group["can_boot"] = ($current_group["can_boot"] == "yes"?"checked=\"checked\"":"");
   }
   if($btit_settings["fmhack_logical_rank_ordering"] == "enabled")
   {
      $current_group["logical_rank_order"] = unesc($current_group["logical_rank_order"]);
   }
   if($btit_settings["fmhack_archive_torrents"] == "enabled")
   {
      $current_group["view_new"] = ($current_group["view_new"] == "yes"?"checked=\"checked\"":"");
      $current_group["up_new"] = ($current_group["up_new"] == "yes"?"checked=\"checked\"":"");
      $current_group["down_new"] = ($current_group["down_new"] == "yes"?"checked=\"checked\"":"");
      $current_group["view_arc"] = ($current_group["view_arc"] == "yes"?"checked=\"checked\"":"");
      $current_group["up_arc"] = ($current_group["up_arc"] == "yes"?"checked=\"checked\"":"");
      $current_group["down_arc"] = ($current_group["down_arc"] == "yes"?"checked=\"checked\"":"");
   }
   if($btit_settings["fmhack_upload_multiplier"] == "enabled")
   {
      $current_group["set_multi"] = ($current_group["set_multi"] == "yes"?"checked=\"checked\"":"");
      $current_group["view_multi"] = ($current_group["view_multi"] == "yes"?"checked=\"checked\"":"");
   }
   if($btit_settings["fmhack_bump_torrents"] == "enabled")
   {
      $current_group["bump_torrents"] = ($current_group["bump_torrents"] == "yes"?"checked=\"checked\"":"");
   }
   if($btit_settings["fmhack_hide_online_status"] == "enabled")
   {
      $current_group["can_hide"] = ($current_group["can_hide"] == "yes"?"checked=\"checked\"":"");
      $current_group["see_hidden"] = ($current_group["see_hidden"] == "yes"?"checked=\"checked\"":"");
   }
   if($btit_settings["fmhack_VIP_freeleech"] == "enabled")
   {
      $current_group["freeleech"] = ($current_group["freeleech"] == "yes"?"checked=\"checked\"":"");
   }
   if($btit_settings["fmhack_torrent_request_and_vote"] == "enabled")
   {
      $current_group["add_request"] = ($current_group["add_request"] == "yes"?"checked=\"checked\"":"");
   }
   if($btit_settings["fmhack_torrent_moderation"] == "enabled")
   {
      $current_group["trusted"] = ($current_group["trusted"] == "yes"?"checked=\"checked\"":"");
      $current_group["moderate_trusted"] = ($current_group["moderate_trusted"] == "yes"?"checked=\"checked\"":"");
   }
   $current_group["delete_news"] = ($current_group["delete_news"] == "yes"?"checked=\"checked\"":"");
   $current_group["view_forum"] = ($current_group["view_forum"] == "yes"?"checked=\"checked\"":"");
   $current_group["edit_forum"] = ($current_group["edit_forum"] == "yes"?"checked=\"checked\"":"");
   $current_group["delete_forum"] = ($current_group["delete_forum"] == "yes"?"checked=\"checked\"":"");
   if($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"] == "enabled")
   {
      #######################################################
      # view/edit/delete shout, comments
      $current_group["view_shout"] = ($current_group["view_shout"] == "yes"?"checked=\"checked\"":"");
      $current_group["edit_shout"] = ($current_group["edit_shout"] == "yes"?"checked=\"checked\"":"");
      $current_group["delete_shout"] = ($current_group["delete_shout"] == "yes"?"checked=\"checked\"":"");
      $current_group["view_comments"] = ($current_group["view_comments"] == "yes"?"checked=\"checked\"":"");
      $current_group["edit_comments"] = ($current_group["edit_comments"] == "yes"?"checked=\"checked\"":"");
      $current_group["delete_comments"] = ($current_group["delete_comments"] == "yes"?"checked=\"checked\"":"");
      # End
      #######################################################
   }
   $current_group["can_upload"] = ($current_group["can_upload"] == "yes"?"checked=\"checked\"":"");
   $current_group["can_download"] = ($current_group["can_download"] == "yes"?"checked=\"checked\"":"");
   $current_group["admin_access"] = ($current_group["admin_access"] == "yes"?"checked=\"checked\"":"");
   $admintpl->set("autorank3", (($btit_settings["fmhack_auto_rank"] == "enabled")?true:false), true);
   if($btit_settings["fmhack_auto_rank"] == "enabled")
   {
      $artype = "\n<option ".(($current_group["autorank_state"] == "Enabled")?" selected=\"selected\" ":"")." value='Enabled'>Enabled</option>";
      $artype .= "\n<option ".(($current_group["autorank_state"] == "Disabled")?" selected=\"selected\" ":"")." value='Disabled'>Disabled</option>";
      $current_group["autorank_state"] = $artype;
      $current_group["forumlist"] = "";
   }
   if(substr($FORUMLINK, 0, 3) == "smf")
   {
      $current_group["forumlist"] = $language["SMF_LIST"];
      $res = get_result("SELECT ".(($FORUMLINK == "smf")?"`ID_GROUP` `idg`, `groupName` `gn`":"`id_group` `idg`, `group_name` `gn`")." FROM `{$db_prefix}membergroups` ORDER BY `idg` ASC", true, $btit_settings["cache_duration"]);
      if(count($res) > 0)
      {
         foreach($res as $row)
         {
            $current_group["forumlist"] .= $row["gn"]." = ".$row["idg"]."<br />";
         }
      }
      $current_group["smf_group_mirror"] = unesc($current_group["smf_group_mirror"]);
   }
   elseif($FORUMLINK == "ipb")
   {
      $current_group["forumlist"] .= $language["IPB_LIST"];
      $res = do_sqlquery("SELECT * FROM `{$ipb_prefix}forum_perms` ORDER BY `perm_id` ASC", true);
      if(@sql_num_rows($res) > 0)
      {
         while($row = $res->fetch_assoc())
         {
            $current_group["forumlist"] .= $row["perm_name"]." = ".$row["perm_id"]."<br />";
         }
      }
      $current_group["ipb_group_mirror"] = unesc($current_group["ipb_group_mirror"]);
   }
   if($btit_settings["fmhack_download_ratio_checker"] == "enabled")
   {
      $current_group["bypass_dlcheck"] = ($current_group["bypass_dlcheck"] == 1?"checked=\"checked\"":"");
   }
   if($btit_settings["fmhack_teams"] == "enabled")
   {
      $current_group["all_teams"] = ($current_group["all_teams"] == "yes"?"checked=\"checked\"":"");
      $opts['name'] = 'name';
      $opts['id'] = 'id';
      $opts['value'] = 'name';
      if($current_group["sel_team"] == "0")
      $opts['default'] = $curu['team'][0];
      else
      $opts['default'] = $current_group["sel_team"];
      $teams = team_list();
      $current_group["sel_team"] = get_combo($teams, $opts);
   }
   if($btit_settings["fmhack_view_peer_details"] == "enabled")
   {
      $current_group["view_peers"] = ($current_group["view_peers"] == "yes"?"checked=\"checked\"":"");
      $current_group["view_history"] = ($current_group["view_history"] == "yes"?"checked=\"checked\"":"");
      $current_group["view_userdetails_torrents"] = ($current_group["view_userdetails_torrents"] == "yes"?"checked=\"checked\"":"");
   }
   if($btit_settings["fmhack_NFO_uploader_-_viewer"] == "enabled")
   {
      $current_group["view_nfo"] = ($current_group["view_nfo"] == "yes"?"checked=\"checked\"":"");
   }
   if($btit_settings["fmhack_offer_to_re-encode"] == "enabled")
   {
      $current_group["view_reencode"] = ($current_group["view_reencode"] == "yes"?"checked=\"checked\"":"");
   }
   if($btit_settings["fmhack_direct_download"] == "enabled")
   {
      $current_group["add_ddl"] = ($current_group["add_ddl"] == "yes"?"checked=\"checked\"":"");
      $current_group["view_ddl"] = ($current_group["view_ddl"] == "yes"?"checked=\"checked\"":"");
   }
   $admintpl->set("group", $current_group);
   break;
   case 'add':
   $admintpl->set("add_new", true, true);
   $block_title = $language["GROUP_ADD_NEW"];
   $admintpl->set("list", false, true);
   $admintpl->set("frm_action", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=groups&amp;action=save&amp;mode=new");
   $admintpl->set("language", $language);
   $frm_dropdown = "\n<select name=\"base_group\" size=\"1\">";
   $rlevel = do_sqlquery("SELECT DISTINCT id_level,predef_level FROM {$TABLE_PREFIX}users_level ORDER BY id_level", true);
   while($level = $rlevel->fetch_array())
   $frm_dropdown .= "\n<option value=\"".$level["id_level"]."\">".$level["predef_level"]."</option>";
   $frm_dropdown .= "\n</select>";
   $admintpl->set("groups_combo", $frm_dropdown);
   break;
   case 'save':
   if($_POST["write"] == $language["FRM_CONFIRM"])
   {
      if(isset($_GET["mode"]) && $_GET["mode"] == "new")
      {
         $gid = max(0, $_POST["base_group"]);
         $gname = sqlesc($_POST["gname"]);
         $rfields = get_result("SELECT * FROM {$TABLE_PREFIX}users_level WHERE id=$gid", true);
         // we have unique record, set the first and unique to our array
         $rfields = $rfields[0];
         if($btit_settings["fmhack_auto_rank"] == "enabled")
         {
            unset($rfields["autorank_state"]);
            unset($rfields["autorank_position"]);
            unset($rfields["autorank_min_upload"]);
            unset($rfields["autorank_minratio"]);
         }
         foreach($rfields as $key => $value)
         if($key != "id" && $key != "level" && $key != "can_be_deleted")
         $fields[] = $key;
         quickQuery("INSERT INTO {$TABLE_PREFIX}users_level (can_be_deleted,level,".implode(",", $fields).") SELECT 'yes',$gname,".implode(",", $fields)." FROM {$TABLE_PREFIX}users_level WHERE id=$gid", true);
         unset($fields);
         unset($rfields);
      }
      else
      {
         $gid = max(0, $_GET["id"]);
         $update = array();
         $update[] = "level=".sqlesc($_POST["gname"]);
         $update[] = "view_torrents=".sqlesc(isset($_POST["vtorrents"])?"yes":"no");
         $update[] = "edit_torrents=".sqlesc(isset($_POST["etorrents"])?"yes":"no");
         $update[] = "delete_torrents=".sqlesc(isset($_POST["dtorrents"])?"yes":"no");
         $update[] = "view_users=".sqlesc(isset($_POST["vusers"])?"yes":"no");
         $update[] = "edit_users=".sqlesc(isset($_POST["eusers"])?"yes":"no");
         $update[] = "delete_users=".sqlesc(isset($_POST["dusers"])?"yes":"no");
         $update[] = "view_news=".sqlesc(isset($_POST["vnews"])?"yes":"no");
         $update[] = "edit_news=".sqlesc(isset($_POST["enews"])?"yes":"no");
         $update[] = "delete_news=".sqlesc(isset($_POST["dnews"])?"yes":"no");
         $update[] = "view_forum=".sqlesc(isset($_POST["vforum"])?"yes":"no");
         $update[] = "edit_forum=".sqlesc(isset($_POST["eforum"])?"yes":"no");
         $update[] = "delete_forum=".sqlesc(isset($_POST["dforum"])?"yes":"no");
         if($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"] == "enabled")
         {
            #######################################################
            # view/edit/delete shout, comments
            $update[] = "view_shout=".sqlesc(isset($_POST["vshout"])?"yes":"no");
            $update[] = "edit_shout=".sqlesc(isset($_POST["eshout"])?"yes":"no");
            $update[] = "delete_shout=".sqlesc(isset($_POST["dshout"])?"yes":"no");
            $update[] = "view_comments=".sqlesc(isset($_POST["vcomments"])?"yes":"no");
            $update[] = "edit_comments=".sqlesc(isset($_POST["ecomments"])?"yes":"no");
            $update[] = "delete_comments=".sqlesc(isset($_POST["dcomments"])?"yes":"no");
            # End
            #######################################################
         }
         if($btit_settings["fmhack_permissions_for_external_torrents"] == "enabled")
         {
            $update[] = "external_upload=".sqlesc(isset($_POST["external_upload"])?"yes":"no");
            $update[] = "external_refresh=".sqlesc(isset($_POST["external_refresh"])?"yes":"no");
         }
         if($btit_settings["fmhack_download_requires_introduction"] == "enabled")
         {
            $update[] = "down_req_intro=".sqlesc(isset($_POST["down_req_intro"])?"yes":"no");
         }
         if($btit_settings["fmhack_booted"] == "enabled")
         {
            $update[] = "can_boot=".sqlesc(isset($_POST["can_boot"])?"yes":"no");
         }
         if($btit_settings["fmhack_logical_rank_ordering"] == "enabled")
         {
            $update[] = "logical_rank_order=".((int)0+$_POST["logical_rank_order"]);
         }
         if($btit_settings["fmhack_archive_torrents"] == "enabled")
         {
            $update[] = "view_new=".sqlesc(isset($_POST["view_new"])?"yes":"no");
            $update[] = "up_new=".sqlesc(isset($_POST["up_new"])?"yes":"no");
            $update[] = "down_new=".sqlesc(isset($_POST["down_new"])?"yes":"no");
            $update[] = "view_arc=".sqlesc(isset($_POST["view_arc"])?"yes":"no");
            $update[] = "up_arc=".sqlesc(isset($_POST["up_arc"])?"yes":"no");
            $update[] = "down_arc=".sqlesc(isset($_POST["down_arc"])?"yes":"no");
         }
         if($btit_settings["fmhack_upload_multiplier"] == "enabled")
         {
            $update[] = "set_multi=".sqlesc(isset($_POST["set_multi"])?"yes":"no");
            $update[] = "view_multi=".sqlesc(isset($_POST["view_multi"])?"yes":"no");
         }
         if($btit_settings["fmhack_bump_torrents"] == "enabled")
         {
            $update[] = "bump_torrents=".sqlesc(isset($_POST["bump_torrents"])?"yes":"no");
         }
         if($btit_settings["fmhack_hide_online_status"] == "enabled")
         {
            $update[] = "can_hide=".sqlesc(isset($_POST["can_hide"])?"yes":"no");
            $update[] = "see_hidden=".sqlesc(isset($_POST["see_hidden"])?"yes":"no");
         }
         if($btit_settings["fmhack_VIP_freeleech"] == "enabled")
         {
            $update[] = "freeleech=".sqlesc(isset($_POST["freeleech"])?"yes":"no");
         }
         if($btit_settings["fmhack_torrent_request_and_vote"] == "enabled")
         {
            $update[] = "add_request=".sqlesc(isset($_POST["add_request"])?"yes":"no");
         }
         if($btit_settings["fmhack_torrent_moderation"] == "enabled")
         {
            $update[] = "trusted=".sqlesc(isset($_POST["trusted"])?"yes":"no");
            $update[] = "moderate_trusted=".sqlesc(isset($_POST["moderate_trusted"])?"yes":"no");
         }
         $update[] = "can_upload=".sqlesc(isset($_POST["upload"])?"yes":"no");
         $update[] = "can_download=".sqlesc(isset($_POST["down"])?"yes":"no");
         $update[] = "admin_access=".sqlesc(isset($_POST["admincp"])?"yes":"no");
         $update[] = "WT=".sqlesc($_POST["waiting"]);
         $update[] = "prefixcolor=".sqlesc($_POST["pcolor"]);
         $update[] = "suffixcolor=".sqlesc($_POST["scolor"]);
         if($btit_settings["fmhack_auto_rank"] == "enabled")
         {
            $update[] = "autorank_state=".sqlesc($_POST["arstate"]);
            $update[] = "autorank_position=".((isset($_POST["arpos"]) && is_numeric($_POST["arpos"]))?$_POST["arpos"]:0);
            $update[] = "autorank_min_upload=".((isset($_POST["arminup"]) && is_numeric($_POST["arminup"]))?$_POST["arminup"]:0);
            $update[] = "autorank_minratio=".((isset($_POST["arminratio"]) && is_numeric($_POST["arminratio"]))?$_POST["arminratio"]:"0.00");
         }
         if($btit_settings["fmhack_download_ratio_checker"] == "enabled")
         {
            $update[] = "bypass_dlcheck=".(isset($_POST["bypass_dlcheck"])?1:0);
         }
         if($btit_settings["fmhack_torrents_limit"] == "enabled")
         {
            $update[] = "torrents_limit=".((isset($_POST["torrents_limit"]) && is_numeric($_POST["torrents_limit"]) && $_POST["torrents_limit"] > 0)?(int)0 + $_POST["torrents_limit"]:0);
         }
         if($btit_settings["fmhack_teams"] == "enabled")
         {
            $update[] = "all_teams=".sqlesc(isset($_POST["all_teams"])?"yes":"no");
            $update[] = "sel_team=".sqlesc(((isset($_POST["sel_team"]) && is_numeric($_POST["sel_team"]) && !isset($_POST["all_teams"]))?(int)0 + $_POST["sel_team"]:0));
         }
         if($btit_settings["fmhack_view_peer_details"] == "enabled")
         {
            $update[] = "view_peers=".sqlesc(isset($_POST["view_peers"])?"yes":"no");
            $update[] = "view_history=".sqlesc(isset($_POST["view_history"])?"yes":"no");
            $update[] = "view_userdetails_torrents=".sqlesc(isset($_POST["view_userdetails_torrents"])?"yes":"no");
         }
         if($btit_settings["fmhack_NFO_uploader_-_viewer"] == "enabled")
         {
            $update[] = "view_nfo=".sqlesc(isset($_POST["view_nfo"])?"yes":"no");
         }
         if($btit_settings["fmhack_offer_to_re-encode"] == "enabled")
         {
            $update[] = "view_reencode=".sqlesc(isset($_POST["view_reencode"])?"yes":"no");
         }
         if(substr($FORUMLINK, 0, 3) == "smf")
         $update[] = "smf_group_mirror=".((int)0 + $_POST["smf_group_mirror"]);
         elseif($FORUMLINK == "ipb")
         $update[] = "ipb_group_mirror=".((int)0 + $_POST["ipb_group_mirror"]);
         if($btit_settings["fmhack_direct_download"] == "enabled")
         {
            $update[] = "add_ddl=".sqlesc(isset($_POST["add_ddl"])?"yes":"no");
            $update[] = "view_ddl=".sqlesc(isset($_POST["view_ddl"])?"yes":"no");
         }
         $strupdate = implode(",", $update);
         quickQuery("UPDATE {$TABLE_PREFIX}users_level SET $strupdate WHERE id=$gid", true);
         if($btit_settings["fmhack_VIP_freeleech"] == "enabled")
         {
            if($_POST["freeleech"] == "on")
            quickQuery("UPDATE `{$TABLE_PREFIX}users` `u`".(($XBTT_USE)?" LEFT JOIN `xbt_users` `x` ON `u`.`id`=`x`.`uid`":"")." SET `u`.`vipfl_down`=".(($XBTT_USE)?"`x`":"`u`").
            ".`downloaded`, `u`.`vipfl_date`=UNIX_TIMESTAMP() WHERE `id_level`=".$gid." AND `u`.`vipfl_down`!=".(($XBTT_USE)?"`x`":"`u`").".`downloaded`", true);
            else
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `vipfl_down`=0, `vipfl_date`=0 WHERE `id_level`=".$gid, true);
         }
         if($btit_settings["fmhack_torrents_limit"] == "enabled" && $XBTT_USE)
         {
            if($gid == 3)
            do_sqlquery("ALTER TABLE `xbt_users` CHANGE `torrents_limit` `torrents_limit` INT( 11 ) NOT NULL DEFAULT '".((isset($_POST["torrents_limit"]) && is_numeric($_POST["torrents_limit"]) && $_POST["torrents_limit"] >
            0)?$_POST["torrents_limit"]:0)."'");
            $userlist = "";
            $res = get_result("SELECT `id` FROM `{$TABLE_PREFIX}users` where `id_level`=".$gid." AND `custom_torr_limit`='no' ORDER BY `id` ASC", true, $btit_settings["cache_duration"]);
            if(count($res) > 0)
            {
               foreach($res as $row)
               {
                  $userlist .= $row["id"].",";
               }
               $userlist = trim($userlist, ",");
               quickQuery("UPDATE `xbt_users` SET `torrents_limit`=".((isset($_POST["torrents_limit"]) && is_numeric($_POST["torrents_limit"]) && $_POST["torrents_limit"] > 0)?$_POST["torrents_limit"]:0).
               " WHERE `uid` IN(".$userlist.")", true);
            }
         }
         if($btit_settings["fmhack_enhanced_wait_time"] == "enabled" && $XBTT_USE)
         {
            if($gid == 3)
            do_sqlquery("ALTER TABLE `xbt_users` CHANGE `wait_time` `wait_time` INT( 11 ) NOT NULL DEFAULT '".((isset($_POST["waiting"]) && is_numeric($_POST["waiting"]) && $_POST["waiting"] > 0)?($_POST["waiting"] *
            3600):0)."'");
            $userlist = "";
            $res = get_result("SELECT `id` FROM `{$TABLE_PREFIX}users` where `id_level`=".$gid." AND `custom_wait_time`='no' ORDER BY `id` ASC", true);
            if(count($res) > 0)
            {
               foreach($res as $row)
               {
                  $userlist .= $row["id"].",";
               }
               $userlist = trim($userlist, ",");
               quickQuery("UPDATE `xbt_users` SET `wait_time`=".((isset($_POST["waiting"]) && is_numeric($_POST["waiting"]) && $_POST["waiting"] > 0)?($_POST["waiting"] * 3600):0)." WHERE `uid` IN(".$userlist.")", true);
            }
         }
         unset($update);
         unset($strupdate);
      }
   }
   // we don't break, so now we read ;)
   case '':
   case 'read':
   default:
   $block_title = $language["USER_GROUPS"];
   $admintpl->set("list", true, true);
   $admintpl->set("group_add_new", "<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=groups&amp;action=add\">".$language["INSERT_USER_GROUP"]."</a>");
   $admintpl->set("language", $language);
   $rlevel = do_sqlquery("SELECT * from {$TABLE_PREFIX}users_level ORDER BY ".(($btit_settings["fmhack_logical_rank_ordering"] == "enabled")?"`logical_rank_order`":"`id_level`")." ASC", true);
   $groups = array();
   $i = 0;
   while($level = $rlevel->fetch_array())
   {
      $groups[$i]["user"] = "<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=groups&amp;action=edit&amp;id=".$level["id"]."\">".unesc($level["prefixcolor"]).
      unesc($level["level"]).unesc($level["suffixcolor"])."</a>";
      $groups[$i]["torrent_aut"] = $level["view_torrents"]."/".$level["edit_torrents"]."/".$level["delete_torrents"];
      $groups[$i]["users_aut"] = $level["view_users"]."/".$level["edit_users"]."/".$level["delete_users"];
      $groups[$i]["news_aut"] = $level["view_news"]."/".$level["edit_news"]."/".$level["delete_news"];
      $groups[$i]["forum_aut"] = $level["view_forum"]."/".$level["edit_forum"]."/".$level["delete_forum"];
      if($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"] == "enabled")
      {
         #######################################################
         # view/edit/delete shout, comments
         $groups[$i]["shout_aut"] = $level["view_shout"]."/".$level["edit_shout"]."/".$level["delete_shout"];
         $groups[$i]["comments_aut"] = $level["view_comments"]."/".$level["edit_comments"]."/".$level["delete_comments"];
         # End
         #######################################################
      }
      $groups[$i]["can_upload"] = $level["can_upload"];
      $groups[$i]["can_download"] = $level["can_download"];
      if($btit_settings["fmhack_permissions_for_external_torrents"] == "enabled")
      {
         $groups[$i]["external_upload"] = $level["external_upload"];
         $groups[$i]["external_refresh"] = $level["external_refresh"];
      }
      if($btit_settings["fmhack_download_requires_introduction"] == "enabled")
      {
         $groups[$i]["down_req_intro"] = $level["down_req_intro"];
      }
      if($btit_settings["fmhack_booted"] == "enabled")
      {
         $groups[$i]["can_boot"] = $level["can_boot"];
      }
      if($btit_settings["fmhack_logical_rank_ordering"] == "enabled")
      {
         $groups[$i]["logical_rank_order"] = $level["logical_rank_order"];
      }
      if($btit_settings["fmhack_archive_torrents"] == "enabled")
      {
         $groups[$i]["view_new"] = $level["view_new"];
         $groups[$i]["up_new"] = $level["up_new"];
         $groups[$i]["down_new"] = $level["down_new"];
         $groups[$i]["view_arc"] = $level["view_arc"];
         $groups[$i]["up_arc"] = $level["up_arc"];
         $groups[$i]["down_arc"] = $level["down_arc"];
      }
      if($btit_settings["fmhack_upload_multiplier"] == "enabled")
      {
         $groups[$i]["set_multi"] = $level["set_multi"];
         $groups[$i]["view_multi"] = $level["view_multi"];
      }
      if($btit_settings["fmhack_bump_torrents"] == "enabled")
      {
         $groups[$i]["bump_torrents"] = $level["bump_torrents"];
      }
      if($btit_settings["fmhack_hide_online_status"] == "enabled")
      {
         $groups[$i]["can_hide"] = $level["can_hide"];
         $groups[$i]["see_hidden"] = $level["see_hidden"];
      }
      if($btit_settings["fmhack_VIP_freeleech"] == "enabled")
      {
         $groups[$i]["freeleech"] = $level["freeleech"];
      }
      if($btit_settings["fmhack_torrent_request_and_vote"] == "enabled")
      {
         $groups[$i]["add_request"] = $level["add_request"];
      }
      if($btit_settings["fmhack_torrent_moderation"] == "enabled")
      {
         $groups[$i]["trusted"] = $level["trusted"];
         $groups[$i]["moderate_trusted"] = $level["moderate_trusted"];
      }
      $groups[$i]["admin_access"] = $level["admin_access"];
      $groups[$i]["WT"] = $level["WT"];
      $groups[$i]["delete"] = ($level["can_be_deleted"] == "no"?"No":"<a onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\" href=\"index.php?page=admin&amp;user=".$CURUSER["uid"].
      "&amp;code=".$CURUSER["random"]."&amp;do=groups&amp;action=delete&amp;id=".$level["id"]."\">".image_or_link("$STYLEPATH/images/delete.png", "", $language["DELETE"])."</a>");
      if($btit_settings["fmhack_auto_rank"] == "enabled")
      {
         $groups[$i]["arpos"] = (($level["autorank_state"] == "Disabled")?$language["NA"]:$level["autorank_position"]);
         $groups[$i]["arstate"] = $level["autorank_state"];
         $groups[$i]["arupdowntrig"] = (($level["autorank_state"] == "Disabled")?$language["NA"]:makesize($level["autorank_min_upload"]));
         $groups[$i]["arratiotrig"] = (($level["autorank_state"] == "Disabled")?$language["NA"]:$level["autorank_minratio"]);
      }
      if($btit_settings["fmhack_download_ratio_checker"] == "enabled")
      {
         $groups[$i]["bypass_dlcheck"] = (($level["bypass_dlcheck"] == 1)?"yes":"no");
      }
      if($btit_settings["fmhack_torrents_limit"] == "enabled")
      {
         $groups[$i]["torrents_limit"] = $level["torrents_limit"];
      }
      if($btit_settings["fmhack_teams"] == "enabled")
      {
         $groups[$i]["sel_team"] = $level["sel_team"];
         $groups[$i]["all_teams"] = $level["all_teams"];
      }
      if($btit_settings["fmhack_view_peer_details"] == "enabled")
      {
         $groups[$i]["view_peers"] = $level["view_peers"];
         $groups[$i]["view_history"] = $level["view_history"];
         $groups[$i]["view_userdetails_torrents"] = $level["view_userdetails_torrents"];
      }
      if($btit_settings["fmhack_NFO_uploader_-_viewer"] == "enabled")
      {
         $groups[$i]["view_nfo"] = $level["view_nfo"];
      }
      if($btit_settings["fmhack_offer_to_re-encode"] == "enabled")
      {
         $groups[$i]["view_reencode"] = $level["view_reencode"];
      }
      if(substr($FORUMLINK, 0, 3) == "smf")
      $groups[$i]["smf_group_mirror"] = $level["smf_group_mirror"];
      elseif($FORUMLINK == "ipb")
      $groups[$i]["ipb_group_mirror"] = $level["ipb_group_mirror"];
      if($btit_settings["fmhack_direct_download"] == "enabled")
      {
         $groups[$i]["add_ddl"] = $level["add_ddl"];
         $groups[$i]["view_ddl"] = $level["view_ddl"];
      }
      $i++;
   }
   unset($level);
   $rlevel->free();
   $admintpl->set("groups", $groups);
}
?>
