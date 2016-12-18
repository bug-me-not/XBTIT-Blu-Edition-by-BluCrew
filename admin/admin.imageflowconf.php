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
if(!defined("IN_BTIT"))
    die("non direct access!");

if(!defined("IN_ACP"))
    die("non direct access!");



$admintpl->set("priority1_iu", true, true);
$admintpl->set("priority1_imdb", false, true);
$admintpl->set("priority1_tvdb", false, true);
$admintpl->set("priority2_iu", false, true);
$admintpl->set("priority2_imdb", true, true);
$admintpl->set("priority2_tvdb", false, true);
$admintpl->set("priority3_iu", false, true);
$admintpl->set("priority3_imdb", false, true);
$admintpl->set("priority3_tvdb", true, true);
$admintpl->set("std_checked", false, true);
$admintpl->set("imdb_checked", false, true);

$action = $_GET['action'];
$returnto = "index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=imageflow_settings";

if($action == 'send')
{
    $priority1=(isset($_POST["priority1"]) && is_numeric($_POST["priority1"])) ? intval(0+$_POST["priority1"]) : false;
    $priority2=(isset($_POST["priority2"]) && is_numeric($_POST["priority2"])) ? intval(0+$_POST["priority2"]) : false;
    $priority3=(isset($_POST["priority3"]) && is_numeric($_POST["priority3"])) ? intval(0+$_POST["priority3"]) : false;
    if($priority1===false || $priority2===false || $priority3===false)
    {
        stderr($language["ERROR"], $language["TVDB_PRIORITY_ERR1"]);
    }
    elseif($priority1==$priority2 || $priority1==$priority3 || $priority2==$priority3)
    {
        stderr($language["ERROR"], $language["TVDB_PRIORITY_ERR2"]);
    }
    $settings["imageflow_priority"] = $priority1.",".$priority2.",".$priority3;
    $settings["imageflow_cats"] = implode(",", $_POST["imageflow_cats"]);
    $settings["imageflow_limit"]=intval(0+$_POST["imageflow_limit"]);

    foreach($settings as $key => $value)
    {
        if(is_bool($value))
            $value == true?$value = 'true':$value = 'false';
        $values[] = "(".sqlesc($key).",".sqlesc($value).")";
    }

    $Match = "imageflow_";
    quickQuery("DELETE FROM {$TABLE_PREFIX}settings WHERE `key` LIKE '%".$Match."%'", true);
    quickQuery("INSERT INTO {$TABLE_PREFIX}settings (`key`,`value`) VALUES ".implode(",", $values).";", true);
    header("Location: $BASEURL/$returnto");
}
else
{
    $Match = "imageflow_";
    $btit_settings = get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}settings where `key` LIKE '".$Match."%'");
    $admintpl->set("language", $language);
    $admintpl->set("frm_action", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=imageflow_settings&amp;action=send");
    $admintpl->set("config", $btit_settings);
    
   
    if($btit_settings["imageflow_priority"]=="imdb" || $btit_settings["imageflow_priority"]=="std" || $btit_settings["imageflow_priority"]=="")
    {
    }
    else
    {
        $priority_order=explode(",", $btit_settings["imageflow_priority"]);
        $admintpl->set("priority1_iu", (($priority_order[0]==1)?true:false), true);
        $admintpl->set("priority1_imdb", (($priority_order[0]==2)?true:false), true);
        $admintpl->set("priority1_tvdb", (($priority_order[0]==3)?true:false), true);
        $admintpl->set("priority2_iu", (($priority_order[1]==1)?true:false), true);
        $admintpl->set("priority2_imdb", (($priority_order[1]==2)?true:false), true);
        $admintpl->set("priority2_tvdb", (($priority_order[1]==3)?true:false), true);
        $admintpl->set("priority3_iu", (($priority_order[2]==1)?true:false), true);
        $admintpl->set("priority3_imdb", (($priority_order[2]==2)?true:false), true);
        $admintpl->set("priority3_tvdb", (($priority_order[2]==3)?true:false), true);
    }
    $catr = get_result('SELECT * FROM '.$TABLE_PREFIX.'categories WHERE id NOT IN (SELECT sub FROM '.$TABLE_PREFIX.'categories WHERE sub>0) ORDER BY sort_index, id', true, $CACHE_DURATION);
    $cat_checks = '';

    if(count($catr))
    {
        $bl = 0;
        $cat_checks .= '<table><tr>';
        foreach($catr as $cid => $catd)
        {
            $list = explode(",", $btit_settings['imageflow_cats']);
            $bl++;
            $cat_checks .= '<td><input type="checkbox" name="imageflow_cats[]" '.(in_array($catd['id'], $list, true)?'checked="checked"':'').'value="'.$catd['id'].'" />&nbsp;'.$catd['name']."</td>\n";
            if($bl % 8 == 0)
                $cat_checks .= '</tr><tr>';
        }
        while($bl % 8 != 0)
        {
            $cat_checks .= '<td>&nbsp;</td>';
            $bl++;
        }
        $cat_checks .= '</tr></table><br />';
    }
    // end category checks
    $admintpl->set("category_checks", $cat_checks);
}

?>