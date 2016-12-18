<?php

if(!defined("IN_BTIT"))
    die("non direct access!");

if(!defined("IN_ACP"))
    die("non direct access!");



$admintpl->set("initialRun", true, true);
$admintpl->set("searchFoundTorrents", false, true);
$admintpl->set("haveGotTorrent", false, true);

$search = (isset($_GET["search"]) && !empty($_GET["search"]) && $_GET["search"] == "true")?true:false;
$selected = (isset($_GET["selected"]) && !empty($_GET["selected"]) && $_GET["selected"] == "true")?true:false;
$method = (isset($_GET["method"]) && !empty($_GET["method"]) && $_GET["method"] == "true")?true:false;

if(isset($_POST) && !empty($_POST))
{
    $admintpl->set("initialRun", false, true);
    if($search && !$selected && !$method)
    {
        $torrentsearch = (isset($_POST["torrentsearch"]) && !empty($_POST["torrentsearch"]))?sql_esc($_POST["torrentsearch"]):false;
        if($torrentsearch)
        {
            $res = get_result("SELECT `f`.`multiplier`, `f`.`gold`, `f`.`id`, `f`.`info_hash`, `f`.`filename`, `f`.`category`, UNIX_TIMESTAMP(`f`.`data`) `upload_date`, `c`.`name` `cat_name`, `c`.`image` `cat_image`, ".(($XBTT_USE)?"`xf`.`seeders` `seeds`, `xf`.`leechers`, `xf`.`completed` `finished`":"`f`.`seeds`, `f`.`leechers`, `f`.`finished`")."  FROM `{$TABLE_PREFIX}files` `f` LEFT JOIN `{$TABLE_PREFIX}categories` `c` ON `f`.`category`=`c`.`id` ".(($XBTT_USE)?"LEFT JOIN `xbt_files` `xf` ON `f`.`bin_hash`=`xf`.`info_hash`":"")." WHERE `f`.`filename` LIKE'%".$torrentsearch."%' ORDER by `f`.`data` DESC", true, $btit_settings["cache_duration"]);
            if(count($res) > 0)
            {
                $admintpl->set("searchFoundTorrents", true, true);
                $foundTorrents = array();
                $i = 0;
                $res2 = get_result("SELECT * FROM `{$TABLE_PREFIX}gold` WHERE `id`=1", true, $btit_settings["cache_duration"]);
                $silver_percentage = (100 - $res2[0]["silver_percentage"])."%";
                $gold_percentage = (100 - $res2[0]["gold_percentage"])."%";
                $bronze_percentage = (100 - $res2[0]["bronze_percentage"])."%";
                foreach($res as $row)
                {
                    $foundTorrents[$i]["filename"] = "<a target='_blank' href='".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated"] == "true")?strtr($row["filename"], $res_seo["str"], $res_seo["strto"])."-".$row["id"].".html":"index.php?page=torrent-details&id=".$row["info_hash"])."'>".$row["filename"]."</a>";
                    $foundTorrents[$i]["upload_date"] = date("d/m/Y H:i:s", $row["upload_date"]);
                    $foundTorrents[$i]["category"] = "<a  target='_blank' href='index.php?page=torrents&category=".$row["category"]."'><img src='".$STYLEURL."/images/categories/".$row["cat_image"]."' border='0' alt='".$row["cat_name"]."' title='".$row["cat_name"]."' /></a>";
                    $foundTorrents[$i]["seeds"] = $row["seeds"];
                    $foundTorrents[$i]["leechers"] = $row["leechers"];
                    $foundTorrents[$i]["finished"] = $row["finished"];
                    $foundTorrents[$i]["radio"] = "<input type='radio' name='selectedTorrent' value='".$row["id"]."' ".(($i == 0)?"checked='checked' ":"")."/>";
                    $foundTorrents[$i]["currentGoldIcon"] = (($row["gold"] == 1)?" <img src='images/".$res2[0]["silver_picture"]."' border='0' alt='".$language["IS_SILVER"]." ".$silver_percentage." ".$language["IS_ALL"]."' title='".$language["IS_SILVER"]." ".$silver_percentage." ".$language["IS_ALL"]."' />":(($row["gold"] == 2)?" <img src='images/".$res2[0]["gold_picture"]."' border='0' alt='".$language["IS_GOLD"]." ".$gold_percentage." ".$language["IS_ALL"]."' title='".$language["IS_GOLD"]." ".$gold_percentage." ".$language["IS_ALL"]."' />":(($row["gold"] == 3)?" <img src='images/".$res2[0]["bronze_picture"]."' border='0' alt='".$language["IS_BRONZE"]." ".$bronze_percentage." ".$language["IS_ALL"]."' title='".$language["IS_BRONZE"]." ".$bronze_percentage." ".$language["IS_ALL"]."' />":"")));
                    $foundTorrents[$i]["currentMultiIcon"] = (($row["multiplier"] == 1)?"":" <img src='images/".$row["multiplier"]."x.gif' border='0' alt='".$row["multiplier"]."x ".$language["UPM_UPL_MULT"]."' title='".$row["multiplier"]."x ".$language["UPM_UPL_MULT"]."' />");
                    $i++;
                }
                $admintpl->set("foundTorrents", $foundTorrents);
            }
            else
                stderr($language["ERROR"], $language["TOW_NO_TORR"]);
        }
    }
    elseif($search && $selected && !$method)
    {
        $admintpl->set("initialRun", false, true);
        $id = (isset($_POST["selectedTorrent"]) && !empty($_POST["selectedTorrent"]) && is_numeric($_POST["selectedTorrent"]))?(int)0 + $_POST["selectedTorrent"]:false;
        if($id)
        {
            $res = get_result("SELECT `f`.`gold`, `f`.`multiplier`, `f`.`id`, `f`.`info_hash`, `f`.`filename`, `f`.`category`, UNIX_TIMESTAMP(`f`.`data`) `upload_date`, `c`.`name` `cat_name`, `c`.`image` `cat_image`, ".(($XBTT_USE)?"`xf`.`seeders` `seeds`, `xf`.`leechers`, `xf`.`completed` `finished`":"`f`.`seeds`, `f`.`leechers`, `f`.`finished`")."  FROM `{$TABLE_PREFIX}files` `f` LEFT JOIN `{$TABLE_PREFIX}categories` `c` ON `f`.`category`=`c`.`id` ".(($XBTT_USE)?"LEFT JOIN `xbt_files` `xf` ON `f`.`bin_hash`=`xf`.`info_hash`":"")." WHERE `f`.`id`=".$id, true, $btit_settings["cache_duration"]);
            if(count($res) > 0)
            {
                $admintpl->set("haveGotTorrent", true, true);

                $row = $res[0];
                $res = get_result("SELECT * FROM `{$TABLE_PREFIX}gold` WHERE `id`=1", true, $btit_settings["cache_duration"]);
                $silver_percentage = (100 - $res[0]["silver_percentage"])."%";
                $gold_percentage = (100 - $res[0]["gold_percentage"])."%";
                $bronze_percentage = (100 - $res[0]["bronze_percentage"])."%";
                $goldAllowed = (($btit_settings["fmhack_gold_and_silver_torrents"] == "enabled" && $CURUSER["id_level"] >= $res[0]["level"])?true:false);
                $multiAllowed = (($btit_settings["fmhack_upload_multiplier"] == "enabled" && $CURUSER["set_multi"] == "yes")?true:false);
                $admintpl->set("gotFilename", "<a target='_blank' href='".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated"] == "true")?strtr($row["filename"], $res_seo["str"], $res_seo["strto"])."-".$row["id"].".html":"index.php?page=torrent-details&id=".$row["info_hash"])."'>".$row["filename"]."</a>");
                $admintpl->set("gotUploadDate", date("d/m/Y H:i:s", $row["upload_date"]));
                $admintpl->set("gotCategory", "<a target='_blank' href='index.php?page=torrents&category=".$row["category"]."'><img src='".$STYLEURL."/images/categories/".$row["cat_image"]."' border='0' alt='".$row["cat_name"]."' title='".$row["cat_name"]."' /></a>");
                $admintpl->set("gotSeeds", $row["seeds"]);
                $admintpl->set("gotLeechers", $row["leechers"]);
                $admintpl->set("gotFinished", $row["finished"]);
                $admintpl->set("goldIcon", "<img src='images/".$res[0]["gold_picture"]."' border='0' alt='".$language["IS_GOLD"]." ".$gold_percentage." ".$language["IS_ALL"]."' title='".$language["IS_GOLD"]." ".$gold_percentage." ".$language["IS_ALL"]."' />");
                $admintpl->set("silverIcon", "<img src='images/".$res[0]["silver_picture"]."' border='0' alt='".$language["IS_SILVER"]." ".$silver_percentage." ".$language["IS_ALL"]."' title='".$language["IS_SILVER"]." ".$silver_percentage." ".$language["IS_ALL"]."' />");
                $admintpl->set("bronzeIcon", "<img src='images/".$res[0]["bronze_picture"]."' border='0' alt='".$language["IS_BRONZE"]." ".$bronze_percentage." ".$language["IS_ALL"]."' title='".$language["IS_BRONZE"]." ".$bronze_percentage." ".$language["IS_ALL"]."' />");
                $admintpl->set("currentGoldIcon", (($row["gold"] == 1)?" <img src='images/".$res[0]["silver_picture"]."' border='0' alt='".$language["IS_SILVER"]." ".$silver_percentage." ".$language["IS_ALL"]."' title='".$language["IS_SILVER"]." ".$silver_percentage." ".$language["IS_ALL"]."' />":(($row["gold"] == 2)?" <img src='images/".$res[0]["gold_picture"]."' border='0' alt='".$language["IS_GOLD"]." ".$gold_percentage." ".$language["IS_ALL"]."' title='".$language["IS_GOLD"]." ".$gold_percentage." ".$language["IS_ALL"]."' />":(($row["gold"] == 3)?" <img src='images/".$res[0]["bronze_picture"]."' border='0' alt='".$language["IS_BRONZE"]." ".$bronze_percentage." ".$language["IS_ALL"]."' title='".$language["IS_BRONZE"]." ".$bronze_percentage." ".$language["IS_ALL"]."' />":""))));
                $admintpl->set("currentMultiIcon", (($row["multiplier"] == 1)?"":" <img src='images/".$row["multiplier"]."x.gif' border='0' alt='".$row["multiplier"]."x ".$language["UPM_UPL_MULT"]."' title='".$row["multiplier"]."x ".$language["UPM_UPL_MULT"]."' />"));
                $admintpl->set("classicDesc", $res[0]["classic_description"]);
                $admintpl->set("torrentId", $id);
                $admintpl->set("goldAllowed", $goldAllowed, true);
                $admintpl->set("multiAllowed", $multiAllowed, true);
                $admintpl->set("isClassic", (($row["gold"] == 0)?true:false), true);
                $admintpl->set("isGold", (($row["gold"] == 2)?true:false), true);
                $admintpl->set("isSilver", (($row["gold"] == 1)?true:false), true);
                $admintpl->set("isBronze", (($row["gold"] == 3)?true:false), true);
                $admintpl->set("is1X", (($row["multiplier"] == 1)?true:false), true);
                $admintpl->set("is2X", (($row["multiplier"] == 2)?true:false), true);
                $admintpl->set("is3X", (($row["multiplier"] == 3)?true:false), true);
                $admintpl->set("is4X", (($row["multiplier"] == 4)?true:false), true);
                $admintpl->set("is5X", (($row["multiplier"] == 5)?true:false), true);
                $admintpl->set("is6X", (($row["multiplier"] == 6)?true:false), true);
                $admintpl->set("is7X", (($row["multiplier"] == 7)?true:false), true);
                $admintpl->set("is8X", (($row["multiplier"] == 8)?true:false), true);
                $admintpl->set("is9X", (($row["multiplier"] == 9)?true:false), true);
                $admintpl->set("is10X", (($row["multiplier"] == 10)?true:false), true);
                $admintpl->set("imdbEnabled", (($btit_settings["fmhack_getIMDB_in_torrent_details"] == "enabled")?true:false), true);
                $admintpl->set("imupEnabled", (($btit_settings["fmhack_torrent_image_upload"] == "enabled")?true:false), true);
                $admintpl->set("noimup", (($btit_settings["fmhack_torrent_image_upload"] == "enabled")?false:true), true);
                $admintpl->set("neitherEnabled", ((!$goldAllowed && !$multiAllowed)?true:false), true);
                $admintpl->set("originalGold", $row["gold"]);
                $admintpl->set("originalMulti", $row["multiplier"]);
            }
        }
    }
    elseif($search && $selected && $method)
    {
        $priority1=(isset($_POST["priority1"]) && is_numeric($_POST["priority1"])) ? intval(0+$_POST["priority1"]) : false;
        $priority2=(isset($_POST["priority2"]) && is_numeric($_POST["priority2"])) ? intval(0+$_POST["priority2"]) : false;
        $priority3=(isset($_POST["priority3"]) && is_numeric($_POST["priority3"])) ? intval(0+$_POST["priority3"]) : false;
        if($priority1===false || $priority2===false || $priority3===false)
        {
            stderr($language["ERROR"], $language["TVDB_PRIORITY_ERR1"]);
        }
        elseif($priority1==$priority2 || $priority1==$priority3 || $priority2==$priority3)
        {
            stderr($language["ERROR"], $language["TVDB_PRIORITY_ERR2"]);
        }
        $imagePriority = $priority1."-".$priority2."-".$priority3;
        $id = (isset($_POST["torrentId"]) && !empty($_POST["torrentId"]) && is_numeric($_POST["torrentId"]))?(int)0 + $_POST["torrentId"]:false;
        $multiplier = (isset($_POST["multiplier"]) && !empty($_POST["multiplier"]) && $_POST["multiplier"] >= 2 && $_POST["multiplier"] <= 10)?(int)0 + $_POST["multiplier"]:(int)1;
        $multiRevert = (isset($_POST["multiRevert"]) && !empty($_POST["multiRevert"]) && ($_POST["multiRevert"] == "yes" || $_POST["multiRevert"] == "no"))?$_POST["multiRevert"]:"no";
        $goldType = (isset($_POST["goldType"]) && !empty($_POST["goldType"]) && $_POST["goldType"] >= 1 && $_POST["goldType"] <= 3)?(int)0 + $_POST["goldType"]:(int)0;
        $goldRevert = (isset($_POST["goldRevert"]) && !empty($_POST["goldRevert"]) && ($_POST["goldRevert"] == "yes" || $_POST["goldRevert"] == "no"))?$_POST["goldRevert"]:"no";
        $whichWeek = (isset($_POST["whichWeek"]) && !empty($_POST["whichWeek"]) && ($_POST["whichWeek"] == "this" || $_POST["whichWeek"] == "next"))?$_POST["whichWeek"]:"this";
        $originalMulti = (isset($_POST["originalMulti"]) && !empty($_POST["originalMulti"]) && $_POST["originalMulti"] >= 2 && $_POST["originalMulti"] <= 10)?(int)0 + $_POST["originalMulti"]:(int)1;
        $originalGold = (isset($_POST["originalGold"]) && !empty($_POST["originalGold"]) && $_POST["originalGold"] >= 1 && $_POST["originalGold"] <= 3)?(int)0 + $_POST["originalGold"]:(int)0;

        $res = get_result("SELECT `level`, `gold_percentage`, `silver_percentage`, `bronze_percentage` FROM `{$TABLE_PREFIX}gold` WHERE `id`=1", true, $btit_settings["cache_duration"]);

        $goldAllowed = (($btit_settings["fmhack_gold_and_silver_torrents"] == "enabled" && $CURUSER["id_level"] >= $res[0]["level"])?true:false);
        $multiAllowed = (($btit_settings["fmhack_upload_multiplier"] == "enabled" && $CURUSER["set_multi"] == "yes")?true:false);

        if($whichWeek == "this" && (($multiAllowed && $multiplier != $originalMulti) || ($goldAllowed && $goldType != $originalGold)))
            quickQuery("UPDATE `{$TABLE_PREFIX}files` `f`".(($XBTT_USE)?" LEFT JOIN `xbt_files` `xf` ON `f`.`bin_hash`=`xf`.`info_hash`":"")." SET".(($multiAllowed && $multiplier != $originalMulti)?" `f`.`multiplier`='".$multiplier."'":"").(($goldAllowed && $goldType != $originalGold)?(($multiAllowed && $multiplier != $originalMulti)?",":"")." `f`.`gold`='".$goldType."'":"").(($XBTT_USE)?", `xf`.`flags`='2',".(($goldAllowed && $goldType != $originalGold)?" `xf`.`down_multi`=".(($goldType == 0)?"'100'":(($goldType == 1)?$res[0]["silver_percentage"]:(($goldType == 2)?"'".$res[0]["gold_percentage"]."'":"'".$res[0]["bronze_percentage"]."'"))):"").(($multiAllowed && $multiplier != $originalMulti)?(($goldAllowed && $goldType != $originalGold)?",":"")." `xf`.`up_multi`='".($multiplier * 100)."'":""):"")." WHERE `f`.`id`='".$id."'", true);

        $value = $id.",".$imagePriority.",".(($goldType >= 1)?1:0)."-".(($goldRevert == "yes")?1:0)."-".$originalGold."-".$goldType.",".(($multiplier >= 2)?1:0)."-".(($multiRevert == "yes")?1:0)."-".$originalMulti."-".$multiplier.(($whichWeek == "this")?",".(time() + 604800):"");
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$value."' WHERE `key`='tow_".(($whichWeek == "this")?"this":"next")."_week'", true);

        foreach(glob($THIS_BASEPATH."/cache/*.txt") as $filename)
            unlink($filename);

        success_msg($language["SUCCESS"], $language["TOW_SUCCESS_1"]." <a href='index.php'>".$language["TOW_CLICK"]."</a> ".$language["TOW_SUCCESS_2"]);
    }
}
$admintpl->set("uid", $CURUSER["uid"]);
$admintpl->set("random", $CURUSER["random"]);
$admintpl->set("language", $language);

?>
