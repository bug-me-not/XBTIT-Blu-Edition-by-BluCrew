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

$scriptname = htmlspecialchars($_SERVER["PHP_SELF"]."?page=upload");
$addparam = "";
require load_language("lang_upload.php");
require_once "include/BDecode.php";
require_once "include/BEncode.php";
//// Configuration//
if(!function_exists("sha1"))
stderr($language["ERROR"], $language["NOT_SHA"]);
if($btit_settings["fmhack_archive_torrents"]=="enabled")
{
   if(($CURUSER["up_new"]=="no" && $CURUSER["up_arc"]=="no") || $CURUSER["can_upload"] == "no")
   stderr($language["SORRY"], $language["ERROR"].$language["NOT_AUTHORIZED_UPLOAD"]);
}
else
{
   if(!$CURUSER || $CURUSER["can_upload"] == "no")
   stderr($language["SORRY"], $language["ERROR"].$language["NOT_AUTHORIZED_UPLOAD"]);
}
if($btit_settings["fmhack_allow_and_disallow_users_to_up_and_download"] == "enabled")
{
   if($CURUSER["allowupload"] == "no")
   stderr($language["SORRY"], $language["ERROR"]);
}
if(isset($_FILES["torrent"]))
{
   if($_FILES["torrent"]["error"] != 4)
   {
      ##############################################################
      # Nfo hack -->
      if($btit_settings["fmhack_NFO_uploader_-_viewer"] == "enabled")
      {
         $HTTP_POST_FILES["nfo"]["tmp_name"] = str_replace("\\", "/", $HTTP_POST_FILES["nfo"]["tmp_name"]);
         $_FILES["nfo"]["tmp_name"] = str_replace("\\", "/", $_FILES["nfo"]["tmp_name"]);
         if((isset($_FILES["nfo"]["tmp_name"]) && !empty($_FILES["nfo"]["tmp_name"])) && (isset($_FILES["nfo"]["name"]) && !empty($_FILES["nfo"]["name"])))
         {
            $check_nfo = check_upload($_FILES["nfo"]["tmp_name"], $_FILES["nfo"]["name"]);
            switch($check_nfo)
            {
               case 1:
               case 2:
               $check_nfo_err = $language["ERR_MISSING_DATA"];
               if(file_exists($_FILES["nfo"]["tmp_name"]))
               @unlink($_FILES["nfo"]["tmp_name"]);
               break;
               case 3:
               $check_nfo_err = $language["QUAR_TMP_FILE_MISS"];
               break;
               case 4:
               $check_nfo_err = $language["QUAR_OUTPUT"];
               break;
               case 5:
               default:
               $check_nfo_err = "";
               break;
            }
            if($check_nfo_err != "")
            stderr($language["ERROR"], $check_nfo_err);
         }
         $nfo = $_FILES["nfo"]["tmp_name"];
         $nfocheck = basename($_FILES['nfo']['name']);
         $ext = strrchr($nfocheck, '.');
         $limitedext = array(".nfo");
         if($nfocheck)
         {
            if(!in_array(strtolower($ext), $limitedext))
            $error["nfo"] = stderr($language["ERROR"], $language["NFO_NOT_NFO"]);
            if($_FILES['nfo']['size'] < "128")
            $error["nfo"] = stderr($language["ERROR"], $language["NFO_NOT_VALID"]);
         }
      }
      # End
      ########################################################## -->
      $fd = fopen($_FILES["torrent"]["tmp_name"], "rb") or stderr($language["ERROR"], $language["FILE_UPLOAD_ERROR_1"]);
      is_uploaded_file($_FILES["torrent"]["tmp_name"]) or stderr($language["ERROR"], $language["FILE_UPLOAD_ERROR_2"]);
      if((isset($_FILES["torrent"]["tmp_name"]) && !empty($_FILES["torrent"]["tmp_name"])) && (isset($_FILES["torrent"]["name"]) && !empty($_FILES["torrent"]["name"])))
      {
         $check_torr = check_upload($_FILES["torrent"]["tmp_name"], $_FILES["torrent"]["name"]);
         switch($check_torr)
         {
            case 1:
            case 2:
            $check_torr_err = $language["ERR_MISSING_DATA"];
            if(file_exists($_FILES["torrent"]["tmp_name"]))
            @unlink($_FILES["torrent"]["tmp_name"]);
            break;
            case 3:
            $check_torr_err = $language["QUAR_TMP_FILE_MISS"];
            break;
            case 4:
            $check_torr_err = $language["QUAR_OUTPUT"];
            break;
            case 5:
            default:
            $check_torr_err = "";
            break;
         }
         if($check_torr_err != "")
         stderr($language["ERROR"], $check_torr_err);
      }
      $length = filesize($_FILES["torrent"]["tmp_name"]);
      if($length)
      $alltorrent = fread($fd, $length);
      else
      {
         err_msg($language["ERROR"], $language["FILE_UPLOAD_ERROR_3"]);
         stdfoot();
         exit();
      }
      $array = BDecode($alltorrent);
      if(!isset($array))
      {
         err_msg($language["ERROR"], $language["ERR_PARSER"]);
         stdfoot();
         exit();
      }
      if(!$array)
      {
         err_msg($language["ERROR"], $language["ERR_PARSER"]);
         stdfoot();
         exit();
      }
      if($btit_settings["fmhack_auto_announce"] == "enabled")
      {
         $array["announce"] = $TRACKER_ANNOUNCEURLS[0];
         unset($array["announce-list"]);
         /*
         This will force a change to the info_hash making sure it won't
         match the info_hash from the site it was downloaded from.
         */
         $array["info"]["source"] = $SITENAME;
         $array["info"]["trackedby"] = $BASEURL;
      }
      if(in_array($array["announce"], $TRACKER_ANNOUNCEURLS) && $DHT_PRIVATE)
      {
         $array["info"]["private"] = 1;
         $hash = sha1(BEncode($array["info"]));
      }
      else
      {
         $hash = sha1(BEncode($array["info"]));
      }
      fclose($fd);
   }
   if(isset($_POST["filename"])) 
   $filename = sql_esc(html_parse($_POST["filename"]));
   else
   $filename = sql_esc(html_parse($_FILES["torrent"]["name"]));

   if($btit_settings["fmhack_direct_download"] == "enabled" && $CURUSER["add_ddl"] == "yes")
   {
      (isset($_POST["direct_link"]) && !empty($_POST["direct_link"]))?$direct_link = $_POST["direct_link"]:$direct_link = false;
      if($direct_link && !preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $direct_link))
         $direct_link = false;
         else
         $direct_link = sql_esc($direct_link);
      }
      if($btit_settings["fmhack_torrent_moderation"] == "enabled")
      {
         if(isset($_POST["moder"]))
         {
            if($CURUSER['moderate_trusted'] == 'yes' || $CURUSER['trusted'] == 'yes')
            $moder = (($CURUSER['moderate_trusted'] == 'yes')?sql_esc($_POST['moder']):"ok");
            else
            $moder = 'um';
         }
         else
         $moder = "um";
      }
      if($btit_settings["fmhack_torrent_nuked_and_requested"] == "enabled")
      {
         //Torrent Nuke/Req Hack Start
         $req = sqlesc($_POST["req"]);
         $nuk = sqlesc($_POST["nuk"]);
         if($nuke != "false")
         $nuk_rea = sqlesc(htmlspecialchars($_POST["nuk_rea"]));
         else
         $nuk_rea = '';

         //Torrent Nuke/Req Hack Stop
      }
      if($btit_settings["fmhack_extended_torrent_description"] == "enabled")
      {
         # get config
         $xtdfig_db = get_khez_config("SELECT `key`,`value` FROM `{$TABLE_PREFIX}khez_configs` WHERE `key` LIKE 'xtd_%' LIMIT 7;", $reload_cfg_interval);
         # get langs
         require (load_language('lang_xtd.php'));
         if($xtdfig_db['xtd_enabled'])
         {
            # internal torrent ?
            $internal = false;
            if(isset($array['announce-list']))
            {
               foreach($array['announce-list'][0] as $tracker)
               if(in_array($tracker, $TRACKER_ANNOUNCEURLS))
               {
                  $internal = true;
                  break;
               }
            }
            elseif(in_array($array['announce'], $TRACKER_ANNOUNCEURLS))
            {
               $internal = true;
            }
            # search for file only if internal
            $file = $xtdfig_db['xtd_file'];
            if(($file != '') && ($internal))
            {
               $tors = array();
               if(isset($array['info']['files']))
               {
                  $tors = $array['info']['files']; # multi file up
               }
               elseif(isset($array['info']['name']))
               {
                  $tors['path'][0] = $array['info']['name']; # single file up
               }
               else
               {
                  # wrong decoding ?
               }
               switch($xtdfig_db['xtd_loc'])
               {
                  case 0:
                  $regexp = '/^'.$file.'$/';
                  break;
                  case 1:
                  $regexp = '/^'.$file.'/';
                  break;
                  case 2:
                  $regexp = '/'.$file.'$/';
                  break;
                  default:
                  $regexp = '/'.$file.'/';
               }
               $insens = ($xtdfig_db['xtd_casesens'])?'':'i';
               foreach($tors as $torfile)
               {
                  if(preg_match($regexp.$insens, $torfile['path'][0]))
                  {
                     $found_it = true;
                     break;
                  }
               }
               if(!isset($found_it))
               stderr($language['ERROR'], sprintf($language['XTD_ERROR_FILE'], $file));
            }
            # create bbcode test array
            $bbcodes = array();
            if($xtdfig_db['xtd_img'] != 0)
            $bbcodes[] = array('name' => 'img', 'min' => $xtdfig_db['xtd_img']);
            if($xtdfig_db['xtd_url'] != 0)
            $bbcodes[] = array('name' => 'url', 'min' => $xtdfig_db['xtd_url']);
            # test bbcode
            $lowercase_info = strtolower($_POST['info']);
            foreach($bbcodes as $bbcode)
            {
               if(substr_count($lowercase_info, '['.$bbcode['name']) < $bbcode['min'])
               stderr($language['ERROR'], sprintf($language['XTD_ERROR_TAGS'], $bbcode['min'], $bbcode['name']));
            }
            # test length
            if($xtdfig_db['xtd_chars'] != 0)
            {
               if(strlen($_POST['info']) < $xtdfig_db['xtd_chars'])
               stderr($language['ERROR'], sprintf($language['XTD_ERROR_CHARS'], $xtdfig_db['xtd_chars']));
            }
         }
      }
      if($btit_settings["fmhack_getIMDB_in_torrent_details"] == "enabled")
      {
         if(isset($_POST["imdb"])&&$_POST["imdb"]!="")
         $imdb = sql_esc(htmlspecialchars($_POST["imdb"]));
         else
         $imdb = 0;
         //maybe lazy user so lets see if its in the description
         if($imdb == 0)
         {
            preg_match("#http://www.imdb.com/title/tt([0-9]*)#", $_POST["info"], $matches);
            if(!empty($matches[0]))
            {
               $matches[0] = str_replace("http://www.imdb.com/title/tt", "", $matches[0]);
               $imdb = sql_esc($matches[0]);
            }
         }
      }
      if($btit_settings["fmhack_grab_images_from_theTVDB"]=="enabled")
      {
         $tvdb_number=(isset($_POST["tvdb_number"]) && !empty($_POST["tvdb_number"])) ? (int)0+$_POST["tvdb_number"] : 0;
         $SeasonAndEpisode=array();
         $theTVDBExtra=array();
         $selected_category=intval(0 + $_POST["category"]);
         $tvdb_catlist=(isset($btit_settings["tvdb_cats"]) && !empty($btit_settings["tvdb_cats"]))?explode(",", $btit_settings["tvdb_cats"]):array(0 => "all");

         require_once dirname(__file__)."/include/class.tvdb.php";
         $tvdb_api_key="84198CDB1D6D23DE";
         require_once dirname(__FILE__)."/include/class.fanart.php";
         $fanart_api_key="05e03e4887f762022f945ee1d27ca627";

         if($tvdb_number>0)
         {
            $tvdb=new tvdb($tvdb_number,$tvdb_api_key);

            if($tvdb->fetch())
            {
               if($tvdb->fetch(TRUE))
               {
                  if($btit_settings["fmhack_getIMDB_in_torrent_details"] == "disabled" || ($btit_settings["fmhack_getIMDB_in_torrent_details"] == "enabled" && $imdb==0))
                  {
                     $imdb=(($tvdb->getimdb()>0)?$tvdb->getimdb():0);
                  }

                  $tvdb_banners=$tvdb->get5banners();
                  $tvdb_banner_number=count($tvdb_banners);

                  if(!file_exists($THIS_BASEPATH."/thetvdb/".$tvdb_number))
                  mkdir($THIS_BASEPATH."/thetvdb/".$tvdb_number);
                  if(!file_exists($THIS_BASEPATH."/thetvdb/".$tvdb_number."/banners"))
                  mkdir($THIS_BASEPATH."/thetvdb/".$tvdb_number."/banners");

                  if($tvdb_banner_number!=null || $tvdb_banner_number>0)
                  {
                     foreach($tvdb_banners as $value)
                     {
                        $imageFilename=explode("/", $value);
                        $lastIamgeKey=(count($imageFilename)-1);
                        if(!file_exists($THIS_BASEPATH."/thetvdb/".$tvdb_number."/banners/".$imageFilename[$lastIamgeKey]))
                        {
                           save_image($value, $THIS_BASEPATH."/thetvdb/".$tvdb_number."/banners/".$imageFilename[$lastIamgeKey]);
                        }
                     }
                  }else{
                     //TVDB Api has no available Banners
                  }
               }else{
                  //TVDB Fetch Banners has failed.
               }
            }else{
               //TVDB Fetch Data has failed.
            }

            $tvdb=null;

            $fanart=new fanart($tvdb_number,$fanart_api_key);

            if($fanart->fetch(TRUE))
            {
               $fanart_banners=$fanart->gettvbanner();
               $fanart_banner_number=count($fanart_banners);

               if(!file_exists($THIS_BASEPATH."/fanart/thetvdb"))
               mkdir($THIS_BASEPATH."/fanart/thetvdb");
               if(!file_exists($THIS_BASEPATH."/fanart/thetvdb/".$tvdb_number))
               mkdir($THIS_BASEPATH."/fanart/thetvdb/".$tvdb_number);
               if(!file_exists($THIS_BASEPATH."/fanart/thetvdb/".$tvdb_number."/banners"))
               mkdir($THIS_BASEPATH."/fanart/thetvdb/".$tvdb_number."/banners");

               if($fanart_banner_number>0)
               {
                  foreach($fanart_banners as $value)
                  {
                     $imageFilename=explode("/", $value);
                     $lastIamgeKey=(count($imageFilename)-1);
                     if(!file_exists($THIS_BASEPATH."/fanart/thetvdb/".$tvdb_number."/banners/".$imageFilename[$lastIamgeKey]))
                     {
                        save_image($value, $THIS_BASEPATH."/fanart/thetvdb/".$tvdb_number."/banners/".$imageFilename[$lastIamgeKey]);
                     }
                  }
               }else{
                  //Fanart API has returned no Banners.
               }
            }else{
               //FanART API Fetch TV Series has failed.
            }
         }else{
            ////No theTVDB ID present on torrent.
         }

         $fanart=null;
         if($imdb>0)
         {
            $fanart=new fanart(("tt".$imdb),$fanart_api_key);

            if($fanart->fetch())
            {
               $fanart_banners=$fanart->getmoviebanner();
               $fanart_banner_number=count($fanart_banners);

               $fanart_id="tt".$fanart->getimdb();

               if(!file_exists($THIS_BASEPATH."/fanart/imdb"))
               mkdir($THIS_BASEPATH."/fanart/imdb");
               if(!file_exists($THIS_BASEPATH."/fanart/imdb/".$fanart_id))
               mkdir($THIS_BASEPATH."/fanart/imdb/".$fanart_id);
               if(!file_exists($THIS_BASEPATH."/fanart/imdb/".$fanart_id."/banners"))
               mkdir($THIS_BASEPATH."/fanart/imdb/".$fanart_id."/banners");

               if($fanart_banner_number>0)
               {
                  foreach($fanart_banners as $value)
                  {
                     $imageFilename=explode("/", $value);
                     $lastIamgeKey=(count($imageFilename)-1);
                     if(!file_exists($THIS_BASEPATH."/fanart/imdb/".$fanart_id."/banners/".$imageFilename[$lastIamgeKey]))
                     {
                        save_image($value, $THIS_BASEPATH."/fanart/imdb/".$fanart_id."/banners/".$imageFilename[$lastIamgeKey]);
                     }
                  }
               }else{
                  //Fanart API has returned no Banners
               }
            }else{
               //Fanart Fetch Movies has failed.
            }
         }else{
            //No IMDB ID present on torrent.
         }
         $fanart=null;
      }
      if(isset($hash) && $hash)
      $url = $TORRENTSDIR."/".$hash.".btf";
      else
      $url = 0;
      if($btit_settings["fmhack_staff_comment_in_torrent_details"] == "enabled")
      {
         if(isset($_POST["staff_comment"]))
         $staff_comment = sql_esc(htmlspecialchars($_POST["staff_comment"]));
         else
         $staff_comment = "";
      }
      if($btit_settings["fmhack_sticky_torrent"] == "enabled")
      {
         /*Mod by losmi - sticky mod
         Operation #1*/
         if(isset($_POST["sticky"]) && $_POST["sticky"] == 'on')
         $sticky = 1;
         else
         $sticky = 0;
         /*End mod by losmi - sticky mod
         End Operation #1*/
      }
      if($btit_settings["fmhack_show_if_seedbox_is_used"] == "enabled")
      {
         // seedbox start
         if(isset($_POST["seedbox"]) && $_POST["seedbox"] == 'on')
         $seedbox = 1;
         else
         $seedbox = 0;
         // seedbox end
      }
      //mod gold
      $gold = 0;
      //setting gold post var
      if($btit_settings["fmhack_gold_and_silver_torrents"] == "enabled")
      {
         if(isset($_POST["gold"]) && $_POST["gold"] != '')
         $gold = sql_esc($_POST["gold"]);
      }
      //end gold mod
      if($btit_settings["fmhack_upload_multiplier"] == "enabled")
      {
         (isset($_POST["multiplier"]) && is_numeric($_POST["multiplier"]) && $_POST["multiplier"] >= 1 && $_POST["multiplier"] <= 10)?$multiplier = (int)0 + $_POST["multiplier"]:$multiplier = 1;
      }
      if(isset($_POST["info"]) && $_POST["info"] != "")
      $comment = sql_esc($_POST["info"]);
      else
      { // description is now required (same as for edit.php)
         //    $comment = "";
         err_msg($language["ERROR"], $language["EMPTY_DESCRIPTION"]);
         stdfoot();
         exit();
      }
      if($btit_settings["fmhack_torrent_details_media_player"] == "enabled")
      {
         if(isset($_POST["mplayer"]))
         $mplayer = sql_esc(htmlspecialchars($_POST["mplayer"]));
      }
      if($btit_settings["fmhack_language_in_torrent_list_and_details"] == "enabled")
      {
         $torlang = (int)0 + $_POST["language"];
      }
      // filename not writen by user, we get info directly from torrent.
      if(strlen($filename) == 0 && isset($array["info"]["name"]))
      $filename = sql_esc(htmlspecialchars($array["info"]["name"]));
      // description not writen by user, we get info directly from torrent.
      if(isset($array["comment"]))
      $info = sql_esc(htmlspecialchars($array["comment"]));
      else
      $info = "";
      if(isset($array["info"]) && $array["info"])
      $upfile = $array["info"];
      else
      $upfile = 0;
      if(isset($upfile["length"]))
      {
         $size = (float)($upfile["length"]);
      }
      else
      if(isset($upfile["files"]))
      {
         // multifiles torrent
         $size = 0;
         foreach($upfile["files"] as $file)
         {
            $size += (float)($file["length"]);
         }
      }
      else
      $size = "0";
      if(!isset($array["announce"]))
      {
         err_msg($language["ERROR"], $language["EMPTY_ANNOUNCE"]);
         stdfoot();
         exit();
      }
      $categoria = intval(0 + $_POST["category"]);
      $release_group= intval(0+$_POST['release_group']);
      $team = (isset($_POST["team"]) && !empty($_POST["team"])) ? intval(0 + $_POST["team"]) : 0;
      $anonyme = sqlesc($_POST["anonymous"]);
      $curuid = intval($CURUSER["uid"]);
      $forumid = 0;
      // category check
      $rc = get_result("SELECT `id`".(($btit_settings["fmhack_forum_auto_topic"] == "enabled" && $btit_settings["smf_autotopic"] == "true")?", `forumid`":"")." FROM `{$TABLE_PREFIX}categories` WHERE `id`=$categoria", true,
      $btit_settings["cache_duration"]);
      if(count($rc) == 0)
      {
         err_msg($language["ERROR"], $language["WRITE_CATEGORY"]);
         stdfoot();
         exit();
      }
      else
      {
         if($btit_settings["fmhack_forum_auto_topic"] == "enabled" && $btit_settings["smf_autotopic"] == "true")
         {
            $forumid = $rc[0]["forumid"];
         }
      }
      unset($rc);
      if($btit_settings["fmhack_teams"] == "enabled")
      {
         // team check
         $rt = do_sqlquery("SELECT id FROM {$TABLE_PREFIX}teams WHERE id=$team", true);
         if(sql_num_rows($rt) == 0)
         {
            err_msg($language["ERROR"], "Team id wrong!");
            stdfoot();
            exit();
         }
         @$rt->free();
      }
      $announce = trim($array["announce"]);
      if($btit_settings["fmhack_upload_multiplier"] == "enabled")
      {
         if(!in_array($announce, $TRACKER_ANNOUNCEURLS))
         $multiplier = 1;
      }
      if($categoria == 0)
      {
         err_msg($language["ERROR"], $language["WRITE_CATEGORY"]);
         stdfoot();
         exit();
      }
      if((strlen($hash) != 40) || !verifyHash($hash))
      {
         err_msg($language["ERROR"], $language["ERR_HASH"]);
         stdfoot();
         exit();
      }
      if(!in_array($announce, $TRACKER_ANNOUNCEURLS) && !$EXTERNAL_TORRENTS)
      {
         err_msg($language["ERROR"], $language["ERR_EXTERNAL_NOT_ALLOWED"]);
         unlink($_FILES["torrent"]["tmp_name"]);
         stdfoot();
         exit();
      }
      if($btit_settings["fmhack_permissions_for_external_torrents"]=="enabled")
      {
         if(!in_array($announce, $TRACKER_ANNOUNCEURLS) && $EXTERNAL_TORRENTS && $CURUSER["external_upload"]=="no")
         {
            err_msg($language["ERROR"], $language["PFET_NO_UPLOAD_1"].unesc($CURUSER["prefixcolor"].$CURUSER["level"].$CURUSER["suffixcolor"]).$language["PFET_NO_UPLOAD_2"]);
            unlink($_FILES["torrent"]["tmp_name"]);
            stdfoot();
            exit();
         }
      }
      // Image Upload -->
      $file_name = '';
      $file_name_s1 = '';
      $file_name_s2 = '';
      $file_name_s3 = '';
      if($btit_settings["fmhack_torrent_image_upload"] == "enabled")
      {
         $userfile = $_FILES["userfile"];
         if((isset($userfile["tmp_name"]) && !empty($userfile["tmp_name"])) && (isset($userfile["name"]) && !empty($userfile["name"])))
         {
            $check_userfile = check_upload($userfile["tmp_name"], $userfile["name"]);
            switch($check_userfile)
            {
               case 1:
               case 2:
               $check_userfile_err = $language["ERR_MISSING_DATA"];
               if(file_exists($userfile["tmp_name"]))
               @unlink($userfile["tmp_name"]);
               break;
               case 3:
               $check_userfile_err = $language["QUAR_TMP_FILE_MISS"];
               break;
               case 4:
               $check_userfile_err = $language["QUAR_OUTPUT"];
               break;
               case 5:
               default:
               $check_userfile_err = "";
               break;
            }
            if($check_userfile_err != "")
            stderr($language["ERROR"], $check_userfile_err);
         }
         $screen1 = $_FILES["screen1"];
         if((isset($screen1["tmp_name"]) && !empty($screen1["tmp_name"])) && (isset($screen1["name"]) && !empty($screen1["name"])))
         {
            $check_screen1 = check_upload($screen1["tmp_name"], $screen1["name"]);
            switch($check_screen1)
            {
               case 1:
               case 2:
               $check_screen1_err = $language["ERR_MISSING_DATA"];
               if(file_exists($screen1["tmp_name"]))
               @unlink($screen1["tmp_name"]);
               break;
               case 3:
               $check_screen1_err = $language["QUAR_TMP_FILE_MISS"];
               break;
               case 4:
               $check_screen1_err = $language["QUAR_OUTPUT"];
               break;
               case 5:
               default:
               $check_screen1_err = "";
               break;
            }
            if($check_screen1_err != "")
            stderr($language["ERROR"], $check_screen1_err);
         }
         $screen2 = $_FILES["screen2"];
         if((isset($screen2["tmp_name"]) && !empty($screen2["tmp_name"])) && (isset($screen2["name"]) && !empty($screen2["name"])))
         {
            $check_screen2 = check_upload($screen2["tmp_name"], $screen2["name"]);
            switch($check_screen2)
            {
               case 1:
               case 2:
               $check_screen2_err = $language["ERR_MISSING_DATA"];
               if(file_exists($screen2["tmp_name"]))
               @unlink($screen2["tmp_name"]);
               break;
               case 3:
               $check_screen2_err = $language["QUAR_TMP_FILE_MISS"];
               break;
               case 4:
               $check_screen2_err = $language["QUAR_OUTPUT"];
               break;
               case 5:
               default:
               $check_screen2_err = "";
               break;
            }
            if($check_screen2_err != "")
            stderr($language["ERROR"], $check_screen2_err);
         }
         $screen3 = $_FILES["screen3"];
         if((isset($screen3["tmp_name"]) && !empty($screen3["tmp_name"])) && (isset($screen3["name"]) && !empty($screen3["name"])))
         {
            $check_screen3 = check_upload($screen3["tmp_name"], $screen3["name"]);
            switch($check_screen3)
            {
               case 1:
               case 2:
               $check_screen3_err = $language["ERR_MISSING_DATA"];
               if(file_exists($screen3["tmp_name"]))
               @unlink($screen3["tmp_name"]);
               break;
               case 3:
               $check_screen3_err = $language["QUAR_TMP_FILE_MISS"];
               break;
               case 4:
               $check_screen3_err = $language["QUAR_OUTPUT"];
               break;
               case 5:
               default:
               $check_screen3_err = "";
               break;
            }
            if($check_screen3_err != "")
            stderr($language["ERROR"], $check_screen3_err);
         }
         $image_types = array(
            "image/bmp",
            "image/jpeg",
            "image/pjpeg",
            "image/gif",
            "image/x-png",
            "image/png");
            switch($_FILES["userfile"]["type"])
            {
               case 'image/bmp':
               $file_name = $hash.".bmp";
               break;
               case 'image/jpeg':
               $file_name = $hash.".jpg";
               break;
               case 'image/pjpeg':
               $file_name = $hash.".jpeg";
               break;
               case 'image/gif':
                  $file_name = $hash.".gif";
                  break;
                  case 'image/x-png':
                  $file_name = $hash.".png";
                  break;
                  case 'image/png':
                  $file_name = $hash.".png";
                  break;
               }
               switch($_FILES["screen1"]["type"])
               {
                  case 'image/bmp':
                  $file_name_s1 = "s1".$hash.".bmp";
                  break;
                  case 'image/jpeg':
                  $file_name_s1 = "s1".$hash.".jpg";
                  break;
                  case 'image/pjpeg':
                  $file_name_s1 = "s1".$hash.".jpeg";
                  break;
                  case 'image/gif':
                     $file_name_s1 = "s1".$hash.".gif";
                     break;
                     case 'image/x-png':
                     $file_name_s1 = "s1".$hash.".png";
                     break;
                     case 'image/png':
                     $file_name_s1 = "s1".$hash.".png";
                     break;
                  }
                  switch($_FILES["screen2"]["type"])
                  {
                     case 'image/bmp':
                     $file_name_s2 = "s2".$hash.".bmp";
                     break;
                     case 'image/jpeg':
                     $file_name_s2 = "s2".$hash.".jpg";
                     break;
                     case 'image/pjpeg':
                     $file_name_s2 = "s2".$hash.".jpeg";
                     break;
                     case 'image/gif':
                        $file_name_s2 = "s2".$hash.".gif";
                        break;
                        case 'image/x-png':
                        $file_name_s2 = "s2".$hash.".png";
                        break;
                        case 'image/png':
                        $file_name_s2 = "s2".$hash.".png";
                        break;
                     }
                     switch($_FILES["screen3"]["type"])
                     {
                        case 'image/bmp':
                        $file_name_s3 = "s3".$hash.".bmp";
                        break;
                        case 'image/jpeg':
                        $file_name_s3 = "s3".$hash.".jpg";
                        break;
                        case 'image/pjpeg':
                        $file_name_s3 = "s3".$hash.".jpeg";
                        break;
                        case 'image/gif':
                           $file_name_s3 = "s3".$hash.".gif";
                           break;
                           case 'image/x-png':
                           $file_name_s3 = "s3".$hash.".png";
                           break;
                           case 'image/png':
                           $file_name_s3 = "s3".$hash.".png";
                           break;
                        }
                        $uploadfile = $GLOBALS["uploaddir"].$file_name;
                        $uploadfile1 = $GLOBALS["uploaddir"].$file_name_s1;
                        $uploadfile2 = $GLOBALS["uploaddir"].$file_name_s2;
                        $uploadfile3 = $GLOBALS["uploaddir"].$file_name_s3;
                        $file_size = $_FILES["userfile"]["size"];
                        $file_size1 = $_FILES["screen1"]["size"];
                        $file_size2 = $_FILES["screen2"]["size"];
                        $file_size3 = $_FILES["screen3"]["size"];
                        $file_type = $_FILES["userfile"]["type"];
                        $file_type1 = $_FILES["screen1"]["type"];
                        $file_type2 = $_FILES["screen2"]["type"];
                        $file_type3 = $_FILES["screen3"]["type"];
                        $file_size = makesize1($file_size);
                        $file_size1 = makesize1($file_size1);
                        $file_size2 = makesize1($file_size2);
                        $file_size3 = makesize1($file_size3);
                        if(isset($_FILES["userfile"]))
                        {
                           if($_FILES["userfile"]["name"] == '')
                           {
                              // do nothing...
                           }
                           else
                           {
                              if($file_size > $GLOBALS["file_limit"])
                              {
                                 err_msg($language["ERROR"], $language["FILE_UPLOAD_TO_BIG"].": ".$file_limit.". ".$language["IMAGE_WAS"].": ".$file_size);
                                 stdfoot();
                                 exit();
                              }
                              if(in_array(strtolower($file_type), $image_types, true))
                              {
                                 $img_info = @getimagesize($_FILES['userfile']['tmp_name']);
                                 if(isset($img_info) && is_array($img_info))
                                 {
                                    if($img_info[0] > $btit_settings["imgup_maxw"] || $img_info[1] > $btit_settings["imgup_maxh"])
                                    {
                                       err_msg($language["ERROR"], $language["IMGUP_DIM_TOO_BIG_1"]."<br /><br />".$btit_settings["imgup_maxw"]." X ".$btit_settings["imgup_maxh"]." ".$language["IMGUP_DIM_TOO_BIG_2"]."<br /><br />".$img_info[0].
                                       " X ".$img_info[1]." ".$language["IMGUP_DIM_TOO_BIG_3"]);
                                       stdfoot();
                                       exit();
                                    }
                                    if(@move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
                                    {
                                    }
                                    else
                                    {
                                       err_msg($language["ERROR"], $language["MOVE_IMAGE_TO"]." ".$GLOBALS["uploaddir"].". ".$language["CHECK_FOLDERS_PERM"]);
                                       stdfoot();
                                       exit();
                                    }
                                 }
                                 else
                                 {
                                    err_msg($language["ERROR"], $language["ILEGAL_UPLOAD"]);
                                    stdfoot();
                                    exit;
                                 }
                              }
                              else
                              {
                                 err_msg($language["ERROR"], $language["ILEGAL_UPLOAD"]);
                                 stdfoot();
                                 exit;
                              }
                           }
                        }
                        if(isset($_FILES["screen1"]))
                        {
                           if($_FILES["screen1"]["name"] == '')
                           {
                              // do nothing...
                           }
                           else
                           {
                              if($file_size1 > $GLOBALS["file_limit"])
                              {
                                 err_msg($language["ERROR"], $language["FILE_UPLOAD_TO_BIG"].": ".$file_limit.". ".$language["IMAGE_WAS"].": ".$file_size1);
                                 stdfoot();
                                 exit();
                              }
                              if(in_array(strtolower($file_type1), $image_types, true))
                              {
                                 $screen1_info = @getimagesize($_FILES['screen1']['tmp_name']);
                                 if(isset($screen1_info) && is_array($screen1_info))
                                 {
                                    if($screen1_info[0] > $btit_settings["imgup_maxw"] || $screen1_info[1] > $btit_settings["imgup_maxh"])
                                    {
                                       err_msg($language["ERROR"], $language["IMGUP_DIM_TOO_BIG_1"]."<br /><br />".$btit_settings["imgup_maxw"]." X ".$btit_settings["imgup_maxh"]." ".$language["IMGUP_DIM_TOO_BIG_2"]."<br /><br />".$img_info[0].
                                       " X ".$img_info[1]." ".$language["IMGUP_DIM_TOO_BIG_3"]);
                                       stdfoot();
                                       exit();
                                    }
                                    if(@move_uploaded_file($_FILES['screen1']['tmp_name'], $uploadfile1))
                                    {
                                    }
                                    else
                                    {
                                       err_msg($language["ERROR"], $language["MOVE_IMAGE_TO"]." ".$GLOBALS["uploaddir"].". ".$language["CHECK_FOLDERS_PERM"]);
                                       stdfoot();
                                       exit();
                                    }
                                 }
                                 else
                                 {
                                    err_msg($language["ERROR"], $language["ILEGAL_UPLOAD"]);
                                    stdfoot();
                                    exit;
                                 }
                              }
                           }
                        }
                        if(isset($_FILES["screen2"]))
                        {
                           if($_FILES["screen2"]["name"] == '')
                           {
                              // do nothing...
                           }
                           else
                           {
                              if($file_size2 > $GLOBALS["file_limit"])
                              {
                                 err_msg($language["ERROR"], $language["FILE_UPLOAD_TO_BIG"].": ".$file_limit.". ".$language["IMAGE_WAS"].": ".$file_size2);
                                 stdfoot();
                                 exit();
                              }
                              if(in_array(strtolower($file_type2), $image_types, true))
                              {
                                 $screen2_info = @getimagesize($_FILES['screen2']['tmp_name']);
                                 if(isset($screen2_info) && is_array($screen2_info))
                                 {
                                    if($screen2_info[0] > $btit_settings["imgup_maxw"] || $screen2_info[1] > $btit_settings["imgup_maxh"])
                                    {
                                       err_msg($language["ERROR"], $language["IMGUP_DIM_TOO_BIG_1"]."<br /><br />".$btit_settings["imgup_maxw"]." X ".$btit_settings["imgup_maxh"]." ".$language["IMGUP_DIM_TOO_BIG_2"]."<br /><br />".$img_info[0].
                                       " X ".$img_info[1]." ".$language["IMGUP_DIM_TOO_BIG_3"]);
                                       stdfoot();
                                       exit();
                                    }
                                    if(@move_uploaded_file($_FILES['screen2']['tmp_name'], $uploadfile2))
                                    {
                                    }
                                    else
                                    {
                                       err_msg($language["ERROR"], $language["MOVE_IMAGE_TO"]." ".$GLOBALS["uploaddir"].". ".$language["CHECK_FOLDERS_PERM"]);
                                       stdfoot();
                                       exit();
                                    }
                                 }
                                 else
                                 {
                                    err_msg($language["ERROR"], $language["ILEGAL_UPLOAD"]);
                                    stdfoot();
                                    exit;
                                 }
                              }
                           }
                        }
                        if(isset($_FILES["screen3"]))
                        {
                           if($_FILES["screen3"]["name"] == '')
                           {
                              // do nothing...
                           }
                           else
                           {
                              if($file_size3 > $GLOBALS["file_limit"])
                              {
                                 err_msg($language["ERROR"], $language["FILE_UPLOAD_TO_BIG"].": ".$file_limit.". ".$language["IMAGE_WAS"].": ".$file_size3);
                                 stdfoot();
                                 exit();
                              }
                              if(in_array(strtolower($file_type3), $image_types, true))
                              {
                                 $screen3_info = @getimagesize($_FILES['screen3']['tmp_name']);
                                 if(isset($screen3_info) && is_array($screen3_info))
                                 {
                                    if($screen3_info[0] > $btit_settings["imgup_maxw"] || $screen3_info[1] > $btit_settings["imgup_maxh"])
                                    {
                                       err_msg($language["ERROR"], $language["IMGUP_DIM_TOO_BIG_1"]."<br /><br />".$btit_settings["imgup_maxw"]." X ".$btit_settings["imgup_maxh"]." ".$language["IMGUP_DIM_TOO_BIG_2"]."<br /><br />".$img_info[0].
                                       " X ".$img_info[1]." ".$language["IMGUP_DIM_TOO_BIG_3"]);
                                       stdfoot();
                                       exit();
                                    }
                                    if(@move_uploaded_file($_FILES['screen3']['tmp_name'], $uploadfile3))
                                    {
                                    }
                                    else
                                    {
                                       err_msg($language["ERROR"], $language["MOVE_IMAGE_TO"]." ".$GLOBALS["uploaddir"].". ".$language["CHECK_FOLDERS_PERM"]);
                                       stdfoot();
                                       exit();
                                    }
                                 }
                                 else
                                 {
                                    err_msg($language["ERROR"], $language["ILEGAL_UPLOAD"]);
                                    stdfoot();
                                    exit;
                                 }
                              }
                           }
                        }
                     }

                     // <-- Image Upload
                     //      if ($announce!=$BASEURL."/announce.php")
                     $query1_insert_key = "";
                     $query1_insert_value = "";
                     $xbt_insert = "";
                     if($btit_settings["fmhack_show_if_seedbox_is_used"] == "enabled")
                     {
                        $query1_insert_key .= ", `seedbox`";
                        $query1_insert_value .= ", '".$seedbox."'";
                     }
                     if($btit_settings["fmhack_teams"] == "enabled")
                     {
                        $query1_insert_key .= ", `team`";
                        $query1_insert_value .= ", '".$team."'";
                     }
                     if($btit_settings["fmhack_upload_multiplier"] == "enabled")
                     {
                        $query1_insert_key .= ", `multiplier`";
                        $query1_insert_value .= ", '".$multiplier."'";
                        if($XBTT_USE && $multiplier > 1)
                        $xbt_insert .= ", up_multi='".($multiplier * 100)."'";
                     }
                     if($btit_settings["fmhack_torrent_moderation"] == "enabled")
                     {
                        $query1_insert_key .= ", `moder`";
                        $query1_insert_value .= ", '".$moder."'";
                     }
                     if($btit_settings["fmhack_sticky_torrent"] == "enabled")
                     {
                        if($sticky != 0)
                        {
                           $query1_insert_key .= ", `sticky`";
                           $query1_insert_value .= ", '".$sticky."'";
                        }
                     }
                     if($btit_settings["fmhack_gold_and_silver_torrents"] == "enabled")
                     {
                        $query1_insert_key .= ", `gold`";
                        $query1_insert_value .= ", '".$gold."'";
                     }
                     if($btit_settings["fmhack_torrent_image_upload"] == "enabled")
                     {
                        $query1_insert_key .= ", `image`, `screen1`, `screen2`, `screen3`";
                        $query1_insert_value .= ", '".$file_name."', '".$file_name_s1."', '".$file_name_s2."', '".$file_name_s3."'";
                     }
                     if($btit_settings["fmhack_torrent_nuked_and_requested"] == "enabled")
                     {
                        $query1_insert_key .= ", `nuked`, `requested`, `nuke_reason`";
                        $query1_insert_value .= ", ".$nuk.", ".$req.", ".$nuk_rea."";
                     }
                     if($btit_settings["fmhack_bonus_system"] == "enabled" && $btit_settings["upl_enable"] == "true")
                     {
                        $query1_insert_key .= ", `sbonus`";
                        $query1_insert_value .= ", '".$btit_settings["bonus_upl"]."'";
                     }
                     if($btit_settings["fmhack_getIMDB_in_torrent_details"] == "enabled")
                     {
                        $query1_insert_key .= ", `imdb`";
                        $query1_insert_value .= ", '".$imdb."'";
                     }
                     if($btit_settings["fmhack_staff_comment_in_torrent_details"] == "enabled")
                     {
                        $query1_insert_key .= ", `staff_comment`";
                        $query1_insert_value .= ", '".$staff_comment."'";
                     }
                     if($btit_settings["fmhack_direct_download"] == "enabled" && $CURUSER["add_ddl"] == "yes" && $direct_link)
                     {
                        $query1_insert_key .= ", `direct_download`";
                        $query1_insert_value .= ", '".$direct_link."'";
                     }
                     if($btit_settings["fmhack_multi_tracker_scrape"] == "enabled")
                     {
                        $announces = array();
                        for($i = 0; $i < count($array["announce-list"]); $i++)
                        {
                           $current = $array["announce-list"][$i];
                           if(is_array($current))
                           $announces[$current[0]] = array(
                              "seeds" => 0,
                              "leeches" => 0,
                              "downloaded" => 0);
                              else
                              $announces[$current] = array(
                                 "seeds" => 0,
                                 "leeches" => 0,
                                 "downloaded" => 0);
                              }
                              $announces[$announce] = array(
                                 "seeds" => 0,
                                 "leeches" => 0,
                                 "downloaded" => 0);
                                 $query1_insert_key .= ", `announces`";
                                 $query1_insert_value .= ", '".sql_esc(serialize($announces))."'";
                              }
                              if($btit_settings["fmhack_language_in_torrent_list_and_details"] == "enabled")
                              {
                                 $query1_insert_key .= ", `language`";
                                 $query1_insert_value .= ", '".$torlang."'";
                              }
                              if($btit_settings["fmhack_torrent_details_media_player"] == "enabled")
                              {
                                 $query1_insert_key .= ", `mplayer`";
                                 $query1_insert_value .= ", '".$mplayer."'";
                              }
                              if($btit_settings["fmhack_bump_torrents"] == "enabled")
                              {
                                 $query1_insert_key .= ", `bumpdate`";
                                 $query1_insert_value .= ", UNIX_TIMESTAMP()";
                              }
                              if($btit_settings["fmhack_archive_torrents"] == "enabled")
                              {
                                 $archive=(isset($_POST["arc_upload_type"]) && is_numeric($_POST["arc_upload_type"]) && $CURUSER["up_new"]=="yes" && $_POST["arc_upload_type"]==1) ? (int)0 : (int)1;
                                 $query1_insert_key .= ", `archive`";
                                 $query1_insert_value .= ", ".$archive;
                              }
                              if($btit_settings["fmhack_grab_images_from_theTVDB"]=="enabled")
                              {
                                 $query1_insert_key .= ", `tvdb_id`".((isset($tvdb_extra) && !empty($tvdb_extra))?", `tvdb_extra`":"");
                                 $query1_insert_value .= ", '".$tvdb_number."'".((isset($tvdb_extra) && !empty($tvdb_extra))?", '".$tvdb_extra."'":"");
                              }
                              if($btit_settings["fmhack_magnet_links"] == "enabled" && !$DHT_PRIVATE && !$PRIVATE_ANNOUNCE)
                              {
                                 $magnetLink="";
                                 if(!isset($array["info"]["private"]) || $array["info"]["private"]==0)
                                 {
                                    $magnetLink="magnet:?xt=urn:btih:".$hash."&dn=".urlencode($filename);
                                    if(!isset($array["announce-list"]) && isset($array["announce"]) && !empty($array["announce"]))
                                    {
                                       $array["announce-list"][0][0]=$array["announce"];
                                    }
                                    if(!isset($array["announce-list"]))
                                    $array["announce-list"]=array();
                                    if(count($array["announce-list"])>0)
                                    {
                                       foreach($array["announce-list"] as $value)
                                       {
                                          $magnetLink.="&tr=".urlencode($value[0]);
                                       }
                                    }
                                 }
                                 $query1_insert_key .= ", `magnet`";
                                 $query1_insert_value .= ", '".(($magnetLink!="")?sqlesc(base64_encode($magnetLink)):"")."'";
                              }
                              if(in_array($announce, $TRACKER_ANNOUNCEURLS))
                              {
                                 $internal = true;
                                 // inserting into xbtt table
                                 if($XBTT_USE)
                                 quickQuery("INSERT INTO xbt_files SET info_hash=0x$hash, ctime=UNIX_TIMESTAMP()".$xbt_insert." ON DUPLICATE KEY UPDATE flags=0", true);
                                 $query = "INSERT INTO {$TABLE_PREFIX}files (info_hash, filename, url, info, category, data, size, comment, uploader,anonymous, bin_hash".$query1_insert_key.",release_group,youtube_video) VALUES (\"$hash\", \"$filename\", \"$url\", \"$info\",0 + $categoria,NOW(), \"$size\", \"$comment\",$curuid,$anonyme,0x$hash".
                                 $query1_insert_value.",$release_group,'{$youtube_video}')";
                              }
                              else
                              {
                                 // maybe we find our announce in announce list??
                                 $internal = false;
                                 if(isset($array["announce-list"]) && is_array($array["announce-list"]))
                                 {
                                    for($i = 0; $i < count($array["announce-list"]); $i++)
                                    {
                                       if(in_array($array["announce-list"][$i][0], $TRACKER_ANNOUNCEURLS))
                                       {
                                          $internal = true;
                                          continue;
                                       }
                                    }
                                 }
                                 if($internal)
                                 {
                                    // ok, we found our announce, so it's internal and we will set our announce as main
                                    $array["announce"] = $TRACKER_ANNOUNCEURLS[0];
                                    $query = "INSERT INTO {$TABLE_PREFIX}files (info_hash, filename, url, info, category, data, size, comment, uploader,anonymous, bin_hash".$query1_insert_key.", release_group,youtube_video) VALUES (\"$hash\", \"$filename\", \"$url\", \"$info\",0 + $categoria,NOW(), \"$size\", \"$comment\",$curuid,$anonyme,0x$hash".
                                    $query1_insert_value.",$release_group,'{$youtube_video}')";
                                    if($XBTT_USE)
                                    quickQuery("INSERT INTO xbt_files SET info_hash=0x$hash, ctime=UNIX_TIMESTAMP() ON DUPLICATE KEY UPDATE flags=0", true);
                                 }
                                 else
                                    $query = "INSERT INTO {$TABLE_PREFIX}files (info_hash, filename, url, info, category, data, size, comment,external,announce_url, uploader,anonymous, bin_hash".$query1_insert_key.",release_group,youtube_video) VALUES (\"$hash\", \"$filename\", \"$url\", \"$info\",0 + $categoria,NOW(), \"$size\", \"$comment\",\"yes\",\"$announce\",$curuid,$anonyme,0x$hash".
                                 $query1_insert_value.",$release_group,'{$youtube_video}')";
                              }
                              $status = do_sqlquery($query);
                              $file_id = sql_insert_id();
                              if($status === TRUE)
                              {
                                 if($btit_settings["fmhack_forum_auto_topic"] == "enabled" && $btit_settings["smf_autotopic"] == "true" && $team == 0)
                                 {
                                    require_once(load_language("lang_admin.php"));
                                    if((($btit_settings["fmhack_torrent_moderation"] == "enabled" && $CURUSER["trusted"] == "yes") || $btit_settings["fmhack_torrent_moderation"] == "disabled") && $forumid > 0)
                                    {
                                       $final_comment = "[center]";
                                       if($btit_settings["fmhack_torrent_image_upload"] == "enabled" && isset($file_name) && !empty($file_name))
                                       {
                                          $final_comment .= "[img]".$BASEURL."/".$GLOBALS["uploaddir"]."/".$file_name."[/img]<br /><br />";
                                       }
                                       require_once($THIS_BASEPATH."/include/smilies.php");
                                       if(substr($FORUMLINK,0,3)=="smf" || $FORUMLINK=="ipb")
                                       {
                                          foreach($smilies as $key => $value)
                                          $comment=str_replace($key, "[img]".$BASEURL."/images/smilies/".$value."[/img]",$comment);
                                          foreach($privatesmilies as $key => $value)
                                          $comment=str_replace($key, "[img]".$BASEURL."/images/smilies/".$value."[/img]",$comment);
                                       }
                                       $final_comment .= $comment."<br /><br />";
                                       if($btit_settings["fmhack_torrent_image_upload"] == "enabled")
                                       {
                                          if(isset($file_name_s1) && !empty($file_name_s1))
                                          $final_comment .= "[img]".$BASEURL."/".$GLOBALS["uploaddir"]."/".$file_name_s1."[/img]<br /><br />";
                                          if(isset($file_name_s2) && !empty($file_name_s2))
                                          $final_comment .= "[img]".$BASEURL."/".$GLOBALS["uploaddir"]."/".$file_name_s2."[/img]<br /><br />";
                                          if(isset($file_name_s3) && !empty($file_name_s3))
                                          $final_comment .= "[img]".$BASEURL."/".$GLOBALS["uploaddir"]."/".$file_name_s3."[/img]<br /><br />";
                                       }
                                       if(extension_loaded("gd"))
                                       {
                                          $seeders = 0;
                                          $leechers = 0;
                                          $total_count = 0;
                                          $downloaded_count = 0;
                                          $string[0] = $language["SEEDS"].": ".$seeders.", ".$language["LEECHERS"].": ".$leechers." = ".$total_count." ".$language["PEERS"];
                                          $string[1] = $language["DOWNLOADED"].": ".$downloaded_count." ".$language["X_TIMES"];
                                          $statsFilename = $THIS_BASEPATH."/torrentstats/".$hash.".png";
                                          $width = 400;
                                          $height = 45;
                                          $im = ImageCreate($width, $height);
                                          $bg = ImageColorAllocate($im, 255, 255, 255);
                                          $border = ImageColorAllocate($im, 207, 199, 199);
                                          ImageRectangle($im, 0, 0, $width - 1, $height - 1, $border);
                                          $stringcolor = ImageColorAllocate($im, 0, 0, 255);
                                          $font = 3;
                                          $font_width = ImageFontWidth($font);
                                          $font_height = ImageFontHeight($font);
                                          $string_width[0] = $font_width * strlen($string[0]);
                                          $string_width[1] = $font_width * strlen($string[1]);
                                          $position_center[0] = ceil(($width - $string_width[0]) / 2);
                                          $position_center[1] = ceil(($width - $string_width[1]) / 2);
                                          $string_height = $font_height;
                                          $position_middle = ceil(($height - $string_height) / 2);
                                          $image_string = imagestring($im, $font, $position_center[0], 5, $string[0], $stringcolor);
                                          $image_string = imagestring($im, $font, $position_center[1], 25, $string[1], $stringcolor);
                                          ImagePNG($im, $statsFilename);
                                          $final_comment .= "[img]".$BASEURL."/torrentstats/".$hash.".png[/img]<br /><br />";
                                          $final_comment .= "[url=".$BASEURL."/".(($btit_settings["fmhack_download_ratio_checker"] == "enabled")?"index.php?page=downloadcheck&amp;id=".$hash:"download.php?id=".$hash."&f=".urlencode($filename).".torrent")."]".$language["DOWNLOAD"]." ".$filename."[/url]<br /><br />";
                                          $final_comment .= "[/center]";
                                       }
                                       new_auto_topic($forumid, ((substr($FORUMLINK, 0, 3) == "smf")?$CURUSER["smf_fid"]:(($FORUMLINK == "ipb")?$CURUSER["ipb_fid"]:$CURUSER["uid"])), $btit_settings["smf_tag"].$filename, (($FORUMLINK ==
                                       "ipb")?str_replace("\\r\\n", "<br />", $final_comment):$final_comment), $hash);
                                       quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `forum_announced`=1 WHERE `info_hash`='".$hash."'", true);
                                    }
                                 }
                                 $mf = @move_uploaded_file($_FILES["torrent"]["tmp_name"], $TORRENTSDIR."/".$hash.".btf");
                                 ##############################################################
                                 # Nfo hack -->
                                 if($btit_settings["fmhack_NFO_uploader_-_viewer"] == "enabled")
                                 {
                                    if($nfocheck)
                                    {
                                       if(empty($error))
                                       {
                                          $result = @move_uploaded_file($nfo, "nfo/rep/".$hash.".nfo");
                                          if(empty($result))
                                          $error["result"] = stderr($language["ERROR"], $language["NFO_CANT_MOVE"]);
                                       }
                                    }
                                    if(is_array($error))
                                    {
                                       while(list($key, $val) = each($error))
                                       echo $val;
                                    }
                                 }
                                 # End
                                 ########################################################## -->
                                 if(!$mf)
                                 {
                                    // failed to move file
                                    quickQuery("DELETE FROM {$TABLE_PREFIX}files WHERE info_hash=\"$hash\"", true);
                                    if($XBTT_USE)
                                    quickQuery("UPDATE xbt_files SET flags=1 WHERE info_hash=0x$hash", true);
                                    stderr($language["ERROR"], $language["ERR_MOVING_TORR"]);
                                 }
                                 // try to chmod new moved file, on some server chmod without this could result 600, seems to be php bug
                                 @chmod($TORRENTSDIR."/".$hash.".btf", 0766);
                                 if($btit_settings["fmhack_gold_and_silver_torrents"] == "enabled")
                                 {
                                    // gold/silver torrent
                                    $getgold = get_result("SELECT `gold_percentage`, `silver_percentage`, `bronze_percentage` FROM `{$TABLE_PREFIX}gold` WHERE `id`=1", true, $btit_settings["cache_duration"]);
                                    if($gold == 0)
                                    $xgold = 100;
                                    elseif($gold == 1)
                                    $xgold = $getgold[0]["silver_percentage"];
                                    elseif($gold == 2)
                                    $xgold = $getgold[0]["gold_percentage"];
                                    elseif($gold == 3)
                                    $xgold = $getgold[0]["bronze_percentage"];
                                    $free_mode = false;
                                    if($btit_settings["fmhack_free_leech_with_happy_hour"] == "enabled" && $XBTT_USE)
                                    {
                                       $petr1 = do_sqlquery("SELECT `free`, `happy` FROM `{$TABLE_PREFIX}files` WHERE `info_hash`='".$hash."'", true);
                                       if(@sql_num_rows($petr1) > 0)
                                       {
                                          $fied = $petr1->fetch_assoc();
                                          if($fied["free"] == "yes" || $fied["happy"] == "yes")
                                          {
                                             $free_mode = true;
                                          }
                                       }
                                    }
                                    if($XBTT_USE && $free_mode === false)
                                    quickQuery("UPDATE `xbt_files` SET `down_multi`=".$xgold.", `flags`=2 WHERE `info_hash`=0x".$hash, true);
                                 }
                                 if(!in_array($announce, $TRACKER_ANNOUNCEURLS))
                                 {
                                    if($btit_settings["fmhack_multi_tracker_scrape"] == "enabled")
                                    require_once (dirname(__file__)."/include/getscrape_multiscrape.php");
                                    else
                                    require_once (dirname(__file__)."/include/getscrape.php");
                                    scrape($announce, $hash);
                                    $status = 2;
                                    write_log("Uploaded new torrent $filename - ".$language["SHORT_EXTERNAL"]." ($hash)", "add");
                                 }
                                 else
                                 {
                                    if($DHT_PRIVATE)
                                    {
                                       $alltorrent = bencode($array);
                                       $fd = fopen($TORRENTSDIR."/".$hash.".btf", "rb+");
                                       fwrite($fd, $alltorrent);
                                       fclose($fd);
                                    }
                                    // with pid system active or private flag (dht disabled), tell the user to download the new torrent
                                    write_log("Uploaded new torrent $filename ($hash)", "add");
                                    $status = 1;
                                 }
                                 if($btit_settings["fmhack_shoutbox_member_and_torrent_announce"] == "enabled")
                                 {
                                    if(($btit_settings["fmhack_torrent_moderation"] == "enabled" && $CURUSER["trusted"] == "yes") || $btit_settings["fmhack_torrent_moderation"] == "disabled")
                                    {
                                       $thisIsPorn=false;
                                       if($btit_settings["fmhack_show_or_hide_porn"]=="enabled")
                                       {
                                          $pornCats=explode(",", $btit_settings["porncat"]);
                                          if(in_array($categoria, $pornCats))
                                          $thisIsPorn=true;
                                       }
                                       if($team == 0 && !$thisIsPorn)
                                       {
                                          if($btit_settings["shoutann_display_uploader"] == "yes" && $_POST["anonymous"] != "true")
                                             $added_by = "{$language['ANN_ADDED_BY']} [url={$BASEURL}/index.php?page=userdetails&id={$CURUSER['uid']}]{$CURUSER['username']}[/url]";
                                          else
                                             $added_by = "";
                                          
                                          if(internal_check($categoria))
                                          {
                                             $system_shout_data_1 = sql_esc("{$language['ANN_NEW_INT']} [url={$BASEURL}/index.php?page=torrent-details&id={$hash}]".mb_convert_encoding($filename, "UTF-8", "HTML-ENTITIES")."[/url] {$added_by}");
                                             system_shout($system_shout_data_1,true,true);
                                          }
                                          else
                                          {
                                             $system_shout_data_2 = sql_esc("{$language['ANN_NEW_TORR']} [url={$BASEURL}/index.php?page=torrent-details&id={$hash}]".mb_convert_encoding($filename, "UTF-8", "HTML-ENTITIES")."[/url] {$added_by}");
                                             system_shout($system_shout_data_2,true,true);
                                          }
                                          if($btit_settings["fmhack_IMG_in_SB_after_x_shouts"] == "enabled")
                                          auto_shout(sql_insert_id());

                                          quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `shout_announced`=1 WHERE `info_hash`='".$hash."'", true);
                                       }
                                    }
                                 }
                              }
                              else
                              {
                                 err_msg($language["ERROR"], $language["ERR_ALREADY_EXIST"]);
                                 unlink($_FILES["torrent"]["tmp_name"]);
                                 stdfoot();
                                 die();
                              }
                           }
                           else
                           {
                              $status = 0;
                           }

                           $uploadtpl = new bTemplate();
                           $uploadtpl->set("arc_enabled", (($btit_settings["fmhack_archive_torrents"] == "enabled")?true:false), true);
                           $uploadtpl->set("arc_both", (($btit_settings["fmhack_archive_torrents"] == "enabled" && $CURUSER["up_new"]=="yes" && $CURUSER["up_arc"]=="yes")?true:false), true);
                           $uploadtpl->set("arc_only_new", (($btit_settings["fmhack_archive_torrents"] == "enabled" && $CURUSER["up_new"]=="yes" && $CURUSER["up_arc"]=="no")?true:false), true);
                           $uploadtpl->set("arc_only_arc", (($btit_settings["fmhack_archive_torrents"] == "enabled" && $CURUSER["up_new"]=="no" && $CURUSER["up_arc"]=="yes")?true:false), true);
                           $uploadtpl->set("torlang", (($btit_settings["fmhack_language_in_torrent_list_and_details"] == "enabled")?true:false), true);
                           $uploadtpl->set("media_enabled", (($btit_settings["fmhack_torrent_details_media_player"] == "enabled")?true:false), true);
                           $uploadtpl->set("st_comm_enabled", (($btit_settings["fmhack_staff_comment_in_torrent_details"] == "enabled")?true:false), true);
                           $uploadtpl->set("tracker_url",$TRACKER_ANNOUNCEURLS[0]);
                           if($btit_settings["fmhack_staff_comment_in_torrent_details"] == "enabled")
                           {
                              if(is_integer($btit_settings["staff_comment"]) || substr($btit_settings["staff_comment"], 0, 4)!="lro-")
                              stderr($language["ERROR"], $language["ERR_NEEDS_RECONFIG_1"]." <b>Staff Comment In Torrent Details</b> ".$language["ERR_NEEDS_RECONFIG_2"].(($CURUSER["admin_access"]=="no")?"<br /><br />".$language["ERR_NEEDS_RECONFIG_3"]:""));

                              $lroPerms=explode("-", $btit_settings["staff_comment"]);
                              if($btit_settings["fmhack_logical_rank_ordering"]=="enabled")
                              {
                                 if($lroPerms[1]==1 && $lroPerms[2]>0)
                                 $addCommOverOrEqual=(($CURUSER["logical_rank_order"]>=$lroPerms[2])?true:false);
                                 else
                                 stderr($language["ERROR"], $language["ERR_NEEDS_RECONFIG_1"]." <b>Staff Comment In Torrent Details</b> ".$language["ERR_NEEDS_RECONFIG_2"].(($CURUSER["admin_access"]=="no")?"<br /><br />".$language["ERR_NEEDS_RECONFIG_3"]:""));
                              }
                              elseif($btit_settings["fmhack_logical_rank_ordering"]=="disabled")
                              {
                                 if($lroPerms[1]==0 && $lroPerms[2]>0)
                                 $addCommOverOrEqual=(($CURUSER["id_level"]>=$lroPerms[2])?true:false);
                                 else
                                 stderr($language["ERROR"], $language["ERR_NEEDS_RECONFIG_1"]." <b>Staff Comment In Torrent Details</b> ".$language["ERR_NEEDS_RECONFIG_2"].(($CURUSER["admin_access"]=="no")?"<br /><br />".$language["ERR_NEEDS_RECONFIG_3"]:""));
                              }
                              if($CURUSER["uid"] > 1 && $addCommOverOrEqual)
                              $uploadtpl->set("LEVEL_SC", true, true);
                              else
                              $uploadtpl->set("LEVEL_SC", false, true);
                           }
                           $uploadtpl->set("aacapg_enabled", (($btit_settings["fmhack_automatic_album_cover_and_picture_grabber"] == "enabled")?true:false), true);
                           $uploadtpl->set("nfo_enabled", (($btit_settings["fmhack_NFO_uploader_-_viewer"] == "enabled")?true:false), true);
                           $uploadtpl->set("nar_enabled", (($btit_settings["fmhack_torrent_nuked_and_requested"] == "enabled")?true:false), true);
                           $uploadtpl->set("upcheck_enabled", (($btit_settings["fmhack_auto_duplicate_torrent_checker"] == "enabled")?true:false), true);
                           $uploadtpl->set("sticky_enabled", (($btit_settings["fmhack_sticky_torrent"] == "enabled")?true:false), true);
                           $uploadtpl->set("auto_announce_enabled", (($btit_settings["fmhack_auto_announce"] == "enabled")?true:false), true);
                           $uploadtpl->set("ddl_enabled", (($btit_settings["fmhack_direct_download"] == "enabled" && $CURUSER["add_ddl"] == "yes")?true:false), true);
                           if($btit_settings["fmhack_sticky_torrent"] == "enabled")
                           {
                              /*
                              Mod by losmi -sticky torrent
                              */
                              $query = "SELECT * FROM {$TABLE_PREFIX}sticky";
                              $rez = do_sqlquery($query, true);
                              $rez = $rez->fetch_assoc();
                              $rez_level = $rez['level'];
                              $current_level = getLevel($CURUSER['id_level']);
                              $level_ok = false;
                              if($CURUSER["uid"] > 1 && $current_level >= $rez_level && $CURUSER['can_upload'] == 'yes')
                              $uploadtpl->set("LEVEL_OK", true, false);
                              else
                              $uploadtpl->set("LEVEL_OK", false, true);
                              unset($rez);
                              /*
                              Mod by losmi -sticky torrent
                              */
                           }
                           $uploadtpl->set("seedbox_enabled", (($btit_settings["fmhack_show_if_seedbox_is_used"] == "enabled")?true:false), true);
                           if($btit_settings["fmhack_show_if_seedbox_is_used"] == "enabled")
                           {
                              // seedbox start
                              if(is_integer($btit_settings["seedbox"]) || substr($btit_settings["seedbox"], 0, 4)!="lro-")
                              stderr($language["ERROR"], $language["ERR_NEEDS_RECONFIG_1"]." <b>Show If Seedbox Is Used</b> ".$language["ERR_NEEDS_RECONFIG_2"].(($CURUSER["admin_access"]=="no")?"<br /><br />".$language["ERR_NEEDS_RECONFIG_3"]:""));

                              $lroPerms=explode("-", $btit_settings["seedbox"]);
                              if($btit_settings["fmhack_logical_rank_ordering"]=="enabled")
                              {
                                 if($lroPerms[1]==1 && $lroPerms[2]>0)
                                 $seedboxOverOrEqual=(($CURUSER["logical_rank_order"]>=$lroPerms[2])?true:false);
                                 else
                                 stderr($language["ERROR"], $language["ERR_NEEDS_RECONFIG_1"]." <b>Show If Seedbox Is Used</b> ".$language["ERR_NEEDS_RECONFIG_2"].(($CURUSER["admin_access"]=="no")?"<br /><br />".$language["ERR_NEEDS_RECONFIG_3"]:""));
                              }
                              elseif($btit_settings["fmhack_logical_rank_ordering"]=="disabled")
                              {
                                 if($lroPerms[1]==0 && $lroPerms[2]>0)
                                 $seedboxOverOrEqual=(($CURUSER["id_level"]>=$lroPerms[2])?true:false);
                                 else
                                 stderr($language["ERROR"], $language["ERR_NEEDS_RECONFIG_1"]." <b>Show If Seedbox Is Used</b> ".$language["ERR_NEEDS_RECONFIG_2"].(($CURUSER["admin_access"]=="no")?"<br /><br />".$language["ERR_NEEDS_RECONFIG_3"]:""));
                              }
                              if($CURUSER["uid"] > 1 && $seedboxOverOrEqual && $CURUSER['can_upload'] == 'yes')
                              {
                                 $uploadtpl->set("LEVEL_SB", true, false);
                              }
                              else
                              {
                                 $uploadtpl->set("LEVEL_SB", false, true);
                              }
                              // seedbox end
                           }
                           $uploadtpl->set("language", $language);
                           $uploadtpl->set("upload_script", "index.php");
                           switch($status)
                           {
                              case 0:
                              foreach($TRACKER_ANNOUNCEURLS as $taurl)
                              $announcs = $announcs."$taurl<br />";
                              $category = (!isset($_GET["category"])?0:explode(";", $_GET["category"]));
                              // sanitize categories id
                              if(is_array($category))
                              $category = array_map("intval", $category);
                              else
                              $category = 0;
                              $combo_categories = categories($category[0]);
                              $uploadtpl->set("teams_enabled", (($btit_settings["fmhack_teams"] == "enabled")?true:false), true);
                              if($btit_settings["fmhack_teams"] == "enabled")
                              {
                                 // TEAM DROPDOWN
                                 $teamsdropdown = "<select name='team'>\n";
                                 $teams = team_list();
                                 $allowed_teams = "";
                                 if(($CURUSER["sel_team"] != 0 && $CURUSER["team"] != 0) && $CURUSER["sel_team"] != $CURUSER["team"])
                                 $allowed_teams = array(
                                    0,
                                    $CURUSER["sel_team"],
                                    $CURUSER["team"]);
                                    elseif(($CURUSER["sel_team"] != 0 && $CURUSER["team"] != 0) && $CURUSER["sel_team"] == $CURUSER["team"])
                                    $allowed_teams = array(0, $CURUSER["sel_team"]);
                                    elseif($CURUSER["sel_team"] != 0 && $CURUSER["team"] == 0)
                                    $allowed_teams = array(0, $CURUSER["sel_team"]);
                                    elseif($CURUSER["team"] != 0 && $CURUSER["sel_team"] == 0)
                                    $allowed_teams = array(0, $CURUSER["team"]);
                                    foreach($teams as $teams)
                                    {
                                       if(is_array($allowed_teams) || $CURUSER["all_teams"] == "yes")
                                       {
                                          if($CURUSER["all_teams"] == "yes")
                                          {
                                             $teamsdropdown .= "<option value='".$teams["id"]."'";
                                             if($teams["id"] == 0)
                                             $teamsdropdown .= " selected='selected'";
                                             $teamsdropdown .= ">".htmlspecialchars($teams["name"])."</option>\n";
                                          }
                                          else
                                          {
                                             if(in_array($teams["id"], $allowed_teams))
                                             {
                                                $teamsdropdown .= "<option value='".$teams["id"]."'";
                                                if($teams["id"] == 0)
                                                $teamsdropdown .= " selected='selected'";
                                                $teamsdropdown .= ">".htmlspecialchars($teams["name"])."</option>\n";
                                             }
                                          }
                                       }
                                    }
                                    $teamsdropdown .= "</select>\n";
                                    if($teamsdropdown != "<select name='team'>\n"."</select>\n")
                                    {
                                       //END team
                                       $combo_teams = "<tr>
                                       <td class='header'>".$language["TEAMS_TEAM"].":</td>
                                       <td class='lista'>".$teamsdropdown."</td>
                                       </tr>";
                                    }
                                    else
                                    $combo_teams = "";
                                    $uploadtpl->set("upload_teams_combo", $combo_teams);
                                 }
                                 $uploadtpl->set("gast_enabled", (($btit_settings["fmhack_gold_and_silver_torrents"] == "enabled")?true:false), true);
                                 if($btit_settings["fmhack_gold_and_silver_torrents"] == "enabled")
                                 {
                                    $gold_level = '';
                                    $res = get_result("SELECT * FROM {$TABLE_PREFIX}gold  WHERE id='1'", true);
                                    foreach($res as $key => $value)
                                    $gold_level = $value["level"];
                                    if($gold_level > $CURUSER['id_level'])
                                    $uploadtpl->set("upload_gold_level", false, true);
                                    else
                                    $uploadtpl->set("upload_gold_level", true, true);
                                    $gold_select_box = createGoldCategories();
                                    $uploadtpl->set("upload_gold_combo", $gold_select_box);
                                 }
                                 else
                                 $uploadtpl->set("upload_gold_level", false, true);
                                 $uploadtpl->set("mult_enabled", (($btit_settings["fmhack_upload_multiplier"] == "enabled" && $CURUSER["set_multi"]=="yes")?true:false), true);
                                 if($btit_settings["fmhack_upload_multiplier"] == "enabled")
                                 {
                                    // Upload Multiplier
                                    if($CURUSER["set_multi"] == "yes")
                                    {
                                       $row = do_sqlquery("SHOW COLUMNS FROM {$TABLE_PREFIX}files LIKE 'multiplier'")->fetch_row();
                                       $options = explode("','", preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $row[1]));
                                       $option="";
                                       foreach($options as $multiplier)
                                       {
                                          $option .= "<option value='".$multiplier."'";
                                          if($multiplier == 1)
                                          $option .= " selected='yes' ";
                                          $option .= ">".unesc($multiplier)."</option>\n";
                                       }
                                       $uploadtpl->set("multie3", $option);
                                    }
                                    // Upload Multiplier
                                 }
                                 $bbc = textbbcode("upload", "info");
                                 $uploadtpl->set("upload.announces", $announcs);
                                 $uploadtpl->set("upload_categories_combo", $combo_categories);
                                 $uploadtpl->set("textbbcode", $bbc);
                                 $uploadtpl->set("tmod_enabled", (($btit_settings["fmhack_torrent_moderation"] == "enabled")?true:false), true);
                                 if($btit_settings["fmhack_torrent_moderation"] == "enabled")
                                 {
                                    if($CURUSER['trusted'] == 'yes')
                                    $moder = "ok";
                                    else
                                    $moder = "um";
                                    $uploadtpl->set("moder", $moder);
                                    // moder
                                 }
                                 // Image Upload -->
                                 $uploadtpl->set("imageup_enabled", (($btit_settings["fmhack_torrent_image_upload"] == "enabled")?true:false), true);
                                 $uploadtpl->set("imageup_enabled2", (($btit_settings["fmhack_torrent_image_upload"] == "enabled")?true:false), true);
                                 if($btit_settings["fmhack_torrent_image_upload"] == "enabled")
                                 {
                                    $uploadtpl->set("imageon", $GLOBALS["imageon"] == "true", true);
                                    $uploadtpl->set("screenon", $GLOBALS["screenon"] == "true", true);
                                 }
                                 else
                                 {
                                    $uploadtpl->set("imageon", false, true);
                                    $uploadtpl->set("screenon", false, true);
                                 }
                                 // <-- Image Upload
                                 $uploadtpl->set("imdb_enabled", (($btit_settings["fmhack_getIMDB_in_torrent_details"] == "enabled")?true:false), true);
                                 $uploadtpl->set("tvdb_enabled", (($btit_settings["fmhack_grab_images_from_theTVDB"] == "enabled")?true:false), true);
                                 $tplfile = "upload";
                                 break;
                                 case 1:
                                 if($PRIVATE_ANNOUNCE || $DHT_PRIVATE || $btit_settings["fmhack_auto_announce"] == "enabled")
                                 {
                                    $uploadtpl->set("MSG_DOWNLOAD_PID", (($btit_settings["fmhack_auto_announce"] == "enabled")?$language["MSG_AUTO_ANNOUNCE"]:$language["MSG_DOWNLOAD_PID"]));
                                    $tplfile = "upload_finish";
                                    //Twitter Update start
                                    if(($btit_settings["fmhack_torrent_moderation"] == "enabled" && $CURUSER["trusted"] == "yes") || $btit_settings["fmhack_torrent_moderation"] == "disabled")
                                    {
                                       if($btit_settings["fmhack_twitter_update"] == "enabled")
                                       {
                                          if($team == 0)
                                          {
                                             // Read in our saved access token/secret
                                             $accessToken = $btit_settings["twitter_oauth_token"];
                                             $accessTokenSecret = $btit_settings["twitter_oauth_token_secret"];
                                             if($accessToken != "" && $accessTokenSecret != "")
                                             {
                                                // Create our twitter API object
                                                require_once ("twitteroauth/twitteroauth/twitteroauth.php");
                                                $oauth = new TwitterOAuth('i3wrpWOyahTF4VO0Fo1EmQ', '4Ng72fOHs7p1nayKZZjcyWGmULhhnjmUX4MQdGzOvg', $accessToken, $accessTokenSecret);
                                                $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$BASEURL."/index.php?page=torrent-details&id=".$hash);
                                                $status = $language["TWIT_NT"].": $filename Link: $tinyurl";
                                                // If it's still over 140 characters we'll just have to shorten the filename
                                                $status_size = strlen($status);
                                                if($status_size > 140)
                                                {
                                                   $filename_size = strlen($filename);
                                                   $excluding_filename = ($status_size - $filename_size);
                                                   $characters_left = (137 - $excluding_filename);
                                                   $filename = substr($filename, 0, $characters_left)."...";
                                                   $status = $language["TWIT_NT"].": $filename Link: $tinyurl";
                                                }
                                                $oauth->post('statuses/update', array('status' => $status));
                                                quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `twitter_announced`=1 WHERE `info_hash`='".$hash."'", true);
                                             }
                                             else
                                             write_log("Unable to announce new torrent to Twitter. Please authorise in <b>Admin Panel --> FM Hacks Config --> Authorise Twitter Posting</b>", "delete");
                                          }
                                       }
                                    }
                                    //Twitter Update end
                                    if($btit_settings["fmhack_download_ratio_checker"] == "enabled")
                                    $uploadtpl->set("DOWNLOAD", "<br /><a href=\"download.php?id=$hash&f=".urlencode($filename).".torrent&amp;key=".$CURUSER["dlrandom"]."\">".$language["DOWNLOAD"]."</a><br /><br />");
                                    else
                                    $uploadtpl->set("DOWNLOAD", "<br /><a href=\"download.php?id=$hash&f=".urlencode($filename).".torrent\">".$language["DOWNLOAD"]."</a><br /><br />");
                                 }
                                 $tplfile = "upload_finish";
                                 break;
                                 case 2:
                                 //Twitter Update start
                                 if(($btit_settings["fmhack_torrent_moderation"] == "enabled" && $CURUSER["trusted"] == "yes") || $btit_settings["fmhack_torrent_moderation"] == "disabled")
                                 {
                                    if($btit_settings["fmhack_twitter_update"] == "enabled")
                                    {
                                       if($team == 0)
                                       {
                                          // Read in our saved access token/secret
                                          $accessToken = $btit_settings["twitter_oauth_token"];
                                          $accessTokenSecret = $btit_settings["twitter_oauth_token_secret"];
                                          if($accessToken != "" && $accessTokenSecret != "")
                                          {
                                             // Create our twitter API object
                                             require_once ("twitteroauth/twitteroauth/twitteroauth.php");
                                             $oauth = new TwitterOAuth('i3wrpWOyahTF4VO0Fo1EmQ', '4Ng72fOHs7p1nayKZZjcyWGmULhhnjmUX4MQdGzOvg', $accessToken, $accessTokenSecret);
                                             $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$BASEURL."/index.php?page=torrent-details&id=".$hash);
                                             $status = $language["TWIT_NT"].": $filename Link: $tinyurl";
                                             // If it's still over 140 characters we'll just have to shorten the filename
                                             $status_size = strlen($status);
                                             if($status_size > 140)
                                             {
                                                $filename_size = strlen($filename);
                                                $excluding_filename = ($status_size - $filename_size);
                                                $characters_left = (137 - $excluding_filename);
                                                $filename = substr($filename, 0, $characters_left)."...";
                                                $status = $language["TWIT_NT"].": $filename Link: $tinyurl";
                                             }
                                             $oauth->post('statuses/update', array('status' => $status));
                                             quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `twitter_announced`=1 WHERE `info_hash`='".$hash."'", true);
                                          }
                                          else
                                          write_log("Unable to announce new torrent to Twitter. Please authorise in <b>Admin Panel --> FM Hacks Config --> Authorise Twitter Posting</b>", "delete");
                                       }
                                    }
                                 }
                                 //Twitter Update end
                                 $tplfile = "upload_finish";
                                 break;
                              }
                              ?>
