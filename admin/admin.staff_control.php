<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Xbtiteam
//
//    This file is part of xbtit.
//
// Staff Control by DiemThuy - Nov 2010
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

if (!defined("IN_ACP"))
      die("non direct access!");



$action = $_GET['action'];

// Undo
if($action =="undo")
{
    (isset($_GET["or"]) && !empty($_GET["or"]) && is_numeric($_GET["or"])) ? $ms = (int)0+$_GET["or"] : $ms=0;
    (isset($_GET["id"]) && !empty($_GET["id"]) && is_numeric($_GET["id"])) ? $msg = (int)0+$_GET["id"] : $msg=0;

    if($ms>0 && $msg>0)
        quickQuery("UPDATE `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}rank` `r` ON `u`.`id`=`r`.`userid` SET `u`.`id_level`=".$ms.", `r`.`undone`='yes' WHERE `u`.`id`=".$msg, true);
		
	redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=staff_control");
	exit();
}

$torrentsperpage=(isset($CURUSER["torrentsperpage"]) && $CURUSER["torrentsperpage"]>0)?$CURUSER["torrentsperpage"]:15;
$res=get_result("SELECT COUNT(*) `count` FROM {$TABLE_PREFIX}rank", true, $btit_settings["cache_duration"]);
$count=$res[0]["count"];
list($pagertop, $pagerbottom, $limit) = pager($torrentsperpage, $count, "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=staff_control&amp;");

$admintpl->set("pagertop_enabled", ((isset($pagertop) && !empty($pagertop))?true:false), true);
$admintpl->set("pagerbottom_enabled", ((isset($pagerbottom) && !empty($pagerbottom))?true:false), true);
$admintpl->set("pagertop", $pagertop);
$admintpl->set("pagerbottom", $pagertop);

//Here we will select the data from the database
// Query enhanced to eliminate the need for all the other queries ;)
$res=get_result("SELECT `r`.`userid` `changed_id`, `ul1`.`prefixcolor` `changed_current_prefixcolor`, `u1`.`username` `changed_username`, `ul1`.`suffixcolor` `changed_current_suffixcolor`, `u1`.`id_level` `changed_current_id_level`, `ul2`.`prefixcolor` `changed_old_prefixcolor`, `ul2`.`suffixcolor` `changed_old_suffixcolor`, `ul2`.`level` `changed_old_level`, `ul1`.`level` `changed_new_level`, `r`.`old_rank` `changed_old_id_level`, `r`.`byt` `changer_id`, `ul3`.`prefixcolor` `changer_prefixcolor`, `u2`.`username` `changer_username`, `ul3`.`suffixcolor` `changer_suffixcolor`, `ul4`.`prefixcolor` `changed_real_prefixcolor`, `ul4`.`suffixcolor` `changed_real_suffixcolor`, UNIX_TIMESTAMP( `r`.`date` ) `date` , `r`.`undone` FROM `{$TABLE_PREFIX}rank` `r` LEFT JOIN `{$TABLE_PREFIX}users` `u1` ON `r`.`userid` = `u1`.`id` LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `r`.`byt` = `u2`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul1` ON `r`.`new_rank` = `ul1`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul2` ON `r`.`old_rank` = `ul2`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul3` ON `u2`.`id_level` = `ul3`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul4` ON `u1`.`id_level` = `ul4`.`id` ORDER BY `r`.`date` DESC ".$limit, true, $btit_settings["cache_duration"]);

$hit=array();
$i=0;

foreach($res as $row)
{
    $hit[$i]["user"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$row["changed_id"]."_".strtr($row["changed_username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$row["changed_id"])."'>".unesc($row["changed_real_prefixcolor"].$row["changed_username"].$row["changed_real_suffixcolor"])."</a>";
    $hit[$i]["by"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$row["changer_id"]."_".strtr($row["changer_username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$row["changer_id"])."'>".unesc($row["changer_prefixcolor"].$row["changer_username"].$row["changer_suffixcolor"])."</a>";
    $hit[$i]["old"]=unesc($row["changed_old_prefixcolor"].$row["changed_old_level"].$row["changed_old_suffixcolor"]);
    $hit[$i]["new"]=unesc($row["changed_current_prefixcolor"].$row["changed_new_level"].$row["changed_current_suffixcolor"]);
    $hit[$i]["date"]=get_date_time($row["date"]);
    if ($row["undone"]=="no")
        $hit[$i]["undo"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=staff_control&amp;action=undo&amp;id=".$row["changed_id"]."&amp;or=".$row["changed_old_id_level"]."\" onclick=\"return confirm('".AddSlashes($language["MO"])."')\">".image_or_link("$STYLEPATH/images/delete.png","",$language["MA"])."</a>";
    else
        $hit[$i]["undo"]="<span style='color:red;'>".$language["UNDONE"]."</span>";
    $i++;
}
$admintpl->set("language", $language);
$admintpl->set("hit",$hit);

?>