<?php
require_once("./include/functions.php");

dbconn(true);

global $TABLE_PREFIX;

  global $radio_interval;

  if ($radio_interval==0)
    return;

  $now = time();
  $res = do_sqlquery("SELECT last_time FROM {$TABLE_PREFIX}tasks WHERE task='radio'");
  $row = $res->fetch_array();
  if (!$row) {
    quickQuery("INSERT INTO {$TABLE_PREFIX}tasks (task, last_time) VALUES ('radio',$now)");
    return;
  }
  $ts = $row[0];
  if ($ts + $radio_interval > $now)
    return;
  quickQuery("UPDATE {$TABLE_PREFIX}tasks SET last_time=$now WHERE task='radio' AND last_time = $ts");
  if (!sql_affected_rows())
    return;
require_once("./include/functions.php");
 
  do_radio($ts);
?>