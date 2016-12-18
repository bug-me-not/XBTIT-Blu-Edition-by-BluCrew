<?php

if (!defined("IN_BTIT"))
      die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");



$admintpl->set("language", $language);
$admintpl->set("CURUSER", $CURUSER);


$option=(isset($_GET["option"]) && !empty($_GET["option"])?$option="".$_GET['option']."":$option="");
switch($option)
{
case 'edit':
$opt="edit";
break;
case 'delete':
$opt="delete";
break;
case '':
default;
$opt="";
break;
}
(isset($_GET["confirm"]) && !empty($_GET["confirm"]) && $_GET["confirm"]=="yes") ? $confirm="yes" : $confirm="no";
(isset($_GET["id"]) && !empty($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"]>1) ? $id=(int)0+$_GET["id"] : $id=0;

if($opt=="delete")
{

    if($confirm=="no")
        information_msg($language["HNR_CONFIRM_DEL"], $language["HNR_R_U_SURE"]."<br /><br /><a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=hitrun&option=delete&id=".$id."&confirm=yes'>".$language["YES"]."</a> | <a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=hitrun'>".$language["NO"]."</a>");
    elseif($confirm=="yes" && $id!=0)
    {
        quickQuery("DELETE FROM `{$TABLE_PREFIX}hnr` WHERE `id_level`=".$id,true);
        redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=hitrun");
    }
}elseif($opt=="edit")
{
$admintpl->set("is_edit",($opt=="edit"?true:false), true);
$admintpl->set("this_id",$id);
$set=get_result("SELECT * FROM `{$TABLE_PREFIX}hnr` WHERE `id_level`=".$id,true,$btit_settings["cache_duration"]);
foreach($set as $id=> $now);
$admintpl->set("now",$now);
if($now["min_seed_hours"]>0)
{
if($now["min_seed_hours"]<24){
$admintpl->set("msh",$now["min_seed_hours"]);
$admintpl->set("hord",$language["HNR_HOURS"]);
}elseif($now["min_seed_hours"]>=24){
$admintpl->set("msh",$now["min_seed_hours"]/24);
$admintpl->set("hord",$language["HNR_DAYS"]);
}
}else{$admintpl->set("hord","-----");}
if($now["tolerance_hours"]>0)
{
if($now["tolerance_hours"]<24){
$admintpl->set("th",$now["tolerance_hours"]);
$admintpl->set("tol",$language["HNR_HOURS"]);
}elseif($now["min_seed_hours"]>=24){
$admintpl->set("th",$now["tolerance_hours"]/24);
$admintpl->set("tol",$language["HNR_DAYS"]);
}
}else{$admintpl->set("tol","-----");}
if($now["dl_trig_bytes"]>0)
{
if (abs($now["dl_trig_bytes"]) < 1024000){
    $admintpl->set("trig",$language["HNR_BYTES"]);
}else
  if (abs($now["dl_trig_bytes"]) < 1048576000){
    $admintpl->set("trig",$language["HNR_MB"]);
}else
  if (abs($now["dl_trig_bytes"]) < 1073741824000){
    $admintpl->set("trig",$language["HNR_GB"]);
}else
  if(abs($now["dl_trig_bytes"])< 1099511627776){
    $admintpl->set("trig",$language["HNR_TB"]);
}
$admintpl->set("trigamt",floor(makesize1($now["dl_trig_bytes"])));
}else{$admintpl->set("trig","-----");
$admintpl->set("trigamt","");
}
if($now["block_leech"]>0?$admintpl->set("hl","selected='selected'"):$admintpl->set("hl","selected='selected'"));
$lev=get_result("SELECT level FROM `{$TABLE_PREFIX}users_level` WHERE `id_level`=".$now["id_level"],true,$btit_settings["cache_duration"]);
$levis=$lev[0]["level"];
if(substr($FORUMLINK,0,3)=="smf")
        $res=get_result("SELECT `ul`.`id`, `ul`.`level`, `ul`.`prefixcolor`, `ul`.`suffixcolor`, `hnr`.*, `f`.`name` FROM `{$TABLE_PREFIX}users_level` `ul` LEFT JOIN `{$TABLE_PREFIX}hnr` `hnr` ON `ul`.`id`=`hnr`.`id_level` LEFT JOIN `{$db_prefix}boards` `f` ON `hnr`.`forum_post`=`f`.".(($FORUMLINK=="smf")?"`ID_BOARD`":"`id_board`")." WHERE `ul`.`id_level`>1 ORDER BY `ul`.`id_level` ASC", true, $btit_settings['cache_duration']);
    elseif($FORUMLINK=="ipb")
        $res=get_result("SELECT `ul`.`id`, `ul`.`level`, `ul`.`prefixcolor`, `ul`.`suffixcolor`, `hnr`.*, `f`.`name` FROM `{$TABLE_PREFIX}users_level` `ul` LEFT JOIN `{$TABLE_PREFIX}hnr` `hnr` ON `ul`.`id`=`hnr`.`id_level` LEFT JOIN `{$ipb_prefix}forums` `f` ON `hnr`.`forum_post`=`f`.`id` WHERE `ul`.`id_level`>1 ORDER BY `ul`.`id_level` ASC", true, $btit_settings['cache_duration']);
    else
        $res=get_result("SELECT `ul`.`id`, `ul`.`level`, `ul`.`prefixcolor`, `ul`.`suffixcolor`, `hnr`.*, `f`.`name` FROM `{$TABLE_PREFIX}users_level` `ul` LEFT JOIN `{$TABLE_PREFIX}hnr` `hnr` ON `ul`.`id`=`hnr`.`id_level` LEFT JOIN `{$TABLE_PREFIX}forums` `f` ON `hnr`.`forum_post`=`f`.`id` WHERE `ul`.`id_level`>1 ORDER BY `ul`.`id_level` ASC", true, $btit_settings['cache_duration']);

    $i=0;
    $current_settings=array();
    $select="<option value='0'>".$levis."</option>";
    foreach($res as $row)
    {
        if(is_null($row["id_level"]))
        {
            $select.="<option value='".$row["id"]."'";
            $select.=">".$row["level"]."</option>\n";
        }
        else
        {
            $current_settings[$i]["id_level"]=$row["id_level"];
            $current_settings[$i]["rank"]=unesc($row["prefixcolor"].$row["level"].$row["suffixcolor"]);

            if($row["method"]=="seed_only")
                $method=$language["HNR_TS_ONLY"];
            elseif($row["method"]=="ratio_only")
                $method=$language["HNR_RATIO_ONLY"];
            elseif($row["method"]=="seed_or_ratio")
                $method=$language["HNR_TS_OR_RATIO_1"];
            elseif($row["method"]=="seed_and_ratio")
                $method=$language["HNR_TS_AND_RATIO_1"];
            $current_settings[$i]["method"]=$method;

            if($row["min_seed_hours"]==0)
                $msh=$language["NA"];
            else
                $msh=(($row["min_seed_hours"]>=24)?($row["min_seed_hours"]/24) . " "  . $language["HNR_DAYS"]:$row["min_seed_hours"] . " " . $language["HNR_HOURS"]);
            $current_settings[$i]["msh"]=$msh;

            if($row["min_ratio"]==0)
                $mrat=$language["NA"];
            else
                $mrat=$row["min_ratio"];
            $current_settings[$i]["mrat"]=$mrat;

            if($row["tolerance_hours"]==0)
                $current_settings[$i]["tol"]=$language["NA"];
            else
                $current_settings[$i]["tol"]=(($row["tolerance_hours"]>=24)?($row["tolerance_hours"]/24) . " "  . $language["HNR_DAYS"]:$row["tolerance_hours"] . " " . $language["HNR_HOURS"]);

            $current_settings[$i]["dltrig"]=makesize($row["dl_trig_bytes"]);

            if($row["block_leech"]==0)
                $current_settings[$i]["block_leech"]=$language["NA"];            
            else
                $current_settings[$i]["block_leech"]=$language["HNR_AFTER"] . " " . $row["block_leech"] . " " . $language["HNR_WARNINGS"];

            if($row["forum_post"]==0)
                $current_settings[$i]["forum_post"]=$language["NA"];            
            else
                $current_settings[$i]["forum_post"]=$row["name"];

            $current_settings[$i]["delete"]="<a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=hitrun&option=delete&id=".$row["id_level"]."'><img src='$STYLEURL/images/delete.png' border='0' alt='".$language["DELETE"]." ".$language["HNR_SET_FOR"]." ".$row["level"]."' title='".$language["DELETE"]." ".$language["HNR_SET_FOR"]." ".$row["level"]."' />";

            $i++;
        }
    }

    
    $admintpl->set("hnrloop", $current_settings);
    $admintpl->set("select", $select);
    if(substr($FORUMLINK,0,3)=="smf")
        $res=get_result("SELECT ".(($FORUMLINK=="smf")?"`ID_BOARD`":"`id_board`")." `id`, `name` FROM `{$db_prefix}boards` ORDER BY ".(($FORUMLINK=="smf")?"`ID_BOARD`":"`id_board`")." ASC", true, $btit_settings["cache_duration"]);
    elseif($FORUMLINK=="ipb")
        $res=get_result("SELECT `id`, `name` FROM `{$ipb_prefix}forums` WHERE `parent_id`!='-1' ORDER BY `id` ASC", true, $btit_settings["cache_duration"]);
    else
        $res=get_result("SELECT `id`, `name` FROM `{$TABLE_PREFIX}forums` ORDER BY `id` ASC", true, $btit_settings["cache_duration"]);
        
        
      if(substr($FORUMLINK,0,3)=="smf")
        $resname=get_result("SELECT `name` FROM `{$db_prefix}boards` WHERE ".(($FORUMLINK=="smf")?"`ID_BOARD`":"`id_board`")."=".$now["forum_post"], true, $btit_settings["cache_duration"]);
    elseif($FORUMLINK=="ipb")
        $resname=get_result("SELECT `name` FROM `{$ipb_prefix}forums` WHERE `id`=".$now["forum_post"]."", true, $btit_settings["cache_duration"]);
    else
        $resname=get_result("SELECT `name` FROM `{$TABLE_PREFIX}forums` WHERE `id`=".$now["forum_post"]."", true, $btit_settings["cache_duration"]);
     $thename=(!empty($resname[0]["name"])?$resname[0]["name"]:"-----");
    $select2="<option value='0'>".$thename."</option>";
    foreach($res as $row)
    {
        $select2.="<option value='".$row["id"]."'";
        $select2.=">".$row["name"]."</option>\n";
    }
    (!empty($resname[0]["name"])?$admintpl->set("fy","selected='selected'"):$admintpl->set("fy",""));
    $admintpl->set("select2", $select2);
}
else
{
	$admintpl->set("is_edit",($opt=="edit"?true:false), true);
    if(substr($FORUMLINK,0,3)=="smf")
        $res=get_result("SELECT `ul`.`id`, `ul`.`level`, `ul`.`prefixcolor`, `ul`.`suffixcolor`, `hnr`.*, `f`.`name` FROM `{$TABLE_PREFIX}users_level` `ul` LEFT JOIN `{$TABLE_PREFIX}hnr` `hnr` ON `ul`.`id`=`hnr`.`id_level` LEFT JOIN `{$db_prefix}boards` `f` ON `hnr`.`forum_post`=`f`.".(($FORUMLINK=="smf")?"`ID_BOARD`":"`id_board`")." WHERE `ul`.`id_level`>1 ORDER BY `ul`.`id_level` ASC", true, $btit_settings['cache_duration']);
    elseif($FORUMLINK=="ipb")
        $res=get_result("SELECT `ul`.`id`, `ul`.`level`, `ul`.`prefixcolor`, `ul`.`suffixcolor`, `hnr`.*, `f`.`name` FROM `{$TABLE_PREFIX}users_level` `ul` LEFT JOIN `{$TABLE_PREFIX}hnr` `hnr` ON `ul`.`id`=`hnr`.`id_level` LEFT JOIN `{$ipb_prefix}forums` `f` ON `hnr`.`forum_post`=`f`.`id` WHERE `ul`.`id_level`>1 ORDER BY `ul`.`id_level` ASC", true, $btit_settings['cache_duration']);
    else
        $res=get_result("SELECT `ul`.`id`, `ul`.`level`, `ul`.`prefixcolor`, `ul`.`suffixcolor`, `hnr`.*, `f`.`name` FROM `{$TABLE_PREFIX}users_level` `ul` LEFT JOIN `{$TABLE_PREFIX}hnr` `hnr` ON `ul`.`id`=`hnr`.`id_level` LEFT JOIN `{$TABLE_PREFIX}forums` `f` ON `hnr`.`forum_post`=`f`.`id` WHERE `ul`.`id_level`>1 ORDER BY `ul`.`id_level` ASC", true, $btit_settings['cache_duration']);

    $i=0;
    $current_settings=array();
    $select="<option value='0'>----</option>";
    foreach($res as $row)
    {
        if(is_null($row["id_level"]))
        {
            $select.="<option value='".$row["id"]."'";
            $select.=">".$row["level"]."</option>\n";
        }
        else
        {
            $current_settings[$i]["id_level"]=$row["id_level"];
            $current_settings[$i]["rank"]=unesc($row["prefixcolor"].$row["level"].$row["suffixcolor"]);

            if($row["method"]=="seed_only")
                $method=$language["HNR_TS_ONLY"];
            elseif($row["method"]=="ratio_only")
                $method=$language["HNR_RATIO_ONLY"];
            elseif($row["method"]=="seed_or_ratio")
                $method=$language["HNR_TS_OR_RATIO_1"];
            elseif($row["method"]=="seed_and_ratio")
                $method=$language["HNR_TS_AND_RATIO_1"];
            $current_settings[$i]["method"]=$method;

            if($row["min_seed_hours"]==0)
                $msh=$language["NA"];
            else
                $msh=(($row["min_seed_hours"]>=24)?($row["min_seed_hours"]/24) . " "  . $language["HNR_DAYS"]:$row["min_seed_hours"] . " " . $language["HNR_HOURS"]);
            $current_settings[$i]["msh"]=$msh;

            if($row["min_ratio"]==0)
                $mrat=$language["NA"];
            else
                $mrat=$row["min_ratio"];
            $current_settings[$i]["mrat"]=$mrat;

            if($row["tolerance_hours"]==0)
                $current_settings[$i]["tol"]=$language["NA"];
            else
                $current_settings[$i]["tol"]=(($row["tolerance_hours"]>=24)?($row["tolerance_hours"]/24) . " "  . $language["HNR_DAYS"]:$row["tolerance_hours"] . " " . $language["HNR_HOURS"]);

            $current_settings[$i]["dltrig"]=makesize($row["dl_trig_bytes"]);

            if($row["block_leech"]==0)
                $current_settings[$i]["block_leech"]=$language["NA"];            
            else
                $current_settings[$i]["block_leech"]=$language["HNR_AFTER"] . " " . $row["block_leech"] . " " . $language["HNR_WARNINGS"];

            if($row["forum_post"]==0)
                $current_settings[$i]["forum_post"]=$language["NA"];            
            else
                $current_settings[$i]["forum_post"]=$row["name"];

            $current_settings[$i]["delete"]="<a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=hitrun&option=delete&id=".$row["id_level"]."'><img src='$STYLEURL/images/delete.png' border='0' alt='".$language["DELETE"]." ".$language["HNR_SET_FOR"]." ".$row["level"]."' title='".$language["DELETE"]." ".$language["HNR_SET_FOR"]." ".$row["level"]."' />";
            $current_settings[$i]["edit"]="<a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=hitrun&option=edit&id=".$row["id_level"]."'><img src='$STYLEURL/images/edit.png' border='0' alt='".$language["EDIT"]." ".$language["HNR_SET_FOR"]." ".$row["level"]."' title='".$language["EDIT"]." ".$language["HNR_SET_FOR"]." ".$row["level"]."' />";
            $i++;
        }
    }

    $admintpl->set("is_loop", ((!empty($current_settings))?true:false), true);
    $admintpl->set("hnrloop", $current_settings);
    $admintpl->set("select", $select);

    if(substr($FORUMLINK,0,3)=="smf")
        $res=get_result("SELECT ".(($FORUMLINK=="smf")?"`ID_BOARD`":"`id_board`")." `id`, `name` FROM `{$db_prefix}boards` ORDER BY ".(($FORUMLINK=="smf")?"`ID_BOARD`":"`id_board`")." ASC", true, $btit_settings["cache_duration"]);
    elseif($FORUMLINK=="ipb")
        $res=get_result("SELECT `id`, `name` FROM `{$ipb_prefix}forums` WHERE `parent_id`!='-1' ORDER BY `id` ASC", true, $btit_settings["cache_duration"]);
    else
        $res=get_result("SELECT `id`, `name` FROM `{$TABLE_PREFIX}forums` ORDER BY `id` ASC", true, $btit_settings["cache_duration"]);

    $select2="<option value='0'>----</option>";
    foreach($res as $row)
    {
        $select2.="<option value='".$row["id"]."'";
        $select2.=">".$row["name"]."</option>\n";
    }
    $admintpl->set("select2", $select2);
    
    $job=(isset($_GET["job"]) && !empty($_GET["job"])?$job="".$_GET['job']."":$job="");
switch($job)
{
case 'insert':
$job="insert";
break;
case 'save':
$job="save";
break;
case '':
default;
$job="";
break;
}

    if(isset($_POST) && !empty($_POST) && $job=="save")
    {
	$id=(isset($_GET["id"])?intval($_GET["id"]):$id=0);
	(isset($_POST["hnr_rank"]) && !empty($_POST["hnr_rank"]) && is_numeric($_POST["hnr_rank"])) ? $hnr_rank=(int)0+$_POST["hnr_rank"] : $hnr_rank=0;
        (isset($_POST["hnr_method"]) && !empty($_POST["hnr_method"]) && is_numeric($_POST["hnr_method"]) ) ? $hnr_method=(int)0+$_POST["hnr_method"] : $hnr_method=0;
        (isset($_POST["hnr_seeding_trigger"]) && !empty($_POST["hnr_seeding_trigger"]) && is_numeric($_POST["hnr_seeding_trigger"])) ? $hnr_seeding_trigger=(float)0+$_POST["hnr_seeding_trigger"] : $hnr_seeding_trigger=0;
        (isset($_POST["hnr_seeding_type"]) && !empty($_POST["hnr_seeding_type"]) && is_numeric($_POST["hnr_seeding_type"])) ? $hnr_seeding_type=(int)0+$_POST["hnr_seeding_type"] : $hnr_seeding_type=0;
        (isset($_POST["hnr_ratio_trigger"]) && !empty($_POST["hnr_ratio_trigger"]) && is_numeric($_POST["hnr_ratio_trigger"])) ? $hnr_ratio_trigger=(float)0+$_POST["hnr_ratio_trigger"] : $hnr_ratio_trigger=0;
        (isset($_POST["hnr_tolerance"]) && !empty($_POST["hnr_tolerance"]) && is_numeric($_POST["hnr_tolerance"])) ? $hnr_tolerance=(float)0+$_POST["hnr_tolerance"] : $hnr_tolerance=0;
        (isset($_POST["hnr_tolerance_type"]) && !empty($_POST["hnr_tolerance_type"]) && is_numeric($_POST["hnr_tolerance_type"])) ? $hnr_tolerance_type=(int)0+$_POST["hnr_tolerance_type"] : $hnr_tolerance_type=0;
        (isset($_POST["hnr_download_trigger"]) && !empty($_POST["hnr_download_trigger"]) && is_numeric($_POST["hnr_download_trigger"])) ? $hnr_download_trigger=(float)0+$_POST["hnr_download_trigger"] : $hnr_download_trigger=0;
        (isset($_POST["hnr_dl_tr_type"]) && !empty($_POST["hnr_dl_tr_type"]) && is_numeric($_POST["hnr_dl_tr_type"])) ? $hnr_dl_tr_type=(int)0+$_POST["hnr_dl_tr_type"] : $hnr_dl_tr_type=0;
        (isset($_POST["hnr_bl"]) && !empty($_POST["hnr_bl"]) && is_numeric($_POST["hnr_bl"])) ? $hnr_bl=(int)0+$_POST["hnr_bl"] : $hnr_bl=0;
        (isset($_POST["hnr_bl_count"]) && !empty($_POST["hnr_bl_count"]) && is_numeric($_POST["hnr_bl_count"])) ? $hnr_bl_count=(int)0+$_POST["hnr_bl_count"] : $hnr_bl_count=0;
        (isset($_POST["hnr_fp"]) && !empty($_POST["hnr_fp"]) && is_numeric($_POST["hnr_fp"])) ? $hnr_fp=(int)0+$_POST["hnr_fp"] : $hnr_fp=0;
        (isset($_POST["hnr_fp_id"]) && !empty($_POST["hnr_fp_id"]) && is_numeric($_POST["hnr_fp_id"])) ? $hnr_fp_id=(int)0+$_POST["hnr_fp_id"] : $hnr_fp_id=0;

        if($hnr_rank==0){
	    }else{
		$hnr_rank1="`id_level`=".$hnr_rank.",";
	    }
        if($hnr_method==0)
        {
	    }
	    
        elseif($hnr_method==2)
        {
            $hnr_method1="`method`='ratio_only',";
            $hnr_seeding_trigger1="`min_seed_hours`=0,";
        }
        elseif($hnr_method==3)
            $hnr_method1="`method`='seed_or_ratio',";
        elseif($hnr_method==4)
            $hnr_method1="`method`='seed_and_ratio',";
        else
        {
            $hnr_method1="`method`='seed_only',";
            $hnr_ratio_trigger=0;
        }
         if ($hnr_seeding_type==0){
		 }
        elseif($hnr_seeding_type==2){
            $hnr_seeding_trigger1="`min_seed_hours`=".floor($hnr_seeding_trigger*24).",";
		}else{
			$hnr_seeding_trigger1="`min_seed_hours`=".$hnr_seeding_trigger.",";
		}
        if($hnr_tolerance_type==0){
	    }
        elseif($hnr_tolerance_type==2){
            $hnr_tolerance1="`tolerance_hours`=".floor($hnr_tolerance*24).",";
		}else{
			$hnr_tolerance1="`tolerance_hours`=".$hnr_tolerance.",";
		}
        if($hnr_dl_tr_type==0){
		}
        elseif($hnr_dl_tr_type==2){
            $hnr_download_trigger1="`dl_trig_bytes`=".floor($hnr_download_trigger*1024).",";
		}
        elseif($hnr_dl_tr_type==3){
            $hnr_download_trigger1="`dl_trig_bytes`=".floor($hnr_download_trigger*1048576).",";
		}
        elseif($hnr_dl_tr_type==4){
            $hnr_download_trigger1="`dl_trig_bytes`=".floor($hnr_download_trigger*1073741824).",";
		}
        elseif($hnr_dl_tr_type==5){
            $hnr_download_trigger1="`dl_trig_bytes`=".floor($hnr_download_trigger*1099511627776).",";
		}else{
		$hnr_download_trigger1="`dl_trig_bytes`=".$hnr_download_trigger.",";
	    }
        
        if($hnr_bl!=1)
            $hnr_bl_count=0;
        
        if($hnr_fp==0 && $hnr_fp_id==0){
		
		}
		elseif($hnr_fp==0 && $hnr_fp_id>=1) {
            $hnr_fp_id1=",`forum_post`=0";
		}else{$hnr_fp_id1=",`forum_post`=".$hnr_fp_id."";}
            
        quickQuery("UPDATE `{$TABLE_PREFIX}hnr` SET ".$hnr_rank1."".$hnr_method1."".$hnr_seeding_trigger1."`min_ratio`='".$hnr_ratio_trigger."',".$hnr_tolerance1." ".$hnr_download_trigger1." `block_leech`=".$hnr_bl_count."".$hnr_fp_id1." WHERE `id_level`=$id", true);
        redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=hitrun");  
	}

    if(isset($_POST) && !empty($_POST) && $job=="insert")
    {
        (isset($_POST["hnr_rank"]) && !empty($_POST["hnr_rank"]) && is_numeric($_POST["hnr_rank"])) ? $hnr_rank=(int)0+$_POST["hnr_rank"] : $hnr_rank=0;
        (isset($_POST["hnr_method"]) && !empty($_POST["hnr_method"]) && is_numeric($_POST["hnr_method"]) ) ? $hnr_method=(int)0+$_POST["hnr_method"] : $hnr_method=0;
        (isset($_POST["hnr_seeding_trigger"]) && !empty($_POST["hnr_seeding_trigger"]) && is_numeric($_POST["hnr_seeding_trigger"])) ? $hnr_seeding_trigger=(float)0+$_POST["hnr_seeding_trigger"] : $hnr_seeding_trigger=0;
        (isset($_POST["hnr_seeding_type"]) && !empty($_POST["hnr_seeding_type"]) && is_numeric($_POST["hnr_seeding_type"])) ? $hnr_seeding_type=(int)0+$_POST["hnr_seeding_type"] : $hnr_seeding_type=0;
        (isset($_POST["hnr_ratio_trigger"]) && !empty($_POST["hnr_ratio_trigger"]) && is_numeric($_POST["hnr_ratio_trigger"])) ? $hnr_ratio_trigger=(float)0+$_POST["hnr_ratio_trigger"] : $hnr_ratio_trigger=0;
        (isset($_POST["hnr_tolerance"]) && !empty($_POST["hnr_tolerance"]) && is_numeric($_POST["hnr_tolerance"])) ? $hnr_tolerance=(float)0+$_POST["hnr_tolerance"] : $hnr_tolerance=0;
        (isset($_POST["hnr_tolerance_type"]) && !empty($_POST["hnr_tolerance_type"]) && is_numeric($_POST["hnr_tolerance_type"])) ? $hnr_tolerance_type=(int)0+$_POST["hnr_tolerance_type"] : $hnr_tolerance_type=0;
        (isset($_POST["hnr_download_trigger"]) && !empty($_POST["hnr_download_trigger"]) && is_numeric($_POST["hnr_download_trigger"])) ? $hnr_download_trigger=(float)0+$_POST["hnr_download_trigger"] : $hnr_download_trigger=0;
        (isset($_POST["hnr_dl_tr_type"]) && !empty($_POST["hnr_dl_tr_type"]) && is_numeric($_POST["hnr_dl_tr_type"])) ? $hnr_dl_tr_type=(int)0+$_POST["hnr_dl_tr_type"] : $hnr_dl_tr_type=0;
        (isset($_POST["hnr_bl"]) && !empty($_POST["hnr_bl"]) && is_numeric($_POST["hnr_bl"])) ? $hnr_bl=(int)0+$_POST["hnr_bl"] : $hnr_bl=0;
        (isset($_POST["hnr_bl_count"]) && !empty($_POST["hnr_bl_count"]) && is_numeric($_POST["hnr_bl_count"])) ? $hnr_bl_count=(int)0+$_POST["hnr_bl_count"] : $hnr_bl_count=0;
        (isset($_POST["hnr_fp"]) && !empty($_POST["hnr_fp"]) && is_numeric($_POST["hnr_fp"])) ? $hnr_fp=(int)0+$_POST["hnr_fp"] : $hnr_fp=0;
        (isset($_POST["hnr_fp_id"]) && !empty($_POST["hnr_fp_id"]) && is_numeric($_POST["hnr_fp_id"])) ? $hnr_fp_id=(int)0+$_POST["hnr_fp_id"] : $hnr_fp_id=0;

        if($hnr_rank<2)
            stderr($language["ERROR"],$language["HNR_YMSAR"]);
        if($hnr_method==0 || $hnr_method>4)
            stderr($language["ERROR"],$language["HNR_YMSAM"]);

        if($hnr_method==1 && ($hnr_seeding_trigger==0 || $hnr_seeding_type==0))
            stderr($language["ERROR"],$language["HNR_YMSAMST"]);
        elseif($hnr_method==2 && $hnr_ratio_trigger==0)
            stderr($language["ERROR"],$language["HNR_YMSAMR"]);
        elseif(($hnr_method==3 || $hnr_method==4) && ($hnr_seeding_trigger==0 || ($hnr_seeding_type==0 || $hnr_seeding_type>2) || $hnr_ratio_trigger==0))
            stderr($language["ERROR"],$language["HNR_YMSAMSTAAMR"]);

        if(($hnr_tolerance_type==0 || $hnr_tolerance_type>2) || $hnr_tolerance==0)
            stderr($language["ERROR"], $language["HNR_YMSAT"]);
        if(($hnr_dl_tr_type==0 || $hnr_dl_tr_type>5) || $hnr_download_trigger==0)
            stderr($language["ERROR"], $language["HNR_YMSADT"]);

        if($hnr_bl>1 || ($hnr_bl==1 && $hnr_bl_count==0))
            stderr($language["ERROR"], $language["HNR_YMSAVFBL"]);
        if($hnr_fp>1 || ($hnr_fp==1 && $hnr_fp_id==0))
            stderr($language["ERROR"], $language["HNR_BFID"]);

        if($hnr_method==2)
        {
            $hnr_method="ratio_only";
            $hnr_seeding_trigger=0;
        }
        elseif($hnr_method==3)
            $hnr_method="seed_or_ratio";
        elseif($hnr_method==4)
            $hnr_method="seed_and_ratio";
        else
        {
            $hnr_method="seed_only";
            $hnr_ratio_trigger=0;
        }

        if($hnr_seeding_type==2)
            $hnr_seeding_trigger=floor($hnr_seeding_trigger*24);

        if($hnr_tolerance_type==2)
            $hnr_tolerance=floor($hnr_tolerance*24);

        if($hnr_dl_tr_type==2)
            $hnr_download_trigger=floor($hnr_download_trigger*1024);
        elseif($hnr_dl_tr_type==3)
            $hnr_download_trigger=floor($hnr_download_trigger*1048576);
        elseif($hnr_dl_tr_type==4)
            $hnr_download_trigger=floor($hnr_download_trigger*1073741824);
        elseif($hnr_dl_tr_type==5)
            $hnr_download_trigger=floor($hnr_download_trigger*1099511627776);

        if($hnr_bl!=1)
            $hnr_bl_count=0;
        if($hnr_fp!=1)
            $hnr_fp_id=0;
    
        quickQuery("INSERT INTO `{$TABLE_PREFIX}hnr` (`id_level`, `method`, `min_seed_hours`, `min_ratio`, `tolerance_hours`, `dl_trig_bytes`, `block_leech`,`forum_post`) VALUES (".$hnr_rank.", '".$hnr_method."', ".$hnr_seeding_trigger.", '".$hnr_ratio_trigger."', ".$hnr_tolerance.", ".$hnr_download_trigger.", ".$hnr_bl_count.", ".$hnr_fp_id.")", true);

        $userlist="";
        $res=get_result("SELECT `id` FROM `{$TABLE_PREFIX}users` WHERE `id_level`=".$hnr_rank, true, $btit_settings["cache_duration"]);
        if(count($res)>0)
        {
            foreach($res as $row)
            {
                $userlist.=$row["id"].",";
            }
            $userlist=trim($userlist, ",");
            quickQuery("UPDATE `".(($XBTT_USE)?"xbt_files_users":"{$TABLE_PREFIX}history")."` SET hitchecked='-1', hit='no' WHERE `hitchecked`!=1 AND `uid` IN(".$userlist.")",true);
        }
        redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=hitrun");
    }
}

?>