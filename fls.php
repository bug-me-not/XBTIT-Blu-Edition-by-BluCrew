<?php
if(!defined("IN_BTIT"))
    die("non direct access!");


session_name("BluRG");
session_start();

$info_hash = (isset($_GET["id"]) && !empty($_GET["id"]))?strtolower(preg_replace("/[^A-Fa-f0-9]/", "", $_GET["id"])):false;
$confirm = (isset($_GET["confirm"]) && !empty($_GET["confirm"]) && $_GET["confirm"] == "yes")?"yes":"no";
if(!$info_hash || strlen($info_hash) != 40)
{
    stderr($language["ERROR"], $language["BAD_ID"]);
}
else
{
    if($confirm == "yes")
    {
        $currentFreeleechTorrents = ((isset($CURUSER["freeleech_slot_hashes"]) && !empty($CURUSER["freeleech_slot_hashes"]))?explode(",", $CURUSER["freeleech_slot_hashes"]):array());
        if(count($currentFreeleechTorrents) > 0)
        {
            if(in_array($id, $currentFreeleechTorrents))
                stderr($language["ERROR"], $language["FLS_ALREADY_HAVE"]);
        }
        if(!isset($CURUSER["freeleech_slots"]) || $CURUSER["freeleech_slots"] == 0)
        {
            stderr($language["ERROR"], $language["FLS_NONE_REMAINING"]);
        }
        $res = get_result("SELECT `filename`, `free`, `gold` FROM `{$TABLE_PREFIX}files` WHERE `info_hash`='".$info_hash."'", true, $btit_settings["cache_duration"]);
        if(count($res) > 0)
        {
            $data = $res[0];
            $freeByOtherMeans = ((($btit_settings["fmhack_gold_and_silver_torrents"] && isset($data["gold"]) && $data["gold"] == 2) || ($btit_settings["fmhack_free_leech_with_happy_hour"] && isset($data["free"]) &&
                $data["free"] == "yes") || ($btit_settings["fmhack_VIP_freeleech"] == "enabled" && $CURUSER["freeleech"] == "yes"))?true:false);
            if($freeByOtherMeans)
            {
                stderr($language["ERROR"], $language["FLS_FREE_BY_OTHER"]);
            }
            $newflsList=sql_esc(((empty($CURUSER["freeleech_slot_hashes"]))?"":$CURUSER["freeleech_slot_hashes"].",").$info_hash);
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `freeleech_slots`=`freeleech_slots`-1, `freeleech_slot_hashes`='".$newflsList."' WHERE `id`=".$CURUSER["uid"], true);
            #unset($_SESSION["CURUSER"], $_SESSION["CURUSER_EXPIRE"]);
            success_msg($language["SUCCESS"],$language["FLS_USED_SLOT1"]." <b>".$data["filename"]."</b> ".$language["FLS_USED_SLOT2"].".<br /><br /><a href='index.php?page=torrents'>".$language["FLS_USED_SLOT3"]."</a>");
        }
        else
            stderr($language["ERROR"], $language["TB_NO_TORR_EXISTS"]);
    }
    else
    {
        information_msg($language["FLS_PLS_CONFIRM"], $language["FLS_R_U_SURE1"]." <b>".$CURUSER["freeleech_slots"]."</b> ".$language["FLS_R_U_SURE2".(($CURUSER["freeleech_slots"]==1)?"A":"B")]."<br /><br /><a href='index.php?page=fls&id=".$info_hash."&confirm=yes'>".$language["YES"]. "</a> | <a href='javascript: history.go(-1);'>".$language["NO"]."</a>");
    }
}

?>
