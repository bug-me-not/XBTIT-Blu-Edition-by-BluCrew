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


function faq_read()
   {
   global $admintpl,$language,$STYLEURL,$CURUSER,$STYLEPATH;

     $admintpl->set("faq_add",false,true);
     $admintpl->set("language",$language);

     $cres=genrelistfaq('','faq_group');
     for ($i=0;$i<count($cres);$i++)
       {

       		$cres[$i]["name"]=unesc($cres[$i]["title"]);
       
         $cres[$i]["edit"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=faq_group&amp;action=edit&amp;id=".$cres[$i]["id"]."\">".image_or_link("$STYLEPATH/images/edit.png","",$language["EDIT"])."</a>";
         $cres[$i]["delete"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=faq_group&amp;action=delete&amp;id=".$cres[$i]["id"]."\" onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\">".image_or_link("$STYLEPATH/images/delete.png","",$language["DELETE"])."</a>";


     }
     $admintpl->set("faq",$cres);
     $admintpl->set("faq_add_new","<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=faq_group&amp;action=add\">".$language["FAQ_ADD"]."</a>");

     unset($cres);
          
}


switch ($action)
  {
   case 'save':
      if ($_POST["confirm"]==$language["FRM_CONFIRM"])
        {
        if ($_POST["faq_name"]!="" && $_POST["sort_index"]!="")
          {
            if ($_GET["mode"]=='new')
              quickQuery("INSERT INTO {$TABLE_PREFIX}faq_group (title, sort_index, description, date) VALUES (".sqlesc($_POST["faq_name"]).",".max(0,$_POST["sort_index"]).",".sqlesc($_POST["faq_description"]).",'NOW()')",true);
            else
              quickQuery("UPDATE {$TABLE_PREFIX}faq_group SET title=".sqlesc($_POST["faq_name"]).",sort_index=".max(0,$_POST["sort_index"]).", description=".sqlesc($_POST["faq_description"]).", date='NOW()' WHERE id=".max(0,$_GET["id"]),true);
          }
        else
            stderr($language["ERROR"],$language["ALL_FIELDS_REQUIRED"]);
      }
      faq_read();
      break;

    case 'add':
        $admintpl->set("faq_add",true,true);
        $admintpl->set("language",$language);
        $admintpl->set("faq_name","");
        $admintpl->set("faq_description",'');
        $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=faq_group&amp;action=save&amp;mode=new");
        $admintpl->set("faq_sort","");
        break;

    case 'edit':
        if (isset($_GET["id"]))
          {
            $id=max(0,$_GET["id"]);
            $cres=get_result("SELECT * FROM {$TABLE_PREFIX}faq_group WHERE id=$id",true);
            $admintpl->set("faq_add",true,true);
            $admintpl->set("language",$language);
            $admintpl->set("faq_name",$cres[0]["title"]);
            $admintpl->set("faq_description",$cres[0]["description"]);
            $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=faq_group&amp;action=save&amp;mode=edit&amp;id=$id");
           
            $admintpl->set("faq_sort",$cres[0]["sort_index"]);
          }
        break;

    case 'delete':
        if (isset($_GET["id"]))
          {
           // we should get only 1 style, selected with radio ...
           $id=max(0,$_GET["id"]);
           // delete style from database
           quickQuery("UPDATE {$TABLE_PREFIX}faq_group SET active = '-1' WHERE id=$id",true);
           quickQuery("UPDATE {$TABLE_PREFIX}faq SET active = '-1' WHERE cat_id=$id",true);
           faq_read();
          }
        break;

            
    case '':
    case 'read':
    default:
      faq_read();
}

?>