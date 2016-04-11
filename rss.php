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

if ($CURUSER["view_torrents"]!="yes" && $CURUSER["view_forum"]!="yes")
   {
   header(ERR_500);
   die;
}

header("Content-type: text/xml");
print("<?xml version=\"1.0\" encoding=\"".$GLOBALS["charset"]."\"?>");

function safehtml($string)
{
$validcharset=array(
"ISO-8859-1",
"ISO-8859-15",
"UTF-8",
"cp866",
"cp1251",
"cp1252",
"KOI8-R",
"BIG5",
"GB2312",
"BIG5-HKSCS",
"Shift_JIS",
"EUC-JP");

   if (in_array($GLOBALS["charset"],$validcharset))
      return htmlentities($string,ENT_COMPAT,$GLOBALS["charset"]);
   else
       return htmlentities($string);
}

?>

<rss version="2.0" >
<channel>
<title><?php print $SITENAME;?></title>
<description>rss feed script designed and coded by beeman (modified by Lupin and VisiGod)</description>
<link><?php print $BASEURL;?></link>
<lastBuildDate><?php print date("r");?></lastBuildDate>
<copyright><?php print "(c) ". date("Y",time())." " .$SITENAME;?></copyright>

<?php

if ($CURUSER["view_torrents"]=="yes")
{
  $query1_where="";
  if($btit_settings["fmhack_teams"]=="enabled" && $btit_settings["team_state"]=="private")
      $query1_where.="WHERE (".$CURUSER['team']." = `f`.`team` OR `f`.`team` = 0 OR '".$CURUSER['all_teams']."'='yes' OR '".$CURUSER['sel_team']."'=`f`.`team`) ";
  if($btit_settings["fmhack_torrent_moderation"]=="enabled")
      $query1_where.(($query1_where=="")?"WHERE":"AND")." `f`.`moder`='ok' ";

  $getItems = "SELECT ".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?"`f`.`id` `fileid`, ":"")."f.info_hash as id, f.comment as description, f.filename, $tseeds AS seeders, $tleechs as leechers, UNIX_TIMESTAMP( f.data ) as added, c.name as cname, f.size FROM $ttables LEFT JOIN {$TABLE_PREFIX}categories c ON c.id = f.category ".$query1_where." ORDER BY data DESC LIMIT 20";
  $doGet=get_result($getItems,true,$btit_settings['cache_duration']);

  foreach($doGet as $item)
   {
    $id=$item['id'];
    $filename=strip_tags($item['filename']);
    $added=strip_tags(date("r",$item['added']));
    $descr=format_comment($item['description']."\n");
    $seeders=strip_tags($item['seeders']);
    $leechers=strip_tags($item['leechers']);
    // output to browser
(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?$link="<link>".$BASEURL."/".strtr($item["filename"], $res_seo["str"], $res_seo["strto"])."-".$item["fileid"].".html</link>":
$link="<link>".$BASEURL."/index.php?page=torrent-details&amp;id=".$id."</link>");
?>

  <item>
  <title><![CDATA[<?php print htmlspecialchars("[".TORRENT."] ".$filename);?>]]></title>
  <description><![CDATA[<?php print ($descr)." (".SEEDERS." ".safehtml($seeders)." -- ".LEECHERS." ".safehtml($leechers);?>)]]></description>
  <?php echo $link;?>
  <pubDate><?php print $added;?></pubDate>
  </item>

<?php
  }
}
// forums
if ($CURUSER["view_forum"]=="yes")
{
  $getItems = "select t.id as topicid, p.id as postid, f.name, u.username,t.subject,p.added, p.body from {$TABLE_PREFIX}topics t inner join {$TABLE_PREFIX}posts p on p.topicid=t.id inner join {$TABLE_PREFIX}forums f on t.forumid=f.id inner join {$TABLE_PREFIX}users u on u.id=p.userid ORDER BY added DESC LIMIT 50";
  $doGet=get_result($getItems,true,$btit_settings['cache_duration']);

  foreach($doGet as $item)
   {
    $topicid=$item['topicid'];
    $postid=$item['postid'];
    $forum=(htmlspecialchars($item['name']));
    $subject=(htmlspecialchars($item['subject']));
    $added=strip_tags(date("r",$item['added']));
    $body=format_comment("[b]Author: ".$item['username']."[/b]\n\n".$item['body']."\n");
    // output to browser
    $link=htmlspecialchars($BASEURL."/index.php?page=forum&action=viewtopic&topicid=$topicid&page=p$postid#$postid");
?>

  <item>
  <title><![CDATA[<?php print ("[".FORUM."] ".$forum." - ".$subject);?>]]></title>
  <description><![CDATA[<?php print ($body); ?>]]></description>
  <link><?php print $link;?></link>
  <pubDate><?php print $added;?></pubDate>
  </item>

<?php
    }
}

?>
</channel>
</rss>
