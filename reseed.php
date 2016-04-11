<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
// Ask for reseed by CobraCRK - converted to XBTIT-2 by DiemThuy - Dec 2008
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


$hash=sql_esc(strtolower(preg_replace("/[^A-Fa-f0-9]/", "", $_GET["q"])));

if(strlen($hash)!=40)
{
    stderr($language["ERROR"],$language['INVALID_INFO_HASH']);
}

$res=do_sqlquery("SELECT `language_url` FROM `{$TABLE_PREFIX}language` WHERE `id`=".$CURUSER["language"], true);
$row=$res->fetch_assoc();

$userlang=$row["language_url"];

if($XBTT_USE)
    $res=do_sqlquery("SELECT ".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?"`f`.`id` `fileid`, ":"")."`f`.`reseed`, `f`.`filename`, `x`.`fid` FROM `{$TABLE_PREFIX}files` `f` INNER JOIN `xbt_files` `x` ON `f`.`bin_hash`=`x`.`info_hash` WHERE `f`.`info_hash`='".$hash."'", true);
else
    $res=do_sqlquery("SELECT ".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?"`id` `fileid`, ":"")."`reseed`, `filename` FROM `{$TABLE_PREFIX}files` WHERE `info_hash`='".$hash."'", true);

if(@sql_num_rows($res)==1)
{
    $row=$res->fetch_assoc();

    if((time()-$row["reseed"])>=($btit_settings["reseed_minDaysSinceLast"]*86400))
    {
        $msg=sqlesc($language["AFR_PM_1"]."\n\n[url=".$BASEURL."/".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated"]=="true")?strtr($row["filename"], $res_seo["str"], $res_seo["strto"])."-".$row["fileid"].".html":"index.php?page=torrent-details&id=".$hash)."]".$row["filename"]."[/url]\n\n".$language["AFR_PM_2"]." ".$CURUSER["username"]." ".$language["AFR_PM_3"]);

        if($XBTT_USE)
            $r=do_sqlquery("SELECT `h`.`uid`, `l`.`language_url` FROM `xbt_files_users` `h` INNER JOIN `{$TABLE_PREFIX}users` `u` ON `h`.`uid`=`u`.`id` INNER JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language` = `l`.`id` WHERE `h`.`active`=0 AND `h`.`completed`=1 AND `h`.`fid`='".$row["fid"]."' ORDER BY `l`.`language_url` ASC", true);
        else
            $r=do_sqlquery("SELECT `h`.`uid`, `l`.`language_url` FROM `{$TABLE_PREFIX}history` `h` INNER JOIN `{$TABLE_PREFIX}users` `u` ON `h`.`uid`=`u`.`id` INNER JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language` = `l`.`id` WHERE `h`.`active`='no' AND `h`.`completed`='yes' AND `h`.`infohash`='".$hash."' ORDER BY `l`.`language_url` ASC", true);

        $firstrun=1;
        $englang="language/english";
        $templang=$englang;
        if($userlang!=$englang)
            require_once($THIS_BASEPATH."/".$englang."/lang_main.php");

        while($row = $r->fetch_array())
        {
            if($row["language_url"]!=$templang)
            {
                if($firstrun!=1)
                {
                    // Reset the language to English before loading the new language
                    require_once($THIS_BASEPATH."/".$englang."/lang_main.php");
                }
                // Load the new language etc.
                require_once($THIS_BASEPATH."/".$row["language_url"]."/lang_main.php");
                $templang=$row["language_url"];
                $firstrun=0;
            }
            send_pm(0,$row["uid"],sqlesc($language["AFR_PM_SUBJ"]),$msg);
        }
   	    quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `reseed`=UNIX_TIMESTAMP() WHERE `info_hash`='".$hash."'", true);

        if($templang!=$userlang)
        {
            if($userlang!=$englang)
                require_once($THIS_BASEPATH."/".$englang."/lang_main.php");
            require_once($THIS_BASEPATH."/".$userlang."/lang_main.php");
        }

        information_msg($language["AFR_INFO_1"],$language["AFR_INFO_2"]);
        stdfoot();
        exit();
    }
    else
    {
        stderr($language["AFR_ERR_1"],$language["AFR_ERR_2"]);
    }
}
else
{
    stderr($language["ERROR"],$language['INVALID_INFO_HASH']);
}

?>
