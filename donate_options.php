<?php
if(!defined("IN_BTIT") || $CURUSER['id'] < 2)
 redirect("index.php");

ob_start();
$text =
    ";



$donateotpl = new bTemplate();
$donateotpl->set("doante_text",$text);

ob_end_flush();

?>