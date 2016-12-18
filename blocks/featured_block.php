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

/*
if ($XBTT_USE)
$rowcat = do_sqlquery("SELECT u.id, (u.downloaded+IFNULL(x.downloaded,0)) as downloaded, ((u.uploaded+IFNULL(x.uploaded,0))/(u.downloaded+IFNULL(x.downloaded,0))) as uratio, cp.* FROM {$TABLE_PREFIX}users u LEFT JOIN xbt_users x ON x.uid=u.id INNER JOIN {$TABLE_PREFIX}categories_perm cp ON u.id_level=cp.levelid WHERE u.id = ".$CURUSER["uid"].";",true);
else
$rowcat = do_sqlquery("SELECT u.id, u.downloaded, (u.uploaded/u.downloaded) as uratio, cp.* FROM {$TABLE_PREFIX}users u INNER JOIN {$TABLE_PREFIX}categories_perm cp ON u.id_level=cp.levelid WHERE u.id = ".$CURUSER["uid"].";",true);

if (sql_num_rows($rowcat)>0)
while ($catdata=$rowcat->fetch_array())
if($catdata["viewtorrlist"]!="yes" && (($catdata["downloaded"]>=$GLOBALS["download_ratio"] && ($catdata["ratio"]>$catdata["uratio"]))||($catdata["downloaded"]<$GLOBALS["download_ratio"])||($catdata["ratio"]=="0")))
$exclude.=' AND f.category!='.$catdata['catid'];
*/
$sql = do_sqlquery("SELECT torrent_id FROM {$TABLE_PREFIX}featured ORDER BY fid DESC limit 1");
$result = $sql->fetch_assoc();
$torrent = do_sqlquery("SELECT f.moder,f.imdb,f.tvdb_id,f.image, f.info_hash, f.filename, f.url, UNIX_TIMESTAMP(f.data) as data, f.size, f.comment, f.uploader, c.name as cat_name, c.image as cat_image, c.id as cat_id, $tseeds, $tleechs, $tcompletes, f.speed, f.external, f.announce_url,UNIX_TIMESTAMP(f.lastupdate) as lastupdate,UNIX_TIMESTAMP(f.lastsuccess) as lastsuccess, f.anonymous, u.username FROM $ttables LEFT JOIN {$TABLE_PREFIX}categories c ON c.id=f.category LEFT JOIN {$TABLE_PREFIX}users u ON u.id=f.uploader WHERE f.info_hash ='{$result['torrent_id']}' AND (f.team = 0 OR ".$CURUSER['id_level']."> 7) $exclude AND f.moder = 'ok'",true);
$tor = $torrent->fetch_assoc();
$fname = $tor['filename'];
?>

<link href="css/featured_torrent.css" rel="stylesheet" media="screen" />
<link href="css/featured_torrent_metro.css" rel="stylesheet" media="screen" />

