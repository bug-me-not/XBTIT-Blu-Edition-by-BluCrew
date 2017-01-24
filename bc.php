<?php

if (!defined("IN_BTIT"))
      die("non direct access!");

require_once (load_language("lang_aads.php")); 
// get settings
$zap_bc = get_result("SELECT * FROM {$TABLE_PREFIX}paypal_settings WHERE id ='1'",true,$btit_settings["cache_duration"]);
$settings = $zap_bc[0];

if($settings["bitcoin_address"]=="")
    stderr($language["ERROR"], $language["AADS_NO_BIT_ADDR"]);

$badCurrency=array('BRL', 'BGN', 'CZK', 'HUF', 'ILS', 'INR', 'LTL', 'MKD', 'MXN', 'MYR', 'NOK', 'PHP', 'RON', 'TWD', 'ZAR');
$currency=$settings["units"];
if(in_array($currency, $badCurrency))
{
    if($currency=="BRL")
        $paytype="Brazilian Real (BRL)";
    elseif($currency=="BGN")
        $paytype="Bulgarian Leva (BGN)";
    elseif($currency=="CZK")
        $paytype="Czech Koruna (CZK)";
    elseif($currency=="HUF")
        $paytype="Hungarian Forint (HUF)";
    elseif($currency=="ILS")
        $paytype="Israeli New Sheqel (ILS)";
    elseif($currency=="INR")
        $paytype="Indian Rupee (INR)";
    elseif($currency=="LTL")
        $paytype="Lithuanian Litai (LTL)";
    elseif($currency=="MKD")
        $paytype="Macedonian Denari (MKD)";
    elseif($currency=="MXN")
        $paytype="Mexican Peso (MXN)";
    elseif($currency=="MYR")
        $paytype="Malaysian Ringgits (MYR)";
    elseif($currency=="NOK")
        $paytype="Norwegian Krone (NOK)";
    elseif($currency=="PHP")
        $paytype="Philippine Pesos (PHP)";
    elseif($currency=="RON")
        $paytype="Romanian Lei (RON)";
    elseif($currency=="TWD")
        $paytype="Taiwan New Dollars (TWD)";
    elseif($currency=="ZAR")
        $paytype="South African Rand (ZAR)";

    stderr($language["ERROR"], $paytype." ".$language["AADS_NOT_SUP_BIT"]);
}
$bctpl= new bTemplate();
if ($currency=="AUD" || $currency=="CAD" || $currency=="HKD" || $currency=="NZD" || $currency=="SGD" || $currency=="USD")
{
    $unit = "Dollar";
    $unit_plural = "Dollars";
    $sign = "&#36;";
    $signLeft=true;
    $signRight=false;
    $bctpl-> set("signleft", $signLeft, true);
    $bctpl-> set("signright", $signRight, true);
}
elseif($currency=="DKK")
{
    $unit = "Krone";
    $unit_plural = "Kroner";
    $sign = "kr";
    $signLeft=false;
    $signRight=true;
    $bctpl-> set("signleft", $signLeft, true);
    $bctpl-> set("signright", $signRight, true);
}
elseif($currency=="EUR")
{
    $unit = "Euro";
    $unit_plural = "Euros";
    $sign = "&#8364;";
    $signLeft=true;
    $signRight=false;
    $bctpl-> set("signleft", $signLeft, true);
    $bctpl-> set("signright", $signRight, true);
}
elseif($currency=="JPY")
{
    $unit = "Yen";
    $unit_plural = "Yen";
    $sign = "&#165;";
    $signLeft=true;
    $signRight=false;
    $bctpl-> set("signleft", $signLeft, true);
    $bctpl-> set("signright", $signRight, true);
}
elseif($currency=="PLN")
{
    $unit = "Z&#322;oty";
    $unit_plural = "z&#322;otych";
    $sign = "z&#322;";
    $signLeft=false;
    $signRight=true;
    $bctpl-> set("signleft", $signLeft, true);
    $bctpl-> set("signright", $signRight, true);
}
elseif($currency=="GBP")
{
    $unit = "Pound";
    $unit_plural = "Pounds";
    $sign = "&#163;";
    $signLeft=true;
    $signRight=false;
    $bctpl-> set("signleft", $signLeft, true);
    $bctpl-> set("signright", $signRight, true);
}
elseif($currency=="SEK")
{
    $unit = "Krona";
    $unit_plural = "Kronor";
    $sign = "kr";
    $signLeft=false;
    $signRight=true;
    $bctpl-> set("signleft", $signLeft, true);
    $bctpl-> set("signright", $signRight, true);
}
elseif($currency=="CHF")
{
    $unit = "Franc";
    $unit_plural = "Francs";
    $sign = "CHF";
    $signLeft=false;
    $signRight=true;
    $bctpl-> set("signleft", $signLeft, true);
    $bctpl-> set("signright", $signRight, true);
}
elseif($currency=="THB")
{
    $unit = "Baht";
    $unit_plural = "Baht";
    $sign = "&#3647;";
    $signLeft=true;
    $signRight=false;
    $bctpl-> set("signleft", $signLeft, true);
    $bctpl-> set("signright", $signRight, true);
}
elseif($currency=="CNY")
{
    $unit = "Yuan";
    $unit_plural = "Yuan";
    $sign = "&#165;";
    $signLeft=true;
    $signRight=false;
    $bctpl-> set("signleft", $signLeft, true);
    $bctpl-> set("signright", $signRight, true);
}
elseif($currency=="RUB")
{
    $unit = "Ruble";
    $unit_plural = "Rubles";
    $sign = "&#1088;&#1091;&#1073;";
    $signLeft=false;
    $signRight=true;
    $bctpl-> set("signleft", $signLeft, true);
    $bctpl-> set("signright", $signRight, true);
}
if(isset($_POST) && !empty($_POST))
{
    $donationAmount=(float)0+$_POST["amount"];
    $itemNumber=(int)0+$_POST["item_number"];
    $price_in_btc = @file_get_contents("https://blockchain.info/tobtc?currency=".$currency."&value=".$donationAmount);
    if($http_response_header[0]=="HTTP/1.1 200 OK")
    {
        $secret=sqlesc(pass_the_salt(12));
        quickQuery("INSERT INTO `{$TABLE_PREFIX}bitcoin_invoices` (`invoice_id`, `tracker_id`, `secret`, `currency`, `price_in_currency`, `price_in_btc`, `product_type`, `added`) values(NULL, '".$CURUSER["uid"]."', '".$secret."', '".$currency."', '".$donationAmount."', '".$price_in_btc."','".$itemNumber."', UNIX_TIMESTAMP())", true);
        $invoiceID=sql_insert_id();
        $createLink=@file_get_contents("https://blockchain.info/api/receive?method=create&address=".$settings["bitcoin_address"]."&shared=false&callback=".urlencode($BASEURL."/bitcoin.php?invoice=".$invoiceID."&id=".$CURUSER["uid"]."&secret=".base64_encode($secret)));
        if($http_response_header[0]=="HTTP/1.1 200 OK")
        {
            $response=json_decode($createLink);
            $bitcoinLink="bitcoin:".$response->input_address."?amount=".$price_in_btc;
            include_once($THIS_BASEPATH."/include/phpqrcode/qrlib.php");
            $qrImage="torrents/".$invoiceID."-".$CURUSER["uid"].".png";
            QRcode::png($bitcoinLink, $qrImage, 'L', 4, 2);
            $tpl->set("bc_extra_params", "inv=".$invoiceID."&id=".$CURUSER["uid"]);
            quickQuery("UPDATE `{$TABLE_PREFIX}bitcoin_invoices` SET `input_address`='".sql_esc($response->input_address)."' WHERE `invoice_id`='".$invoiceID."' AND `tracker_id`='".$CURUSER["uid"]."'", true);
            information_msg($language["AADS_BIT_DON"], $language["AADS_BIT_INFO_1"]." <b>".$price_in_btc." BTC</b> (".$language["AADS_BIT_INFO_2"]." <b>".(($signLeft)?$sign:"").$donationAmount.(($signRight)?$sign:"")." [".$currency."]</b>) ".$language["AADS_BIT_INFO_3"].":<br /><br /><a href='".$bitcoinLink."'>".$response->input_address."</a><br /><br /><img src='".$qrImage."' /><br /><br />".$language["AADS_BIT_INFO_4"]."<br /><br /><div id=\"bitcoin_payment_status\"></div><br /><hr><br />".$language["AADS_BIT_INFO_5"]);
        }
        else
        {
            quickQuery("DELETE FROM `{$TABLE_PREFIX}bitcoin_invoices` WHERE `invoice_id`='".$invoiceID."' AND `tracker_id`='".$CURUSER["uid"]."'");
            stderr($language["ERROR"], $language["AADS_BIT_CANNOT"]);
        }
    }
}
$bctpl-> set("language",$language);
$bctpl-> set("url_back",$BASEURL);
$bctpl-> set("site",$SITENAME);
$user=unesc($CURUSER["prefixcolor"].$CURUSER["username"].$CURUSER["suffixcolor"]);
$bctpl-> set("user",$user);
$bctpl-> set("uid",$CURUSER["uid"]);
$bctpl-> set("days",$settings["vip_days"]);
$bctpl-> set("days_plural", (($settings["vip_days"]==1)?false:true),true);
$bctpl-> set("daysb",$settings["vip_daysb"]);
$bctpl-> set("daysb_plural", (($settings["vip_daysb"]==1)?false:true),true);
$bctpl-> set("daysc",$settings["vip_daysc"]);
$bctpl-> set("daysc_plural", (($settings["vip_daysc"]==1)?false:true),true);
$bctpl-> set("gb",$settings["gb"]);
$bctpl-> set("gbb",$settings["gbb"]);
$bctpl-> set("gbc",$settings["gbc"]);
$bctpl-> set("bitcoin_address",$settings["bitcoin_address"]);

