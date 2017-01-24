<?php

if(!defined("IN_BTIT"))
    die("non direct access!");

ob_start();

$sbtpl=new bTemplate();
$sbtpl->set("language", $language);
$sbtpl->set("gb_enabled", (($btit_settings["gb_enable"]=="true")?true:false), true);
$sbtpl->set("vip_enabled", (($btit_settings["vip_enable"]=="true")?true:false), true);
$sbtpl->set("inv_enabled", (($btit_settings["inv_enable"]=="true" && $btit_settings["fmhack_invitation_system"]=="enabled")?true:false), true);
$sbtpl->set("ct_enabled", (($btit_settings["ct_enable"]=="true")?true:false), true);
$sbtpl->set("un_enabled", (($btit_settings["uname_enable"]=="true")?true:false), true);
$sbtpl->set("gift_enabled", (($btit_settings["sb_gift_enable"]=="true" && isset($CURUSER) && $CURUSER["seedbonus"]>0)?true:false), true);
$sbtpl->set("logged_user", ((isset($CURUSER) && $CURUSER["uid"]>1)?true:false), true);
$sbtpl->set("hnr_enabled", (($btit_settings["hnr_enable"]=="true" && $btit_settings["fmhack_warning_system"]=="enabled" && $btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")?true:false), true);
$sbtpl->set("flsl_enabled", (($btit_settings["fmhack_freeleech_slots"]=="enabled" && $btit_settings["flshot_enable"]=="true")?true:false), true);
$sbtpl->set('bon_enabled',(($CURUSER['seedbonus']>0 && $btit_settings['fmhack_bon_pool']=='enabled')?true:false),true);

if ($CURUSER["uid"] > 1)
{
    if (!isset($CURUSER))
        global $CURUSER;

    $cc=number_format($CURUSER["seedbonus"],2);
    $sbtpl->set("cc", $cc);

    $uid=$CURUSER['uid'];
    $c=$CURUSER["seedbonus"];

    if($btit_settings["gb_enable"]=="true")
    {
        $gb_enable=array();
        $i=0;
        $res=get_result("SELECT `id`, `name`, `points`, `gb` FROM `{$TABLE_PREFIX}bonus` ORDER BY `id` ASC", true, $btit_settings["cache_duration"]);
        foreach($res as $row)
        {
            if($c<$row["points"])
                $gb_enable[$i]["enabled"]="disabled";
            else
                $gb_enable[$i]["enabled"]="";

            $gb_enable[$i]["id"]=$row["id"];
            $gb_enable[$i]["name"]=$row["name"];
            $gb_enable[$i]["points"]=number_format($row["points"],0);
            $gb_enable[$i]["gb"]=$row["gb"];
            $i++;
        }
        $sbtpl->set("gb_enable", $gb_enable);
    }
    if($btit_settings["vip_enable"]=="true")
    {
        if($GLOBALS["vip_timeframe"]==0)
            $timeframe="";
        elseif($GLOBALS["vip_timeframe"]==7)
            $timeframe="1 ".$language["TR_WEEK"];
        elseif($GLOBALS["vip_timeframe"]==14)
            $timeframe="2 ".$language["TR_WEEKS"];
        elseif($GLOBALS["vip_timeframe"]==21)
            $timeframe="3 ".$language["TR_WEEKS"];
        elseif($GLOBALS["vip_timeframe"]==30)
            $timeframe="1 ".$language["TR_MONTH"];
        elseif($GLOBALS["vip_timeframe"]==61)
            $timeframe="2 ".$language["TR_MONTHS"];
        elseif($GLOBALS["vip_timeframe"]==91)
            $timeframe="3 ".$language["TR_MONTHS"];
        elseif($GLOBALS["vip_timeframe"]==182)
            $timeframe="6 ".$language["TR_MONTHS"];
        elseif($GLOBALS["vip_timeframe"]==365)
            $timeframe="1 ".$language["TR_YEAR"];
        else
            $timeframe=$GLOBALS["vip_timeframe"]." ".$language["TR_DAYS"];

        $sbtpl->set("price_vip", number_format($GLOBALS["price_vip"],0));
        $sbtpl->set("timeframe", $timeframe);
        $sbtpl->set("vip_for", (($btit_settings["fmhack_timed_ranks"]=="enabled" && $timeframe!="")?" ".$language["FOR"]." ".$timeframe:""));
        $sbtpl->set("vip_anc", (($c<$GLOBALS["price_vip"] || $CURUSER["edit_torrents"]=="yes"  || $CURUSER["id_level"]==5)?"disabled":""));
    }
    if($btit_settings["inv_enable"]=="true" && $btit_settings["fmhack_invitation_system"]=="enabled")
    {
        $sbtpl->set("inv1", (($c<$GLOBALS["price_inv"])?"disabled":""));
        $sbtpl->set("inv3", (($c<$GLOBALS["price_inv3"])?"disabled":""));
        $sbtpl->set("inv5", (($c<$GLOBALS["price_inv5"])?"disabled":""));
        $sbtpl->set("price_inv1", number_format($GLOBALS["price_inv"],0));
        $sbtpl->set("price_inv3", number_format($GLOBALS["price_inv3"],0));
        $sbtpl->set("price_inv5", number_format($GLOBALS["price_inv5"],0));
    }
    if($btit_settings["ct_enable"]=="true")
    {
        $sbtpl->set("price_ct", number_format($GLOBALS["price_ct"],0));
        $sbtpl->set("custom_title", unesc($CURUSER["custom_title"]));
        $sbtpl->set("no_ct", ((!$CURUSER["custom_title"])?true:false), true);
        $sbtpl->set("can_afford_ct", (($c>=$GLOBALS["price_ct"])?true:false), true);
    }
    if($btit_settings["uname_enable"]=="true")
    {
        $sbtpl->set("price_name", number_format($GLOBALS["price_name"],0));
        $sbtpl->set("username", unesc($CURUSER["username"]));
        $sbtpl->set("can_afford_unc", (($c>=$GLOBALS["price_name"])?true:false), true);
    }
    if($btit_settings["sb_gift_enable"]=="true" && $c>0)
    {
        $sbtpl->set("giftmax", (($CURUSER["seedbonus"]<$btit_settings["bonus_giftmax"])?number_format(floor($CURUSER["seedbonus"]),2):number_format($btit_settings["bonus_giftmax"],0)));
    }
    if($btit_settings["hnr_enable"]=="true" && $btit_settings["fmhack_warning_system"]=="enabled" && $btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")
    {
        $sbtpl->set("hnr_found", false, true);
        $res=get_result("SELECT (SELECT COUNT(*) FROM ".(($XBTT_USE)?"`xbt_files_users`":"`{$TABLE_PREFIX}history`")." WHERE `uid`=".$CURUSER["uid"]." AND `hit`='yes' AND `hitchecked`=1) `hitcount`, (SELECT `warn_lev` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$CURUSER["uid"].") `warn_lev`", true, $btit_settings["cache_duration"]);
        $row=$res[0];

        if($row["hitcount"]>=1 && $row["warn_lev"]>=1)
        {
            if($XBTT_USE)
                $res2=get_result("SELECT `f`.`id`, `f`.`info_hash`, `f`.`filename` FROM `xbt_files_users` `xfu` LEFT JOIN `xbt_files` `xf` ON `xfu`.`fid`=`xf`.`fid` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `xf`.`info_hash`=`f`.`bin_hash` WHERE `xfu`.`uid`=".$CURUSER["uid"]." AND `xfu`.`hit`='yes' AND `xfu`.`hitchecked`=1 ORDER BY `xfu`.`mtime` ASC LIMIT 1", true, $btit_settings["cache_duration"]);
            else
                $res2=get_result("SELECT `f`.`id`, `f`.`info_hash`, `f`.`filename` FROM `{$TABLE_PREFIX}history` `h` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `h`.`infohash`=`f`.`info_hash` WHERE `h`.`uid`=".$CURUSER["uid"]." AND `h`.`hit`='yes' AND `h`.`hitchecked`=1 ORDER BY `h`.`date` ASC LIMIT 1", true, $btit_settings["cache_duration"]);

            $sbtpl->set("price_hnr", number_format($btit_settings["price_hnr"],0));
            $sbtpl->set("oldest_hnr_filename", $res2[0]["filename"]);
            $sbtpl->set("oldest_hnr_hash", $res2[0]["info_hash"]);
            $sbtpl->set("oldest_hnr_id", $res2[0]["id"]);
            $sbtpl->set("seo", (($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?true:false), true);
            $sbtpl->set("seo_filename", (($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?strtr($res2[0]["filename"], $res_seo["str"], $res_seo["strto"]):""));
            $sbtpl->set("hnr", (($c<$btit_settings["price_hnr"])?"disabled":""));
            $sbtpl->set("hnr_found", true, true);
        }
    }
    if($btit_settings["fmhack_freeleech_slots"]=="enabled")
    {
        $sbtpl->set("price_fls", number_format($btit_settings["bonus_flslot"],0));
        $sbtpl->set("fls", (($c<$btit_settings["bonus_flslot"])?"disabled":""));
    }

    if($btit_settings['fmhack_bon_pool']=='enabled')
    {
         $bon1q=do_sqlquery("SELECT `pot` FROM {$TABLE_PREFIX}pool_settings WHERE complete=false");
         $bon1r=$bon1q->fetch_array();
         $bonpot=$bon1r['pot'];

         $bon2q=do_sqlquery("SELECT SUM(`amount`) as `total` FROM `{$TABLE_PREFIX}pool` `l` LEFT JOIN `{$TABLE_PREFIX}pool_settings` `s` ON `l`.`poolid`=`s`.`id` WHERE `s`.`complete`=false LIMIT 1") or sqlerr();
         $bon2r=$bon2q->fetch_array();
         $bonamount=$bon2r['total'];

         $sbtpl->set('bon_figure',' '.number_format($bonamount,0).'/'.number_format($bonpot,0).' ('.($bonamount/$bonpot*100).'%)');
    }

    $sbtpl->set("cond1", (($btit_settings["sb_speed_enable"]=="true" && $btit_settings["bonus_min_uprate"]>0)?true:false), true);
    $sbtpl->set("cond2", (($btit_settings["bonus"]==1)?true:false), true);
    $sbtpl->set("cond3", (($btit_settings["bonus_type"]=="all")?true:false), true);
    $sbtpl->set("cond4", (($btit_settings["sb_max_ph_enable"]=="true" && $btit_settings["bonus_max_per_hour"]>0)?true:false), true);
    $sbtpl->set("cond5", (($btit_settings["upl_enable"]=="true" && $CURUSER["can_upload"]=="yes")?true:false), true);
    $sbtpl->set("cond6", (($btit_settings["bonus_upl"]==1)?true:false), true);
    $sbtpl->set("cond7", (($btit_settings["comm_enable"])?true:false), true);
    $sbtpl->set("cond8", (($btit_settings["bonus_comm"]==1)?true:false), true);
    $sbtpl->set("cond9", (($btit_settings["forpost_enable"])?true:false), true);
    $sbtpl->set("cond10", (($btit_settings["bonus_forpost"]==1)?true:false), true);
    $sbtpl->set("cond11", (($btit_settings["sb_shout_enable"]=="true" && $btit_settings["bonus_make_a_shout"]>0)?true:false), true);
    $sbtpl->set("cond12", (($btit_settings["bonus_make_a_shout"]==1)?true:false), true);
    $sbtpl->set("cond13", (($btit_settings["sb_radio_enable"]=="true" && $btit_settings["bonus_listen2radio"]>0 && $btit_settings["fmhack_shoutcast_stats_and_DJ_application"]=="enabled")?true:false), true);
    $sbtpl->set("cond14", (($btit_settings["bonus_listen2radio"]==1)?true:false), true);
    $sbtpl->set("cond15", (($btit_settings["fmhack_archive_torrents"]=="enabled" && $btit_settings["archive_enable"]=="true" && $btit_settings["bonus_archive"]>0)?true:false), true);
    $sbtpl->set("cond16", (($btit_settings["bonus_archive"]==1)?true:false), true);
    $sbtpl->set("bonus_min_uprate", $btit_settings["bonus_min_uprate"]);
    $sbtpl->set("bonus", $btit_settings["bonus"]);
    $sbtpl->set("bonus_mph", $btit_settings["bonus_max_per_hour"]);
    $sbtpl->set("bonus_upl", $btit_settings["bonus_upl"]);
    $sbtpl->set("bonus_upl_delay", $btit_settings["bonus_upl_delay"]);
    $sbtpl->set("bonus_comm", $btit_settings["bonus_comm"]);
    $sbtpl->set("bonus_forpost", $btit_settings["bonus_forpost"]);
    $sbtpl->set("bonus_make_a_shout", $btit_settings["bonus_make_a_shout"]);
    $sbtpl->set("bonus_listen2radio", $btit_settings["bonus_listen2radio"]);
    $sbtpl->set("bonus_archive", $btit_settings["bonus_archive"]);
    $sbtpl->set("approval_code", substr(sha1($CURUSER["random"].$CURUSER["username"].$CURUSER["random"]),20,6));
}

echo $sbtpl->fetch(load_template("sb.tpl"));

$module_out=ob_get_contents();
ob_end_clean();

?>
