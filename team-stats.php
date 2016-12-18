<?php

if(!$CURUSER || $CURUSER["view_torrents"]!="yes")
{
    err_msg($language["ERROR"],$language["NOT_AUTHORIZED"]." ".$language["MNU_TORRENT"]."!<br />\n".$language["SORRY"]."...");
    stdfoot();
    exit();
}
else
{
    $teamstatstpl=new bTemplate();
    $pagertop="";
    $pagerbottom="";
    $action=$_GET["action"];
    $team=(int)0+$_GET["team"];

    $teamstatstpl->set("view", (($action=="view")?true:false), true);
    $teamstatstpl->set("edit", (($action=="edit")?true:false), true);
    $teamstatstpl->set("team", $team);
    $teamstatstpl->set("STYLEURL", $STYLEURL);
    require_once(load_language("lang_teams.php"));
    $teamstatstpl->set("language", $language);

    if($action=="save" && is_numeric($team))
    {
        $ures=get_result("SELECT `owner` FROM `{$TABLE_PREFIX}teams` WHERE `id`=".$team, true, $btit_settings["cache_duration"]);
        $urow = $ures[0];
        if($CURUSER["uid"]!=$urow["owner"])
        {
            stderr($language["ERROR"],$language["BAD_ID"]);
        }
        else
        {
            $pic=sqlesc(str_replace(array('\t','%25','%00'), array('','',''), htmlspecialchars(AddSlashes($_POST["pic"]))));
            quickQuery("UPDATE `{$TABLE_PREFIX}teams` SET `image`=".$pic." WHERE `id`=".$team." AND `owner`=".$CURUSER["uid"], true);
            redirect("index.php?page=teaminfo&team=".$team."&action=view");
        }
    }
    if($action=="edit" && is_numeric($team))
    {
        $ures=get_result("SELECT `owner`, `image` FROM `{$TABLE_PREFIX}teams` WHERE `id`=".$team, true, $btit_settings["cache_duration"]);
        $urow = $ures[0];
        $teamstatstpl->set("teampic", $urow["image"]);
        if($CURUSER["uid"]!=$urow["owner"])
        {
            stderr($language["ERROR"],$language["BAD_ID"]);
        }
    }
    if($action=="view" && is_numeric($team))
    {
        if ($XBTT_USE)
        {
            $udownloaded="`u`.`downloaded`+IFNULL(`x`.`downloaded`,0) `downloaded`";
            $uuploaded="`u`.`uploaded`+IFNULL(`x`.`uploaded`,0) `uploaded`";
            $utables="`{$TABLE_PREFIX}users` `u` LEFT JOIN `xbt_users` `x` ON `x`.`uid`=`u`.`id`";
        }
        else
        {
            $udownloaded="`u`.`downloaded`";
            $uuploaded="`u`.`uploaded`";
            $utables="`{$TABLE_PREFIX}users` `u`";
        }

        $teamres=get_result("SELECT `t`.`id`, `t`.`name`, `t`.`owner`, `t`.`info`, `u`.`username`, `u`.`avatar`, $udownloaded, $uuploaded, `t`.`image` `teampic`, `ul`.`prefixcolor`, `ul`.`suffixcolor` FROM $utables LEFT JOIN `{$TABLE_PREFIX}teams` `t` ON `t`.`owner`=`u`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `t`.`id`=".$team, true, $btit_settings["cache_duration"]);
        $row = $teamres[0];

        if($_GET["team"]!=$row["id"])
        {
            stderr($language["ERROR"],$language["BAD_ID"]);
        }
        else
        {
            $owner = (int)0+$row["owner"];
            $teamsname = stripslashes($row["prefixcolor"].$row["username"].$row["suffixcolor"]);
            $teamstatstpl->set("info", format_comment($row["info"]));
            $teamstatstpl->set("uname", $teamsname);

            if($row["avatar"] && $row["avatar"]!="")
            {
                $avatar="<img border='0' src='".$row["avatar"]."' width='80' height='80' />";
            }
            else
            {
                $avatar="<img border='0' src='".$BASEURL."/images/question.gif' width='80' height='80' />";
            }
            $teamstatstpl->set("owner", (($CURUSER["uid"]==$owner)?true:false), true);
            $teamstatstpl->set("img",$avatar);
            $downloaded = makesize ($row["downloaded"]);
            $uploaded = makesize ($row["uploaded"]);
            $ratio=($row["downloaded"]>0?number_format($row["uploaded"]/$row["downloaded"],2):"---");
            $teampic="";
            if($row["teampic"] && $row["teampic"]!="")
            {
                $teampic=$row["teampic"];
            }
            $teamstatstpl->set("pic",$teampic);
            $teamstatstpl->set("dl",$downloaded);
            $teamstatstpl->set("ul",$uploaded);
            $teamstatstpl->set("ratio",$ratio);
            $tc=get_result("SELECT (SELECT COUNT(*) FROM `{$TABLE_PREFIX}files` WHERE `uploader`=".$owner." AND `team`=".$team.") `count1`, (SELECT  COUNT(*) FROM `{$TABLE_PREFIX}users` where `team`=".$team.") `count2`", true, $btit_settings["cache_duration"]);
            $teamstatstpl->set("count",$tc[0]["count1"]);
            $perpage=(max(0,$CURUSER["torrentsperpage"])>0?$CURUSER["torrentsperpage"]:10);
            list($pagertop, $pagerbottom, $limit) = pager($perpage, $tc[0]["count2"], "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=team_users&amp;");
       
            $teamstatstpl->set("pagertop",$pagertop);
            $teamstatstpl->set("pagerbottom",$pagerbottom);

            $teamlist=get_result("SELECT `u`.`id`, `u`.`username`, $udownloaded, $uuploaded, `ul`.`prefixcolor`, `ul`.`suffixcolor`, `u`.`team` `userteam`, `t`.`id` `teamsid`, `t`.`name` `teamname`, `t`.`owner`
FROM $utables
LEFT JOIN `{$TABLE_PREFIX}teams` `t` ON `u`.`team` = `t`.`id` 
LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id`
WHERE `u`.`team`=".$team." AND `u`.`id`!=".$owner."
ORDER BY `u`.`id` ASC $limit", true, $btit_settings["cache_duration"]);

            $teaml=array();
            $i=0;
            if(count($teamlist)>0)
            {
                foreach($teamlist as $rip)
                {
                    $torcountu= get_result("SELECT COUNT(*) `count` FROM {$TABLE_PREFIX}files WHERE uploader=".$rip["id"]." AND `team`=".$team);
                    $teaml[$i]["id"] = (int)$rip["id"];
                    $teaml[$i]["username"] = stripslashes($rip["prefixcolor"].$rip["username"].$rip["suffixcolor"]);
                    $teaml[$i]["username_link"]=(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$rip["id"]."_".strtr($rip["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$rip["id"]);
                    $teaml[$i]["uploaded"] = makesize($rip["uploaded"]);
                    $teaml[$i]["downloaded"] = makesize($rip["downloaded"]);
                    $teaml[$i]["countt"] = $torcountu[0]["count"];
                    $i++;
                }
            }
            $teamstatstpl->set("teamu",$teaml);

            unset($rim);
            @$teamlist->free();
            unset($teaml);
        }
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
        $last5dat=array();
        $l5=0;    

        $ups=get_result("SELECT `f`.`id`, `f`.`info_hash`, `f`.`filename`, `f`.`uploader`,".$tseeds." `seeders`,".$tleechs." `leech`, `u`.`username`, `ul`.`prefixcolor`, `ul`.`suffixcolor` FROM ".$ttables." LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `f`.`uploader`=`u`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `f`.`team`=".$team." ORDER BY `f`.`data` DESC LIMIT 5", true, $btit_settings["cache_duration"]);

        if (count($ups)>0)
        {
            $teamstatstpl->set("got_rows",true,true);
            foreach($ups as $uups)
            {
                $tname=$uups["filename"];
                if(strlen($tname)>20)
                    $tname  = substr(htmlspecialchars($uups["filename"]), 0, 20)."...";

                $last5dat[$l5]["torrent_link"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?strtr($uups["filename"], $res_seo["str"], $res_seo["strto"])."-".$uups["id"].".html":"index.php?page=torrent-details&id=".$uups["info_hash"])."'>".$tname."</a>";
                $last5dat[$l5]["username_link"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$uups["uploader"]."_".strtr($uups["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$uups["uploader"])."'>".stripslashes($uups["prefixcolor"].$uups["username"].$uups["suffixcolor"])."</a>";
$last5dat[$l5]["seeders"]=$uups["seeders"];
$last5dat[$l5]["leechers"]=$uups["leech"];
                $l5++; 
            }
        }
        else
        {
            $teamstatstpl->set("got_rows",false,true);
        }

        $teamstatstpl->set("last5data",$last5dat);
    }
}

?>