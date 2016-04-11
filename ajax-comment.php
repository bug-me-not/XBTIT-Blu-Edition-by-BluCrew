<?php
//#################################################################################
//## Created by Bhorer_Alo
//## 
//## THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
//## WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
//## MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
//## IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
//## SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
//## TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
//## PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
//## LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
//## NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
//## EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//##
//#################################################################################

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
	do_sqlquery("INSERT INTO {$TABLE_PREFIX}comments (added,text,ori_text,user,info_hash) VALUES (NOW(),\"$comment\",\"$comment\",\"$user\",\"" . sql_esc(StripSlashes($id)) . "\")",true);
	
	$subres = get_result("SELECT ".$query2_select." c.id, c.points, text, UNIX_TIMESTAMP(added) as data, user, u.id as uid FROM {$TABLE_PREFIX}comments c LEFT JOIN {$TABLE_PREFIX}users u ON c.user=u.username ".$query2_join." WHERE c.info_hash = '" . $id . "' ORDER BY added DESC ".$limit,true,$btit_settings['cache_duration']);
	
	$time = date("d/m/Y H.i.s",$subres[0]["data"]-$offset);
	$level= get_result("SELECT level FROM {$TABLE_PREFIX}users_level WHERE id_level=".$CURUSER['id_level']);
	$quote = "<a href='index.php?page=comment&id=$id&usern=".$CURUSER["username"]."&quoteid=".$subres[0]["id"]."'><img src='.".$STYLEPATH."/images/f_quote.png'/></a>";
	$delete = "<a onclick=\"return confirm('Are you sure you want to delete/remove this?')\" href=\"index.php?page=comment&amp;id=$id&amp;cid=" . $subres[0]["id"] . "&amp;action=delete\"><img src='.".$STYLEPATH."/images/f_delete.png'/></a>";
	$edit = "<a href=\"index.php?page=comment&amp;id=$id&amp;cid=" . $subres[0]["id"] . "&amp;edit\"><img src='.".$STYLEPATH."/images/f_edit.png'/></a>";
	$avatar = "<img onload=\"resize_avatar(this);\" src=\"".($subres[0]["avatar"] && $subres[0]["avatar"] != "" ? htmlspecialchars($subres[0]["avatar"]): "$STYLEURL/images/default_avatar.gif" )."\" alt=\"\" />";
	$ratio = "<img src=\"images/arany.png\">&nbsp;".(intval($subres[0]['downloaded']) > 0?number_format($subres[0]['uploaded'] / $subres[0]['downloaded'], 2):"---");
	$uploaded = "<img src=\"images/speed_up.png\">&nbsp;".(makesize($subres[0]["uploaded"]));
	$downloaded= "<img src=\"images/speed_down.png\">&nbsp;".(makesize($subres[0]["downloaded"]));

// DT reputation system start
$reput=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}reputation_settings WHERE id =1");
$setrep=mysql_fetch_array($reput);

if ($setrep["rep_is_online"]== 'false')
{
//do nothing
}
else
{
if ($subres[0]["reputation"] == 0)
{
$reput= "<img src='images/rep/reputation_balance.gif' alt='" . $setrep["no_level"] . "' title='" . $setrep["no_level"] . "' />";
}
if ($subres[0]["reputation"] >= 1  )
{
$reput= "<img src='images/rep/reputation_pos.gif' alt='" . $setrep["good_level"] . "' title='" . $setrep["good_level"] . "' />";
}
if ($subres[0]["reputation"] <= -1)
{
$reput= "<img src='images/rep/reputation_neg.gif' alt='" . $setrep["bad_level"] . "' title='" . $setrep["bad_level"] . "' />";
}
if ($subres[0]["reputation"] >= 101 )
{
$reput= "<img src='images/rep/reputation_highpos.gif' alt='" . $setrep["best_level"] . "' title='" . $setrep["best_level"] . "' />";
}
if ($subres[0]["reputation"] <= -101)
{
$reput= "<img src='images/rep/reputation_highneg.gif' alt='" . $setrep["worse_level"] . "' title='" . $setrep["worse_level"] . "' />";
}
$reputation = "Reputation: ".$reput;
}
// DT end reputation system

//All set now, just show the comments.
	echo "
	
	    <tr>
			<td align=\"left\" class=\"header\" colspan=\"2\">
				<table width=\"100%\">
				<td align=\"right\">You can't vote your own comment.&nbsp;&nbsp;&nbsp;$quote $edit $delete</td>
				</table>
			</td>
        </tr>
		<tr>
			<td class=\"header\" align=\"left\" valign=\"top\">
				<table width=\"140\">
					<tr>
					  <td>
						  <a href=\"index.php?page=userdetails&amp;id=".$CURUSER["uid"]."\">".unesc($CURUSER["prefixcolor"]).unesc($CURUSER["username"]).unesc($CURUSER["suffixcolor"])."</a>
						  <br />
						  Rank: ".$level[0]["level"]."
						  <br />$reputation<br />$time<br />(".get_elapsed_time($subres[0]["data"]) . " ago)<br />$avatar
						  <br />$ratio
						  <br />$uploaded
						  <br />$downloaded
					  </td>
					</tr>
				</table>
			</td>
			<td class=\"lista new\" width=\"100%\" valign=\"top\" style=\"padding:10px\">$forcomment</td>
        </tr>";
}
?>