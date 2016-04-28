<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
//
// Expected & To Offer Torrents by DiemThuy oct 2010 based on Jboy,s BTI version
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

global $CURUSER;

$viewexpectedtpl= new bTemplate();
$viewexpectedtpl-> set("language",$language);

if (!$CURUSER || $CURUSER["view_torrents"]=="no")
{
   // do nothing
}
else
{
   if (!$CURUSER || $CURUSER["view_torrents"]=="yes")
   {
      $viewexpectedtpl->set("vex2","<div class='panel panel-primary'>
         <div class='panel-heading'><h3 class='panel-title'>Options</h3></div>
         <div class='panel-body'><center><a href=index.php?page=expected>" . $language["ADD_EXPECTED"] . "</a> | <a href=index.php?page=viewexpected&expectorid=$CURUSER[uid]>" . $language["VIEW_MY_EXPECTED"] . "</a></center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
      $viewexpectedtpl->set("vex4","</div></div>");
   }

   $categ = sql_esc($_GET["category"]);
   $expectorid = sql_esc($_GET["expectorid"]);
   $search = sql_esc($_GET["search"]);
   $searchq = " AND expected.expect like '%$search%' ";
   $categq = "";
   if ($expectorid <> NULL) {
      if (($categ <> NULL) && ($categ <> 0)){
      $categq = "WHERE expected.cat = '".$categ."' AND expected.userid ='".$expectorid."'";
      }else{
      $categq = "WHERE expected.userid='".$expectorid."'";
   }}else if ($categ == 0){
   $categq = '';
   }else{
   $categq = "WHERE expected.cat = " . $categ;
   }
   $res = do_sqlquery("SELECT count(expected.id) FROM {$TABLE_PREFIX}expected expected INNER JOIN {$TABLE_PREFIX}categories categories on expected.cat = categories.id inner join {$TABLE_PREFIX}users users on expected.userid = users.id  $categq $searchq") or die(sql_error());
   $exp=array();
   $ii = 0;
   $row = $res->fetch_array();
   $count = $row[0];
   $sort= 'ORDER BY expected.added DESC';
   $dir = 'index.php?page=viewexpected';
   $perpage = 20;

   list($pagertop, $pagerbottom, $limit) = pager($perpage, $count, $dir ."&" . "category=" . $_GET["category"] . "&sort=" . $_GET["sort"] . "&" );

   $res = do_sqlquery("SELECT expected.hitsmin ,expected.hits ,expected.expect_offer,users.username, expected.id, expected.userid, expected.expect, expected.added, expected.date, expected.uploaded, expected.torrenturl,categories.image as catimg, categories.id as catid, categories.name as cat FROM {$TABLE_PREFIX}expected expected INNER JOIN {$TABLE_PREFIX}categories categories on expected.cat = categories.id inner join {$TABLE_PREFIX}users users on expected.userid = users.id  $categq $searchq $sort $limit") or sqlerr();
   $num = sql_num_rows($res);

   $viewexpectedtpl->set("vex6","<br><br><CENTER><form method=get action=index.php><input type=hidden name=page value=viewexpected/>");
   $viewexpectedtpl->set("vex7","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text size=30 name=search>");
   $viewexpectedtpl->set("vex8","<input type=submit align=center class='btn btn-primary btn-sm' value=".$language["SEARCH"].">\n");
   $viewexpectedtpl->set("vex10","</form></CENTER><br>");
   $viewexpectedtpl->set("pagtop","<center>$pagertop</center>");
   $viewexpectedtpl->set("vex12","<Table border=0 width=99% align=center cellspacing=0 cellpadding=0><TR><TD width=49.5% align=left>");
   $viewexpectedtpl->set("vex14","");
   $viewexpectedtpl->set("vex15","</td><td width=100% align=right>");
   $viewexpectedtpl->set("vex17","<form method=get action=index.php><input type=hidden name=page value=viewexpected />");
   $viewexpectedtpl->set("vex16","");
   $viewexpectedtpl->set("vex18",categories()); 
   $viewexpectedtpl->set("vex19","");
   $viewexpectedtpl->set("vex20","<input type=submit align=center class='btn btn-primary btn-sm' value=" . $language["FIND_EXPECT"] . ">\n");
   $viewexpectedtpl->set("vex22","</form></td></tr></table>");
   $viewexpectedtpl->set("vex24","<form method=post action=index.php?page=takedelexpect>");
   $viewexpectedtpl->set("vex26","<table class='table table-bordered'>");
   $viewexpectedtpl->set("vex28","<tr><td class=head align=center>" . $language["UPLOADED"] . "</td><td class=head align=center>" . $language["TYPE"] . "</td><td class=head align=center>" . $language["NAME"] . "</td><td class=head align=center>" . $language["CATEGORY"] . "</td><td class=head align=center>" . $language["ADDED"] . "</td><td class=head align=center>" . $language["UPLOADER"] . "</td><td class=head align=center>" . $language["EXPECVOTE"] . "</td>\n");

   if (!$CURUSER || $CURUSER["delete_torrents"]=="yes")
   $viewexpectedtpl->set("vex30","<td class=head align=center>" . $language["FRM_DELETE"] . "</td></tr>\n");

   for ($i = 0; $i < $num; ++$i)
   {
      $arr = $res->fetch_assoc();
      $privacylevel = $arr["privacy"];

      $addedby = "<td class=lista align=center><a href=index.php?page=userdetails&id=".$arr['userid']."><b>".$arr['username']."</b></a></td>";

      global $btit_settings;
      $totall= ($arr["hits"]-$arr["hitsmin"]);
      if($btit_settings["offer"] >= $totall AND $arr["expect_offer"]=="yes")
      $all_uploaded='<font color = orange>Need more votes</font>';
      else
      {
         if($arr["uploaded"]=="yes")
         $all_uploaded = "<a href=" . $arr["torrenturl"] . "><font color=\"green\">" . $language["YES"] . "</font></a>";
         else
         $all_uploaded = "<font color=\"red\">" . $language["NO"] . "</font";
      }

      if($arr["expect_offer"]=="no" AND $arr["uploaded"]=="yes")
      $all_uploaded = "<a href=" . $arr["torrenturl"] . "><font color=\"green\">" . $language["YES"] . "</font></a>";
      else if($arr["expect_offer"]=="no" AND $arr["uploaded"]=="no")
      $all_uploaded = "<font color=\"red\">" . $language["NO"] . "</font";


      if($arr["expect_offer"]=="yes")
      {
         $ex_of = "<font color=\"purple\">" . $language["OFFER"] . "</font></a>";
         $type="<a href=index.php?page=votesexpectedview&expectid=".$arr['id']."><font size =3 color = green>[<img src=images/thumbs-up.gif alt=Plus />&nbsp;".$arr["hits"]."]&nbsp;<a href=index.php?page=votesexpectedviewmin&expectid=".$arr['id']."><font color = red>[<img src=images/thumbs-down.gif alt=Minus />&nbsp;".$arr["hitsmin"]."]&nbsp;</a><font color = steelblue>[<img src=images/plus-min.gif alt=Plus />".$totall."]</font>";
         //	$type="<a href=index.php?page=votesexpectedview&expectid=$arr[id]><b>".$arr["hits"]."</b>";
      }
      else
      {
         $ex_of = "<font color=\"darkblue\">" . $language["EXPECTED"] . "</font";
         $type=$arr["date"];
      }


      $exp[$ii]["vex33"]=("<tr><td class=lista align=center><center><b>$all_uploaded</b></center></td><td class=lista align=center><center><b>$ex_of</b></center></td><td class=lista align=center><a href=index.php?page=expectdetails&id=".$arr['id']."><b>".$arr['expect']."</b></a></td>" .
      "<td class=lista align=center><center>".image_or_link(($arr['catimg']==''?'':''.$STYLEPATH.'/images/categories/'.$arr['catimg']),' title='.$arr['cat'].'',$arr['cat'])."</center></td><td class=lista align=center><center>".$arr["added"] . "</center></td>$addedby<td class=lista align=center><center>".$type."</center></td>\n");

      if (!$CURUSER || $CURUSER["delete_torrents"]=="yes")
      $exp[$ii]["vex34"]=("<td class=lista align=center><center><input type=\"checkbox\" name=\"delexpect[]\" value=\"" . $arr['id'] . "\" /></center></td></tr>\n");
      $ii++;
   }
   $viewexpectedtpl->set("exp",$exp);
   $viewexpectedtpl->set("vex36","</table>\n");

   if (!$CURUSER || $CURUSER["delete_torrents"]=="yes")
   $viewexpectedtpl->set("vex38","<table width=99%><td align=right><input type=submit class='btn btn-danger' value= Delete></td></table>");
   $viewexpectedtpl->set("vex40","</form>");
}
?>
