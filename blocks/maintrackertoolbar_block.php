<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2016  Btiteam
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
global $CURUSER, $XBTT_USE,$TABLE_PREFIX,$btit_settings;
if (!$CURUSER || $CURUSER["view_torrents"]=="no")
   {
    // do nothing
   }
else
    {
   if ($XBTT_USE)
      $res=get_result("select count(*) as tot, sum(f.seeds)+sum(ifnull(x.seeders,0)) as seeds, sum(f.leechers)+sum(ifnull(x.leechers,0)) as leechs  FROM {$TABLE_PREFIX}files f LEFT JOIN xbt_files x ON f.bin_hash=x.info_hash",true,$btit_settings['cache_duration']);
   else
       $res=get_result("select count(*) as tot, sum(seeds) as seeds, sum(leechers) as leechs  FROM {$TABLE_PREFIX}files",true,$btit_settings['cache_duration']);
   if ($res)
      {
      $row=$res[0];
      $torrents=$row["tot"];
      $seeds=0+$row["seeds"];
      $leechers=0+$row["leechs"];
      }
   else {
      $seeds=0;
      $leechers=0;
      $torrents=0;
      }
   $res=get_result("select count(*) as tot FROM {$TABLE_PREFIX}users where id>1",true,$btit_settings['cache_duration']);
   if ($res)
      {
      $row=$res[0];
      $users=$row["tot"];
      }
   else
       $users=0;
   if ($leechers>0)
      $percent=number_format(($seeds/$leechers)*100,0);
   else
       $percent=number_format($seeds*100,0);
   $peers=$seeds+$leechers;
   if ($XBTT_USE)
      $res=get_result("select sum(u.downloaded+x.downloaded) as dled, sum(u.uploaded+x.uploaded) as upld FROM {$TABLE_PREFIX}users u LEFT JOIN xbt_users x ON x.uid=u.id",true,$btit_settings['cache_duration']);
   else
      $res=get_result("select sum(downloaded) as dled, sum(uploaded) as upld FROM {$TABLE_PREFIX}users",true,$btit_settings['cache_duration']);
   $row=$res[0];
   $dled=0+$row["dled"];
   $upld=0+$row["upld"];
   $traffic=makesize($dled+$upld);

//Advanced Addon Start//

   //users
$res=do_sqlquery("select 1,count(*) as tot FROM {$TABLE_PREFIX}users where id>1 union select 2,count(*) as tot from {$TABLE_PREFIX}users where DATE_FORMAT(lastconnect ,'%m/%d/%Y') = DATE_FORMAT(curdate(),'%m/%d/%Y') union select 3,count(*) as tot from {$TABLE_PREFIX}users where DATE_FORMAT(lastconnect ,'%m/%Y') = DATE_FORMAT(curdate(),'%m/%Y') union select 4,count(*) as tot from {$TABLE_PREFIX}users where DATE_FORMAT(joined ,'%m/%d/%Y') = DATE_FORMAT(curdate(),'%m/%d/%Y') union select 5,count(*) as tot from {$TABLE_PREFIX}users where DATE_FORMAT(joined ,'%m/%Y') = DATE_FORMAT(curdate(),'%m/%Y')");

$users=0;
$userstoday=0;
$usersthismonth=0;
$newuserstoday=0;
$newusersmonth=0;

while($row=$res->fetch_assoc())
{
  $test[]=$row;
  if($row['1']==1)
  {
     $users = $row['tot'];
  }
  if($row['1']==2)
  {
    $userstoday = $row['tot'];
 }
 if($row['1']==3)
 {
    $usersthismonth = $row['tot'];
 }
 if($row['1']==4)
 {
    $newuserstoday = $row['tot'];
 }
 if($row['1']==5)
 {
    $newusersmonth = $row['tot'];
 }
}
?>
<div class="col-md-6 col-lg-6">
<div class="panel panel-default">
<div class="panel-heading"><h4><i class="fa fa-fw fa-files-o"></i><?php echo $language["BLOCK_INFO"]; ?> </h4></div>
<div class="panel-body" align="center">
<b><?php echo $language["MEMBERS"]; ?>:</b>&nbsp;&nbsp;<?php echo $users; ?>&nbsp;&nbsp;&nbsp;
<b><?php echo $language["MEMBERSNEWTODAY"]; ?>:</b>&nbsp;&nbsp;<?php echo $newuserstoday; ?>&nbsp;&nbsp;&nbsp;
<b><?php echo $language["MEMBERSNEWMONTH"]; ?>:</b>&nbsp;&nbsp;<?php echo $newusersmonth; ?>&nbsp;&nbsp;&nbsp;
<b><?php echo $language["TORRENTS"]; ?>:</b>&nbsp;&nbsp;<?php echo $torrents; ?>&nbsp;&nbsp;&nbsp;<br />
<b><?php echo $language["SEEDERS"]; ?>:</b>&nbsp;&nbsp;<?php echo $seeds; ?>&nbsp;&nbsp;&nbsp;
<b><?php echo $language["LEECHERS"]; ?>:</b>&nbsp;&nbsp;<?php echo $leechers; ?>&nbsp;&nbsp;&nbsp;
<b><?php echo $language["PEERS"]; ?>:</b>&nbsp;&nbsp;<?php echo $peers; ?>
<b><?php echo $language["SEEDERS"]."/".$language["LEECHERS"]; ?>:&nbsp;&nbsp;<?php echo $percent."%"; ?>&nbsp;&nbsp;&nbsp;
<b><?php echo $language["TRAFFIC"]; ?>:</b>&nbsp;&nbsp;<?php echo $traffic; ?>
</br>
</div>
</div>
</div>

<?php
} // end if user can view
?>