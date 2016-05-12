<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// ** Featured Torrent Block Hack By MCANGELI 1/30/2008
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
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
//
////////////////////////////////////////////////////////////////////////////////////

if (!defined("IN_BTIT"))
  die("non direct access!");

if (!defined("IN_ACP"))
  die("non direct access!");

global $THIS_BASEPATH, $language, $THE_BASEPATH;

$admintpl=new bTemplate();
$admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=featured&amp;action=save&amp;mode=new");

/* Admin tool for the Featured Torrent*/

// include language file
include(load_language("lang_featured.php"));

switch ($action)
{
  case 'save':
  if ($_POST["id"])
  {
   $tor_id = $_POST["id"];
   do_sqlquery("INSERT INTO {$TABLE_PREFIX}featured (fid,torrent_id) VALUES ('','$tor_id')");
 }

 case 'read':
 default: 
 if ($btit_settings["imdbbl"]==true ) 
  $query = do_sqlquery("SELECT info_hash, filename from {$TABLE_PREFIX}files where imdb!='' ORDER BY data DESC limit 15");
else       
  $query = do_sqlquery("SELECT info_hash, filename from {$TABLE_PREFIX}files where image!='' ORDER BY data DESC limit 15");


$torrents=array();
$i=0;
while ($results=$query->fetch_array()) {

  $torrents[$i]["hash"]= "<tr><td><input type=radio value=".$results['info_hash']." name=id>";
  $torrents[$i]["name"]= " - ".$results['filename']."</td></tr>";

  $i++;
}
unset($result);
$query->free();

$admintpl->set("TORRENT",$torrents);

// This is the part that will print the currently featured torrent
if ($XBTT_USE)
{
  $tseeds="f.seeds+ifnull(x.seeders,0) as seeds";
  $tleechs="f.leechers+ifnull(x.leechers,0) as leechers";
  $tcompletes="f.finished+ifnull(x.completed,0) as finished";
  $ttables="{$TABLE_PREFIX}files f LEFT JOIN xbt_files x ON x.info_hash=f.bin_hash";
}
else
{
  $tseeds="f.seeds as seeds";
  $tleechs="f.leechers as leechers";
  $tcompletes="f.finished as finished";
  $ttables="{$TABLE_PREFIX}files f";
}

$sql = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}featured ORDER BY fid DESC limit 1");
$result = $sql->fetch_assoc();

$torrent = do_sqlquery("SELECT f.info_hash, f.filename, f.url, UNIX_TIMESTAMP(f.data) as data, f.size, f.comment, f.uploader, c.name as cat_name, c.image as cat_image, c.id as cat_id, $tseeds, $tleechs, $tcompletes, f.speed, f.external, f.announce_url,UNIX_TIMESTAMP(f.lastupdate) as lastupdate,UNIX_TIMESTAMP(f.lastsuccess) as lastsuccess, f.anonymous, u.username FROM $ttables LEFT JOIN {$TABLE_PREFIX}categories c ON c.id=f.category LEFT JOIN {$TABLE_PREFIX}users u ON u.id=f.uploader WHERE f.info_hash =\"".$result['torrent_id']."\"");

$featured=array();
$a=0;

while ($tor = $torrent->fetch_assoc() )
{
  $description = format_comment($tor["comment"]);
  $featured[$a]["name"]="<a href=/index.php?page=torrent-details&id=".$tor['info_hash'].">".$tor['filename']."</a>";
  $featured[$a]["cat"]="<a href=\"index.php?page=torrents&amp;category=".$tor['cat_id']."\">" . image_or_link( ($tor["cat_image"] == "" ? "" : "$STYLEPATH/images/categories/large/" . $tor["cat_image"]), "", $tor["cat_name"]) . "</a>";
  $featured[$a]["sl"]="<br /><b>Seeders: </b>".$tor['seeds']."<br />
  <b>Leechers: </b>".$tor['leechers']."";
//description
  $featured[$a]["desc"]="<table border=0 style=\"border:0px\" width=\"99%\"><tr><td>".((strlen($description)>40)?substr($description,0,40):$description)."</td></tr></table>";

$a++;
}
$admintpl->set("language",$language);
$admintpl->set("CURRENT",$featured);
break;
}
?>