<?php

$THIS_BASEPATH=dirname(__FILE__);
$LANGPATH=$THIS_BASEPATH."/language/english";

require_once($THIS_BASEPATH."/include/functions.php");
require_once($LANGPATH."/lang_main.php");

dbconn(true);

global $TABLE_PREFIX, $XBTT_USE, $btit_settings, $language, $CURUSER, $STYLEURL, $STYLEPATH;

if($btit_settings["fmhack_SEO_panel"]=="enabled")
{
    $active_seo = get_result("SELECT `activated`, `str`, `strto` FROM `{$TABLE_PREFIX}seo` WHERE `id`='1'", true, $btit_settings["cache_duration"]);
    $res_seo=$active_seo[0];
}

if ($XBTT_USE)
{
    $tseeds="`f`.`seeds`+ifnull(`x`.`seeders`,0)";
    $tleechs="`f`.`leechers`+ifnull(`x`.`leechers`,0)";
    $tcompletes="f.finished+ifnull(`x`.`completed`,0)";
    $ttables="`{$TABLE_PREFIX}files` `f` LEFT JOIN `xbt_files` `x` ON `x`.`info_hash`=`f`.`bin_hash`";
}
else
{
    $tseeds="`f`.`seeds`";
    $tleechs="`f`.`leechers`";
    $tcompletes="`f`.`finished`";
    $ttables="`{$TABLE_PREFIX}files` `f`";
}

//get current style
$resheet=get_result("SELECT(SELECT `style_url` FROM `{$TABLE_PREFIX}style` WHERE `id`=".$CURUSER["style"].") `style_url`, (SELECT `language_url` FROM `{$TABLE_PREFIX}language` WHERE `id`=".$CURUSER["language"].") `language_url`",true,$btit_settings["cache_duration"]);
if (!$resheet)
{
    $STYLEPATH="$THIS_BASEPATH/style/xbtit_default";
    $STYLEURL="$BASEURL/style/xbtit_default";
}
else
{
    $resstyle=$resheet[0];
    $STYLEPATH="$THIS_BASEPATH/".$resstyle["style_url"];
    $STYLEURL="$BASEURL/".$resstyle["style_url"];
    $LANGPATH2=$THIS_BASEPATH."/".$resstyle["language_url"];
}

if($LANGPATH!=$LANGPATH2)
{
    require_once($LANGPATH2."/lang_main.php");
}

?>

<link rel='stylesheet' type='text/css' href='imageflow/screen.css' />
<link rel='stylesheet' type='text/css' href='<?php echo $STYLEURL; ?>/main.css' />
<script language='JavaScript' type='text/javascript' src='imageflow/imageflow.js' defer="defer"></script>
<body class='listacircle'><br>
<table width='100%' valign='top' cellspacing='0' border='0'><tr><td class='lista' style='text-align:center;' border='0'><center>
<div align="center">

<?php