<div id='container'>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse9">Featured Torrent</a>
</h4>
</div>
<div id="collapse9" class="panel-collapse collapse in">
        <div class="container-fluid" style="padding:0;">
            <div class="row-fluid">

                <!-- STRAPSLIDE -->
                <div class="strapslide" id="strapslide">

                    <!-- PRELOADER -->
                    <div class="preloader text-center">
                    <img src="/images/loader.gif" alt="Loading.." id="loader" />
                    </div>
                    <!-- /PRELOADER -->

                    <!-- STRAPSLIDE CONTAINER -->
                    <div class="strapslide-container">

                        <!-- SLIDE -->
                        <div class="slide active" data-animation="fade, scaledown, top" id="slide1">
                            <!-- BACKGROUND IMAGE -->
                            <img src="<?php echo "images/default_fanart.png";/*getBannerData($tor['imdb'],$tor['tvdb_id']);*/ ?>" class="background-image" alt="<?php echo $fname; ?>"/>
                            <!-- /BACKGROUND IMAGE -->
                        </div>
                        <!-- /SLIDE -->

                        <!-- SLIDE -->
                        <div class="slide" data-animation="fade, rotatecw, top" id="slide2">
                            <!-- BACKGROUND IMAGE -->
                            <img src="<?php echo "images/default_fanart.png";/*getBannerData($tor['imdb'],$tor['tvdb_id']);*/ ?>" class="background-image" alt="<?php echo $fname; ?>"/>
                            <!-- /BACKGROUND IMAGE -->
                        </div>
                        <!-- /SLIDE -->

                        <!-- SLIDE -->
                        <div class="slide" data-animation="fade, scaleup, top" id="slide3">
                            <!-- BACKGROUND IMAGE -->
                            <img src="<?php echo "images/default_fanart.png";/*getBannerData($tor['imdb'],$tor['tvdb_id']);*/ ?>" class="background-image" alt="<?php echo $fname; ?>"/>
                            <!-- /BACKGROUND IMAGE -->
                        </div>
                        <!-- /SLIDE -->

                    </div>
                    <!-- /STRAPSLIDE CONTAINER -->

                    <!-- PROGRESS BAR -->
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger progress-bar-striped" style="width: 20%;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /PROGRESS BAR -->

                    <!-- TORRENT INFO -->
                    <div>
                        <center><h2><a href="index.php?page=torrent-details&amp;id=<?php echo $tor['info_hash']; ?>"><?php echo $tor['filename']; ?></font></a></h2>
                            <p>Category: <?php echo $tor['cat_name'];?> | Seeders: <?php echo $tor['seeds'];?> | Leechers: <?php echo $tor['leechers'];?> | Completed: <?php echo $tor['finished'];?></p></center>
                        </div>
                        <!-- TORRENT INFO -->

                    <!-- DOWNLOAD BUTTON
                    <button class="btn btn-labeled btn-danger" type="button">
                    <span class="btn-label"><i class="fa fa-download"></i></span><a href="index.php?page=torrent-details&id= <?php echo $tor['info_hash']; ?>"/>Download</a></button>
                    DOWNLAOD BUTTON -->

                    <!-- NEXT-PREV NAVIGATION -->
                    <div class="row-fluid strapslide-nav">
                        <div class="prev red" href="#">
                            <a href="#">&lt;</a>
                        </div>
                        <div class="next red" href="#">
                            <a href="#">&gt;</a>
                        </div>
                    </div>
                    <!-- /NEXT-PREV NAVIGATION -->

                    <!-- PAGINATION -->
                    <br>
                    <br>
                    <div class="row-fluid strapslide-pagination">
                        <div class="span12 text-center" style="text-align:center;">
                            <ul>

                            </ul>
                        </div>
                    </div>
                    <!-- /PAGINATION -->

                </div>
                <!-- /STRAPSLIDE -->

            </div>
        </div>
        </div>
        <div class="panel-footer">
        </div>
    </div>


    <!-- JavaScript plugins (requires jQuery) -->
    <script src="jscript/Featured_Torrent/jquery.touchSwipe.min.js"></script>
    <script src="jscript/Featured_Torrent/jquery.transit.min.js"></script>
    <script src="jscript/Featured_Torrent/jquery.mousewheel.js"></script>
    <script src="jscript/Featured_Torrent/jquery.fitVids.js"></script>
    <!-- Slider plugin -->
    <script src="jscript/Featured_Torrent/strapslide.js"></script>

    <script>
        jQuery.noConflict()(function($){
            $(document).ready(function() {
                $('#strapslide').strapslide({
                    animation: "fade, top",
                    speed: 1000,
                    timeout: 5000,
                    responsive: 'resize',
                    autoplay: true,
                    preload: true,
                    pauseOnHover: true,
                    pagination: true,
                    mousewheel: false,
                    keyboard: true,
                    touchscreen: true
                }, function() {
                    if ($('#strapslide .active').attr('id') == 'slide1') {
                        $('#slide1_content').fxenter('fade, bottom', 800);
                    }
                    if ($('#strapslide .active').attr('id') == 'slide2') {
                        $('#tile1').fxenter('fade, scaleup', 800);
                        $('#tile2').fxenter('fade, scaledown', 800);
                    }
                }, function() {
                    if ($('#strapslide .active').attr('id') == 'slide1') {
                        $('#slide1_content').fxexit('fade, scaledown, rotatecw, bottom', 800);
                    }
                    if ($('#strapslide .active').attr('id') == 'slide2') {
                        $('#tile1').fxexit('fade, scaledown', 800);
                        $('#tile2').fxexit('fade, scaleup', 800);
                    }
                });
            })
        });
    </script>
</div>
