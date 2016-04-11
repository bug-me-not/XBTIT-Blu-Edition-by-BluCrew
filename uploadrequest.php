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
      
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();

if(!$CURUSER || $CURUSER["view_torrents"]!="yes")

   {
       stderr("Error", "looks like you are not allowd to see this !");
       stdfoot();
       die;
}

$uploadrequesttpl=new bTemplate();
$uploadrequesttpl->set("language",$language);

$uploadrequesttpl->set("uploadrequest1","<form id=form1 name=form1 method=post action=index.php?page=uploadrequest2>");
$uploadrequesttpl->set("uploadrequest2","<table width=531 border=0 align=center cellpadding=0 cellspacing=0>");
$uploadrequesttpl->set("uploadrequest3","<tr>");
$uploadrequesttpl->set("uploadrequest4","<td width=530><div align=center><strong><span class=style1>A T T E N T I O N !</span><br />");
$uploadrequesttpl->set("uploadrequest5","<span class=style3>If you want to be a uploader on this site , fill in this form please</span></strong></div></td>");
$uploadrequesttpl->set("uploadrequest6","</tr>");
$uploadrequesttpl->set("uploadrequest7","</table>");
$uploadrequesttpl->set("uploadrequest8","<table width=511 border=1 align=center cellpadding=3 cellspacing=0>");
$uploadrequesttpl->set("uploadrequest9","<tr>");
$uploadrequesttpl->set("uploadrequest10","<td><span class=style8>Connection ?</span></td>");
$uploadrequesttpl->set("uploadrequest11","<td><strong>");
$uploadrequesttpl->set("uploadrequest12","- upload speed&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
$uploadrequesttpl->set("uploadrequest13","<select name=intern id=intern>");
$uploadrequesttpl->set("uploadrequest14","<option value=0 selected=selected>0 KB/s</option>");
$uploadrequesttpl->set("uploadrequest15","<option value=&lt;64KB/s>&lt; 64 KB/s</option>");
$uploadrequesttpl->set("uploadrequest16","<option value=64-128KB/s>64 - 128 KB/s</option>");
$uploadrequesttpl->set("uploadrequest17","<option value=128-256KB/s>128 - 256 KB/s</option>");
$uploadrequesttpl->set("uploadrequest18","<option value=256-512KB/s>256 - 512 KB/s</option>");
$uploadrequesttpl->set("uploadrequest19","<option value=512-1024KB/s>512 - 1024 KB/s</option>");
$uploadrequesttpl->set("uploadrequest20","<option value=1-2MB/s>1 - 2 MB/s</option>");
$uploadrequesttpl->set("uploadrequest21","<option value=2-5MB/s>2 - 5 MB/s</option>");
$uploadrequesttpl->set("uploadrequest22","<option value=5- 0MB/s>5 - 10 MB/s</option>");
$uploadrequesttpl->set("uploadrequest23","<option value=&gt;10MB/s>&gt; 10 MB/s</option>");
$uploadrequesttpl->set("uploadrequest24","</select>");
$uploadrequesttpl->set("uploadrequest25","<br />");
$uploadrequesttpl->set("uploadrequest26","- download speed&nbsp;");
$uploadrequesttpl->set("uploadrequest27","<select name=extern id=extern>");
$uploadrequesttpl->set("uploadrequest28","<option value=0 selected=selected>0 KB/s</option>");
$uploadrequesttpl->set("uploadrequest29","<option value=&lt;64KB/s>&lt;64 KB/s</option>");
$uploadrequesttpl->set("uploadrequest30","<option value=64-128KB/s>64 - 128 KB/s</option>");
$uploadrequesttpl->set("uploadrequest31","<option value=128-256KB/s>128 - 256 KB/s</option>");
$uploadrequesttpl->set("uploadrequest32","<option value=256-512KB/s>256 - 512 KB/s</option>");
$uploadrequesttpl->set("uploadrequest33","<option value=512-1024KB/s>512 - 1024 KB/s</option>");
$uploadrequesttpl->set("uploadrequest34","<option value=1-2MB/s>1 - 2 MB/s</option>");
$uploadrequesttpl->set("uploadrequest35","<option value=2-5MB/s>2 - 5 MB/s</option>");
$uploadrequesttpl->set("uploadrequest36","<option value=5-10MB/s>5 - 10 MB/s</option>");
$uploadrequesttpl->set("uploadrequest37","<option value=&gt;10MB/s>&gt; 10 MB/s</option>");
$uploadrequesttpl->set("uploadrequest38","</select>");
$uploadrequesttpl->set("uploadrequest39","</strong></td>");
$uploadrequesttpl->set("uploadrequest40","</tr>");
$uploadrequesttpl->set("uploadrequest41","<tr>");
$uploadrequesttpl->set("uploadrequest42","<td><span class=style8>What you intend to upload ?</span></td>");
$uploadrequesttpl->set("uploadrequest43","<td><strong>");
$uploadrequesttpl->set("uploadrequest44","<label>");
$uploadrequesttpl->set("uploadrequest45","<textarea name=intentioneaza cols=40 rows=4 id=intentioneaza></textarea>");
$uploadrequesttpl->set("uploadrequest46","</label>");
$uploadrequesttpl->set("uploadrequest47","</strong></td>");
$uploadrequesttpl->set("uploadrequest48","</tr>");
$uploadrequesttpl->set("uploadrequest49","<tr>");
$uploadrequesttpl->set("uploadrequest50","<td><span class=style8>Torrent Source ?</span></td>");
$uploadrequesttpl->set("uploadrequest51","<td><strong>");
$uploadrequesttpl->set("uploadrequest52","<textarea name=sursa cols=40 rows=4 id=sursa></textarea>");
$uploadrequesttpl->set("uploadrequest53","</strong></td>");
$uploadrequesttpl->set("uploadrequest54","</tr>");
$uploadrequesttpl->set("uploadrequest55","<tr>");
$uploadrequesttpl->set("uploadrequest56","<td><span class=style8>Do you upload on other site(s) & wich ?</span></td>");
$uploadrequesttpl->set("uploadrequest57","<td><strong>");
$uploadrequesttpl->set("uploadrequest58","<textarea name=altsite cols=40 rows=4 id=altsite></textarea>");
$uploadrequesttpl->set("uploadrequest59","</strong></td>");
$uploadrequesttpl->set("uploadrequest60","</tr>");
$uploadrequesttpl->set("uploadrequest61","<tr>");
$uploadrequesttpl->set("uploadrequest62","<td><span class=style8>Do you know how to make a torrent ?</span></td>");
$uploadrequesttpl->set("uploadrequest63","<td>");
$uploadrequesttpl->set("uploadrequest64","<strong>");
$uploadrequesttpl->set("uploadrequest65","<select name=facetorrent>");
$uploadrequesttpl->set("uploadrequest66","<option value=Yes selected=selected>Yes</option>");
$uploadrequesttpl->set("uploadrequest67","<option value=No >No</option>");
$uploadrequesttpl->set("uploadrequest68","</select>");
$uploadrequesttpl->set("uploadrequest69","</strong> </td>");
$uploadrequesttpl->set("uploadrequest70","</tr>");
$uploadrequesttpl->set("uploadrequest71","<tr>");
$uploadrequesttpl->set("uploadrequest72","<td><span class=style8>Do you know to make rar archives ?</span></td>");
$uploadrequesttpl->set("uploadrequest73","<td><strong>");
$uploadrequesttpl->set("uploadrequest74","<select name=facerar id=facerar>");
$uploadrequesttpl->set("uploadrequest75","<option value=Yes selected=selected>Yes</option>");
$uploadrequesttpl->set("uploadrequest76","<option value=No >No</option>");
$uploadrequesttpl->set("uploadrequest77","</select>");
$uploadrequesttpl->set("uploadrequest78","</strong></td>");
$uploadrequesttpl->set("uploadrequest79","</tr>");
$uploadrequesttpl->set("uploadrequest80","<tr>");
$uploadrequesttpl->set("uploadrequest81","<td><span class=style8>Do you know how to make SFV ?</span></td> ");
$uploadrequesttpl->set("uploadrequest82","<td><strong>");
$uploadrequesttpl->set("uploadrequest83","<select name=facesfv id=facesfv>");
$uploadrequesttpl->set("uploadrequest84","<option value=Yes selected=selected>Yes</option>");
$uploadrequesttpl->set("uploadrequest85","<option value=No>No</option>");
$uploadrequesttpl->set("uploadrequest86","</select>");
$uploadrequesttpl->set("uploadrequest87","</strong></td>");
$uploadrequesttpl->set("uploadrequest88","</tr>");
$uploadrequesttpl->set("uploadrequest89","<tr>");
$uploadrequesttpl->set("uploadrequest90","<td><span class=style8>Do you know how to make NFO ?</span></td>");
$uploadrequesttpl->set("uploadrequest91","<td><strong>");
$uploadrequesttpl->set("uploadrequest92","<select name=facenfo id=facenfo>");
$uploadrequesttpl->set("uploadrequest93","<option value=Yes selected=selected>Yes</option>");
$uploadrequesttpl->set("uploadrequest94","<option value=No>No</option>");
$uploadrequesttpl->set("uploadrequest95","</select>");
$uploadrequesttpl->set("uploadrequest96","</strong></td>");
$uploadrequesttpl->set("uploadrequest97","</tr>");

$uploadrequesttpl->set("uploadrequest189","<tr>");
$uploadrequesttpl->set("uploadrequest190","<td><span class=style8>Do you have access to Scene rips ?</span></td>");
$uploadrequesttpl->set("uploadrequest191","<td><strong>");
$uploadrequesttpl->set("uploadrequest192","<select name=scerip id=scerip>");
$uploadrequesttpl->set("uploadrequest193","<option value=Yes selected=selected>Yes</option>");
$uploadrequesttpl->set("uploadrequest194","<option value=No>No</option>");
$uploadrequesttpl->set("uploadrequest195","</select>");
$uploadrequesttpl->set("uploadrequest196","</strong></td>");
$uploadrequesttpl->set("uploadrequest197","</tr>");

$uploadrequesttpl->set("uploadrequest98","<tr>");
$uploadrequesttpl->set("uploadrequest99","<td><span class=style8>Why do you wanna upload on this site ?</span></td>");
$uploadrequesttpl->set("uploadrequest100","<td><strong>");
$uploadrequesttpl->set("uploadrequest101","<textarea name=motiv cols=40 rows=4 id=motiv></textarea>");
$uploadrequesttpl->set("uploadrequest102","</strong></td>");
$uploadrequesttpl->set("uploadrequest103","</tr>");
$uploadrequesttpl->set("uploadrequest104","<tr>");
$uploadrequesttpl->set("uploadrequest105","<td><span class=style8>Where have you heard about this site ?</span></td>");
$uploadrequesttpl->set("uploadrequest106","<td><strong>");
$uploadrequesttpl->set("uploadrequest107","<textarea name=stisite cols=40 rows=4 id=stisite></textarea>");
$uploadrequesttpl->set("uploadrequest108","</strong></td>");
$uploadrequesttpl->set("uploadrequest109","</tr>");
$uploadrequesttpl->set("uploadrequest110","<tr>");
$uploadrequesttpl->set("uploadrequest111","<td><span class=style8>Have you read the upload rules and do you agree them ?</span></td>");
$uploadrequesttpl->set("uploadrequest112","<td><strong>");
$uploadrequesttpl->set("uploadrequest113","<select name=regulament id=regulament>");
$uploadrequesttpl->set("uploadrequest114","<option value=Yes selected=selected>Yes</option>");
$uploadrequesttpl->set("uploadrequest115","<option value=No>No</option>");
$uploadrequesttpl->set("uploadrequest116","</select>");
$uploadrequesttpl->set("uploadrequest117","</strong></td>");
$uploadrequesttpl->set("uploadrequest118","</tr>");
$uploadrequesttpl->set("uploadrequest119","<tr>");
$uploadrequesttpl->set("uploadrequest120","<td><span class=style8>Can you upload at least 1 torrent per week ?</span></td>");
$uploadrequesttpl->set("uploadrequest121","<td><strong>");
$uploadrequesttpl->set("uploadrequest122","<select name=oday id=oday>");
$uploadrequesttpl->set("uploadrequest123","<option value=Yes selected=selected>Yes</option>");
$uploadrequesttpl->set("uploadrequest124","<option value=No>No</option>");
$uploadrequesttpl->set("uploadrequest125","</select>");
$uploadrequesttpl->set("uploadrequest126","</strong></td>");
$uploadrequesttpl->set("uploadrequest127","</tr>");

$uploadrequesttpl->set("uploadrequest219","<tr>");
$uploadrequesttpl->set("uploadrequest220","<td><span class=style8>I understand I have to seed my torrents till there are at least 2 other seeds !</span></td>");
$uploadrequesttpl->set("uploadrequest221","<td><strong>");
$uploadrequesttpl->set("uploadrequest222","<select name=seet id=seet>");
$uploadrequesttpl->set("uploadrequest223","<option value=Yes selected=selected>Yes</option>");
$uploadrequesttpl->set("uploadrequest224","<option value=No>No</option>");
$uploadrequesttpl->set("uploadrequest225","</select>");
$uploadrequesttpl->set("uploadrequest226","</strong></td>");
$uploadrequesttpl->set("uploadrequest227","</tr>");

$uploadrequesttpl->set("uploadrequest128","</table>");
$uploadrequesttpl->set("uploadrequest129","<p>");
$uploadrequesttpl->set("uploadrequest130","<label>");
$uploadrequesttpl->set("uploadrequest131","<div align=center>");
$uploadrequesttpl->set("uploadrequest132","<input name=Submit type=submit id=Submit value=Submit />");
$uploadrequesttpl->set("uploadrequest133","</div>");
$uploadrequesttpl->set("uploadrequest134","</label>");
$uploadrequesttpl->set("uploadrequest135","</p>");
$uploadrequesttpl->set("uploadrequest136","</form>");
?>
