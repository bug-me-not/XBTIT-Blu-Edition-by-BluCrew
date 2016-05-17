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

$expectedtpl= new bTemplate();
$expectedtpl-> set("language",$language);

$expectedtpl->set("ex2","<br>\n");

$where = "WHERE userid = " . $CURUSER["uid"] . "";
$res2 = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}expected $where") or sqlerr();
$num2 = sql_num_rows($res2);


$expectedtpl->set("ex4","<div class='panel panel-primary'>");
$expectedtpl->set("ex6","<div class='panel-heading'><h3 class='panel-title'><center>" . $language["SEARCH"]  ." ". $language["TORRENT"] . "</center></h3></div>");
$expectedtpl->set("ex8","<div class='panel-body'><form method=get action=index.php><input type=hidden name=page value=torrents />");
$expectedtpl->set("ex10","<input type=text name=search size=40 value=$searchstr >");
$expectedtpl->set("ex12","in");
$expectedtpl->set("ex14","");
$expectedtpl->set("ex16","");

$deadchkbox = "<input type=\"checkbox\" name=\"active\" value=\"0\"";
if ($_GET["active"])
   $deadchkbox .= " checked=\"checked\"";
$deadchkbox .= " /> " . $language["INC_DEAD"] . "\n";

$expectedtpl->set("ex18",categories());
$expectedtpl->set("ex20","");
$expectedtpl->set("ex22","$deadchkbox");
$expectedtpl->set("ex24","<input type=submit class='btn btn-primary btn-sm' value=". $language["SEARCH"] ."  />");
$expectedtpl->set("ex26","</form>");
$expectedtpl->set("ex28","</table></div></div><BR><HR><BR>");

$expectedtpl->set("ex30","<br>\n");

$expectedtpl->set("ex32","<div class='panel panel-primary'><div class='panel-heading'><h4 class='text-center'>" . $language["ADD_EXPECTED"] . "</h4></div><table class='table table-bordered'><form name=expect method=post action=index.php?page=takeexpect><a name=add id=add></a>");
$expectedtpl->set("ex36","<tr><td class=header align=left>". $language["NAME"] ."</td><td class=lista align=left><input type=text class='form-control' size=40 name=expecttitle></td></tr>");
$expectedtpl->set("ex38","<tr><td class=header align=left>" . $language["DATE_EXPECTED"] . "</td><td class=lista align=left><input type=text class='form-control' size=15 name=date>&nbsp;" . $language["TEXT_DTD"] . "</td></tr>");
$expectedtpl->set("ex40","<tr><td class=header align=left>".$language["CATEGORY"]."</td><td class=lista align=left>");

$expectedtpl->set("ex42","");
$expectedtpl->set("ex44","");
$expectedtpl->set("ex46",categories());
$expectedtpl->set("ex48","");

$expectedtpl->set("ex50","<br>\n");
$expectedtpl->set("ex52","<tr><td class=header align=left>".$language["DESCRIPTION"]."</td><td class=lista align=left>");
$expectedtpl->set("ex54",textbbcode("expect","description"));
$expectedtpl->set("ex56","</td></tr>");
$expectedtpl->set("ex58","<tr><td class=lista align=center width=100% colspan=\"2\"><center><input type=submit class='btn btn-md btn-primary' value='" . $language["FRM_CONFIRM"] . "'></center></td></tr>");
$expectedtpl->set("ex60","</form>\n");
$expectedtpl->set("ex62","</table></CENTER>\n");

?>
