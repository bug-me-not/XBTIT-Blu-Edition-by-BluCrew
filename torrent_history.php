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


$id = strtolower(preg_replace("/[^A-Fa-f0-9]/", "", $_GET["id"]));
if (!isset($id) || !$id)
    die("Error ID");

if($btit_settings["fmhack_view_peer_details"]=="enabled" && $CURUSER["view_history"]=="no")
    stderr($language["ERROR"], $language["CANT_VIEW_PAGE"]);

$scriptname = htmlspecialchars($_SERVER["PHP_SELF"]."?history&id=$id");
$addparam = "";

// control if torrent exist in our db
$res = get_result("SELECT size FROM {$TABLE_PREFIX}files WHERE info_hash='$id'",true,$btit_settings['cache_duration']);

if ($res)
{
    $row=$res[0];
    if ($row)
    {
        $tsize=0+$row["size"];
    }
}
else
    die("Error ID");

if ($XBTT_USE)
    $res=get_result("SELECT COUNT(*) `count` FROM `xbt_files` `xf` LEFT JOIN `xbt_files_users` `xfu` ON `xf`.`fid` = `xfu`.`fid` WHERE `xf`.`info_hash` = 0x".$id." AND `xfu`.`completed`>0", true, $btit_settings["cache_duration"]);
else
    $res=get_result("SELECT COUNT(*) `count` FROM `{$TABLE_PREFIX}history` WHERE `infohash`='".$id."' AND `completed`='yes'", true, $btit_settings["cache_duration"]);

