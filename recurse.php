<?php

$path = ".";
function filesize_r($path){
  if(!file_exists($path)) return 0;
  if(is_file($path)) return filesize($path);
  $ret = 0;
  foreach(glob($path."/*") as $fn)
if(!fnmatch('*_files.tar', $fn))
    $ret += filesize_r($fn);
  return $ret;
}

if(!file_exists("./backup_tmp/size_tmp"))
{
$size=filesize_r($path);
file_put_contents("./backup_tmp/size_tmp",$size, FILE_APPEND | LOCK_EX);
}
if(file_exists("./backup_tmp/size_tmp") && file_exists("./backup_tmp/filename_tmp"))
{
$folder_size=file_get_contents("./backup_tmp/size_tmp");
$file=file_get_contents("./backup_tmp/filename_tmp");
$file_size=filesize($file); //.".tar");
$status["size"]=$folder_size;
$status["fsize"]=$file_size;
echo json_encode($status);
}
?>