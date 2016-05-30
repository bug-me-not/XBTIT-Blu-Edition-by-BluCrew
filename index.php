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

if (file_exists("install.unlock") && file_exists("install.php"))
{
 if (dirname($_SERVER["PHP_SELF"])=="/" || dirname($_SERVER["PHP_SELF"])=="\\")
  header("Location: http://".$_SERVER["HTTP_HOST"]."/install.php");
else
  header("Location: http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/install.php");
exit;
}

define("IN_BTIT",true);

$THIS_BASEPATH=dirname(__FILE__);

include("$THIS_BASEPATH/btemplate/bTemplate.php");

require("$THIS_BASEPATH/include/functions.php");

include($THIS_BASEPATH.'/index.begin.php');


/*if($CURUSER['id_level']!=8)
{
   stderr($language["SORRY"],$btit_settings["offline_msg"]);
 }*/
 session_name("BluRG");
 session_start();
 dbconn(true);

// If they've updated to SMF 2.0 and their tracker settings still thinks they're using SMF 1.x.x force an update
 if($FORUMLINK=="smf")
 {
  $check_ver=get_result("SELECT `value` FROM `{$db_prefix}settings` WHERE `variable`='smfVersion'", true, 60);
  if(((int)substr($check_ver[0]["value"],0,1))==2)
    quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='smf2' WHERE `key`='forum'",true);
  foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
    unlink($filename);
}

$sp = $_SERVER['SERVER_PORT']; $ss = $_SERVER['HTTPS']; if ( $sp =='443' || $ss == 'on' || $ss == '1') $p = 's';
$domain = 'http'.$p.'://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$domain = str_replace('/index.php', '', $domain);

/*if($btit_settings["fmhack_force_ssl"]=="enabled" && $CURUSER["force_ssl"]=="yes")
{
$BASEURL=str_replace("http","https",$BASEURL);
}*/

if ($BASEURL != $domain) {
 $currentFile = $_SERVER['REQUEST_URI']; preg_match("/[^\/]+$/",$currentFile,$matches);
 $filename = "/" . $matches[0];
 header ("Location: " . $BASEURL . $filename . "");
}

$time_start = get_microtime();

//require_once ("$THIS_BASEPATH/include/config.php");

clearstatcache();

$pageID=(isset($_GET["page"])?$_GET["page"]:"");

if($btit_settings["fmhack_alternate_login"]=="enabled")
{
  global $CURUSER;

  $server_url=explode("/", $_SERVER["REQUEST_URI"]);
  $last_key=(count($server_url)-1);
  $user_location=$server_url[$last_key];

  if(!isset($CURUSER) || (isset($CURUSER) && $CURUSER["uid"]==1))
  {
    if($user_location=="" || $user_location=="index.php")
    {
      redirect("login_new.php");
    }

    if($pageID!="login" && $pageID!="signup" && $pageID!="contact" && $pageID!="recover")
    {
      redirect("login_new.php");
    }
  }
  if(isSet($CURUSER) && $CURUSER['id']==2)
  {
    login_redirect("vu",1);
  }
}

$style_css=load_css("bootstrap.css");

$idlang=intval($_GET["language"]);

$no_columns=(isset($_GET["nocolumns"]) && intval($_GET["nocolumns"])==1?true:false);

//which module by cooly
if($pageID=="modules")
{
  $MID=(isset($_GET["module"])?htmlentities($_GET["module"]):$MID="");
  check_online(session_id(), ($MID==""?"index":$MID));
}
else
{
  check_online(session_id(), ($pageID==""?"index":$pageID));
}

require(load_language("lang_main.php"));


