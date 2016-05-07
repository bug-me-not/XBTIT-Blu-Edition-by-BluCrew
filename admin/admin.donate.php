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
if(!defined("IN_BTIT"))
    die("non direct access!");
if(!defined("IN_ACP"))
    die("non direct access!");

require_once (load_language("lang_aads.php"));
if(!isset($CURUSER) || !is_array($CURUSER))
{
    session_name("BluRG");
    session_start();
    $CURUSER = $_SESSION["CURUSER"];
}
if(isset($_POST) && !empty($_POST))
{

    (isset($_POST["donate_mode"]) && $_POST["donate_mode"]=="custom") ? $donate_mode="custom" : $donate_mode="classic";


    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$donate_mode."' WHERE `key`='donate_mode'", true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);

}
if($btit_settings["donate_mode"]=="classic")
{
$admintpl->set("new_1", (($btit_settings["donate_mode"] == "classic" && $btit_settings["donate_mode"] == "custom")?true:false), true);
}
else{
$admintpl->set("new_1", (($btit_settings["donate_mode"] == "custom" && $btit_settings["donate_mode"] == "custom")?true:false), true);
}
$admintpl->set("custom", (($btit_settings["donate_mode"]=="custom")?true:false), true);
$admintpl->set("classic", (($btit_settings["donate_mode"]=="classic")?true:false), true);
$action = $_GET['action'];
// update donate settings in the database
if($action == 'update')
{
    $DT1 = sql_esc($_POST["pp_unit"]);
    $DT2 = sql_esc($_POST["pp_test"]);
    $DT3 = sql_esc($_POST["pp_scrol"]);
    $DT5 = sql_esc($_POST['pp_email_sand']);
    $DT6 = sql_esc($_POST['pp_email']);
    $DT7 = sql_esc($_POST['pp_day']);
    $DT77 = sql_esc($_POST['pp_dayb']);
    $DT777 = sql_esc($_POST['pp_dayc']);
    $DT8 = sql_esc($_POST['pp_rank']);
    $DT9 = sql_esc($_POST['pp_needed']);
    $DT10 = sql_esc($_POST['pp_received']);
    $DT11 = sql_esc($_POST['pp_due_date']);
    $DT12 = sql_esc($_POST['pp_scrol_tekst']);
    $DT13 = sql_esc($_POST['pp_block']);
    $DT14 = sql_esc($_POST['pp_historie']);
    $DT15 = sql_esc($_POST['pp_don_star']);
    $DT16 = sql_esc($_POST['pp_gb']);
    $DT166 = sql_esc($_POST['pp_gbb']);
    $DT1666 = sql_esc($_POST['pp_gbc']);
    $DT17 = (isset($_POST['pp_smf'])?sql_esc($_POST['pp_smf']):false);
    $DT18 = sql_esc($_POST['pp_togb']);
    $DT19 = sql_esc($_POST['pp_togbb']);
    $DT20 = sql_esc($_POST['pp_togbc']);
    $DT21 = sql_esc($_POST['pp_today']);
    $DT22 = sql_esc($_POST['pp_todayb']);
    $DT23 = sql_esc($_POST['pp_todayc']);
    $DT24 = sql_esc($_POST['ap_email']);
    $DT25 = sql_esc($_POST['ap_sec']);
    $DT26 = sql_esc($_POST['pp_pp']);
    $DT27 = sql_esc($_POST['pp_ap']);
    $DT28 = sql_esc($_POST['pp_auto']);
    $PET1 = trim(str_replace(" ", "", sql_esc($_POST['poss_don_amnt'])), ",");
    $PET2 = sql_esc($_POST['fl_slot']);
    $PET3 = sql_esc((int)0+$_POST['fl_slot_cost']);
    $PET4 = sql_esc($_POST['bitcoin_enabled']);
    $PET5 = sql_esc($_POST['bitcoin_address']);
    $COOLY1 = sql_esc($_POST['pp_IPN']);
    $COOLY2 = sql_esc($_POST['identity_token']);
    $test = explode(",", $PET1);
    $ok = true;
    foreach($test as $v)
    {
        if(!is_numeric($v))
        {
            $ok = false;
            break;
        }
    }
    if($ok === false)
        stderr($language["ERROR"], $language["AADS_POSS_DON_WRONG"]);
    quickQuery("UPDATE `{$TABLE_PREFIX}paypal_settings` SET `units`='".$DT1."',`test`='".$DT2."',`donation_block`='".$DT3."',`sandbox_email`='".$DT5."',`paypal_email`='".$DT6."',`vip_days`='".$DT7.
        "',`vip_daysb`='".$DT77."',`vip_daysc`='".$DT777."',`vip_rank`='".$DT8."',`needed`='".$DT9."',`received`='".$DT10."', `due_date`='".$DT11."', `num_block`='".$DT13."' , `scrol_tekst`='".$DT12.
        "' ,`historie`='".$DT14."',`don_star`='".$DT15."',`gb`='".$DT16."',`gbb`='".$DT166."',`gbc`='".$DT1666."',".(($DT17!==false)?"`smf`='".$DT17."',":"")."`togb`='".$DT18."',`togbb`='".$DT19."',`togbc`='".$DT20."',`today`='".$DT21.
        "',`todayb`='".$DT22."',`todayc`='".$DT23."',`alertpay_email`='".$DT24."',`alertpay_code`='".$DT25."',`pp`='".$DT26."',`ap`='".$DT27."',`auto`='".$DT28."',`poss_don_amnt`='".$PET1."', `IPN`='".$COOLY1.
        "',`identity_token`='".$COOLY2."', `fl_slot`='".$PET2."', `fl_slot_cost`='".$PET3."', `bc`='".$PET4."', `bitcoin_address`='".$PET5."' WHERE `id`='1'", true);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=donate");
    exit();
}
//Here we will select the data from the table donors
$settings = get_result("SELECT * FROM {$TABLE_PREFIX}paypal_settings WHERE id ='1'", true, $btit_settings["cache_duration"]);
$pay = $settings[0];
$admintpl->set("language", $language);
$admintpl->set("bc_enabled", (($pay["bc"]=="true")?true:false), true);
$admintpl->set("bc_disabled", (($pay["bc"]=="true")?false:true), true);
$admintpl->set("bitcoin_address", $pay["bitcoin_address"]);
if($pay["auto"] == 'true')
    $pp_autoyes = "checked";