$poss_don_amnt=explode(",",$settings["poss_don_amnt"]);
$bctpl-> set("poss_don_amnt",$poss_don_amnt);
$bctpl-> set("unit_plural",$unit_plural);

$bctpl-> set("unit",$unit);
$bctpl-> set("sign",$sign);
$bctpl-> set("currency",$currency);

$bctpl-> set("today",$settings["today"]);
$bctpl-> set("count",($settings["today"]+1));
$bctpl-> set("todayb",$settings["todayb"]);
$bctpl-> set("countb",($settings["todayb"]+1));

$bctpl-> set("togb",$settings["togb"]);
$bctpl-> set("countc",($settings["togb"]+1));
$bctpl-> set("togbb",$settings["togbb"]);
$bctpl-> set("countd",($settings["togbb"]+1));

$vip = (int)$settings["vip_rank"];
$zap_usr_v = get_result("SELECT prefixcolor,suffixcolor,level FROM {$TABLE_PREFIX}users_level WHERE id =$vip",true,$btit_settings["cache_duration"]);
$wyn_usr_v = $zap_usr_v[0];
$vipname = unesc($wyn_usr_v["prefixcolor"].$wyn_usr_v["level"].$wyn_usr_v["suffixcolor"]);
$bctpl-> set("vip_name",$vipname);

