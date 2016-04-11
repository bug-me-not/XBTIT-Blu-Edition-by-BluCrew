<?php
// Please encrypt me
require_once("include/functions.php");
dbconn();
require_once(dirname(__FILE__).load_language("lang_aads.php"));
require_once(dirname(__FILE__).load_language("lang_main.php"));

$id=(int)0+$_GET["id"];
$inv=(int)0+$_GET["inv"];

$res=get_result("SELECT * FROM `{$TABLE_PREFIX}bitcoin_invoices` WHERE `invoice_id`='".$inv."' AND `tracker_id`='".$id."'");
if(count($res)>0)
{
    $row=$res[0];
    echo "\n<table>\n";
    echo "\t<tr>\n";
    echo "\t\t<td class='header' style='text-align:center;'>".$language["AADS_BIT_REQ"]."</td>\n";
    echo "\t\t<td class='header' style='text-align:center;'>".$language["AADS_BIT_REC"]."</td>\n";
    echo "\t\t<td class='header' style='text-align:center;'>".$language["AADS_BIT_CON"]."</td>\n";
    echo "\t\t<td class='header' style='text-align:center;'>".$language["AADS_BIT_STA"]."</td>\n";
    echo "\t\t<td class='header' style='text-align:center;'>".$language["AADS_BIT_LAS"]."</td>\n";
    echo "\t</tr>\n";
    echo "\t<tr>\n";
    echo "\t\t<td class='lista' style='text-align:center;'>0".trim($row["price_in_btc"],0)." BTC</td>\n";
    echo "\t\t<td class='lista' style='text-align:center;'>".(($row["received_in_btc"]==0)?$language["NA"]:"0".trim($row["received_in_btc"],0)." BTC")."</td>\n";
    echo "\t\t<td class='lista' style='text-align:center;'>".(($row["confirmation_count"]<=6)?$row["confirmation_count"]."/6":$row["confirmation_count"])."</td>\n";
    echo "\t\t<td class='lista' style='text-align:center;'>".ucfirst($row["state"])."</td>\n";
    echo "\t\t<td class='lista' style='text-align:center;'>".(($row["lastupdate"]==0)?$language["NA"]:date("jS F Y \a\\t g:ia", $row["lastupdate"]))."</td>\n";
    echo "\t</tr>\n";
    echo "</table>\n";
}
else
{
    echo $language["AADS_BIT_NOT"];
}

?>