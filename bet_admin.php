<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//   SPORT BETTING HACK , orginal TBDEV 2009 by Soft & Bigjoos 
//   XBTIT conversion by DiemThuy , April 2010
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


require_once("include/functions.php");

global $BASEURL, $CURUSER, $language, $btit_settings;

if(!isset($CURUSER) || !is_array($CURUSER))
{
    session_name("Blu-torrents");
    session_start();
    $CURUSER=$_SESSION["CURUSER"];
}

$betadmintpl = new bTemplate();
$betadmintpl->set("language", $language);
$betadmintpl->set("admin_access", (($CURUSER["admin_access"]=="yes")?true:false),true);

if ($CURUSER["admin_access"]=="no")
    stderr($language["ERROR"], $language["SB_ACC_DEN"]);
 
$a = get_result("SELECT `bg`.*, `ul`.`prefixcolor`, `ul`.`suffixcolor` FROM `{$TABLE_PREFIX}betgames` `bg` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `bg`.`creator`=`u`.`username` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` ORDER BY `bg`.`endtime` ASC", true, $btit_settings["cache_duration"]);
if(count($a)>0)
{
    $betadmintpl->set("result",true,true);
    $loop1=array();
    $i=0;
    foreach($a as $b)
    {
        $loop1[$i]["creator"]=unesc($b["prefixcolor"].$b['creator'].$b["suffixcolor"]);
        $loop1[$i]["open_italics"]=((time() > $b["endtime"])?"<i>":"");
        $loop1[$i]["close_italics"]=((time() > $b["endtime"])?"</i>":"");
        $loop1[$i]["endtime"]=htmlspecialchars(date('l jS F Y \a\\t g:ia',$b['endtime']));
        $loop1[$i]["heading"]=htmlspecialchars($b['heading']);
        $loop1[$i]["undertext"]=htmlspecialchars($b['undertext']);
        $loop1[$i]["id"]=$b["id"];
        $loop1[$i]["link"]=((time() > $b["endtime"])?"0":"<a href='index.php?page=betactive&id=".$b["id"]."'><u>".htmlspecialchars($b['active'])."</u></a>" );
        $i++;
    }
    $betadmintpl->set("loop1", $loop1);
}
else
    $betadmintpl->set("result",false,true);

?>