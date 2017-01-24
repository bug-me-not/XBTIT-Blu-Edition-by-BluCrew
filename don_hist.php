<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
//    Donation Historie by DiemThuy ( Juni 2009 )
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


require_once("include/functions.php");

global $BASEURL, $CURUSER, $language, $btit_settings;

if(!isset($CURUSER) || !is_array($CURUSER))
{
    session_name("BluRG");
    session_start();
    $CURUSER=$_SESSION["CURUSER"];
}

if($CURUSER['edit_torrents'] == 'no' && $CURUSER['edit_users'] == 'no')
    stderr($language["ERROR"], $language['ERR_PERM_DENIED']);
(isset($_GET["id"]) && is_numeric($_GET["id"]))?$id = (int)0 + $_GET["id"]:$id = 0;
(isset($_POST["don_amount"]) && !empty($_POST["don_amount"]))?$don = addslashes($_POST["don_amount"]):$don = "";
(isset($_POST["returnto"]) && !empty($_POST["returnto"]))?$returnto = $_POST["returnto"]:$returnto = "index.php";
$donation = get_result("SELECT * FROM {$TABLE_PREFIX}don_historie WHERE don_id ='$id'", true, $btit_settings["cache_duration"]);
if(count($donation) > 0)
{
    $dh = $donation[0];
    if($btit_settings["dh_pm"] = true)
    {
        $subj = sqlesc($language['DON_CONFIRM']);
        $msg = sqlesc($btit_settings["dh_text"]);
        send_pm(0, $id, $subj, $msg);
    }
    if(empty($dh["don_ation_1"]))
    {
        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_1="'.$don.'",donate_date_1=NOW() WHERE don_id='.$id, true);
    }
    elseif(empty($dh["don_ation_2"]))
    {
        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_2="'.$don.'",donate_date_2=NOW() WHERE don_id='.$id, true);
    }
    elseif(empty($dh["don_ation_3"]))
    {
        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_3="'.$don.'",donate_date_3=NOW() WHERE don_id='.$id, true);
    }
    elseif(empty($dh["don_ation_4"]))
    {
        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_4="'.$don.'",donate_date_4=NOW() WHERE don_id='.$id, true);
    }
    elseif(empty($dh["don_ation_5"]))
    {
        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_5="'.$don.'",donate_date_5=NOW() WHERE don_id='.$id, true);
    }
    elseif(empty($dh["don_ation_6"]))
    {
        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_6="'.$don.'",donate_date_6=NOW() WHERE don_id='.$id, true);
    }
    elseif(empty($dh["don_ation_7"]))
    {
        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_7="'.$don.'",donate_date_7=NOW() WHERE don_id='.$id, true);
    }
    elseif(empty($dh["don_ation_8"]))
    {
        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_8="'.$don.'",donate_date_8=NOW() WHERE don_id='.$id, true);
    }
    elseif(empty($dh["don_ation_9"]))
    {
        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_9="'.$don.'",donate_date_9=NOW() WHERE don_id='.$id, true);
    }
    elseif(empty($dh["don_ation_10"]))
    {
        do_sqlquery('update '.$TABLE_PREFIX.'don_historie SET don_ation_10="'.$don.'",donate_date_10=NOW() WHERE don_id='.$id, true);
    }
}
else
{
    $dh = $donation[0];
    if($btit_settings["dh_pm"] = true)
    {
        $subj = sqlesc($language['DON_CONFIRM']);
        $msg = sqlesc($btit_settings["dh_text"]);
        send_pm(0, $id, $subj, $msg);
    }
    do_sqlquery('insert '.$TABLE_PREFIX.'don_historie SET donate_date=NOW(),don_ation="'.$don.'" ,don_id='.$id, true);
}
header('Location: '.$returnto);
die();

?>