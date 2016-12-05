<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2012  Btiteam
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


if (!defined("IN_BTIT_FORUM"))
die("non direct access!");


$postsperpage = $CURUSER["postsperpage"];
if (!$postsperpage)
$postsperpage = 15;


$topicid = intval(0+$_GET["topicid"]);

if (isset($_GET["pages"]))
{
   if (substr($_GET["pages"],0,4)=="last")
   $page=htmlspecialchars($_GET["pages"]);
   else
   $page = max(1,intval($_GET["pages"]));
}
else $page = '';

if (isset($_GET["hl"]) && $_GET["hl"])
$hl = trim($_GET["hl"]);
else
$hl = "";

if (isset($_GET["msg"]))
{
   if (substr($_GET["msg"],0,3)=="new")
   $msg_number=htmlspecialchars($_GET["msg"]);
   else
   $msg_number=intval(0+$_GET["msg"]);
}
else
$msg_number="";


if (!is_valid_id($topicid))
stderr($language["ERROR"],$language["ERR_FORUM_TOPIC"]);

$userid = intval($CURUSER["uid"]);

//------ Get topic info

$res = do_sqlquery("SELECT t.*, f.name, f.minclassread, minclasswrite FROM {$TABLE_PREFIX}topics t LEFT JOIN {$TABLE_PREFIX}forums f ON t.forumid=f.id WHERE t.id=$topicid LIMIT 1",true);
$arr = $res->fetch_assoc();

$locked = ($arr["locked"] == 'yes');
$subject = htmlspecialchars(unesc($arr["subject"]));
$sticky = ($arr["sticky"] == "yes");
$forumid = $arr["forumid"];
$forumname = htmlspecialchars(unesc($arr["name"]));

$block_title="<a href=\"index.php?page=forum&amp;\">".$language["FORUM"]."</a>&nbsp;&gt;&nbsp;<a href=\"index.php?page=forum&amp;action=viewforum&amp;forumid=$forumid\">$forumname</a>";


if ($CURUSER["id_level"] < $arr["minclassread"])
stderr($language["ERROR"],$language["ERR_LEVEL_CANT_VIEW"]);


$user_can_write=(($CURUSER["id_level"]>=$arr["minclasswrite"]) && (!$locked || $CURUSER["edit_forum"] == "yes"));

//------ Update hits column

quickQuery("UPDATE {$TABLE_PREFIX}topics SET views = views + 1 WHERE id=$topicid",true);

//------ Get post count

$res = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}posts WHERE topicid=$topicid",true);
$arr = $res->fetch_row();
$postcount = $arr[0];

// the message to find has been given in query string
if ($msg_number!="")
{
   if ($msg_number=="new")
   {
      // search last read by user
      $newpost=get_result("SELECT MIN(id) as np FROM {$TABLE_PREFIX}posts WHERE topicid=$topicid AND id>IFNULL((SELECT lastpostread FROM {$TABLE_PREFIX}readposts WHERE topicid=$topicid AND userid=".intval($CURUSER["uid"])."),1)",true);
      $new_id=($newpost[0]["np"]?$newpost[0]["np"]:"last");
      unset($newpost);
      $res = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}posts WHERE topicid=$topicid".($new_id=="last"?"":" AND id<=$new_id"),true);
   }
   else
   $res = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}posts WHERE topicid=$topicid AND id<=$msg_number",true);
   $arr = $res->fetch_row();
   $cur_post_pos = $arr[0];
   $_GET["pages"] = ceil($cur_post_pos / $postsperpage);
}

unset($arr);
$res->free();


//------ Make page menu
if ($page=="last")
$_GET["pages"] = ceil($postcount / $postsperpage);

list($pagertop, $pagerbottom,$limit)=forum_pager($postsperpage,$postcount, "index.php?page=forum&amp;action=viewtopic&amp;topicid=$topicid&amp;");

