<?php
//
// Author: TracKer
// E-Mail: tracker2k@gmail.com
// Version 0.1.7 (Major.Minor.Revision)
//
// Copyright (C) 2006  TracKer
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
//
// See doc/copying.txt for details
//
//===========================================================================
// Info
//===========================================================================
//
// [IN]
//   userid - ID of user in TorrentPier forum
//
// [OUT]
//   PNG file
//
// [Example]
//   http://127.0.0.1/torrentbar.php/USERID.png
//
//===========================================================================
// Presets
//===========================================================================

// Database Presets
//$torrentpier_config_path = "/home/localhost/www/torrentpier/forum/config.php";

$template_file = dirname(__FILE__)."/torrentbar/template.png";

$rating_x = 37;
$rating_y = 6;

$upload_x = 104;
$upload_y = 6;

$download_x = 198;
$download_y = 6;

$digits_template = dirname(__FILE__)."/torrentbar/digits.png";
$digits_config = dirname(__FILE__)."/torrentbar/digits.ini";

//===========================================================================
// Funtions
//===========================================================================

function getParam() {
    $res = preg_replace("#(.*)\/(.*)\.png#i", "$2", $_SERVER['REQUEST_URI']);
    $res = trim(substr(trim($res), 0, 10));
    if (! is_numeric($res)) { $res=0; }
    return $res;
}

function mysql_init() {
    global $dbhost, $database, $dbuser, $dbpass;
    if ($dbpass!='') {
        $link = @new mysqli($dbhost, $dbuser, $dbpass) or die("Cannot connect to database!");
    } else {
        $link = @new mysqli($dbhost, $dbuser) or die("Cannot connect to database!");
    }
    $link->select_db($database) or die("Cannot select database!");
    return $link;
}

function ifthen($ifcondition, $iftrue, $iffalse) {
    if ($ifcondition) {
        return $iftrue;
    } else {
        return $iffalse;
    }
}

function getPostfix($val) {
    $postfix = "b";
    if ($val>=1024)             { $postfix = "kb"; }
    if ($val>=1048576)          { $postfix = "mb"; }
    if ($val>=1073741824)       { $postfix = "gb"; }
    if ($val>=1099511627776)    { $postfix = "tb"; }
    if ($val>=1125899906842624) { $postfix = "pb"; }
    if ($val>=1152921504606846976)       { $postfix = "eb"; }
    if ($val>=1180591620717411303424)    { $postfix = "zb"; }
    if ($val>=1208925819614629174706176) { $postfix = "yb"; }

    return $postfix;
}

function roundCounter($value, $postfix) {
    $val=$value;
    switch ($postfix) {
    case "kb": $val=$val / 1024;
        break;
    case "mb": $val=$val / 1048576;
        break;
    case "gb": $val=$val / 1073741824;
        break;
    case "tb": $val=$val / 1099511627776;
        break;
    case "pb": $val=$val / 1125899906842624;
        break;
    case "eb": $val=$val / 1152921504606846976;
        break;
    case "zb": $val=$val / 1180591620717411303424;
        break;
    case "yb": $val=$val / 1208925819614629174706176;
        break;

    default:
        break;
    }
    return $val;
}

//===========================================================================
// Main body
//===========================================================================

// Digits initialization - begin
$digits_ini = @parse_ini_file($digits_config) or die("Cannot load Digits Configuration file!");
$digits_img = @imagecreatefrompng($digits_template) or die("Cannot Initialize new GD image stream!");
// Digits initialization - end

$download_counter = 0;
$upload_counter = 0;
$rating_counter = 0;

header("Content-type: image/png");
$img = @imagecreatefrompng($template_file) or die ("Cannot Initialize new GD image stream!");


