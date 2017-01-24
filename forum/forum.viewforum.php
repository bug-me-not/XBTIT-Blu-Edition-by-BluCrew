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


$forumid = intval(0+$_GET["forumid"]);


if (!is_valid_id($forumid))
  stderr($language["ERROR"],$language["BAD_ID"]);

if (isset($_GET["page"]) && $_GET["page"])
$page = max(1,intval(0+$_GET["page"]));
else $page = '';

$userid = intval(0+$CURUSER["uid"]);

//------ Get forum name + create quickjump dropdown

$res = get_result("SELECT id, name, minclassread, minclasscreate FROM {$TABLE_PREFIX}forums WHERE minclassread<=".intval($CURUSER["id_level"]),true,$btit_settings["cache_duration"]);
$quickjmp="\n<form method=\"get\" action=\"index.php?page=forum\" name=\"quickjump\">";
$quickjmp.="\n<select name=\"forumid\" onchange=\"location.href=this.options[this.selectedIndex].value\" size=\"1\">";

$forumfound=false;
$user_can_create=false;
foreach($res as $id=>$arr)
    {
    $quickjmp.="\n<option value=\"index.php?page=forum&amp;action=viewforum&amp;forumid=" . $arr["id"] . ($forumid == $arr["id"] ? "\" selected=\"selected\">" : "\">") . htmlspecialchars(unesc($arr["name"])) . "</option>\n";
    if ($forumid==$arr["id"])
      {
        $forumname = htmlspecialchars(unesc($arr["name"]));
        $forumfound=true;
        $user_can_create=($arr["minclasscreate"]<=$CURUSER["id_level"]);

    }
}
$quickjmp.="\n</select>\n</form>\n";

if (!$forumfound)
  stderr($language["ERROR"],$language["ERR_NOT_PERMITED"]."<br />\n$forumname" );

unset($res);
unset($arr);

$block_title="<a href=\"index.php?page=forum\">".$language["FORUM"]."</a>&nbsp;&gt;&nbsp;$forumname";

//------ Page links

//------ Get topic count

$perpage = $CURUSER["topicsperpage"];
if (!$perpage) $perpage = 20;

$res = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}topics WHERE forumid=$forumid",true);
$arr =$res->fetch_row();
$numtopics=$arr[0];
$res->free();
unset($arr);

list($pagertop, $pagerbottom, $limit)=forum_pager($perpage,$numtopics, "index.php?page=forum&amp;action=viewforum&amp;forumid=$forumid&amp;");

//------ Get topics data

$topicsres = do_sqlquery("SELECT t.*,(SELECT COUNT(*) FROM {$TABLE_PREFIX}posts WHERE topicid=t.id) as num_posts,".
                         "  ul.suffixcolor as suf1, ul.prefixcolor as pre1,ulp.username as lastposter, ulp.id as lastposter_uid, p.added as start_date, ull.suffixcolor as suf2, ull.prefixcolor as pre2, us.username as starter,".
                         " IF(t.lastpost<=(SELECT lastpostread FROM {$TABLE_PREFIX}readposts rp WHERE rp.userid=".intval($CURUSER["uid"]).
                         " AND rp.topicid=t.id) OR t.lastpost IS NULL,'unlocked','unlockednew') as img".
                         " FROM {$TABLE_PREFIX}topics t LEFT JOIN {$TABLE_PREFIX}users us ON t.userid=us.id LEFT JOIN {$TABLE_PREFIX}users_level ull ON us.id_level=ull.id".
                         " LEFT JOIN {$TABLE_PREFIX}posts p ON t.lastpost=p.id LEFT JOIN {$TABLE_PREFIX}users ulp ON p.userid=ulp.id LEFT JOIN {$TABLE_PREFIX}users_level ul ON ulp.id_level=ul.id".
                         " WHERE forumid=$forumid ORDER BY sticky, lastpost DESC $limit",true);

$postsperpage = $CURUSER["postsperpage"];
  if (!$postsperpage) $postsperpage = 15;

