<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
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

if (!defined("IN_ACP"))
      die("non direct access!");



if (!$CURUSER || $CURUSER["admin_access"]!="yes")
{
    stderr($language["ERROR"],$language["NOT_ADMIN_CP_ACCESS"]);
}
else
{
    $warnres=get_result("SELECT COUNT(*) `count` FROM `{$TABLE_PREFIX}users` WHERE `warn_lev`>0", true, $btit_settings["cache_duration"]);
    $count=$warnres[0]["count"];
    
    $perpage=(max(0,$CURUSER["torrentsperpage"])>0?$CURUSER["torrentsperpage"]:20);

    list($pagertop, $pagerbottom, $limit) = pager($perpage, $count, "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=warned_users&amp;");

    $admintpl->set("language",$language);
    $admintpl->set("pager_top",$pagertop);
    $admintpl->set("pager_bottom",$pagerbottom);
    $admintpl->set("need_pager_top", ((!isset($pagertop) || $pagertop=="")?false:true), true);
    $admintpl->set("need_pager_bottom", ((!isset($pagerbottom) || $pagerbottom=="")?false:true), true);

    $warnedres=get_result("SELECT `u`.`id`, `ul`.`prefixcolor`, `u`.`username`, `ul`.`suffixcolor`, `u`.`warn_lev`, `u`.`warn_last` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `u`.`warn_lev`>0 ORDER BY `u`.`warn_lev` DESC ".$limit,true,$btit_settings["cache_duration"]);
    $warn=array();
    $i=0;

    include("$THIS_BASEPATH/include/offset.php");

    if (count($warnedres)>0)
    {
        foreach($warnedres as $warnview)
        {
            if($btit_settings["warn_max"]==0)
                $btit_settings["warn_max"]=10;
            if($btit_settings["warn_auto_decrease"]==0)
                $btit_settings["warn_auto_decrease"]=10;

            $stage4=$btit_settings["warn_max"];
            $stage3=round($btit_settings["warn_max"]*0.75);
            $stage2=round($btit_settings["warn_max"]*0.5);
            $stage1=round($btit_settings["warn_max"]*0.25);
            $stage0=0;

            if($warnview["warn_lev"] >= $stage4)
                $warn[$i]["warnlevel"]="<a href='index.php?page=warnlog&id=".$warnview["id"]."'><img src='images/warned/warn_max.png' alt='".$warnview["warn_lev"]."/".$stage4."' title='".$warnview["warn_lev"]."/".$stage4."' /></a>";
            elseif($warnview["warn_lev"] >= $stage3)
                $warn[$i]["warnlevel"]="<a href='index.php?page=warnlog&id=".$warnview["id"]."'><img src='images/warned/warn_3.png' alt='".$warnview["warn_lev"]."/".$stage4."' title='".$warnview["warn_lev"]."/".$stage4."' /></a>";
            elseif($warnview["warn_lev"] >= $stage2)
                $warn[$i]["warnlevel"]="<a href='index.php?page=warnlog&id=".$warnview["id"]."'><img src='images/warned/warn_2.png' alt='".$warnview["warn_lev"]."/".$stage4."' title='".$warnview["warn_lev"]."/".$stage4."' /></a>";
            elseif($warnview["warn_lev"] >= $stage1)
                $warn[$i]["warnlevel"]="<a href='index.php?page=warnlog&id=".$warnview["id"]."'><img src='images/warned/warn_1.png' alt='".$warnview["warn_lev"]."/".$stage4."' title='".$warnview["warn_lev"]."/".$stage4."' /></a>";
            else
                $warn[$i]["warnlevel"]="<a href='index.php?page=warnlog&id=".$warnview["id"]."'><img src='images/warned/warn_0.png' alt='".$warnview["warn_lev"]."/".$stage4."' title='".$warnview["warn_lev"]."/".$stage4."' /></a>";

            $warn[$i]["username"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$warnview["id"]."_".strtr($warnview["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$warnview["id"])."'>".unesc($warnview["prefixcolor"].$warnview["username"].$warnview["suffixcolor"])."</a>";
            $warn[$i]["nextexpire"]=date("M j Y, g:i A", ($warnview["warn_last"]+($btit_settings["warn_auto_decrease"]*86400)));
            $i++;
        }
    }

    $admintpl->set("warns",$warn);

    unset($warnview);
    unset($warn);

}
?>