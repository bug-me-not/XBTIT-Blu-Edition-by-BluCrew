<?php
/////////////////////////////////////////////////////////////////////////////////////
// 
//   SeedHelp Module 
//	 Originally developed by Spidi 
//   Coverted by HDVinnie for xbtitFM v1.1 by BluCrew
//
////////////////////////////////////////////////////////////////////////////////////

ob_start();

// Grab the Necessary Info from the DB
$seedhelp = do_sqlquery("SELECT `f`.`info_hash`, `f`.`filename`, `f`.`size`,`u`.`username`,`h`.`seed`, `f`.`seeds`, `f`.`leechers`, `h`.`uploaded` FROM {$TABLE_PREFIX}files `f` LEFT JOIN {$TABLE_PREFIX}users `u` ON `u`.`id`=`f`.`uploader` LEFT JOIN {$TABLE_PREFIX}history `h` ON `h`.`infohash`=`f`.`info_hash` WHERE (`f`.`uploader`={$CURUSER['uid']} OR `h`.`uid`={$CURUSER['uid']}) AND `f`.`seeds`=0 AND `f`.`leechers`>=1 AND `h`.`completed`='yes' AND `h`.`active`='no' GROUP BY `f`.`info_hash`");
?>

<br />
<div class="panel panel-danger">
<div class="panel-heading">
<div align="center">
<h2>Below is a list of torrents that you have uploaded or previously downloaded that could use another seeder</h2>
</div>
</div>
</div>
<table class="table table-bordered">
	<?php
	if ($seedhelp && sql_num_rows($seedhelp)>0) 
	{
		echo "<tr>";
		echo "<td class=lista align=center width='200' style='font-size:12px'><b>Filename</b></td>";
		echo "<td class=lista align=center width='50' style='font-size:12px'><b>Size</b></td>";
		echo "<td class=lista align=center width='50' style='font-size:12px'><b>Uploaded</b></td>";
		echo "<td class=lista align=center width='50' style='font-size:12px'><b>Seeding Time</b></td>";
		echo "<td class=lista align=center width='50' style='font-size:12px'><b>Seeders</b></td>";
		echo "<td class=lista align=center width='50' style='font-size:12px'><b>Leechers</b></td>";
		echo "</tr>";
		while($seedres = $seedhelp->fetch_assoc()) 
		{
			echo "<tr>";
			echo "<td class=lista align=center><a href='index.php?page=torrent-details&id={$seedres['info_hash']}'>{$seedres['filename']}</td>";
			echo "<td class=lista align=center>" . makesize($seedres['size']) . "</td>";
			echo "<td class=lista align=center>" . makesize($seedres['uploaded']) . "</td>";
			echo "<td class=lista align=center>" . NewDateFormat($seedres['seed']) . "</td>";
			echo "<td class=lista align=center>{$seedres['seeds']}</td>";
			echo "<td class=lista align=center>{$seedres['leechers']}</td>";
			echo "</tr>";
		}
	}
	else
	{
		echo "<tr>";
		echo "<td align=center><b>No help needed on any torrents</b></td>";
		echo "</tr>";
	}
	?>
</table>
<br /><br />

<?php
$module_out=ob_get_contents();
ob_end_clean();
?>