$tpl=new bTemplate();
$tpl->set("aads_enabled", (($btit_settings["fmhack_advanced_auto_donation_system"]=="enabled" && $pageID=="donatebc")?true:false), true);
$tpl->set("main_title",$btit_settings["name"]." .::. "."Index");
//ads system cooly
if($btit_settings["fmhack_ads_system"]=="enabled" && in_array($CURUSER["id_level"],explode(",",$btit_settings["ad_groups"])))
{
  $ad_settings=get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}ads");
  if($ad_settings["header_enabled"]=="enabled")
  {
    $tpl->set("ads_header",$ad_settings["header"]);
  }else{}
  if($ad_settings["left_top_enabled"]=="enabled")
  {
    $tpl->set("left_top",$ad_settings["left_top"]);
  }else{}
  if($ad_settings["left_bottom_enabled"]=="enabled")
  {
    $tpl->set("left_bottom",$ad_settings["left_bottom"]);
  }else{}
  if($ad_settings["right_top_enabled"]=="enabled")
  {
    $tpl->set("right_top",$ad_settings["right_top"]);
  }else{}
  if($ad_settings["right_bottom_enabled"]=="enabled")
  {
    $tpl->set("right_bottom",$ad_settings["right_bottom"]);
  }else{}
  if($ad_settings["footer_enabled"]=="enabled")
  {
    $tpl->set("ads_footer",$ad_settings["footer"]);
  }else{}
}
$tpl->set("footer_en",(($btit_settings["fmhack_ads_system"]=="enabled")?TRUE:FALSE),TRUE);
$tpl->set("right_bottom_en",(($btit_settings["fmhack_ads_system"]=="enabled")?TRUE:FALSE),TRUE);
$tpl->set("right_top_en",(($btit_settings["fmhack_ads_system"]=="enabled")?TRUE:FALSE),TRUE);
$tpl->set("left_top_en",(($btit_settings["fmhack_ads_system"]=="enabled")?TRUE:FALSE),TRUE);
$tpl->set("left_bottom_en",(($btit_settings["fmhack_ads_system"]=="enabled")?TRUE:FALSE),TRUE);
$tpl->set("header_en",(($btit_settings["fmhack_ads_system"]=="enabled")?TRUE:FALSE),TRUE);

//ads system cooly
// Seo by atmoner
$tpl->set("seo_enabled", (($btit_settings["fmhack_SEO_panel"]=="enabled")?true:false), true);
if($btit_settings["fmhack_SEO_panel"]=="enabled")
  require("$THIS_BASEPATH/seo.php");
// Seo by atmoner

$tpl->set("balloons_enabled", (($btit_settings["fmhack_balloons_on_mouseover"]=="enabled")?true:false), true);

// is language right to left?
if (!empty($language["rtl"]))
 $tpl->set("main_rtl"," dir=\"".$language["rtl"]."\"");
else
 $tpl->set("main_rtl","");
if (!empty($language["charset"]))
{
 $GLOBALS["charset"]=$language["charset"];
 $btit_settings["default_charset"]=$language["charset"];
}
$tpl->set("main_charset",$GLOBALS["charset"]);
$tpl->set("main_css","$style_css");


require_once("$THIS_BASEPATH/include/blocks.php");


$logo.="<div></div>";
$dropdown=dropdown_menu();
$extra=extra_menu();
$adarea=adarea_menu();
/* new for KC's alternet login menu */
$altlogin=altlogin_menu();

$header.="<div>".main_menu()."</div>";
/* for the header collapse */
$slideIt="<span style=\"float:left; padding-left:20px; border:none; margin: 0px;\"><a href=\"#\" rel=\"toggle[header]\" data-closedimage=\"$STYLEURL/images/open.png\" data-openimage=\"$STYLEURL/images/close.png\"><img src=\"$STYLEURL/images/close.png\" border=\"0\" alt=\"click\" /></a></span>";


/* for the footer block collapse */
$slideIt2="<span style=\"float:left; padding-left:20px; border:0; margin: 0px;\"><a href=\"#\" rel=\"toggle[bottom_menu]\" data-closedimage=\"$STYLEURL/images/open.png\" data-openimage=\"$STYLEURL/images/close.png\"><img src=\"$STYLEURL/images/close.png\" border=\"0\" alt=\"click\" /></a></span>";
/*---*/
$left_col=side_menu();
$right_col=right_menu();

if($btit_settings["fmhack_site_offline"]=="enabled")
{
  if (($left_col=="" && $right_col=="") || $btit_settings["site_offline"])
    $no_columns=1;
}
else
{
  if ($left_col=="" && $right_col=="")
    $no_columns=1;
}
if($btit_settings["fmhack_no_columns_display"]=="enabled")
{
  $noColArr=(($btit_settings["nocol_exceptions"]=="")?array():unserialize($btit_settings["nocol_exceptions"]));
  $pageID2=$pageID;
  if($pageID2=="")
    $pageID2="index";
  if(!in_array($pageID2, $noColArr))
    $no_columns=1;
}
include 'include/jscss.php';

