<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2007  Btiteam
//
//    This file is part of xbtit.
//
// Redistribution and use in source and binary forms, with or without modification,
// are permitted provided that the following conditions are met:
//
//   1. Redistributions of source code must retain the above copyright notice,
//      this list of conditions and the following disclaimer.
//   2. Redistributions in binary form must reproduce the above copyright notice,
//      this list of conditions and the following disclaimer in the documentation
//      and/or other materials provided with the distribution.
//   3. The name of the author may not be used to endorse or promote products
//      derived from this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
// WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
// MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
// IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
// TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
// PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
// LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
// NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
// EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
////////////////////////////////////////////////////////////////////////////////////
global $CURUSER, $TABLE_PREFIX, $btit_settings,$BASEURL;

$THIS_BASEPATH=dirname(__FILE__);
$USERLANG = $THIS_BASEPATH."/language/english";

require_once('include/functions.php');
if(!$CURUSER || $CURUSER['uid']==1)
{
   redirect($BASEURL);
}
require_once('btemplate/bTemplate.php');
dbconn(true);
include($THIS_BASEPATH.'/index.begin.php');
require($USERLANG."/gallery_lang.php");

if(gallery_in())
{
	$gallery_uploadtpl = new bTemplate();
	$gallery_uploadtpl->set("charset",$charset);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $SITENAME;?></title>
<meta http-equiv="Page-Enter" content="blendTrans(Duration=0.3)" />
<link rel="stylesheet" href="<?php echo $BASEURL;?>/gallery/style/style.css" type="text/css" media="screen" />
	</head>
</html>
<?php
// Configure Start
$serverpath = "gallery/";
$urltoimages = $btit_settings["gallery_pth"];
$maxsize = $btit_settings["gallery_mfs"];
// Configure End

print("	<table class='main' border='0' cellpadding='0' cellspacing='0' width='100%'><tr><td class='embedded'>
		<table width='100%' border='1' cellspacing='0' cellpadding='10'>
		<tr><td style='padding: 4px; background: url(gallery/images/mainbox_bg.jpg) repeat-x left top'>\n");
echo'	<strong><center><font color="#ffffff">'.$SITENAME.' '.$language['gallery15'].'</font></center></strong>';

print("	<tr><td style='padding: 4px; background: url(gallery/images/mainbox_bg.jpg) repeat-x left top'>
		<table style='padding: 4px; background: url(gallery/images/mainbox_bg.jpg) left top' border='0' cellpadding='5' cellspacing='1' width='100%'>\n");

	echo '<tr><td align="center">
		<FORM>
			<INPUT TYPE="button" VALUE="'.$language['gallery'].'"		ONCLICK="window.location.href=\'gallery.php\'">
			<INPUT TYPE="button" VALUE="'.$language['gallery2'].'" 	ONCLICK="window.location.href=\'gallery_upload.php\'">
			<INPUT TYPE="button" VALUE="'.$language['gallery4'].'"	ONCLICK="history.go(-1);return true;">
			<INPUT TYPE="button" VALUE="'.$language['gallery6'].'" 	ONCLICK="history.go(0)">
			<INPUT TYPE="button" VALUE="'.$language['gallery8'].'" 	ONCLICK="window.location.href=\'gallery_readme.php\'">
			<INPUT TYPE="button" value="'.$language['gallery10'].'"  	ONCLICK="window.close()">
		</FORM>
		</td></tr></table>';

$mode = $_GET['mode'];
if ($mode == "") { $mode = "form"; }

if ($mode == "form") {
?>
<div align='center'>

	<form method='post' action="?mode=upload" enctype="multipart/form-data">
		<table style='padding: 4px; background: url(gallery/images/mainbox_bg.jpg) repeat-x left top' border='1' cellspacing='0' cellpadding='5' width='100%'>
			<tr><td class='rowhead'><?php echo'<center>'.$language['gallery21'].'</center>';?></td>
		<td><input type='file' name='file' size='60'></td></tr>
	<tr><td colspan='2' align='center'><input type='submit' name='Submit' value='<?php echo''.$language['gallery18'].'';?>' class='btn'>
		</td></tr></table></form>


	<table style='padding: 4px; background: url(gallery/images/mainbox_bg.jpg) left top' border='0' cellpadding='5' cellspacing='1' width='100%'>
		<td class='rowhead' style='padding: 4px; background: #000000' align='center'>
			<?php echo'<strong><center>'.$language['gallery20'].'</center></strong>';?>
		</td></tr></table></td></tr></table></div>
<?php
}

if ($mode == "upload") {
$file = $_FILES['file']['name'];
$file_type = $_FILES["file"]["type"];
$hash= md5(uniqid(rand(), true));
$image_types = Array ("image/bmp", "image/jpeg", "image/pjpeg", "image/gif", "image/png");
          switch($_FILES["file"]["type"])
          {
              case 'image/bmp':
              $file = $hash.".bmp";
              break;
              case 'image/jpeg':
              $file = $hash.".jpg";
              break;
              case 'image/pjpeg':
              $file = $hash.".jpeg";
              break;
              case 'image/gif':
              $file = $hash.".gif";
              break;
              case 'image/png':
              $file = $hash.".png";
              break;
          }

@getimagesize($_FILES['file']['tmp_name'])
or
die('<center><font color=white><h3>only image uploads are allowed!</h3></font>');

           if((isset($_FILES["file"]["tmp_name"]) && !empty($_FILES["file"]["tmp_name"])) && (isset($_FILES["file"]["name"]) && !empty($_FILES["file"]["name"])))
            {
                $check_img = check_upload($_FILES["file"]["tmp_name"], $_FILES["file"]["name"]);
                switch($check_img)
                {
                    case 1:
                    case 2:
                        $check_img_err = $language["ERR_MISSING_DATA"];
                        if(file_exists($_FILES["file"]["tmp_name"]))
                            @unlink($_FILES["file"]["tmp_name"]);
                        break;
                    case 3:
                        $check_img_err = $language["QUAR_TMP_FILE_MISS"];
                        break;
                    case 4:
                        $check_img_err = $language["QUAR_OUTPUT"];
                        break;
                    case 5:
                    default:
                        $check_img_err = "";
                        break;
                }
                if($check_img_err != "")
                    stderr($language["ERROR"], $check_img_err);
            }




if($_FILES['file']['size'] > $maxsize)
	{

	echo'<p><strong><center>'.$language['gallery24'].'</center></strong></p>';

	} else {

$path = $serverpath.$file;



if ($done <> "yes") {

	if (file_exists($path)) {

echo '<p><strong><center>'.$language['gallery22'].'</center></strong></p>';

exit;
}




if (in_array (strtolower ($file_type), $image_types, TRUE))
                  {
move_uploaded_file($_FILES['file']['tmp_name'], "$path");
$done = "yes";

echo '<center>';
echo '<p><form><INPUT TYPE="button" VALUE="'.$language['gallery12'].'"	ONCLICK=window.location.href=\'gallery_upload.php\'></a></form></p>';
echo '<p><form><INPUT TYPE="button" VALUE="'.$language['gallery13'].'"	ONCLICK=window.location.href=\'gallery.php\'></a></form></p>';
echo '<p>'.$language['gallery14'].'</p>';
echo '<p>'.$language['gallery17'].'</p>';
echo "<p><A href='$BASEURL/$urltoimages/$file' target='_blank'><strong><font color='#ffffff'>$BASEURL/$urltoimages/$file</color></strong></a></center></p>";
echo "<p><center><img src='$urltoimages/$file' border='0'>";
echo '</center>';
?>
	<script type="text/javascript">
		alert("Thank you for using <?php echo $SITENAME;?> Gallery to host your pictures.")
	</script>
<?php

$name = sqlesc($file);

		quickQuery("INSERT INTO {$TABLE_PREFIX}gallery (owner, name, added) VALUES ($CURUSER[uid], $name, NOW())") or sqlerr(__FILE__, __LINE__);

	}

		}

	if ($done <> "yes") { echo'<p><strong><center>'.$language['gallery23'].'</center></strong></p>'; }

	}
}

//echo $gallery_uploadtpl->fetch(load_template("gallery.tpl"));
}
else
{
ext_err_msg($language["OOPS"],$language["GRP"]);
}
include($THIS_BASEPATH.'/index.end.php');
?>
