<?php

if (!defined("IN_BTIT"))
      die("non direct access!");
if (!defined("IN_ACP"))
      die("non direct access!");


(isset($_GET["essentials"]) && !empty($_GET["essentials"])) ? $essentials=unserialize(base64_decode(urldecode($_GET["essentials"]))) : $essentials=FALSE;
(isset($_GET["case"]) && !empty($_GET["case"]) && ($_GET["case"]==5 || $_GET["case"]==6)) ? $case=$_GET["case"] : $case=FALSE;

if($essentials!==FALSE && is_array($essentials) && $case!==FALSE)
{
    ipb_create($essentials["username"], $essentials["email"], $essentials["password"], $essentials["id_level"], $essentials["newuid"]);
    header("Location: index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=newuser&action=".(($case==5)?"save_ok":"save_pb"));
}
else
    stderr($language["ERROR"], $language["BAD_DATA"]);

?>