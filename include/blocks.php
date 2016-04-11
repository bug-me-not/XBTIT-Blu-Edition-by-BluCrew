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
global $USERLANG;
require_once (load_language('lang_blocks.php'));
function get_menu($pos)
{
    global $TABLE_PREFIX, $CURUSER, $FORUMLINK, $CACHE_DURATION, $language, $btit_settings;
    $min_perm = $CURUSER["id_level"].">=`minclassview`";
    $max_perm = $CURUSER["id_level"]."<=`maxclassview`";
    if($btit_settings["fmhack_logical_rank_ordering"] == "enabled")
    {
        $min_perm = "IF(`use_lro`='yes', ".$CURUSER["logical_rank_order"].">=`lro_minclassview`, ".$CURUSER["id_level"].">= `minclassview`)";
        $max_perm = "IF(`use_lro`='yes', ".$CURUSER["logical_rank_order"]."<=`lro_maxclassview`, ".$CURUSER["id_level"]."<= `maxclassview`)";
    }
    $blocks = get_result("SELECT `title`, `content`, `cache` FROM `{$TABLE_PREFIX}blocks` WHERE `position`='".$pos."' AND `status`=1 AND ".$min_perm." AND ".$max_perm.(($FORUMLINK == "" || $FORUMLINK == "internal" || substr($FORUMLINK, 0, 3) == "smf" || $FORUMLINK == "ipb")?"":" AND content!='forum'")." ORDER BY `sortid`", true, $CACHE_DURATION);
    $return = "";
    foreach($blocks as $entry)
        $return .= get_block($language[$entry['title']], 'justify', $entry['content'], $entry['cache'] == 'yes');
    return $return;
}
function main_menu()
{
    global $TABLE_PREFIX, $CURUSER, $tpl, $btit_settings;
    $min_perm = $CURUSER["id_level"].">=`minclassview`";
    $max_perm = $CURUSER["id_level"]."<=`maxclassview`";
    if($btit_settings["fmhack_logical_rank_ordering"] == "enabled")
    {
        $min_perm = "IF(`use_lro`='yes', ".$CURUSER["logical_rank_order"].">=`lro_minclassview`, ".$CURUSER["id_level"].">= `minclassview`)";
        $max_perm = "IF(`use_lro`='yes', ".$CURUSER["logical_rank_order"]."<=`lro_maxclassview`, ".$CURUSER["id_level"]."<= `maxclassview`)";
    }
    $blocks = get_result("SELECT `content` FROM `{$TABLE_PREFIX}blocks` WHERE `position`='t' AND `status`=1 AND ".$min_perm."  AND ".$max_perm.(($FORUMLINK == "" || $FORUMLINK == "internal" || substr($FORUMLINK, 0, 3) == "smf" || $FORUMLINK == "ipb")?"":" AND content!='forum'")." ORDER BY `sortid`", true, $CACHE_DURATION);
    $return = "";
    foreach($blocks as $entry)
        $return .= get_content(realpath(dirname(__file__).'/..').'/blocks/'.$entry['content'].'_block.php');
    return set_block('', 'justify', $return);
}
function dropdown_menu()
{
    return get_menu('d');
}
function extra_menu()
{
    return get_menu('e');
}
function altlogin_menu()
{
    return get_menu('k');
}
function adarea_menu()
{
    return get_menu('a');
}
function center_menu()
{
    return get_menu('c');
}
function side_menu()
{
    return get_menu('l');
}
function right_menu()
{
    return get_menu('r');
}
function bottom_menu()
{
    return get_menu('b');
}

?>