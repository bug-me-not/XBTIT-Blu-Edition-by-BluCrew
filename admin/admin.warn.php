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


function warn_read()
   {
   global $admintpl,$language,$STYLEURL,$CURUSER,$STYLEPATH;

     $admintpl->set("warn_add",false,true);
     $admintpl->set("language",$language);
     $cres=genrelistreasons();
     for ($i=0;$i<count($cres);$i++)
       {
         $cres[$i]["title"]=unesc($cres[$i]["title"]);
         $cres[$i]["text"]=unesc($cres[$i]["text"]);
         $cres[$i]["edit"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=warn&amp;action=edit&amp;id=".$cres[$i]["id"]."\">".image_or_link("$STYLEPATH/images/edit.png","",$language["EDIT"])."</a>";
         $cres[$i]["delete"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=warn&amp;action=delete&amp;id=".$cres[$i]["id"]."\" onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\">".image_or_link("$STYLEPATH/images/delete.png","",$language["DELETE"])."</a>";
     }
     $admintpl->set("warn",$cres);
     $admintpl->set("warn_add_new","<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=warn&amp;action=add\"><button class=\"btn btn-md btn-primary\">".$language["WARN_ADD_REASON"]."</button></a>");
     unset($cres);
}

switch ($action)
  {
   case 'save':
      if ($_POST["confirm"]==$language["FRM_CONFIRM"])
        {
        if ($_POST["warn_title"]!="" && $_POST["warn_text"]!="")
          {
            if ($_GET["mode"]=='new')
         quickQuery("INSERT INTO {$TABLE_PREFIX}warn_reasons (text, title) 
         			  VALUES (".sqlesc($_POST["warn_text"]).",".sqlesc($_POST["warn_title"]).")");
            else
         quickQuery("UPDATE {$TABLE_PREFIX}warn_reasons 
         		SET title=".sqlesc($_POST["warn_title"]).",
         			text=".sqlesc($_POST["warn_text"])." WHERE id= ".(int)$_GET['id']);
          }
        else
            stderr($language["ERROR"],$language["ALL_FIELDS_REQUIRED"]);
      }
      warn_read();
      break;

    case 'add':
        $admintpl->set("warn_add",true,true);
        $admintpl->set("language",$language);
        $admintpl->set("warn_title","");
        $admintpl->set("warn_text","");
        $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=warn&amp;action=save&amp;mode=new");
        break;

    case 'edit':
        if (isset($_GET["id"]))
          {
            // we should get only 1 style, selected with radio ...
            $id=max(0,$_GET["id"]);
            $cres=get_result("SELECT * FROM {$TABLE_PREFIX}warn_reasons WHERE id=$id",true);
            $admintpl->set("warn_add",true,true);
            $admintpl->set("language",$language);
            $admintpl->set("warn_title",$cres[0]["title"]);
            $admintpl->set("warn_text",$cres[0]["text"]);
            $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=warn&amp;action=save&amp;mode=edit&amp;id=$id");
          }
        break;

    case 'delete':
        if (isset($_GET["id"]))
          {
           // we should get only 1 style, selected with radio ...
           $id=max(0,$_GET["id"]);
           // delete style from database
           quickQuery("DELETE FROM {$TABLE_PREFIX}warn_reasons WHERE id=$id",true);
           category_read();
          }
        break;

    case '':
    case 'read':
    default:
      warn_read();
}

?>