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

if (!defined("IN_ACP"))
      die("non direct access!");


$action=(isset($_GET["action"])?$_GET["action"]:"");
$days=(isset($_POST["days"])?max(0,$_POST["days"]):"30");

switch ($action)
  {
    case "prune":

       if (!isset($_POST["hash"]))
           {
            redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=prunet");
            exit();
       }

       $count=0;
       foreach($_POST["hash"] as $selected=>$hash)
              {
               @quickQuery("DELETE FROM {$TABLE_PREFIX}files WHERE info_hash=\"$hash\"");
               @quickQuery("DELETE FROM {$TABLE_PREFIX}timestamps WHERE info_hash=\"$hash\"");
               @quickQuery("DELETE FROM {$TABLE_PREFIX}comments WHERE info_hash=\"$hash\"");
               @quickQuery("DELETE FROM {$TABLE_PREFIX}ratings WHERE infohash=\"$hash\"");
               @quickQuery("DELETE FROM {$TABLE_PREFIX}peers WHERE infohash=\"$hash\"");
               @quickQuery("DELETE FROM {$TABLE_PREFIX}history WHERE infohash=\"$hash\"");

               if ($XBTT_USE)
                  @quickQuery("UPDATE xbt_files SET flags=1 WHERE info_hash=UNHEX(\"$hash\")");

               @unlink($TORRENTSDIR."/$hash.btf");
               $count++;
               }
       $block_title=$language["PRUNE_TORRENTS_PRUNED"];
       $admintpl->set("prune_done_msg","<div align=\"center\">n.$count torrents pruned!</div>");
       break;

    case "view":

      if ($XBTT_USE)
         {
          $tseeds="f.seeds+ifnull(x.seeders,0)";
          $tleechs="f.leechers+ifnull(x.leechers,0)";
          $tcompletes="f.finished+ifnull(x.completed,0)";
          $ttables="{$TABLE_PREFIX}files f LEFT JOIN xbt_files x ON x.info_hash=f.bin_hash";
          $tspeed="mtime";
         }
      else
          {
          $tseeds="f.seeds";
          $tleechs="f.leechers";
          $tcompletes="f.finished";
          $ttables="{$TABLE_PREFIX}files f";
          $tspeed="lastspeedcycle";
          }

      // 30 DAYS
      if ($days==0)
          {
          // days not set!!
          redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=prunet");
          exit;
          }
      $timeout=(60*60*24)*$days;

      $res=get_result("SELECT f.info_hash, filename, $tspeed AS lastupdate, $tseeds as seeds, ".
            "$tleechs as leechers FROM $ttables WHERE external='no' AND $tspeed<(UNIX_TIMESTAMP()-$timeout) ORDER BY $tseeds",true);


      $block_title=$language["PRUNE_TORRENTS"];

       $count=0;
       $tor=array();
       include("$THIS_BASEPATH/include/offset.php");
       foreach ($res as $ID=>$rtorrent)
          {
             $tor[$count]["filename"]=unesc($rtorrent["filename"]);
             $tor[$count]["lastupdate"]=date("d/m/Y H:i",$rtorrent["lastupdate"]-$offset)." (".get_elapsed_time($rtorrent["lastupdate"]-$offset)." ago)";
             $tor[$count]["seeds"]=$rtorrent["seeds"];
             $tor[$count]["leechers"]=$rtorrent["leechers"];
             $tor[$count]["info_hash"]=$rtorrent["info_hash"];
             $count++;
         }


      // external
       $res=get_result("SELECT info_hash, filename, UNIX_TIMESTAMP(lastupdate) AS lastupdate, seeds, ".
            " leechers FROM {$TABLE_PREFIX}files WHERE external='yes' AND UNIX_TIMESTAMP(lastupdate)<(UNIX_TIMESTAMP()-$timeout) ORDER BY lastupdate",true);


       foreach ($res as $ID=>$rtorrent)
         {
             $tor[$count]["filename"]=unesc($rtorrent["filename"]);
             $tor[$count]["lastupdate"]=date("d/m/Y H:i",$rtorrent["lastupdate"]-$offset)." (".get_elapsed_time($rtorrent["lastupdate"]-$offset)." ago)";
             $tor[$count]["seeds"]=$rtorrent["seeds"];
             $tor[$count]["leechers"]=$rtorrent["leechers"];
             $tor[$count]["info_hash"]=$rtorrent["info_hash"];
             $count++;
         }

      $admintpl->set("language",$language);
      $admintpl->set("prune_list",true,true);
      $admintpl->set("pruned_done",false,true);
      $admintpl->set("no_records",($count==0),true);
      $admintpl->set("torrents",$tor);


      $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=prunet&amp;action=prune");


      unset($res);
      unset($tor);

      break;

    default:

      $block_title=$language["PRUNE_TORRENTS"];
      $admintpl->set("language",$language);
      $admintpl->set("prune_list",false,true);
      $admintpl->set("pruned_done",false,true);
      $admintpl->set("prune_days",$days);
      $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=prunet&amp;action=view");
}

?>