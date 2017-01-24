<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit.
//
//    Donation Historie ACP by DiemThuy ( Juni 2009 )
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



$admintpl->set("language",$language);

$action = $_GET['action'];
$returnto = "index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=don_hist";

$currency="";
if($btit_settings["fmhack_advanced_auto_donation_system"]=="enabled")
{
    $petr1=do_sqlquery("SELECT `units` FROM `{$TABLE_PREFIX}paypal_settings` WHERE `id`=1");
    if(@sql_num_rows($petr1)>0)
    {
        $fied=$petr1->fetch_assoc();
        $currency=$fied["units"];
    }
}

$r2=do_sqlquery("SELECT d.* , ul.prefixcolor, ul.suffixcolor , username , u.id FROM {$TABLE_PREFIX}users u INNER JOIN {$TABLE_PREFIX}don_historie d  ON u.id = d.don_id LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id ORDER BY username");
$donation=array();
$i=0;

if ($r2)
{
    while ($arr=$r2->fetch_assoc())
    {

        if ($currency=="")
        {
            $sign = (($btit_settings["dh_unit"]=="true")?"&#8364;":"&#36;");
            $sign_left = TRUE;
            $sign_right = FALSE;
        }
        else
        {
            if($currency=="AUD" || $currency=="CAD" || $currency=="HKD" || $currency=="NZD" || $currency=="SGD" || $currency=="USD")
            {
                $sign = "&#36;";
                $sign_left = TRUE;
                $sign_right = FALSE;
            }
            elseif($currency=="CZK")
            {
                $sign = "K&#269;";
                $sign_left = FALSE;
                $sign_right = TRUE;
            }
            elseif($currency=="DKK" || $currency=="NOK"  || $currency=="SEK")
            {
                $sign = "kr";
                $sign_left = FALSE;
                $sign_right = TRUE;
            }
            elseif($currency=="EUR")
            {
                $sign = "&#8364;";
                $sign_left = TRUE;
                $sign_right = FALSE;
            }
            elseif($currency=="HUF")
            {
                $sign = "Ft";
                $sign_left = FALSE;
                $sign_right = TRUE;
            }
            elseif($currency=="ILS")
            {
                $sign = "&#8362;";
                $sign_left = TRUE;
                $sign_right = FALSE;
            }
            elseif($currency=="JPY")
            {
                $sign = "&#165;";
                $sign_left = TRUE;
                $sign_right = FALSE;
            }
            elseif($currency=="MXN")
            {
                $sign = "&#36;";
                $sign_left = FALSE;
                $sign_right = TRUE;
            }
            elseif($currency=="PLN")
            {
                $sign = "z&#322;";
                $sign_left = FALSE;
                $sign_right = TRUE;
            }
            elseif($currency=="GBP")
            {
                $sign = "&#163;";
                $sign_left = TRUE;
                $sign_right = FALSE;
            }
            elseif($currency=="CHF")
            {
                $sign = "CHF";
                $sign_left = FALSE;
                $sign_right = TRUE;
            }
            elseif($currency=="BRL")
            {
                $sign = "R&#36;";
                $sign_left = TRUE;
                $sign_right = FALSE;
            }
            elseif($currency=="MYR")
            {
                $sign = "RM";
                $sign_left = TRUE;
                $sign_right = FALSE;
            }
            elseif($currency=="PHP")
            {
                $sign = "&#8369;";
                $sign_left = TRUE;
                $sign_right = FALSE;
            }
            elseif($currency=="TWD")
            {
                $sign = "NT&#36;";
                $sign_left = TRUE;
                $sign_right = FALSE;
            }
            elseif($currency=="THB")
            {
                $sign = "&#3647;";
                $sign_left = TRUE;
                $sign_right = FALSE;
            }
        }
        $namee=unesc($arr["prefixcolor"] . $arr["username"] . $arr["suffixcolor"]);
        $don = "<span style='color:green'>".substr($arr['donate_date'], 8, -9)."-".substr($arr['donate_date'], 5, -12)."-".substr($arr['donate_date'], 0,4)."</span><span style='color:purple'><br> ".(($sign_left===TRUE)?$sign:"").$arr['don_ation'].(($sign_right===TRUE)?$sign:"")."</span>";
        if  ($arr['donate_date_1']=='0000-00-00 00:00:00')
            $don1= "<span style='color:red'>".$language['ACP_NONE_YET']."</span>";
        else
            $don1 = "<span style='color:green'>".substr($arr['donate_date_1'], 8, -9)."-".substr($arr['donate_date_1'], 5, -12)."-".substr($arr['donate_date_1'], 0,4)."</span><span style='color:purple'><br> ".(($sign_left===TRUE)?$sign:"").$arr['don_ation_1'].(($sign_right===TRUE)?$sign:"")."</span>";
        if  ($arr['donate_date_2']=='0000-00-00 00:00:00')
            $don2= "<span style='color:red'>".$language['ACP_NONE_YET']."</span>";
        else
            $don2 = "<span style='color:green'>".substr($arr['donate_date_2'], 8, -9)."-".substr($arr['donate_date_2'], 5, -12)."-".substr($arr['donate_date_2'], 0,4)."</span><span style='color:purple'><br> ".(($sign_left===TRUE)?$sign:"").$arr['don_ation_2'].(($sign_right===TRUE)?$sign:"")."</span>";
        if  ($arr['donate_date_3']=='0000-00-00 00:00:00')
            $don3= "<span style='color:red'>".$language['ACP_NONE_YET']."</span>";
        else
            $don3 = "<span style='color:green'>".substr($arr['donate_date_3'], 8, -9)."-".substr($arr['donate_date_3'], 5, -12)."-".substr($arr['donate_date_3'], 0,4)."</span><span style='color:purple'><br> ".(($sign_left===TRUE)?$sign:"").$arr['don_ation_3'].(($sign_right===TRUE)?$sign:"")."</span>";
        if  ($arr['donate_date_4']=='0000-00-00 00:00:00')
            $don4= "<span style='color:red'>".$language['ACP_NONE_YET']."</span>";
        else
            $don4 = "<span style='color:green'>".substr($arr['donate_date_4'], 8, -9)."-".substr($arr['donate_date_4'], 5, -12)."-".substr($arr['donate_date_4'], 0,4)."</span><span style='color:purple'><br> ".(($sign_left===TRUE)?$sign:"").$arr['don_ation_4'].(($sign_right===TRUE)?$sign:"")."</span>";
        if  ($arr['donate_date_5']=='0000-00-00 00:00:00')
            $don5= "<span style='color:red'>".$language['ACP_NONE_YET']."</span>";
        else
            $don5 = "<span style='color:green'>".substr($arr['donate_date_5'], 8, -9)."-".substr($arr['donate_date_5'], 5, -12)."-".substr($arr['donate_date_5'], 0,4)."</span><span style='color:purple'><br> ".(($sign_left===TRUE)?$sign:"").$arr['don_ation_5'].(($sign_right===TRUE)?$sign:"")."</span>";
        if  ($arr['donate_date_6']=='0000-00-00 00:00:00')
            $don6= "<span style='color:red'>".$language['ACP_NONE_YET']."</span>";
        else
            $don6 = "<span style='color:green'>".substr($arr['donate_date_6'], 8, -9)."-".substr($arr['donate_date_6'], 5, -12)."-".substr($arr['donate_date_6'], 0,4)."</span><span style='color:purple'><br> ".(($sign_left===TRUE)?$sign:"").$arr['don_ation_6'].(($sign_right===TRUE)?$sign:"")."</span>";
        if  ($arr['donate_date_7']=='0000-00-00 00:00:00')
            $don7= "<span style='color:red'>".$language['ACP_NONE_YET']."</span>";
        else
            $don7 = "<span style='color:green'>".substr($arr['donate_date_7'], 8, -9)."-".substr($arr['donate_date_7'], 5, -12)."-".substr($arr['donate_date_7'], 0,4)."</span><span style='color:purple'><br> ".(($sign_left===TRUE)?$sign:"").$arr['don_ation_7'].(($sign_right===TRUE)?$sign:"")."</span>";
        if  ($arr['donate_date_8']=='0000-00-00 00:00:00')
            $don8= "<span style='color:red'>".$language['ACP_NONE_YET']."</span>";
        else
            $don8 = "<span style='color:green'>".substr($arr['donate_date_8'], 8, -9)."-".substr($arr['donate_date_8'], 5, -12)."-".substr($arr['donate_date_8'], 0,4)."</span><span style='color:purple'><br> ".(($sign_left===TRUE)?$sign:"").$arr['don_ation_8'].(($sign_right===TRUE)?$sign:"")."</span>";
        if  ($arr['donate_date_9']=='0000-00-00 00:00:00')
            $don9= "<span style='color:red'>".$language['ACP_NONE_YET']."</span>";
        else
            $don9 = "<span style='color:green'>".substr($arr['donate_date_9'], 8, -9)."-".substr($arr['donate_date_9'], 5, -12)."-".substr($arr['donate_date_9'], 0,4)."</span><span style='color:purple'><br> ".(($sign_left===TRUE)?$sign:"").$arr['don_ation_9'].(($sign_right===TRUE)?$sign:"")."</span>";
        if  ($arr['donate_date_10']=='0000-00-00 00:00:00')
            $don10= "<span style='color:red'>".$language['ACP_NONE_YET']."</span>";
        else
            $don10 = "<span style='color:green'>".substr($arr['donate_date_10'], 8, -9)."-".substr($arr['donate_date_10'], 5, -12)."-".substr($arr['donate_date_10'], 0,4)."</span><span style='color:purple'><br> ".(($sign_left===TRUE)?$sign:"").$arr['don_ation_10'].(($sign_right===TRUE)?$sign:"")."</span>";

        $donation[$i]["Username"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$arr["id"]."_".strtr($namee, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["id"])."'>".$namee."</a>";
        $donation[$i]["id"]=$arr["don_id"];
        $donation[$i]["a"]=$don;
        $donation[$i]["b"]=$don1;
        $donation[$i]["c"]=$don2;
        $donation[$i]["d"]=$don3;
        $donation[$i]["e"]=$don4;
        $donation[$i]["f"]=$don5;
        $donation[$i]["g"]=$don6;
        $donation[$i]["h"]=$don7;
        $donation[$i]["i"]=$don8;
        $donation[$i]["j"]=$don9;
        $donation[$i]["edit"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=don_edit&amp;id=".$donation[$i]["id"]."\">".image_or_link("$STYLEPATH/images/edit.png","",$language["EDIT"])."</a>";
        $i++;
    }
}
$admintpl->set("donation",$donation);
?>