$userid = getParam();
if ($userid!="") {
    include("include/config.php");
    mysql_init();

    $query = "SELECT COUNT(id) FROM {$TABLE_PREFIX}users WHERE id = '".$userid."'";
    $result = @do_sqlquery($query) or die("Could not select data!");
    $counter = $result->fetch_row()[0];
    $result->free();

    if ($counter>0)
    {
        if ($XBTT_USE)
        {
            $udownloaded="`u`.`downloaded`+IFNULL(`x`.`downloaded`,0) `downloaded`";
            $uuploaded="`u`.`uploaded`+IFNULL(`x`.`uploaded`,0) `uploaded`";
            $utables="`{$TABLE_PREFIX}users` `u` LEFT JOIN `xbt_users` `x` ON `x`.`uid`=`u`.`id`";
        }
        else
        {
            $udownloaded="`u`.`downloaded`";
            $uuploaded="`u`.`uploaded`";
            $utables="`{$TABLE_PREFIX}users` `u`";
        }
        $query = "SELECT $uuploaded, $udownloaded FROM $utables WHERE `u`.`id` = '".$userid."'";
        $result = do_sqlquery($query) or die("Could not select data!");

        while ($data = $result->fetch_array())
        {
            $upload_counter = $data['uploaded'];
            $download_counter = $data['downloaded'];
            if ($download_counter>0)
            {
                $rating_counter = $upload_counter / $download_counter;
            }
        }
    }
}

$dot_pos = strpos((string) $rating_counter, ".");
if ($dot_pos>0) {
    $rating_counter = (string) round(substr((string) $rating_counter, 0, $dot_pos+1+2), 2);
} else {
    $rating_counter = (string) $rating_counter;
}
$counter_x = $rating_x;
for ($i=0; $i<strlen($rating_counter); $i++) {
    $d_x=$digits_ini[ifthen($rating_counter[$i]==".", "dot", $rating_counter[$i])."_x"];
    $d_w=$digits_ini[ifthen($rating_counter[$i]==".", "dot", $rating_counter[$i])."_w"];
    imagecopy($img, $digits_img, $counter_x, $rating_y, $d_x, 0, $d_w, imagesy($digits_img));
    $counter_x=$counter_x+$d_w-1;
}


$postfix = getPostfix($upload_counter);
$upload_counter = roundCounter($upload_counter, $postfix);
$dot_pos = strpos((string) $upload_counter, ".");
if ($dot_pos>0) {
    $upload_counter = (string) round(substr((string) $upload_counter, 0, $dot_pos+1+2), 2);
} else {
    $upload_counter = (string) $upload_counter;
}
$counter_x = $upload_x;
for ($i=0; $i<strlen($upload_counter); $i++) {
    $d_x=$digits_ini[ifthen($upload_counter[$i]==".", "dot", $upload_counter[$i])."_x"];
    $d_w=$digits_ini[ifthen($upload_counter[$i]==".", "dot", $upload_counter[$i])."_w"];
    imagecopy($img, $digits_img, $counter_x, $upload_y, $d_x, 0, $d_w, imagesy($digits_img));
    $counter_x=$counter_x+$d_w-1;
}
$counter_x+=3;
$d_x=$digits_ini[$postfix."_x"];
$d_w=$digits_ini[$postfix."_w"];
imagecopy($img, $digits_img, $counter_x, $upload_y, $d_x, 0, $d_w, imagesy($digits_img));


$postfix = getPostfix($download_counter);
$download_counter = roundCounter($download_counter, $postfix);
$dot_pos = strpos((string) $download_counter, ".");
if ($dot_pos>0) {
    $download_counter = (string) round(substr((string) $download_counter, 0, $dot_pos+1+2), 2);
} else {
    $download_counter = (string) $download_counter;
}
$counter_x = $download_x;
for ($i=0; $i<strlen($download_counter); $i++) {
    $d_x=$digits_ini[ifthen($download_counter[$i]==".", "dot", $download_counter[$i])."_x"];
    $d_w=$digits_ini[ifthen($download_counter[$i]==".", "dot", $download_counter[$i])."_w"];
    imagecopy($img, $digits_img, $counter_x, $download_y, $d_x, 0, $d_w, imagesy($digits_img));
    $counter_x=$counter_x+$d_w-1;
}
$counter_x+=3;
$d_x=$digits_ini[$postfix."_x"];
$d_w=$digits_ini[$postfix."_w"];
imagecopy($img, $digits_img, $counter_x, $download_y, $d_x, 0, $d_w, imagesy($digits_img));


imagepng($img);
imagedestroy($img);
?>
