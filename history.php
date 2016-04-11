<?php
/////////////////////////////////////////////////////////////////////////////////////
//   History
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

$historytpl= new bTemplate();
$historytpl-> set("language",$language);
$historytpl-> set("userdetail_username", unesc($row["username"]));
$historytpl -> set("userdetail_downloaded", (makesize($row["downloaded"])));
$historytpl -> set("userdetail_uploaded", (makesize($row["uploaded"])));
$historytpl -> set("userdetail_ratio", ($ratio));




$historytpl->set("pagertopact","");

//HISTORY TABLE

if ($XBTT_USE)
 $anq=get_result("SELECT count(h.fid) as th FROM xbt_files_users h INNER JOIN xbt_files f ON h.fid=f.fid WHERE h.uid={$id} AND h.completed=1",true,$btit_settings['cache_duration']);
else
  $anq=get_result("SELECT count(h.infohash) as th FROM {$TABLE_PREFIX}history h INNER JOIN {$TABLE_PREFIX}files f ON h.infohash=f.info_hash WHERE h.uid={$id} AND h.date IS NOT NULL",true,$btit_settings['cache_duration']);

$historytpl->set("pagertophist","");

if ($anq[0]['th']>0)
{
  $historytpl->set("RESULTS_2",true,true);
  $torhistory=array();
  $i=0;
  list($pagertop, $pagerbottom, $limit) = pager(($utorrents==0?15:$utorrents), $sanq[0]['th'], "index.php?page=snatched&amp;id=$id&amp;pagename=history&amp;",array("pagename" => "history"));
  $historytpl->set("pagertophist",$pagertop);
  if ($XBTT_USE)
   $anq=get_result("SELECT f.filename, f.size, f.info_hash, IF(h.active=1,'yes','no'), 'unknown' as agent, h.downloaded, h.uploaded, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished
     FROM $ttables INNER JOIN xbt_files_users h ON h.fid=x.fid WHERE h.uid={$id} AND h.completed=1 ORDER BY h.mtime DESC $limit",true,$btit_settings['cache_duration']);
 else
  $anq=get_result("SELECT f.filename, f.size, f.info_hash, h.active, h.agent, h.downloaded, h.uploaded, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished
    FROM $ttables INNER JOIN {$TABLE_PREFIX}history h ON h.infohash=f.info_hash WHERE h.uid={$id} AND h.date IS NOT NULL ORDER BY date DESC $limit",true,$btit_settings['cache_duration']);
//    print("<div align=\"center\">$pagertop</div>");
foreach ($anq as $ud_id=>$torlist)
{
  $torlist['filename']=unesc($torlist['filename']);
  $filename=cut_string($torlist['filename'],intval($btit_settings["cut_name"]));

  if ($GLOBALS["usepopup"])
  {
    $torhistory[$i]["filename"]="<a href=\"javascript:popdetails('index.php?page=torrent-details&amp;id=".$torlist['info_hash']."')\" title=\"".$language["VIEW_DETAILS"].": ".$torlist['filename']."\">".$filename."</a>";
    $torhistory[$i]["size"]=makesize($torlist['size']);
    $torhistory[$i]["agent"]=htmlspecialchars($torlist['agent']);
    $torhistory[$i]["status"]=($torlist['active']=='yes'?$language["ACTIVATED"]:'Stopped');
    $torhistory[$i]["downloaded"]=makesize($torlist['downloaded']);
    $torhistory[$i]["uploaded"]=makesize($torlist['uploaded']);
    if ($torlist['downloaded']>0)
     $peerratio=number_format($torlist['uploaded']/$torlist['downloaded'],2);
   else
     $peerratio='&#8734;';
   $torhistory[$i]["ratio"]=unesc($peerratio);
   $torhistory[$i]["seedscolor"]=linkcolor($torlist['seeds']);
   $torhistory[$i]["seeds"]="<a href=\"javascript:poppeer('index.php?page=peers&amp;id=".$torlist['info_hash']."')\">".$torlist['seeds']."</a>";
   $torhistory[$i]["leechcolor"]=linkcolor($torlist['leechers']);
   $torhistory[$i]["leechs"]="<a href=\"javascript:poppeer('index.php?page=peers&amp;id=".$torlist['info_hash']."')\">".$torlist['leechers']."</a>";
   $torhistory[$i]["completed"]="<a href=\"javascript:poppeer('index.php?page=torrent_history&amp;id=".$torlist['info_hash']."\">".$torlist['finished']."</a>";
   $i++;
   $historytpl->set("torhistory",$torhistory);
 }
 else
 {
  $torhistory[$i]["filename"]="<a href=\"index.php?page=torrent-details&amp;id=".$torlist['info_hash']."\" title=\"".$language["VIEW_DETAILS"].": ".$torlist['filename']."\">".$filename."</a>";
  $torhistory[$i]["size"]=makesize($torlist['size']);
  $torhistory[$i]["agent"]=htmlspecialchars($torlist['agent']);
  $torhistory[$i]["status"]=($torlist['active']=='yes'?$language["ACTIVATED"]:'Stopped');
  $torhistory[$i]["downloaded"]=makesize($torlist['downloaded']);
  $torhistory[$i]["uploaded"]=makesize($torlist['uploaded']);
  if ($torlist['downloaded']>0)
   $peerratio=number_format($torlist['uploaded']/$torlist['downloaded'],2);
 else
   $peerratio='&#8734;';
 $torhistory[$i]["ratio"]=unesc($peerratio);
 $torhistory[$i]["seedscolor"]=linkcolor($torlist['seeds']);
 $torhistory[$i]["seeds"]="<a href=\"index.php?page=peers&amp;id=".$torlist['info_hash']."\">".$torlist['seeds']."</a>";
 $torhistory[$i]["leechcolor"]=linkcolor($torlist['leechers']);
 $torhistory[$i]["leechs"]="<a href=\"index.php?page=peers&amp;id=".$torlist['info_hash']."\">".$torlist['leechers']."</a>";
 $torhistory[$i]["completed"]="<a href=\"index.php?page=torrent_history&amp;id=".$torlist['info_hash']."\">".$torlist['finished']."</a>";
 $i++;
 $historytpl->set("torhistory",$torhistory);
}
}
} else $historytpl->set("RESULTS_2",false,true);

unset($sanq);
$historytpl-> set("userdetail_back", "<a  href=\"javascript: history.go(-1);\">".$language["BACK"]."</a>");

?>