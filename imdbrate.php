<?php
//imdb rating in torrents details cooly and a bit of pets code
require"include/functions.php";
dbconn(false);

global $BASEURL, $CURUSER;

if(!$CURUSER && $CURUSER["uid"]<1)
die("Sorry no Guests!");

$id=(isset($_GET["mid"])?$_GET["mid"]:$id=0);

$url = "http://www.imdb.com/title/tt".$id."/";//no need to change this.


//gets the match content
function get_match($regex,$content)
{
	preg_match($regex,$content,$matches);
	return $matches[1];
}


//gets the data from a URL
function get_data($url)
{
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1) Gecko/20090624 Firefox/3.5');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 140);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}


//get the page content and cache it just incase u cant get it again :)

$imdb_content = get_data($url);

$rand=substr($url,26,9);

//Rating
if(file_exists("imdb/cache/".$rand."_rating.txt"))
{
$rating=file_get_contents("imdb/cache/".$rand."_rating.txt");
$rat=$rating;
}else{
if($rating = get_match('@class\=\"rating\-rating\">(\d{1,2}\.\d)@i',$imdb_content))
{
$content= $rating;
$rat=$content;
file_put_contents("imdb/cache/".$rand."_rating.txt",$rat);
}else{
$rat="No record";
}
}
$votes=$rating."/10";


if($rat<=0.4)
      $rat_img="00";
  elseif($rat>=0.5 && $rat<=0.9)
      $rat_img="05";
  elseif($rat>=1 && $rat<=1.4)
      $rat_img="10";
  elseif($rat>=1.5 && $rat<=1.9)
      $rat_img="15";
  elseif($rat>=2 && $rat<=2.4)
      $rat_img="20";
  elseif($rat>=2.5 && $rat<=2.9)
      $rat_img="25";
  elseif($rat>=3 && $rat<=3.4)
      $rat_img="30";
  elseif($rat>=3.5 && $rat<=3.9)
      $rat_img="35";
  elseif($rat>=4 && $rat<=4.4)
      $rat_img="40";
  elseif($rat>=4.5 && $rat<=4.9)
      $rat_img="45";
  elseif($rat>=5 && $rat<=5.4)
      $rat_img="50";
  elseif($rat>=5.5 && $rat<=5.9)
      $rat_img="55";
  elseif($rat>=6 && $rat<=6.4)
      $rat_img="60";
  elseif($rat>=6.5 && $rat<=6.9)
      $rat_img="65";
  elseif($rat>=7 && $rat<=7.4)
      $rat_img="70";
  elseif($rat>=7.5 && $rat<=7.9)
      $rat_img="75";
  elseif($rat>=8 && $rat<=8.4)
      $rat_img="80";
  elseif($rat>=8.5 && $rat<=8.9)
      $rat_img="85";
  elseif($rat>=9 && $rat<=9.4)
      $rat_img="90";
  elseif($rat>=9.5 && $rat<=9.9)
      $rat_img="95";
  elseif($rat==10)
      $rat_img="100";
      
if (!empty($id)){
print("<img src='./imdb/imgs/showtimes/".$rat_img.".gif' alt='".$rat."/10' title='".(!empty($votes)?$votes:$votes=0)."'>");
}
else{
print("Unknown");
}
?>