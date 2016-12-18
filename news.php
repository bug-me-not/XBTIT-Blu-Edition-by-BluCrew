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


require_once(load_language("lang_news.php"));

global $CURUSER, $language, $newstpl;

if (isset($_GET["act"])) $action=$_GET["act"];
else $action ="viewnews";

if ($CURUSER["edit_news"]!="yes")
   {
   err_msg($language["ERROR"],$language["ERR_NOT_AUTH"]);
   stdfoot();
   exit();
   }

if ($action=="del")
   {
       if ($CURUSER["delete_news"]=="yes")
          {
              quickQuery("DELETE FROM {$TABLE_PREFIX}news WHERE id=".$_GET["id"],true);
              redirect("index.php");
              exit();
          }
          else
              {
              stderr($language["ERROR"],$language["CANT_DELETE_NEWS"]);
              stdfoot();
              exit();
              }

   }
elseif ($action=="edit")
       {
       if ($CURUSER["edit_news"]=="yes")
          {
              $rnews=get_result("SELECT * FROM {$TABLE_PREFIX}news WHERE id=".intval($_GET["id"]),true,$btit_settings['cache_duration']);
              if (!$rnews)
                 {
                 stderr($language["ERROR"],$language["ERR_BAD_NEWS_ID"]);
                 stdfoot();
                 exit();
                 }
              $row=$rnews[0];
              if ($row)
                 {
                   $news=unesc($row["news"]);
                   $title=unesc($row["title"]);
                 }
              else
                  {
                   stderr($language["ERROR"],$language["ERR_NO_NEWS_ID"]);
                   stdfoot();
                   exit();
                  }
          }
          else
              {
              stderr($language["ERROR"],$language["CANT_DELETE_NEWS"]);
              stdfoot();
              exit();
              }

global $language, $newstpl;

    $newstpl=new bTemplate();
    $newstpl->set("language",$language);

    $newstpl->set("ADD_EDIT",true,true);

    $tplnews=array();
    $tplnews["action"]="index.php?page=news&amp;act=confirm";
    $tplnews["hidden_action"]=$action;
    $tplnews["hidden_id"]=$_GET["id"];
    $tplnews["news_title"]=$title;
    $tplnews["bbcode"]=textbbcode("news","news",$news);
    $newstpl->set("news",$tplnews);

       }


elseif ($action=="add")
{
global $news, $title, $CURUSER, $language, $newstpl;

    $newstpl=new bTemplate();
    $newstpl->set("language",$language);

    $newstpl->set("ADD_EDIT",true,true);

    $tplnews=array();
    $tplnews["action"]="index.php?page=news&amp;act=confirm";
    $tplnews["hidden_action"]=$action;
    $tplnews["hidden_id"]=$_GET["id"];
    $tplnews["news_title"]=$title;
    $tplnews["bbcode"]=textbbcode("news","news",$news);
    $newstpl->set("news",$tplnews);

}

elseif ($action=="confirm")
{
if (!isset($_POST["conferma"])) ;
      elseif ($_POST["conferma"] == $language["FRM_CONFIRM"])
         {
         if (isset($_POST["news"]) && isset($_POST["title"]))
            {
              $news=$_POST["news"];
              $uid=$CURUSER["uid"];
              $title=$_POST["title"];
              if ($news=="" || $title=="")
              {
                  err_msg($language["ERROR"],$language["ERR_INS_TITLE_NEWS"]);
              }
              else
              {
                $news=sqlesc($news);
                $title=sqlesc($title);
                $nid=intval($_POST["id"]);
                $action=$_POST['action'];
                if ($action=="edit")
                   quickQuery("UPDATE {$TABLE_PREFIX}news SET news=$news, title=$title WHERE id=$nid",true);
                else
                    quickQuery("INSERT INTO {$TABLE_PREFIX}news (news,title,user_id,date) VALUES ($news, $title, $uid, NOW())",true);
                redirect("index.php");
                exit();
              }
            }
         }
         elseif ($_POST["conferma"] == $language["FRM_CANCEL"]) {
                redirect("index.php");
                exit();
                }
         else {
              $title="";
              $news="";
         }
}
else
{
    header("Location: index.php?page=viewnews");
}

?>