<?php
if(!defined("IN_BTIT"))
    die("non direct access!");
if(!defined("IN_ACP"))
    die("non direct access!");


if(isset($_GET["action"]) && $_GET["action"]=="delawk")
{
    $key=(isset($_GET["key"]) && is_numeric($_GET["key"])) ? (int)0+$_GET["key"] : -1;
    if($key>=0)
    {
        $awkTitles=array();
        $awkTitles2=array();
        $i=0;
        if(!empty($btit_settings["tvdb_awkward_titles"]))
        {
            $awkTitles=unserialize($btit_settings["tvdb_awkward_titles"]);
        }
        if(isset($awkTitles[$key]))
        {
            unset($awkTitles[$key]);
            if(count($awkTitles)>0)
            {
                foreach($awkTitles as $value)
                {
                    $awkTitles2[$i]["name"]=$value["name"];
                    $awkTitles2[$i]["delimiter"]=$value["delimiter"];
                    $awkTitles2[$i]["seriesid"]=$value["seriesid"];
                    $i++;
                }
                $awkTitles=serialize($awkTitles2);
            }
            else
                $awkTitles="";
            if($awkTitles!=$btit_settings["tvdb_awkward_titles"])
            {
                quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".sql_esc($awkTitles)."' WHERE `key`='tvdb_awkward_titles'", true);
                foreach(glob($THIS_BASEPATH."/cache/*.txt") as $filename)
                    unlink($filename);
                redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=tvdb");
            }
        }
    }
}
if(isset($_POST) && !empty($_POST))
{
    $tvdb_img_min_rating=(isset($_POST["tvdb_img_min_rating"]) && is_numeric($_POST["tvdb_img_min_rating"])) ? floatval(0+$_POST["tvdb_img_min_rating"]): 0;
    $tvdb_image_min_voters=(isset($_POST["tvdb_image_min_voters"]) && is_numeric($_POST["tvdb_image_min_voters"])) ? intval(0+$_POST["tvdb_image_min_voters"]): 0;
    $tvdb_awkward_release_name=(isset($_POST["tvdb_awkward_release_name"]) && !empty($_POST["tvdb_awkward_release_name"])) ? $_POST["tvdb_awkward_release_name"] : false;
    $tvdb_awkward_release_delimiter=(isset($_POST["tvdb_awkward_release_delimiter"]) && !empty($_POST["tvdb_awkward_release_delimiter"])) ? $_POST["tvdb_awkward_release_delimiter"] : false;
    $tvdb_awkward_release_seriesid=(isset($_POST["tvdb_awkward_release_seriesid"]) && is_numeric($_POST["tvdb_awkward_release_seriesid"])) ? intval(0+$_POST["tvdb_awkward_release_seriesid"]): false;
    $tvdb_hide_imdb=(isset($_POST["tvdb_hide_imdb"]) && $_POST["tvdb_hide_imdb"]=="yes") ? "yes": "no";

    $tvdb_cats = "";
    foreach($_POST as $k => $v)
    {
        if(substr($k, 0, 8) == "category")
            $tvdb_cats .= (int)0 + $v.",";
    }
    $tvdb_cats = sql_esc(trim($tvdb_cats, ","));
    quickQuery("DELETE FROM `{$TABLE_PREFIX}settings` WHERE `key` IN('tvdb_cats','tvdb_img_min_rating','tvdb_image_min_voters','tvdb_hide_imdb')", true);
    quickQuery("INSERT INTO `{$TABLE_PREFIX}settings` (`key`, `value`) VALUES ('tvdb_img_min_rating', '".$tvdb_img_min_rating."'), ('tvdb_image_min_voters', '".$tvdb_image_min_voters."'), ('tvdb_cats', '".$tvdb_cats."'), ('tvdb_hide_imdb', '".$tvdb_hide_imdb."')", true);
    if(($tvdb_awkward_release_name && (!$tvdb_awkward_release_delimiter || !$tvdb_awkward_release_seriesid)) || ($tvdb_awkward_release_delimiter && (!$tvdb_awkward_release_name || !$tvdb_awkward_release_seriesid)) || ($tvdb_awkward_release_seriesid && (!$tvdb_awkward_release_delimiter || !$tvdb_awkward_release_name)))
    {
        stderr($language["ERROR"], $language["TVDB_AWK_ERR"]);
    }
    if($tvdb_awkward_release_name && $tvdb_awkward_release_delimiter && $tvdb_awkward_release_seriesid)
    {
        $awkTitles=array();
        $i=-1;
        if(!empty($btit_settings["tvdb_awkward_titles"]))
        {
            $awkTitles=unserialize($btit_settings["tvdb_awkward_titles"]);
        }
        $count=count($awkTitles);
        if($count>0)
        {
            foreach($awkTitles as $key => $value)
            {
                if($value["name"]==$tvdb_awkward_release_name)
                {
                    $i=$key;
                }
            }
            if($i==-1)
                $i=$count;
        }
        else
            $i=0;

        $awkTitles[$i]["name"]=$tvdb_awkward_release_name;
        $awkTitles[$i]["delimiter"]=$tvdb_awkward_release_delimiter;
        $awkTitles[$i]["seriesid"]=$tvdb_awkward_release_seriesid;

        $awkSerialized=sql_esc(serialize($awkTitles));
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$awkSerialized."' WHERE `key`='tvdb_awkward_titles'", true);
    }
    foreach(glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=tvdb");
}
$tvdb_catlist = (isset($btit_settings["tvdb_cats"]) && !empty($btit_settings["tvdb_cats"]))?explode(",", $btit_settings["tvdb_cats"]):array(0 => "all");
$res = get_result("SELECT `id`, `name`, `image` FROM `{$TABLE_PREFIX}categories` WHERE `sub`='0' ORDER BY `sort_index` ASC", true, $btit_settings["cache_duration"]);
$counter = 1;
$i = 0;
if(count($res) > 0)
{
    $tvdb_output .= "\n<table>\n<tr>\n";
    foreach($res as $row)
    {
        $res2 = get_result("SELECT `id`, `name`, `image` FROM `{$TABLE_PREFIX}categories` WHERE `sub`='".$row["id"]."'", true, $btit_settings["cache_duration"]);
        if(count($res2) > 0)
        {
            foreach($res2 as $row2)
            {
                if($counter == 6)
                {
                    $tvdb_output .= "\n</tr>\n<tr>\n";
                    $counter = 1;
                }
                $tvdb_output .= "<td valign='middle'><img src='".$STYLEURL."/images/categories/".$row2["image"]."' title='".$row["name"]." --> ".$row2["name"]."' height='32' width='32' />&nbsp;&nbsp;<input type='checkbox' name='category".$i."' value='".$row2["id"]."'".(($tvdb_catlist[0] == "all" || in_array($row2["id"], $tvdb_catlist))?" checked='checked' ":"")."></td>\n";
                $counter++;
                $i++;
            }
        }
        else
        {
            if($counter == 6)
            {
                $tvdb_output .= "\n</tr>\n<tr>\n";
                $counter = 1;
            }
            $tvdb_output .= "<td valign='middle'><img src='".$STYLEURL."/images/categories/".$row["image"]."' title='".$row["name"]."' height='32' width='32' />&nbsp;&nbsp;<input type='checkbox' name='category".$i."' value='".$row["id"]."'".(($tvdb_catlist[0] == "all" || in_array($row["id"], $tvdb_catlist))?" checked='checked' ":"")."></td>\n";
            $counter++;
            $i++;
        }
    }
    $tvdb_output .= "</tr>\n</table>\n";
}


