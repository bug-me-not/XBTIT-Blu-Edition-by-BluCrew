<?php

//by CobraCRK 21.07.2006 - www.extremeshare.org - cobracrk@yahoo.com
//converted to xbtit by cooly
require_once ("include/functions.php");
require_once ("include/config.php");
require_once ("include/sanitize.php");
dbconn();
if ($CURUSER["view_torrent"] == "no")
{
    err_msg(ERROR, NOT_AUTH_VIEW_NEWS);
    stdfoot();
    exit;
}
$id = $_GET['id'];
$id = sanitize_int($id);
$r = do_sqlquery("SELECT file FROM {$TABLE_PREFIX}subtitles WHERE id=$id");
$m = $r->fetch_row()[0];
$m = "subtitles/" . $m . "";
$r = do_sqlquery("UPDATE {$TABLE_PREFIX}subtitles set downloaded=downloaded+1 WHERE id=$id");
header("Content-Disposition: attachment; filename=\"" . basename($m) . "\"");
$mp = fopen("$m", "r");
fpassthru($mp);
//converted to xbtit by cooly
//by CobraCRK 21.07.2006 - www.extremeshare.org - cobracrk@yahoo.com


?>
