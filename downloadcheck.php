<?php

$minratio=$btit_settings["mindlratio"];

// load language file
require(load_language("lang_downloadcheck.php"));

$dlchecktpl = new bTemplate();
$dlchecktpl -> set("language",$language);

if (!$CURUSER || $CURUSER["view_torrents"]=="no" || $CURUSER["can_download"]=="no")
{
    err_msg($language["ERROR"],$language["NOT_AUTH_DOWNLOAD"]);
    stdfoot(($GLOBALS["usepopup"]?false:true));
    die();
}

(isset($_GET["id"]) ? $id=sql_esc(strtolower(preg_replace("/[^A-Fa-f0-9]/", "", $_GET["id"]))) : $id="");

if($id=="")
{
    err_msg($language["ERROR"],$language["BAD_ID"]);
    stdfoot(($GLOBALS["usepopup"]?false:true));
    die();
}
$completedb4 = false;
if($XBTT_USE)
    $res = get_result("SELECT COUNT(*) `count` FROM `xbt_files_users` `xfu` INNER JOIN `xbt_files` `xf` ON `xfu`.`fid`=`xf`.`fid` INNER JOIN `{$TABLE_PREFIX}users` `u` ON `xfu`.`uid`=`u`.`id` WHERE `xfu`.`completed`>0 AND `xf`.`info_hash`=0x".$id." AND `xfu`.`uid`=".$CURUSER["uid"]);
else
    $res = get_result("SELECT COUNT(*) `count` FROM `{$TABLE_PREFIX}history` `h` INNER JOIN `{$TABLE_PREFIX}users` `u` ON `h`.`uid`=`u`.`id` WHERE `h`.`completed`='yes' AND `h`.`infohash`='".$id."' AND `h`.`uid`=".$CURUSER["uid"]);
if($res[0]["count"] > 0)
    $completedb4 = true;
if($btit_settings["fmhack_magnet_links"] == "enabled")
    $query1_select.="`f`.`magnet`,";
$res = do_sqlquery("SELECT ".$query1_select." f.filename, f.size, f.uploader, f.anonymous, u.id, u.username, ul.prefixcolor, ul.suffixcolor FROM {$TABLE_PREFIX}files f LEFT JOIN {$TABLE_PREFIX}users u ON u.id=f.uploader LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE info_hash='$id'");
if(sql_num_rows($res)==1)
    $row=$res->fetch_assoc();
else
{
    err_msg($language["ERROR"],$language["BAD_ID"]);
    stdfoot(($GLOBALS["usepopup"]?false:true));
    die();
}
if ($XBTT_USE)
   $res=do_sqlquery("SELECT u.id, (u.downloaded+IFNULL(x.downloaded,0)) as downloaded, ((u.uploaded+IFNULL(x.uploaded,0))/(u.downloaded+IFNULL(x.downloaded,0))) as ratio FROM {$TABLE_PREFIX}users u LEFT JOIN xbt_users x ON x.uid=u.id WHERE u.id=".$CURUSER["uid"]);
else
   $res=do_sqlquery("SELECT id, downloaded, (uploaded/downloaded) as ratio FROM {$TABLE_PREFIX}users WHERE id=".$CURUSER["uid"]);

$user = $res->fetch_assoc();
$anon=$row["anonymous"];//account for anonymous
$row["clean_username"]=$row["username"];
if($anon=="true" && $row["uploader"]==$row["id"] && $CURUSER["edit_torrents"]=="no")
          {
              $row["username"]=$language["ANONYMOUS"];
              $row["clean_username"]=$row["username"];
              $row["prefixcolor"]="";
              $row["suffixcolor"]="";
              $row["uploader"]=0;

          }
          elseif($anon=="true" && $row["uploader"]==$row["id"] && $CURUSER["edit_torrents"]=="yes")
              $row["username"]="".stripslashes($row["prefixcolor"]).$row["username"].stripslashes($row["suffixcolor"])."&nbsp;(".$language["ANONYMOUS"].")";
          elseif($anon=="false")
              $row["username"]=stripslashes($row["prefixcolor"].$row["username"].$row["suffixcolor"]);

$uploader="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$row["uploader"]."_".strtr($row["clean_username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$row["uploader"])."'>".$row["username"]."</a>";
(is_numeric($user["ratio"])?$ratio=number_format($user["ratio"], 3):$ratio=$user["ratio"]);

if(is_null($ratio))
    $ratio="&#8734;";

$dlcheck=array();
$dlcheck["username"]=$CURUSER["username"];

// user downloaded less than 10mb or good ratio, or by pass, or admin, or is uploader
if($user["downloaded"]<="1048576" || $ratio>=$minratio || $ratio=="&#8734;" || $CURUSER["bypass_dlcheck"]==1 || $CURUSER["admin_access"]=="yes" || $row["uploader"]==$CURUSER["uid"] || $completedb4) {
    $dlcheck["result"]=$language["TORRENT_READY"];
    $dlcheck["link"]="<a href='".(($btit_settings["fmhack_magnet_links"]=="enabled" && !$DHT_PRIVATE && !$PRIVATE_ANNOUNCE && $row["magnet"]!="")?base64_decode(stripslashes($row["magnet"])):"download.php?id=".$id."&amp;f=".urlencode($row["filename"]).".torrent&amp;key=".$CURUSER["dlrandom"])."'".(($btit_settings["fmhack_magnet_links"]=="enabled" && !$DHT_PRIVATE && !$PRIVATE_ANNOUNCE && $row["magnet"]!="")?" title='".$language["MAGNET_DOWN_USING"]."'":" title='".$language["DOWNLOAD_TORRENT"]."'")."><img src='images/".(($btit_settings["fmhack_magnet_links"]=="enabled" && !$DHT_PRIVATE && !$PRIVATE_ANNOUNCE && $row["magnet"]!="")?"magnet":"download").".gif' border='0' ".(($btit_settings["fmhack_magnet_links"]=="enabled" && !$DHT_PRIVATE && !$PRIVATE_ANNOUNCE && $row["magnet"]!="")?"alt='".$language["MAGNET_DOWN_USING"]."' title='".$language["MAGNET_DOWN_USING"]."'":"alt='".$language["DOWNLOAD_TORRENT"]."' title='".$language["DOWNLOAD_TORRENT"]."'")." />&nbsp;&nbsp;".$language["DOWNLOAD_NOW"]."</a>";
}
else {
    $dlcheck["result"]=$language["TORRENT_NOT_READY_1"] . $minratio . $language["TORRENT_NOT_READY_2"];
    $dlcheck["link"]=$language["CANT_DOWNLOAD"];
}
$dlcheck["ratio"]=$ratio;
$dlcheck["size"]=makesize($row["size"])." (".number_format($row["size"])." bytes)";
$dlcheck["uploader"]=$uploader;
$dlcheck["filename"]="<a title='Details' href='index.php?page=torrent-details&amp;id=".$id."'>".$row["filename"]."</a>";

$dlchecktpl -> set("dlcheck", $dlcheck);

?>
