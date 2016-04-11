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
    $bootedres=do_sqlquery("SELECT COUNT(*) FROM `{$TABLE_PREFIX}users` WHERE booted='yes'");
    $bootednum=$bootedres->fetch_row();
    $num2=$bootednum[0];
    $perpage=(max(0,$CURUSER["postsperpage"])>0?$CURUSER["postsperpage"]:20);
    list($pagertop, $pagerbottom, $limit) = pager($perpage, $num2, "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=booted_users&amp;");

    $admintpl->set("language",$language);
    $admintpl->set("pager_top",$pagertop);
    $admintpl->set("pager_bottom",$pagerbottom);

    $booted1res=do_sqlquery("SELECT `u1`.`id` `booted_id`, `ul1`.`prefixcolor` `booted_prefixcolor`, `u1`.`username` `booted_username`, `ul1`.`suffixcolor` `booted_suffixcolor`, `u2`.`id` `booter_id`, `ul2`.`prefixcolor` `booter_prefixcolor`,  `u1`.`whobooted` `booter_username`, `ul2`.`suffixcolor` `booter_suffixcolor`, UNIX_TIMESTAMP(`u1`.`addbooted`) `boot_expire`, `u1`.`whybooted` `boot_reason` FROM `{$TABLE_PREFIX}users` `u1` LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `u1`.`whobooted`=`u2`.`username` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul1` ON `u1`.`id_level`=`ul1`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul2` ON `u2`.`id_level`=`ul2`.`id` WHERE `u1`.`booted`='yes' ORDER BY `u1`.`addbooted` DESC $limit");
    $booted=array();
    $i=0;

    include("$THIS_BASEPATH/include/offset.php");

    if ($booted1res)
    {
        while ($warnview=$booted1res->fetch_assoc())
        {
            $boot[$i]["username"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$warnview["booted_id"]."_".strtr($warnview["booted_username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$warnview["booted_id"])."'>".stripslashes($warnview["booted_prefixcolor"] . $warnview["booted_username"] . $warnview["booted_prefixcolor"])."</a>";
            $boot[$i]["addbooted"]=date('d/m/Y \a\\t H:i',$warnview["boot_expire"]-$offset);
            $boot[$i]["whybooted"]=$warnview["boot_reason"];
            $boot[$i]["whobooted"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$warnview["booter_id"]."_".strtr($warnview["booter_username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$warnview["booter_id"])."'>".stripslashes($warnview["booter_prefixcolor"] . $warnview["booter_username"] . $warnview["booter_prefixcolor"])."</a>";
            $i++;
        }
    }

    $admintpl->set("boots",$boot);

    unset($warnview);
    $booted1res->free();
    unset($booted);

}
?>
