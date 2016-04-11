<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");

global $BASEURL;



$loader='<div align="center"><iframe  id="loader" frameborder="0" border="0" name="loader" width="98%" height="500" src="'.$BASEURL.'/sxd/index.php"></iframe></div>';


$admintpl->set("frm", $frame);
$admintpl->set("load", $loader);

?>