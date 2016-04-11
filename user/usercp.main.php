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

$usercptpl->set("edit_allowed_1", true, true);
$usercptpl->set("edit_allowed_2", true, true);
$usercptpl->set("delete_allowed_1", true, true);
$usercptpl->set("delete_allowed_2", true, true);
$usercptpl->set("showporn_enabled", (($btit_settings["fmhack_show_or_hide_porn"] == "enabled")?true:false), true);
$usercptpl->set("about_me_enabled", (($btit_settings["fmhack_about_me"] == "enabled")?true:false), true);
$usercptpl->set("rss_feed_enabled", (($btit_settings["fmhack_advanced_RSS_feed"] == "enabled")?true:false), true);
if($btit_settings["fmhack_advanced_RSS_feed"] == "enabled")
{
    $usercptpl->set("custom_rss_feed", whatsMyRssUrl());
}
if($btit_settings["fmhack_about_me"] == "enabled")
{
    $usercptpl->set("about_me", format_comment($CURUSER["about_me"]));
}
if($btit_settings["fmhack_uploader_rights"] == "enabled")
{
    if($btit_settings["ulri_edit"] == "no" && $CURUSER["edit_torrents"] == "no")
    {
        $usercptpl->set("edit_allowed_1", false, true);
        $usercptpl->set("edit_allowed_2", false, true);
    }
    if($btit_settings["ulri_delete"] == "no" && $CURUSER["delete_torrents"] == "no")
    {
        $usercptpl->set("delete_allowed_1", false, true);
        $usercptpl->set("delete_allowed_2", false, true);
    }
}
$uid = intval($CURUSER["uid"]);
$res = get_result("SELECT c.name, c.flagpic FROM {$TABLE_PREFIX}countries c WHERE id=".$CURUSER["flag"], true, $btit_settings['cache_duration']);
$row = $res[0];
if(max(0, $CURUSER["downloaded"]) > 0)
{
    $sr = $CURUSER["uploaded"] / $CURUSER["downloaded"];
    if($sr >= 4)
        $s = "images/smilies/thumbsup.gif";
    else
        if($sr >= 2)
            $s = "images/smilies/grin.gif";
        else
            if($sr >= 1)
                $s = "images/smilies/smile1.gif";
            else
                if($sr >= 0.5)
                    $s = "images/smilies/noexpression.gif";
                else
                    if($sr >= 0.25)
                        $s = "images/smilies/sad.gif";
                    else
                        $s = "images/smilies/thumbsdown.gif";
    $ratio = number_format($sr, 2)."&nbsp;&nbsp;<img src=\"$s\" alt=\"\" />";
}
else
    $ratio = '&#8734;';
$ucptpl = array();
$usercptpl->set("fls_enabled", (($btit_settings["fmhack_freeleech_slots"] == "enabled")?true:false), true);
if($btit_settings["fmhack_freeleech_slots"] == "enabled")
    $ucptpl["fls"]=$CURUSER["freeleech_slots"];
$ucptpl["username"] = (($btit_settings["fmhack_group_colours_overall"] == "enabled")?unesc($CURUSER["prefixcolor"].$CURUSER["username"].$CURUSER["suffixcolor"]):unesc($CURUSER["username"]));
if($CURUSER["avatar"] && $CURUSER["avatar"] != "")
    $ucptpl["avatar"] = "<img border=\"0\" onload=\"resize_avatar(this);\" src=\"".htmlspecialchars($CURUSER["avatar"])."\" alt=\"\" />";
else
    $ucptpl["avatar"] = "";
