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

// - baterist BTIT v1.2 SearchDiff Hack v0.3

if (!defined("IN_BTIT"))
      die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");


global $CURUSER;
$uid= $CURUSER['uid'];

function report($id, $name, $down, $up, $rank, $first, $last) {

    global $CURUSER, $language, $btit_settings, $res_seo;

    IF ($down > 0 ) $ratio = substr($up / $down,0,5); else $ratio = '&#8734;';

    if ($down > $up) $diff="<b><font color=red>&#8595&nbsp;".makesize($down-$up)."</font></b>";
    elseif ($up > $down) $diff="<b><font color=blue>&#8593&nbsp;".makesize($up-$down)."</font></b>";
    else $diff="<b><font color=Cyan>0</font></b>";

    $return=array();
    $return["id"]=$id;
    $return["username"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$id."_".strtr($name, $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$id)."'>$name</a>";
    $return["down"]=makesize($down)."</b></font></td>";
    $return["up"]=makesize($up)."</b></font></td>";
    $return["ratio"]=$ratio."</b></td>";
    $return["rank"]=$rank."</b></td>";
    $return["diff"]=$diff."</b></td>";
    $return["first"]=date("d/m/Y H:i:s",$first)."</b></td>";
    $return["last"]=date("d/m/Y H:i:s",$last)."</b></td>";
    $return["edit"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=users&amp;action=edit&amp;uid=$id&amp;returnto=admincp.php?user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=searchdiff\">".$language["EDIT"]."</a>";
    $return["delete"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=users&amp;action=delete&amp;uid=$id&amp;returnto=admincp.php?user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=searchdiff\">".$language["DELETE"]."</a>";

    return $return;

}


$type=(isset($_POST["type"])?$_POST["type"]:"GB");
$diff=(isset($_POST["diff"])?$_POST["diff"]:50);
$readyto=(isset($_POST["readyto"])?$_POST["readyto"]:"sa");
$kullan=(isset($_POST["kullan"])?$_POST["kullan"]:0);
$kullan1=(isset($_POST["kullan1"])?$_POST["kullan1"]:0);
$changeug=(isset($_POST["changeug"])?$_POST["changeug"]:"sa");
$mesajat=(isset($_POST["mesajat"])?$_POST["mesajat"]:"sa");
$grupdegis=(isset($_POST["grupdegis"])?$_POST["grupdegis"]:"sa");
$mesajmetni=(isset($_POST["mesajmetni"])?$_POST["mesajmetni"]:"sa");
$baslik=(isset($_POST["baslik"])?$_POST["baslik"]:"sa");

$count=0;


$block_title=$language["SEARCH_DIFF"];
$admintpl->set("language",$language);
$admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=searchdiff");

$s=array('KB' => '1024', 'MB' => '1048576', 'GB' => '1073741824', 'TB' => '1099411627776' );
$opt=array("KB","MB","GB","TB");
$option="\n<select name=\"type\" size=\"1\">";
for ($id=0; $id<count($opt); $id++) {
  $option.="\n<option ";
  if ($opt[$id]==$type)
      $option.="selected=\"selected\" ";
  $option.="value=\"".$opt[$id]."\">".$opt[$id]."</option>";
}
$option.="</select>";

$admintpl->set("search_combo_kb",$option);

$option="\n<select name=\"kullan\" size=\"1\">";
$option.="\n<option value=\"0\"".($kullan==0 ? " selected=\"selected\" " : "").">".$language["ALL"]."</option>";
$res=get_result("SELECT id,level FROM {$TABLE_PREFIX}users_level WHERE id_level>1 ORDER BY id_level",true);
foreach($res as $id=>$row) {
   $option.="<option value=\"".$row["id"]."\"";
   if ($kullan==$row["id"])
      $option.="selected=\"selected\"";
   $option.=">".$row["level"]."</option>\n";
}
$option.="\n</select>";

$admintpl->set("search_combo_groups",$option);
$admintpl->set("final_result",false,true);
$admintpl->set("display_result",false,true);
$admintpl->set("search_value",$diff);

// it's final step, users get new group and pm are send
if ($changeug=="Work" && isset($_POST["uyedegis"])){

  $dis="";
  if ($grupdegis=="evet"){

       $dis.="<div align=\"center\">";
       foreach($_POST["uyedegis"] as $uyedegis=>$degeri)
       {
          quickQuery("UPDATE {$TABLE_PREFIX}users SET id_level='".$kullan1."' WHERE id='".$degeri."'");
          $dis.="User <b>".$degeri."</b> ID LEVEL has changed to <b>".$kullan1."</b><br />";
       }
       $dis.="</div>";
  }

  if ($mesajat=="evet"){
    $dis.="<div align=\"center\">";
    foreach($_POST["uyedegis"] as $uyedegis=>$degeri)
     {
     send_pm($gonderen,$degeri,$baslik,$mesajmetni);
     $dis.="PM send to User <b>".$degeri."</b><br />";
     }
    $dis.="</div>";
  }
    $admintpl->set("show_tasks",$dis);
    $admintpl->set("language",$language);
    $admintpl->set("final_result",true,true);
    $admintpl->set("display_result",false,true);

}

if ($readyto=="Go") {

    $mdiff=$_POST["diff"] * $s[$_POST["type"]];

    $admintpl->set("search_diff_title","Search for difference >".makesize($mdiff)." and User Group = ".($kullan==0?"ALL":$kullan));
    $admintpl->set("final_result",false,true);
    $admintpl->set("display_result",true,true);

    $admintpl->set("pm_bbcode",textbbcode("act","mesajmetni",""));

    if ($XBTT_USE)
       {
        $udownloaded="u.downloaded+IFNULL(x.downloaded,0)";
        $uuploaded="u.uploaded+IFNULL(x.uploaded,0)";
        $utables="{$TABLE_PREFIX}users u LEFT JOIN xbt_users x ON x.uid=u.id";
       }
    else
        {
        $udownloaded="u.downloaded";
        $uuploaded="u.uploaded";
        $utables="{$TABLE_PREFIX}users u";
        }

    if ($kullan==0)
        $q=do_sqlquery("SELECT u.id as fid, username, $udownloaded as downloaded, $uuploaded as uploaded, level, UNIX_TIMESTAMP(joined) as joined, UNIX_TIMESTAMP(lastconnect) as lastconnect FROM $utables LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id where (ABS($udownloaded - $uuploaded) > '".$mdiff."') ORDER BY ($uuploaded / $udownloaded) ASC",true);
    else
        $q=do_sqlquery("SELECT u.id as fid, username, $udownloaded as downloaded, $uuploaded as uploaded, level, UNIX_TIMESTAMP(joined) as joined, UNIX_TIMESTAMP(lastconnect) as lastconnect FROM $utables LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id where (u.id_level='".$kullan."' and ABS($udownloaded - $uuploaded) > '".$mdiff."') ORDER BY ($uuploaded / $udownloaded) ASC",true);

    $lusers=array();
    while ($user=$q->fetch_object()) {
      if ($user) {
        $lusers[]=report($user->fid, $user->username, $user->downloaded, $user->uploaded, $user->level, $user->joined, $user->lastconnect);
        $count++;

      }
    }


    $option="\n<select name=\"kullan1\" size=\"1\">";
    $res=get_result("SELECT id,level FROM {$TABLE_PREFIX}users_level WHERE id_level>2 ORDER BY id_level",true);
    foreach($res as $id=>$row) {
       $option.="<option value=\"".$row["id"]."\"";
       if ($kullan1==$row["id"])
          $option.="selected=\"selected\"";
       $option.=">".$row["level"]."</option>\n";
    }
    $option.="\n</select>";

    $admintpl->set("search_combo_newgroups",$option);
    $admintpl->set("users",$lusers);
    $admintpl->set("users_founds","<br /><br />Found <b>".$count."</b> users whose difference is higher than <b>".makesize($mdiff)."</b>");

    unset($res);
    unset($user);
    unset($lusers);
    $q->free();


}

?>
