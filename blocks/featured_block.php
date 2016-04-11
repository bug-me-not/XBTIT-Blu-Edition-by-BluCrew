<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Featured Uploads</h4>
</div>
<ul>
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

// speed
if ($tor["speed"] <= 1)
$speed = 0;
else
$speed = $tor["speed"]/1048576 ;
// speed end

?>
<center><table width=99% border=0 style="border:0px;padding:5px">
   <tr>
      <td colspan=3 >

         <h2><b><center><a href="index.php?page=torrent-details&amp;id=<?php echo $tor['info_hash']; ?>">
            <font color =red><?php
            echo $tor['filename'];
            ?></font></a></b></center>
         </td></tr>
         <tr >
            <td >
               <!-- INCLUDE THE FOLLOWING JGAUGE REQUIREMENTS... -->
               <link rel="stylesheet" href="jscript/jgauge.css" type="text/css" /> <!-- CSS for jGauge styling. -->
               <!--[if IE]><script type="text/javascript" language="javascript" src="jscript/excanvas.min.js"></script><![endif]--> <!-- Extends canvas support to IE. (Possibly buggy, need to look into this.) -->
               <script language="javascript" type="text/javascript" src="jscript/jquery.js"></script> <!-- jQuery JavaScript library. -->
               <script language="javascript" type="text/javascript" src="jscript/jQueryRotate.min.js"></script> <!-- jQueryRotate plugin used for needle movement. -->
               <script language="javascript" type="text/javascript" src="jscript/jgauge-0.3.0.a3.js"></script> <!-- jGauge JavaScript. -->

               <div id="jGaugeDemo1" class="jgauge"></div>
               <div id="jGaugeDemo2" class="jgauge"></div>
               <div class="break"></div>

               <script type="text/javascript">

               var dtGauge1 = new jGauge(); // Create a new jGauge.
               dtGauge1.id = 'jGaugeDemo1'; // Link the new jGauge to the placeholder DIV.
               dtGauge1.label.suffix = 'MB/s';

               // This function is called by jQuery once the page has finished loading.
               $(document).ready(function(){
                  dtGauge1.init(); // Put the jGauge on the page by initialising it.

                  dtGauge1.setValue(<?php echo $speed ?>);

               });
               </script>

               <script type="text/javascript">
               var dtGauge2 = new jGauge(); // Create a new jGauge.
               dtGauge2.id = 'jGaugeDemo2'; // Link the new jGauge to the placeholder DIV.
               dtGauge2.label.suffix = '%';

               // This function is called by jQuery once the page has finished loading.
               $(document).ready(function(){
                  dtGauge2.init(); // Put the jGauge on the page by initialising it.

                  dtGauge2.setValue(<?php echo $prgsf ?>);

               });
               </script>

            </td><td align = right>
               <span class="chart">

                  <?php
                  // imdb image
                  if ($btit_settings["imdbbl"]==true )
                  {
                     require_once ("imdb/imdb.class.php");
                     $movie = new imdb($tor["imdb"]);
                     $movie->photodir='./imdb/images/';
                     $movie->photoroot='./imdb/images/';
                     if (($photo_url = $movie->photo_localurl() ) != FALSE)
                     print "<img style='width:250px' src='{$photo_url}'   />";
                     // imdb image
                  }
                  else
                  {
                     $featimg = $tor['image'];
                     if ($btit_settings["imgsw"]==false )
                     print "<img style='width:400px' src='{$featimg}'   />";
                     else
                     print "<img style='width:400px' src='torrentimg/{$featimg}'   />";
                  }
                  ?>

               </span>
            </td></tr>
            <tr>
               <td colspan=3>
                  <div class="foot">

                     <center><a href="index.php?page=torrent-details&id=<?php echo $tor['info_hash']; ?>" alt="Torrent Details"><img src='images/get.png'</a></center>

                  </div>
               </div></td></tr></table>
               </ul>
<div class="panel-footer">
</div>
</div>
