<?php

//by CobraCRK 21.07.2006 - www.extremeshare.org - cobracrk@yahoo.com
require_once ("include/functions.php");
require_once ("include/config.php");
require_once ("include/sanitize.php");
dbconn();
global $CURUSER;
$id = $_GET['id'];
$id = sanitize_int($id);
$do = $_GET["do"];
if ($do = "del" && $CURUSER["delete_torrents"] == "yes")
{
    $r = do_sqlquery("SELECT file FROM {$TABLE_PREFIX}subtitles WHERE id=$id");
    $file = $r->fetch_row()[0];
    @unlink("subtitles/$file");
    $r = do_sqlquery("DELETE FROM {$TABLE_PREFIX}subtitles WHERE id=$id");
    redirect("index.php?page=subtitles");
} else
{
    redirect("index.php?page=subtitles");
}
//by CobraCRK 21.07.2006 - www.extremeshare.org - cobracrk@yahoo.com


?>
