<?php
// Please encrypt me
if (!defined("IN_BTIT"))
die("non direct access!");

$firstname=htmlentities($_GET["fname"]);
$lastname=htmlentities($_GET["lname"]);
$itemname=htmlentities($_GET["item"]);
$amount=(0 + $_GET["amt"]);
$curr=htmlentities($_GET["curr"]);

$synchtpl=new bTemplate();
$synchtpl-> set("language", $language);
$synchtpl-> set("firstname", $firstname);
$synchtpl-> set("lastname", $lastname);
$synchtpl-> set("itemname", $itemname);
$synchtpl-> set("amount", $amount);
$synchtpl-> set("curr", $curr);

?>