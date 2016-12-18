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
// get settings
$zap_pp = get_result("SELECT * FROM {$TABLE_PREFIX}paypal_settings WHERE id ='1'",true,$btit_settings["cache_duration"]);
$settings = $zap_pp[0];


if($settings["units"]=="BRL" || $settings["units"]=="ILS" || $settings["units"]=="JPY" || $settings["units"]=="MXN" || $settings["units"]=="PHP" || $settings["units"]=="TWD" || $settings["units"]=="THB")
{
    if($settings["units"]=="BRL")
        $paytype="Brazilian Real (BRL)";
    elseif($settings["units"]=="ILS")
        $paytype="Israeli New Sheqel (ILS)";
    elseif($settings["units"]=="JPY")
        $paytype="Japanese Yen (JPY)";
    elseif($settings["units"]=="MXN")
        $paytype="Mexican Peso (MXN)";
    elseif($settings["units"]=="PHP")
        $paytype="Philippine Peso (PHP)";
    elseif($settings["units"]=="TWD")
        $paytype="Taiwan New Dollar (TWD)";
    elseif($settings["units"]=="THB")
        $paytype="Thai Baht (THB)";

    stderr($language["ERROR"], $paytype." ".$language["AADS_NOT_SUP_ALE"]);
}


$aptpl= new bTemplate();

$aptpl-> set("language",$language);
$aptpl-> set("url_back",$BASEURL);
$aptpl-> set("site",$SITENAME);
$user=unesc($CURUSER["prefixcolor"].$CURUSER["username"].$CURUSER["suffixcolor"]);
$aptpl-> set("user",$user);
$aptpl-> set("uid",$CURUSER["uid"]);
$aptpl-> set("days",$settings["vip_days"]);
$aptpl-> set("days_plural", (($settings["vip_days"]==1)?FALSE:TRUE),TRUE);
$aptpl-> set("daysb",$settings["vip_daysb"]);
$aptpl-> set("daysb_plural", (($settings["vip_daysb"]==1)?FALSE:TRUE),TRUE);
$aptpl-> set("daysc",$settings["vip_daysc"]);
$aptpl-> set("daysc_plural", (($settings["vip_daysc"]==1)?FALSE:TRUE),TRUE);
$aptpl-> set("gb",$settings["gb"]);
$aptpl-> set("gbb",$settings["gbb"]);
$aptpl-> set("gbc",$settings["gbc"]);
$email= $settings["alertpay_email"];
$aptpl-> set("email",$email);
$currency=$settings["units"];
$url = "https://secure.payza.com/checkout";
$aptpl-> set("url",$url);

if ($currency=="AUD" || $currency=="CAD" || $currency=="HKD" || $currency=="NZD" || $currency=="SGD" || $currency=="USD")
{
    $unit = "Dollar";
    $unit_plural = "Dollars";
    $sign = "&#36;";
    $aptpl-> set("signleft",TRUE,TRUE);
    $aptpl-> set("signright",FALSE,TRUE);
}
elseif($currency=="CZK")
{
    $unit = "Koruna &#269;esk&#225;";
    $unit_plural = "Korun &#269;esk&#253;ch";
    $sign = "K&#269;";
    $aptpl-> set("signleft",FALSE,TRUE);
    $aptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="DKK" || $currency=="NOK")
{
    $unit = "Krone";
    $unit_plural = "Kroner";
    $sign = "kr";
    $aptpl-> set("signleft",FALSE,TRUE);
    $aptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="EUR")
{
    $unit = "Euro";
    $unit_plural = "Euros";
    $sign = "&#8364;";
    $aptpl-> set("signleft",TRUE,TRUE);
    $aptpl-> set("signright",FALSE,TRUE);
}
elseif($currency=="HUF")
{
    $unit = "Forint";
    $unit_plural = $unit;
    $sign = "Ft";
    $aptpl-> set("signleft",FALSE,TRUE);
    $aptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="PLN")
{
    $unit = "Z&#322;oty";
    $unit_plural = "z&#322;otych";
    $sign = "z&#322;";
    $aptpl-> set("signleft",FALSE,TRUE);
    $aptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="GBP")
{
    $unit = "Pound";
    $unit_plural = "Pounds";
    $sign = "&#163;";
    $aptpl-> set("signleft",TRUE,TRUE);
    $aptpl-> set("signright",FALSE,TRUE);
}
elseif($currency=="SEK")
{
    $unit = "Krona";
    $unit_plural = "Kronor";
    $sign = "kr";
    $aptpl-> set("signleft",FALSE,TRUE);
    $aptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="CHF")
{
    $unit = "Franc";
    $unit_plural = "Francs";
    $sign = "CHF";
    $aptpl-> set("signleft",FALSE,TRUE);
    $aptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="MYR")
{
    $unit = "Ringgit";
    $unit_plural = "Ringgit";
    $sign = "RM";
    $aptpl-> set("signleft",TRUE,TRUE);
    $aptpl-> set("signright",FALSE,TRUE);
}
elseif($currency=="BGN")
{
    $unit = "Lev";
    $unit_plural = "Leva";
    $sign = "&#1083;&#1074;";
    $aptpl-> set("signleft",FALSE,TRUE);
    $aptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="INR")
{
    $unit = "Rupee";
    $unit_plural = "Rupee";
    $sign = "&#8377;";
    $aptpl-> set("signleft",TRUE,TRUE);
    $aptpl-> set("signright",FALSE,TRUE);
}
elseif($currency=="LTL")
{
    $unit = "Litas";
    $unit_plural = "Litai";
    $sign = "Lt";
    $aptpl-> set("signleft",FALSE,TRUE);
    $aptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="MKD")
{
    $unit = "Denar";
    $unit_plural = "Denari";
    $sign = "&#1076;&#1077;&#1085;";
    $aptpl-> set("signleft",FALSE,TRUE);
    $aptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="RON")
{
    $unit = "Leu";
    $unit_plural = "Lei";
    $sign = "Lei";
    $aptpl-> set("signleft",FALSE,TRUE);
    $aptpl-> set("signright",TRUE,TRUE);
}
elseif($currency=="ZAR")
{
    $unit = "Rand";
    $unit_plural = "Rand";
    $sign = "R";
    $aptpl-> set("signleft",TRUE,TRUE);
    $aptpl-> set("signright",FALSE,TRUE);
}

