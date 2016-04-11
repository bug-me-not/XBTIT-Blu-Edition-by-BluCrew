<?php
if(!defined("IN_BTIT"))
    die("non direct access!");
if(!defined("IN_ACP"))
    die("non direct access!");

if(isset($_POST) && !empty($_POST))
{
    $ibd_forumid=(isset($_POST["forumid"]) && is_numeric($_POST["forumid"])) ? (int)0+$_POST["forumid"]: 0;
    $ibd_topicid=(isset($_POST["ibd_topicid"]) && is_numeric($_POST["ibd_topicid"])) ? (int)0+$_POST["ibd_topicid"]: 0;
    if($ibd_forumid==0 && $ibd_topicid>0)
    {
        stderr($language["ERROR"], $language["IBD_NEED_BOTH"]);
    }
    elseif($ibd_forumid>0 && $ibd_topicid>0)
    {
        if(substr($FORUMLINK, 0, 3)=="smf")
        {
            $res=get_result("SELECT `id_topic` FROM `{$db_prefix}topics` WHERE `id_topic`=".$ibd_topicid." AND `id_board`=".$ibd_forumid, true, $btit_settings["cache_duration"]);
        }
        elseif($FORUMLINK=="ipb")
        {
            $res=get_result("SELECT `tid` FROM `{$ipb_prefix}topics` WHERE `tid`=".$ibd_topicid." AND `forum_id`=".$ibd_forumid, true, $btit_settings["cache_duration"]);
        }
        else
        {
            $res=get_result("SELECT `id` FROM `{$TABLE_PREFIX}topics` WHERE `id`=".$ibd_topicid." AND `forumid`=".$ibd_forumid, true, $btit_settings["cache_duration"]);
        }
        if(count($res)==0)
        {
            stderr($language["ERROR"], $language["IBD_TOPICID_NOT_FOUND"]);
        }
    }
    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `made_intro`=1");
    quickQuery("DELETE FROM `{$TABLE_PREFIX}settings` WHERE `key` LIKE 'ibd_%'", true);
    quickQuery("INSERT INTO `{$TABLE_PREFIX}settings` (`key`, `value`) VALUES ('ibd_forumid', '".$ibd_forumid."'), ('ibd_topicid', '".$ibd_topicid."');", true);

    foreach(glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
    success_msg($language["SUCCESS"], $language["IBD_SUCCESS_MSG"]." <a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=groups&action=read'>".$language["HERE"]."</a>.");
}

$admintpl->set("ibd_topicid", $btit_settings["ibd_topicid"]);
$admintpl->set("select_forum", get_forum_list($btit_settings["ibd_forumid"], 0, false, false));
$admintpl->set("uid", $CURUSER["uid"]);
$admintpl->set("random", $CURUSER["random"]);
$admintpl->set("language", $language);
?>