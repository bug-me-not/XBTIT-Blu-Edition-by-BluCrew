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


if ($CURUSER["view_news"]=="no")
   {
       err_msg($language["ERROR"],$language["NOT_AUTHORIZED"]."!");
       stdfoot();
       exit;
}

//     global $CURUSER, $limitqry, $adm_menu, $CURRENTPATH, $TABLE_PREFIX;
//     $output="";

if ($limit>0)
  $limitqry="LIMIT $limit";

$query1_select="";
$query1_join="";
if($btit_settings["fmhack_group_colours_overall"]=="enabled")
{
    $query1_select.="`ul`.`prefixcolor`, `ul`.`suffixcolor`,";
    $query1_join.="INNER JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` ";
}

$res=get_result("SELECT ".$query1_select." n.id, n.title, n.news,UNIX_TIMESTAMP(n.date) as news_date, u.username FROM {$TABLE_PREFIX}news n INNER JOIN {$TABLE_PREFIX}users u on u.id=n.user_id ".$query1_join." ORDER BY date DESC $limitqry",true,$btit_settings['cache_duration']);

// load language file
require(load_language("lang_viewnews.php"));

$viewnewstpl = new bTemplate();
$viewnewstpl -> set("language",$language);
$viewnewstpl -> set("can_edit_news", $CURUSER["edit_news"]=="yes", TRUE);
$viewnewstpl -> set("can_edit_news_1", $CURUSER["edit_news"]=="yes", TRUE);
$viewnewstpl -> set("can_delete_news", $CURUSER["delete_news"]=="yes", TRUE);

$viewnews=array();
$i=0;

$viewnewstpl -> set("news_exists", (count($res) > 0),TRUE);
$viewnewstpl -> set("insert_news_link", (count($res) == 0?"<a href=\"index.php?page=news&amp;act=add\"><img border=\"0\" alt=\"".$language["ADD"]."\" src=\"$BASEURL/images/new.gif\" /></a>":""));

include("$THIS_BASEPATH/include/offset.php");


foreach ($res as $rows)
  {
  
      $viewnews[$i]["add_edit_news"] = "<a href=\"index.php?page=news&amp;act=add\">".$language["ADD"]."</a>&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=news&amp;act=edit&amp;id=".$rows["id"]."\">".$language["EDIT"]."</a>";
      $viewnews[$i]["delete_news"] = "&nbsp;&nbsp;&nbsp;<a onclick=\"return confirm('". str_replace("'","\'",$language["DELETE_CONFIRM"])."')\" href=\"index.php?page=news&amp;act=del&amp;id=".$rows["id"]."\">".$language["DELETE"]."</a>";
      $viewnews[$i]["user_posted"]=(($btit_settings["fmhack_group_colours_overall"]=="enabled")?unesc($rows["prefixcolor"].$rows["username"].$rows["suffixcolor"]):unesc($rows["username"]));
      $viewnews[$i]["posted_date"] = date("d/m/Y H:i",$rows["news_date"]-$offset);
      $viewnews[$i]["news_title"] = unesc($rows["title"]);
      $viewnews[$i]["news"] = format_comment($rows["news"]);
    
      $i++;
    
  }

$viewnewstpl -> set("viewnews", $viewnews);

?>