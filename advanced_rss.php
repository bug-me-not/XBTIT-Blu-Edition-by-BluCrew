<?php

require_once("include/functions.php");
dbconn(true);

if($btit_settings["fmhack_SEO_panel"]=="enabled")
{
    $active_seo = get_result("SELECT `activated`, `str`, `strto` FROM `{$TABLE_PREFIX}seo` WHERE `id`='1'");
    $res_seo=$active_seo[0];
}

(isset($_GET["auth"]) && !empty($_GET["auth"])) ? $auth=explode("-", base64_decode($_GET["auth"])) : $auth=false;
(isset($_GET["cats"]) && !empty($_GET["cats"])) ? $categories=explode(";", $_GET["cats"]) : $categories=array();
(isset($_GET["tpc"]) && !empty($_GET["tpc"])) ? $torrents_per_cat=(int)0+$_GET["tpc"] : $torrents_per_cat=3;

if(isset($auth) && is_array($auth))
{
    if($CURUSER["uid"]==1)
    {
        unset($CURUSER);
        userlogin($auth);
    }
    if(count($categories)==0 || !is_numeric($categories[0]))
    {
        $res=get_result("SELECT `id` FROM `{$TABLE_PREFIX}categories` ORDER BY `id` ASC");
        foreach($res as $row)
            $categories[]=$row["id"];
    }
    header("Content-type: application/rss+xml");
    print("<?xml version=\"1.0\" encoding=\"".$GLOBALS["charset"]."\"?>");?>

    <rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
    <title><?php print($SITENAME);?></title>
    <description>Advanced RSS Feed for xbtitFM by Petr1fied</description>
    <link><?php print($BASEURL);?></link>
    <lastBuildDate><?php print(date("r"));?></lastBuildDate>
    <copyright>(c) <?php print(date("Y")." ".$SITENAME);?></copyright>
    <atom:link href="<?php echo str_replace("&", "&amp;", $BASEURL.$_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"]);?>" rel="self" type="application/rss+xml" />

    <?php
    $res1=get_result("SELECT `id` FROM `{$TABLE_PREFIX}users` WHERE `id`='".sql_esc($auth[1])."' AND `password` LIKE '".sql_esc($auth[2])."%' AND `password` LIKE '%".sql_esc($auth[0])."' AND `random`='".sql_esc($auth[3])."' AND `id`>1");
    if(count($res1)>0)
    {
        foreach($categories as $value)
        {
            if(!is_numeric($value) && !is_integer($value))
                $value=0;

            $query1_select="";
            $query1_and="";
            if($btit_settings["fmhack_teams"]=="enabled" && $btit_settings["team_state"]=="private")
                $query1_and .= "AND (".$CURUSER['team']." = `f`.`team` OR `f`.`team` = 0 OR '".$CURUSER['all_teams']."'='yes' OR '".$CURUSER['sel_team']."'=`f`.`team`) ";
            if($btit_settings["fmhack_torrent_moderation"]=="enabled")
                $query1_and .= "AND `f`.`moder`='ok' ";
            if($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")
                $query1_select .= "`f`.`id` `fileid`, ";
            if($btit_settings["fmhack_archive_torrents"]=="enabled")
            {
                $query1_select .= "`f`.`archive`, ";
                if($CURUSER["view_new"]=="yes")
                    $query1_and .= "AND `f`.`archive`=0 ";
                elseif($CURUSER["view_arc"]=="yes")
                    $query1_and .= "AND `f`.`archive`=1 ";
                else
                    $query1_and .= "AND 1=2 ";
            }
            $query = "SELECT ".$query1_select."`f`.`info_hash`, `f`.`filename`, `f`.`url`, UNIX_TIMESTAMP(`f`.`data`) `data`, `f`.`comment`, ".(($XBTT_USE)?"`xf`.`seeders` `seeds`, `xf`.`leechers`,":"`f`.`seeds`, `f`.`leechers`,")." `c`.`name`, `c`.`sub` ";
            $query .= "FROM `{$TABLE_PREFIX}files` `f` ";
            $query .= "LEFT JOIN `{$TABLE_PREFIX}categories` `c` ON `f`.`category` = `c`.`id` ";
            if($XBTT_USE)
                $query .= "LEFT JOIN `xbt_files` `xf` ON `f`.`bin_hash` = `xf`.`info_hash` ";
            $query .= "WHERE `f`.`category`='".$value."' ".$query1_and;
            $query .= "ORDER BY `f`.`data` DESC ";
            $query .= "LIMIT ".$torrents_per_cat;

            $res2=get_result($query);
            if(count($res2)>0)
            {
                $parent_cat="";
                if($res2[0]["sub"]!=0)
                {
                    $res3=get_result("SELECT `name` FROM `{$TABLE_PREFIX}categories` WHERE `id`=".$res2[0]["sub"]);
                    if(count($res3)>0)
                        $parent_cat=$res3[0]["name"];
                }
                foreach($res2 as $row)
                {
                    (($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?$link="<link>".$BASEURL."/".strtr($row["filename"], $res_seo["str"], $res_seo["strto"])."-".$row["fileid"].".html</link>":
                    $link="<link>".$BASEURL."/index.php?page=torrent-details&amp;id=".$id."</link>");
                    (($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?$guid="<guid>".$BASEURL."/".strtr($row["filename"], $res_seo["str"], $res_seo["strto"])."-".$row["fileid"].".html</guid>":
                    $guid="<guid>".$BASEURL."/index.php?page=torrent-details&amp;id=".$id."</guid>");

                    $allowed_to_download="yes";

                    if($btit_settings["fmhack_booted"]=="enabled" && $CURUSER["booted"]=="yes")
                        $allowed_to_download="no";
                    if($btit_settings["fmhack_ban_button"]=="enabled" && $CURUSER["ban"]=="yes" && $allowed_to_download=="yes")
                        $allowed_to_download="no";
                    if($btit_settings["fmhack_low_ratio_ban_system"]=="enabled" && $CURUSER["bandt"]=="yes" && $allowed_to_download=="yes")
                        $allowed_to_download="no";
                    if($btit_settings["fmhack_allow_and_disallow_users_to_up_and_download"]=="enabled" && $CURUSER["allowdownload"]=="no" && $allowed_to_download=="yes")
                        $allowed_to_download="no";
                    if($btit_settings["fmhack_download_ratio_checker"]=="enabled" && $allowed_to_download=="yes")
                    {
                        $user_ratio=(($CURUSER["downloaded"]>0)?number_format($CURUSER["uploaded"]/$CURUSER["downloaded"],3):999.99);
                        if($user_ratio<$btit_settings["mindlratio"] && $CURUSER["bypass_dlcheck"]==0)
                            $allowed_to_download="no";
                    }
                    if($btit_settings["fmhack_archive_torrents"]=="enabled" && $allowed_to_download=="yes")
                    {
                        if($CURUSER["down_new"]=="no" && $row["archive"]==0)
                            $allowed_to_download="no";
                        elseif($CURUSER["down_arc"]=="no" && $row["archive"]==1)
                            $allowed_to_download="no";
                    }
                    if($btit_settings["fmhack_download_requires_introduction"]=="enabled")
                    {
                        if($CURUSER["down_req_intro"]=="yes" && $CURUSER["made_intro"]==0)
                            $allowed_to_download="no";
                    }
                    ?>
                    <item>
                    <title><![CDATA[<?php print("[".(($parent_cat=="")?"":$parent_cat." --> ").$row["name"]."] ".html2txt(stripDodgyCharacters($row["filename"]))." [SEEDERS (".strip_tags($row["seeds"]).")/LEECHERS (".strip_tags($row["leechers"]).")]");?>]]></title>
                    <description><![CDATA[<?php print stripDodgyCharacters(utf8_decode(format_comment($row["comment"])));?>]]></description>
                    <link><?php print($BASEURL."/index.php?page=torrent-details&amp;id=".$row["info_hash"]);?></link>
                    <guid><?php print($BASEURL."/index.php?page=torrent-details&amp;id=".$row["info_hash"]);?></guid>
                    <?php
                    $torrentFile=dirname(__FILE__)."/".$row["url"];
                    if($allowed_to_download=="yes" && file_exists($torrentFile))
                    {
                        ?>
                        <enclosure url="<?php print($BASEURL."/download.php?id=".$row["info_hash"]."&amp;f=".rawurlencode($row["filename"]).".torrent&amp;auth=".base64_encode(implode("-", $auth)));?>" length="<?php print(filesize($torrentFile));?>" type="application/x-bittorrent" />
                        <?php
                    }
                    ?>
                    <pubDate><?php print(date("r", $row["data"]));?></pubDate>
                    </item>

                    <?php
                }
            }
        }
    }
    else
    {
        echo "Invalid authorisation";
    }
    ?>
    </channel>
    </rss>
    <?php
}
else
    echo "Invalid authorisation";


function stripDodgyCharacters($str)
{
    $from=array("onload='resize(this);'",'"','&amp;','\'','&lt;','&gt;','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�');
    $to = array('','&quot;','&#38;','&apos;','&#60;','&#62;','&iexcl;','&cent;','&pound;','&curren;','&yen;','&brvbar;','&sect;','&uml;','&copy;','&ordf;','&laquo;','&not;','&reg;','&macr;','&deg;','&plusmn;','&sup2;','&sup3;','&acute;','&micro;','&para;','&middot;','&cedil;','&sup1;','&ordm;','&raquo;','&frac14;','&frac12;','&frac34;','&iquest;','&Agrave;','&Aacute;','&Acirc;','&Atilde;','&Auml;','&Aring;','&AElig;','&Ccedil;','&Egrave;','&Eacute;','&Ecirc;','&Euml;','&Igrave;','&Iacute;','&Icirc;','&Iuml;','&ETH;','&Ntilde;','&Ograve;','&Oacute;','&Ocirc;','&Otilde;','&Ouml;','&times;','&Oslash;','&Ugrave;','&Uacute;','&Ucirc;','&Uuml;','&Yacute;','&THORN;','&szlig;','&agrave;','&aacute;','&acirc;','&atilde;','&auml;','&aring;','&aelig;','&ccedil;','&egrave;','&eacute;','&ecirc;','&euml;','&igrave;','&iacute;','&icirc;','&iuml;','&eth;','&ntilde;','&ograve;','&oacute;','&ocirc;','&otilde;','&ouml;','&divide;','&oslash;','&ugrave;','&uacute;','&ucirc;','&uuml;','&yacute;','&thorn;','&yuml;');
    return str_replace($from, $to, $str);
}
function html2txt($document)
{
    $search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
                   '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
                   '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
                   '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
                   );
    $text = preg_replace($search, '', $document);
    return $text;
}

?>
