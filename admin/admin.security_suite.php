<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");

if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["secsui_quarantine_search_terms"]) && !empty($_POST["secsui_quarantine_search_terms"])) ? $secsui_quarantine_search_terms=
    sqlesc(strtolower(str_replace(array("\r\n", "\n\r", " "), array(",", ",", ""), $_POST["secsui_quarantine_search_terms"]))) : $secsui_quarantine_search_terms="";
    (isset($_POST["secsui_quarantine_dir"]) && !empty($_POST["secsui_quarantine_dir"])) ? $secsui_quarantine_dir=sqlesc(str_replace("\\", "/", $_POST["secsui_quarantine_dir"])) : $secsui_quarantine_dir="";
    (isset($_POST["secsui_quarantine_pm"]) && !empty($_POST["secsui_quarantine_pm"]) && is_numeric($_POST["secsui_quarantine_pm"]) && $_POST["secsui_quarantine_pm"]>=2) ? $secsui_quarantine_pm=(int)0+$_POST["secsui_quarantine_pm"] : $secsui_quarantine_pm=2;
    (isset($_POST["secsui_pass_type"]) && !empty($_POST["secsui_pass_type"]) && is_numeric($_POST["secsui_pass_type"]) && $_POST["secsui_pass_type"]>=1 && $_POST["secsui_pass_type"]<=7) ? $secsui_pass_type=(int)0+$_POST["secsui_pass_type"] : $secsui_pass_type=1;
    (isset($_POST["secsui_ss"]) && !empty($_POST["secsui_ss"])) ? $secsui_ss=sqlesc($_POST["secsui_ss"]) : $secsui_ss="";
    (isset($_POST["secsui_cookie_type"]) && !empty($_POST["secsui_cookie_type"]) && is_numeric($_POST["secsui_cookie_type"]) && $_POST["secsui_cookie_type"]>=1 && $_POST["secsui_cookie_type"]<=3) ? $secsui_cookie_type=(int)0+$_POST["secsui_cookie_type"] : $secsui_cookie_type=1;
    (isset($_POST["secsui_cookie_exp1"]) && !empty($_POST["secsui_cookie_exp1"]) && is_numeric($_POST["secsui_cookie_exp1"]) && $_POST["secsui_cookie_exp1"]>=1) ? $secsui_cookie_exp1=(int)0+$_POST["secsui_cookie_exp1"] : $secsui_cookie_exp1=1;
    (isset($_POST["secsui_cookie_exp2"]) && !empty($_POST["secsui_cookie_exp2"]) && is_numeric($_POST["secsui_cookie_exp2"]) && $_POST["secsui_cookie_exp2"]>=1 && $_POST["secsui_cookie_exp2"]<=6) ? $secsui_cookie_exp2=(int)0+$_POST["secsui_cookie_exp2"] : $secsui_cookie_exp2=2;
    (isset($_POST["secsui_cookie_name"]) && !empty($_POST["secsui_cookie_name"])) ? $secsui_cookie_name=sqlesc(preg_replace('/[^A-Za-z0-9]/', '', $_POST["secsui_cookie_name"])) : $secsui_cookie_name="";
    (isset($_POST["secsui_cookie_path"]) && !empty($_POST["secsui_cookie_path"])) ? $secsui_cookie_path=sqlesc($_POST["secsui_cookie_path"]) : $secsui_cookie_path="";
    (isset($_POST["secsui_cookie_domain"]) && !empty($_POST["secsui_cookie_domain"])) ? $secsui_cookie_domain=sqlesc($_POST["secsui_cookie_domain"]) : $secsui_cookie_domain="";
    (isset($_POST["pass_min_char"]) && !empty($_POST["pass_min_char"]) && is_numeric($_POST["pass_min_char"]) && $_POST["pass_min_char"]>=4) ? $pass_min_char=(int)0+$_POST["pass_min_char"] : $pass_min_char=4;
    (isset($_POST["pass_min_lct"]) && !empty($_POST["pass_min_lct"]) && is_numeric($_POST["pass_min_lct"]) && $_POST["pass_min_lct"]>=0) ? $pass_min_lct=(int)0+$_POST["pass_min_lct"] : $pass_min_lct=0;
    (isset($_POST["pass_min_uct"]) && !empty($_POST["pass_min_uct"]) && is_numeric($_POST["pass_min_uct"]) && $_POST["pass_min_uct"]>=0) ? $pass_min_uct=(int)0+$_POST["pass_min_uct"] : $pass_min_uct=0;
    (isset($_POST["pass_min_num"]) && !empty($_POST["pass_min_num"]) && is_numeric($_POST["pass_min_num"]) && $_POST["pass_min_num"]>=0) ? $pass_min_num=(int)0+$_POST["pass_min_num"] : $pass_min_num=0;
    (isset($_POST["pass_min_sym"]) && !empty($_POST["pass_min_sym"]) && is_numeric($_POST["pass_min_sym"]) && $_POST["pass_min_sym"]>=0) ? $pass_min_sym=(int)0+$_POST["pass_min_sym"] : $pass_min_sym=0;

    $char_type_count=($pass_min_lct+$pass_min_uct+$pass_min_num+$pass_min_sym);

    if($char_type_count>$pass_min_char)
        stderr($language["ERROR"], $language["SECSUI_PASS_ERR_1"]." (<span style='color:blue;font-weight:bold;'>".$char_type_count."</span>) ".$language["SECSUI_PASS_ERR_2"]." (<span style='color:blue;font-weight:bold;'>".$pass_min_char."</span>)");

    $secsui_pass_min_req=$pass_min_char.",".$pass_min_lct.",".$pass_min_uct.",".$pass_min_num.",".$pass_min_sym;

    $cookie_items_changed=false;
    if($secsui_cookie_type!=1)
    {
        $cookie_items_arr[0]="1-1";
        $cookie_items_arr[1]="2-1";
        $cookie_items_arr[2]="3-1";
        (isset($_POST["username"]) && !empty($_POST["username"]) && $_POST["username"]=="yes") ? $cookie_items_arr[3]="4-1" : $cookie_items_arr[3]="4-0";
        (isset($_POST["pass_salt"]) && !empty($_POST["pass_salt"]) && $_POST["pass_salt"]=="yes") ? $cookie_items_arr[4]="5-1" : $cookie_items_arr[4]="5-0";
        (isset($_POST["uagent"]) && !empty($_POST["uagent"]) && $_POST["uagent"]=="yes") ? $cookie_items_arr[5]="6-1" : $cookie_items_arr[5]="6-0";
        (isset($_POST["alang"]) && !empty($_POST["alang"]) && $_POST["alang"]=="yes") ? $cookie_items_arr[6]="7-1" : $cookie_items_arr[6]="7-0";
        (isset($_POST["ipadd"]) && !empty($_POST["ipadd"]) && $_POST["ipadd"]=="yes") ? $cookie_items_arr[7]="8-1" : $cookie_items_arr[7]="8-0";
        (isset($_POST["secsui_ip_octets"]) && !empty($_POST["secsui_ip_octets"]) && is_numeric($_POST["secsui_ip_octets"]) && $_POST["secsui_ip_octets"]>=1 && $_POST["secsui_ip_octets"]<=13 && $cookie_items_arr[7]=="8-1") ? $cookie_items_arr[7].="[+]".$_POST["secsui_ip_octets"] : $cookie_items_arr[7].="[+]0";

        $cookie_items=explode(",", $btit_settings["secsui_cookie_items"]);

        $cookie_items_1=array();
        foreach($cookie_items as $ci_value)
        {
            $ci_exp=explode("-",$ci_value);
            if($ci_exp[0]==8)
            {
                $ci_exp2=explode("[+]", $ci_exp[1]);
                $cookie_items_1[$ci_exp[0]]["enabled"]=$ci_exp2[0];
                $cookie_items_1[$ci_exp[0]]["type"]=$ci_exp2[1];
                unset($ci_exp2);
            }
            else
            {
                $cookie_items_1[$ci_exp[0]]["enabled"]=$ci_exp[1];
            }
            unset($ci_exp);
        }

        $cookie_items_2=array();
        foreach($cookie_items_arr as $ci_value)
        {
            $ci_exp=explode("-",$ci_value);
            if($ci_exp[0]==8)
            {
                $ci_exp2=explode("[+]", $ci_exp[1]);
                $cookie_items_2[$ci_exp[0]]["enabled"]=$ci_exp2[0];
                $cookie_items_2[$ci_exp[0]]["type"]=$ci_exp2[1];
                unset($ci_exp2);
            }
            else
            {
                $cookie_items_2[$ci_exp[0]]["enabled"]=$ci_exp[1];
            }
            unset($ci_exp);
        }
        foreach($cookie_items_1 as $key => $value)
        {
            if($cookie_items_2[$key]!=$value)
            {
                $cookie_items_changed=true;
                break;
            }
        }
        shuffle($cookie_items_arr);
        $secsui_cookie_items=sqlesc(implode(",", $cookie_items_arr));
    }
    else
    {
        $cookie_items_changed=true;
        $secsui_cookie_items=sqlesc("1-0,2-0,3-0,4-0,5-0,6-0,7-0,8-0[+]0");
    }

    if($secsui_cookie_type==2)
    {
        $mult=60;
        if($secsui_cookie_exp2==2)
            $mult=3600;
        elseif($secsui_cookie_exp2==3)
            $mult=86400;
        elseif($secsui_cookie_exp2==4)
            $mult=604800;
        elseif($secsui_cookie_exp2==5)
            $mult=2592000;
        elseif($secsui_cookie_exp2==6)
            $mult=31536000;

        $cookie_expire=(($secsui_cookie_exp1*$mult)+time());
        
        if($cookie_expire>2147483647)
            stderr($language["ERROR"], $language["SECSUI_COOKIE_TOO_FAR"]);
    }

    if($secsui_quarantine_search_terms!="")
    {
        $exp=explode(",", $secsui_quarantine_search_terms);
        $exp1=$exp;
        foreach($exp1 as $k => $v)
        {
            if(empty($v))
                unset($exp[$k]);
        }
        $secsui_quarantine_search_terms=implode(",",$exp);
        unset($exp,$exp1);
    }
    $test_pm_user=get_result("SELECT `username` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$secsui_quarantine_pm, true, $btit_settings["cache_duration"]);
    if(count($test_pm_user)!=1)
    {
        stderr($language["ERROR"], $language["SECSUI_NO_MEMBER"]." (".$secsui_quarantine_pm.")");
    }
    if($btit_settings["secsui_quarantine_search_terms"]!=$secsui_quarantine_search_terms)
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$secsui_quarantine_search_terms."' WHERE `key`='secsui_quarantine_search_terms'", true);
    if($btit_settings["secsui_quarantine_dir"]!=$secsui_quarantine_dir)
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$secsui_quarantine_dir."' WHERE `key`='secsui_quarantine_dir'", true);
    if($btit_settings["secsui_quarantine_pm"]!=$secsui_quarantine_pm)
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$secsui_quarantine_pm."' WHERE `key`='secsui_quarantine_pm'", true);
    if($btit_settings["secsui_pass_type"]!=$secsui_pass_type)
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$secsui_pass_type."' WHERE `key`='secsui_pass_type'", true);
    if($secsui_pass_type==4 && $btit_settings["secsui_ss"]!=$secsui_ss)
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$secsui_ss."' WHERE `key`='secsui_ss'", true);
    if($btit_settings["secsui_cookie_type"]!=$secsui_cookie_type)
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$secsui_cookie_type."' WHERE `key`='secsui_cookie_type'", true);
    if($secsui_cookie_type==2 && $btit_settings["secsui_cookie_exp1"]!=$secsui_cookie_exp1)
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$secsui_cookie_exp1."' WHERE `key`='secsui_cookie_exp1'", true);
    if($secsui_cookie_type==2 && $btit_settings["secsui_cookie_exp2"]!=$secsui_cookie_exp2)
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$secsui_cookie_exp2."' WHERE `key`='secsui_cookie_exp2'", true);
    if($secsui_cookie_type==2 && $btit_settings["secsui_cookie_name"]!=$secsui_cookie_name)
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$secsui_cookie_name."' WHERE `key`='secsui_cookie_name'", true);
    if($secsui_cookie_type==2 && $btit_settings["secsui_cookie_path"]!=$secsui_cookie_path)
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$secsui_cookie_path."' WHERE `key`='secsui_cookie_path'", true);
    if($secsui_cookie_type==2 && $btit_settings["secsui_cookie_domain"]!=$secsui_cookie_domain)
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$secsui_cookie_domain."' WHERE `key`='secsui_cookie_domain'", true);
    if($cookie_items_changed && $btit_settings["secsui_cookie_items"]!=$secsui_cookie_items)
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$secsui_cookie_items."' WHERE `key`='secsui_cookie_items'", true);
    if($btit_settings["secsui_pass_min_req"]!=$secsui_pass_min_req)
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$secsui_pass_min_req."' WHERE `key`='secsui_pass_min_req'", true);

    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);

    if($btit_settings["secsui_cookie_type"]!=$secsui_cookie_type || $btit_settings["secsui_pass_type"]!=$secsui_pass_type)
    {
        logoutcookie();
        redirect("index.php");
    }
    else
    {
        redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=security_suite");
    }
}

