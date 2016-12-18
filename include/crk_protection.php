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

/*
########################################################
#   CRK-Protection v2.0                                #
#   Anti-Hacking Module by CobraCRK                    #
#   This is made by CobraCRK - cobracrk[at]yahoo.com   #
#   This shall not used without my approval!           #
#   You may not share this!!!                          #
#   DO NOT REMOVE THIS COPYRIGHT!                      #
########################################################
#         This version was made for BtitTracker        #
########################################################
*/
function crk($l)
{
    $xip=$_SERVER["REMOTE_ADDR"];

    global $CURUSER,$btit_settings, $res_seo;

    if (function_exists("write_log"))
        write_log('Hacking Attempt! User: <a href="'.$btit_settings['url'].'/'.(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$CURUSER["uid"]."_".strtr($CURUSER["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$CURUSER["uid"]).'">'.$CURUSER['username'].'</a> IP:'.$xip.' - Attempt: '.htmlspecialchars($l));

    header('Location: index.php');
    die();
}

//the bad words...
$ban['union']='select';
//$ban['update']='set';
$ban['set password for']='@';

$ban2=array('delete from','insert into','<script', '<object', '.write', '.location', '.cookie', '.open', 'vbscript:', '<iframe', '<layer', '<style', ':expression', '<base', 'id_level', 'users_level', 'xbt_', 'c99.txt', 'c99shell', 'r57.txt', 'r57shell.txt','/home/', '/var/', '/www/', '/etc/', '/bin', '/sbin/', '$_GET', '$_POST', '$_REQUEST', 'window.open', 'javascript:', 'xp_cmdshell',  '.htpasswd', '.htaccess', '<?php', '<?', '?>', '</script>');

global $CURUSER;
if(!isset($CURUSER) || !isset($CURUSER['admin_access']))
{
    session_name("BluRG");
    session_start();
    if(isset($_SESSION["CURUSER"]))
        $CURUSER=$_SESSION["CURUSER"];
    else
    {
        $CURUSER["admin_access"]="no";
        $CURUSER["uid"]=1;
        $CURUSER["random"]=94673;
        $CURUSER["username"]="Guest";
    }
}

if($CURUSER["admin_access"]=="yes" && $_SERVER["QUERY_STRING"]=="page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=config&action=write" && strpos(strtolower($_REQUEST["tracker_announceurl"]),"tracker.openbittorrent.com")) 
    unset($ban2[7]); 
if($CURUSER["admin_access"]=="yes" && $_SERVER["QUERY_STRING"]=="page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=security_suite")
    $ban2=array('delete from','insert into','<script', '<object', '.write', '.location', '.cookie', 'vbscript:', '<iframe', '<layer', '<style', ':expression', '<base', 'id_level', 'users_level', 'xbt_', 'c99.txt', 'c99shell', 'r57.txt', 'r57shell.txt', '$_GET', '$_POST', '$_REQUEST', 'window.open', 'javascript:', 'xp_cmdshell',  '.htpasswd', '.htaccess', '</script>');
if($CURUSER["admin_access"]=="yes" && $_SERVER["QUERY_STRING"]=="page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=php_log&action=save")
    $ban2=array('delete from','insert into','<script', '<object', '.write', '.location', '.cookie', 'vbscript:', '<iframe', '<layer', '<style', ':expression', '<base', 'id_level', 'users_level', 'xbt_', 'c99.txt', 'c99shell', 'r57.txt', 'r57shell.txt', '$_GET', '$_POST', '$_REQUEST', 'window.open', 'javascript:', 'xp_cmdshell',  '.htpasswd', '.htaccess', '</script>');
if($CURUSER["admin_access"]=="yes" && $_SERVER["QUERY_STRING"]=="page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=ads_setup&area=update&editid=".$_REQUEST["editid"])
    $ban2=array('delete from','insert into','<object', '.write', '.location', '.cookie', 'vbscript:', '<iframe', '<layer', '<style', ':expression', '<base', 'id_level', 'users_level', 'xbt_', 'c99.txt', 'c99shell', 'r57.txt', 'r57shell.txt', '$_GET', '$_POST', '$_REQUEST', 'window.open', 'javascript:', 'xp_cmdshell',  '.htpasswd', '.htaccess','<?php', '<?', '?>');

$host=FALSE;
$host=@getenv("SERVER_NAME");
if($host===FALSE)
    $host=$_SERVER["SERVER_NAME"];

$url=explode(".",$host);
unset($url[0]);
if(count($url)>0)
{
    foreach($url as $urlpart)
    {
        if(in_array(".".$urlpart,$ban2))
            $remove[]=array_search(".".$urlpart,$ban2);
    }
}

if(isset($remove) && is_array($remove))
{
    foreach($remove as $key)
    {
        unset($ban2[$key]);
    }
}

// Check


//checking the bad words
$cepl=$_SERVER['QUERY_STRING'];
if (!empty($cepl)) {
  $cepl=preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $cepl); 
  $cepl=urldecode($cepl);
  $cepl=strtolower($cepl);
}
foreach ($ban as $k => $l)
  if (str_replace($k, '',$cepl)!=$cepl&&str_replace($l, '',$cepl)!=$cepl)
      crk(($cepl));
if (str_replace($ban2,'',$cepl)!=$cepl)
  crk(($cepl));

$cepl=implode(' ', $_REQUEST);
if (!empty($cepl)) {
  $cepl=preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $cepl);
  $cepl=urldecode($cepl);
  $cepl=strtolower($cepl);
}
foreach ($ban as $k => $l)
  if(str_replace($k, '',$cepl)!=$cepl&&str_replace($l, '',$cepl)!=$cepl)
    crk(($cepl));
if (str_replace($ban2,'',$cepl)!=$cepl)
  crk(($cepl));

$cepl=implode(' ', $_COOKIE);
if (!empty($cepl)) {
  $cepl=preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $cepl); 
  $cepl=urldecode($cepl);
  $cepl=strtolower($cepl);
}
foreach ($ban as $k => $l)
  if(str_replace($k, '',$cepl)!=$cepl&&str_replace($l, '',$cepl)!=$cepl)
   crk(($cepl));
if (str_replace($ban2,'',$cepl)!=$cepl)
  crk(($cepl));
?>