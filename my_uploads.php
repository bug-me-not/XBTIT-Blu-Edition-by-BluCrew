<?php
/////////////////////////////////////////////////////////////////////////////////////
//   My Uploads
//
//   
//
////////////////////////////////////////////////////////////////////////////////////


if (!defined("IN_BTIT"))
  die("non direct access!");


// load language file
require(load_language("lang_fav_up_up.php"));

$id=intval(0+$_GET["id"]);
if (!isset($_GET["returnto"])) $_GET["returnto"] = "";
$link=rawurlencode($_GET["returnto"]);

if ($CURUSER["view_users"]!="yes")
{
 err_msg($language["ERROR"],$language["NOT_AUTHORIZED"]." ".$language["MEMBERS"]);
 stdfoot();
 die();
}

if ($id==1)
   { // trying to view guest details?
     err_msg($language["ERROR"],$language["GUEST_DETAILS"]);
     stdfoot();
     die();
   }

   if ($XBTT_USE)
   {
    $tseeds="f.seeds+ifnull(x.seeders,0)";
    $tleechs="f.leechers+ifnull(x.leechers,0)";
    $tcompletes="f.finished+ifnull(x.completed,0)";
    $ttables="{$TABLE_PREFIX}files f LEFT JOIN xbt_files x ON x.info_hash=f.bin_hash";
    $udownloaded="u.downloaded+IFNULL(x.downloaded,0)";
    $uuploaded="u.uploaded+IFNULL(x.uploaded,0)";
    $utables="{$TABLE_PREFIX}users u LEFT JOIN xbt_users x ON x.uid=u.id";
  }
  else
  {
    $tseeds="f.seeds";
    $tleechs="f.leechers";
    $tcompletes="f.finished";
    $ttables="{$TABLE_PREFIX}files f";
    $udownloaded="u.downloaded";
    $uuploaded="u.uploaded";
    $utables="{$TABLE_PREFIX}users u";
  }


  if ($id>1) {
   $res=get_result("SELECT u.avatar,u.email,u.cip,u.username,$udownloaded as downloaded,$uuploaded as uploaded,UNIX_TIMESTAMP(u.joined) as joined,UNIX_TIMESTAMP(u.lastconnect) as lastconnect,ul.level, u.flag, c.name, c.flagpic, u.pid, u.time_offset, u.smf_fid FROM $utables INNER JOIN {$TABLE_PREFIX}users_level ul ON ul.id=u.id_level LEFT JOIN {$TABLE_PREFIX}countries c ON u.flag=c.id WHERE u.id={$id}",true,$btit_settings['cache_duration']);
   $num=count($res);
   if ($num==0)
   {
     err_msg($language["ERROR"],$language["BAD_ID"]);
     stdfoot();
     die();
   }
   else {
    $row=$res[0];
  }
}
else
{
 err_msg($language["ERROR"],$language["BAD_ID"]);
 stdfoot();
 die();
}

include("include/offset.php");

$utorrents = intval($CURUSER["torrentsperpage"]);

$my_uploadstpl= new bTemplate();
$my_uploadstpl-> set("language",$language);
$my_uploadstpl-> set("userdetail_username", unesc($row["username"]));
//$my_uploadstpl-> set("userdetail_no_guest", $CURUSER["uid"]>1, TRUE);
$my_uploadstpl -> set("userdetail_downloaded", (makesize($row["downloaded"])));
$my_uploadstpl -> set("userdetail_uploaded", (makesize($row["uploaded"])));
$my_uploadstpl -> set("userdetail_ratio", ($ratio));


$resuploaded = get_result("SELECT count(*) as tf FROM {$TABLE_PREFIX}files f WHERE uploader=$id AND f.anonymous = \"false\" ORDER BY data DESC",true,$btit_settings['cache_duration']);
$numtorrent=$resuploaded[0]['tf'];
unset($resuploaded);
$my_uploadstpl->set("pagertop","");
if ($numtorrent>0)
{
 list($pagertop, $pagerbottom, $limit) = pager(($utorrents==0?15:$utorrents), $numtorrent, $_SERVER["PHP_SELF"]."?page=my_uploads&amp;id=$id&amp;pagename=uploaded&amp;",array("pagename" => "uploaded"));
 $my_uploadstpl->set("pagertop",$pagertop);
 $resuploaded = get_result("SELECT f.info_hash, f.filename, UNIX_TIMESTAMP(f.data) as added, f.size, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished FROM $ttables WHERE uploader=$id AND anonymous = \"false\" ORDER BY data DESC $limit",true,$btit_settings['cache_duration']);
}


