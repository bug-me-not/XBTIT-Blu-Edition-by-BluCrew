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

$id2 = (int)$_GET["id"];
$res = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}expected WHERE id=$id2");
$row = $res->fetch_array();

$expectedittpl= new bTemplate();
$expectedittpl-> set("language",$language);

if ($CURUSER["uid"] == $row["userid"] || $CURUSER["can_upload"]== "yes")
{

   if (!$row)
   die();

   $where = "WHERE userid = ".$CURUSER["id"]."";
   $res2 = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}expected $where") or sqlerr();
   $num2 = sql_num_rows($res2);

   $expectedittpl->set("exe2","<form name=\"edit\" method=post action=index.php?page=takeexpectedit><a name=edit id=edit></a>");
   $expectedittpl->set("exe4","<div class='panel panel-primary'><div class='panel-heading'><h4 class='text-center'>Edit</h4></div><table class='table table-bordered'>\n");
   $expectedittpl->set("exe6","<tr><td align=left class=header>". $language["NAME"] ."</td> <td class=lista align=left><input type=text class='form-control' size=60 name=expecttitle value=\"" . htmlspecialchars($row["expect"]) . "\"></td></tr>");
   $expectedittpl->set("exe8","<tr><td class=header align=left width=30%>" . $language["DATE_EXPECTED"] . "</td><td class=lista align=left width=70%><input type=text size=15 class='form-control' name=date value=\"" . htmlspecialchars($row["date"]) . "\">&nbsp;" . $language["TEXT_DTD"] . "</td></tr>");
   $expectedittpl->set("exe10","<tr><td class=header align=left>" . $language["CATEGORY"] . "</td><td align=left class=lista>\n");

   $s = categories($row['cat']);

   $expectedittpl->set("exe11","$s</td></tr>\n");

   if ($row["expect_offer"] =='yes')
   {
      $expectedittpl->set("dtyes","checked");
      $expectedittpl->set("dtno","");
   }
   else if  ($row["expect_offer"] =='no')
   {
      $expectedittpl->set("dtno","checked");
      $expectedittpl->set("dtyes","");
   }

   global $btit_settings;
   $totall= ($row["hits"]-$row["hitsmin"]);
   if($btit_settings["offer"] >= $totall AND $row["expect_offer"]=="yes")
   {
      $expectedittpl->set("SHOW_UP",false,TRUE);
   }
   else
   {
      $expectedittpl->set("SHOW_UP",TRUE,TRUE);
   }

   $expectedittpl->set("exe12","<tr><td align=left class=header>".$language["DESCRIPTION"]."</td><td align=left class=lista>");
   $expectedittpl->set("exe14",textbbcode("edit","description",unesc($row["descr"])));
   $expectedittpl->set("exe16","</td></tr>");
   $expectedittpl->set("exe17", ($row["uploaded"]=="yes"?"checked=\"checked\"":""));
   $expectedittpl->set("exe171","<tr><td align=left class=header>".$language["TORR_LINK"]."</td><td align=left class=lista><input type=text name=torrenturl class='form-control' value=\"".$row["torrenturl"]. "\" size=70 /></td></tr>");



   $expectedittpl->set("exe18","<input type=\"hidden\" name=\"id\" value=\"$id2\">\n");
   $expectedittpl->set("exe20","<tr><td colspan=2 align=center class=lista><center><input type=submit class='btn btn-primary' value=\"Submit\"></center>\n");
   $expectedittpl->set("exe22","</form>\n");
   $expectedittpl->set("exe24","</table></div>\n");
}

else

{
   stderr($language["ERROR"],$language["ERR_NOT_AUTH"]);
   stdfoot();
   die();
}

?>
