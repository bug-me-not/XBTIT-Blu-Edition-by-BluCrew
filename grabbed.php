<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
// Grabbed Hack by DiemThuy - Feb 2010
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


require_once("include/functions.php");

global $BASEURL, $CURUSER, $language, $btit_settings;

if(!isset($CURUSER) || !is_array($CURUSER))
{
   session_name("BluRG");
   session_start();
   $CURUSER=$_SESSION["CURUSER"];
}

if ($CURUSER["id_level"]==1)
{
   redirect("index.php&page=users"); // redirects to users.php if guest
   exit();
}
$grabbedtpl= new bTemplate();
$grabbedtpl-> set("language",$language);

if($XBTT_USE)
$res_load=get_result("SELECT ".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?"`f`.`id` `fileid`, ":"")."`d`.`hash`, `d`.`time`, `f`.`filename`, if(`fu`.`active`=1,1,NULL) `status` FROM `{$TABLE_PREFIX}down_load` `d` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `d`.`hash` = `f`.`info_hash` LEFT JOIN `xbt_files` `xf` ON `f`.`bin_hash` = `xf`.`info_hash` LEFT JOIN `xbt_users` `u` ON `d`.`pid` = `u`.`torrent_pass` LEFT JOIN `xbt_files_users` `fu` ON (`u`.`uid`=`fu`.`uid` AND xf.fid=fu.fid) WHERE  `d`.`pid` = '".$CURUSER["pid"]."'",true,$btit_settings["cache_duration"]);
else
$res_load=get_result("SELECT ".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?"`f`.`id` `fileid`, ":"")."`d`.`hash`, `d`.`time`, `f`.`filename` , `p`.`status` FROM `{$TABLE_PREFIX}down_load` `d` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `d`.`hash` = `f`.`info_hash` LEFT JOIN `{$TABLE_PREFIX}peers` `p` ON `d`.`hash` = `p`.`infohash` WHERE  `d`.`pid` = '".$CURUSER["pid"]."' GROUP BY `d`.`hash` ORDER BY `d`.`time` DESC",true,$btit_settings["cache_duration"]);

$count = count($res_load);
$res_load=null;

list($pagertop,$pagerbottom,$limit)=pager(25,$count,"index.php?page=grabbed&");

if($XBTT_USE)
$res_load=get_result("SELECT ".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?"`f`.`id` `fileid`, ":"")."`d`.`hash`, `d`.`time`, `f`.`filename`, if(`fu`.`active`=1,1,NULL) `status` FROM `{$TABLE_PREFIX}down_load` `d` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `d`.`hash` = `f`.`info_hash` LEFT JOIN `xbt_files` `xf` ON `f`.`bin_hash` = `xf`.`info_hash` LEFT JOIN `xbt_users` `u` ON `d`.`pid` = `u`.`torrent_pass` LEFT JOIN `xbt_files_users` `fu` ON (`u`.`uid`=`fu`.`uid` AND xf.fid=fu.fid) WHERE  `d`.`pid` = '".$CURUSER["pid"]."'",true,$btit_settings["cache_duration"]);
else
$res_load=get_result("SELECT ".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?"`f`.`id` `fileid`, ":"")."`d`.`hash`, `d`.`time`, `f`.`filename` , `p`.`status` FROM `{$TABLE_PREFIX}down_load` `d` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `d`.`hash` = `f`.`info_hash` LEFT JOIN `{$TABLE_PREFIX}peers` `p` ON `d`.`hash` = `p`.`infohash` WHERE  `d`.`pid` = '".$CURUSER["pid"]."' GROUP BY `d`.`hash` ORDER BY `d`.`time` DESC $limit",true,$btit_settings["cache_duration"]);

if ($res_load)
{
   $grabbed=array();
   $i=0;
   foreach ($res_load as $row_load)
   {
      if (!is_null($row_load["status"]))
      {
         $act="<b><span style='color:green'>".$language["GRAB_STILL_ACTIVE"]."</span></b>";
      }
      else
      {
         $act="<b><span style='color:red'>".$language["GRAB_NOT_ACTIVE"]."</span></b>";
      }
      $grabbed[$i]["filename"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?strtr($row_load["filename"], $res_seo["str"], $res_seo["strto"])."-".$row_load["fileid"].".html":"index.php?page=torrent-details&id=".$row_load["hash"])."'>".$row_load["filename"]."</a>";
      $grabbed[$i]["date"]=$row_load["time"];
      $grabbed[$i]["active"]=$act;
      $i++;
   }
}
$grabbedtpl->set("pagertop",$pagertop);
$grabbedtpl->set("grabbed",$grabbed);
$grabbedtpl->set("pagerbottom",$pagerbottom);
?>
