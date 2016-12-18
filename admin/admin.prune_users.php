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



$action=(isset($_GET["action"])?$_GET["action"]:"");
$days=(isset($_POST["days"])?max(0,$_POST["days"]):"");

if ($action=="prune")
{
    if (!isset($_POST["id"]))
    {
        redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=pruneu");
        die();
    }
    $count=0;
    $del_id=array();
     
    foreach($_POST["id"] as $id=>$uid)
    {
        if ($uid==1)
            continue;
        $del_id[]=$uid;
    }
    quickQuery("DELETE FROM {$TABLE_PREFIX}users WHERE id IN ('".implode("','",$del_id)."')",true);
     
    if(substr($GLOBALS["FORUMLINK"],0,3)=="smf")
    {
        $smf_fid=array();
        foreach($_POST["smf_fid"] AS $v)
        {
            $smf_fid[]=intval($v);
        }
        if (implode("", $smf_fid)!="")
        quickQuery("DELETE FROM `{$db_prefix}members` WHERE ".(($GLOBALS["FORUMLINK"]=="smf")?"`ID_MEMBER`":"`id_member`")." IN ('".implode(",", $smf_fid)."')",true);
    }
    elseif($GLOBALS["FORUMLINK"]=="ipb")
    {
        $ipb_fid=array();
        $ipb_counter=0;
        foreach($_POST["ipb_fid"] AS $v)
        {
            $ipb_counter++;
            $ipb_fid[]=intval($v);
        }
        if (implode("", $ipb_fid)!="")
        {
            quickQuery("DELETE FROM `{$ipb_prefix}members` WHERE `member_id` IN ('".implode(",", $ipb_fid)."')",true);
            $ipb_res=get_result("SELECT `cs_value` FROM `{$ipb_prefix}cache_store` WHERE `cs_key`='stats'",true,$btit_settings["cache_duration"]);
            if(count($ipb_res)>0)
            {
                $ipb_stats=unserialize($ipb_res[0]["cs_value"]);
                $ipb_stats["mem_count"]-=$ipb_counter;
                $updated_ipb_stats=serialize($ipb_stats);
                quickQuery("UPDATE `{$ipb_prefix}cache_store` SET `cs_value`='".sql_esc($updated_ipb_stats)."' WHERE `cs_key`='stats'",true);
            }
        }
    }
    $block_title=$language["PRUNE_USERS_PRUNED"];
    $admintpl->set("pruned_done",true,true);
    $admintpl->set("prune_done_msg","n.".count($del_id)." users pruned!<br />\n<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."\">".$language["BACK"]."</a>");
    $admintpl->set("prune_list",false,true);

}
elseif ($action=="view")
{
    // 30 DAYS
    if ($days==0)
    {
        // days not set!!
        redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=pruneu");
        exit;
    }
    $timeout=(60*60*24)*$days;

    $query1_and="";
    if($btit_settings["fmhack_account_parked"]=="enabled")
        $query1_and.="AND `u`.`is_parked`!='yes' ";

    $res=get_result("SELECT `u`.`id`, `u`.`username`, UNIX_TIMESTAMP(`u`.`joined`) `joined`, UNIX_TIMESTAMP(`u`.`lastconnect`) `lastconnect`, `ul`.`level`".((substr($GLOBALS["FORUMLINK"],0,3)=="smf")?", `u`.`smf_fid`":(($GLOBALS["FORUMLINK"]=="ipb")?", `u`.`ipb_fid`":""))." FROM `{$TABLE_PREFIX}users` `u` INNER JOIN `{$TABLE_PREFIX}users_level` `ul` ON `ul`.`id`=`u`.`id_level` WHERE (`u`.`id`>1 AND `ul`.`id_level`<3 AND UNIX_TIMESTAMP(`u`.`joined`)<(UNIX_TIMESTAMP()-$timeout)) OR (`u`.`id`>1 AND `ul`.`id_level`<7 AND UNIX_TIMESTAMP(`u`.`lastconnect`)<(UNIX_TIMESTAMP()-$timeout)) ".$query1_and." ORDER BY `ul`.`id_level` DESC, `u`.`lastconnect`",true);
    
    $block_title=$language["PRUNE_USERS"];

    include("$THIS_BASEPATH/include/offset.php");

    $ru=array();
    $i=0;
    foreach($res as $id=>$rusers)
    {
        $ru[$i]["username"]=unesc($rusers["username"]);
        $ru[$i]["joined"]=date("d/m/Y H:i",$rusers["joined"]-$offset)." (".get_elapsed_time($rusers["joined"]-$offset)." ago)";
        $ru[$i]["lastconnect"]=date("d/m/Y H:i",$rusers["lastconnect"]-$offset)." (".get_elapsed_time($rusers["lastconnect"]-$offset)." ago)";;
        $ru[$i]["level"]=unesc($rusers["level"]);
        $ru[$i]["id"]=$rusers["id"];
        if(substr($GLOBALS["FORUMLINK"],0,3)=="smf")
        {
            $ru[$i]["smf_fid"]=$rusers["smf_fid"];
            $ru[$i]["ipb_fid"]="";
        }
        elseif($GLOBALS["FORUMLINK"]=="ipb")
        {
            $ru[$i]["ipb_fid"]=$rusers["ipb_fid"];
            $ru[$i]["smf_fid"]="";
        }
        else
        {
            $ru[$i]["smf_fid"]="";
            $ru[$i]["ipb_fid"]="";
        }
        $i++;
    }
    unset($res);
      
    $admintpl->set("language",$language);
    $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=pruneu&amp;action=prune");
    $admintpl->set("pruned_done",false,true);
    $admintpl->set("prune_list",true,true);
    $admintpl->set("no_records",($i==0),true);
    $admintpl->set("users",$ru);
}
else
{
    $block_title=$language["PRUNE_USERS"];
    $admintpl->set("language",$language);
    $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=pruneu&amp;action=view");
    $admintpl->set("pruned_done",false,true);
    $admintpl->set("prune_list",false,true);
    $admintpl->set("prune_days","30");
}

?>