<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2011  Btiteam
//
//    This file is part of xbtit.
//
// Redistribution and use in source and binary forms, with or without modification,
// are permitted provided that the following conditions are met:
//
//   1. Redistributions of source code must retain the above copyright notice,
//      this list of conditions and the following disclaimer.
//   2. Redistributions in binary form must reproduce the above copyright notice,
//      this list of conditions and the following disclaimer in the documentation
//      and/or other materials provided with the distribution.
//   3. The name of the author may not be used to endorse or promote products
//      derived from this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
// WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
// MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
// IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
// TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
// PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
// LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
// NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
// EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
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
   $res=get_result("SELECT u.avatar,u.email,u.cip,u.username,$udownloaded as downloaded,$uuploaded as uploaded,UNIX_TIMESTAMP(u.joined) as joined,UNIX_TIMESTAMP(u.lastconnect) as lastconnect,ul.level, u.flag, c.name, c.flagpic, u.pid, u.time_offset, u.smf_fid FROM $utables INNER JOIN {$TABLE_PREFIX}users_level ul ON ul.id=u.id_level LEFT JOIN {$TABLE_PREFIX}countries c ON u.flag=c.id WHERE u.id=$id",true,$btit_settings['cache_duration']);
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

// user's ratio
if (intval($row["downloaded"])>0)
 {
   $sr = $row["uploaded"]/$row["downloaded"];
   if ($sr >= 4)
     $s = "images/smilies/thumbsup.gif";
   else if ($sr >= 2)
     $s = "images/smilies/grin.gif";
   else if ($sr >= 1)
     $s = "images/smilies/smile1.gif";
   else if ($sr >= 0.5)
     $s = "images/smilies/noexpression.gif";
   else if ($sr >= 0.25)
     $s = "images/smilies/sad.gif";
   else
     $s = "images/smilies/thumbsdown.gif";
  $ratio=number_format($sr,2)."&nbsp;&nbsp;<img src=\"$s\" alt=\"\" />";
 }
else
   $ratio='&#8734;';

$utorrents = intval($CURUSER["torrentsperpage"]);

$fav_up_uptpl= new bTemplate();
$fav_up_uptpl-> set("language",$language);
$fav_up_uptpl-> set("userdetail_username", unesc($row["username"]));
//$fav_up_uptpl-> set("userdetail_no_guest", $CURUSER["uid"]>1, TRUE);
if ($CURUSER["uid"]>1 && $id!=$CURUSER["uid"])
    $fav_up_uptpl -> set("userdetail_send_pm", "&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=usercp&amp;do=pm&amp;action=edit&amp;uid=".$CURUSER["uid"]."&amp;what=new&amp;to=".urlencode(unesc($row["username"]))."\">".image_or_link("$STYLEPATH/images/pm.png","",$language["PM"])."</a>");
if ($CURUSER["edit_users"]=="yes" && $id!=$CURUSER["uid"])
    $fav_up_uptpl -> set("fav_up_up_edit","&nbsp;&nbsp;&nbsp<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=users&amp;action=edit&amp;uid=$id&amp;returnto=index.php?page=fav_up_ups&amp;id=$id\">".image_or_link("$STYLEPATH/images/edit.png","",$language["EDIT"])."</a>");
if ($CURUSER["delete_users"]=="yes" && $id!=$CURUSER["uid"])
    $fav_up_uptpl -> set("userdetail_delete", "&nbsp;&nbsp;&nbsp<a onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\" href=index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=users&amp;action=delete&amp;uid=$id&amp;smf_fid=".$row["smf_fid"]."&amp;returnto=".urlencode("index.php?page=users")."\">".image_or_link("$STYLEPATH/images/delete.png","",$language["DELETE"])."</a>");
$fav_up_uptpl -> set("userdetail_has_avatar", $row["avatar"] && $row["avatar"]!="", TRUE);

$fav_up_uptpl -> set("userdetail_avatar","<img border=\"0\" onload=\"resize_avatar(this);\" src=\"".htmlspecialchars($row["avatar"])."\" alt=\"\" />");

