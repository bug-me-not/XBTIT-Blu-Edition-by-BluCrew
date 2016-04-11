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
if(!defined("IN_BTIT"))
    die("non direct access!");

function usertable($res, $frame_caption, $online = false)
{
    global $STYLEPATH, $extratpl, $language, $btit_settings, $res_seo;
    $num = 0;
    $user = array();
    foreach($res as $a)
    {
        $num++;
        if($online === false)
        {
            if($btit_settings["fmhack_VIP_freeleech"] == "enabled")
            {
                if($a["freeleech"]=="yes")
                    $a["downloaded"]=$a["vipfl_down"];
            }
            if($a["downloaded"] > 0)
            {
                $ratio = $a["uploaded"] / $a["downloaded"];
                $ratio = number_format($ratio, 2);
            }
            else
                $ratio = $language["INFINITE"];
            $user[$num - 1]["uploaded"] = makesize($a["uploaded"]);
            $user[$num - 1]["downloaded"] = makesize($a["downloaded"]);
            $user[$num - 1]["ratio"] = $ratio;
        }
        $user[$num - 1]["rank"] = $num;
        $user[$num - 1]["username"] = ($a["id"] > 1?"<a href=\"".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated_user"] == "true")?$a["id"]."_".strtr($a["username"], $res_seo["str"],
            $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$a["id"])."\"> ".(($btit_settings["fmhack_group_colours_overall"] == "enabled")?stripslashes($a["prefixcolor"].$a["username"].$a["suffixcolor"]):
            "<b>".$a["username"]."</b>")."</a>":"<b>".$a["username"]."</b>");
        if($online === true)
        {
            $user[$num - 1]["online"] = NewDateFormat($a["tot_on"]);
        }
    }
    $extratpl->set("language", $language);
    $extratpl->set("user", $user);
    return set_block($frame_caption, "center", $extratpl->fetch(load_template("extra-stats.user".(($online === true)?"b":"").".tpl")));
}
function _torrenttable($rt, $frame_caption, $speed = false)
{
    global $STYLEPATH, $extratpl, $language, $btit_settings;
    $torrent = array();
    $num = 0;
    foreach($rt as $a)
    {
        $num++;
        if($a["leechers"] > 0)
        {
            $r = $a["seeds"] / $a["leechers"];
            $ratio = number_format($r, 2);
        }
        else
            $ratio = $language["INFINITE"];
        $team = "";
        if($btit_settings["fmhack_teams"] == "enabled")
        {
            $fteam = $a["team"];
            if(isset($fteam) && isset($a["teamimage"]) && !empty($a["teamimage"]))
                $team = "<a href='index.php?page=teaminfo&team=".$a["teamsid"]."&action=view'><img src='".$a["teamimage"]."' border='0' title='".$a["teamname"]."' style='width:25px;'></a>";
            else
                $team = "";
        }
        $torrent[$num - 1]["rank"] = $num;
        if($GLOBALS["usepopup"])
            $torrent[$num - 1]["filename"] = "<a href=\"javascript:popdetails('index.php?page=details&amp;id=".$a['hash']."');\">".unesc($a["name"])."</a>".(($btit_settings["fmhack_teams"] == "enabled" && $team !=
                "")?"&nbsp;".$team."&nbsp;":"");
        else
            $torrent[$num - 1]["filename"] = "<a href=\"index.php?page=details&amp;id=".$a['hash']."\">".unesc($a["name"])."</a>".(($btit_settings["fmhack_teams"] == "enabled" && $team != "")?"&nbsp;".$team.
                "&nbsp;":"");
        $torrent[$num - 1]["complete"] = number_format($a["finished"]);
        $torrent[$num - 1]["seeds"] = number_format($a["seeds"]);
        $torrent[$num - 1]["leechers"] = number_format($a["leechers"]);
        $torrent[$num - 1]["peers"] = number_format($a["leechers"] + $a["seeds"]);
        $torrent[$num - 1]["ratio"] = $ratio;
        if($speed)
            $torrent[$num - 1]["speed"] = makesize($a["speed"]);
    }
    $extratpl->set("language", $language);
    $extratpl->set("torrent", $torrent);
    $extratpl->set("DISPLAY_SPEED", $speed, true);
    $extratpl->set("DISPLAY_SPEED1", $speed, true);
    return set_block($frame_caption, "center", $extratpl->fetch(load_template("extra-stats.torrent.tpl")));
}
if($XBTT_USE)
{
    $tseeds = "`f`.`seeds`+ifnull(`x`.`seeders`,0)";
    $tleechs = "`f`.`leechers`+ifnull(`x`.`leechers`,0)";
    $tcompletes = "`f`.`finished`+ifnull(`x`.`completed`,0)";
    $ttables = "`{$TABLE_PREFIX}files` `f` LEFT JOIN `xbt_files` `x` ON `x`.`info_hash`=`f`.`bin_hash`";
    $udownloaded = "`u`.`downloaded`+IFNULL(`x`.`downloaded`,0)";
    $uuploaded = "`u`.`uploaded`+IFNULL(`x`.`uploaded`,0)";
    $utables = "`{$TABLE_PREFIX}users` `u` LEFT JOIN `xbt_users` `x` ON `x`.`uid`=`u`.`id`";
}
else
{
    $tseeds = "`f`.`seeds`";
    $tleechs = "`f`.`leechers`";
    $tcompletes = "`f`.`finished`";
    $ttables = "`{$TABLE_PREFIX}files` `f`";
    $udownloaded = "`u`.`downloaded`";
    $uuploaded = "`u`.`uploaded`";
    $utables = "`{$TABLE_PREFIX}users` `u`";
}
$out = "";
$cpage = get_cached_version("extra-stats".$CURUSER["id_level"]);
if($cpage)
{
    $out = $cpage;
    return;
}
$extratpl = new bTemplate();
// the display the box only if number of rows is > 0
if($CURUSER["view_users"] == "yes")
{
    $query1_select = "";
    $query1_join = "";
    if($btit_settings["fmhack_group_colours_overall"] == "enabled")
    {
        $query1_select .= "`ul`.`prefixcolor`,`ul`.`suffixcolor`, `u`.`id`,";
        $query1_join .= "LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` ";
    }
    if($btit_settings["fmhack_VIP_freeleech"] == "enabled")
    {
        $query1_select .= "`u`.`vipfl_down`, `ul`.`freeleech`,";
        if($btit_settings["fmhack_group_colours_overall"] != "enabled")
            $query1_join .= "LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` ";
    }
    $r = get_result("SELECT ".$query1_select." u.id, u.username, $udownloaded as downloaded, $uuploaded as uploaded FROM $utables ".$query1_join." WHERE $uuploaded>0 ORDER BY $uuploaded DESC LIMIT 10", true, $CACHE_DURATION);
    if(count($r) > 0)
    {
        $out .= usertable($r, $language["TOP_10_UPLOAD"]);
        $out .= "<br /><br />";
    }
    $r = get_result("SELECT ".$query1_select." u.id, u.username, $udownloaded as downloaded, $uuploaded as uploaded FROM $utables ".$query1_join." WHERE $uuploaded>0 AND $udownloaded>0 ORDER BY $udownloaded DESC LIMIT 10", true,
        $CACHE_DURATION);
    if(count($r) > 0)
    {
        $out .= usertable($r, $language["TOP_10_DOWNLOAD"]);
        $out .= "<br /><br />";
    }
    $r = get_result("SELECT ".$query1_select." u.id, u.username, $udownloaded as downloaded, $uuploaded as uploaded FROM $utables ".$query1_join." WHERE $udownloaded > 104857600 ORDER BY $uuploaded / if($udownloaded>0,$udownloaded,1) DESC, $uuploaded DESC LIMIT 10", true,
        $CACHE_DURATION);
    if(count($r) > 0)
    {
        $out .= usertable($r, $language["TOP_10_SHARE"]." ".$language["MINIMUM_100_DOWN"]."");
        $out .= "<br /><br />";
    }
    $r = get_result("SELECT ".$query1_select." u.id, u.username, $udownloaded as downloaded, $uuploaded as uploaded FROM $utables ".$query1_join." WHERE $udownloaded > 104857600 ORDER BY $uuploaded / if($udownloaded>0,$udownloaded,1) ASC, $udownloaded DESC LIMIT 10", true,
        $CACHE_DURATION);
    if(count($r) > 0)
    {
        $out .= usertable($r, $language["TOP_10_WORST"]." ".$language["MINIMUM_100_DOWN"]."");
        $out .= "<br /><br />";
    }
    if($btit_settings["fmhack_total_online_time"] == "enabled")
    {
        // online
        $r = get_result("SELECT `u`.`id`, `u`.`username`, `ul`.`prefixcolor`, `ul`.`suffixcolor`, `tot_on` FROM $utables LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `u`.`id`>1 ORDER BY `tot_on` DESC LIMIT 10", true,
            $CACHE_DURATION);
        if(count($r) > 0)
        {
            $out .= usertable($r, $language["TOT_MOST_ONLINE"], true);
            $out .= "<br /><br />";
        }
        //online
    }
}
if($CURUSER["view_torrents"] == "yes")
{
    $query2_select = "";
    $query2_where = "";
    $query2_join = "";
    if($btit_settings["fmhack_teams"] == "enabled")
    {
        $query2_select .= "`t`.`id` `teamsid`, `t`.`name` `teamname`, `t`.`image` `teamimage`, `f`.`team`,";
        $query2_join .= "LEFT JOIN `{$TABLE_PREFIX}teams` `t` ON `f`.`team` = `t`.`id` ";
        if($btit_settings["team_state"] == "private")
        {
            $query2_where .= "WHERE (".$CURUSER['team']." = f.team OR f.team = 0 OR '".$CURUSER['all_teams']."'='yes' OR '".$CURUSER['sel_team']."'=`f`.`team`) ";
        }
    }
    if($btit_settings["fmhack_torrent_moderation"] == "enabled")
        $query2_where .= (($query2_where == "")?"WHERE":"AND")." `f`.`moder`='ok' ";
    if($btit_settings["fmhack_show_or_hide_porn"] == "enabled")
    {
        if($CURUSER["showporn"] == "no")
            $query2_where .= (($query2_where == "")?"WHERE":"AND")." `f`.`category` NOT IN(".$btit_settings["porncat"].") ";
    }
    $r = get_result("SELECT ".$query2_select." f.info_hash as hash, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished, dlbytes as dwned , filename as name, url as url, f.info, speed as speed, uploader FROM $ttables ".
        $query2_join." ".$query2_where." ORDER BY $tseeds + $tleechs DESC LIMIT 10", true, $CACHE_DURATION);
    if(count($r) > 0)
    {
        $out .= _torrenttable($r, $language["TOP_10_ACTIVE"]);
        $out .= "<br /><br />";
    }
    $query2_where = "";
    if($btit_settings["fmhack_teams"] == "enabled" && $btit_settings["team_state"] == "private")
        $query2_where .= "AND (".$CURUSER['team']." = f.team OR f.team = 0 OR '".$CURUSER['all_teams']."'='yes' OR '".$CURUSER['sel_team']."'=`f`.`team`) ";
    if($btit_settings["fmhack_torrent_moderation"] == "enabled")
        $query2_where .= "AND `f`.`moder`='ok' ";
    if($btit_settings["fmhack_show_or_hide_porn"] == "enabled")
    {
        if($CURUSER["showporn"] == "no")
            $query2_where .= "AND `f`.`category` NOT IN(".$btit_settings["porncat"].") ";
    }
    $r = get_result("SELECT ".$query2_select." f.info_hash as hash, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished, dlbytes as dwned , filename as name, url as url, f.info, speed as speed, uploader FROM $ttables ".
        $query2_join." WHERE $tseeds >= 5 ".$query2_where." ORDER BY  seeds DESC, $tseeds / $tleechs DESC LIMIT 10", true, $CACHE_DURATION);
    if(count($r) > 0)
    {
        $out .= _torrenttable($r, $language["TOP_10_BEST_SEED"]." (".$language["MINIMUM_5_SEED"].")");
        $out .= "<br /><br />";
    }
    $r = get_result("SELECT ".$query2_select." f.info_hash as hash, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished, dlbytes as dwned , filename as name, url as url, f.info, speed as speed, uploader FROM $ttables ".
        $query2_join." WHERE $tleechs >= 5 AND $tcompletes > 0 ".$query2_where." ORDER BY $tleechs DESC, $tseeds / $tleechs ASC LIMIT 10", true, $CACHE_DURATION);
    if(count($r) > 0)
    {
        $out .= _torrenttable($r, $language["TOP_10_WORST_SEED"]." (".$language["MINIMUM_5_LEECH"].")");
        $out .= "<br /><br />";
    }
    if(!$XBTT_USE)
    {
        $r = get_result("SELECT ".$query2_select." f.info_hash as hash, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished, dlbytes as dwned , filename as name, url as url, f.info, speed as speed, uploader FROM $ttables ".
            $query2_join." WHERE external='no' ".$query2_where." ORDER BY speed DESC, $tseeds DESC LIMIT 10", true, $CACHE_DURATION);
        if(count($r) > 0)
        {
            $out .= _torrenttable($r, $language["TOP_10_BSPEED"], true);
            $out .= "<br /><br />";
        }
        $r = get_result("SELECT ".$query2_select." f.info_hash as hash, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished, dlbytes as dwned , filename as name, url as url, f.info, speed as speed, uploader FROM $ttables ".
            $query2_join." WHERE external='no' ".$query2_where." ORDER BY speed ASC, $tseeds DESC LIMIT 10", true, $CACHE_DURATION);
        if(count($r) > 0)
        {
            $out .= _torrenttable($r, $language["TOP_10_WSPEED"], true);
            $out .= "<br /><br />";
        }
    }
}
unset($r);
write_cached_version("extra-stats".$CURUSER["id_level"], $out);

?>