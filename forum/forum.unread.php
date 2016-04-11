<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2007  Btiteam
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


if (isset($_GET["page"]) && $_GET["page"])
$page = max(1,intval(0+$_GET["page"]));
else $page = '';

$block_title=$language["TOPIC_UNREAD_POSTS"];

//------ Page links

//------ Get topic count

$perpage = $CURUSER["topicsperpage"];
if (!$perpage) $perpage = 20;

//$res = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}topics t LEFT JOIN {$TABLE_PREFIX}readposts r ON t.id=r.topicid WHERE t.lastpost>IF(r.lastpostread IS NULL,0, r.lastpostread)",true);
$res = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}topics t LEFT JOIN {$TABLE_PREFIX}readposts rp ON t.id=rp.topicid AND rp.userid=".intval($CURUSER["uid"]).
                         " LEFT JOIN {$TABLE_PREFIX}users us ON t.userid=us.id LEFT JOIN {$TABLE_PREFIX}forums f ON t.forumid=f.id ".
                         " LEFT JOIN {$TABLE_PREFIX}posts p ON t.lastpost=p.id LEFT JOIN {$TABLE_PREFIX}users ulp ON p.userid=ulp.id ".
                         " WHERE t.lastpost>IF(rp.lastpostread IS NULL,0, rp.lastpostread) AND IFNULL(f.minclassread,999)<=".$CURUSER["id_level"].
                         " ORDER BY lastpost DESC $limit",true);

$arr = $res->fetch_row();
$numtopics=$arr[0];
$res->free();
unset($arr);

list($pagertop, $pagerbottom, $limit)=forum_pager($perpage,$numtopics, "index.php?page=forum&amp;action=viewunread&amp;");

//------ Get topics data

$topicsres = do_sqlquery("SELECT DISTINCT t.*,(SELECT COUNT(*) FROM {$TABLE_PREFIX}posts WHERE topicid=t.id) as num_posts,".
                         " ull.suffixcolor as suf2, ull.prefixcolor as pre2,  ulp.username as lastposter, ulp.id as lastposter_uid, p.added as start_date, us.username as starter, ul.suffixcolor as suf1, ul.prefixcolor as pre1,".
                         " IF(t.lastpost<rp.lastpostread OR t.lastpost IS NULL,'unlocked','unlockednew') as img".
                         " FROM {$TABLE_PREFIX}topics t LEFT JOIN {$TABLE_PREFIX}readposts rp ON t.id=rp.topicid AND rp.userid=".intval($CURUSER["uid"]).
                         " LEFT JOIN {$TABLE_PREFIX}users us ON t.userid=us.id LEFT JOIN {$TABLE_PREFIX}users_level ull ON us.id_level=ull.id LEFT JOIN {$TABLE_PREFIX}forums f ON t.forumid=f.id".
                         " LEFT JOIN {$TABLE_PREFIX}posts p ON t.lastpost=p.id LEFT JOIN {$TABLE_PREFIX}users ulp ON p.userid=ulp.id LEFT JOIN {$TABLE_PREFIX}users_level ul ON ulp.id_level=ul.id".
                         " WHERE t.lastpost>IF(rp.lastpostread IS NULL,0, rp.lastpostread) AND IFNULL(f.minclassread,999)<=".$CURUSER["id_level"].
                         " ORDER BY lastpost DESC $limit",true);

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
        $topicpages = " (<img src=images/multipage.gif>";
        for ($i = 1; $i <= $tpages; ++$i)
          $topicpages .= " <a href=\"index.php?page=forum&amp;action=viewtopic&amp;topicid=$topicid&amp;pages=$i\">$i</a>";
        $topicpages .= ")";
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
      htmlspecialchars(unesc($topicarr["subject"])) .
      "&nbsp;<a href=\"index.php?page=forum&amp;action=viewtopic&amp;topicid=$topicid&amp;msg=new#new\">".image_or_link("$STYLEPATH/images/new.gif","",$language["NEW"])."</a>".
      "</b></a>$topicpages";

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


?>
