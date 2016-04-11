<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
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
error_reporting(E_ALL);
 ini_set("display_errors", 1); 
require ("include/functions.php");
require ("imdb/imdb.class.php");

dbconn(false);

global $TABLE_PREFIX;

$THIS_BASEPATH=dirname(__FILE__);

$LANGPATH=$THIS_BASEPATH."/language/english";
require_once($LANGPATH."/lang_main.php");

$movie = new imdb ($_GET["mid"]);
$r=$_GET['id'];

$zap_usr = do_sqlquery("SELECT image FROM {$TABLE_PREFIX}nzbfiles WHERE info_hash =".$r);

$dt= "torrentimg/".$img["image"];

if (isset ($_GET["mid"])) {
  $movieid = $_GET["mid"];
  $movie->setid ($movieid);
  $movie->photodir='./imdb/images/';
  $movie->photoroot='./imdb/images/';
  $rows = 2; // count for the rowspan; init with photo + year

  echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>\n";
  echo "<HTML><HEAD>\n <TITLE>".$movie->title().' ('.$movie->year().")</TITLE>\n";
?>
<link rel="stylesheet" type="text/css" href="<?php echo $STYLEURL; ?>/main.css" />
<?php
  echo "</HEAD>\n<BODY ONLOAD='fix_colspan()' class=\"lista\" style=\"margin: 0px; 0px 0px 0px;\">\n<TABLE border='0'  ALIGN='center' width=100% class=\"lista\">";

  # Photo
  echo '<TR><TD rowspan="29" valign="top">';
  if (($photo_url = $movie->photo_localurl() ) != FALSE) {
    echo '<img src="'.$photo_url.'" width="178" height="220" alt="Cover">';
  } else {
    echo $language["IMDB_NO_PHOTO"];
  }
   
# Languages
  $languages = $movie->languages();
  if (!empty($languages)) {
    ++$rows;
    echo '<TD><B>'.$language["IMDB_LANGUAGES"].':</B></TD><TD>';
    for ($i = 0; $i + 1 < count($languages); $i++) {
      echo $languages[$i].', ';
    }
    echo $languages[$i]."</TD></TR>\n";
  }
  flush();

  # Country
  $country = $movie->country();
  if (!empty($country)) {
    ++$rows;
    echo '<TR><TD><B>'.$language["COUNTRY"].':</B></TD><TD>';
    for ($i = 0; $i + 1 < count($country); $i++) {
      echo $country[$i].', ';
    }
    echo $country[$i]."</TD></TR>\n";
  }

  # Genres
  $genre = $movie->genre();
  if (!empty($genre)) { echo "<TR><TD><B>".$language["IMDB_GENRE"].":</B></TD><TD>$genre</TD></TR>\n"; ++$rows; }

  $gen = $movie->genres();
  if (!empty($gen)) {
    ++$rows;
    echo '<TR><TD><B>'.$language["IMDB_ALL_GENRES"].':</B></TD><TD>';
    for ($i = 0; $i + 1 < count($gen); $i++) {
      echo $gen[$i].', ';
    }
    echo $gen[$i]."</TD></TR>\n";
  }
# Ratings and votes
  $ratv = $movie->rating();
  
  if($ratv<=0.4)
      $rat_img="00";
  elseif($ratv>=0.5 && $ratv<=0.9)
      $rat_img="05";
  elseif($ratv>=1 && $ratv<=1.4)
      $rat_img="10";
  elseif($ratv>=1.5 && $ratv<=1.9)
      $rat_img="15";
  elseif($ratv>=2 && $ratv<=2.4)
      $rat_img="20";
  elseif($ratv>=2.5 && $ratv<=2.9)
      $rat_img="25";
  elseif($ratv>=3 && $ratv<=3.4)
      $rat_img="30";
  elseif($ratv>=3.5 && $ratv<=3.9)
      $rat_img="35";
  elseif($ratv>=4 && $ratv<=4.4)
      $rat_img="40";
  elseif($ratv>=4.5 && $ratv<=4.9)
      $rat_img="45";
  elseif($ratv>=5 && $ratv<=5.4)
      $rat_img="50";
  elseif($ratv>=5.5 && $ratv<=5.9)
      $rat_img="55";
  elseif($ratv>=6 && $ratv<=6.4)
      $rat_img="60";
  elseif($ratv>=6.5 && $ratv<=6.9)
      $rat_img="65";
  elseif($ratv>=7 && $ratv<=7.4)
      $rat_img="70";
  elseif($ratv>=7.5 && $ratv<=7.9)
      $rat_img="75";
  elseif($ratv>=8 && $ratv<=8.4)
      $rat_img="80";
  elseif($ratv>=8.5 && $ratv<=8.9)
      $rat_img="85";
  elseif($ratv>=9 && $ratv<=9.4)
      $rat_img="90";
  elseif($ratv>=9.5 && $ratv<=9.9)
      $rat_img="95";
  elseif($ratv==10)
      $rat_img="100";

  if (!empty($ratv)) { echo "<TR><TD><B>".$language["IMDB_RATING"].":</b></TD><TD><img src='".$BASEURL."/imdb/imgs/showtimes/".$rat_img.".gif' alt='".$ratv."/10'>&nbsp;&nbsp;".$ratv."/10</TD></TR>\n"; ++$rows; }
  $ratv = $movie->votes();
  if (!empty($ratv)) { echo "<TR><TD><B>".$language["IMDB_VOTES"].":</B></TD><TD>$ratv</TD></TR>\n"; ++$rows; }
  flush();
 
  $tagline = $movie->tagline();
  if (!empty($tagline)) {
    ++$rows;
    echo "<TR><TD valign='top' ><B>".$language["IMDB_TAGLINE"].":</B></TD><TD>$tagline</TD></TR>\n";
  }
  # Plot outline & plot
  $plotoutline = $movie->plotoutline();
  if (!empty($plotoutline)) {
    ++$rows;
    echo "<tr><td valign='top' ><b>".$language["IMDB_PLOT_OUTLINE"].":</b></td><td>$plotoutline</td></tr>\n";
  }

//  $plot = $movie->plot();
//  if (!empty($plot)) {
//    ++$rows;
//    echo '<tr><td valign=top ><b>'.$language["IMDB_PLOT"].':</b></td><td>';
//    for ($i = 0; $i < count($plot); $i++) {
//      echo "".$plot[$i]."\n";
//    }
//    echo "</td></tr>\n";
//  }
  flush();

# Year & runtime
  echo '<TR><TD><B>'.$language["IMDB_YEAR"].':</B></TD><TD>'.$movie->year().'</TD></TR>';
  $runtime = $movie->runtime();
  if (!empty($runtime)) {
    ++$rows;
    echo "<TR><TD valign=top ><B>".$language["IMDB_RUNTIME"].":</b></TD><TD>$runtime ".$language["IMDB_MINUTES"]."</TD></TR>\n";
  }
  flush();



  echo "</TABLE>\n";
  echo "<SCRIPT TYPE='text/javascript'>// <!--\n";
  echo "  function fix_colspan() {\n";
  echo "    document.getElementById('photocol').rowspan = '$rows';\n";
  echo "  }\n//-->\n</SCRIPT>\n";
  echo "</BODY></HTML>";
}
?>