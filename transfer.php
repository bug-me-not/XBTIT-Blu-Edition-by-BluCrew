<?php
ignore_user_abort(true);
set_time_limit(0);
require"include/functions.php";
dbconn();
global $btit_settings, $CURUSER;
if($CURUSER["admin_access"]=="yes")
{
spl_autoload_unregister('Autoloader_XBTITFM');
include('sendto/Net/SFTP.php');
$server=isset($_GET["CBT_SFTP_SERV"])?htmlentities($_GET["CBT_SFTP_SERV"],ENT_QUOTES,"UTF-8"):$server='';
$port=isset($_GET["CBT_SFTP_PORT"])?intval(0+$_GET["CBT_SFTP_PORT"]):$port='';
$user=isset($_GET["CBT_SFTP_USER"])?htmlentities($_GET["CBT_SFTP_USER"],ENT_QUOTES,"UTF-8"):$user='';
$pass=isset($_GET["CBT_SFTP_PASS"])?htmlentities($_GET["CBT_SFTP_PASS"],ENT_QUOTES,"UTF-8"):$pass='';
$thefile=isset($_GET["CBT_FILE_GO"])?htmlentities($_GET["CBT_FILE_GO"],ENT_QUOTES,"UTF-8"):$thefile='';
if($server!='' && $pass!='' && $user!='' && $pass!='' && $thefile!='' && $port!='')
{
$sftp = new Net_SFTP($server,$port,30);
if (!$sftp->login($user, $pass)) {
    stderr($language["ERROR"],'Login Failed!');
}
$sftp->put($thefile, $btit_settings["CBT_FILE_BACKUP_DIR"].$thefile, NET_SFTP_LOCAL_FILE);
}
exit("complete");
}
?>