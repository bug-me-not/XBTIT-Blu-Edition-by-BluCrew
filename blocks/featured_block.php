<?php

global $BASEURL, $STYLEPATH, $dblist, $XBTT_USE,$btit_settings;

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

$exclude="";

if ($XBTT_USE)
$rowcat = do_sqlquery("SELECT u.id, (u.downloaded+IFNULL(x.downloaded,0)) as downloaded, ((u.uploaded+IFNULL(x.uploaded,0))/(u.downloaded+IFNULL(x.downloaded,0))) as uratio, cp.* FROM {$TABLE_PREFIX}users u LEFT JOIN xbt_users x ON x.uid=u.id INNER JOIN {$TABLE_PREFIX}categories_perm cp ON u.id_level=cp.levelid WHERE u.id = ".$CURUSER["uid"].";",true);
else
$rowcat = do_sqlquery("SELECT u.id, u.downloaded, (u.uploaded/u.downloaded) as uratio, cp.* FROM {$TABLE_PREFIX}users u INNER JOIN {$TABLE_PREFIX}categories_perm cp ON u.id_level=cp.levelid WHERE u.id = ".$CURUSER["uid"].";",true);
if (sql_num_rows($rowcat)>0)
while ($catdata=$rowcat->fetch_array())
if($catdata["viewtorrlist"]!="yes" && (($catdata["downloaded"]>=$GLOBALS["download_ratio"] && ($catdata["ratio"]>$catdata["uratio"]))||($catdata["downloaded"]<$GLOBALS["download_ratio"])||($catdata["ratio"]=="0")))
$exclude.=' AND f.category!='.$catdata['catid'];

$sql = do_sqlquery("SELECT torrent_id FROM {$TABLE_PREFIX}featured ORDER BY fid DESC limit 1");
$result = $sql->fetch_assoc();

$torrent = do_sqlquery("SELECT f.moder,f.imdb,f.image, f.info_hash, f.filename, f.url, UNIX_TIMESTAMP(f.data) as data, f.size, f.comment, f.uploader, c.name as cat_name, c.image as cat_image, c.id as cat_id, $tseeds, $tleechs, $tcompletes, f.speed, f.external, f.announce_url,UNIX_TIMESTAMP(f.lastupdate) as lastupdate,UNIX_TIMESTAMP(f.lastsuccess) as lastsuccess, f.anonymous, u.username FROM $ttables LEFT JOIN {$TABLE_PREFIX}categories c ON c.id=f.category LEFT JOIN {$TABLE_PREFIX}users u ON u.id=f.uploader WHERE f.info_hash ='$result[torrent_id]' AND (f.team = 0 OR ".$CURUSER['id_level']."> 7) $exclude AND f.moder = 'ok'",true);

$tor = $torrent->fetch_assoc();

// progress
$id = $tor['info_hash'];
$subres = get_result("SELECT sum(IFNULL(bytes,0)) as to_go, count(*) as numpeers FROM {$TABLE_PREFIX}peers where infohash='{$id}'",true,$btit_settings['cache_duration']);
$subres2 = get_result("SELECT size FROM {$TABLE_PREFIX}files WHERE info_hash ='{$id}'",true,$btit_settings['cache_duration']);
$torrent = $subres2[0];
$subrow = $subres[0];
$tmp=0+$subrow["numpeers"];
if ($tmp>0) {
   $tsize=(0+$torrent["size"])*$tmp;
   $tbyte=0+$subrow["to_go"];
   $prgs=(($tsize-$tbyte)/$tsize) * 100; //100 * (1-($tbyte/$tsize));
   $prgsf=floor($prgs);
}
else
$prgsf=0;
// progress end
?>

<style>
 body {
padding - top : 60px;
padding - bottom : 40px;
}

.item{
    background-color:#1E1E1E;
    display:block;
}

.carousel-caption{
    color:#000;
    position:static;
}
</style>

<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Throwbacks</h4>
</div>
   

<div id="this-carousel-id" class="carousel slide"><!-- class of slide for animation -->
<div class="carousel-inner">
<div class="item active"><!-- class of active since it's the first item -->
<div class="carousel-caption">
<a href="index.php?page=torrent-details&amp;id=<?php echo $tor['info_hash']; ?>">
<h3><?php
echo $tor['filename'];
?></h3></a>
<p class= "text-danger">Info Hash:<?php
echo $tor['info_hash'];
?></p>
<p class= "text-success">Seeders: Leechers: Completed:</p>
</div>
</div>

<div class="item">
<div class="carousel-caption">
<h3>NEXT</h3>
</div>
</div>

<div class="item">
<div class="carousel-caption">
<h3>NEXT</h3>
</div>
</div>

<div class="item">
<div class="carousel-caption">
<h3>NEXT</h3>
</div>
</div>

<div class="item">
<div class="carousel-caption">
<h3>NEXT</h3>
</div>
</div>
</div><!-- /.carousel-inner -->

<!--  Next and Previous controls below, href values must reference the id for this carousel -->
<a class="carousel-control left" href="#this-carousel-id" data-slide="prev">&lsaquo;</a>
<a class="carousel-control right" href="#this-carousel-id" data-slide="next">&rsaquo;</a>
</div><!-- /.carousel -->


               </div>