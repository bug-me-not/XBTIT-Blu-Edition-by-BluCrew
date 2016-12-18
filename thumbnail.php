<?php
function thumb($filename,$x,$y=0)
{
$t=getimagesize($filename) or die('Illegal type');
$with=$t[0];
$height=$t[1];
switch ($t[2])
{
case 1:
$type='GIF';
$img=imagecreatefromgif($filename);
break;
case 2:
$type='JPEG';
$img=imagecreatefromjpeg($filename);
break;
case 3:
$type='PNG';
$img=imagecreatefrompng($filename);
break;
}
if($y==0)
{$y=$x*($height/$with);}

header("Content-type: image/jpeg");
$thumb=imagecreatetruecolor($x,$y);
ImageCopyResampled($thumb, $img, 0, 0, 0, 0,$x,$y,$with,$height);
$thumb=imagejpeg($thumb);
return $thumb;
}
$file=urldecode($_GET["path"]);
$size=(int)$_GET["size"];
if($file)
{
echo thumb($file,$size);
}
?>