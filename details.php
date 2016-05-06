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


if(!isset($id) || empty($id))
   $id=strtolower(preg_replace("/[^A-Fa-f0-9]/", "", $_GET["id"]));
(isset($_GET["torrent_id"]) && !empty($_GET["torrent_id"]) && is_numeric($_GET["torrent_id"]) && $_GET["torrent_id"]>=1) ? $torrent_id=(int)0+$_GET["torrent_id"] : $torrent_id=false;

if ($id===false && $torrent_id===false)
   stderr($language["ERROR"],$language["ERROR_ID"],$GLOBALS["usepopup"]);

if($btit_settings["fmhack_archive_torrents"]=="enabled")
{
   if($CURUSER["view_new"]=="no" && $CURUSER["view_arc"]=="no")
      stderr($language["ERROR"],$language["ARC_ERR_NO_BOTH"]);
}

if($btit_settings["fmhack_torrent_view_count"]=="enabled")
{
   session_name("Blu-torrents");
   session_start();

   if(!isset($_SESSION["torrent_count"][$id]))
   {
      quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `viewcount`=`viewcount`+1 WHERE `info_hash`='".$id."'", true);
      $_SESSION["torrent_count"][$id]=true;
   }
}

require_once(load_language("lang_torrents.php"));

if (isset($_GET["act"]) && $_GET["act"]=="update")
{
   if($btit_settings["fmhack_multi_tracker_scrape"]=="enabled")
      require_once(dirname(__FILE__)."/include/getscrape_multiscrape.php");
   else
      require_once(dirname(__FILE__)."/include/getscrape.php");

   if($btit_settings["fmhack_multi_tracker_scrape"]=="enabled")
   {
      $torrent=get_result("SELECT `announces` FROM `{$TABLE_PREFIX}files` WHERE `info_hash`='".sql_esc($id)."'", true, $btit_settings["cache_duration"]);
      $urls=@unserialize($torrent[0]["announces"])?unserialize($torrent[0]["announces"]):array();
      $keys=array_keys($urls);
      $random=mt_rand(0, count($urls)-1);
      $url=$keys[$random];
      scrape($url, $id);
   }
   else
      scrape(urldecode($_GET["surl"]),$id);

   redirect((($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?strtr($_GET["name"], $res_seo["str"], $res_seo["strto"])."-".$torrent_id.".html":"index.php?page=torrent-details&id=".$id));
   exit();
}

if($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"]=="enabled")
{
   #######################################################
   # view/edit/delete shout, comments

   # mass deleting comments
   if (isset($_POST["delcomment"]))
   {
      if ($CURUSER["delete_comments"]=="yes")
      {
         $multidel=$_POST["delcomment"];
         foreach($multidel as $key => $value)
         {
            if(!is_numeric($value))
               unset($_POST["delcomment"][$key]);
         }
         if(!empty($_POST["delcomment"]))
            quickQuery("DELETE FROM {$TABLE_PREFIX}comments WHERE id IN (" . implode(", ", $_POST["delcomment"]) . ")");
      }
   }
   # End
   #######################################################
}
if (isset($_GET["vote"]) && $_GET["vote"]==$language["VOTE"])
{
   if (isset($_GET["rating"]) && $_GET["rating"]==0)
   {
      err_msg($language["ERROR"],$language["ERR_NO_VOTE"],$GLOBALS["usepopup"]);
      stdfoot(($GLOBALS["usepopup"]?false:true),false);
      exit();
   }
   else {
      quickQuery("INSERT INTO {$TABLE_PREFIX}ratings SET infohash='$id',userid=".$CURUSER["uid"].",rating=".intval($_GET["rating"]).",added='".time()."'",true);
      redirect((($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?strtr($_GET["name"], $res_seo["str"], $res_seo["strto"])."-".$torrent_id.".html":"index.php?page=torrent-details&id=".$id));
      exit();
   }
   exit();
}

if ($XBTT_USE)
{
   if($btit_settings["fmhack_similar_torrents"]=="enabled")
      $tdt= "`f`.`seeds`+ifnull(`x`.`seeders`,0)";
   $tseeds="`f`.`seeds`+ifnull(`x`.`seeders`,0) `seeds`";
   $tleechs="`f`.`leechers`+ifnull(`x`.`leechers`,0) `leechers`";
   $tcompletes="`f`.`finished`+ifnull(`x`.`completed`,0) `finished`";
   $ttables="`{$TABLE_PREFIX}files` `f` LEFT JOIN `xbt_files` `x` ON `x`.`info_hash`=`f`.`bin_hash`";
}
else
{
   if($btit_settings["fmhack_similar_torrents"]=="enabled")
      $tdt= "`f`.`seeds`";
   $tseeds="`f`.`seeds`";
   $tleechs="`f`.`leechers`";
   $tcompletes="`f`.`finished`";
   $ttables="`{$TABLE_PREFIX}files` `f`";
}


if(!$CURUSER || $CURUSER["view_torrents"]!="yes")
{
   err_msg($language["ERROR"],$language["NOT_AUTHORIZED"]." ".$language["MNU_TORRENT"]."!<br />\n".$language["SORRY"]."...");
   stdfoot();
   exit();
}

$query1_select="";
$query1_join="";
if($btit_settings["fmhack_simple_donor_display"]=="enabled")
   $query1_select.="`u`.`donor`,";
if($btit_settings["fmhack_torrent_image_upload"]=="enabled")
   $query1_select.="`f`.`screen1`, `f`.`screen2`, `f`.`screen3`, `f`.`image`,";
if($btit_settings["fmhack_warning_system"]=="enabled")
   $query1_select.="`u`.`warn`,";
if($btit_settings["fmhack_ask_for_reseed"]=="enabled")
   $query1_select.="`f`.`reseed`,";
if($btit_settings["fmhack_group_colours_overall"]=="enabled")
{
   $query1_select.="`ul`.`prefixcolor`, `ul`.`suffixcolor`,";
   $query1_join.="LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` ";
}
if($btit_settings["fmhack_getIMDB_in_torrent_details"]=="enabled")
{
   $query1_select.="`f`.`imdb`,";
}
if($btit_settings["fmhack_torrent_nuked_and_requested"]=="enabled")
   $query1_select.="`f`.`requested`, `f`.`nuked`, `f`.`nuke_reason`,";
if($btit_settings["fmhack_teams"]=="enabled")
{
   $query1_select.="`t`.`name` `teamname`, `t`.`id` `teamsid`, `t`.`image` `teamimage`, `f`.`team`,";
   $query1_join.="LEFT JOIN `{$TABLE_PREFIX}teams` `t` ON `f`.`team` = `t`.`id` ";
}
if($btit_settings["fmhack_upload_multiplier"]=="enabled")
   $query1_select.="`f`.`multiplier`,";
if($btit_settings["fmhack_forum_auto_topic"]=="enabled" && $btit_settings["smf_autotopic"]=="true")
   $query1_select.="`f`.`topicid`,";
if($btit_settings["fmhack_offer_to_re-encode"]=="enabled")
   $query1_select.="`c`.`reencode`,";
if($btit_settings["fmhack_staff_comment_in_torrent_details"]=="enabled")
   $query1_select.=" `f`.`staff_comment`,";
if($btit_settings["fmhack_direct_download"]=="enabled" && $CURUSER["view_ddl"]=="yes")
   $query1_select.=" `f`.`direct_download`,";
if($btit_settings["fmhack_multi_tracker_scrape"]=="enabled")
   $query1_select.=" `f`.`announces`,";
if($btit_settings["fmhack_language_in_torrent_list_and_details"]=="enabled")
   $query1_select.=" `f`.`language`,";
if($btit_settings["fmhack_torrent_details_media_player"]=="enabled")
   $query1_select.=" `f`.`mplayer`,";
if($btit_settings["fmhack_torrent_view_count"]=="enabled")
   $query1_select.=" `f`.`viewcount`,";
if($btit_settings["fmhack_archive_torrents"]=="enabled")
   $query1_select.=" `f`.`archive`,";
if($btit_settings["fmhack_grab_images_from_theTVDB"] == "enabled")
   $query1_select.="`f`.`tvdb_id`, `f`.`tvdb_extra`,";
if($btit_settings["fmhack_magnet_links"] == "enabled")
   $query1_select.="`f`.`magnet`,";
$res = get_result("SELECT ".$query1_select." `f`.`info_hash`, `f`.`filename`, `f`.`url`, UNIX_TIMESTAMP(`f`.`data`) `data`, `f`.`size`, `f`.`comment`, `f`.`uploader`,`f`.`category`, `c`.`name` `cat_name`, $tseeds, $tleechs, $tcompletes, `f`.`speed`, `f`.`external`, `f`.`announce_url`, UNIX_TIMESTAMP(`f`.`lastupdate`) `lastupdate`, UNIX_TIMESTAMP(`f`.`lastsuccess`) `lastsuccess`, `f`.`anonymous`, `u`.`username` FROM $ttables LEFT JOIN `{$TABLE_PREFIX}categories` `c` ON `c`.`id`=`f`.`category` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `u`.`id`=`f`.`uploader` ".$query1_join." WHERE ".((isset($id) && !empty($id))?"`f`.`info_hash`='".sql_esc($id)."'":((isset($torrent_id) && !empty($torrent_id))?"`f`.`id`='".$torrent_id."'":"")),true, $btit_settings['cache_duration']);

if (count($res)<1)
   stderr($language["ERROR"],"Bad ID!",$GLOBALS["usepopup"]);
$row=$res[0];

$download_locked=false;
if($btit_settings["fmhack_archive_torrents"]=="enabled")
{
   if($row["archive"]==0 && $CURUSER["view_new"]=="no")
      stderr($language["ERROR"],$language["ARC_ERR_NO_NEW"]);
   elseif($row["archive"]==1 && $CURUSER["view_arc"]=="no")
      stderr($language["ERROR"], $language["ARC_ERR_NO_ARC"]);
   if($row["archive"]==0 && $CURUSER["down_new"]=="no")
      $download_locked=true;
   elseif($row["archive"]==1 && $CURUSER["down_arc"]=="no")
      $download_locked=true;
}

if($btit_settings["fmhack_torrent_moderation"]=="enabled")
   $res_m = getmoderstatusbyhash($id);

if($btit_settings["fmhack_teams"]=="enabled")
{
   if($row["team"]!=0)
   {
      $allowed="no";
      if($CURUSER["team"]==$row["team"] || $CURUSER["all_teams"]=="yes" || $CURUSER['sel_team']==$row["team"] || $btit_settings["team_state"]=="public")
         $allowed="yes";
      if($allowed=="no")
         stderr($language["ERROR"],$language["TEAM_ERROR"],$GLOBALS["usepopup"]);
   }
}

$spacer = "&nbsp;&nbsp;";

$torrenttpl=new bTemplate();
// show all uploads per user
$dt = do_sqlquery("SELECT filename,info_hash FROM {$TABLE_PREFIX}files WHERE uploader =".$row["uploader"]." ORDER BY data DESC");

$upl=array();
$i=0;

if (!$dt || sql_num_rows($dt)==0)
{
//
}
else
{
   while ($dts = $dt->fetch_array())
   {
    $upl[$i]["filename"]="<a href=index.php?page=torrent-details&id=".$dts["info_hash"].">".$dts["filename"]."</a>&nbsp;<font color = red><b>--</b></font>";
    $i++;
 }
}
$torrenttpl->set("upl",$upl);
// show all uploads per user end
$torrenttpl->set("need_intro", false, true);
if($btit_settings["fmhack_download_requires_introduction"] == "enabled")
{
   if($CURUSER["down_req_intro"]=="yes" && $CURUSER["made_intro"]==0)
   {
      $download_locked=true;
      $currentTopic=(($btit_settings["ibd_forumid"]>0 && $btit_settings["ibd_topicid"]>0)?true:false);
      $torrenttpl->set("need_intro", true, true);
      $torrenttpl->set("newThread", !$currentTopic, true);
      if($btit_settings["fmhack_integrated_forum_display"]=="enabled")
      {
         if(substr($FORUMLINK, 0,3)=="smf")
            $introForumLink="<a".(($btit_settings["forum_viewtype"]!="iframe")?" href='".$BASEURL."/smf/index.php?".(($currentTopic)?"topic=".$btit_settings["ibd_topicid"]:"board=".$btit_settings["ibd_forumid"])."' target='".$btit_settings["forum_viewtype"]."'":" href='index.php?page=forum&action=".(($currentTopic)?"viewtopic&topicid=".$btit_settings["ibd_topicid"]:"board&boardid=".$btit_settings["ibd_forumid"])."'").">";
         elseif($FORUMLINK=="ipb")
            $introForumLink="<a".(($btit_settings["forum_viewtype"]!="iframe")?" href='".$BASEURL."/ipb/index.php?show".(($currentTopic)?"topic=".$btit_settings["ibd_topicid"]:"forum=".$btit_settings["ibd_forumid"])."' target='".$btit_settings["forum_viewtype"]."'":" href='index.php?page=forum&action=".(($currentTopic)?"viewtopic&topicid=".$btit_settings["ibd_topicid"]:"showforum&boardid=".$btit_settings["ibd_forumid"])."'").">";
         else
            $introForumLink="<a href='index.php?page=forum&action=view".(($currentTopic)?"topic&topicid=".$btit_settings["ibd_topicid"]:"forum&forumid=".$btit_settings["ibd_forumid"])."'>";
      }
      else
      {
         if(substr($FORUMLINK, 0,3)=="smf")
            $introForumLink="<a href='index.php?page=forum&action=".(($currentTopic)?"viewtopic&topicid=".$btit_settings["ibd_topicid"]:"board&boardid=".$btit_settings["ibd_forumid"])."'>";
         elseif($FORUMLINK=="ipb")
            $introForumLink="<a href='index.php?page=forum&action=".(($currentTopic)?"viewtopic&topicid=".$btit_settings["ibd_topicid"]:"showforum&boardid=".$btit_settings["ibd_forumid"])."'>";
         else
            $introForumLink="<a href='index.php?page=forum&action=view".(($currentTopic)?"topic&topicid=".$btit_settings["ibd_topicid"]:"forum&forumid=".$btit_settings["ibd_forumid"])."'>";
      }
      $torrenttpl->set("introForumLink", $introForumLink);
   }
}
$torrenttpl->set("fls_enabled", (($btit_settings["fmhack_freeleech_slots"]=="enabled")?true:false), true);
if($btit_settings["fmhack_freeleech_slots"]=="enabled")
{
   $hashes=(!empty($CURUSER["freeleech_slot_hashes"])) ? explode(",", $CURUSER["freeleech_slot_hashes"]) : array();
   $torrenttpl->set("hash_found", in_array($row["info_hash"], $hashes), true);
   $torrenttpl->set("have_slots1", (($CURUSER["freeleech_slots"]>0)?true:false), true);
   $torrenttpl->set("have_slots2", (($CURUSER["freeleech_slots"]>0)?true:false), true);
}
//ads system by cooly
if($btit_settings["fmhack_ads_system"]=="enabled" && in_array($CURUSER["id_level"],explode(",",$btit_settings["ad_groups"])))
{
   $ads_settings=get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}ads");
   if($ads_settings["above_comments_enabled"]=="enabled")
   {
      $torrenttpl->set("comments_above",$ads_settings["above_comments"]);
      $torrenttpl->set("comments_above_en",(($btit_settings["fmhack_ads_system"]=="enabled")?TRUE:FALSE),TRUE);
   }else{}
}
   //ads system by cooly
$torrenttpl->set("download_locked", (($download_locked===true)?true:false), true);
$torrenttpl->set("refresh_peers_enabled",(($btit_settings["fmhack_refresh_torrent_peers"]=="enabled")?true:false) ,true);
$torrenttpl->set("similar_enabled", (($btit_settings["fmhack_similar_torrents"]=="enabled")?true:false), true);
$torrenttpl->set("viewcount_enabled", (($btit_settings["fmhack_torrent_view_count"]=="enabled")?true:false), true);
if($btit_settings["fmhack_torrent_view_count"]=="enabled")
{
   $row["viewcount"].=" ".$language["X_TIMES"];
}

if($btit_settings["fmhack_similar_torrents"]=="enabled")
{
      // Similar Torrents by DT start
   $similar_torrents=array();
   $j=0;
   $searchname1 = $row['filename'];
   $searchname2 = substr($row['filename'], 0, 8);
   $query1 = str_replace(" ",".",sql_esc($searchname1));
   $query2 = str_replace("."," ",sql_esc($searchname2));
   $r = get_result("SELECT `f`.`id`, `f`.`info_hash`, `f`.`filename`, `f`.`size`, UNIX_TIMESTAMP(`f`.`data`) `added`, $tseeds, $tleechs, `f`.`category` FROM $ttables WHERE imdb={$row['imdb']}", true, $btit_settings["cache_duration"]);
         //`f`.`filename` LIKE '%{$query1}%' AND {$tdt} > '0' AND `f`.`info_hash` <> '$id' OR `f`.`filename` LIKE '%{$query2}%' AND $tdt > '0' AND `f`.`info_hash` <> '$id' ORDER BY $tdt DESC LIMIT 10
   if (count($r)>0 && $row['imdb']>0)
   {
      foreach($r as $a)
      {
            // Peers Colors by DT
         $sc = '#04B404';
         $lc = '#04B404';

         if ($a["seeds"]==0)
            $sc  = '#FF0000';
         if ($a["leechers"]==0)
            $lc = '#FF0000';
         if ($a["seeds"]==1 || $a["seeds"]==2)
            $sc  = '#A9F5D0';
         if ($a["leechers"]==1 || $a["leechers"]==2)
            $lc = '#A9F5D0';
         if ($a["seeds"]==3 || $a["seeds"]==4)
            $sc  = '#00FF80';
         if ($a["leechers"]==3 || $a["leechers"]==4)
            $lc = '#00FF80';
            // end Peers Colors by DT

         $similar_torrents[$j]["sc"]=$sc;
         $similar_torrents[$j]["lc"]=$lc;
         $similar_torrents[$j]["name"]=htmlspecialchars($a["filename"]);
         $similar_torrents[$j]["size"]=makesize($a["size"]);
         $similar_torrents[$j]["seeds"]=$a["seeds"];
         $similar_torrents[$j]["leechers"]=$a["leechers"];
         require_once(dirname(__FILE__)."/include/offset.php");
         $similar_torrents[$j]["date"]=date("d/m/Y",$a["added"]-$offset);
         $similar_torrents[$j]["info_hash"]=$a["info_hash"];
         $j++;
      }
      $torrenttpl->set("similar_torrents", $similar_torrents);
   }else{
      $similar_torrents[0]["name"]="No match found";
      $torrenttpl->set("similar_torrents", $similar_torrents);
   }
      // Similar Torrents END
}

$torrenttpl->set("ddl_enabled", (($btit_settings["fmhack_direct_download"]=="enabled" && $CURUSER["view_ddl"]=="yes")?true:false), true);
$torrenttpl->set("BASEURL", $BASEURL);
if($btit_settings["fmhack_direct_download"]=="enabled" && $CURUSER["view_ddl"]=="yes")
{
   $torrenttpl->set("has_direct_link",  (($row["direct_download"]!="")?true:false), true);
   $torrenttpl->set("direct_link", $row["direct_download"]);
}
$torrenttpl->set("st_comm_enabled", (($btit_settings["fmhack_staff_comment_in_torrent_details"]=="enabled")?true:false), true);
if($btit_settings["fmhack_staff_comment_in_torrent_details"]=="enabled")
{
   if(is_integer($btit_settings["staff_comment_view"]) || substr($btit_settings["staff_comment_view"], 0, 4)!="lro-")
      stderr($language["ERROR"], $language["ERR_NEEDS_RECONFIG_1"]." <b>Staff Comment In Torrent Details</b> ".$language["ERR_NEEDS_RECONFIG_2"].(($CURUSER["admin_access"]=="no")?"<br /><br />".$language["ERR_NEEDS_RECONFIG_3"]:""));

   $lroPerms=explode("-", $btit_settings["staff_comment_view"]);
   if($btit_settings["fmhack_logical_rank_ordering"]=="enabled")
   {
      if($lroPerms[1]==1 && $lroPerms[2]>0)
         $viewCommOverOrEqual=(($CURUSER["logical_rank_order"]>=$lroPerms[2])?true:false);
      else
         stderr($language["ERROR"], $language["ERR_NEEDS_RECONFIG_1"]." <b>Staff Comment In Torrent Details</b> ".$language["ERR_NEEDS_RECONFIG_2"].(($CURUSER["admin_access"]=="no")?"<br /><br />".$language["ERR_NEEDS_RECONFIG_3"]:""));
   }
   elseif($btit_settings["fmhack_logical_rank_ordering"]=="disabled")
   {
      if($lroPerms[1]==0 && $lroPerms[2]>0)
         $viewCommOverOrEqual=(($CURUSER["id_level"]>=$lroPerms[2])?true:false);
      else
         stderr($language["ERROR"], $language["ERR_NEEDS_RECONFIG_1"]." <b>Staff Comment In Torrent Details</b> ".$language["ERR_NEEDS_RECONFIG_2"].(($CURUSER["admin_access"]=="no")?"<br /><br />".$language["ERR_NEEDS_RECONFIG_3"]:""));
   }
   if ($CURUSER["uid"]>1 && $viewCommOverOrEqual)
      $torrenttpl->set("LEVEL_SC",true,true);
   else
      $torrenttpl->set("LEVEL_SC",false,true);
   $torrenttpl->set("torrent_staff_comment",$row["staff_comment"]);
}

$torrenttpl->set("reenc_enabled", (($btit_settings["fmhack_offer_to_re-encode"]=="enabled" && $CURUSER["view_reencode"]=="yes" && $row["reencode"]==1)?true:false), true);

$torrenttpl->set("mult_enabled", (($btit_settings["fmhack_upload_multiplier"]=="enabled" && $row["multiplier"]>1)?true:false), true);
if($btit_settings["fmhack_upload_multiplier"]=="enabled")
{
   if($row["multiplier"]>1)
      $mult="<img src='images/".$row["multiplier"]."x.gif' border='0' alt='".$row["multiplier"]."x ".$language["UPM_UPL_MULT"]."' title='".$row["multiplier"]."x ".$language["UPM_UPL_MULT"]."' />";
   else
      $mult="";
   $torrenttpl->set("mult", $mult);
}

$torrenttpl->set("ruat", (($btit_settings["fmhack_report_users_and_torrents"]=="enabled")?true:false),true);
if($btit_settings["fmhack_report_users_and_torrents"]=="enabled")
{
   $torrenttpl->set("rep","<a href=index.php?page=report&torrent=".$row["info_hash"]."><button class='btn btn-labeled btn-danger' type='button'>
      <span class='btn-label'><i class='fa fa-exclamation-triangle'></i></span>Report Upload</button></a>");
}

$torrenttpl->set("AFR", (($btit_settings["fmhack_ask_for_reseed"]=="enabled")?true:false),true);
if($btit_settings["fmhack_ask_for_reseed"]=="enabled")
{
   $pa=time()-$row["data"];
   $px=time()-$row["reseed"];

   $reseed="";
   if($row["seeds"]<=$btit_settings["reseed_minSeeds"] && $row["finished"]>=$btit_settings["reseed_minFinished"] && $row["leechers"]>=$btit_settings["reseed_minLeechers"] && $pa>=($btit_settings["reseed_minTorrentAgeInDays"]*86400) && $px>=($btit_settings["reseed_minDaysSinceLast"]*86400))
   {
      $reseed=("<a href='index.php?page=reseed&amp;q=".$row["info_hash"]."'><button class='btn btn-labeled btn-info' type='button'>
      <span class='btn-label'><i class='fa fa-refresh fa-spin'></i></span>Reseed Request</button></a>");
   }
   $torrenttpl->set("reseed_possible",(($reseed=="")?FALSE:TRUE),TRUE);
   $torrenttpl->set("reseed",$reseed);
}
else
   $torrenttpl->set("reseed_possible",FALSE,TRUE);

$title2 = $row["filename"]." at ".$btit_settings["name"];
$torrenttpl->set("language",$language);

$torrenttpl->set("imageup_enabled",(($btit_settings["fmhack_torrent_image_upload"]=="enabled")?true:false),true);
$torrenttpl->set("imageup_enabled2",(($btit_settings["fmhack_torrent_image_upload"]=="enabled")?true:false),true);
$torrenttpl->set("imageup_enabled3",(($btit_settings["fmhack_torrent_image_upload"]=="enabled")?true:false),true);
if($btit_settings["fmhack_torrent_image_upload"]=="enabled")
{
   $torrenttpl->set("IMAGEIS",!empty($row["image"]),TRUE);
      //Gaart edit: disabling screenshots section.
   $torrenttpl->set("IMAGESC",FALSE);
      //$torrenttpl->set("IMAGESC",!empty($row["screen1"]) OR !empty($row["screen2"])OR !empty($row["screen3"]) ,TRUE);
      //End Gaart
   $torrenttpl->set("SCREENIS1",!empty($row["screen1"]),TRUE);
   $torrenttpl->set("SCREENIS2",!empty($row["screen2"]),TRUE);
   $torrenttpl->set("SCREENIS3",!empty($row["screen3"]),TRUE);

   if (!empty($row["image"]) && file_exists(($GLOBALS["uploaddir"].$row["image"])))
   {
      $image1 = $row["image"];
      $uploaddir = $GLOBALS["uploaddir"];
      $torrenttpl->set("uploaddir",$uploaddir);
         $image_new = $uploaddir.$image1; //url of picture
         //$image_new = str_replace(' ','%20',$image_new); //take url and replace spaces
         $max_width= "490"; //maximum width allowed for pictures
         $resize_width= "490"; //same as max width
         $size = @getimagesize("$image_new"); //get the actual size of the picture
         $width= $size[0]; // get width of picture
         $height= $size[1]; // get height of picture

         if ($width>$max_width)
         $new_width=$resize_width; // Resize Image If over max width
      else
         $new_width=$width; // Keep original size from array because smaller than max

      $torrenttpl->set("width",$new_width);
   }
   else
   {
      $torrenttpl->set("uploaddir","");
   }
}
else
{
   $torrenttpl->set("IMAGEIS",FALSE,TRUE);
   $torrenttpl->set("SCREENIS1",FALSE,TRUE);
   $torrenttpl->set("SCREENIS2",FALSE,TRUE);
   $torrenttpl->set("SCREENIS3",FALSE,TRUE);
}

   // Temp Fix
$torrenttpl->set("SHOW_UPLOADER",true,true);
   //
if ($CURUSER["uid"]>1 && ($CURUSER["uid"]==$row["uploader"] || $CURUSER["edit_torrents"]=="yes" || $CURUSER["delete_torrents"]=="yes"))
{
   $torrenttpl->set("MOD",TRUE,TRUE);
   $torrent_mod="<br />&nbsp;&nbsp;";
      //$torrenttpl->set("SHOW_UPLOADER",true,true);
}
else
{
      //$torrenttpl->set("SHOW_UPLOADER",false,true);
   $torrenttpl->set("MOD",false,TRUE);
}

$uploader_allowed=(($CURUSER["uid"]>1 && $CURUSER["uid"]==$row["uploader"])?"yes":"no");
if($btit_settings["fmhack_uploader_rights"]=="enabled" && $uploader_allowed=="yes" && $btit_settings["ulri_edit"]=="no")
   $uploader_allowed="no";

if ($uploader_allowed=="yes" || $CURUSER["edit_torrents"]=="yes") {
   if ($GLOBALS["usepopup"])
      $torrent_mod.="<a href=\"javascript: windowunder('index.php?page=edit&amp;info_hash=".$row["info_hash"]."&amp;returnto=".urlencode((($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?strtr($row["filename"], $res_seo["str"], $res_seo["strto"])."-".$torrent_id.".html":"index.php?page=torrent-details&id=".$row["info_hash"]))."')\"><button class='btn btn-primary btn-circle' type='button'><i class='fa fa-pencil-square-o'></i></button></a>&nbsp;&nbsp;";
   else
      $torrent_mod.="<a href=\"index.php?page=edit&amp;info_hash=".$row["info_hash"]."&amp;returnto=".urlencode((($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?strtr($row["filename"], $res_seo["str"], $res_seo["strto"])."-".$torrent_id.".html":"index.php?page=torrent-details&id=".$row["info_hash"]))."\"><button class='btn btn-primary btn-circle' type='button'><i class='fa fa-pencil-square-o'></i></button></a>&nbsp;&nbsp;";

}

if($btit_settings["fmhack_teams"]=="enabled")
{
   if ($row["team"])
   {
      $viewteam="<tr>
      <td align='right' class='header'>".$language["TEAMS_TEAM"]."</td>
      <td class='lista' align='center'><a href='index.php?page=teaminfo&team=".$row["teamsid"]."&action=view'><img src='".$row["teamimage"]."' border='0' title='".$row["teamname"]."' style='width:25px;'></a></td>
   </tr>";
}
else
   $viewteam="";
$torrenttpl->set("teamview",$viewteam);
}

$uploader_allowed=(($CURUSER["uid"]>1 && $CURUSER["uid"]==$row["uploader"])?"yes":"no");
if($btit_settings["fmhack_uploader_rights"]=="enabled" && $uploader_allowed=="yes" && $btit_settings["ulri_delete"]=="no")
   $uploader_allowed="no";

if ($uploader_allowed=="yes" || $CURUSER["delete_torrents"]=="yes") {
   if ($GLOBALS["usepopup"])
      $torrent_mod.="<a href=\"javascript: windowunder('index.php?page=delete&amp;info_hash=".$row["info_hash"]."&amp;returnto=".urlencode("index.php?page=torrents")."')\"><button class='btn btn-danger btn-circle' type='button'><i class='fa fa-times'></i></button></a>&nbsp;&nbsp;";
   else
      $torrent_mod.="<a href=\"index.php?page=delete&amp;info_hash=".$row["info_hash"]."&amp;returnto=".urlencode("index.php?page=torrents")."\"><button class='btn btn-danger btn-circle' type='button'><i class='fa fa-times'></i></button></a>";
}

if($btit_settings["fmhack_uploader_rights"]=="enabled" && $torrent_mod=="<br />&nbsp;&nbsp;")
$torrent_mod="";

$torrenttpl->set("mod_task",$torrent_mod);

   ##############################################################
   # Nfo hack -->
$torrenttpl->set("nfo_enabled", (($btit_settings["fmhack_NFO_uploader_-_viewer"]=="enabled")?true:false), true);
$torrenttpl->set("view_nfo", (($btit_settings["fmhack_NFO_uploader_-_viewer"]=="enabled" && $CURUSER["view_nfo"]=="yes")?true:false), true);
if($btit_settings["fmhack_NFO_uploader_-_viewer"]=="enabled")
{
   $filenfo = "nfo/rep/" . $row["info_hash"] . ".nfo";
   $torrenttpl->set("nfo_exists",file_exists($filenfo), true);
}
   # End
   ########################################################## -->

$row["filename2"]=$row["filename"];
$torrenttpl->set("down_filename",str_replace("&amp;","_",$row["filename2"]));
if($btit_settings["fmhack_torrent_nuked_and_requested"]=="enabled")
{
      //Torrent Nuke/Req Hack Start
   $row["torrentname"]=$row["filename"];
   if ($row["requested"]!="false")
      $req="&nbsp;<img title='".$language["TNR_REL_REQ"]."' src='images/req.gif' border='0' />";

   if ($row["nuked"]!="false")
      $nuk="&nbsp;<img title='".$row["nuke_reason"]."' src='images/nuked.gif' border='0' />";

   $row["filename2"]=$row["filename"].$nuk.$req;
      //Torrent Nuke/Req Hack End
}

if (!empty($row["comment"]))
   $row["description"]=format_comment($row["comment"]);

if($btit_settings["fmhack_torrent_details_media_player"]=="enabled")
{
   if (!empty($row["mplayer"]))
   {
      $row["mplayer"]=unesc("<div id=\"container\"><a href=\"http://www.macromedia.com/go/getflashplayer\">Get the Flash Player</a> to see this player.</div>
         <script type=\"text/javascript\" src=\"mplayer/swfobject.js\"></script>
         <script type=\"text/javascript\">
            var s1 = new SWFObject(\"mplayer/player.swf\",\"ply\",\"100%\",\"200\", \"9\",\"#FFFFFF\");
            s1.addParam(\"allowfullscreen\",\"true\");
            s1.addParam(\"allowscriptaccess\",\"always\");
            s1.addParam(\"flashvars\",\"file=".$row["mplayer"]."&image=mplayer/background.jpg\");
            s1.write(\"container\");
         </script>");
   }
   else
      $row["mplayer"]=unesc($language["MPLAYERNON"]);
}

if (isset($row["cat_name"]))
   $row["cat_name"]=unesc($row["cat_name"]);
else
   $row["cat_name"]=unesc($language["NONE"]);


$row["size"]=makesize($row["size"]);
   // files in torrent - by Lupin 20/10/05

$torrenttpl->set("auto_topic_enabled", (($btit_settings["fmhack_forum_auto_topic"]=="enabled" && $btit_settings["smf_autotopic"]=="true")?true:false), true);
$torrenttpl->set("FORUM_LNK", false, true);
if($btit_settings["fmhack_forum_auto_topic"]=="enabled" && $btit_settings["smf_autotopic"]=="true")
{
   if($btit_settings["smf_autotopic"] == "true")
      $torrenttpl->set("FORUM_LNK", true, true);

   $href="href='".$BASEURL."/index.php?page=forum&amp;action=viewtopic&amp;topicid=".$row["topicid"]."'";

   if(substr($FORUMLINK,0,3)=="smf")
   {
      $href="href='".$BASEURL."/index.php?page=forum&amp;action=viewtopic&amp;topicid=".$row["topicid"].".0'";

      if($btit_settings["fmhack_integrated_forum_display"]=="enabled")
      {
         if($btit_settings["forum_viewtype"]!="iframe")
            $href="href='".$BASEURL."/smf/index.php?topic=".$row["topicid"].".0' target='".$btit_settings["forum_viewtype"]."'";
      }
   }
   elseif($FORUMLINK=="ipb")
   {
      $href="href='".$BASEURL."/index.php?page=forum&amp;action=viewtopic&amp;topicid=".$row["topicid"]."'";

      if($btit_settings["fmhack_integrated_forum_display"]=="enabled")
      {
         if($btit_settings["forum_viewtype"]!="iframe")
            $href="href='".$BASEURL."/ipb/index.php?showtopic=".$row["topicid"]."' target='".$btit_settings["forum_viewtype"]."'";
      }
   }
   $row["topicid"] = "<a ".$href.">".$language["AUTOTOPIC_CLICK_HERE"]."</a>";
}

$torrenttpl->set("magnet_enabled1", false, true);
$torrenttpl->set("magnet_enabled2", false, true);
require_once(dirname(__FILE__)."/include/BDecode.php");
if (file_exists($row["url"]))
{
   $torrenttpl->set("DISPLAY_FILES",TRUE,TRUE);
   $ffile=fopen($row["url"],"rb");
   $content=fread($ffile,filesize($row["url"]));
   fclose($ffile);
   $content=BDecode($content);
   $magnetLink="";
   if($btit_settings["fmhack_magnet_links"]=="enabled" && !$DHT_PRIVATE && !$PRIVATE_ANNOUNCE && $row["magnet"]=="")
   {
      if(!isset($content["info"]["private"]) || $content["info"]["private"]==0)
      {
         $magnetLink="magnet:?xt=urn:btih:".$row["info_hash"]."&dn=".urlencode($row["filename"]);
         if(!isset($content["announce-list"]) && isset($content["announce"]) && !empty($content["announce"]))
         {
            $content["announce-list"][0][0]=$content["announce"];
         }
         if(!isset($content["announce-list"]))
            $content["announce-list"]=array();
         if(count($content["announce-list"])>0)
         {
            foreach($content["announce-list"] as $value)
            {
               $magnetLink.="&tr=".urlencode($value[0]);
            }
         }
      }
      quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `magnet`='".sql_esc(base64_encode($magnetLink))."' WHERE `info_hash`='".sql_esc($row["info_hash"])."' ",true);
   }
   elseif($btit_settings["fmhack_magnet_links"]=="enabled" && !$DHT_PRIVATE && !$PRIVATE_ANNOUNCE && $row["magnet"]!="")
   {
      $magnetLink=base64_decode(stripslashes($row["magnet"]));
   }
   $torrenttpl->set("magnet_enabled1", (($btit_settings["fmhack_magnet_links"]=="enabled" && !$DHT_PRIVATE && !$PRIVATE_ANNOUNCE && $magnetLink!="")?true:false), true);
   $torrenttpl->set("magnet_enabled2", (($btit_settings["fmhack_magnet_links"]=="enabled" && !$DHT_PRIVATE && !$PRIVATE_ANNOUNCE && $magnetLink!="")?true:false), true);
   $torrenttpl->set("magnetLink", $magnetLink);
   $numfiles=0;
   if (isset($content["info"]) && $content["info"])
   {
      $thefile=$content["info"];
      if (isset($thefile["length"]))
      {
         preg_match('/\\.([A-Za-z0-9]+)$/', $thefile["name"], $ext);
         $ext = strtolower($ext[1]);
         if (substr($ext, 0, 1) == 'r') $ext = 'rar';
         if (!file_exists("images/icons/".$ext.".png")) $ext = "Unknown";

         $dfiles[$numfiles]["filename"]=$ext.htmlspecialchars($thefile["name"]);
         $dfiles[$numfiles]["size"]=makesize($thefile["length"]);
         $numfiles++;
      }
      elseif (isset($thefile["files"]))
      {
         foreach($thefile["files"] as $singlefile)
         {
            preg_match('/\\.([A-Za-z0-9]+)$/', implode("/",$singlefile["path"]), $ext);
            $ext = strtolower($ext[1]);
            if (substr($ext, 0, 1) == 'r') $ext = 'rar';
            if (!file_exists("images/icons/".$ext.".png")) $ext = "Unknown";
            $dfiles[$numfiles]["filename"]="<img border='0' src='".$BASEURL."/images/icons/".$ext.".png' title='".$ext."'>&nbsp;".htmlspecialchars(implode("/",$singlefile["path"]));
            $dfiles[$numfiles]["size"]=makesize($singlefile["length"]);
            $numfiles++;
         }
      }
      else
      {
            // can't be but...
      }
   }
   $row["numfiles"]=$numfiles.($numfiles==1?" file":" files");
   unset($content);
}
else
   $torrenttpl->set("DISPLAY_FILES",false,TRUE);

$torrenttpl->set("files",$dfiles);

   // end files in torrents
include(dirname(__FILE__)."/include/offset.php");
$row["date"]=date("d/m/Y",$row["data"]-$offset);

if ($row["anonymous"]=="true")
{
   if ($CURUSER["edit_torrents"]=="yes")
      $uploader="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$row["uploader"]."_".strtr($row["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$row["uploader"])."'>". unesc((($btit_settings["fmhack_group_colours_overall"]=="enabled")?$row["prefixcolor"]:"") . $row["username"] . (($btit_settings["fmhack_group_colours_overall"]=="enabled")?$row["suffixcolor"]:"")) . "</a>(".$language["TORRENT_ANONYMOUS"].")";
   else
      $uploader=$language["TORRENT_ANONYMOUS"];
}
else
   $uploader="<a href=\"".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$row["uploader"]."_".strtr($row["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$row["uploader"])."\">".(($btit_settings["fmhack_group_colours_overall"]=="enabled")?stripslashes($row["prefixcolor"].$row["username"].$row["suffixcolor"]):$row["username"]).(($btit_settings["fmhack_simple_donor_display"]=="enabled")?get_user_icons($row):"").(($btit_settings["fmhack_warning_system"]=="enabled")?warn($row):"")."</a>";
$row["uploader"]=$uploader;

if ($row["speed"] < 0) {
   $speed = "N/D";
}
else if ($row["speed"] > 2097152) {
   $speed = round($row["speed"]/1048576,2) . " MB/sec";
}
else {
   $speed = round($row["speed"] / 1024, 2) . " KB/sec";
}

$torrenttpl->set("NOT_XBTT",!$XBTT_USE,TRUE);

$row["speed"]=$speed;

$torrenttpl->set("tmod1_enabled", (($btit_settings["fmhack_torrent_moderation"]=="enabled")?true:false), true);
if($btit_settings["fmhack_torrent_moderation"]=="enabled")
{
      // moder
   if ($CURUSER['moderate_trusted']=='yes')
      $moderation=TRUE;
   $torrenttpl->set("MODER",$moderation,TRUE);

   $moder=$res_m;
   if(!isset($language["SYSTEM_USER"]))
      $language["SYSTEM_USER"]="System";
   $row["moderation"].="<a title=\"".$moder["moder"].(($btit_settings["mod_app_sa"]=="yes" && $CURUSER["admin_access"]=="yes" && $moder["username"]!=$language["SYSTEM_USER"] && $moder["moder"]!="um")?(($moder["moder"]=="ok")?" (".$language["TMOD_APPROVED_BY"]." ".$moder["username"].")":" (".$language["TMOD_REJECTED_BY"]." ".$moder["username"].")"):"")."\" href=\"index.php?page=edit&info_hash=".$row["info_hash"]."\"><img alt=\"".$moder["moder"]."\" src=\"images/mod/".$moder["moder"].".png\"  border=\"0\" /></a>";
      // moder
}

if (($XBTT_USE && !$PRIVATE_ANNOUNCE) || $row["external"]=="yes")
{
   $row["downloaded"]=$row["finished"]." " . $language["X_TIMES"];
   $row["peers"]=($row["leechers"]+$row["seeds"])." ".$language["PEERS"];
   $row["seeds"]=$language["SEEDERS"].": ".$row["seeds"];
   $row["leechers"]=$language["LEECHERS"].": " . $row["leechers"];
}
else
{
   $row["downloaded"]="<a href=\"index.php?page=torrent_history&amp;id=".$row["info_hash"]."\">" . $row["finished"] . "</a> " . $language["X_TIMES"];
   $row["peers"]="<a href=\"index.php?page=peers&amp;id=".$row["info_hash"]."\">" . ($row["leechers"]+$row["seeds"]) . "</a> ".$language["PEERS"];
   $row["seeds"]=$language["SEEDERS"].": <a href=\"index.php?page=peers&amp;id=".$row["info_hash"]."\">" . $row["seeds"] . "</a>";
   $row["leechers"]=$language["LEECHERS"].": <a href=\"index.php?page=peers&amp;id=".$row["info_hash"]."\">" . $row["leechers"] ."</a>";
}
if ($row["external"]=="yes" && $CURUSER["id_level"]>=6)
{
   $torrenttpl->set("EXTERNAL", (($btit_settings["fmhack_permissions_for_external_torrents"]=="enabled" && $CURUSER["external_refresh"]=="no")?false:true), true);
   if($btit_settings["fmhack_multi_tracker_scrape"]=="enabled")
   {
      $row["update_url"]="<a href=\"index.php?page=torrent-details&amp;act=update&amp;id=".$row["info_hash"]."\">".$language["UPDATE"]."</a>";
      $row["announce_url"]="<b>".$language["EXTERNAL"]."</b>";
      $announces=@unserialize($row['announces'])?unserialize($row['announces']):array();
      $i=0;
      foreach ($announces AS $announce=>$details)
      {
         if ($i==0)
         {
            $row['announce_url'].='<table><tbody>';
            $row['announce_url'].='<tr><th>'.$language["MTS_ANNURL"].'</th><th>'.$language["MTS_SEED"].'</th><th>'.$language["MTS_LEECH"].'</th><th>'.$language["MTS_DOWN"].'</th></tr>';
         }

         $row['announce_url'].='<tr><td>'.$announce.'</td><td>'.intval($details['seeds']).'</td><td>'.intval($details['leeches']).'</td><td>'.intval($details['downloaded']).'</td></tr>';

         if ($i+1==count($announces))
            $row['announce_url'].='</tbody></table>';

         $i++;
      }
   }
   else
   {
      $row["update_url"]="<a href=\"index.php?page=torrent-details&amp;act=update&amp;id=".$row["info_hash"]."&amp;surl=".urlencode($row["announce_url"])."\">".$language["UPDATE"]."</a>";
      $row["announce_url"]="<b>".$language["EXTERNAL"]."</b><br />".$row["announce_url"];
   }
   $row["lastupdate"]=get_date_time($row["lastupdate"]);
   $row["lastsuccess"]=get_date_time($row["lastsuccess"]);
}
else
   $torrenttpl->set("EXTERNAL",false,TRUE);


$CURUSER["view_comments"]=(($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"]=="enabled")?$CURUSER["view_comments"]:"yes");
$CURUSER["delete_comments"]=(($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"]=="enabled")?$CURUSER["delete_comments"]:$CURUSER["delete_torrents"]);

if ($CURUSER["view_comments"]=="yes")
{
   $torrenttpl->set("VIEW_COMMENTS",TRUE,TRUE);
   $torrenttpl->set("VIEW_COMMENTS_2",TRUE,TRUE);

   $pagertop="";
   $pagerbottom="";
   $limit="";
   $query2_select="";
   $query2_join="";
   if($btit_settings["fmhack_custom_title"]=="enabled")
      $query2_select.="u.custom_title, u.id_level, ul.level,";
   if($btit_settings["fmhack_simple_donor_display"]=="enabled")
      $query2_select.="u.donor,";
   if($btit_settings["fmhack_warning_system"]=="enabled")
      $query2_select.="u.warn,";
   if($btit_settings["fmhack_group_colours_overall"]=="enabled")
      $query2_select.="`ul`.`prefixcolor`, `ul`.`suffixcolor`,";
   if($btit_settings["fmhack_avatar_signature_sync"]=="enabled")
      $query2_select.="`u`.`sig`,`u`.`signature`,";
   if($btit_settings["fmhack_custom_title"]=="enabled" || $btit_settings["fmhack_group_colours_overall"]=="enabled")
      $query2_join.="LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` ";
   if($btit_settings["fmhack_lock_comments"]=="enabled")
   {
      $query2_select.="`f`.`lock_comment`,";
      $query2_join.="LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `c`.`info_hash`=`f`.`info_hash` ";
   }
   if($btit_settings["fmhack_comments_layout"]=="enabled")
   {
      $perpage=(($CURUSER["torrentsperpage"]>0)?$CURUSER["torrentsperpage"]:15);
      $cnumres=get_result("SELECT COUNT(*) as comms FROM `{$TABLE_PREFIX}comments` WHERE `info_hash` = '" . $id . "'",true,$btit_settings["cache_duration"]);
      $num2=$cnumres[0]["comms"];
      list($pagertop, $pagerbottom, $limit) = pager($perpage, $num2, "index.php?page=torrent-details&id=".$id."&amp;");

      if($XBTT_USE)
      {
         $query2_select.="`u`.`downloaded`+IFNULL(`x`.`downloaded`,0) `downloaded`, `u`.`uploaded`+IFNULL(`x`.`uploaded`,0) `uploaded`, `u`.`avatar`, ".(($btit_settings["fmhack_custom_title"]=="enabled")?"":"`u`.`id_level`,");
         $query2_join.="LEFT JOIN `xbt_users` `x` ON `x`.`uid`=`u`.`id` ";
      }
      else
         $query2_select.="`u`.`downloaded`, `u`.`uploaded`, `u`.`avatar`, ".(($btit_settings["fmhack_custom_title"]=="enabled")?"":"`u`.`id_level`,");
   }

      // comments..

      // comments...

   $subres = get_result("SELECT ".$query2_select." c.id, c.points, text, UNIX_TIMESTAMP(added) as data, user, u.id as uid FROM {$TABLE_PREFIX}comments c LEFT JOIN {$TABLE_PREFIX}users u ON c.user=u.username ".$query2_join." WHERE c.info_hash = '" . $id . "' ORDER BY added DESC ".$limit,true,$btit_settings['cache_duration']);



   if($btit_settings["fmhack_lock_comments"]=="enabled")
      $first_pass=true;

   if (!$subres || count($subres)==0)
   {
      if($CURUSER["uid"]>1)
         $torrenttpl->set("INSERT_COMMENT",TRUE,TRUE);
      else
         $torrenttpl->set("INSERT_COMMENT",false,TRUE);

      $torrenttpl->set("NO_COMMENTS",true,TRUE);
   }
   else
   {
      $torrenttpl->set("NO_COMMENTS",false,TRUE);

      if($CURUSER["uid"]>1)
         $torrenttpl->set("INSERT_COMMENT",TRUE,TRUE);
      else
         $torrenttpl->set("INSERT_COMMENT",false,TRUE);
      $comments=array();
      $count=0;
      foreach ($subres as $subrow)
      {
         if($btit_settings["fmhack_avatar_signature_sync"]=="enabled")
         {
            $sigshit=array('[img]','[/img]');
            $sigshit2=array('','');
            $prev_sig=str_replace($sigshit,$sigshit2,$subrow["sig"]);
            if(!empty($subrow["sig"])){
               $comments[$count]["comm_sig"]="<img border=\"0\" onload=\"resize_sig(this);\" src=\"".htmlspecialchars($prev_sig)."\" alt=\"\" />";
            }else{
               $comments[$count]["comm_sig"]=" <br /> <br /><center style='line-height: 1.5em;border-top:solid 1px;'>".format_comment($arr['signature'])."</center>";
            }
         }
         else
         {
            $comments[$count]["comm_sig"]=" <br /> <br /><center style='line-height: 1.5em;border-top:solid 1px;'>".format_comment($arr['signature'])."</center>";
         }

         if($btit_settings["fmhack_lock_comments"]=="enabled" && $first_pass===true)
         {
               // lock
            if ($CURUSER["id_level"]>= 6)
               $torrenttpl->set("lock","<a href='index.php?page=comment&amp;id=$id&amp;".(($subrow["lock_comment"]=="yes")?"un":"")."lock'>".image_or_link("images/".(($subrow["lock_comment"]=="yes")?"un":"")."lock.gif","", (($subrow["lock_comment"]=="yes")?$language["UNLOCK"]:$language["LOCK"]))."</a>");
               //lock end
         }

            // DT Comment Vote Start
         $comments[$count]["cid"]=$subrow["id"];

         if ($subrow["points"] == 0)
         {
            $vote_plus=  "<button class='btn btn-labeled btn-success' type='button'>
            <span class='btn-label'><i class='fa fa-thumbs-up'></i></span>Thumbs
            Up</button>";
            $vote_min= "<button class='btn btn-labeled btn-danger' type='button'>
            <span class='btn-label'><i class='fa fa-thumbs-down'></i></span>Thumbs
            Down</button>";
         }
         if ($subrow["points"] >= +1 )
         {
            $vote_plus=  "<button class='btn btn-labeled btn-success' type='button'>
            <span class='btn-label'><i class='fa fa-thumbs-up'></i></span>Thumbs
            Up</button>";
            $vote_min= "<button class='btn btn-labeled btn-danger' type='button'>
            <span class='btn-label'><i class='fa fa-thumbs-down'></i></span>Thumbs
            Down</button>";
         }
         if ($subrow["points"] <= -1 )
         {
            $vote_plus= "<button class='btn btn-labeled btn-success' type='button'>
            <span class='btn-label'><i class='fa fa-thumbs-up'></i></span>Thumbs
            Up</button>";
            $vote_min=  "<button class='btn btn-labeled btn-danger' type='button'>
            <span class='btn-label'><i class='fa fa-thumbs-down'></i></span>Thumbs
            Down</button>";
         }

         $comments[$count]["voteu"]="<a href=index.php?page=votes&id=".$subrow["id"]."&hash=".$id."&count=up>".$vote_plus."</a>";
         $comments[$count]["voted"]="<a href=index.php?page=votes&id=".$subrow["id"]."&hash=".$id."&count=down>".$vote_min."</a>";
         $comments[$count]["vote_tot"] = $subrow["points"];
            // DT End Comment Vote end

         $first_pass=false;

         if($btit_settings["fmhack_custom_title"]=="enabled")
         {
            if (!$subrow["uid"])
               $title = "orphaned";
            elseif (!$subrow["custom_title"])
               $title = $subrow["level"];
            else
               $title = unesc($subrow["custom_title"]);
         }

         $comments[$count]["user"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$subrow["uid"]."_".strtr($subrow["user"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$subrow["uid"])."'>".(($btit_settings["fmhack_group_colours_overall"]=="enabled")?unesc($subrow["prefixcolor"].$subrow["user"].$subrow["suffixcolor"]):unesc($subrow["user"]).(($btit_settings["fmhack_comments_layout"]=="enabled")?"</a>":"")).(($btit_settings["fmhack_simple_donor_display"]=="enabled")?get_user_icons($subrow):"").(($btit_settings["fmhack_warning_system"]=="enabled")?warn($subrow):"") . (($btit_settings["fmhack_custom_title"]=="enabled")?(($btit_settings["fmhack_comments_layout"]=="enabled")?"":"</a>")." .::. ".$title:"");
         $comments[$count]["date"]=date("d/m/Y H.i.s",$subrow["data"]-$offset);
			// Begin Anonymous Comments for Anonymous Uploader Part 2
         $anon = "Anonymous";
         $anoncomm = do_sqlquery("select anonymous, uploader from {$TABLE_PREFIX}files WHERE info_hash='$id'");
         $anonrow=$anoncomm->fetch_assoc();
         if ($srow[uid]==$anonrow["uploader"] AND $anonrow["anonymous"]=="true") {
            if ($CURUSER["edit_torrents"]=="no")
            {
               ($comments[$count]["user"]="$anon");
               ($srow["avatar"] = "$STYLEURL/images/default_avatar.gif");
               ($srow["downloaded"] = "");
               ($srow["uploaded"] = "");
            }
            else
            {
               $srow["user"] = "Anonymous";
            }
         }
			// End Anonymous Comments for Anonymous Uploader Part 2

			//Quote
         $comments[$count]["quote"]="<a href='index.php?page=comment&id=$id&usern=".$CURUSER["username"]."&quoteid=".$subrow["id"]."'><button class='btn btn-labeled btn-primary' type='button'><span class='btn-label'><i class='fa fa-quote-right'></i></span>".$language["QUOTE"]."</button></a>";
         //Quote END

         if($btit_settings["fmhack_comments_layout"]=="enabled")
         {
            $comments[$count]["elapsed"]="(".get_elapsed_time($subrow["data"]) . " ".$language["TRAV_AGO"].")";
            $comments[$count]["avatar"]="<img onload=\"resize_avatar(this);\" src=\"".($subrow["avatar"] && $subrow["avatar"] != "" ? htmlspecialchars($subrow["avatar"]): "$STYLEURL/images/default_avatar.gif" )."\" alt=\"\" border=\"0\" />";
            $comments[$count]["ratio"]="<img src=\"images/arany.png\" border=\"0\" />&nbsp;".(intval($subrow['downloaded']) > 0?number_format($subrow['uploaded'] / $subrow['downloaded'], 2):"---");
            $comments[$count]["uploaded"]="<img src=\"images/speed_up.png\" border=\"0\" />&nbsp;".(makesize($subrow["uploaded"]));
            $comments[$count]["downloaded"]="<img src=\"images/speed_down.png\" border=\"0\" />&nbsp;".(makesize($subrow["downloaded"]));
         }
            // only users able to delete torrents can delete comments...
         if($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"]=="enabled")
         {
            if ($CURUSER["edit_comments"]=="yes" || $subrow["user"]==$CURUSER["username"])
               $comments[$count]["edit.delete"].="<a href=\"index.php?page=comment&amp;id=$id&amp;cid=" . $subrow["id"] . "&amp;edit\"><button class='btn btn-labeled btn-primary' type='button'><span class='btn-label'><i class='fa fa-pencil'></i></span>".$language["EDIT"]."</button></a>";
            if ($CURUSER["delete_comments"]=="yes" || $subrow["user"]==$CURUSER["username"])
               $comments[$count]["edit.delete"].="<a onclick=\"return confirm('". str_replace("'","\'",$language["DELETE_CONFIRM"])."')\" href=\"index.php?page=comment&amp;id=$id&amp;cid=" . $subrow["id"] . "&amp;action=delete\"><button class='btn btn-labeled btn-primary' type='button'><span class='btn-label'><i class='fa fa-times'></i></span>Delete</button></a>";
            if ($CURUSER["delete_comments"]=="yes")
               $comments[$count]["edit.delete"].="<input type=\"checkbox\" name=\"delcomment[]\" value=\"" . $subrow["id"] . "\" />";
         }
         else
         {
            if ($CURUSER["delete_torrents"]=="yes")
               $comments[$count]["delete"]="<a onclick=\"return confirm('". str_replace("'","\'",$language["DELETE_CONFIRM"])."')\" href=\"index.php?page=comment&amp;id=$id&amp;cid=" . $subrow["id"] . "&amp;action=delete\">".image_or_link("$STYLEPATH/images/delete.png","",$language["DELETE"])."</a>";
         }
         $comments[$count]["comment"]=format_comment($subrow["text"]);
         $count++;
      }
      unset($subrow);
      unset($subres);
   }

   $torrenttpl->set("current_username",$CURUSER["username"]);

   if ($CURUSER["delete_comments"]=="yes")
      $torrenttpl->set("MASSDEL_COMMENTS",TRUE,TRUE);
   else
      $torrenttpl->set("MASSDEL_COMMENTS",FALSE,TRUE);
}
else
{
   $torrenttpl->set("VIEW_COMMENTS",FALSE,TRUE);
   $torrenttpl->set("VIEW_COMMENTS_2",FALSE,TRUE);
}

if ($GLOBALS["usepopup"])
   $torrenttpl->set("torrent_footer","<a href=\"javascript: window.close();\">".$language["CLOSE"]."</a>");
else
   $torrenttpl->set("torrent_footer","<a href=\"javascript: history.go(-1);\">".$language["BACK"]."</a>");

$torrenttpl->set("imdb_enabled", (($btit_settings["fmhack_getIMDB_in_torrent_details"]=="enabled")?(($btit_settings["fmhack_grab_images_from_theTVDB"]=="enabled" && $row["tvdb_id"]>0 && $btit_settings["tvdb_hide_imdb"]=="yes")?false:true):false),true);

$tvdb_banners=array();
if($btit_settings["fmhack_getIMDB_in_torrent_details"]=="enabled")
{
   if ($row["imdb"]==0)
   {
      $searchit=$language["IMDB_NOT_ADDED"];
   }
   else
   {
      $frameit="<script type=\"text/javascript\" src=\"".$BASEURL."/jscript/imdb.js\"></script>

      <div id='imdb'></div>
      <script>
         $(\"#imdb\").empty().html('<center><br><b>".$language["IMDB_SCAN"]."</b><br><img src=\"".$BASEURL."/images/loading.gif\" /></center>');
         $(\"#imdb\").load(\"getimdb.php?mid=".$row["imdb"]."\");
         jQuery.noConflict();
      </script>
      ";

      $lang_path=$_SESSION["CURUSER"]["language_url"];

      if($lang_path=="language/german" && !isset($imdburl))
         $imdburl="www.imdb.de";
      elseif($lang_path=="language/italian" && !isset($imdburl))
         $imdburl="www.imdb.it";
      elseif($lang_path=="language/spanish" && !isset($imdburl))
         $imdburl="www.imdb.es";
      elseif($lang_path=="language/french" && !isset($imdburl))
         $imdburl="www.imdb.fr";
      elseif(substr($lang_path, 0, 19)=="language/portuguese" && !isset($imdburl))
         $imdburl="www.imdb.pt";
      elseif(!isset($imdburl))
         $imdburl="www.imdb.com";

      $extra1="<tr>
      <td align=\"right\" class=\"header\" valign=\"top\">".$language["IMDB_EXTRA"]."</td>
      <td class=\"lista\" style=\"text-align:center\"><a href='http://".$imdburl."/title/tt".$row["imdb"]."' target='_blank'>".$language["IMDB_VIEW"]."</a>
         &nbsp;&nbsp;<a href=\"javascript: void(0)\"
         onclick=\"window.open('$BASEURL/imdb/imdb.php?mid=<tag:torrent.imdb />','windowname1','width=600, height=400,scrollbars=yes');
         return false;\">".$language["IMDB_MORE_INFO"]."</a>
         &nbsp;&nbsp;<a href=\"javascript: void(0)\"
         onclick=\"window.open('$BASEURL/imdb/search.php?mid=".$row["imdb"]."&engine=imdb&name=".$row["filename"]."','windowname1','width=600,height=400,scrollbars=yes');
         return false;\">".$language["SEARCH"]."</a></td>
      </tr>";

      if(file_exists($THIS_BASEPATH."/fanart/imdb/tt".$row["imdb"]."/banners"))
      {
         foreach(glob($THIS_BASEPATH."/fanart/imdb/tt".$row["imdb"]."/banners/*.*") as $imageFilename)
            $tvdb_banners[]=str_replace($THIS_BASEPATH."/", "", $imageFilename);
      }
   }
   $torrenttpl->set("extra1",$extra1);
   $torrenttpl->set("frameit",$frameit);
}
$theTVDBExtraOutput="";
$img_src="";
$banner_src="";
if($btit_settings["fmhack_grab_images_from_theTVDB"] == "enabled" && $row["tvdb_id"]!=0)
{

   if(file_exists($THIS_BASEPATH."/thetvdb/".$row["tvdb_id"]."/banners"))
   {
      foreach(glob($THIS_BASEPATH."/thetvdb/".$row["tvdb_id"]."/banners/*.*") as $imageFilename)
         $tvdb_banners[]=str_replace($THIS_BASEPATH."/", "", $imageFilename);
   }

   if(file_exists($THIS_BASEPATH."/fanart/thetvdb/".$row["tvdb_id"]."/banners"))
   {
      foreach(glob($THIS_BASEPATH."/fanart/thetvdb/".$row["tvdb_id"]."/banners/*.*") as $imageFilename)
         $tvdb_banners[]=str_replace($THIS_BASEPATH."/", "", $imageFilename);
   }
}
if(count($tvdb_banners)>0)
{
   $key_b=mt_rand(0,(count($tvdb_banners)-1));
   $tvdb_banner_out=$tvdb_banners[$key_b];
}
if(!empty($tvdb_banner_out) && $tvdb_banner_out!=""){
   $torrenttpl->set("has_cover_banner",true,true);
}
else{
   $torrenttpl->set("has_cover_banner",false,true);
}
$torrenttpl->set("tvdb_banner",$tvdb_banner_out);
$torrenttpl->set("TheTVDBExtra", $theTVDBExtraOutput);
   // subtitles begin
$torrenttpl->set("sub_enabled", (($btit_settings["fmhack_subtitles"]=="enabled")?true:false), true);
if($btit_settings["fmhack_subtitles"]=="enabled")
{
   $sres=do_sqlquery("SELECT IFNULL(flagpic,'unknown.gif') as flag, s.name, c.name as flagname, s.id FROM {$TABLE_PREFIX}subtitles s LEFT JOIN {$TABLE_PREFIX}countries c ON s.flag=c.id WHERE hash='$id'",true);

   if (@sql_num_rows($sres)>0)
   {
      $torrenttpl->set("HAVE_SUBTITLE",true,true);
      $sub=array();
      $i=0;
      while ($srow = $sres->fetch_assoc())
      {
// Begin Anonymous Comments for Anonymous Uploader Part 1
       if ($srow[uid]==$anonrow["uploader"] AND $anonrow["anonymous"]=="true") {
          $srow["user"] = "Anonymous";
       }
// End Anonymous Comments for Anonymous Uploader Part 1
       $sub[$i]['name']="<a href='subtitle_download.php?id=".$srow["id"]."'>".$srow["name"]."</a>";
       $sub[$i]['flag']="<img src='images/flag/".$srow["flag"]."' title='".$srow["flagname"]."' alt='".$srow["flagname"]."'  border='0' />";
       $i++;
    }
    $torrenttpl->set('subs',$sub);
    unset($sub);
 }
 else
   $torrenttpl->set("HAVE_SUBTITLE",false,true);

$sres->free();
}
   // subtitles end
   //addthis by signo
   /*$torrenttpl->set("show_addthis","	<!-- Code genarated from http://www.addthis.com/ -->
   <!-- AddThis Button BEGIN -->
   <div class='addthis_toolbox addthis_default_style'>
   <a class='addthis_button_facebook'></a>
   <a class='addthis_button_myspace'></a>
   <a class='addthis_button_googlebuzz'></a>
   <a class='addthis_button_twitter'></a>
   <a class='addthis_button_live'></a>
   <a class='addthis_button_google_plusone'></a>
   <a class='addthis_button_compact'></a>
   <a class='addthis_counter addthis_bubble_style'></a>
   </div>
   <script type='text/javascript' src='http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e57b1bb3fd7f0ca'></script>
   <!-- AddThis Button END -->");*/
   //end addthis

   $row["alt_image_imgup"]=$GLOBALS["uploaddir"]."nocover.jpg";
   $row["alt_image_imdb"]=$GLOBALS["uploaddir"]."nocover.jpg";
   if($btit_settings["fmhack_getIMDB_in_torrent_details"]=="enabled" && $btit_settings["fmhack_torrent_image_upload"]=="enabled")
   {
      $imgup_img=((isset($row["image"]) && !empty($row["image"]) && file_exists(dirname(__FILE__)."/".$GLOBALS["uploaddir"].$row["image"]))?true:false);
      $imdb_img=((isset($row["imdb"]) && !empty($row["imdb"]) && file_exists(dirname(__FILE__)."/imdb/images/".$row["imdb"].".jpg"))?true:false);
      $row["alt_image_imgup"]=(($imgup_img===true)?$GLOBALS["uploaddir"].$row["image"]:(($imdb_img===true)?"imdb/images/".$row["imdb"].".jpg":$GLOBALS["uploaddir"]."nocover.jpg"));
      $row["alt_image_imdb"]=(($imdb_img===true)?"imdb/images/".$row["imdb"].".jpg":(($imgup_img===true)?$GLOBALS["uploaddir"].$row["image"]:$GLOBALS["uploaddir"]."nocover.jpg"));
   }

   //Rate This Upload
   require('ajaxstarrater/_drawrating.php'); # ajax rating

   if ($row["username"]!=$CURUSER["username"] && $CURUSER["uid"]>1) {
      $row["rating"] =  rating_bar("" . $_GET["id"]. "", 5);
   } else {
      $row["rating"] = rating_bar("" . $_GET["id"]. "", 5, 'static');
   }
   //$row["rating"];
   //Rate This Upload

   $torrenttpl->set("torrent",$row);
   $torrenttpl->set("media_enabled", (($btit_settings["fmhack_torrent_details_media_player"]=="enabled")?true:false), true);
   $torrenttpl->set("torlang", (($btit_settings["fmhack_language_in_torrent_list_and_details"]=="enabled")?true:false), true);
   if($btit_settings["fmhack_language_in_torrent_list_and_details"]=="enabled")
   {
      if ($row["language"] == "0")
         $torrenttpl->set("language",$language["UNKNOWN"]);
      else if ($row["language"] == "1")
         $torrenttpl->set("language",$language["LANG_ENG"]);
      else if ($row["language"] == "2")
         $torrenttpl->set("language",$language["LANG_FRE"]);
      else if ($row["language"] == "3")
         $torrenttpl->set("language",$language["LANG_DUT"]);
      else if ($row["language"] == "4")
         $torrenttpl->set("language",$language["LANG_GER"]);
      else if ($row["language"] == "5")
         $torrenttpl->set("language",$language["LANG_SPA"]);
      else if ($row["language"] == "6")
         $torrenttpl->set("language",$language["LANG_ITA"]);
      else if ($row["language"] == "7")
         $torrenttpl->set("language",$language["LANG_FIN"]);
      else if ($row["language"] == "8")
         $torrenttpl->set("language",$language["LANG_GRE"]);
      else if ($row["language"] == "9")
         $torrenttpl->set("language",$language["LANG_ICE"]);
      else if ($row["language"] == "10")
         $torrenttpl->set("language",$language["LANG_JAP"]);
      else if ($row["language"] == "11")
         $torrenttpl->set("language",$language["LANG_KOR"]);
      else if ($row["language"] == "12")
         $torrenttpl->set("language",$language["LANG_LAT"]);
      else if ($row["language"] == "13")
         $torrenttpl->set("language",$language["LANG_NOR"]);
      else if ($row["language"] == "14")
         $torrenttpl->set("language",$language["LANG_PHI"]);
      else if ($row["language"] == "15")
         $torrenttpl->set("language",$language["LANG_POL"]);
      else if ($row["language"] == "16")
         $torrenttpl->set("language",$language["LANG_POR"]);
      else if ($row["language"] == "17")
         $torrenttpl->set("language",$language["LANG_SLO"]);
      else if ($row["language"] == "18")
         $torrenttpl->set("language",$language["LANG_RUS"]);
      else if ($row["language"] == "19")
         $torrenttpl->set("language",$language["LANG_CAS"]);
      else if ($row["language"] == "20")
         $torrenttpl->set("language",$language["LANG_SWE"]);
      else if ($row["language"] == "21")
         $torrenttpl->set("language",$language["LANG_TUR"]);
      else if ($row["language"] == "22")
         $torrenttpl->set("language",$language["LANG_DAN"]);
      else if ($row["language"] == "23")
         $torrenttpl->set("language",$language["LANG_CZE"]);
      else if ($row["language"] == "24")
         $torrenttpl->set("language",$language["LANG_CHI"]);
      else if ($row["language"] == "25")
         $torrenttpl->set("language",$language["LANG_BUL"]);
      else if ($row["language"] == "26")
         $torrenttpl->set("language",$language["LANG_ARA"]);
      else if ($row["language"] == "27")
         $torrenttpl->set("language",$language["LANG_VIE"]);
   }

   $torrenttpl->set("comments",$comments);
   $torrenttpl->set("files",$dfiles);
   $torrenttpl->set("thanks_enabled",(($btit_settings["fmhack_torrent_thanks"]=="enabled")?true:false),true);
   $torrenttpl->set("dlratiocheck",(($btit_settings["fmhack_download_ratio_checker"]=="enabled")?true:false),true);
   $torrenttpl->set("teams_enabled",(($btit_settings["fmhack_teams"]=="enabled")?true:false),true);
   $torrenttpl->set("lock_comments_enabled",(($btit_settings["fmhack_lock_comments"]=="enabled")?true:false),true);
   $torrenttpl->set("vedsc_enabled_1",(($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"]=="enabled")?true:false),true);
   $torrenttpl->set("vedsc_enabled_2",(($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"]=="enabled")?true:false),true);
   $torrenttpl->set("vedsc_enabled_3",(($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"]=="enabled")?true:false),true);
   $torrenttpl->set("p_top",(($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"]=="enabled")?$pagertop:""));
   $torrenttpl->set("p_bottom",(($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"]=="enabled")?$pagerbottom:""));
   $torrenttpl->set("pager1",(($btit_settings["fmhack_comments_layout"]=="enabled" && !empty($pagertop))?true:false),true);
   $torrenttpl->set("pager2",(($btit_settings["fmhack_comments_layout"]=="enabled" && !empty($pagerbottom))?true:false),true);
   $torrenttpl->set("com_lay_1",(($btit_settings["fmhack_comments_layout"]=="enabled")?true:false),true);
   $torrenttpl->set("id", $id);
   $torrenttpl->set("bookmark_enabled", (($btit_settings["fmhack_torrent_bookmark"]=="enabled")?true:false), true);
   $torrenttpl->set("avatar_signature_sync_enabled", (($btit_settings["fmhack_avatar_signature_sync"]=="enabled")?true:false), true);
   $torrenttpl->set("avatar_signature_sync_enabled_1", (($btit_settings["fmhack_avatar_signature_sync"]=="enabled")?true:false), true);
   $torrenttpl->set("addthis_enabled",(($btit_settings["fmhack_addthis"]=="enabled")?true:false),true);
   

   //Gift BON to Uploader Hack
   $tellen = 0;
   $tell = 0;

   $blasd = do_sqlquery("SELECT SUM(points) FROM {$TABLE_PREFIX}coins WHERE info_hash=".sqlesc($id));
   while($sdsa = $blasd->fetch_array()){
      $tellen = $sdsa['SUM(points)']or $tellen = 0;
      $lasd = do_sqlquery("SELECT points FROM {$TABLE_PREFIX}coins WHERE info_hash=".sqlesc($id)." AND userid=" .sqlesc($CURUSER["uid"]));
      $dsa = $lasd->fetch_assoc();
      $tell = $dsa['points']or $tell = 0;
   }

   $torrenttpl->set("coin", "In Total <b><font color=red>" . $tellen . "</b></font> Points given to this torrent of which <b><font color=red>" . $tell . "</b></font> from you.<br /><br />By clicking on the coins you can give bonus points to the uploader of this torrent.<br /><br />(This will be deducted from your available bonus points)<br /><br /><br />
      <a href='index.php?page=coins&id=$id&amp;points=10&amp;ix={$CURUSER['uid']}' class='hvr-buzz'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <img src='images/10coin.png' alt='10 Points' title='10 Points' border='0' /></a>
         &nbsp;<a href='index.php?page=coins&id=$id&amp;points=20&amp;ix={$CURUSER['uid']}'class='hvr-buzz'>
         <img src='images/20coin.png' alt='20 Points' title='20 Points' border='0' /></a>
         &nbsp;<a href='index.php?page=coins&id=$id&amp;points=50&amp;ix={$CURUSER['uid']}' class='hvr-buzz'>
         <img src='images/50coin.png' alt='50 Points' title='50 Points' border='0' /></a>
         &nbsp;<a href='index.php?page=coins&id=$id&amp;points=100&amp;ix={$CURUSER['uid']}' class='hvr-buzz'>
         <img src='images/100coin.png' alt='100 Points' title='100 Points' border='0' /></a>
         &nbsp;<a href='index.php?page=coins&id=$id&amp;points=200&amp;ix={$CURUSER['uid']}' class='hvr-buzz'>
         <img src='images/200coin.png' alt='200 Points' title='200 Points' border='0' /></a>
         &nbsp;<a href='index.php?page=coins&id=$id&amp;points=500&amp;ix={$CURUSER['uid']}' class='hvr-buzz'>
         <img src='images/500coin.png' alt='500 Points' title='500 Points' border='0' /></a>
         &nbsp;<a href='index.php?page=coins&id=$id&amp;points=1000&amp;ix={$CURUSER['uid']}' class='hvr-buzz'>
         <img src='images/1000coin.png' alt='1000 Points' title='1000 Points' border='0' /></a>", 1);
   //Gift BON to Uploader Hack

   //Internal clock Hack
   if(internal_check($row['category'])){
      $clocktime=do_sqlquery("select UNIX_TIMESTAMP(now()) as now, UNIX_TIMESTAMP(data) as data, UNIX_TIMESTAMP((data + INTERVAL 1 DAY)) as done, filename FROM {$TABLE_PREFIX}files WHERE info_hash='".sql_esc($id)."'")->fetch_assoc();
      $clocknow=$clocktime['now']-$offset;
      $clockup=$clocktime['data']-$offset;
      $clockdone=$clocktime['done']-$offset;
      $torrenttpl->set("internal_clock",true,true);
      $torrenttpl->set("timenow",$clocknow);
      $torrenttpl->set("timeup",$clockup);
      $torrenttpl->set("timedone",$clockdone);
   }else{
      $torrenttpl->set("internal_clock",false,true);
   }
   unset($clocktime); unset($clocknow); unset($clockup); unset($clockdone);
   //Internal clock hack

   // cover/artwork section by medishack
   $artq = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}covers WHERE imdb=".$row['imdb']."");
   $artc = sql_num_rows($artq);
   
   $coverquery = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}covers");
   $covernum = sql_num_rows($coverquery);

   if ($artc == 0)
   {
      $artwork = "No Covers/Artwork currently available for this torrent <a href='index.php?page=modules&module=covers'>View other available covers/artwork {$covernum} available</a>";
   }else{
      $artwork = ""; 
      while ($artr = $artq->fetch_array()) 
      {
         $loc = "covers/".$artr['filename'];
         $name = $artr['name']." - ".$artr['type'] ." ". $artr['scan'];
         $desc = $artr['name'] . " - Width = " .$artr['width']. "px Height = " . $artr['height'] ."px";
         $artwork .= "<a href='covers/download.php?img={$artr['filename']}&name={$name}'><img src='coverthumb.php?file={$loc}&maxw=400&maxh=150' alt='{$desc}' title='{$desc}' border='0' /></a>&nbsp; &nbsp;";   
      }
      
      $artwork .= "<br /><br /><a href='index.php?page=modules&module=covers'>View other available covers/artwork {$covernum} available</a>";
   }  
   $torrenttpl->set("covers",$artwork);
// cover/artwork section by medishack

// add streaming
   $streaming = "";
   if ($CURUSER['can_stream'] == 'yes'){
   // only allow vip to see the stream link
      $query = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}stream WHERE imdb = {$row["imdb"]}");
      $rows = $query->fetch_array();
      if ($rows > 0)
         $streaming .= "<a href=\"index.php?page=modules&module=video_player&id={$row["imdb"]}\"><img src=\"images/stream_now.png\" /></a>";
      else
         $streaming .= "This title is currently not available try later";
   }

   if ($CURUSER['can_stream'] == 'no'){
      $streaming .= "Your user group is not enabled for streaming you need to be VIP <a href='index.php?page=modules&module=video_player&id=1'>Click Here to Watch the Promo</a>";
   }

   $torrenttpl->set("streaming",$streaming);
// add streaming

   ?>
