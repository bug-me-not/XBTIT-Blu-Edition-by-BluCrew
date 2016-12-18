<?php
require "include/functions.php";
dbconn();
global $TABLE_PREFIX, $CURUSER, $BASEURL;
$HERE = dirname(__file__);
require ("./".load_language("lang_main.php"));
if($CURUSER["edit_users"] != "yes")
    die();
if(empty($_SESSION['CURUSER']['style_url']))
{
    // get user's style
    $resheet = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}style where id=".$CURUSER["style"]." LIMIT 1", false, $btit_settings["cache_duration"]);
    if(!$resheet)
    {
        $STYLEPATH = "$THIS_BASEPATH/style/xbtit_default";
        $STYLEURL = "$BASEURL/style/xbtit_default";
    }
    else
    {
        $resstyle = $resheet->fetch_array();
        $STYLEPATH = "$THIS_BASEPATH/".$resstyle["style_url"];
        $STYLEURL = "$BASEURL/".$resstyle["style_url"];
    }
    $_SESSION['CURUSER']['style_url'] = $STYLEURL;
    $_SESSION['CURUSER']['style_path'] = $STYLEPATH;
}
else
{
    $STYLEURL = $_SESSION['CURUSER']['style_url'];
    $STYLEPATH = $_SESSION['CURUSER']['style_path'];
}
$uid = (isset($_GET["id"])?intval($_GET["id"]):$uid = 0);
$wlist = get_result("SELECT *,UNIX_TIMESTAMP(date) AS data FROM `{$TABLE_PREFIX}watched_users` WHERE `uid`=".$uid." ORDER BY `id` DESC", false, $btit_settings["cache_duration"]);
include ("$HERE/include/offset.php");
echo "<table width=100%>

<tr><td class=header>".$language["LAST_IP"]."</td><td class=header>".$language["LAST_LOCATION"]."</td><td class=header>".$language["WHEN_LOCATION"]."</td><td class=header></td></tr>";
foreach($wlist as $wid => $watch)
{
    echo "<tr><td class=lista>".$watch["cip"]."</td><td class=lista>".$watch["location"]."</td><td class=lista>".date("d/m/Y H:i", $watch["data"] - $offset)."</td><td class=lista><a href=\"javascript:popprogress('watchdel.php?wid=".
        $watch["id"]."');\"><img border=0 src=".$STYLEURL."/images/delete.png></a></td></tr>";
}
echo "</table>";

?>
