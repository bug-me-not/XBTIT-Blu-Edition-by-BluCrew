<?php
$dh = opendir(".");
while (false !== ($file = readdir($dh)))
{
  if (preg_match('/\.jpg$/i', $file) and $file != "shout.jpg")
  {
     $filelist[] = $file;
  }
}

srand((double)microtime()*1000000);
$picnum = rand(0, sizeof($filelist) - 1);

header("Location: " . $filelist[$picnum]);

closedir($dh);
?>