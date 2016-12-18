<?php
if(!defined("IN_BTIT"))
    die("non direct access!");
if(!defined("IN_ACP"))
    die("non direct access!");

if(isset($_POST) && !empty($_POST))
{
    $emailArray=explode("\r\n", $_POST["email_allowed"]);
    if(count($emailArray)>0)
    {
        $emailArray2=$emailArray;
        foreach($emailArray2 as $key => $value)
        {
            if(empty($value))
                unset($emailArray[$key]);
        }
    }
    $email_allowed=((count($emailArray)>0)?sqlesc(serialize($emailArray)):"");
    quickQuery("DELETE FROM `{$TABLE_PREFIX}settings` WHERE `key`='email_allowed'", true);
    quickQuery("INSERT INTO `{$TABLE_PREFIX}settings` (`key`, `value`) VALUES ('email_allowed', '".$email_allowed."');", true);

    foreach(glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=specmail");
}

$emailList="";
if($btit_settings["email_allowed"]!="")
{
    $emailarr=unserialize($btit_settings["email_allowed"]);
    if(count($emailarr)>0)
    {
        foreach($emailarr as $value)
        {
            $emailList.=$value."\r\n";
        }
        $emailList=trim($emailList,"\r\n");
    }
}

$admintpl->set("emailList", $emailList);
$admintpl->set("uid", $CURUSER["uid"]);
$admintpl->set("random", $CURUSER["random"]);
$admintpl->set("language", $language);
?>