$get_pm_user=get_result("SELECT `u`.`username`, `ul`.`prefixcolor`, `ul`.`suffixcolor` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `u`.`id`=".sqlesc($btit_settings["secsui_quarantine_pm"]), true, $btit_settings["cache_duration"]);

$btit_settings["secsui_quarantine_search_terms"]=str_replace(",", "\n", $btit_settings["secsui_quarantine_search_terms"]);
$btit_settings["secsui_quarantine_user"]=((count($get_pm_user)==1)?"<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$btit_settings["secsui_quarantine_pm"]."_".strtr($get_pm_user[0]["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$btit_settings["secsui_quarantine_pm"])."'>".unesc($get_pm_user[0]["prefixcolor"].$get_pm_user[0]["username"].$get_pm_user[0]["suffixcolor"])."</a>":"<span style='background-color:#FF0000;color:#FFFF00;font-weight:bold;'>".$language["SETTING_QUAR_INV_USR"]."</span>");
$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);

$admintpl->set("config",$btit_settings);
$admintpl->set("short_open_tag", "<span style='font-weight:bold;'>short_open_tag = ".((ini_get("short_open_tag"))?"On</span>&nbsp;&nbsp;&nbsp;<img src='".$BASEURL."/images/smilies/thumbsdown.gif' border='0' />":"Off</span>&nbsp;&nbsp;&nbsp;<img src='".$BASEURL."/images/smilies/thumbsup.gif' border='0' />"));

