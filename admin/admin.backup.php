<?php
if (!defined("IN_BTIT"))
      die("non direct access!");
if (!defined("IN_ACP"))
      die("non direct access!");

$action=isset($_GET["action"])?htmlentities($_GET["action"],ENT_QUOTES,"UTF-8"):$action='';
$admintpl->set("go",(($action == "NoW")?true:false), true);
$admintpl->set("conf",(($action == "conf")?true:false), true);
$admintpl->set("sftp",(($action == "export")?true:false), true);
$admintpl->set("lang",$language);
$admintpl->set("set.CBT_FILE_FROM",isset($_GET["file2send"])?htmlentities($_GET["file2send"],ENT_QUOTES,"UTF-8"):"");
if($action=="export_now" && $_SERVER["REQUEST_METHOD"]=="POST")
{

}
elseif($action=="export")
{
$admintpl->set("frmsf","index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=backup&action=export_now");
$admintpl->set("bupath",$btit_settings["CBT_FILE_BACKUP_DIR"]);
$admintpl->set("redir","index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=backup");
}
elseif($action=="conf")
{
$admintpl->set("set.CBT_FILE_BACKUP_DIR",$btit_settings["CBT_FILE_BACKUP_DIR"]);
$admintpl->set("frm","index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=backup&action=conf_set");
}
elseif($action=="conf_set")
{
if($_SERVER["REQUEST_METHOD"]=="POST")
{
$set=isset($_POST["CBT_FILE"])?sqlesc(htmlentities($_POST["CBT_FILE"],ENT_QUOTES,"UTF-8")):$set='';
if($set!='')
quickQuery("UPDATE {$TABLE_PREFIX}settings SET `value`='".$set."' WHERE `key`='CBT_FILE_BACKUP_DIR'",true);
    foreach (glob($THIS_BASEPATH."/cache/*.txt") as $filename)
        unlink($filename);
redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=backup&action=conf");
}
}
elseif($action=="delete")
{
$file=isset($_GET["file"])?htmlentities($_GET["file"],ENT_QUOTES,"UTF-8"):$file='';
if(file_exists("".$btit_settings["CBT_FILE_BACKUP_DIR"]."".$file.".tar"))
{
@unlink("".$btit_settings["CBT_FILE_BACKUP_DIR"]."".$file.".tar");
}
redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=backup");
}
elseif($action=="NoW"){
$admintpl->set("redir","index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=backup");
$admintpl->set("bk","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=backup&amp;action=NoW#progress");
}else{
if (is_writable($btit_settings["CBT_FILE_BACKUP_DIR"]))
{
$dir = opendir ($btit_settings["CBT_FILE_BACKUP_DIR"]);
	    $Files=array();
	    $F=0; 
while (false !== ($file = readdir($dir))) { 

	// Print the filenames that have .tar extension
	if (strpos($file,'.tar',1)) { 

	// Get time and date from filename
	$date = substr($file, 9, 10);
	$time = substr($file, 20, 8);

	// Remove the sql extension part in the filename
	$filename = str_replace('.tar', '', $file);
                     

		$Files[$F]["name"]=($filename . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $date . " - " . $time . "");
		$Files[$F]["zip"]="<a href='".$btit_settings["CBT_FILE_BACKUP_DIR"]."" . $filename . ".tar' class='view'>".$language["DOWNLOAD"]."</a>";
		$Files[$F]["delete"]="<a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=backup&action=delete&file=" . $filename . "' class='delete'>".$language["DELETE"]."</a></td>";
		$Files[$F]["send"]="<a href='index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=backup&action=export&file2send=" . $filename . ".tar' class='delete'>".$language["ACP_BUINFO_S"]."</a></td>";
		$F++;
	} 
}
}
if (is_writable($btit_settings["CBT_FILE_BACKUP_DIR"])) {

} else {
    $admintpl->set('alert','<span style="color:red;">The folder <b>'.$btit_settings["CBT_FILE_BACKUP_DIR"].'</b> is not writable!</span><br />');
}
if (is_writable("backup_tmp")) {

} else {
    $admintpl->set('alert2','<span style="color:red;">The folder <b>backup_tmp</b> is not writable!</span><br />');
}    
$admintpl->set("file",$Files);
$admintpl->set("bk","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=backup&amp;action=NoW#progress");
$admintpl->set("s2","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=backup&amp;action=export");
$admintpl->set("cf","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=backup&amp;action=conf");
}
?>