<?php

if (!defined("IN_BTIT"))
die("non direct access!");

if (!defined("IN_ACP"))
die("non direct access!");



$admintpl->set("config_saved",false,true);
$admintpl->set("xbtt_error",false,true);

switch ($action)
{
   case 'write':
   if ($_POST["write"]==$language["FRM_CONFIRM"])
   {
      //$btit_settings=array();
      $btit_settings["name"]=$_POST["trackername"];
      $btit_settings["url"]=$_POST["trackerurl"];
      //        $btit_settings["announce"]=serialize(explode("\n",$_POST["announceurl"]));
      $btit_settings["announce"]=serialize(explode("\n",$_POST["tracker_announceurl"]));
      $btit_settings["email"]=$_POST["trackeremail"];
      $btit_settings["torrentdir"]=$_POST["torrentdir"];
      $btit_settings["external"]=isset($_POST["exttorrents"])?"true":"false";
      $btit_settings["gzip"]=isset($_POST["gzip_enabled"])?"true":"false";
      $btit_settings["debug"]=isset($_POST["show_debug"])?"true":"false";
      $btit_settings["disable_dht"]=isset($_POST["dht"])?"true":"false";
      $btit_settings["livestat"]=isset($_POST["livestat"])?"true":"false";
      $btit_settings["logactive"]=isset($_POST["logactive"])?"true":"false";
      $btit_settings["loghistory"]=isset($_POST["loghistory"])?"true":"false";
      $btit_settings["p_announce"]=isset($_POST["p_announce"])?"true":"false";
      $btit_settings["p_scrape"]=isset($_POST["p_scrape"])?"true":"false";
      $btit_settings["show_uploader"]=isset($_POST["show_uploader"])?"true":"false";
      $btit_settings["usepopup"]=isset($_POST["usepopup"])?"true":"false";
      $btit_settings["default_language"]=$_POST["default_langue"];
      $btit_settings["default_style"]=$_POST["default_style"];
      $btit_settings["default_charset"]=$_POST["default_charset"];
      $btit_settings["max_users"]=$_POST["maxusers"];
      if($btit_settings["max_torrents_per_page"]!=$_POST["ntorrents"])
      {
         $old_setting=$btit_settings["max_torrents_per_page"];
         $alter=true;
      }
      $btit_settings["max_torrents_per_page"]=$_POST["ntorrents"];
      $btit_settings["sanity_update"]=$_POST["sinterval"];
      $btit_settings["external_update"]=$_POST["uinterval"];
      $btit_settings["max_announce"]=$_POST["rinterval"];
      $btit_settings["min_announce"]=$_POST["mininterval"];
      $btit_settings["max_peers_per_announce"]=$_POST["maxpeers"];
      $btit_settings["dynamic"]=isset($_POST["dynamic"])?"true":"false";
      $btit_settings["nat"]=isset($_POST["nat"])?"true":"false";
      $btit_settings["persist"]=isset($_POST["persist"])?"true":"false";
      $btit_settings["allow_override_ip"]=isset($_POST["override"])?"true":"false";
      $btit_settings["countbyte"]=isset($_POST["countbyte"])?"true":"false";
      $btit_settings["peercaching"]=isset($_POST["peercaching"])?"true":"false";
      $btit_settings["maxpid_seeds"]=$_POST["maxseeds"];
      $btit_settings["maxpid_leech"]=$_POST["maxleech"];
      $btit_settings["validation"]=$_POST["validation"];
      $btit_settings["imagecode"]=isset($_POST["imagecode"])?"true":"false";
      $btit_settings["forum"]=$_POST["f_link"];
      $btit_settings["shout_history_pp"]=$_POST["shout_history_pp"];

      if($btit_settings["fmhack_integrated_forum_display"]=="enabled")
      {
         if($_POST["for_disp_sel"]=="iframe" || $_POST["for_disp_sel"]=="_self" || $_POST["for_disp_sel"]=="_blank")
         $btit_settings["forum_viewtype"]=$_POST["for_disp_sel"];
         else
         $btit_settings["forum_viewtype"]="iframe";
      }
      $btit_settings["ipb_autoposter"]=((isset($_POST["ipb_autoposter"]) && !empty($_POST["ipb_autoposter"]))?$_POST["ipb_autoposter"]:0);
      $btit_settings["clocktype"]=$_POST["clocktype"];
      $btit_settings["up_all"]=$_POST["up_all"];
      $btit_settings["up_id"]=$_POST["up_id"];
      $btit_settings["forumblocktype"]=$_POST["forumblocktype"];
      $btit_settings["newslimit"]=$_POST["newslimit"];
      $btit_settings["forumlimit"]=$_POST["forumlimit"];
      $btit_settings["last10limit"]=$_POST["last10limit"];
      $btit_settings["mostpoplimit"]=$_POST["mostpoplimit"];
      $btit_settings["html_entities"]=isset($_POST["parsetype"]) && $_POST["parsetype"]=="false"?"enabled":"disabled";

      // dt last upload jquery block
      $btit_settings["scrolw"]=$_POST["scrolw"];
      $btit_settings["nav"]=$_POST["nav"];
      // dt last upload jquery block

      // SeedBonus (BON) Multiplier
      $btit_settings["multie"]=$_POST["multie"];
      // SeedBonus (BON) Multiplier

      if (isset($_POST["xbtt_use"]))
      {
         // check base xbtt url
         if ($_POST["xbtt_url"]!="")
         {
            // check if XBTT tables are present in current db
            $res=do_sqlquery("SHOW TABLES LIKE 'xbt_%'");
            $xbt_tables=array('xbt_announce_log','xbt_config','xbt_deny_from_clients','xbt_deny_from_hosts','xbt_files','xbt_files_users','xbt_scrape_log','xbt_users');
            $xbt_in_db=array();
            if ($res)
            {
               while ($result=$res->fetch_row())
               {
                  $xbt_in_db[]=$result[0];
               }
            }
            $ad=array_diff($xbt_tables,$xbt_in_db);
            // some xbtt tables missed!
            if (count($ad)!=0)
            {
               $btit_settings["xbtt_use"]="false";
               $admintpl->set("xbtt_error",true,true);
            }
            else
            {
               $btit_settings["xbtt_use"]="true";
               $admintpl->set("xbtt_error",false,true);
               // save some settings into xbt_config table
               $xbt_cfg="('anonymous_announce','anonymous_scrape','announce_interval','auto_register')";
               quickQuery("DELETE FROM xbt_config WHERE name IN $xbt_cfg",true);
               quickQuery("INSERT INTO xbt_config (name,value) VALUES ".
               "('anonymous_announce','".($btit_settings["p_announce"]=="false"?1:0)."'),".
               "('anonymous_scrape','".($btit_settings["p_scrape"]=="false"?1:0)."'),".
               "('announce_interval','".$btit_settings["max_announce"]."'),".
               "('auto_register','0');",true);
               // insert non exist torrent into xbt_files
               quickQuery("INSERT INTO xbt_files (info_hash, mtime, ctime) SELECT bin_hash, unix_timestamp(), unix_timestamp() FROM {$TABLE_PREFIX}files WHERE bin_hash NOT IN (SELECT info_hash FROM xbt_files) AND external='no'",true);
               // control missed field (latest xbt don't have torrent_pass field)
               $mf=do_sqlquery("SHOW COLUMNS FROM xbt_users");
               $tp_present=false;
               $tpv_present=false;
               while($fn=$mf->fetch_assoc()){
                  $fnr = $fn['Field'];

                  if($fnr=="torrent_pass")
                  $tp_present=true;
                  if($fnr=="torrent_pass_version")
                  $tpv_present=true;
               }
               if (!$tp_present)
               do_sqlquery("ALTER TABLE xbt_users ADD torrent_pass CHAR(32) NOT NULL, ADD torrent_pass_secret bigint unsigned not null;",true);
               if ($tpv_present)
               do_sqlquery("ALTER TABLE `xbt_users` CHANGE `torrent_pass_version` `torrent_pass_version` INT(11) NOT NULL DEFAULT '0'",true);

               // insert missed users in xbt_users
               quickQuery("INSERT INTO xbt_users (uid, torrent_pass) SELECT id,pid FROM {$TABLE_PREFIX}users WHERE id NOT IN (SELECT uid FROM xbt_users)",true);

               if($btit_settings["fmhack_upload_multiplier"]=="enabled")
               {
                  quickQuery("UPDATE `xbt_files` `x` LEFT JOIN `{$TABLE_PREFIX}files` `f` ON `f`.`bin_hash`=`x`.`info_hash` SET `x`.`up_multi`=(`f`.`multiplier`*100), `x`.`flags`=2", true);
               }

               if($btit_settings["fmhack_free_leech_with_happy_hour"]=="enabled")
               {
                  $free_res=get_result("SELECT UNIX_TIMESTAMP(`free_expire_date`) `free_expire_date`, `free` FROM `{$TABLE_PREFIX}files` WHERE `external`='no' LIMIT 1",true,$btit_settings["cache_duration"]);
                  $free_row=$free_res[0];
                  if($free_row["free"]=="no" || ($free_row["free"]=="yes" && time()>$free_row["free_expire_date"]))
                  {
                     if($btit_settings["fmhack_gold_and_silver_torrents"]=="enabled")
                     {
                        $gold_res=do_sqlquery("SELECT `gold_percentage`, `silver_percentage`, `bronze_percentage` FROM `{$TABLE_PREFIX}gold` WHERE `id`=1", true);
                        $gold_row=$gold_res->fetch_assoc();
                        $file_res = do_sqlquery("SELECT `gold`, `info_hash` FROM `{$TABLE_PREFIX}files` WHERE `external`='no'", true);
                        $restore_classic="";
                        $restore_gold="";
                        $restore_silver="";
                        $restore_bronze="";
                        while($file_row = $file_res->fetch_assoc())
                        {
                           if($file_row["gold"]==0)
                           $restore_classic.="0x".$file_row["info_hash"].",";
                           elseif($file_row["gold"]==1)
                           $restore_silver.="0x".$file_row["info_hash"].",";
                           elseif($file_row["gold"]==2)
                           $restore_gold.="0x".$file_row["info_hash"].",";
                           if($file_row["gold"]==3)
                           $restore_bronze.="0x".$file_row["info_hash"].",";
                        }
                        $restore_classic=trim($restore_classic,",");
                        $restore_gold=trim($restore_gold,",");
                        $restore_silver=trim($restore_silver,",");
                        $restore_bronze=trim($restore_bronze,",");

                        if($restore_classic!="")
                        quickQuery("UPDATE `xbt_files` SET `down_multi`=100, `flags`=2 WHERE `info_hash` IN(".$restore_classic.")", true);
                        if($gold_row["gold_percentage"]>0 && $restore_gold!="")
                        quickQuery("UPDATE `xbt_files` SET `down_multi`='".$gold_row["gold_percentage"]."', `flags`=2 WHERE `info_hash` IN(".$restore_gold.")", true);
                        if($restore_silver!="")
                        quickQuery("UPDATE `xbt_files` SET `down_multi`='".$gold_row["silver_percentage"]."', `flags`=2 WHERE `info_hash` IN(".$restore_silver.")", true);
                        if($restore_bronze!="")
                        quickQuery("UPDATE `xbt_files` SET `down_multi`='".$gold_row["bronze_percentage"]."', `flags`=2 WHERE `info_hash` IN(".$restore_bronze.")", true);
                     }
                     else
                     {
                        quickQuery("UPDATE `xbt_files` SET `down_multi`=100, `flags`=2", true);
                     }
                     do_sqlquery("ALTER TABLE `xbt_files` CHANGE `down_multi` `down_multi` INT NULL DEFAULT '100'", true);
                  }
                  elseif($free_row["free"]=="yes" && time()<=$free_row["free_expire_date"])
                  {
                     quickQuery("UPDATE `xbt_files` SET `down_multi`=0, `flags`=2", true);
                     do_sqlquery("ALTER TABLE `xbt_files` CHANGE `down_multi` `down_multi` INT NULL DEFAULT '0'", true);
                  }
               }
               else
               {
                  if($btit_settings["fmhack_gold_and_silver_torrents"]=="enabled")
                  {
                     $gold_res=do_sqlquery("SELECT `gold_percentage`, `silver_percentage`, `bronze_percentage` FROM `{$TABLE_PREFIX}gold` WHERE `id`=1", true);
                     $gold_row=$gold_res->fetch_assoc();
                     $file_res = do_sqlquery("SELECT `gold`, `info_hash` FROM `{$TABLE_PREFIX}files` WHERE `external`='no'", true);
                     $restore_classic="";
                     $restore_gold="";
                     $restore_silver="";
                     $restore_bronze="";
                     while($file_row = $file_res->fetch_assoc())
                     {
                        if($file_row["gold"]==0)
                        $restore_classic.="0x".$file_row["info_hash"].",";
                        elseif($file_row["gold"]==1)
                        $restore_silver.="0x".$file_row["info_hash"].",";
                        elseif($file_row["gold"]==2)
                        $restore_gold.="0x".$file_row["info_hash"].",";
                        if($file_row["gold"]==3)
                        $restore_bronze.="0x".$file_row["info_hash"].",";
                     }
                     $restore_classic=trim($restore_classic,",");
                     $restore_gold=trim($restore_gold,",");
                     $restore_silver=trim($restore_silver,",");
                     $restore_bronze=trim($restore_bronze,",");

                     if($restore_classic!="")
                     quickQuery("UPDATE `xbt_files` SET `down_multi`=100, `flags`=2 WHERE `info_hash` IN(".$restore_classic.")", true);
                     if($gold_row["gold_percentage"]>0 && $restore_gold!="")
                     quickQuery("UPDATE `xbt_files` SET `down_multi`='".$gold_row["gold_percentage"]."', `flags`=2 WHERE `info_hash` IN(".$restore_gold.")", true);
                     if($restore_silver!="")
                     quickQuery("UPDATE `xbt_files` SET `down_multi`='".$gold_row["silver_percentage"]."', `flags`=2 WHERE `info_hash` IN(".$restore_silver.")", true);
                     if($restore_bronze!="")
                     quickQuery("UPDATE `xbt_files` SET `down_multi`='".$gold_row["bronze_percentage"]."', `flags`=2 WHERE `info_hash` IN(".$restore_bronze.")", true);
                  }
               }
            }
         }
         else
         {
            $language["XBTT_TABLES_ERROR"]=$language["XBTT_URL_ERROR"];
            $btit_settings["xbtt_use"]="false";
            $admintpl->set("xbtt_error",true,true);
         }
      }
      else
      {
         $btit_settings["xbtt_use"]="false";
      }
      $btit_settings["xbtt_url"]=$_POST["xbtt_url"];
      $btit_settings["cache_duration"]=$_POST["cache_duration"];
      $btit_settings["cut_name"]=intval($_POST["cut_name"]);

      $btit_settings["mail_type"]=$_POST["mail_type"];
      if ($btit_settings["mail_type"]=="smtp")
      {
         $btit_settings["smtp_server"]=$_POST["smtp_server"];
         $btit_settings["smtp_port"]=$_POST["smtp_port"];
         $btit_settings["smtp_username"]=$_POST["smtp_username"];
         $btit_settings["smtp_password"]=$_POST["smtp_password"];
      }

      foreach($btit_settings as $key=>$value)
      {
         if (is_bool($value))
         $value==true ? $value='true' : $value='false';

         $values[]="(".sqlesc($key).",".sqlesc($value).")";
      }

      //die(implode(",",$values));
      quickQuery("DELETE FROM {$TABLE_PREFIX}settings") or stderr($language["ERROR"],sql_error());
      quickQuery("INSERT INTO {$TABLE_PREFIX}settings (`key`,`value`) VALUES ".implode(",",$values).";") or stderr($language["ERROR"],sql_error());
      // update guest values for language, style, torrentsxpage etc...
      quickQuery("UPDATE {$TABLE_PREFIX}users SET language=".sqlesc($btit_settings["default_language"]).",
      style=".sqlesc($btit_settings["default_style"]).",
      torrentsperpage=".sqlesc($btit_settings["max_torrents_per_page"])." WHERE id=1") or stderr($language["ERROR"],sql_error());

      if($alter===true)
      {
         quickQuery("ALTER TABLE `{$TABLE_PREFIX}users` CHANGE `torrentsperpage` `torrentsperpage` TINYINT( 3 ) UNSIGNED NOT NULL DEFAULT ".sqlesc($btit_settings["max_torrents_per_page"]));
         quickQuery("UPDATE `{$TABLE_PREFIX}users` SET `torrentsperpage`=".sqlesc($btit_settings["max_torrents_per_page"])." WHERE `torrentsperpage`=".sqlesc($old_setting));
      }

      unset($values);

      $admintpl->set("config_saved",true,true);
   }
   // we don't break, so we will display the new config...

   case 'read':
   case '':
   default:
   $admintpl->set("language",$language);

   $btit_settings=get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}settings");

   // some $btit_settings are stored in database, some other not like in template
   // we will convert and set to correct value in the array.
   if (is_array(unserialize($btit_settings["announce"])))
   $btit_settings["announce"]=implode("\n",unserialize($btit_settings["announce"]));
   $btit_settings["external"]=($btit_settings["external"]=="true"?"checked=\"checked\"":"");
   $btit_settings["gzip"]=($btit_settings["gzip"]=="true"?"checked=\"checked\"":"");
   $btit_settings["debug"]=($btit_settings["debug"]=="true"?"checked=\"checked\"":"");
   $btit_settings["disable_dht"]=($btit_settings["disable_dht"]=="true"?"checked=\"checked\"":"");
   $btit_settings["livestat"]=($btit_settings["livestat"]=="true"?"checked=\"checked\"":"");
   $btit_settings["logactive"]=($btit_settings["logactive"]=="true"?"checked=\"checked\"":"");
   $btit_settings["loghistory"]=($btit_settings["loghistory"]=="true"?"checked=\"checked\"":"");
   $btit_settings["p_announce"]=($btit_settings["p_announce"]=="true"?"checked=\"checked\"":"");
   $btit_settings["p_scrape"]=($btit_settings["p_scrape"]=="true"?"checked=\"checked\"":"");
   $btit_settings["show_uploader"]=($btit_settings["show_uploader"]=="true"?"checked=\"checked\"":"");
   $btit_settings["usepopup"]=($btit_settings["usepopup"]=="true"?"checked=\"checked\"":"");
   $btit_settings["dynamic"]=($btit_settings["dynamic"]=="true"?"checked=\"checked\"":"");
   $btit_settings["nat"]=($btit_settings["nat"]=="true"?"checked=\"checked\"":"");
   $btit_settings["persist"]=($btit_settings["persist"]=="true"?"checked=\"checked\"":"");
   $btit_settings["allow_override_ip"]=($btit_settings["allow_override_ip"]=="true"?"checked=\"checked\"":"");
   $btit_settings["countbyte"]=($btit_settings["countbyte"]=="true"?"checked=\"checked\"":"");
   $btit_settings["peercaching"]=($btit_settings["peercaching"]=="true"?"checked=\"checked\"":"");
   $btit_settings["imagecode"]=($btit_settings["imagecode"]=="true"?"checked=\"checked\"":"");
   $btit_settings["clockanalog"]=($btit_settings["clocktype"]?"checked=\"checked\"":"");
   $btit_settings["clockdigital"]=(!$btit_settings["clocktype"]?"checked=\"checked\"":"");
   $btit_settings["up_allyes"]=($btit_settings["up_all"]?"checked=\"checked\"":"");
   $btit_settings["up_allno"]=(!$btit_settings["up_all"]?"checked=\"checked\"":"");
   $btit_settings["forumblockposts"]=($btit_settings["forumblocktype"]?"checked=\"checked\"":"");
   $btit_settings["forumblocktopics"]=(!$btit_settings["forumblocktype"]?"checked=\"checked\"":"");
   $btit_settings["xbtt_use"]=($btit_settings["xbtt_use"]=="true"?"checked=\"checked\"":"");
   $btit_settings["HTML_ENT"]=($btit_settings["html_entities"]=="enabled"?"checked=\"checked\"":"");
   $btit_settings["HTML_SPECIAL"]=($btit_settings["html_entities"]!="enabled"?"checked=\"checked\"":"");

   // dt last upload jquery block
   $btit_settings["navyes"]=($btit_settings["nav"]?"checked=\"checked\"":"");
   $btit_settings["navno"]=(!$btit_settings["nav"]?"checked=\"checked\"":"");
   // dt last upload jquery block

   // language dropdown
   $lres=language_list();
   $btit_settings["language_combo"]=("\n<select name=\"default_langue\" size=\"1\">");
   foreach($lres as $langue)
   {
      $btit_settings["language_combo"].="\n<option ";
      if ($langue["id"]==$btit_settings["default_language"])
      $btit_settings["language_combo"].="selected=\"selected\" ";
      $btit_settings["language_combo"].="value=\"".$langue["id"]."\">".$langue["language"]."</option>";
      $btit_settings["language_combo"].=($option);
   }
   $btit_settings["language_combo"].=("\n</select>\n");
   unset($lres);

   // SeedBonus (BON) Multiplier
        $btit_settings["multie_combo"]="
                    <select name=\"multie\" size=\"1\">
                    <option value=\"1\"".($btit_settings["multie"]=="1"?" selected=\"selected\"":"").">1x</option>
                    <option value=\"2\"".($btit_settings["multie"]=="2"?" selected=\"selected\"":"").">2x</option>
                    <option value=\"3\"".($btit_settings["multie"]=="3"?" selected=\"selected\"":"").">3x</option>
                    <option value=\"4\"".($btit_settings["multie"]=="4"?" selected=\"selected\"":"").">4x</option>
                    <option value=\"5\"".($btit_settings["multie"]=="5"?" selected=\"selected\"":"").">5x</option>
                    <option value=\"6\"".($btit_settings["multie"]=="6"?" selected=\"selected\"":"").">6x</option>
                    <option value=\"7\"".($btit_settings["multie"]=="7"?" selected=\"selected\"":"").">7x</option>
                    <option value=\"8\"".($btit_settings["multie"]=="8"?" selected=\"selected\"":"").">8x</option>
                    <option value=\"9\"".($btit_settings["multie"]=="9"?" selected=\"selected\"":"").">9x</option>
                    <option value=\"10\"".($btit_settings["multie"]=="10"?" selected=\"selected\"":"").">10x</option>
                    </select>";
   // SeedBonus (BON) Multiplier
                    
   // charset
   $btit_settings["charset_combo"]="\n<select name=\"default_charset\" size=\"1\">";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-1"?" selected=\"selected\"":"").">ISO-8859-1</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-2"?" selected=\"selected\"":"").">ISO-8859-2</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-3"?" selected=\"selected\"":"").">ISO-8859-3</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-4"?" selected=\"selected\"":"").">ISO-8859-4</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-5"?" selected=\"selected\"":"").">ISO-8859-5</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-6"?" selected=\"selected\"":"").">ISO-8859-6</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-6-e"?" selected=\"selected\"":"").">ISO-8859-6-e</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-6-i"?" selected=\"selected\"":"").">ISO-8859-6-i</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-7"?" selected=\"selected\"":"").">ISO-8859-7</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-8"?" selected=\"selected\"":"").">ISO-8859-8</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-8-e"?" selected=\"selected\"":"").">ISO-8859-8-e</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-8-i"?" selected=\"selected\"":"").">ISO-8859-8-i</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-9"?" selected=\"selected\"":"").">ISO-8859-9</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-10"?" selected=\"selected\"":"").">ISO-8859-10</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-13"?" selected=\"selected\"":"").">ISO-8859-13</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-14"?" selected=\"selected\"":"").">ISO-8859-14</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-8859-15"?" selected=\"selected\"":"").">ISO-8859-15</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="UTF-8"?" selected=\"selected\"":"").">UTF-8</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="ISO-2022-JP"?" selected=\"selected\"":"").">ISO-2022-JP</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="EUC-JP"?" selected=\"selected\"":"").">EUC-JP</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="Shift_JIS"?" selected=\"selected\"":"").">Shift_JIS</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="GB2312"?" selected=\"selected\"":"").">GB2312</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="Big5"?" selected=\"selected\"":"").">Big5</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="EUC-KR"?" selected=\"selected\"":"").">EUC-KR</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="windows-1250"?" selected=\"selected\"":"").">windows-1250</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="windows-1251"?" selected=\"selected\"":"").">windows-1251</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="windows-1252"?" selected=\"selected\"":"").">windows-1252</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="windows-1253"?" selected=\"selected\"":"").">windows-1253</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="windows-1254"?" selected=\"selected\"":"").">windows-1254</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="windows-1255"?" selected=\"selected\"":"").">windows-1255</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="windows-1256"?" selected=\"selected\"":"").">windows-1256</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="windows-1257"?" selected=\"selected\"":"").">windows-1257</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="windows-1258"?" selected=\"selected\"":"").">windows-1258</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="KOI8-R"?" selected=\"selected\"":"").">KOI8-R</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="KOI8-U"?" selected=\"selected\"":"").">KOI8-U</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="cp866"?" selected=\"selected\"":"").">cp866</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="cp874"?" selected=\"selected\"":"").">cp874</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="TIS-620"?" selected=\"selected\"":"").">TIS-620</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="VISCII"?" selected=\"selected\"":"").">VISCII</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="VPS"?" selected=\"selected\"":"").">VPS</option>";
   $btit_settings["charset_combo"].="\n<option".($btit_settings["default_charset"]=="TCVN-5712"?" selected=\"selected\"":"").">TCVN-5712</option>";
   $btit_settings["charset_combo"].="\n</select>";
   // style dropdown
   $sres=style_list();
   $btit_settings["style_combo"]="\n<select name=\"default_style\" size=\"1\">";
   foreach($sres as $style)
   {
      $btit_settings["style_combo"].="\n<option ";
      if ($style["id"]==$btit_settings["default_style"])
      $btit_settings["style_combo"].="selected=\"selected\" ";
      $btit_settings["style_combo"].="value=\"".$style["id"]."\">".$style["style"]."</option>";
   }
   $btit_settings["style_combo"].="\n</select>\n";
   unset($sres);
   // validation dropdown
   $btit_settings["validation_combo"]="
   <select name=\"validation\" size=\"1\">
   <option value=\"none\"".($btit_settings["validation"]=="none"?" selected=\"selected\"":"").">".$language["NONE"]."</option>
   <option value=\"user\"".($btit_settings["validation"]=="user"?" selected=\"selected\"":"").">".$language["USER"]."</option>
   <option value=\"admin\"".($btit_settings["validation"]=="admin"?" selected=\"selected\"":"").">Admin</option>
   </select>";


   // cut torrent's name
   $btit_settings["cut_name"]=intval($btit_settings["cut_name"]);
   // mailer
   $btit_settings["mail_type_combo"]="\n<option value=\"php\"".($btit_settings["mail_type"]=="php"?"selected=\"selected\"":"").">PHP (default)</option>";
   $btit_settings["mail_type_combo"].="\n<option value=\"smtp\"".($btit_settings["mail_type"]=="smtp"?"selected=\"selected\"":"").">SMTP</option>";

   $btit_settings["smtp_server"]=isset($btit_settings["smtp_server"])?$btit_settings["smtp_server"]:"";
   $btit_settings["smtp_port"]=isset($btit_settings["smtp_port"])?$btit_settings["smtp_port"]:"25";
   $btit_settings["smtp_username"]=isset($btit_settings["smtp_username"])?$btit_settings["smtp_username"]:"";
   $btit_settings["smtp_password"]=isset($btit_settings["smtp_password"])?$btit_settings["smtp_password"]:"";
   $admintpl->set("config",$btit_settings);
   $admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=config&amp;action=write");

   $admintpl->set("forum_en_enabled", (($btit_settings["fmhack_integrated_forum_display"]=="enabled")?true:false), true);
   $admintpl->set("forum_colspan",(($btit_settings["fmhack_integrated_forum_display"]=="enabled")?"":" colspan='3'"));
   $admintpl->set("forum_size",(($btit_settings["fmhack_integrated_forum_display"]=="enabled")?"20":"40"));

   if($btit_settings["fmhack_integrated_forum_display"]=="enabled")
   {
      $forum_display_select ="<select name='for_disp_sel'>";
      if($FORUMLINK=="ipb" || substr($FORUMLINK,0,3)=="smf")
      {
         $forum_display_select.="<option value='iframe'".(($btit_settings["forum_viewtype"]=="iframe")?" selected='yes'":"").">".$language["FORUM_OPTION_1"]."</option>";
         $forum_display_select.="<option value='_self'".(($btit_settings["forum_viewtype"]=="_self")?" selected='yes'":"").">".$language["FORUM_OPTION_2"]."</option>";
         $forum_display_select.="<option value='_blank'".(($btit_settings["forum_viewtype"]=="_blank")?" selected='yes'":"").">".$language["FORUM_OPTION_3"]."</option>";
      }
      else
      $forum_display_select.="<option value='false'>".$language["NA"]."</option>";
      $forum_display_select.="</select>";
   }
   else
   $forum_display_select="";

   $admintpl->set("ipb_in_use", (($btit_settings["forum"]=="ipb")?true:false), true);

   $admintpl->set("forum_display_select", $forum_display_select);
   break;
}
?>
