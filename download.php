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

$THIS_BASEPATH=dirname(__FILE__);

require_once("$THIS_BASEPATH/include/functions.php");
require_once ("$THIS_BASEPATH/include/BDecode.php");
require_once ("$THIS_BASEPATH/include/BEncode.php");

dbconn();

(isset($_GET["id"]) && !empty($_GET["id"])) ? $_GET["id"]=strtolower(preg_replace("/[^A-Fa-f0-9]/", "", $_GET["id"])) : $_GET["id"]="";

$completedb4=false;

if($XBTT_USE)
    $res=get_result("SELECT COUNT(*) `count` FROM `xbt_files_users` `xfu` INNER JOIN `xbt_files` `xf` ON `xfu`.`fid`=`xf`.`fid` INNER JOIN `{$TABLE_PREFIX}users` `u` ON `xfu`.`uid`=`u`.`id` WHERE `xfu`.`completed`>0 AND `xf`.`info_hash`=0x".sqlesc($_GET["id"])." AND `xfu`.`uid`=".$CURUSER["uid"]);
else
    $res=get_result("SELECT COUNT(*) `count` FROM `{$TABLE_PREFIX}history` `h` INNER JOIN `{$TABLE_PREFIX}users` `u` ON `h`.`uid`=`u`.`id` WHERE `h`.`completed`='yes' AND `h`.`infohash`='".sql_esc($_GET["id"])."' AND `h`.`uid`=".$CURUSER["uid"]);

if($res[0]["count"]>0)
    $completedb4=true;

if($btit_settings["fmhack_download_ratio_checker"]=="enabled" && $CURUSER["bypass_dlcheck"]==0 && $completedb4===false)
{
    session_name("BluRG");
    session_start();
    (isset($_GET["key"])? $key=$_GET["key"] : $key=(int)0);

    if (!$CURUSER || $CURUSER["can_download"]=="no" || $CURUSER["dlrandom"]!=$key)
    {
        if($CURUSER["can_download"]=="yes" && $key==0)
        {
            // Lets double-check their ratio before rejecting just in case the download
            // attempt is coming from a BitTorrent client via the RSS feed
            $manual_test=get_result("SELECT IF(`downloaded` >0, `uploaded`/`downloaded`, '9999.999') `ratio` FROM `".(($XBTT_USE)?"xbt_":$TABLE_PREFIX)."users` WHERE `".(($XBTT_USE)?"u":"")."id`=".$CURUSER["uid"]);
            if(count($manual_test)==1)
                $user_ratio=(float)$manual_test[0]["ratio"];
            else
                $user_ratio=(int)0;

            $btit_settings["mindlratio"]=(float)$btit_settings["mindlratio"];

            if($user_ratio<$btit_settings["mindlratio"])
            {
                require(load_language("lang_main.php"));
                die($language["NOT_AUTH_DOWNLOAD"]);
            }
        }
        else
        {
            require(load_language("lang_main.php"));
            die($language["NOT_AUTH_DOWNLOAD"]);
        }
    }

    $rand=substr(md5(mt_rand()),0,8);
    quickQuery("UPDATE {$TABLE_PREFIX}users SET dlrandom='$rand' WHERE id=".$CURUSER["uid"]);
    $_SESSION["CURUSER"]["dlrandom"]=$rand;
}
else
{
    if (!$CURUSER || $CURUSER["can_download"]=="no")
    {
        require_once(load_language("lang_main.php"));
        die($language["NOT_AUTH_DOWNLOAD"]);
    }
}

