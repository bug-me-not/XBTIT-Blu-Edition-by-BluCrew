<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



if(isset($_POST) && !empty($_POST))
{
    (isset($_POST["porncat"]) && !empty($_POST["porncat"])) ? $porncat=trim(str_replace(array(" " ,".", ";"), array("", ",", ","), $_POST["porncat"]), ",") : $porncat=false;

    if($porncat!==false)
    {
        if(strpos($porncat, ",")>0)
        {
            $pc_array1=array();
            $pc_array2=explode(",", $porncat);
            foreach($pc_array2 as $value)
            {
                if(is_numeric($value))
                {
                   $pc_array1[]=$value;
                }
            }
            $porncat=sql_esc(implode(",", $pc_array1));
        }
        else
        {
            $porncat=sql_esc($porncat);
        }
        quickQuery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='".$porncat."' WHERE `key`='porncat'", true);

        foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
            unlink($filename);
        redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=showporn");
    }
}

$admintpl->set("uid",$CURUSER["uid"]);
$admintpl->set("random",$CURUSER["random"]);
$admintpl->set("language",$language);
$admintpl->set("porncat", $btit_settings["porncat"]);
$admintpl->set("cat_count_is_1", ((!strpos($btit_settings["porncat"],","))?true:false), true);
?>
