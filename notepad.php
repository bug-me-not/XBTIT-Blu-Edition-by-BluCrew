<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
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
require_once ("include/functions.php");
require_once ("include/config.php");
global $CURUSER;

dbconn();

//Start User Redirect if Not Logged In
if ($CURUSER["view_users"]=="yes")
{
//Stop User Redirect if Not Logged In
$tora=array();
$i=0;
$notepadtpl=new bTemplate();
$notepadtpl->set("language",$language);
$resusrnm = do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users WHERE id=$CURUSER[uid]") or mysql_error();
$arrusrnm = $resusrnm->fetch_array();
$curusername = $arrusrnm['username'];
$res = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}notes WHERE userid=$CURUSER[uid] ORDER BY added DESC") or sqlerr();
$arrnotes = sql_num_rows($res);

    if (isset($_GET["action"])) $action=$_GET["action"];
      else $action = "";
    if (isset($_GET["id"]))
       $id=$_GET["id"];

//Start Read Personal Note Page
     if  ($action=="read" && $id=="$id")
         {
$resusrid = do_sqlquery("SELECT userid FROM {$TABLE_PREFIX}notes WHERE id=$id AND userid=$CURUSER[uid]") or sqlerr();
$arrresusrid = $resusrid->fetch_array();
$curuserid = $arrresusrid["userid"];
if ($CURUSER['uid']==$curuserid)
{
block_begin("".$curusername."'s Personal Notepad");
$notepadtpl->set("rp0","<table class='table table-bordered'>");

$notepadtpl->set("rp3","<tr><td class=\"head\" align=\"center\">".$language["NOTE_ID"]."</td><td class=\"head\" align=\"center\">".$language["NOTE_NOTE"]."</td><td class=\"head\" align=\"center\">".$language["NOTE_DATETIME"]."</td></tr>");
$resview = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}notes WHERE id=".$_GET['id']." AND userid='".$CURUSER['uid']."'") or sqlerr();
$arrview = $resview->fetch_assoc();
$noteview = $arrview['note'];
$addedview = $arrview['added'];
$numberview = $arrview['id'];
$notepadtpl->set("rp4","<tr><td class=\"lista\" align=\"center\" width=\"3%\"><center>$numberview</td><td class=\"lista\" align=\"center\" width=\"77%\"><center>".format_comment($noteview)."</td><td class=\"lista\" align=\"center\" width=\"20%\"><center>$addedview</td></tr>");

$notepadtpl->set("rp7","<tr><td colspan=\"3\" class=\"header\" align=\"center\" width=\"100%\"><a href=\"index.php?page=notepad&action=add\">".$language["NOTE_ADD_NEW"]."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=notepad\">".$language["NOTE_VIEW_MORE"]."</a></td></tr>");
$notepadtpl->set("rp8","</table>");

block_end();
}
else
{
block_begin("".$curusername."'s Personal Notepad");
$notepadtpl->set("rp11","<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" class=\"lista\" align=\"center\" width=\"100%\">");
$notepadtpl->set("rp13","<tr><td colspan=\"2\" class=\"lista\" align=\"center\"><center>".$language["NOTE_READ_ERROR"]."</td></tr>");
$notepadtpl->set("rp16","<tr><td class=\"header\" align=\"center\" width=\"50%\"><a href=\"index.php?page=notepad&action=add\">".$language["NOTE_ADD_NEW"]."</a></td><td class=\"header\" align=\"center\" width=\"50%\"><a href=\"index.php?page=notepad\">".$language["NOTE_VIEW_MORE"]."</a></td></tr>");
$notepadtpl->set("rp17","</table>");
block_end();
}
         }
//Stop Read Personal Note Page

