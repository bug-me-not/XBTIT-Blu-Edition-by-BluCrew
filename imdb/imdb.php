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

require ("../include/functions.php");
require ("imdb.class.php");

dbconn(false);

$exploded_dir=explode("/",str_replace("\\", "/", dirname(__FILE__)));
unset($exploded_dir[(count($exploded_dir)-1)]);
$THIS_BASEPATH=implode("/",$exploded_dir);

$LANGPATH=$THIS_BASEPATH."/language/english";
require_once($LANGPATH."/lang_main.php");

$movie = new imdb ($_GET["mid"]);

if (isset ($_GET["mid"])) {
  $movieid = $_GET["mid"];
  $movie->setid ($movieid);
  $rows = 2; // count for the rowspan; init with photo + year

//get current style
  $resheet=do_sqlquery("SELECT(SELECT `style_url` FROM `xbtit_style` WHERE `id`=".$CURUSER["style"].") `style_url`, (SELECT `language_url` FROM `xbtit_language` WHERE `id`=".$CURUSER["language"].") `language_url`");
if (!$resheet)
   {

   $STYLEPATH="$THIS_BASEPATH/style/xbtit_default";
   $STYLEURL="$BASEURL/style/xbtit_default";
}
else
    {
        $resstyle=mysql_fetch_array($resheet);
        $STYLEPATH="$THIS_BASEPATH/".$resstyle["style_url"];
        $STYLEURL="$BASEURL/".$resstyle["style_url"];
        $LANGPATH2=$THIS_BASEPATH."/".$resstyle["language_url"];
}

if($LANGPATH!=$LANGPATH2)
{
    require_once($LANGPATH2."/lang_main.php");
}

$style_css=load_css("main.css");//end style

  echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>\n";
  echo "<HTML><HEAD>\n <TITLE>".$movie->title().' ('.$movie->year().")</TITLE>\n";
?>
<link rel="stylesheet" type="text/css" href="<?php echo $STYLEURL; ?>/main.css" />
<?php
  echo "</HEAD>\n<BODY ONLOAD='fix_colspan()' class=\"listaimdb\" style=\"margin: 0px; 0px 0px 0px;\">\n<TABLE border='1'  ALIGN='center' STYLE='border-collapse:collapse' width=100% class=\"listaimdb\">";

  # Title & year
  echo '<TR><td COLSPAN="3" class="header"><center><b>';
  echo $movie->title().' ('.$movie->year().")</b></center></td></tr>\n";
  flush();

  # Photo
  echo '<TR><TD rowspan="29" valign="top" class="lista">';
  if (($photo_url = $movie->photo_localurl() ) != FALSE) {
    echo '<img src="'.$photo_url.'" width="100" height="140" alt="Cover">';
  } else {
    echo $language["IMDB_NO_PHOTO"];
  }

  # AKAs
  $aka = $movie->alsoknow();
  $cc  = count($aka);
  if (!empty($aka)) {
    echo '</TD><TD valign=top width=120 class=header><b>'.$language["IMDB_AKA"].':</b> </td><td class=lista>';
    foreach ( $aka as $ak){
      echo $ak["title"];
      if (!empty($ak["year"])) echo " ".$ak["year"];
      echo  " =&gt; ".$ak["country"];
      if (empty($ak["lang"])) { if (!empty($ak["comment"])) echo " (".$ak["comment"].")"; }
      else {
        if (!empty($ak["comment"])) echo ", ".$ak["comment"];
        echo " [".$ak["lang"]."]";
      }
      echo "<BR>";
    }
    echo "</td></tr>\n";
    flush();
  }

  # Seasons
  if ( $movie->seasons() != 0 ) {
    ++$rows;
    echo '<TR><TD class=header><B>'.$language["IMDB_SEASONS"].':</B></TD><TD class=lista>'.$movie->seasons()."</TD></TR>\n";
    flush();
  }

  # Year & runtime
  echo '<TR><TD class=header><B>'.$language["IMDB_YEAR"].':</B></TD><TD class=lista>'.$movie->year().'</TD></TR>';
  $runtime = $movie->runtime();
  if (!empty($runtime)) {
    ++$rows;
    echo "<TR><TD valign=top class=header><B>".$language["IMDB_RUNTIME"].":</b></TD><TD class=lista>$runtime minutes</TD></TR>\n";
  }
  flush();

  # MPAA
  $mpaa = $movie->mpaa();
  if (!empty($mpaa)) {
    ++$rows;
    $mpar = $movie->mpaa_reason();
    if (empty($mpar)) echo '<TR><TD class=header><B>'.$language["IMDB_AGE_CLASS"].':</b></TD><TD class=lista>';
    else echo '<TR><TD rowspan="2" class=header><B>'.$language["IMDB_AGE_CLASS"].':</b></TD><TD class=lista>';
    echo "<table align='left' border='1' style='border-collapse:collapse;background-color:#ddd;'><tr><td class=header>".$language["IMDB_COUNTRY"]."</td><td class=header>".$language["IMDB_RATING"]."</th></tr>";
    foreach ($mpaa as $key=>$mpaa) {
      echo "<tr><td class=lista>$key</td><td class=lista>$mpaa</td></tr>";
    }
    echo "</table></TD></TR>\n";
    if (!empty($mpar)) echo "<TR><TD class=lista>$mpar</TD></TR>\n";
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
  
  if (!empty($ratv)) { echo "<TR><TD class=header><B>".$language["IMDB_RATING"].":</b></TD><TD class=lista><img src='".$BASEURL."/imdb/imgs/showtimes/".$rat_img.".gif' alt='".$ratv."/10'>&nbsp;&nbsp;".$ratv."/10</TD></TR>\n"; ++$rows; }
  $ratv = $movie->votes();
  if (!empty($ratv)) { echo "<TR><TD class=header><B>".$language["IMDB_VOTES"].":</B></TD><TD class=lista>$ratv</TD></TR>\n"; ++$rows; }
  flush();

  # Languages
  $languages = $movie->languages();
  if (!empty($languages)) {
    ++$rows;
    echo '<TR><TD class=header><B>'.$language["IMDB_LANGUAGES"].':</B></TD><TD class=lista>';
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
    echo '<TR><TD class=header><B>'.$language["IMDB_COUNTRY"].':</B></TD><TD class=lista>';
    for ($i = 0; $i + 1 < count($country); $i++) {
      echo $country[$i].', ';
    }
    echo $country[$i]."</TD></TR>\n";
  }

  # Genres
  $genre = $movie->genre();
  if (!empty($genre)) { echo "<TR><TD class=header><B>".$language["IMDB_GENRE"].":</B></TD><TD class=lista>$genre</TD></TR>\n"; ++$rows; }

  $gen = $movie->genres();
  if (!empty($gen)) {
    ++$rows;
    echo '<TR><TD class=header><B>'.$language["IMDB_ALL_GENRES"].':</B></TD><TD class=lista>';
    for ($i = 0; $i + 1 < count($gen); $i++) {
      echo $gen[$i].', ';
    }
    echo $gen[$i]."</TD></TR>\n";
  }

  # Colors
  $col = $movie->colors();
  if (!empty($col)) {
    ++$rows;
    echo '<TR><TD class=header><B>'.$language["IMDB_COLORS"].':</B></TD><TD class=lista>';
    for ($i = 0; $i + 1 < count($col); $i++) {
      echo $col[$i].', ';
    }
    echo $col[$i]."</TD></TR>\n";
  }
  flush();

  # Sound
  $sound = $movie->sound ();
  if (!empty($sound)) {
    ++$rows;
    echo '<TR><TD class=header><B>'.$language["IMDB_SOUND"].':</B></TD><TD class=lista>';
    for ($i = 0; $i + 1 < count($sound); $i++) {
      echo $sound[$i].', ';
    }
    echo $sound[$i]."</TD></TR>\n";
  }

  $tagline = $movie->tagline();
  if (!empty($tagline)) {
    ++$rows;
    echo "<TR><TD valign='top' class=header><B>".$language["IMDB_TAGLINE"].":</B></TD><TD class=lista>$tagline</TD></TR>\n";
  }

  #==[ Staff ]==
  # director(s)
  $director = $movie->director();
  if (!empty($director)) {
    ++$rows;
    echo '<TR><TD valign=top class=header><B>'.$language["IMDB_DIRECTOR"].':</B></TD><TD class=lista>';
    for ($i = 0; $i < count($director); $i++) {
      echo '<a href="imdb_person.php?mid='.$director[$i]["imdb"].'">'.$director[$i]["name"]."</a><br />";
    }
    echo "</td></tr>\n";
  }

  # Story
  $write = $movie->writing();
  if (!empty($write)) {
    ++$rows;
    echo '<TR><TD valign=top class=header><B>'.$language["IMDB_WRITING_BY"].':</B></TD><TD class=lista>';
    echo "<table align='left' border='1' class=lista><tr><td class=header>".$language["IMDB_WRITER"]."</td><td class=header>".$language["IMDB_ROLE"]."</td></tr>";
    for ($i = 0; $i < count($write); $i++) {
      echo '<tr><td width=200 class=lista>';
      echo '<a href="imdb_person.php?mid='.$write[$i]["imdb"].'">';
      echo $write[$i]["name"].'</a></td><td class=lista>';
      echo $write[$i]["role"]."</td></tr>";
    }
    echo "</table></td></tr>\n";
  }
  flush();

  # Producer
  $produce = $movie->producer();
  if (!empty($produce)) {
    ++$rows;
    echo '<TR><TD valign=top class=header><B>'.$language["IMDB_PRODUCED_BY"].':</B></TD><TD class=lista>';
    echo "<table align='left' border='1' class=lista><tr><td class=header>".$language["IMDB_PRODUCER"]."</td><td class=header>".$language["IMDB_ROLE"]."</th></tr>";
    for ($i = 0; $i < count($produce); $i++) {
      echo '<tr><td width=200 class=lista>';
      echo '<a href="imdb_person.php?mid='.$produce[$i]["imdb"].'">';
      echo $produce[$i]["name"].'</a></td><td class=lista>';
      echo $produce[$i]["role"]."</td></tr>";
    }
    echo "</table></td></tr>\n";
  }

  # Music
  $compose = $movie->composer();
  if (!empty($compose)) {
    ++$rows;
    echo '<TR><TD valign=top class=header><B>'.$language["IMDB_MUSIC"].':</B></TD><TD class=lista>';
    echo "<table align='left' border='1' class=lista><tr><td class=header>".$language["IMDB_MUSICIAN"]."</td></tr>";
    for ($i = 0; $i < count($compose); $i++) {
      echo '<tr><td width=200 class=lista>';
      echo '<a href="imdb_person.php?mid='.$compose[$i]["imdb"].'">';
      echo $compose[$i]["name"]."</a></td></tr>";
    }
    echo "</table></td></tr>\n";
  }
  flush();

  # Cast
  $cast = $movie->cast();
  if (!empty($cast)) {
    ++$rows;
    echo '<TR><TD valign=top class=header><B>'.$language["IMDB_CAST"].':</B></TD><TD class=lista>';
    echo "<table align='left' border='1' class=lista><tr><td class=header>".$language["IMDB_ACTOR"]."</td><td class=header>".$language["IMDB_ROLE"]."</td></tr>";
    for ($i = 0; $i < count($cast); $i++) {
      echo '<tr><td width=200 class=lista>';
      echo '<a href="imdb_person.php?mid='.$cast[$i]["imdb"].'">';
      echo $cast[$i]["name"].'</a></td><td class=lista>';
      echo $cast[$i]["role"]."</td></tr>";
    }
    echo "</table></td></tr>\n";
  }
  flush();

  # Plot outline & plot
  $plotoutline = $movie->plotoutline();
  if (!empty($plotoutline)) {
    ++$rows;
    echo "<tr><td valign='top' class=header><b>".$language["IMDB_PLOT_OUTLINE"].":</b></td><td class=lista>$plotoutline</td></tr>\n";
  }

  $plot = $movie->plot();
  if (!empty($plot)) {
    ++$rows;
    echo '<tr><td valign=top class=header><b>'.$language["IMDB_PLOT"].':</b></td><td class=lista><ul>';
    for ($i = 0; $i < count($plot); $i++) {
      echo "<li>".$plot[$i]."</li>\n";
    }
    echo "</ul></td></tr>\n";
  }
  flush();

  # Taglines
  $taglines = $movie->taglines();
  if (!empty($taglines)) {
    ++$rows;
    echo '<tr><td valign=top class=header><b>'.$language["IMDB_TAGLINES"].':</b></td><td class=lista><ul>';
    for ($i = 0; $i < count($taglines); $i++) {
      echo "<li>".$taglines[$i]."</li>\n";
    }
    echo "</ul></td></tr>\n";
  }

  $seasons = $movie->seasons();
  if ( $seasons != 0 ) {
    ++$rows;
    $episodes = $movie->episodes();
    echo '<tr><td valign=top><b>'.$language["IMDB_EPISODES"].':</b></td><td>';
    for ( $season = 1; $season <= $seasons; ++$season ) {
      $eps = @count($episodes[$season]);
      for ( $episode = 1; $episode <= $eps; ++$episode ) {
        $episodedata = &$episodes[$season][$episode];
        echo '<b>'.$language["IMDB_SEASON"].' '.$season.', '.$language["IMDB_EPISODE"].' '.$episode.': <a href="'.$_SERVER["PHP_SELF"].'?mid='.$episodedata['imdbid'].'">'.$episodedata['title'].'</a></b> (<b>'.$language["IMDB_ORIG_AIR_DATE"].': '.$episodedata['airdate'].'</b>)<br>'.$episodedata['plot'].'<br/><br/>';
      }
    }
    echo "</td></tr>\n";
  }

  # Selected User Comment
  $comment = $movie->comment();
  if (!empty($comment)) {
    ++$rows;
    echo "<tr><td valign='top' class=header><b>".$language["IMDB_USER_COMMENTS"].":</b></td><td class=lista>$comment</td></tr>\n";
  }

  # Quotes
  $quotes = $movie->quotes();
  if (!empty($quotes)) {
    ++$rows;
    echo '<tr><td valign=top class=header><b>'.$language["IMDB_MOVIE_QUOTES"].':</b></td><td class=lista>';
    echo preg_replace("/http\:\/\/".str_replace(".","\.",$movie->imdbsite)."\/name\/nm(\d{7})\//","imdb_person.php?mid=\\1",$quotes[0])."</td></tr>\n";
  }

  # Trailer
  $trailers = $movie->trailers();
  if (!empty($trailers)) {
    ++$rows;
    echo '<tr><td valign=top class=header><b>'.$language["IMDB_TRAILERS"].':</b></td><td class=lista>';
    for ($i=0;$i<count($trailers);++$i) {
      echo "<a href='".$trailers[$i]."'>".$trailers[$i]."</a><br>\n";
    }
    echo "</td></tr>\n";
  }

  # Crazy Credits
  $crazy = $movie->crazy_credits();
  $cc    = count($crazy);
  if ($cc) {
    ++$rows;
    echo '<tr><td valign=top class=header><b>'.$language["IMDB_CR_CRED"].':</b></td><td class=lista>';
    echo $language["IMDB_CR_CRED_1"]." $cc <i>".$language["IMDB_CR_CRED"]."</i>. ".$language["IMDB_CR_CRED_2"].":<br>$crazy[0]</td></tr>\n";
  }

  # Goofs
  $goofs = $movie->goofs();
  $gc    = count($goofs);
  if ($gc > 0) {
    ++$rows;
    echo '<tr><td valign=top class=header><b>'.$language["IMDB_GOOFS"].':</b></td><td class=lista>';
    echo $language["IMDB_CR_CRED_1"]." $gc ".strtolower($language["IMDB_GOOFS"]).". ".$language["IMDB_GOOFS_1"].":<br>";
    echo "<b>".$goofs[0]["type"]."</b> ".$goofs[0]["content"]."</td></tr>\n";
  }

  # Trivia
  $trivia = $movie->trivia();
  $gc     = count($trivia);
  if ($gc > 0) {
    ++$rows;
    echo '<tr><td valign=top class=header><b>'.$language["IMDB_TRIVIA"].':</b></td><td class=lista>';
    echo $language["IMDB_TRIVIA_1"]." $gc ".$language["IMDB_TRIVIA_2"].":<br><ul>";
    for ($i=0;$i<5;++$i) {
      if (empty($trivia[$i])) break;
      echo "<li>".preg_replace("/http\:\/\/".str_replace(".","\.",$movie->imdbsite)."\/name\/nm(\d{7})\//","imdb_person.php?mid=\\1",$trivia[$i])."</li>";
    }
    echo "</ul></td></tr>\n";
  }

  # Soundtracks
  $soundtracks = $movie->soundtrack();
  $gc = count($soundtracks);
  if ($gc > 0) {
    ++$rows;
    echo '<tr><td valign=top class=header><b>'.$language["IMDB_SOUNDTRACKS"].':</b></td><td class=lista>';
    echo $language["IMDB_TRIVIA_1"]." $gc ".$language["IMDB_SOUNDTRACKS_1"].":<br>";
    echo "<table align='center' border='1' class=lista><tr><td class=header>".$language["IMDB_SOUNDTRACK"]."</td><td class=header>".$language["IMDB_CREDIT"]." 1</td><td class=header>".$language["IMDB_CREDIT"]." 2</td></tr>";
    for ($i=0;$i<5;++$i) {
      if (empty($soundtracks[$i])) break;
      $credit1 = preg_replace("/http\:\/\/".str_replace(".","\.",$movie->imdbsite)."\/name\/nm(\d{7})\//","imdb_person.php?mid=\\1",$soundtracks[$i]["credits"][0]);
      $credit2 = preg_replace("/http\:\/\/".str_replace(".","\.",$movie->imdbsite)."\/name\/nm(\d{7})\//","imdb_person.php?mid=\\1",$soundtracks[$i]["credits"][1]);
      echo "<tr><td class=lista>".$soundtracks[$i]["soundtrack"]."</td><td class=lista>$credit1</td><td class=lista>$credit2</td></tr>";
    }
    echo "</table></td></tr>\n";
  }

  echo "</TABLE><BR>\n";
  echo "<SCRIPT TYPE='text/javascript'>// <!--\n";
  echo "  function fix_colspan() {\n";
  echo "    document.getElementById('photocol').rowspan = '$rows';\n";
  echo "  }\n//-->\n</SCRIPT>\n";
  echo "</BODY></HTML>";
}
?>
