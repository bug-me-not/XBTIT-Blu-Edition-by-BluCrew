<?php
require_once("./include/functions.php");
dbconn(true);

global $TABLE_PREFIX;
 
$Match = "[radio]";
quickQuery("DELETE FROM {$TABLE_PREFIX}chat WHERE text LIKE '%".$Match."%'");
  
  
?>