//Start Edit Personal Note Page
     elseif  ($action=="edit" && $id=="$id")
         {
$resusrid = do_sqlquery("SELECT userid FROM {$TABLE_PREFIX}notes WHERE id=$id AND userid=$CURUSER[uid]") or sqlerr();
$arrresusrid = $resusrid->fetch_array();
$curuserid = $arrresusrid["userid"];
if ($CURUSER['uid']==$curuserid)
{
block_begin("".$curusername."'s Personal Notepad");
$notepadtpl->set("rp18","<form name=editnote method=post action=index.php?page=notepad&action=takeedit&id=".$_GET['id'].">\n");
$notepadtpl->set("rp19","<table class='table table-bordered'>");
$resedit = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}notes WHERE id=".$_GET[id]." AND userid=".$CURUSER['uid']."") or sqlerr();
$arredit = $resedit->fetch_array();
$editnote = $arredit['note'];
$addededit = $arredit['added'];
$numberedit = $id;


$notepadtpl->set("rp22","<tr><td class=\"header\" align=\"center\"><b>".$language["NOTE_NOTE"].":</b></td>");
$notepadtpl->set("rp23","<td align=left class=lista>".textbbcode("editnote","editnote",htmlspecialchars(unesc($editnote)))."</td></tr>");

$notepadtpl->set("rp25","<input type=\"hidden\" name=\"edit\" value=\"note\">\n");
$notepadtpl->set("rp26","<tr><td class=\"header\" align=\"center\"></td><td align=center class=lista><input type=submit class='btn btn-sm btn-primary' value=\"Submit\"></td></tr>");

$notepadtpl->set("rp30","<tr><td colspan=\"2\" class=\"header\" align=\"center\" width=\"100%\"><a href=\"index.php?page=notepad&action=add\">".$language["NOTE_ADD_NEW"]."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php?page=notepad\">".$language["NOTE_VIEW_MORE"]."</a></td></tr>");
$notepadtpl->set("rp31","</table></form>");
block_end();
}
else
{
block_begin("".$curusername."'s Personal Notepad");
$notepadtpl->set("rp32","<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" class=\"lista\" align=\"center\" width=\"100%\">");

$notepadtpl->set("rp35","<tr><td colspan=\"2\" class=\"lista\" align=\"center\"><center>".$language["NOTE_EDIT_ERROR"]."</td></tr>");


$notepadtpl->set("rp38","<tr><td class=\"header\" align=\"center\" width=\"50%\"><a href=\"index.php?page=notepad&action=add\">".$language["NOTE_ADD_NEW"]."</a></td><td class=\"header\" align=\"center\" width=\"50%\"><a href=\"index.php?page=notepad\">".$language["NOTE_VIEW_MORE"]."</a></td></tr>");
$notepadtpl->set("rp39","</table>");
block_end();
}
         }
//Stop Edit Personal Note Page

//Start Add New Personal Note Page
     elseif  ($action=="add")
         {
block_begin("".$curusername."'s Personal Notepad");
$notepadtpl->set("rp40","<form name=takenote method=post action=index.php?page=notepad&action=takenote>");
$notepadtpl->set("rp41","<table class='table table-bordered'>");

$notepadtpl->set("rp44","<tr><td class=\"header\" align=\"center\"><b>".$language["NOTE_NOTE"].":</b></td>");
$notepadtpl->set("rp45","<td align=left class=lista>".textbbcode("takenote","takenote")."</td></tr>");

$notepadtpl->set("rp47","<input type=\"hidden\" name=\"add\" value=\"note\">");
$notepadtpl->set("rp48","<tr><td class=\"header\" align=\"center\"></td><td align=center class=lista><input type=submit class='btn btn-sm btn-primary' value=\"Submit\"></td></tr>");


$notepadtpl->set("rp52","<tr><td colspan=\"2\" class=\"header\" align=\"center\" width=\"100%\"><a href=\"index.php?page=notepad\">".$language["NOTE_VIEW_MORE"]."</a></td></tr>");
$notepadtpl->set("rp53","</table></form>");
block_end();
         }
//Stop Add New Personal Note Page

//Start TakeAdd Personal Note Page
     elseif  ($action=="takenote")
         {
$note = $_POST["takenote"];
$note = sqlesc($note);
$added = gmdate("Y-m-d H:i:s");
quickQuery("INSERT INTO {$TABLE_PREFIX}notes (userid,note,added) VALUES ('$CURUSER[uid]',$note,'$added')") or sqlerr();
redirect("index.php?page=notepad");
         }
//Stop Take Personal Note Page

//Start TakeEdit Personal Note Page
     elseif  ($action=="takeedit" && $id=="$id")
         {
$id = $_GET["id"];
$note = $_POST["editnote"];
$note = sqlesc($note);
$added = gmdate("Y-m-d H:i:s");
quickQuery("UPDATE {$TABLE_PREFIX}notes SET note=".$note.", added='".$added."' WHERE id=".$id." AND userid=".$CURUSER[uid]." LIMIT 1") or sqlerr();
redirect("index.php?page=notepad");
         }
//Stop TakeEdit Personal Note Page

//Start TakeDelete Personal Note Page
     elseif  ($action=="takedelete")
         {
if (empty($_POST["delnote"]))
{
block_begin("".$curusername."'s Personal Notepad");
$notepadtpl->set("rp54","<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" class=\"lista\" align=\"center\" width=\"100%\">");
$notepadtpl->set("rp55","<tr><td class=\"lista\" align=\"center\" colspan=\"2\">".$language["NOTE_DEL_ERR"]."</td></tr>");
$notepadtpl->set("rp56","<tr><td class=\"header\" align=\"center\" width=\"50%\"><a href=\"index.php?page=notepad&action=add\">".$language["NOTE_ADD_NEW"]."</a></td><td class=\"header\" align=\"center\" width=\"50%\"><a href=\"index.php?page=notepad\">".$language["NOTE_VIEW_MORE"]."</a></td></tr>");
$notepadtpl->set("rp57","</table>");
block_end();
}
else
{
$id = implode(", ", $_POST[delnote]);
quickQuery("DELETE FROM {$TABLE_PREFIX}notes WHERE id IN (".implode(", ", $_POST[delnote]).") AND userid=".$CURUSER[uid]."") or sqlerr();
redirect("index.php?page=notepad");
}
         }
