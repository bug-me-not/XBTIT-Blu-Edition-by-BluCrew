<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
//
//    Converted from BTI code to XBTIT-2 code by DiemThuy ( jan 2009 )
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

$getbanned = get_result("SELECT `i`.`userid`, `i`.`ip`, `i`.`failed`, `i`.`remaining`, `u`.`username`, `ul`.`prefixcolor`, `ul`.`suffixcolor` FROM `{$TABLE_PREFIX}invalid_logins` `i` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `i`.`userid`=`u`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` ORDER BY `i`.`id` ASC", true, $btit_settings["cache_duration"]);

$log=array();
$i=0;

if (count($getbanned)==0)
{
    $log[0]["Username"]="";
    $log[0]["IP"]=("<span style='color:#00FF00;'>".$language["LOGLOG_NOTH"]."</span>");
    $log[0]["Failed"]=("<span style='color:#00FF00;'>".$language["LOGLOG_HERE"]."</span>");
    $log[0]["Remaining"]=("<span style='color:#00FF00;'>".$language["LOGLOG_YET"]."</span>");
}
else
{
    foreach($getbanned as $arr)
    {
        $log[$i]["Username"]=((is_null($arr["username"]))?"":"<a href='index.php?page=userdetails&id=".$arr["userid"]."'>".stripslashes($arr["prefixcolor"].$arr["username"].$arr["suffixcolor"])."</a>");
        $log[$i]["IP"]=long2ip($arr["ip"]);
        $log[$i]["Failed"]=$arr["failed"];
        $log[$i]["Remaining"]=$arr["remaining"];
        $i++;
    }
}

$admintpl->set("language",$language);
$admintpl->set("loglog",$log);

?>