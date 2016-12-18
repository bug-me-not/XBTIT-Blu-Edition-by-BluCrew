<?php
// *****************************************************************
// Version: 1.1
// *****************************************************************
//
// Filename: admin.client_clearban.php
// Parent:   peers.php
// Author:   Petr1fied
// Date:     2007-06-17
// Updated:  N/A
//
// Usage:
// - Removes bans on BitTorrent Clients.
//
// ####### HISTORY ################################################
//
// 1.0 2007-06-17 - Petr1fied - Intital development.
// 1.1 2008-10-18 - Petr1fied - Conversion for use with xbtit.
//
// *****************************************************************

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");

include(load_language("lang_peers.php"));
$admintpl->set('language',$language);

(isset($_GET["id"]) ? $id = 0+$_GET["id"] : $id="");
(isset($_GET["returnto"]) ? $url=urldecode($_GET["returnto"]) : $url="");
(isset($_POST["confirm"]) ? $confirm=$_POST["confirm"] : $confirm="");

if($_POST["confirm"])
{
    if($confirm==$language["YES"])
    {
        if ($XBTT_USE)
           {
           $dr = do_sqlquery("SELECT peer_id_ascii FROM `{$TABLE_PREFIX}bannedclient` WHERE `id`=".$id)->fetch_array();
           @quickQuery("DELETE FROM xbt_deny_from_clients WHERE peer_id=".sqlesc($dr['peer_id_ascii']));
           unset($dr);
        }
        @quickQuery("DELETE FROM `{$TABLE_PREFIX}bannedclient` WHERE `id`=".$id);
        success_msg($language["SUCCESS"],$language["CLIENT_REMOVED"]."<a href='$url'>".$language["RETURN"]."</a>");
        stdfoot();
        exit();
    }
    else
        redirect($url);
}
$res = do_sqlquery("SELECT * FROM `{$TABLE_PREFIX}bannedclient`",true);

if(@sql_num_rows($res) > 0)
{
    $client = array();
    $i = 0;
    while($row=$res->fetch_assoc())
    {
        $client[$i]["client_name"] = $row["client_name"];
        $client[$i]["user_agent"] = $row["user_agent"];
        $client[$i]["peer_id"] = $row["peer_id"];
        $client[$i]["peer_id_ascii"] = $row["peer_id_ascii"];
        $client[$i]["reason"] = stripslashes($row["reason"]);
        $i++;
    }
    $admintpl->set('client',$client);
}
else
{
	err_msg($language["ERROR"],$language['BAD_ID']);
	stdfoot();
	exit();
}

?>