$ucptpl["email"] = htmlspecialchars($CURUSER["email"]);
$ucptpl["lastip"] = long2ip($CURUSER["lip"]);
$ucptpl["userlevel"] = (($btit_settings["fmhack_group_colours_overall"] == "enabled")?unesc($CURUSER["prefixcolor"].$CURUSER["level"].$CURUSER["suffixcolor"]):unesc($CURUSER["level"]));
$ucptpl["userjoin"] = ($CURUSER["joined"] == 0?"N/A":get_date_time($CURUSER["joined"]));
$ucptpl["lastaccess"] = ($CURUSER["lastconnect"] == 0?"N/A":get_date_time($CURUSER["lastconnect"]));
$ucptpl["country"] = ($CURUSER["flag"] == 0?"":unesc($row['name']))."&nbsp;&nbsp;<img src=\"images/flag/".(!$row["flagpic"] || $row["flagpic"] == ""?"unknown.gif":$row["flagpic"])."\" alt='".($CURUSER["flag"] == 0?"unknow":unesc($row['name']))."' />";
if($btit_settings["fmhack_show_or_hide_porn"] == "enabled")
{
    $ucptpl["showporn"] = $CURUSER["showporn"];
}
$usercptpl->set("hos_enabled", (($btit_settings["fmhack_hide_online_status"] == "enabled" && $CURUSER["can_hide"] == "yes")?true:false), true);
if($btit_settings["fmhack_hide_online_status"] == "enabled" && $CURUSER["can_hide"] == "yes")
    $ucptpl["invisible"] = (($CURUSER["invisible"] == "yes")?$language["YES"]:$language["NO"]);
$ucptpl["download"] = makesize($CURUSER["downloaded"]);
$ucptpl["upload"] = makesize($CURUSER["uploaded"]);
$ucptpl["ratio"] = $ratio;
$usercptpl->set("signature_enabled", (($btit_settings["fmhack_signature_on_internal_forum"] == "enabled")?true:false), true);
if($btit_settings["fmhack_signature_on_internal_forum"] == "enabled")
{
    $ucptpl["signature"] = format_comment($CURUSER["signature"]);
}
$usercptpl->set("birthdays_enabled", (($btit_settings["fmhack_birthdays"] == "enabled")?true:false), true);
if($btit_settings["fmhack_birthdays"] == "enabled")
{
    $dob = explode("-", $CURUSER["dob"]);
    $age = userage($dob[0], $dob[1], $dob[2]);
    if($row["dob"] == "0000-00-00")
        $ucptpl["age"] = $language["NA"];
    else
        $ucptpl["age"] = $age;
}
$usercptpl->set("torrentbar_enabled", (($btit_settings["fmhack_torrentBar"] == "enabled")?true:false), true);
if($btit_settings["fmhack_torrentBar"] == "enabled")
{
    //TorrentBar - Start By Confe
    $ucptpl["baseurl"] = $BASEURL;
    $ucptpl["uid"] = $uid;
    //TorrentBar - End By Confe
}
$usercptpl->set("ucp", $ucptpl);
$usercptpl->set("AVATAR", $CURUSER["avatar"] && $CURUSER["avatar"] != "", true);
$usercptpl->set("CAN_EDIT", $CURUSER["edit_users"] == "yes" || $CURUSER["admin_access"] == "yes", true);
$usercptpl->set("tmod1_enabled", (($btit_settings["fmhack_torrent_moderation"] == "enabled")?true:false), true);
$usercptpl->set("tmod2_enabled", (($btit_settings["fmhack_torrent_moderation"] == "enabled")?true:false), true);
$usercptpl->set("avatar_signature_sync_enabled", (($btit_settings["fmhack_avatar_signature_sync"] == "enabled")?true:false), true);
if($btit_settings["fmhack_avatar_signature_sync"] == "enabled")
{
    $sigshit = array('[img]', '[/img]');
    $sigshit2 = array('', '');
    $prev_sig = str_replace($sigshit, $sigshit2, $CURUSER["sig"]);
    if(!empty($CURUSER["sig"]))
    {
        $usercptpl->set("usercp_sig", "<img border=\"0\" onload=\"resize_sig(this);\" src=\"".htmlspecialchars($prev_sig)."\" alt=\"\" />");
    }
    else
    {
        $usercptpl->set("usercp_sig", "");
    }
}
$colspan = 8;
if($btit_settings["fmhack_torrent_moderation"] == "enabled")
    $colspan++;
