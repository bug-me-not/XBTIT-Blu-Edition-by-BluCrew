<?php

//by CobraCRK 21.07.2006 - www.extremeshare.org - cobracrk@yahoo.com
//converted to xbtit by cooly
if (!defined("IN_BTIT"))
    die("non direct access!");



require_once ("include/sanitize.php");
require (load_language("lang_subs.php"));

global $STYLEURL, $CURUSER;

if ($CURUSER["view_torrents"] == "no")
{
    err_msg(ERROR, NOT_AUTH_VIEW_NEWS);
    stdfoot();
    exit;
}

$src = sanitize_sql_string($_POST['src']);
$subsearchtpl = new bTemplate();
$subsearchtpl->set("language", $language);

if ($CURUSER["can_upload"] == "yes")
{
    $subadd = "<br><center><a href=\"index.php?page=subadd\"><img src=\"images/Add.png\" width=30 height=30 alt=\"Add Subtitle\" title=\"Add Subtitle\"></a>&nbsp;&nbsp;<a href=\"index.php?page=subtitles\"><img src=\"images/Back.png\" width=30 height=30 alt=\"Back\" title=\"Back\"></a></center>";
}

$search = "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"index.php?page=subsearch\">
  <div align=\"center\">
    <input name=\"src\" type=\"text\" size=\"40\" value=\"$src\" />
    <input type=\"submit\" class=btn name=\"Submit\" value=\"" . $language['SUBSEARCH'] .
    "\" />
  </div>
</form>
<p>&nbsp;</p>
<table border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">";

$subsearchtpl->set("subadd", $subadd);
$subsearchtpl->set("subsearch", $search);

$subres = do_sqlquery("SELECT COUNT(*) FROM {$TABLE_PREFIX}subtitles WHERE name LIKE '%$src%'", true);
$subnum = $subres->fetch_row();
$num2 = $subnum[0];

if ($num2 == 0)
{
    "<div class=\"alert alert-dismissable alert-bg-white alert-danger\">
    <button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
    <div class=\"icon\"><i class=\"fa fa-times\"></i></div>
    <strong>".$language['SUBS_EMPTY_STD']."</strong>
    </div>
    </div>"
}

$perpage = (max(0, $CURUSER["torrentsperpage"]) > 0 ? $CURUSER["torrentsperpage"] :
    10);
list($pagertop, $pagerbottom, $limit) = pager($perpage, $num2,
    "index.php?page=subsearch&amp;");
$subsearchtpl->set("pagertop", $pagertop);
$subsearchtpl->set("pagerbottom", $pagerbottom);
$r = do_sqlquery("SELECT s.id as id, s.name as name, s.pic as pic, s.imdb as imdb, s.author as author, s.uploader as uploader, s.file as file, s.framerate as framerate, s.cds as cds, s.downloaded as downloaded, s.hash as hash, s.flag as flag, c.flagpic as flagpic, c.name as country FROM {$TABLE_PREFIX}subtitles s LEFT JOIN {$TABLE_PREFIX}countries c ON s.flag=c.id WHERE s.name LIKE '%$src%' ORDER BY name $limit");
$subs = array();
$i = 0;

while ($row = $r->fetch_array())
{
    $up = $row['uploader'];
    $mss = do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users WHERE id=$up LIMIT 1");
    $uploader = $mss->fetch_row()[0];
    if (is_null($row['author']))
    {
        $row['author'] = "Unknown";
    }
    $subs[$i][id] = (int)$row['id'];
    $subs[$i][pic] = "<img src=" . $row['pic'] . " alt=\"Extreme Subtitles\" width=\"61\" height=\"90\" border=\"0\" />";
    $subs[$i][imdb] = "<a href=\"" . $row['imdb'] . "\" target=\"_blank\">" . $row['name'] .
        "</a>";
    $subs[$i][flagpic] = "<img src=\"images/flag/" . $row['flagpic'] . "\" alt=\"" .
        $row['country'] . "\" title=\"" . $row['country'] . "\">";
    $subs[$i][uploader] = "<a href=\"userdetails.php?id=" . $row['uploader'] . "\">$uploader</a>";
    $subs[$i][downloaded] = (int)$row['downloaded'];
    $subs[$i][framerate] = $row['framerate'];
    $subs[$i][cds] = $row['cds'];
    $subs[$i][author] = $row['author'];
    $subs[$i][dl] = "<a href=\"subtitle_download.php?id=" . $row['id'] . "\"><img src=images/download.gif alt=download title=download></a>";
    if ($CURUSER['edit_torrents'] == "yes")
    {
        $subs[$i][del] = "<a href=\"subtitle_del.php?do=del&id=" . $row['id'] . "\"><img src=" .
            $STYLEURL . "/images/delete.png alt=delete title=delete></a>";
    }
    if ($CURUSER == $row['uploader'] || $CURUSER['edit_torrents'] == "yes")
    {
        $subs[$i][ed] = "<a href=\"index.php?page=subedit&action=edit&id=" . $row['id'] .
            "\"><img src=" . $STYLEURL . "/images/edit.png alt=delete title=edit></a>";
    }
    $i++;
}
$tds = " </center></td>
    </tr>";
$endsubs = "</table>";
$subsearchtpl->set("subs", $subs);
$subsearchtpl->set("subadd", $subadd);
$subsearchtpl->set("tds", $tds);
$subsearchtpl->set("endsubs", $endsubs);
//by CobraCRK 21.07.2006 - www.extremeshare.org - cobracrk@yahoo.com
//converted to xbtit by cooly

?>