$awkTitles=array();
if(!empty($btit_settings["tvdb_awkward_titles"]))
{
    $awkTitles=unserialize($btit_settings["tvdb_awkward_titles"]);
}
if(count($awkTitles)>0)
{
    $awkTitles2=$awkTitles;
    foreach($awkTitles as $key => $value)
    {
        $awkTitles2[$key]["key"]=$key;
    }
}

$admintpl->set("STYLEURL", $STYLEURL);
$admintpl->set("tvdb_have_awk", ((count($awkTitles)>0)?true:false), true);
$admintpl->set("awkTitles", $awkTitles2);
$admintpl->set("tvdb_output", $tvdb_output);
$admintpl->set("tvdb_img_min_rating", $btit_settings["tvdb_img_min_rating"]);
$admintpl->set("tvdb_image_min_voters", $btit_settings["tvdb_image_min_voters"]);
$admintpl->set("imdb_enabled", (($btit_settings["fmhack_getIMDB_in_torrent_details"] == "enabled")?true:false), true);
$admintpl->set("yes_checked", (($btit_settings["tvdb_hide_imdb"] == "yes")?true:false), true);
$admintpl->set("no_checked", (($btit_settings["tvdb_hide_imdb"] == "no")?true:false), true);
$admintpl->set("uid", $CURUSER["uid"]);
$admintpl->set("random", $CURUSER["random"]);
$admintpl->set("language", $language);
?>