$usercptpl->set("colspan", $colspan);
// Only show if forum is internal
if($GLOBALS["FORUMLINK"] == '' || $GLOBALS["FORUMLINK"] == 'internal')
{
    $sql = get_result("SELECT count(*) as tp FROM {$TABLE_PREFIX}posts p INNER JOIN {$TABLE_PREFIX}users u ON p.userid = u.id WHERE u.id = ".$CURUSER["uid"], true, $btit_settings['cache_duration']);
    $posts = $sql[0]['tp'];
    unset($sql);
    $memberdays = max(1, round((time() - $CURUSER['joined']) / 86400));
    $posts_per_day = number_format(round($posts / $memberdays, 2), 2);
    $usercptpl->set("INTERNAL_FORUM", true, true);
    $usercptpl->set("posts", $posts."&nbsp;[".sprintf($language["POSTS_PER_DAY"], $posts_per_day)."]");
}
elseif(substr($GLOBALS["FORUMLINK"], 0, 3) == "smf")
{
    $forum = get_result("SELECT `date".(($GLOBALS["FORUMLINK"] == "smf")?"R":"_r")."egistered`, `posts` FROM `{$db_prefix}members` WHERE ".(($GLOBALS["FORUMLINK"] == "smf")?"`ID_MEMBER`":"`id_member`")."=".$CURUSER["smf_fid"], true, $btit_settings['cache_duration']);
    $forum = $forum[0];
    $memberdays = max(1, round((time() - (($GLOBALS["FORUMLINK"] == "smf")?$forum["dateRegistered"]:$forum["date_registered"])) / 86400));
    $posts_per_day = number_format(round($forum["posts"] / $memberdays, 2), 2);
    $usercptpl->set("INTERNAL_FORUM", true, true);
    $usercptpl->set("posts", $forum["posts"]."&nbsp;[".sprintf($language["POSTS_PER_DAY"], $posts_per_day)."]");
    unset($forum);
}
elseif($GLOBALS["FORUMLINK"] == "ipb")
{
    $forum = get_result("SELECT `joined`, `posts` FROM `{$ipb_prefix}members` WHERE `member_id`=".$CURUSER["ipb_fid"], true, $btit_settings['cache_duration']);
    $forum = $forum[0];
    $memberdays = max(1, round((time() - $forum["joined"]) / 86400));
    $posts_per_day = number_format(round($forum["posts"] / $memberdays, 2), 2);
    $usercptpl->set("INTERNAL_FORUM", true, true);
    $usercptpl->set("posts", $forum["posts"]."&nbsp;[".sprintf($language["POSTS_PER_DAY"], $posts_per_day)."]");
    unset($forum);
}
if($XBTT_USE)
{
    $tseeds = "f.seeds+ifnull(x.seeders,0)";
    $tleechs = "f.leechers+ifnull(x.leechers,0)";
    $tcompletes = "f.finished+ifnull(x.completed,0)";
    $ttables = "{$TABLE_PREFIX}files f INNER JOIN xbt_files x ON x.info_hash=f.bin_hash";
}
else
{
    $tseeds = "f.seeds";
    $tleechs = "f.leechers";
    $tcompletes = "f.finished";
    $ttables = "{$TABLE_PREFIX}files f";
}
$resuploaded = get_result("SELECT count(*) as tf FROM {$TABLE_PREFIX}files WHERE uploader=$uid ORDER BY data DESC", true, $btit_settings['cache_duration']);
$numtorrent = $resuploaded[0]['tf'];
unset($resuploaded);
$utorrents = intval($CURUSER["torrentsperpage"]);
if($numtorrent > 0)
{
    list($pagertop, $pagerbottom, $limit) = pager(($utorrents == 0?15:$utorrents), $numtorrent, "index.php?page=usercp&amp;uid=$uid&amp;".(($btit_settings["fmhack_profile_torrent_sorting"] == "enabled" && isset($_GET["ordup"]) && !empty($_GET["ordup"]) && isset($_GET["dirup"]) && !empty($_GET["dirup"]))?"ordup=".$_GET["ordup"]."&amp;dirup=".$_GET["dirup"]."&amp;":""), array("pagename" => "ucp_uploaded"));
    $usercptpl->set("pagertop", $pagertop);
    $orderBy = "`f`.`data`";
    $direction = "DESC";
    $usercptpl->set("upsort1", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $usercptpl->set("upsort2", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $usercptpl->set("upsort3", false, true);
    $usercptpl->set("upsort4", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $usercptpl->set("upsort5", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $usercptpl->set("upsort6", false, true);
    $usercptpl->set("upsort7", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $usercptpl->set("upsort8", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $usercptpl->set("upsort9", false, true);
    $usercptpl->set("upsort10", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $usercptpl->set("upsort11", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $usercptpl->set("upsort12", false, true);
    $usercptpl->set("upsort13", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $usercptpl->set("upsort14", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $usercptpl->set("upsort15", false, true);
    $usercptpl->set("upsort16", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $usercptpl->set("upsort17", (($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")?true:false), true);
    $usercptpl->set("upsort18", false, true);
    if($btit_settings["fmhack_profile_torrent_sorting"] == "enabled")
    {
        $ordup = (isset($_GET["ordup"]) && !empty($_GET["ordup"]) && $_GET["ordup"] >= 1 && $_GET["ordup"] <= 6)?(int)0 + $_GET["ordup"]:false;
        $dirup = (isset($_GET["dirup"]) && !empty($_GET["dirup"]) && $_GET["dirup"] >= 1 && $_GET["dirup"] <= 2)?(int)0 + $_GET["dirup"]:false;
        $udupsorturl1 = "index.php?page=usercp&uid=".$CURUSER["uid"]."&amp;ordup=1&amp;dirup=";
        $udupsorturl2 = "index.php?page=usercp&uid=".$CURUSER["uid"]."&amp;ordup=2&amp;dirup=";
        $udupsorturl3 = "index.php?page=usercp&uid=".$CURUSER["uid"]."&amp;ordup=3&amp;dirup=";
        $udupsorturl4 = "index.php?page=usercp&uid=".$CURUSER["uid"]."&amp;ordup=4&amp;dirup=";
        $udupsorturl5 = "index.php?page=usercp&uid=".$CURUSER["uid"]."&amp;ordup=5&amp;dirup=";
        $udupsorturl6 = "index.php?page=usercp&uid=".$CURUSER["uid"]."&amp;ordup=6&amp;dirup=";
        switch($ordup)
        {
            case 1:
                $orderBy = "`f`.`filename`";
                $usercptpl->set("upsort3", true, true);
                break;
            case 3:
                $orderBy = "`f`.`size`";
                $usercptpl->set("upsort9", true, true);
                break;
            case 4:
                $orderBy = (($XBTT_USE)?"`x`.`seeders`":"`f`.`seeds`");
                $usercptpl->set("upsort12", true, true);
                break;
            case 5:
                $orderBy = (($XBTT_USE)?"`x`":"`f`").".`leechers`";
                $usercptpl->set("upsort15", true, true);
                break;
            case 6:
                $orderBy = (($XBTT_USE)?"`x`.`completed`":"`f`.`finished`");
                $usercptpl->set("upsort18", true, true);
                break;
            case 2:
            default:
                $orderBy = "`f`.`data`";
                $usercptpl->set("upsort6", true, true);
                break;
        }
        switch($dirup)
        {
            case 2:
                $direction = "ASC";
                $udupsorturl .= "&amp;dirup=1";
                $usercptpl->set("uarrow", "&nbsp;&uarr;");
                $usercptpl->set("udupsorturl1", $udupsorturl1 .= "1");
                $usercptpl->set("udupsorturl2", $udupsorturl2 .= "1");
                $usercptpl->set("udupsorturl3", $udupsorturl3 .= "1");
                $usercptpl->set("udupsorturl4", $udupsorturl4 .= "1");
                $usercptpl->set("udupsorturl5", $udupsorturl5 .= "1");
                $usercptpl->set("udupsorturl6", $udupsorturl6 .= "1");
                break;
            case 1:
            default:
                $direction = "DESC";
                $udupsorturl .= "&amp;dirup=2";
                $usercptpl->set("uarrow", "&nbsp;&darr;");
                $usercptpl->set("udupsorturl1", $udupsorturl1 .= "2");
                $usercptpl->set("udupsorturl2", $udupsorturl2 .= "2");
                $usercptpl->set("udupsorturl3", $udupsorturl3 .= "2");
                $usercptpl->set("udupsorturl4", $udupsorturl4 .= "2");
                $usercptpl->set("udupsorturl5", $udupsorturl5 .= "2");
                $usercptpl->set("udupsorturl6", $udupsorturl6 .= "2");
                break;
        }
    }
    $resuploaded = get_result("SELECT `f`.`filename`, UNIX_TIMESTAMP(`f`.`data`) `added`, `f`.`size`, ".$tseeds." `seeds`, ".$tleechs." `leechers`, ".$tcompletes." `finished`, `f`.`info_hash` `hash` FROM ".$ttables." WHERE `f`.`uploader`=".$uid." ORDER BY ".$orderBy." ".$direction." ".$limit, true, $btit_settings['cache_duration']);
}
else
{
    $usercptpl->set("upsort1", false, true);
    $usercptpl->set("upsort2", false, true);
    $usercptpl->set("upsort3", false, true);
    $usercptpl->set("upsort4", false, true);
    $usercptpl->set("upsort5", false, true);
    $usercptpl->set("upsort6", false, true);
    $usercptpl->set("upsort7", false, true);
    $usercptpl->set("upsort8", false, true);
    $usercptpl->set("upsort9", false, true);
    $usercptpl->set("upsort10", false, true);
    $usercptpl->set("upsort11", false, true);
    $usercptpl->set("upsort12", false, true);
    $usercptpl->set("upsort13", false, true);
    $usercptpl->set("upsort14", false, true);
    $usercptpl->set("upsort15", false, true);
    $usercptpl->set("upsort16", false, true);
    $usercptpl->set("upsort17", false, true);
    $usercptpl->set("upsort18", false, true);
}
if($resuploaded && count($resuploaded) > 0)
{
    include ("include/offset.php");
    $usercptpl->set("RESULTS", true, true);
    $uptortpl = array();
    $i = 0;
    foreach($resuploaded as $id => $rest)
    {
        $uptortpl[$i]["filename"] = cut_string(unesc($rest["filename"]), intval($btit_settings["cut_name"]));
        $uptortpl[$i]["added"] = date("d/m/Y", $rest["added"] - $offset);
        if($btit_settings["fmhack_torrent_moderation"] == "enabled")
            $uptortpl[$i]["moder"] = getmoderdetails(getmoderstatusbyhash($rest['hash']), $rest['hash']);
        $uptortpl[$i]["size"] = makesize($rest["size"]);
        $uptortpl[$i]["seedcolor"] = linkcolor($rest["seeds"]);
        $uptortpl[$i]["seeds"] = $rest[seeds];
        $uptortpl[$i]["leechcolor"] = linkcolor($rest["leechers"]);
        $uptortpl[$i]["leechers"] = $rest[leechers];
        $uptortpl[$i]["completed"] = ($rest["finished"] > 0?$rest["finished"]:"---");
        $uptortpl[$i]["editlink"] = "index.php?page=edit&amp;info_hash=".$rest["hash"]."&amp;returnto=".urlencode("index.php?page=torrents")."";
        $uptortpl[$i]["dellink"] = "index.php?page=delete&amp;info_hash=".$rest["hash"]."&amp;returnto=".urlencode("index.php?page=torrents")."";
        $uptortpl[$i]["editimg"] = image_or_link("$STYLEPATH/images/edit.png", "", $language["EDIT"]);
        $uptortpl[$i]["delimg"] = image_or_link("$STYLEPATH/images/delete.png", "", $language["DELETE"]);
        $i++;
    }
    $usercptpl->set("uptor", $uptortpl);
}
else
{
    $usercptpl->set("RESULTS", false, true);
    $usercptpl->set("pagertop", "");
}

?>