list($pagertop, $pagerbottom, $limit) = pager(30, $res[0]["count"], "index.php?page=torrent_history&id=".$id."&amp;");
$historytpl=new bTemplate();
$historytpl->set("pagertop_visible", ((isset($pagertop) && !empty($pagertop))?true:false), true);
$historytpl->set("pagerbottom_visible", ((isset($pagerbottom) && !empty($pagerbottom))?true:false), true);
$historytpl->set("pagertop", $pagertop);
$historytpl->set("pagerbottom", $pagerbottom);
$colspan=(($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")?10:9);
if($btit_settings["fmhack_torrent_times"]=="enabled")
    $colspan+=3;
$historytpl->set("colspan", $colspan);
$historytpl->set("ttimes_enabled_1", (($btit_settings["fmhack_torrent_times"]=="enabled")?true:false), true);
$historytpl->set("ttimes_enabled_2", (($btit_settings["fmhack_torrent_times"]=="enabled")?true:false), true);

$query1_select=(($XBTT_USE)?"LOWER(HEX(`h`.`peer_id`)) `peer_id`,":"");
if($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")
    $query1_select.= (($XBTT_USE)?"`h`.`seeding_time` `seed`,":"");
if($btit_settings["fmhack_torrent_times"]=="enabled")
{
    $query1_select.=(($XBTT_USE)?"`h`.`started_time`, `h`.`completed_time`,":"");
}
if ($XBTT_USE)
    $res = get_result("SELECT ".$query1_select." IF(h.active=1,'yes','no') as active, 'unknown' as agent, h.downloaded, h.uploaded, h.mtime as date, h.uid, u.username, c.name AS country, c.flagpic, ul.level, ul.prefixcolor, ul.suffixcolor FROM xbt_files_users h LEFT JOIN xbt_files xf ON xf.fid=h.fid LEFT JOIN {$TABLE_PREFIX}users u ON h.uid=u.id LEFT JOIN {$TABLE_PREFIX}countries c ON u.flag=c.id LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE HEX(xf.info_hash)='$id' AND h.completed>0 ORDER BY h.mtime DESC ".$limit, true, $btit_settings['cache_duration']);
else
    $res = get_result("SELECT ".$query1_select." h.*, u.username, c.name AS country, c.flagpic, ul.level, ul.prefixcolor, ul.suffixcolor FROM {$TABLE_PREFIX}history h LEFT JOIN {$TABLE_PREFIX}users u ON h.uid=u.id LEFT JOIN {$TABLE_PREFIX}countries c ON u.flag=c.id LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE h.infohash='$id' AND h.date IS NOT NULL ORDER BY date DESC ".$limit, true, $btit_settings['cache_duration']);

require(load_language("lang_history.php"));

$historytpl->set("language",$language);
$historytpl->set("history_script","index.php");

if (count($res)==0)
    $historytpl->set("NOHISTORY",TRUE,TRUE);
else
{
    $historytpl->set("NOHISTORY",FALSE,TRUE);
 	  	 
    foreach ($res as $row)
    {
        if($XBTT_USE)
        {
            $row["agent"]=getagent("",$row["peer_id"]);
        }

        if ($GLOBALS["usepopup"])
        {
            $history[$i]["USERNAME"]="<a href=\"javascript: windowunder('".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$row["uid"]."_".strtr($row["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$row["uid"])."')\">".unesc($row["username"])."</a>";
            $history[$i]["PM"]=(strtolower($row["username"])=="guest"?"":"<a href=\"javascript: windowunder('index.php?page=usercp&amp;do=pm&action=edit&uid=$CURUSER[uid]&what=new&to=".urlencode(unesc($row["username"]))."')\">".image_or_link("$STYLEPATH/images/pm.png","","PM")."</a>");
        }
        else
        {
            $history[$i]["USERNAME"]="<a href=\"".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$row["uid"]."_".strtr($row["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$row["uid"])."\">".unesc($row["username"])."</a>";
            $history[$i]["PM"]=(strtolower($row["username"])=="guest"?"":"<a href=\"index.php?page=usercp&amp;do=pm&action=edit&uid=$CURUSER[uid]&what=new&to=".urlencode(unesc($row["username"]))."\">".image_or_link("$STYLEPATH/images/pm.png","","PM")."</a>");
        }
        if ($row["flagpic"]!="")
            $history[$i]["FLAG"]="<img src=images/flag/".$row["flagpic"]." alt=".$row["country"]." />";
        else
            $history[$i]["FLAG"]="<img src=images/flag/unknown.gif alt=".$language["UNKNOWN"]." />";
        $history[$i]["ACTIVE"]=$row["active"];
        $history[$i]["CLIENT"]=htmlspecialchars($row["agent"]);
        $dled=makesize($row["downloaded"]);
        $upld=makesize($row["uploaded"]);
        $history[$i]["DOWNLOADED"]=$dled;
        $history[$i]["UPLOADED"]=$upld;
        //Peer Ratio
        if (intval($row["downloaded"])>0)
        {
            $ratio=number_format($row["uploaded"]/$row["downloaded"],2);
        }
        else
        {
            $ratio='&#8734;';
        }
        $history[$i]["RATIO"]=$ratio;
        //End Peer Ratio
        $history[$i]["FINISHED"]=get_elapsed_time((($btit_settings["fmhack_torrent_times"]=="enabled")?$row["completed_time"]:$row["date"]))." ago";
        if($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")
            $history[$i]["SEEDING_TIME"]=NewDateFormat($row["seed"]);
        if($btit_settings["fmhack_torrent_times"]=="enabled")
        {
            $history[$i]["mtime"]=date("d/m/Y\<\b\\r \/\>H:i:s", $row["date"]);
            $history[$i]["completed_time"]=(($row["completed_time"]==-1)?$language["NA"]:date("d/m/Y\<\b\\r \/\>H:i:s", $row["completed_time"]));
            $history[$i]["started_time"]=(($row["started_time"]==-1)?$language["NA"]:date("d/m/Y\<\b\\r \/\>H:i:s", $row["started_time"]));
        }
        $i++;
    }
}

if ($GLOBALS["usepopup"])
    $historytpl->set("BACK2","<br /><br /><center><a href=\"javascript:window.close()\"><tag:language.CLOSE /></a></center>");
else
   $historytpl->set("BACK2", "</div><br /><br /><center><a href=\"javascript: history.go(-1);\"><tag:language.BACK /></a>");
$historytpl->set("hnr_enabled", (($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")?TRUE:FALSE), TRUE);
$historytpl->set("hnr_enabled2", (($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")?TRUE:FALSE), TRUE);
$historytpl->set("history",$history);

?>