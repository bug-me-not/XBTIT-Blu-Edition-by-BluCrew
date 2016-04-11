<?php

ob_start();

if($btit_settings['fmhack_games']=='disabled')
{
  stderr("Closed",'The Games section is closed.');
  die();
}

$action=$_GET["action"];
if($action=="stats"){
include("casino_player.php");
}
if($action=="edit"){
include("casino_player_edit.php");
}
if($action==""){
include("casino.php");
}

$module_out=ob_get_contents();
ob_end_clean();

?>
