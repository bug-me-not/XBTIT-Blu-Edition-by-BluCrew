<?php

if(!IN_BTIT)
	redirect("index.php");

if(isset($_GET['id']))
	$uid = $_GET['id'];
else
	$uid = $CURUSER['uid'];

if(!isset($_GET['type']))
	stderr("Error","You need to specift type and unique ID.");
elseif($_GET['type']!='seeding' || $_GET['type']!='snatched' || $_GET['type']!='uploaded')
	$type = 'snatched';
//else
//	$type = $_GET['type'];

if($CURUSER["uid"]!=$uid && $CURUSER["view_users"] != "yes")
{
	err_msg($language["ERROR"], $language["NOT_AUTHORIZED"]." ".$language["MEMBERS"]);
	stdfoot();
	die();
}

//Need to create a dedicated page for this
if($XBTT_USE)
{
	$tseeds = "f.seeds+ifnull(x.seeders,0)";
	$tleechs = "f.leechers+ifnull(x.leechers,0)";
	$tcompletes = "f.finished+ifnull(x.completed,0)";
	$ttables = "{$TABLE_PREFIX}files f LEFT JOIN xbt_files x ON x.info_hash=f.bin_hash";
	$udownloaded = "u.downloaded+IFNULL(x.downloaded,0)";
	$uuploaded = "u.uploaded+IFNULL(x.uploaded,0)";
	$utables = "{$TABLE_PREFIX}users u LEFT JOIN xbt_users x ON x.uid=u.id";
}
else
{
	$tseeds = "f.seeds";
	$tleechs = "f.leechers";
	$tcompletes = "f.finished";
	$ttables = "{$TABLE_PREFIX}files f";
	$udownloaded = "u.downloaded";
	$uuploaded = "u.uploaded";
	$utables = "{$TABLE_PREFIX}users u";
}
//Need to create a dedicated page for this

$all_torrents = new bTemplate();

$torrent_sorting = ($btit_settings["fmhack_profile_torrent_sorting"]=="enabled")?true:false;
$hnr_system = ($btit_settings["fmhack_anti_hit_and_run_system"]=="enabled")?true:false;
$torrent_times = ($btit_settings['fmhack_torrent_times']=="enabled")?true:false;
$torrent_mod = (($btit_settings["fmhack_torrent_moderation"] == "enabled")?true:false);

$pager_limit = 15;

