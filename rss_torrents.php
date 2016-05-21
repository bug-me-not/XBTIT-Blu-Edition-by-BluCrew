<?php

require_once "include/functions.php";
require_once "include/config.php";

dbconn(true);

$pid = (isSet($_GET['pid']) && !empty($_GET['pid'])) ? sql_esc($_GET['pid']) : "";

if(!empty($pid))
{
  $user = do_sqlquery("SELECT count(*) FROM {$TABLE_PREFIX}users u LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE u.pid='$pid' AND ul.id_level>2");
  if(sql_num_rows($user) != 1)
  {
    header(ERR_500);
    die();
  }
}
else
{
  header(ERR_500);
  die();
}

$feed = (isSet($_GET['feed']) && !empty($_GET['feed'])) ? sql_esc($_GET['feed']) : "";  
$cats = array();

if(isSet($_GET['cat']))
{
  foreach($_GET['cat'] as $cat)
  {
    $cats[] = 0 + $cat;
  }
}

if(count($cats) < 1)
{
  header(ERR_500);
  die();
}

if(count($cats) >1)
{
  $where = "WHERE f.category IN (".implode(", ",$cats).") ";
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

$rss = get_result("SELECT f.info_hash, f.comment as description, f.filename, $tseeds as seeds, $tleechs as leech, UNIX_TIMESTAMP(f.data) as added, c.name as catname, f.size FROM $ttables LEFT JOIN {$TABLE_PREFIX}categories c ON c.id=f.category $where AND f.moder = 'ok' ORDER BY data DESC LIMIT 25",true,$btit_settings['cache_duration']);

header("Content-type: text/xml");
print("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
?>

<rss version="2.0">
  <channel>
    <title><?php print $SITENAME;?></title>
    <description>RSS feed by beeman (modified by Lupin / VisiGod / DiemThuy / Gaart)</description>
    <link><?php print $BASEURL;?></link>
    <lastBuildDate><?php print date("D, d M Y H:i:s O");?></lastBuildDate>
    <copyright><?php print "(c) ".date("Y",time()). " ".$SITENAME;?> </copyright>

    <?php
    foreach($rss as $id=>$item)
    {
     $hash = $item['info_hash'];
     $filename = $item['filename'];
     $added = strip_tags(date("D, d M Y H:i:s O",$item['added']));
     $catname = strip_tags($item['catname']);
     $seeders = strip_tags($item['seeds']);
     $leechers = strip_tags($item['leech']);
     $desc = "";
     $size = $item['size'];
     $title = htmlspecialchars("[".$catname."] ".$filename." [Seeders (".$seeders.") / Leechers (".$leechers.")]");
     $furl = rawurlencode($item['filename']);
     $durl = $BASEURL."/download.php?id=".$hash."&amp;f=".$furl.".torrent&amp;rsspid=".$pid."";
     $vurl = $BASEURL."/index.php?page=torrent-details&amp;id=".$hash."";

     if ($feed == "dl" )
     {
      $link="<link>".$durl."</link>";
      $guid="<guid>".$durl."</guid>";
    }
    else
    {
      $link="<link>".$vurl."</link>";
      $guid="<guid>".$vurl."</guid>";
    }
    ?>

    <item>
      <title><![CDATA[<?php print $title;?>]]></title>
      <description><?php print $filename;?></description>
      <?php print $link; ?>
      <?php print $guid; ?>
      <enclosure url="<?php ($feed=='dl')?print $durl:print $vurl; ?>" length="<?php print $size; ?>" type="application/x-bittorrent" />
        <pubDate><?php print $added; ?></pubDate>
      </item>
      <?php
    }
    ?>
  </channel>
</rss>