if($CURUSER["view_torrents"]=="yes")
{
    $query_select="";
    $query_where="`f`.`image` !=''";
    if($btit_settings["fmhack_getIMDB_in_torrent_details"]=="enabled")
    {
        $query_select="`f`.`imdb`, ";
        $query_where="(`f`.`image` !='' OR `f`.`imdb`>0)";
    }
    if($btit_settings["fmhack_grab_images_from_theTVDB"] == "enabled")
    {
        $query_select.="`f`.`tvdb_id`, ";
        $query_where="(`f`.`image` !='' ".(($btit_settings["fmhack_getIMDB_in_torrent_details"]=="enabled")?"OR `f`.`imdb`>0":"")." OR `f`.`tvdb_id`>0)";
    }    
    $query="SELECT ".$query_select.(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?"`f`.`id` `fileid`, ":"")."`f`.`size`, `f`.`image`, `f`.`info_hash` `hash`, $tseeds `seeds`, $tleechs `leechers`, $tcompletes `finished`, `f`.`filename`, `c`.`name` `catname` FROM $ttables LEFT JOIN `{$TABLE_PREFIX}categories` `c` ON `f`.`category`=`c`.`id` WHERE ".$query_where." AND `f`.`external`='no' AND $tseeds>0 ".(($btit_settings["fmhack_torrent_moderation"]=="enabled")?"AND `f`.`moder`='ok'":"")." ".($btit_settings["imageflow_cats"]!=""?"AND `f`.`category` IN (".$btit_settings["imageflow_cats"].")":"")." ORDER BY `f`.`data` DESC limit ".($btit_settings["imageflow_limit"]>0?$btit_settings["imageflow_limit"]:"30")."";
    $result=get_result($query,true,$btit_settings["cache_duration"]);
    $num = count($result);
    if ($num>0)
    {
        ?>
        <div id='imageflow'> 
        <div id='loading'>
        <b><?php echo $language["CIRC_NEW_REL"]; ?></b><br/>
        <img src='imageflow/loading.gif' width='208' height='13' alt='loading' /> 
        </div>
        <div id="images">
        <?php
        foreach($result as $row)
        {
            $t_name  = substr(htmlspecialchars($row["filename"], ENT_QUOTES), 0, 30)."...";
            $cat = (isset($row["catname"])?$row["catname"]:$language["UNKNOWN"]);

            $img_src="";
            $imageflowPriority=explode(",", $btit_settings["imageflow_priority"]);
            if(count($imageflowPriority)>0)
            {
                foreach($imageflowPriority as $imageflowValue)
                {
                    if($img_src=="")
                    {
                        if($imageflowValue==1)
                        {
                            if(!empty($row["image"]) && @file_exists($THIS_BASEPATH."/".$btit_settings["uploaddir"].$row["image"]))
                                $img_src = $btit_settings["uploaddir"].$row["image"];
                        }
                        elseif($imageflowValue==2)
                        {
                            if($btit_settings["fmhack_getIMDB_in_torrent_details"] == "enabled" && !empty($row["imdb"]) && @file_exists($THIS_BASEPATH."/imdb/images/".$row["imdb"].".jpg"))
                                $img_src = "imdb/images/".$row["imdb"].".jpg";
                        }
                        elseif($imageflowValue==3)
                        {
                            if($btit_settings["fmhack_grab_images_from_theTVDB"] == "enabled" && !empty($row["tvdb_id"]))
                            {
                                $selectedPics=array();
                                if(file_exists($THIS_BASEPATH."/thetvdb/".$row["tvdb_id"]."/poster"))
                                {
                                    foreach(glob($THIS_BASEPATH."/thetvdb/".$row["tvdb_id"]."/poster/*.*") as $imageFilename)
                                        $selectedPics[]=str_replace($THIS_BASEPATH."/", "", $imageFilename);
                                }
                                if(count($selectedPics)>0)
                                {
                                    $randomkey=array_rand($selectedPics, 1);
                                    if(file_exists($THIS_BASEPATH."/".$selectedPics[$randomkey]))
                                        $img_src = $selectedPics[$randomkey];
                                }
                            }
                        }
                    }
                }
            }
            if($img_src=="")
                $img_src = $btit_settings["uploaddir"]."nocover.jpg";

            echo "<img src='".$img_src."' width='85' height='115' longdesc='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?strtr($row["filename"], $res_seo["str"], $res_seo["strto"])."-".$row["fileid"].".html":"index.php?page=torrent-details&id=".$row["hash"])."' alt='<br><br><br>".$t_name."<br /><span style=\"color:green;\">".$row["seeds"]."</span> ".$language["CIRC_SEEDERS"]." / <span style=\"color:red;\">".$row["leechers"]."</span> ".$language["CIRC_LEECHERS"]." <br> ".$cat."&nbsp;&nbsp;&nbsp;&nbsp;".makesize($row["size"])."' />";
        }
        ?>
        </div>
        <div id='captions'></div>
        <div id='scrollbar'>
        <div id='slider'></div>
        </div>
        </div>
        </div></center><br><br><br><br></td></tr></table></body>
        <?php
    }
    else
        echo $language["CIRC_NO_TORR"];
}

?>