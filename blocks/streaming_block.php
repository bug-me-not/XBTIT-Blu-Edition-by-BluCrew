<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">BluFLIX Checks</h4>
</div>
<?php
global $CURUSER,$btit_settings;
if (!$CURUSER || $CURUSER["id_level"]<6)
   {
    // do nothing
   }
else
    {
		if ($btit_settings["fmhack_bluflix"] == 'enabled'){
print("<TABLE width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">");       
// tm     
// add stream
print("<tr><td class=\"header\" align=\"left\"><a href=\"imdb/index.html\"><span style=\"float:left; padding-left:3px;\"></span><span style=\"float:left; padding-right:5px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Stream</span></a> <span style=\"float:right; padding-right:5px;\"><font color=\"green\"><b></font></span> </td></tr>\n");


// no imdb
$countnoimdbt=get_result("SELECT * FROM {$TABLE_PREFIX}files WHERE imdb='' AND imdb_ignore='no'");
$countnoimdb=count($countnoimdbt);

if ($countnoimdb==0)
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=torrents\"><span style=\"float:left; padding-left:3px;\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No IMDB</a><span style=\"float:right; padding-right:5px;\"><font color=\"green\">[ - ]<font></span></td></tr>\n");
else
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php?page=torrents\"><span style=\"float:left; padding-left:3px;\"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No IMDB</a><span style=\"float:right; padding-right:5px;\"><font color=\"red\">[ $countnoimdb ]<font></span></td></tr>\n");


//Available Movies
$resstrm=get_result("SELECT * FROM {$TABLE_PREFIX}stream GROUP BY imdb");
$strmc=count($resstrm);
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php\"><span style=\"float:left; padding-left:3px;\"></span><span style=\"float:left; padding-right:5px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Avail Movies</span></a> <span style=\"float:right; padding-right:5px;\"><font color=\"green\"><b>[ $strmc ]</font></span> </td></tr>\n");

//Available Movies 720p
$resstrm=get_result("SELECT * FROM {$TABLE_PREFIX}stream WHERE res = 2 GROUP BY imdb");
$strmc=count($resstrm);
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php\"><span style=\"float:left; padding-left:3px;\"></span><span style=\"float:left; padding-right:5px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Avail Movies (720p)</span></a> <span style=\"float:right; padding-right:5px;\"><font color=\"green\"><b>[ $strmc ]</font></span> </td></tr>\n");

//Available Movies 1080p
$resstrm=get_result("SELECT * FROM {$TABLE_PREFIX}stream WHERE res = 3 GROUP BY imdb");
$strmc=count($resstrm);
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php\"><span style=\"float:left; padding-left:3px;\"></span><span style=\"float:left; padding-right:5px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Avail Movies (1080p)</span></a> <span style=\"float:right; padding-right:5px;\"><font color=\"green\"><b>[ $strmc ]</font></span> </td></tr>\n");


// To Encode
$restostrm=get_result("SELECT f.filename FROM {$TABLE_PREFIX}files f WHERE imdb NOT IN (SELECT imdb FROM {$TABLE_PREFIX}stream) AND f.imdb > 1 GROUP BY f.imdb ORDER  BY f.filename ASC");
$tostrmc=count($restostrm);
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php\"><span style=\"float:left; padding-left:3px;\"></span><span style=\"float:left; padding-right:5px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To Encode</span></a> <span style=\"float:right; padding-right:5px;\"><font color=\"green\"><b>[ $tostrmc ]</font></span> </td></tr>\n");

//Streamed to date
$resstrm=get_result("SELECT * FROM {$TABLE_PREFIX}stream_users WHERE streamid > 1");
$strmc=count($resstrm);
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php\"><span style=\"float:left; padding-left:3px;\"></span><span style=\"float:left; padding-right:5px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Streamed to Date</span></a> <span style=\"float:right; padding-right:5px;\"><font color=\"green\"><b>[ $strmc ]</font></span> </td></tr>\n");

//Unique users
$resstrm=get_result("SELECT * FROM {$TABLE_PREFIX}stream_users WHERE streamid > 1 GROUP BY userid");
$strmc=count($resstrm);
print("<tr><td class=\"header\" align=\"left\"><a href=\"index.php\"><span style=\"float:left; padding-left:3px;\"></span><span style=\"float:left; padding-right:5px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unique Users</span></a> <span style=\"float:right; padding-right:5px;\"><font color=\"green\"><b>[ $strmc ]</font></span> </td></tr>\n");


print("</TABLE>"); 

	
	}else{
		print "Bluflix<br />disabled";
//end
}
}
?>
<div class="panel-footer">
</div>
</div>
