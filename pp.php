<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
//    Advanced Auto Donation System by DiemThuy ( sept 2009 )
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

require_once (load_language("lang_aads.php"));
if($CURUSER["uid"]<=1)
die();
// get settings
$zap_pp = get_result("SELECT * FROM {$TABLE_PREFIX}paypal_settings WHERE id ='1'",true,$btit_settings["cache_duration"]);
$settings = $zap_pp[0];


if($settings["units"]=="BGN" || $settings["units"]=="INR" || $settings["units"]=="LTL" || $settings["units"]=="MKD" || $settings["units"]=="RON" || $settings["units"]=="ZAR")
{
    if($settings["units"]=="BGN")
        $paytype="Bulgarian Leva (BGN)";
    elseif($settings["units"]=="INR")
        $paytype="Indian Rupee (INR)";
    elseif($settings["units"]=="LTL")
        $paytype="Lithuanian Litai (LTL)";
    elseif($settings["units"]=="MKD")
        $paytype="Macedonian Denari (MKD)";
    elseif($settings["units"]=="RON")
        $paytype="Romanian Lei (RON)";
    elseif($settings["units"]=="ZAR")
        $paytype="South African Rand (ZAR)";

    stderr($language["ERROR"], $paytype." ".$language["AADS_NOT_SUP_PAY"]);
}

$pptpl= new bTemplate();

$pptpl-> set("language",$language);
$pptpl-> set("url_back",$BASEURL);
$pptpl-> set("site",$SITENAME);
$user=unesc($CURUSER["prefixcolor"].$CURUSER["username"].$CURUSER["suffixcolor"]);
$pptpl-> set("user",$user);
$pptpl-> set("uid",$CURUSER["uid"]);
$pptpl-> set("days",$settings["vip_days"]);
$pptpl-> set("days_plural", (($settings["vip_days"]==1)?FALSE:TRUE),TRUE);
$pptpl-> set("daysb",$settings["vip_daysb"]);
$pptpl-> set("daysb_plural", (($settings["vip_daysb"]==1)?FALSE:TRUE),TRUE);
$pptpl-> set("daysc",$settings["vip_daysc"]);
$pptpl-> set("daysc_plural", (($settings["vip_daysc"]==1)?FALSE:TRUE),TRUE);
$pptpl-> set("gb",$settings["gb"]);
$pptpl-> set("gbb",$settings["gbb"]);
$pptpl-> set("gbc",$settings["gbc"]);

// If testing on Sandbox use:
if ($settings["test"]=="true")
{
    $email= $settings["sandbox_email"];
    $url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
    $pptpl-> set("proc","sandbox");
}
if ($settings["test"]=="false")
{
    $email= $settings["paypal_email"];
    $url = "https://www.paypal.com/cgi-bin/webscr";
    $pptpl-> set("proc","paypal");
}
$pptpl-> set("email",$email);

if($settings["IPN"]=="true")
    $pptpl-> set("url",$url);
else
    $pptpl-> set("url","pdon.php");

$pptpl->set("ipn_en_1", (($settings["IPN"]=="true")?TRUE:FALSE),TRUE);
$pptpl->set("ipn_en_2", (($settings["IPN"]=="true")?TRUE:FALSE),TRUE);
$pptpl->set("ipn_en_3", (($settings["IPN"]=="true")?TRUE:FALSE),TRUE);

$currency=$settings["units"];

if ($currency=="AUD" || $currency=="CAD" || $currency=="HKD" || $currency=="NZD" || $currency=="SGD" || $currency=="USD")
{
    $unit = "Dollar";
    $unit_plural = "Dollars";
    $sign = "&#36;";
    $pptpl-> set("signleft",TRUE,TRUE);
    $pptpl-> set("signright",FALSE,TRUE);
}
elseif($currency=="CZK")
{
    $unit = "Koruna &#269;esk&#225;";
    $unit_plural = "Korun &#269;esk&#253;ch";
    $sign = "K&#269;";
    $pptpl-> set("signleft",FALSE,TRUE);
    $pptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="DKK" || $currency=="NOK")
{
    $unit = "Krone";
    $unit_plural = "Kroner";
    $sign = "kr";
    $pptpl-> set("signleft",FALSE,TRUE);
    $pptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="EUR")
{
    $unit = "Euro";
    $unit_plural = "Euros";
    $sign = "&#8364;";
    $pptpl-> set("signleft",TRUE,TRUE);
    $pptpl-> set("signright",FALSE,TRUE);
}
elseif($currency=="HUF")
{
    $unit = "Forint";
    $unit_plural = $unit;
    $sign = "Ft";
    $pptpl-> set("signleft",FALSE,TRUE);
    $pptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="ILS")
{
    $unit = "Shekel";
    $unit_plural = "Shekalim";
    $sign = "&#8362;";
    $pptpl-> set("signleft",TRUE,TRUE);
    $pptpl-> set("signright",FALSE,TRUE);
}
elseif($currency=="JPY")
{
    $unit = "Yen";
    $unit_plural = "Yen";
    $sign = "&#165;";
    $pptpl-> set("signleft",TRUE,TRUE);
    $pptpl-> set("signright",FALSE,TRUE);
}
elseif($currency=="MXN")
{
    $unit = "Peso";
    $unit_plural = "Pesos";
    $sign = "&#36;";
    $pptpl-> set("signleft",FALSE,TRUE);
    $pptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="PLN")
{
    $unit = "Z&#322;oty";
    $unit_plural = "z&#322;otych";
    $sign = "z&#322;";
    $pptpl-> set("signleft",FALSE,TRUE);
    $pptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="GBP")
{
    $unit = "Pound";
    $unit_plural = "Pounds";
    $sign = "&#163;";
    $pptpl-> set("signleft",TRUE,TRUE);
    $pptpl-> set("signright",FALSE,TRUE);
}
elseif($currency=="SEK")
{
    $unit = "Krona";
    $unit_plural = "Kronor";
    $sign = "kr";
    $pptpl-> set("signleft",FALSE,TRUE);
    $pptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="CHF")
{
    $unit = "Franc";
    $unit_plural = "Francs";
    $sign = "CHF";
    $pptpl-> set("signleft",FALSE,TRUE);
    $pptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="BRL")
{
    $unit = "Real";
    $unit_plural = "Real";
    $sign = "R&#36;";
    $pptpl-> set("signleft",TRUE,TRUE);
    $pptpl-> set("signright",FALSE,TRUE);
}
elseif($currency=="MYR")
{
    $unit = "Ringgit";
    $unit_plural = "Ringgit";
    $sign = "RM";
    $pptpl-> set("signleft",TRUE,TRUE);
    $pptpl-> set("signright",FALSE,TRUE);
}
elseif($currency=="PHP")
{
    $unit = "Peso";
    $unit_plural = "Pesos";
    $sign = "&#8369;";
    $pptpl-> set("signleft",TRUE,TRUE);
    $pptpl-> set("signright",FALSE,TRUE);
}
elseif($currency=="TWD")
{
    $unit = "Dollar";
    $unit_plural = "Dollars";
    $sign = "NT&#36;";
    $pptpl-> set("signleft",TRUE,TRUE);
    $pptpl-> set("signright",FALSE,TRUE);
}
elseif($currency=="THB")
{
    $unit = "Baht";
    $unit_plural = "Baht";
    $sign = "&#3647;";
    $pptpl-> set("signleft",TRUE,TRUE);
    $pptpl-> set("signright",FALSE,TRUE);
}

