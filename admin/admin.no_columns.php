<?php
if(!defined("IN_BTIT"))
    die("non direct access!");
if(!defined("IN_ACP"))
    die("non direct access!");

if(isset($_POST) && !empty($_POST))
{
    $nocolArray=explode("\r\n", $_POST["nocol_exceptions"]);
    if(count($nocolArray)>0)
    {
        $nocolArray2=$nocolArray;
        foreach($nocolArray2 as $key => $value)
        {
            if(empty($value))
                unset($nocolArray[$key]);
        }
    }
    $nocol_exceptions=((count($nocolArray)>0)?sqlesc(serialize($nocolArray)):"");
    quickQuery("DELETE FROM `{$TABLE_PREFIX}settings` WHERE `key`='nocol_exceptions'", true);
    quickQuery("INSERT INTO `{$TABLE_PREFIX}settings` (`key`, `value`) VALUES ('nocol_exceptions', '".$nocol_exceptions."');", true);

    foreach(glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=nocoldisp");
}

$nocolList="";
if($btit_settings["nocol_exceptions"]!="")
{
    $nocolarr=unserialize($btit_settings["nocol_exceptions"]);
    if(count($nocolarr)>0)
    {
        foreach($nocolarr as $value)
        {
            $nocolList.=$value."\r\n";
        }
        $nocolList=trim($nocolList,"\r\n");
    }
}

$admintpl->set("nocolList", $nocolList);
$admintpl->set("uid", $CURUSER["uid"]);
$admintpl->set("random", $CURUSER["random"]);
$admintpl->set("language", $language);
?>