else
    if($pay["auto"] == 'false')
        $pp_autono = "checked";
if($pay["pp"] == 'true')
    $pp_ppyes = "checked";
else
    if($pay["pp"] == 'false')
        $pp_ppno = "checked";
if($pay["ap"] == 'true')
    $pp_apyes = "checked";
else
    if($pay["ap"] == 'false')
        $pp_apno = "checked";
if($pay["units"] == 'true')
    $pp_unityes = "checked";
else
    if($pay["units"] == 'false')
        $pp_unitno = "checked";
if($pay["test"] == 'true')
    $pp_testyes = "checked";
else
    if($pay["test"] == 'false')
        $pp_testno = "checked";
if($pay["donation_block"] == 'true')
    $pp_scrolyes = "checked";
else
    if($pay["donation_block"] == 'false')
        $pp_scrolno = "checked";
if($pay["historie"] == 'true')
    $pp_historieyes = "checked";
else
    if($pay["historie"] == 'false')
        $pp_historieno = "checked";
if($pay["don_star"] == 'true')
    $pp_don_staryes = "checked";
else
    if($pay["don_star"] == 'false')
        $pp_don_starno = "checked";
if($pay["IPN"] == 'true')
    $pp_IPN_yes = "checked";
elseif($pay["IPN"] == 'false')
    $pp_IPN_no = "checked";
