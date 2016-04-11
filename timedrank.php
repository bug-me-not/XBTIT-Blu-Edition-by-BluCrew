<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
// Timed promote / demote system by DiemThuy June 2009
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


if($CURUSER['edit_torrents']=='no' || $CURUSER['edit_users']=='no')
{
    stderr($language["ERROR"],$language['TR_UNAUTH']);
}

(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"]>=2) ? $id=$_GET["id"] : $id=FALSE;
(isset($_POST["level"]) && is_numeric($_POST["level"]) && $_POST["level"]>=1) ? $level=$_POST["level"] : $level=FALSE;
(isset($_POST["t_days"]) && is_numeric($_POST["t_days"]) && $_POST["t_days"]>=1) ? $days=$_POST["t_days"] : $days=0;
if($id!==FALSE && $level!==FALSE)
{
    $res=get_result("SELECT `u`.`smf_fid`, `u`.`ipb_fid`, `u`.`id_level` `current_id_level`, `ul`.`id_level` `current_base`, `ul`.`level` `current_level` , `ul2`.`level` `new_level`, `ul2`.`id_level` `new_base`,".((substr($FORUMLINK,0,3)=="smf")?" `ul2`.`smf_group_mirror` `new_mirror`,":(($FORUMLINK=="ipb")?" `ul2`.`ipb_group_mirror` `new_mirror`,":""))." `l`.`language_url` , `l2`.`language_url` `my_language_url` ".(($btit_settings["fmhack_torrents_limit"]=="enabled" && $XBTT_USE)?", `ul`.`torrents_limit` `current_torrents_limit`, `ul2`.`torrents_limit` `new_torrents_limit`":"")." FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level` = `ul`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul2` ON `ul2`.`id` =".$level." LEFT JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language` = `l`.`id` LEFT JOIN `{$TABLE_PREFIX}language` `l2` ON `l2`.`id` =".$CURUSER["language"]." WHERE `u`.`id` =".$id,true,$btit_settings["cache_interval"]);
    $row=$res[0];
}
else
{
    stderr($language["ERROR"], $language['TR_ID_OR_LEV_INV']);
}

if($id==$CURUSER["uid"])
{
    stderr($language["ERROR"], $language['TR_NOT_OWN_RANK']);
}
elseif($row["new_base"]>$CURUSER["id_level"])
{
    stderr($language["ERROR"], $language['TR_NOT_HIGHER']);
}
elseif($row["current_base"]>=$CURUSER["id_level"])
{
    stderr($language["ERROR"], $language['TR_NOT_HIGHER_2']);
}
elseif($row["current_level"]==$row["new_level"])
{
    stderr($language["ERROR"], $language['TR_BOTH_THE_SAME']);
}

$dt1=gmdate('Y-m-d H:i:s',(time()+($days*86400)));
$returnto=urldecode($_POST['returnto']);

if($row["my_language_url"]!="language/english")
{
    require_once("language/english/lang_main.php");
}
if($row["language_url"]!="language/english")
{
    require_once($row["language_url"]."/lang_main.php");
}

$subj=sqlesc($language['TR_SUBJECT']);
$msg=sqlesc($language['TR_MSG_PART_1']." ".$row["new_level"]."\n\n ".$language['TR_MSG_PART_2']." ".$dt1."\n\n ".$language['TR_MSG_PART_3']." ".$row["current_level"]." ".$language['TR_MSG_PART_4']."\n\n [color=red]".$language['TR_MSG_PART_5']."[/color]");

quickQuery("UPDATE `{$TABLE_PREFIX}users` `u` ".(($btit_settings["fmhack_VIP_freeleech"]=="enabled")?"LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON ".$level."=`ul`.`id`".(($XBTT_USE)?" LEFT JOIN `xbt_users` `xu` ON `u`.`id`=`xu`.`uid`":""):"")." SET `u`.`timed_rank`='".$dt1."', `u`.`old_rank`=".$row["current_id_level"].", `u`.`rank_switch`='yes', `u`.`id_level`='".$level."' ".(($btit_settings["fmhack_VIP_freeleech"]=="enabled")?", `u`.`vipfl_down`=IF(`ul`.`freeleech`='yes', ".(($XBTT_USE)?"`xu`":"`u`").".`downloaded`, '0'), `u`.`vipfl_date`=IF(`ul`.`freeleech`='yes', UNIX_TIMESTAMP(), '0')":"")." WHERE `u`.`id`=".$id,true);
if(substr($FORUMLINK,0,3)=="smf")
    quickQuery("UPDATE `{$db_prefix}members` SET ".(($FORUMLINK=="smf")?"`ID_GROUP`":"`id_group`")."='".(($row["new_mirror"]>0)?$row["new_mirror"]:($level+10))."' WHERE ".(($FORUMLINK=="smf")?"`ID_MEMBER`":"`id_member`")."=".$row["smf_fid"]);
elseif($FORUMLINK=="ipb")
    quickQuery("UPDATE `{$ipb_prefix}members` SET `member_group_id`='".(($row["new_mirror"]>0)?$row["new_mirror"]:$level)."' WHERE `member_id`=".$row["ipb_fid"]);

if($btit_settings["fmhack_torrents_limit"]=="enabled" && $XBTT_USE && $row["new_torrents_limit"]!=$row["current_torrents_limit"])
    quickQuery("UPDATE `xbt_users` SET `torrents_limit` =".$row["new_torrents_limit"]." WHERE `uid`=".$id,true);

send_pm(0,$id,$subj,$msg);

header('Location: '.$returnto);
die();

?>