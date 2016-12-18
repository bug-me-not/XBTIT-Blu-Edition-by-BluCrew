<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
// BTI version created by Gando , converted to XBTIT-2 by DiemThuy - Nov 2008
// updated to be used with XBT and XML updated - march 2009
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

if ($CURUSER["id_level"]==1)
{
    redirect("index.php?page=torrents"); // redirects to torrents.php if guest
    exit();
}

if ($XBTT_USE)
{
    $tseeds="`f`.`seeds`+ifnull(`x`.`seeders`,0) `seeds`";
    $tleechs="`f`.`leechers`+ifnull(`x`.`leechers`,0) `leechers`";
    $tcompletes="`f`.`finished`+ifnull(`x`.`completed`,0) `finished`";
    $ttables="LEFT JOIN `xbt_files` `x` ON `x`.`info_hash`=`f`.`bin_hash`";
}
else
{
    $tseeds="`f`.`seeds`";
    $tleechs="`f`.`leechers`";
    $tcompletes="`f`.`finished`";
    $ttables="";
}

$bookmarktpl=new bTemplate();
$bookmarktpl->set("language",$language);

(isset($_GET["do"])) ? $do = $_GET["do"] : $do="";
(isset($_GET["torrent_id"])) ? $torrent_id = preg_replace("/[^A-Fa-f0-9]/","",$_GET["torrent_id"]) : $torrent_id=false;
(isset($_GET["id"]) && !empty($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"]>0) ? $id = (int)0+$_GET["id"] : $id=false;

if ($do=="add")
{
    // bookmark torrents
    if ($torrent_id===false || strlen($torrent_id)!=40)
        stderr($language["ERROR"],$language["INVALID_INFO_HASH"]);

    $hmm=do_sqlquery("SELECT `id` FROM `{$TABLE_PREFIX}wishlist` WHERE `torrent_id` = '".$torrent_id."' AND `user_id`=".$CURUSER["uid"], true);

    if (sql_num_rows($hmm)>0)
        stderr($language["ERROR"],$language["TB_ALREADY_BOOK"]);

    $sql = "SELECT `filename` FROM `{$TABLE_PREFIX}files` WHERE `info_hash`='".$torrent_id."'";
    $qry = do_sqlquery($sql, true);
    $res = $qry->fetch_assoc();
    $chk = sql_num_rows($qry);
    if (!$chk)
        stderr($language["ERROR"],$language["TB_NO_TORR_EXISTS"]);

    quickQuery("INSERT INTO `{$TABLE_PREFIX}wishlist` (`user_id`, `torrent_id`, `added`) VALUES ('".$CURUSER["uid"]."', '".$torrent_id."', NOW())", true);
    redirect("index.php?page=bookmark");
    exit();
}
elseif ($do=="del")
{
    // Delete torrent from bookmark list
    if($id===false)
        stderr($language["ERROR"], $language["BAD_ID"]);

    quickQuery("DELETE FROM `{$TABLE_PREFIX}wishlist` WHERE `id`=".$id, true);
    redirect("index.php?page=bookmark");
    exit();
}
else
{
    // Main bookmark page
    $torrentsperpage=((isset($CURUSER["torrentsperpage"])&& $CURUSER["torrentsperpage"]>0)?$CURUSER["torrentsperpage"]:15);
    $a=get_result("SELECT COUNT(*) `count` FROM `{$TABLE_PREFIX}wishlist` WHERE `user_id`=".$CURUSER["uid"], true, $btit_settings["cache_duration"]);
    $count=$a[0]["count"];

    list($pagertop, $pagerbottom, $limit) = pager($torrentsperpage, $count, "index.php?page=bookmark&amp;");
    $bookmarktpl->set("pagertop_visible", ((isset($pagertop) && !empty($pagertop))?true:false), true);
    $bookmarktpl->set("pagerbottom_visible", ((isset($pagerbottom) && !empty($pagerbottom))?true:false), true);
    $bookmarktpl->set("pagertop", $pagertop);
    $bookmarktpl->set("pagerbottom", $pagerbottom);
    $qry=get_result("SELECT `w`.`id`, UNIX_TIMESTAMP(`w`.`added`) `added`, `f`.`info_hash`, `f`.`filename`, `f`.`size`, ".$tseeds.", ".$tleechs.", ".$tcompletes.", `f`.`speed`, `f`.`external`, `c`.`image`, `c`.`id` `catid`, `c`.`name` `cname` FROM `{$TABLE_PREFIX}wishlist` `w` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `w`.`torrent_id`=`f`.`info_hash` LEFT JOIN `{$TABLE_PREFIX}categories` `c` ON `f`.`category`=`c`.`id` ".$ttables." WHERE `w`.`user_id`=".$CURUSER["uid"]." ".$limit, true, $btit_settings["cache_duration"]);

    $wish=array();
    $i=0;
    if(count($qry)>0)
    {
        $bookmarktpl->set("wish_empty", false, true);
        foreach($qry as $res)
        {
            // torrent exists in database
            $category="<a href=index.php?page=torrents&category=".$res["catid"].">".image_or_link(($res["image"]==""?"":$STYLEPATH."/images/categories/" . $res["image"]),"",$res["cname"])."</td>";
            $filename="<a href=index.php?page=details&id=".$res["info_hash"]."&returnto=bookmark.php>".$res["filename"]."</a>";
$download="<a href=".(($btit_settings["fmhack_download_ratio_checker"]=="enabled")?"index.php?page=downloadcheck&":"download.php?")."id=".$res["info_hash"]."&f=" . rawurlencode(html_entity_decode($res["filename"])) . ".torrent><button class='btn btn-primary btn-circle' type='button'><i class='fa fa-download'></i></button></a>";
            $size=makesize($res["size"]);
            $seeds="<a href='index.php?page=peers&id=".$res["info_hash"]."&returnto=index.php?page=bookmark' title='".$language["PEERS_DETAILS"]."'><span style='color:green;'>".$res["seeds"]."</span></a></td>";
            $leechers="<a href='index.php?page=peers&id=".$res["info_hash"]."&returnto=index.php?page=bookmark' title='".$language["PEERS_DETAILS"]."'><span style='color:red;'>".$res["leechers"]."</span></a></td>";
            $completes="<a href='index.php?page=torrent_history&id=".$res["info_hash"]."'><span style='color:purple;'>".$res["finished"]."</span></a>";
            if ($res["speed"] <=0 || $res["external"]=="yes")
                $speed = $language["NA"];
            elseif ($res["speed"] >=1048576)
                $speed = round($res["speed"]/1048576,2) . " MB/sec";
            else
                $speed = round($res["speed"] / 1024, 2) . " KB/sec";

            $wish[$i]["id"]=$res["id"];
            $wish[$i]["category"]=$category;
            $wish[$i]["file"]=$filename;
            $wish[$i]["down"]=$download;
            $wish[$i]["size"]=$size;
            $wish[$i]["seed"]=$seeds;
            $wish[$i]["leech"]=$leechers;
            $wish[$i]["completed"]=$completes;
            $wish[$i]["speed"]=$speed;
            $wish[$i]["added"]=get_date_time($res["added"]);
            $wish[$i]["delete"]="<a href=\"index.php?page=bookmark&do=del&amp;id=".$wish[$i]["id"]."\" onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\"><button class='btn btn-danger btn-circle' type='button'><i class='fa fa-times'></i></button></a>";
            $i++;
        }
    }
    else
        $bookmarktpl->set("wish_empty", true, true);
}

$bookmarktpl->set("wish",$wish);

?>