if ($XBTT_USE)
$query = "SELECT u.profileview, p.*, u.warn, ul.suffixcolor, ul.prefixcolor ,u.donor, u.username,UNIX_TIMESTAMP(u.lastconnect) lastconnect, IFNULL(ul.level,'".$language['UNKNOWN']."') as user_group, u.avatar, u.uploaded+IFNULL(x.uploaded,0) as uploaded".
", u.downloaded+IFNULL(x.downloaded,0) as downloaded,u.signature, c.name as name, ue.username as editor, flagpic , o.lastaction FROM {$TABLE_PREFIX}posts p".
" LEFT JOIN {$TABLE_PREFIX}users u ON p.userid=u.id LEFT JOIN xbt_users x ON x.uid=u.id LEFT JOIN {$TABLE_PREFIX}users_level ul".
" ON u.id_level=ul.id LEFT JOIN {$TABLE_PREFIX}countries c ON u.flag = c.id LEFT JOIN {$TABLE_PREFIX}users ue ON p.editedby=ue.id".
" LEFT JOIN {$TABLE_PREFIX}online o ON u.id = o.user_id ".
" WHERE topicid=$topicid ORDER BY id $limit";
else
$query = "SELECT u.profileview,  p.*, u.warn, ul.suffixcolor, ul.prefixcolor , u.donor, u.username, UNIX_TIMESTAMP(u.lastconnect) lastconnect,IFNULL(ul.level,'".$language['UNKNOWN']."') as user_group, u.avatar, u.uploaded".
", u.downloaded,u.signature, c.name as name, ue.username as editor, flagpic , o.lastaction FROM {$TABLE_PREFIX}posts p".
" LEFT JOIN {$TABLE_PREFIX}users u ON p.userid=u.id LEFT JOIN {$TABLE_PREFIX}users_level ul".
" ON u.id_level=ul.id LEFT JOIN {$TABLE_PREFIX}countries c ON u.flag = c.id LEFT JOIN {$TABLE_PREFIX}users ue ON p.editedby=ue.id".
" LEFT JOIN {$TABLE_PREFIX}online o ON u.id = o.user_id ".
" WHERE topicid=$topicid ORDER BY id $limit";


$res = get_result($query,true);
$pc = count($res);

