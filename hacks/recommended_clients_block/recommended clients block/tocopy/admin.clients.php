<?php

/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2007  Btiteam
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

if ($action == "new_btclient")
{
$client_name = sqlesc($_POST["client_name"]);
$client_link = sqlesc($_POST["client_link"]);
$client_image = $_FILES["client_image"]["name"];
$client_image_url = "images/btclients/$client_image";
$client_sort_res = mysql_query("SELECT sort FROM {$TABLE_PREFIX}bt_clients ORDER BY sort DESC LIMIT 1");
$client_sort_arr = mysql_fetch_row($client_sort_res);
$client_sort = $client_sort_arr[0]+1;

if ((($_FILES["client_image"]["type"] == "image/bmp") || ($_FILES["client_image"]["type"] == "image/jpeg") || ($_FILES["client_image"]["type"] == "image/pjpeg" ) || ($_FILES["client_image"]["type"] == "image/gif" ) || ($_FILES["client_image"]["type"] == "image/x-png" ) || ($_FILES["client_image"]["type"] == "image/png" )) && ($_FILES["client_image"]["size"] < 1000))
{
if(move_uploaded_file($_FILES["client_image"]["tmp_name"],"$client_image_url"))
{
$insert_btclient = mysql_query("INSERT INTO {$TABLE_PREFIX}bt_clients (name, link, image, sort) VALUES ($client_name, $client_link, '$client_image', $client_sort)") or sqlerr(__FILE__, __LINE__);



}
}
else
{
err_msg(ERROR,  FILE_UPLOAD_ERROR_2." $client_image_url ");
stdfoot();
exit;
}
}

// delete clients

if ($action == "delete")
{
$btclient_id = $_GET["id"];
mysql_query("DELETE FROM {$TABLE_PREFIX}bt_clients WHERE id=$btclient_id") or sqlerr(__FILE__, __LINE__);

}

$admintpl->set("frm_action", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=clients&amp;action=new_btclient");
$admintpl->set("client_name",$client_name);
$admintpl->set("client_link",$client_link);
$admintpl->set("client_image",$client_image);

// show clients

$bt_clients_res = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}bt_clients ORDER BY sort ASC". $sclient[$i]["id"],true);
$client=array();
$i=0;

include("$THIS_BASEPATH/include/offset.php");

if ($bt_clients_res)
{
 while ($clientview=mysql_fetch_assoc($bt_clients_res))
  {
  $client[$i]["id"]=$clientview["id"];
  $client[$i]["name"]=$clientview["name"];
  $client[$i]["link"]=$clientview["link"];
  $client[$i]["image"]=$clientview["image"];
  $client[$i]["sort"]=$clientview["sort"];

  $client[$i]["delete"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=clients&amp;action=delete&amp;id=".$client[$i]["id"]."\" onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\">".image_or_link("$STYLEPATH/images/delete.png","",$language["DELETE"])."</a>";

  $i++;
    }
}
    $admintpl->set("clients",$client);
    $admintpl->set("language",$language);

    unset($clientview);
    mysql_free_result($bt_clients_res);
    unset($client);
    
?>