$bctpl->set("vip_show_1", (($CURUSER["id_level"]==1 || $CURUSER["id_level"]==$vip || $CURUSER["edit_forum"]=="yes")?false:true),true);
$bctpl->set("vip_show_2", (($CURUSER["id_level"]==1 || $CURUSER["id_level"]==$vip || $CURUSER["edit_forum"]=="yes")?false:true),true);
$bctpl->set("vip_show_3", (($CURUSER["id_level"]==$vip && $CURUSER["rank_switch"]=="yes" && $CURUSER["timed_rank"]>0 && $CURUSER["old_rank"]!=$vip)?true:false), true);
$bctpl->set("vip_show_4", (($CURUSER["id_level"]==$vip && $CURUSER["rank_switch"]=="yes" && $CURUSER["timed_rank"]>0 && $CURUSER["old_rank"]!=$vip)?false:true), true);
$bctpl->set("vip_show_5", (($CURUSER["id_level"]==$vip && $CURUSER["rank_switch"]=="yes" && $CURUSER["timed_rank"]>0 && $CURUSER["old_rank"]!=$vip)?true:false), true);
$bctpl->set("check_1", (($CURUSER["id_level"]==1 || $CURUSER["id_level"]==$vip || $CURUSER["edit_forum"]=="yes")?true:false),true);
$bctpl->set("check_2", (($CURUSER["id_level"]==$vip || $CURUSER["edit_forum"]=="yes")?false:true),true);
$bctpl->set("check_3", (($CURUSER["id_level"]==1)?true:false),true);
$bctpl->set("ul_show_1", (($CURUSER["id_level"]!=1)?true:false),true);
$bctpl->set("ul_show_2", (($CURUSER["id_level"]!=1)?true:false),true);
$bctpl->set("vip_expire", date("\p\a\s\\t jS F Y \a\\t g:ia",$CURUSER["timed_rank"]));
$bctpl->set("fl_slot_cost", $settings["fl_slot_cost"]);
$bctpl->set("fls_enabled1", (($btit_settings["fmhack_freeleech_slots"]=="enabled" && $settings["fl_slot"]=="true")?true:false), true);
$bctpl->set("fls_enabled2", (($btit_settings["fmhack_freeleech_slots"]=="enabled" && $settings["fl_slot"]=="true")?true:false), true);

?>