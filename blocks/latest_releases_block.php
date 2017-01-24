<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse15">Latest Uploads</a>
</h4>
</div>
<div id="collapse15" class="panel-collapse collapse in">
<?php
/////////////////////////////////////////////////////////////////////////////////////
//  xbtit - Bittorrent tracker/frontend
//
//  Copyright (C) 2004 - 2015  Btiteam
//
//  This file is based off xbtit DT DC / by DiemThuy
//
// 	Optimized for xbtitFM v1.0 by Blu-Torrents
//
////////////////////////////////////////////////////////////////////////////////////
if (!$CURUSER || $CURUSER["view_torrents"] == "no")
{
   // do nothing
}
else
{
   global  $btit_settings, $XBTT_USE, $THIS_BASEPATH,$STYLEURL;

   if ($XBTT_USE)
   {
      $tseeds="f.seeds+ifnull(x.seeders,0)";
      $tleechs="f.leechers+ifnull(x.leechers,0)";
      $tcompletes="f.finished+ifnull(x.completed,0)";
      $ttables="{$TABLE_PREFIX}files f LEFT JOIN xbt_files x ON x.info_hash=f.bin_hash";
   }
   else
   {
      $tseeds="f.seeds";
      $tleechs="f.leechers";
      $tcompletes="f.finished";
      $ttables="{$TABLE_PREFIX}files f";
   }

   $res=do_sqlquery("SELECT f.info_hash,f.filename,f.imdb,f.tvdb_id,$tseeds as seeds, $tleechs as leechers,c.name,c.image FROM $ttables LEFT JOIN {$TABLE_PREFIX}categories c ON c.id=f.category WHERE ($tleechs + $tseeds) > 0 AND f.moder='ok' AND (imdb != 0 OR tvdb_id != 0) ORDER BY data DESC LIMIT 10");
   if(sql_num_rows($res)>0)
   {
      $rth=$btit_settings["scrolw"];
      $dgt="max-width: ".$rth."px; ";
      ?>
      <script type="text/javascript" src="jscript/sliderman.1.3.7.js"></script>
      <style type="text/css">
      #SliderName{
         <?php echo $dgt; ?>
         height: 200px;
         margin: auto;
      }
      .SliderNamePrev{
         background: url(images/slider/left.gif) no-repeat center center;
         width: 24px;
         height: 24px;
         display: block;
         position: absolute;
         top: 88px;
         left: 10px;
         text-decoration: none;
      }
      .SliderNameNext{
         background: url(images/slider/right.gif) no-repeat center center;
         width: 24px;
         height: 24px;
         display: block;
         position: absolute;
         top: 88px;
         right: 10px;
         text-decoration: none;
      }
      .SliderNameDescription{
         font-family: Verdana;
         font-size: 10px;
         text-align: left;
         padding: 5px;
      }
      <?php
      if($btit_settings["nav"]==true)
      {
         ?>
         #SliderNameNavigation { margin: 0px 0 0 0; height: 30px; text-align: center; -moz-border-radius: 6px 6px; background: #FFF; }
         #SliderNameNavigation a:link, #SliderNameNavigation a:active, #SliderNameNavigation a:visited, #SliderNameNavigation a:hover{
            margin: 0 2px;
            background: url(images/slider/nav.gif) no-repeat center center;
            font-size: 0px;
            line-height: 0px;
            padding: 12px;
            text-decoration: none;
         }
         #SliderNameNavigation a.active:link, #SliderNameNavigation a.active:active, #SliderNameNavigation a.active:visited, #SliderNameNavigation a.active:hover{
            background: url(images/slider/nav_active.gif) no-repeat center center;
         }
         <?php
      }
      ?>
      </style>
      <div id="SliderName">
         <?php
         while($result=$res->fetch_array())
         {
            //Banner Grab
               $img = "images/default_fanart.png";//getBannerData($result['imdb'],$result['tvdb_id']);
            //Banner Grab

            $dowl = "#";
            if($btit_settings["fmhack_download_ratio_checker"] == "enabled")
            {
               $dowl="index.php?page=downloadcheck&amp;id={$result['info_hash']}";
            }
            else
            {
               $dowl="download.php?id={$result['info_hash']}&amp;f=".rawurlencode($result['filename']).".torrent";
            }

            $dt="<img src=".$img." title=\"".$result['filename']."\" />";
            $dtt="<img src=\"{$STYLEURL}/images/categories/{$result['image']}\" title=\"".$result['name']."\" height=50 style=float:left;margin-right:15px; />";
            $dow="<a href=\"{$dowl}\"><img src=\"images/download_release.png\" title=\"Download ".$result['filename']."\" height=50 style=float:right;margin-left:15px; /></a>";
            $seed="<font color=darkgreen><b>Seeders &nbsp;&nbsp;:".$result["seeds"]."</b> </font><br>";
            $leech="<font color=red><b>Leechers :".$result["leechers"]."</b></font><br>";
            $name="<font color=black><b>".$result["filename"]."</b></font><br>";
            $link="<a href=index.php?page=torrent-details&id=".$result['info_hash'].">";

            echo $link;
            echo $dt;
            ?>
         </a>
         <div class="SliderNameDescription">
            <?php echo $dtt; ?>
            <?php echo $dow; ?>
            <?php echo $name; ?>
            <?php echo $seed; ?>
            <?php echo $leech; ?>
            <?php echo $dc; ?>
         </div>
         <?php
      }
      $dht="width: ".$rth;
      ?>
   </div>
   <div class="c"></div>
   <div id="SliderNameNavigation"></div>
   <div class="c"></div>

   <script type="text/javascript">
   var demoSlider = Sliderman.slider({container: 'SliderName', <?php echo $dht; ?> , height: 200, effects: 'devtrixEffects',
   display: {
      pause: true,
      autoplay: 3000,
      always_show_loading: 200,
      description: {background: '#ffffff', opacity: 0.5, height: 60, position: 'bottom'},
      loading: {background: '#000000', opacity: 0.2, image: '/images/slider/loading.gif'},
      buttons: {opacity: 1, prev: {className: 'SliderNamePrev', label: ''}, next: {className: 'SliderNameNext', label: ''}},
      <?php
      if($btit_settings["nav"]==true)
      {
         ?>
         navigation: {container: 'SliderNameNavigation', label: '&nbsp;'}
         <?php
      }
      ?>
   }});
   </script>

   <div class="c"></div>
</div>
<?php
}
}
?>
</div>
</div>