$exp=explode("/", str_replace("\\", "/", $THIS_BASEPATH));
$last_key=(count($exp)-1);
unset($exp[$last_key]);
$recommended=implode("/",$exp)."/quarantine";

$admintpl->set("recommended", $recommended);

$secsui_pass_type="<select name='secsui_pass_type'>";

$types[1]["name"]=$language["SECSUI_PASSHASH_TYPE_1"];
$types[2]["name"]=$language["SECSUI_PASSHASH_TYPE_2"];
$types[3]["name"]=$language["SECSUI_PASSHASH_TYPE_3"];
$types[4]["name"]=$language["SECSUI_PASSHASH_TYPE_4"];
$types[5]["name"]=$language["SECSUI_PASSHASH_TYPE_5"];
$types[6]["name"]=$language["SECSUI_PASSHASH_TYPE_6"];
$types[7]["name"]=$language["SECSUI_PASSHASH_TYPE_7"];

$admintpl->set("not_gazelle", (($btit_settings["secsui_pass_type"]==4)?false:true), true);

foreach($types as $key => $value)
{
    if($btit_settings["secsui_pass_type"]==$key)
        $type_selected=" selected='yes'";
    else
        $type_selected="";
    if($key==4)
        $type_selected.=" onclick='show(\"gazelle\");'";
    else
        $type_selected.=" onclick='hide(\"gazelle\");'";
    $secsui_pass_type.="<option value='".$key."'".$type_selected.">".$value["name"]."</option>";
}
$secsui_pass_type.="</select>";
unset($types,$type_selected,$key,$value);

