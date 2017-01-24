<?php

require_once("include/functions.php");

if(!isset($CURUSER) || !is_array($CURUSER))
{
    session_name("BluRG");
    session_start();
    $CURUSER=$_SESSION["CURUSER"];
}

require(load_language("lang_userdetails.php"));
$id = AddSlashes((isset($_GET["id"])?$_GET["id"]:false));

$res = do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users WHERE id = $id");
$row = $res->fetch_array();

$username = $row["username"];
$privatetpl = new bTemplate();
$privatetpl->set("language", $language);

if ($CURUSER["uid"]>1 && $id!=$CURUSER["uid"])
{
    $privatetpl -> set("private_send_pm", "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=usercp&amp;do=pm&amp;action=edit&amp;uid=".$CURUSER["uid"]."&amp;what=new&amp;to=".urlencode(unesc($row["username"]))."\"><button class='btn btn-labeled btn-danger' type='button'><span class='btn-label'><i class='fa fa-envelope'></i></span>PM User</button></a>");
	$privatetpl -> set("username",$username);
}
?>
