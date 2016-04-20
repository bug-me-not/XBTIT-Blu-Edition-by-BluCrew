<?php
//Request Comments//

require_once ("include/functions.php");

include("include/offset.php");

global $CURUSER, $btit_settings, $language, $TABLE_PREFIX, $STYLEURL, $STYLEPATH;

if (!$CURUSER || $CURUSER["uid"]==1)
{
   stderr($language["ERROR"],$language["ONLY_REG_COMMENT"]);
}

if((isset($_POST['id'])) && (isset($_POST['comment'])) && (isset($_POST['user'])))
{

	$id = $_POST['id'];
	$user = $_POST['user'];
	$comment = $_POST['comment'];
	$forcomment= format_comment($_POST['comment']); //Formatted Comment

	dbconn(true);	
	do_sqlquery("INSERT INTO {$TABLE_PREFIX}comments (added,text,ori_text,user,info_hash) VALUES (NOW(),\"$comment\",\"$comment\",\"$user\",\"" . mysqli_real_escape_string(StripSlashes($id)) . "\")",true);
	
	$subres = get_result("SELECT u.downloaded as downloaded, u.uploaded as uploaded, u.avatar, u.id_level, u.custom_title, u.id_level, u.warn, u.donor, c.id, text, UNIX_TIMESTAMP(added) as data, user, u.id as uid FROM {$TABLE_PREFIX}comments c LEFT JOIN {$TABLE_PREFIX}users u ON c.user=u.username WHERE info_hash = '" . $id . "' && user= '".$user."' ORDER BY added DESC LIMIT 1",true,$btit_settings['cache_duration']);
	
	$time = date("d/m/Y H.i.s",$subres[0]["data"]-$offset);
	$level= get_result("SELECT level FROM {$TABLE_PREFIX}users_level WHERE id_level=".$CURUSER['id_level']);
	


//All set now, just show the comments.
	echo "
	<table class='table table-bordered'>
		<tr>
			<td class=\"header\" align=\"left\" valign=\"top\">
				<table width=\"140\">
					<tr>
					  <td>
						  <a href=\"index.php?page=userdetails&amp;id=".$CURUSER["uid"]."\">".unesc($CURUSER["prefixcolor"]).unesc($CURUSER["username"]).unesc($CURUSER["suffixcolor"])."</a>
						  <br />
						  Rank: ".$level[0]["level"]."
					  </td>
					</tr>
				</table>
			</td>
			<td class=\"lista new\" width=\"100%\" valign=\"top\" style=\"padding:10px\">$forcomment</td>
        </tr></table>";
}
?>