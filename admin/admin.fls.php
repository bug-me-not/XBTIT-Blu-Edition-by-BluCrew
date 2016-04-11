<?php
if(!defined("IN_BTIT"))
    die("non direct access!");
if(!defined("IN_ACP"))
    die("non direct access!");


$admintpl->set("language", $language);
$admintpl->set("uid", $CURUSER["uid"]);
$admintpl->set("random", $CURUSER["random"]);

if(isset($_POST) && !empty($_POST) && $_POST["confirm"] == $language["FRM_CONFIRM"])
{
    $affect = (isset($_POST["affect"]) && !empty($_POST["affect"]))?(int)0 + $_POST["affect"]:(int)0;
    $task = (isset($_POST["task"]) && !empty($_POST["task"]))?(int)0 + $_POST["task"]:(int)0;
    $receiver = (isset($_POST["receiver"]) && !empty($_POST["receiver"]))?sql_esc($_POST["receiver"]):false;
    $taskText = (isset($_POST["taskText"]) && !empty($_POST["taskText"]))?(int)0 + $_POST["taskText"]:(int)0;
    $levelLow = (isset($_POST["levelLow"]) && !empty($_POST["levelLow"]))?(int)0 + $_POST["levelLow"]:(int)0;
    $levelHigh = (isset($_POST["levelHigh"]) && !empty($_POST["levelHigh"]))?(int)0 + $_POST["levelHigh"]:(int)0;

    if($affect == 1)
    {
        if(!$receiver)
            stderr($language["ERROR"], $language["FLS_NO_USER"]);
        if($task == 1 && $taskText == 0)
            stderr($language["ERROR"], $language["FLS_INC_BY_ZERO"]);

        $res = get_result("SELECT `id` FROM `{$TABLE_PREFIX}users` WHERE `username`='".$receiver."'", true, $btit_settings["cache_duration"]);

        if(count($res) == 0)
        {
            stderr($language["ERROR"], $language["FLS_USER_INVALID"]);
        }
        else
        {
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `freeleech_slots`=".(($task == 1)?"`freeleech_slots`+".$taskText:(($task == 2)?$taskText:"0, `freeleech_slot_hashes`=''"))." WHERE id=".$res[0]["id"], true);
            success_msg($language["SUCCESS"], $language["FLS_JOB_DONE"]."<br /><br /><a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=fls'>".$language["RETURN"]."</a>");
        }
    }
    elseif($affect == 2)
    {
        if($levelLow > $levelHigh)
        {
            stderr($language["ERROR"], $language["FLS_RANGE_ERROR"]);
        }
        if($task == 1 && $taskText == 0)
            stderr($language["ERROR"], $language["FLS_INC_BY_ZERO"]);

        $res = get_result("SELECT `id` FROM `{$TABLE_PREFIX}users_level` WHERE `logical_rank_order`>=".$levelLow." AND `logical_rank_order`<=".$levelHigh." ORDER BY `id` ASC", true, $btit_settings["cache_duration"]);
        $idlevels = "";
        if(count($res) > 0)
        {
            foreach($res as $row)
            {
                $idlevels .= $row["id"].",";
            }
            $idlevels = trim($idlevels, ",");
        }
        if($idlevels!="")
        {
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `freeleech_slots`=".(($task == 1)?"`freeleech_slots`+".$taskText:(($task == 2)?$taskText:"0, `freeleech_slot_hashes`=''"))." WHERE `id_level` IN(".$idlevels.")", true);
            success_msg($language["SUCCESS"], $language["FLS_JOB_DONE"]."<br /><br /><a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=fls'>".$language["RETURN"]."</a>");
        }
    }
}
else
{
    if($btit_settings["fmhack_logical_rank_ordering"] == "enabled")
    {
        $test_lro = array();
        $res = get_result("SELECT * FROM `{$TABLE_PREFIX}users_level` ORDER BY `logical_rank_order` ASC, `id` ASC", true, $btit_settings["cache_duration"]);
        foreach($res as $row)
        {
            if(!isset($test_lro[$row["logical_rank_order"]]))
                $test_lro[$row["logical_rank_order"]] = 1;
            else
            {
                stderr($language["ERROR"], $language["LRO_ERR_BLOCK"]." <a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=groups&action=read'>".$language["HERE"]."</a>.");
                break;
            }
        }
        $ranks = $res;
        $opts['name'] = 'levelLow';
        $opts['complete'] = true;
        $opts['id'] = 'logical_rank_order';
        $opts['value'] = 'level';
        $opts['default'] = $res[0]["logical_rank_order"];
        $combo1 = get_combo($ranks, $opts);
        $opts['name'] = 'levelHigh';
        $opts['default'] = $res[(count($res) - 1)]["logical_rank_order"];
        $combo2 = get_combo($ranks, $opts);
        $admintpl->set("rankLow", $combo1);
        $admintpl->set("rankHigh", $combo2);
    }
    else
        stderr($language["ERROR"], $language["FLS_NEED_RO"]." <a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=hacks&action=read'>".$language["HERE"]."</a>.");
}

?>
