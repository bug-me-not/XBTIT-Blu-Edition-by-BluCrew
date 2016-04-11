<?php

// ipb_import.php language file
global $TABLE_PREFIX, $ipb_prefix;

$lang[0]='Yes';
$lang[1]='No';
$lang[2]='<center><u><strong><font size="4" face="Arial">Stage 1: Initial Requirements</font></strong></u></center><br />';
$lang[3]='<center><strong><font size="2" face="Arial">IPB files present in the "ipb" folder?<font color="';
$lang[4]='">&nbsp;&nbsp;&nbsp; ';
$lang[5]='</font></center></strong>';
$lang[6]='<br /><center>Please <a target="_new" href="http://www.invisionpower.com/">download IPB</a> and upload the contents of the "upload" folder in the archive to the "ipb" folder.<br />If you don&rsquo;t have an "ipb" folder please create one in your tracker root and upload<br />the contents of  the "upload" folder to it.<br /><br />Once uploaded p'; // p at end is a lowercase p for use with $lang[8]
$lang[7]='<br /><center>P'; // P at end is an uppercase p for use with $lang[8]
$lang[8]='lease install IPB by <a target="_new" href="ipb/admin/install/index.php">clicking here</a>*<br /><br /><strong>* Please use the same database login details as those used for your tracker,<br />you can use any database prefix you want (excluding the prefix used by the<br />tracker where applicable)<br /><br />';
$lang[9]='<font color="#0000FF" size="3">You may refresh this page once you have completed the required task!</font></strong></center>';
$lang[10]='<center><strong>IPB installed?<font color="';
$lang[11]='File not found!';
$lang[12]='File found but not writable!';
$lang[13]='<center><strong>Default IPB English Errors file available and writable?<font color="';
$lang[14]='<center><strong>ipb.sql file present in the "sql" folder?<font color="';
$lang[15]='<br /><center><strong>Language file (';
$lang[16]=')<br />is missing, please ensure <font color="#FF0000"><u>all IPB files</u></font> were uploaded!<br /><br />';
$lang[17]=')<br />is not writable, <font color="#FF0000"><u>please CHMOD this file to 777</u></font><br /><br />';
$lang[18]='<br /><center><strong>ipb.sql is missing, <font color="#FF0000"><u>please ensure this file is present in the "sql" folder.</u></font><br />(It should be included with the xbtitFM distribution!)<br /><br />';
$lang[19]='<br /><center>All requirements have been met, please <a href="';
$lang[20]='">click here to continue</a></center>';
$lang[21]='<center><u><strong><font size="4" face="Arial">Stage 2: Initial Setup</font></strong></u></center><br />';
$lang[22]='<center>Now that we&rsquo;ve verified everything is in place it&rsquo;s time to modify the database<br />to bring everything in line with the tracker.</center><br />';
$lang[23]='<center><form name="db_pwd" action="'.$_SERVER['PHP_SELF'].'" method="GET">Enter Database password:&nbsp;<input name="pwd" size="20" /><br /><br /><strong>please click <input type="submit" name="confirm" value="yes" size="20" /> to proceed</strong><input type="hidden" name="act" value="init_setup" /></form></center>';
$lang[24]='<center><u><strong><font size="4" face="Arial">Stage 3: Importing the tracker members</font></strong></u></center><br />';
$lang[25]='<center>Now the database has been setup correctly it&rsquo;s time to start importing the tracker members,<br />This can take some time if you have a large memberbase so please be patient and allow<br />the script to do it&rsquo;s work!<br /><br /><strong>please <a href="'.$_SERVER['PHP_SELF'].'?act=member_import&amp;confirm=yes">click here</a> to proceed</center>';
$lang[26]='<center><u><strong><font size="4" face="Arial">Sorry</font></strong></u></center><br />';
$lang[27]='<center>Sorry, this is meant to be a use once and discard script and since you&rsquo;ve already used it this file has been locked!</center>';
$lang[28]='<center><br /><strong><font color="#FF0000"><br />';
$lang[29]='</strong></font> Forum accounts were successfully created, please <a href="'.$_SERVER['PHP_SELF'].'?act=import_forum&amp;confirm=no">click here</a> to proceed</center>';
$lang[30]='<center><u><strong><font size="4" face="Arial">Stage 4: Importing the forum layout & posts</font></strong></u></center><br />';
$lang[31]='<center>This is the final stage of the forum import, this will import your current BTI Forums into IPB,<br />they will be imported into a new category called "My BTI import",<br />please <a href="'.$_SERVER['PHP_SELF'].'?act=import_forum&amp;confirm=yes">click here</a> to proceed</center>';
$lang[32]='<center><u><strong><font size="4" face="Arial">Import Complete</font></strong></u></center><br />';
$lang[33]='<center><font face="Arial" size="2">Please <a target="_new" href="ipb/index.php?app=core&module=global&section=login">login to your new IPB forum</a> using your Tacker details and goto<br />the <strong>Administration Center</strong> then select <strong>Forum Maintenance</strong> and run<br /><strong>Find and repair any errors.</strong> followed by <strong>Recount all forum totals<br />and statistics.</strong> to tidy up the import and fix the post count etc.<br /><br /><strong><font color="#0000FF">Your integrated IPB Forum should then be ready to use!</font></strong></font></center>';
$lang[34]='<center><u><strong><font size="4" face="Arial" color="#FF0000">ERROR!</font></strong></u></center><br />'."\n".'<br />'."\n".'<center><font face="Arial" size="3">You typed the wrong password or you&rsquo;re not the owner of this tracker!<br />'."\n".'Please note that your IP has been logged.</font></center>';
$lang[35]='';
$lang[36]='<center>Unable to write to:<br /><br /><b>';
$lang[37]='</b><br /><br />Please ensure this file is writable then run this script again.</center>';
$lang[38]='<center><br /><font color="red" size="4"><b>Access Denied</b></font></center>';
$lang[39]='<br /><center><strong>IPB Config file (';
$lang[40]='<center><u><strong><font size="4" face="Arial">Stage 3: Creating the bridge</font></strong></u></center><br />';
$lang[41]='<center>Now the database has been setup correctly it&rsquo;s time to start bridging the tracker members with the ipb members and adjusting everyone&rsquo;s rank to match their tracker rank,<br />This can take some time if you have a large memberbase so please be patient and allow<br />the script to do it&rsquo;s work!<br /><br /><strong>please <a href="'.$_SERVER['PHP_SELF'].'?act=member_bridge&amp;confirm=yes">click here</a> to proceed</center>';
$lang[42]='<center><font face="Arial" size="2">Please <a target="_new" href="ipb/index.php?app=core&module=global&section=login">login to your new IPB forum</a> using your Tracker credentials and goto<br />the <strong>Admin Panel</strong> and setup the category/forum permissions for your ranks,<br />currently only the default category/forum is visible to all.<br /><br /><strong><font color="#0000FF">Your integrated IPB Forum should then be ready to use!</font></strong></font></center>';
$lang[43]="<center>Successfully bridged";
$lang[44]="accounts.<br /><br /></center>";
$lang[45]="<center><b><span style='color:red'>WARNING: There are";
$lang[46]="unbridged tracker accounts and";
$lang[47]="orphaned forum accounts.</span></b><br /><br />You should attempt to fix these manually by comparing the account details in phpMyAdmin.<br />You can use the following queries for this:<br /><br />Tracker:<br /><textarea rows='1' cols='80'>SELECT * FROM `{$TABLE_PREFIX}users` WHERE `ipb_fid`=0 AND `id`>1 ORDER BY `id` ASC;</textarea><br /><br />Forum:<br /><textarea rows='1' cols='80'>SELECT * FROM `{$ipb_prefix}members` WHERE `member_group_id`=0 ORDER BY `id_member` ASC;</textarea><br /><br />Once you have found a match you should update the \"ipb_fid\" field on the tracker account<br />with the contents of the \"id_member\" field on the appropriate forum record.<br /><br />Then update the \"member_group_id\" field on the forum record with the value from the \"id_level\" field on the tracker record.<br /><br />It is then advisable to delete any remaining orphaned IPB accounts by running the following query:<br /><textarea rows='1' cols='80'>DELETE FROM `{$ipb_prefix}members` WHERE `member_group_id`=0;</textarea><br /><br /></center>";
$lang[48]="<center>Successfully imported and bridged";
$lang[49]="<center><b><span style=\"color:#0000FF;\">Your integrated IPB Forum should now be ready to use!</span></b></center>";
?>