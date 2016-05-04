<?php
ob_start();
// Prevent non logged users access
if ($CURUSER['uid'] == 1 || !$CURUSER['uid'])
	stderr("Error", "You must be logged in to view this page");

/*if($CURUSER['id_level']!=8)
	stderr("Disabled","This Module has been temporarily disabled.");*/

if ($btit_settings["fmhack_bluflix"] == 'enabled'){

$pagetitle = "";
require ("./imdb/imdb.class.php");
function showmovie($imdb){
global $CURUSER;
$movieid = "{$imdb}";
$movie = new imdb($movieid);
$movie->setid ($movieid);
$movie->photodir='./imdb/images/';
$movie->photoroot='./imdb/images/';
$watched = '';
if ($CURUSER['uid'] == 3){
	$views = do_sqlquery("SELECT SUM(views) AS total FROM {$TABLE_PREFIX}stream WHERE imdb='{$movieid}'");
	$views = $views->fetch_array();
	$watched = "Watched ".$views['total']." Times";
}

if (($photo_url = $movie->photo_localurl() ) != FALSE)
$movieblock = '<div style="display: inline-block; margin: 1em">
<table style="width: 160px;height:320px" border="0"><tbody><tr><td align="center" valign="top">
<a href="index.php?page=modules&module=video_player&id='.$movieid.'"><div class="bfimg"><img src="'.$photo_url.'" width="130" height="190"><div class="showoff"></div></div></a><br />
<a href="index.php?page=modules&module=video_player&id='.$movieid.'">'.$movie->title().'</a> ('.$movie->year().')<br>Rating: '.$movie->rating().'&nbsp;-&nbsp;
<a target="_blank" href="http://www.imdb.com/title/tt'.$movieid.'/">IMDB</a><br /><a href="index.php?page=torrents&options=3&search='.$movieid.'">View Torrents</a><br />'.$watched.'
</td></tr></tbody></table></div>';
print $movieblock;
}

function showporn($pornid){
$showporn = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}stream_porn WHERE pornid='{$pornid}' LIMIT 1");
$showporn = $showporn->fetch_array();
$pornphotoloc = "images/porn/{$pornid}.jpg";
$movieblock = '<div style="display: inline-block; margin: 1em">
<table style="width: 160px;height:300px" border="0"><tbody><tr><td align="center" valign="top">
<a href="index.php?page=modules&module=video_player&xid='.$pornid.'"><div class="bfimg"><img src="'.$pornphotoloc.'" width="130" height="190"><div class="showoff"></div></div></a><br />
<a href="index.php?page=modules&module=video_player&xid='.$pornid.'">'.$showporn['title'].'</b>
</td></tr></tbody></table></div>';
print $movieblock;
}

print "<div align=\"center\" style=\"width: 100%; margin: 0 auto;\">";
print "What is BluFLIX ? Quite simply BluFLIX is our exclusive high definition streaming service for VIP members to enjoy!<br /><br /><br /><br /><br /><br />";

$formdata = '<center><form action="index.php?page=modules&module=bluflix&sortby=search" method="post">
			<input type="text" name="searching" value=""> &nbsp;&nbsp;&nbsp;
			<input type="submit" value="Search!">
			</form></center>';
print $formdata."<br /><br />";


$link_year = "index.php?page=modules&module=bluflix&sortby=year";
$link_genre = "index.php?page=modules&module=bluflix&sortby=genre";
$link_latest = "index.php?page=modules&module=bluflix&sortby=latest";
$link_alpha = "index.php?page=modules&module=bluflix&sortby=alpha";
$pagertop = "";
$pagerbottom = "";
print "Sort By: <a href=\"{$link_year}\">Year</a> | <a href=\"{$link_genre}\">Genre</a> | <a href=\"{$link_latest}\">Latest</a> | <a href=\"{$link_alpha}\">Alphabetical</a><br /><br />";

$titles_page = 28;
$default_query = do_sqlquery("SELECT imdb FROM {$TABLE_PREFIX}stream ORDER BY id DESC LIMIT {$titles_page}");

