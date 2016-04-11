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



$action = $_GET['action'];
$returnto = "index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=image_upload";

if($action == 'send')
{
    (isset($_POST["imageon"]) && $_POST["imageon"]=="true") ? $imageon="true" : $imageon="false";
    (isset($_POST["screenon"]) && $_POST["screenon"]=="true") ? $screenon="true" : $screenon="false";
    (isset($_POST["uploaddir"]) && !empty($_POST["uploaddir"])) ? $uploaddir=sql_esc($_POST["uploaddir"]) : $uploaddir=sql_esc("torrentimg/");
    (isset($_POST["file_limit"]) && is_numeric($_POST["file_limit"]) && $_POST["file_limit"]>0) ? $file_limit=(int)0+$_POST["file_limit"] : $file_limit=15;
    (isset($_POST["imgup_maxh"]) && is_numeric($_POST["imgup_maxh"]) && $_POST["imgup_maxh"]>0) ? $imgup_maxh=(int)0+$_POST["imgup_maxh"] : $imgup_maxh=100;
    (isset($_POST["imgup_maxw"]) && is_numeric($_POST["imgup_maxw"]) && $_POST["imgup_maxw"]>0) ? $imgup_maxw=(int)0+$_POST["imgup_maxw"] : $imgup_maxw=100;

    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$imageon."' WHERE `key`='imageon'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$screenon."' WHERE `key`='screenon'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$uploaddir."' WHERE `key`='uploaddir'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$file_limit."' WHERE `key`='file_limit'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$imgup_maxh."' WHERE `key`='imgup_maxh'", true);
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$imgup_maxw."' WHERE `key`='imgup_maxw'", true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect($returnto);
}

$btit_settings["imageonyes"]=($btit_settings["imageon"]?"checked=\"checked\"":"");
$btit_settings["imageonno"]=(!$btit_settings["imageon"]?"checked=\"checked\"":"");
$btit_settings["screenonyes"]=($btit_settings["screenon"]?"checked=\"checked\"":"");
$btit_settings["screenonno"]=(!$btit_settings["screenon"]?"checked=\"checked\"":"");
$admintpl->set("language",$language);
$admintpl->set("frm_action", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=image_upload&amp;action=send");
$admintpl->set("fuconfig",$btit_settings);

?>
