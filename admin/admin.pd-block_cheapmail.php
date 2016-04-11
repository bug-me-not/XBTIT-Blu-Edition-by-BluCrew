<?php

if (!defined("IN_BTIT"))
      die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");

(isset($_GET['cheapmail'])) ? $addcheapmail = sqlesc($_GET['cheapmail']) : (isset($_POST["cheapmail"])) ? $addcheapmail = sqlesc($_POST['cheapmail']) :         $addcheapmail = '';
(isset($_GET['additthen'])) ? $additthen = $_GET['additthen'] : (isset($_POST["additthen"])) ? $additthen = sqlesc($_POST['additthen']) : $additthen = '';
(isset($_GET['delete'])) ? $delete = sqlesc($_GET['delete']) : $delete = 'false';
(isset($_GET['confirm'])) ? $confirm = $_GET['confirm'] : $confirm = 'false';

$admintpl->set("language", $language);
$admintpl->set("STYLEURL", $STYLEURL);
$admintpl->set("delete", $delete);
$admintpl->set("uid", $CURUSER["uid"]);
$admintpl->set("random", $CURUSER["random"]);
$admintpl->set("opt1", (($delete!='false' && $confirm=='false')?true:false), true);
$admintpl->set("opt2", (($delete!='false' && $confirm=='true')?true:false), true);

if ($delete!='false' && $confirm=='true')
    quickQuery("DELETE FROM `{$TABLE_PREFIX}cheapmail` WHERE `domain`='".$delete."' LIMIT 1",true);

if(($addcheapmail=="")&&($additthen=="Submit"))
    stderr($language["ERROR"],$language["ERR_CHEAP_SUBMIT"]);


elseif(($addcheapmail!="")&&($additthen=="Submit"))
{
    $isthere=do_sqlquery("SELECT * FROM `{$TABLE_PREFIX}cheapmail` WHERE `domain`='".$addcheapmail."'")->fetch_assoc();
    $wildcard="@".strrrchr($addcheapmail,".");
    $wildthere=do_sqlquery("SELECT * FROM `{$TABLE_PREFIX}cheapmail` WHERE `domain`='".$wildcard."'")->fetch_assoc();

    if((!$isthere)&&(!$wildthere))
    {
        quickQuery("INSERT INTO `{$TABLE_PREFIX}cheapmail` VALUES ('".$addcheapmail."', UNIX_TIMESTAMP(), '".$CURUSER["username"]."')");
        success_msg("Success!","<span style='color:#CC0000'><b>$addcheapmail</span><span style='color:#000000'>".$language["CHEAP_ADDED"]."</span></b>");
    }
    elseif((!$isthere)&&($wildthere))
    {
	    stderr($language["ERROR"],"<span style='color:#000000'>".$language["ERR_WILDCARD_1"]."<span style='color:#CC0000'><b>$wildcard</b></span>".$language["ERR_WILDCARD_2"]."<span style='color:#CC0000'><b>$addcheapmail</b></span>".$language["ERR_WILDCARD_3"]."</span>");
	}
    else
    {
        stderr($language["ERROR"],"<span style='color:#CC0000'>$addcheapmail </span><span style='color:#000000'>".$language["ERR_CHEAP_DUPE"]."</span>");
    }
}

$i=0;
$loop=array();
$list=get_result("SELECT `c`.`domain`, `c`.`added`, `c`.`added_by`, `ul`.`prefixcolor`, `ul`.`suffixcolor` FROM `{$TABLE_PREFIX}cheapmail` `c` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `c`.`added_by`=`u`.`username` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` ORDER BY `c`.`domain` ASC",true,$btit_settings["cache_duration"]);

if(isset($list[0]))
{
    $admintpl->set("haveloop",true,true);
    foreach($list as $cheapmail)
    {
        $loop[$i]["domain"]=$cheapmail["domain"];
        $loop[$i]["added"]=(($cheapmail["added"]==0)?$language["UNKNOWN"]:date('M j Y \\a\t h:i A',$cheapmail["added"]));
        $loop[$i]["added_by"]=(($cheapmail["added_by"]=="Unknown")?$language["UNKNOWN"]:  unesc($cheapmail["prefixcolor"].$cheapmail["added_by"].$cheapmail["suffixcolor"])   );
        $i++;
    }
    $admintpl->set("loop",$loop);
    $admintpl->set("counter",$i);
}
else
{
    $admintpl->set("haveloop",false,true);
    $admintpl->set("counter",$i);
}

?>
