<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
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

$i=0;
$scriptname = htmlspecialchars($_SERVER["PHP_SELF"]."?page=peers&amp;id=$_GET[id]");
$addparam = "";
$id = AddSlashes($_GET["id"]);
if (!isset($id) || !$id)
die("Error ID");

if($btit_settings["fmhack_view_peer_details"]=="enabled" && $CURUSER["view_peers"]=="no")
stderr($language["ERROR"], $language["CANT_VIEW_PAGE"]);

$res = get_result("SELECT ".(($btit_settings["fmhack_speed_stats_in_peers_with_filename"]=="enabled")?"filename,":"")." anonymous,uploader, size FROM {$TABLE_PREFIX}files WHERE info_hash='$id'",true);
if ($res)
{
   $row=$res[0];
   if ($row)
   {
      $tsize=0+$row["size"];
      $uploader=$row["uploader"];
      $anon=$row["anonymous"];
      if($btit_settings["fmhack_speed_stats_in_peers_with_filename"]=="enabled")
      {
         ################################################################################################
         # Speed stats in peers with filename

         $peers["filename"] = $row["filename"];
         $peers["size"] = makesize($row["size"]);

         # End
         ################################################################################################
      }
   }
}
else
die("Error ID");

if ($XBTT_USE)
{
   $query1_select="LOWER(HEX(`x`.`peer_id`)) `peer_id`, `x`.`port`,";
   $query1_join="";
   if($btit_settings["fmhack_simple_donor_display"]=="enabled")
   $query1_select.="u.donor,";
   if($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")
   $query1_select.="`x`.`seeding_time` `seed`,";
   if($btit_settings["fmhack_group_colours_overall"]=="enabled" || $btit_settings["fmhack_VIP_freeleech"] == "enabled")
   {
      if($btit_settings["fmhack_group_colours_overall"]=="enabled")
      {
         $query1_select.="`ul`.`prefixcolor`, `ul`.`suffixcolor`,";
      }
      $query1_join.="LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` ";
   }
   if($btit_settings["fmhack_speed_stats_in_peers_with_filename"]=="enabled")
   $query1_select.="x.down_rate, x.up_rate,";
   if($btit_settings["fmhack_VIP_freeleech"] == "enabled")
   {
      $query1_select.="`u`.`vipfl_date`, `ul`.`freeleech`,";
   }
   if($btit_settings["fmhack_torrent_times"]=="enabled")
   {
      $query1_select.="`x`.`mtime`, `x`.`started_time`, `x`.`completed_time`,";
   }
   $res = get_result("SELECT ".$query1_select." x.uid,x.completed, x.ipa, x.downloaded, x.uploaded, x.left as bytes, IF(x.left=0,'seeder','leecher') as status, x.mtime as lastupdate, u.username, u.flag, c.flagpic, c.name FROM xbt_files_users x LEFT JOIN xbt_files ON x.fid=xbt_files.fid LEFT JOIN {$TABLE_PREFIX}files f ON f.bin_hash=xbt_files.info_hash LEFT JOIN {$TABLE_PREFIX}users u ON u.id=x.uid LEFT JOIN {$TABLE_PREFIX}countries c ON u.flag=c.id ".$query1_join." WHERE f.info_hash='$id' AND active=1 ORDER BY status DESC, lastupdate DESC",true,$btit_settings['cache_duration']);
}
else
$res = get_result("SELECT * FROM {$TABLE_PREFIX}peers p LEFT JOIN {$TABLE_PREFIX}countries c ON p.dns=c.domain WHERE infohash='$id' ORDER BY bytes ASC, status DESC, lastupdate DESC",true,$btit_settings['cache_duration']);

require(load_language("lang_peers.php"));

$peerstpl=new bTemplate();
$peerstpl->set("language",$language);
$peerstpl->set("peers_script","index.php");
$peerstpl->set("ban_clients_enabled", (($btit_settings["fmhack_ban_client"]=="enabled")?true:false), true);
$peerstpl->set("ttimes_enabled_1", (($btit_settings["fmhack_torrent_times"]=="enabled")?true:false), true);
$peerstpl->set("ttimes_enabled_2", (($btit_settings["fmhack_torrent_times"]=="enabled")?true:false), true);

if (count($res)==0)
$peerstpl->set("NOPEERS",TRUE,TRUE);
else
{
   $peerstpl->set("NOPEERS",FALSE,TRUE);

   $clientarr=array();
   foreach ($res as $row)
   {
      if($btit_settings["fmhack_VIP_freeleech"] == "enabled" && $XBTT_USE)
      {
         if($row["freeleech"]=="yes" && $row["lastupdate"]>=$row["vipfl_date"])
         $row["downloaded"]=0;
      }
      if($btit_settings["fmhack_ban_client"]=="enabled")
      {
         // Ban clients by Petr1fied
         if($XBTT_USE)
         $row["client"]=ucfirst($language["UNKNOWN"]);
         if($CURUSER["admin_access"]=="yes")
         {
            $gotclient=htmlspecialchars(getagent(unesc($row["client"]), unesc($row["peer_id"])));
            if(!array_key_exists($gotclient,$clientarr))
            {
               $clientarr[$gotclient]["user_agent"]=((substr($row["client"], 0, 7)=="Azureus") ? substr($row["client"], 0,  (((stripos($row["client"], ";")==true) ? stripos($row["client"], ";") : strlen($row["client"])))) : $row["client"]);
               $clientarr[$gotclient]["peer_id"]=substr($row["peer_id"], 0, 16);
               $clientarr[$gotclient]["peer_id_ascii"]=hex2bin(substr($row["peer_id"], 0, 16));
               $clientarr[$gotclient]["times_seen"]=1;
            }
            else
            $clientarr[$gotclient]["times_seen"]=$clientarr[$gotclient]["times_seen"]+1;
         }
         // Ban clients by Petr1fied
      }


      $query2_select="";
      $query2_join="";
      if($btit_settings["fmhack_simple_donor_display"]=="enabled")
      $query2_select.="u.donor,";
      if($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled" || $btit_settings["fmhack_torrent_times"]=="enabled")
      {
         if($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")
         {
            $query2_select.="`h`.`seed`,";
         }
         $query2_join.="LEFT JOIN `{$TABLE_PREFIX}history` `h` ON (`u`.`id`=`h`.`uid` AND `h`.`infohash`='".$id."')";
      }
      if($btit_settings["fmhack_group_colours_overall"]=="enabled")
      {
         $query2_select.="`ul`.`prefixcolor`, `ul`.`suffixcolor`,";
         $query2_join.=" LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` ";
      }
      if($btit_settings["fmhack_torrent_times"]=="enabled")
      {
         $query2_select.="`h`.`date` `mtime`, `h`.`started_time`, `h`.`completed_time`,";
      }
      // for user name instead of peer
      if ($XBTT_USE)
      $resu=TRUE;
      elseif ($PRIVATE_ANNOUNCE)
      $resu=get_result("SELECT ".$query2_select." u.username,u.id,c.flagpic,c.name FROM {$TABLE_PREFIX}users u LEFT JOIN {$TABLE_PREFIX}countries c ON c.id=u.flag ".$query2_join." WHERE u.pid='".$row["pid"]."' LIMIT 1",true,$btit_settings['cache_duration']);
      else
      $resu=get_result("SELECT ".$query2_select." u.username,u.id,c.flagpic,c.name FROM {$TABLE_PREFIX}users u LEFT JOIN {$TABLE_PREFIX}countries c ON c.id=u.flag ".$query2_join." WHERE u.cip='".$row["ip"]."' ".$query2_where." LIMIT 1",true,$btit_settings['cache_duration']);

      if($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled" && !$XBTT_USE)
      {
         if(count($resu)==0)
         {
            $query3_select="";
            if($btit_settings["fmhack_simple_donor_display"]=="enabled")
            $query3_select.="u.donor,";

            if ($PRIVATE_ANNOUNCE)
            $resu=get_result("SELECT ".$query3_select." u.username,u.id,c.flagpic,c.name, 0 `seed` FROM {$TABLE_PREFIX}users u LEFT JOIN {$TABLE_PREFIX}countries c ON c.id=u.flag  WHERE u.pid='".$row["pid"]."'",true,$btit_settings['cache_duration']);
            else
            $resu=get_result("SELECT ".$query3_select." u.username,u.id,c.flagpic,c.name, 0 `seed` FROM {$TABLE_PREFIX}users u LEFT JOIN {$TABLE_PREFIX}countries c ON c.id=u.flag WHERE u.cip='".$row["ip"]."'",true,$btit_settings['cache_duration']);
         }
      }

      if ($resu)
      {
         if($XBTT_USE)
         {
            $rowuser["username"]=$row["username"];
            $rowuser["id"]=$row["uid"];
            $rowuser["flagpic"]=$row["flagpic"];
            $rowuser["name"]=$row["name"];
            if($btit_settings["fmhack_simple_donor_display"]=="enabled")
            $rowuser["donor"]=$row["donor"];
            if($btit_settings["fmhack_group_colours_overall"]=="enabled")
            {
               $rowuser["prefixcolor"]=$row["prefixcolor"];
               $rowuser["suffixcolor"]=$row["suffixcolor"];
            }
            if($btit_settings["fmhack_torrent_times"]=="enabled")
            {
               $rowuser["started_time"]=$row["started_time"];
               $rowuser["completed_time"]=$row["completed_time"];
               $rowuser["mtime"]=$row["mtime"];
            }
         }
         else
         $rowuser=$resu[0];

         if ($rowuser && $rowuser["id"]>1)
         {
            if($btit_settings["fmhack_ban_client"]=="enabled")
            {
               if($CURUSER["admin_access"]=="yes")
               {
                  $peerstpl->set("ADMIN_ACCESS",TRUE,TRUE);
                  $peerstpl->set("uid",$CURUSER["uid"]);
                  $peerstpl->set("random",$CURUSER["random"]);
                  $clients=array();
                  $ii=0;
                  foreach($clientarr as $num => $val)
                  {
                     $clients[$ii]["client"]=$num;
                     $clients[$ii]["user_agent"]=$val["user_agent"];
                     $clients[$ii]["peer_id"]=$val["peer_id"];
                     $clients[$ii]["peer_id_ascii"]=$val["peer_id_ascii"];
                     $clients[$ii]["times_seen"]=$val["times_seen"];
                     $clients[$ii]["encode1"]=urlencode($val["user_agent"]);
                     $clients[$ii]["encode2"]=urlencode($val["peer_id"]);
                     $clients[$ii]["encode3"]=urlencode("index.php?page=peers&id=".$id);
                     $ii++;
                  }
                  $peerstpl->set("clients",$clients);

                  $sqlquery ="SELECT * ";
                  $sqlquery.="FROM {$TABLE_PREFIX}bannedclient ";
                  $sqlquery.="ORDER BY client_name ASC";

                  $res2=do_sqlquery($sqlquery,true);

                  if(@sql_num_rows($res2)>0)
                  {
                     $iii=0;
                     $banned=array();
                     while($row2=$res2->fetch_assoc())
                     {
                        $banned[$iii]["client_name"]=$row2["client_name"];
                        $banned[$iii]["user_agent"]=$row2["user_agent"];
                        $banned[$iii]["peer_id"]=$row2["peer_id"];
                        $banned[$iii]["peer_id_ascii"]=$row2["peer_id_ascii"];
                        $banned[$iii]["reason"]=stripslashes($row2["reason"]);
                        $banned[$iii]["id"]=$row2["id"];
                        $banned[$iii]["encode"]=urlencode("index.php?page=peers&id=".$id);
                        $iii++;
                     }
                     $peerstpl->set("banned_clients",TRUE,TRUE);
                     $peerstpl->set("banned",$banned);
                  }
                  else
                  {
                     $peerstpl->set("banned_clients",FALSE,TRUE);
                  }
               }
               else
               {
                  $peerstpl->set("ADMIN_ACCESS",FALSE,TRUE);
               }
            }
            if($anon=="true" && $uploader==$rowuser["id"] && $CURUSER["edit_torrents"]=="no")
            {
               $rowuser["username"]=$language["ANONYMOUS"];
               $rowuser["prefixcolor"]="";
               $rowuser["suffixcolor"]="";
               $rowuser["id"]=0;
               $rowuser["flagpic"]="unknown.gif";
               $rowuser["name"]=$language['UNKNOWN'];
            }
            elseif($anon=="true" && $uploader==$rowuser[id] && $CURUSER["edit_torrents"]=="yes")
            $rowuser["username"].=" (".$language["ANONYMOUS"].")";
            if ($GLOBALS["usepopup"])
            {
               $peers[$i]["USERNAME"]="<a href=\"javascript: windowunder('".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$rowuser["id"]."_".strtr($rowuser["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$rowuser["id"])."')\">".(($btit_settings["fmhack_group_colours_overall"]=="enabled")?unesc($rowuser["prefixcolor"].$rowuser["username"].$rowuser["suffixcolor"]):unesc($rowuser["username"])).(($btit_settings["fmhack_simple_donor_display"]=="enabled")?get_user_icons($rowuser):"")."</a>";
               $peers[$i]["PM"]="<a href=\"javascript: windowunder('index.php?page=usercp&amp;do=pm&amp;action=edit&amp;uid=".$CURUSER["uid"]."&amp;what=new&amp;to=".urlencode(unesc($rowuser["username"]))."')\"><button class='btn btn-xs btn-primary' type='button'>PM</button></a>";
            }
            else
            {
               $peers[$i]["USERNAME"]="<a href=\"".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$rowuser["id"]."_".strtr($rowuser["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$rowuser["id"])."\">".(($btit_settings["fmhack_group_colours_overall"]=="enabled")?unesc($rowuser["prefixcolor"].$rowuser["username"].$rowuser["suffixcolor"]):unesc($rowuser["username"])).(($btit_settings["fmhack_simple_donor_display"]=="enabled")?get_user_icons($rowuser):"")."</a>";
               $peers[$i]["PM"]="<a href=\"index.php?page=usercp&amp;do=pm&amp;action=edit&amp;uid=".$CURUSER["uid"]."&amp;what=new&amp;to=".urlencode(unesc($rowuser["username"]))."\"><button class='btn btn-xs btn-primary' type='button'>PM</button></a>";
            }
         }
         else
         {
            $peers[$i]["USERNAME"]=$language["GUEST"];
            $peers[$i]["PM"]="";
         }
      }
      else
      {
         $peers[$i]["USERNAME"]=$language["GUEST"];
         $peers[$i]["PM"]="";
      }
      if ($row["flagpic"]!="" && $row["flagpic"]!="unknown.gif")
      $peers[$i]["FLAG"]="<img src=\"images/flag/".$row["flagpic"]."\" alt=\"".unesc($row["name"])."\" />";
      elseif ($rowuser["flagpic"]!="" && !empty($rowuser["flagpic"]))
      $peers[$i]["FLAG"]="<img src=\"images/flag/".$rowuser["flagpic"]."\" alt=\"".unesc($rowuser["name"])."\" />";
      else
      $peers[$i]["FLAG"]="<img src=\"images/flag/unknown.gif\" alt=\"".$language["UNKNOWN"]."\" />";
    if ($GLOBALS["NAT"])
        $peers[$i]["PORT"]="<b><font color='".(($row["natuser"]=="Y")?"red":"green")."'>".$row["port"]."</font></b>";
    else
        $peers[$i]["PORT"]=$row["port"];
      
      $stat=floor((($tsize - $row["bytes"]) / $tsize) *100);
      //$progress="<table width=\"100\" cellspacing=\"0\" cellpadding=\"0\"><tr><td class=\"progress\" align=\"left\">";
      //$progress.="<img height=\"10\" width=\"".number_format($stat,0)."\" src=\"$STYLEURL/images/progress.jpg\" alt=\"\" /></td></tr></table>";
      //$peers[$i]["PROGRESS"]=$stat."%<br />" . $progress;
      $progress = "<div class='progress active' style='height: 2em; min-width: 15em;'>\n<div class='progress-bar progress-bar-info progress-bar-striped' role='progressbar' aria-valuenow='".$stat."' aria-valuemin='0' aria-valuemax='100' style='width: ".$stat."%'>\n".$stat."%\n</div>\n</div>";
      $peers[$i]["PROGRESS"]=$progress;

      $peers[$i]["STATUS"]=$row["status"];
      $peers[$i]["IPA"]=long2ip($row["ipa"]);
      $peers[$i]["CLIENT"]=htmlspecialchars(getagent(unesc((($XBTT_USE)?"":$row["client"])),unesc($row["peer_id"])));
      if($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")
      $peers[$i]["SEEDING_TIME"]=NewDateFormat((($XBTT_USE)?$row["seed"]:$rowuser["seed"]));
      if($btit_settings["fmhack_torrent_times"]=="enabled")
      {
         $peers[$i]["mtime"]=date("d/m/Y\<\b\\r \/\>H:i:s", $rowuser["mtime"]);
         $peers[$i]["completed_time"]=(($rowuser["completed_time"]==-1)?$language["NA"]:date("d/m/Y\<\b\\r \/\>H:i:s", $rowuser["completed_time"]));
         $peers[$i]["started_time"]=(($rowuser["started_time"]==-1)?$language["NA"]:date("d/m/Y\<\b\\r \/\>H:i:s", $rowuser["started_time"]));
      }
      $dled=makesize($row["downloaded"]);
      $upld=makesize($row["uploaded"]);
      $peers[$i]["DOWNLOADED"]=$dled;

      if($btit_settings["fmhack_speed_stats_in_peers_with_filename"]=="enabled")
      {
         ################################################################################################
         # Speed stats in peers with filename

         if ($row['status']=='seeder')
         $transferrateDL="<i>seeder</i>";
         else if ($row['download_difference'] > '0' && $row['announce_interval'] > '0' && !$XBTT_USE)
         $transferrateDL=round(round($row['download_difference']/$row['announce_interval'])/1000, 2)." KB/sec";
         elseif ($row['down_rate'] > '0' && $XBTT_USE)
         $transferrateDL=round($row['down_rate']/1000, 2)." KB/sec";
         else
         $transferrateDL="0 KB/sec";

         if ($transferrateDL >= 6.50)
         $color="green";
         else if ($transferrateDL >= 3.00)
         $color="orange";
         else if ($transferrateDL >= 0.01)
         $color="red";
         else if($row['status']=='seeder')
         $color="#00D900";
         else
         $color="";
         $peers[$i]["DLSPEED"]="<span style='color:".$color."'>$transferrateDL</span>";
      }

      $peers[$i]["UPLOADED"]=$upld;

      if($btit_settings["fmhack_speed_stats_in_peers_with_filename"]=="enabled")
      {
         if ($row['upload_difference'] > '0' && $row['announce_interval'] > '0' && !$XBTT_USE)
         $transferrateUP=round(round($row['upload_difference']/$row['announce_interval'])/1000, 2)." KB/sec";
         elseif ($row['up_rate'] > '0' && $XBTT_USE)
         $transferrateUP=round($row['up_rate']/1000, 2)." KB/sec";
         else
         $transferrateUP="0 KB/sec";

         if ($transferrateUP >= 6.50)
         $color="green";
         else if ($transferrateUP >= 3.00)
         $color="orange";
         else if ($transferrateUP >= 0.01)
         $color="red";
         else
         $color="";
         $peers[$i]["UPSPEED"]="<span style='color:".$color."'>$transferrateUP</span>";

         # End
         ################################################################################################
      }

      //Peer Ratio
      if (intval($row["downloaded"])>0)
      {
         $ratio=number_format($row["uploaded"]/$row["downloaded"],2);
      }
      else
      {
         $ratio='&#8734;';
      }
      $peers[$i]["RATIO"]=$ratio;
      //End Peer Ratio
      $peers[$i]["SEEN"]=get_elapsed_time($row["lastupdate"])." ago";
      $i++;
   }
}

if ($GLOBALS["usepopup"])
$peerstpl->set("BACK2","<br /><br /><center><a href=\"javascript:window.close()\"><tag:language.CLOSE /></a></center>");
else
$peerstpl->set("BACK2", "<br /><br /><center><a href=\"javascript: history.go(-1);\"><tag:language.BACK /></a></center>");

$peerstpl->set("hnr_enabled",(($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")?TRUE:FALSE),TRUE);
$peerstpl->set("hnr_enabled2",(($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")?TRUE:FALSE),TRUE);
$peerstpl->set("warn_edit_allowed_1",FALSE,TRUE);
$peerstpl->set("warn_edit_allowed_2",FALSE,TRUE);
$peerstpl->set("peers_flag_1",FALSE,TRUE);
$peerstpl->set("peers_flag_2",FALSE,TRUE);
$peerstpl->set("speedstats_enabled",(($btit_settings["fmhack_speed_stats_in_peers_with_filename"]=="enabled")?TRUE:FALSE),TRUE);
$peerstpl->set("speedstats_enabled2",false,true);//(($btit_settings["fmhack_speed_stats_in_peers_with_filename"]=="enabled")?TRUE:FALSE),TRUE);
$peerstpl->set("speedstats_enabled3",false,true);//(($btit_settings["fmhack_speed_stats_in_peers_with_filename"]=="enabled")?TRUE:FALSE),TRUE);
$peerstpl->set("speedstats_enabled4",false,true);//(($btit_settings["fmhack_speed_stats_in_peers_with_filename"]=="enabled")?TRUE:FALSE),TRUE);
$peerstpl->set("speedstats_enabled5",false,true);//(($btit_settings["fmhack_speed_stats_in_peers_with_filename"]=="enabled")?TRUE:FALSE),TRUE);
$peerstpl->set("peers",$peers);

?>
