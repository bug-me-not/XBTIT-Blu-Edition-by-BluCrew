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


function read_styles()
    {
        global $TABLE_PREFIX, $language, $CURUSER, $admintpl, $STYLEPATH;

        $sres=style_list();
        for ($i=0;$i<count($sres);$i++)
           {
            $res = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}users WHERE style = " . $sres[$i]["id"],true);
            $sres[$i]["style_users"]=$res->fetch_row()[0];
            $sres[$i]["style"]=unesc($sres[$i]["style"]);
            $sres[$i]["style_url"]=unesc($sres[$i]["style_url"]);
            $sres[$i]["style_type"]=(($sres[$i]["style_type"]==1)?$language["CLA_STYLE"]:(($sres[$i]["style_type"]==2)?$language["ATM_STYLE"]:(($sres[$i]["style_type"]==3)?$language["PET_STYLE"]:$language["UNKNOWN"])));
            $sres[$i]["edit"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=style&amp;action=edit&amp;id=".$sres[$i]["id"]."\">".image_or_link("$STYLEPATH/images/edit.png","",$language["EDIT"])."</a>";
            $sres[$i]["delete"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=style&amp;action=delete&amp;id=".$sres[$i]["id"]."\" onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\">".image_or_link("$STYLEPATH/images/delete.png","",$language["DELETE"])."</a>";
        }
        $admintpl->set("style_add",false,true);
        $admintpl->set("language",$language);
        $admintpl->set("styles",$sres);
        $admintpl->set("style_add_new","<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=style&amp;action=add\">".$language["STYLE_ADD"]."</a>");
        unset($sres);
        $res->free();

}


function styles_combo($all=false,$selected="")
  {
      global $THIS_BASEPATH, $language;
      if (!$all)
        {
            $sr=style_list();
            foreach ($sr as $s)
              $news[]=$s["style_url"];
       }
      $dir = @opendir("$THIS_BASEPATH/style");
      $lc="\n<select name=\"style_url\" size=\"1\">";
      if ($selected=="")
            $lc.="\n<option value=\"\">".$language["SELECT"]."</option>";

      while($file = @readdir($dir))
      {
        if(is_dir("$THIS_BASEPATH/style/$file") && $file!="." && $file!=".." && file_exists("$THIS_BASEPATH/style/$file/index.php"))
          {
            if ((!$all && !in_array("style/$file",$news)) || $all)
              $lc.="\n<option value=\"$file\" ".($selected=="style/$file"?"selected=\"selected\"":"").">$file</option>";
          }
      }
      @closedir($dir);
      $lc.="</select>";
      return $lc;

}

switch($action)
  {

    case 'save':
      if ($_POST["confirm"]==$language["FRM_CONFIRM"])
        {
        if ($_POST["style_name"]!="" && $_POST["style_url"]!="" && $_POST["style_type"]!="")
          {
            if ($_GET["mode"]=='new')
              quickQuery("INSERT INTO {$TABLE_PREFIX}style (style, style_url, style_type) VALUES (".sqlesc($_POST["style_name"]).",".sqlesc("style/".$_POST["style_url"]).", ".sqlesc(((is_numeric($_POST["style_type"]) && $_POST["style_type"]>=1 && $_POST["style_type"]<=3))?(int)0+$_POST["style_type"]:1).")",true);
            else
              quickQuery("UPDATE {$TABLE_PREFIX}style SET style=".sqlesc($_POST["style_name"]).",style_url=".sqlesc("style/".$_POST["style_url"]).", style_type=".sqlesc(((is_numeric($_POST["style_type"]) && $_POST["style_type"]>=1 && $_POST["style_type"]<=3))?(int)0+$_POST["style_type"]:1)." WHERE id=".max(0,$_GET["id"]),true);
          }
        else
            stderr($language["ERROR"],$language["ALL_FIELDS_REQUIRED"]);
      }
      read_styles();
      break;

    case 'add':
      $admintpl->set("style_add",true,true);
      $admintpl->set("language",$language);
      $admintpl->set("style_name","");
      $admintpl->set("style_type","<select name='style_type'>
            <option value='1' selected='yes'>".$language["CLA_STYLE"]."</option>
            <option value='2'>".$language["ATM_STYLE"]."</option>
            <option value='3'>".$language["PET_STYLE"]."</option>
           </select>");
      $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=style&amp;action=save&amp;mode=new");
      $admintpl->set("style_combo",styles_combo());
      break;

    case 'edit':
      if (isset($_GET["id"]))
        {
          // we should get only 1 style, selected with radio ...
          $id=max(0,$_GET["id"]);
          $sres=get_result("SELECT style, style_url, style_type FROM {$TABLE_PREFIX}style WHERE id=$id",true);
          $admintpl->set("style_add",true,true);
          $admintpl->set("language",$language);
          $admintpl->set("style_name",$sres[0]["style"]);
          $admintpl->set("style_type","<select name='style_type'>
            <option value='1'".(($sres[0]["style_type"]==1)?" selected='yes'":"").">".$language["CLA_STYLE"]."</option>
            <option value='2'".(($sres[0]["style_type"]==2)?" selected='yes'":"").">".$language["ATM_STYLE"]."</option>
            <option value='3'".(($sres[0]["style_type"]==3)?" selected='yes'":"").">".$language["PET_STYLE"]."</option>
           </select>");
          $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=style&amp;action=save&amp;mode=edit&amp;id=$id");
          $admintpl->set("style_combo",styles_combo(true,$sres[0]["style_url"]));
        }
      break;

    case 'delete':
      if (isset($_GET["id"]))
        {
         // we should get only 1 style, selected with radio ...
         $id=max(0,$_GET["id"]);
         // update the deleted user's style to default one
         quickQuery("UPDATE {$TABLE_PREFIX}users SET style='".$btit_settings["default_style"]."' WHERE style=$id",true);
         // delete style from database
         quickQuery("DELETE FROM {$TABLE_PREFIX}style WHERE id=$id",true);
         read_styles();
        }
      break;

    case '':
    case'read':
    default:
        read_styles();

}

?>