$fav_up_uptpl -> set("userdetail_edit_admin", $CURUSER["edit_users"]=="yes" || $CURUSER["admin_access"]=="yes", TRUE);
if ($CURUSER["edit_users"]=="yes" || $CURUSER["admin_access"]=="yes")
{
$fav_up_uptpl -> set("userdetail_email", "<a href=\"mailto:".$row["email"]."\">".$row["email"]."</a>");
$fav_up_uptpl -> set("userdetail_last_ip", ($row["cip"]));
$fav_up_uptpl -> set("userdetail_level_admin", ($row["level"]));
$fav_up_uptpl -> set("userdetail_colspan", "2");
}
else
{
$fav_up_uptpl-> set("userdetail_level", ($row["level"]));
$fav_up_uptpl-> set("userdetail_colspan", "0");
}
$fav_up_uptpl -> set("userdetail_joined", ($row["joined"]==0 ? "N/A" : get_date_time($row["joined"])));
$fav_up_uptpl -> set("userdetail_lastaccess", ($row["lastconnect"]==0 ? "N/A" : get_date_time($row["lastconnect"])));
$fav_up_uptpl -> set("userdetail_country", ($row["flag"]==0 ? "":unesc($row['name']))."&nbsp;&nbsp;<img src=\"images/flag/".(!$row["flagpic"] || $row["flagpic"]==""?"unknown.gif":$row["flagpic"])."\" alt=\"".($row["flag"]==0 ? "unknown":unesc($row['name']))."\" />");
$fav_up_uptpl -> set("userdetail_local_time", (date("d/m/Y H:i:s",time()-$offset)."&nbsp;(GMT".($row["time_offset"]>0?" +".$row["time_offset"]:($row["time_offset"]==0?"":" ".$row["time_offset"])).")"));
$fav_up_uptpl -> set("userdetail_downloaded", (makesize($row["downloaded"])));
$fav_up_uptpl -> set("userdetail_uploaded", (makesize($row["uploaded"])));
$fav_up_uptpl -> set("userdetail_ratio", ($ratio));
$fav_up_uptpl-> set("userdetail_forum_internal", ( $GLOBALS["FORUMLINK"] == '' || $GLOBALS["FORUMLINK"] == 'internal' || $GLOBALS["FORUMLINK"] == 'smf'), TRUE);

// Only show if forum is internal
if ( $GLOBALS["FORUMLINK"] == '' || $GLOBALS["FORUMLINK"] == 'internal' )
   {
   $sql = get_result("SELECT count(*) as tp FROM {$TABLE_PREFIX}posts p INNER JOIN {$TABLE_PREFIX}users u ON p.userid = u.id WHERE u.id = " . $id,true,$btit_settings['cache_duration']);
   $posts = $sql[0]['tp'];
   unset($sql);
   $memberdays = max(1, round( ( time() - $row['joined'] ) / 86400 ));
   $posts_per_day = number_format(round($posts / $memberdays,2),2);
   $fav_up_uptpl-> set("userdetail_forum_posts", $posts . " &nbsp; [" . sprintf($language["POSTS_PER_DAY"], $posts_per_day) . "]");
}
elseif ($GLOBALS["FORUMLINK"]=="smf")
   {
   $forum=get_result("SELECT dateRegistered, posts FROM {$db_prefix}members WHERE ID_MEMBER=".$row["smf_fid"],true,$btit_settings['cache_duration']);
   $forum=$forum[0];
   $memberdays = max(1, round( ( time() - $forum["dateRegistered"] ) / 86400 ));
   $posts_per_day = number_format(round($forum["posts"] / $memberdays,2),2);
   $fav_up_uptpl-> set("userdetail_forum_posts", $forum["posts"] . " &nbsp; [" . sprintf($language["POSTS_PER_DAY"], $posts_per_day) . "]");
   unset($forum);
}

$resuploaded = get_result("SELECT count(*) as tf FROM {$TABLE_PREFIX}files f WHERE uploader=$id AND f.anonymous = \"false\" ORDER BY data DESC",true,$btit_settings['cache_duration']);
$numtorrent=$resuploaded[0]['tf'];
unset($resuploaded);
$fav_up_uptpl->set("pagertop","");
if ($numtorrent>0)
   {
   list($pagertop, $pagerbottom, $limit) = pager(($utorrents==0?15:$utorrents), $numtorrent, $_SERVER["PHP_SELF"]."?page=userdetails&amp;id=$id&amp;pagename=uploaded&amp;",array("pagename" => "uploaded"));
   $fav_up_uptpl->set("pagertop",$pagertop);
   $resuploaded = get_result("SELECT f.info_hash, f.filename, UNIX_TIMESTAMP(f.data) as added, f.size, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished FROM $ttables WHERE uploader=$id AND anonymous = \"false\" ORDER BY data DESC $limit",true,$btit_settings['cache_duration']);
}


