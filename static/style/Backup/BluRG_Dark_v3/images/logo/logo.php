<?
$dh = opendir(".");
while (false !== ($file = readdir($dh)))
{
  if (preg_match('/\.png$/i', $file) and $file != "logo.png")
  {
     $filelist[] = $file;
  }
}

srand((double)microtime()*1000000);
$picnum = rand(0, sizeof($filelist) - 1);

header("Location: " . $filelist[$picnum]);

closedir($dh);
?>