$pn = 0;
$posts=array();
$page=(isset($page)?($page>0?max(1,$page):1):1);
$post_number=($postsperpage*($page-1))+1;
foreach($res as $id=>$arr)
{
   $posterid=$arr["userid"];

   // DT immunity
   //if ($arr["immunity"] == 'yes')
   //{
   //$imm= "<img src='images/shield.png' alt='User Have Immunity !' title='User Have Immunity !' />";
   //}
   //else
   //{
   //$imm= "";
   //}
   // DT immunity

   if ($arr["username"])
   $posts[$pn]["username"]=($arr["userid"]>1?"<a href=\"index.php?page=userdetails&amp;id=".$arr["userid"]."\">".unesc($arr["prefixcolor"]).unesc($arr["username"]).unesc($arr["suffixcolor"])."</a>":unesc($arr["username"])).get_user_icons($arr).warn($arr);
   else
   $posts[$pn]["username"]=$language["MEMBER"]."[".$arr["userid"]."]";
   // DT reputation system start
   //$reput=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}reputation_settings WHERE id =1");
   //$setrep=$reput->fetch_array();

   //$forumtpl-> set("forum_reputation", (($setrep["rep_is_online"]=="true") ? TRUE : FALSE), TRUE);

   //if ($setrep["rep_is_online"]== 'false')
   //{
   //do nothing
   //}
   //else
   //{
   //if ($arr["reputation"] == 0)
   //{
   //$reput= "<img src='images/rep/reputation_balance.gif' alt='" . $setrep["no_level"] . "' title='" . $setrep["no_level"] . "' />";
   //}
   //if ($arr["reputation"] >= 1 )
   //{
   //$reput= "<img src='images/rep/reputation_pos.gif' alt='" . $setrep["good_level"] . "' title='" . $setrep["good_level"] . "' />";
   //}
   //if ($arr["reputation"] <= -100 )
   //{
   //$reput= "<img src='images/rep/reputation_neg.gif' alt='" . $setrep["bad_level"] . "' title='" . $setrep["bad_level"] . "' />";
   //}
   //if ($arr["reputation"] >= 101 )
   //{
   //$reput= "<img src='images/rep/reputation_highpos.gif' alt='" . $setrep["best_level"] . "' title='" . $setrep["best_level"] . "' />";
   //}
   //if ($arr["reputation"] <= -101)
   //{
   //$reput= "<img src='images/rep/reputation_highneg.gif' alt='" . $setrep["worse_level"] . "' title='" . $setrep["worse_level"] . "' />";
   //}
   //$posts[$pn]["reputation"] = $reput;
   //}

   // DT end reputation system




   $posts[$pn]["date"]=get_date_time($arr["added"]);
   $posts[$pn]["elapsed"]="(".get_elapsed_time($arr["added"]) . " ago)";
   $posts[$pn]["avatar"]="<img onload=\"resize_avatar(this);\" src=\"".($arr["avatar"] && $arr["avatar"] != "" ? htmlspecialchars($arr["avatar"]): "/avatar/default_avatar.gif" )."\" alt=\"\" />";
   (is_null($arr["lastaction"])?$lastseen=$arr["lastconnect"]:$lastseen=$arr["lastaction"]);
   ((time()-$lastseen>100)?$status="<img src='images/offline.gif' border='0' alt='".$language["OFFLINE"]."'>":$status="<img src='images/online.gif' border='0' alt='".$language["ONLINE"]."'>");
   $posts[$pn]["online"]=$status;
   $posts[$pn]["user_group"]=$arr["user_group"];

   if ($arr["profileview"] == 0 || $CURUSER["uid"] == $arr["userid"]) {
      $posts[$pn]["flag"]="<img src=\"images/flag/".($arr["flagpic"] && $arr["flagpic"]!=""?$arr["flagpic"]:"unknown.gif")."\" alt=\"".($arr["name"] && $arr["name"]!=""?$arr["name"]:"unknown")."\" />";
      $posts[$pn]["ratio"]=(intval($arr['downloaded']) > 0?number_format($arr['uploaded'] / $arr['downloaded'], 2):"---");
      $posts[$pn]["uploaded"]= (makesize($arr['uploaded'], 2));
      $posts[$pn]["downloaded"]= (makesize($arr['downloaded'], 2));
   }
   else {
      $posts[$pn]["flag"]="<img src=\"images/private2.png\" title=\"private\">";
      $posts[$pn]["ratio"]="<img src=\"images/private2.png\" title=\"private\">";
      $posts[$pn]["uploaded"]= "<img src=\"images/private2.png\" title=\"private\">";
      $posts[$pn]["downloaded"]= "<img src=\"images/private2.png\" title=\"private\">";
   }
   $sql = get_result("SELECT COUNT(*) as posts FROM {$TABLE_PREFIX}posts p INNER JOIN {$TABLE_PREFIX}users u ON p.userid = u.id WHERE u.id = " . $arr["userid"],true);
   $posts[$pn]["posts"]=intval(0+$sql[0]["posts"]);
   $posts[$pn]["id"]=$arr["id"];
   $posts[$pn]["post_number"]=$post_number;

   $posts[$pn]["actions"]="";
   if ($user_can_write)
   $posts[$pn]["actions"].="<a href=\"index.php?page=forum&amp;action=quotepost&amp;topicid=$topicid&amp;postid=".$arr["id"]."\">".image_or_link($STYLEPATH."/images/f_quote.png","","[".$language["QUOTE"]."]")."</a>";

   if (($CURUSER["uid"] == $posterid && !$locked && $posterid>1) || $CURUSER["edit_forum"] == "yes")
   $posts[$pn]["actions"].="&nbsp;&nbsp;<a href=\"index.php?page=forum&amp;action=editpost&amp;postid=".$arr["id"]."\">".image_or_link($STYLEPATH."/images/f_edit.png","","[".$language["EDIT"]."]")."</a>";

   if ($CURUSER["delete_forum"] == "yes")
   $posts[$pn]["actions"].="&nbsp;&nbsp;<a onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\" href=\"index.php?page=forum&amp;action=deletepost&amp;postid=".$arr["id"]."&amp;forumid=$forumid\">".image_or_link($STYLEPATH."/images/f_delete.png","","[".$language["DELETE"]."]")."</a>";

   $posts[$pn]["body"]=($hl==""?format_comment($arr["body"]):highlight_search(format_comment($arr["body"]),explode(" ",$hl)));

   if(!empty($arr['signature']))
   $posts[$pn]["body"].=" <br /> <br /><center style='line-height: 1.5em;border-top:solid 1px;'>".format_comment($arr['signature'])."</center>";

   $posts[$pn]["msglink"]="index.php?page=forum&amp;action=viewtopic&amp;topicid=$topicid&amp;msg=".$arr["id"]."#".$arr["id"];
   $posts[$pn]["new"]= ($new_id==$arr["id"] || ($new_id=="last" && $pn==$pc) ?"<a name=\"new\" />":"");

   if (is_valid_id($arr['editedby']))
   $posts[$pn]["body"].= "<p><font size=\"1\">".$language["LAST_EDITED_BY"]." <a href=\"index.php?page=userdetails&amp;id=".$arr["editedby"]."\"><b>".$arr["editor"]."</b></a> at ".get_date_time($arr['editedat'])."</font></p>\n";

   $posts[$pn]["pm"]=($CURUSER["uid"]>1?"<a href=\"index.php?page=usercp&amp;do=pm&amp;action=edit&amp;uid=$userid&amp;what=new&amp;to=".urlencode($arr["username"])."\"><i class=\"fa fa-envelope\" aria-hidden=\"true\"></i></a>":"");
   $posts[$pn]["top"]=("<i class=\"fa fa-arrow-circle-o-up\" aria-hidden=\"true\">");
   ++$pn;
   ++$post_number;

}

