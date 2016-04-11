<?php

if(!defined("IN_BTIT"))
    die('non direct access!');



(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"]>1) ? $id=(int)0+$_GET["id"] : $id=1;

if($id==1)
    stderr($language["ERROR"],$language["BAD_ID"]);

if($CURUSER["uid"]==$id || $CURUSER['edit_users']=='yes')
{
    if(!isset($language["SYSTEM_USER"]))
        $language["SYSTEM_USER"]="System";
    $warnlogtpl=new btemplate();
    $warnlogtpl->set("language", $language);
    $warnlogtpl->set("pagertop_needed",false,true);
    $warnlogtpl->set("pagerbottom_needed",false,true);
    
    $res=get_result("SELECT COUNT(*) `count` FROM `{$TABLE_PREFIX}warn_logs` WHERE `uid`=".$id,true,$btit_settings["cache_duration"]);
    $count=$res[0]["count"];
    $perpage=(($CURUSER["torrentsperpage"]>0)?$CURUSER["torrentsperpage"]:15);
    list($pagertop, $pagerbottom, $limit) = pager($perpage, $count, "index.php?page=warnlog&amp;id=$id&amp;");
    if($pagertop)
    {
        $warnlogtpl->set("pagertop_needed",true,true);
        $warnlogtpl->set("pagertop",$pagertop);
    }
    if($pagerbottom)
    {
        $warnlogtpl->set("pagerbottom_needed",true,true);
        $warnlogtpl->set("pagerbottom",$pagerbottom);
    }

    $res=get_result("SELECT `wl`.`uid` `warned_id`,`ul1`.`prefixcolor` `warned_prefixcolor`, `u1`.`username` `warned_username`, `ul1`.`suffixcolor` `warned_suffixcolor`, `u1`.`warn_lev` `warned_warn_lev`, `wl`.`notes`, `wl`.`contact`, `wl`.`date_added`, `wl`.`type`, `wl`.`added_by` `warner_id`, `ul2`.`prefixcolor` `warner_prefixcolor`, `u2`.`username` `warner_username`, `ul2`.`suffixcolor` `warner_suffixcolor` FROM `{$TABLE_PREFIX}warn_logs` `wl` LEFT JOIN `{$TABLE_PREFIX}users` `u1` ON `wl`.`uid`=`u1`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul1` ON `u1`.`id_level`=`ul1`.`id` LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `wl`.`added_by`=`u2`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul2` ON `u2`.`id_level`=`ul2`.`id` WHERE `wl`.`uid`=".$id." ORDER BY `wl`.`date_added` DESC ".$limit,true,$btit_settings["cache_duration"]);

    if(count($res)>0)
    {
        $warnlogtpl->set("found_rows",true,true);

        $stage4=$btit_settings["warn_max"];
        $stage3=round($btit_settings["warn_max"]*0.75);
        $stage2=round($btit_settings["warn_max"]*0.5);
        $stage1=round($btit_settings["warn_max"]*0.25);
        $stage0=0;

        if($res[0]["warned_warn_lev"] >= $stage4)
            $warnlogtpl->set("w_level" , "<img src='images/warned/warn_max.png' alt='".$res[0]["warned_warn_lev"]."/".$stage4."' title='".$res[0]["warned_warn_lev"]."/".$stage4."' />");
        elseif($res[0]["warned_warn_lev"] >= $stage3)
            $warnlogtpl->set("w_level" , "<img src='images/warned/warn_3.png' alt='".$res[0]["warned_warn_lev"]."/".$stage4."' title='".$res[0]["warned_warn_lev"]."/".$stage4."' />");
        elseif($res[0]["warned_warn_lev"] >= $stage2)
            $warnlogtpl->set("w_level" , "<img src='images/warned/warn_2.png' alt='".$res[0]["warned_warn_lev"]."/".$stage4."' title='".$res[0]["warned_warn_lev"]."/".$stage4."' />");
        elseif($res[0]["warned_warn_lev"] >= $stage1)
            $warnlogtpl->set("w_level" , "<img src='images/warned/warn_1.png' alt='".$res[0]["warned_warn_lev"]."/".$stage4."' title='".$res[0]["warned_warn_lev"]."/".$stage4."' />");
        else
            $warnlogtpl->set("w_level" , "<img src='images/warned/warn_0.png' alt='".$res[0]["warned_warn_lev"]."/".$stage4."' title='".$res[0]["warned_warn_lev"]."/".$stage4."' />");

        $warnlogtpl->set("w_level_expire" , (($btit_settings["warn_auto_down_enable"]=="yes" && $res[0]["warned_warn_lev"]>0)?date("M j Y, g:i A", ($res[0]["date_added"]+($btit_settings["warn_auto_decrease"]*86400))):$language["NA"]));

        $warnlogtpl->set("warn_user", "<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$id."_".strtr($res[0]["warned_username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$id)."'>".unesc($res[0]["warned_prefixcolor"].$res[0]["warned_username"].$res[0]["warned_suffixcolor"])."</a>");


        foreach($res as $key => $value)
        {
            $output[$key]["warned_user"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$id."_".strtr($value["warned_username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$id)."'>".unesc($value["warned_prefixcolor"].$value["warned_username"].$value["warned_suffixcolor"])."</a>";
            $output[$key]["warner_user"]= (($value["warner_id"]==0)?$language["SYSTEM_USER"]:"<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$value["warner_id"]."_".strtr($value["warner_username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$value["warner_id"])."'>".unesc($value["warner_prefixcolor"].$value["warner_username"].$value["warner_suffixcolor"])."</a>");
            $output[$key]["date_added"]=date("M j Y, g:i A", $value["date_added"]);
            $output[$key]["notes"]=format_comment($value["notes"]);
            $output[$key]["contact"]=$value["contact"];
            $output[$key]["type"]=(($value["type"]=="inc")?"<span style='color:red'>".$language["WS_INC_WL"]."</span>":"<span style='color:green'>".$language["WS_DEC_WL"]."</span>");
            $output[$key]["type2"]=(($value["type"]=="inc")?$language["WS_WARNED_ON"]:$language["WS_REP_ON"]);
            $output[$key]["type3"]=(($value["type"]=="inc")?$language["WS_WARNED_BY"]:$language["WS_REP_BY"]);
        }
        $warnlogtpl->set("myloop", $output);
    }
    else
    {
        $warnlogtpl->set("found_rows",false,true);
        $res=get_result("SELECT `u`.`id`, `u`.`username`, `ul`.`prefixcolor`, `ul`.`suffixcolor` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `u`.`id`=".$id,true,$btit_settings["cache_duration"]);
        $warnlogtpl->set("warn_user", "<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$id."_".strtr($res[0]["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$id)."'>".unesc($res[0]["prefixcolor"].$res[0]["username"].$res[0]["suffixcolor"])."</a>");
    }
}
else
{
    stderr($language["ERROR"],$language['TR_UNAUTH']);
}

?>