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
function blocks_combo($current_block = "")
{
    global $THIS_BASEPATH, $language;
    $dir = @opendir("$THIS_BASEPATH/blocks/");
    $ret = "\n<select name=\"block_name\" size=\"1\">\n<option value=\"\" ".($current_block == ""?"selected=\"selected\"":"").">".$language["SELECT"]."</option>";
    while($file = @readdir($dir))
    {
        if(@is_file("$THIS_BASEPATH/blocks/".$file) && $file != "index.php")
        {
            $content = str_replace(array("_block", ".php"), "", $file);
            $ret .= "\n<option value=\"$content\" ".($current_block == $content?"selected=\"selected\"":"").">$file</option>";
        }
    }
    @closedir($dir);
    $ret .= "\n</select>";
    return $ret;
}
function read_blocks()
{
    global $TABLE_PREFIX, $language, $admintpl, $CURUSER, $USERLANG, $STYLEPATH, $btit_settings;
    require_once (load_language("lang_blocks.php"));
    $br = get_result("SELECT * FROM {$TABLE_PREFIX}blocks ORDER BY sortid", true);
    $tops = array();
    $dropdown = array();
    $extras = array();
		$altlogin = array();
    $adarea = array();
    $lefts = array();
    $centers = array();
    $rights = array();
    $bottom = array();
    $t = 0;
    $d = 0;
    $e = 0;
		$k = 0;
    $a = 0;
    $l = 0;
    $c = 0;
    $r = 0;
    $b = 0;
    $query1_select="";
    $query1_order="id_level";
    $query1_where="WHERE `id`>=1 AND `id`<=8";
    if($btit_settings["fmhack_logical_rank_ordering"]=="enabled")
    {
        $query1_select.=", logical_rank_order, id";
        $query1_order="logical_rank_order";
        $query1_where="";
    }
    $rlevel = do_sqlquery("SELECT `id_level`, `predef_level`, `level`".$query1_select." FROM `{$TABLE_PREFIX}users_level` ".$query1_where." ORDER BY ".$query1_order." ASC");
    $alevel = array();
    while($reslevel =$rlevel->fetch_assoc())
        $alevel[] = $reslevel;
    foreach($br as $id => $blk)
    {
        switch($blk["position"])
        {
            case 't':
                $tops[$t]["pos"] = "\n<select name=\"position_".$blk["blockid"]."\" size=\"1\">";
                $tops[$t]["pos"] .= "\n<option selected=\"selected\" value=\"t\">".$language["TOP"]."</option>";
                $tops[$t]["pos"] .= "\n<option value=\"d\">".$language["DROPDOWN"]."</option>";
                $tops[$t]["pos"] .= "\n<option value=\"e\">".$language["EXTRA"]."</option>";
                $tops[$t]["pos"] .= "\n<option value=\"k\">".$language["ALTLOGIN"]."</option>";
								$tops[$t]["pos"] .= "\n<option value=\"a\">".$language["ADAREA"]."</option>";
                $tops[$t]["pos"] .= "\n<option value=\"l\">".$language["LEFT"]."</option>";
                $tops[$t]["pos"] .= "\n<option value=\"c\">".$language["CENTER"]."</option>";
                $tops[$t]["pos"] .= "\n<option value=\"r\">".$language["RIGHT"]."</option>";
                $tops[$t]["pos"] .= "\n<option value=\"b\">".$language["BOTTOM"]."</option>";
                $tops[$t]["pos"] .= "\n</select>";
                $tops[$t]["combo_min_view"] = "\n<select name=\"minclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $tops[$t]["combo_min_view"] .= "\n<option value=\"".$level["id_level"].($blk["minclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $tops[$t]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["minclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $tops[$t]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_minclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $tops[$t]["combo_min_view"] .= "\n</select>";
                $tops[$t]["combo_max_view"] = "\n<select name=\"maxclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $tops[$t]["combo_max_view"] .= "\n<option value=\"".$level["id_level"].($blk["maxclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $tops[$t]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["maxclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $tops[$t]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_maxclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $tops[$t]["combo_max_view"] .= "\n</select>";
                $tops[$t]["combo"] = "\n<select name=\"sort_".$blk["blockid"]."\" size=\"1\">";
                for($i = 0; $i < count($br); $i++)
                $tops[$t]["combo"] .= "\n<option value=\"$i\" ".($i == $blk["sortid"]?"selected=\"selected\"":"").">$i</option>";
                $tops[$t]["combo"] .= "\n</select>";
                $tops[$t]["status"] = $blk["status"];
                $tops[$t]["title"] = $language[$blk["title"]]."&nbsp;&nbsp;<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=blocks&amp;action=edit&amp;id=".$blk["blockid"].
                    "\">".image_or_link("$STYLEPATH/images/edit.png", "", $language["EDIT"])."</a>";
                $tops[$t]["check"] = "<input name=\"status_".$blk["blockid"]."\" type=\"checkbox\" ".($blk["status"] == "1"?"checked=\"checked\"":"")." />";
                $t++;
                break;

            case 'd':
                $dropdown[$d]["pos"] = "\n<select name=\"position_".$blk["blockid"]."\" size=\"1\">";
                $dropdown[$d]["pos"] .= "\n<option value=\"t\">".$language["TOPS"]."</option>";
                $dropdown[$d]["pos"] .= "\n<option selected=\"selected\" value=\"d\">".$language["DROPDOWN"]."</option>";
                $dropdown[$d]["pos"] .= "\n<option value=\"e\">".$language["EXTRA"]."</option>";
								$dropdown[$d]["pos"] .= "\n<option value=\"k\">".$language["ALTLOGIN"]."</option>";
                $dropdown[$d]["pos"] .= "\n<option value=\"a\">".$language["ADAREA"]."</option>";
                $dropdown[$d]["pos"] .= "\n<option value=\"l\">".$language["LEFT"]."</option>";
                $dropdown[$d]["pos"] .= "\n<option value=\"c\">".$language["CENTER"]."</option>";
                $dropdown[$d]["pos"] .= "\n<option value=\"r\">".$language["RIGHT"]."</option>";
                $dropdown[$d]["pos"] .= "\n<option value=\"b\">".$language["BOTTOM"]."</option>";
                $dropdown[$d]["pos"] .= "\n</select>";
                $dropdown[$d]["combo_min_view"] = "\n<select name=\"minclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $dropdown[$d]["combo_min_view"] .= "\n<option value=\"".$level["id_level"].($blk["minclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $dropdown[$d]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["minclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $dropdown[$d]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_minclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $dropdown[$d]["combo_min_view"] .= "\n</select>";
                $dropdown[$d]["combo_max_view"] = "\n<select name=\"maxclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $dropdown[$d]["combo_max_view"] .= "\n<option value=\"".$level["id_level"].($blk["maxclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $dropdown[$d]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["maxclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $dropdown[$d]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_maxclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $dropdown[$d]["combo_max_view"] .= "\n</select>";
                $dropdown[$d]["combo"] = "\n<select name=\"sort_".$blk["blockid"]."\" size=\"1\">";
                for($i = 0; $i < count($br); $i++)
                $dropdown[$d]["combo"] .= "\n<option value=\"$i\" ".($i == $blk["sortid"]?"selected=\"selected\"":"").">$i</option>";
                $dropdown[$d]["combo"] .= "\n</select>";
                $dropdown[$d]["status"] = $blk["status"];
                $dropdown[$d]["title"] = $language[$blk["title"]]."&nbsp;&nbsp;<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=blocks&amp;action=edit&amp;id=".$blk["blockid"].
                    "\">".image_or_link("$STYLEPATH/images/edit.png", "", $language["EDIT"])."</a>";
                $dropdown[$d]["check"] = "<input name=\"status_".$blk["blockid"]."\" type=\"checkbox\" ".($blk["status"] == "1"?"checked=\"checked\"":"")." />";
                $d++;
                break;

            case 'e':
                $extras[$e]["pos"] = "\n<select name=\"position_".$blk["blockid"]."\" size=\"1\">";
                $extras[$e]["pos"] .= "\n<option value=\"t\">".$language["TOP"]."</option>";
                $extras[$e]["pos"] .= "\n<option value=\"d\">".$language["DROPDOWN"]."</option>";
                $extras[$e]["pos"] .= "\n<option selected=\"selected\" value=\"e\">".$language["EXTRA"]."</option>";
								$extras[$e]["pos"] .= "\n<option value=\"k\">".$language["ALTLOGIN"]."</option>";
                $extras[$e]["pos"] .= "\n<option value=\"a\">".$language["ADAREA"]."</option>";
                $extras[$e]["pos"] .= "\n<option value=\"l\">".$language["LEFT"]."</option>";
                $extras[$e]["pos"] .= "\n<option value=\"c\">".$language["CENTER"]."</option>";
                $extras[$e]["pos"] .= "\n<option value=\"r\">".$language["RIGHT"]."</option>";
                $extras[$e]["pos"] .= "\n<option value=\"b\">".$language["BOTTOM"]."</option>";
                $extras[$e]["pos"] .= "\n</select>";
                $extras[$e]["combo_min_view"] = "\n<select name=\"minclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $extras[$e]["combo_min_view"] .= "\n<option value=\"".$level["id_level"].($blk["minclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $extras[$e]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["minclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $extras[$e]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_minclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $extras[$e]["combo_min_view"] .= "\n</select>";
                $extras[$e]["combo_max_view"] = "\n<select name=\"maxclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $extras[$e]["combo_max_view"] .= "\n<option value=\"".$level["id_level"].($blk["maxclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $extras[$e]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["maxclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $extras[$e]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_maxclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $extras[$e]["combo_max_view"] .= "\n</select>";
                $extras[$e]["combo"] = "\n<select name=\"sort_".$blk["blockid"]."\" size=\"1\">";
                for($i = 0; $i < count($br); $i++)
                $extras[$e]["combo"] .= "\n<option value=\"$i\" ".($i == $blk["sortid"]?"selected=\"selected\"":"").">$i</option>";
                $extras[$e]["combo"] .= "\n</select>";
                $extras[$e]["status"] = $blk["status"];
                $extras[$e]["title"] = $language[$blk["title"]]."&nbsp;&nbsp;<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=blocks&amp;action=edit&amp;id=".$blk["blockid"].
                    "\">".image_or_link("$STYLEPATH/images/edit.png", "", $language["EDIT"])."</a>";
                $extras[$e]["check"] = "<input name=\"status_".$blk["blockid"]."\" type=\"checkbox\" ".($blk["status"] == "1"?"checked=\"checked\"":"")." />";
                $e++;
                break;

            case 'k':
                $altlogin[$k]["pos"] = "\n<select name=\"position_".$blk["blockid"]."\" size=\"1\">";
                $altlogin[$k]["pos"] .= "\n<option value=\"t\">".$language["TOP"]."</option>";
                $altlogin[$k]["pos"] .= "\n<option value=\"d\">".$language["DROPDOWN"]."</option>";
								$altlogin[$k]["pos"] .= "\n<option value=\"e\">".$language["EXTRA"]."</option>";
								$altlogin[$k]["pos"] .= "\n<option selected=\"selected\" value=\"k\">".$language["ALTLOGIN"]."</option>";
                $altlogin[$k]["pos"] .= "\n<option value=\"a\">".$language["ADAREA"]."</option>";
                $altlogin[$k]["pos"] .= "\n<option value=\"l\">".$language["LEFT"]."</option>";
                $altlogin[$k]["pos"] .= "\n<option value=\"c\">".$language["CENTER"]."</option>";
                $altlogin[$k]["pos"] .= "\n<option value=\"r\">".$language["RIGHT"]."</option>";
                $altlogin[$k]["pos"] .= "\n<option value=\"b\">".$language["BOTTOM"]."</option>";
                $altlogin[$k]["pos"] .= "\n</select>";
                $altlogin[$k]["combo_min_view"] = "\n<select name=\"minclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $altlogin[$k]["combo_min_view"] .= "\n<option value=\"".$level["id_level"].($blk["minclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $altlogin[$k]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["minclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $altlogin[$k]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_minclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $altlogin[$k]["combo_min_view"] .= "\n</select>";
                $altlogin[$k]["combo_max_view"] = "\n<select name=\"maxclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $altlogin[$k]["combo_max_view"] .= "\n<option value=\"".$level["id_level"].($blk["maxclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $altlogin[$k]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["maxclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $altlogin[$k]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_maxclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $altlogin[$k]["combo_max_view"] .= "\n</select>";
                $altlogin[$k]["combo"] = "\n<select name=\"sort_".$blk["blockid"]."\" size=\"1\">";
                for($i = 0; $i < count($br); $i++)
                $altlogin[$k]["combo"] .= "\n<option value=\"$i\" ".($i == $blk["sortid"]?"selected=\"selected\"":"").">$i</option>";
                $altlogin[$k]["combo"] .= "\n</select>";
                $altlogin[$k]["status"] = $blk["status"];
                $altlogin[$k]["title"] = $language[$blk["title"]]."&nbsp;&nbsp;<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=blocks&amp;action=edit&amp;id=".$blk["blockid"].
                    "\">".image_or_link("$STYLEPATH/images/edit.png", "", $language["EDIT"])."</a>";
                $altlogin[$k]["check"] = "<input name=\"status_".$blk["blockid"]."\" type=\"checkbox\" ".($blk["status"] == "1"?"checked=\"checked\"":"")." />";
                $k++;
                break;

            case 'a':
                $adarea[$a]["pos"] = "\n<select name=\"position_".$blk["blockid"]."\" size=\"1\">";
                $adarea[$a]["pos"] .= "\n<option value=\"t\">".$language["TOP"]."</option>";
                $adarea[$a]["pos"] .= "\n<option value=\"d\">".$language["DROPDOWN"]."</option>";
                $adarea[$a]["pos"] .= "\n<option value=\"e\">".$language["EXTRA"]."</option>";
								$adarea[$a]["pos"] .= "\n<option value=\"k\">".$language["ALTLOGIN"]."</option>";
                $adarea[$a]["pos"] .= "\n<option selected=\"selected\" value=\"a\">".$language["ADAREA"]."</option>";
                $adarea[$a]["pos"] .= "\n<option value=\"l\">".$language["LEFT"]."</option>";
                $adarea[$a]["pos"] .= "\n<option value=\"c\">".$language["CENTER"]."</option>";
                $adarea[$a]["pos"] .= "\n<option value=\"r\">".$language["RIGHT"]."</option>";
                $adarea[$a]["pos"] .= "\n<option value=\"b\">".$language["BOTTOM"]."</option>";
                $adarea[$a]["pos"] .= "\n</select>";
                $adarea[$a]["combo_min_view"] = "\n<select name=\"minclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $adarea[$a]["combo_min_view"] .= "\n<option value=\"".$level["id_level"].($blk["minclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $adarea[$a]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["minclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $adarea[$a]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_minclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $adarea[$a]["combo_min_view"] .= "\n</select>";
                $adarea[$a]["combo_max_view"] = "\n<select name=\"maxclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $adarea[$a]["combo_max_view"] .= "\n<option value=\"".$level["id_level"].($blk["maxclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $adarea[$a]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["maxclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $adarea[$a]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_maxclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $adarea[$a]["combo_max_view"] .= "\n</select>";
                $adarea[$a]["combo"] = "\n<select name=\"sort_".$blk["blockid"]."\" size=\"1\">";
                for($i = 0; $i < count($br); $i++)
                $adarea[$a]["combo"] .= "\n<option value=\"$i\" ".($i == $blk["sortid"]?"selected=\"selected\"":"").">$i</option>";
                $adarea[$a]["combo"] .= "\n</select>";
                $adarea[$a]["status"] = $blk["status"];
                $adarea[$a]["title"] = $language[$blk["title"]]."&nbsp;&nbsp;<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=blocks&amp;action=edit&amp;id=".$blk["blockid"].
                    "\">".image_or_link("$STYLEPATH/images/edit.png", "", $language["EDIT"])."</a>";
                $adarea[$a]["check"] = "<input name=\"status_".$blk["blockid"]."\" type=\"checkbox\" ".($blk["status"] == "1"?"checked=\"checked\"":"")." />";
                $a++;
                break;

            case 'l':
                $lefts[$l]["pos"] = "\n<select name=\"position_".$blk["blockid"]."\" size=\"1\">";
                $lefts[$l]["pos"] .= "\n<option value=\"t\">".$language["TOP"]."</option>";
                $lefts[$l]["pos"] .= "\n<option value=\"d\">".$language["DROPDOWN"]."</option>";
                $lefts[$l]["pos"] .= "\n<option value=\"e\">".$language["EXTRA"]."</option>";
								$lefts[$l]["pos"] .= "\n<option value=\"k\">".$language["ALTLOGIN"]."</option>";
                $lefts[$l]["pos"] .= "\n<option value=\"a\">".$language["ADAREA"]."</option>";
                $lefts[$l]["pos"] .= "\n<option selected=\"selected\" value=\"l\">".$language["LEFT"]."</option>";
                $lefts[$l]["pos"] .= "\n<option value=\"c\">".$language["CENTER"]."</option>";
                $lefts[$l]["pos"] .= "\n<option value=\"r\">".$language["RIGHT"]."</option>";
                $lefts[$l]["pos"] .= "\n<option value=\"b\">".$language["BOTTOM"]."</option>";
                $lefts[$l]["pos"] .= "\n</select>";
                $lefts[$l]["combo_min_view"] = "\n<select name=\"minclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $lefts[$l]["combo_min_view"] .= "\n<option value=\"".$level["id_level"].($blk["minclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $lefts[$l]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["minclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $lefts[$l]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_minclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $lefts[$l]["combo_min_view"] .= "\n</select>";
                $lefts[$l]["combo_max_view"] = "\n<select name=\"maxclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $lefts[$l]["combo_max_view"] .= "\n<option value=\"".$level["id_level"].($blk["maxclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $lefts[$l]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["maxclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $lefts[$l]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_maxclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $lefts[$l]["combo_max_view"] .= "\n</select>";
                $lefts[$l]["combo"] = "\n<select name=\"sort_".$blk["blockid"]."\" size=\"1\">";
                for($i = 0; $i < count($br); $i++)
                $lefts[$l]["combo"] .= "\n<option value=\"$i\" ".($i == $blk["sortid"]?"selected=\"selected\"":"").">$i</option>";
                $lefts[$l]["combo"] .= "\n</select>";
                $lefts[$l]["status"] = $blk["status"];
                $lefts[$l]["title"] = $language[$blk["title"]]."&nbsp;&nbsp;<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=blocks&amp;action=edit&amp;id=".$blk["blockid"].
                    "\">".image_or_link("$STYLEPATH/images/edit.png", "", $language["EDIT"])."</a>";
                $lefts[$l]["check"] = "<input name=\"status_".$blk["blockid"]."\" type=\"checkbox\" ".($blk["status"] == "1"?"checked=\"checked\"":"")." />";
                $l++;
                break;

            case 'c':
                $centers[$c]["pos"] = "\n<select name=\"position_".$blk["blockid"]."\" size=\"1\">";
                $centers[$c]["pos"] .= "\n<option value=\"t\">".$language["TOP"]."</option>";
                $centers[$c]["pos"] .= "\n<option value=\"d\">".$language["DROPDOWN"]."</option>";
                $centers[$c]["pos"] .= "\n<option value=\"e\">".$language["EXTRA"]."</option>";
								$centers[$c]["pos"] .= "\n<option value=\"k\">".$language["ALTLOGIN"]."</option>";
                $centers[$c]["pos"] .= "\n<option value=\"a\">".$language["ADAREA"]."</option>";
                $centers[$c]["pos"] .= "\n<option value=\"l\">".$language["LEFT"]."</option>";
                $centers[$c]["pos"] .= "\n<option selected=\"selected\" value=\"c\">".$language["CENTER"]."</option>";
                $centers[$c]["pos"] .= "\n<option value=\"r\">".$language["RIGHT"]."</option>";
                $centers[$c]["pos"] .= "\n<option value=\"b\">".$language["BOTTOM"]."</option>";
                $centers[$c]["pos"] .= "\n</select>";
                $centers[$c]["combo_min_view"] = "\n<select name=\"minclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $centers[$c]["combo_min_view"] .= "\n<option value=\"".$level["id_level"].($blk["minclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $centers[$c]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["minclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $centers[$c]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_minclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $centers[$c]["combo_min_view"] .= "\n</select>";
                $centers[$c]["combo_max_view"] = "\n<select name=\"maxclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $centers[$c]["combo_max_view"] .= "\n<option value=\"".$level["id_level"].($blk["maxclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $centers[$c]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["maxclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $centers[$c]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_maxclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $centers[$c]["combo_max_view"] .= "\n</select>";
                $centers[$c]["combo"] = "\n<select name=\"sort_".$blk["blockid"]."\" size=\"1\">";
                for($i = 0; $i < count($br); $i++)
                $centers[$c]["combo"] .= "\n<option value=\"$i\" ".($i == $blk["sortid"]?"selected=\"selected\"":"").">$i</option>";
                $centers[$c]["combo"] .= "\n</select>";
                $centers[$c]["status"] = $blk["status"];
                $centers[$c]["title"] = $language[$blk["title"]]."&nbsp;&nbsp;<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=blocks&amp;action=edit&amp;id=".$blk["blockid"].
                    "\">".image_or_link("$STYLEPATH/images/edit.png", "", $language["EDIT"])."</a>";
                $centers[$c]["check"] = "<input name=\"status_".$blk["blockid"]."\" type=\"checkbox\" ".($blk["status"] == "1"?"checked=\"checked\"":"")." />";
                $c++;
                break;

            case 'r':
                $rights[$r]["pos"] = "\n<select name=\"position_".$blk["blockid"]."\" size=\"1\">";
                $rights[$r]["pos"] .= "\n<option value=\"t\">".$language["TOP"]."</option>";
                $rights[$r]["pos"] .= "\n<option value=\"d\">".$language["DROPDOWN"]."</option>";
                $rights[$r]["pos"] .= "\n<option value=\"e\">".$language["EXTRA"]."</option>";
								$rights[$r]["pos"] .= "\n<option value=\"k\">".$language["ALTLOGIN"]."</option>";
                $rights[$r]["pos"] .= "\n<option value=\"a\">".$language["ADAREA"]."</option>";
                $rights[$r]["pos"] .= "\n<option value=\"l\">".$language["LEFT"]."</option>";
                $rights[$r]["pos"] .= "\n<option value=\"c\">".$language["CENTER"]."</option>";
                $rights[$r]["pos"] .= "\n<option selected=\"selected\" value=\"r\">".$language["RIGHT"]."</option>";
                $rights[$r]["pos"] .= "\n<option value=\"b\">".$language["BOTTOM"]."</option>";
                $rights[$r]["pos"] .= "\n</select>";
                $rights[$r]["combo_min_view"] = "\n<select name=\"minclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $rights[$r]["combo_min_view"] .= "\n<option value=\"".$level["id_level"].($blk["minclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $rights[$r]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["minclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $rights[$r]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_minclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $rights[$r]["combo_min_view"] .= "\n</select>";
                $rights[$r]["combo_max_view"] = "\n<select name=\"maxclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $rights[$r]["combo_max_view"] .= "\n<option value=\"".$level["id_level"].($blk["maxclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $rights[$r]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["maxclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $rights[$r]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_maxclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $rights[$r]["combo_max_view"] .= "\n</select>";
                $rights[$r]["combo"] = "\n<select name=\"sort_".$blk["blockid"]."\" size=\"1\">";
                for($i = 0; $i < count($br); $i++)
                $rights[$r]["combo"] .= "\n<option value=\"$i\" ".($i == $blk["sortid"]?"selected=\"selected\"":"").">$i</option>";
                $rights[$r]["combo"] .= "\n</select>";
                $rights[$r]["status"] = $blk["status"];
                $rights[$r]["title"] = $language[$blk["title"]]."&nbsp;&nbsp;<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=blocks&amp;action=edit&amp;id=".$blk["blockid"].
                    "\">".image_or_link("$STYLEPATH/images/edit.png", "", $language["EDIT"])."</a>";
                $rights[$r]["check"] = "<input name=\"status_".$blk["blockid"]."\" type=\"checkbox\" ".($blk["status"] == "1"?"checked=\"checked\"":"")." />";
                $r++;
                break;

            case 'b':
                $bottom[$b]["pos"] = "\n<select name=\"position_".$blk["blockid"]."\" size=\"1\">";
                $bottom[$b]["pos"] .= "\n<option value=\"t\">".$language["TOP"]."</option>";
                $bottom[$b]["pos"] .= "\n<option value=\"d\">".$language["DROPDOWN"]."</option>";
                $bottom[$b]["pos"] .= "\n<option value=\"e\">".$language["EXTRA"]."</option>";
								$bottom[$b]["pos"] .= "\n<option value=\"k\">".$language["ALTLOGIN"]."</option>";
                $bottom[$b]["pos"] .= "\n<option value=\"a\">".$language["ADAREA"]."</option>";
                $bottom[$b]["pos"] .= "\n<option value=\"l\">".$language["LEFT"]."</option>";
                $bottom[$b]["pos"] .= "\n<option value=\"c\">".$language["CENTER"]."</option>";
                $bottom[$b]["pos"] .= "\n<option value=\"r\">".$language["RIGHT"]."</option>";
                $bottom[$b]["pos"] .= "\n<option selected=\"selected\" value=\"b\">".$language["BOTTOM"]."</option>";
                $bottom[$b]["pos"] .= "\n</select>";
                $bottom[$b]["combo_min_view"] = "\n<select name=\"minclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $bottom[$b]["combo_min_view"] .= "\n<option value=\"".$level["id_level"].($blk["minclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $bottom[$b]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["minclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $bottom[$b]["combo_min_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_minclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $bottom[$b]["combo_min_view"] .= "\n</select>";
                $bottom[$b]["combo_max_view"] = "\n<select name=\"maxclassview_".$blk["blockid"]."\" size=\"1\">";
                foreach($alevel as $level)
                {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                $bottom[$b]["combo_max_view"] .= "\n<option value=\"".$level["id_level"].($blk["maxclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="no")
                $bottom[$b]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["maxclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $blk["use_lro"]=="yes")
                $bottom[$b]["combo_max_view"] .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($blk["lro_maxclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $bottom[$b]["combo_max_view"] .= "\n</select>";
                $bottom[$b]["combo"] = "\n<select name=\"sort_".$blk["blockid"]."\" size=\"1\">";
                for($i = 0; $i < count($br); $i++)
                $bottom[$b]["combo"] .= "\n<option value=\"$i\" ".($i == $blk["sortid"]?"selected=\"selected\"":"").">$i</option>";
                $bottom[$b]["combo"] .= "\n</select>";
                $bottom[$b]["status"] = $blk["status"];
                $bottom[$b]["title"] = $language[$blk["title"]]."&nbsp;&nbsp;<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=blocks&amp;action=edit&amp;id=".$blk["blockid"].
                    "\">".image_or_link("$STYLEPATH/images/edit.png", "", $language["EDIT"])."</a>";
                $bottom[$b]["check"] = "<input name=\"status_".$blk["blockid"]."\" type=\"checkbox\" ".($blk["status"] == "1"?"checked=\"checked\"":"")." />";
                $b++;
                break;
        }
    }
    unset($br);
    $admintpl->set("frm_action", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=blocks&amp;action=save");
    $admintpl->set("top_blocks", $t > 0, true);
    $admintpl->set("dropdown_blocks", $d > 0, true);
    $admintpl->set("extra_blocks", $e > 0, true);
		$admintpl->set("altlogin_blocks", $k > 0, true);
    $admintpl->set("adarea_blocks", $a > 0, true);
    $admintpl->set("left_blocks", $l > 0, true);
    $admintpl->set("center_blocks", $c > 0, true);
    $admintpl->set("right_blocks", $r > 0, true);
    $admintpl->set("bottom_blocks", $b > 0, true);
    $admintpl->set("tops", $tops);
    $admintpl->set("dropdown", $dropdown);
    $admintpl->set("extras", $extras);
		$admintpl->set("altlogin", $altlogin);
    $admintpl->set("adarea", $adarea);
    $admintpl->set("lefts", $lefts);
    $admintpl->set("centers", $centers);
    $admintpl->set("rights", $rights);
    $admintpl->set("bottoms", $bottom);
    $admintpl->set("language", $language);
    $admintpl->set("edit_block", false, true);
    $admintpl->set("add_new_block", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=blocks&amp;action=edit");
}
function position_combo($current = "l")
{
    global $language;
    $ret = "\n<select name=\"block_position\" size=\"1\">";
    $ret .= "\n<option value=\"t\" ".($current == "t"?"selected=\"selected\"":"").">".$language["TOP"]."</option>";
    $ret .= "\n<option value=\"d\" ".($current == "d"?"selected=\"selected\"":"").">".$language["DROPDOWN"]."</option>";
    $ret .= "\n<option value=\"e\" ".($current == "e"?"selected=\"selected\"":"").">".$language["EXTRA"]."</option>";
		$ret .= "\n<option value=\"k\" ".($current == "k"?"selected=\"selected\"":"").">".$language["ALTLOGIN"]."</option>";
    $ret .= "\n<option value=\"a\" ".($current == "a"?"selected=\"selected\"":"").">".$language["ADAREA"]."</option>";
    $ret .= "\n<option value=\"l\" ".($current == "l"?"selected=\"selected\"":"").">".$language["LEFT"]."</option>";
    $ret .= "\n<option value=\"c\" ".($current == "c"?"selected=\"selected\"":"").">".$language["CENTER"]."</option>";
    $ret .= "\n<option value=\"r\" ".($current == "r"?"selected=\"selected\"":"").">".$language["RIGHT"]."</option>";
    $ret .= "\n<option value=\"b\" ".($current == "b"?"selected=\"selected\"":"").">".$language["BOTTOM"]."</option>";
    $ret .= "\n</select>";
    return $ret;
}
switch($action)
{
    case 'confirm':
        if($_POST["confirm"] == $language["FRM_CONFIRM"])
        {
            if($btit_settings["fmhack_logical_rank_ordering"]=="enabled")
            {
                $test_lro=array();
                $res=get_result("SELECT `logical_rank_order` FROM `{$TABLE_PREFIX}users_level` ORDER BY `logical_rank_order` ASC", true, $btit_settings["cache_duration"]);
                foreach($res as $row)
                {
                    if(!isset($test_lro[$row["logical_rank_order"]]))
                        $test_lro[$row["logical_rank_order"]]=1;
                    else
                    {
                        stderr($language["ERROR"], $language["LRO_ERR_BLOCK"]." <a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=groups&action=read'>".$language["HERE"]."</a>.");
                        break;
                    }
                }
                $block_min=explode("-", $_POST["minclassview"]);
                $block_max=explode("-", $_POST["maxclassview"]);
                $block_minview = sqlesc(intval($block_min[0]));
                $block_lro_minview = intval($block_min[1]);
                $block_maxview = sqlesc(intval($block_max[0]));
                $block_lro_maxview = intval($block_max[1]);
            }
            else
            {
                $block_minview = sqlesc(intval($_POST["minclassview"]));
                $block_maxview = sqlesc(intval($_POST["maxclassview"]));
            }
            $id = (isset($_GET["id"])?intval($_GET["id"]):0);
            $block_name = sqlesc($_POST["block_name"]);
            $block_position = sqlesc($_POST["block_position"]);
            $block_title = sqlesc($_POST["block_title"]);
            $block_cache = isset($_POST["use_cache"])?"'yes'":"'no'";
            if($block_name == "''")
                stderr($language["ERROR"], $language["ERR_BLOCK_NAME"]);
            if($id > 0) // update existing block
            {
                quickQuery("UPDATE `{$TABLE_PREFIX}blocks` SET `content`=".$block_name.", `position`=".$block_position.", `title`=".$block_title.", `cache`=".$block_cache.", `minclassview`=".$block_minview.", `maxclassview`=".$block_maxview.(($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $block_lro_maxview>=$block_lro_minview)?", `use_lro`='yes', `lro_minclassview`=".sqlesc($block_lro_minview).", `lro_maxclassview`=".sqlesc($block_lro_maxview):", `use_lro`='no', `lro_minclassview`='0', `lro_maxclassview`='0'")." WHERE `blockid`=".$id, true);
            }
            else
            {
                quickQuery("INSERT INTO `{$TABLE_PREFIX}blocks` SET `content`=".$block_name.", `position`=".$block_position.", `title`=".$block_title.", `cache`=".$block_cache.", `status`=0, `minclassview`=".$block_minview.", `maxclassview`=".$block_maxview.(($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $block_lro_maxview>=$block_lro_minview)?", `use_lro`='yes', `lro_minclassview`=".sqlesc($block_lro_minview).", `lro_maxclassview`=".sqlesc($block_lro_maxview):", `use_lro`='no', `lro_minclassview`='0', `lro_maxclassview`='0'"), true);
            }
        }
        read_blocks();
        break;
    case 'edit':
        $query2_select="";
        $query2_order="`id_level`";
        $query2_where="WHERE `id`>=1 AND `id`<=8";
        if($btit_settings["fmhack_logical_rank_ordering"]=="enabled")
        {
            $query2_select.=", `logical_rank_order`, `id`";
            $query2_order="`logical_rank_order`";
            $query2_where="";
        }
        $rlevel = do_sqlquery("SELECT `id_level`, `predef_level`, `level`".$query2_select." FROM `{$TABLE_PREFIX}users_level` ".$query2_where." ORDER BY ".$query2_order." ASC");
        $alevel = array();
        while($reslevel = $rlevel->fetch_assoc())
            $alevel[] = $reslevel;
        $id = (isset($_GET["id"])?intval($_GET["id"]):0);
        if($id > 0)
        {
            $cb = get_result("SELECT * FROM {$TABLE_PREFIX}blocks WHERE blockid=$id", true);
            if(count($cb) > 0)
            {
                $admintpl->set("combo_blocks_name", blocks_combo($cb[0]["content"]));
                $admintpl->set("combo_position", position_combo($cb[0]["position"]));
                $admintpl->set("block_title", $cb[0]["title"]);
                $admintpl->set("block_cache", ($cb[0]["cache"] == "yes"?"checked=\"checked\"":""));
                $combo_min_view = "\n<select name=\"minclassview\" size=\"1\">";
                foreach($alevel as $level)
                {
                    if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                        $combo_min_view .= "\n<option value=\"".$level["id_level"].($cb[0]["minclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                    elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $cb[0]["use_lro"]=="no")
                        $combo_min_view .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($cb[0]["minclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                    elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $cb[0]["use_lro"]=="yes")
                        $combo_min_view .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($cb[0]["lro_minclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $combo_min_view .= "\n</select>";
                $combo_max_view = "\n<select name=\"maxclassview\" size=\"1\">";

                foreach($alevel as $level)
                {
                    if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                        $combo_max_view .= "\n<option value=\"".$level["id_level"].($cb[0]["maxclassview"] == $level["id_level"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                    elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $cb[0]["use_lro"]=="no")
                        $combo_max_view .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($cb[0]["maxclassview"] == $level["id"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                    elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $cb[0]["use_lro"]=="yes")
                        $combo_max_view .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($cb[0]["lro_maxclassview"] == $level["logical_rank_order"]?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                }
                $combo_max_view .= "\n</select>";
            }
            else
                stderr($language["ERROR"], $language["BLOCK_BAD_ID"]);
        }
        else
        {
            if($btit_settings["fmhack_logical_rank_ordering"]=="enabled")
            {
                $lowest=$alevel[0]["logical_rank_order"];
                $highest=$alevel[(count($alevel)-1)]["logical_rank_order"];
            }
            $admintpl->set("combo_blocks_name", blocks_combo());
            $admintpl->set("combo_position", position_combo());
            $admintpl->set("block_title", "");
            $admintpl->set("block_cache", "");
            $combo_min_view = "\n<select name=\"minclassview\" size=\"1\">";
            foreach($alevel as $level)
            {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                    $combo_min_view .= "\n<option value=\"".$level["id_level"].($level["id_level"] == 1?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled")
                    $combo_min_view .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($level["logical_rank_order"] == $lowest?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
            }
            $combo_min_view .= "\n</select>";
            $combo_max_view = "\n<select name=\"maxclassview\" size=\"1\">";
            foreach($alevel as $level)
            {
                if($btit_settings["fmhack_logical_rank_ordering"]!="enabled")
                    $combo_max_view .= "\n<option value=\"".$level["id_level"].($level["id_level"] == 8?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
                elseif($btit_settings["fmhack_logical_rank_ordering"]=="enabled")
                    $combo_max_view .= "\n<option value=\"".$level["id_level"]."-".$level["logical_rank_order"].($level["logical_rank_order"] == $highest?"\" selected=\"selected\">":"\">").$level["level"]."</option>";
            }
            $combo_max_view .= "\n</select>";
        }
        $admintpl->set("combo_min_view", $combo_min_view);
        $admintpl->set("combo_max_view", $combo_max_view);
        $admintpl->set("frm_action", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=blocks&amp;action=confirm&amp;id=$id");
        $admintpl->set("language", $language);
        $admintpl->set("edit_block", true, true);
        break;
    case 'save':
        if($_POST["confirm"] == $language["FRM_CONFIRM"])
        {
            if($btit_settings["fmhack_logical_rank_ordering"]=="enabled")
            {
                $test_lro=array();
                $res=get_result("SELECT `logical_rank_order` FROM `{$TABLE_PREFIX}users_level` ORDER BY `logical_rank_order` ASC", true, $btit_settings["cache_duration"]);
                foreach($res as $row)
                {
                    if(!isset($test_lro[$row["logical_rank_order"]]))
                        $test_lro[$row["logical_rank_order"]]=1;
                    else
                    {
                        stderr($language["ERROR"], $language["LRO_ERR_BLOCK"]." <a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=groups&action=read'>".$language["HERE"]."</a>.");
                        break;
                    }
                }
            }
            $br = get_result("SELECT * FROM {$TABLE_PREFIX}blocks", true);
            foreach($br as $block)
            {
                $active = (isset($_POST["status_".$block["blockid"]])?1:0);
                $position = sqlesc($_POST["position_".$block["blockid"]]);
                $sort = max(0, $_POST["sort_".$block["blockid"]]);
                if($btit_settings["fmhack_logical_rank_ordering"]=="enabled")
                {
                    $block_min=explode("-", $_POST["minclassview_".$block["blockid"]]);
                    $block_max=explode("-", $_POST["maxclassview_".$block["blockid"]]);
                    $block_minview = sqlesc(intval($block_min[0]));
                    $block_lro_minview = intval($block_min[1]);
                    $block_maxview = sqlesc(intval($block_max[0]));
                    $block_lro_maxview = intval($block_max[1]);
                }
                else
                {
                    $block_minview = sqlesc(intval($_POST["minclassview_".$block["blockid"]]));
                    $block_maxview = sqlesc(intval($_POST["maxclassview_".$block["blockid"]]));
                }
                $id = $block["blockid"];
                quickQuery("UPDATE `{$TABLE_PREFIX}blocks` SET `position`=".$position.", `sortid`=".$sort.", `status`=".$active.", `minclassview`=".$block_minview.", `maxclassview`=".$block_maxview.(($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && $block_lro_maxview>=$block_lro_minview)?", `use_lro`='yes', `lro_minclassview`=".sqlesc($block_lro_minview).", `lro_maxclassview`=".sqlesc($block_lro_maxview):", `use_lro`='no', `lro_minclassview`='0', `lro_maxclassview`='0'")." WHERE `blockid`=".$id, true);
            }
        }
        // don't break, we read the new block's position ;)
    case '':
    case 'read':
    default:
        read_blocks();
}

?>