if ($resuploaded && $numtorrent>0)
   {
   $fav_up_uptpl->set("RESULTS",true,true);
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
          $fav_up_uptpl->set("uptor",$uptortpl);

   }
else
   {
   $fav_up_uptpl->set("RESULTS",false,true);
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


$fav_up_uptpl->set("pagertopact","");

// active torrents
if ($anq[0]['tp']>0)
   {
   $fav_up_uptpl->set("RESULTS_1",true,true);
   $tortpl=array();
   $i=0;

    list($pagertop, $pagerbottom, $limit) = pager(($utorrents==0?15:$utorrents), $anq[0]['tp'], "index.php?page=userdetails&amp;id=$id&amp;pagename=active&amp;",array("pagename" => "active"));
    $fav_up_uptpl->set("pagertopact",$pagertop);
    if ($XBTT_USE)
            $anq=get_result("SELECT '127.0.0.1' as ip, f.info_hash as infohash, f.filename, f.size, IF(p.left=0,'seeder','leecher') as status, p.downloaded, p.uploaded, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished
                        FROM xbt_files_users p INNER JOIN xbt_files x ON p.fid=x.fid INNER JOIN {$TABLE_PREFIX}files f ON f.bin_hash = x.info_hash
                        WHERE p.uid=$id AND p.active=1 ORDER BY status DESC $limit",true,$btit_settings['cache_duration']);
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
                 $fav_up_uptpl->set("tortpl",$tortpl);
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
                 $fav_up_uptpl->set("tortpl",$tortpl);
            }
         }
        }
   } else $fav_up_uptpl->set("RESULTS_1",false,true);

unset($anq);

if ($XBTT_USE)
   $anq=get_result("SELECT count(h.fid) as th FROM xbt_files_users h INNER JOIN xbt_files f ON h.fid=f.fid WHERE h.uid=$id AND h.completed=1",true,$btit_settings['cache_duration']);
else
    $anq=get_result("SELECT count(h.infohash) as th FROM {$TABLE_PREFIX}history h INNER JOIN {$TABLE_PREFIX}files f ON h.infohash=f.info_hash WHERE h.uid=$id AND h.date IS NOT NULL",true,$btit_settings['cache_duration']);

$fav_up_uptpl->set("pagertophist","");

if ($anq[0]['th']>0)
   {
    $fav_up_uptpl->set("RESULTS_2",true,true);
    $torhistory=array();
    $i=0;
    list($pagertop, $pagerbottom, $limit) = pager(($utorrents==0?15:$utorrents), $sanq[0]['th'], "index.php?page=userdetails&amp;id=$id&amp;pagename=history&amp;",array("pagename" => "history"));
    $fav_up_uptpl->set("pagertophist",$pagertop);
    if ($XBTT_USE)
       $anq=get_result("SELECT f.filename, f.size, f.info_hash, IF(h.active=1,'yes','no'), 'unknown' as agent, h.downloaded, h.uploaded, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished
       FROM $ttables INNER JOIN xbt_files_users h ON h.fid=x.fid WHERE h.uid=$id AND h.completed=1 ORDER BY h.mtime DESC $limit",true,$btit_settings['cache_duration']);
    else
      $anq=get_result("SELECT f.filename, f.size, f.info_hash, h.active, h.agent, h.downloaded, h.uploaded, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished
      FROM $ttables INNER JOIN {$TABLE_PREFIX}history h ON h.infohash=f.info_hash WHERE h.uid=$id AND h.date IS NOT NULL ORDER BY date DESC $limit",true,$btit_settings['cache_duration']);
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
                $fav_up_uptpl->set("torhistory",$torhistory);
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
                $fav_up_uptpl->set("torhistory",$torhistory);
            }
        }
   } else $fav_up_uptpl->set("RESULTS_2",false,true);

unset($sanq);
$fav_up_uptpl-> set("userdetail_back", "<a  href=\"javascript: history.go(-1);\">".$language["BACK"]."</a>");

?>