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

if (!$CURUSER || $CURUSER["uid"]==1)
{
   stderr($language["ERROR"],$language["ONLY_REG_COMMENT"]);
}
if($btit_settings["fmhack_comment_captcha"]=="enabled")
{
   require_once(dirname(__FILE__).'/include/recaptchalib.php');
}

$comment = sql_esc($_POST["comment"]);

$id=strtolower(preg_replace("/[^A-Fa-f0-9]/", "", $_GET["id"]));

if (isset($_GET["cid"]))
$cid = intval($_GET["cid"]);
else
$cid=0;

if($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")
{
   $seo_res=get_result("SELECT `id`, `filename` FROM `{$TABLE_PREFIX}files` WHERE `info_hash`='".sql_esc($id)."'", true, $btit_settings["cache_duration"]);
   $extra_seo_info=$seo_res[0];
}

if($btit_settings["fmhack_lock_comments"]=="enabled")
{
   //lock
   if ($CURUSER["id_level"]<= 5)
   {
      if ($CURUSER["block_comment"] == "yes")
      stderr($language["BC_AB_ERR"],$language["BC_U_R_BANNED"]);

      $block = do_sqlquery("SELECT `lock_comment` FROM `{$TABLE_PREFIX}files` WHERE `info_hash` = '".sql_esc($id)."'");
      $block_comments = $block->fetch_assoc();

      if ($block_comments["lock_comment"] == "yes")
      stderr($language["BC_COM_LOCKED"],$language["BC_OVERALL_ABUSE"]);
   }
   // end lock
}

if($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"]=="enabled")
{
   #######################################################
   # view/edit/delete shout, comments
   $comres = do_sqlquery("SELECT `id`, `text`, `user` FROM `{$TABLE_PREFIX}comments` WHERE `id`=$cid",true);
   $comrow = $comres->fetch_array();
   $username = $CURUSER["username"];
}

if (isset($_GET["action"]))
{
   if (($CURUSER["delete_torrents"]=="yes" || $CURUSER["username"]==$comrow["user"]) && $_GET["action"]=="delete")
   {
      if($btit_settings["fmhack_bonus_system"]=="enabled" && $btit_settings["comm_enable"]=="true")
      {
         $petr1=get_result("SELECT `user`, `sbonus` FROM `{$TABLE_PREFIX}comments` WHERE `id`=".$cid." AND `sbonus`>0",true,$btit_settings["cache_interval"]);
         if(count($petr1)>0)
         {
            $fied=$petr1[0];
            if($fied["sbonus"]>0)
            {
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=`seedbonus`-".$fied["sbonus"]." WHERE `username`='".$fied["user"]."'",true);
               $_SESSION["CURUSER"]["seedbonus"]-=$fied["sbonus"];
            }
         }
      }
      quickQuery("DELETE FROM {$TABLE_PREFIX}comments WHERE id=$cid",true);
      redirect((($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?strtr($extra_seo_info["filename"], $res_seo["str"], $res_seo["strto"])."-".$extra_seo_info["id"].".html#comments":"index.php?page=torrent-details&id=$id#comments"));
      exit;
   }
}

$tpl_comment=new bTemplate();

$tpl_comment->set("vedsc_enabled", (($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"]=="enabled")?true:false),true);
$tpl_comment->set("captcha_enabled", (($btit_settings["fmhack_comment_captcha"]=="enabled")?true:false),true);

if($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"]=="enabled")
{
   if (isset($_GET["edit"]))
   {
      if ($CURUSER["edit_comments"]=="yes" || $CURUSER["username"]==$comrow["user"])
      {
         $username = $comrow["user"]; $cid = $comrow["id"];
         $tpl_comment->set("cid","&cid=".$cid);
         $tpl_comment->set("edit","&edit");
         if ($_POST["confirm"]==$language["FRM_PREVIEW"] || $_POST["confirm"]==$language["FRM_CONFIRM"])
         $comment = $comment;
         else
         $comment = $comrow["text"];
      }
   }
   else
   {
      $tpl_comment->set("cid","");
      $tpl_comment->set("edit","");
   }
   # End
   #######################################################
}

if($btit_settings["fmhack_lock_comments"]=="enabled")
{
   //lock
   if (isset($_GET["lock"]) || isset($_GET["unlock"]))
   {
      quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `lock_comment`='".((isset($_GET["lock"]))?"yes":"no")."' WHERE `info_hash`='".sql_esc($id)."'");
      redirect((($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?strtr($extra_seo_info["filename"], $res_seo["str"], $res_seo["strto"])."-".$extra_seo_info["id"].".html":"index.php?page=torrent-details&id=$id"));
      die();
   }
   //end lock
}

$tpl_comment->set("language",$language);
$tpl_comment->set("comment_id",$id);
$tpl_comment->set("comment_username", (($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"]=="enabled")?$username:$CURUSER["username"]));
$tpl_comment->set("comment_comment",textbbcode("comment","comment",htmlspecialchars(unesc($comment))));

if($btit_settings["fmhack_comment_captcha"]=="enabled")
{
   $publickey = "".$btit_settings["comment_captcha_pub"]."";
   $tpl_comment->set("captcha",recaptcha_get_html($publickey));
}

if (isset($_POST["info_hash"]))
{
   if($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")
   {
      $seo_res_1=get_result("SELECT `id`, `filename` FROM `{$TABLE_PREFIX}files` WHERE `info_hash`='".sql_esc(StripSlashes($_POST["info_hash"]))."'", true, $btit_settings["cache_duration"]);
      $extra_seo_info_1=$seo_res_1[0];
   }

   if ($_POST["confirm"]==$language["FRM_CONFIRM"])
   {

      if($btit_settings["fmhack_comment_captcha"]=="enabled")
      {
         $privatekey = "".$btit_settings["comment_captcha_priv"]."";
         $resp = recaptcha_check_answer ($privatekey,
         $_SERVER["REMOTE_ADDR"],
         $_POST["recaptcha_challenge_field"],
         $_POST["recaptcha_response_field"]);

         if (!$resp->is_valid) {
            // What happens when the CAPTCHA was entered incorrectly
            stderr ($language["ERROR"]," ".$language["CAPTCHA_ERROR"]." " . $resp->error . ")");
         }
      }
      $user=AddSlashes((($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"]=="enabled")?$username:$CURUSER["username"]));
      if ($user=="")
      $user="Anonymous";

      if($btit_settings["fmhack_pM_notification_on_torrent_comment"] == "enabled")
      {
         $sql = "SELECT f.uploader, f.filename, f.info_hash, u.username, u.commentpm FROM {$TABLE_PREFIX}files f LEFT JOIN {$TABLE_PREFIX}users u ON f.uploader=u.id WHERE f.info_hash='".sql_esc(StripSlashes($_POST["info_hash"]))."'";
         $qry = get_result($sql, true, $btit_settings["cache_duration"]);
         $res = $qry[0];
         if($res['commentpm'] == 'true' && $CURUSER['uid'] != $res['uploader'])
         {
            $msg = "[url=$BASEURL/index.php?page=userdetails&id=".$CURUSER['uid']."]".$CURUSER['username']."[/url] ".$language["TCOM_AUTOPM_1"]." [url=$BASEURL/index.php?page=torrent-details&id=".$res['info_hash']."]".addslashes($res['filename'])."[/url]."."\n\n".$language["TCOM_AUTOPM_2"];
            $sub = $language["TCOM_AUTOPM_SUBJ"];
            send_pm(0,$res["uploader"],sqlesc($sub),sqlesc($msg));
         }
      }

      if(empty($comment))
      {
         stderr($language["ERROR"],$language['ERR_COMMENT_EMPTY']);
         exit();
      }
      else
      {
         if($btit_settings["fmhack_view_edit_delete_preview_shoutBox_comments"]=="enabled")
         {
            #######################################################
            # view/edit/delete shout, comments
            if (!isset($_GET["edit"]))
            {
               quickQuery("INSERT INTO {$TABLE_PREFIX}comments (added,text,ori_text,user,info_hash".(($btit_settings["fmhack_bonus_system"]=="enabled" && $btit_settings["comm_enable"]=="true")?",sbonus":"").") VALUES (NOW(),\"$comment\",\"$comment\",\"$user\",\"" . sql_esc(StripSlashes($_POST["info_hash"])) . "\"".(($btit_settings["fmhack_bonus_system"]=="enabled" && $btit_settings["comm_enable"]=="true")?",".$btit_settings["bonus_comm"]:"").")",true);
               if($btit_settings["fmhack_bonus_system"]=="enabled" && $btit_settings["comm_enable"]=="true")
               {
                  quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=`seedbonus`+".$btit_settings["bonus_comm"]." WHERE `id`=".$CURUSER["uid"]);
                  $_SESSION["CURUSER"]["seedbonus"]+=$btit_settings["bonus_comm"];
               }
               if($user!="Anonymous")
                  $chat_user="[url=$BASEURL/index.php?page=userdetails&id={$CURUSER['uid']}]{$CURUSER['username']}[/url]";
               else
                  $chat_user="[url=$BASEURL/index.php?page=userdetails&id=2]Anonymous[/url]";

               system_shout(sql_esc("{$chat_user} has left a comment on torrent: [url={$BASEURL}/index.php?page=torrent-details&id=".StripSlashes($_POST["info_hash"])."]".mb_convert_encoding($res['filename'], "UTF-8", "HTML-ENTITIES")."[/url]"));

               redirect((($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?strtr($extra_seo_info_1["filename"], $res_seo["str"], $res_seo["strto"])."-".$extra_seo_info_1["id"].".html#comments":"index.php?page=torrent-details&id=".StripSlashes($_POST["info_hash"])."#comments"));
               die();
            }
            else
            {
               quickQuery("UPDATE {$TABLE_PREFIX}comments SET text='$comment' WHERE id='" . $cid . "'",true);
               redirect((($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?strtr($extra_seo_info_1["filename"], $res_seo["str"], $res_seo["strto"])."-".$extra_seo_info_1["id"].".html#comments":"index.php?page=torrent-details&id=".StripSlashes($_POST["info_hash"])."#comments"));
               die();
            }
            # End
            #######################################################
         }
         else
         {
            quickQuery("INSERT INTO {$TABLE_PREFIX}comments (added,text,ori_text,user,info_hash".(($btit_settings["fmhack_bonus_system"]=="enabled" && $btit_settings["comm_enable"]=="true")?",sbonus":"").") VALUES (NOW(),\"$comment\",\"$comment\",\"$user\",\"" . sql_esc(StripSlashes($_POST["info_hash"])) . "\"".(($btit_settings["fmhack_bonus_system"]=="enabled" && $btit_settings["comm_enable"]=="true")?",".$btit_settings["bonus_comm"]:"").")",true);
            if($btit_settings["fmhack_bonus_system"]=="enabled" && $btit_settings["comm_enable"]=="true")
            {
               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=`seedbonus`+".$btit_settings["bonus_comm"]." WHERE `id`=".$CURUSER["uid"]);
               $_SESSION["CURUSER"]["seedbonus"]+=$btit_settings["bonus_comm"];
            }
            if($user!="Anonymous")
               $chat_user="[url=$BASEURL/index.php?page=userdetails&id={$CURUSER['uid']}]{$CURUSER['username']}[/url]";
            else
               $chat_user="[url=$BASEURL/index.php?page=userdetails&id=2]Anonymous[/url]";

            system_shout(sql_esc("{$chat_user} has left a comment on torrent: [url={$BASEURL}/index.php?page=torrent-details&id=".StripSlashes($_POST["info_hash"])."]".mb_convert_encoding($res['filename'], "UTF-8", "HTML-ENTITIES")."[/url]"));
            redirect((($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?strtr($extra_seo_info_1["filename"], $res_seo["str"], $res_seo["strto"])."-".$extra_seo_info_1["id"].".html#comments":"index.php?page=torrent-details&id=".StripSlashes($_POST["info_hash"])."#comments"));
            die();
         }
      }
   }

   # Comment preview by miskotes
   #############################

   if ($_POST["confirm"]==$language["FRM_PREVIEW"]) {

      $tpl_comment->set("PREVIEW",TRUE,TRUE);
      $tpl_comment->set("comment_preview",set_block($language["COMMENT_PREVIEW"],"center",format_comment(unesc($comment)),false));

      #####################
      # Comment preview end
   }
   else
   {
      redirect((($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?strtr($extra_seo_info_1["filename"], $res_seo["str"], $res_seo["strto"])."-".$extra_seo_info_1["id"].".html#comments":"index.php?page=torrent-details&id=".StripSlashes($_POST["info_hash"])."#comments"));
      die();
   }
}
else
$tpl_comment->set("PREVIEW",FALSE,TRUE);

?>
