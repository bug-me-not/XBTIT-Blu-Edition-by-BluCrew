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


if (!defined("IN_BTIT"))
      die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");

$admin=array();

$doSanity=true;
if($btit_settings["fmhack_staffpanel"]=="enabled" && $CURUSER["id_level"]!=8)
{
    $res=get_result("SELECT `id` FROM `{$TABLE_PREFIX}adminpanel` WHERE `link` LIKE '%do=sanity%' AND `access`=1 AND `id_level`=".$CURUSER["id_level"],true, $btit_settings["cache_duration"]);
    if(count($res)==0)
        $doSanity=false;
}
$res=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}tasks");
if ($res)
   {
    while ($result=$res->fetch_array())
          {
          if ($result["task"]=="sanity")
             $admin["lastsanity"]=$language["LAST_SANITY"]."<br />\n".get_date_time($result["last_time"])."<br />\n(".$language["NEXT"].": ".get_date_time($result["last_time"]+intval($GLOBALS["clean_interval"])).")<br />\n".(($doSanity)?"<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=sanity&amp;action=now\">".$language["SANITY_DOITNOW"]."</a><br />":"");
          elseif ($result["task"]=="update")
             $admin["lastscrape"]="<br />\n".$language["LAST_EXTERNAL"]."<br />\n".get_date_time($result["last_time"])."<br />\n(".$language["NEXT"].": ".get_date_time($result["last_time"]+intval($GLOBALS["update_interval"])).")<br />";
       }
   }

// check if XBTT tables are present in current db
$res=do_sqlquery("SHOW TABLES LIKE 'xbt%'");
$xbt_tables=array('xbt_config','xbt_deny_from_hosts','xbt_files','xbt_files_users','xbt_users');
$xbt_in_db=array();
if ($res)
   {
   while ($result=$res->fetch_row())
         {
             $xbt_in_db[]=$result[0];
         }
 }
 $ad=array_diff($xbt_tables,$xbt_in_db);

 if (count($ad)==0)
    $admin["xbtt_ok"]="<br />\nIT SEEMS THAT ALL XBTT TABLES ARE PRESENT!<br />\n<br />\n";
 else
    $admin["xbtt_ok"]="";

unset($ad);
unset($xbt_tables);
unset($xbt_in_db);

unset($result);
$res->free();

// check torrents' folder
if (file_exists($TORRENTSDIR))
  {
  if (is_writable($TORRENTSDIR))
        $admin["torrent_ok"]=("<br />\nTorrent's folder $TORRENTSDIR<br />\n<span style=\"color:#BEC635; font-weight: bold;\">is writable</span><br />\n");
  else
        $admin["torrent_ok"]=("<br />\nTorrent's folder $TORRENTSDIR<br />\nis <span style=\"color:#FF0000; font-weight: bold;\">NOT writable</span><br />\n");
  }
else
  $admin["torrent_ok"]=("<br />\nTorrent's folder $TORRENTSDIR<br />\n<span style=\"color:#FF0000; font-weight: bold;\">NOT FOUND!</span><br />\n");

// check cache folder
if (file_exists("$THIS_BASEPATH/cache"))
  {
  if (is_writable("$THIS_BASEPATH/cache"))
        $admin["cache_ok"]=("cache folder<br />\n<span style=\"color:#BEC635; font-weight: bold;\">is writable</span><br />\n");
  else
        $admin["cache_ok"]=("cache folder is<br />\n<span style=\"color:#FF0000; font-weight: bold;\">NOT writable</span><br />\n");
  }
else
  $admin["cache_ok"]=("cache folder<br />\n<span style=\"color:#FF0000; font-weight: bold;\">NOT FOUND!</span><br />\n");


// check censored worlds file
if (file_exists("badwords.txt"))
  {
  if (is_writable("badwords.txt"))
        $admin["badwords_ok"]=("Censored words file (badwords.txt)<br />\n<span style=\"color:#BEC635; font-weight: bold;\">is writable</span><br />\n");
  else
        $admin["badwords_ok"]=("Censored words file (badwords.txt)<br />\nis <span style=\"color:#FF0000; font-weight: bold;\">NOT writable</span> (cannot writing tracker's configuration change)<br />\n");
   }
else
  $admin["badwords_ok"]=("<br />\nCensored words file (badwords.txt)<br />\n<span style=\"color:#FF0000; font-weight: bold;\">NOT FOUND!</span><br />\n");

$admin["infos"].=("<br />\n<table border=\"0\">\n");
$admin["infos"].=("<tr><td class=\"header\" align=\"center\">Server's OS</td></tr><tr><td align=\"left\">".php_uname()."</td></tr>");
$admin["infos"].=("<tr><td class=\"header\" align=\"center\">PHP version</td></tr><tr><td align=\"left\">".phpversion()."</td></tr>");

$sqlver=do_sqlquery("SELECT VERSION()")->fetch_row();
$admin["infos"].=("\n<tr><td class=\"header\" align=\"center\">MYSQL version</td></tr><tr><td align=\"left\">$sqlver[0]</td></tr>");
$sqlver=sql_stat();
$sqlver=explode('  ',$sqlver);
$admin["infos"].=("\n<tr><td valign=\"top\" class=\"header\" align=\"center\">MYSQL stats</td></tr>\n");
for ($i=0;$i<count($sqlver);$i++)
      $admin["infos"].=("<tr><td align=\"left\">$sqlver[$i]</td></tr>\n");
$admin["infos"].=("\n</table><br />\n");

unset($sqlver);

$admintpl->set("language",$language);
$admintpl->set("admin",$admin);

?>
