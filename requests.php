<?php
////////////////////////////////////////
//
// Request system
// For use only with XBTIT Blu Edition
//
// By MrG04
//
////////////////////////////////////////

if(!defined("IN_BTIT"))
	redirect("index.php");

require load_language("lang_requests.php");
require dirname(__FILE__)."/include/offset.php";

if($CURUSER['view_torrents'] == 'no')
{
	stderr($language["TRAV_OFF_MESS"], $language["TRAV_REQ_OFF"]);
	die();
}
else
{
	if($btit_settings['req_onoff'] == 'true')
	{
		$requeststpl = new bTemplate();
		$act = (isset($_GET['action']) && $_GET['action'] != '')?$_GET['action']:'';

		if($act == 'viewreq')
		{
			if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']>0)
			{
				$id = intval($_GET['id']);

				$view_que = get_result("SELECT `req`.`id`, `req`.`reqname`, `req`.`category`, `req`.`requester`, UNIX_TIMESTAMP(`req`.`dateadded`) as `dateadded`, `req`.`description`, `req`.`views`, `req`.`jobtakenby`, UNIX_TIMESTAMP(`req`.`jobtakenwhen`) as `jobtakenwhen`, `req`.`uploadedby`, UNIX_TIMESTAMP(`req`.`uploadedwhen`) as `uploadedwhen`, `u1`.`username` as `req_username`, `ul1`.`suffixcolor` as `req_suffix`, `ul1`.`prefixcolor` as `req_prefix`,`u2`.`username` as `job_username`, `ul2`.`prefixcolor` as `job_prefix`, `ul2`.`suffixcolor` as `job_suffix`, `u3`.`username` as `upl_username`, `ul3`.`prefixcolor` as `upl_prefix`, `ul3`.`suffixcolor` as `upl_suffix`, sum(`req_bou`.`seedbonus`) as `total_bounty`, `files`.`info_hash`,`files`.`filename` as `filename`, `c`.`id` as `catid` ,`c`.`name` as `catname`, `c`.`image` as `catimg` FROM {$TABLE_PREFIX}requests `req` LEFT JOIN {$TABLE_PREFIX}categories `c` ON `c`.`id`=`req`.`category` LEFT JOIN {$TABLE_PREFIX}users `u1` ON `req`.`requester`=`u1`.`id` LEFT JOIN {$TABLE_PREFIX}users_level `ul1` ON `u1`.`id_level`=`ul1`.`id` LEFT JOIN {$TABLE_PREFIX}users `u2` ON `req`.`jobtakenby`=`u2`.`id`LEFT JOIN {$TABLE_PREFIX}users_level `ul2` ON `u2`.`id_level`=`ul2`.`id` LEFT JOIN {$TABLE_PREFIX}users `u3` ON `req`.`uploadedby`=`u3`.`id` LEFT JOIN {$TABLE_PREFIX}users_level `ul3` ON `u3`.`id_level`=`ul3`.`id` LEFT JOIN {$TABLE_PREFIX}requests_bounty `req_bou` ON `req`.`id`=`req_bou`.`req_id` LEFT JOIN {$TABLE_PREFIX}files `files` ON `files`.`info_hash`=`req`.`infohash`WHERE `req`.`id`={$id}",true,$btit_settings["cache_duration"]);

				if(count($view_que) == 1)
				{
					$res = $view_que[0];

					//Update view count
					quickQuery("UPDATE {$TABLE_PREFIX}requests SET views = views+1");
					$res['views'] = $res['views']+1;
					//Update view count

					$reqdetailstpl = new bTemplate();

					$reqdetailstpl->set("language",$language);
					$reqdetailstpl->set("req_head","REQUESTS -> DETAILS");
					$reqdetailstpl->set("can_edit",(($CURUSER['admin_access']=='yes'||$CURUSER['uid']==$res['requester'])?true:false),true);
					$reqdetailstpl->set("req_id",$res['id']);
					$reqdetailstpl->set("req_name",$res['reqname']);
					$reqdetailstpl->set("req_uid",$res['requester']);
					$req_by = $res['req_prefix'].$res['req_username'].$res['req_suffix'];
					$reqdetailstpl->set("req_by",$req_by);
					$reqdetailstpl->set("date_added",date("d/m/Y H:i:s",$res['dateadded']-$offset));
					$reqdetailstpl->set("catimg",(image_or_link(($res['catimg']==""?"":"{$STYLEPATH}/images/categories/".$res['catimg']),"",$res['catname'])));

					$reqdetailstpl->set("req_views",$res['views']);
					$reqdetailstpl->set("uid",$CURUSER['uid']);
					$reqdetailstpl->set("uid_auth",sha1($CURUSER['random']));

					$reqdetailstpl->set("req_total_bounty",number_format($res['total_bounty']));
					$reqdetailstpl->set("disabled","");
					if($res['jobtakenby']>0)
					{
						$reqdetailstpl->set("job_taken",true,true);
						$reqdetailstpl->set("job_uid",$res['jobtakenby']);
						$job_by = $res['job_prefix'].$res['job_username'].$res['job_prefix'];
						$reqdetailstpl->set("job_taken_by",$job_by);
						$reqdetailstpl->set("job_taken_when",date("d/m/Y H:i:s",$res['jobtakenwhen']-$offset));
					}
					else
					{
						$reqdetailstpl->set("job_taken",false,true);
						$reqdetailstpl->set("can_upload1",(($CURUSER['can_upload']=='yes')?true:false),true);
					}
					if($res['uploadedby']>0)
					{
						$reqdetailstpl->set("uploaded",true,true);
						$reqdetailstpl->set("upl_uid",$res['uploadedby']);
						$upl_by = $res['upl_prefix'].$res['upl_username'].$res['upl_suffix'];
						$reqdetailstpl->set("filled_by",$upl_by);
						$reqdetailstpl->set("req_fill_link",""); //needs filling
						$reqdetailstpl->set("infohash",$res['infohash']);
						$reqdetailstpl->set("upload_name",$res['tor_name']);
						$reqdetailstpl->set("uploaded_when",date("d/m/Y H:i:s",$res['uploadedwhen']-$offset));
						$reqdetailstpl->set("disabled","disabled='disabled'");
					}
					else
					{
						$reqdetailstpl->set("uploaded",false,true);
						$reqdetailstpl->set("can_upload2",(($CURUSER['can_upload']=='yes'&&$res['jobtakenby']==$CURUSER['uid'])?true:false),true);
					}
					$reqdetailstpl->set("req_descr",format_comment(unesc($res['description'])));

					//Comments Section
					$comm_que = get_result("SELECT `req`.`id`,`req`.`addedby`,UNIX_TIMESTAMP(`req`.`addedwhen`) as `addedwhen`,`req`.`comment`,`u`.`username`,`ul`.`prefixcolor`,`ul`.`suffixcolor`,`u`.`avatar` FROM `{$TABLE_PREFIX}requests_comments` `req` LEFT JOIN `{$TABLE_PREFIX}users` `u` ON `u`.`id`=`req`.`addedby` LEFT JOIN `{$TABLE_PREFIX}users_level` `ul` ON `u`.`id_level`=`ul`.`id` WHERE `req`.`req_id`={$res['id']}",true,$btit_settings['cache_duration']);

					if(count($comm_que)>0 && $CURUSER['view_comments']=='yes')
					{
						$comments = array();
						$cc = 0;
						foreach($comm_que as $res)
						{
							$comments[$cc]['com_id'] = $res['id'];
							$comments[$cc]['uid'] = $res['addedby'];
							$comments[$cc]['username'] = $res['prefixcolor'].$res['username'].$res['suffixcolor'];

							$av_link = ($res["avatar"] && $res["avatar"] != "") ? htmlspecialchars($res["avatar"]): "{$STYLEURL}/images/default_avatar.gif";
							$comments[$cc]['avatar'] = ("<img onload=\"resize_avatar(this);\" src=\"{$av_link}\" alt=\"{$res['username']}'s Avatar\"/>");

							$comments[$cc]['text'] = format_comment($res['comment']);
							$cc++;
						}

						$reqdetailstpl->set("comments",$comments);
						$reqdetailstpl->set("has_comments",true,true);
					}
					else
					{
						$reqdetailstpl->set("has_comments",false,true);
					}

					$reqdetailstpl->set("comment_comment",textbbcode("comment","comment",""));

					//Comments Section

					$requeststpl->set("view_requests",false,true);
					$requeststpl->set("requests_content",$reqdetailstpl->fetch(load_template("requests.details.tpl")));
				}
				else
				{
					stderr($language["ERROR"], $language["BAD_ID"]);
					die();
				}
			}
			else
			{
				stderr($language['ERROR'],$language["TRAV_NODELID"]." \n \n \n ".$language['TRAV_GOBACK']);
				die();
			}
		}
		elseif($act == 'createreq')
		{
			if($CURUSER['id_level']>=$btit_settings['req_level'])
			{
				$createreqtpl = new bTemplate();
				$createreqtpl->set("language",$language);
				$createreqtpl->set("header",$language['TRAV_NEW']);
				$createreqtpl->set("category",categories());
				$createreqtpl->set("uid",$CURUSER['uid']);
				$createreqtpl->set("uid_auth",sha1($CURUSER['random']));
				$createreqtpl->set("url",'index.php?page=requests&action=takereq');
				$createreqtpl->set("req_id","");
				$createreqtpl->set("reqtitle","");
				$createreqtpl->set("aBON",$btit_settings['req_bon']);
				$createreqtpl->set("imdb","");
				$createreqtpl->set("tvdb","");
				$createreqtpl->set("description","");

				$requeststpl->set("view_requests",false,true);
				$requeststpl->set("requests_content",$createreqtpl->fetch(load_template("requests.createreq.tpl")));
			}
			else
			{
				stderr($language["ERROR"], $language["TRAV_NOADD1"]." (".unesc($CURUSER["prefixcolor"].$CURUSER["level"].$CURUSER["suffixcolor"]).") ".$language["TRAV_NOADD2"]);
				die();
			}
		}
		elseif($act == 'takereq')
		{
			if($CURUSER['uid'] == $_POST['uid'] && sha1($CURUSER['random']) == $_POST['auth'])
			{
				if($CURUSER['view_torrents']=='no')
				{
					stderr($language['ERROR'],$language['TRAV_NOTALLOWED']);
					die();
				}
				else
				{
					if($btit_settings['req_bon']>$CURUSER['seedbonus'])
					{
						stderr($language['ERROR'],$language['TRAV_REACHEDMAX']);
						die();
					}

					if($CURUSER['id_level']<$btit_settings['req_level'])
					{
						stderr($language['ERROR'],$language['TRAV_NOTALLOWED']);
						die();
					}

					$reqtitle = $_POST['reqtitle'];
					$cat = 0+$_POST['category'];
					$imdb = 0+$_POST['imdb'];
					$tvdb = 0+$_POST['tvdb'];
					$desc = $_POST['description'];

					if(!$reqtitle)
					{
						stderr($language['ERROR'],$language['TRAV_MUSTADDTITLE']);
						die();
					}
					if($cat==0)
					{
						stderr($language['ERROR'],$language['TRAV_MUSTCHOOSECAT']);
						die();
					}
					if(!is_int($imdb))
					{
						stderr($language['ERROR'],$language['TRAV_INVIMDB']);
						die();
					}
					if(!is_int($tvdb))
					{
						stderr($language['ERROR'],$language['TRAV_INVTVDB']);
						die();
					}

					$req1title = sqlesc($reqtitle);
					$cat = sqlesc($cat);
					$imdb = sqlesc($imdb);
					$tvdb = sqlesc($tvdb);
					$desc = ($desc=="")?sqlesc(""):sqlesc($desc);

					$test = do_sqlquery("SELECT `id` FROM `{$TABLE_PREFIX}requests` WHERE `category`={$cat} AND `reqname`LIKE {$req1title}");
					if(sql_num_rows($test)==0)
					{
						quickQuery("INSERT INTO {$TABLE_PREFIX}requests (`reqname`,`category`,`requester`,`dateadded`,`description`,`views`,`imdb`,`tvdb`) VALUES ($req1title,$cat,{$CURUSER['uid']},NOW(),$desc,1,$imdb,$tvdb)") or sqlerr();

						$last_id = sql_insert_id();
						quickQuery("INSERT INTO {$TABLE_PREFIX}requests_bounty (`addedby`,`seedbonus`,`req_id`) VALUES ({$CURUSER['uid']},{$btit_settings['req_bon']},{$last_id});") or sqlerr();

						quickQuery("UPDATE {$TABLE_PREFIX}users SET `seedbonus` = `seedbonus` - {$btit_settings['req_bon']} WHERE id = {$CURUSER['uid']}") or sqlerr();
						$_SESSION["CURUSER"]["seedbonus"] -= $btit_settings['req_bon'];

						if($btit_settings['req_shout']==true)
						{
							$url=("[color=RED]".sql_esc($language["TRAV_NEWREQUEST"]).":[/color] [url=".$BASEURL."/index.php?page=viewrequests]".sql_esc($reqtitle)."[/url] [color=RED]".sql_esc($language["TRAV_ADDEDBY"]).":[/color] [url=$BASEURL/index.php?page=userdetails&id=" .$CURUSER['uid']."]".$CURUSER['prefixcolor'].$CURUSER["username"].$CURUSER['suffixcolor']."[/url]");
							system_shout($url,false,true);
						}

						write_log("$reqtitle ".$language['TRAV_WATTRS']);
						redirect("index.php?page=requests");
					}
					else
					{
						stderr($language['ERROR'],$language['TRAV_EXIST']);
						die();
					}
				}
			}
			else
			{
				stderr($language['ERROR'],$language['TRAV_NOTAUTH']);
				die();
			}
		}
		elseif($act == 'reqedit')
		{
			if(isset($_GET['req_id']) && is_numeric($_GET['req_id']) && $_GET['req_id']>0)
			{
				$id = intval($_GET['req_id']);

				$req_que = get_result("SELECT `id`, `reqname`, `category`,`description`,`requester`,`jobtakenby`,`uploadedby`,`imdb`,`tvdb` FROM {$TABLE_PREFIX}requests WHERE `id`={$id}",true,$btit_settings['cache_duration']);

				if(count($req_que)>0)
				{
					$edit_res = $req_que[0];

					if($CURUSER['admin_access']=='yes'|| ($CURUSER['uid']==$edit_res['requester'] && $edit_res['jobtakenby']==0 && $edit_res['uploadedby']==0))
					{
						$editreqtpl = new bTemplate();
						$editreqtpl->set("header",$language['RE']);
						$editreqtpl->set("language",$language);
						$editreqtpl->set("url","index.php?page=requests&action=takereqedit");
						$editreqtpl->set("uid",$CURUSER['uid']);
						$editreqtpl->set("uid_auth",sha1($CURUSER['random']));
						$editreqtpl->set("aBON",$btit_settings['req_bon']);

						$editreqtpl->set("req_id",$edit_res['id']);
						$editreqtpl->set("reqtitle",$edit_res['reqname']);
						$editreqtpl->set("category",categories($edit_res['category']));
						$editreqtpl->set("imdb",$edit_res['imdb']);
						$editreqtpl->set("tvdb",$edit_res['tvdb']);
						$editreqtpl->set("description",$edit_res['description']);

						$requeststpl->set("view_requests",false,true);
						$requeststpl->set("requests_content",$editreqtpl->fetch(load_template("requests.createreq.tpl")));
					}
					else
					{
						stderr($language['ERROR'],$language['TRAV_NOTAUTH']);
						die();
					}
				}
				else
				{
					stderr($language['ERROR'],$language['TRAV_INVID']);
					die();
				}
			}
			else
			{
				stderr($language['ERROR'],$language["TRAV_NODELID"]." \n \n \n ".$language['TRAV_GOBACK']);
				die();
			}
		}
		elseif($act == 'takereqedit')
		{
			if(isset($_POST['req_id']) && is_numeric($_POST['req_id']) && $_POST['req_id']>0)
			{
				$id = intval($_POST['req_id']);
				if($CURUSER['uid'] == $_POST['uid'] && sha1($CURUSER['random']) == $_POST['auth'])
				{
					if($CURUSER['view_torrents']=='no')
					{
						stderr($language['ERROR'],$language['TRAV_NOTALLOWED']);
						die();
					}
					else
					{
						if($CURUSER['id_level']<$btit_settings['req_level'])
						{
							stderr($language['ERROR'],$language['TRAV_NOTALLOWED']);
							die();
						}

						$reqtitle = $_POST['reqtitle'];
						$cat = 0+$_POST['category'];
						$imdb = 0+$_POST['imdb'];
						$tvdb = 0+$_POST['tvdb'];
						$desc = $_POST['description'];

						if(!$reqtitle)
						{
							stderr($language['ERROR'],$language['TRAV_MUSTADDTITLE']);
							die();
						}
						if($cat==0)
						{
							stderr($language['ERROR'],$language['TRAV_MUSTCHOOSECAT']);
							die();
						}
						if(!is_int($imdb))
						{
							stderr($language['ERROR'],$language['TRAV_INVIMDB']);
							die();
						}
						if(!is_int($tvdb))
						{
							stderr($language['ERROR'],$language['TRAV_INVTVDB']);
							die();
						}

						$reqtitle = sqlesc($reqtitle);
						$cat = sqlesc($cat);
						$imdb = sqlesc($imdb);
						$tvdb = sqlesc($tvdb);
						$desc = ($desc=="")?"":sqlesc($desc);

						quickQuery("UPDATE {$TABLE_PREFIX}requests SET `reqname`={$reqtitle}, `category`={$cat},`imdb`={$imdb},`tvdb`={$tvdb},`description`={$desc} WHERE `id`={$id}") or stderr($language['ERR_SQL_ERR'],$language['TRAV_NOREQEDIT']);

						redirect("index.php?page=requests&action=viewreq&id={$id}");
					}
				}
				else
				{
					stderr($language['ERROR'],$language['TRAV_NOTAUTH']);
					die();
				}
			}
			else
			{
				stderr($language['ERROR'],$language["TRAV_NODELID"]." \n \n \n ".$language['TRAV_GOBACK']);
				die();
			}
		}
		elseif($act == 'takejob')
		{
			if(isset($_POST['req_id']) && is_numeric($_POST['req_id']) && $_POST['req_id']>0)
			{
				$id = intval($_POST['req_id']);
				$test = get_result("SELECT `requester`,`jobtakenby` FROM {$TABLE_PREFIX}requests WHERE `id`={$id}",true,$btit_settings['cache_duration']);
				if($test[0]['jobtakenby'] > 0)
				{
					stderr($language['ERROR'],$language['TRAV_JOB_TAKEN']);
					die();
				}
				if($test[0]['requester'] == $CURUSER['uid'])
				{
					stderr($language['ERROR'],$language['TRAV_TAKE_NOT']);
					die();
				}

				if($CURUSER['uid'] == $_POST['uid'] && sha1($CURUSER['random']) == $_POST['auth'])
				{
					if($CURUSER['can_upload'] == 'yes' && $CURUSER['uid']>1)
					{
						$id = intval($_POST['req_id']);
						quickQuery("UPDATE {$TABLE_PREFIX}requests SET `jobtakenby`=".$CURUSER['uid'].",`jobtakenwhen`=NOW() WHERE `id`={$id}");
						redirect("index.php?page=requests&action=viewreq&id={$id}");
					}
					else
					{
						stderr($language["ERROR"],$language['TRAV_NOTALLOWED']);
						die();
					}
				}
				else
				{
					stderr($language['ERROR'],$language['TRAV_NOAUTH']);
					die();
				}
			}
			else
			{
				stderr($language["ERROR"],$language['TRAV_NODELID']);
				die();
			}
		}
		elseif($act == 'delreq')
		{
			if(isset($_POST['req_id']) && is_numeric($_POST['req_id']) && $_POST['req_id']>0)
			{
				$id = intval($_POST['req_id']);
				if($CURUSER['uid'] == $_POST['uid'] && sha1($CURUSER['random']) == $_POST['auth'])
				{
					$res = do_sqlquery("SELECT `requester`,`jobtakenby`,`uploadedby` FROM {$TABLE_PREFIX}requests WHERE `id`={$id}")->fetch_assoc();
					$requester = $res['requester'];
					$jobtakenby = $res['jobtakenby'];
					$uploadedby = $res['uploadedby'];
					if($CURUSER['admin_access']=='yes' || ($CURUSER['uid']==$requester && $jobtakenby>0 && $uploadedby>0))
					{
						$name = sql_esc($_POST['req_name']);
						$del_req1 = "DELETE FROM {$TABLE_PREFIX}requests WHERE id={$id}";
						$del_req2 = "DELETE FROM {$TABLE_PREFIX}requests_bounty WHERE req_id={$id}";
						$del_req3 = "DELETE FROM {$TABLE_PREFIX}requests_comments WHERE req_id={$id}";

						$del_1 = quickQuery($del_req1);
						$del_2 = quickQuery($del_req2);
						$del_3 = quickQuery($del_req3);

						if($del_1 && $del_2 && $del_3)
						{
							write_log("{$CURUSER['username']} ".$language['TRAV_REQDELLOG']."{$name}");
							information_msg($language['SUCCESS'],$language['TRAV_REQDELETED'],"delete");
							die();
						}
						else
						{
							error_msg($language['ERROR'],$language['TRAV_NOREQDEL']);
							die();
						}
					}
					else
					{
						stderr($language['ERROR'],$language['TRAV_NOTALLOWED']);
						die();
					}
				}
				else
				{
					stderr($language['ERROR'],$language['TRAV_NOTAUTH']);
					die();
				}
			}
			else
			{
				stderr($language['ERROR'],$language["TRAV_NODELID"]);
				die();
			}
		}
		elseif($act == 'reqfill')
		{
			//Verify whether info-hash
			if($CURUSER['uid'] == $_POST['uid'] && sha1($CURUSER['random']) == $_POST['auth'])
			{
				if(isset($_POST['req_id']) && is_numeric($_POST['req_id']) && $_POST['req_id']>0)
				{
					$reqid = intval($_POST['req_id']);
					if(isset($_POST['fill_link']) && strlen($_POST['fill_link'])==40)
					{
						$hash = sql_esc($_POST['fill_link']);
						$hashque = do_sqlquery("SELECT UNIX_TIMESTAMP(data) as data,uploader FROM {$TABLE_PREFIX}files WHERE info_hash=\"{$hash}\"");

						if(sql_num_rows($hashque)==1)
						{
							$hashres = $hashque->fetch_assoc();

							$reqres = do_sqlquery("SELECT `req`.`reqname`,`req`.`requester`,`req`.`infohash`,(SELECT sum(`reqbou`.`seedbonus`) FROM {$TABLE_PREFIX}requests_bounty `reqbou` WHERE `reqbou`.`req_id`=`req`.`id`) as `seedbonus` FROM {$TABLE_PREFIX}requests `req` WHERE id={$reqid}")->fetch_assoc();

							$link = "{$BASEURL}/index.php?page=torrent-details&id={$hash}";
							$message = "Dear Member, \n\n Your request: {$reqres['reqname']} , has been filled. \n\n See this link: [url={$link}]{$reqres['reqname']}[/url] for more info. \n\n If this is incorrect, Please reset via the request section. \n\nSincerely Blu-Bot.";
							send_pm(0,$reqres['requester'],sqlesc($language['RF']),sqlesc($message));

							//BON allocation
							$bounty = intval($reqres['seedbonus'])*(1-((int)$btit_settings['req_tax']/100));
							$tax = intval($reqres['seedbonus'])*((int)$btit_settings['req_tax']/100);

							if($CURUSER['uid']==$hashres['uploader'])
							{
								quickQuery("UPDATE {$TABLE_PREFIX}requests SET uploadedby={$hashres['uploader']}, uploadedwhen=NOW(), infohash=\"{$hash}\" WHERE id={$reqid}");
								quickQuery("UPDATE {$TABLE_PREFIX}users SET seedbonus=seedbonus+{$bounty} WHERE id={$CURUSER['uid']}");
								$_SESSION["CURUSER"]["seedbonus"]+=$bounty;
							}
							elseif(time() > $hasres['data']+3600 && $CURUSER['uid']!=$hashres['uploader'])
							{
								quickQuery("UPDATE {$TABLE_PREFIX}requests SET uploadedby={$CURUSER['uid']}, uploadedwhen=NOW(), infohash=\"{$hash}\" WHERE id={$reqid}");
								quickQuery("UPDATE {$TABLE_PREFIX}users SET seedbonus=seedbonus+{$bounty} WHERE id={$CURUSER['uid']}");
								$_SESSION["CURUSER"]["seedbonus"]+=$bounty;
							}
							else
							{
								stderr($language['ERROR'],$language['TRAV_FILL_TIME']);
								die();
							}

							//Tax to BON Pool allocation
							quickQuery("INSERT INTO `{$TABLE_PREFIX}pool` (`uid`,`date`,`amount`,`poolid`) VALUES (2,NOW(),{$tax},(SELECT `id` FROM `{$TABLE_PREFIX}pool_settings` WHERE `complete`=false LIMIT 1))",true);

							redirect("index.php?page=requests&action=viewreq&id={$reqid}");
						}
						else
						{
							stderr($language['ERROR'],$language['TRAV_HASH_NOEXIST']);
							die();
						}
					}
					else
					{
						stderr($language['ERROR'],$language['TRAV_NOHASH']);
						die();
					}
				}
				else
				{
					stderr($language["ERROR"],$language['TRAV_NODELID']);
					die();
				}
			}
			else
			{
				stderr($language['ERROR'],$language['TRAV_NOAUTH']);
				die();
			}
		}
		elseif($act == 'reqreset')
		{
			if(isset($_POST['req_id']) && is_numeric($_POST['req_id']) && $_POST['req_id']>0)
			{
				$reqid = intval($_POST['req_id']);
				if(isset($_POST['uid']) && is_numeric($_POST['uid']) && $_POST['uid']>0)
				{
					$uid = intval($_POST['uid']);
					if(isset($_POST['req_name']) && $_POST['req_name']!="")
					{
						$reqname = sql_esc($_POST['req_name']);
						if($CURUSER['uid']==$_POST['uid'] && sha1($CURUSER['random']==$_POST['auth']))
						{
							$res = do_sqlquery("SELECT `req`.`requester`,`req`.`jobtakenby`,`req`.`uploadedby`,`req`.`uploadedwhen`,(SELECT sum(`reqbou`.`seedbonus`) FROM {$TABLE_PREFIX}requests_bounty `reqbou` WHERE `reqbou`.`req_id`=`req`.`id`) as `amount` FROM {$TABLE_PREFIX}requests `req` where `req`.`id`={$reqid}")->fetch_assoc();
							$requester = $res['requester'];
							$jobtakenby = $res['jobtakenby'];
							$uploadedby = $res['uploadedby'];
							$uploadedwhen = $res['uploadedwhen'];
							$amount = $res['amount']*0.9;

							if($CURUSER['admin_access'] == 'yes' || ($CURUSER['uid']==$requester && $jobtakenby>0 && $uploadedby>0 && (($uploadedwhen+48*3600)>time())) || ($jobtakenby>0 && $CURUSER['uid']==$jobtakenby && (($uploadedwhen+48*3600)>time())))
							{
								if($uploadedby>0)
								{
									$bonreset = quickQuery("UPDATE {$TABLE_PREFIX}users SET seedbonus=seedbonus-{$amount} WHERE id={$uploadedby} AND `seedbonus`>{$amount}");
									if(!$bonreset)
									{
										send_pm(0,23027,sqlesc("BON Reset Failure"),sqlesc("The Following userid: {$uploadedby} \n\n Does not have {$amount} BON when BON was reset."));
									}
								}

								$reset = quickQuery("UPDATE {$TABLE_PREFIX}requests SET `jobtakenby`=0,`jobtakenwhen`='0000-00-00 00:00:00',`uploadedby`=0,`uploadedwhen`='0000-00-00 00:00:00' WHERE `id`={$reqid}");

								if($reset)
								{
									write_log("{$CURUSER['username']} ".$language['TRAV_REQRESLOG']."{$reqname}","modify");
									redirect("index.php?page=requests");
									die();
								}
								else
								{
									stderr($language['ERROR'],$language['TRAV_DEN_RESET']);
									die();
								}
							}
							else
							{
								stderr($language['ERROR'],$language['TRAV_CANNOT']);
								die();
							}
						}
						else
						{
							stderr($language['ERROR'],$language['TRAV_NOTAUTH']);
							die();
						}
					}
					else
					{
						stderr($language['ERROR'],$language['TRAV_NOREQNAME']);
						die();
					}
				}
				else
				{
					stderr($language['ERROR'],$language['TRAV_NOUSERID']);
					die();
				}
			}
			else
			{
				stderr($language["ERROR"],$language['TRAV_NODELID']);
				die();
			}
		}
		elseif($act == 'addbounty')
		{
			if(isset($_POST['amount']) && is_numeric($_POST['amount']) && $_POST['amount']>0)
			{
				$amount = intval($_POST['amount']);
				if($_POST['uid']==$CURUSER['uid'] && $_POST['auth']==sha1($CURUSER['random']))
				{
					if($CURUSER['seedbonus']>=$amount)
					{
						if(isset($_POST['req_id']) && $_POST['req_id']>0 && is_numeric($_POST['req_id']))
						{
							$reqid = intval($_POST['req_id']);

							$isfillque = do_sqlquery("SELECT uploadedby FROM {$TABLE_PREFIX}requests WHERE id={$reqid}")->fetch_assoc();
							$isfilled = $isfillque['uploadedby'];
							if($isfilled==0)
							{
								$user = quickQuery("UPDATE {$TABLE_PREFIX}users SET seedbonus=seedbonus-{$amount} WHERE id={$CURUSER['uid']}");
								if($user)
								{
									$bon = quickQuery("INSERT INTO {$TABLE_PREFIX}requests_bounty (`addedby`,`seedbonus`,`req_id`) VALUES ({$CURUSER['uid']},{$amount},{$reqid})");
									if($bon)
									{
										redirect("index.php?page=requests&action=viewreq&id={$reqid}");
									}
									else
									{
										quickQuery("UPDATE {$TABLE_PREFIX}users SET seedbonus=seedbonus+{$amount} WHERE id={$CURUSER['uid']}");
										stderr($language['ERROR'],$language['TRAV_BON_REQ_ERR']);
									}
								}
								else
								{
									stderr($language['ERROR'],$language['TRAV_BON_USER_ERR']);
									die();
								}
							}
							else
							{
								stderr($language['ERROR'],$language['TRAV_BON_REQ_FILL']);
								die();
							}
						}
						else
						{
							stderr($language['ERROR'],$language['TRAV_NODELID']);
							die();
						}
					}
					else
					{
						stderr($language['ERROR'],$language['SB_NOT_ENOUGH_POINTS']);
						die();
					}
				}
				else
				{
					stderr($language['ERROR'],$language['TRAV_NOAUTH']);
					die();
				}
			}
			else
			{
				stderr($language['ERROR'],$language['TRAV_NOBON']);
				die();
			}
		}
		elseif($act == 'addcomment')
		{
			if(isset($_POST['req_id']) && is_numeric($_POST['req_id']) && $_POST['req_id']>0)
			{
				if(isset($_POST['comment']) && $_POST['comment']!='')
				{
					if(isset($_POST['uid']) && is_numeric($_POST['uid']) && $_POST['uid']>0)
					{
						if($CURUSER['uid']==$_POST['uid'] && sha1($CURUSER['random']==$_POST['auth']))
						{
							$comment = sqlesc($_POST['comment']);
							$uid = $CURUSER['uid'];
							$reqid = intval($_POST['req_id']);

							$com = quickQuery("INSERT INTO `{$TABLE_PREFIX}requests_comments` (`req_id`,`addedby`,`addedwhen`,`comment`) VALUES ({$reqid},{$uid},NOW(),{$comment});");

							if($com)
							{
								redirect("index.php?page=requests&action=viewreq&id={$reqid}");
							}
							else
							{
								stderr($language['ERROR'],$language['TRAV_COMMENT']);
								die();
							}
						}
						else
						{
							stderr($language['ERROR'],$language['TRAV_NOTAUTH']);
							die();
						}
					}
					else
					{
						stderr($language['ERROR'],$language['TRAV_NOUSERID']);
						die();
					}
				}
				else
				{
					stderr($language['ERROR'],$language['TRAV_COMMENT']);
					die();
				}
			}
			else
			{
				stderr($language["ERROR"],$language['TRAV_NODELID']);
				die();
			}
		}
		else
		{
			$requeststpl->set("view_requests",true,true);
			$requeststpl->set("req_welcome","REQUESTS -> VIEW");
			$requeststpl->set("uid",$CURUSER['uid']);
			$requeststpl->set("uid_auth",sha1($CURUSER['random']));
			$requeststpl->set("language",$language);

			//Form handling
			$requeststpl->set("title_value",(($act=='search')?$_GET['title']:""));
			$requeststpl->set("category",(($act=='search')?categories(0+$_GET['category']):categories()));
			$requeststpl->set("hfillcheck",(($act=='search' && $_GET['hfilled']=='on')?"checked='yes'":""));
			$requeststpl->set("htakencheck",(($act=='search' && $_GET['htaken']=='on')?"checked='yes'":""));
			$requeststpl->set("col_name",(($act=='search' && $_GET['col']=='name')?"selected='yes'":""));
			$requeststpl->set("col_views",(($act=='search' && $_GET['col']=='views')?"selected='yes'":""));
			$requeststpl->set("col_bon",(($act=='search' && $_GET['col']=='bon')?"selected='yes'":""));
			$requeststpl->set("order_asc",(($act=='search' && $_GET['order']=='asc')?"selected='yes'":""));
			$requeststpl->set("order_desc",(($act=='search' && $_GET['order']=='desc')?"selected='yes'":""));
			//Form handling

			$search = "ORDER BY `req`.`id` DESC";
			if($act=="search")
			{
				$stitle = sql_esc($_GET['title']);
				$scategory = sql_esc(0+$_GET['category']);
				$hfilled = (isset($_GET['hfilled']) && $_GET['hfilled']=="on")?true:false;
				$htaken = (isset($_GET['htaken']) && $_GET['htaken']=="on")?true:false;
				$scol_1 = $_GET['col']; $scol = "";
				$sasc = sql_esc($_GET['order']);

				switch($scol_1)
				{
					case "name":
					$scol = "`req`.`reqname`";
					break;
					case "views":
					$scol = "`req`.`views`";
					break;
					case "bon":
					$scol = "`total_bounty`";
					break;
					default:
					$scol = "`req`.`reqname`";
					break;
				}


				$search = "WHERE `req`.`reqname` LIKE '%{$stitle}%' ".($scategory>0?"AND `req`.`category`={$scategory} ":"").($hfilled?"AND `req`.`uploadedby`=0 ":"").($htaken?"AND `req`.`jobtakenby`=0":"")." ORDER BY {$scol} {$sasc}";
			}
			if(isset($_GET['uid']) && $_GET['uid']>1)
			{
				$search = "WHERE `req`.`requester`={$CURUSER['uid']}";
			}

			$counter = get_result("SELECT count(`req`.`id`) as `req_no` FROM {$TABLE_PREFIX}requests `req`",true,$btit_settings['cache_duration']);

			$count = intval($counter[0]['req_no']);
			$dir = "index.php?page=requests&title={$_GET['title']}&category={$_GET['category']}&hfilled={$_GET['hfilled']}&htaken={$_GET['htaken']}&col={$_GET['col']}&order={$_GET['order']}&";

			list($pagertop,$pagerbottom,$limit) = pager(intval($btit_settings['req_page']),$count,$dir);

			if($count>0)
			{
				$query = get_result("SELECT `req`.`id`, `req`.`reqname`, `req`.`category`, `req`.`requester`, UNIX_TIMESTAMP(`req`.`dateadded`) as `dateadded`, `req`.`description`, `req`.`views`, `req`.`jobtakenby`, UNIX_TIMESTAMP(`req`.`jobtakenwhen`) as `jobtakenwhen`, `req`.`uploadedby`, UNIX_TIMESTAMP(`req`.`uploadedwhen`) as `uploadedwhen`,`req`.`infohash`, `u1`.`username` as `req_username`, `ul1`.`suffixcolor` as `req_suffix`, `ul1`.`prefixcolor` as `req_prefix`, `u2`.`username` as `job_username`, `ul2`.`prefixcolor` as `job_prefix`, `ul2`.`suffixcolor` as `job_suffix`, `u3`.`username` as `upl_username`, `ul3`.`prefixcolor` as `upl_prefix`, `ul3`.`suffixcolor` as `upl_suffix`, (SELECT sum(`reqbou`.`seedbonus`) FROM {$TABLE_PREFIX}requests_bounty `reqbou` WHERE `reqbou`.`req_id`=`req`.`id`) as `total_bounty`, (SELECT count(distinct `reqbou`.`addedby`) FROM {$TABLE_PREFIX}requests_bounty `reqbou` WHERE `reqbou`.req_id=`req`.`id`)as `total_voters` , `files`.`info_hash`,`files`.`filename` as `filename`,`c`.`id` as `catid` ,`c`.`name` as `catname`, `c`.`image` as `catimg` FROM {$TABLE_PREFIX}requests `req` LEFT JOIN {$TABLE_PREFIX}categories `c` ON `c`.`id`=`req`.`category` LEFT JOIN {$TABLE_PREFIX}users `u1` ON `req`.`requester`=`u1`.`id` LEFT JOIN {$TABLE_PREFIX}users_level `ul1` ON `u1`.`id_level`=`ul1`.`id` LEFT JOIN {$TABLE_PREFIX}users `u2` ON `req`.`jobtakenby`=`u2`.`id` LEFT JOIN {$TABLE_PREFIX}users_level `ul2` ON `u2`.`id_level`=`ul2`.`id` LEFT JOIN {$TABLE_PREFIX}users `u3` ON `req`.`uploadedby`=`u3`.`id` LEFT JOIN {$TABLE_PREFIX}users_level `ul3` ON `u3`.`id_level`=`ul3`.`id` LEFT JOIN {$TABLE_PREFIX}files `files` ON `files`.`info_hash`=`req`.`infohash` {$search}",true,$btit_settings['cache_duration']);
				$reqdata = array();
				$i = 0;
				$cid = $CURUSER['uid'];
				$cauth = sha1($CURUSER['random']);
				$requeststpl->set("has_requests",true,true);
				foreach($query as $tres)
				{
					$reqdata[$i]['req_id'] = $tres['id'];
					if($tres['jobtakenby']>0)
					{
						$jtbid = $tres['jobtakenby'];
						$jtbuser = $tres['job_prefix'].$tres['job_username'].$tres['job_suffix'];
						$jtbdate = "[".date("d/m/Y H:i:s",$tres['jobtakenwhen']-$offset)."]";

						$reqdata[$i]['job'] = "<a href='index.php?page=userdetails&id={$jtbid}'>{$jtbuser}</a><br>{$jtbdate}";
					}
					else
					{
						if($CURUSER['can_upload']=='yes')
						{
							$reqdata[$i]['job'] = "<form method='post' action='index.php?page=requests&amp;action=takejob'>\n<input type='hidden' name='req_id' value='{$tres['id']}'>\n<input type='hidden' name='uid' value='{$cid}'>\n<input type='hidden' name='auth' value='{$cauth}'>\n<input type='submit' class='btn btn-sm btn-primary' value='{$language['TRAV_TJ']}'>\n</form>";
						}
						else
						{
							$reqdata[$i]['job'] = $language['TRAV_SOON'];
						}
					}

					$reqdata[$i]['catid'] = $tres['catid'];
					$reqdata[$i]['catimg'] = image_or_link(($tres['catimg']==""?"":"{$STYLEPATH}/images/categories/".$tres['catimg']),"",$tres['catname']);

					$reqdata[$i]['reqname'] = $tres['reqname'];

					$reqdata[$i]['req_uid'] = $tres['requester'];
					$reqdata[$i]['req_by'] = $tres['req_prefix'].$tres['req_username'].$tres['req_suffix'];
					$reqdata[$i]['req_when'] = "[".date("d/m/Y H:i:s",$tres['dateadded']-$offset)."]";

					if($tres['uploadedby']>0)
					{
						$uplid = $tres['uploadedby'];
						$upluser = $tres['upl_prefix'].$tres['upl_username'].$tres['upl_suffix'];
						$upldate = "[".date("d/m/Y H:i:s",$tres['uploadedwhen']-$offset)."]";
						$torid = $tres['infohash'];

						$reqdata[$i]['filled'] = "<a href='index.php?page=userdetails&id={$uplid}'>{$upluser}</a><br>{$upldate}<br>[<a href='index.php?page=torrent-details&id={$torid}'>{$language['TORR_LINK']}</a>]";
					}
					else
					{
						$reqdata[$i]['filled'] = $language['TRAV_SOON'];
					}

					$reqdata[$i]['bon'] = number_format($tres['total_bounty']);
					$reqdata[$i]['voters'] = $tres['total_voters'];

					//has access
					$hasaccess = "";
					if(($CURUSER['admin_access']=='yes' && ($tres['uploadedby']>0 || $tres['jobtakenby']>0)) || ($CURUSER['uid']==$tres['requester'] && $tres['uploadedby']>0 && $tres['jobtakenby']>0 && (($uploadedwhen+48*3600)>time())) || ($CURUSER['uid']==$tres['jobtakenby']))
					{
						$hasaccess .= "<form action='index.php?page=requests&action=reqreset' method='post'>\n<input type='hidden' name='req_id' value='{$tres['id']}'>\n<input type='hidden' name='req_name' value='{$tres['reqname']}'>\n<input type='hidden' name='uid' value='{$cid}'>\n<input type='hidden' name='auth' value='{$cauth}'>\n<input type='submit' class='btn btn-sm btn-danger' value='{$language['RS']}'>\n</form>";
					}
					if($CURUSER['admin_access']=='yes' || ($CURUSER['uid']==$tres['requester'] && $tres['uploadedby']==0 && $tres['jobtakenby']==0))
					{
						$hasaccess .= "<form action='index.php?page=requests&action=delreq' method='post'>\n<input type='hidden' name='req_id' value='{$tres['id']}'>\n<input type='hidden' name='req_name' value='{$tres['reqname']}'>\n<input type='hidden' name='uid' value='{$cid}'>\n<input type='hidden' name='auth' value='{$cauth}'>\n<input type='submit' class='btn btn-sm btn-danger' value='{$language['DELETE']}'>\n</form>";
					}
					$reqdata[$i]['access'] = ($hasaccess=="")?$language['SB_ACC_DEN']:$hasaccess;

					$i++;
				}
			}
			else
			{
				$requeststpl->set("has_requests",false,true);
			}

			$requeststpl->set("top_pager",$pagertop);
			$requeststpl->set("can_upload",($CURUSER['can_upload']=='yes'?true:false),true);
			$requeststpl->set("reqdata",$reqdata);
			$requeststpl->set("bottom_pager",$pagerbottom);
		}
	}
	else
	{
		stderr($language["TRAV_NOAUTH"], $language["TRAV_NOADD1"]." is ".$language['TRAV_NOTALLOWED']);
		die();
	}
}
?>