if ($_GET['sortby'] == 'year'){
	$pagetitle = "> SortBy > Year";
	$query = do_sqlquery("SELECT year FROM {$TABLE_PREFIX}stream GROUP BY year ORDER BY year DESC");
	print "| ";
	while ($row = $query->fetch_array()){
		print "<a href=\"{$link_year}&year={$row['year']}\">{$row['year']}</a> | ";
			}



	if ($_GET['sortby'] == 'year' && isset($_GET['year'])){
		$pagetitle = "> SortBy > Year > {$_GET['year']}";
		$count = sql_num_rows(do_sqlquery("SELECT imdb FROM {$TABLE_PREFIX}stream WHERE year=".sqlesc($_GET['year'])." GROUP BY imdb"));
		list($pagertop, $pagerbottom, $limit) = pager($titles_page, $count,  "{$link_year}&year={$_GET['year']}&");
		$query = do_sqlquery("SELECT imdb FROM {$TABLE_PREFIX}stream WHERE year=".sqlesc($_GET['year'])." GROUP BY imdb {$limit}");
		print $pagertop;
	}else{
		$query = $default_query;
		$pagetitle = "> Latest";
		}

}else if ($_GET['sortby'] == 'latest'){
	//latest
	$pagetitle = "> SortBy > Latest";
		if ($_GET['sortby'] == 'latest'){
		$count = sql_num_rows(do_sqlquery("SELECT imdb FROM {$TABLE_PREFIX}stream ORDER BY id DESC"));
		list($pagertop, $pagerbottom, $limit) = pager($titles_page, $count,  "{$link_latest}&");
		$query = do_sqlquery("SELECT imdb FROM {$TABLE_PREFIX}stream ORDER BY id DESC {$limit}");
		print $pagertop;
	}else{
		$query = $default_query;
		$pagetitle = "> Latest";
		}


}else if ($_GET['sortby'] == 'genre'){
// sort genre
$pagetitle = "> SortBy > Genre";
	$query = do_sqlquery("SELECT genre1 FROM {$TABLE_PREFIX}stream WHERE genre1 !='' GROUP BY genre1 ORDER BY genre1 ASC");
	//$query = do_sqlquery("SELECT CONCAT(genre1, genre2, genre3, genre4) AS genre FROM {$TABLE_PREFIX}stream WHERE genre1 !='' ORDER BY genre ASC");

	print "| ";
	while ($row = $query->fetch_array()){
		print "<a href=\"{$link_genre}&genre={$row['genre1']}\">{$row['genre1']}</a> | ";
			}
			// Adult Genre link
			if($CURUSER['showporn']=='yes'){
			//print "<a href=\"{$link_genre}&genre=Adult\">Adult</a> | ";
			}
	if ($_GET['sortby'] == 'genre' && isset($_GET['genre'])){
		// adult exeptions
		if ($_GET['genre'] == 'Adult'){
			//special adult queries
			$count = sql_num_rows(do_sqlquery("SELECT * FROM {$TABLE_PREFIX}stream_porn ORDER BY id DESC"));
			list($pagertop, $pagerbottom, $limit) = pager($titles_page, $count,  "{$link_genre}&genre=Adult&");
			$pornquery = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}stream_porn ORDER BY id DESC {$limit}");
			print $pagertop;
		}else{
		//non adult genres
		$count = sql_num_rows(do_sqlquery("SELECT imdb FROM {$TABLE_PREFIX}stream WHERE genre1='".sql_esc($_GET['genre'])."' OR genre2='".sql_esc($_GET['genre'])."' OR genre3='".sql_esc($_GET['genre'])."' OR genre4='".sql_esc($_GET['genre'])."' GROUP BY imdb"));
		list($pagertop, $pagerbottom, $limit) = pager($titles_page, $count,  "{$link_genre}&genre={$_GET['genre']}&");
		$query = do_sqlquery("SELECT imdb FROM {$TABLE_PREFIX}stream WHERE genre1='".sql_esc($_GET['genre'])."' OR genre2='".sql_esc($_GET['genre'])."' OR genre3='".sql_esc($_GET['genre'])."' OR genre4='".sql_esc($_GET['genre'])."' GROUP BY imdb {$limit}");
		print $pagertop;
		}
		$pagetitle = "> SortBy > Genre > {$_GET['genre']}";
	}else{
		$query = $default_query;
		$pagetitle = "> Latest";
		}