$admintpl->set("secsui_pass_type",$secsui_pass_type);

$secsui_cookie_type="<select name='secsui_cookie_type'>";

$types[1]["name"]=$language["SECSUI_COOKIE_T1"];
$types[2]["name"]=$language["SECSUI_COOKIE_T2"];
$types[3]["name"]=$language["SECSUI_COOKIE_T3"];

$admintpl->set("not_session", (($btit_settings["secsui_cookie_type"]==2)?false:true), true);

foreach($types as $key => $value)
{
    if($btit_settings["secsui_cookie_type"]==$key)
        $type_selected=" selected='yes'";
    else
        $type_selected="";
    if($key==2)
        $type_selected.=" onclick='show(\"cookie_extra\");'";
    else
        $type_selected.=" onclick='hide(\"cookie_extra\");'";

    $secsui_cookie_type.="<option value='".$key."'".$type_selected.">".$value["name"]."</option>";
}
$secsui_cookie_type.="</select>";
unset($types,$type_selected,$key,$value);
$admintpl->set("secsui_cookie_type",$secsui_cookie_type);

$secsui_cookie_exp2="<select name='secsui_cookie_exp2'>";

$types[1]["name"]=(($btit_settings["secsui_cookie_exp1"]==1)?$language["SECSUI_COOKIE_MIN"]:$language["SECSUI_COOKIE_MINS"]);
$types[2]["name"]=(($btit_settings["secsui_cookie_exp1"]==1)?$language["SECSUI_COOKIE_HOUR"]:$language["SECSUI_COOKIE_HOURS"]);
$types[3]["name"]=(($btit_settings["secsui_cookie_exp1"]==1)?$language["SECSUI_COOKIE_DAY"]:$language["SECSUI_COOKIE_DAYS"]);
$types[4]["name"]=(($btit_settings["secsui_cookie_exp1"]==1)?$language["SECSUI_COOKIE_WEEK"]:$language["SECSUI_COOKIE_WEEKS"]);
$types[5]["name"]=(($btit_settings["secsui_cookie_exp1"]==1)?$language["SECSUI_COOKIE_MONTH"]:$language["SECSUI_COOKIE_MONTHS"]);
$types[6]["name"]=(($btit_settings["secsui_cookie_exp1"]==1)?$language["SECSUI_COOKIE_YEAR"]:$language["SECSUI_COOKIE_YEARS"]);

