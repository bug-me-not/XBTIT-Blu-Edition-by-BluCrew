<?
require_once ("include/functions.php");
require_once ("include/config.php");

global $BASEURL;

dbconn();

if (!$CURUSER || $CURUSER["view_torrents"]=="no")
{
// do nothing
}
else
{
block_begin(BTCLIENTS);

// Retrieve BTClients info from database

$bt_clients = mysql_query("SELECT * FROM {$TABLE_PREFIX}bt_clients ORDER BY sort ASC")or sqlerr(__FILE__, __LINE__);
print("<table width=\"100%\">");
while($bt_clients_res = mysql_fetch_assoc($bt_clients))
{
$bt_name = $bt_clients_res["name"];
$bt_link = $bt_clients_res["link"];
$bt_image = $bt_clients_res["image"];
print("<tr><td align=\"center\"><img src=\"$BASEURL/images/btclients/$bt_image\"></td><td align=\"left\"><a href=$bt_link target=\"_blank\">$bt_name</a></td></tr>");
}
print("</table>");
block_end();
}
?>
