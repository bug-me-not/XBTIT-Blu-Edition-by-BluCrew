<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2009  Btiteam
//
//    This file is part of xbtit.
//
// Uploader request hack by DiemThuy - April 2009
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

if ($CURUSER["view_torrents"]=="no")
   {
       stderr("Error", "looks like you are not allowd to see this !");
       stdfoot();
       die;
}
else
    {

$intern=$_POST['intern'];
$extern=$_POST['extern'];
$intentioneaza=$_POST['intentioneaza'];
$sursa=$_POST['sursa'];
$altsite=$_POST['altsite'];
$facetorrent=$_POST['facetorrent'];
$facerar=$_POST['facerar'];
$facesfv=$_POST['facesfv'];
$facenfo=$_POST['facenfo'];
$scerip=$_POST['scerip'];
$motiv=$_POST['motiv'];
$stisite=$_POST['stisite'];
$regulament=$_POST['regulament'];
$oday=$_POST['oday'];
$seet=$_POST['seet'];

if(isset($intern) && isset($extern) && isset($intentioneaza) && isset($sursa) && isset($altsite) && isset($facetorrent) && isset($facerar) && isset($facesfv) && isset($facenfo) && isset($scerip) && isset($motiv) && isset($stisite) && isset($regulament) && isset($seet)) {

$user=$CURUSER["username"];
$up=$CURUSER["uploaded"];
$down=$CURUSER["downloaded"];
$msg="[color=red]Name:[/color] $user\n
[color=red]Connection[/color] Upload speed=$intern / Download speed=$extern\n
[color=red]Want to upload:[/color] $intentioneaza\n
[color=red]Source:[/color] $sursa\n
[color=red]Is uploader on other site:[/color] $altsite\n
[color=red]Know how to make torrents:[/color] $facetorrent\n
[color=red]Know how to make SFV:[/color] $facesfv\n
[color=red]Know how to make NFO:[/color] $facenfo\n
[color=red]Scene torrents acces:[/color] $scerip\n
[color=red]Motivation for upload:[/color] $motiv\n
[color=red]Heard about this site:[/color] $stisite\n
[color=red]Know the rules:[/color] $regulament\n
[color=red]Upload 1 torrent per week:[/color] $oday\n
[color=red]Will seed till 2 seeds:[/color] $seet\n";

$xx=$CURUSER["uid"];
$ms=sqlesc($msg);

  if ($btit_settings["up_all"]==false)
{
  $rcv=$btit_settings["up_id"];
  send_pm($xx,$rcv,sqlesc("New Uploader Request - $user"),$ms);
}

  if ($btit_settings["up_all"]==true)
{
  $r=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}users WHERE id_level >=6 AND id_level<=8");
  while($x=$r->fetch_array())
  send_pm($xx,$x["id"],sqlesc("New Uploader Request - $user"),$ms);
}
       stderr("Application Sended", "The staff will review your application, after that, you will get a response, thank you ");
       stdfoot();
       die;
}
else
{
       stderr("Alert ! ", "You must fill all the fields");
       stdfoot();
       die;
}
}
?>
