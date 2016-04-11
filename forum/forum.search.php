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


if (isset($_GET["keywords"]) && $_GET["keywords"])
    $keywords = trim($_GET["keywords"]);
else
    $keywords = "";

if ($keywords != "")
{
    $perpage = $CURUSER["topicsperpage"];
    if (!$perpage) $perpage = 20;

    $pagemenu1="";
    $page = (isset($_GET["page"])?max(1, intval(0 + $_GET["page"])):1);

    $ekeywords = sqlesc($keywords);

    $res = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}posts WHERE MATCH (body) AGAINST ($ekeywords IN BOOLEAN MODE)",true);
    $arr = $res->fetch_row();
    $hits = intval(0 + $arr[0]);
    if ($hits == 0)
      {
        $forumtpl->set("NO_TOPICS",true, true);
    }
    else
      {
        $forumtpl->set("NO_TOPICS",false, true);
        list($pagertop,$pagerbottom, $limit)=forum_pager($perpage,$hits, "index.php?page=forum&amp;action=search&amp;keywords=" . htmlspecialchars($keywords) . "&amp;");


        $res = get_result("SELECT p.*, t.subject, f.id as forumid, f.name as forumname, u.username, p.added, MATCH (p.body) AGAINST ($ekeywords IN BOOLEAN MODE) as score FROM {$TABLE_PREFIX}posts p".
                        " LEFT JOIN {$TABLE_PREFIX}users u ON p.userid=u.id INNER JOIN {$TABLE_PREFIX}topics t ON p.topicid=t.id".
                        " INNER JOIN {$TABLE_PREFIX}forums f ON t.forumid=f.id".
                        " WHERE IFNULL(f.minclassread,999)<=".$CURUSER["id_level"]." AND MATCH (p.body) AGAINST ($ekeywords IN BOOLEAN MODE)".
                        " ORDER BY score, added DESC  $limit",true);

        $search=array();
        $i=0;
        foreach($res as $id=>$sr)
        {
            if ($sr["forumname"] == "")
                continue;

            $search[$i]["match"]=$sr["score"];
            $search[$i]["postid"]=$sr["id"];
            $search[$i]["topic"]="<a href=\"index.php?page=forum&amp;action=viewtopic&amp;topicid=".$sr["topicid"]."&amp;hl=".urlencode($keywords)."&amp;msg=".$sr["id"]."#".$sr["id"]."\">".unesc(htmlspecialchars($sr["subject"]))."</a>";
            $search[$i]["forum"]="<a href=\"index.php?page=forum&amp;action=viewforum&amp;forumid=".$sr["forumid"]."\">".unesc(htmlspecialchars($sr["forumname"]))."</a>";
            $search[$i]["author"]=get_date_time($sr["added"])."&nbsp;".$language["AT"]."&nbsp;".($sr["username"] == ""?"unknown[".$sr["userid"]."]":"<a href=\"index.php?page=userdetails&amp;id=".$sr["userid"]."\">".unesc(htmlspecialchars($sr["username"]))."</a>");
            $search[$i]["body"]=highlight_search(cut_string($sr["body"],200),explode(" ",$keywords));
            $i++;
        }
        $forumtpl->set("topics",$search);

    }

    $forumtpl->set("forum_pager",$pagertop);
    $forumtpl->set("results",true, true);
    $forumtpl->set("search_hits",$i);

}
else
    $forumtpl->set("results",false, true);

$forumtpl->set("search_keywords",$keywords);


?>
