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
$BASEPATH=dirname(__FILE__);

require $BASEPATH."/include/config.php";
require $BASEPATH."/include/common.php";
# protection against sql injection, xss attack
require_once $BASEPATH.'/include/crk_protection.php';

// check if we are using standard php tracker or xbtt backend
// if using xbbt we will make a redirect to xbtt announce using
// informations given in config + pid if private
// thank you petr1fied for the code.
/*if ($XBTT_USE)
{
   function implode_with_keys($glue, $array) {
      $output = array();
      foreach( $array as $key => $item )
      $output[] = $key . "=" . $item;

      return implode($glue, $output);
   }

   if (isset ($_GET["pid"])) {
      $pid = $_GET["pid"];
      unset($_GET["pid"]);
   } else
   $pid = "";

   $query_string=implode_with_keys("&", $_GET);

   if ($pid!="") // private announce
   {
      header("Location: $XBTT_URL/$pid/scrape?" . $query_string);
   }
   else // public
   {
      header("Location: $XBTT_URL/scrape?" . $query_string);
   }
   exit;
}*/
// not using xbtt, let us go ;)
include($BASEPATH.'/index.begin.php');
header("Content-type: text/plain;");
header("Cache-Control: no-cache");

error_reporting(0);

// connect to db
if ($GLOBALS["persist"])
$conres=new mysqli("p:".$dbhost, $dbuser, $dbpass) or show_error("Tracker errore - mysql_connect: ".$conres->connect_error);
else
$conres=new mysqli($dbhost, $dbuser, $dbpass) or show_error("Tracker errore - mysql_connect: ".$conres->connect_error);

$conres->select_db($database) or show_error("Tracker errore - ".$database." - ".$conres->error);

if (isset($_GET["pid"])) $pid = $_GET["pid"];
else $pid = "";

if (strpos($pid, "?"))
{
   $tmp = substr($pid , strpos($pid , "?"));
   $pid  = substr($pid , 0,strpos($pid , "?"));
   $tmpname = substr($tmp, 1, strpos($tmp, "=")-1);
   $tmpvalue = substr($tmp, strpos($tmp, "=")+1);
   $_GET[$tmpname] = $tmpvalue;
}

$usehash = false; $pid = AddSlashes($pid); $info_hash=''; $newmatches[]='';
// if private announce turned on and PID empty string or not send by client
if (($pid=="" || !$pid) && $PRIVATE_SCRAPE)
show_error("Sorry. Private scrape is ON and PID system is required");

if (isset($_GET["info_hash"]))
{
   if ($pid!="")
   $qryStr=substr($_SERVER["QUERY_STRING"],strlen("?pid=$pid"));
   else
   $qryStr=$_SERVER["QUERY_STRING"];
   // support for multi-scrape
   // more info @ http://wiki.depthstrike.com/index.php/P2P:Programming:Trackers:PHP:Multiscrape
   foreach (explode("&", $qryStr) as $item)
   {
      if (substr($item, 0, 10) == "info_hash=")
      {
         $ihash=urldecode(substr($item,10));

         if (strlen($ihash) == 20){
            $ihash = bin2hex($ihash);
         }else if (strlen($ihash) == 40){
            if (!verifyHash($ihash)) continue; //showError(INVALID_INFO_HASH);
         }else{
            continue;
         } // showError(INVALID_INFO_HASH);
         $newmatches[]=$ihash;
      }
   }

   if (get_magic_quotes_gpc())
   //$info_hash = stripslashes($_GET["info_hash"]);
   $info_hash = stripslashes(join($newmatches,"','"));
   else
   // $info_hash = $_GET["info_hash"];
   $info_hash = join($newmatches,"','");

   $info_hash = strtolower("('$info_hash')");
   $usehash = true;
}

if ($usehash)
//    $query = do_sqlquery("SELECT info_hash, filename FROM namemap WHERE external='no' AND info_hash=\"$info_hash\"");
$query = $conres->query("SELECT info_hash, filename FROM {$TABLE_PREFIX}files WHERE external='no' AND info_hash IN $info_hash");
else
$query = $conres->query("SELECT info_hash, filename FROM {$TABLE_PREFIX}files WHERE external='no'");

$namemap = array();
while ($row = $query->fetch_row())
$namemap[$row[0]] = $row[1];

if ($usehash)
$query = $conres->query("SELECT f.info_hash, f.seeds, f.leechers, f.finished FROM {$TABLE_PREFIX}files f WHERE external='no' AND info_hash IN $info_hash") or show_error("Database error. Cannot complete request.");
else
$query = $conres->query("SELECT f.info_hash, f.seeds, f.leechers, f.finished FROM {$TABLE_PREFIX}files f WHERE external='no' ORDER BY info_hash") or show_error("Database error. Cannot complete request.");

$result="d5:filesd";

while ($row = $query->fetch_row())
{
   $hash = hex2bin($row[0]);
   $result.="20:".$hash."d";
   $result.="8:completei".$row[1]."e";
   $result.="10:downloadedi".$row[3]."e";
   $result.="10:incompletei".$row[2]."e";
   if (isset($namemap[$row[0]])){ $result.="4:name".strlen($namemap[$row[0]]).":".$namemap[$row[0]]."e";}
}

$result.="e5:flagsd20:min_request_intervali1800eee";
echo $result;
$conres->close();
include($BASEPATH.'/index.end.php');
?>
