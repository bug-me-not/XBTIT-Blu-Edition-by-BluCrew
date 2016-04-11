<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  XBtiteam
//
//    This file is part of xbtit.
//
// Reencoding hack by DiemThuy - Jan 2011
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
if(isset($_POST["infohashb"]))
{
    $THIS_BASEPATH = dirname(__file__);
    require_once ($THIS_BASEPATH."/include/functions.php");
    if(!isset($CURUSER) || !is_array($CURUSER))
    {
        session_name("Blu-torrents");
        session_start();
        $CURUSER = $_SESSION["CURUSER"];
    }
    include (load_language("lang_torrents.php"));
    $uid = intval(0 + $CURUSER['uid']);
    if(preg_match("/([a-z0-9]{40})/", $_POST['infohashb']))
    {
        $infohash = ($_POST["infohashb"]);
    }
    else
    {
        die('Hacking Attempt!');
    }
    if($btit_settings["fmhack_SEO_panel"] == "enabled")
    {
        $active_seo_sb = get_result("SELECT `activated_user`, `str`, `strto` FROM `{$TABLE_PREFIX}seo` WHERE `id`='1'", true, $btit_settings["cache_duration"]);
        $res_seo_sb = $active_seo_sb[0];
    }
    $outb = "";
    $rt = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}files_reencodeb WHERE infohash=$infohash");
    // not filled yet
    if(sql_num_rows($rt) == 0)
        $button = true;
    else
        $button = false;
    // I offer
    if(isset($_POST["reencodeb"]) && $button)
    {
        $rt->free();
        $rt = do_sqlquery("SELECT userid FROM {$TABLE_PREFIX}files_reencodeb WHERE userid=$uid AND infohash=$infohash");
        // never offered to reencode this file
        if(sql_num_rows($rt) == 0)
        {
            @quickQuery("INSERT INTO {$TABLE_PREFIX}files_reencodeb (infohash, userid) VALUES ($infohash, $uid)");
        }
    }
    $rt->free();
    $rt = do_sqlquery("SELECT u.id, u.username, ul.prefixcolor, ul.suffixcolor FROM {$TABLE_PREFIX}files_reencodeb t LEFT JOIN
                   {$TABLE_PREFIX}users u ON u.id=t.userid LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE infohash=$infohash");
    if(sql_num_rows($rt) == 0)
        $out = $language["REENCODE_BE_FIRST"];
    while($tyt = $rt->fetch_assoc())
    {
        if($tyt["id"] == $uid) // already offered

            $button = false;
        $outb .= "<a href=\"".$BASEURL."/".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated_user"] == "true")?$tyt["id"]."_".strtr($tyt["username"], $res_seo["str"], $res_seo["strto"]).
            ".html":"index.php?page=userdetails&id=".$tyt["id"])."\">".unesc($tyt["prefixcolor"].$tyt["username"].$tyt["suffixcolor"])."</a> ";
    }
    if($button && $CURUSER["uid"] > 1)
        $outb .= "|0";
    else
        $outb .= "|1";
}
else
    $outb = "no direct access!";
echo $outb;
die;

?>