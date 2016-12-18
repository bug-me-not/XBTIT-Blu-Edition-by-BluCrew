<?php
require_once ("include/functions.php");
require_once ("include/config.php");
dbconn();
session_name("BluRG");
session_start();
global $CURUSER, $FORUMLINK, $db_prefix, $btit_settings, $XBTT_USE, $ipb_prefix, $THIS_BASEPATH, $TABLE_PREFIX, $CACHE_DURATION, $smilies, $privatesmilies, $BASEURL;
if(!isset($THIS_BASEPATH) || empty($THIS_BASEPATH))
    $THIS_BASEPATH = dirname(__file__);
if($btit_settings["fmhack_SEO_panel"] == "enabled")
{
    $active_seo_sb = get_result("SELECT `activated_user`, `str`, `strto` FROM `{$TABLE_PREFIX}seo` WHERE `id`='1'", true, $btit_settings["cache_duration"]);
    $res_seo_sb = $active_seo_sb[0];
}
require_once (load_language("lang_main.php"));
if(!isset($language["SYSTEM_USER"]))
    $language["SYSTEM_USER"]="System";
if($CURUSER["uid"] > 1)
{
    (isset($_GET["id"]))?$id = sql_esc($_GET['id']):$id = "";
    $uid = $CURUSER["uid"];
    $u = $CURUSER["seedbonus"];
    if($id == "vip")
    {
        if($u < $GLOBALS["price_vip"] || $CURUSER["edit_torrents"] == "yes")
        {
            header("Location: index.php?page=modules&module=seedbonus");
        }
        else
        {
            if($btit_settings["fmhack_timed_ranks"] == "enabled" && $btit_settings["vip_timeframe"] > 0)
            {
                $expire_date = date("Y-m-d H:i:s", (time() + ($btit_settings["vip_timeframe"] * 86400)));
            }
            $querymod = "";
            $queryjoin = "";
            if($btit_settings["fmhack_VIP_freeleech"] == "enabled")
            {
                $res = get_result("SELECT `freeleech` FROM `{$TABLE_PREFIX}users_level` WHERE `id`=5", true, $btit_settings["cache_duration"]);
                if(count($res) > 0)
                {
                    if($CURUSER["freeleech"] == "no" && $res[0]["freeleech"] == "yes")
                        $querymod .= "`u`.`vipfl_down`=".$CURUSER["downloaded"].", `u`.`vipfl_date`=UNIX_TIMESTAMP(),";
                    elseif($CURUSER["freeleech"] == "yes" && $res[0]["freeleech"] == "no")
                        $querymod .= "`u`.`vipfl_down`=0, `u`.`vipfl_date`=0,";
                }
            }
            if(($btit_settings["fmhack_torrents_limit"] == "enabled" || $btit_settings["fmhack_enhanced_wait_time"] == "enabled" || $btit_settings["fmhack_VIP_freeleech"]=="enabled") && $XBTT_USE)
            {
                $queryjoin .= "LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON 5=`ul`.`id` ";
                $queryjoin .= "LEFT JOIN `xbt_users` `xu` ON `u`.`id`=`xu`.`uid` ";
                $querymod .= (($btit_settings["fmhack_torrents_limit"] == "enabled")?"`u`.`custom_torr_limit`='no', `xu`.`torrents_limit`=`ul`.`torrents_limit`,":"").(($btit_settings["fmhack_enhanced_wait_time"] == "enabled")?"`u`.`custom_wait_time`='no', `xu`.`wait_time`=IF(`ul`.`WT`>0,(`ul`.`WT`*3600),0),":"").(($btit_settings["fmhack_VIP_freeleech"]=="enabled")?"`u`.`vipfl_down`=IF(`ul`.`freeleech`='yes', `xu`.`downloaded`, '0'), `u`.`vipfl_date`=IF(`ul`.`freeleech`='yes', UNIX_TIMESTAMP(), '0'),":"");
            }
            quickQuery("UPDATE `{$TABLE_PREFIX}users` `u` ".$queryjoin." SET ".$querymod." `u`.`id_level`=5, `u`.`seedbonus`=`u`.`seedbonus`-".$GLOBALS["price_vip"]." ".(($btit_settings["fmhack_timed_ranks"] == "enabled" && $btit_settings["vip_timeframe"] > 0)?", `u`.`rank_switch`='yes', `u`.`old_rank`=".$CURUSER["id"].", `u`.`timed_rank`='".$expire_date."'":"")."WHERE `u`.`id`=".$uid);
            $_SESSION["CURUSER"]["id"] = 5;
            $_SESSION["CURUSER"]["id_level"] = 5;
            $_SESSION["CURUSER"]["seedbonus"] -= $GLOBALS["price_vip"];
            if(substr($FORUMLINK, 0, 3) == "smf" || $FORUMLINK == "ipb")
                $vip_mirror = get_result("SELECT ".((substr($FORUMLINK, 0, 3) == "smf")?"`smf_group_mirror`":"`ipb_group_mirror`")." FROM `{$TABLE_PREFIX}users_level` WHERE `id`=5");
            if(substr($FORUMLINK, 0, 3) == "smf" && count($vip_mirror) == 1)
                quickQuery("UPDATE `{$db_prefix}members` SET ".(($FORUMLINK == "smf")?"`ID_GROUP`":"`id_group`")."=".(($vip_mirror[0]["smf_group_mirror"] > 0)?$vip_mirror[0]["smf_group_mirror"]:15)." WHERE ".(($FORUMLINK == "smf")?"`ID_MEMBER`":"`id_member`")."=".$CURUSER["smf_fid"]);
            elseif($FORUMLINK == "ipb" && count($vip_mirror) == 1)
                quickQuery("UPDATE `{$ipb_prefix}members` SET `member_group_id`=".(($vip_mirror[0]["ipb_group_mirror"] > 0)?$vip_mirror[0]["ipb_group_mirror"]:5)." WHERE `member_id`=".$CURUSER["ipb_fid"]);
            if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_bonus"] == "enabled")
            {
                if(isset($CURUSER["user_notes"]) && !empty($CURUSER["user_notes"]))
                    $usernotes = unserialize(unesc($CURUSER["user_notes"]));
                else
                    $usernotes = array();
                $usernotes[] = base64_encode("[b]".$CURUSER["username"]."[/b] ".$language["UN_BONUS_GENERAL_1"]." [b]".$GLOBALS["price_vip"]."[/b] ".$language["UN_BONUS_GENERAL_2"]." [b]".$language["UN_VIP_RANK"]."[/b]<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                $new_notes = serialize($usernotes);
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$uid);
            }
            header("Location: index.php?page=modules&module=seedbonus");
        }
        die();
    }
    elseif(substr($id, 0, 3) == "inv")
    {
        if($id == "inv")
        {
            if($u < $GLOBALS["price_inv"])
            {
                header("Location: index.php?page=modules&module=seedbonus");
            }
            else
            {
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `invitations`=`invitations`+1, `seedbonus`=`seedbonus`-".$GLOBALS["price_inv"]." WHERE `id`=$uid");
                $_SESSION["CURUSER"]["invitiations"] += 1;
                $_SESSION["CURUSER"]["seedbonus"] -= $GLOBALS["price_inv"];
                if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_bonus"] == "enabled")
                {
                    if(isset($CURUSER["user_notes"]) && !empty($CURUSER["user_notes"]))
                        $usernotes = unserialize(unesc($CURUSER["user_notes"]));
                    else
                        $usernotes = array();
                    $usernotes[] = base64_encode("[b]".$CURUSER["username"]."[/b] ".$language["UN_BONUS_GENERAL_1"]." [b]".$GLOBALS["price_inv"]."[/b] ".$language["UN_BONUS_GENERAL_2"]." [b]".$language["UN_ONE_INV"]."[/b]<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                    $new_notes = serialize($usernotes);
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$uid);
                }
                header("Location: index.php?page=modules&module=seedbonus");
            }
            die();
        }
        elseif($id == "inv3")
        {
            if($u < $GLOBALS["price_inv3"])
            {
                header("Location: index.php?page=modules&module=seedbonus");
            }
            else
            {
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `invitations`=`invitations`+3, `seedbonus`=`seedbonus`-".$GLOBALS["price_inv3"]." WHERE `id`=$uid");
                $_SESSION["CURUSER"]["invitiations"] += 3;
                $_SESSION["CURUSER"]["seedbonus"] -= $GLOBALS["price_inv3"];
                if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_bonus"] == "enabled")
                {
                    if(isset($CURUSER["user_notes"]) && !empty($CURUSER["user_notes"]))
                        $usernotes = unserialize(unesc($CURUSER["user_notes"]));
                    else
                        $usernotes = array();
                    $usernotes[] = base64_encode("[b]".$CURUSER["username"]."[/b] ".$language["UN_BONUS_GENERAL_1"]." [b]".$GLOBALS["price_inv3"]."[/b] ".$language["UN_BONUS_GENERAL_2"]." [b]".$language["UN_THREE_INV"]."[/b]<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                    $new_notes = serialize($usernotes);
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$uid);
                }
                header("Location: index.php?page=modules&module=seedbonus");
            }
            die();
        }
        elseif($id == "inv5")
        {
            if($u < $GLOBALS["price_inv5"])
            {
                header("Location: index.php?page=modules&module=seedbonus");
            }
            else
            {
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `invitations`=`invitations`+5, `seedbonus`=`seedbonus`-".$GLOBALS["price_inv5"]." WHERE `id`=$uid");
                $_SESSION["CURUSER"]["invitiations"] += 5;
                $_SESSION["CURUSER"]["seedbonus"] -= $GLOBALS["price_inv5"];
                if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_bonus"] == "enabled")
                {
                    if(isset($CURUSER["user_notes"]) && !empty($CURUSER["user_notes"]))
                        $usernotes = unserialize(unesc($CURUSER["user_notes"]));
                    else
                        $usernotes = array();
                    $usernotes[] = base64_encode("[b]".$CURUSER["username"]."[/b] ".$language["UN_BONUS_GENERAL_1"]." [b]".$GLOBALS["price_inv5"]."[/b] ".$language["UN_BONUS_GENERAL_2"]." [b]".$language["UN_FIVE_INV"]."[/b]<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                    $new_notes = serialize($usernotes);
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$uid);
                }
                header("Location: index.php?page=modules&module=seedbonus");
            }
            die();
        }
    }
    elseif($id == "sb_gift")
    {
        $approval_code = (isset($_POST["approval_code"])) ? $_POST["approval_code"] : false;
        if(!$approval_code || $approval_code != substr(sha1($CURUSER["random"].$CURUSER["username"].$CURUSER["random"]),20,6))
        {
            header("Location: index.php");
            die();
        }
        (isset($_POST["gift_user"]) && !empty($_POST["gift_user"]) && strlen($_POST["gift_user"] <= 40) && strtolower($_POST["gift_user"]) != "guest" && strtolower($_POST["gift_user"]) != strtolower($CURUSER["username"]))?$gift_user = sql_esc($_POST["gift_user"]):$gift_user = "";
        (isset($_POST["gift_points"]) && !empty($_POST["gift_points"]) && is_numeric($_POST["gift_points"]) && $_POST["gift_points"] > 0)?$gift_points = (float)0 + $_POST["gift_points"]:$gift_points = 0;
        if($gift_user == "" || $gift_points == 0)
            die($language["BAD_DATA"]);
        if($gift_points > $CURUSER["seedbonus"])
            die($language["GIFT_NOT_ENOUGH"]);
        if($gift_points > $btit_settings["bonus_giftmax"])
            die($language["GIFT_TOO_BIG"]." ".$btit_settings["bonus_giftmax"]." ".(($btit_settings["bonus_giftmax"] == 1)?$language["BONUS_INFO4a"]:$language["BONUS_INFO4"]).".");
        $res = do_sqlquery("SELECT `id`, `username`".(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_bonus"] == "enabled")?", `user_notes`":"")." FROM `{$TABLE_PREFIX}users` WHERE `username`='".$gift_user."'", true);
        if(@sql_num_rows($res) == 0)
            die($language["GIFT_USER_NOT_FOUND"]);
        else
        {
            $row = $res->fetch_assoc();
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=`seedbonus`+'".$gift_points."' WHERE `id`=".$row["id"], true);
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=`seedbonus`-'".$gift_points."' WHERE `id`=".$CURUSER["uid"], true);
            $_SESSION["CURUSER"]["seedbonus"] -= $gift_points;
            $msg1 = "[url=".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo_sb["activated_user"] == "true")?$CURUSER["uid"]."_".strtr($CURUSER["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$CURUSER["uid"])."]".$CURUSER["username"]."[/url]"." ".$language["GIFT_PM_REC_1"]." ".$gift_points." ".$language["GIFT_PM_REC_2"].$language["GIFT_PM_SYS"];
            $msg2 = $language["GIFT_PM_SEND_1"]." [url=".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo_sb["activated_user"] == "true")?$row["id"]."_".strtr($row["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$row["id"])."]".$row["username"]."[/url]"." ".$language["GIFT_PM_SEND_2"]." ".$gift_points." ".$language["GIFT_PM_SEND_3"]." [url=".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo_sb["activated_user"] == "true")?$row["id"]."_".strtr($row["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$row["id"])."]".$row["username"]."[/url]".$language["GIFT_PM_SEND_4"].$language["GIFT_PM_SYS"];
            if(substr($FORUMLINK, 0, 3) == "smf" || $FORUMLINK == "ipb")
            {
                reset($smilies);
                while(list($code, $url) = each($smilies))
                {
                    $msg1 = str_replace($code, "[img]".$BASEURL."/images/smilies/".$url."[/img]", $msg1);
                    $msg2 = str_replace($code, "[img]".$BASEURL."/images/smilies/".$url."[/img]", $msg2);
                }
                reset($privatesmilies);
                while(list($code, $url) = each($privatesmilies))
                {
                    $msg1 = str_replace($code, "[img]".$BASEURL."/images/smilies/".$url."[/img]", $msg1);
                    $msg2 = str_replace($code, "[img]".$BASEURL."/images/smilies/".$url."[/img]", $msg2);
                }
            }
            send_pm(0, $row["id"], sqlesc($language["GIFT_PM_SUBJ_1"]), sqlesc($msg1));
            send_pm(0, $CURUSER["uid"], sqlesc($language["GIFT_PM_SUBJ_2"]), sqlesc($msg2));
            if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_bonus"] == "enabled")
            {
                if(isset($CURUSER["user_notes"]) && !empty($CURUSER["user_notes"]))
                    $usernotes = unserialize(unesc($CURUSER["user_notes"]));
                else
                    $usernotes = array();
                if(isset($row["user_notes"]) && !empty($row["user_notes"]))
                    $usernotes2 = unserialize(unesc($row["user_notes"]));
                else
                    $usernotes2 = array();
                $usernotes[] = base64_encode("[b]".$CURUSER["username"]."[/b] ".$language["UN_GIFT_SEND_1"]." [b]".$row["username"]."[/b] ".$language["UN_GIFT_SEND_2"]." [b]".$gift_points."[/b] ".$language["UN_GIFT_SEND_3"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                $usernotes2[] = base64_encode("[b]".$row["username"]."[/b] ".$language["UN_GIFT_REC_1"]." [b]".$gift_points."[/b] ".$language["UN_GIFT_REC_2"]." [b]".$CURUSER["username"]."[/b].<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                $new_notes = serialize($usernotes);
                $new_notes2 = serialize($usernotes2);
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$uid);
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes2)."' WHERE `id`=".$row["id"]);
            }
            header("Location: index.php?page=modules&module=seedbonus");
        }
        die();
    }
    elseif($id == "hnr")
    {
        (isset($_POST["info_hash"]) && !empty($_POST["info_hash"]))?$info_hash = strtolower(preg_replace("/^a-zA-z0-9/", "", $_POST["info_hash"])):$info_hash = false;
        (isset($_POST["filename"]) && !empty($_POST["filename"]))?$filename = $_POST["filename"]:$filename = "";
        (isset($_POST["seo_filename"]) && !empty($_POST["seo_filename"]))?$seo_filename = $_POST["seo_filename"]:$seo_filename = "";
        (isset($_POST["id"]) && !empty($_POST["id"]) && is_numeric($_POST["id"]) && $_POST["id"] >= 1)?$id = (int)0 + $_POST["id"]:$id = false;
        if($info_hash !== false && strlen($info_hash) == 40)
        {
            if($btit_settings["price_hnr"] > $CURUSER["seedbonus"])
            {
                die($language["HNR_NOT_ENOUGH"]);
            }
            include ($THIS_BASEPATH."/language/english/lang_hnr_sanity.php");
            if($XBTT_USE)
                $res = get_result("SELECT(SELECT COUNT(*) FROM `xbt_files` `xf` LEFT JOIN `xbt_files_users` `xfu` ON `xf`.`fid`=`xfu`.`fid` WHERE `xfu`.`uid`=".$CURUSER["uid"]." AND `xf`.`info_hash`=0x".$info_hash." AND `xfu`.`hit`='yes' AND `xfu`.`hitchecked`=1) `hitcount`, (SELECT `warn_lev` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$CURUSER["uid"].") `warn_lev`, (SELECT `forum_post` FROM `{$TABLE_PREFIX}hnr` WHERE `id_level`=".$CURUSER["id_level"].") `forum_post`, (SELECT `hnr_count` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$CURUSER["uid"].") `hnr_count`, (SELECT `user_notes` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$CURUSER["uid"].") `user_notes`", true, $btit_settings["cache_duration"]);
            else
                $res = get_result("SELECT(SELECT COUNT(*) FROM `{$TABLE_PREFIX}history` WHERE `uid`=".$CURUSER["uid"]." AND `infohash`='".$info_hash."' AND `hit`='yes' AND `hitchecked`=1) `hitcount`, (SELECT `warn_lev` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$CURUSER["uid"].") `warn_lev`, (SELECT `forum_post` FROM `{$TABLE_PREFIX}hnr` WHERE `id_level`=".$CURUSER["id_level"].") `forum_post`, (SELECT `hnr_count` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$CURUSER["uid"].") `hnr_count`, (SELECT `user_notes` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$CURUSER["uid"].") `user_notes`", true, $btit_settings["cache_duration"]);
            if(count($res) == 1 && $res[0]["hitcount"] == 1 && $res[0]["warn_lev"] >= 1)
            {
                if($XBTT_USE)
                    quickQuery("UPDATE `xbt_files_users` `xfu` LEFT JOIN `xbt_files` `xf` ON `xfu`.`fid`=`xf`.`fid` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `xfu`.`uid`=`u`.`id` SET `u`.`warn_lev`=`u`.`warn_lev`-1, `u`.`warn_last`=".(($res[0]["warn_lev"] == 1)?"0":"UNIX_TIMESTAMP()").",".(($res[0]["hnr_count"] >= 1)?" `u`.`hnr_count`=`u`.`hnr_count`-1,":"")." `xfu`.`hit`='no', `xfu`.`hitchecked`='-1', `u`.`seedbonus`=`u`.`seedbonus`-".$btit_settings["price_hnr"]." WHERE `xfu`.`uid`=".$CURUSER["uid"]." AND `xf`.`info_hash`=0x".$info_hash, true);
                else
                    quickQuery("UPDATE `{$TABLE_PREFIX}history` `h` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `h`.`uid`=`u`.`id` SET `u`.`warn_lev`=`u`.`warn_lev`-1, `u`.`warn_last`=".(($res[0]["warn_lev"] == 1)?"0":"UNIX_TIMESTAMP()").",".(($res[0]["hnr_count"] >= 1)?" `u`.`hnr_count`=`u`.`hnr_count`-1,":"")." `h`.`hit`='no', `h`.`hitchecked`='-1', `u`.`seedbonus`=`u`.`seedbonus`-".$btit_settings["price_hnr"]." WHERE `h`.`uid`=".$CURUSER["uid"]." AND `h`.`infohash`='".$info_hash."'", true);
                $_SESSION["CURUSER"]["seedbonus"] -= $btit_settings["price_hnr"];
                $forum_subj = sqlesc($language["HNR_FORUM_SUBJ"]." ".$CURUSER["username"]);
                $forum_post = sqlesc($CURUSER["username"]." ".$language["HNR_FORUM_MSG_14"]." ".$btit_settings["price_hnr"]." ".$language["HNR_FORUM_MSG_15"]."\n\n"."[url=".$BASEURL."/".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated"] == "true")?$seo_filename."-".$id.".html":"index.php?page=torrent-details&id=".$info_hash)."]".$filename."[/url]");
                if($res[0]["forum_post"] > 0)
                {
                    if(substr($FORUMLINK, 0, 3) == "smf")
                    {
                        $old_topic = false;
                        $res2 = get_result("SELECT ".(($FORUMLINK == "smf")?"`ID_TOPIC`":"`id_topic`")." FROM `{$db_prefix}messages` WHERE ".(($FORUMLINK == "smf")?"`ID_BOARD`":"`id_board`")."=".$res[0]["forum_post"]." AND `subject`=".$forum_subj, true, $btit_settings["cache_duration"]);
                        if(count($res2) > 0)
                        {
                            $row = $res2[0];
                            $topicid = (($FORUMLINK == "smf")?$row["ID_TOPIC"]:$row["id_topic"]);
                            $old_topic = true;
                        }
                        else
                        {
                            quickQuery("INSERT INTO `{$db_prefix}topics` (".(($FORUMLINK == "smf")?"`ID_BOARD`, `ID_MEMBER_STARTED`":"`id_board`, `id_member_started`").") VALUES(".$res[0]["forum_post"].",0)", true);
                            $topicid = sql_insert_id();
                        }
                        if($FORUMLINK == "smf")
                            quickQuery("INSERT INTO `{$db_prefix}messages` (`ID_TOPIC`,`ID_BOARD`, `posterTime`, `ID_MEMBER`, `ID_MSG_MODIFIED`, `subject`, `posterName`, `posterEmail`, `posterIP`, `body`) VALUES($topicid,".$res[0]["forum_post"].",UNIX_TIMESTAMP(),0,$topicid,$forum_subj,'".sql_esc($language["SYSTEM_USER"])."','','127.0.0.1',$forum_post)", true);
                        else
                            quickQuery("INSERT INTO `{$db_prefix}messages` (`id_topic`,`id_board`, `poster_time`, `id_member`, `id_msg_modified`, `subject`, `poster_name`, `poster_email`, `poster_ip`, `body`) VALUES($topicid,".$res[0]["forum_post"].",UNIX_TIMESTAMP(),0,$topicid,$forum_subj,'".sql_esc($language["SYSTEM_USER"])."','','127.0.0.1',$forum_post)", true);
                        $postid = @sql_insert_id();
                        quickQuery("UPDATE `{$db_prefix}topics` SET ".(($FORUMLINK == "smf")?"`ID_FIRST_MSG`":"`id_first_msg`")."=$postid, ".(($FORUMLINK == "smf")?"`ID_LAST_MSG`":"`id_last_msg`")."=$postid WHERE ".(($FORUMLINK == "smf")?"`ID_BOARD`":"`id_board`")."=".$res[0]["forum_post"]." AND `ID_TOPIC`=$topicid", true);
                        quickQuery("UPDATE `{$db_prefix}boards` SET ".(($FORUMLINK == "smf")?"`ID_LAST_MSG`":"`id_last_msg`")."=$postid, ".(($FORUMLINK == "smf")?"`ID_MSG_UPDATED`":"`id_msg_updated`")."=$postid, ".(($old_topic === false)?(($FORUMLINK == "smf")?"`numTopics`=`numTopics`":"`num_topics`=`num_topics`")."+1, ":"").(($FORUMLINK == "smf")?"`numPosts`=`numPosts`":"`num_posts`=`num_posts`")."+1 WHERE ".(($FORUMLINK == "smf")?"`ID_BOARD`":"`id_board`")."=".$res[0]["forum_post"], true);
                        if($old_topic === false)
                            quickQuery("UPDATE `{$db_prefix}settings` SET `value`=`value`+1 WHERE `variable`='totalTopics'", true);
                        quickQuery("UPDATE `{$db_prefix}settings` SET `value`=`value`+1 WHERE `variable`='totalMessages'", true);
                    }
                    elseif($FORUMLINK == "ipb")
                        ipb_make_post($res[0]["forum_post"], $forum_subj, $forum_post);
                    else
                    {
                        $old_topic = false;
                        $res3 = get_result("SELECT `id` FROM `{$TABLE_PREFIX}topics` WHERE `forumid`=".$res[0]["forum_post"]." AND `subject`=".$forum_subj, true, $btit_settings["cache_duration"]);
                        if(count($res3) > 0)
                        {
                            $row2 = $res3[0];
                            $topicid = $row2["id"];
                            $old_topic = true;
                        }
                        else
                        {
                            quickQuery("INSERT INTO `{$TABLE_PREFIX}topics` (`userid`, `subject`, `forumid`) VALUES (0, ".$forum_subj.", ".$res[0]["forum_post"].")", true);
                            $topicid = sql_insert_id();
                        }
                        quickQuery("INSERT INTO `{$TABLE_PREFIX}posts` (`topicid`,`userid`, `added`, `body`) VALUES ($topicid, 0, UNIX_TIMESTAMP(), $forum_post)", true);
                        $postid = @sql_insert_id();
                        quickQuery("UPDATE `{$TABLE_PREFIX}topics` SET `lastpost`=$postid WHERE `forumid`=".$res[0]["forum_post"]." AND `id`=$topicid", true);
                        quickQuery("UPDATE `{$TABLE_PREFIX}forums` SET `postcount`=`postcount`+1".(($old_topic === false)?", `topiccount`=`topiccount`+1":"")." WHERE `id`=".$res[0]["forum_post"], true);
                    }
                }
                quickQuery("INSERT INTO `{$TABLE_PREFIX}warn_logs` (`uid`, `notes`, `contact`, `date_added`, `type`, `added_by`) VALUES (".$CURUSER["uid"].", ".$forum_post.", 'pm', UNIX_TIMESTAMP(), 'dec', '".sql_esc($language["SYSTEM_USER"])."')");
                $stage4=$btit_settings["warn_max"];
                $stage3=round($btit_settings["warn_max"]*0.75);
                $stage2=round($btit_settings["warn_max"]*0.5);
                $stage1=round($btit_settings["warn_max"]*0.25);
                $stage0=0;
                $warn_lev = ($res[0]["warn_lev"] - 1);
                if($warn_lev >= $stage4)
                    $wl = "[img]".$BASEURL."/images/warned/warn_max.png[/img] (".$warn_lev."/".$stage4.")";
                elseif($warn_lev >= $stage3)
                    $wl = "[img]".$BASEURL."/images/warned/warn_3.png[/img] (".$warn_lev."/".$stage4.")";
                elseif($warn_lev >= $stage2)
                    $wl = "[img]".$BASEURL."/images/warned/warn_2.png[/img] (".$warn_lev."/".$stage4.")";
                elseif($warn_lev >= $stage1)
                    $wl = "[img]".$BASEURL."/images/warned/warn_1.png[/img] (".$warn_lev."/".$stage4.")";
                else
                    $wl = "[img]".$BASEURL."/images/warned/warn_0.png[/img] (".$warn_lev."/".$stage4.")";
                send_pm(0, $CURUSER["uid"], sqlesc($language['WS_WC_SUBJ']), sqlesc($language['WS_WC_MSG'].":\n\n[quote]".str_replace("\\n", "\\\n", trim($forum_post, "'"))."[/quote]"."\n\n".$language["WS_YOUR_CUR_LEV"]."\n\n".$wl."\n\n".(($btit_settings["warn_auto_down_enable"] == "yes" && $row["warn_lev"] > 0)?$language["WS_DEC_IN_DAYS_1"]." ".$btit_settings["warn_auto_decrease"]." ".$language["WS_DEC_IN_DAYS_2"]."\n\n":"").$language["WS_AUTO_MSG"]."\n"));
                if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled")
                {
                    if(isset($res[0]["user_notes"]) && !empty($res[0]["user_notes"]))
                        $usernotes = unserialize(unesc($res[0]["user_notes"]));
                    else
                        $usernotes = array();
                    $usernotes[] = base64_encode($language["UN_WLEV_DEC"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                    $new_notes = serialize($usernotes);
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$CURUSER["uid"]);
                }
            }
        }
        header("Location: index.php?page=modules&module=seedbonus");
    }
    elseif($id == "flslot")
    {
        if($btit_settings["bonus_flslot"] > $CURUSER["seedbonus"])
        {
            die($language["FLS_NOT_ENOUGH"]);
        }
        else
        {
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=`seedbonus`-".$btit_settings["bonus_flslot"].", `freeleech_slots`=`freeleech_slots`+1 WHERE `id`=".$CURUSER["uid"]);
            $_SESSION["CURUSER"]["seedbonus"] -= $btit_settings["bonus_flslot"];
        }
        header("Location: index.php?page=modules&module=seedbonus");
    }
    if(is_null($id) || !is_numeric($id) || $CURUSER["view_torrents"] == "no")
    {
        header("Location: index.php");
    }
    $id=(int)0+$_GET["id"];
    $r = get_result("SELECT `points`, `traffic` FROM `{$TABLE_PREFIX}bonus` WHERE `id`='$id'");
    if(count($r) > 0)
    {
        $p = $r[0]["points"];
        $t = $r[0]["traffic"];
        if($u < $p)
        {
            header("Location: index.php?page=modules&module=seedbonus");
        }
        else
        {
            if($XBTT_USE)
            {
                quickQuery("UPDATE `xbt_users` SET `uploaded`=`uploaded`+".$t." WHERE `uid`=".$uid);
            }
            @quickQuery("UPDATE `{$TABLE_PREFIX}users` SET ".(($XBTT_USE)?"":"`uploaded`=`uploaded`+".$t.",")."`seedbonus`=`seedbonus`-".$p." WHERE `id`=".$uid);
            $_SESSION["CURUSER"]["uploaded"] += $t;
            $_SESSION["CURUSER"]["seedbonus"] -= $p;
            if($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_bonus"] == "enabled")
            {
                if(isset($CURUSER["user_notes"]) && !empty($CURUSER["user_notes"]))
                    $usernotes = unserialize(unesc($CURUSER["user_notes"]));
                else
                    $usernotes = array();
                $usernotes[] = base64_encode("[b]".$CURUSER["username"]."[/b] ".$language["UN_BONUS_GENERAL_1"]." [b]".(int)$p."[/b] ".$language["UN_BONUS_GENERAL_2"]." [b]".makesize($t)."[/b] ".$language["UN_UL_CREDIT"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                $new_notes = serialize($usernotes);
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$uid);
            }
        }
    }
    header("Location: index.php?page=modules&module=seedbonus");
}
else
    header("Location: index.php");

?>
