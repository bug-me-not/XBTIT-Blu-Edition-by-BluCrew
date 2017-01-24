<?php
require_once("include/functions.php");
dbconn();
global $CURUSER, $TABLE_PREFIX;
if (!$CURUSER && $CURUSER["uid"]<=1) die;
$uid=isset($_GET["uid"])?sql_esc(htmlentities($_GET["uid"])):$uid=0;
if ($uid == "no")
    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `announce_read` = 'yes' WHERE `id` =".$CURUSER["uid"]);
die("Announcement cleared");
?>
