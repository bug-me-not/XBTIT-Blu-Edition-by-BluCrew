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


switch ($action)
  {

    case 'catchup':

        // we will update the readposts table with max post id for each topic
        $rtopics = get_result("SELECT t.id FROM {$TABLE_PREFIX}topics t LEFT JOIN {$TABLE_PREFIX}forums f ON t.forumid=f.id WHERE IFNULL(f.minclassread,999)<=".$CURUSER["id_level"],true);
        // check if record exist in readposts table

        foreach($rtopics as $id=>$rt)
          {
           $rp=get_result("SELECT id FROM {$TABLE_PREFIX}readposts WHERE topicid=".$rt["id"]." AND userid=".$CURUSER["uid"]);
           if (count($rp)>0)
              quickQuery("UPDATE {$TABLE_PREFIX}readposts SET lastpostread=(SELECT MAX(id) FROM {$TABLE_PREFIX}posts WHERE topicid=".$rt["id"].") WHERE topicid=".$rt["id"]." AND userid=".$CURUSER["uid"],true);
           else
              quickQuery("INSERT INTO {$TABLE_PREFIX}readposts SET lastpostread=(SELECT MAX(id) FROM {$TABLE_PREFIX}posts WHERE topicid=".$rt["id"]."), topicid=".$rt["id"].", userid=".$CURUSER["uid"],true);
        }
        redirect("index.php?page=forum");
        die();
      break;

    case 'deletetopic':
        $topicid = intval(0+$_GET["topicid"]);
        $forumid = intval(0+$_GET["forumid"]);

        if (!is_valid_id($topicid) || $CURUSER["delete_forum"] != "yes")
            stderr($language["ERROR"],$language["BAD_TOPIC_ID"]);

        if (isset($_GET["sure"]) && $_GET["sure"])
            $sure = htmlspecialchars($_GET["sure"]);
        else
            $sure = "";

        if (!$sure)
        {
          information_msg($language["FRM_CONFIRM"]."?",$language["ERR_DELETE_TOPIC"]."&nbsp;<a href=\"index.php?page=forum&amp;action=deletetopic&amp;topicid=$topicid&amp;sure=1&amp;forumid=$forumid\">".$language["HERE"]."</a>&nbsp;".$language["IF_YOU_ARE_SURE"]."<br />");
        }

        quickQuery("DELETE FROM {$TABLE_PREFIX}topics WHERE id=$topicid",true);
        $numtopic=sql_affected_rows();
        quickQuery("DELETE FROM {$TABLE_PREFIX}posts WHERE topicid=$topicid",true);
        $numposts=sql_affected_rows();
        quickQuery("DELETE FROM {$TABLE_PREFIX}readposts WHERE topicid=$topicid",true);

        quickQuery("UPDATE {$TABLE_PREFIX}forums SET topiccount=topiccount-$numtopic,postcount=postcount-$numposts WHERE id=$forumid",true);

        redirect("index.php?page=forum&action=viewforum&forumid=$forumid");

        die();

      break;


    case 'movetopic':
        $forumid = intval(0 + $_POST["forumid"]);
        $topicid = intval(0 + $_GET["topicid"]);

        if (!is_valid_id($forumid) || !is_valid_id($topicid) || $CURUSER["edit_forum"] != "yes")
            stderr($language["ERROR"],$language["BAD_TOPIC_ID"]);

        $res = do_sqlquery("SELECT minclasswrite FROM {$TABLE_PREFIX}forums WHERE id=$forumid",true);

        if (sql_num_rows($res) != 1)
            stderr($language["ERROR"],$language["ERR_FORUM_NOT_FOUND"]);

        $arr = $res->fetch_row();

        if ($CURUSER["id_level"] < $arr[0])
            stderr($language["ERROR"],$language["BAD_TOPIC_ID"]);

        $res = do_sqlquery("SELECT subject,forumid FROM {$TABLE_PREFIX}topics WHERE id=$topicid",true);

        if (sql_num_rows($res) != 1)
            stderr($language["ERROR"],$language["TOPIC_NOT_FOUND"]);

        $arr = $res->fetch_assoc();

        if ($arr["forumid"] != $forumid)
          quickQuery("UPDATE {$TABLE_PREFIX}topics SET forumid=$forumid WHERE id=$topicid",true);

        // modifying count topics & post
        $res=do_sqlquery("SELECT count(*) as numposts FROM {$TABLE_PREFIX}posts WHERE topicid=$topicid",true);
        $numposts=$res->fetch_assoc()['numposts'];

        quickQuery("UPDATE {$TABLE_PREFIX}forums SET topiccount=topiccount-1, postcount=postcount-$numposts WHERE id=".$arr["forumid"]);
        quickQuery("UPDATE {$TABLE_PREFIX}forums SET topiccount=topiccount+1, postcount=postcount+$numposts WHERE id=$forumid");

        // Redirect to forum page

        redirect("index.php?page=forum&action=viewforum&forumid=$forumid");
        die();

      break;

    case 'setlocked':
        $topicid = intval(0 + $_POST["topicid"]);

        if (!$topicid || $CURUSER["edit_forum"] != "yes")
            stderr($language["ERROR"],$language["BAD_TOPIC_ID"]);

        $locked = sqlesc($_POST["locked"]);
        quickQuery("UPDATE {$TABLE_PREFIX}topics SET locked=$locked WHERE id=$topicid") or sqlerr(__FILE__, __LINE__);

        redirect(urldecode($_POST["returnto"]));

        die();

      break;

    case 'setsticky':
        $topicid = intval(0 + $_POST["topicid"]);

        if (!$topicid || $CURUSER["edit_forum"] != "yes")
            stderr($language["ERROR"],$language["BAD_TOPIC_ID"]);

        $sticky = sqlesc($_POST["sticky"]);
        quickQuery("UPDATE {$TABLE_PREFIX}topics SET sticky=$sticky WHERE id=$topicid",true);

        redirect(urldecode($_POST[returnto]));
        die();

      break;

    case 'rename':

        if ($CURUSER["edit_forum"] != "yes")
          stderr($language["ERROR"],$language["ERR_NOT_AUTH"]);

        $topicid = intval(0+$_POST['topicid']);

        if (!is_valid_id($topicid))
          stderr($language["ERROR"],$language["BAD_TOPIC_ID"]);

        $subject = $_POST['subject'];

        if ($subject == '')
          stderr($language["ERROR"],$language["ERR_ENTER_NEW_TITLE"]);

        $subject = sqlesc($subject);

        quickQuery("UPDATE {$TABLE_PREFIX}topics SET subject=$subject WHERE id=$topicid") or sqlerr();

        $returnto = urldecode($_POST['returnto']);

        if ($returnto)
          redirect("$returnto");
        die();

      break;

    case 'deletepost':
      $postid = intval(0+$_GET["postid"]);
      $forumid = intval(0+$_GET["forumid"]);

      if (isset($_GET["sure"]) && $_GET["sure"])
          $sure = htmlspecialchars($_GET["sure"]);
      else
          $sure = "";

      if ($CURUSER["delete_forum"] != "yes" || !is_valid_id($postid))
        stderr($language["ERROR"],$language["ERR_FORUM_TOPIC"]);

      //------- Get topic id

      $res = do_sqlquery("SELECT (SELECT COUNT(*) FROM {$TABLE_PREFIX}posts WHERE topicid=p.topicid) as total_posts,topicid FROM {$TABLE_PREFIX}posts p WHERE id=$postid",true);
      $arr = $res->fetch_assoc() or stderr($language["ERROR"],$language["ERR_POST_NOT_FOUND"]);
      $topicid = intval($arr["topicid"]);

      if ($arr["total_posts"] < 2)
        information_msg($language["FRM_CONFIRM"]."?",$language["ERR_POST_UNIQUE"]."&nbsp;<a href=\"index.php?page=forum&amp;action=deletetopic&amp;topicid=$topicid&amp;sure=1&amp;forumid=$forumid\">".$language["ERR_POST_UNIQUE_2"]."</a>&nbsp;".$language["ERR_POST_UNIQUE_3"]);

      if (!$sure)
      {
        information_msg($language["FRM_CONFIRM"]."?",$language["ERR_DELETE_POST"]."&nbsp;<a href=\"index.php?page=forum&amp;action=deletepost&amp;postid=$postid&amp;sure=1&amp;forumid=$forumid\">".$language["HERE"]."</a>&nbsp;".$language["IF_YOU_ARE_SURE"]."<br />");
      }

      //------- Delete post
      quickQuery("DELETE FROM {$TABLE_PREFIX}posts WHERE id=$postid",true);
      $numposts=sql_affected_rows();

      // update post's count
      quickQuery("UPDATE {$TABLE_PREFIX}forums SET postcount=postcount-$numposts WHERE id=$forumid");

      // update last topic's post
      quickQuery("UPDATE {$TABLE_PREFIX}topics SET lastpost=(SELECT MAX(id) FROM {$TABLE_PREFIX}posts WHERE topicid=$topicid) WHERE id=$topicid",true);

      redirect("index.php?page=forum&action=viewtopic&topicid=$topicid");
      die();
      break;

}

?>
