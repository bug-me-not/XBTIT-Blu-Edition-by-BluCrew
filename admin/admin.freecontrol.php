<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if (!defined("IN_ACP"))
    die("non direct access!");



$action = $_GET['action'];
$returnto = "index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=free";

if($action == 'send')
{
    $expire_date = $_POST['expire_date'];
    $expire_time = $_POST['expire_time'];
    $DT1 = $expire_date." ".$expire_time.":00:00";
    $DT2 = $_POST["free"]?"yes":"no";
    $DT3 = $_POST["happy"]?"yes":"no";
    if($DT3=="yes")
    {
        $DT1="0000-00-00 00:00:00";
        $DT2="no";
        if(isset($_POST["free"]))
            unset($_POST["free"]);
    }
    quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `free_expire_date`='".$DT1."',`free`='".$DT2."',`happy_hour`='".$DT3."' WHERE `external`='no'", true);
    do_sqlquery("ALTER TABLE `{$TABLE_PREFIX}files` CHANGE `free` `free` ENUM( 'yes', 'no' ) NULL DEFAULT '".$DT2."'") or sqlerr();

    $DTxbtt = $_POST["free"]?"0":"100";
    if($btit_settings["fmhack_gold_and_silver_torrents"]=="enabled" && $DTxbtt==100 && $XBTT_USE)
    {
        $goldres=do_sqlquery("SELECT `gold_percentage`, `silver_percentage`, `bronze_percentage` FROM `{$TABLE_PREFIX}gold` WHERE `id`=1");
        $goldrow=$goldres->fetch_assoc();
        $res = do_sqlquery("SELECT `gold`, `info_hash` FROM `{$TABLE_PREFIX}files` WHERE `external`='no'", true);
        $restore_classic="";
        $restore_gold="";
        $restore_silver="";
        $restore_bronze="";
        while($row = $res->fetch_array())
        {
            if($row["gold"]==0)
                $restore_classic.="0x".$row["info_hash"].",";
            elseif($row["gold"]==1)
                $restore_silver.="0x".$row["info_hash"].",";
            if($row["gold"]==2)
                $restore_classic.="0x".$row["info_hash"].",";
            elseif($row["gold"]==3)
                $restore_silver.="0x".$row["info_hash"].",";
        }
        $restore_classic=trim($restore_classic,",");
        $restore_gold=trim($restore_gold,",");
        $restore_silver=trim($restore_silver,",");
        $restore_bronze=trim($restore_bronze,",");

        if($restore_classic!="")
            quickQuery("UPDATE `xbt_files` SET `down_multi`=100, `flags`=2 WHERE `info_hash` IN(".$restore_classic.")");
        if($goldrow["gold_percentage"]>0 && $restore_gold!="")
            quickQuery("UPDATE `xbt_files` SET `down_multi`='".$goldrow["gold_percentage"]."', `flags`=2 WHERE `info_hash` IN(".$restore_gold.")");
        if($restore_silver!="")
            quickQuery("UPDATE `xbt_files` SET `down_multi`='".$goldrow["silver_percentage"]."', `flags`=2 WHERE `info_hash` IN(".$restore_silver.")");
        if($restore_bronze!="")
            quickQuery("UPDATE `xbt_files` SET `down_multi`='".$goldrow["bronze_percentage"]."', `flags`=2 WHERE `info_hash` IN(".$restore_bronze.")");
        do_sqlquery("ALTER TABLE `xbt_files` CHANGE `down_multi` `down_multi` INT NULL DEFAULT '100'",true);
    }
    elseif($btit_settings["fmhack_gold_and_silver_torrents"]=="disabled" && $DTxbtt==100 && $XBTT_USE)
    {
        quickQuery("UPDATE `xbt_files` SET `down_multi`=100, `flags`=2");
        do_sqlquery("ALTER TABLE `xbt_files` CHANGE `down_multi` `down_multi` INT NULL DEFAULT '100'",true);
    }
    elseif($DTxbtt==0 && $XBTT_USE)
    {
        quickQuery("UPDATE `xbt_files` SET `down_multi`=0, `flags`=2");
        do_sqlquery("ALTER TABLE `xbt_files` CHANGE `down_multi` `down_multi` INT NULL DEFAULT '0'",true);
    }

    header("Location: $BASEURL/$returnto");
}
else
{
    $query = do_sqlquery("SELECT `free_expire_date`, `free`, `happy_hour` FROM `{$TABLE_PREFIX}files` WHERE `external`='no'", true);
    $row = $query->fetch_array();

    $admintpl->set("language",$language);
    $admintpl->set("expire_date", substr($row["free_expire_date"], 0 , -9));
    $admintpl->set("expire_time", substr($row["free_expire_date"], -8, -6));
    $admintpl->set("frm_action", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=free&amp;action=send");
    $admintpl->set("free_checked", ($row["free"]=="yes"?"checked=\"checked\"":""));
    $admintpl->set("happy_checked", ($row["happy_hour"]=="yes"?"checked=\"checked\"":""));
}

?>
