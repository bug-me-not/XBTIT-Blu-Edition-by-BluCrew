<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
// Ban Button by Petr1fied and DiemThuy  - oct 2009
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


if(!isset($CURUSER) || !is_array($CURUSER))
{
    session_name("Blu-torrents");
    session_start();
    $CURUSER = $_SESSION["CURUSER"];
}
if(isset($_GET["action"]))
    $action = $_GET["action"];
else
    $action = "";
if($action == "delete")
{
    (isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] > 0)?$id = (int)0+$_GET["id"]:$id = 0;
    if($id != 0)
        quickQuery("DELETE FROM `{$TABLE_PREFIX}signup_ip_block` WHERE `id`=".$id, true);
    else
        redirect("index.php");
}
$getbanned = do_sqlquery("SELECT * FROM `{$TABLE_PREFIX}signup_ip_block` ORDER BY `added` ASC", true);
$row = @sql_num_rows($getbanned);
$log = array();
$i = 0;
$admintpl->set("language", $language);
$admintpl->set("bandays", $btit_settings["bandays"]);
if(sql_num_rows($getbanned) == 0)
{
    $banbutton[$i]["FIP"] = ("<center><b><span style='color:green'>".$language["BB_NONE_YET_1"]."</span></b></center>");
    $banbutton[$i]["LIP"] = ("<center><b><span style='color:green'>".$language["BB_NONE_YET_2"]."</span></b></center>");
    $banbutton[$i]["added"] = ("<center><b><span style='color:green'>".$language["BB_NONE_YET_3"]."</span></b></center>");
    $banbutton[$i]["to"] = ("<center><b><span style='color:green'>".$language["BB_NONE_YET_4"]."</span></b></center>");
    $banbutton[$i]["by"] = ("<center><b><span style='color:green'>".$language["BB_NONE_YET_5"]."</span></b></center>");
    $banbutton[$i]["com"] = ("<center><b><span style='color:green'>".$language["BB_NONE_YET_6"]."</span></b></center>");
    $banbutton[$i]["remove"] = ("<center><b><span style='color:green'>".$language["BB_NONE_YET_7"]."</span></b></center>");
    $i++;
}
else
{
    while($arr = $getbanned->fetch_assoc())
    {
        $ip_f = long2ip($arr["first_ip"]);
        $ip_l = long2ip($arr["last_ip"]);
        $days = ($btit_settings["bandays"] * 86400);
        $to = ($arr['added'] + $days);
        $banbutton[$i]["id"] = $arr["id"];
        $banbutton[$i]["FIP"] = $ip_f;
        $banbutton[$i]["LIP"] = $ip_l;
        $banbutton[$i]["added"] = get_date_time($arr['added']);
        $banbutton[$i]["to"] = get_date_time($to);
        $banbutton[$i]["by"] = $arr['addedby'];
        $banbutton[$i]["com"] = $arr['comment'];
        $banbutton[$i]["remove"] = "<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=banbutton&amp;action=delete&amp;id=".$arr["id"]."\" onclick=\"return confirm('".
            str_replace("'", "\'", $language["DELETE_CONFIRM"])."')\">".image_or_link("$STYLEPATH/images/delete.png", "", $language["DELETE"])."</a>";
        $i++;
    }
}
$admintpl->set("banbutton", $banbutton);

?>
