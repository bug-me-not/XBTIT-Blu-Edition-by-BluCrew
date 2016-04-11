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
//
// **Edited by mcangeli on 1/24/2008 to correct torrent detail link
//
////////////////////////////////////////////////////////////////////////////////////

die("Error");
require_once("include/functions.php");
require_once("include/config.php");

dbconn(true);

if($btit_settings["fmhack_SEO_panel"]=="enabled")
{
    $active_seo = get_result("SELECT `activated`, `str`, `strto` FROM `{$TABLE_PREFIX}seo` WHERE `id`='1'", true, $btit_settings["cache_duration"]);
    $res_seo=$active_seo[0];
}

if ($XBTT_USE)
   {
    $tseeds="f.seeds+ifnull(x.seeders,0)";
    $tleechs="f.leechers+ifnull(x.leechers,0)";
    $ttables="{$TABLE_PREFIX}files f INNER JOIN xbt_files x ON x.info_hash=f.bin_hash";
   }
else
    {
    $tseeds="f.seeds";
    $tleechs="f.leechers";
    $ttables="{$TABLE_PREFIX}files f";
    }

if ($CURUSER["view_torrents"]!="yes")
   {
   header(ERR_500);
   die;
}

header("Content-type: text/xml");

print("<?xml version=\"1.0\" encoding=\"".$GLOBALS["charset"]."\"?>");
?>

<rss version="2.0">
<channel>
<title><?php print $SITENAME;?></title>
<description>rss feed script designed and coded by beeman (modified by Lupin and VisiGod)</description>
<link><?php print $BASEURL;?></link>
<lastBuildDate><?php print date("r");?></lastBuildDate>
<copyright><?php print "(c) ". date("Y",time())." " .$SITENAME;?></copyright>

<?php

  $query1_where="";
  if($btit_settings["fmhack_teams"]=="enabled" && $btit_settings["team_state"]=="private")
      $query1_where.="WHERE (".$CURUSER['team']." = `f`.`team` OR `f`.`team` = 0 OR '".$CURUSER['all_teams']."'='yes' OR '".$CURUSER['sel_team']."'=`f`.`team`) ";
  if($btit_settings["fmhack_torrent_moderation"]=="enabled")
      $query1_where.(($query1_where=="")?"WHERE":"AND")." `f`.`moder`='ok' ";

  $getItems = "SELECT ".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?"`f`.`id` `fileid`, ":"")."f.info_hash as id, f.comment as description, f.filename, $tseeds AS seeders, $tleechs as leechers, UNIX_TIMESTAMP( f.data ) as added, c.name as cname, f.size FROM $ttables LEFT JOIN {$TABLE_PREFIX}categories c ON c.id = f.category ".$query1_where." ORDER BY data DESC LIMIT 20";
  $doGet=get_result($getItems,true,$btit_settings['cache_duration']);

  foreach($doGet as $id=>$item)
   {
    $id=$item['id'];
    $filename=($item['filename']);
    $added=strip_tags(date("r",$item['added']));
    $cat=strip_tags($item['cname']);
    $seeders=strip_tags($item['seeders']);
    $leechers=strip_tags($item['leechers']);
    $desc=format_comment($item['description']);
    $f=rawurlencode($item['filename']);
    // output to browser
(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?$link="<link>".$BASEURL."/".strtr($item["filename"], $res_seo["str"], $res_seo["strto"])."-".$item["fileid"].".html</link>":
$link="<link>".$BASEURL."/index.php?page=torrent-details&amp;id=".$id."</link>");
(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?$guid="<guid>".$BASEURL."/".strtr($item["filename"], $res_seo["str"], $res_seo["strto"])."-".$item["fileid"].".html</guid>":
$guid="<guid>".$BASEURL."/index.php?page=torrent-details&amp;id=".$id."</guid>");

$allowed_to_download="yes";

if($btit_settings["fmhack_booted"]=="enabled" && $CURUSER["booted"]=="yes")
    $allowed_to_download="no";
if($btit_settings["fmhack_ban_button"]=="enabled" && $CURUSER["ban"]=="yes" && $allowed_to_download=="yes")
    $allowed_to_download="no";
if($btit_settings["fmhack_low_ratio_ban_system"]=="enabled" && $CURUSER["bandt"]=="yes" && $allowed_to_download=="yes")
    $allowed_to_download="no";
if($btit_settings["fmhack_allow_and_disallow_users_to_up_and_download"]=="enabled" && $CURUSER["allowdownload"]=="no" && $allowed_to_download=="yes")
    $allowed_to_download="no";
if($btit_settings["fmhack_download_ratio_checker"]=="enabled" && $allowed_to_download=="yes")
{
    $user_ratio=(($CURUSER["downloaded"]>0)?number_format($CURUSER["uploaded"]/$CURUSER["downloaded"],3):999.99);

    if($user_ratio<$btit_settings["mindlratio"] && $CURUSER["bypass_dlcheck"]==0)
        $allowed_to_download="no";
}

?>
  <item>
  <title><![CDATA[<?php print htmlspecialchars("[$cat] $filename [".SEEDERS." ($seeders)/".LEECHERS." ($leechers)]");?>]]></title>
  <description><![CDATA[<?php print $desc; ?>]]></description>
  <?php echo $link;?>
  <?php echo $guid;?>
  <?php if($allowed_to_download=="yes")
  {
      ?>
      <enclosure url="<?php print("$BASEURL/download.php?id=$id&amp;f=$f.torrent");?>" length="<?php print $item["size"] ?>" type="application/x-bittorrent" />
      <?php
  }
  ?>
  <pubDate><?php print $added;?></pubDate>
  </item>

<?php
}

?>
</channel>
</rss>