if ($numtopics > 0)
  {
    $forumtpl->set("NO_TOPICS",false,true);

    $topics=array();
    $i=0;
    while ($topicarr = $topicsres->fetch_assoc())
    {
      $topicid = $topicarr["id"];
      $topic_userid = $topicarr["userid"];
      $topic_views = $topicarr["views"];
      $locked = $topicarr["locked"] == "yes";
      $sticky = $topicarr["sticky"] == "yes";
      $tpages = floor(intval($topicarr["num_posts"]) / $postsperpage);

      if (($tpages * $postsperpage) != intval($topicarr["num_posts"]))
        ++$tpages;

      if ($tpages > 1)
      {
        $topicpages = "&nbsp;(<img src=\"images/multipage.gif\" alt=\"multipage\" />";
        for ($x = 1; $x <= ($tpages<=3?$tpages:3); ++$x)
          $topicpages .= "&nbsp;<a href=\"index.php?page=forum&amp;action=viewtopic&amp;topicid=$topicid&amp;pages=$x\">$x</a>";
        $topicpages .= ($tpages<=3?")":"&nbsp;<a href=\"index.php?page=forum&amp;action=viewtopic&amp;topicid=$topicid&amp;pages=$tpages\">&raquo;</a>)");
      }
      else
        $topicpages = "";

      $lppostid = 0 + $topicarr["lastpost"];
      $lpuserid = 0 + $topicarr["lastposter_uid"];
      if ($lpuserid>1)
         $lpusername = ($topicarr["lastposter"]?"<a href=\"index.php?page=userdetails&amp;id=$lpuserid\"><b>".unesc($topicarr["pre1"]).unesc($topicarr["lastposter"]).unesc($topicarr["suf1"])."</b></a>":$language["MEMBER"]."[$topic_userid]");
      else
          $lpusername = ($topicarr["lastposter"]?unesc($topicarr["lastposter"]):$language["MEMBER"]."[$topic_userid]");
      $new = $topicarr["img"]=="unlockednew";

      $topicpic = ($locked ? ($new ? "lockednew" : "locked") : $topicarr["img"]);

      $subject = ($sticky ? $language["STICKY"].": " : "") . "<a href=\"index.php?page=forum&amp;action=viewtopic&amp;topicid=$topicid\"><b>" .
      htmlspecialchars(unesc($topicarr["subject"])) . "</b></a>".
      ($new?"&nbsp;<a href=\"index.php?page=forum&amp;action=viewtopic&amp;topicid=$topicid&amp;msg=new#new\">".image_or_link("$STYLEPATH/images/new.gif","",$language["NEW"])."</a>":"")."$topicpages";

      $topics[$i]["view"]=number_format($topic_views);
      $topics[$i]["replies"]=intval($topicarr["num_posts"]) - 1;
      if ($topic_userid>1)
         $topics[$i]["starter"]=($topicarr["starter"]?"<a href=\"index.php?page=userdetails&amp;id=$topic_userid\"><b>".unesc($topicarr["pre2"]).unesc($topicarr["starter"]).unesc($topicarr["suf2"])."</b></a>":$language["MEMBER"]."[$topic_userid]");
      else
         $topics[$i]["starter"]=($topicarr["starter"]?unesc($topicarr["starter"]):$language["MEMBER"]."[$topic_userid]");
      $topics[$i]["status"]=image_or_link("$STYLEPATH/images/$topicpic.png","",$topicpic);
      $topics[$i]["topic"]=$subject;
      $topics[$i]["lastpost"]=get_date_time($topicarr["start_date"])." ". $language["BY"] . " $lpusername";
      $i++;

    } // while

    $forumtpl->set("topics",$topics);

} // if
else
   $forumtpl->set("NO_TOPICS",true,true);

$forumtpl->set("forum_pager",$pagertop);
$forumtpl->set("forum_pager_bottom",$pagerbottom);

