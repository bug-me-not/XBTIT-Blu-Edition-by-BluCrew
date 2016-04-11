<?php
/////////////////////////////////////////////////////////////////////////////////////
//  Active
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

$activetpl= new bTemplate();
$activetpl-> set("language",$language);
$activetpl-> set("userdetail_username", unesc($row["username"]));


if ($XBTT_USE)
 $anq=get_result("SELECT count(*) as tp FROM xbt_files_users xfu WHERE active=1 AND uid=$id",true,$btit_settings['cache_duration']);
else
{
  if ($PRIVATE_ANNOUNCE)
    $anq=get_result("SELECT count(*) as tp FROM {$TABLE_PREFIX}peers p INNER JOIN {$TABLE_PREFIX}files f ON f.info_hash = p.infohash WHERE p.pid='".$row["pid"]."'",true,$btit_settings['cache_duration']);
  else
    $anq=get_result("SELECT count(*) as tp FROM {$TABLE_PREFIX}peers p INNER JOIN {$TABLE_PREFIX}files f ON f.info_hash = p.infohash WHERE p.ip='".($row["cip"])."'",true,$btit_settings['cache_duration']);
}


$activetpl->set("pagertopact","");

// ACTIVE TABLE
if ($anq[0]['tp']>0)
{
 $activetpl->set("RESULTS_1",true,true);
 $tortpl=array();
 $i=0;

 list($pagertop, $pagerbottom, $limit) = pager(($utorrents==0?15:$utorrents), $anq[0]['tp'], "index.php?page=active&amp;id=$id&amp;pagename=active&amp;",array("pagename" => "active"));
 $activetpl->set("pagertopact",$pagertop);
 if ($XBTT_USE)
  $anq=get_result("SELECT '127.0.0.1' as ip, f.info_hash as infohash, f.filename, f.size, IF(p.left=0,'seeder','leecher') as status, p.downloaded, p.uploaded, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished
    FROM xbt_files_users p INNER JOIN xbt_files x ON p.fid=x.fid INNER JOIN {$TABLE_PREFIX}files f ON f.bin_hash = x.info_hash
    WHERE p.uid={$id} AND p.active=1 ORDER BY status DESC $limit",true,$btit_settings['cache_duration']);
else
{
  if ($PRIVATE_ANNOUNCE)
    $anq=get_result("SELECT p.ip, p.infohash, f.filename, f.size, p.status, p.downloaded, p.uploaded, f.seeds, f.leechers, f.finished
      FROM {$TABLE_PREFIX}peers p INNER JOIN {$TABLE_PREFIX}files f ON f.info_hash = p.infohash
      WHERE p.pid='".$row["pid"]."' ORDER BY p.status DESC $limit",true,$btit_settings['cache_duration']);
  else
    $anq=get_result("SELECT p.ip, p.infohash, f.filename, f.size, p.status, p.downloaded, p.uploaded, f.seeds, f.leechers, f.finished
      FROM {$TABLE_PREFIX}peers p INNER JOIN {$TABLE_PREFIX}files f ON f.info_hash = p.infohash
      WHERE p.ip='".($row["cip"])."' ORDER BY p.status DESC $limit",true,$btit_settings['cache_duration']);
}
//    print("<div align=\"center\">$pagertop</div>");

foreach ($anq as $ud_id=>$torlist)
{
 if ($torlist['ip'] !="")
 {
   $torlist['filename']=unesc($torlist['filename']);
   $filename=cut_string($torlist['filename'],intval($btit_settings["cut_name"]));

   if ($GLOBALS["usepopup"])
   {
     $tortpl[$i]["filename"]="<a href=\"javascript:popdetails('index.php?page=torrent-details&amp;id=".$torlist['infohash']."')\" title=\"".$language["VIEW_DETAILS"].": ".$torlist['filename']."\">".$filename."</a>";
     $tortpl[$i]["size"]=makesize($torlist['size']);
     $tortpl[$i]["status"]=unesc($torlist['status']);
     $tortpl[$i]["downloaded"]=makesize($torlist['downloaded']);
     $tortpl[$i]["uploaded"]=makesize($torlist['uploaded']);
     if ($torlist['downloaded']>0)
      $peerratio=number_format($torlist['uploaded']/$torlist['downloaded'],2);
    else
      $peerratio='&#8734;';
    $tortpl[$i]["peerratio"]=unesc($peerratio);
    $tortpl[$i]["seedscolor"]=linkcolor($torlist['seeds']);
    $tortpl[$i]["seeds"]="<a href=\"javascript:poppeer('index.php?page=peers&amp;id=".$torlist['infohash']."')\">".$torlist['seeds']."</a>";
    $tortpl[$i]["leechcolor"]=linkcolor($torlist['leechers']);
    $tortpl[$i]["leechs"]="<a href=\"javascript:poppeer('index.php?page=peers&amp;id=".$torlist['infohash']."')\">".$torlist['leechers']."</a>";
    $tortpl[$i]["completed"]="<a href=\"javascript:poppeer('index.php?page=torrent_history.php&amp;id=".$torlist['infohash']."')\">".$torlist['finished']."</a>";
    $i++;
    $activetpl->set("tortpl",$tortpl);
  }
  else
  {
   $tortpl[$i]["filename"]="<a href=\"index.php?page=torrent-details&amp;id=".$torlist['infohash']."\" title=\"".$language["VIEW_DETAILS"].": ".$torlist['filename']."\">".$filename."</a>";
   $tortpl[$i]["size"]=makesize($torlist['size']);
   $tortpl[$i]["status"]=unesc($torlist['status']);
   $tortpl[$i]["downloaded"]=makesize($torlist['downloaded']);
   $tortpl[$i]["uploaded"]=makesize($torlist['uploaded']);
   if ($torlist['downloaded']>0)
    $peerratio=number_format($torlist['uploaded']/$torlist['downloaded'],2);
  else
    $peerratio='&#8734;';
  $tortpl[$i]["peerratio"]=unesc($peerratio);
  $tortpl[$i]["seedscolor"]=linkcolor($torlist['seeds']);
  $tortpl[$i]["seeds"]="<a href=\"index.php?page=peers&amp;id=".$torlist['infohash']."\">".$torlist['seeds']."</a>";
  $tortpl[$i]["leechcolor"]=linkcolor($torlist['leechers']);
  $tortpl[$i]["leechs"]="<a href=\"index.php?page=peers&amp;id=".$torlist['infohash']."\">".$torlist['leechers']."</a>";
  $tortpl[$i]["completed"]="<a href=\"index.php?page=torrent_history&amp;id=".$torlist['infohash']."\">".$torlist['finished']."</a>";
  $i++;
  $activetpl->set("tortpl",$tortpl);
}
}
}
} else $activetpl->set("RESULTS_1",false,true);

unset($anq);
?>