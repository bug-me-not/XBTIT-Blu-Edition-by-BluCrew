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


switch ($action)
{
    case 'add':
      $lres=language_list();
      foreach ($lres as $l)
        $newl[]=$l["language_url"];
      $dir = @opendir("$THIS_BASEPATH/language");
      $lc="\n<select name=\"new_lang_url\" size=\"1\">";
      $lc.="\n<option value=\"\">".$language["SELECT"]."</option>";
      while($file = @readdir($dir))
      {
        if(is_dir("$THIS_BASEPATH/language/$file") && $file!="." && $file!=".." && substr($file, 0, 8) != 'install_')
          {
            if (!in_array("language/$file",$newl))
             $lc.="\n<option value=\"$file\">$file</option>";
          }
      }
      @closedir($dir);
      unset($newl);
      unset($lres);
      $lc.="\n</select>";

      $admintpl->set("language_add",true,true);
      $admintpl->set("language",$language);
      $admintpl->set("lang_combo",$lc);
      $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=language&amp;action=save");
      break;

    case 'save':
      if ($_POST["confirm"]==$language["FRM_CONFIRM"])
        if ($_POST["new_language"]!="" &&$_POST["new_lang_url"]!="")
            quickQuery("INSERT INTO {$TABLE_PREFIX}language (language, language_url) VALUES (".sqlesc($_POST["new_language"]).", ".sqlesc("language/".$_POST["new_lang_url"]).")",true);
        else
            stderr($language["ERROR"],$language["ALL_FIELDS_REQUIRED"]);
      // we don't break, so we read the new inserted row ;)

    case '':
    case 'read':
    default:
      $lres=language_list();
      for ($i=0;$i<count($lres);$i++)
        {
        $res = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}users WHERE language = " . $lres[$i]["id"],true);
        $lres[$i]["language_users"]=$res->fetch_row()[0];
        $lres[$i]["language"]=unesc($lres[$i]["language"]);
        $lres[$i]["language_url"]=unesc($lres[$i]["language_url"]);
        }
      $admintpl->set("language_add",false,true);
      $admintpl->set("language",$language);
      $admintpl->set("languages",$lres);
      $admintpl->set("lang_add_new","<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=language&amp;action=add\">".$language["LANGUAGE_ADD"]."</a>");

      unset($lres);
      $res->free();
}

?>
