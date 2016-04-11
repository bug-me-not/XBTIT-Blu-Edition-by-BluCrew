<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Hot Picks</h4>
</div>
<?php
global $btit_settings, $TABLE_PREFIX, $XBTT_USE, $language, $res_seo, $THIS_BASEPATH;

echo "<table width='100%'>\n<tr>\n<td class='lista' style='text-align:center;'><br />";

if(isset($btit_settings["tow_this_week"]) && !empty($btit_settings["tow_this_week"]))
{
    $towThisWeek = explode(",", $btit_settings["tow_this_week"]);
    $goldSettings=explode("-", $towThisWeek[2]);
    $multiSettings=explode("-", $towThisWeek[3]);
    $towImagePriority=explode("-", $towThisWeek[1]);
    $res = get_result("SELECT `f`.`info_hash`, `f`.`filename`, `f`.`size`, `f`.`image`, `f`.`imdb`, `f`.`tvdb_id`, `f`.`gold`, `f`.`multiplier`, `f`.`category`, `c`.`name`, ".(($XBTT_USE)?"`xf`.`seeders` `seeds`, `xf`.`leechers`":"`f`.`seeds`, `f`.`leechers`")." FROM `{$TABLE_PREFIX}files` `f` LEFT JOIN `{$TABLE_PREFIX}categories` `c` ON `f`.`category`=`c`.`id` ".(($XBTT_USE)?"LEFT JOIN `xbt_files` `xf` ON `f`.`bin_hash`=`xf`.`info_hash`":"")." WHERE `f`.`id`=".$towThisWeek[0].(($btit_settings["fmhack_upload_multiplier"]=="enabled" && $CURUSER["view_multi"]=="no")?" AND `f`.`multiplier`=1":""), true, $btit_settings["cache_duration"]);

    if(count($res) > 0)
    {
        $row = $res[0];
        $torrimage = "";
        if(count($towImagePriority)>0)
        {
            foreach($towImagePriority as $towImageValue)
            {
                if($torrimage=="")
                {
                    if($towImageValue==1)
                    {
                        if(!empty($row["image"]) && @file_exists($THIS_BASEPATH."/".$btit_settings["uploaddir"].$row["image"]))
                            $torrimage = "<img src='".$btit_settings["uploaddir"].$row["image"]."' border='0' width='150' height='200' />";
                    }
                    elseif($towImageValue==2)
                    {
                        if($btit_settings["fmhack_getIMDB_in_torrent_details"] == "enabled" && !empty($row["imdb"]) && @file_exists($THIS_BASEPATH."/imdb/images/".$row["imdb"].".jpg"))
                            $torrimage = "<img src='imdb/images/".$row["imdb"].".jpg' border='0' width='150' height='200' />";
                    }
                    elseif($towImageValue==3)
                    {
                        if($btit_settings["fmhack_grab_images_from_theTVDB"] == "enabled" && !empty($row["tvdb_id"]))
                        {
                            $selectedPics=array();
                            if(file_exists($THIS_BASEPATH."/thetvdb/".$row["tvdb_id"]."/poster"))
                            {
                                foreach(glob($THIS_BASEPATH."/thetvdb/".$row["tvdb_id"]."/poster/*.*") as $filename)
                                    $selectedPics[]=str_replace($THIS_BASEPATH."/", "", $filename);
                            }
                            if(count($selectedPics)>0)
                            {
                                $randomkey=array_rand($selectedPics, 1);
                                if(file_exists($THIS_BASEPATH."/".$selectedPics[$randomkey]))
                                    $torrimage = "<img src='".$selectedPics[$randomkey]."' border='0' width='150' height='200' />";
                            }
                        }
                    }
                }
            }
        }
        if($torrimage=="")
            $torrimage = "<img src='".$btit_settings["uploaddir"]."nocover.jpg' border='0' width='150' height='200' />";

        $goldimg="";
        $multimg="";
        $goldmulti="";
        if($btit_settings["fmhack_gold_and_silver_torrents"]=="enabled" && $goldSettings[0]==1 && $row["gold"]>=1 && $row["gold"]<=3)
        {
            $res=get_result("SELECT * FROM `{$TABLE_PREFIX}gold` WHERE `id`=1", true, $btit_settings["cache_duration"]);
            if(count($res)>0)
            {
                $row2=$res[0];
                $silver_percentage = (100 - $row2["silver_percentage"])."%";
                $gold_percentage = (100 - $row2["gold_percentage"])."%";
                $bronze_percentage = (100 - $row2["bronze_percentage"])."%";
                if($row["gold"]==1)
                    $goldimg="<img src='images/".$row2["silver_picture"]."' border='0' alt='".$language["IS_SILVER"]." ".$silver_percentage." ".$language["IS_ALL"]."' title='".$language["IS_SILVER"]." ".$silver_percentage." ".$language["IS_ALL"]."' />";
                elseif($row["gold"]==2)
                    $goldimg="<img src='images/".$row2["gold_picture"]."' border='0' alt='".$language["IS_GOLD"]." ".$gold_percentage." ".$language["IS_ALL"]."' title='".$language["IS_GOLD"]." ".$gold_percentage." ".$language["IS_ALL"]."' />";
                elseif($row["gold"]==3)
                    $goldimg="<img src='images/".$row2["bronze_picture"]."' border='0' alt='".$language["IS_BRONZE"]." ".$bronze_percentage." ".$language["IS_ALL"]."' title='".$language["IS_BRONZE"]." ".$bronze_percentage." ".$language["IS_ALL"]."' />";
            }
        }
        if($btit_settings["fmhack_upload_multiplier"]=="enabled" && $multiSettings[0]==1 && $row["multiplier"]>=2 && $row["multiplier"]<=10)
            $multimg="<img src='images/".$row["multiplier"]."x.gif' border='0' alt='".$row["multiplier"]."x ".$language["UPM_UPL_MULT"]."' title='".$row["multiplier"]."x ".$language["UPM_UPL_MULT"]."' />";

        if($goldimg!="" && $multimg!="")
            $goldmulti=$goldimg."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$multimg;
        elseif($goldimg!="")
            $goldmulti=$goldimg;
        elseif($multimg!="")
            $goldmulti=$multimg;

        echo (($goldmulti!="")?$goldmulti."<br /><br />":"");
        echo "<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?strtr($row["filename"], $res_seo["str"], $res_seo["strto"])."-".$towThisWeek[0].".html":"index.php?page=torrent-details&id=".$row["info_hash"])."'>".$torrimage."</a>";
        $tname=wordwrap($row["filename"], 25 ,"\n", true);
        echo "<b><br /><br />".$tname."<br />";
        echo "<span style='color:green;'>".$row["seeds"]."</span> ".$language["TOW_SEEDS"];
        echo " | <span style='color:red;'>".$row["leechers"]."</span> ".$language["TOW_LEECH"];
        echo "<br /><a href='index.php?page=torrents&category=".$row["category"]."'>".$row["name"]."</a> | ".makesize($row["size"])."</b>";
    }
    else
    {
        echo $language["TOW_NONE_ATM"];
    }
}
else
{
    echo $language["TOW_NONE_ATM"];
}

echo "<br /><br /></td>\n</tr>\n</table>\n";

?>
<div class="panel-footer">
</div>
</div>