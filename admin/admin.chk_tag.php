<?php
require"../include/functions.php";
dbconn();
global $CURUSER, $TABLE_PREFIX;
$tag=isset($_GET["tag"])?htmlentities($_GET["tag"],ENT_QUOTES,"UTF-8"):$tag='';
if($CURUSER["admin_access"]!="yes")
die();
if($tag!='')
{
$list=get_result("SELECT * FROM {$TABLE_PREFIX}smilies WHERE `key`='".$tag."'",true);
if($list[0]>0)
{
echo "<span style='color:red;'>Tag already Exists!</span>";
}
else
{
echo "<span style='color:limegreen;'>Tag available</span>";}
}
else
{
echo "wtf?";
}
?>