//Stop TakeDelete Personal Note Page

//Start Personal Note HomePage
else
         {
 if (sql_num_rows($res) == 0)
{
block_begin("".$curusername."'s Personal Notepad (".$arrnotes." notes)");
$notepadtpl->set("rp58","<table class='table table-bordered'>");
$notepadtpl->set("rp59","<tr><td class=\"lista\" align=\"center\"><center>You don't have any personal notes. Maybe you could add some...</td></tr>");
$notepadtpl->set("rp60","<tr><td colspan=\"6\" class=\"header\" align=\"center\"><a href=\"index.php?page=notepad&action=add\">Add new personal note</a></td></tr>");
$notepadtpl->set("rp61","</table>");
block_end();
}
else
{
$notepadtpl->set("rp62","<script type=\"text/javascript\">
            <!--
            function SetAllCheckBoxes(FormName, FieldName, CheckValue)
            {
            if(!document.forms[FormName])
            return;
            var objCheckBoxes = document.forms[FormName].elements[FieldName];
            if(!objCheckBoxes)
            return;
            var countCheckBoxes = objCheckBoxes.length;
            if(!countCheckBoxes)
            objCheckBoxes.checked = CheckValue;
            else
            // set the check value for all check boxes
            for(var i = 0; i < countCheckBoxes; i++)
            objCheckBoxes[i].checked = CheckValue;
            }
            -->
            </script>
            ");
block_begin("".$curusername."'s Personal Notepad (".$arrnotes." notes)");
$notepadtpl->set("rp63","<form method=post name=deleteall action=index.php?page=notepad&action=takedelete>");
$notepadtpl->set("rp64","<table class='table table-bordered'>");
$notepadtpl->set("rp65","<tr><td class=\"head\" align=\"center\">".$language["NOTE_ID"]."</td><td class=\"head\" align=\"center\">".$language["NOTE_NOTE"]."</td><td class=\"head\" align=\"center\">".$language["NOTE_DATETIME"]."</td><td class=\"head\" align=\"center\">".$language["NOTE_VIEW"]."</td><td class=\"head\" align=\"center\">".$language["NOTE_EDIT"]."</td><td class=\"head\" align=\"center\"><input type=\"checkbox\" name=\"all\" onclick=\"SetAllCheckBoxes('deleteall','delnote[]',this.checked)\" /></td></tr>");

  while ($arr = $res->fetch_assoc())
   {
      $note = $arr[note];
      $added = $arr[added];
      $number = $arr[id];
      //Name of Note Too big Hack Start
      if (strlen($note)>38)
      {
      $extension = "...";
      $note = substr($note, 0, 38)."$extension";
      }
      //Name of Note Too big Hack Stop
$tora[$i]["rp66"]=("<tr><td class=\"lista\" align=\"center\" width=\"3%\"><center>$number</td><td class=\"lista\" align=\"center\" width=\"38%\"><center>$note</td><td class=\"lista\" align=\"center\" width=\"23%\"><center>$added</td><td class=\"lista\" align=\"center\" width=\"12%\"><a href=index.php?page=notepad&action=read&id=".$number."><center>".$language["NOTE_VIEW"]."</a></td><td class=\"lista\" align=\"center\" width=\"12%\"><a href=index.php?page=notepad&action=edit&id=".$number."><center>".$language["NOTE_EDIT"]."</a></td><td class=\"lista\" align=\"center\" width=\"12%\"><center><input type=\"checkbox\" name=\"delnote[]\" value=\"".$number."\" /></td></tr>");
$i++;
   }
$tora[$i]["rp67"]=("<tr><td colspan=\"5\" class=\"header\" align=\"center\"><a href=\"index.php?page=notepad&action=add\">".$language["NOTE_ADD_NEW"]."</a></td><td colspan=\"1\" class=\"header\" align=\"center\"><input type=submit class='btn btn-sm btn-danger' value=".$language["DELETE"]."></td></tr>");


$notepadtpl->set("rp68","</form>");
$notepadtpl->set("rp69","</table>");

block_end();
}
         }
         $notepadtpl->set("tora",$tora);
//Stop Personal Note HomePage

//Start User Redirect if Not Logged In
}
else
{
redirect("login.php");
}
//Stop User Redirect if Not Logged In


?>
