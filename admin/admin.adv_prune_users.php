<?php
if(!defined("IN_BTIT"))
    die("non direct access!");
if(!defined("IN_ACP"))
    die("non direct access!");

if(isset($_POST) && !empty($_POST))
{
    $unval_num=(isset($_POST["unval_num"]) && is_numeric($_POST["unval_num"])) ? (int)0+$_POST["unval_num"]: 2;
    $firstwarn_num=(isset($_POST["firstwarn_num"]) && is_numeric($_POST["firstwarn_num"])) ? (int)0+$_POST["firstwarn_num"]: 14;
    $secondwarn_num=(isset($_POST["secondwarn_num"]) && is_numeric($_POST["secondwarn_num"])) ? (int)0+$_POST["secondwarn_num"]: 21;
    $del_num=(isset($_POST["del_num"]) && is_numeric($_POST["del_num"])) ? (int)0+$_POST["del_num"]: 7;
    $firstwarn_msg=(isset($_POST["firstwarn_msg"]) && !empty($_POST["firstwarn_msg"])) ? sqlesc($_POST["firstwarn_msg"]) : false;
    $secondwarn_msg=(isset($_POST["secondwarn_msg"]) && !empty($_POST["secondwarn_msg"])) ? sqlesc($_POST["secondwarn_msg"]) : false;
    $final_msg=(isset($_POST["final_msg"]) && !empty($_POST["final_msg"])) ? sqlesc($_POST["final_msg"]) : false;
    $advprune_excempt="1,2,";
    unset($_POST["unval_num"],$_POST["firstwarn_num"],$_POST["secondwarn_num"],$_POST["del_num"],$_POST["firstwarn_msg"],$_POST["secondwarn_msg"],$_POST["final_msg"],$_POST["submit"]);
    foreach($_POST as $key => $value)
    {
        if(substr($key, 0, 5)=="level" && is_numeric($value))
            $advprune_excempt.=$value.",";
    }
    $advprune_excempt=trim($advprune_excempt, ",");

    quickQuery("DELETE FROM `{$TABLE_PREFIX}settings` WHERE `key` LIKE 'advprune_%'  AND `key` NOT LIKE 'advprunet_%'", true);
    quickQuery("INSERT INTO `{$TABLE_PREFIX}settings` (`key`, `value`) VALUES ('advprune_validate_max', '".$unval_num."'), ('advprune_firstwarn_max', '".$firstwarn_num."'), ('advprune_firstwarn_msg', '".$firstwarn_msg."'), ('advprune_secondwarn_max', '".$secondwarn_num."'), ('advprune_secondwarn_msg', '".$secondwarn_msg."'), ('advprune_del_after', '".$del_num."'), ('advprune_exempt_ranks', '".$advprune_excempt."'), ('advprune_final_msg', '".$final_msg."');", true);

    foreach(glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=adv_pruneu");
}


$exempt_ranks=explode(",", $btit_settings["advprune_exempt_ranks"]);

$res=get_result("SELECT `id`, `level`, `prefixcolor`, `suffixcolor` FROM `{$TABLE_PREFIX}users_level` WHERE `id`>2 ORDER BY ".(($btit_settings["fmhack_logical_rank_ordering"]=="enabled")?"`logical_rank_order` ASC,":"")." `id` ASC", true, $btit_settings["cache_duration"]);

$levels="";

foreach($res as $row)
{
    $levels.="<input type='checkbox' name='level".$row["id"]."' value='".$row["id"]."'".((in_array($row["id"], $exempt_ranks))?" checked='yes'":"").">".unesc($row["prefixcolor"].$row["level"].$row["suffixcolor"])."<br />";
}

$admintpl->set("final_msg", $btit_settings["advprune_final_msg"]);
$admintpl->set("overall_num", ($btit_settings["advprune_secondwarn_max"]+$btit_settings["advprune_del_after"]));
$admintpl->set("unval_num", $btit_settings["advprune_validate_max"]);
$admintpl->set("firstwarn_num", $btit_settings["advprune_firstwarn_max"]);
$admintpl->set("firstwarn_msg", $btit_settings["advprune_firstwarn_msg"]);
$admintpl->set("secondwarn_num", $btit_settings["advprune_secondwarn_max"]);
$admintpl->set("secondwarn_msg", $btit_settings["advprune_secondwarn_msg"]);
$admintpl->set("del_num", $btit_settings["advprune_del_after"]);
$admintpl->set("exempt_ranks", $levels);
$admintpl->set("SITENAME", $SITENAME);
$admintpl->set("BASEURL", $BASEURL);
$admintpl->set("member", $CURUSER["username"]);
$admintpl->set("uid", $CURUSER["uid"]);
$admintpl->set("random", $CURUSER["random"]);
$admintpl->set("language", $language);
?>