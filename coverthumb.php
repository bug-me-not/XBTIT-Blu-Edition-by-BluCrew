<?php
 
$sImagePath = $_GET["file"];
 
$iThumbnailWidth = (int)$_GET['width'];
$iThumbnailHeight = (int)$_GET['height'];
$iMaxWidth = (int)$_GET["maxw"];
$iMaxHeight = (int)$_GET["maxh"];
 
if ($iMaxWidth && $iMaxHeight) $sType = 'scale';
else if ($iThumbnailWidth && $iThumbnailHeight) $sType = 'exact';
 
$img = NULL;
 
$sExtension = strtolower(end(explode('.', $sImagePath)));
if ($sExtension == 'jpg' || $sExtension == 'jpeg') {
 
    $img = @imagecreatefromjpeg($sImagePath)
        or die("Cannot create new JPEG image");
 
} else if ($sExtension == 'png') {
 
    $img = @imagecreatefrompng($sImagePath)
        or die("Cannot create new PNG image");
 
} else if ($sExtension == 'gif') {
 
    $img = @imagecreatefromgif($sImagePath)
        or die("Cannot create new GIF image");
 
}
 
if ($img) {
 
    $iOrigWidth = imagesx($img);
    $iOrigHeight = imagesy($img);
 
    if ($sType == 'scale') {
 
        // Get scale ratio
 
        $fScale = min($iMaxWidth/$iOrigWidth,
              $iMaxHeight/$iOrigHeight);
 
        if ($fScale < 1) {
 
            $iNewWidth = floor($fScale*$iOrigWidth);
            $iNewHeight = floor($fScale*$iOrigHeight);
 
            $tmpimg = imagecreatetruecolor($iNewWidth,
                               $iNewHeight);
 
            imagecopyresampled($tmpimg, $img, 0, 0, 0, 0,
            $iNewWidth, $iNewHeight, $iOrigWidth, $iOrigHeight);
 
            imagedestroy($img);
            $img = $tmpimg;
        }     
 
    } else if ($sType == "exact") {
 
        $fScale = max($iThumbnailWidth/$iOrigWidth,
              $iThumbnailHeight/$iOrigHeight);
 
        if ($fScale < 1) {
 
            $iNewWidth = floor($fScale*$iOrigWidth);
            $iNewHeight = floor($fScale*$iOrigHeight);
 
            $tmpimg = imagecreatetruecolor($iNewWidth,
                            $iNewHeight);
            $tmp2img = imagecreatetruecolor($iThumbnailWidth,
                            $iThumbnailHeight);
 
            imagecopyresampled($tmpimg, $img, 0, 0, 0, 0,
            $iNewWidth, $iNewHeight, $iOrigWidth, $iOrigHeight);
 
            if ($iNewWidth == $iThumbnailWidth) {
 
                $yAxis = ($iNewHeight/2)-
                    ($iThumbnailHeight/2);
                $xAxis = 0;
 
            } else if ($iNewHeight == $iThumbnailHeight)  {
 
                $yAxis = 0;
                $xAxis = ($iNewWidth/2)-
                    ($iThumbnailWidth/2);
 
            } 
 
            imagecopyresampled($tmp2img, $tmpimg, 0, 0,
                       $xAxis, $yAxis,
                       $iThumbnailWidth,
                       $iThumbnailHeight,
                       $iThumbnailWidth,
                       $iThumbnailHeight);
 
            imagedestroy($img);
            imagedestroy($tmpimg);
            $img = $tmp2img;
        }    
 
    }
 
    header("Content-type: image/jpeg");
    imagejpeg($img);
 
}
 
?>