// sort genre
}else if ($_GET['sortby'] == 'alpha'){
	// sort alpabetical
	$pagetitle = "> SortBy > Alphabetical";
print "| <a href=\"{$link_alpha}&alpha=a\">A</a> | <a href=\"{$link_alpha}&alpha=b\">B</a> | <a href=\"{$link_alpha}&alpha=c\">C</a> | <a href=\"{$link_alpha}&alpha=d\">D</a> | <a href=\"{$link_alpha}&alpha=e\">E</a> | <a href=\"{$link_alpha}&alpha=f\">F</a> | <a href=\"{$link_alpha}&alpha=g\">G</a> | <a href=\"{$link_alpha}&alpha=h\">H</a> | <a href=\"{$link_alpha}&alpha=i\">I</a> | <a href=\"{$link_alpha}&alpha=j\">J</a> | <a href=\"{$link_alpha}&alpha=k\">K</a> | <a href=\"{$link_alpha}&alpha=l\">L</a> | <a href=\"{$link_alpha}&alpha=m\">M</a> | <a href=\"{$link_alpha}&alpha=n\">N</a> | <a href=\"{$link_alpha}&alpha=o\">O</a> | <a href=\"{$link_alpha}&alpha=p\">P</a> | <a href=\"{$link_alpha}&alpha=q\">Q</a> | <a href=\"{$link_alpha}&alpha=r\">R</a> | <a href=\"{$link_alpha}&alpha=s\">S</a> | <a href=\"{$link_alpha}&alpha=t\">T</a> | <a href=\"{$link_alpha}&alpha=u\">U</a> | <a href=\"{$link_alpha}&alpha=v\">V</a> | <a href=\"{$link_alpha}&alpha=w\">W</a> | <a href=\"{$link_alpha}&alpha=x\">X</a> | <a href=\"{$link_alpha}&alpha=y\">Y</a> | <a href=\"{$link_alpha}&alpha=z\">Z</a> |";
	if ($_GET['sortby'] == 'alpha' && isset($_GET['alpha'])){
		$count = sql_num_rows(do_sqlquery("SELECT imdb FROM {$TABLE_PREFIX}stream WHERE title LIKE '".sql_esc($_GET['alpha'])."%' GROUP BY imdb ORDER BY title"));
		list($pagertop, $pagerbottom, $limit) = pager($titles_page, $count,  "{$link_alpha}&alpha={$_GET['alpha']}&");
		$query = do_sqlquery("SELECT imdb FROM {$TABLE_PREFIX}stream WHERE title LIKE '".sql_esc($_GET['alpha'])."%' GROUP BY imdb ORDER BY title {$limit}");
		print $pagertop;
		$pagetitle = "> SortBy > Alphabetical > {$_GET['alpha']}";
	}else{
		$query = $default_query;
		$pagetitle = "> Latest";
		}
}else if($_GET['sortby'] == 'search'){

	$pagetitle = "> SortBy > Search";

	if($_GET['sortby'] == 'search' && isset($_POST['searching']) && $_POST['searching'] != '' && $_POST['searching'] != ' '){
	$searchparam = $_POST['searching'];
	$searchparam = str_replace(' ','%',$searchparam);
	$count = sql_num_rows(do_sqlquery("SELECT imdb FROM {$TABLE_PREFIX}stream WHERE title LIKE '%".sql_esc($searchparam)."%' GROUP BY imdb ORDER BY title"));
	if($count>0){
	$query = do_sqlquery("SELECT imdb FROM {$TABLE_PREFIX}stream WHERE title LIKE '%".sql_esc($searchparam)."%' GROUP BY imdb ORDER BY title");
	}else{
		$query = $default_query;
		$pagetitle = "> Latest";
		print "<script type='text/javascript'>alert('There are no matching results');</script>";
	}
	}else{
		$query = $default_query;
		$pagetitle = "> Latest";
		print "<script type='text/javascript'>alert('Returning to sort by Latest');</script>";
	}

}else{
	$query = $default_query;
	$pagetitle = "> Latest";
}

print "<br /><br /><br /></div>";



print "<div align=\"center\" style=\"width: 100%; margin: 0 auto;\">";
// adult exeptions
if (isset($_GET['genre']) && $_GET['genre'] == 'Adult'){
// special adult display
while($res = $pornquery->fetch_array()){
showporn($res['pornid']);
}
}else{
while($res = $query->fetch_array()){
showmovie($res['imdb']);
}
}
print $pagerbottom;
print "</div>";

print "<div align=\"center\" style=\"width: 100%; margin: 0;\">";
print "Disclaimer<br /><br /><br /><br /><br /><br />";
print "<div align=\"center\" style=\"width: 100%; margin: 0;\">";
print "BluFLIX is not a paid service. This is a non profit perk, with content shared by the sites members. The managment of this site takes no responsibility for the distribution of any of the content. By using BluFLIX and/or using this website, it is assumed that you, as the user, have read, understood, and agreed to all the terms and conditions set forth by the site's owner. BluFLIX is provided  as a bonus for VIP. It is assumed that you have the relevant authority to view... ie your own a copy of the film in question... it is your responsibility to adhere to there terms.<br /><br /><br /><br /><br /><br />";

$module_name = "BluFLIX {$pagetitle}";

}else{
	print "BluFLIX is currently disabled";
}
$module_out=ob_get_contents();
ob_end_clean();
?>