unset($arr);
unset($res);

$forumtpl->set("topic_title",$subject);
$forumtpl->set("forum_pager",$pagertop);
$forumtpl->set("forum_pager_bottom",$pagerbottom);
$forumtpl->set("posts",$posts);

unset($posts);

// set this topic as read (update the reaposts table with higher post id for this topic
$ret=do_sqlquery("SELECT id FROM {$TABLE_PREFIX}readposts WHERE topicid=$topicid AND userid=".intval(0+$CURUSER["uid"]),true);
// first time this user
if (sql_num_rows($ret)==0)
quickQuery("INSERT INTO {$TABLE_PREFIX}readposts SET lastpostread=(SELECT MAX(id) FROM {$TABLE_PREFIX}posts WHERE topicid=$topicid), topicid=$topicid, userid=".intval(0+$CURUSER["uid"]),true);
else // update existing record
{
   $rp_id=$ret->fetch_row();
   quickQuery("UPDATE {$TABLE_PREFIX}readposts SET lastpostread=(SELECT MAX(id) FROM {$TABLE_PREFIX}posts WHERE topicid=$topicid) WHERE id=".$rp_id[0],true);
}
//------ Mod options

$forumtpl->set("can_write",$user_can_write,true);
$forumtpl->set("can_write_1",$user_can_write,true);
$forumtpl->set("forum_action","index.php?page=forum&amp;action=reply&amp;topicid=$topicid");
$forumtpl->set("topic_locked",($locked?image_or_link("$STYLEPATH/images/locked.png","style='margin-right: 5px'","locked")."&nbsp;".$language["TOPIC_LOCKED"]:""));


if ($CURUSER["edit_forum"] == "yes")
{
   $forumtpl->set("moderator",true,true);
   $forumtpl->set("topic_id",$topicid);
   $forumtpl->set("return_to",htmlspecialchars($_SERVER["REQUEST_URI"]));
   $forumtpl->set("sticky_yes",($sticky?"checked=\"checked\"":""));
   $forumtpl->set("sticky_no",(!$sticky?"checked=\"checked\"":""));
   $forumtpl->set("locked_yes",($locked?"checked=\"checked\"":""));
   $forumtpl->set("locked_no",(!$locked?"checked=\"checked\"":""));
   $forumtpl->set("topic_subject",$subject);
   $forumtpl->set("forum_id",$forumid);
   $f=get_result("SELECT id,name FROM {$TABLE_PREFIX}forums WHERE minclasswrite<=".intval($CURUSER["id_level"])." AND id<>$forumid",true, $btit_settings["cache_duration"]);
   $forums="<select name=\"forumid\" size=\"1\">";
   foreach($f as $id=>$ff)
   $forums.="<option value=\"".$ff["id"]."\">".htmlspecialchars(unesc($ff["name"]))."</option>";
   $forums.="</select>";
   $forumtpl->set("forums_combo",$forums);

   unset($f);
   unset($ff);
}
else
$forumtpl->set("moderator",false,true);



?>
