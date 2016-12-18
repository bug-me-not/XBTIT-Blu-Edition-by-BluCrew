<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["banbutton"]) && substr($_POST["banbutton"],0,4)=="lro-") ? $banbutton=$_POST["banbutton"] : $banbutton=false;
    (isset($_POST["bandays"]) && is_numeric($_POST["bandays"]) && $_POST["bandays"]>0) ? $bandays=(int)0+$_POST["bandays"] : $bandays=2;

    if($banbutton)
    {
        $newType=((is_integer($banbutton))?array():explode("-", $banbutton));
        if(count($newType)>0)
        {
            $i=0;
            foreach($newType as $value)
            {
                if($i>0)
                {
                    if(!is_integer($value))
                        stderr($language["ERROR"], $language["BAD_DATA"]);
                }
            }
        }
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$banbutton."' WHERE `key`='banbutton'", true);
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$bandays."' WHERE `key`='bandays'", true);

        foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
            unlink($filename);
    }
    else
        stderr($language["ERROR"], $language["BAD_DATA"]);

    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=ban_button");
}

$res=get_result("SELECT `id_level`, `level`, `logical_rank_order` FROM `{$TABLE_PREFIX}users_level` ".(($btit_settings["fmhack_logical_rank_ordering"]=="enabled")?"":"WHERE `id`>=1 AND `id`<=8")." ORDER BY ".(($btit_settings["fmhack_logical_rank_ordering"]=="enabled")?"`logical_rank_order`":"`id_level`")."  ASC", true, $btit_settings["cache_duration"]);
if($btit_settings["fmhack_logical_rank_ordering"]=="enabled")
{
    $test_lro=array();
    foreach($res as $row)
    {
        if(!isset($test_lro[$row["logical_rank_order"]]))
            $test_lro[$row["logical_rank_order"]]=1;
        else
        {
            stderr($language["ERROR"], $language["LRO_ERR_BLOCK"]." <a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=groups&action=read'>".$language["HERE"]."</a>.");
            break;
        }
    }
}

$curType=((is_integer($btit_settings["banbutton"]))?array():explode("-", $btit_settings["banbutton"]));

$formSelect="\n<select name='banbutton'>\n<option value='0'".((count($curType)==0 || ($btit_settings["fmhack_logical_rank_ordering"]=="enabled" && count($curType)>0 && $curType[1]==0))?" selected='selected'":"").">---------</option>\n";

foreach($res as $row)
{
    $formSelect.="<option value='lro-".(($btit_settings["fmhack_logical_rank_ordering"]=="enabled")?"1-".$row["logical_rank_order"]:"0-".$row["id_level"])."'".(($btit_settings["banbutton"]=="lro-".(($btit_settings["fmhack_logical_rank_ordering"]=="enabled")?"1-".$row["logical_rank_order"]:"0-".$row["id_level"])?" selected='selected'":"")).">".$row["level"]."</option>\n";
}
$formSelect.="</select>";

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("config", $btit_settings);
$admintpl->set("formSelect", $formSelect);

?>