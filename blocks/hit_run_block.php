<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file ( HIT and RUN block by DiemThuy - april 2009 ) is part of xbtit.
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

global $btit_settings, $TABLE_PREFIX, $XBTT_USE, $language, $res_seo;


    $limit=((isset($btit_settings["hitnumber"]) && is_numeric($btit_settings["hitnumber"]) && $btit_settings["hitnumber"] >0)?$btit_settings["hitnumber"]:2);

    if($XBTT_USE)
    {
        $res=get_result("SELECT `fu`.`uid` `id`, `u`.`username`, LOWER(HEX(`xf`.`info_hash`)) `infohash`, `f`.`filename`, `ul`.`prefixcolor`, `ul`.`suffixcolor`, `fu`.`mtime` `date` FROM `xbt_files_users` `fu` INNER JOIN `{$TABLE_PREFIX}users` `u` ON `fu`.`uid`=`u`.`id` INNER JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` INNER JOIN `xbt_files` `xf` ON `xf`.fid = `fu`.`fid` INNER JOIN `{$TABLE_PREFIX}files` `f` ON `xf`.`info_hash` =`f`.`bin_hash` WHERE `fu`.`hit` ='yes' ORDER BY `fu`.`completed_time` DESC LIMIT ".$limit,true,$btit_settings["cache_duration"] );
    }
    else
    {
        $res=get_result("SELECT `u`.`id`, `u`.`username`, `h`.`infohash`, `f`.`filename`, `ul`.`prefixcolor`, `ul`.`suffixcolor`, `h`.`date` FROM `{$TABLE_PREFIX}history` `h` INNER JOIN `{$TABLE_PREFIX}users` `u` ON `h`.`uid`=`u`.`id` INNER JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` INNER JOIN `{$TABLE_PREFIX}files` `f` ON `h`.`infohash` =`f`.`info_hash` WHERE `h`.`hit` ='yes' ORDER BY `h`.`date` DESC LIMIT ".$limit,true,$btit_settings["cache_duration"]);
    }
    if(count($res)>0)
    {
        echo "<table class=lista border=0 align=center>";
        foreach($res as $row)
        {
            echo "<tr><td width=15% class=lista><center><span style='color:red'>".$language["USER"].":</span> <a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$row["id"]."_".strtr($row["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$row["id"])."'>" . unesc($row["prefixcolor"] . $row["username"] . $row["suffixcolor"]) . " <img src='images/warn.gif' border=0></a></center></td></tr>";
            echo "<tr><td width=15% class=header><center>".$language["HNR_EVENT_DATE"]."</center></td></tr>";
            echo "<tr><td><center><a href=index.php?page=details&id=".$row["infohash"].">".trim(str_replace("."," ",$row["filename"]), " ")."</a></center></td></tr>";

            include("include/offset.php");
            echo "<tr><td class=lista ><center>".$language["DATE"].": ".date("d/m/Y",$row["date"]-$offset)."</center></td></tr>";
            echo "<tr><td class=block >&nbsp;</td></tr>";
        }
        echo "<tr><td class=lista ><center>";
        echo "<marquee onmouseover=this.stop() onmouseout=this.start()  scrollAmount=2 direction=left >";
        echo "<span style='color:red;font-size:120%'><b>" . $btit_settings["scrol_tekst"] . "</b></span>";
        echo "</marquee></center>";
        echo"</td></tr></table>";
    }
    else
    {
        echo "<table border=0 align=center width=100%>\n<tr>\n<td class='blocklist' align='center'>".$language["NO_HR"]."</td>\n</tr>\n</table>";
    }


?>