<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



$cres = genrelist();
$current_state=array();
for ($i = 0; $i < count($cres); $i++)
{
    $cres[$i]["frm_number"] = "form" . $i;
    $cres[$i]["name"] = unesc($cres[$i]["name"]);
    $cres[$i]["image"] = "<img src='".$STYLEURL."/images/categories/".$cres[$i]["image"]."' alt='".unesc($cres[$i]["name"])."' title='".unesc($cres[$i]["name"])."' border='0' />";
    $cres[$i]["cat_reencode"] = (($cres[$i]["reencode"]==1)?"checked=\"checked\"":"");
    $current_state[$cres[$i]["id"]]=$cres[$i]["reencode"];
}
$admintpl->set("categories", $cres);
unset($cres);


if(isset($_POST) && !empty($_POST))
{
    foreach($current_state as $k => $v)
        quickQuery("UPDATE `{$TABLE_PREFIX}categories` SET `reencode`=".((isset($_POST[$k]) && $_POST[$k]=="on")?1:0)." WHERE `id`=".$k, true);

    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=reencode");
}

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("config", $btit_settings);

?>