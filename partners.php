<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
//  Partners page by DiemThuy - Jan 2010
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

$partnerstpl=new bTemplate();
$partnerstpl->set("language",$language);

/* valid actions */
$action = (isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : ''));
$allowed_actions = array('addpartner', 'editpartner', 'deletepartner', 'main');
$action = (($action && in_array($action,$allowed_actions,true)) ? $action : '') or header("Location: index.php?page=partners&action=main");

$partnerstpl->set("action_main", false, true);
$partnerstpl->set("action_edit", false, true);
$partnerstpl->set("edit_torrents_1", (($CURUSER["edit_torrents"]=="yes")?true:false), true);
$partnerstpl->set("edit_torrents_2", (($CURUSER["edit_torrents"]=="yes")?true:false), true);
$partnerstpl->set("edit_torrents_3", (($CURUSER["edit_torrents"]=="yes")?true:false), true);
$partnerstpl->set("BASEURL", $BASEURL);
$partnerstpl->set("colspan", (($CURUSER["edit_torrents"]=="yes")?"5":"4"));

/*action == main */
if($action == "main")
{
    $partnerstpl->set("action_main", true, true);

    $query = get_result("SELECT `p`.`id`, `p`.`title`, `p`.`banner`, `p`.`link`, `p`.`addedby`, `u`.`username`, `ul`.`prefixcolor`, `ul`.`suffixcolor` FROM `{$TABLE_PREFIX}partner` `p` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `p`.`addedby`=`u`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id`", true, $btit_settings["cache_duration"]);
    $partners=array();
    $i=0;

    $partnerstpl->set("no_partners", ((count($query)==0)?true:false), true);

    if(count($query)>0)
    {
        foreach($query as $result)
        {
            $partners[$i]["id"]=$result["id"];
            $partners[$i]["title"]=htmlspecialchars($result["title"]);
            $partners[$i]["banner"]=htmlspecialchars($result["banner"]);
            $partners[$i]["link"]=$result["link"];
            $partners[$i]["username"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$result["addedby"]."_".strtr($result["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$result["addedby"])."'>".unesc($result["prefixcolor"].$result["username"].$result["suffixcolor"]);
            $i++;
        }
        $partnerstpl->set("partners",$partners);
    }
}

/*action == editpartner */
if($action == "editpartner" && $CURUSER["edit_torrents"]=="yes")
{
    $partnerstpl->set("action_edit", true, true);

    $id = (int)0+$_GET["id"];

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $title = sqlesc($_POST["title"]);
        $banner = sqlesc($_POST["banner"]);
        $link = sqlesc($_POST["link"]);
        quickQuery("UPDATE `{$TABLE_PREFIX}partner` SET `title`=$title, `banner`=$banner, `link`=$link WHERE `id`=".$id, true);
        header("Location: index.php?page=partners&action=main");
        die();
	}
	else
	{
        $query = get_result("SELECT `title`, `banner`, `link` FROM `{$TABLE_PREFIX}partner` WHERE `id`=".$id, true, $btit_settings["cache_duration"]);

        if(count($query)==0)
            stderr($language["ERROR"], $language["PAR_NO_PART_2"]);
        else
        {
            $partnerstpl->set("id", $id);
            $partnerstpl->set("title", htmlspecialchars($query[0]["title"]));
            $partnerstpl->set("banner", htmlspecialchars($query[0]["banner"]));
            $partnerstpl->set("link", htmlspecialchars($query[0]["link"]));
        }
    }
}

//action == addpartner
if ($action == "addpartner" && $CURUSER["edit_torrents"]=="yes")
{
    $userid = (int)$CURUSER["uid"];

    $title = $_POST["title"];
    $banner = $_POST["banner"];
    $link = $_POST["link"];

    quickQuery("INSERT INTO `{$TABLE_PREFIX}partner` (`title`, `banner`, `link`, `addedby`) VALUES(".sqlesc($title).", ".sqlesc($banner).", ".sqlesc($link).", ".sqlesc($userid).")", true);
    header("Location: index.php?page=partners");
    die();
}

//action == deletepartner
if ($action == "deletepartner" && $CURUSER["edit_torrents"]=="yes")
{
    $id = (int)0+$_GET["id"];

	if (!$id)
    {
        header("Location: index.php?page=partners");
        die();
    }
    quickQuery("DELETE FROM `{$TABLE_PREFIX}partner` where `id`=".$id, true);

	header("Location: index.php?page=partners");
	die();
}

?>