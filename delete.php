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


$id = sql_esc($_GET["info_hash"]);

if (!isset($id) || !$id)
die("Error ID");

$query1_select="";
if($btit_settings["fmhack_torrent_image_upload"]=="enabled")
$query1_select.="f.screen1, f.screen2, f.screen3, f.image,";

if ($XBTT_USE)
$res = do_sqlquery("SELECT ".$query1_select." f.info_hash, f.uploader, f.filename, f.url, UNIX_TIMESTAMP(f.data) as data, f.size, f.comment, c.name as cat_name, f.seeds+ ifnull(x.seeders,0) as seeds, f.leechers+ ifnull(x.leechers,0) as leechers, f.finished+ ifnull(x.completed,0) as finished, f.speed FROM {$TABLE_PREFIX}files f LEFT JOIN xbt_files x ON x.info_hash=f.bin_hash LEFT JOIN {$TABLE_PREFIX}categories c ON c.id=f.category WHERE f.info_hash ='" . $id . "'",true);
else
$res = do_sqlquery("SELECT ".$query1_select." f.info_hash, f.uploader, f.filename, f.url, UNIX_TIMESTAMP(f.data) as data, f.size, f.comment, c.name as cat_name, f.seeds, f.leechers, f.finished, f.speed FROM {$TABLE_PREFIX}files f LEFT JOIN {$TABLE_PREFIX}categories c ON c.id=f.category WHERE f.info_hash ='" . $id . "'",true);

$row = $res->fetch_assoc();

if($btit_settings["fmhack_torrent_image_upload"]=="enabled")
{
   $image_drop = "" . $row["image"]. "";
   $image_drop1 = "" . $row["screen1"]. "";
   $image_drop2 = "" . $row["screen2"]. "";
   $image_drop3 = "" . $row["screen3"]. "";
}

$uploader_allowed=((!$CURUSER || $CURUSER["uid"]<2 || $CURUSER["uid"]!=$row["uploader"])?"no":"yes");
if($btit_settings["fmhack_uploader_rights"]=="enabled" && $uploader_allowed=="yes" && $btit_settings["ulri_delete"]=="no")
$uploader_allowed="no";

if ($uploader_allowed=="no" && $CURUSER["delete_torrents"]!="yes")
{
   stderr($language["SORRY"],$language["CANT_DELETE_TORRENT"]);
}

$scriptname = htmlspecialchars($_SERVER["PHP_SELF"]);

$link = urldecode($_GET["returnto"]);
$hash = AddSlashes($_GET["info_hash"]);

if ($link=="")
$link="index.php?page=torrents";

if (isset($_POST["action"]))
{
   //start torrent deleted
   if ($_POST["action"]==$language["DELETE"])
   {
      if($_POST["reason"]=="")
      {
         stderr("Sorry!","torrent $hash not found. Please enter a reason for the removal of this torrent, should it exist.");
      }
      else
      $reason=AddSlashes($_POST["reason"]);

      $ris = do_sqlquery("SELECT f.info_hash, f.filename, f.url, f.uploader, u.username FROM {$TABLE_PREFIX}files f , {$TABLE_PREFIX}users u WHERE f.uploader=u.id AND info_hash=\"$hash\"") or die(sql_error());

      if (sql_num_rows($ris)==0)
      {
         stderr("Sorry!", "torrent $hash not found.");
      }
      else
      {
         $ris1 = $ris->fetch_array(); $ris->free();
         $torhash=$ris1['info_hash']; $torname=$ris1['filename']; $torurl=$ris1['url'];
         $torupid=$ris1['uploader']; $torupname=$ris1['username'];
         unset($ris1);
      }

      $subject="Torrent Deleted.";
      $body="$torupname, \n\n Your torrent, ($torname) has been deleted for the following reasons: \n\n$reason";

      quickQuery("INSERT INTO {$TABLE_PREFIX}messages (sender, receiver, added, subject, msg) VALUES (".$CURUSER['uid'].", $torupid, UNIX_TIMESTAMP(), '$subject', '$body')")or sqlerr(__FILE__, __LINE__);

      write_log("Deleted torrent {$torname} ({$torhash}) Deleted by {$CURUSER['username']} ({$reason})","delete");
      //end torrent deleted

      if($btit_settings["fmhack_torrent_image_upload"]=="enabled")
      {
         if (!empty($image_drop))
         @unlink("".$GLOBALS["uploaddir"]."$image_drop");
         if (!empty($image_drop1))
         @unlink("".$GLOBALS["uploaddir"]."$image_drop1");
         if (!empty($image_drop2))
         @unlink("".$GLOBALS["uploaddir"]."$image_drop2");
         if (!empty($image_drop3))
         @unlink("".$GLOBALS["uploaddir"]."$image_drop3");
      }

      @quickQuery("DELETE FROM {$TABLE_PREFIX}files WHERE info_hash=\"$hash\"");
      @quickQuery("DELETE FROM {$TABLE_PREFIX}timestamps WHERE info_hash=\"$hash\"");
      @quickQuery("DELETE FROM {$TABLE_PREFIX}comments WHERE info_hash=\"$hash\"");
      @quickQuery("DELETE FROM {$TABLE_PREFIX}ratings WHERE infohash=\"$hash\"");
      @quickQuery("DELETE FROM {$TABLE_PREFIX}peers WHERE infohash=\"$hash\"");
      @quickQuery("DELETE FROM {$TABLE_PREFIX}history WHERE infohash=\"$hash\"");

      IF ($XBTT_USE)
      quickQuery("UPDATE xbt_files SET flags=1 WHERE info_hash=UNHEX('$hash')") or die(sql_error());

      unlink($TORRENTSDIR."/$hash.btf");

      ######################################
      # Nfo hack -->
      if($btit_settings["fmhack_NFO_uploader_-_viewer"]=="enabled")
      {
         @unlink("nfo/rep/" . $hash . ".nfo");
      }
      # End
      ################################## -->

      redirect($link);
      exit();

   }
   else
   {
      redirect($link);
      exit();
   }
}

$torrenttpl=new bTemplate();
$torrenttpl->set("language",$language);

$torrent=array();
$torrent["filename"]=$row["filename"];
$torrent["info_hash"]=$row["info_hash"];
$torrent["description"]=format_comment($row["comment"]);
$torrent["catname"]=$row["cat_name"];
$torrent["size"]=makesize($row["size"]);
include(dirname(__FILE__)."/include/offset.php");
$torrent["date"]=date("d/m/Y",$row["data"]-$offset);
if (!$XBTT_USE)
{
   if ($row["speed"] < 0) {
      $speed = "N/D";
   }
   else if ($row["speed"] > 2097152) {
      $speed = round($row["speed"]/1048576,2) . " MB/sec";
   }
   else {
      $speed = round($row["speed"] / 1024, 2) . " KB/sec";
   }
   $torrenttpl->set("NO_XBBT",true,true);
}
else
$torrenttpl->set("NO_XBBT",false,true);

$torrent["speed"]=$speed;
$torrent["complete"]=$row["finished"];
$torrent["peers"]=$language["PEERS"]." :" .$row["seeds"].",".$language["LEECHERS"] .": ". $row["leechers"]."=". ($row["leechers"]+$row["seeds"]). " ". $language["PEERS"];
$torrent["return"]=urlencode($link);

unset($row);
$res->free();

$torrenttpl->set("torrent",$torrent);

?>
