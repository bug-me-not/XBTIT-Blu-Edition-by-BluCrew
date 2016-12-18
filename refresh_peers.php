<?php

include("include/functions.php");

(isset($_GET["id"]) && !empty($_GET["id"]) && strlen($_GET["id"])==40) ? $id=sql_esc(preg_replace("/[^a-zA-Z0-9]/","",$_GET["id"])) : $id=false;

if($id===false)
die();

$my_timeout=time()-(intval($btit_settings["sanity_update"] * 2));

if($XBTT_USE)
{
   $res=get_result("SELECT `fid` FROM `xbt_files` WHERE `info_hash`=0x$id", true, $btit_settings["cache_duration"]);
   if(count($res)>0)
   {
      $fid=(int)$res[0]["fid"];
      quickQuery("UPDATE `xbt_files_users` SET `active`=0 WHERE `mtime`<".$my_timeout." AND `fid`=".$fid, true);
      $res=get_result("SELECT (SELECT COUNT(*) FROM `xbt_files_users` WHERE `fid`=".$fid." AND `left`=0 AND `active`=1) `seeders`, (SELECT COUNT(*) FROM `xbt_files_users` WHERE `fid`=".$fid." AND `left`>0 AND `active`=1) `leechers`, (SELECT COUNT(*) FROM `xbt_files_users` WHERE `fid`=".$fid." AND `completed`>0) `completed`", true, $btit_settings["cache_duration"]);
      if(count($res)>0)
      {
         $row=$res[0];
         quickQuery("UPDATE `xbt_files` SET `seeders`=".$row["seeders"].", `leechers`=".$row["leechers"].", `completed`=".$row["completed"]." WHERE `fid`=".$fid);
         echo $row["seeders"]."[*]".$row["leechers"]."[*]".($row["seeders"]+$row["leechers"]);
      }
   }

}
else
{
   quickQuery("DELETE FROM `{$TABLE_PREFIX}peers` WHERE `lastupdate` < ".$my_timeout." AND `infohash`='".$id."'", true);
   $res=get_result("SELECT `status`, COUNT(`status`) `status_count` FROM `{$TABLE_PREFIX}peers` WHERE `infohash`='".$id."' GROUP BY `status`", true, $btit_settings["cache_duration"]);
   $counts = array();
   if(count($res)>0)
   {
      foreach($res as $row)
      {
         $counts[$row["status"]] = (int)0+$row["status_count"];
      }
   }
   $seeders=(isset($counts["seeder"])?$counts["seeder"]:0);
   $leechers=(isset($counts["leecher"])?$counts["leecher"]:0);
   $total_count=($seeders+$leechers);
   quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `leechers`=".$leechers.", `seeds`=".$seeders." WHERE `info_hash`='".$id."'", true);
   echo $seeders."[*]".$leechers."[*]".$total_count;
}

?>