if ($resuploaded && $numtorrent>0)
{
 $my_uploadstpl->set("RESULTS",true,true);
 $uptortpl=array();
 $i=0;
 foreach ($resuploaded as $ud_id=>$rest)
 {
   $rest["filename"]=unesc($rest["filename"]);
   $filename=cut_string($rest["filename"],intval($btit_settings["cut_name"]));
   if ($GLOBALS["usepopup"])
   {
     $uptortpl[$i]["filename"]="<a href=\"javascript:popdetails('index.php?page=torrent-details&amp;id=".$rest{"info_hash"}."')\" title=\"".$language["VIEW_DETAILS"].": ".$rest["filename"]."\">".$filename."</a>";
     $uptortpl[$i]["added"]=date("d/m/Y",$rest["added"]-$offset);
     $uptortpl[$i]["size"]=makesize($rest["size"]);
     $uptortpl[$i]["seedcolor"]=linkcolor($rest["seeds"]);
     $uptortpl[$i]["seeds"]="<a href=\"javascript:poppeer('index.php?page=peers&amp;id=".$rest{"info_hash"}."')\">$rest[seeds]</a>";
     $uptortpl[$i]["leechcolor"]=linkcolor($rest["leechers"]);
     $uptortpl[$i]["leechs"]="<a href=\"javascript:poppeer('index.php?page=peers&amp;id=".$rest{"info_hash"}."')\">$rest[leechers]</a>";
     if ($rest["finished"]>0)
       $uptortpl[$i]["completed"]="<a href=\"javascript:poppeer('index.php?page=torrent_history&amp;id=".$rest["info_hash"]."')\">" . $rest["finished"] . "</a>";
     else
       $uptortpl[$i]["completed"]="---";
     $i++;
   }
   else
   {
     $uptortpl[$i]["filename"]="<a href=\"index.php?page=torrent-details&amp;id=".$rest{"info_hash"}."\" title=\"".$language["VIEW_DETAILS"].": ".$rest["filename"]."\">".$filename."</a>";
     $uptortpl[$i]["added"]=date("d/m/Y",$rest["added"]-$offset);
     $uptortpl[$i]["size"]=makesize($rest["size"]);
     $uptortpl[$i]["seedcolor"]=linkcolor($rest["seeds"]);
     $uptortpl[$i]["seeds"]="<a href=\"index.php?page=peers&amp;id=".$rest{"info_hash"}."\">$rest[seeds]</a>";
     $uptortpl[$i]["leechcolor"]=linkcolor($rest["leechers"]);
     $uptortpl[$i]["leechs"]="<a href=\"index.php?page=peers&amp;id=".$rest{"info_hash"}."\">$rest[leechers]</a>";
     if ($rest["finished"]>0)
      $uptortpl[$i]["completed"]="<a href=\"index.php?page=torrent_history&amp;id=".$rest["info_hash"]."\">" . $rest["finished"] . "</a>";
    else
      $uptortpl[$i]["completed"]="---";
    $i++;
  }
}
$my_uploadstpl->set("uptor",$uptortpl);

}
else
{
 $my_uploadstpl->set("RESULTS",false,true);
}

if ($XBTT_USE)
 $anq=get_result("SELECT count(*) as tp FROM xbt_files_users xfu WHERE active=1 AND uid=$id",true,$btit_settings['cache_duration']);
else
{
  if ($PRIVATE_ANNOUNCE)
    $anq=get_result("SELECT count(*) as tp FROM {$TABLE_PREFIX}peers p INNER JOIN {$TABLE_PREFIX}files f ON f.info_hash = p.infohash WHERE p.pid='".$row["pid"]."'",true,$btit_settings['cache_duration']);
  else
    $anq=get_result("SELECT count(*) as tp FROM {$TABLE_PREFIX}peers p INNER JOIN {$TABLE_PREFIX}files f ON f.info_hash = p.infohash WHERE p.ip='".($row["cip"])."'",true,$btit_settings['cache_duration']);
}