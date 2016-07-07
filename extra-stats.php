<?php
        /////////////////////////////////////////////////////////////////////////////////////
        // xbtit - Bittorrent tracker/frontend
        //
        // Copyright (C) 2004 - 2014  Btiteam
        //
        //    This file is part of xbtit DT FM.
        //
        // Redistribution and use in source and binary forms, with or without modification,
        // are permitted provided that the following conditions are met:
        //
        //   1. Redistributions of source code must retain the above copyright notice,
        //      this list of conditions and the following disclaimer.
        //   2. Redistributions in binary form must reproduce the above copyright notice,
        //      this list of conditions and the following disclaimer in the documentation
        //      and/or other materials provided with the distribution.
        //   3. The name of the author may not be used to endorse or promote products
        //      derived from this software without specific prior written permission.
        //
        // THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
        // WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
        // MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
        // IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
        // SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
        // TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
        // PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
        // LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
        // NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
        // EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
        //
        ////////////////////////////////////////////////////////////////////////////////////
    
    if (!defined("IN_BTIT"))
    die("non direct access!");
        //limit hack
        //$limit = (int)$_POST["limit"];
    
        //Gaart: edit
    $limit = 10;
    
        //Redirect
    if($_GET["type"]=="torrents" || $_GET["type"]=="users" || $_GET["type"]=="forum")
    {
        //Do Nothing
    }
    else
    {
    redirect("index.php?page=extra-stats&type=users");
    }
    
        //Staff access only
    //if($CURUSER["id_level"] >= 6)
    //{
        //Do Nothing
    //}
    //else
    //{
    //redirect("index.php");
    //}
        //End Gaart
    
    
    
        // online
    function usertableb($res, $frame_caption) {
        global $STYLEPATH, $extratpl, $language;
        $num = 0;
        $userb=array();
        foreach ($res as $id=>$a) {
            $num++;
            
            
            
            $userb[$num-1]["rank"]=$num;
            
            $userb[$num-1]["username"]=("<a href=\"index.php?page=userdetails&amp;id=" . $a["id"] . "\"><b>".stripslashes($a["prefixcolor"]) . $a["username"] .stripslashes($a["suffixcolor"])."</b></a>");
            
            $userb[$num-1]["online"]=NDF($a["tot_on"]);
            
        }
        $extratpl->set("language",$language);
        $extratpl->set("userb",$userb);
        return set_block($frame_caption,"center",$extratpl->fetch(load_template("extra-stats.userb.tpl")));
    }
        //online
    
    
    
    function usertable($res, $frame_caption) {
        
        global $STYLEPATH, $extratpl, $language;
        
        $num = 0;
        $user=array();
        foreach ($res as $id=>$a) {
            $num++;
            
            if ($a["downloaded"]>0) {
                $ratio = $a["uploaded"] / $a["downloaded"];
                $ratio = number_format($ratio, 2);
            }
            else
                $ratio = $language["INFINITE"];
            
                //Gaart Addition
            if($a[uploads]==0 || $a["uploads"]==null)
                {
                $uploads=0;
                }
            else
                $uploads=$a["uploads"];
                //End Gaart
            
            $user[$num-1]["rank"]=$num;
            $user[$num-1]["username"]=("<a href=\"index.php?page=userdetails&amp;id=" . $a["id"] . "\"><b>".stripslashes($a["prefixcolor"]) . $a["username"] .stripslashes($a["suffixcolor"])."</b></a>");
            $user[$num-1]["uploaded"]=makesize($a["uploaded"]);
            $user[$num-1]["downloaded"]=makesize($a["downloaded"]);
            $user[$num-1]["ratio"]=$ratio;
                //Gaart addition
            $user[$num-1]["uploads"]=$uploads;
            $user[$num-1]["joined"]=substr("".$a["joined"]."",0,16);
                //End Gaart
        }
        
        $extratpl->set("language",$language);
        $extratpl->set("user",$user);
        return set_block($frame_caption,"center",$extratpl->fetch(load_template("extra-stats.user.tpl")));
    }
    
    function _torrenttable($rt, $frame_caption,$speed=false) {
        
        global $STYLEPATH, $extratpl, $language;
        
        $torrent=array();
        $num = 0;
        foreach ($rt as $id=>$a) {
            $num++;
            if ($a["leechers"]>0)
                {
                $r = $a["seeds"] / $a["leechers"];
                $ratio = number_format($r, 2);
                }
            
            $torrent[$num-1]["rank"]=$num;
            if ($GLOBALS["usepopup"])
                $torrent[$num-1]["filename"]="<a href=\"javascript:popdetails('index.php?page=details&amp;id=".$a['hash']."');\">".unesc($a["name"])."</a>";
            else
                $torrent[$num-1]["filename"]="<a href=\"index.php?page=details&amp;id=".$a['hash']."\">".unesc($a["name"])."</a>";
            
            $torrent[$num-1]["complete"]=number_format($a["finished"]);
            $torrent[$num-1]["seeds"]=number_format($a["seeds"]);
            $torrent[$num-1]["leechers"]=number_format($a["leechers"]);
            $torrent[$num-1]["peers"]=number_format($a["leechers"] + $a["seeds"]);
            if ($speed)
                $torrent[$num-1]["speed"]=makesize($a["speed"]);
            $torrent[$num-1]["data"]=substr("".$a["data"]."",0,16);
            
        }
        
        $extratpl->set("language",$language);
        $extratpl->set("torrent",$torrent);
        $extratpl->set("DISPLAY_SPEED",$speed,true);
        $extratpl->set("DISPLAY_SPEED1",$speed,true);
        
        return set_block($frame_caption,"center",$extratpl->fetch(load_template("extra-stats.torrent.tpl")));
        
    }
    
        //Gaart edit
    function forumtable($res, $frame_caption, $forums=false)
    {
    global $STYLEPATH, $extratpl, $language;
    
    $num=0;
    $forum=array();
    
    foreach($res as $id=>$f)
        {
        $num++;
        $forum[$num-1]["rank"]=$num;
        
        if($forums)
            {
            $forum[$num-1]["subject"]="<a href=\"index.php?page=forum&amp;action=viewtopic&amp;topicid=".$f["topicid"]."\">".unesc($f["subject"])."</a>";
            $forum[$num-1]["reply"]=$f["reply"]-1;
            }
        else
            {
            $forum[$num-1]["user"]=("<a href=\"index.php?page=userdetails&amp;id=" . $f["id"] . "\"><b>".stripslashes($f["prefixcolor"]) . $f["username"] .stripslashes($f["suffixcolor"])."</b></a>");
            $forum[$num-1]["posts"]=$f["posts"];
            $forum[$num-1]["joined"]=substr("".$f["joined"]."",0,16);
            }
        }
    
    $extratpl->set("language",$language);
    $extratpl->set("forum",$forum);
    
    if($forums)
        {
        return set_block($frame_caption,"center",$extratpl->fetch(load_template("extra-stats.posts.tpl")));
        }
    else
        {
        return set_block($frame_caption,"center",$extratpl->fetch(load_template("extra-stats.forum.tpl")));
        }
    
    return "";
    }
        //End Gaart
    
    
    if ($XBTT_USE)
    {
    $tseeds="f.seeds+ifnull(x.seeders,0)";
    $tleechs="f.leechers+ifnull(x.leechers,0)";
    $tcompletes="f.finished+ifnull(x.completed,0)";
    $ttables="{$TABLE_PREFIX}files f LEFT JOIN xbt_files x ON x.info_hash=f.bin_hash";
    $udownloaded="u.downloaded+IFNULL(x.downloaded,0)";
    $uuploaded="u.uploaded+IFNULL(x.uploaded,0)";
    $utables="{$TABLE_PREFIX}users u LEFT JOIN xbt_users x ON x.uid=u.id";
    }
    else
    {
    $tseeds="f.seeds";
    $tleechs="f.leechers";
    $tcompletes="f.finished";
    $ttables="{$TABLE_PREFIX}files f";
    $udownloaded="u.downloaded";
    $uuploaded="u.uploaded";
    $utables="{$TABLE_PREFIX}users u";
    }
    
    $out="";
    
    $cpage=get_cached_version("extra-stats".$CURUSER["id_level"]);
    if ($cpage)
    {
    $out=$cpage;
    return;
    }
    
        //Edit Gaart
    $out.="<div id='menu'>\n<ul class='level1'>";
    $out.="<li class='level1-li'><a href='index.php?page=extra-stats&type=users'>Users</a></li>\n";
    $out.="<li class='level1-li'><a href='index.php?page=extra-stats&type=torrents'>Torrents</a></li>\n";
    $out.="<li class='level1-li'><a href='index.php?page=extra-stats&type=forum'>Forum</a></li>\n";
    $out.="</div><br /><br />";
        //End
    
    $extratpl=new bTemplate();
    
        // the display the box only if number of rows is > 0
    if ($CURUSER["view_users"]=="yes"  && $_GET["type"]=="users")
    {
        //Top Upload
    $r = get_result("SELECT u.id, u.username, ul.prefixcolor, ul.suffixcolor, $udownloaded as downloaded, $uuploaded as uploaded, u.joined, (SELECT COUNT(*) FROM $ttables WHERE f.uploader=u.id GROUP BY f.uploader) as uploads FROM $utables LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE $uuploaded>0 ORDER BY $uuploaded DESC LIMIT $limit",true,$CACHE_DURATION);
    if (count($r)>0) { $out.=usertable($r, $language["TOP_10_UPLOAD"]); $out.= "<br /><br />"; }
        //Top Download
    $r = get_result("SELECT u.id, u.username, ul.prefixcolor, ul.suffixcolor, $udownloaded as downloaded, $uuploaded as uploaded, u.joined, (SELECT COUNT(*) FROM $ttables WHERE f.uploader=u.id GROUP BY f.uploader) as uploads FROM $utables LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE $uuploaded>0 AND $udownloaded>0 ORDER BY $udownloaded DESC LIMIT $limit",true,$CACHE_DURATION);
    if (count($r)>0) { $out.=usertable($r, $language["TOP_10_DOWNLOAD"]); $out.="<br /><br />";}
        //Top Uploaders (Gaart addition)
    $r = get_result("SELECT u.id, u.username, ul.prefixcolor, ul.suffixcolor, $udownloaded as downloaded, $uuploaded as uploaded, u.joined, (SELECT COUNT(*) FROM $ttables WHERE f.uploader=u.id GROUP BY f.uploader) as uploads FROM $utables LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE $uuploaded>0 ORDER BY uploads DESC LIMIT $limit",true,$CACHE_DURATION);
    if (count($r)>0) { $out.=usertable($r, "Top 10 Torrent Uploaded"); $out.="<br /><br />";}
        //Best Sharers
        //$r = get_result("SELECT u.username, ul.prefixcolor, ul.suffixcolor, $udownloaded as downloaded, $uuploaded as uploaded, u.joined, (SELECT COUNT(*) FROM $ttables WHERE f.uploader=u.id GROUP BY f.uploader) as uploads FROM $utables LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE $udownloaded > 104857600 ORDER BY $uuploaded - $udownloaded DESC LIMIT $limit",true,$CACHE_DURATION);
        //if (count($r)>0) { $out.=usertable($r, $language["TOP_10_SHARE"]." ".$language["MINIMUM_100_DOWN"].""); $out.= "<br /><br />";}
        //Worst Sharers
        //$r = get_result("SELECT u.username, ul.prefixcolor, ul.suffixcolor, $udownloaded as downloaded, $uuploaded as uploaded, u.joined, (SELECT COUNT(*) FROM $ttables WHERE f.uploader=u.id GROUP BY f.uploader) as uploads FROM $utables LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE $udownloaded > 104857600 ORDER BY $udownloaded - $uuploaded DESC, $udownloaded DESC LIMIT $limit",true,$CACHE_DURATION);
        //if (count($r)>0) { $out.=usertable($r, $language["TOP_10_WORST"]." ".$language["MINIMUM_100_DOWN"].""); $out.= "<br /><br />"; }
    
        // online
        //$r = get_result("SELECT u.username, ul.prefixcolor, ul.suffixcolor, tot_on FROM $utables LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id  WHERE u.id_level !=1 ORDER BY tot_on DESC LIMIT 10",true,$CACHE_DURATION);
    
        //if (count($r)>0) { $out.=usertableb($r, $language["most_online"]); $out.= "<br /><br />"; }
        //online
    
    }
    if ($CURUSER["view_torrents"]=="yes" && $_GET["type"]=="torrents")
    {
        //Most Active
    $r = get_result("SELECT f.info_hash as hash, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished, dlbytes as dwned , filename as name, url as url, info, speed as speed, uploader, data FROM $ttables where (".$CURUSER['team']." = f.team OR f.team = 0 OR ".$CURUSER['id_level']."> 7) ORDER BY $tseeds + $tleechs DESC LIMIT $limit",true,$CACHE_DURATION);
    if (count($r)>0) { $out.=_torrenttable($r, $language["TOP_10_ACTIVE"]); $out.= "<br /><br />";}
        //Best Seeds
    $r = get_result("SELECT f.info_hash as hash, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished, dlbytes as dwned , filename as name, url as url, info, speed as speed, uploader, data FROM $ttables WHERE $tseeds >= 5 AND (".$CURUSER['team']." = f.team OR f.team = 0 OR ".$CURUSER['id_level']."> 7)  ORDER BY  seeds DESC, $tseeds / $tleechs DESC LIMIT $limit",true,$CACHE_DURATION);
    if (count($r)>0) { $out.=_torrenttable($r, $language["TOP_10_BEST_SEED"]." (".$language["MINIMUM_5_SEED"].")"); $out.= "<br /><br />";}
        //Worst Seeds
    $r = get_result("SELECT f.info_hash as hash, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished, dlbytes as dwned , filename as name, url as url, info, speed as speed, uploader, data FROM $ttables WHERE $tleechs >= 5 AND $tcompletes > 0 AND (".$CURUSER['team']." = f.team OR f.team = 0 OR ".$CURUSER['id_level']."> 7) ORDER BY $tleechs DESC, $tseeds / $tleechs ASC LIMIT $limit",true,$CACHE_DURATION);
    if (count($r)>0) { $out.=_torrenttable($r, $language["TOP_10_WORST_SEED"]." (".$language["MINIMUM_5_LEECH"].")"); $out.= "<br /><br />";}
    
        //Oldest Torrents with atleast 1 Seed
    $r = get_result("SELECT f.info_hash as hash, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished, dlbytes as dwned , filename as name, url as url, info, speed as speed, uploader, data FROM $ttables WHERE $tseeds >= 1 AND (".$CURUSER['team']." = f.team OR f.team = 0 OR ".$CURUSER['id_level']."> 7) AND f.category!=41 AND f.category!=40 AND f.category!=90 ORDER BY data ASC, seeds ASC LIMIT $limit",true,$CACHE_DURATION);
    if (count($r)>0) { $out.=_torrenttable($r, "Oldest Torrents with atleast 1 Seed"); $out.= "<br /><br />";}
    
    
    if (!$XBTT_USE)
        {
        $r = get_result("SELECT f.info_hash as hash, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished, dlbytes as dwned , filename as name, url as url, info, speed as speed, uploader, data FROM $ttables WHERE external='no' AND (".$CURUSER['team']." = f.team OR f.team = 0 OR ".$CURUSER['id_level']."> 7) ORDER BY speed DESC, $tseeds DESC LIMIT $limit",true,$CACHE_DURATION);
        if (count($r)>0) { $out.=_torrenttable($r, $language["TOP_10_BSPEED"],true); $out.= "<br /><br />";}
        $r = get_result("SELECT f.info_hash as hash, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished, dlbytes as dwned , filename as name, url as url, info, speed as speed, uploader, data FROM $ttables WHERE external='no' AND (".$CURUSER['team']." = f.team OR f.team = 0 OR ".$CURUSER['id_level']."> 7) ORDER BY speed ASC, $tseeds DESC LIMIT $limit",true,$CACHE_DURATION);
        if (count($r)>0) { $out.=_torrenttable($r, $language["TOP_10_WSPEED"],true); $out.= "<br /><br />";}
        }
    }
    
    if($CURUSER["view_forum"]=="yes" && $_GET["type"]=="forum")
    {
        //Top Forum Posters
    $r = get_result("SELECT userid, u.username, COUNT(*) as posts, ul.prefixcolor, ul.suffixcolor, u.joined FROM {$TABLE_PREFIX}posts LEFT JOIN {$TABLE_PREFIX}users u ON userid=u.id LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id GROUP BY userid ORDER BY posts DESC LIMIT $limit",true,$CACHE_DURATION);
    if(count($r>0)){ $out.=forumtable($r,"Top 10 Forum Posters"); $out.="<br /><br />";}
    
        //Top Forum Topics
    $r = get_result("SELECT subject, topicid, (SELECT COUNT(*) FROM btnet_posts p WHERE p.topicid=t.id) as reply FROM btnet_topics t LEFT JOIN btnet_posts p ON p.topicid=t.id LEFT JOIN btnet_forums f ON t.forumid=f.id WHERE f.minclassread<=".$CURUSER["id_level"]." GROUP BY subject ORDER BY reply DESC LIMIT $limit",true,$CACHE_DURATION);
    if(count($r>0)){ $out.=forumtable($r,"Top 10 Forum Topics",true); $out.="<br /><br />";}
    

    }
    
    unset($r);
    
    write_cached_version("extra-stats".$CURUSER["id_level"],$out);
    
    ?>