$currency = $pay["units"];
if($currency == "AUD" || $currency == "CAD" || $currency == "HKD" || $currency == "NZD" || $currency == "SGD" || $currency == "USD")
{
    $sign = "&#36;";
    $sign_left = true;
    $sign_right = false;
}
elseif($currency == "CNY")
{
    $sign = "&#165;";
    $sign_left = true;
    $sign_right = false;
}
elseif($currency == "CZK")
{
    $sign = "K&#269;";
    $sign_left = false;
    $sign_right = true;
}
elseif($currency == "DKK" || $currency == "NOK" || $currency == "SEK")
{
    $sign = "kr";
    $sign_left = false;
    $sign_right = true;
}
elseif($currency == "EUR")
{
    $sign = "&#8364;";
    $sign_left = true;
    $sign_right = false;
}
elseif($currency == "HUF")
{
    $sign = "Ft";
    $sign_left = false;
    $sign_right = true;
}
elseif($currency == "ILS")
{
    $sign = "&#8362;";
    $sign_left = true;
    $sign_right = false;
}
elseif($currency == "JPY")
{
    $sign = "&#165;";
    $sign_left = true;
    $sign_right = false;
}
elseif($currency == "MXN")
{
    $sign = "&#36;";
    $sign_left = false;
    $sign_right = true;
}
elseif($currency == "PLN")
{
    $sign = "z&#322;";
    $sign_left = false;
    $sign_right = true;
}
elseif($currency == "GBP")
{
    $sign = "&#163;";
    $sign_left = true;
    $sign_right = false;
}
elseif($currency == "CHF")
{
    $sign = "CHF";
    $sign_left = false;
    $sign_right = true;
}
elseif($currency == "BRL")
{
    $sign = "R&#36;";
    $sign_left = true;
    $sign_right = false;
}
elseif($currency == "MYR")
{
    $sign = "RM";
    $sign_left = true;
    $sign_right = false;
}
elseif($currency == "PHP")
{
    $sign = "&#8369;";
    $sign_left = true;
    $sign_right = false;
}
elseif($currency == "RUB")
{
    $sign = "&#1088;&#1091;&#1073;";
    $sign_left = false;
    $sign_right = true;
}
elseif($currency == "TWD")
{
    $sign = "NT&#36;";
    $sign_left = true;
    $sign_right = false;
}
elseif($currency == "THB")
{
    $sign = "&#3647;";
    $sign_left = true;
    $sign_right = false;
}
else
{
    $sign = "";
    $sign_left = false;
    $sign_right = false;
}
$admintpl->set("ppauto", "<td class=lista colspan='3'>&nbsp;&nbsp;".$language["AADS_ENABLE"]."&nbsp;<input type=radio name=pp_auto value=true ".$pp_autoyes.
    " />&nbsp;&nbsp;".$language["AADS_DISABLE"]."&nbsp;<input type=radio name=pp_auto value=false ".$pp_autono." /></td> ");
$admintpl->set("pppp", "<td class=lista>&nbsp;&nbsp;".$language["AADS_ENABLE"]."&nbsp;<input type=radio name=pp_pp value=true ".$pp_ppyes." />&nbsp;&nbsp;".$language["AADS_DISABLE"]."&nbsp;<input type=radio name=pp_pp value=false ".$pp_ppno.
    " /></td> ");
$admintpl->set("ppap", "<td class=lista colspan=3>&nbsp;&nbsp;".$language["AADS_ENABLE"]."&nbsp;<input type=radio name=pp_ap value=true ".$pp_apyes." />&nbsp;&nbsp;".$language["AADS_DISABLE"]."&nbsp;<input type=radio name=pp_ap value=false ".$pp_apno.
    " /></td> ");
$admintpl->set("testtttt", "<td class=lista>&nbsp;&nbsp;".$language["AADS_ENABLE"]."&nbsp;<input type=radio name=pp_don_star value=true ".$pp_don_staryes.
    " />&nbsp;&nbsp;".$language["AADS_DISABLE"]."&nbsp;<input type=radio name=pp_don_star value=false ".$pp_don_starno." /></td> ");
$admintpl->set("testtt", "<td class=lista>&nbsp;&nbsp;".$language["AADS_ENABLE"]."&nbsp;<input type=radio name=pp_scrol value=true ".$pp_scrolyes." />&nbsp;&nbsp;".$language["AADS_DISABLE"]."&nbsp;<input type=radio name=pp_scrol value=false ".
    $pp_scrolno." /></td> ");