if($type=='seeding')
{



	$all_torrents->set("header",$language['ALL_SEEDING']);
	$all_torrents->set("pagertop",$pagertop);
	$all_torrents->set("seeding",true,true);
	$all_torrents->set("seeding_table",_seeding());
	$all_torrents->set("snatched",false,true);
	$all_torrents->set("uploaded",false,true);
	$all_torrents->set("pagerbottom",$pagerbottom);
}
elseif($type=='snatched')
{
	$sntpl = new bTemplate();

	$query_snatched_join = ""; $query_snatched_where = "";
	if($btit_settings["fmhack_torrent_moderation"] == "enabled" || $btit_settings["fmhack_teams"] == "enabled")
	{
		if($XBTT_USE)
			$query_snatched_join .= "INNER JOIN `{$TABLE_PREFIX}files` `xf` ON `f`.`info_hash`=`xf`.`bin_hash`";
	}
	if($btit_settings["fmhack_torrent_moderation"] == "enabled")
	{
		if($btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes")
		{
			$query_snatched_join .= "LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `".(($XBTT_USE)?"x":"")."f`.`approved_by`=`u2`.`id` ";
		}
		if($CURUSER["moderate_trusted"] != "yes")
			$query_snatched_where .= "AND `".(($XBTT_USE)?"x":"")."f`.`moder`='ok' ";
	}
	if($btit_settings["fmhack_teams"] == "enabled" && $btit_settings["team_state"] == "private")
		$query_snatched_where .= "AND (".$CURUSER['team']." = `".(($XBTT_USE)?"x":"")."f`.`team` OR `".(($XBTT_USE)?"x":"")."f`.`team` = 0 OR '".$CURUSER['all_teams']."'='yes' OR '".$CURUSER['sel_team']."'=`".(($XBTT_USE)?"x":"")."f`.`team`) ";
	if($btit_settings["fmhack_view_peer_details"] == "enabled" && $CURUSER["view_all_torrents_torrents"] == "no" && $CURUSER["uid"] != $uid)
		$num_snatched = 0;
	else
	{
		if($XBTT_USE)
			$num_res = get_result("SELECT count(h.fid) as th FROM xbt_files_users h INNER JOIN xbt_files f ON h.fid=f.fid ".$query_snatched_join." WHERE h.uid={$uid} ".$query_snatched_where, true, $btit_settings['cache_duration']);
		else
			$num_res = get_result("SELECT count(h.infohash) as th FROM {$TABLE_PREFIX}history h INNER JOIN {$TABLE_PREFIX}files f ON h.infohash=f.info_hash ".$query_snatched_join."WHERE h.uid={$uid} ".$query_snatched_where, true, $btit_settings['cache_duration']);

		$num_snatched = $num_res[0]['th']; unset($num_res);
	}

	if($num_snatched>0)
	{
		$sntpl->set("RESULTS_2",true,true);
		$sntpl->set("hisort1", $torrent_sorting, true);
		$sntpl->set("hisort2", $torrent_sorting, true);
		$sntpl->set("hisort3", false, true);
		$sntpl->set("hisort4", $torrent_sorting, true);
		$sntpl->set("hisort5", $torrent_sorting, true);
		$sntpl->set("hisort6", false, true);
		$sntpl->set("hisort7", $torrent_sorting, true);
		$sntpl->set("hisort8", $torrent_sorting, true);
		$sntpl->set("hisort9", false, true);
		$sntpl->set("hisort10", $torrent_sorting, true);
		$sntpl->set("hisort11", $torrent_sorting, true);
		$sntpl->set("hisort12", false, true);
		$sntpl->set("hisort13", $torrent_sorting, true);
		$sntpl->set("hisort14", $torrent_sorting, true);
		$sntpl->set("hisort15", false, true);
		$sntpl->set("hisort16", $torrent_sorting, true);
		$sntpl->set("hisort17", $torrent_sorting, true);
		$sntpl->set("hisort18", false, true);
		$sntpl->set("hisort19", $torrent_sorting, true);
		$sntpl->set("hisort20", $torrent_sorting, true);
		$sntpl->set("hisort21", false, true);
		$sntpl->set("hisort22", $torrent_sorting, true);
		$sntpl->set("hisort23", $torrent_sorting, true);
		$sntpl->set("hisort24", false, true);
		$sntpl->set("hisort25", $torrent_sorting, true);
		$sntpl->set("hisort26", $torrent_sorting, true);
		$sntpl->set("hisort27", false, true);
		$sntpl->set("hisort28", ($torrent_sorting && $hnr_system), true);
		$sntpl->set("hisort29", ($torrent_sorting && $hnr_system), true);
		$sntpl->set("hisort30", false, true);
		$sntpl->set("hisort31", ($torrent_sorting && $torrent_times), true);
		$sntpl->set("hisort32", ($torrent_sorting && $torrent_times), true);
		$sntpl->set("hisort33", false, true);
		$sntpl->set("hisort34", ($torrent_sorting && $torrent_times), true);
		$sntpl->set("hisort35", ($torrent_sorting && $torrent_times), true);
		$sntpl->set("hisort36", false, true);
		$sntpl->set("hisort37", ($torrent_sorting && $torrent_times), true);
		$sntpl->set("hisort38", ($torrent_sorting && $torrent_times), true);
		$sntpl->set("hisort39", false, true);

		$torhistory = array(); 
		$i = 0;
		$orderBy = (($XBTT_USE)?"`h`.`mtime`":"`date`"); 
		$direction = "DESC";

		list($pagertop, $pagerbottom, $limit) = pager($pager_limit, $num_snatched, "index.php?page=all_torrents&amp;id={$uid}&amp;type={$type}&amp;".($torrent_sorting)?"ordup=".(int)0+$_GET["ordup"]."&amp;dirup=".(int)0+$_GET["dirup"]."&amp;ordac=".(int)0+$_GET["ordac"]."&amp;dirac=".(int)0+$_GET["dirac"]."&amp;ordhi=".(int)0+$_GET["ordhi"]."&amp;dirhi=".(int)0+$_GET["dirhi"]."&amp;":"");

		if($torrent_sorting)
		{
			$ordhi = (isset($_GET["ordhi"]) && !empty($_GET["ordhi"]) && $_GET["ordhi"] >= 1 && $_GET["ordhi"] <= 13)?(int)0 + $_GET["ordhi"]:false;
			$dirhi = (isset($_GET["dirhi"]) && !empty($_GET["dirhi"]) && $_GET["dirhi"] >= 1 && $_GET["dirhi"] <= 2)?(int)0 + $_GET["dirhi"]:false;
			$udhisorturl1 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=1&amp;dirhi=";
			$udhisorturl2 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=2&amp;dirhi=";
			$udhisorturl3 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=3&amp;dirhi=";
			$udhisorturl4 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=4&amp;dirhi=";
			$udhisorturl5 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=5&amp;dirhi=";
			$udhisorturl6 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=6&amp;dirhi=";
			$udhisorturl7 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=7&amp;dirhi=";
			$udhisorturl8 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=8&amp;dirhi=";
			$udhisorturl9 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=9&amp;dirhi=";
			$udhisorturl10 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=10&amp;dirhi=";
			$udhisorturl11 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=11&amp;dirhi=";
			$udhisorturl12 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=12&amp;dirhi=";
			$udhisorturl13 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordup=".((int)0+$_GET["ordup"])."&amp;dirup=".((int)0+$_GET["dirup"])."&amp;ordhi=13&amp;dirhi=";

			switch($ordhi)
			{
				case 1:
				$orderBy = "`f`.`filename`";
				$sntpl->set("hisort3", true, true);
				break;
				case 2:
				$orderBy = "`f`.`size`";
				$sntpl->set("hisort6", true, true);
				break;
				case 3:
				$orderBy = "`h`.`active`";
				$sntpl->set("hisort9", true, true);
				break;
				case 4:
				$orderBy = "`h`.`downloaded`";
				$sntpl->set("hisort12", true, true);
				break;
				case 5:
				$orderBy = "`h`.`uploaded`";
				$sntpl->set("hisort15", true, true);
				break;
				case 6:
				$orderBy = "(`h`.`uploaded`/`h`.`downloaded`)";
				$sntpl->set("hisort18", true, true);
				break;
				case 7:
				$orderBy = (($XBTT_USE)?"`h`.`seeding_time`":"`h`.`seed`");
				$sntpl->set("hisort21", true, true);
				break;
				case 8:
				$orderBy = (($XBTT_USE)?"`x`.`seeders`":"`f`.`seeds`");
				$sntpl->set("hisort24", true, true);
				break;
				case 9:
				$orderBy = (($XBTT_USE)?"`x`":"`f`").".`leechers`";
				$sntpl->set("hisort27", true, true);
				break;
				case 10:
				if($hnr_system)
				{
					$orderBy = (($XBTT_USE)?"`x`.`completed`":"`f`.`finished`");
					$sntpl->set("hisort30", true, true);
				}
				break;
				case 11:
				if($torrent_times)
				{
					$orderBy = "`h`.`started_time`";
					$sntpl->set("hisort33", true, true);
				}
				break;
				case 12:
				if($torrent_times)
				{
					$orderBy = "`h`.`completed_time`";
					$sntpl->set("hisort36", true, true);
				}
				break;
				case 13:
				if($torrent_times)
				{
					$orderBy = (($XBTT_USE)?"`h`.`mtime`":"`h`.`date`");
					$sntpl->set("hisort39", true, true);
				}
				break;
				default:
				$orderBy = (($XBTT_USE)?"`h`.`mtime`":"`date`");
				break;
			}

			switch($dirhi)
			{
				case 2:
				$direction = "ASC";
				$sntpl->set("uarrow3","&nbsp;&uarr;");
				$sntpl->set("udhisorturl1",($udhisorturl1."1"));
				$sntpl->set("udhisorturl2",($udhisorturl2."1"));
				$sntpl->set("udhisorturl3",($udhisorturl3."1"));
				$sntpl->set("udhisorturl4",($udhisorturl4."1"));
				$sntpl->set("udhisorturl5",($udhisorturl5."1"));
				$sntpl->set("udhisorturl6",($udhisorturl6."1"));
				$sntpl->set("udhisorturl7",($udhisorturl7."1"));
				$sntpl->set("udhisorturl8",($udhisorturl8."1"));
				$sntpl->set("udhisorturl9",($udhisorturl9."1"));
				$sntpl->set("udhisorturl10",($udhisorturl10."1"));
				$sntpl->set("udhisorturl11",($udhisorturl11."1"));
				$sntpl->set("udhisorturl12",($udhisorturl12."1"));
				$sntpl->set("udhisorturl13",($udhisorturl13."1"));
				break;
				case 1:
				default:
				$direction = "DESC";
				$sntpl->set("uarrow3","&nbsp;&darr;");
				$sntpl->set("udhisorturl1",($udhisorturl1."2"));
				$sntpl->set("udhisorturl2",($udhisorturl2."2"));
				$sntpl->set("udhisorturl3",($udhisorturl3."2"));
				$sntpl->set("udhisorturl4",($udhisorturl4."2"));
				$sntpl->set("udhisorturl5",($udhisorturl5."2"));
				$sntpl->set("udhisorturl6",($udhisorturl6."2"));
				$sntpl->set("udhisorturl7",($udhisorturl7."2"));
				$sntpl->set("udhisorturl8",($udhisorturl8."2"));
				$sntpl->set("udhisorturl9",($udhisorturl9."2"));
				$sntpl->set("udhisorturl10",($udhisorturl10."2"));
				$sntpl->set("udhisorturl11",($udhisorturl11."2"));
				$sntpl->set("udhisorturl12",($udhisorturl12."2"));
				$sntpl->set("udhisorturl13",($udhisorturl13."2"));
				break;
			}
		}

		$query_snatched_select = ""; $query_snatched_where = ""; $query_snatched_join = "";
		if($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")
			$query_snatched_select .= (($XBTT_USE)?"`h`.`seeding_time` `seed`,":"`h`.`seed`,");
		if($torrent_mod)
		{
			if($btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes")
			{
				$query_snatched_select .= "`u2`.`username` `approved_by`,";
				$query_snatched_join .= "LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `f`.`approved_by`=`u2`.`id` ";
			}
			if($CURUSER["moderate_trusted"] != "yes")
				$query_snatched_where .= "AND `f`.`moder`='ok' ";
		}
		if($btit_settings["fmhack_teams"] == "enabled")
		{
			$query_snatched_select .= "`t`.`name` `teamname`, `t`.`id` `teamsid`, `t`.`image` `teamimage`, `f`.`team`,";
			$query_snatched_join .= "LEFT JOIN `{$TABLE_PREFIX}teams` `t` ON `f`.`team` = `t`.`id` ";
			if($btit_settings["team_state"] == "private")
			{
				$query_snatched_where .= "AND (".$CURUSER['team']." = `f`.`team` OR `f`.`team` = 0 OR '".$CURUSER['all_teams']."'='yes' OR '".$CURUSER['sel_team']."'=`f`.`team`) ";
			}
		}
		if($btit_settings["fmhack_SEO_panel"] == "enabled")
			$query_snatched_select .= "`f`.`id` `seoid`,";
		if(($btit_settings["fmhack_VIP_freeleech"] == "enabled" || $torrent_times) && $XBTT_USE)
			$query_snatched_select .= "`h`.`mtime`,";
		if($torrent_times)
			$query_snatched_select .= ((!$XBTT_USE)?"`h`.`date` `mtime`, ":"")."`h`.`completed_time`, `h`.`started_time`,";
		if($XBTT_USE)
			$snatch_res = get_result("SELECT ".$query_snatched_select." f.filename, f.size, f.info_hash, IF(h.active=1,'yes','no') `active`, LOWER(HEX(`h`.`peer_id`)) as agent, h.downloaded, h.uploaded, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished FROM $ttables INNER JOIN xbt_files_users h ON h.fid=x.fid ".$query_snatched_join." WHERE h.uid={$uid} ".$query_snatched_where." ORDER BY {$orderBy} {$direction} {$limit}", true, $btit_settings['cache_duration']);
		else
			$snatch_res = get_result("SELECT ".$query_snatched_select." f.filename, f.size, f.info_hash, h.active, h.agent, h.downloaded, h.uploaded, $tseeds as seeds, $tleechs as leechers, $tcompletes as finished FROM $ttables INNER JOIN {$TABLE_PREFIX}history h ON h.infohash=f.info_hash ".$query_snatched_join." WHERE h.uid={$uid} ".$query_snatched_where." ORDER BY {$orderBy} {$direction} {$limit}", true, $btit_settings['cache_duration']);

		foreach($snatch_res as $torlist)
		{
			if($btit_settings["fmhack_VIP_freeleech"] == "enabled" && $XBTT_USE)
			{
				if($row["freeleech"] == "yes" && $torlist["mtime"] >= $row["vipfl_date"])
					$torlist["downloaded"] = 0;
			}
			if($XBTT_USE)
				$torlist['agent'] = getagent("", $torlist['agent']);
			$torlist['filename'] = unesc($torlist['filename']);
			$filename = cut_string($torlist['filename'], intval($btit_settings["cut_name"]));
			if($btit_settings["fmhack_teams"] == "enabled")
			{
				$fteam = $torlist["team"];
				if(isset($fteam) && !empty($fteam))
					$team = "<a href='index.php?page=teaminfo&team=".$torlist["teamsid"]."&action=view'><img src='".$torlist["teamimage"]."' border='0' title='".$torlist["teamname"]."' style='width:25px;'></a>";
				else
					$team = "";
			}
			if($GLOBALS["usepopup"])
			{
				if($torrent_times)
				{
					$torhistory[$i]["mtime"]=date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["mtime"]);
					$torhistory[$i]["completed_time"]=(($torlist["completed_time"]==-1)?$language["NA"]:date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["completed_time"]));
					$torhistory[$i]["started_time"]=(($torlist["started_time"]==-1)?$language["NA"]:date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["started_time"]));
				}
				if($torrent_mod)
				{
					$torhistory[$i]["moder"] = getmoderdetails(getmoderstatusbyhash($torlist["info_hash"]), $torlist["info_hash"]);
				}
				$torhistory[$i]["filename"] = "<a href=\"javascript:popdetails('".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated"] == "true")?strtr($torlist["filename"], $res_seo["str"], $res_seo["strto"])."-".$torlist["seoid"].".html":"index.php?page=torrent-details&id=".$torlist["info_hash"])."')\" title=\"".$language["VIEW_DETAILS"].": ".$torlist['filename'].(($torrent_mod && $btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes" && $torlist["approved_by"] != $language["SYSTEM_USER"])?" (".$language["TMOD_APPROVED_BY"]." ".$torlist["approved_by"].")":"")."\">".$filename."</a>".(($btit_settings["fmhack_teams"] == "enabled" && $team != "")?"&nbsp;".$team."&nbsp;":"");
				$torhistory[$i]["size"] = makesize($torlist['size']);
				$torhistory[$i]["agent"] = htmlspecialchars($torlist['agent']);
				$torhistory[$i]["status"] = ($torlist['active'] == 'yes'?$language["ACTIVATED"]:'Stopped');
				$torhistory[$i]["downloaded"] = makesize($torlist['downloaded']);
				$torhistory[$i]["uploaded"] = makesize($torlist['uploaded']);
				if($torlist['downloaded'] > 0)
					$peerratio = number_format($torlist['uploaded'] / $torlist['downloaded'], 2);
				else
					$peerratio = '&#8734;';
				$torhistory[$i]["ratio"] = unesc($peerratio);
				$torhistory[$i]["seedscolor"] = linkcolor($torlist['seeds']);
				$torhistory[$i]["seeds"] = "<a href=\"javascript:poppeer('index.php?page=peers&amp;id=".$torlist['info_hash']."')\">".$torlist['seeds']."</a>";
				$torhistory[$i]["leechcolor"] = linkcolor($torlist['leechers']);
				$torhistory[$i]["leechs"] = "<a href=\"javascript:poppeer('index.php?page=peers&amp;id=".$torlist['info_hash']."')\">".$torlist['leechers']."</a>";
				$torhistory[$i]["completed"] = "<a href=\"javascript:poppeer('index.php?page=torrent_history&amp;id=".$torlist['info_hash']."')\">".$torlist['finished']."</a>";
				if($btit_settings["fmhack_anti_hit_and_run_system"] == "enabled")
					$torhistory[$i]["SEEDING_TIME"] = NewDateFormat($torlist["seed"]);
				$i++;
			}
			else
			{
				if($torrent_times)
				{
					$torhistory[$i]["mtime"]=date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["mtime"]);
					$torhistory[$i]["completed_time"]=(($torlist["completed_time"]==-1)?$language["NA"]:date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["completed_time"]));
					$torhistory[$i]["started_time"]=(($torlist["started_time"]==-1)?$language["NA"]:date("d/m/Y\<\b\\r \/\>H:i:s", $torlist["started_time"]));
				}
				if($torrent_mod)
				{
					$torhistory[$i]["moder"] = getmoderdetails(getmoderstatusbyhash($torlist["info_hash"]), $torlist["info_hash"]);
				}
				$torhistory[$i]["filename"] = "<a href=\"".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated"] == "true")?strtr($torlist["filename"], $res_seo["str"], $res_seo["strto"])."-".$torlist["seoid"].".html":"index.php?page=torrent-details&id=".$torlist["info_hash"])."\" title=\"".$language["VIEW_DETAILS"].": ".$torlist['filename'].(($torrent_mod && $btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes" && $torlist["approved_by"] != $language["SYSTEM_USER"])?" (".$language["TMOD_APPROVED_BY"]." ".$torlist["approved_by"].")":"")."\">".$filename."</a>".(($btit_settings["fmhack_teams"] == "enabled" && $team != "")?"&nbsp;".$team."&nbsp;":"");
				$torhistory[$i]["size"] = makesize($torlist['size']);
				$torhistory[$i]["agent"] = htmlspecialchars($torlist['agent']);
				$torhistory[$i]["status"] = ($torlist['active'] == 'yes'?$language["ACTIVATED"]:'Stopped');
				$torhistory[$i]["downloaded"] = makesize($torlist['downloaded']);
				$torhistory[$i]["uploaded"] = makesize($torlist['uploaded']);
				if($torlist['downloaded'] > 0)
					$peerratio = number_format($torlist['uploaded'] / $torlist['downloaded'], 2);
				else
					$peerratio = '&#8734;';
				$torhistory[$i]["ratio"] = unesc($peerratio);
				$torhistory[$i]["seedscolor"] = linkcolor($torlist['seeds']);
				$torhistory[$i]["seeds"] = "<a href=\"index.php?page=peers&amp;id=".$torlist['info_hash']."\">".$torlist['seeds']."</a>";
				$torhistory[$i]["leechcolor"] = linkcolor($torlist['leechers']);
				$torhistory[$i]["leechs"] = "<a href=\"index.php?page=peers&amp;id=".$torlist['info_hash']."\">".$torlist['leechers']."</a>";
				$torhistory[$i]["completed"] = "<a href=\"index.php?page=torrent_history&amp;id=".$torlist['info_hash']."\">".$torlist['finished']."</a>";
				if($hnr_system)
					$torhistory[$i]["SEEDING_TIME"] = NewDateFormat($torlist['seed']);
				$i++;
			}
		}
		$sntpl->set("torhistory", $torhistory);
	}
	else
	{
		$sntpl->set("RESULTS_2", false, true);
		$sntpl->set("hisort1", false, true);
		$sntpl->set("hisort2", false, true);
		$sntpl->set("hisort3", false, true);
		$sntpl->set("hisort4", false, true);
		$sntpl->set("hisort5", false, true);
		$sntpl->set("hisort6", false, true);
		$sntpl->set("hisort7", false, true);
		$sntpl->set("hisort8", false, true);
		$sntpl->set("hisort9", false, true);
		$sntpl->set("hisort10", false, true);
		$sntpl->set("hisort11", false, true);
		$sntpl->set("hisort12", false, true);
		$sntpl->set("hisort13", false, true);
		$sntpl->set("hisort14", false, true);
		$sntpl->set("hisort15", false, true);
		$sntpl->set("hisort16", false, true);
		$sntpl->set("hisort17", false, true);
		$sntpl->set("hisort18", false, true);
		$sntpl->set("hisort19", false, true);
		$sntpl->set("hisort20", false, true);
		$sntpl->set("hisort21", false, true);
		$sntpl->set("hisort22", false, true);
		$sntpl->set("hisort23", false, true);
		$sntpl->set("hisort24", false, true);
		$sntpl->set("hisort25", false, true);
		$sntpl->set("hisort26", false, true);
		$sntpl->set("hisort27", false, true);
		$sntpl->set("hisort28", false, true);
		$sntpl->set("hisort29", false, true);
		$sntpl->set("hisort30", false, true);
		$sntpl->set("hisort31", false, true);
		$sntpl->set("hisort32", false, true);
		$sntpl->set("hisort33", false, true);
		$sntpl->set("hisort34", false, true);
		$sntpl->set("hisort35", false, true);
		$sntpl->set("hisort36", false, true);
		$sntpl->set("hisort37", false, true);
		$sntpl->set("hisort38", false, true);
		$sntpl->set("hisort39", false, true);
	}
	unset($num_snatched);

	$sntpl->set("ttimes_enabled_1", $torrent_times, true);
	$sntpl->set("ttimes_enabled_2", $torrent_times, true);
	$sntpl->set("hnr_enabled", $hnr_system, true);
	$sntpl->set("hnr_enabled2", $hnr_system, true);
	$sntpl->set("language",$language);

	$all_torrents->set("header",$language['ALL_SNATCHED']);
	$all_torrents->set("pagertop",$pagertop);
	$all_torrents->set("seeding",false,true);
	$all_torrents->set("snatched",true,true);
	$all_torrents->set("snatched_table",$sntpl->fetch(load_template("all_torrents.snatched.tpl")));
	$all_torrents->set("uploaded",false,true);
	$all_torrents->set("pagerbottom",$pagerbottom);
}
elseif($type=='uploaded')
{
	$upltpl = new bTemplate();

	$query_upload_where = ""; $query_upload_select = ""; $query_upload_join = "";
	if($btit_settings["fmhack_torrent_moderation"] == "enabled")
	{
		if($btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes")
		{
			$query_upload_select .= "`u2`.`username` `approved_by`,";
			$query_upload_join .= "LEFT JOIN `{$TABLE_PREFIX}users` `u2` ON `f`.`approved_by`=`u2`.`id` ";
		}
		if($CURUSER["moderate_trusted"] != "yes")
		{
			if($CURUSER["uid"] != $uid)
				$query_upload_where .= "AND `f`.`moder`='ok' ";
		}
	}
	if($btit_settings["fmhack_teams"] == "enabled")
	{
		$query_upload_select .= "`t`.`name` `teamname`, `t`.`id` `teamsid`, `t`.`image` `teamimage`, `f`.`team`,";
		$query_upload_join .= "LEFT JOIN `{$TABLE_PREFIX}teams` `t` ON `f`.`team` = `t`.`id` ";
		if($btit_settings["team_state"] == "private")
		{
			$query_upload_where .= "AND (".$CURUSER['team']." = f.team OR f.team = 0 OR '".$CURUSER['all_teams']."'='yes' OR '".$CURUSER['sel_team']."'=`f`.`team`) ";
		}
	}
	if($btit_settings["fmhack_SEO_panel"] == "enabled")
	{
		$query_upload_select .= "`f`.`id` `seoid`,";
	}
	if($btit_settings["fmhack_view_peer_details"] == "enabled" && $CURUSER["view_all_torrents_torrents"] == "no" && $CURUSER["uid"] != $uid)
		$numtorrent = 0;
	else
	{
		$resuploaded = get_result("SELECT count(*) as tf FROM {$TABLE_PREFIX}files f WHERE uploader={$uid} AND f.anonymous = \"false\" ".$query_upload_where." ORDER BY data DESC", true, $btit_settings['cache_duration']);
		$numtorrent = $resuploaded[0]['tf']; unset($resuploaded);
	}

	if($numtorrent>0)
	{

		list($pagetop,$pagerbottom,$limit) = pager($pager_limit,$numtorrent,"index.php?page=all_torrents&amp;id={uid}&amp;type={$type}&amp;".(($torrent_sorting)?"ordup=".(int)0+$_GET["ordup"]."&amp;dirup=".(int)0+$_GET["dirup"]."&amp;ordac=".(int)0+$_GET["ordac"]."&amp;dirac=".(int)0+$_GET["dirac"]."&amp;ordhi=".(int)0+$_GET["ordhi"]."&amp;dirhi=".(int)0+$_GET["dirhi"]."&amp;":""));
		$orderBY = "`f`.`data`"; 
		$direction = "DESC";

		$upltpl->set("upsort1", $torrent_sorting, true);
		$upltpl->set("upsort2", $torrent_sorting, true);
		$upltpl->set("upsort3", false, true);
		$upltpl->set("upsort4", $torrent_sorting, true);
		$upltpl->set("upsort5", $torrent_sorting, true);
		$upltpl->set("upsort6", false, true);
		$upltpl->set("upsort7", $torrent_sorting, true);
		$upltpl->set("upsort8", $torrent_sorting, true);
		$upltpl->set("upsort9", false, true);
		$upltpl->set("upsort10", $torrent_sorting, true);
		$upltpl->set("upsort11", $torrent_sorting, true);
		$upltpl->set("upsort12", false, true);
		$upltpl->set("upsort13", $torrent_sorting, true);
		$upltpl->set("upsort14", $torrent_sorting, true);
		$upltpl->set("upsort15", false, true);
		$upltpl->set("upsort16", $torrent_sorting, true);
		$upltpl->set("upsort17", $torrent_sorting, true);
		$upltpl->set("upsort18", false, true);

		if($torrent_sorting)
		{
			$ordup = (isset($_GET["ordup"]) && !empty($_GET["ordup"]) && $_GET["ordup"] >= 1 && $_GET["ordup"] <= 6)?(int)0 + $_GET["ordup"]:false;
			$dirup = (isset($_GET["dirup"]) && !empty($_GET["dirup"]) && $_GET["dirup"] >= 1 && $_GET["dirup"] <= 2)?(int)0 + $_GET["dirup"]:false;

			$udupsorturl1 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordup=1&amp;dirup=";
			$udupsorturl2 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordup=2&amp;dirup=";
			$udupsorturl3 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordup=3&amp;dirup=";
			$udupsorturl4 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordup=4&amp;dirup=";
			$udupsorturl5 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordup=5&amp;dirup=";
			$udupsorturl6 = "index.php?page=all_torrents&id=".$uid."&amp;ordac=".((int)0+$_GET["ordac"])."&amp;dirac=".((int)0+$_GET["dirac"])."&amp;ordhi=".((int)0+$_GET["ordhi"])."&amp;dirhi=".((int)0+$_GET["dirhi"])."&amp;ordup=6&amp;dirup=";

			switch($ordup)
			{
				case 1:
				$orderBy = "`f`.`filename`";
				$upltpl->set("upsort3", true, true);
				break;
				case 3:
				$orderBy = "`f`.`size`";
				$upltpl->set("upsort9", true, true);
				break;
				case 4:
				$orderBy = (($XBTT_USE)?"`x`.`seeders`":"`f`.`seeds`");
				$upltpl->set("upsort12", true, true);
				break;
				case 5:
				$orderBy = (($XBTT_USE)?"`x`":"`f`").".`leechers`";
				$upltpl->set("upsort15", true, true);
				break;
				case 6:
				$orderBy = (($XBTT_USE)?"`x`.`completed`":"`f`.`finished`");
				$upltpl->set("upsort18", true, true);
				break;
				case 2:
				default:
				$orderBy = "`f`.`data`";
				$upltpl->set("upsort6", true, true);
				break;
			}

			switch($dirup)
			{
				case 2:
				$direction = "ASC";
				//$udupsorturl .= "&amp;dirup=1";
				$upltpl->set("uarrow", "&nbsp;&uarr;");
				$upltpl->set("udupsorturl1", ($udupsorturl1."1"));
				$upltpl->set("udupsorturl2", ($udupsorturl2."1"));
				$upltpl->set("udupsorturl3", ($udupsorturl3."1"));
				$upltpl->set("udupsorturl4", ($udupsorturl4."1"));
				$upltpl->set("udupsorturl5", ($udupsorturl5."1"));
				$upltpl->set("udupsorturl6", ($udupsorturl6."1"));
				break;
				case 1:
				default:
				$direction = "DESC";
				//$udupsorturl .= "&amp;dirup=2";
				$upltpl->set("uarrow", "&nbsp;&darr;");
				$upltpl->set("udupsorturl1", ($udupsorturl1."2"));
				$upltpl->set("udupsorturl2", ($udupsorturl2."2"));
				$upltpl->set("udupsorturl3", ($udupsorturl3."2"));
				$upltpl->set("udupsorturl4", ($udupsorturl4."2"));
				$upltpl->set("udupsorturl5", ($udupsorturl5."2"));
				$upltpl->set("udupsorturl6", ($udupsorturl6."2"));
				break;
			}		
		}

		$resuploaded = get_result("SELECT ".$query_upload_select." `f`.`info_hash`, `f`.`filename`, UNIX_TIMESTAMP(`f`.`data`) `added`, `f`.`size`, ".$tseeds." `seeds`, ".$tleechs." `leechers`, ".$tcompletes." `finished` FROM ".$ttables." ".$query_upload_join." WHERE `f`.`uploader`=".$uid." AND `f`.`anonymous` = 'false' ".$query_upload_where." ORDER BY ".$orderBy." ".$direction." ".$limit, true, $btit_settings["cache_duration"]);
	}
	else
	{
		$upltpl->set("upsort1", false, true);
		$upltpl->set("upsort2", false, true);
		$upltpl->set("upsort3", false, true);
		$upltpl->set("upsort4", false, true);
		$upltpl->set("upsort5", false, true);
		$upltpl->set("upsort6", false, true);
		$upltpl->set("upsort7", false, true);
		$upltpl->set("upsort8", false, true);
		$upltpl->set("upsort9", false, true);
		$upltpl->set("upsort10", false, true);
		$upltpl->set("upsort11", false, true);
		$upltpl->set("upsort12", false, true);
		$upltpl->set("upsort13", false, true);
		$upltpl->set("upsort14", false, true);
		$upltpl->set("upsort15", false, true);
		$upltpl->set("upsort16", false, true);
		$upltpl->set("upsort17", false, true);
		$upltpl->set("upsort18", false, true);
	}

	if($resuploaded && $numtorrent > 0)
	{
		$upltpl->set("RESULTS", true, true);
		$uptortpl = array();
		$i = 0;
		foreach($resuploaded as $ud_id => $rest)
		{
			$rest["filename"] = unesc($rest["filename"]);
			$filename = cut_string($rest["filename"], intval($btit_settings["cut_name"]));
			if($btit_settings["fmhack_teams"] == "enabled")
			{
				$fteam = $rest["team"];
				if(isset($fteam) && !empty($fteam))
					$team = "<a href='index.php?page=teaminfo&team=".$rest["teamsid"]."&action=view'><img src='".$rest["teamimage"]."' border='0' title='".$rest["teamname"]."' style='width:25px;'></a>";
				else
					$team = "";
			}
			if($GLOBALS["usepopup"])
			{
				if($btit_settings["fmhack_torrent_moderation"] == "enabled")
				{
					$uptortpl[$i]["moder"] = getmoderdetails(getmoderstatusbyhash($rest['info_hash']), $rest['info_hash']);
				}
				$uptortpl[$i]["filename"] = "<a href=\"javascript:popdetails('".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated"] == "true")?strtr($rest["filename"], $res_seo["str"], $res_seo["strto"])."-".$rest["seoid"].".html":"index.php?page=torrent-details&id=".$rest["info_hash"])."')\" title=\"".$language["VIEW_DETAILS"].": ".$rest["filename"].(($btit_settings["fmhack_torrent_moderation"] == "enabled" && $btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes" && $rest["approved_by"] != $language["SYSTEM_USER"])?" (".$language["TMOD_APPROVED_BY"]." ".$rest["approved_by"].")":"")."\">".$filename."</a>".(($btit_settings["fmhack_teams"] == "enabled" && $team != "")?"&nbsp;".$team."&nbsp;":"");
				$uptortpl[$i]["added"] = date("d/m/Y", $rest["added"] - $offset);
				$uptortpl[$i]["size"] = makesize($rest["size"]);
				$uptortpl[$i]["seedcolor"] = linkcolor($rest["seeds"]);
				$uptortpl[$i]["seeds"] = "<a href=\"javascript:poppeer('index.php?page=peers&amp;id=".$rest["info_hash"]."')\">".$rest["seeds"]."</a>";
				$uptortpl[$i]["leechcolor"] = linkcolor($rest["leechers"]);
				$uptortpl[$i]["leechs"] = "<a href=\"javascript:poppeer('index.php?page=peers&amp;id=".$rest["info_hash"]."')\">".$rest["leechers"]."</a>";
				if($rest["finished"] > 0)
					$uptortpl[$i]["completed"] = "<a href=\"javascript:poppeer('index.php?page=torrent_history&amp;id=".$rest["info_hash"]."')\">".$rest["finished"]."</a>";
				else
					$uptortpl[$i]["completed"] = "---";
				$i++;
			}
			else
			{
				if($btit_settings["fmhack_torrent_moderation"] == "enabled")
				{
					$uptortpl[$i]["moder"] = getmoderdetails(getmoderstatusbyhash($rest['info_hash']), $rest['info_hash']);
				}
				$uptortpl[$i]["filename"] = "<a href=\"".(($btit_settings["fmhack_SEO_panel"] == "enabled" && $res_seo["activated"] == "true")?strtr($rest["filename"], $res_seo["str"], $res_seo["strto"])."-".$rest["seoid"].".html":"index.php?page=torrent-details&id=".$rest["info_hash"])."\" title=\"".$language["VIEW_DETAILS"].": ".$rest["filename"].(($btit_settings["fmhack_torrent_moderation"] == "enabled" && $btit_settings["mod_app_sa"] == "yes" && $CURUSER["admin_access"] == "yes" && $rest["approved_by"] != $language["SYSTEM_USER"])?" (".$language["TMOD_APPROVED_BY"]." ".$rest["approved_by"].")":"")."\">".$filename."</a>".(($btit_settings["fmhack_teams"] == "enabled" && $team != "")?"&nbsp;".$team."&nbsp;":"");
				$uptortpl[$i]["added"] = date("d/m/Y", $rest["added"] - $offset);
				$uptortpl[$i]["size"] = makesize($rest["size"]);
				$uptortpl[$i]["seedcolor"] = linkcolor($rest["seeds"]);
				$uptortpl[$i]["seeds"] = "<a href=\"index.php?page=peers&amp;id=".$rest{"info_hash"}."\">".$rest["seeds"]."</a>";
				$uptortpl[$i]["leechcolor"] = linkcolor($rest["leechers"]);
				$uptortpl[$i]["leechs"] = "<a href=\"index.php?page=peers&amp;id=".$rest{"info_hash"}."\">".$rest["leechers"]."</a>";
				if($rest["finished"] > 0)
					$uptortpl[$i]["completed"] = "<a href=\"index.php?page=torrent_history&amp;id=".$rest["info_hash"]."\">".$rest["finished"]."</a>";
				else
					$uptortpl[$i]["completed"] = "---";
				$i++;
			}
		}
		$upltpl->set("uptor", $uptortpl);
	}
	else
	{
		$upltpl->set("RESULTS", false, true);
	}

	$upltpl->set("tmod1_enabled", $torrent_mod, true);
	$upltpl->set("tmod2_enabled", $torrent_mod, true);

	$all_torrents->set("header",$language['ALL_UPLOADED']);
	$all_torrents->set("pagertop",$pagertop);
	$all_torrents->set("seeding",false,true);
	$all_torrents->set("snatched",false,true);
	$all_torrents->set("uploaded",true,true);
	$all_torrents->set("uploaded_table",$upltpl->fetch(load_template("all_torrents.uploaded.tpl")));
	$all_torrents->set("pagerbottom",$pagerbottom);
}
else
{
	stderr('Error','Invalid data received.');
	die();
}

?>