$tpl->set("main_jscript",$morescript);
if (!$no_columns && $pageID!='admin' && $pageID!='forum' && $pageID!='torrents' && $pageID!='usercp' 
  && $pageID!='torrent-details' && $pageID!="upload" && $pageID!="userdetails" && $pageID!="viewrequests"
  && $pageID!="requests" && $pageID!="reqdetails" && $pageID!="veiwexpected" && $pageID!="expectdetails"
  && $pageID!="expected" && $pageID!="faq" && $pageID!='peers' && $pageID!='seedbox' && $PageID!='staffchecks') 
{
  $tpl->set("main_left",$left_col);
  $tpl->set("main_right",$right_col);
}
$tpl->set("main_logo",$logo);

$tpl->set("main_dropdown",$dropdown);

$tpl->set("main_extra",$extra);

$tpl->set("main_adarea",$adarea);

$tpl->set("main_slideIt",$slideIt);

$tpl->set("main_header",$header.$err_msg_install);

$tpl->set("more_css",$morecss); 

$tpl->set("HAS_MT",false,true);

$tpl->set("uid",$CURUSER['uid']);

$tpl->set("show_nav",(($CURUSER['id']>2)?true:false),true);

$tpl->set("valid_user",(($CURUSER['id']>2)?true:false),true);

$tpl->set("anon_enabled", (($btit_settings["fmhack_anonymous_links"]=="enabled")?true:false), true);
if($btit_settings["fmhack_anonymous_links"]=="enabled")
{
  $tpl->set("protected",$BASEURL);
}
//start private shout
if($btit_settings["fmhack_private_shouts"]=="enabled")
{
  if($CURUSER["uid"]>1 && $CURUSER["pchat"]=="")
    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `pchat`=".rand(1000,100000)." WHERE `id`=".$CURUSER["uid"],true);
}
//end private shout

if($btit_settings["fmhack_booted"]=="enabled")
{
  if ($CURUSER["uid"]>1 && $CURUSER["booted"] == "yes")
    redirect("logout.php");
}

if($btit_settings["fmhack_site_offline"]=="enabled")
{
  if ($btit_settings["site_offline"] && $CURUSER["id"]>1 && $CURUSER["admin_access"]!="yes")
    stderr($language["SORRY"],$btit_settings["offline_msg"]);
  elseif ($btit_settings["site_offline"] && $CURUSER["id"]==1)
    $pageID="login";
}
if($btit_settings["fmhack_account_parked"]=="enabled" && $CURUSER["parked"]=="yes" && $pageID!="usercp")
{
  information_msg($language["PARK_ACC_PARKED"], $language["PARK_ACC_PARKED_INFO_1"]." <a href='index.php?page=usercp&amp;do=user&amp;action=change&amp;uid=".$CURUSER["uid"]."'>".$language["PARK_ACC_PARKED_INFO_2"]."</a>.");
}

if($btit_settings["fmhack_forced_FAQ"]=="enabled")
{
  $faq=get_result("SELECT COUNT(*) `count` FROM `{$TABLE_PREFIX}faq`", true, $btit_settings["cache_duration"]);
  if ($CURUSER["id_level"]>=3 && $CURUSER["viewed_faq"]==0 && $faq[0]["count"]>0)
    $pageID="faq";
}
//if arcade
/*$act=(isset($_GET["act"])?$_GET["act"]:$act="");
if($act=="Arcade"){
include("$THIS_BASEPATH/Arcade.php");
}else{*/
  require("index_arc.php");

  include($THIS_BASEPATH.'/index.switch.php');

//}//end if arcade

  include($THIS_BASEPATH.'/index.pages.php');

  if($btit_settings["fmhack_user_watch_list"]=="enabled")
  {
    if($CURUSER["IS_WATCHED"]=="yes")
    {
      $the_page=$BASEURL.$_SERVER['REQUEST_URI'];
      $the_ip=$_SERVER['REMOTE_ADDR'];
      $cuid=$CURUSER["uid"];
      $cuser=$CURUSER["username"];
      quickQuery("INSERT INTO `{$TABLE_PREFIX}watched_users` (`id`,`uid`,`username`,`cip`,`location`,`date`) VALUES ('',$cuid,'$cuser','$the_ip','$the_page',NOW())",true);
    }
  }
  include($THIS_BASEPATH.'/index.end.php');

  ?>
