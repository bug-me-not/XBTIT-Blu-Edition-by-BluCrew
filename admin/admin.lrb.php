<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Xbtiteam
//
//    This file is part of xbtit.
//
// Low Ratio and Ban System hack by DiemThuy - Juni 2010
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



$admintpl->set("language",$language);

$action = $_GET['action'];

// Delete low ratio ban rules
if($action =="delete")
{
    (isset($_GET["id"]) && !empty($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"]>0) ? $msg =(int)0+$_GET["id"] : $msg=0;
    if($msg!=0)
        quickQuery("DELETE FROM `{$TABLE_PREFIX}low_ratio_ban` WHERE `wb_rank`=".$msg,true);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=lrb");
    exit();
}

// insert low ratio/ban overall settings in the database
if($action == 'senda')
{
    (isset($_POST["wb_text_one"]) && !empty($_POST["wb_text_one"])) ? $DT11 = sqlesc($_POST['wb_text_one']) : $DT11="";
    $DT0  = $_POST["wb_sys"]?"true":"false";
    (isset($_POST["wb_text_one"]) && !empty($_POST["wb_text_one"])) ? $DT11 = sqlesc($_POST['wb_text_one']) : $DT11="";
    (isset($_POST["wb_text_two"]) && !empty($_POST["wb_text_two"])) ? $DT12 = sqlesc($_POST['wb_text_two']) : $DT12="";
    (isset($_POST["wb_text_fin"]) && !empty($_POST["wb_text_fin"])) ? $DT13 = sqlesc($_POST['wb_text_fin']) : $DT13="";

    quickQuery("UPDATE `{$TABLE_PREFIX}low_ratio_ban_settings` SET `wb_sys`='".$DT0."', `wb_text_one`='".$DT11."', `wb_text_two`='".$DT12."' , `wb_text_fin`='".$DT13."' WHERE `id` =1", true);

    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=lrb");
    exit();
}

// read low ratio/ban overall settings from the database
$rest=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}low_ratio_ban_settings",true);

$row3=$rest->fetch_array();
$admintpl->set("wb_button",$row3["wb_sys"]=="true"?"checked=\"checked\"":"");
$admintpl->set("lrb.wb_text_one",$row3['wb_text_one']);
$admintpl->set("lrb.wb_text_two",$row3['wb_text_two']);
$admintpl->set("lrb.wb_text_fin",$row3['wb_text_fin']);

// insert low ratio/ban group rules in the database
if($action == 'sendb')
{
    (isset($_POST["wb_down"]) && !empty($_POST["wb_down"]) && is_numeric($_POST["wb_down"]) && $_POST["wb_down"]>0) ? $DT1=(float)0+$_POST["wb_down"] : $DT1=0;
    (isset($_POST["wb_rank"]) && !empty($_POST["wb_rank"]) && is_numeric($_POST["wb_rank"]) && $_POST["wb_rank"]>0) ? $DT2=(int)0+$_POST["wb_rank"] : $DT2=0;
    $DT3  =    $_POST['wb_warn']?"true":"false";
    (isset($_POST["wb_one"]) && !empty($_POST["wb_one"]) && is_numeric($_POST["wb_one"]) && $_POST["wb_one"]>0) ? $DT4=(float)0+$_POST["wb_one"] : $DT4=0;
    (isset($_POST["wb_days_one"]) && !empty($_POST["wb_days_one"]) && is_numeric($_POST["wb_days_one"]) && $_POST["wb_days_one"]>0) ? $DT5=(int)0+$_POST["wb_days_one"] : $DT5=0;
    (isset($_POST["wb_two"]) && !empty($_POST["wb_two"]) && is_numeric($_POST["wb_two"]) && $_POST["wb_two"]>0) ? $DT6=(float)0+$_POST["wb_two"] : $DT6=0;
    (isset($_POST["wb_days_two"]) && !empty($_POST["wb_days_two"]) && is_numeric($_POST["wb_days_two"]) && $_POST["wb_days_two"]>0) ? $DT7=(int)0+$_POST["wb_days_two"] : $DT7=0;
    (isset($_POST["wb_three"]) && !empty($_POST["wb_three"]) && is_numeric($_POST["wb_three"]) && $_POST["wb_three"]>0) ? $DT8=(float)0+$_POST["wb_three"] : $DT8=0;
    (isset($_POST["wb_days_fin"]) && !empty($_POST["wb_days_fin"]) && is_numeric($_POST["wb_days_fin"]) && $_POST["wb_days_fin"]>0) ? $DT9=(int)0+$_POST["wb_days_fin"] : $DT9=0;
    (isset($_POST["wb_fin"]) && !empty($_POST["wb_fin"]) && is_numeric($_POST["wb_fin"]) && $_POST["wb_fin"]>0) ? $DT10=(float)0+$_POST["wb_fin"] : $DT10=0;

    $check=do_sqlquery("SELECT * FROM `{$TABLE_PREFIX}low_ratio_ban` WHERE `wb_rank`=".$DT2,true);
    $checkres=sql_num_rows($check);

    if ($checkres>0)
        stderr($language["ERROR"],$language["RAT_NO_2ND_RULE"]);
    else
    {
        quickQuery("INSERT `{$TABLE_PREFIX}low_ratio_ban` SET `wb_down`='".$DT1."',`wb_rank`='".$DT2."',`wb_warn`='".$DT3."',`wb_one`='".$DT4."',`wb_days_one`='".$DT5."',`wb_two`='".$DT6."',`wb_days_two`='".$DT7."',`wb_three`='".$DT8."', `wb_days_fin`='".$DT9."', `wb_fin`='".$DT10."'",true);
        redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=lrb");
        exit();
    }
}

//Here we will select the data from the table low ratio ban
$res=do_sqlquery("SELECT  ul.id, ul.level,ul.prefixcolor,ul.suffixcolor, ar.wb_down, ar.wb_rank, ar.wb_warn, ar.wb_one, ar.wb_days_one, ar.wb_two, ar.wb_days_two, ar.wb_three, ar.wb_days_fin, ar.wb_fin FROM {$TABLE_PREFIX}low_ratio_ban ar INNER JOIN {$TABLE_PREFIX}users_level ul ON ar.wb_rank=ul.id ORDER BY ar.wb_rank ASC",true);

$hit=array();
$i=0;
if(@sql_num_rows($res)>0)
{
    while($row1=$res->fetch_array())
    {
        if ($row1['wb_warn']=='false')
            $war='<span style="color:green;"><b>'.$language["NO"].'</b></span>';
        else
            $war='<span style="color:red;"><b>'.$language["YES"].'</b></span>';

        $hit[$i]["wb_rank"]=$row1["wb_rank"];
        $hit[$i]["wb_group"]="<a href=\"index.php?page=users&level=".$row1["wb_rank"]."\">".unesc($row1["prefixcolor"].$row1["level"].$row1["suffixcolor"])."</a>";
        $hit[$i]["min_download"]=$row1["wb_down"]." ".$language["GB"];
        $hit[$i]["ratio_one"]=$row1["wb_one"];
        $hit[$i]["days_one"]=$row1["wb_days_one"];
        $hit[$i]["ratio_two"]=$row1["wb_two"];
        $hit[$i]["days_two"]=$row1["wb_days_two"];
        $hit[$i]["ratio_three"]=$row1["wb_three"];
        $hit[$i]["days_three"]=$row1["wb_days_fin"];
        $hit[$i]["ratio_fin"]=$row1["wb_fin"];
        $hit[$i]["warn"]=$war;
        $hit[$i]["delete"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=lrb&amp;action=delete&amp;id=".$row1[wb_rank]."\" onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\">".image_or_link("$STYLEPATH/images/delete.png","",$language["DELETE"])."</a>";
        $i++;
    }
}
$admintpl->set("frm_actiona", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=lrb&amp;action=senda");
$admintpl->set("frm_actionb", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=lrb&amp;action=sendb");
$admintpl->set("hit",$hit);

// Unwarn
if($action =="unwarn")
{
    (isset($_GET["id"]) && !empty($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"]>0) ? $uuw =(int)0+$_GET["id"] : $uuw=0;
    if($uuw!=0)
        quickQuery("UPDATE {$TABLE_PREFIX}users SET rat_warn_level ='0' WHERE id=".$uuw,true);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=lrb");
    exit();
}

// Unban
if($action =="unban")
{
    (isset($_GET["id"]) && !empty($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"]>0) ? $uub =(int)0+$_GET["id"] : $uub=0;
    if($uub!=0)
        quickQuery("UPDATE {$TABLE_PREFIX}users SET bandt ='no' WHERE id=".$uub,true);
    redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=lrb");
    exit();
}

// Warned & banned user list
$r2 = do_sqlquery("SELECT `u`.`id`, `ul`.`prefixcolor`, `u`.`username`, `ul`.`suffixcolor`, `u`.`rat_warn_level`, `u`.`rat_warn_time`, `ul`.`level`, `u`.`bandt` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `u`.`rat_warn_level`!=0 OR `u`.`bandt`='yes'",true);
$list=array();
$ii=0;

if(@sql_num_rows($r2)>0)
{
    while ($arr=$r2->fetch_assoc())
    {
        $name = unesc($arr["prefixcolor"].$arr["username"].$arr["suffixcolor"]);

        if ($arr['bandt']=='no')
            $ban='<span style="color:green;"><b>'.$language["NO"].'</b></span>';
        else
            $ban='<span style="color:red;"><b>'.$language["YES"].'</b></span>';

        if ($arr['rat_warn_level']==0)
            $wa='<span style="color:green;"><b>'.$language["NO"].'</b></span>';
        else
            $wa='<span style="color:red;"><b>'.$language["YES"].'</b></span>';

        $list[$ii]["username"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$arr["id"]."_".strtr($arr["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$arr["id"])."'>" . $name . "</a>";
        $list[$ii]["group"]=$arr['level'];
        $list[$ii]["warn"]=$arr['rat_warn_level'];
        $list[$ii]["date"]=$arr['rat_warn_time'];
        $list[$ii]["show"]=$wa;
        $list[$ii]["ban"]=$ban;
        $list[$ii]["unwarn"]="<center><a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=lrb&amp;action=unwarn&amp;id=".$arr[id]."\" onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\">".image_or_link("images/aranydt.png","",$language["DELETE"])."</center></a>";
        $list[$ii]["unban"]="<center><a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=lrb&amp;action=unban&amp;id=".$arr[id]."\" onclick=\"return confirm('".AddSlashes($language["DELETE_CONFIRM"])."')\">".image_or_link("images/aranydt.png","",$language["DELETE"])."</center></a>";
        $ii++;
    }
}
$admintpl->set("list",$list);

?>