$poss_don_amnt=explode(",",$settings["poss_don_amnt"]);
$aptpl-> set("poss_don_amnt",$poss_don_amnt);
$aptpl-> set("unit_plural",$unit_plural);

$aptpl-> set("unit",$unit);
$aptpl-> set("sign",$sign);
$aptpl-> set("currency",$currency);

$aptpl-> set("today",$settings["today"]);
$aptpl-> set("count",($settings["today"]+1));
$aptpl-> set("todayb",$settings["todayb"]);
$aptpl-> set("countb",($settings["todayb"]+1));

$aptpl-> set("togb",$settings["togb"]);
$aptpl-> set("countc",($settings["togb"]+1));
$aptpl-> set("togbb",$settings["togbb"]);
$aptpl-> set("countd",($settings["togbb"]+1));

$vip = (int)$settings["vip_rank"];
$zap_usr_v = get_result("SELECT prefixcolor,suffixcolor,level FROM {$TABLE_PREFIX}users_level WHERE id =$vip",true,$btit_settings["cache_duration"]);
$wyn_usr_v = $zap_usr_v[0];
$vipname = unesc($wyn_usr_v["prefixcolor"].$wyn_usr_v["level"].$wyn_usr_v["suffixcolor"]);
$aptpl-> set("vip_name",$vipname);

$aptpl->set("vip_show_1", (($CURUSER["id_level"]==1 || $CURUSER["id_level"]==$vip || $CURUSER["edit_forum"]=="yes")?false:true),true);
$aptpl->set("vip_show_2", (($CURUSER["id_level"]==1 || $CURUSER["id_level"]==$vip || $CURUSER["edit_forum"]=="yes")?false:true),true);
$aptpl->set("vip_show_3", (($CURUSER["id_level"]==$vip && $CURUSER["rank_switch"]=="yes" && $CURUSER["timed_rank"]>0 && $CURUSER["old_rank"]!=$vip)?true:false), true);
$aptpl->set("vip_show_4", (($CURUSER["id_level"]==$vip && $CURUSER["rank_switch"]=="yes" && $CURUSER["timed_rank"]>0 && $CURUSER["old_rank"]!=$vip)?false:true), true);
$aptpl->set("vip_show_5", (($CURUSER["id_level"]==$vip && $CURUSER["rank_switch"]=="yes" && $CURUSER["timed_rank"]>0 && $CURUSER["old_rank"]!=$vip)?true:false), true);
$aptpl->set("check_1", (($CURUSER["id_level"]==1 || $CURUSER["id_level"]==$vip || $CURUSER["edit_forum"]=="yes")?true:false),true);
$aptpl->set("check_2", (($CURUSER["id_level"]==$vip || $CURUSER["edit_forum"]=="yes")?false:true),true);
$aptpl->set("check_3", (($CURUSER["id_level"]==1)?true:false),true);
$aptpl->set("ul_show_1", (($CURUSER["id_level"]!=1)?true:false),true);
$aptpl->set("ul_show_2", (($CURUSER["id_level"]!=1)?true:false),true);
$aptpl->set("vip_expire", date("\p\a\s\\t jS F Y \a\\t g:ia",$CURUSER["timed_rank"]));
$aptpl->set("fl_slot_cost", $settings["fl_slot_cost"]);
$aptpl->set("fls_enabled1", (($btit_settings["fmhack_freeleech_slots"]=="enabled" && $settings["fl_slot"]=="true")?true:false), true);
$aptpl->set("fls_enabled2", (($btit_settings["fmhack_freeleech_slots"]=="enabled" && $settings["fl_slot"]=="true")?true:false), true);

?>