foreach($types as $key => $value)
{
    if($btit_settings["secsui_cookie_exp2"]==$key)
        $type_selected=" selected='yes'";
    else
        $type_selected="";

    $secsui_cookie_exp2.="<option value='".$key."'".$type_selected.">".$value["name"]."</option>";
}
$secsui_cookie_exp2.="</select>";
unset($types,$type_selected,$key,$value);
$admintpl->set("secsui_cookie_exp2",$secsui_cookie_exp2);

$cookie_items=explode(",", $btit_settings["secsui_cookie_items"]);
$cookie_items_1=array();
foreach($cookie_items as $ci_value)
{
    $ci_exp=explode("-",$ci_value);
    if($ci_exp[0]==8)
    {
        $ci_exp2=explode("[+]", $ci_exp[1]);
        $cookie_items_1[$ci_exp[0]]["enabled"]=$ci_exp2[0];
        $cookie_items_1[$ci_exp[0]]["type"]=$ci_exp2[1];
        unset($ci_exp2);
    }
    else
    {
        $cookie_items_1[$ci_exp[0]]["enabled"]=$ci_exp[1];
    }
    unset($ci_exp);
}

$secsui_cookie_exp2="<select name='secsui_ip_octets'>";

$types[1]["name"]=$language["SECSUI_COOKIE_IP_TYPE_1"];
$types[2]["name"]=$language["SECSUI_COOKIE_IP_TYPE_2"];
$types[3]["name"]=$language["SECSUI_COOKIE_IP_TYPE_3"];
$types[4]["name"]=$language["SECSUI_COOKIE_IP_TYPE_4"];
$types[5]["name"]=$language["SECSUI_COOKIE_IP_TYPE_5"];
$types[6]["name"]=$language["SECSUI_COOKIE_IP_TYPE_6"];
$types[7]["name"]=$language["SECSUI_COOKIE_IP_TYPE_7"];
$types[8]["name"]=$language["SECSUI_COOKIE_IP_TYPE_8"];
$types[9]["name"]=$language["SECSUI_COOKIE_IP_TYPE_9"];
$types[10]["name"]=$language["SECSUI_COOKIE_IP_TYPE_10"];
$types[11]["name"]=$language["SECSUI_COOKIE_IP_TYPE_11"];
$types[12]["name"]=$language["SECSUI_COOKIE_IP_TYPE_12"];
$types[13]["name"]=$language["SECSUI_COOKIE_IP_TYPE_13"];

