<?php

if (!defined("IN_BTIT"))
      die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");
      
$action=isset($_GET["action"])?htmlentities($_GET["action"],ENT_QUOTES,"UTF-8"):$action='';
switch($action)
{
case'index_now':
include"include/hashscan.php";
break;
case'check':
include"include/hashscan.php";
break;
case'':
default;
$scan=get_result("SELECT COUNT(*) as COUNT FROM {$TABLE_PREFIX}baseline");
$count=$scan[0]["COUNT"];
if($count==0)
{
$admintpl->set("start",$language["INTEGRITY_NOINDEX"]);
}
else{
$admintpl->set("start",$language["INTEGRITY_ALINDEX"]);
}
break;
}
$admintpl->set("language",$language);
?>