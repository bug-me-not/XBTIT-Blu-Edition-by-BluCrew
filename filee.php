<?php
require"include/functions.php";
dbconn();
global $SITENAME,$language,$btit_settings,$CURUSER;
if($CURUSER["admin_access"]=="yes")
$filess = $SITENAME.'_' . date("d.m.Y_H:i:s") . '_files';

set_time_limit(0);

#files
if($_GET["go"]==1)
{
// Generate the filename for the backup file
unlink("./backup_tmp/filename_tmp");
unlink("./backup_tmp/size_tmp");

if(file_put_contents("./backup_tmp/filename_tmp",'/tmp/'.$filess.'.tar', FILE_APPEND | LOCK_EX))
redirect("filee.php?go=2");
}
else
if($_GET["go"]==2)
{
require_once(dirname(__FILE__).'/include/TAR.php');
if (file_exists("./backup_tmp/filename_tmp"))
	$filess=file_get_contents("./backup_tmp/filename_tmp");
$obj = new Archive_Tar($filess);
$path = dirname(__FILE__);
$path_list=pathinfo($btit_settings["CBT_FILE_BACKUP_DIR"]);
if ($handle = opendir($path)) {
 $ignore = array( ''.$path_list["dirname"].'', '.', '..','._' );
 $i=0;
 $files=array();
 while (false !== ($file = readdir($handle))) {
   if (!in_array($file,$ignore) and substr($file, 0, 1) != '.') {
   $files[]=$file;
   $i++;
  }
  if ($i==10) {
	$obj->add($files);
	$files=array();
	$i=0;
	}
 }
 closedir($handle);
}



if ($obj->add($files))
{
unlink("./backup_tmp/filename_tmp");
unlink("./backup_tmp/size_tmp");
rename($filess, ''.$btit_settings["CBT_FILE_BACKUP_DIR"].''.str_replace('/tmp','',$filess));
exit();
}
else
{
unlink("./backup_tmp/filename_tmp");
unlink("./backup_tmp/size_tmp");
stderr($language["ERROR"],"A problem occured!");
}
}
?>