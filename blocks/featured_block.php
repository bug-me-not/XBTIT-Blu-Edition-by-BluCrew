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

$res = get_result("SELECT f.info_hash, f.filename, UNIX_TIMESTAMP(f.data) as data, f.size, f.imdb, $tseeds, $tleechs, $tcompletes FROM $ttables WHERE f.moder='ok' AND seeds>0 AND f.imdb>0 ORDER BY RAND() LIMIT 5",true,$btit_settings['cache_duration']);

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
<a href="index.php?page=torrent-details&amp;id=<?php echo $res[0]['info_hash'];?>"><h3><?php echo $res[0]['filename'];?></h3></a>
<p class= "text-danger">Info Hash: <?php echo $res[0]['info_hash'];?></p>
<p class= "text-success">Seeders: <?php echo $res[0]['seeds'];?> | Leechers: <?php echo $res[0]['leechers'];?> | Completed: <?php echo $res[0]['finished'];?></p>
</div>
</div>

<div class="item">
<div class="carousel-caption">
<a href="index.php?page=torrent-details&amp;id=<?php echo $res[1]['info_hash'];?>"><h3><?php echo $res[1]['filename'];?></h3></a>
<p class= "text-danger">Info Hash: <?php echo $res[1]['info_hash'];?></p>
<p class= "text-success">Seeders: <?php echo $res[1]['seeds'];?> | Leechers: <?php echo $res[1]['leechers'];?> | Completed: <?php echo $res[1]['finished'];?></p>
</div>
</div>

<div class="item">
<div class="carousel-caption">
<a href="index.php?page=torrent-details&amp;id=<?php echo $res[2]['info_hash'];?>"><h3><?php echo $res[2]['filename'];?></h3></a>
<p class= "text-danger">Info Hash: <?php echo $res[2]['info_hash'];?></p>
<p class= "text-success">Seeders: <?php echo $res[2]['seeds'];?> | Leechers: <?php echo $res[2]['leechers'];?> | Completed: <?php echo $res[2]['finished'];?></p>
</div>
</div>

<div class="item">
<div class="carousel-caption">
<a href="index.php?page=torrent-details&amp;id=<?php echo $res[3]['info_hash'];?>"><h3><?php echo $res[3]['filename'];?></h3></a>
<p class= "text-danger">Info Hash: <?php echo $res[3]['info_hash'];?></p>
<p class= "text-success">Seeders: <?php echo $res[3]['seeds'];?> | Leechers: <?php echo $res[3]['leechers'];?> | Completed: <?php echo $res[3]['finished'];?></p>
</div>
</div>

<div class="item">
<div class="carousel-caption">
<a href="index.php?page=torrent-details&amp;id=<?php echo $res[4]['info_hash'];?>"><h3><?php echo $res[4]['filename'];?></h3></a>
<p class= "text-danger">Info Hash: <?php echo $res[4]['info_hash'];?></p>
<p class= "text-success">Seeders: <?php echo $res[4]['seeds'];?> | Leechers: <?php echo $res[4]['leechers'];?> | Completed: <?php echo $res[4]['finished'];?></p>
</div>
</div>
</div><!-- /.carousel-inner -->

<!--  Next and Previous controls below, href values must reference the id for this carousel -->
<a class="carousel-control left" href="#this-carousel-id" data-slide="prev">&lsaquo;</a>
<a class="carousel-control right" href="#this-carousel-id" data-slide="next">&rsaquo;</a>
</div><!-- /.carousel -->


               </div>