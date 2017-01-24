<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
//
//    Proxy Blacklist by DiemThuy ( nov 2009 )
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

if ($action=="delete")
{
    (isset($_GET["ip"]) && !empty($_GET["ip"]) && is_numeric($_GET["ip"])) ? $id=(int)0+$_GET["ip"] : $id=0;
    if ($id==0)
        stderr($language["ERROR"],$language["INVALID_ID"]);
    quickQuery("DELETE FROM `{$TABLE_PREFIX}blacklist` WHERE `id`=".$id,true);
}
if ($action=="add")
{
    $tip = sqlesc($_POST["tip"]);
    if(long2ip(ip2long($tip))!=$tip)
        stderr($language["ERROR"], $language["ERR_INVALID_IP_NUMB"]);
    quickQuery("INSERT INTO `{$TABLE_PREFIX}blacklist` (`added`, `tip`) VALUES(UNIX_TIMESTAMP(),INET_ATON('".$tip."'))",true);
}

$blacklist=array();
$getbanned = do_sqlquery("SELECT `id`, INET_NTOA(`tip`) `tip`, `added` FROM `{$TABLE_PREFIX}blacklist` ORDER BY `added` DESC",true);
$rowsbanned = @sql_num_rows($getbanned);
$admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=blacklist&amp;action=add");
$i=0;
if ($rowsbanned>0)
{
    $admintpl->set("no_records",false,true);

    while ($arr=$getbanned->fetch_assoc())
    {
        $blacklist[$i]["tip"] = $arr["tip"];
        $blacklist[$i]["date"] = get_date_time($arr['added']);
        $blacklist[$i]["remove"] = "<a href='index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=blacklist&amp;action=delete&amp;ip=".$arr["id"]."' onclick=\"return confirm('". str_replace("'","\'",$language["DELETE_CONFIRM"])."')\">".image_or_link("$STYLEPATH/images/delete.png","",$language["DELETE"])."</a>";
        $i++;
    }
}
else
    $admintpl->set("no_records",true,true);

$admintpl->set("blacklist",$blacklist);
$admintpl->set("language",$language);

?>
