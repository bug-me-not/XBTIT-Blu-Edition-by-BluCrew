<?php
ob_start();
// Prevent non logged users access
if ($CURUSER['uid'] == 1 || !$CURUSER['uid'])
stderr("Error", "You must be logged in to view this page");

if ($btit_settings["fmhack_bluflix"] == 'enabled'){

	// add sream to db and inform user or url etc

	if ($CURUSER['admin_access'] == 'yes'){

		if (isset($_GET['addstream']) && $_GET['addstream'] == 1){
			$query = "SELECT * FROM {$TABLE_PREFIX}stream WHERE imdb = {$_POST['imdb']} AND res = {$_POST['quality']} AND codec = '{$_POST['codec']}' AND ext = '{$_POST['ext']}'";
			$rows = sql_num_rows(do_sqlquery($query));
			if ($rows > 0)
			stderr("Stream Exists","A stream for that quality already exists");

			$salt = md5($_POST['title'].$_POST['codec'].date().$_POST['imdb'].$_POST['title'].time());
			require_once ("imdb/imdb.class.php");
			$movie = new imdb($_POST['imdb']);
			$genre1 = $movie->genres()[0];
			$genre2 = $movie->genres()[1];
			$genre3 = $movie->genres()[2];
			$genre4 = $movie->genres()[3];

			quickQuery("INSERT INTO {$TABLE_PREFIX}stream (title, year, imdb, server, ext, codec, res, user, salt, genre1, genre2, genre3, genre4) VALUES ('{$_POST['title']}', '{$_POST['year']}', '{$_POST['imdb']}', '{$_POST['server']}', '{$_POST['ext']}', '{$_POST['codec']}', '{$_POST['quality']}', '{$CURUSER['uid']}', '{$salt}', '{$genre1}', '{$genre2}', '{$genre3}', '{$genre4}')");
			switch ($_POST['quality']) {
				case 1:
				$quality = "480p";
				break;
				case 2:
				$quality = "720p";
				break;
				case 3:
				$quality = "1080p";
				break;
				case 4:
				$quality = "2k";
				break;
				case 5:
				$quality = "4k";
				break;
			}

			global $BASEURL;
			system_shout("[color=red]NEW Stream[/color]: [url=$BASEURL/index.php?page=modules&module=video_player&id=".sql_esc($_POST['imdb'])."]".sql_esc($_POST['title'])." (".sql_esc($_POST['year']).") - ".$quality."[/url]");

			$query = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}stream_servers WHERE sid = {$_POST['server']}");
			$server = $query->fetch_array();


			$filename = $_POST['title'].".".$_POST['year'].".".$quality.".".$_POST['codec'].".".$salt.".".$_POST['ext'];
			$len = strlen($filename);
			stderr("Stream Added","Your stream has been added to the database please upload the file to server<br /><br/><b>{$server['server_url']}<br /><br /><form>
			<input type=\"filename\" value=\"{$filename}\" size=\"{$len}\">
			</form></b><br /><br /><a href=\"index.php?page=modules&module=video_player&id={$_POST['imdb']}\">View upload {$_POST['title']}</a>");
		}

	}

	// get video id if given and if user is above vip otherwise get preview
	if (isset($_GET['id']) && $CURUSER['can_stream'] == 'yes')
	$vid_id = $_GET['id'];
	else
	$vid_id = 1;

	// get video details
	if ($CURUSER['pref1080'] == 'yes')
		$max_quality = 3;
	else
		$max_quality = 2;

	$query = "SELECT * FROM {$TABLE_PREFIX}stream, {$TABLE_PREFIX}stream_servers WHERE imdb = {$vid_id} AND server = sid ORDER BY res DESC LIMIT 1";
	$noresult = "";
	$rows = sql_num_rows(do_sqlquery($query));
	if ($rows == 0){
	$vid_id = 1;
		$query = "SELECT * FROM {$TABLE_PREFIX}stream, {$TABLE_PREFIX}stream_servers WHERE imdb = {$vid_id} AND server = sid ORDER BY res DESC LIMIT 1";
		$noresult = "The stream you selected is not available at your maximum quality settings (720p)<br />you may change your maximum quality setting in your user profile the 1080p version will play instead";
		}else{
	$query = "SELECT * FROM {$TABLE_PREFIX}stream, {$TABLE_PREFIX}stream_servers WHERE imdb = {$vid_id} AND server = sid ORDER BY res DESC LIMIT 1";
		}

	$vid = do_sqlquery($query)->fetch_assoc();

	// Set title
	$views = "";
	if ($CURUSER['admin_access'] == 'yes'){
		if ($vid['views'] == 1)
		$s = "";
		else
		$s ="s";
		$views = " (Viewed ".$vid['views']." Time".$s.")";
	}
	$title = preg_replace('/\./', ' ', $vid['title'], -1);

	// Pick quality
	switch ($vid['res']) {
		case 1:
		$quality = "480p";
		break;
		case 2:
		$quality = "720p";
		break;
		case 3:
		$quality = "1080p";
		break;
		case 4:
		$quality = "2k";
		break;
		case 5:
		$quality = "4k";
		break;
	}

	// Pick mime tyye
	switch ($vid['ext']) {
		case "mp4":
		$type = "video/mp4";
		break;
		case "mkv":
		$type = "video/x-matroska";
		break;
		case "webm":
		$type = "video/webm";
		break;
	}

	// video file to play
	$file = $vid['server_url']."/".$vid['title'].".".$vid['year'].".".$quality.".".$vid['codec'].".".$vid['salt'].".".$vid['ext'];

	// update view count and add viewer
	$query = "UPDATE {$TABLE_PREFIX}stream SET views=views+1 WHERE id={$vid['id']}";
	quickQuery($query);
	$query = "INSERT INTO {$TABLE_PREFIX}stream_users (userid,streamid) VALUES ({$CURUSER['uid']}, {$vid_id})";
	quickQuery($query);

	// image placeholder
	$imag = "modules/video_player/bluflix.png";
	$preroll = "modules/video_player/preroll.mp4";

	// web player
	$player = "<video id=\"web-player\" class=\"video-js vjs-default-skin\" controls
	preload=\"auto\" autoplay=\"true\" width=\"640\" height=\"360\" poster=\"{$imag}\"
	oncontextmenu=\"return false;\"
	data-setup=\"{}\">
		<source src=\"{$file}\" type='{$type}'>
		<p class=\"vjs-no-js\">To view this video please enable JavaScript, and consider upgrading to a web browser that supports HTML5 video</p>
		</video>
		";

		print "<div align = \"center\"><a href=\"index.php?page=torrents&search={$_GET['id']}&category=0&uploader=0&options=3&active=0&gold=0\">Click Here</a> to view all torrents that match this title<br /><br />{$noresult}
		".$player."
		<br /><br /><a href=\"javascript:history.back();\">[Go Back]</a></div>";

		$module_name = "Now Playing - ".$title." (".$vid['year'].") ".$quality." ".$vid['codec'].$views;}else{	print "BluFLIX is currently disabled";
		}
		$module_out=ob_get_contents();
		ob_end_clean();
		?>
