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
function do_sanity($ts = 0)
{

// SeedBonus (BON) Multiplier
$multie=$btit_settings["multie"]*$GLOBALS["bonus"];
    if ($XBTT_USE) {
        $ressb = do_sqlquery("SELECT uid FROM xbt_files_users as u INNER JOIN xbt_files as x ON u.fid=x.fid WHERE u.left = '0' AND x.flags='0' AND u.active='1'");
        if (sql_num_rows($ressb) > 0) {
            while ($arrsb=$ressb->fetch_assoc()) {
                $x=$arrsb["uid"];
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=`seedbonus`+'".number_format((((($ts>0)?(time()-$ts):$clean_interval)/3600)*$multie), 6, ".", "")."' WHERE `id` = '$x'");
            }
        }
    } else {
        $ressb = do_sqlquery("SELECT pid FROM {$TABLE_PREFIX}peers WHERE status = 'seeder'");
        if (sql_num_rows($ressb) > 0) {
            while ($arrsb=$ressb->fetch_assoc()) {
                $x=$arrsb['pid'];
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=`seedbonus`+'".number_format((((($ts>0)?(time()-$ts):$clean_interval)/3600)*$multie), 6, ".", "")."' WHERE `pid`= '$x'");
            }
        }
    }
// SeedBonus (BON) Multiplier

    // Lets try upping the max_execution_time and memory_limit if we can
    if (@ini_get("max_execution_time") < 300) {
        @ini_set("max_execution_time", 300);
    }
    if (trim(@ini_get("memory_limit"), "M") < 128) {
        @ini_set("memory_limit", "128M");
    }
    global $BASEURL, $PRIVATE_ANNOUNCE, $TORRENTSDIR, $CAPTCHA_FOLDER, $CURRENTPATH, $LIVESTATS, $LOG_HISTORY, $TABLE_PREFIX, $btit_settings, $clean_interval, $XBTT_USE, $THIS_BASEPATH, $FORUMLINK, $db_prefix, $INV_EXPIRES, $ipb_prefix, $SITENAME, $reload_cfg_interval, $kisfig;
    if (!isset($THIS_BASEPATH) || empty($THIS_BASEPATH)) {
        $THIS_BASEPATH = str_replace(array("/include", "\\include"), "", dirname(__FILE__));
        $THIS_BASEPATH = str_replace("\\", "/", $THIS_BASEPATH);
    }
    // As there is no specific user to tie the language to we need to generate a
    // language array for each language and then we'll use the correct one later.
    include($THIS_BASEPATH."/language/english/lang_main.php");
    if ($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled") {
        include($THIS_BASEPATH."/language/english/lang_hnr_sanity.php");
    }
    if ($btit_settings["fmhack_forum_auto_topic"] == "enabled") {
        include($THIS_BASEPATH."/language/english/lang_admin.php");
    }
    $lang_english = $language;
    $res = do_sqlquery("SELECT `language_url` FROM `{$TABLE_PREFIX}language` WHERE `language_url`!='language/english' ORDER BY `id` ASC");
    while ($row = $res->fetch_assoc()) {
        $lang_split = explode("/", strtolower(str_replace("-", "_", $row["language_url"])));
        $language = $lang_english;
        if (file_exists($THIS_BASEPATH."/".$row["language_url"]."/lang_main.php")) {
            include($THIS_BASEPATH."/".$row["language_url"]."/lang_main.php");
        }
        if ($btit_settings["fmhack_forum_auto_topic"] == "enabled" && file_exists($THIS_BASEPATH."/".$row["language_url"]."/lang_admin.php")) {
            include($THIS_BASEPATH."/".$row["language_url"]."/lang_admin.php");
        }
        ${"lang_".$lang_split[1]} = $language;
    }
    $language = $lang_english;
    /* We should now have the following lang_main definitions available by default:

    $lang_english
    $lang_romanian
    $lang_polish
    $lang_serbocroatian
    $lang_dutch
    $lang_italian
    $lang_russian
    $lang_german
    $lang_hungarian
    $lang_french
    $lang_finnish
    $lang_vietnamese
    $lang_greek
    $lang_bulgarian
    $lang_spanish
    $lang_portuguese_br
    $lang_portuguese_pt

    + / - any they've added or removed.
    */

    if (!isset($language["SYSTEM_USER"])) {
        $language["SYSTEM_USER"]="System";
    }
    if ($ts == 0) {
        $ts = $clean_interval;
    }
    if ($XBTT_USE) {
        $xbt_timeout = time() - (intval($clean_interval * 2));
        quickQuery("UPDATE `xbt_files_users` SET `active`=0 WHERE `mtime`<".$xbt_timeout);
        $res = do_sqlquery("SELECT `fid`, `seeders`, `leechers`, `completed`, LOWER(HEX(`info_hash`)) `info_hash` FROM `xbt_files` ORDER BY `fid` ASC");
        while ($row = $res->fetch_assoc()) {
            $res2 = do_sqlquery("SELECT (SELECT COUNT(*) FROM `xbt_files_users` WHERE `fid`=".$row["fid"]." AND `left`=0 AND `active`=1), (SELECT COUNT(*) FROM `xbt_files_users` WHERE `fid`=".$row["fid"].
                " AND `left`>0 AND `active`=1), (SELECT COUNT(*) FROM `xbt_files_users` WHERE `fid`=".$row["fid"]." AND `completed`>0), (SELECT SUM(`down_rate`) FROM `xbt_files_users` WHERE `fid` =".$row["fid"].
                " AND `active` =1 AND `down_rate` >0), (SELECT COUNT(*) FROM `xbt_files_users` WHERE `fid` =".$row["fid"]." AND `active` =1 AND `down_rate` >0)");
            $row2 = ($res2->fetch_array());

            if (extension_loaded("gd") && $btit_settings["fmhack_forum_auto_topic"] == "enabled" && $btit_settings["smf_autotopic"] == "true") {
                $seeders = $row2[0];
                $leechers = $row2[1];
                $total_count = ($seeders + $leechers);
                $downloaded_count = $row2[2];
                $string[0] = ((isset($language["SEEDS"]) && !empty($language["SEEDS"]))?$language["SEEDS"]:"seed(s)").": ".$seeders.", ".$language["LEECHERS"].": ".$leechers." = ".$total_count." ".$language["PEERS"];
                $string[1] = $language["DOWNLOADED"].": ".$downloaded_count." ".$language["X_TIMES"];
                $statsFilename = $THIS_BASEPATH."/torrentstats/".$row["info_hash"].".png";
                $width = 400;
                $height = 45;
                $im = ImageCreate($width, $height);
                $bg = ImageColorAllocate($im, 255, 255, 255);
                $border = ImageColorAllocate($im, 207, 199, 199);
                ImageRectangle($im, 0, 0, $width - 1, $height - 1, $border);
                $stringcolor = ImageColorAllocate($im, 0, 0, 255);
                $font = 3;
                $font_width = ImageFontWidth($font);
                $font_height = ImageFontHeight($font);
                $string_width[0] = $font_width * strlen($string[0]);
                $string_width[1] = $font_width * strlen($string[1]);
                $position_center[0] = ceil(($width - $string_width[0]) / 2);
                $position_center[1] = ceil(($width - $string_width[1]) / 2);
                $string_height = $font_height;
                $position_middle = ceil(($height - $string_height) / 2);
                $image_string = imagestring($im, $font, $position_center[0], 5, $string[0], $stringcolor);
                $image_string = imagestring($im, $font, $position_center[1], 25, $string[1], $stringcolor);
                ImagePNG($im, $statsFilename);
            }
            if ($row["seeders"] != $row2[0] || $row["leechers"] != $row2[1] || $row["completed"] != $row2[2]) {
                quickQuery("UPDATE `xbt_files` SET `seeders`=".$row2[0].", `leechers`=".$row2[1].", `completed`=".$row2[2]." WHERE `fid`=".$row["fid"]);
            }
            // Whilst we're at it, lets update the torrent speed ;)
            if (is_null($row2[3]) || $row2[3] == 0 || $row2[4] == 0) {
                $torrspeed = 0;
            } elseif ($row2[4] == 1) {
                $torrspeed = $row2[3];
            } else {
                $torrspeed = floor($row2[3] / $row2[4]);
            }
            quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `speed`=".$torrspeed.", `lastSpeedCycle`=UNIX_TIMESTAMP() WHERE `info_hash`='".$row["info_hash"]."'");
        }
        // Lets transfer the upload/download from the xbtit_users table to the xbt_users table for good measure.
        $res = do_sqlquery("SELECT `id`, `uploaded`, `downloaded` FROM `{$TABLE_PREFIX}users` WHERE `uploaded`>0 OR `downloaded`>0 ORDER BY `id` ASC");
        if (@sql_num_rows($res) > 0) {
            while ($row = $res->fetch_assoc()) {
                quickQuery("UPDATE `xbt_users` SET `uploaded`=`uploaded`+".$row["uploaded"].", `downloaded`=`downloaded`+".$row["downloaded"]." WHERE `uid`=".$row["id"]);
            }
            // Then reset everyone to 0/0 in the xbtit tables
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=0, `downloaded`=0");
        }
        // Zero users download totals if they're into crazy Exabyte levels
        // (It can happen in the rare case a deduction would push it into a negative)
        quickQuery("UPDATE `xbt_users` SET `downloaded`=0 WHERE `downloaded`>=1152921504606846976");
    }
    if ($btit_settings["fmhack_torrent_of_the_week"]=="enabled") {
        if (isset($btit_settings["tow_this_week"]) && !empty($btit_settings["tow_this_week"])) {
            $currentWeek=explode(",", $btit_settings["tow_this_week"]);
            $expiryDate=$currentWeek[4];
            if (time()>$expiryDate) {
                if ($XBTT_USE) {
                    $res=get_result("SELECT `gold_percentage`, `silver_percentage`, `bronze_percentage` FROM `{$TABLE_PREFIX}gold` WHERE `id`=1");
                }

                $goldSettings=explode("-", $currentWeek[2]);
                $multiSettings=explode("-", $currentWeek[3]);

                $torrentId=$currentWeek[0];
                $revertGold=$goldSettings[1];
                $originalGold=$goldSettings[2];
                $revertMulti=$multiSettings[1];
                $originalMulti=$multiSettings[2];

                if ($revertGold==1 || $revertMulti==1) {
                    quickQuery("UPDATE `{$TABLE_PREFIX}files` `f`".(($XBTT_USE)?" LEFT JOIN `xbt_files` `xf` ON `f`.`bin_hash`=`xf`.`info_hash`":"")." SET".(($revertMulti==1)?" `f`.`multiplier`='".$originalMulti."'":"").(($revertGold==1)?(($revertMulti==1)?",":"")." `f`.`gold`='".$originalGold."'":"").(($XBTT_USE)?", `xf`.`flags`='2',".(($revertGold==1)?" `xf`.`down_multi`=".(($originalGold == 0)?"'100'":(($originalGold == 1)?$res[0]["silver_percentage"]:(($originalGold == 2)?"'".$res[0]["gold_percentage"]."'":"'".$res[0]["bronze_percentage"]."'"))):"").(($revertMulti==1)?(($revertGold==1)?",":"")." `xf`.`up_multi`='".($originalMulti * 100)."'":""):"")." WHERE `f`.`id`='".$torrentId."'");
                }
                if (isset($btit_settings["tow_next_week"]) && !empty($btit_settings["tow_next_week"])) {
                    $nextWeek=explode(",", $btit_settings["tow_next_week"]);
                    $goldSettings=explode("-", $nextWeek[2]);
                    $multiSettings=explode("-", $nextWeek[3]);

                    $torrentId=$nextWeek[0];
                    $originalGold=$goldSettings[2];
                    $newGold=$goldSettings[3];
                    $originalMulti=$multiSettings[2];
                    $newMulti=$multiSettings[3];
                    $newThisWeek=$btit_settings["tow_next_week"].=",".(time()+604800);

                    if ($originalGold!=$newGold || $originalMulti!=$newMulti) {
                        quickQuery("UPDATE `{$TABLE_PREFIX}files` `f`".(($XBTT_USE)?" LEFT JOIN `xbt_files` `xf` ON `f`.`bin_hash`=`xf`.`info_hash`":"")." SET".(($originalMulti!=$newMulti)?" `f`.`multiplier`='".$newMulti."'":"").(($originalGold!=$newGold)?(($originalMulti!=$newMulti)?",":"")." `f`.`gold`='".$newGold."'":"").(($XBTT_USE)?", `xf`.`flags`='2',".(($originalGold!=$newGold)?" `xf`.`down_multi`=".(($newGold == 0)?"'100'":(($newGold == 1)?$res[0]["silver_percentage"]:(($newGold == 2)?"'".$res[0]["gold_percentage"]."'":"'".$res[0]["bronze_percentage"]."'"))):"").(($originalMulti!=$newMulti)?(($originalGold!=$newGold)?",":"")." `xf`.`up_multi`='".($newMulti * 100)."'":""):"")." WHERE `f`.`id`='".$torrentId."'");
                    }
                } else {
                    $newThisWeek="";
                }

                quickQuery("UPDATE {$TABLE_PREFIX}settings SET `value`='".$newThisWeek."' WHERE `key`='tow_this_week'");
                quickQuery("UPDATE {$TABLE_PREFIX}settings SET `value`='' WHERE `key`='tow_next_week'");
            }
        }
    }
    if ($btit_settings["fmhack_VIP_freeleech"] == "enabled" && $XBTT_USE) {
        quickQuery("UPDATE `xbt_users` `x` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `x`.`uid`=`u`.`id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` SET `x`.`downloaded`=`u`.`vipfl_down` WHERE `ul`.`freeleech`='yes' AND `x`.`downloaded`>`u`.`vipfl_down`");
        quickQuery("UPDATE `xbt_files_users` `xfu` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `u`.`id`=`xfu`.`uid` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` SET `xfu`.`downloaded`=0 WHERE `ul`.`freeleech`='yes' AND `xfu`.`mtime`>=`u`.`vipfl_date` AND `xfu`.`downloaded`>0");
    }
    if ($btit_settings["fmhack_freeleech_slots"]=="enabled" && $XBTT_USE) {
        $res=get_result("SELECT `xu`.`uid`, `xfu`.`fid`, `xfu`.`downloaded` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON FIND_IN_SET(`f`.`info_hash`, `u`.`freeleech_slot_hashes`) LEFT JOIN `xbt_files` `xf` ON `f`.`bin_hash`=`xf`.`info_hash` LEFT JOIN `xbt_users` `xu` ON `u`.`id`=`xu`.`uid` LEFT JOIN `xbt_files_users` `xfu` ON (`xf`.`fid`=`xfu`.`fid` AND `xu`.`uid`=`xfu`.`uid`) WHERE `f`.`info_hash` IS NOT NULL AND `xfu`.`downloaded` IS NOT NULL AND `xfu`.`downloaded`>0 ORDER BY `xu`.`uid` ASC, `xfu`.`fid` ASC");
        $userlist=array();
        if (count($res)>0) {
            foreach ($res as $row) {
                if (!array_key_exists($row["uid"], $userlist)) {
                    $userlist[$row["uid"]]["fids"]=$row["fid"];
                    $userlist[$row["uid"]]["total_download"]=$row["downloaded"];
                } else {
                    $userlist[$row["uid"]]["fids"].=",".$row["fid"];
                    $userlist[$row["uid"]]["total_download"]+=$row["downloaded"];
                }
            }
            if (count($userlist)>0) {
                foreach ($userlist as $uid => $values) {
                    // Make sure it cannot possibly go under zero to prevent the potential Exabyte downloaded issue.
                    quickQuery("UPDATE `xbt_users` SET `downloaded`=IF(".$values["total_download"].">=`downloaded`,'0',`downloaded`-".$values["total_download"].") WHERE `uid`=".$uid);
                    quickQuery("UPDATE `xbt_files_users` SET `downloaded`=0 WHERE `uid`=".$uid." AND `fid` IN(".$values["fids"].")");
                }
            }
        }
    }
    if ($ts > 0) {
        $elapsed_time = (time() - $ts);
    } else {
        $elapsed_time = $clean_interval;
    }
    if ($btit_settings["fmhack_bonus_system"] == "enabled") {
        $seed_bonus = number_format(($elapsed_time / 3600) * $GLOBALS["bonus"], 6, ".", "");
        $archive_bonus = (($btit_settings["fmhack_archive_torrents"] == "enabled" && isset($btit_settings["bonus_archive"]) && $btit_settings["bonus_archive"] > 0 && $btit_settings["archive_enable"]=="true")?number_format(($elapsed_time / 3600) * $btit_settings["bonus_archive"],
            6, ".", ""):0);
        if ($seed_bonus < 0) {
            $seed_bonus = 0;
        }
        if ($archive_bonus < 0) {
            $archive_bonus = 0;
        }
        if ($btit_settings["sb_max_ph_enable"] == "true") {
            $max_allowed_points = number_format(($elapsed_time / 3600) * $btit_settings["bonus_max_per_hour"], 6, ".", "");
        }
        if ($btit_settings["forpost_enable"] == "true" && substr($FORUMLINK, 0, 3) == "smf") {
            $petr1 = do_sqlquery("SELECT `u`.`id`, `u`.`smf_postcount`, `u`.`seedbonus`, `m`.`posts` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$db_prefix}members` `m` ON `u`.`smf_fid`=`m`.".(($FORUMLINK ==
                "smf")?"`ID_MEMBER`":"`id_member`")." WHERE `u`.`smf_postcount`!=`m`.`posts` ORDER BY `u`.`id` ASC");
            if (@sql_num_rows($petr1) > 0) {
                while ($fied = $petr1->fetch_assoc()) {
                    if ($fied["smf_postcount"] < $fied["posts"]) {
                        $diff = number_format((($fied["posts"] - $fied["smf_postcount"]) * $btit_settings["bonus_forpost"]), 6, ".", "");
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=`seedbonus`+'".$diff."', `smf_postcount`=".$fied["posts"]." WHERE `id`=".$fied["id"]);
                    } elseif ($fied["smf_postcount"] > $fied["posts"]) {
                        $diff = number_format((($fied["smf_postcount"] - $fied["posts"]) * $btit_settings["bonus_forpost"]), 6, ".", "");
                        $new_sbonus = ($fied["seedbonus"] - $diff);
                        if ($new_sbonus < 0) {
                            $diff = $fied["seedbonus"];
                        }
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=`seedbonus`-'".$diff."', `smf_postcount`=".$fied["posts"]." WHERE `id`=".$fied["id"]);
                    }
                }
            }
        } elseif ($btit_settings["forpost_enable"] == "true" && $FORUMLINK == "ipb") {
            $petr1 = do_sqlquery("SELECT `u`.`id`, `u`.`ipb_postcount`, `u`.`seedbonus`, `m`.`posts` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$ipb_prefix}members` `m` ON `u`.`ipb_fid`=`m`.`member_id` WHERE `u`.`ipb_postcount`!=`m`.`posts` ORDER BY `u`.`id` ASC");
            if (@sql_num_rows($petr1) > 0) {
                while ($fied = $petr1->fetch_assoc()) {
                    if ($fied["ipb_postcount"] < $fied["posts"]) {
                        $diff = number_format((($fied["posts"] - $fied["ipb_postcount"]) * $btit_settings["bonus_forpost"]), 6, ".", "");
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=`seedbonus`+'".$diff."', `ipb_postcount`=".$fied["posts"]." WHERE `id`=".$fied["id"]);
                    } elseif ($fied["ipb_postcount"] > $fied["posts"]) {
                        $diff = number_format((($fied["ipb_postcount"] - $fied["posts"]) * $btit_settings["bonus_forpost"]), 6, ".", "");
                        $new_sbonus = ($fied["seedbonus"] - $diff);
                        if ($new_sbonus < 0) {
                            $diff = $fied["seedbonus"];
                        }
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus`=`seedbonus`-'".$diff."', `ipb_postcount`=".$fied["posts"]." WHERE `id`=".$fied["id"]);
                    }
                }
            }
        }
        if ($btit_settings["upl_enable"] == "true") {
            $petr1 = do_sqlquery("SELECT `uploader`, `sbonus`, `info_hash` FROM `{$TABLE_PREFIX}files` WHERE `sbonus`>0 AND (UNIX_TIMESTAMP()-(".$btit_settings["bonus_upl_delay"].
                "*3600))>=UNIX_TIMESTAMP(`data`)");
            if (@sql_num_rows($petr1) > 0) {
                $hashlist = "";
                while ($fied = $petr1->fetch_assoc()) {
                    $hashlist .= "'".$fied["info_hash"]."',";
                    $fied["sbonus"] = number_format($fied["sbonus"], 6, ".", "");
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus` = `seedbonus`+'".$fied["sbonus"]."' WHERE `id`=".$fied["uploader"]);
                }
                $hashlist = trim($hashlist, ",");
                quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `sbonus`=0 WHERE `info_hash` IN($hashlist)");
            }
        }
        if ($btit_settings["bonus_type"] == "all") {
            if ($seed_bonus > 0) {
                if ($btit_settings["sb_speed_enable"] == "true") {
                    $min_up_rate = ($btit_settings["bonus_min_uprate"] * 1024);
                }
                if ($XBTT_USE) {
                    $res = do_sqlquery("SELECT u.uid, count(*) `count` FROM `xbt_files_users` `u` LEFT JOIN `xbt_files` `x` ON `u`.`fid`=`x`.`fid` WHERE `u`.`left` = '0' AND `x`.`flags`='0' AND `u`.`active`='1' ".(($btit_settings["sb_speed_enable"] ==
                        "true")?"AND `u`.`up_rate`>=".$min_up_rate:"")."  GROUP BY `u`.`uid` ORDER BY `u`.`uid` ASC");
                    if (@sql_num_rows($res) > 0) {
                        while ($arr = $res->fetch_assoc()) {
                            $overall_bonus = number_format(($seed_bonus * $arr["count"]), 6, ".", "");
                            if ($btit_settings["sb_max_ph_enable"] == "true") {
                                if ($overall_bonus > $max_allowed_points) {
                                    $overall_bonus = $max_allowed_points;
                                }
                            }
                            if ($overall_bonus > 0) {
                                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus` = `seedbonus`+'".$overall_bonus."' WHERE `id` = '".$arr["uid"]."'");
                            }
                        }
                    }
                } else {
                    $res = do_sqlquery("SELECT ".(($PRIVATE_ANNOUNCE)?"`pid`":"`ip`").", count(*) `count` FROM `{$TABLE_PREFIX}peers` WHERE `status` = 'seeder' ".(($btit_settings["sb_speed_enable"] == "true")?
                        "AND IF(`announce_interval`=0, `upload_difference`, (`upload_difference`/`announce_interval`))>=".$min_up_rate:"")." GROUP BY ".(($PRIVATE_ANNOUNCE)?"`pid`":"`ip`")." ORDER BY ".(($PRIVATE_ANNOUNCE)?
                        "`pid`":"`ip`")." ASC");
                    if (@sql_num_rows($res) > 0) {
                        while ($arr = $res->fetch_assoc()) {
                            $overall_bonus = number_format(($seed_bonus * $arr["count"]), 6, ".", "");
                            $x = (($PRIVATE_ANNOUNCE)?$arr['pid']:$arr["ip"]);
                            if ($btit_settings["sb_max_ph_enable"] == "true") {
                                if ($overall_bonus > $max_allowed_points) {
                                    $overall_bonus = $max_allowed_points;
                                }
                            }
                            if ($overall_bonus > 0) {
                                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus` = `seedbonus`+'".$overall_bonus."' WHERE ".(($PRIVATE_ANNOUNCE)?"`pid`='".$x."'":"`cip`='".$x."'"));
                            }
                        }
                    }
                }
            }
            if ($btit_settings["fmhack_archive_torrents"] == "enabled" && $archive_bonus > 0) {
                if ($btit_settings["sb_speed_enable"] == "true") {
                    $min_up_rate = ($btit_settings["bonus_min_uprate"] * 1024);
                }
                if ($XBTT_USE) {
                    $res = do_sqlquery("SELECT u.uid, count(*) `count` FROM `xbt_files_users` `u` LEFT JOIN `xbt_files` `x` ON `u`.`fid`=`x`.`fid` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `x`.`info_hash`=`f`.`bin_hash` WHERE `u`.`left` = '0' AND `x`.`flags`='0' AND `u`.`active`='1' AND `f`.`archive`=1 ".
                        (($btit_settings["sb_speed_enable"] == "true")?"AND `u`.`up_rate`>=".$min_up_rate:"")."  GROUP BY `u`.`uid` ORDER BY `u`.`uid` ASC");
                    if (@sql_num_rows($res) > 0) {
                        while ($arr = $res->fetch_assoc()) {
                            $overall_bonus = number_format(($archive_bonus * $arr["count"]), 6, ".", "");
                            if ($btit_settings["sb_max_ph_enable"] == "true") {
                                if ($overall_bonus > $max_allowed_points) {
                                    $overall_bonus = $max_allowed_points;
                                }
                            }
                            if ($overall_bonus > 0) {
                                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus` = `seedbonus`+'".$overall_bonus."' WHERE `id` = '".$arr["uid"]."'");
                            }
                        }
                    }
                } else {
                    $res = do_sqlquery("SELECT `p`.".(($PRIVATE_ANNOUNCE)?"`pid`":"`ip`").", count(*) `count` FROM `{$TABLE_PREFIX}peers` `p` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `p`.`infohash`=`f`.`info_hash` WHERE `f`.`archive`=1 AND `p`.`status` = 'seeder' ".
                        (($btit_settings["sb_speed_enable"] == "true")?"AND IF(`p`.`announce_interval`=0, `p`.`upload_difference`, (`p`.`upload_difference`/`p`.`announce_interval`))>=".$min_up_rate:"")." GROUP BY `p`.".(($PRIVATE_ANNOUNCE)?
                            "`pid`":"`ip`")." ORDER BY `p`.".(($PRIVATE_ANNOUNCE)?"`pid`":"`ip`")." ASC");
                    if (@sql_num_rows($res) > 0) {
                        while ($arr = $res->fetch_assoc()) {
                            $overall_bonus = number_format(($archive_bonus * $arr["count"]), 6, ".", "");
                            $x = (($PRIVATE_ANNOUNCE)?$arr['pid']:$arr["ip"]);
                            if ($btit_settings["sb_max_ph_enable"] == "true") {
                                if ($overall_bonus > $max_allowed_points) {
                                    $overall_bonus = $max_allowed_points;
                                }
                            }
                            if ($overall_bonus > 0) {
                                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus` = `seedbonus`+'".$overall_bonus."' WHERE ".(($PRIVATE_ANNOUNCE)?"`pid`='".$x."'":"`cip`='".$x."'"));
                            }
                        }
                    }
                }
            }
        } else {
            if ($btit_settings["sb_speed_enable"] == "true") {
                $min_up_rate = ($btit_settings["bonus_min_uprate"] * 1024);
            }
            if ($XBTT_USE) {
                if ($seed_bonus > 0) {
                    $res = do_sqlquery("SELECT `u`.`uid` FROM `xbt_files_users` `u` LEFT JOIN `xbt_files` `x` ON `u`.`fid`=`x`.`fid` WHERE `u`.`left` = '0' AND `x`.`flags`='0' AND `u`.`active`='1' ".(($btit_settings["sb_speed_enable"] ==
                        "true")?"AND `u`.`up_rate`>=".$min_up_rate:"")." GROUP BY `u`.`uid` ORDER BY `u`.`uid` ASC");
                    if (@sql_num_rows($res) > 0) {
                        $userlist = "";
                        while ($arr = $res->fetch_assoc()) {
                            $userlist .= $arr["uid"].",";
                        }
                        $userlist = trim($userlist, ",");
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus` = `seedbonus`+'".$seed_bonus."' WHERE `id` IN($userlist)");
                    }
                }
            } else {
                if ($seed_bonus > 0) {
                    $res = do_sqlquery("SELECT ".(($PRIVATE_ANNOUNCE)?"`pid`":"`ip`")." FROM `{$TABLE_PREFIX}peers` WHERE `status` = 'seeder' ".(($btit_settings["sb_speed_enable"] == "true")?
                        "AND IF(`announce_interval`=0, `upload_difference`, (`upload_difference`/`announce_interval`))>=".$min_up_rate:"")." GROUP BY ".(($PRIVATE_ANNOUNCE)?"`pid`":"`ip`")." ORDER BY ".(($PRIVATE_ANNOUNCE)?
                        "`pid`":"`ip`")." ASC");
                    if (@sql_num_rows($res) > 0) {
                        $userlist = "";
                        while ($arr = $res->fetch_assoc()) {
                            $userlist .= (($PRIVATE_ANNOUNCE)?"'".$arr["pid"]."',":"'".$arr["ip"]."',");
                        }
                        $userlist = trim($userlist, ",");
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus` = `seedbonus`+'".$seed_bonus."' WHERE ".(($PRIVATE_ANNOUNCE)?"`pid`":"`cip`")." IN($userlist)");
                    }
                }
            }
            if ($btit_settings["fmhack_archive_torrents"] == "enabled") {
                if ($XBTT_USE) {
                    if ($archive_bonus > 0) {
                        $res = do_sqlquery("SELECT `u`.`uid` FROM `xbt_files_users` `u` LEFT JOIN `xbt_files` `x` ON `u`.`fid`=`x`.`fid` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `x`.`info_hash`=`f`.`bin_hash` WHERE `f`.`archive`=1 AND `u`.`left` = '0' AND `x`.`flags`='0' AND `u`.`active`='1' ".
                            (($btit_settings["sb_speed_enable"] == "true")?"AND `u`.`up_rate`>=".$min_up_rate:"")." GROUP BY `u`.`uid` ORDER BY `u`.`uid` ASC");
                        if (@sql_num_rows($res) > 0) {
                            $userlist = "";
                            while ($arr = $res->fetch_assoc()) {
                                $userlist .= $arr["uid"].",";
                            }
                            $userlist = trim($userlist, ",");
                            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus` = `seedbonus`+'".$archive_bonus."' WHERE `id` IN($userlist)");
                        }
                    }
                } else {
                    if ($archive_bonus > 0) {
                        $res = do_sqlquery("SELECT `p`.".(($PRIVATE_ANNOUNCE)?"`pid`":"`ip`")." FROM `{$TABLE_PREFIX}peers` `p` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `p`.`infohash`=`f`.`info_hash` WHERE `f`.`archive`=1 AND `p`.`status` = 'seeder' ".
                            (($btit_settings["sb_speed_enable"] == "true")?"AND IF(`p`.`announce_interval`=0, `p`.`upload_difference`, (`p`.`upload_difference`/`p`.`announce_interval`))>=".$min_up_rate:"")." GROUP BY `p`.".(($PRIVATE_ANNOUNCE)?
                                "`pid`":"`ip`")." ORDER BY `p`.".(($PRIVATE_ANNOUNCE)?"`pid`":"`ip`")." ASC");
                        if (@sql_num_rows($res) > 0) {
                            $userlist = "";
                            while ($arr = $res->fetch_assoc()) {
                                $userlist .= (($PRIVATE_ANNOUNCE)?"'".$arr["pid"]."',":"'".$arr["ip"]."',");
                            }
                            $userlist = trim($userlist, ",");
                            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `seedbonus` = `seedbonus`+'".$archive_bonus."' WHERE ".(($PRIVATE_ANNOUNCE)?"`pid`":"`cip`")." IN($userlist)");
                        }
                    }
                }
            }
        }
    }
    // high speed report
    if ($btit_settings["fmhack_high_UL_speed_report"] == "enabled") {
        if ($btit_settings["highswitch"] == "true") {
            if ($XBTT_USE) {
                $resch = do_sqlquery("SELECT `fu`.`uid` `id`, `fu`.`up_rate`, LOWER(HEX(`fu`.`peer_id`)) `peer_id`, `f`.`filename`, `f`.`info_hash` FROM `xbt_files_users` `fu` LEFT JOIN `xbt_files` `xf` ON `fu`.`fid`=`xf`.`fid` LEFT JOIN `{$TABLE_PREFIX}files` `f` on `xf`.`info_hash`=`f`.`bin_hash` WHERE `fu`.`up_rate` >= (".
                    $btit_settings["highspeed"]."*1024) AND `fu`.`active`=1");
            } else {
                $resch = do_sqlquery("SELECT `p`.`upload_difference`, `p`.`announce_interval`, `p`.`peer_id`, `p`.`client`, `u`.`id`, `f`.`filename`, `f`.`info_hash` FROM `{$TABLE_PREFIX}peers` `p` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON ".
                    (($PRIVATE_ANNOUNCE)?"`p`.`pid`=`u`.`pid`":"`p`.`ip`=`u`.`cip`")."  LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `p`.`infohash`=`f`.`info_hash` WHERE (`p`.`upload_difference`/`p`.`announce_interval`) >= (".
                    $btit_settings["highspeed"]."*1024)");
            }
            if (@sql_num_rows($resch) > 0) {
                while ($rowch = $resch->fetch_assoc()) {
                    if (!is_null($rowch["id"])) {
                        $client = getagent((($XBTT_USE)?"":$rowch["client"]), $rowch["peer_id"]);
                        if ($XBTT_USE) {
                            $transferrate = sql_esc("User Uploading at ".makesize(round($rowch["up_rate"] / 1024, 2))." on <a href='".$BASEURL."/index.php?page=peers&id=".$rowch["info_hash"]."'>".$rowch["filename"].
                                "</a> using ".$client);
                        } else {
                            $transferrate = sql_esc("User Uploading at ".makesize(round(round($rowch['upload_difference'] / $rowch['announce_interval']), 2))." ({$rowch['announce_interval']}) on <a href='".$BASEURL."/index.php?page=peers&id=".$rowch["info_hash"].
                                "'>".$rowch["filename"]."</a> using ".$client);
                        }
                        $high = $rowch["id"];
                        if ($btit_settings["highonce"] === true) {
                            $once = do_sqlquery("SELECT `id` FROM `{$TABLE_PREFIX}reports` WHERE `addedby` = 0 AND `votedfor` = $high AND `type` = 'user' AND reason LIKE 'User Uploading at %'");
                            if (@sql_num_rows($once) == 0) {
                                quickQuery("INSERT INTO `{$TABLE_PREFIX}reports` (`addedby`,`votedfor`,`type`,`reason`) VALUES ('0','$high','user', '$transferrate')");
                            }
                        } elseif ($btit_settings["highonce"] === false) {
                            quickQuery("INSERT INTO `{$TABLE_PREFIX}reports` (`addedby`,`votedfor`,`type`,`reason`) VALUES ('0','$high','user', '$transferrate')");
                        }
                    }
                }
            }
        }
    }
    // end high speed report
    if ($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled") {
        /*
        Anti Hit and Run V2 based on CobraCRK's Anti Hit&Run Mod v1 Enhanced By IntelPentium4 & fatepower
        converted ( and improved ) to XBTIT 2 by DiemThuy Nov 2008
        Updated by Petr1fied to add XBTT support and optimise code - December 2009
        Rewrite for new system by Petr1fied December 2010
        */
        $language = $lang_english;
        if ($ts > 0) {
            $elapsed_time = (time() - $ts);
        } else {
            $elapsed_time = $clean_interval;
        }
        // Update Active Seeders' Seeding Clock
        if ($XBTT_USE) {
            // Make sure users can't get a Hit & Run on a deleted torrent
            quickQuery("UPDATE `xbt_files_users` `xfu` LEFT JOIN `xbt_files` `xf` ON `xfu`.`fid`=`xf`.`fid` SET `xfu`.`hitchecked`=-1 WHERE `xf`.`fid` IS NULL AND `xfu`.`hit`='no'");
            // Update their seeding time
            quickQuery("UPDATE `xbt_files_users` SET `seeding_time`=`seeding_time`+".$elapsed_time." WHERE `active`=1 AND `left`=0");
        } else {
            // Make sure users can't get a Hit & Run on a deleted torrent
            quickQuery("UPDATE `{$TABLE_PREFIX}history` `h` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `h`.`infohash`=`f`.`info_hash` SET `h`.`hitchecked`=-1 WHERE `f`.`info_hash` IS NULL AND `h`.`hit`='no'");
            $res = do_sqlquery("SELECT `p`.`infohash`, `u`.`id` FROM `{$TABLE_PREFIX}peers` `p` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON ".(($PRIVATE_ANNOUNCE)?"`u`.`pid`=`p`.`pid`":"`u`.`cip`=`p`.`ip`").
                " WHERE `p`.`status` = 'seeder'");
            if (@sql_num_rows($res) > 0) {
                while ($arr = $res->fetch_assoc()) {
                    quickQuery("UPDATE `{$TABLE_PREFIX}history` SET `seed` = `seed`+".$elapsed_time." WHERE `uid`=".$arr["id"]." AND `infohash`='".$arr["infohash"]."'");
                }
            }
        }
        // Lets get the rules
        $petr1 = do_sqlquery("SELECT `ul`.`id`, `hnr`.* FROM  `{$TABLE_PREFIX}users_level` `ul` LEFT JOIN `{$TABLE_PREFIX}hnr` `hnr` ON `ul`.`id`=`hnr`.`id_level` WHERE `ul`.`id`>1 ORDER BY `hnr`.`id_level` ASC");
        if (@sql_num_rows($petr1) > 0) {
            while ($fied = $petr1->fetch_assoc()) {
                if (is_null($fied["id_level"])) {
                    // Hide the rows for downloads from users excluded from Hit & Run
                    quickQuery("UPDATE ".(($XBTT_USE)?"`xbt_files_users`":"`{$TABLE_PREFIX}history`")." `h`,`{$TABLE_PREFIX}users` `u` SET `h`.`hit`='no', `h`.`hitchecked`=-1 WHERE `h`.`uid`=`u`.`id` AND `u`.`id_level`=".
                        $fied["id"]." AND `h`.`completed`=".(($XBTT_USE)?1:"'yes'"));
                } else {
                    // Remove Warnings - Start -->
                    $query1_where = "";
                    if ($fied["method"] == "seed_only") {
                        $min_seed_time = (int)($fied["min_seed_hours"] * 3600);
                        if ($XBTT_USE) {
                            $query1_where = "`fu`.`seeding_time`>=".$min_seed_time;
                        } else {
                            $query1_where = "`h`.`seed`>=".$min_seed_time;
                        }
                    } elseif ($fied["method"] == "ratio_only") {
                        $min_ratio = (float)$fied["min_ratio"];
                        if ($XBTT_USE) {
                            $query1_where = "(`fu`.`uploaded`/`fu`.`downloaded`)>='".$min_ratio."'";
                        } else {
                            $query1_where = "(`h`.`uploaded`/`h`.`downloaded`)>='".$min_ratio."'";
                        }
                    } elseif ($fied["method"] == "seed_or_ratio") {
                        $min_seed_time = (int)($fied["min_seed_hours"] * 3600);
                        $min_ratio = (float)$fied["min_ratio"];
                        if ($XBTT_USE) {
                            $query1_where = "((`fu`.`seeding_time`>=".$min_seed_time.") OR ((`fu`.`uploaded`/`fu`.`downloaded`)>='".$min_ratio."'))";
                        } else {
                            $query1_where = "((`h`.`seed`>=".$min_seed_time.") OR ((`h`.`uploaded`/`h`.`downloaded`)>='".$min_ratio."'))";
                        }
                    } elseif ($fied["method"] == "seed_and_ratio") {
                        $min_seed_time = (int)($fied["min_seed_hours"] * 3600);
                        $min_ratio = (float)$fied["min_ratio"];
                        if ($XBTT_USE) {
                            $query1_where = "((`fu`.`seeding_time`>=".$min_seed_time.") AND ((`fu`.`uploaded`/`fu`.`downloaded`)>='".$min_ratio."'))";
                        } else {
                            $query1_where = "((`h`.`seed`>=".$min_seed_time.") AND ((`h`.`uploaded`/`h`.`downloaded`)>='".$min_ratio."'))";
                        }
                    }
                    if ($query1_where != "") {
                        if ($XBTT_USE) {
                            $res = do_sqlquery("SELECT `fu`.`uid`, `fu`.`fid`, `fu`.`hitchecked`, `u`.`username`, `f`.`filename`, `f`.`info_hash`, `u`.`warn_lev`, `fu`.`seeding_time`, `fu`.`downloaded`, `fu`.`uploaded`, `fu`.`mtime` `date`, `u`.`hnr_count`".
                                (($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled")?", `u`.`user_notes`":"")." FROM `xbt_files_users` `fu` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `fu`.`uid`=`u`.`id` LEFT JOIN `xbt_files` `xf` ON `fu`.`fid`=`xf`.`fid` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `xf`.`info_hash`=`f`.`bin_hash` WHERE  ".
                                $query1_where." AND `fu`.`hitchecked`=1 AND `fu`.`left`=0 AND `u`.`id_level`=".$fied["id"]);
                        } else {
                            $res = do_sqlquery("SELECT `h`.`uid`, `h`.`hitchecked`, `u`.`username`, `f`.`filename`, `f`.`info_hash`, `u`.`warn_lev`, `h`.`seed` `seeding_time`, `h`.`downloaded`, `h`.`uploaded`, `h`.`date`, `u`.`hnr_count`".
                                (($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled")?", `u`.`user_notes`":"")." FROM `{$TABLE_PREFIX}history` `h` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `h`.`uid`=`u`.`id` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `h`.`infohash`=`f`.`info_hash` WHERE  ".
                                $query1_where." AND `h`.`hitchecked`=1 AND `h`.`completed`='yes' AND `u`.`id_level`=".$fied["id"]);
                        }
                        if (@sql_num_rows($res) > 0) {
                            while ($row = $res->fetch_assoc()) {
                                $forum_subj = sqlesc($language["HNR_FORUM_SUBJ"]." ".$row["username"]);
                                if ($fied["method"] == "seed_only") {
                                    $forum_post = sqlesc($row["username"]." ".$language["HNR_FORUM_MSG_1"]." [b]".(($fied["min_seed_hours"] >= 24)?($fied["min_seed_hours"] / 24)." ".((($fied["min_seed_hours"] / 24) == 1)?$language["HNR_FORUM_DAY"]:
                                        $language["HNR_FORUM_DAYS"]):$fied["min_seed_hours"]." ".(($fied["min_seed_hours"] == 1)?$language["HNR_FORUM_HOUR"]:$language["HNR_FORUM_HOURS"]))."[/b] ".$language["HNR_FORUM_MSG_2"].":"."\n".
                                    "[url=".$BASEURL."/index.php?page=torrent-details&id=".$row["info_hash"]."]".$row["filename"]."[/url]"."\n\n".$language["HNR_FORUM_MSG_3"].":"."\n"."[b]".NewDateFormat($row["seeding_time"])."[/b]"."\n\n".
                                    $language["HNR_FORUM_MSG_12"].":"."\n"."[b]".date("l jS F Y \a\\t g:i a", $row["date"])."[/b]");
                                } elseif ($fied["method"] == "ratio_only") {
                                    $forum_post = sqlesc($row["username"]." ".$language["HNR_FORUM_MSG_4"]." [b]".$min_ratio."[/b] ".$language["HNR_FORUM_MSG_2"].":"."\n"."[url=".$BASEURL."/index.php?page=torrent-details&id=".$row["info_hash"].
                                        "]".$row["filename"]."[/url]"."\n\n".$language["HNR_FORUM_MSG_5"].":"."\n"."[b][color=green]".$language["UPLOADED"].": ".makesize($row["uploaded"])."[/color][/b]"."\n"."[b][color=red]".$language["DOWNLOADED"].
                                        ": ".makesize($row["downloaded"])."[/color][/b]"."\n"."[b]".$language["RATIO"].": ".(($row["downloaded"] > 0)?number_format($row["uploaded"] / $row["downloaded"], 3):"&#8734;")."[/b]"."\n\n".$language["HNR_FORUM_MSG_12"].
                                        ":"."\n"."[b]".date("l jS F Y \a\\t g:i a", $row["date"])."[/b]");
                                } elseif ($fied["method"] == "seed_or_ratio") {
                                    $forum_post = sqlesc($row["username"]." ".$language["HNR_FORUM_MSG_6"]." [b]".(($fied["min_seed_hours"] >= 24)?($fied["min_seed_hours"] / 24)." ".((($fied["min_seed_hours"] / 24) == 1)?$language["HNR_FORUM_DAY"]:
                                        $language["HNR_FORUM_DAYS"]):$fied["min_seed_hours"]." ".(($fied["min_seed_hours"] == 1)?$language["HNR_FORUM_HOUR"]:$language["HNR_FORUM_HOURS"]))."[/b] ".$language["HNR_FORUM_MSG_7"]." [b]".$min_ratio.
                                    "[/b] ".$language["HNR_FORUM_MSG_8"]." ".$language["HNR_FORUM_MSG_2"].":"."\n"."[url=".$BASEURL."/index.php?page=torrent-details&id=".$row["info_hash"]."]".$row["filename"]."[/url]"."\n\n".$language["HNR_FORUM_MSG_3"].
                                    ":"."\n"."[b]".NewDateFormat($row["seeding_time"])."[/b]"."\n\n".$language["HNR_FORUM_MSG_5"].":"."\n"."[b][color=green]".$language["UPLOADED"].": ".makesize($row["uploaded"])."[/color][/b]"."\n".
                                    "[b][color=red]".$language["DOWNLOADED"].": ".makesize($row["downloaded"])."[/color][/b]"."\n"."[b]".$language["RATIO"].": ".(($row["downloaded"] > 0)?number_format($row["uploaded"] / $row["downloaded"],
                                        3):"&#8734;")."[/b]"."\n\n".$language["HNR_FORUM_MSG_12"].":"."\n"."[b]".date("l jS F Y \a\\t g:i a", $row["date"])."[/b]");
                                } elseif ($fied["method"] == "seed_and_ratio") {
                                    $forum_post = sqlesc($row["username"]." ".$language["HNR_FORUM_MSG_1"]." [b]".(($fied["min_seed_hours"] >= 24)?($fied["min_seed_hours"] / 24)." ".((($fied["min_seed_hours"] / 24) == 1)?$language["HNR_FORUM_DAY"]:
                                        $language["HNR_FORUM_DAYS"]):$fied["min_seed_hours"]." ".(($fied["min_seed_hours"] == 1)?$language["HNR_FORUM_HOUR"]:$language["HNR_FORUM_HOURS"]))."[/b] ".$language["HNR_FORUM_MSG_9"]." [b]".$min_ratio.
                                    "[/b] ".$language["HNR_FORUM_MSG_2"].":"."\n"."[url=".$BASEURL."/index.php?page=torrent-details&id=".$row["info_hash"]."]".$row["filename"]."[/url]"."\n\n".$language["HNR_FORUM_MSG_3"].":"."\n"."[b]".
                                    NewDateFormat($row["seeding_time"])."[/b]"."\n\n".$language["HNR_FORUM_MSG_5"].":"."\n"."[b][color=green]".$language["UPLOADED"].": ".makesize($row["uploaded"])."[/color][/b]"."\n"."[b][color=red]".$language["DOWNLOADED"].
                                    ": ".makesize($row["downloaded"])."[/color][/b]"."\n"."[b]".$language["RATIO"].": ".(($row["downloaded"] > 0)?number_format($row["uploaded"] / $row["downloaded"], 3):"&#8734;")."[/b]"."\n\n".$language["HNR_FORUM_MSG_12"].
                                    ":"."\n"."[b]".date("l jS F Y \a\\t g:i a", $row["date"])."[/b]");
                                }
                                if ($fied["forum_post"] > 0) {
                                    if (substr($FORUMLINK, 0, 3) == "smf") {
                                        $old_topic = false;
                                        $res2 = do_sqlquery("SELECT ".(($FORUMLINK == "smf")?"`ID_TOPIC`":"`id_topic`")." FROM `{$db_prefix}messages` WHERE ".(($FORUMLINK == "smf")?"`ID_BOARD`":"`id_board`")."=".$fied["forum_post"].
                                            " AND `subject`=".$forum_subj);
                                        if (@sql_num_rows($res2) > 0) {
                                            $row2 = $res2->fetch_assoc();
                                            $topicid = (($FORUMLINK == "smf")?$row2["ID_TOPIC"]:$row2["id_topic"]);
                                            $old_topic = true;
                                        } else {
                                            quickQuery("INSERT INTO `{$db_prefix}topics` (".(($FORUMLINK == "smf")?"`ID_BOARD`, `ID_MEMBER_STARTED`":"`id_board`, `id_member_started`").") VALUES(".$fied["forum_post"].",0)");
                                            $topicid = sql_insert_id();
                                        }
                                        if ($FORUMLINK == "smf") {
                                            quickQuery("INSERT INTO `{$db_prefix}messages` (`ID_TOPIC`,`ID_BOARD`, `posterTime`, `ID_MEMBER`, `ID_MSG_MODIFIED`, `subject`, `posterName`, `posterEmail`, `posterIP`, `body`) VALUES($topicid,".$fied["forum_post"].
                                                ",UNIX_TIMESTAMP(),0,$topicid,$forum_subj,'".sql_esc($language["SYSTEM_USER"])."','','127.0.0.1',$forum_post)");
                                        } else {
                                            quickQuery("INSERT INTO `{$db_prefix}messages` (`id_topic`,`id_board`, `poster_time`, `id_member`, `id_msg_modified`, `subject`, `poster_name`, `poster_email`, `poster_ip`, `body`) VALUES($topicid,".
                                                $fied["forum_post"].",UNIX_TIMESTAMP(),0,$topicid,$forum_subj,'".sql_esc($language["SYSTEM_USER"])."','','127.0.0.1',$forum_post)");
                                        }
                                        $postid = @sql_insert_id();
                                        quickQuery("UPDATE `{$db_prefix}topics` SET ".(($FORUMLINK == "smf")?"`ID_FIRST_MSG`":"`id_first_msg`")."=$postid, ".(($FORUMLINK == "smf")?"`ID_LAST_MSG`":"`id_last_msg`")."=$postid WHERE ".(($FORUMLINK ==
                                            "smf")?"`ID_BOARD`":"`id_board`")."=".$fied["forum_post"]." AND `ID_TOPIC`=$topicid");
                                        quickQuery("UPDATE `{$db_prefix}boards` SET ".(($FORUMLINK == "smf")?"`ID_LAST_MSG`":"`id_last_msg`")."=$postid, ".(($FORUMLINK == "smf")?"`ID_MSG_UPDATED`":"`id_msg_updated`")."=$postid, ".(($old_topic
                                            === false)?(($FORUMLINK == "smf")?"`numTopics`=`numTopics`":"`num_topics`=`num_topics`")."+1, ":"").(($FORUMLINK == "smf")?"`numPosts`=`numPosts`":"`num_posts`=`num_posts`")."+1 WHERE ".(($FORUMLINK ==
                                            "smf")?"`ID_BOARD`":"`id_board`")."=".$fied["forum_post"]);
                                        if ($old_topic === false) {
                                            quickQuery("UPDATE `{$db_prefix}settings` SET `value`=`value`+1 WHERE `variable`='totalTopics'");
                                        }
                                        quickQuery("UPDATE `{$db_prefix}settings` SET `value`=`value`+1 WHERE `variable`='totalMessages'");
                                    } elseif ($FORUMLINK == "ipb") {
                                        ipb_make_post($fied["forum_post"], $forum_subj, $forum_post);
                                    } else {
                                        $old_topic = false;
                                        $res3 = do_sqlquery("SELECT `id` FROM `{$TABLE_PREFIX}topics` WHERE `forumid`=".$fied["forum_post"]." AND `subject`=".$forum_subj);
                                        if (@sql_num_rows($res3) > 0) {
                                            $row3 = $res3->fetch_assoc();
                                            $topicid = $row3["id"];
                                            $old_topic = true;
                                        } else {
                                            quickQuery("INSERT INTO `{$TABLE_PREFIX}topics` (`userid`, `subject`, `forumid`) VALUES (0, ".$forum_subj.", ".$fied["forum_post"].")");
                                            $topicid = sql_insert_id();
                                        }
                                        quickQuery("INSERT INTO `{$TABLE_PREFIX}posts` (`topicid`,`userid`, `added`, `body`) VALUES ($topicid, 0, UNIX_TIMESTAMP(), $forum_post)");
                                        $postid = @sql_insert_id();
                                        quickQuery("UPDATE `{$TABLE_PREFIX}topics` SET `lastpost`=$postid WHERE `forumid`=".$fied["forum_post"]." AND `id`=$topicid");
                                        quickQuery("UPDATE `{$TABLE_PREFIX}forums` SET `postcount`=`postcount`+1".(($old_topic === false)?", `topiccount`=`topiccount`+1":"")." WHERE `id`=".$fied["forum_post"]);
                                    }
                                }
                                if ($row["warn_lev"] >= 1) {
                                    $fp = explode("\\n", trim($forum_post, "'"));
                                    $mycount = count($fp);
                                    quickQuery("INSERT INTO `{$TABLE_PREFIX}warn_logs` (`uid`, `notes`, `contact`, `date_added`, `type`, `added_by`) VALUES (".$row["uid"].", ".sqlesc($language["HNR_WARN_DEC"]."\n"."[quote=".$language["SYSTEM_USER"]."]".(($mycount >=
                                        1)?$fp[0]."\n":"").(($mycount >= 2)?$fp[1]."\n":"").(($mycount >= 3)?$fp[2]."\n":"").(($mycount >= 4)?$fp[3]."\n":"").(($mycount >= 5)?$fp[4]."\n":"").(($mycount >= 6)?$fp[5]."\n":"").(($mycount >= 7)?
                                    $fp[6]."\n":"").(($mycount >= 8)?$fp[7]."\n":"").(($mycount >= 9)?$fp[8]."\n":"").(($mycount >= 10)?$fp[9]."\n":"").(($mycount >= 11)?$fp[10]."\n":"").(($mycount >= 12)?$fp[11]."\n":"").(($mycount >=
                                        13)?$fp[12]."\n":"")."[/quote]").", 'pm', UNIX_TIMESTAMP(), 'dec', 0)");
                                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `warn_lev`=`warn_lev`-1, `warn_last`=".(($row["warn_lev"] == 1)?"0":"UNIX_TIMESTAMP()")." WHERE `id`=".$row["uid"]);
                                    $stage4=$btit_settings["warn_max"];
                                    $stage3=round($btit_settings["warn_max"]*0.75);
                                    $stage2=round($btit_settings["warn_max"]*0.5);
                                    $stage1=round($btit_settings["warn_max"]*0.25);
                                    $stage0=0;
                                    $warn_lev = ($row["warn_lev"] - 1);
                                    if ($warn_lev >= $stage4) {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_max.png[/img] (".$warn_lev."/".$stage4.")";
                                    } elseif ($warn_lev >= $stage3) {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_3.png[/img] (".$warn_lev."/".$stage4.")";
                                    } elseif ($warn_lev >= $stage2) {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_2.png[/img] (".$warn_lev."/".$stage4.")";
                                    } elseif ($warn_lev >= $stage1) {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_1.png[/img] (".$warn_lev."/".$stage4.")";
                                    } else {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_0.png[/img] (".$warn_lev."/".$stage4.")";
                                    }
                                    send_pm(0, $row["uid"], sqlesc($language['WS_WC_SUBJ']), sqlesc($language['WS_WC_MSG'].":\n\n"."[quote=".$language["SYSTEM_USER"]."]".(($mycount >= 1)?$fp[0]."\n":"").(($mycount >= 2)?$fp[1]."\n":"").(($mycount >= 3)?$fp[2].
                                        "\n":"").(($mycount >= 4)?$fp[3]."\n":"").(($mycount >= 5)?$fp[4]."\n":"").(($mycount >= 6)?$fp[5]."\n":"").(($mycount >= 7)?$fp[6]."\n":"").(($mycount >= 8)?$fp[7]."\n":"").(($mycount >= 9)?$fp[8]."\n":
                                        "").(($mycount >= 10)?$fp[9]."\n":"").(($mycount >= 11)?$fp[10]."\n":"").(($mycount >= 12)?$fp[11]."\n":"").(($mycount >= 13)?$fp[12]."\n":"")."[/quote]"."\n\n".$language["WS_YOUR_CUR_LEV"]."\n\n".$wl.
                                        "\n\n".(($btit_settings["warn_auto_down_enable"] == "yes" && $row["warn_lev"] > 0)?$language["WS_DEC_IN_DAYS_1"]." ".$btit_settings["warn_auto_decrease"]." ".$language["WS_DEC_IN_DAYS_2"]."\n\n":"").
                                        $language["WS_AUTO_MSG"]."\n"));
                                }
                                if ($row["hnr_count"] >= 1) {
                                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `hnr_count`=`hnr_count`-1 WHERE `id`=".$row["uid"]);
                                }
                                if ($XBTT_USE) {
                                    quickQuery("UPDATE `xbt_files_users` SET `hitchecked`=-1, `hit`='no' WHERE `uid`=".$row["uid"]." AND `fid`=".$row["fid"]);
                                } else {
                                    quickQuery("UPDATE `{$TABLE_PREFIX}history` SET `hitchecked`=-1, `hit`='no' WHERE `uid`=".$row["uid"]." AND `infohash`='".$row["info_hash"]."'");
                                }
                                if ($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled") {
                                    if (isset($row["user_notes"]) && !empty($row["user_notes"])) {
                                        $usernotes = unserialize(unesc($row["user_notes"]));
                                    } else {
                                        $usernotes = array();
                                    }
                                    $usernotes[] = base64_encode($language["UN_WLEV_DEC"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                                    $new_notes = serialize($usernotes);
                                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$row["uid"]);
                                }
                            }
                        }
                    }
                    // <-- Remove Warnings - End
                    // Add Warnings - Start -->
                    $query2_where = "";
                    if ($fied["method"] == "seed_only") {
                        $min_seed_time = (int)($fied["min_seed_hours"] * 3600);
                        if ($XBTT_USE) {
                            $query2_where = "`fu`.`seeding_time`<".$min_seed_time;
                        } else {
                            $query2_where = "`h`.`seed`<".$min_seed_time;
                        }
                    } elseif ($fied["method"] == "ratio_only") {
                        $min_ratio = (float)$fied["min_ratio"];
                        if ($XBTT_USE) {
                            $query2_where = "(`fu`.`uploaded`/`fu`.`downloaded`)<'".$min_ratio."'";
                        } else {
                            $query2_where = "(`h`.`uploaded`/`h`.`downloaded`)<'".$min_ratio."'";
                        }
                    } elseif ($fied["method"] == "seed_or_ratio") {
                        $min_seed_time = (int)($fied["min_seed_hours"] * 3600);
                        $min_ratio = (float)$fied["min_ratio"];
                        if ($XBTT_USE) {
                            $query2_where = "((`fu`.`seeding_time`<".$min_seed_time.") AND ((`fu`.`uploaded`/`fu`.`downloaded`)<'".$min_ratio."'))";
                        } else {
                            $query2_where = "((`h`.`seed`<".$min_seed_time.") AND ((`h`.`uploaded`/`h`.`downloaded`)<'".$min_ratio."'))";
                        }
                    } elseif ($fied["method"] == "seed_and_ratio") {
                        $min_seed_time = (int)($fied["min_seed_hours"] * 3600);
                        $min_ratio = (float)$fied["min_ratio"];
                        if ($XBTT_USE) {
                            $query2_where = "((`fu`.`seeding_time`<".$min_seed_time.") OR ((`fu`.`uploaded`/`fu`.`downloaded`)<'".$min_ratio."'))";
                        } else {
                            $query2_where = "((`h`.`seed`<".$min_seed_time.") OR ((`h`.`uploaded`/`h`.`downloaded`)<'".$min_ratio."'))";
                        }
                    }
                    if ($query2_where != "") {
                        if ($XBTT_USE) {
                            $resa = do_sqlquery("SELECT `fu`.`uid`, `fu`.`fid`, `fu`.`hitchecked`, `u`.`username`, `f`.`filename`, `f`.`info_hash`, `u`.`warn_lev`, `fu`.`seeding_time`, `fu`.`downloaded`, `fu`.`uploaded`, `fu`.`mtime` `date`, `u`.`hnr_count`".
                                (($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled")?", `u`.`user_notes`":"")." FROM `xbt_files_users` `fu` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `fu`.`uid`=`u`.`id` LEFT JOIN `xbt_files` `xf` ON `fu`.`fid`=`xf`.`fid` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `xf`.`info_hash`=`f`.`bin_hash` WHERE  ".
                                $query2_where." AND `fu`.`hitchecked`=0 AND `fu`.`mtime` < (UNIX_TIMESTAMP() - (3600 * ".$fied["tolerance_hours"].")) AND `fu`.`completed_time` > 0 AND `fu`.`downloaded` > ".$fied["dl_trig_bytes"].
                                " AND `fu`.`left`=0 AND `fu`.`active`=0 AND `u`.`id_level`=".$fied["id"]);
                        } else {
                            $resa = do_sqlquery("SELECT `h`.`uid`, `h`.`hitchecked`, `u`.`username`, `f`.`filename`, `f`.`info_hash`, `u`.`warn_lev`, `h`.`seed` `seeding_time`, `h`.`downloaded`, `h`.`uploaded`, `h`.`date`, `u`.`hnr_count`".
                                (($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled")?", `u`.`user_notes`":"")." FROM `{$TABLE_PREFIX}history` `h` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `h`.`uid`=`u`.`id` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `h`.`infohash`=`f`.`info_hash` WHERE  ".
                                $query2_where." AND `h`.`hitchecked`=0 AND `h`.`completed`='yes' AND `h`.`date` < (UNIX_TIMESTAMP() - (3600 * ".$fied["tolerance_hours"].")) AND `h`.`downloaded` > ".$fied["dl_trig_bytes"].
                                " AND `h`.`active`='no' AND `u`.`id_level`=".$fied["id"]);
                        }
                        if (@sql_num_rows($resa) > 0) {
                            while ($rowa = $resa->fetch_assoc()) {
                                $forum_subj = sqlesc($language["HNR_FORUM_SUBJ"]." ".$rowa["username"]);
                                if ($fied["method"] == "seed_only") {
                                    $forum_post = sqlesc($rowa["username"]." ".$language["HNR_FORUM_MSG_10"]." [b]".(($fied["min_seed_hours"] >= 24)?($fied["min_seed_hours"] / 24)." ".((($fied["min_seed_hours"] / 24) == 1)?$language["HNR_FORUM_DAY"]:
                                        $language["HNR_FORUM_DAYS"]):$fied["min_seed_hours"]." ".(($fied["min_seed_hours"] == 1)?$language["HNR_FORUM_HOUR"]:$language["HNR_FORUM_HOURS"]))."[/b] ".$language["HNR_FORUM_MSG_2"].":"."\n".
                                    "[url=".$BASEURL."/index.php?page=torrent-details&id=".$rowa["info_hash"]."]".$rowa["filename"]."[/url]"."\n\n".$language["HNR_FORUM_MSG_3"].":"."\n"."[b]".NewDateFormat($rowa["seeding_time"])."[/b]".
                                    "\n\n".$language["HNR_FORUM_MSG_12"].":"."\n"."[b]".date("l jS F Y \a\\t g:i a", $rowa["date"])."[/b]");
                                } elseif ($fied["method"] == "ratio_only") {
                                    $forum_post = sqlesc($rowa["username"]." ".$language["HNR_FORUM_MSG_11"]." [b]".$min_ratio."[/b] ".$language["HNR_FORUM_MSG_2"].":"."\n"."[url=".$BASEURL."/index.php?page=torrent-details&id=".$rowa["info_hash"].
                                        "]".$rowa["filename"]."[/url]"."\n\n".$language["HNR_FORUM_MSG_5"].":"."\n"."[b][color=green]".$language["UPLOADED"].": ".makesize($rowa["uploaded"])."[/color][/b]"."\n"."[b][color=red]".$language["DOWNLOADED"].
                                        ": ".makesize($rowa["downloaded"])."[/color][/b]"."\n"."[b]".$language["RATIO"].": ".(($rowa["downloaded"] > 0)?number_format($rowa["uploaded"] / $rowa["downloaded"], 3):"&#8734;")."[/b]"."\n\n".$language["HNR_FORUM_MSG_12"].
                                        ":"."\n"."[b]".date("l jS F Y \a\\t g:i a", $rowa["date"])."[/b]");
                                } elseif ($fied["method"] == "seed_or_ratio") {
                                    $forum_post = sqlesc($rowa["username"]." ".$language["HNR_FORUM_MSG_13"]." [b]".(($fied["min_seed_hours"] >= 24)?($fied["min_seed_hours"] / 24)." ".((($fied["min_seed_hours"] / 24) == 1)?$language["HNR_FORUM_DAY"]:
                                        $language["HNR_FORUM_DAYS"]):$fied["min_seed_hours"]." ".(($fied["min_seed_hours"] == 1)?$language["HNR_FORUM_HOUR"]:$language["HNR_FORUM_HOURS"]))."[/b] ".$language["HNR_FORUM_MSG_7"]." [b]".$min_ratio.
                                    "[/b] ".$language["HNR_FORUM_MSG_2"].":"."\n"."[url=".$BASEURL."/index.php?page=torrent-details&id=".$rowa["info_hash"]."]".$rowa["filename"]."[/url]"."\n\n".$language["HNR_FORUM_MSG_3"].":"."\n".
                                    "[b]".NewDateFormat($rowa["seeding_time"])."[/b]"."\n\n".$language["HNR_FORUM_MSG_5"].":"."\n"."[b][color=green]".$language["UPLOADED"].": ".makesize($rowa["uploaded"])."[/color][/b]"."\n".
                                    "[b][color=red]".$language["DOWNLOADED"].": ".makesize($rowa["downloaded"])."[/color][/b]"."\n"."[b]".$language["RATIO"].": ".(($rowa["downloaded"] > 0)?number_format($rowa["uploaded"] / $rowa["downloaded"],
                                        3):"&#8734;")."[/b]"."\n\n".$language["HNR_FORUM_MSG_12"].":"."\n"."[b]".date("l jS F Y \a\\t g:i a", $rowa["date"])."[/b]");
                                } elseif ($fied["method"] == "seed_and_ratio") {
                                    $forum_post = sqlesc($rowa["username"]." ".$language["HNR_FORUM_MSG_10"]." [b]".(($fied["min_seed_hours"] >= 24)?($fied["min_seed_hours"] / 24)." ".((($fied["min_seed_hours"] / 24) == 1)?$language["HNR_FORUM_DAY"]:
                                        $language["HNR_FORUM_DAYS"]):$fied["min_seed_hours"]." ".(($fied["min_seed_hours"] == 1)?$language["HNR_FORUM_HOUR"]:$language["HNR_FORUM_HOURS"]))."[/b] ".$language["HNR_FORUM_MSG_9"]." [b]".$min_ratio.
                                    "[/b] ".$language["HNR_FORUM_MSG_2"].":"."\n"."[url=".$BASEURL."/index.php?page=torrent-details&id=".$rowa["info_hash"]."]".$rowa["filename"]."[/url]"."\n\n".$language["HNR_FORUM_MSG_3"].":"."\n".
                                    "[b]".NewDateFormat($rowa["seeding_time"])."[/b]"."\n\n".$language["HNR_FORUM_MSG_5"].":"."\n"."[b][color=green]".$language["UPLOADED"].": ".makesize($rowa["uploaded"])."[/color][/b]"."\n".
                                    "[b][color=red]".$language["DOWNLOADED"].": ".makesize($rowa["downloaded"])."[/color][/b]"."\n"."[b]".$language["RATIO"].": ".(($rowa["downloaded"] > 0)?number_format($rowa["uploaded"] / $rowa["downloaded"],
                                        3):"&#8734;")."[/b]"."\n\n".$language["HNR_FORUM_MSG_12"].":"."\n"."[b]".date("l jS F Y \a\\t g:i a", $rowa["date"])."[/b]");
                                }
                                if ($fied["forum_post"] > 0) {
                                    if (substr($FORUMLINK, 0, 3) == "smf") {
                                        $old_topic = false;
                                        $resb = do_sqlquery("SELECT ".(($FORUMLINK == "smf")?"`ID_TOPIC`":"`id_topic`")." FROM `{$db_prefix}messages` WHERE ".(($FORUMLINK == "smf")?"`ID_BOARD`":"`id_board`")."=".$fied["forum_post"].
                                            " AND `subject`=".$forum_subj);
                                        if (@sql_num_rows($resb) > 0) {
                                            $rowb = $resb->fetch_assoc();
                                            $topicid = (($FORUMLINK == "smf")?$rowb["ID_TOPIC"]:$rowb["id_topic"]);
                                            $old_topic = true;
                                        } else {
                                            quickQuery("INSERT INTO `{$db_prefix}topics` (".(($FORUMLINK == "smf")?"`ID_BOARD`, `ID_MEMBER_STARTED`":"`id_board`, `id_member_started`").") VALUES(".$fied["forum_post"].",0)");
                                            $topicid = sql_insert_id();
                                        }
                                        if ($FORUMLINK == "smf") {
                                            quickQuery("INSERT INTO `{$db_prefix}messages` (`ID_TOPIC`,`ID_BOARD`, `posterTime`, `ID_MEMBER`, `ID_MSG_MODIFIED`, `subject`, `posterName`, `posterEmail`, `posterIP`, `body`) VALUES($topicid,".$fied["forum_post"].
                                                ",UNIX_TIMESTAMP(),0,$topicid,$forum_subj,'".sql_esc($language["SYSTEM_USER"])."','','127.0.0.1',$forum_post)");
                                        } else {
                                            quickQuery("INSERT INTO `{$db_prefix}messages` (`id_topic`,`id_board`, `poster_time`, `id_member`, `id_msg_modified`, `subject`, `poster_name`, `poster_email`, `poster_ip`, `body`) VALUES($topicid,".
                                                $fied["forum_post"].",UNIX_TIMESTAMP(),0,$topicid,$forum_subj,'".sql_esc($language["SYSTEM_USER"])."','','127.0.0.1',$forum_post)");
                                        }
                                        $postid = @sql_insert_id();
                                        quickQuery("UPDATE `{$db_prefix}topics` SET ".(($FORUMLINK == "smf")?"`ID_FIRST_MSG`":"`id_first_msg`")."=$postid, ".(($FORUMLINK == "smf")?"`ID_LAST_MSG`":"`id_last_msg`")."=$postid WHERE ".(($FORUMLINK ==
                                            "smf")?"`ID_BOARD`":"`id_board`")."=".$fied["forum_post"]." AND ".(($FORUMLINK == "smf")?"`ID_TOPIC`":"`id_topic`")."=$topicid");
                                        quickQuery("UPDATE `{$db_prefix}boards` SET ".(($FORUMLINK == "smf")?"`ID_LAST_MSG`":"`id_last_msg`")."=$postid, ".(($FORUMLINK == "smf")?"`ID_MSG_UPDATED`":"`id_msg_updated`")."=$postid, ".(($old_topic
                                            === false)?(($FORUMLINK == "smf")?"`numTopics`=`numTopics`":"`num_topics`=`num_topics`")."+1, ":"").(($FORUMLINK == "smf")?"`numPosts`=`numPosts`":"`num_posts`=`num_posts`")."+1 WHERE ".(($FORUMLINK ==
                                            "smf")?"`ID_BOARD`":"`id_board`")."=".$fied["forum_post"]);
                                        if ($old_topic === false) {
                                            quickQuery("UPDATE `{$db_prefix}settings` SET `value`=`value`+1 WHERE `variable`='totalTopics'");
                                        }
                                        quickQuery("UPDATE `{$db_prefix}settings` SET `value`=`value`+1 WHERE `variable`='totalMessages'");
                                    } elseif ($FORUMLINK == "ipb") {
                                        ipb_make_post($fied["forum_post"], $forum_subj, $forum_post);
                                    } else {
                                        $old_topic = false;
                                        $resc = do_sqlquery("SELECT `id` FROM `{$TABLE_PREFIX}topics` WHERE `forumid`=".$fied["forum_post"]." AND `subject`=".$forum_subj);
                                        if (@sql_num_rows($resc) > 0) {
                                            $rowc = $resc->fetch_assoc();
                                            $topicid = $rowc["id"];
                                            $old_topic = true;
                                        } else {
                                            quickQuery("INSERT INTO `{$TABLE_PREFIX}topics` (`userid`, `subject`, `forumid`) VALUES (0, ".$forum_subj.", ".$fied["forum_post"].")");
                                            $topicid = sql_insert_id();
                                        }
                                        quickQuery("INSERT INTO `{$TABLE_PREFIX}posts` (`topicid`,`userid`, `added`, `body`) VALUES ($topicid, 0, UNIX_TIMESTAMP(), $forum_post)");
                                        $postid = @sql_insert_id();
                                        quickQuery("UPDATE `{$TABLE_PREFIX}topics` SET `lastpost`=$postid WHERE `forumid`=".$fied["forum_post"]." AND `id`=$topicid");
                                        quickQuery("UPDATE `{$TABLE_PREFIX}forums` SET `postcount`=`postcount`+1".(($old_topic === false)?", `topiccount`=`topiccount`+1":"")." WHERE `id`=".$fied["forum_post"]);
                                    }
                                }
                                if ($rowa["warn_lev"] < $btit_settings["warn_max"]) {
                                    $fp = explode("\\n", trim($forum_post, "'"));
                                    $mycount = count($fp);
                                    quickQuery("INSERT INTO `{$TABLE_PREFIX}warn_logs` (`uid`, `notes`, `contact`, `date_added`, `type`, `added_by`) VALUES (".$rowa["uid"].", ".sqlesc($language["HNR_WARN_INC"]."\n"."[quote=".$language["SYSTEM_USER"]."]".(($mycount >=
                                        1)?$fp[0]."\n":"").(($mycount >= 2)?$fp[1]."\n":"").(($mycount >= 3)?$fp[2]."\n":"").(($mycount >= 4)?$fp[3]."\n":"").(($mycount >= 5)?$fp[4]."\n":"").(($mycount >= 6)?$fp[5]."\n":"").(($mycount >= 7)?
                                    $fp[6]."\n":"").(($mycount >= 8)?$fp[7]."\n":"").(($mycount >= 9)?$fp[8]."\n":"").(($mycount >= 10)?$fp[9]."\n":"").(($mycount >= 11)?$fp[10]."\n":"").(($mycount >= 12)?$fp[11]."\n":"").(($mycount >=
                                        13)?$fp[12]."\n":"")."[/quote]").", 'pm', UNIX_TIMESTAMP(), 'inc', 0)");
                                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `warn_lev`=`warn_lev`+1, `warn_last`=UNIX_TIMESTAMP() WHERE `id`=".$rowa["uid"]);
                                    $stage4=$btit_settings["warn_max"];
                                    $stage3=round($btit_settings["warn_max"]*0.75);
                                    $stage2=round($btit_settings["warn_max"]*0.5);
                                    $stage1=round($btit_settings["warn_max"]*0.25);
                                    $stage0=0;
                                    $warn_lev = ($rowa["warn_lev"] + 1);
                                    if ($warn_lev >= $stage4) {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_max.png[/img] (".$warn_lev."/".$stage4.")";
                                    } elseif ($warn_lev >= $stage3) {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_3.png[/img] (".$warn_lev."/".$stage4.")";
                                    } elseif ($warn_lev >= $stage2) {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_2.png[/img] (".$warn_lev."/".$stage4.")";
                                    } elseif ($warn_lev >= $stage1) {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_1.png[/img] (".$warn_lev."/".$stage4.")";
                                    } else {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_0.png[/img] (".$warn_lev."/".$stage4.")";
                                    }
                                    send_pm(0, $rowa["uid"], sqlesc($language['WS_YHRAW']), sqlesc($language['WS_TRFW'].":\n\n"."[quote=".$language["SYSTEM_USER"]."]".(($mycount >= 1)?$fp[0]."\n":"").(($mycount >= 2)?$fp[1]."\n":"").(($mycount >= 3)?$fp[2].
                                        "\n":"").(($mycount >= 4)?$fp[3]."\n":"").(($mycount >= 5)?$fp[4]."\n":"").(($mycount >= 6)?$fp[5]."\n":"").(($mycount >= 7)?$fp[6]."\n":"").(($mycount >= 8)?$fp[7]."\n":"").(($mycount >= 9)?$fp[8]."\n":
                                        "").(($mycount >= 10)?$fp[9]."\n":"").(($mycount >= 11)?$fp[10]."\n":"").(($mycount >= 12)?$fp[11]."\n":"").(($mycount >= 13)?$fp[12]."\n":"")."[/quote]"."\n\n".$language["WS_YOUR_CUR_LEV"]."\n\n".$wl.
                                        "\n\n".(($btit_settings["warn_auto_down_enable"] == "yes" && $rowa["warn_lev"] > 0)?$language["WS_DEC_IN_DAYS_1"]." ".$btit_settings["warn_auto_decrease"]." ".$language["WS_DEC_IN_DAYS_2"]."\n\n":"").
                                        $language["WS_AUTO_MSG"]."\n"));
                                }
                                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `hnr_count`=`hnr_count`+1 WHERE `id`=".$rowa["uid"]);
                                if ($XBTT_USE) {
                                    quickQuery("UPDATE `xbt_files_users` SET `hitchecked`=1, `hit`='yes' WHERE `uid`=".$rowa["uid"]." AND `fid`=".$rowa["fid"]);
                                } else {
                                    quickQuery("UPDATE `{$TABLE_PREFIX}history` SET `hitchecked`=1, `hit`='yes' WHERE `uid`=".$rowa["uid"]." AND `infohash`='".$rowa["info_hash"]."'");
                                }
                                if ($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled") {
                                    if (isset($rowa["user_notes"]) && !empty($rowa["user_notes"])) {
                                        $usernotes = unserialize(unesc($rowa["user_notes"]));
                                    } else {
                                        $usernotes = array();
                                    }
                                    $usernotes[] = base64_encode($language["UN_WLEV_INC"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                                    $new_notes = serialize($usernotes);
                                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$rowa["uid"]);
                                }
                            }
                        }
                    }
                    // <-- Add Warnings - End
                    // Block Leech if they hit the maximum (XBT Backend Only)
                    if ($XBTT_USE && $fied["block_leech"] > 0) {
                        $result = do_sqlquery("SELECT `u`.`id` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `xbt_users` `xu` ON `u`.`id`=`xu`.`uid` WHERE `u`.`hnr_count`>=".$fied["block_leech"]." AND `xu`.`can_leech`=1");
                        if (@sql_num_rows($result) > 0) {
                            $userlist = "";
                            while ($myrow = $result->fetch_assoc()) {
                                $userlist .= $myrow["id"].",";
                            }
                            $userlist = trim($userlist, ",");
                            if ($userlist != "") {
                                quickQuery("UPDATE `xbt_users` SET `can_leech`=0 WHERE `uid` IN(".$userlist.")");
                            }
                        }
                        $result = do_sqlquery("SELECT `u`.`id` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `xbt_users` `xu` ON `u`.`id`=`xu`.`uid` WHERE `u`.`hnr_count`<".$fied["block_leech"]." AND `xu`.`can_leech`=0");
                        if (@sql_num_rows($result) > 0) {
                            $userlist = "";
                            while ($myrow = $result->fetch_assoc()) {
                                $userlist .= $myrow["id"].",";
                            }
                            $userlist = trim($userlist, ",");
                            if ($userlist != "") {
                                quickQuery("UPDATE `xbt_users` SET `can_leech`=1 WHERE `uid` IN(".$userlist.")");
                            }
                        }
                    }
                }
            }
        }
    }
    //Free leech With Happy Hour
    if ($btit_settings["fmhack_free_leech_with_happy_hour"] == "enabled") {
        $happy_r = do_sqlquery("SELECT UNIX_TIMESTAMP(value_s) AS happy , value_i AS happys from {$TABLE_PREFIX}avps where arg='happyhour'");
        $happy_a = $happy_r->fetch_array();
        $curDate = time();
        $happyTime = ($happy_a["happy"] + 3600);
        if ($happy_a["happys"] == 0) {
            $happyHour = happyHour();
            quickQuery("UPDATE {$TABLE_PREFIX}avps set value_s=".sqlesc($happyHour).", value_i='1' WHERE arg='happyhour' LIMIT 1");
        } elseif ($happy_a["happys"] == 1 && ($curDate > $happyTime)) {
            quickQuery("UPDATE {$TABLE_PREFIX}avps set value_i='0' WHERE arg='happyhour' LIMIT 1");
        }
        if ($btit_settings["fmhack_gold_and_silver_torrents"] == "enabled" && $XBTT_USE) {
            $goldres = do_sqlquery("SELECT `gold_percentage`, `silver_percentage`, `bronze_percentage` FROM `{$TABLE_PREFIX}gold` WHERE `id`=1");
            $goldrow = $goldres->fetch_assoc();
            $res = do_sqlquery("SELECT `gold`, `info_hash` FROM `{$TABLE_PREFIX}files` WHERE `external`='no'");
            $restore_classic = "";
            $restore_gold = "";
            $restore_silver = "";
            $restore_bronze = "";
            while ($row = $res->fetch_assoc()) {
                if ($row["gold"] == 0) {
                    $restore_classic .= "0x".$row["info_hash"].",";
                } elseif ($row["gold"] == 1) {
                    $restore_silver .= "0x".$row["info_hash"].",";
                } elseif ($row["gold"] == 2) {
                    $restore_gold .= "0x".$row["info_hash"].",";
                }
                if ($row["gold"] == 3) {
                    $restore_bronze .= "0x".$row["info_hash"].",";
                }
            }
            $restore_classic = trim($restore_classic, ",");
            $restore_gold = trim($restore_gold, ",");
            $restore_silver = trim($restore_silver, ",");
            $restore_bronze = trim($restore_bronze, ",");
        }
        $switch = do_sqlquery("SELECT `happy_hour`, free_expire_date, free FROM `{$TABLE_PREFIX}files` WHERE `external`='no' LIMIT 1");
        $switch_happy = $switch->fetch_array();
        if ($switch_happy["happy_hour"] == "yes") {
            if (ishappyHour("check") && $happyTime > "0:00") {
                quickQuery("ALTER TABLE `{$TABLE_PREFIX}files` CHANGE `happy` `happy` ENUM( 'yes', 'no' ) NULL DEFAULT 'yes'");
                quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `happy`='yes' WHERE `external`='no'");
                if ($XBTT_USE) {
                    quickQuery("UPDATE `xbt_files` SET `down_multi`=0, `flags`=2");
                    quickQuery("ALTER TABLE `xbt_files` CHANGE `down_multi` `down_multi` INT NULL DEFAULT '0'");
                }
            } else {
                quickQuery("ALTER TABLE `{$TABLE_PREFIX}files` CHANGE `happy` `happy` ENUM( 'yes', 'no' ) NULL DEFAULT 'no'");
                quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `happy`='no' WHERE `external`='no'");
                if ($btit_settings["fmhack_gold_and_silver_torrents"] == "enabled" && $XBTT_USE) {
                    if ($restore_classic != "") {
                        quickQuery("UPDATE `xbt_files` SET `down_multi`=100, `flags`=2 WHERE `info_hash` IN(".$restore_classic.")");
                    }
                    if ($goldrow["gold_percentage"] > 0 && $restore_gold != "") {
                        quickQuery("UPDATE `xbt_files` SET `down_multi`='".$goldrow["gold_percentage"]."', `flags`=2 WHERE `info_hash` IN(".$restore_gold.")");
                    }
                    if ($restore_silver != "") {
                        quickQuery("UPDATE `xbt_files` SET `down_multi`='".$goldrow["silver_percentage"]."', `flags`=2 WHERE `info_hash` IN(".$restore_silver.")");
                    }
                    if ($restore_bronze != "") {
                        quickQuery("UPDATE `xbt_files` SET `down_multi`='".$goldrow["bronze_percentage"]."', `flags`=2 WHERE `info_hash` IN(".$restore_bronze.")");
                    }
                    quickQuery("ALTER TABLE `xbt_files` CHANGE `down_multi` `down_multi` INT NULL DEFAULT '100'");
                } elseif ($btit_settings["fmhack_gold_and_silver_torrents"] == "disabled" && $XBTT_USE) {
                    quickQuery("UPDATE `xbt_files` SET `down_multi`=100, `flags`=2");
                    quickQuery("ALTER TABLE `xbt_files` CHANGE `down_multi` `down_multi` INT NULL DEFAULT '100'");
                }
            }
        }
        $expire_dated = $switch_happy['free_expire_date'];
        $expired = strtotime($expire_dated);
        $nowd = strtotime("now");
        if ($nowd >= $expired && $switch_happy['free'] == 'yes') {
            quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `free`='no',free_expire_date='0000-00-00 00:00:00' WHERE `external`='no'");
            quickQuery("ALTER TABLE `{$TABLE_PREFIX}files` CHANGE `free` `free` ENUM( 'yes', 'no' ) NULL DEFAULT 'no'");
            // xbtt
            if ($btit_settings["fmhack_gold_and_silver_torrents"] == "enabled" && $XBTT_USE) {
                if ($restore_classic != "") {
                    quickQuery("UPDATE `xbt_files` SET `down_multi`=100, `flags`=2 WHERE `info_hash` IN(".$restore_classic.")");
                }
                if ($goldrow["gold_percentage"] > 0 && $restore_gold != "") {
                    quickQuery("UPDATE `xbt_files` SET `down_multi`='".$goldrow["gold_percentage"]."', `flags`=2 WHERE `info_hash` IN(".$restore_gold.")");
                }
                if ($restore_silver != "") {
                    quickQuery("UPDATE `xbt_files` SET `down_multi`='".$goldrow["silver_percentage"]."', `flags`=2 WHERE `info_hash` IN(".$restore_silver.")");
                }
                if ($restore_bronze != "") {
                    quickQuery("UPDATE `xbt_files` SET `down_multi`='".$goldrow["bronze_percentage"]."', `flags`=2 WHERE `info_hash` IN(".$restore_bronze.")");
                }
                quickQuery("ALTER TABLE `xbt_files` CHANGE `down_multi` `down_multi` INT NULL DEFAULT '100'");
            } elseif ($btit_settings["fmhack_gold_and_silver_torrents"] == "disabled" && $XBTT_USE) {
                quickQuery("UPDATE `xbt_files` SET `down_multi`=100, `flags`=2");
                quickQuery("ALTER TABLE `xbt_files` CHANGE `down_multi` `down_multi` INT NULL DEFAULT '100'");
            }
        }
    }
    // End Free Leech With Happy Hour
    if ($btit_settings["fmhack_torrent_request_and_vote"] == "enabled") {
        // DT request hack start
        $reqprune = $btit_settings["req_prune"];
        $request = do_sqlquery("SELECT `id` FROM `{$TABLE_PREFIX}requests` WHERE `jobtakenby` > '0' AND `uploadedby`=0 AND `jobtakenwhen` < DATE_SUB(NOW(), INTERVAL {$reqprune} DAY)");
        while ($reqrow = $request->fetch_assoc()) {
            $reqid = $reqrow["id"];
            quickQuery("UPDATE {$TABLE_PREFIX}requests SET `jobtakenby`='0',`jobtakenwhen`='0000-00-00 00:00:00' WHERE `id`=".$reqid);
            /*quickQuery("DELETE FROM `{$TABLE_PREFIX}requests` WHERE `jobtakenby` > 0 AND `id` = ".$reqid);
            quickQuery("DELETE FROM `{$TABLE_PREFIX}requests_bounty` WHERE `req_id` = ".$reqid);
            quickQuery("DELETE FROM `{$TABLE_PREFIX}requests_comments` WHERE `req_id` = ".$reqid);*/
        }
        // DT request hack end
    }
    if ($btit_settings["fmhack_ban_button"]) {
        // banbutton
        $timeout = ($btit_settings["bandays"] * 86400);
        quickQuery("DELETE FROM `{$TABLE_PREFIX}signup_ip_block` WHERE (UNIX_TIMESTAMP() - `added`) > ".$timeout);
        // end banbutton
    }
    // warn-ban system with acp by DT
    //Auto Seedbox Start
    if ($btit_settings["fmhack_show_if_seedbox_is_used"] == "enabled") {
        do_sqlquery("UPDATE {$TABLE_PREFIX}files SET `seedbox`='0' ");

        $query = do_sqlquery("select ip FROM {$TABLE_PREFIX}seedboxip");
        while ($row=$query->fetch_row()) {
            $seedip[] = $row[0];
            $host = gethostbyaddr($row[0]);
            $peers = sql_num_rows(do_sqlquery("SELECT ip FROM {$TABLE_PREFIX}peers WHERE ip='".$row[0]."'"));
            quickQuery("UPDATE {$TABLE_PREFIX}seedboxip SET host='{$host}', peers={$peers} WHERE ip='".$row[0]."'");
        }

        if (is_array($seedip) && count($seedip)>0) {
            $sid=do_sqlquery("select * FROM {$TABLE_PREFIX}peers WHERE `ip` IN ('".implode("','", $seedip)."')");
            while ($sow=$sid->fetch_array()) {
                do_sqlquery("UPDATE {$TABLE_PREFIX}files SET `seedbox`='1' WHERE `info_hash`='".$sow['infohash']."'");
            }
        }
    } //Auto Seedbox End
   if ($btit_settings["fmhack_low_ratio_ban_system"] == "enabled") {
       $resset = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}low_ratio_ban_settings WHERE id ='1'");
       if (@sql_num_rows($resset) > 0) {
           $art = $resset->fetch_assoc();
           $resban = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}low_ratio_ban ");
           if (@sql_num_rows($resban) > 0) {
               while ($ban = $resban->fetch_assoc()) {
                   if ($art["wb_sys"] == "true") {
                       $min_dl = ($ban["wb_down"] * 1024 * 1024 * 1024);
                        // find bad users 1
                    if ($XBTT_USE) {
                        $demotelist = do_sqlquery("SELECT `u`.`id`, `l`.`language_url`, `u`.`warn_lev`".(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled")?", `u`.`user_notes`":"").
                            " FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `xbt_users` `x` ON `u`.`id`=`x`.`uid` LEFT JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language`=`l`.`id` WHERE `x`.`downloaded`  > ".$min_dl.
                            " AND (`x`.`uploaded`/`x`.`downloaded`) <= ".$ban["wb_one"]." AND `u`.`id_level`=".$ban["wb_rank"]." AND `u`.`rat_warn_level` = 0 ORDER BY `l`.`language_url` ASC");
                    } else {
                        $demotelist = do_sqlquery("SELECT `u`.`id`, `l`.`language_url`, `u`.`warn_lev`".(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled")?", `u`.`user_notes`":"").
                            " FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language`=`l`.`id` WHERE `u`.`downloaded`  > ".$min_dl." AND (`u`.`uploaded`/`u`.`downloaded`) <= ".$ban["wb_one"].
                            " AND `u`.`id_level`=".$ban["wb_rank"]." AND `u`.`rat_warn_level` = 0 ORDER BY `l`.`language_url` ASC");
                    }
                       if (@sql_num_rows($demotelist) > 0) {
                           $templang = "language/english";
                           $language = $lang_english;
                           while ($demote = $demotelist->fetch_assoc()) {
                               // warn bad users 1
                            quickQuery("UPDATE {$TABLE_PREFIX}users SET rat_warn_level = 1 , rat_warn_time = NOW() WHERE id=".$demote["id"]);
                               if ($demote["language_url"] != $templang) {
                                   $lang_split = explode("/", strtolower(str_replace("-", "_", $demote["language_url"])));
                                   $language = ${"lang_".$lang_split[1]};
                                   $templang = $demote["language_url"];
                               }
                                // send pm bad users 1
                            $sub = sqlesc($language["RAT_SUBJ"]);
                               $msg = sqlesc($art["wb_text_one"]);
                               send_pm(0, $demote[id], $sub, $msg);
                                // add warn symbol 1
                            if ($ban["wb_warn"] == "true" && $demote["warn_lev"] < $btit_settings["warn_max"]) {
                                $stage4=$btit_settings["warn_max"];
                                $stage3=round($btit_settings["warn_max"]*0.75);
                                $stage2=round($btit_settings["warn_max"]*0.5);
                                $stage1=round($btit_settings["warn_max"]*0.25);
                                $stage0=0;
                                $warn_lev = ($demote["warn_lev"] + 1);
                                if ($warn_lev >= $stage4) {
                                    $wl = "[img]".$BASEURL."/images/warned/warn_max.png[/img] (".$warn_lev."/".$stage4.")";
                                } elseif ($warn_lev >= $stage3) {
                                    $wl = "[img]".$BASEURL."/images/warned/warn_3.png[/img] (".$warn_lev."/".$stage4.")";
                                } elseif ($warn_lev >= $stage2) {
                                    $wl = "[img]".$BASEURL."/images/warned/warn_2.png[/img] (".$warn_lev."/".$stage4.")";
                                } elseif ($warn_lev >= $stage1) {
                                    $wl = "[img]".$BASEURL."/images/warned/warn_1.png[/img] (".$warn_lev."/".$stage4.")";
                                } else {
                                    $wl = "[img]".$BASEURL."/images/warned/warn_0.png[/img] (".$warn_lev."/".$stage4.")";
                                }
                                quickQuery("INSERT INTO `{$TABLE_PREFIX}warn_logs` (`uid`, `notes`, `contact`, `date_added`, `type`, `added_by`) VALUES (".$demote["id"].", '".sql_esc($language["RAT_SUBJ"]).
                                    "', 'pm', UNIX_TIMESTAMP(), 'inc', 0)");
                                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `warn_lev`=".$warn_lev.", `warn_last`=".(($warn_lev == 0)?"0":"UNIX_TIMESTAMP()")." WHERE `id`=".$demote["id"]);
                                send_pm(0, $demote['id'], sqlesc($language['WS_YHRAW']), sqlesc($language['WS_TRFW'].":\n\n"."[quote=".$language["SYSTEM_USER"]."]".trim(unesc($msg), ",")."[/quote]"."\n\n".$language["WS_YOUR_CUR_LEV"]."\n\n".$wl."\n\n".(($btit_settings["warn_auto_down_enable"] ==
                                    "yes" && $warn_lev > 0)?$language["WS_DEC_IN_DAYS_1"]." ".$btit_settings["warn_auto_decrease"]." ".$language["WS_DEC_IN_DAYS_2"]."\n\n":"").$language["WS_AUTO_MSG"]."\n"));
                            }
                               if ($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled") {
                                   if (isset($demote["user_notes"]) && !empty($demote["user_notes"])) {
                                       $usernotes = unserialize(unesc($demote["user_notes"]));
                                   } else {
                                       $usernotes = array();
                                   }
                                   $usernotes[] = base64_encode($language["UN_WLEV_INC"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                                   $new_notes = serialize($usernotes);
                                   quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$demote["id"]);
                               }
                           }
                       }
                        // time date stuff
                    $time_AA = (86400 * $ban['wb_days_one']);
                       $time_BB = strtotime(now);
                       $time_CC = ($time_BB - $time_AA);
                        // find bad users 2
                    if ($XBTT_USE) {
                        $demotelistt = do_sqlquery("SELECT `u`.`id`, `u`.`rat_warn_time`, `l`.`language_url`, `u`.`warn_lev`".(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled")?
                            ", `u`.`user_notes`":"")." FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `xbt_users` `x` ON `u`.`id`=`x`.`uid` LEFT JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language`=`l`.`id` WHERE `x`.`downloaded`  > ".
                    $min_dl." AND (`x`.`uploaded`/`x`.`downloaded`) <= ".$ban["wb_two"]." AND `u`.`id_level`=".$ban["wb_rank"]." AND `u`.`rat_warn_level` = 1 ORDER BY `l`.`language_url` ASC");
                    } else {
                        $demotelistt = do_sqlquery("SELECT `u`.`id`, `u`.`rat_warn_time`, `l`.`language_url`, `u`.`warn_lev`".(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled")?
                            ", `u`.`user_notes`":"")." FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language`=`l`.`id` WHERE `u`.`downloaded`  > ".$min_dl.
                    " AND (`u`.`uploaded`/`u`.`downloaded`) <= ".$ban["wb_two"]." AND `u`.`id_level`=".$ban["wb_rank"]." AND `u`.`rat_warn_level` = 1 ORDER BY `l`.`language_url` ASC");
                    }
                       if (@sql_num_rows($demotelistt) > 0) {
                           $templang = "language/english";
                           $language = $lang_english;
                           while ($demotee = $demotelistt->fetch_assoc()) {
                               $time_DD = strtotime($demotee["rat_warn_time"]);
                               if ($time_DD <= $time_CC) {
                                   // warn bad users 2
                                quickQuery("UPDATE {$TABLE_PREFIX}users SET rat_warn_level = 2 , rat_warn_time = NOW() WHERE id=".$demotee["id"]);
                                   if ($demotee["language_url"] != $templang) {
                                       $lang_split = explode("/", strtolower(str_replace("-", "_", $demotee["language_url"])));
                                       $language = ${"lang_".$lang_split[1]};
                                       $templang = $demotee["language_url"];
                                   }
                                    // send pm bad users 2
                                $sub = sqlesc($language["RAT_SUBJ_2"]);
                                   $msg = sqlesc($art["wb_text_two"]);
                                   send_pm(0, $demotee[id], $sub, $msg);
                                    // add warn symbol 2
                                if ($ban["wb_warn"] == "true" && $demotee["warn_lev"] < $btit_settings["warn_max"]) {
                                    $stage4=$btit_settings["warn_max"];
                                    $stage3=round($btit_settings["warn_max"]*0.75);
                                    $stage2=round($btit_settings["warn_max"]*0.5);
                                    $stage1=round($btit_settings["warn_max"]*0.25);
                                    $stage0=0;
                                    $warn_lev = ($demotee["warn_lev"] + 1);
                                    if ($warn_lev >= $stage4) {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_max.png[/img] (".$warn_lev."/".$stage4.")";
                                    } elseif ($warn_lev >= $stage3) {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_3.png[/img] (".$warn_lev."/".$stage4.")";
                                    } elseif ($warn_lev >= $stage2) {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_2.png[/img] (".$warn_lev."/".$stage4.")";
                                    } elseif ($warn_lev >= $stage1) {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_1.png[/img] (".$warn_lev."/".$stage4.")";
                                    } else {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_0.png[/img] (".$warn_lev."/".$stage4.")";
                                    }
                                    quickQuery("INSERT INTO `{$TABLE_PREFIX}warn_logs` (`uid`, `notes`, `contact`, `date_added`, `type`, `added_by`) VALUES (".$demotee["id"].", '".sql_esc($language["RAT_SUBJ_2"]).
                                        "', 'pm', UNIX_TIMESTAMP(), 'inc', 0)");
                                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `warn_lev`=".$warn_lev.", `warn_last`=".(($warn_lev == 0)?"0":"UNIX_TIMESTAMP()")." WHERE `id`=".$demotee["id"]);
                                    send_pm(0, $demotee['id'], sqlesc($language['WS_YHRAW']), sqlesc($language['WS_TRFW'].":\n\n"."[quote=".$language["SYSTEM_USER"]."]".trim(unesc($msg), ",")."[/quote]"."\n\n".$language["WS_YOUR_CUR_LEV"]."\n\n".$wl."\n\n".
                                        (($btit_settings["warn_auto_down_enable"] == "yes" && $warn_lev > 0)?$language["WS_DEC_IN_DAYS_1"]." ".$btit_settings["warn_auto_decrease"]." ".$language["WS_DEC_IN_DAYS_2"]."\n\n":"").$language["WS_AUTO_MSG"].
                                        "\n"));
                                }
                               }
                               if ($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled") {
                                   if (isset($demotee["user_notes"]) && !empty($demotee["user_notes"])) {
                                       $usernotes = unserialize(unesc($demotee["user_notes"]));
                                   } else {
                                       $usernotes = array();
                                   }
                                   $usernotes[] = base64_encode($language["UN_WLEV_INC"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                                   $new_notes = serialize($usernotes);
                                   quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$demotee["id"]);
                               }
                           }
                       }
                        // unwarn user who did improve
                    if ($XBTT_USE) {
                        $unwarnone = do_sqlquery("SELECT `u`.`id` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `xbt_users` `x` ON `u`.`id`=`x`.`uid` WHERE `x`.`downloaded`  > ".$min_dl.
                            " AND (`x`.`uploaded`/`x`.`downloaded`) >".$ban["wb_one"]." AND `u`.`id_level`=".$ban["wb_rank"]." AND `u`.`rat_warn_level` = 1");
                    } else {
                        $unwarnone = do_sqlquery("SELECT `u`.`id` FROM `{$TABLE_PREFIX}users` `u` WHERE `u`.`downloaded`  > ".$min_dl." AND (`u`.`uploaded`/`u`.`downloaded`) > ".$ban["wb_one"]." AND `u`.`id_level`=".$ban["wb_rank"].
                            " AND `u`.`rat_warn_level` = 1");
                    }
                       if (@sql_num_rows($unwarnone) > 0) {
                           $iid = "";
                           while ($unwarna = $unwarnone->fetch_assoc()) {
                               $iid .= $unwarna["id"].",";
                           }
                           $iid = trim($iid, ",");
                           if ($iid != "") {
                               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `rat_warn_level`=0 WHERE `id` IN (".$iid.")");
                           }
                       }
                        // time date stuff
                    $time_EE = (86400 * $ban['wb_days_two']);
                       $time_FF = ($time_BB - $time_EE);
                        // find bad users 3
                    if ($XBTT_USE) {
                        $demotelisttt = do_sqlquery("SELECT `u`.`id`, `u`.`rat_warn_time`, `l`.`language_url`, `u`.`warn_lev`".(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled")?
                            ", `u`.`user_notes`":"")." FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `xbt_users` `x` ON `u`.`id`=`x`.`uid` LEFT JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language`=`l`.`id` WHERE `x`.`downloaded`  > ".
                    $min_dl." AND (`x`.`uploaded`/`x`.`downloaded`) <= ".$ban["wb_three"]." AND `u`.`id_level`=".$ban["wb_rank"]." AND `u`.`rat_warn_level` = 2 ORDER BY `l`.`language_url` ASC");
                    } else {
                        $demotelisttt = do_sqlquery("SELECT `u`.`id`, `u`.`rat_warn_time`, `l`.`language_url`, `u`.`warn_lev`".(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled")?
                            ", `u`.`user_notes`":"")." FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language`=`l`.`id` WHERE `u`.`downloaded`  > ".$min_dl.
                    " AND (`u`.`uploaded`/`u`.`downloaded`) <= ".$ban["wb_three"]." AND `u`.`id_level`=".$ban["wb_rank"]." AND `u`.`rat_warn_level` = 2 ORDER BY `l`.`language_url` ASC");
                    }
                       if (@sql_num_rows($demotelisttt) > 0) {
                           $templang = "language/english";
                           $language = $lang_english;
                           while ($demoteee = $demotelisttt->fetch_assoc()) {
                               $time_GG = strtotime($demoteee["rat_warn_time"]);
                               if ($time_GG <= $time_FF) {
                                   // warn bad users 3
                                quickQuery("UPDATE {$TABLE_PREFIX}users SET rat_warn_level = 3 , rat_warn_time = NOW() WHERE id=".$demoteee["id"]);
                                   if ($demoteee["language_url"] != $templang) {
                                       $lang_split = explode("/", strtolower(str_replace("-", "_", $demoteee["language_url"])));
                                       $language = ${"lang_".$lang_split[1]};
                                       $templang = $demoteee["language_url"];
                                   }
                                    // send pm bad users 3
                                $sub = sqlesc($language["RAT_SUBJ_3"]);
                                   $msg = sqlesc($art["wb_text_fin"]);
                                   send_pm(0, $demoteee[id], $sub, $msg);
                                    // add warn symbol 3
                                if ($ban["wb_warn"] == "true" && $demoteee["warn_lev"] < $btit_settings["warn_max"]) {
                                    $stage4=$btit_settings["warn_max"];
                                    $stage3=round($btit_settings["warn_max"]*0.75);
                                    $stage2=round($btit_settings["warn_max"]*0.5);
                                    $stage1=round($btit_settings["warn_max"]*0.25);
                                    $stage0=0;
                                    $warn_lev = ($demoteee["warn_lev"] + 1);
                                    if ($warn_lev >= $stage4) {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_max.png[/img] (".$warn_lev."/".$stage4.")";
                                    } elseif ($warn_lev >= $stage3) {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_3.png[/img] (".$warn_lev."/".$stage4.")";
                                    } elseif ($warn_lev >= $stage2) {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_2.png[/img] (".$warn_lev."/".$stage4.")";
                                    } elseif ($warn_lev >= $stage1) {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_1.png[/img] (".$warn_lev."/".$stage4.")";
                                    } else {
                                        $wl = "[img]".$BASEURL."/images/warned/warn_0.png[/img] (".$warn_lev."/".$stage4.")";
                                    }
                                    quickQuery("INSERT INTO `{$TABLE_PREFIX}warn_logs` (`uid`, `notes`, `contact`, `date_added`, `type`, `added_by`) VALUES (".$demoteee["id"].", '".sql_esc($language["RAT_SUBJ_2"]).
                                        "', 'pm', UNIX_TIMESTAMP(), 'inc', 0)");
                                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `warn_lev`=".$warn_lev.", `warn_last`=".(($warn_lev == 0)?"0":"UNIX_TIMESTAMP()")." WHERE `id`=".$demoteee["id"]);
                                    send_pm(0, $demoteee['id'], sqlesc($language['WS_YHRAW']), sqlesc($language['WS_TRFW'].":\n\n"."[quote=".$language["SYSTEM_USER"]."]".trim(unesc($msg), ",")."[/quote]"."\n\n".$language["WS_YOUR_CUR_LEV"]."\n\n".$wl."\n\n".
                                        (($btit_settings["warn_auto_down_enable"] == "yes" && $warn_lev > 0)?$language["WS_DEC_IN_DAYS_1"]." ".$btit_settings["warn_auto_decrease"]." ".$language["WS_DEC_IN_DAYS_2"]."\n\n":"").$language["WS_AUTO_MSG"].
                                        "\n"));
                                }
                               }
                               if ($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled") {
                                   if (isset($demoteee["user_notes"]) && !empty($demoteee["user_notes"])) {
                                       $usernotes = unserialize(unesc($demoteee["user_notes"]));
                                   } else {
                                       $usernotes = array();
                                   }
                                   $usernotes[] = base64_encode($language["UN_WLEV_INC"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                                   $new_notes = serialize($usernotes);
                                   quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$demoteee["id"]);
                               }
                           }
                       }
                        // unwarn user who did improve 2
                    if ($XBTT_USE) {
                        $unwarntwo = do_sqlquery("SELECT `u`.`id` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `xbt_users` `x` ON `u`.`id`=`x`.`uid` WHERE `x`.`downloaded`  > ".$min_dl.
                            " AND (`x`.`uploaded`/`x`.`downloaded`) >".$ban["wb_two"]." AND `u`.`id_level`=".$ban["wb_rank"]." AND `u`.`rat_warn_level` = 2");
                    } else {
                        $unwarntwo = do_sqlquery("SELECT `u`.`id` FROM `{$TABLE_PREFIX}users` `u` WHERE `u`.`downloaded`  > ".$min_dl." AND (`u`.`uploaded`/`u`.`downloaded`) > ".$ban["wb_two"]." AND `u`.`id_level`=".$ban["wb_rank"].
                            " AND `u`.`rat_warn_level` = 2");
                    }
                       if (@sql_num_rows($unwarntwo) > 0) {
                           $jid = "";
                           while ($unwarnb = $unwarntwo->fetch_assoc()) {
                               $jid .= $unwarnb["id"].",";
                           }
                           $jid = trim($jid, ",");
                           if ($jid != "") {
                               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `rat_warn_level`=0 WHERE `id` IN (".$jid.")");
                           }
                       }
                        // time date stuff
                    $time_HH = (86400 * $ban['wb_days_fin']);
                       $time_II = ($time_BB - $time_HH);
                        // find bad users 4
                    if ($XBTT_USE) {
                        $demotelistttt = do_sqlquery("SELECT `u`.`id`, `u`.`rat_warn_time`, `l`.`language_url` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `xbt_users` `x` ON `u`.`id`=`x`.`uid` LEFT JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language`=`l`.`id` WHERE `x`.`downloaded`  > ".
                            $min_dl." AND (`x`.`uploaded`/`x`.`downloaded`) <= ".$ban["wb_fin"]." AND `u`.`id_level`=".$ban["wb_rank"]." AND `u`.`rat_warn_level` = 3 ORDER BY `l`.`language_url` ASC");
                    } else {
                        $demotelistttt = do_sqlquery("SELECT `u`.`id`, `u`.`rat_warn_time`, `l`.`language_url` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language`=`l`.`id` WHERE `u`.`downloaded`  > ".
                            $min_dl." AND (`u`.`uploaded`/`u`.`downloaded`) <= ".$ban["wb_fin"]." AND `u`.`id_level`=".$ban["wb_rank"]." AND `u`.`rat_warn_level` = 3 ORDER BY `l`.`language_url` ASC");
                    }
                       if (@sql_num_rows($demotelistttt) > 0) {
                           while ($demoteeee = $demotelistttt->fetch_assoc()) {
                               $time_JJ = strtotime($demoteeee["rat_warn_time"]);
                               if ($time_JJ <= $time_II) {
                                   // ban bad users 4
                                quickQuery("UPDATE {$TABLE_PREFIX}users SET rat_warn_level = 4 ,rat_warn_time = NOW(),bandt='yes' WHERE id=".$demoteeee["id"]);
                               }
                           }
                       }
                        // unwarn user who did improve last
                    if ($XBTT_USE) {
                        $unwarnthree = do_sqlquery("SELECT `u`.`id` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `xbt_users` `x` ON `u`.`id`=`x`.`uid` WHERE `x`.`downloaded`  > ".$min_dl.
                            " AND (`x`.`uploaded`/`x`.`downloaded`) >".$ban["wb_three"]." AND `u`.`id_level`=".$ban["wb_rank"]." AND `u`.`rat_warn_level` = 3");
                    } else {
                        $unwarnthree = do_sqlquery("SELECT `u`.`id` FROM `{$TABLE_PREFIX}users` `u` WHERE `u`.`downloaded`  > ".$min_dl." AND (`u`.`uploaded`/`u`.`downloaded`) > ".$ban["wb_three"]." AND `u`.`id_level`=".$ban["wb_rank"].
                            " AND `u`.`rat_warn_level` = 3");
                    }
                       if (@sql_num_rows($unwarnthree) > 0) {
                           $lid = "";
                           while ($unwarnc = $unwarnthree->fetch_assoc()) {
                               $lid .= $unwarnc["id"].",";
                           }
                           $lid = trim($lid, ",");
                           if ($lid != "") {
                               quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `rat_warn_level`=0 WHERE `id` IN (".$lid.")");
                           }
                       }
                   }
               }
           }
       }
   }
    // warn-ban system with acp by DT

    // SANITY FOR TORRENTS
$results = do_sqlquery("SELECT info_hash, seeds, leechers, finished, dlbytes, filename FROM {$TABLE_PREFIX}files WHERE external='no'");
    $i = 0;
    while ($row = $results->fetch_row()) {
        list($hash, $seeders, $leechers, $finished, $bytes, $filename) = $row;
        $timeout = time() - (intval($GLOBALS["report_interval"] * 2));
        // for testing purpose -- begin
    $resupd = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}peers where lastupdate < ".$timeout." AND infohash='$hash'");
        if (sql_num_rows($resupd) > 0) {
            while ($resupdate = $resupd->fetch_array()) {
                $uploaded = max(0, $resupdate["uploaded"]);
                $downloaded = max(0, $resupdate["downloaded"]);
                $pid = $resupdate["pid"];
                $ip = $resupdate["ip"];
                // update user->peer stats only if not livestat
            if (!$LIVESTATS) {
                if ($PRIVATE_ANNOUNCE) {
                    quickQuery("UPDATE {$TABLE_PREFIX}users SET uploaded=uploaded+$uploaded, downloaded=downloaded+$downloaded WHERE pid='$pid' AND id>1 LIMIT 1");
                } else { // ip

                    quickQuery("UPDATE {$TABLE_PREFIX}users SET uploaded=uploaded+$uploaded, downloaded=downloaded+$downloaded WHERE cip='$ip' AND id>1 LIMIT 1");
                }
            }
                // update dead peer to non active in history table
                if ($LOG_HISTORY) {
                    $resuser = do_sqlquery("SELECT id FROM {$TABLE_PREFIX}users WHERE ".($PRIVATE_ANNOUNCE?"pid='$pid'":"cip='$ip'")." ORDER BY lastconnect DESC LIMIT 1");
                    $curu = @$resuser->fetch_row();
                    quickquery("UPDATE {$TABLE_PREFIX}history SET active='no' WHERE uid=$curu[0] AND infohash='$hash'");
                }
            }
        }
        // for testing purpose -- end
        quickQuery("DELETE FROM {$TABLE_PREFIX}peers where lastupdate < ".$timeout." AND infohash='$hash'");
        quickQuery("UPDATE {$TABLE_PREFIX}files SET lastcycle='".time()."' WHERE info_hash='$hash'");
        $results2 = do_sqlquery("SELECT status, COUNT(status) from {$TABLE_PREFIX}peers WHERE infohash='$hash' GROUP BY status");
        $counts = array();
        while ($row = $results2->fetch_row()) {
            $counts[$row[0]] = 0 + $row[1];
            if (!$XBTT_USE && extension_loaded("gd") && $btit_settings["fmhack_forum_auto_topic"] == "enabled" && $btit_settings["smf_autotopic"] == "true") {
                $seeders = (isset($counts["seeder"])?$counts["seeder"]:0);
                $leechers = (isset($counts["leecher"])?$counts["leecher"]:0);
                $total_count = ($seeders + $leechers);
                $downloaded_count = $finished;
                $string[0] = $language["SEEDS"].": ".$seeders.", ".$language["LEECHERS"].": ".$leechers." = ".$total_count." ".$language["PEERS"];
                $string[1] = $language["DOWNLOADED"].": ".$downloaded_count." ".$language["X_TIMES"];
                $statsFilename = $THIS_BASEPATH."/torrentstats/".$hash.".png";
                $width = 400;
                $height = 45;
                $im = ImageCreate($width, $height);
                $bg = ImageColorAllocate($im, 255, 255, 255);
                $border = ImageColorAllocate($im, 207, 199, 199);
                ImageRectangle($im, 0, 0, $width - 1, $height - 1, $border);
                $stringcolor = ImageColorAllocate($im, 0, 0, 255);
                $font = 3;
                $font_width = ImageFontWidth($font);
                $font_height = ImageFontHeight($font);
                $string_width[0] = $font_width * strlen($string[0]);
                $string_width[1] = $font_width * strlen($string[1]);
                $position_center[0] = ceil(($width - $string_width[0]) / 2);
                $position_center[1] = ceil(($width - $string_width[1]) / 2);
                $string_height = $font_height;
                $position_middle = ceil(($height - $string_height) / 2);
                $image_string = imagestring($im, $font, $position_center[0], 5, $string[0], $stringcolor);
                $image_string = imagestring($im, $font, $position_center[1], 25, $string[1], $stringcolor);
                ImagePNG($im, $statsFilename);
            }
            quickQuery("UPDATE {$TABLE_PREFIX}files SET leechers=".(isset($counts["leecher"])?$counts["leecher"]:0).",seeds=".(isset($counts["seeder"])?$counts["seeder"]:0)." WHERE info_hash=\"$hash\"");
        }
        if ($bytes < 0) {
            quickQuery("UPDATE {$TABLE_PREFIX}files SET dlbytes=0 WHERE info_hash=\"$hash\"");
        }
    }
    // END TORRENT'S SANITY
    //  optimize peers table
    quickQuery("OPTIMIZE TABLE {$TABLE_PREFIX}peers");
    // delete readposts when topic don't exist or deleted  *** should be done by delete, just in case
    quickQuery("DELETE r FROM {$TABLE_PREFIX}readposts r LEFT JOIN {$TABLE_PREFIX}topics t ON r.topicid = t.id WHERE t.id IS NULL");
    // delete readposts when users was deleted *** should be done by delete, just in case
    quickQuery("DELETE r FROM {$TABLE_PREFIX}readposts r LEFT JOIN {$TABLE_PREFIX}users u ON r.userid = u.id WHERE u.id IS NULL");
    // deleting orphan image in torrent's folder (if image code is enabled)
    $CAPTCHA_FOLDER = realpath("$CURRENTPATH/../$CAPTCHA_FOLDER");
    if ($dir = @opendir($CAPTCHA_FOLDER."/")) {
        while (false !== ($file = @readdir($dir))) {
            if ($ext = substr(strrchr($file, "."), 1) == "png") {
                unlink("$CAPTCHA_FOLDER/$file");
            }
        }
        @closedir($dir);
    }
    if ($btit_settings["fmhack_birthdays"] == "enabled") {
        $templang = "language/english";
        $language = $lang_english;
        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `birthday_bonus`=0 WHERE DAYOFMONTH(`dob`)!=".date('j'));
        $res = do_sqlquery("SELECT `u`.`id`, `u`.`dob`, `l`.`language_url` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language`=`l`.`id` WHERE DAYOFMONTH(`u`.`dob`)=".
            date('j')." AND MONTH(`u`.`dob`)=".date('n')." AND `u`.`dob`!=CURDATE() AND `u`.`birthday_bonus`=0 ORDER BY `l`.`language_url` ASC");
        if (@sql_num_rows($res) > 0) {
            while ($row = $res->fetch_assoc()) {
                $dob = explode("-", $row["dob"]);
                $age = userage($dob[0], $dob[1], $dob[2]);
                $bonus = round($age * $btit_settings["birthday_bonus"] * ($btit_settings["birthday_bytes"]=="GB"?1073741824:1048576));
                if ($row["language_url"] != $templang) {
                    $lang_split = explode("/", strtolower(str_replace("-", "_", $row["language_url"])));
                    $language = ${"lang_".$lang_split[1]};
                    $templang = $row["language_url"];
                }
                if ($XBTT_USE) {
                    quickQuery("UPDATE `xbt_users` `xu` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `xu`.`uid`=`u`.`id` SET `xu`.`uploaded`=`xu`.`uploaded`+$bonus, `u`.`birthday_bonus`=1 WHERE `xu`.`uid`=".$row["id"]);
                } else {
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `uploaded`=`uploaded`+$bonus, `birthday_bonus`=1 WHERE `id`=".$row["id"]);
                }
                send_pm(0, $row["id"], sqlesc($language["HB_SUBJECT"]), sqlesc($language["HB_MESSAGE_1"].makesize($bonus).$language["HB_MESSAGE_2"].$btit_settings["birthday_bonus"].$language["HB_MESSAGE_3"]));
            }
        }
    }
    //timed rank
    if ($btit_settings["fmhack_timed_ranks"] == "enabled") {
        $rankstats = do_sqlquery("SELECT `u`.`id`, `u`.`old_rank`, ".(($btit_settings["fmhack_torrents_limit"] == "enabled" && $XBTT_USE)?"`u`.`custom_torr_limit`, `ul`.`torrents_limit`, ":"").(($btit_settings["fmhack_enhanced_wait_time"] ==
            "enabled" && $XBTT_USE)?"`u`.`custom_wait_time`, `ul`.`WT`, ":"")." `ul`.`level`, `l`.`language_url`, `u`.`smf_fid`, `u`.`ipb_fid`, `ul`.`smf_group_mirror`, `ul`.`ipb_group_mirror` FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`old_rank`=`ul`.`id` LEFT JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language`=`l`.`id` WHERE `u`.`timed_rank` < NOW() AND `u`.`rank_switch`='yes'");
        $templang = "language/english";
        $language = $lang_english;
        if (@sql_num_rows($rankstats) > 0) {
            while ($arrdt = $rankstats->fetch_assoc()) {
                if ($arrdt["language_url"] != $templang) {
                    $lang_split = explode("/", strtolower(str_replace("-", "_", $arrdt["language_url"])));
                    $language = ${"lang_".$lang_split[1]};
                    $templang = $arrdt["language_url"];
                }
                $subj = sqlesc($language["TR_EXP_SUBJ"]);
                $msg = sqlesc($language["TR_EXP_SUBJ"]."\n\n".$language["TR_EXP_MSG_1"]." ".$arrdt["level"]."\n\n".$language["TR_EXP_MSG_2"]);
                send_pm(0, $arrdt["id"], $subj, $msg);
                quickQuery("UPDATE {$TABLE_PREFIX}users SET rank_switch='no', `old_rank`=3, `timed_rank`='0000-00-00 00:00:00', id_level =".$arrdt["old_rank"]." WHERE id=".$arrdt["id"]);
                if (substr($FORUMLINK, 0, 3) == "smf") {
                    quickQuery("UPDATE `{$db_prefix}members` SET ".(($FORUMLINK == "smf")?"`ID_GROUP`":"`id_group`")."=".(($arrdt["smf_group_mirror"] > 0)?$arrdt["smf_group_mirror"]:($arrdt["old_rank"] + 10))." WHERE ".
                        (($FORUMLINK == "smf")?"`ID_MEMBER`":"`id_member`")."=".$arrdt["smf_fid"]);
                } elseif ($FORUMLINK == "ipb") {
                    quickQuery("UPDATE `{$ipb_prefix}members` SET `member_group_id`=".(($arrdt["ipb_group_mirror"] > 0)?$arrdt["ipb_group_mirror"]:$arrdt["old_rank"])." WHERE `member_id`=".$arrdt["ipb_fid"]);
                }
                if ($btit_settings["fmhack_torrents_limit"] == "enabled" && $XBTT_USE) {
                    if ($arrdt["custom_torr_limit"] == "no") {
                        quickQuery("UPDATE `xbt_users` SET `torrents_limit`=".$arrdt["torrents_limit"]." WHERE `uid`=".$arrdt["id"]);
                    }
                }
                if ($btit_settings["fmhack_enhanced_wait_time"] == "enabled" && $XBTT_USE) {
                    if ($arrdt["custom_wait_time"] == "no") {
                        quickQuery("UPDATE `xbt_users` SET `wait_time`=".$arrdt["WT"]." WHERE `uid`=".$arrdt["id"]);
                    }
                }
            }
        }
    }
    //timed rank end
    //begin invitation system by dodge
    if ($btit_settings["fmhack_invitation_system"] == "enabled") {
        $deadtime = $INV_EXPIRES * 86400;
        $user = do_sqlquery("SELECT inviter FROM {$TABLE_PREFIX}invitations WHERE time_invited < DATE_SUB(NOW(), INTERVAL $deadtime SECOND)");
        if (@sql_num_rows($user) > 0) {
            $arr = $user->fetch_assoc();
            quickQuery("UPDATE {$TABLE_PREFIX}users SET invitations=invitations+1 WHERE id = '".$arr["inviter"]."'");
            quickQuery("DELETE FROM {$TABLE_PREFIX}invitations WHERE inviter = '".$arr["inviter"]."' AND time_invited < DATE_SUB(NOW(), INTERVAL $deadtime SECOND)");
        }
    }
    //end invitation system
    // Warn System -->
    if ($btit_settings["fmhack_warning_system"] == "enabled") {
        if ($btit_settings["warn_auto_down_enable"] == "yes") {
            $query = do_sqlquery("SELECT `u`.`id`, `u`.`warn_last`, `u`.`warn_lev`, `l`.`language_url`".(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled")?
                ", `u`.`user_notes`":"")." FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language` = `l`.`id`  WHERE `u`.`warn_lev`>0 AND UNIX_TIMESTAMP() >= ((".$btit_settings["warn_auto_decrease"].
            "*86400)+`u`.`warn_last`) AND `u`.`warn_lev`<=".$btit_settings["warn_max"]." ".(($btit_settings["fmhack_booted"] == "enabled")?"AND `u`.`booted`='no'":"")." ORDER BY `l`.`language_url` ASC");
            $templang = "language/english";
            $language = $lang_english;
            if (@sql_num_rows($query) > 0) {
                while ($conf = $query->fetch_array()) {
                    if ($conf["language_url"] != $templang) {
                        $lang_split = explode("/", strtolower(str_replace("-", "_", $conf["language_url"])));
                        $language = ${"lang_".$lang_split[1]};
                        $templang = $conf["language_url"];
                    }
                    $stage4=$btit_settings["warn_max"];
                    $stage3=round($btit_settings["warn_max"]*0.75);
                    $stage2=round($btit_settings["warn_max"]*0.5);
                    $stage1=round($btit_settings["warn_max"]*0.25);
                    $stage0=0;
                    $warn_lev = ($conf["warn_lev"] - 1);
                    if ($warn_lev >= $stage4) {
                        $wl = "[img]".$BASEURL."/images/warned/warn_max.png[/img] (".$warn_lev."/".$stage4.")";
                    } elseif ($warn_lev >= $stage3) {
                        $wl = "[img]".$BASEURL."/images/warned/warn_3.png[/img] (".$warn_lev."/".$stage4.")";
                    } elseif ($warn_lev >= $stage2) {
                        $wl = "[img]".$BASEURL."/images/warned/warn_2.png[/img] (".$warn_lev."/".$stage4.")";
                    } elseif ($warn_lev >= $stage1) {
                        $wl = "[img]".$BASEURL."/images/warned/warn_1.png[/img] (".$warn_lev."/".$stage4.")";
                    } else {
                        $wl = "[img]".$BASEURL."/images/warned/warn_0.png[/img] (".$warn_lev."/".$stage4.")";
                    }
                    quickQuery("INSERT INTO `{$TABLE_PREFIX}warn_logs` (`uid`, `notes`, `contact`, `date_added`, `type`, `added_by`) VALUES (".$conf["id"].", '".sql_esc($language["WS_AUTO_REASON"]).
                        "', 'pm', UNIX_TIMESTAMP(), 'dec', 0)");
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `warn_lev`=".$warn_lev.", `warn_last`=".(($warn_lev == 0)?"0":"UNIX_TIMESTAMP()")." WHERE `id`=".$conf["id"]);
                    send_pm(0, $conf['id'], sqlesc($language['WS_WC_SUBJ']), sqlesc($language['WS_WC_MSG'].":\n\n"."[quote=".$language["SYSTEM_USER"]."]".$language["WS_AUTO_REASON"]."[/quote]"."\n\n".$language["WS_YOUR_CUR_LEV"]."\n\n".$wl."\n\n".
                        (($btit_settings["warn_auto_down_enable"] == "yes" && $warn_lev > 0)?$language["WS_DEC_IN_DAYS_1"]." ".$btit_settings["warn_auto_decrease"]." ".$language["WS_DEC_IN_DAYS_2"]."\n\n":"").$language["WS_AUTO_MSG"].
                        "\n"));
                    if ($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled") {
                        if (isset($conf["user_notes"]) && !empty($conf["user_notes"])) {
                            $usernotes = unserialize(unesc($conf["user_notes"]));
                        } else {
                            $usernotes = array();
                        }
                        $usernotes[] = base64_encode($language["UN_WLEV_DEC"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                        $new_notes = serialize($usernotes);
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$conf["id"]);
                    }
                }
            }
        }
        if ($btit_settings["fmhack_booted"] == "enabled" && $btit_settings["warn_bantype"] == "boot_at_max" && $btit_settings["warn_booted_days"] > 0 && $btit_settings["warn_max"] > 0) {
            $query = do_sqlquery("SELECT `u`.`id`, `u`.`username`, `l`.`language_url`".(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_booted"] == "enabled")?", `u`.`user_notes`":"").
                " FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language` = `l`.`id`  WHERE `u`.`warn_lev`>=".$btit_settings["warn_max"].
                " AND `u`.`booted`='no 'ORDER BY `l`.`language_url` ASC");
            $templang = "language/english";
            $language = $lang_english;
            if (@sql_num_rows($query) > 0) {
                while ($conf = $query->fetch_array()) {
                    if ($conf["language_url"] != $templang) {
                        $lang_split = explode("/", strtolower(str_replace("-", "_", $conf["language_url"])));
                        $language = ${"lang_".$lang_split[1]};
                        $templang = $conf["language_url"];
                    }
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `booted`='yes', `whybooted`='".sql_esc($language['BOOT_GIVE_REA']."<br /><br />".$language["WS_WHY_BOOTED"]."<br /><br />".$language['BOOT_GIVE_WHO'].
                        " ".$language["SYSTEM_USER"]."<br /><br />".$language['BOOT_GIVE_EXP'].": ".date("j M Y \a\\t g:i a", (time() + ($btit_settings["warn_booted_days"] * 86400))))."', `whobooted`='".sql_esc($language["SYSTEM_USER"])."', `addbooted`='".date("Y-m-d H:i:s", (time() + ($btit_settings["warn_booted_days"] * 86400)))."' WHERE `id`=".$conf["id"]);
                    send_pm(0, $conf["id"], sqlesc($language['BOOT_GIVE']), sqlesc($language['BOOT_GIVE_REA']."\n\n".$language["WS_WHY_BOOTED"]."\n\n".$language['BOOT_GIVE_WHO']." ".$language["SYSTEM_USER"]."\n\n".$language['BOOT_GIVE_EXP'].
                        ": ".date("j M Y \a\\t g:i a", (time() + ($btit_settings["warn_booted_days"] * 86400)))));
                    if ($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_booted"] == "enabled" && $btit_settings["un_warn"] == "enabled") {
                        if (isset($conf["user_notes"]) && !empty($conf["user_notes"])) {
                            $usernotes = unserialize(unesc($conf["user_notes"]));
                        } else {
                            $usernotes = array();
                        }
                        $usernotes[] = base64_encode($conf["username"]." ".$language["UN_BOOTED"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                        $new_notes = serialize($usernotes);
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$conf["id"]);
                    }
                }
            }
        }
    }
    // <-- warn System
    if ($btit_settings["fmhack_auto_rank"] == "enabled") {
        do_updateranks();
    }
    // Booted -->
    if ($btit_settings["fmhack_booted"] == "enabled") {
        $warn_dec = false;
        //remove ban after expiration
        $bootedstats = do_sqlquery("SELECT `u`.`id`, `l`.`language_url`".(($btit_settings["fmhack_warning_system"] == "enabled" && $btit_settings["warn_bantype"] == "boot_at_max")?
            ", `u`.`warn_lev`, `u`.`whybooted`".(($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled" && $btit_settings["un_booted"] == "enabled")?", `u`.`user_notes`":""):
            "")." FROM `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}language` `l` ON `u`.`language`=`l`.`id` WHERE `u`.`addbooted` < NOW() AND `u`.`booted`='yes' ORDER BY `l`.`language_url` ASC");
        $templang = "language/english";
        $language = $lang_english;
        if (@sql_num_rows($bootedstats) > 0) {
            while ($arr = $bootedstats->fetch_assoc()) {
                if ($arr["language_url"] != $templang) {
                    $lang_split = explode("/", strtolower(str_replace("-", "_", $arr["language_url"])));
                    $language = ${"lang_".$lang_split[1]};
                    $templang = $arr["language_url"];
                }
                if ($btit_settings["fmhack_warning_system"] == "enabled" && $btit_settings["warn_bantype"] == "boot_at_max" && $btit_settings["warn_auto_down_enable"] == "yes") {
                    if (strpos($arr["whybooted"], $language["WS_WHY_BOOTED"])) {
                        $warn_dec = true;
                        $stage4=$btit_settings["warn_max"];
                        $stage3=round($btit_settings["warn_max"]*0.75);
                        $stage2=round($btit_settings["warn_max"]*0.5);
                        $stage1=round($btit_settings["warn_max"]*0.25);
                        $stage0=0;
                        $warn_lev = ($arr["warn_lev"] - 1);
                        if ($warn_lev >= $stage4) {
                            $wl = "[img]".$BASEURL."/images/warned/warn_max.png[/img] (".$warn_lev."/".$stage4.")";
                        } elseif ($warn_lev >= $stage3) {
                            $wl = "[img]".$BASEURL."/images/warned/warn_3.png[/img] (".$warn_lev."/".$stage4.")";
                        } elseif ($warn_lev >= $stage2) {
                            $wl = "[img]".$BASEURL."/images/warned/warn_2.png[/img] (".$warn_lev."/".$stage4.")";
                        } elseif ($warn_lev >= $stage1) {
                            $wl = "[img]".$BASEURL."/images/warned/warn_1.png[/img] (".$warn_lev."/".$stage4.")";
                        } else {
                            $wl = "[img]".$BASEURL."/images/warned/warn_0.png[/img] (".$warn_lev."/".$stage4.")";
                        }
                        quickQuery("INSERT INTO `{$TABLE_PREFIX}warn_logs` (`uid`, `notes`, `contact`, `date_added`, `type`, `added_by`) VALUES (".$arr["id"].", '".sql_esc($language["WS_AUTO_REASON"]).
                            "', 'pm', UNIX_TIMESTAMP(), 'dec', 0)");
                        $sub = sqlesc($language['WS_WC_SUBJ']);
                        $mess = sqlesc($language['WS_WC_MSG'].":\n\n"."[quote=".$language["SYSTEM_USER"]."]".$language["WS_AUTO_REASON"]."[/quote]"."\n\n".$language["WS_YOUR_CUR_LEV"]."\n\n".$wl."\n\n".(($btit_settings["warn_auto_down_enable"] ==
                            "yes" && $warn_lev > 0)?$language["WS_DEC_IN_DAYS_1"]." ".$btit_settings["warn_auto_decrease"]." ".$language["WS_DEC_IN_DAYS_2"]."\n\n":"").$language["WS_AUTO_MSG"]."\n");
                        send_pm(0, $arr["id"], $sub, $mess);
                    }
                    if ($btit_settings["fmhack_user_notes"] == "enabled" && $btit_settings["un_warn"] == "enabled" && $btit_settings["un_booted"] == "enabled") {
                        if (isset($arr["user_notes"]) && !empty($arr["user_notes"])) {
                            $usernotes = unserialize(unesc($arr["user_notes"]));
                        } else {
                            $usernotes = array();
                        }
                        $usernotes[] = base64_encode($language["UN_WLEV_DEC"]."<+>0<+>".$language["SYSTEM_USER"]."<+>".time());
                        $new_notes = serialize($usernotes);
                        quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `user_notes`='".sql_esc($new_notes)."' WHERE `id`=".$arr["id"]);
                    }
                }
                $sub = sqlesc($language['BOOT_EXP']);
                $mess = sqlesc($language['BOOT_EXP_MSG']);
                send_pm(0, $arr["id"], $sub, $mess);
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `booted`='no', `whybooted`='', `addbooted`='0000-00-00 00:00:00', `whobooted`=''".(($warn_dec === true)?", `warn_lev`=".$warn_lev.
                    ", `warn_last`=UNIX_TIMESTAMP()":"")." WHERE `id`=".$arr["id"]);
            }
        }
    }
    // Booted
    if ($btit_settings["fmhack_lottery"] == "enabled") {
        $query = do_sqlquery("SELECT * FROM `{$TABLE_PREFIX}lottery_config` WHERE `id`=1");
        $config = $query->fetch_array();
        $expire_date = $config['lot_expire_date'];
        $expire = strtotime($expire_date);
        $now = strtotime("now");
        if ($now >= $expire) {
            $number_winners = $config['lot_number_winners'];
            $number_to_win = $config['lot_number_to_win'];
            $minupload = $config['lot_amount'];
            $res = do_sqlquery("SELECT `id`, `user` FROM `{$TABLE_PREFIX}lottery_tickets` ORDER BY RAND(NOW()) LIMIT ".$number_winners.""); //select number of winners
            $total = sql_num_rows(do_sqlquery("SELECT * FROM `{$TABLE_PREFIX}lottery_tickets`")); //select total selled tickets
            $pot = $total * $minupload; //selled tickets * ticket price
            $pot += $number_to_win; // ticket price + minimum win
            $win = (($number_winners == 0)?$pot:($pot / $number_winners)); // price for each winner
            $subject = "You have won a prize in the lottery"; //subject in pm
            $msg = "Congratulations you have won a prize in our Lottery. Your prize has been added to your account. You won ".makesize($win).""; //next 3 rows are the msg for PM
            $sender = $config['sender_id']; // Sender id, in my case 0
            //print the winners and send them PM en give them price
            while ($row = $res->fetch_array()) {
                $ras = do_sqlquery("SELECT `username` FROM `{$TABLE_PREFIX}users` WHERE `id`=".$row['user']."");
                $raw = $ras->fetch_array();
                quickQuery("UPDATE `".(($XBTT_USE)?"xbt_":$TABLE_PREFIX)."users` SET `uploaded`=uploaded+".$win." WHERE `".(($XBTT_USE)?"u":"")."id`=".$row['user']."");
                send_pm($sender, $row["user"], sqlesc($subject), sqlesc($msg));
                quickQuery("INSERT INTO `{$TABLE_PREFIX}lottery_winners` (`id`, `win_user`, `windate`, `price`) VALUES ('', '".$raw['username']."', '".$expire_date."', '".$win."')");
                system_shout("[color=red]Lottery Winner:[/color] ".$raw['username']." won ".sql_esc(makesize($win))."");
                if ($btit_settings["fmhack_IMG_in_SB_after_x_shouts"] == "enabled") {
                    auto_shout(sql_insert_id());
                }
            }
            quickQuery("TRUNCATE TABLE `{$TABLE_PREFIX}lottery_tickets`");
            quickQuery("UPDATE `{$TABLE_PREFIX}lottery_config` SET `lot_status`='closed' WHERE `id`=1");
        }
    }
    if ($btit_settings["fmhack_uploader_medals"] == "enabled") {
        //DT Uploader Medals
        quickQuery("UPDATE {$TABLE_PREFIX}users SET `up_med`='0'");
        $time_B = (86400 * $btit_settings['UPD']);
        $time_E = strtotime(now);
        $time_D = ($time_E - $time_B);
        $res = do_sqlquery("SELECT `uploader`, count(*) `count` FROM `{$TABLE_PREFIX}files` WHERE UNIX_TIMESTAMP(`data`) > ".$time_D." GROUP BY `uploader` ORDER BY `count` DESC LIMIT ".$btit_settings["UPBL"]);
        while ($fetch_U = $res->fetch_array()) {
            quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `up_med`=".$fetch_U["count"]." WHERE `id`=".$fetch_U["uploader"]);
        }
    }
    // donation auto set new month
    if ($btit_settings["fmhack_advanced_auto_donation_system"] == "enabled") {
        $current_month = date("n");
        if (date("j") == 1) {
            $zap_usr = do_sqlquery("SELECT `auto`, `due_date` FROM `{$TABLE_PREFIX}paypal_settings` WHERE `id`=1");
            $setpp = $zap_usr->fetch_assoc();
            if ($setpp["auto"] == "true") {
                if ($current_month == 1 || $current_month == 3 || $current_month == 5 || $current_month == 7 || $current_month == 8 || $current_month == 10 || $current_month == 12) {
                    $days_left_in_month = 30;
                } elseif ($current_month == 4 || $current_month == 6 || $current_month == 9 || $current_month == 11) {
                    $days_left_in_month = 29;
                } elseif ($current_month == 2) {
                    $days_left_in_month = ((date("L") == 1)?28:27);
                } else {
                    $days_left_in_month = false;
                }
                if ($days_left_in_month !== false) {
                    $new_date = date("d/m/y", strtotime("+".$days_left_in_month." days"));
                    if ($new_date != $setpp["due_date"]) {
                        quickQuery("UPDATE `{$TABLE_PREFIX}paypal_settings` SET `due_date`='".$new_date."', `received`=0 WHERE `id`=1");
                    }
                }
            }
        }
    }
    // donation auto set new month end
    if ($btit_settings["fmhack_multi_tracker_scrape"] == "enabled") {
        //Scrape $num_torrents_to_update torrents
        $num_torrents_to_update = 2;
        $torrents = get_result("SELECT `announces`, `info_hash` FROM `{$TABLE_PREFIX}files` WHERE `external`='yes' ORDER BY `lastupdate` DESC LIMIT ".$num_torrents_to_update);
        if (count($torrents)>0) {
            require_once("getscrape_multiscrape.php");
            for ($i = 0; $i < count($torrents); $i++) {
                $announces = @unserialize($torrents[$i]['announces'])?unserialize($torrents[$i]['announces']):array();
                if (count($announces)>0) {
                    $keys = array_keys($announces);
                    $random = mt_rand(0, count($keys) - 1);
                    $url = $keys[$random];
                    scrape($url, $torrents[$i]['info_hash']);
                }
            }
        }
    }
    if ($btit_settings["fmhack_archive_torrents"] == "enabled") {
        $currset=explode("-", $btit_settings["archive_time"]);

        if ($currset[0]<1 || $currset[0]>99) {
            $multiplier=false;
        } else {
            $multiplier=$currset[0];
        }

        if ($currset[1]==1) {
            $frequency=3600;
        } elseif ($currset[1]==2) {
            $frequency=86400;
        } elseif ($currset[1]==3) {
            $frequency=604800;
        } else {
            $frequency=false;
        }

        if ($frequency===false || $multiplier===false) {
            $archive_time=(time()-604800);
        } else {
            $archive_time=(time()-($multiplier*$frequency));
        }

        quickQuery("UPDATE `{$TABLE_PREFIX}files` SET `archive`=1 WHERE UNIX_TIMESTAMP(`data`)<=".$archive_time);
    }
    if ($btit_settings["fmhack_advanced_prune_users_and_torrents"]=="enabled") {
        // Autoprune torrents
        quickQuery("UPDATE `{$TABLE_PREFIX}files` `f` ".(($XBTT_USE)?"LEFT JOIN `xbt_files` `xf` ON `f`.`bin_hash`=`xf`.`info_hash`":"")." SET `f`.`dead_time`=UNIX_TIMESTAMP() WHERE ((".(($XBTT_USE)?"`xf`.`seeders`>0 OR `xf`.`leechers`>0":"`f`.`seeds`>0 OR `f`.`leechers`>0").") OR `f`.`dead_time`=0) AND `f`.`external`='no'");
        $res=get_result("SELECT `info_hash`, `bin_hash` FROM `{$TABLE_PREFIX}files` WHERE `dead_time`<=".(time()-($btit_settings["advprunet_del_torrents"]*86400))." AND `dead_time`!=0 AND `external`='no'");
        if (count($res)>0) {
            foreach ($res as $row) {
                quickQuery("DELETE FROM `{$TABLE_PREFIX}files` WHERE `info_hash`='".sql_esc($row["info_hash"])."'");
                quickQuery("DELETE FROM `{$TABLE_PREFIX}timestamps` WHERE `info_hash`='".sql_esc($row["info_hash"])."'");
                quickQuery("DELETE FROM `{$TABLE_PREFIX}comments` WHERE `info_hash`='".sql_esc($row["info_hash"])."'");
                quickQuery("DELETE FROM `{$TABLE_PREFIX}ratings` WHERE `infohash`='".sql_esc($row["info_hash"])."'");
                quickQuery("DELETE FROM `{$TABLE_PREFIX}peers` WHERE `infohash`='".sql_esc($row["info_hash"])."'");
                quickQuery("DELETE FROM `{$TABLE_PREFIX}history` WHERE `infohash`='".sql_esc($row["info_hash"])."'");
                if ($XBTT_USE) {
                    quickQuery("UPDATE `xbt_files` SET `flags`=1 WHERE `info_hash`='".sql_esc($row["bin_hash"])."'");
                }
            }
        }
        // Autoprune users
        // First warning
  $res=get_result("SELECT `id`, `username`, `email` FROM `{$TABLE_PREFIX}users` WHERE `prune_last_warn`=0 AND `prune_level`=0 AND `id_level` NOT IN (".$btit_settings["advprune_exempt_ranks"].") AND UNIX_TIMESTAMP(`lastconnect`)<(UNIX_TIMESTAMP()-(".$btit_settings["advprune_firstwarn_max"]."*86400))");
        if (count($res)>0) {
            foreach ($res as $row) {
                $email_content=str_replace(array("{member}", "{sitename}", "{siteurl}", "{warn1days}", "{warn2days}", "{warn3days}", "{warnoverall}"), array($row["username"], $SITENAME, $BASEURL, $btit_settings["advprune_firstwarn_max"], $btit_settings["advprune_secondwarn_max"], $btit_settings["advprune_del_after"], ($btit_settings["advprune_secondwarn_max"]+$btit_settings["advprune_del_after"])), $btit_settings["advprune_firstwarn_msg"]);
                send_mail($row["email"], "[".$SITENAME."] ".$language["PRUNE_WARN_SUBJ"], $email_content);
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `prune_last_warn`=UNIX_TIMESTAMP(), `prune_level`=1 WHERE `id`=".$row["id"]);
            }
        }
        // Second warning
$res=get_result("SELECT `id`, `username`, `email` FROM `{$TABLE_PREFIX}users` WHERE `prune_last_warn`<(UNIX_TIMESTAMP()-((".$btit_settings["advprune_secondwarn_max"]."-".$btit_settings["advprune_firstwarn_max"].")*86400)) AND `prune_level`=1 AND `id_level` NOT IN (".$btit_settings["advprune_exempt_ranks"].") AND UNIX_TIMESTAMP(`lastconnect`) < (UNIX_TIMESTAMP()-(".$btit_settings["advprune_secondwarn_max"]."*86400))");
        if (count($res)>0) {
            foreach ($res as $row) {
                $email_content=str_replace(array("{member}", "{sitename}", "{siteurl}", "{warn1days}", "{warn2days}", "{warn3days}", "{warnoverall}"), array($row["username"], $SITENAME, $BASEURL, $btit_settings["advprune_firstwarn_max"], $btit_settings["advprune_secondwarn_max"], $btit_settings["advprune_del_after"], ($btit_settings["advprune_secondwarn_max"]+$btit_settings["advprune_del_after"])), $btit_settings["advprune_secondwarn_msg"]);
                send_mail($row["email"], "[".$SITENAME."] ".$language["PRUNE_WARN_SUBJ"], $email_content);
                quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `prune_last_warn`=UNIX_TIMESTAMP(), `prune_level`=2 WHERE `id`=".$row["id"]);
            }
        }
        // Time to prune
$res=get_result("SELECT `id`, `username`, `email`, `smf_fid`, `ipb_fid` FROM `{$TABLE_PREFIX}users` WHERE `prune_last_warn`<(UNIX_TIMESTAMP()-(".$btit_settings["advprune_del_after"]."*86400)) AND `prune_level`=2 AND `id_level` NOT IN (".$btit_settings["advprune_exempt_ranks"].") AND UNIX_TIMESTAMP(`lastconnect`) < (UNIX_TIMESTAMP()-((".$btit_settings["advprune_del_after"]."+".$btit_settings["advprune_secondwarn_max"].")*86400))");
        if (count($res)>0) {
            foreach ($res as $row) {
                $email_content=str_replace(array("{member}", "{sitename}", "{siteurl}", "{warn1days}", "{warn2days}", "{warn3days}", "{warnoverall}"), array($row["username"], $SITENAME, $BASEURL, $btit_settings["advprune_firstwarn_max"], $btit_settings["advprune_secondwarn_max"], $btit_settings["advprune_del_after"], ($btit_settings["advprune_secondwarn_max"]+$btit_settings["advprune_del_after"])), $btit_settings["advprune_final_msg"]);
                send_mail($row["email"], "[".$SITENAME."] ".$language["PRUNE_WARN_SUBJ2"], $email_content);
                quickQuery("DELETE FROM `{$TABLE_PREFIX}users` WHERE `id`=".$row["id"]." LIMIT 1");
                if (substr($FORUMLINK, 0, 3) == 'smf') {
                    quickQuery("DELETE FROM `{$db_prefix}members` WHERE ".(($FORUMLINK == "smf")?"`ID_MEMBER`":"`id_member`")."=".$row["smf_fid"]." LIMIT 1");
                } elseif ($FORUMLINK == 'ipb') {
                    quickQuery("DELETE FROM `{$ipb_prefix}members` WHERE `member_id`=".$row["ipb_fid"]." LIMIT 1");
                }
                if ($XBTT_USE) {
                    quickQuery("DELETE FROM `xbt_users` WHERE `uid`=".$row["id"]." LIMIT 1");
                }
            }
        }
        // Prune unvalidated users
$res=get_result("SELECT `id`, `smf_fid`, `ipb_fid` FROM `{$TABLE_PREFIX}users` WHERE `id_level`=2 AND UNIX_TIMESTAMP(`lastconnect`) < (UNIX_TIMESTAMP()-(".$btit_settings["advprune_validate_max"]."*86400))");
        if (count($res)>0) {
            foreach ($res as $row) {
                quickQuery("DELETE FROM `{$TABLE_PREFIX}users` WHERE `id`=".$row["id"]." LIMIT 1");
                if (substr($FORUMLINK, 0, 3) == 'smf') {
                    quickQuery("DELETE FROM `{$db_prefix}members` WHERE ".(($FORUMLINK == "smf")?"`ID_MEMBER`":"`id_member`")."=".$row["smf_fid"]." LIMIT 1");
                } elseif ($FORUMLINK == 'ipb') {
                    quickQuery("DELETE FROM `{$ipb_prefix}members` WHERE `member_id`=".$row["ipb_fid"]." LIMIT 1");
                }
                if ($XBTT_USE) {
                    quickQuery("DELETE FROM `xbt_users` WHERE `uid`=".$row["id"]." LIMIT 1");
                }
            }
        }
    }
    if ($btit_settings["fmhack_download_requires_introduction"]=="enabled") {
        quickQuery("UPDATE `{$TABLE_PREFIX}users` `u` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` SET `u`.`made_intro`=1 WHERE `u`.`made_intro`=0 AND `ul`.`down_req_intro`='no'");
        if (substr($FORUMLINK, 0, 3) == "smf" || $FORUMLINK=="ipb") {
            if (substr($FORUMLINK, 0, 3) == "smf") {
                if ($btit_settings["ibd_forumid"]>0 && $btit_settings["ibd_topicid"]>0) {
                    $res=get_result("SELECT `u`.`id`, COUNT(*) FROM `{$db_prefix}messages` `m` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `u`.`smf_fid`=`m`.`id_member` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `m`.`id_board`=".$btit_settings["ibd_forumid"]." AND `m`.`id_topic`=".$btit_settings["ibd_topicid"]." AND `u`.`made_intro`=0 AND `ul`.`down_req_intro`='yes' GROUP BY `m`.`id_member`");
                } else {
                    $res=get_result("SELECT `u`.`id`, COUNT(*) FROM `{$db_prefix}topics` `t` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `u`.`smf_fid`=`t`.`id_member_started` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `t`.`id_board`=".$btit_settings["ibd_forumid"]." AND `u`.`made_intro`=0 AND `ul`.`down_req_intro`='yes' GROUP BY `t`.`id_member_started`");
                }
            } elseif ($FORUMLINK=="ipb") {
                if ($btit_settings["ibd_forumid"]>0 && $btit_settings["ibd_topicid"]>0) {
                    die("SELECT `u`.`id`, COUNT(*) FROM `{$ipb_prefix}posts` `p` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `u`.`ipb_fid`=`p`.`author_id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `p`.`topic_id`=".$btit_settings["ibd_topicid"]." AND `u`.`made_intro` =0 AND `ul`.`down_req_intro`='yes' GROUP BY `p`.`author_id`");
                } else {
                    die("SELECT `u`.`id`, COUNT(*) FROM `{$ipb_prefix}topics` `t` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `u`.`ipb_fid` = `t`.`starter_id` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `t`.`forum_id` =".$btit_settings["ibd_forumid"]." AND `u`.`made_intro`=0 AND `ul`.`down_req_intro`='yes' GROUP BY `t`.`starter_id`");
                }
            }
            if (count($res)>0) {
                $updateList="";
                foreach ($res as $row) {
                    $updateList.=$row["id"].",";
                }
                if ($updateList!="") {
                    $updateList=trim($updateList, ",");
                    quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `made_intro`=1 WHERE `id` IN(".$updateList.")");
                }
            }
        }
    }

    require dirname(__FILE__).'/khez.php';
    quickQuery('OPTIMIZE TABLE `'.$TABLE_PREFIX.'khez_configs`;');
      # hacks can start here ==Khez==

# get config vars
if (!isset($kisfig)) {
    $kisfig=get_khez_config('SELECT `key`,`value` FROM `'.$TABLE_PREFIX.'khez_configs` WHERE `key` LIKE "kis_%" LIMIT 7;', $reload_cfg_interval);
    require load_language('lang_kis.php');
    require dirname(__FILE__).'/kis.php';
}
    if ($kisfig['kis_enabled'] && $kisfig['kis_invExpireAmmount']!=0) {
        # remove old invites
    $last=getTime(-$kisfig['kis_invExpireAmmount'], $kisfig['kis_invExpireType']);
        $old=get_result('SELECT uid FROM `'.$TABLE_PREFIX.'kis_sent` WHERE `time`<'.$last.' AND used=0;');
    # inits
    if (isset($old[0])) {
        $i=0;
        $j=0;
        $users=array();
        $subject=sqlesc($language['KIS_SANITY_TITLE']);
        $msg=sqlesc($language['KIS_SANITY_BODY']);
        foreach ($old as $invite) {
            $i++;
            $users[$invite['uid']]++;
        }
        foreach ($users as $uid => $invites) {
            $j++;
            kisMod($uid, $invites);
            send_pm(0, $uid, $subject, $msg);
        }
        quickQuery('DELETE FROM `'.$TABLE_PREFIX.'kis_sent` WHERE `time`<'.$last.' AND used=0;');
        if ($kisfig['kis_logs']) {
            write_log('[KIS] Sanity cleaned '.$i.' old invites from '.$j.' users.', 'delete');
        }
    }
    }

    // OK We're finished, let's reset max_execution_time and memory_limit back to the php.ini defaults
@ini_restore("max_execution_time");
    @ini_restore("memory_limit");
}
