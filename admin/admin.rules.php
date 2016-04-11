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


      
$admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=rules&amp;action=serch");
function getGroup($id)
{
    global $STYLEPATH, $language, $STYLEURL;
      $cres=genrelistrules('','rules_group');
      $group_name='';
      for ($i=0;$i<count($cres);$i++)
       {
        if($cres[$i]["id"]==$id)
        {
            $group_name=$cres[$i]["title"];
            break;
        }

     }
     return $group_name;
}
function cat_combo_search($current_cat=-1)
   {
      global $STYLEPATH, $language, $STYLEURL;
      $cres=genrelistrules('','rules_group');
     
      $ret="<select name='rules_id'>";
      $ret.="\n<option value='' ".$selected.">".$language["RULE_ALL"]."</option>";
      for ($i=0;$i<count($cres);$i++)
       {
        $selected='';
        if($cres[$i]["id"]==$current_cat)
        {
            $selected='selected';
        }
        $ret.="\n<option value='".$cres[$i]["id"]."' ".$selected.">".$cres[$i]["title"]."</option>";
         
            
        
     }
      $ret.="\n</select>";

      return $ret;
}
function cat_combo($current_cat=-1)
   {
      global $STYLEPATH, $language, $STYLEURL;
      $cres=genrelistrules('','rules_group');
     
      $ret="<select name='rules_id'>";
        
      for ($i=0;$i<count($cres);$i++)
       {
        $selected='';
        if($cres[$i]["id"]==$current_cat)
        {
            $selected='selected';
        }
        $ret.="\n<option value='".$cres[$i]["id"]."' ".$selected.">".$cres[$i]["title"]."</option>";
         
            
        
     }
      $ret.="\n</select>";

      return $ret;
}
function rules_read($search='')
   {
   global $admintpl,$language,$STYLEURL,$CURUSER,$STYLEPATH;

     $admintpl->set("rules_add",false,true);
     $admintpl->set("language",$language);
     $admintpl->set("groups",cat_combo_search($_POST['rules_id']));
     $append='';
     if(strlen($search)>0 && strlen($_POST['rules_id'])>0)
     {
        $append = " AND cat_id = ".sqlesc($_POST['rules_id'])."";
        $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=rules&amp;action=serch");
       
     }
     $cres=genrelistrules($append);
     for ($i=0;$i<count($cres);$i++)
       {
         $cres[$i]["name"]=format_comment(unesc($cres[$i]["text"]));
         $cres[$i]["sort_index"]=unesc($cres[$i]["sort_index"]);
         $cres[$i]["id"]=unesc($cres[$i]["id"]);
         $cres[$i]["group_name"]=unesc(getGroup($cres[$i]["cat_id"]));
            
         $cres[$i]["edit"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=rules&amp;action=edit&amp;id=".$cres[$i]["id"]."\">".image_or_link("$STYLEPATH/images/edit.png","",$language["EDIT"])."</a>";
         $cres[$i]["delete"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=rules&amp;action=delete&amp;id=".$cres[$i]["id"]."\" onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\">".image_or_link("$STYLEPATH/images/delete.png","",$language["DELETE"])."</a>";


     }
     $admintpl->set("categories",$cres);
     $admintpl->set("rules_add_new","<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=rules&amp;action=add\">".$language["RULES_ADD"]."</a>");

     unset($cres);
          
}
        

switch ($action)
  {
   case 'save':
      if ($_POST["confirm"]==$language["FRM_CONFIRM"])
        {
        if ($_POST["rules_name"]!="" && $_POST["rules_sort"]!=""  )
          {
            if ($_GET["mode"]=='new')
              quickQuery("INSERT INTO {$TABLE_PREFIX}rules (sort_index, text, cat_id) VALUES (".sqlesc($_POST["rules_sort"]).",".sqlesc($_POST["rules_name"]).",".sqlesc($_POST["rules_id"]).")",true);
            else
              quickQuery("UPDATE {$TABLE_PREFIX}rules SET text=".sqlesc($_POST["rules_name"]).",  sort_index=".sqlesc($_POST["rules_sort"]).", cat_id=".sqlesc($_POST["rules_id"])." WHERE id=".max(0,$_GET["id"]),true);
          }
        else
            stderr($language["ERROR"],$language["ALL_FIELDS_REQUIRED"]);
      }
      rules_read();
      break;
    case 'add':
        $admintpl->set("rules_add",true,true);
        $admintpl->set("language",$language);
        $admintpl->set("rules_name",textbbcode("rules_add_new","rules_name"));
        $admintpl->set("rules_description","");
        $admintpl->set("rules_group",cat_combo());
        $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=rules&amp;action=save&amp;mode=new");
        $admintpl->set("rules_sort","");
        break;

    case 'edit':
        if (isset($_GET["id"]))
          {
            // we should get only 1 style, selected with radio ...
            $id=max(0,$_GET["id"]);
            $cres=get_result("SELECT * FROM {$TABLE_PREFIX}rules WHERE id=$id",true);
            $admintpl->set("rules_add",true,true);
            $admintpl->set("language",$language);
            $admintpl->set("rules_name",textbbcode("rules_add_new","rules_name",$cres[0]["text"]));
            $admintpl->set("rules_sort",$cres[0]["sort_index"]);
            $admintpl->set("rules_group",cat_combo($cres[0]["cat_id"]));
            $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=rules&amp;action=save&amp;mode=edit&amp;id=$id");
           
            $admintpl->set("rules_sort",$cres[0]["sort_index"]);
          }
        break;

    case 'delete':
        if (isset($_GET["id"]))
          {
           // we should get only 1 style, selected with radio ...
           $id=max(0,$_GET["id"]);
           // delete style from database
           quickQuery("UPDATE {$TABLE_PREFIX}rules SET active = '-1' WHERE id=$id",true);
           rules_read();
          }
        break;
    case 'serch':
        rules_read('serch');
    break;
            
    case '':
    case 'read':
    default:
        $search='';
        
      rules_read();
      
}

?>