$admintpl->set("testt", "<td class=lista><select name='pp_unit'>
<option value='AUD'".(($pay["units"] == "AUD")?" selected='yes'":"").">Australian Dollar (AUD) [".$language["AADS_PAYPAL"]."|".$language["AADS_PAYZA"]."|".$language["AADS_BITCOIN"]."]</option>
<option value='BRL'".(($pay["units"] == "BRL")?" selected='yes'":"").">Brazilian Real (BRL) [".$language["AADS_PAY_ONLY"]."]</option>
<option value='BGN'".(($pay["units"] == "BGN")?" selected='yes'":"").">Bulgarian Leva (BGN) [".$language["AADS_PZA_ONLY"]."]</option>
<option value='CAD'".(($pay["units"] == "CAD")?" selected='yes'":"").">Canadian Dollar (CAD) [".$language["AADS_PAYPAL"]."|".$language["AADS_PAYZA"]."|".$language["AADS_BITCOIN"]."]</option>
<option value='CNY'".(($pay["units"] == "CNY")?" selected='yes'":"").">Chinese Yuan (CNY) [".$language["AADS_BC_ONLY"]."]</option>
<option value='CZK'".(($pay["units"] == "CZK")?" selected='yes'":"").">Czech Koruna (CZK) [".$language["AADS_PAYPAL"]."|".$language["AADS_PAYZA"]."]</option>
<option value='DKK'".(($pay["units"] == "DKK")?" selected='yes'":"").">Danish Krone (DKK) [".$language["AADS_PAYPAL"]."|".$language["AADS_PAYZA"]."]</option>
<option value='EUR'".(($pay["units"] == "EUR")?" selected='yes'":"").">Euro (EUR) [".$language["AADS_PAYPAL"]."|".$language["AADS_PAYZA"]."|".$language["AADS_BITCOIN"]."]</option>
<option value='HKD'".(($pay["units"] == "HKD")?" selected='yes'":"").">Hong Kong Dollar (HKD) [".$language["AADS_PAYPAL"]."|".$language["AADS_PAYZA"]."|".$language["AADS_BITCOIN"]."]</option>
<option value='HUF'".(($pay["units"] == "HUF")?" selected='yes'":"").">Hungarian Forint (HUF) [".$language["AADS_PAYPAL"]."|".$language["AADS_PAYZA"]."]</option>
<option value='INR'".(($pay["units"] == "INR")?" selected='yes'":"").">Indian Rupee (INR) [".$language["AADS_PZA_ONLY"]."]</option>
<option value='ILS'".(($pay["units"] == "ILS")?" selected='yes'":"").">Israeli New Sheqel (ILS) [".$language["AADS_PAY_ONLY"]."]</option>
<option value='JPY'".(($pay["units"] == "JPY")?" selected='yes'":"").">Japanese Yen (JPY) [".$language["AADS_PAYPAL"]."|".$language["AADS_BITCOIN"]."]</option>
<option value='LTL'".(($pay["units"] == "LTL")?" selected='yes'":"").">Lithuanian Litai (LTL) [".$language["AADS_PZA_ONLY"]."]</option>
<option value='MKD'".(($pay["units"] == "MKD")?" selected='yes'":"").">Macedonian Dinars (MKD) [".$language["AADS_PZA_ONLY"]."]</option>
<option value='MYR'".(($pay["units"] == "MYR")?" selected='yes'":"").">Malaysian Ringgits (MYR) [".$language["AADS_PAYPAL"]."|".$language["AADS_PAYZA"]."]</option>
<option value='MXN'".(($pay["units"] == "MXN")?" selected='yes'":"").">Mexican Peso (MXN) [".$language["AADS_PAY_ONLY"]."]</option>
<option value='NZD'".(($pay["units"] == "NZD")?" selected='yes'":"").">New Zealand Dollar (NZD) [".$language["AADS_PAYPAL"]."|".$language["AADS_PAYZA"]."|".$language["AADS_BITCOIN"]."]</option>
<option value='NOK'".(($pay["units"] == "NOK")?" selected='yes'":"").">Norwegian Krone (NOK) [".$language["AADS_PAYPAL"]."|".$language["AADS_PAYZA"]."]</option>
<option value='PHP'".(($pay["units"] == "PHP")?" selected='yes'":"").">Philippine Pesos (PHP) [".$language["AADS_PAY_ONLY"]."]</option>
<option value='PLN'".(($pay["units"] == "PLN")?" selected='yes'":"").">Polish Zloty (PLN) [".$language["AADS_PAYPAL"]."|".$language["AADS_PAYZA"]."|".$language["AADS_BITCOIN"]."]</option>
<option value='GBP'".(($pay["units"] == "GBP")?" selected='yes'":"").">Pound Sterling (GBP) [".$language["AADS_PAYPAL"]."|".$language["AADS_PAYZA"]."|".$language["AADS_BITCOIN"]."]</option>
<option value='RON'".(($pay["units"] == "RON")?" selected='yes'":"").">Romanian Lei (RON) [".$language["AADS_PZA_ONLY"]."]</option>
<option value='RUB'".(($pay["units"] == "RUB")?" selected='yes'":"").">Russian Ruble (RUB) [".$language["AADS_BC_ONLY"]."]</option>
<option value='SGD'".(($pay["units"] == "SGD")?" selected='yes'":"").">Singapore Dollar (SGD) [".$language["AADS_PAYPAL"]."|".$language["AADS_PAYZA"]."|".$language["AADS_BITCOIN"]."]</option>
<option value='ZAR'".(($pay["units"] == "ZAR")?" selected='yes'":"").">South African Rand (ZAR) [".$language["AADS_PZA_ONLY"]."]</option>
<option value='SEK'".(($pay["units"] == "SEK")?" selected='yes'":"").">Swedish Kronor (SEK) [".$language["AADS_PAYPAL"]."|".$language["AADS_PAYZA"]."|".$language["AADS_BITCOIN"]."]</option>
<option value='CHF'".(($pay["units"] == "CHF")?" selected='yes'":"").">Swiss Franc (CHF) [".$language["AADS_PAYPAL"]."|".$language["AADS_PAYZA"]."|".$language["AADS_BITCOIN"]."]</option>
<option value='TWD'".(($pay["units"] == "TWD")?" selected='yes'":"").">Taiwan New Dollars (TWD) [".$language["AADS_PAY_ONLY"]."]</option>
<option value='THB'".(($pay["units"] == "THB")?" selected='yes'":"").">Thai Baht (THB) [".$language["AADS_PAYPAL"]."|".$language["AADS_BITCOIN"]."]</option>
<option value='USD'".(($pay["units"] == "USD")?" selected='yes'":"").">U.S. Dollar (USD) [".$language["AADS_PAYPAL"]."|".$language["AADS_PAYZA"]."|".$language["AADS_BITCOIN"]."]</option>
</select></td>");
$admintpl->set("test", "<td class=lista>&nbsp;&nbsp;sandbox&nbsp;<input type=radio name=pp_test value=true  ".$pp_testyes." />&nbsp;&nbsp;Paypal&nbsp;<input type=radio name=pp_test value=false ".$pp_testno.
    " /></td>");
$admintpl->set("Itest", "<td class=lista>&nbsp;&nbsp;&nbsp;IPN&nbsp;<input type=radio name=pp_IPN value=true  ".$pp_IPN_yes." />&nbsp;&nbsp;PDT&nbsp;<input type=radio name=pp_IPN value=false ".$pp_IPN_no.
    " /></td>");
$admintpl->set("testttt", "<td class=lista>&nbsp;&nbsp;enable&nbsp;<input type=radio name=pp_historie value=true  ".$pp_historieyes.
    " />&nbsp;&nbsp;disable&nbsp;<input type=radio name=pp_historie value=false ".$pp_historieno." /></td>");
$admintpl->set("pp_email_sand", $pay["sandbox_email"]);
$admintpl->set("pp_email", $pay["paypal_email"]);
$admintpl->set("ap_email", $pay["alertpay_email"]);
$admintpl->set("ap_sec", $pay["alertpay_code"]);
$admintpl->set("pp_token", $pay["identity_token"]);
$admintpl->set("pp_day", $pay["vip_days"]);
$admintpl->set("pp_dayb", $pay["vip_daysb"]);
$admintpl->set("pp_dayc", $pay["vip_daysc"]);
$admintpl->set("integratedForumInUse1", ((substr($FORUMLINK,0,3)=="smf" || $FORUMLINK=="ipb")?true:false), true);
$admintpl->set("integratedForumInUse2", ((substr($FORUMLINK,0,3)=="smf" || $FORUMLINK=="ipb")?true:false), true);

$selectStart="<select name='pp_rank'>\n";
$selectEnd="</select>\n";

$res=get_result("SELECT id, level FROM `{$TABLE_PREFIX}users_level` ORDER BY ".(($btit_settings["fmhack_logical_rank_ordering"] == "enabled")?"`logical_rank_order` ASC,":"")." `id` ASC", true, $btit_settings["cache_duration"]);
foreach($res as $row)
{
    $selectStart .= "<option value='".$row["id"]."'".(($row["id"]==$pay["vip_rank"])?" selected='selected'":"").">".$row["level"]."</option>\n";
}
$admintpl->set("pp_rank", $selectStart.$selectEnd);

if(substr($FORUMLINK,0,3)=="smf" || $FORUMLINK=="ipb")
{
    $selectStart="<select name='pp_smf'>\n";

    if(substr($FORUMLINK, 0, 3) == "smf")
        $res = get_result("SELECT ".(($FORUMLINK == "smf")?"`ID_GROUP` `id`, `groupName` `level`":"`id_group` `id`, `group_name` `level`")." FROM `{$db_prefix}membergroups` ORDER BY `id_group` ASC", true, $btit_settings["cache_duration"]);
    elseif($FORUMLINK == "ipb")
        $res = get_result("SELECT `perm_name` `level`, `perm_id` `id` FROM `{$ipb_prefix}forum_perms` ORDER BY `perm_id` ASC", true);

    foreach($res as $row)
    {
        $selectStart .= "<option value='".$row["id"]."'".(($row["id"]==$pay["smf"])?" selected='selected'":"").">".$row["level"]."</option>\n";
    }
    $admintpl->set("pp_smf", $selectStart.$selectEnd);
}

$admintpl->set("pp_gb", $pay["gb"]);
$admintpl->set("pp_gbb", $pay["gbb"]);
$admintpl->set("pp_gbc", $pay["gbc"]);
$admintpl->set("pp_togb", $pay["togb"]);
$admintpl->set("pp_togbb", $pay["togbb"]);
$admintpl->set("pp_today", $pay["today"]);
$admintpl->set("pp_todayb", $pay["todayb"]);
$admintpl->set("pp_count", ($pay["today"] + 1));
$admintpl->set("pp_counta", ($pay["togb"] + 1));
$admintpl->set("pp_countb", ($pay["todayb"] + 1));
$admintpl->set("pp_countc", ($pay["togbb"] + 1));
$admintpl->set("pp_needed", $pay["needed"]);
$admintpl->set("pp_received", $pay["received"]);
$admintpl->set("pp_due_date", $pay["due_date"]);
$admintpl->set("pp_block", $pay["num_block"]);
$admintpl->set("pp_scrol_tekst", $pay["scrol_tekst"]);
$admintpl->set("poss_don_amnt", $pay["poss_don_amnt"]);
$admintpl->set("fl_slot_true", (($pay["fl_slot"]=="true")?true:false), true);
$admintpl->set("fl_slot_false", (($pay["fl_slot"]=="true")?false:true), true);
$admintpl->set("fl_slot_cost", $pay["fl_slot_cost"]);
$admintpl->set("frm_action", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=donate&amp;action=update");
// donors list
$donres = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}donors");
$row = $donres->fetch_array();
$count = $row[0];
$perpage = 25;
list($pagertop, $pagerbottom, $limit) = pager($perpage, $count, "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=donate&amp;");
$donor = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}donors ORDER BY date DESC $limit") or die(sql_error());
$row = @sql_num_rows($donor);
$don = array();
$i = 0;
if(sql_num_rows($donor) == 0)
{
    $don[$i]["Username"] = ("<center><span style='color:green'>".$language["AADS_NOTHING"]."</span></center>");
    $don[$i]["Anonymous"] = ("<center><span style='color:green'>".$language['AADS_HERE']."</span></center>");
    $don[$i]["Last_name"] = ("<center><span style='color:green'>".$language['AADS_YET']."</span></center>");
    $i++;
}
else
{
    while($arr = $donor->fetch_assoc())
    {
        if($arr["userid"] == "0")
        {
            // Do Nothing
        }
        else
        {
            $res = do_sqlquery("SELECT `u`.`timed_rank`, `u`.`username`, `ul1`.`id_level` `a3_id_level`, `ul1`.`prefixcolor` `a3_prefixcolor`,`ul1`.`suffixcolor` `a3_suffixcolor`, `ul2`.`level` `a4_level`, `ul2`.`prefixcolor` `a4_prefixcolor`,`ul2`.`suffixcolor` `a4_suffixcolor` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul1` ON `u`.`id_level`=`ul1`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul2` ON `u`.`old_rank`=`ul2`.`id` WHERE `u`.`id`=".
                $arr["userid"]." AND ".$arr["userid"]." > 0");
            $row = $res->fetch_assoc();
            if($arr['first_name'] == "anonymous")
            {
                $ano = "<span style='color:red'>".$language['AADS_YES']."</span>";
                $vip = "<span style='color:red'>".$language['AADS_NO_TIMED_RANK']."</span>";
                $rank = "<span style='color:red'>".$language['AADS_NO_OLD_RANK']."</span>";
                $upload = "<span style='color:red'>".$language['AADS_NO_UPLOAD']."</span>";
                $fls = "<span style='color:red'>".$language['AADS_NO_FLS']."</span>";
            }
            if(($arr['item'] == 1 || $arr['item'] == 4) && $row["a3_id_level"] <= 6)
            {
                $ano = "<span style='color:green'>".$language['AADS_NO']."</span>";
                $vip = "<span style='color:green'>".$row['timed_rank']."</span>";
                $rank = stripslashes($row["a4_prefixcolor"]).$row['a4_level'].stripslashes($row["a4_suffixcolor"]);
                $upload = "<span style='color:red'>".$language['AADS_NO_UPLOAD']."</span>";
                $fls = "<span style='color:red'>".$language['AADS_NO_FLS']."</span>";
            }
            elseif(($arr['item'] == 1 || $arr['item'] == 4) && $row["a3_id_level"] >= 6)
            {
                $ano = "<span style='color:green'>".$language['AADS_NO']."</span>";
                $vip = "<span style='color:purple'>".$language['AADS_DEM_PRO']."</span>";
                $rank = "<span style='color:purple'>".$language['AADS_DEM_PRO']."</span>";
                $upload = "<span style='color:red'>".$language['AADS_NO_UPLOAD']."</span>";
                $fls = "<span style='color:red'>".$language['AADS_NO_FLS']."</span>";
            }
            elseif($arr['item'] == 2)
            {
                $ano = "<span style='color:green'>".$language['AADS_NO']."</span>";
                $vip = "<span style='color:red'>".$language['AADS_NO_TIMED_RANK']."</span>";
                $rank = "<span style='color:red'>".$language['AADS_NO_OLD_RANK']."</span>";
                $upl=((($arr["mc_gross"]<=$pay["togb"])?$pay["gb"]:(($arr["mc_gross"] > $pay["togb"] && $arr["mc_gross"] <= $pay["togbb"])?$pay["gbb"]:$pay["gbc"]))*$arr["mc_gross"]*1073741824);
                $upload = "<span style='color:green'>".makesize($upl)."</span>";
                $fls = "<span style='color:red'>".$language['AADS_NO_FLS']."</span>";
            }
            elseif($arr['item'] == 5)
            {
                $ano = "<span style='color:green'>".$language['AADS_NO']."</span>";
                $vip = "<span style='color:red'>".$language['AADS_NO_TIMED_RANK']."</span>";
                $rank = "<span style='color:red'>".$language['AADS_NO_OLD_RANK']."</span>";
                $upload = "<span style='color:red'>".$language['AADS_NO_UPLOAD']."</span>";
                $fls = "<span style='color:green'>".(($pay["fl_slot_cost"]>0)?($arr["mc_gross"]/$pay["fl_slot_cost"]):0)."</span>";
            }
            $name = "<a href='".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated_user"] == "true")?$arr["userid"]."_".strtr($row["username"], $res_seo["str"], $res_seo["strto"]).".html":
                "index.php?page=userdetails&id=".$arr["userid"])."'>".stripslashes($row["a3_prefixcolor"]).$row['username'].stripslashes($row["a3_suffixcolor"])."</a>";
            $don[$i]["System"] = $arr['system'];
            $don[$i]["Test"] = $arr['test'];
            $don[$i]["Username"] = $name;
            $don[$i]["Anonymous"] = $ano;
            $don[$i]["Last_name"] = $arr['last_name'];
            $don[$i]["Email"] = $arr['payers_email'];
            $don[$i]["Date"] = $arr['date'];
            $don[$i]["Amount"] = (($sign_left === true)?$sign:"").$arr['mc_gross'].(($sign_right === true)?$sign:"");
            $don[$i]["Upload"] = $upload;
            $don[$i]["Vip"] = $vip;
            $don[$i]["Rank"] = $rank;
            $don[$i]["fls"] = $fls;
            $i++;
        }
    }
    $admintpl->set("language", $language);
    $admintpl->set("don", $don);
    $admintpl->set("pager_in_use", ((isset($pagerbottom) && !empty($pagerbottom))?true:false), true);
    $admintpl->set("pager", ((isset($pagerbottom) && !empty($pagerbottom))?$pagerbottom:""));
}

?>
