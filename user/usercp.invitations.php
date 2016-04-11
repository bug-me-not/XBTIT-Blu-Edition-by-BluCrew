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


if(!isset($language["SYSTEM_USER"]))
$language["SYSTEM_USER"]="System";
if (!$INVITATIONSON)
stderr($language["ERROR"], $language["ERR_INVITATIONS_OFF"]);

if (isset($_GET["action"]))
$do = $_GET["action"];
else
$action = "";

$id = 0 + $_GET["uid"];

$usercptpl->set("new_invitation", false, true);
$usercptpl->set("to_confirm", false, true);
$usercptpl->set("invs_sent", false, true);
$scriptname = htmlspecialchars($_SERVER["PHP_SELF"] .
"?page=usercp&do=invite&action=read&uid=" . $CURUSER["uid"]);

switch ($action)
{
   //if inviter confirmation is defined and
   //inviter confirms invitee registration
   case 'confirm':

   if (isset($_POST[conusr]))
   {
      $res = do_sqlquery("SELECT id, email, smf_fid, ipb_fid".(($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_invite"]=="enabled")?", `username`":"")." FROM {$TABLE_PREFIX}users WHERE id_level='2' AND id IN (" . implode(", ", $_POST["conusr"]) . ")", true);
      while ($arr = $res->fetch_assoc())
      {
         quickQuery("UPDATE {$TABLE_PREFIX}users SET id_level='3' WHERE id=" . $arr["id"] .
         "", true);
         quickQuery("UPDATE {$TABLE_PREFIX}invitations SET confirmed='true' WHERE hash='" .
         $arr["id"] . "'");
         if (substr($FORUMLINK,0,3)=="smf" || $FORUMLINK=="ipb")
         $member_mirror=get_result("SELECT ".((substr($FORUMLINK,0,3)=="smf")?"`smf_group_mirror`":"`ipb_group_mirror`")." FROM `{$TABLE_PREFIX}users_level` WHERE `id`=3");
         if(substr($FORUMLINK,0,3)=="smf" && count($member_mirror)==1)
         quickQuery("UPDATE `{$db_prefix}members` SET ".(($FORUMLINK=="smf")?"`ID_GROUP`":"`id_group`")."=".(($member_mirror[0]["smf_group_mirror"]>0)?$member_mirror[0]["smf_group_mirror"]:13)." WHERE ".(($FORUMLINK=="smf")?"`ID_MEMBER`":"`id_member`")."=".$arr["smf_fid"]);
         elseif($FORUMLINK=="ipb" && count($member_mirror)==1)
         quickQuery("UPDATE `{$ipb_prefix}members` SET `member_group_id`=".(($member_mirror[0]["ipb_group_mirror"]>0)?$member_mirror[0]["ipb_group_mirror"]:3)." WHERE `member_id`=".$arr["ipb_fid"]);

         $email = $arr["email"];

         send_mail($email, "$SITENAME " . $language["ACCOUNT_CONFIRMED"] . "", $language["INVIT_MSGCONFIRM"]);

         if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_invite"]=="enabled")
         {
            if(isset($CURUSER["user_notes"]) && !empty($CURUSER["user_notes"]))
            $usernotes=unserialize(unesc($CURUSER["user_notes"]));
            else
            $usernotes=array();

            $usernotes[]=base64_encode($CURUSER["username"]." ".$language["UN_INV_CONF"]." ".$arr["username"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
            $new_notes=serialize($usernotes);
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$arr["id"], true);
         }
      }
      if (!$res)
      die("ERROR: " . sql_error() . "\n");
   }
   else
   {
      stderr($language["ERROR"], $language["ERR_MISSING_DATA"]);
   }
   redirect("index.php?page=usercp&do=invite&action=read&uid=" . $id . "");
   break;

   //let's send the invitation
   case 'send':

   $id = (int)0+$_GET["uid"];
   $hash = strtolower(preg_replace("/[^A-Fa-f0-9]/", "", $_POST["hash"]));
   $invitername = $_POST["invitername"];
   $email = sql_esc($_POST["email"]);
   $body = sql_esc($_POST["body"]);

   if (!$email)
   stderr($language["ERROR"], $language["INSERT_EMAIL"]);

   if (!$body)
   stderr($language["ERROR"], $language["INSERT_MESSAGE"]);

   $a = @do_sqlquery("SELECT COUNT(*) FROM `{$TABLE_PREFIX}users` WHERE email='" .
   $email."'", true)->fetch_row();
   if ($a[0] != 0)
   stderr($language["ERROR"], "($email)<br>" . $language["ERR_EMAIL_ALREADY_EXISTS"]);

   send_mail($email, $SITENAME . " " . $language["INVIT_CONFIRM"], $language["INVIT_MSG"] .
   " " . $invitername . "." . $language["INVIT_MSG1"] . $BASEURL .
   "/index.php?page=signup&act=invite&invitationnumber=" . $hash . $language["INVIT_MSG2"] .
   " " . $invitername . ":\n\n" . $body . $language["INVIT_MSG3"]);

   quickQuery("INSERT INTO `{$TABLE_PREFIX}invitations` (inviter, invitee, hash, time_invited, confirmed) VALUES ('$id', '$email', '$hash', NOW(), 'false')", true);
   quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `invitations` = invitations - 1 WHERE id = '" .
   $id . "'", true);

   if($btit_settings["fmhack_user_notes"]=="enabled" && $btit_settings["un_invite"]=="enabled")
   {
      if(isset($CURUSER["user_notes"]) && !empty($CURUSER["user_notes"]))
      $usernotes=unserialize(unesc($CURUSER["user_notes"]));
      else
      $usernotes=array();

      $usernotes[]=base64_encode($language["UN_INV_SENT"]." ".$email."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
      $new_notes=serialize($usernotes);
      quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$id, true);
   }

   redirect("index.php?page=usercp&do=invite&action=read&uid=$id");
   break;

   //If user wants to send a new invitation
   case 'new':
   $count = (int)$CURUSER["invitations"];

   if ($count <= 0)
   stderr($language["ERROR"], $language['NO_INV']);

   $usercptpl->set("read_invitations", false, true);
   $usercptpl->set("new_invitation", true, true);
   $usercptpl->set("frm2_target", "index.php?page=usercp&amp;do=invite&amp;action=send&amp;uid=".$id);
   $hash = md5(mt_rand(1, 10000));
   $invitername = $CURUSER["username"];
   $usercptpl->set("inv_someone", $language["INVITATIONS"] . ": " . $inv["invitations"]);

   if ($count > 0)
   {
      $usercptpl->set("inv_hash", $hash);
      $usercptpl->set("invitername", $CURUSER["username"]);
   }
   break;

   //Display the invitees, if any...
   case '':
   case 'read':
   default:

   $id = 0 + $_GET["uid"];
   $usercptpl->set("read_invitations", true, true);

   $res = get_result("SELECT COUNT(*) as invite_num FROM {$TABLE_PREFIX}invitations WHERE inviter=" .
   $id, true);
   $count = $res[0]["invite_num"];

   if ($count > 0)
   {
      $usercptpl->set("invs_sent", true, true);
      $usercptpl->set("sent_inv", $count);
      $tobe_users = array();
      $i = 0;
      //All sent invitations
      $results = get_result("SELECT * FROM `{$TABLE_PREFIX}invitations` WHERE `inviter`='" .
      $id . "' ORDER BY id DESC", true);

      foreach ($results as $id => $data2)
      {
         $tobe_users[$i]["invitee"] = $data2["invitee"];
         $tobe_users[$i]["infohash"] = $data2["hash"];
         $tobe_users[$i]["send_date"] = $data2["time_invited"];
         if ($data2["confirmed"] == "true")
         $data2["confirmed"] = "<font color=\"green\">" . $data2["confirmed"] . "</font>";
         else
         $data2["confirmed"] = "<font color=\"red\">" . $data2["confirmed"] . "</font>";
         $tobe_users[$i]["confirmed"] = $data2["confirmed"];
         $i++;
      }
      $usercptpl->set("tobe_users", $tobe_users);
      unset($tobe_users);
   }

   $id = 0 + $_GET["uid"];

   $res = do_sqlquery("SELECT invitations FROM {$TABLE_PREFIX}users WHERE id=" . $id, true);
   @$inv = $res->fetch_assoc();
   if ($inv["invitations"] > 0)
   $usercptpl->set("sendnew_inv", "<a href=\"index.php?page=usercp&amp;do=invite&amp;action=new&amp;uid=$id\"><input type=\"button\" value=\"" .
   $language["INVITE_SOMEONE_TO"] . " (" . $inv["invitations"] . " " . $language["REMAINING"] .
   ")\" onclick=\"document.location.href('index.php?page=usercp&amp;do=invite&amp;action=new&amp;uid=$id');\" ></a>");
   else
   $usercptpl->set("sendnew_inv", "<input type=\"button\" value=\"" . $language["NO_INV"] .
   "\" disabled=\"true\">");

   //        Let's display the list of users which
   //        have accepted an invitation and are registered...
   //        something like a buddy list ;)
   $res = get_result("SELECT COUNT(*) as num_members FROM {$TABLE_PREFIX}users WHERE invited_by=" .
   $id, true);
   $count = $res[0]["num_members"];
   list($pagertop, $pagerbottom, $limit) = pager('15', $count, $scriptname .
   "&amp;");

   $usercptpl->set("inv_pagertop", $pagertop);
   $usercptpl->set("inv_pagerbottom", $pagerbottom);

   global $XBTT_USE;
   if($XBTT_USE)
   {
      $udownloaded = "u.downloaded+IFNULL(x.downloaded,0)";
      $uuploaded = "u.uploaded+IFNULL(x.uploaded,0)";
      $utables = "{$TABLE_PREFIX}users u LEFT JOIN xbt_users x ON x.uid=u.id";
   }
   else
   {
      $udownloaded = "u.downloaded";
      $uuploaded = "u.uploaded";
      $utables = "{$TABLE_PREFIX}users u";
   }

   $results = get_result("SELECT `u`.`id`, `u`.`username`, {$udownloaded} AS `downloaded`, {$uuploaded} AS `uploaded`, u.email, u.id_level FROM {$utables} WHERE invited_by=" .
   $id . " ORDER BY id DESC $limit", true);
   $num = count($results);

   if ($num > 0)
   {
      $usercptpl->set("to_confirm", true, true);
      $usercptpl->set("number_confirmed", $count);
      $usercptpl->set("frm1_target",
      "index.php?page=usercp&do=invite&amp;action=confirm&amp;uid=$id");

      $numreg = @do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}users WHERE invited_by=$id AND id_level=2", true)->fetch_row();

      if ($numreg[0] == 0)
      $usercptpl->set("confirm_btn", false, true);

      $invitees = array();
      $i = 0;
      foreach ($results as $id => $data)
      {
         $invitees[$i]["username"] = "<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$data["id"]."_".strtr($data["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$data["id"])."'>" . unesc($data["username"] . "</a>");
         $invitees[$i]["email"] = $data["email"];
         $invitees[$i]["uploaded"] = makesize($data["uploaded"]);
         $invitees[$i]["downloaded"] = makesize($data["downloaded"]);
         if ($data["id_level"] < 3)
         {
            $invitees[$i]["status"] = "<font color=\"red\">" . $language["PENDING"] .
            "</font>";
            $invitees[$i]["frm_chk"] = "<input type=\"checkbox\" name=\"conusr[]\" value=\"" .
            $data["id"] . "\" />";
         }
         else
         {
            $invitees[$i]["status"] = "<font color=\"green\">" . $language["CONFIRMED"] .
            "</font>";
            $invitees[$i]["frm_chk"] = "";
         }
         $i++;
      }
      $usercptpl->set("invitees", $invitees);
      unset($invitees);
   }
}

?>
