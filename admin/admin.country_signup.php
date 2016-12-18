<?php
if(!defined("IN_BTIT"))
    die("non direct access!");
if(!defined("IN_ACP"))
    die("non direct access!");

if(isset($_POST) && !empty($_POST))
{
    $blockedArray=array_unique(explode("\r\n", $_POST["country_codes"]));
    sort($blockedArray, SORT_STRING);
    if(count($blockedArray)>0)
    {
        $blockedArray2=$blockedArray;
        foreach($blockedArray2 as $key => $value)
        {
            if(empty($value) || substr($value, 0, 1)!="[" || substr($value, 3, 1)!="]")
                unset($blockedArray[$key]);
        }
    }
    $blocked_signup_countries=sqlesc(((count($blockedArray)>0)?implode(",", $blockedArray):""));
    quickQuery("DELETE FROM `{$TABLE_PREFIX}settings` WHERE `key`='blocked_signup_countries'", true);
    quickQuery("INSERT INTO `{$TABLE_PREFIX}settings` (`key`, `value`) VALUES ('blocked_signup_countries', '".$blocked_signup_countries."');", true);
    foreach(glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=csignup");
}
$select="<option value='false'>---</option>\n";
$pad="            ";
$res=get_result("SELECT `country_code2`, `country_name` FROM `{$TABLE_PREFIX}ip2country` GROUP BY `country_code2` ORDER BY `country_name` ASC", true, $btit_settings["cache_duration"]);
if(count($res)>0)
{
    foreach($res as $row)
    {
        $select.=$pad."<option value='".$row["country_code2"]."' onclick='addToTextarea(\"[".$row["country_code2"]."] (".$row["country_name"].")\");'>".$row["country_name"]."</option>\n";
    }
}
$select=trim($select, "\n");
$admintpl->set("select", $select);
$admintpl->set("currentBlocked", (($btit_settings["blocked_signup_countries"]!="")?str_replace(",", "\r\n", $btit_settings["blocked_signup_countries"])."\r\n":""));
$admintpl->set("uid", $CURUSER["uid"]);
$admintpl->set("random", $CURUSER["random"]);
$admintpl->set("language", $language);
?>