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

function category_read()
{
    global $admintpl, $language, $STYLEURL, $CURUSER, $STYLEPATH, $btit_settings;
    $admintpl->set("language", $language);

    $cres = genrelist();
    for ($i = 0; $i < count($cres); $i++)
    {
        $cres[$i]["frm_number"] = "form" . $i;
        $cres[$i]["name"] = unesc($cres[$i]["name"]);
        $cres[$i]["image"] = "<img src=\"$STYLEURL/images/categories/" . $cres[$i]["image"] .
            "\" alt=\"\" border=\"0\" />";
        $cres[$i]["smf_select"] = get_forum_list($cres[$i]["forumid"], $cres[$i]["id"]);
    }
    $admintpl->set("categories", $cres);
    unset($cres);
}

$redirect = "index.php?page=admin&user=" . $CURUSER["uid"] . "&code=" . $CURUSER["random"] .
    "&do=smf_select&action=read";

$admintpl->set("frm1_action", "index.php?page=admin&amp;user=" . $CURUSER["uid"] .
    "&amp;code=" . $CURUSER["random"] . "&amp;do=smf_select&amp;action=activate");
$admintpl->set("frm2_action", "index.php?page=admin&amp;user=" . $CURUSER["uid"] .
    "&amp;code=" . $CURUSER["random"] . "&amp;do=smf_select&amp;action=update");

switch ($action)
{
    case 'activate':
        $autotopic = $_POST["autotopic"];
        $tagtopic = $_POST["tagtopic"];
        quickQuery("UPDATE {$TABLE_PREFIX}settings SET `value`='" . $autotopic .
            "' WHERE `key`='smf_autotopic'") or sqlerr(__file__, __line__);
        quickQuery("UPDATE {$TABLE_PREFIX}settings SET `value`='" . $tagtopic .
            "' WHERE `key`='smf_tag'") or sqlerr(__file__, __line__);
        redirect($redirect);
        break;

    case 'update':
        quickQuery("UPDATE {$TABLE_PREFIX}categories SET forumid=" . $_POST["forumid"] .
            " WHERE id='" . $_POST["cid"] . "'") or sqlerr(__file__, __line__);
        redirect($redirect);
        break;

    case '':
    case 'read':
    default:
        $btit_settings = get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}settings") or
            sqlerr(__file__, __line__);
        if ($btit_settings["smf_autotopic"] == "true")
        {
            $btit_settings["topicon"] = " checked=\"checked\"";
            $btit_settings["topicoff"] = "";
        }
        else
        {
            $btit_settings["topicon"] = "";
            $btit_settings["topicoff"] = " checked=\"checked\"";
        }
        $btit_settings["smftag"] = isset($btit_settings["smf_tag"]) ? $btit_settings["smf_tag"]:
        "";
        $admintpl->set("config", $btit_settings);
        category_read();
}

?>