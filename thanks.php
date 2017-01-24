<?php

if ((isset($_POST["infohash"]))&&(!empty($_POST["infohash"])))
{   
    $_POST["infohash"]=str_replace("'","",$_POST["infohash"]);
    $THIS_BASEPATH=dirname(__FILE__);
    require("$THIS_BASEPATH/include/functions.php");
    include(load_language("lang_torrents.php"));
    dbconn();

    if($btit_settings["fmhack_SEO_panel"]=="enabled")
    {
        $active_seo_thanks = get_result("SELECT `activated_user`, `str`, `strto` FROM `{$TABLE_PREFIX}seo` WHERE `id`='1'", true, $btit_settings["cache_duration"]);
        $res_seo_thanks=$active_seo_thanks[0];
    }

    $uid = intval(0+$CURUSER['uid']);
    if(preg_match("/([a-z0-9]{40})/",$_POST['infohash']))
    {
        $infohash=stripslashes($_POST["infohash"]);
    }
    else
    {
        die('Hacking Attempt!');
    }

    $out="";
    $rt=get_result("SELECT `uploader` FROM `{$TABLE_PREFIX}files` WHERE `info_hash`='".$infohash."' AND `uploader`=".$uid, true, $btit_settings["cache_duration"]);
    // he's not the uploader
    if (count($rt)==0)
       $button=true;
    else
       $button=false;

    // saying thank you.
    if (isset($_POST["thanks"]) && $button)
    {
        $rt=get_result("SELECT `userid` FROM `{$TABLE_PREFIX}files_thanks` WHERE `userid`=$uid AND `infohash`='".$infohash."'", true);
        // never thanks for this file
        if (count($rt)==0)
        {
           quickQuery("INSERT INTO `{$TABLE_PREFIX}files_thanks` (`infohash`, `userid`) VALUES ('".$infohash."', $uid)");
        }
    }

    $rt=get_result("SELECT `u`.`id`, `u`.`username`, `ul`.`prefixcolor`, `ul`.`suffixcolor` FROM `{$TABLE_PREFIX}files_thanks` `t` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `u`.`id`=`t`.`userid` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `infohash`='".$infohash."'", true, $btit_settings["cache_duration"]);
    if (count($rt)==0)
       $out=$language["THANKS_BE_FIRST"];

    foreach($rt as $ty)
    {
        if ($ty["id"]==$uid) // already thank
            $button=false;
        $out.="<a href=\"$BASEURL/".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo_thanks["activated_user"]=="true")?$ty["id"]."_".strtr($ty["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$ty["id"])."\">".unesc($ty["prefixcolor"].$ty["username"].$ty["suffixcolor"])."</a> ";
    }
    if ($button && $CURUSER["uid"]>1)
       $out.="|0";
    else
       $out.="|1";

}
else
    $out= "no direct access!";

echo $out;
die;

?>