$poss_don_amnt=explode(",",$settings["poss_don_amnt"]);
$pptpl-> set("poss_don_amnt",$poss_don_amnt);
$pptpl-> set("unit_plural",$unit_plural);

$pptpl-> set("unit",$unit);
$pptpl-> set("sign",$sign);
$pptpl-> set("currency",$currency);

$pptpl-> set("today",$settings["today"]);
$pptpl-> set("count",($settings["today"]+1));
$pptpl-> set("todayb",$settings["todayb"]);
$pptpl-> set("countb",($settings["todayb"]+1));

$pptpl-> set("togb",$settings["togb"]);
$pptpl-> set("countc",($settings["togb"]+1));
$pptpl-> set("togbb",$settings["togbb"]);
$pptpl-> set("countd",($settings["togbb"]+1));

$vip = (int)$settings["vip_rank"];
$zap_usr_v = get_result("SELECT prefixcolor,suffixcolor,level FROM {$TABLE_PREFIX}users_level WHERE id =$vip",true,$btit_settings["cache_duration"]);
$wyn_usr_v = $zap_usr_v[0];
$vipname = unesc($wyn_usr_v["prefixcolor"].$wyn_usr_v["level"].$wyn_usr_v["suffixcolor"]);
$pptpl-> set("vip_name",$vipname);

$pptpl->set("vip_show_1", (($CURUSER["id_level"]==1 || $CURUSER["id_level"]==$vip || $CURUSER["edit_forum"]=="yes")?false:true),true);
$pptpl->set("vip_show_2", (($CURUSER["id_level"]==1 || $CURUSER["id_level"]==$vip || $CURUSER["edit_forum"]=="yes")?false:true),true);
$pptpl->set("vip_show_3", (($CURUSER["id_level"]==$vip && $CURUSER["rank_switch"]=="yes" && $CURUSER["timed_rank"]>0 && $CURUSER["old_rank"]!=$vip && $CURUSER['id']!=20 && $CURUSER['id']!=12)?true:false), true);
$pptpl->set("vip_show_4", (($CURUSER["id_level"]==$vip && $CURUSER["rank_switch"]=="yes" && $CURUSER["timed_rank"]>0 && $CURUSER["old_rank"]!=$vip && $CURUSER['id']!=20 && $CURUSER['id']!=12)?false:true), true);
$pptpl->set("vip_show_5", (($CURUSER["id_level"]==$vip && $CURUSER["rank_switch"]=="yes" && $CURUSER["timed_rank"]>0 && $CURUSER["old_rank"]!=$vip && $CURUSER['id']!=20 && $CURUSER['id']!=12)?true:false), true);
$pptpl->set("check_1", (($CURUSER["id_level"]==1 || $CURUSER["id_level"]==$vip || $CURUSER["edit_forum"]=="yes")?true:false),true);
$pptpl->set("check_2", (($CURUSER["id_level"]==$vip || $CURUSER["edit_forum"]=="yes")?false:true),true);
$pptpl->set("check_3", (($CURUSER["id_level"]==1)?true:false),true);
$pptpl->set("ul_show_1", (($CURUSER["id_level"]!=1)?true:false),true);
$pptpl->set("ul_show_2", (($CURUSER["id_level"]!=1)?true:false),true);
$pptpl->set("vip_expire", date("\p\a\s\\t jS F Y \a\\t g:ia",$CURUSER["timed_rank"]));
$pptpl->set("fl_slot_cost", $settings["fl_slot_cost"]);
$pptpl->set("fls_enabled1", (($btit_settings["fmhack_freeleech_slots"]=="enabled" && $settings["fl_slot"]=="true")?true:false), true);
$pptpl->set("fls_enabled2", (($btit_settings["fmhack_freeleech_slots"]=="enabled" && $settings["fl_slot"]=="true")?true:false), true);

?>
