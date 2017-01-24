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

$forums_res = do_sqlquery("SELECT ul.suffixcolor as suf1, ul.prefixcolor as pre1, f.*, t.lastpost, t.subject, t.locked, p.userid as uid, u.username, p.added as date, p.topicid,".
" IF(t.lastpost<=(SELECT lastpostread FROM {$TABLE_PREFIX}readposts rp WHERE rp.userid=".intval($CURUSER["uid"]).
" AND rp.topicid=t.id) OR t.lastpost IS NULL,'unlocked','unlockednew') as img FROM {$TABLE_PREFIX}forums f LEFT JOIN {$TABLE_PREFIX}topics t ON f.id=t.forumid".
" LEFT JOIN {$TABLE_PREFIX}posts p ON t.lastpost=p.id".
" LEFT JOIN {$TABLE_PREFIX}users u ON p.userid=u.id  LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE (t.lastpost IS NULL OR t.lastpost=(SELECT MAX(lastpost)".
" FROM {$TABLE_PREFIX}topics WHERE forumid=f.id)) AND f.minclassread<=".intval($CURUSER["id_level"]).
" AND f.id_parent=0 ORDER BY sort,name",true);

$sub_forums = get_result("SELECT ul.suffixcolor , ul.prefixcolor, f.*, t.lastpost, t.subject, t.locked, p.userid as uid, u.username, p.added as date, p.topicid,".
" IF(t.lastpost<=(SELECT lastpostread FROM {$TABLE_PREFIX}readposts rp WHERE rp.userid=".intval($CURUSER["uid"]).
" AND rp.topicid=t.id) OR t.lastpost IS NULL,'unlocked','unlockednew') as img FROM {$TABLE_PREFIX}forums f LEFT JOIN {$TABLE_PREFIX}topics t ON f.id=t.forumid".
" LEFT JOIN {$TABLE_PREFIX}posts p ON t.lastpost=p.id".
" LEFT JOIN {$TABLE_PREFIX}users u ON p.userid=u.id LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id  WHERE (t.lastpost IS NULL OR t.lastpost=(SELECT MAX(lastpost)".
" FROM {$TABLE_PREFIX}topics WHERE forumid=f.id)) AND f.minclassread<=".intval($CURUSER["id_level"]).
" AND f.id_parent<>0 ORDER BY sort,name",true);

$subformtpl=new bTemplate();

if (sql_num_rows($forums_res) == 0)
$forumtpl->set("NO_FORUMS",true,true);
else
{
   $forums=array();
   $i=0;
   while ($forums_arr = $forums_res->fetch_assoc())
   {
      if($forums_arr["category"]=="yes")
      {
         $forums[$i]["header"] =  "<tr><td class=head colspan=5><b><center>".htmlspecialchars(unesc($forums_arr["name"]))."</b></center></td></tr>";
      }
      else
      {
         $forums[$i]["name"]  = "<a href=\"index.php?page=forum&amp;action=viewforum&amp;forumid=".$forums_arr["id"]."\">".htmlspecialchars(unesc($forums_arr["name"]))."</a>";
         $forums[$i]["description"]  =  ($forums_arr["description"]?"<br />\n".format_comment(unesc($forums_arr["description"])):"");
         $forums[$i]["topics"]  = number_format($forums_arr["topiccount"]);
         $forums[$i]["posts"]  = number_format($forums_arr["postcount"]);

         if ($forums_arr["uid"])
         {
            if ($forums_arr["username"])
            {
               $forums[$i]["lastpost"]  = date("",$forums_arr["date"])."<br />" .
               "by <a href=\"index.php?page=userdetails&amp;id=".$forums_arr["uid"]."\"><b>".unesc($forums_arr["pre1"]).unesc($forums_arr["username"]).unesc($forums_arr["suf1"])."</b></a><br />" .
               "in <a href=\"index.php?page=forum&amp;action=viewtopic&amp;topicid=".$forums_arr["topicid"]."&amp;msg=".$forums_arr["lastpost"]."#".$forums_arr["lastpost"]."\">".htmlspecialchars(unesc($forums_arr["subject"]))."</a>";
            }
            else
            {
               $forums[$i]["lastpost"]  = date("",$forums_arr["date"])."<br />" .
               "by ".$language["MEMBER"]."[".$forums_arr["uid"]."]<br />" .
               "in <a href=\"index.php?page=forum&amp;action=viewtopic&amp;topicid=".$forums_arr["topicid"]."&amp;msg=".$forums_arr["lastpost"]."#".$forums_arr["lastpost"]."\">".htmlspecialchars(unesc($forums_arr["subject"]))."</a>";
            }
         }
         else
         $forums[$i]["lastpost"]  = $language["NA"];

         $forums[$i]["status"]=image_or_link("$STYLEPATH/images/".$forums_arr["img"].".png","",$img);
         // just in case they are no subs
         $forums[$i]["subforums"]="";

         reset($sub_forums);
         $j=0;
         $subforums=array();
         foreach($sub_forums as $id=>$subfor)
         {
            if ($subfor["id_parent"]==$forums_arr["id"])
            {
               $subforums[$j]["status"]=image_or_link("$STYLEPATH/images/".$subfor["img"].".png","",$img);
               $subforums[$j]["name"]="<a href=\"index.php?page=forum&amp;action=viewforum&amp;forumid=".$subfor["id"]."\">".htmlspecialchars(unesc($subfor["name"]))."</a>";
               $subforums[$j]["description"]=htmlspecialchars(unesc($subfor["description"]));
               $subforums[$j]["topics"]=number_format($subfor["topiccount"]);
               $subforums[$j]["posts"]=number_format($subfor["postcount"]);
               if ($subfor["uid"])
               {
                  if ($forums_arr["username"])
                  {
                     $subforums[$j]["lastpost"]=date("",$subfor["date"])."<br />" .
                     "by <a href=\"index.php?page=userdetails&amp;id=".$subfor["uid"]."\"><b>".unesc($subfor["prefixcolor"]).unesc($subfor["username"]).unesc($subfor["suffixcolor"])."</b></a><br />" .
                     "in <a href=\"index.php?page=forum&amp;action=viewtopic&amp;topicid=".$subfor["topicid"]."&amp;msg=".$subfor["lastpost"]."#".$subfor["lastpost"]."\">".htmlspecialchars(unesc($subfor["subject"]))."</a>";
                  }
                  else
                  {
                     $subforums[$j]["lastpost"]  = date("",$subfor["date"])."<br />" .
                     "by ".$language["MEMBER"]."[".$subfor["uid"]."]<br />" .
                     "in <a href=\"index.php?page=forum&amp;action=viewtopic&amp;topicid=".$subfor["topicid"]."&amp;msg=".$subfor["lastpost"]."#".$subfor["lastpost"]."\">".htmlspecialchars(unesc($subfor["subject"]))."</a>";
                  }
               }
               else
               {
                  $subforums[$j]["lastpost"]  = $language["NA"];
               }
               $j++;
               unset($sub_forums[$id]);
            }
         }
         if ($j>0)
         {
            $subformtpl->set("language",$language);
            $subformtpl->set("forums",$subforums);
            $subformtpl->set("parent_forum",htmlspecialchars(unesc($forums_arr["name"]))."'s ".$language["SUBFORUM"]);
            $forums[$i]["subforums"]=$subformtpl->fetch(load_template("forum.subforums.tpl"));
         }
      }
      $i++;
   }
   $forumtpl->set("NO_FORUMS",false,true);
   $forumtpl->set("forums",$forums);
}
?>
