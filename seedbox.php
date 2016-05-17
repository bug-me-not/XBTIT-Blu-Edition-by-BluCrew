<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
//
//  Seed Box page by DiemThuy - Dec 2009
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

if (!$CURUSER || $CURUSER["view_torrents"]=="no")
{
   // do nothing
}
else
{
   include("include/offset.php");

   global $CURUSER, $BASEURL, $STYLEPATH, $XBTT_USE;
   //   $limit=10;
   if ($XBTT_USE)
      $sql = "SELECT count(*) FROM {$TABLE_PREFIX}files as f LEFT JOIN xbt_files x ON f.bin_hash=x.info_hash LEFT JOIN {$TABLE_PREFIX}categories as c ON c.id = f.category LEFT JOIN blurg_users as u ON u.id=f.uploader LEFT JOIN blurg_users_level as ul ON ul.id=u.id_level WHERE f.leechers + ifnull(x.leechers,0) > 0 AND f.seeds+ifnull(x.seeders,0) = 0 AND f.external='no'";
   else
      $sql = "SELECT count(*) FROM blurg_files as f LEFT JOIN blurg_categories as c ON c.id = f.category LEFT JOIN blurg_users as u ON u.id=f.uploader LEFT JOIN blurg_users_level as ul ON ul.id=u.id_level WHERE  f.seedbox='1'";

   $count = (do_sqlquery($sql,true)->fetch_array())[0];

   $seedboxtpl=new bTemplate();
   $seedboxtpl->set("language",$language);

   if($count > 0)
   {
      list($pagertop, $pagerbottom, $limit) = pager(25, $count,"index.php?page=seedbox&amp;");

      if ($XBTT_USE)
         $sql = "SELECT f.seedbox,f.info_hash as hash, f.seeds+ifnull(x.seeders,0) as seeds , f.leechers + ifnull(x.leechers,0) as leechers, dlbytes AS dwned, format(f.finished+ifnull(x.completed,0),0) as finished, filename, url, info, UNIX_TIMESTAMP(data) AS added, c.image, c.name AS cname, category AS catid, size, external, uploader, u.username, ul.prefixcolor, ul.suffixcolor, f.anonymous FROM {$TABLE_PREFIX}files as f LEFT JOIN xbt_files x ON f.bin_hash=x.info_hash LEFT JOIN {$TABLE_PREFIX}categories as c ON c.id = f.category LEFT JOIN blurg_users as u ON u.id=f.uploader LEFT JOIN blurg_users_level as ul ON ul.id=u.id_level WHERE f.leechers + ifnull(x.leechers,0) > 0 AND f.seeds+ifnull(x.seeders,0) = 0 AND f.external='no' ORDER BY f.leechers + ifnull(x.leechers,0) DESC {$limit}";
      else
         $sql = "SELECT f.anonymous, f.seedbox,f.info_hash as hash, f.seeds, f.leechers, f.dlbytes AS dwned, f.finished, f.filename, f.url, f.info, UNIX_TIMESTAMP(f.data) AS added, c.image, c.name AS cname, f.category AS catid, f.size, f.external, f.uploader, u.username, ul.prefixcolor, ul.suffixcolor FROM blurg_files as f LEFT JOIN blurg_categories as c ON c.id = f.category LEFT JOIN blurg_users as u ON u.id=f.uploader LEFT JOIN blurg_users_level as ul ON ul.id=u.id_level WHERE  f.seedbox='1' AND f.external='no' ORDER BY added DESC {$limit}";

      $row = do_sqlquery($sql,true);

      if(sql_num_rows($row)>0)
      {
         $seedboxtpl->set("has_torrents",true,true);
         $seedboxtpl->set("pagertop",$pagertop);
         $seedboxtpl->set("wait_time",(max(0,$CURUSER["WT"]) > 0),true);
         $seedboxtpl->set("wait_time1",(max(0,$CURUSER["WT"]) > 0),true);
         $seedboxtpl->set("dcheck",($btit_settings["fmhack_download_ratio_checker"] == "enabled"),true);
         $seedboxtpl->set("popup",$GLOBALS["usepopup"],true);
         $seedboxtpl->set("popup1",$GLOBALS["usepopup"],true);
         $seedboxtpl->set("spath",$STYLEURL);
         $seedbox=array();
         $i=0;

         while($data = $row->fetch_assoc())
         {
            $seedbox[$i]['hash'] = $data['hash'];
            $seedbox[$i]['dfile'] = rawurlencode($data['filename']);
            $seedbox[$i]['filename'] = $data['filename'];
            $seedbox[$i]['catid'] = $data['catid'];
            $seedbox[$i]['catname'] = $data['cname'];
            $seedbox[$i]['catimage'] = $data['image'];

            if(max(0,$CURUSER["WT"]) > 0)
            {
               if(max(0,$CURUSER['downloaded']) > 0)
                  $ratio = number_format($CURUSER['uploaded']/$CURUSER['downloaded'],2);
               else
                  $ratio = 0.0;

               $timer = floor((time() - $data['added']) / 3600);

               if($ratio < 1.0 && $CURUSER['uid']!=$data['uploaded'])
                  $wait = $CURUSER['WT'];

               $wait -= $timer;

               if($wait <= 0)
                  $wait = 0;

               $seedbox[$i]['wait'] = $wait;
            }

            $seedbox[$i]['datetime'] = date("d/m/Y",$data['added'] - $offset);

            $seedbox[$i]['uploaderid'] = $data['uploader'];
            $seedbox[$i]['uploader'] = $data['prefixcolor'].$data['username'].$data['suffixcolor'];

            $seedbox[$i]['size'] = makesize($data['size']);

            $seedbox[$i]['seeds'] = $data['seeds'];
            $seedbox[$i]['lseeds'] = linkcolor($data['seeds']);
            $seedbox[$i]['leechers'] = $data['leechers'];
            $seedbox[$i]['lleechers'] = linkcolor($data['leechers']);
            $seedbox[$i]['finished'] = $data['finished'];
            $seedbox[$i]['lfinished'] = linkcolor($data['finished']);

            $i++;
         }
         $seedboxtpl->set("seedbox",$seedbox);
         $seedboxtpl->set("pagerbottom",$pagerbottom);
      }
      else
      {
         $seedboxtpl->set("has_torrents",false,true);
      }
   }
   else
   {
      $seedboxtpl->set("has_torrents",false,true);
   }
} // end if user can view
?>
