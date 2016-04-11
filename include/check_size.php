<?php 
include_once('../sendto/Net/SFTP.php');
$server=isset($_GET["CBT_SFTP_SERV"])?htmlentities($_GET["CBT_SFTP_SERV"],ENT_QUOTES,"UTF-8"):$server='';
$port=isset($_GET["CBT_SFTP_PORT"])?intval(0+$_GET["CBT_SFTP_PORT"]):$port='';
$user=isset($_GET["CBT_SFTP_USER"])?htmlentities($_GET["CBT_SFTP_USER"],ENT_QUOTES,"UTF-8"):$user='';
$pass=isset($_GET["CBT_SFTP_PASS"])?htmlentities($_GET["CBT_SFTP_PASS"],ENT_QUOTES,"UTF-8"):$pass='';
$thefile=isset($_GET["CBT_FILE_GO"])?htmlentities($_GET["CBT_FILE_GO"],ENT_QUOTES,"UTF-8"):$thefile='';
$path=isset($_GET["bupath"])?htmlentities($_GET["bupath"],ENT_QUOTES,"UTF-8"):$path='';
if($server!='' && $pass!='' && $user!='' && $pass!='' && $thefile!='' && $port!='' && $path!='')
{
$sftp = new Net_SFTP($server,$port,30);
if (!$sftp->login($user, $pass)) {
    die('Login Failed!');
}
$stats["fsize"]=$sftp->exec("du -b $thefile | cut -f1");
$stats["fsize"]=str_replace("\n","",$stats["fsize"]);
$stats["size"]=filesize("../".$path."".$thefile."");
echo json_encode($stats);
}else{
die("issue!");
}
?>