<?php
require"include/functions.php";
global $CURUSER, $TABLE_PREFIX;
if($CURUSER["edit_users"]!="yes")
die();
$wid=(isset($_GET["wid"])?intval(0+$_GET["wid"]):$wid=0);
$search=do_sqlquery("select * from `{$TABLE_PREFIX}watched_users` where `id`=".$wid."",false);
if(!sql_num_rows($search)>0)
{
echo"error bad id!";
redirect("closer.html");
}
else{
quickQuery("DELETE from `{$TABLE_PREFIX}watched_users` where `id`=".$wid."",false);
redirect("closer.html");
}
?>