$sub_forums = get_result("SELECT ul.suffixcolor , ul.prefixcolor , f.*, t.lastpost,t.subject, t.locked, p.userid as uid, u.username, p.added as date, p.topicid,".
                          " IF(t.lastpost<=(SELECT lastpostread FROM {$TABLE_PREFIX}readposts rp WHERE rp.userid=".intval($CURUSER["uid"]).
                          " AND rp.topicid=t.id) OR t.lastpost IS NULL,'unlocked','unlockednew') as img FROM {$TABLE_PREFIX}forums f LEFT JOIN {$TABLE_PREFIX}topics t ON f.id=t.forumid".
                          " LEFT JOIN {$TABLE_PREFIX}posts p ON t.lastpost=p.id".

                          " LEFT JOIN {$TABLE_PREFIX}users u ON p.userid=u.id LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE (t.lastpost IS NULL OR t.lastpost=(SELECT MAX(lastpost)".
                          " FROM {$TABLE_PREFIX}topics WHERE forumid=f.id)) AND f.minclassread<=".intval($CURUSER["id_level"]).
                          " AND f.id_parent=$forumid ORDER BY sort,name",true);

if (count($sub_forums)>0)
  {
   $subforms=array();
   $i=0;
   foreach($sub_forums as $id=>$subfor)
      {
        $subforums[$i]["status"]=image_or_link("$STYLEPATH/images/".$subfor["img"].".png","",$subfor["img"]);
        $subforums[$i]["name"]="<a href=\"index.php?page=forum&amp;action=viewforum&amp;forumid=".$subfor["id"]."\">".htmlspecialchars(unesc($subfor["name"]))."</a>";
        $subforums[$i]["description"]  =  ($subfor["description"]?"<br />\n".format_comment(unesc($subfor["description"])):"");
        $subforums[$i]["topics"]=number_format($subfor["topiccount"]);
        $subforums[$i]["posts"]=number_format($subfor["postcount"]);
        if ($subfor["uid"])
          $subforums[$i]["lastpost"]=date("",$subfor["date"])."<br />by&nbsp;" .
                    ($subfor["username"]?"<a href=\"index.php?page=userdetails&amp;id=".$subfor["uid"]."\"><b>".unesc($subfor["prefixcolor"]).unesc($subfor["username"]).unesc($subfor["suffixcolor"])."</b></a><br />":$language["MEMBER"]."[".$subfor["topicid"]."]")."<br />\n" .
                    "in <a href=\"index.php?page=forum&amp;action=viewtopic&amp;topicid=".$subfor["topicid"]."&amp;msg=".$subfor["lastpost"]."#".$subfor["lastpost"]."\">".htmlspecialchars(unesc($subfor["subject"]))."</a>";
        else
          $subforums[$i]["lastpost"]  = $language["NA"];
        $i++;
   }
   $forumtpl->set("forums",$subforums);
   $forumtpl->set("HAS_SUBFORUMS",true,true);
}
else
   $forumtpl->set("HAS_SUBFORUMS",false,true);

$forumtpl->set("forum_name",$forumname);
$forumtpl->set("sub_forum_name",$forumname."'s ".$language["SUBFORUMS"]);
$forumtpl->set("locked_legend",image_or_link("$STYLEPATH/images/locked.png","style='margin-right: 5px'","locked")."&nbsp;".$language["LOCKED"]);
$forumtpl->set("unlocked_legend",image_or_link("$STYLEPATH/images/unlocked.png","style='margin-right: 5px'","unlocked")."&nbsp;".$language["UNLOCKED"]);
$forumtpl->set("locked_new_legend",image_or_link("$STYLEPATH/images/lockednew.png","style='margin-right: 5px'","lockednew")."&nbsp;".$language["LOCKED_NEW"]);
$forumtpl->set("unlocked_new_legend",image_or_link("$STYLEPATH/images/unlockednew.png","style='margin-right: 5px'","unlockednew")."&nbsp;".$language["UNLOCKED_NEW"]);
$forumtpl->set("quick_jump_combo",$quickjmp);
$forumtpl->set("forum_action","index.php?page=forum&amp;action=newtopic&amp;forumid=$forumid");
$forumtpl->set("can_create",$user_can_create,true);

unset($topics);
unset($topicarr);
$topicsres->free();

?>
