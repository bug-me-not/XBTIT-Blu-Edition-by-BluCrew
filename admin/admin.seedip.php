<?php

/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    This file is part of xbtit and created by Diemthuy & Cooly okt 2008
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


if (isset($_GET["action"]))
$action = $_GET["action"];
else
$action = "";

if ($action == "new_seedip")
{
   $ip = sqlesc($_POST["ip"]);

   if (!filter_var($_POST["ip"], FILTER_VALIDATE_IP) === true) {
      stderr("Error", "".$_POST["ip"]." is not a valid IP Address");
   }

   $rows = sql_num_rows(do_sqlquery("SELECT * FROM {$TABLE_PREFIX}seedboxip WHERE ip={$ip}"));
   if ($rows >0){
      stderr("Error", "IP ".$_POST["ip"]." Address already exists");
   }else{
      $host = gethostbyaddr($_POST["ip"]);
      quickQuery("INSERT INTO {$TABLE_PREFIX}seedboxip (ip, host) VALUES ({$ip},'{$host}')") or sqlerr(__FILE__, __LINE__);
   }
}

// delete ips

if ($action == "delete")
{
   $seedid = sqlesc($_GET["id"]);
   quickQuery("DELETE FROM {$TABLE_PREFIX}seedboxip WHERE id=$seedid") or sqlerr(__FILE__, __LINE__);
}

$admintpl->set("frm_action", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=seedip&amp;action=new_seedip");
$admintpl->set("seeip",$seedip);
// show ips

$seedip_res = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}seedboxip ORDER BY ip ASC ");
$ip=array();
$i=0;
if ($seedip_res) {
   while ($seedipview=$seedip_res->fetch_assoc()) {
      $seedip[$i]["id"]=$seedipview["id"];
      $del_link = " <a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=seedip&amp;action=delete&amp;id=".$seedip[$i]["id"]."\" onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\">[DELETE]</a>";
      $seedip[$i]["remove"]=$del_link;
      $seedip[$i]["ip"]=$seedipview["ip"];
      $seedip[$i]["host"]=$seedipview["host"];
      $seedip[$i]["peers"]=$seedipview["peers"];

      $i++;
   }
}
$admintpl->set("seedip",$seedip);
$admintpl->set("language",$language);

unset($seedipview);
$seedip_res->free();
unset($seedip);

?>
