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
    session_name("BluRG");
    session_start();
    $CURUSER=$_SESSION["CURUSER"];
}

if ($CURUSER["admin_access"]=="no")
    stderr($language["ERROR"], $language["SB_ACC_DEN"]);

$id = isset($_POST['id']) && is_valid_id($_POST['id']) ? $_POST['id'] : 0;

if (empty($_POST['heading']) || empty($_POST['undertext']) || $_POST["endday"]=="na" || $_POST["endmonth"]=="na" || $_POST["endyear"]=="na" || $_POST["endhour"]=="na" || $_POST["endmin"]=="na")
    stderr($language["SB_SILLY_RABBIT"], $language["SB_NO_OPT"]);

$day=(int)$_POST["endday"];
$month=(int)$_POST["endmonth"];
$year=(int)$_POST["endyear"];
$hour=(int)$_POST["endhour"];
$min=(int)$_POST["endmin"];
$endtime=mktime($hour,$min,0,$month,$day,$year);

if(!checkdate($month,$day,$year))
    stderr($language["ERROR"], "Invalid date");

if($endtime<time())
    stderr($language["ERROR"], "Expiry time cannot be in the past");



$heading = htmlspecialchars($_POST['heading']);
$heading = str_replace("'","",$heading);
$undertext = htmlspecialchars($_POST['undertext']);
$undertext = str_replace("'","",$undertext);
$sort = (int) $_POST['sort'];
$res = "UPDATE {$TABLE_PREFIX}betgames SET heading =".sqlesc($heading).", undertext=".sqlesc($undertext).", endtime=".sqlesc($endtime).", sort=".sqlesc($sort)." WHERE id =".sqlesc($id)."";
do_sqlquery($res,true);
header("location: $BASEURL/index.php?page=betadmin");

?>