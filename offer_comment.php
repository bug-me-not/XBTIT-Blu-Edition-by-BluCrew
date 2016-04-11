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


if (!$CURUSER || $CURUSER["uid"]==1)
{
   stderr($language["ERROR"],$language["ONLY_REG_COMMENT"]);
}

$comment = sql_esc($_POST["comment"]);

$id = $_GET["id"];
if (isset($_GET["cid"]))
$cid = intval($_GET["cid"]);
else
$cid=0;


if (isset($_GET["action"]))
{
   if ($CURUSER["delete_torrents"]=="yes" && $_GET["action"]=="delete")
   {
      quickQuery("DELETE FROM {$TABLE_PREFIX}offer_comments WHERE id=$cid",true);
      redirect("index.php?page=expectdetails&id=$id#comments");
      exit;
   }
}

$tpl_offer_comment=new bTemplate();

$tpl_offer_comment->set("language",$language);
$tpl_offer_comment->set("comment_id",$id);
$tpl_offer_comment->set("comment_username",$CURUSER["username"]);
$tpl_offer_comment->set("comment_comment",textbbcode("comment","comment",htmlspecialchars(unesc($comment))));


if (isset($_POST["info_hash"])) {
   if ($_POST["confirm"]==$language["FRM_CONFIRM"]) {
      $comment = addslashes($_POST["comment"]);
      $user=AddSlashes($CURUSER["username"]);
      if ($user=="") $user="Anonymous";
      quickQuery("INSERT INTO {$TABLE_PREFIX}offer_comments (added,text,ori_text,user,offer_id) VALUES (NOW(),\"$comment\",\"$comment\",\"$user\",\"" . sql_esc(StripSlashes($_POST["info_hash"])) . "\")",true);
      redirect("index.php?page=expectdetails&id=$id#comments");
      die();
   }

   # Comment preview by miskotes
   #############################

   if ($_POST["confirm"]==$language["FRM_PREVIEW"]) {

      $tpl_offer_comment->set("PREVIEW",TRUE,TRUE);
      $tpl_offer_comment->set("comment_preview",set_block($language["COMMENT_PREVIEW"],"center",format_comment($comment),false));

      #####################
      # Comment preview end
   }
   else
   {
      redirect("index.php?page=torrent-details&id=" . StripSlashes($_POST["info_hash"])."#comments");
      die();
   }
}
else
$tpl_offer_comment->set("PREVIEW",FALSE,TRUE);

?>