foreach($types as $key => $value)
{
    if($cookie_items_1[8]["type"]==$key)
        $type_selected=" selected='yes'";
    else
        $type_selected="";

    $secsui_cookie_exp2.="<option value='".$key."'".$type_selected.">".$value["name"]."</option>";
}
$secsui_cookie_exp2.="</select>";
unset($types,$type_selected,$key,$value);
$admintpl->set("secsui_ip_octets",$secsui_cookie_exp2);

$admintpl->set("4a_checked",(($cookie_items_1[4]["enabled"]==1)?" checked='yes' ":""));
$admintpl->set("4b_checked",(($cookie_items_1[4]["enabled"]==0)?" checked='yes' ":""));
$admintpl->set("5a_checked",(($cookie_items_1[5]["enabled"]==1)?" checked='yes' ":""));
$admintpl->set("5b_checked",(($cookie_items_1[5]["enabled"]==0)?" checked='yes' ":""));
$admintpl->set("6a_checked",(($cookie_items_1[6]["enabled"]==1)?" checked='yes' ":""));
$admintpl->set("6b_checked",(($cookie_items_1[6]["enabled"]==0)?" checked='yes' ":""));
$admintpl->set("7a_checked",(($cookie_items_1[7]["enabled"]==1)?" checked='yes' ":""));
$admintpl->set("7b_checked",(($cookie_items_1[7]["enabled"]==0)?" checked='yes' ":""));
$admintpl->set("8a_checked",(($cookie_items_1[8]["enabled"]==1)?" checked='yes' ":""));
$admintpl->set("8b_checked",(($cookie_items_1[8]["enabled"]==0)?" checked='yes' ":""));

$admintpl->set("not_ip_options",(($cookie_items_1[8]["enabled"]==1)?false:true),true);

$pass_min_req=explode(",", $btit_settings["secsui_pass_min_req"]);

$min_char_lang=(($pass_min_req[0]==1)?$language["SECSUI_PASS_CHAR_IN_LEN"]:$language["SECSUI_PASS_CHAR_IN_LEN_A"]);
$min_lc_lang=(($pass_min_req[1]==1)?$language["SECSUI_PASS_LC_LET"]:$language["SECSUI_PASS_LC_LET_A"]);
$min_uc_lang=(($pass_min_req[2]==1)?$language["SECSUI_PASS_UC_LET"]:$language["SECSUI_PASS_UC_LET_A"]);
$min_num_lang=(($pass_min_req[3]==1)?$language["SECSUI_PASS_NUM"]:$language["SECSUI_PASS_NUM_A"]);
$min_sym_lang=(($pass_min_req[4]==1)?$language["SECSUI_PASS_SYM"]:$language["SECSUI_PASS_SYM_A"]);

$admintpl->set("min_char_lang",$min_char_lang);
$admintpl->set("min_lc_lang",$min_lc_lang);
$admintpl->set("min_uc_lang",$min_uc_lang);
$admintpl->set("min_num_lang",$min_num_lang);
$admintpl->set("min_sym_lang",$min_sym_lang);
$admintpl->set("pass_min_char",$pass_min_req[0]);
$admintpl->set("pass_min_lct",$pass_min_req[1]);
$admintpl->set("pass_min_uct",$pass_min_req[2]);
$admintpl->set("pass_min_num",$pass_min_req[3]);
$admintpl->set("pass_min_sym",$pass_min_req[4]);

?>