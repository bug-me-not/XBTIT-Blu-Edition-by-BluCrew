<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
//
// Expected & To Offer Torrents by DiemThuy oct 2010 based on Jboy,s BTI version
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

require_once ("include/functions.php");
require_once ("include/config.php");
dbconn();

$id = (int)$_GET["id"];

$res = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}expected WHERE id = $id") or sqlerr();
$num = $res->fetch_array();

$s = $num["expect"];

$expectdetailstpl = new bTemplate();
$expectdetailstpl ->set("language",$language);

$expectdetailstpl->set("exd2","<center><table width=550 border=0 cellspacing=0 cellpadding=3>\n");

$url = "index.php?page=expectedit&id=$id";
 if (isset($_GET["returnto"])) {
         $addthis = "&amp;returnto=" . urlencode($_GET["returnto"]);
         $url .= $addthis;
         $keepget .= $addthis;
 }
 $editlink = "a href=\"$url\"";
$expectdetailstpl->set("exd4","<table class=lista align=center width=550 cellspacing=2 cellpadding=0>\n");
$expectdetailstpl->set("exd6","<br><tr><td align=left class=header><B>" . $language["NAME"] . ": </B></td><td class=lista width=70% align=left>$num[expect]");
if ($CURUSER["uid"] == $num["userid"] || $CURUSER["edit_torrents"]== "yes")
{
$expectdetailstpl->set("exd8","&nbsp;&nbsp;&nbsp;<".$editlink."><b>[" . $language["EDIT"] . "]</b></a></td></tr>");
}
else
{
}

$expectdetailstpl->set("exd10","</td></tr>");

if($num["expect_offer"]=="yes")
{
	$ex_of = "<font color=\"purple\">" . $language["OFFER"] . "</font></a>";
	$type="<a href=index.php?page=votesexpectedview&expectid=$num[id]><b>".$num["hits"]."</b>";
	$lang=$language["VOTE_EXPECTED"];
}
else
{
	$ex_of = "<font color=\"darkblue\">" . $language["EXPECTED"] . "</font";
	$type=$num["date"];
	$lang=$language["EXPECTED"];
}

if ($num["descr"])
$expectdetailstpl->set("exd12","<tr><td align=left class=header><B>" . $language["TYPE"] . ": </B><td class=lista align=left><b>$ex_of</b></td></tr><tr><td align=left class=header><B>" . $language["DESCRIPTION"] . ": </B></td><td class=lista width=70% align=left>".format_comment(unesc($num[descr]))."</td></tr>");
$expectdetailstpl->set("exd14","<tr><td align=left class=header><B>" . $language["ADDED"]  . ": </B></td><td class=lista width=70% align=left>$num[added]</td></tr>");
$expectdetailstpl->set("exd16","<tr><td align=left class=header><B>" . $lang  . ": </B></td><td class=lista width=70% align=left>$type</td></tr>");

$cres = do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users WHERE id=$num[userid]");
   if (sql_num_rows($cres) == 1)
   {
     $carr = $cres->fetch_assoc();
     $username = "$carr[username]";
   }
$expectdetailstpl->set("exd18","<tr><td align=left class=header><B>" . $language["UPLOADER"]  . ":</B></td><td class=lista align=left><a href=index.php?page=userdetails&id=$num[userid]><b>$username</b></td></tr>");

if ($num["uploaded"]=="yes"){
$expectdetailstpl->set("exd19","<tr><td align=left class=header><b>" . $language["UPLOADED"] . ":</b></td><td class=lista align=left><a href=" . $num["torrenturl"] . ">" . $language["TORR_CLICK"] . "</a></td></tr>");
}

$expectdetailstpl->set("exd20","<tr><td class=lista align=center width=100% colspan='2'><form method=get action=index.php><input type=hidden name=page value=viewexpected /><center><input type=submit value=\"".$language["BACK"] ."\"></center></form></td></tr>");
$expectdetailstpl->set("exd22","</table>");

// comments...
$subres = get_result("SELECT u.downloaded as downloaded, u.uploaded as uploaded, u.avatar, u.id_level, c.id, text, UNIX_TIMESTAMP(added) as data, user, u.id as uid FROM {$TABLE_PREFIX}offer_comments c LEFT JOIN {$TABLE_PREFIX}users u ON c.user=u.username WHERE offer_id = '" . $id . "' ORDER BY added DESC",true,$btit_settings['cache_duration']);
if (!$subres || count($subres)==0) {
     if($CURUSER["uid"]>1)
       $expectdetailstpl->set("INSERT_COMMENT",TRUE,TRUE);
     else
       $expectdetailstpl->set("INSERT_COMMENT",false,TRUE);

    $expectdetailstpl->set("NO_COMMENTS",true,TRUE);
}
else {

     $expectdetailstpl->set("NO_COMMENTS",false,TRUE);

     if($CURUSER["uid"]>1)
       $expectdetailstpl->set("INSERT_COMMENT",TRUE,TRUE);
     else
      $expectdetailstpl->set("INSERT_COMMENT",false,TRUE);
     $comments=array();
     $count=0;
     foreach ($subres as $iid=>$subrow) {



       $level = do_sqlquery("SELECT level FROM {$TABLE_PREFIX}users_level WHERE id_level='$subrow[id_level]'");
       $lvl = $level->fetch_assoc();

        $title = "".$lvl['level']."";

        $comments[$count]["user"]="<a href=\"index.php?page=userdetails&amp;id=".$subrow["uid"]."\">" . user_with_color($subrow["user"]).get_user_icons($row)."</a> .::. ". $title;


$comments[$count]["date"]=date("d/m/Y H.i.s",$subrow["data"]-$offset);
       // only users able to delete torrents can delete comments...
       if ($CURUSER["delete_torrents"]=="yes")
       $comments[$count]["delete"]="<a onclick=\"return confirm('". str_replace("'","\'",$language["DELETE_CONFIRM"])."')\" href=\"index.php?page=offer_comment&amp;id=$id&amp;cid=" . $subrow["id"] . "&amp;action=delete\">".image_or_link("$STYLEPATH/images/delete.png","",$language["DELETE"])."</a>";
       $comments[$count]["comment"]=format_comment($subrow["text"]);
       $comments[$count]["elapsed"]="(".get_elapsed_time($subrow["data"]) . " ago)";
       $comments[$count]["avatar"]="<img onload=\"resize_avatar(this);\" src=\"".($subrow["avatar"] && $subrow["avatar"] != "" ? htmlspecialchars($subrow["avatar"]): "$STYLEURL/images/default_avatar.gif" )."\" alt=\"\" />";
       $comments[$count]["ratio"]="<img src=\"images/arany.png\">&nbsp;".(intval($subrow['downloaded']) > 0?number_format($subrow['uploaded'] / $subrow['downloaded'], 2):"---");
       $comments[$count]["uploaded"]="<img src=\"images/speed_up.png\">&nbsp;".(makesize($subrow["uploaded"]));
       $comments[$count]["downloaded"]="<img src=\"images/speed_down.png\">&nbsp;".(makesize($subrow["downloaded"]));
       $count++;
        }
     unset($subrow);
     unset($subres);
}

$expectdetailstpl->set("current_username",$CURUSER["username"]);
$expectdetailstpl->set("offer_id",$id);

if ($GLOBALS["usepopup"])
 $expectdetailstpl->set("torrent_footer","<a href=\"javascript: window.close();\">".$language["CLOSE"]."</a>");
else
 $expectdetailstpl->set("torrent_footer","<a href=\"javascript: history.go(-1);\">".$language["BACK"]."</a>");



$expectdetailstpl->set("comments",$comments);

?>