if($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled" && $completedb4===false)
{
    if(!is_null($CURUSER["block_leech"]) && $CURUSER["block_leech"] > 0 && $CURUSER["hnr_count"]>=$CURUSER["block_leech"])
    {
        require_once(load_language("lang_main.php"));
        die($language["HNR_CANT_DOWN"]);
    }
}

if($btit_settings["fmhack_allow_and_disallow_users_to_up_and_download"]=="enabled" && $completedb4===false)
{
    if ($CURUSER["allowdownload"] == "no")
    {
        require_once(load_language("lang_main.php"));
        die($language["NOT_AUTH_DOWNLOAD"]);
    }
}

if(ini_get('zlib.output_compression'))
  ini_set('zlib.output_compression','Off');

$infohash=sql_esc($_GET["id"]);
$filepath=$TORRENTSDIR."/".$infohash . ".btf";

if($btit_settings["fmhack_archive_torrents"]=="enabled" && $completedb4===false)
{
    $down_err=false;
    $res=get_result("SELECT `archive` FROM `{$TABLE_PREFIX}files` WHERE `info_hash`='".$infohash."'");
    if(count($res)>0)
    {
        if($res[0]["archive"]==0 && $CURUSER["down_new"]=="no")
            $down_err=true;
        elseif($res[0]["archive"]==1 && $CURUSER["down_arc"]=="no")
            $down_err=true;
    }
    else
        $down_err=true;

    if($down_err===true)
    {
        require_once(load_language("lang_main.php"));
        die($language["NOT_AUTH_DOWNLOAD"]);
    }
}

if (!is_file($filepath) || !is_readable($filepath))
{
 require_once(load_language("lang_main.php"));
 die($language["CANT_FIND_TORRENT"]);
}

// This just seems to mess up the filename adding %20's etc. Reverted until I can find a better way of doing whatever it's supposed to do.
//$f=rawurlencode(html_entity_decode($_GET["f"]));
$_GET["f"]=str_replace("&amp;","_",$_GET["f"]);# &amp issue
$f=urldecode($_GET["f"]);

if($btit_settings["fmhack_last_download_block"]=="enabled" && $btit_settings["fmhack_IP_to_country"]=="enabled")
{
    quickQuery("INSERT INTO `{$TABLE_PREFIX}downloads` (`uid`, `info_hash`, `date`) VALUES ('".$CURUSER["uid"]."','$infohash', NOW())", true);
}

if($btit_settings["fmhack_download_prefix_or_suffix"]=="enabled")
{
    if(isset($btit_settings["download_prefix"]) && !empty($btit_settings["download_prefix"]))
        $f=$btit_settings["download_prefix"].$f;
    if(isset($btit_settings["download_suffix"]) && !empty($btit_settings["download_suffix"]))
        $f=str_replace(".torrent", "", $f).$btit_settings["download_suffix"].".torrent";
}

// pid code begin
$row =get_result("SELECT pid FROM {$TABLE_PREFIX}users WHERE id=".$CURUSER['uid'],true,$btit_settings['cache_duration']);
$pid=$row[0]["pid"];
if (!$pid)
{
 $pid=md5(uniqid(rand(),true));
 quickQuery("UPDATE {$TABLE_PREFIX}users SET pid='".$pid."' WHERE id='".$CURUSER['uid']."'");
 if ($XBTT_USE)
  quickQuery("UPDATE xbt_users SET torrent_pass='".$pid."' WHERE uid='".$CURUSER['uid']."'");
}

$result=get_result("SELECT * FROM {$TABLE_PREFIX}files WHERE info_hash='".$infohash."'",true,$btit_settings['cache_duration']);
$row = $result[0];

if($btit_settings["fmhack_downloaded_torrents"]=="enabled")
{
    if($row["uploader"]!=$CURUSER["uid"])
    {
        quickQuery("DELETE FROM `{$TABLE_PREFIX}down_load` WHERE `pid`='".$CURUSER["pid"]."' AND `hash`='$infohash'",true);
        quickQuery("INSERT INTO `{$TABLE_PREFIX}down_load` (`pid`, `hash`, `time`) VALUES('".$CURUSER["pid"]."', '$infohash', NOW())",true);
    }
}

if($btit_settings["fmhack_torrent_moderation"]=="enabled")
{
    if((($row["moder"]=="um" || $row["moder"]=="bad") && $CURUSER["uid"]!=$row["uploader"]))
        die("Access Denied - Torrent bad or unmoderated.");
}
if($btit_settings["fmhack_teams"]=="enabled")
{
    if($row["team"]!=0)
    {
        $allowed="no";
        if($CURUSER["team"]==$row["team"] || $CURUSER["all_teams"]=="yes"|| $CURUSER['sel_team']==$row["team"])
            $allowed="yes";
        if($allowed=="no")
        {
            require_once(load_language("lang_main.php"));
            die($language["TEAM_ERROR"]);
        }
    }
}

if ($row["external"]=="yes" || !$PRIVATE_ANNOUNCE)
{
    $fd = fopen($filepath, "rb");
    $alltorrent = fread($fd, filesize($filepath));
    fclose($fd);
    header("Content-Type: application/x-bittorrent");
    header('Content-Disposition: attachment; filename="'.$f.'"');
    print($alltorrent);
}
else
{
    $fd = fopen($filepath, "rb");
    $alltorrent = fread($fd, filesize($filepath));
    $array = BDecode($alltorrent);
/*
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    die;
*/
    fclose($fd);

    $BASEURLn = str_replace("/announce.php","",$TRACKER_ANNOUNCEURLS[0]);   
    if(substr($BASEURL,0,5) == "https")
    {
        if($CURUSER["force_ssl"] != "yes")
        {
            $BASEURLn = str_replace("https","http",$BASEURL);
        }
    }

    if ($XBTT_USE)
     $array["announce"] = $XBTT_URL."/$pid/announce";
 else
     $array["announce"] = $BASEURLn."/announce.php?pid=$pid";

 if (isset($array["announce-list"]) && is_array($array["announce-list"]))
 {
     for ($i=0;$i<count($array["announce-list"]);$i++)
     {
         for ($j=0;$j<count($array["announce-list"][$i]);$j++)
         {
             if (in_array($array["announce-list"][$i][$j],$TRACKER_ANNOUNCEURLS))
             {
              if (strpos($array["announce-list"][$i][$j],"announce.php")===false)
               $array["announce-list"][$i][$j] = trim(str_replace("/announce", "/$pid/announce", $array["announce-list"][$i][$j]));
           else
               $array["announce-list"][$i][$j] = trim(str_replace("/announce.php", "/announce.php?pid=$pid", $array["announce-list"][$i][$j]));
       }
   }
}
}

$alltorrent=BEncode($array);

header("Content-Type: application/x-bittorrent");
header('Content-Disposition: attachment; filename="'.$f.'"');
print($alltorrent);
}
?>
