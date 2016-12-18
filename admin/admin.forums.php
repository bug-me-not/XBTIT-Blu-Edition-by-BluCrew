<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2012  Btiteam
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
    case "read":
        $resf=get_result("SELECT f.*,uread.level as readlevel,uwrite.level as writelevel, ucreate.level as createlevel FROM {$TABLE_PREFIX}forums f INNER JOIN {$TABLE_PREFIX}users_level  as uread on uread.id_level=minclassread INNER JOIN {$TABLE_PREFIX}users_level as uwrite on uwrite.id_level=minclasswrite INNER JOIN {$TABLE_PREFIX}users_level as ucreate on ucreate.id_level=minclasscreate WHERE id_parent=0 AND uread.can_be_deleted='no' AND uwrite.can_be_deleted='no' AND ucreate.can_be_deleted='no' ORDER BY f.sort,f.id",true);
        $forums=array();
        $i=0;
        foreach($resf as $id=>$result)
            {
              $forums[$i]["td_padding"]="";
              $forums[$i]["name"]="<b>".unesc($result["name"])."</b><br />".unesc($result["description"]);
              $forums[$i]["topiccount"]=$result["topiccount"];
              $forums[$i]["postcount"]=$result["postcount"];
              $forums[$i]["readlevel"]=$result["readlevel"];
              $forums[$i]["writelevel"]=$result["writelevel"];
              $forums[$i]["createlevel"]=$result["createlevel"];
              $forums[$i]["sortorder"]=$result["sort"];
              $forums[$i]["category"]=$result["category"];
              $forums[$i]["edit"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=forum&amp;action=edit&amp;id=".$result["id"]."\">".image_or_link("$STYLEPATH/images/edit.png","",$language["EDIT"])."</a>";
              $forums[$i]["delete"]="<a onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\" href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=forum&amp;action=delete&amp;id=".$result["id"]."\">".image_or_link("$STYLEPATH/images/delete.png","",$language["DELETE"])."</a>";
              $res_subf=get_result("SELECT f.*,uread.level as readlevel,uwrite.level as writelevel, ucreate.level as createlevel FROM {$TABLE_PREFIX}forums f INNER JOIN {$TABLE_PREFIX}users_level  as uread on uread.id_level=minclassread INNER JOIN {$TABLE_PREFIX}users_level as uwrite on uwrite.id_level=minclasswrite INNER JOIN {$TABLE_PREFIX}users_level as ucreate on ucreate.id_level=minclasscreate WHERE f.id_parent=".$result["id"]." AND uread.can_be_deleted='no' AND uwrite.can_be_deleted='no' AND ucreate.can_be_deleted='no' ORDER BY f.sort,f.id",true);
              $i++;
              foreach($res_subf as $ids=>$sub_f)
                  {
                    $forums[$i]["td_padding"]="style=\"padding-left:35px;\"";
                    $forums[$i]["name"]="<b>".unesc($sub_f["name"])."</b><br />".unesc($sub_f["description"]);
                    $forums[$i]["topiccount"]=$sub_f["topiccount"];
                    $forums[$i]["postcount"]=$sub_f["postcount"];
                    $forums[$i]["readlevel"]=$sub_f["readlevel"];
                    $forums[$i]["writelevel"]=$sub_f["writelevel"];
                    $forums[$i]["createlevel"]=$sub_f["createlevel"];
                    $forums[$i]["sortordersub"]=$sub_f["sort"];
                    $forums[$i]["edit"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=forum&amp;action=edit&amp;id=".$sub_f["id"]."\">".image_or_link("$STYLEPATH/images/edit.png","",$language["EDIT"])."</a>";
                    $forums[$i]["delete"]="<a onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\" href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=forum&amp;action=delete&amp;id=".$sub_f["id"]."\">".image_or_link("$STYLEPATH/images/delete.png","",$language["DELETE"])."</a>";
                    $i++;
               }
              unset($res_subf);
              unset($sub_f);
        }
        unset($resf);
        unset($result);
        $block_title=$language["FORUM_SETTINGS"];
        $admintpl->set("language",$language);
        $admintpl->set("read",true,true);
        $admintpl->set("forums",$forums);
        $admintpl->set("add_link","<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=forum&amp;action=edit&amp;what=new\">".$language["FORUM_ADD_NEW"]."</a>");
        unset($forums);

    break;

case "edit":

        if (isset($_GET["what"])) $what=$_GET["what"];
              else $what="";

        $block_title=$language["FORUM_ADD_NEW"];

        if ($what!="new")
           {
            $block_title=$language["FORUM_EDIT"];
            $id=intval($_GET["id"]);
            $resforums=do_sqlquery("SELECT *,IF((SELECT COUNT(*) FROM {$TABLE_PREFIX}forums WHERE id_parent=$id)>0,1,0) as i_am_parent FROM {$TABLE_PREFIX}forums WHERE id=".$id);
           }
        if (isset($resforums) && $resforums)
           $result=$resforums->fetch_assoc();
        elseif ($what!="new")
          {
            err_msg($language["ERROR"] ,$language["BAD_ID"]);
            stdfoot(false,false,true);
            exit();
        }
        $rlevel=do_sqlquery("SELECT DISTINCT id_level, predef_level, level FROM {$TABLE_PREFIX}users_level ORDER BY id_level");
        $alevel=array();
        while($reslevel=$rlevel->fetch_assoc())
            $alevel[]=$reslevel;

        $parents=get_result("SELECT id, name FROM {$TABLE_PREFIX}forums WHERE id_parent=0".(max(0,$id)>0?" AND id<>$id":""));

        if (!isset($id)) $id = "";

        $admintpl->set("language",$language);
        $admintpl->set("read",false,true);
        $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=forum&amp;action=save&amp;id=$id&amp;what=$what");

        $forum=array();
        $forum["name"]=($what == "new" ? "" : unesc($result["name"]));
        $forum["description"]=($what == "new" ? "" : unesc($result["description"]));
        $forum["combo_parent"]="\n<select name=\"parent\" size=\"1\" ".($result["i_am_parent"]?"disabled=\"disabled\"":"").">";
        $forum["combo_parent"].="\n<option value=\"0\"".($result["id_parent"]==0?"selected=\"selected\"":"").">".$language["NONE"]."</option>";
        foreach($parents as $id=>$parent)
            $forum["combo_parent"].="\n<option value=\"".$parent["id"]."\"".($result["id_parent"]==$parent["id"]?"selected=\"selected\"":"").">".$parent["name"]."</option>";
        $forum["combo_parent"].="\n</select>".($result["i_am_parent"]?"&nbsp;&nbsp;".$language["FORUM_SORRY_PARENT"]:"");

        $forum["combo_min_read"]="\n<select name=\"readlevel\" size=\"1\">";
        foreach($alevel as $level)
            $forum["combo_min_read"].="\n<option value=\"".$level["id_level"].($result["minclassread"] == $level["id_level"] ? "\" selected=\"selected\">" : "\">").$level["level"]."</option>";
        $forum["combo_min_read"].="\n</select>";

        $forum["combo_min_write"]="\n<select name=\"writelevel\" size=\"1\">";
        foreach($alevel as $level)
            $forum["combo_min_write"].="\n<option value=\"".$level["id_level"].($result["minclasswrite"] == $level["id_level"] ? "\" selected=\"selected\">" : "\">").$level["level"]."</option>";
        $forum["combo_min_write"].="\n</select>";

        $forum["combo_min_create"]="\n<select name=\"createlevel\" size=\"1\">";
        foreach($alevel as $level)
            $forum["combo_min_create"].="\n<option value=\"".$level["id_level"].($result["minclasscreate"] == $level["id_level"] ? "\" selected=\"selected\">" : "\">").$level["level"]."</option>";
        $forum["combo_min_create"].="\n</select>";

         $forum["sortorder"] = $result["sort"];
         $forum["category"] = $result["category"];

        unset($result);
        unset($reslevel);
        unset($alevel);
        unset($parents);
        unset($parent);
        $rlevel->free();

        $admintpl->set("forum",$forum);

     break;

    case "save":
        if ($_POST["confirm"]==$language["FRM_CONFIRM"])
          {
            $what=$_GET["what"];
            $minclassread=max(1,$_POST["readlevel"]);
            $minclasswrite=max(1,$_POST["writelevel"]);
            $minclasscreate=max(1,$_POST["createlevel"]);
            $description=sqlesc($_POST["description"]);
            $parent_forum=max(0,$_POST["parent"]);
            $sort=($_POST["sortorder"]);
            $category=sqlesc($_POST["category"]);
            $name=sqlesc($_POST["name"]);
            if ($what!="new")
               {
               $id=intval($_GET["id"]);
               quickQuery("UPDATE {$TABLE_PREFIX}forums SET name=$name,description=$description,minclassread=$minclassread,minclasswrite=$minclasswrite,minclasscreate=$minclasscreate, category=$category ,category=$category , sort=$sort, id_parent=$parent_forum WHERE id=$id",true);
             }
            else
                {
               quickQuery("INSERT INTO {$TABLE_PREFIX}forums SET name=$name,description=$description,minclassread=$minclassread,minclasswrite=$minclasswrite,minclasscreate=$minclasscreate, category=$category ,sort=$sort, id_parent=$parent_forum",true);
             }
          }
        redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=read");
        exit();

      break;

    case "delete":
        $id=intval($_GET["id"]);
        // control if there are posts/topics
        $resforum=do_sqlquery("SELECT *,IF((SELECT COUNT(*) FROM {$TABLE_PREFIX}forums WHERE id_parent=$id)>0,1,0) as i_am_parent FROM {$TABLE_PREFIX}forums WHERE id=$id");

        if ($_GET["confirm"]==1)
           {
             quickQuery("DELETE FROM {$TABLE_PREFIX}posts WHERE topicid IN (SELECT id FROM {$TABLE_PREFIX}topics WHERE forumid=$id)") or die(sql_error());
             quickQuery("DELETE FROM {$TABLE_PREFIX}topics WHERE forumid=$id") or die(sql_error());
             quickQuery("DELETE FROM {$TABLE_PREFIX}forums WHERE id=$id") or die(sql_error());
             redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=read");
             exit();
           }
        if ($resforum)
           {
               $result=$resforum->fetch_assoc();
               if ($result["i_am_parent"])
                 {
                    err_msg($language["WARNING"],$language["FORUM_ERR_CANNOT_DELETE_PARENT"]);
                    stdfoot(false,false,true);
                    exit();

                 }
               elseif ($result["topiccount"]>0 || $result["postcount"]>0)
                 {
                   $msg=$language["FORUM_PRUNE_1"];
                   $msg.=$language["FORUM_PRUNE_2"]." <a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=forum&amp;action=delete&amp;id=$id&amp;confirm=1\">".$language["CLICK_HERE"]."</a>";
                   $msg.=",<br />".$language["FORUM_PRUNE_3"];
                   err_msg($language["WARNING"],$msg);
                   stdfoot(false,false,true);
                   exit();
               }
               else
                 {
                   redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=delete&id=$id&confirm=1");
                   exit();
                }
           }

}
?>
