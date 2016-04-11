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
       err_msg($language["ERROR"],$language["NOT_ADMIN_CP_ACCESS"]);
       stdfoot();
       exit;
}
else
{
    $watchres=get_result("SELECT COUNT(*) `count` FROM `{$TABLE_PREFIX}watched_users` WHERE `uid`>0", true, $btit_settings["cache_duration"]);
    $count=$watchres[0]["count"];
    
    $perpage=(max(0,$CURUSER["torrentsperpage"])>0?$CURUSER["torrentsperpage"]:20);

    
    $admintpl->set("language",$language);
    
    
    $watchedres=get_result("SELECT `u`.`id`, `ul`.`prefixcolor`, `u`.`username`, `ul`.`suffixcolor` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `u`.`IS_WATCHED`='yes' ORDER BY `u`.`id` DESC ".$limit,true,$btit_settings["cache_duration"]);
    $watch=array();
    $i=0;

    

    if (count($watchedres)>0)
    {
        foreach($watchedres as $watchview)
        {
            
            $watch[$i]["username"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$watchview["id"]."_".strtr($watchview["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$watchview["id"])."'>".unesc($watchview["prefixcolor"].$watchview["username"].$watchview["suffixcolor"])."</a>";
           
            $i++;
        }
    }

    $admintpl->set("watch",$watch);

    unset($watchview);
    unset($watch);

}
?>