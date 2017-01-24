<?php
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
/*
Page:           _drawrating.php
Created:        Aug 2006
Last Mod:       Mar 18 2007
The function that draws the rating bar.
---------------------------------------------------------
ryan masuga, masugadesign.com
ryan@masugadesign.com
Licensed under a Creative Commons Attribution 3.0 License.
http://creativecommons.org/licenses/by/3.0/
See readme.txt for full credit details.
--------------------------------------------------------- */

function rating_bar($id,$units='',$static='') {

require_once(dirname(__FILE__).'/../_config-rating.php'); // get the db connection info

global $CURUSER;
//$TABLE_PREFIX is already defined in _config-rating.php
//set some variables
$ip = $CURUSER["uid"] . "." . $CURUSER["random"];


if (!$units) {$units = 10;}
if (!$static) {$static = FALSE;}

// get votes, values, ips for the current rating bar
$query=$rating_conn->query("SELECT total_votes, total_value, used_ips FROM $rating_dbname.$rating_tableName WHERE id='$id' ")or die(" Error: ".$rating_conn->error);


// insert the id in the DB if it doesn't exist already
// see: http://www.masugadesign.com/the-lab/scripts/unobtrusive-ajax-star-rating-bar/#comment-121
if ($query->num_rows == 0) {
$sql = "INSERT INTO $rating_dbname.$rating_tableName (`id`,`total_votes`, `total_value`, `used_ips`) VALUES ('$id', '0', '0', '')";
$result = $rating_conn->query($sql);
}

$numbers=$query->fetch_assoc();


if ($numbers['total_votes'] < 1) {
	$count = 0;
} else {
	$count=$numbers['total_votes']; //how many votes total
}
$current_rating=$numbers['total_value']; //total number of rating added together and stored
$tense=($count==1) ? "vote" : "votes"; //plural form votes/vote

// determine whether the user has voted, so we know how to draw the ul/li
$voted=$rating_conn->query("SELECT used_ips FROM $rating_dbname.$rating_tableName WHERE used_ips LIKE '%".$ip."%' AND id='".$id."' ")->num_rows;

// now draw the rating bar
$rating_width = @number_format($current_rating/$count,2)*$rating_unitwidth;
$rating1 = @number_format($current_rating/$count,1);
$rating2 = @number_format($current_rating/$count,2);


if ($static == 'static') {

		$static_rater = array();
		$static_rater[] .= "\n".'<div class="ratingblock">';
		$static_rater[] .= '<div id="unit_long'.$id.'">';
		$static_rater[] .= '<ul id="unit_ul'.$id.'" class="unit-rating" style="width:'.$rating_unitwidth*$units.'px;">';
		$static_rater[] .= '<li class="current-rating" style="width:'.$rating_width.'px;">Currently '.$rating2.'/'.$units.'</li>';
		$static_rater[] .= '</ul>';
		$static_rater[] .= '<div class="r">Rating: <strong> '.$rating1.' out of '.$units.'.0 </strong>  (Votes: '.$count.') <em>For your upload!</em></p>';
		$static_rater[] .= '</div>';
		$static_rater[] .= '</div>'."\n\n";

		return join("\n", $static_rater);


} else {

      $rater ='';
      $rater.='<div class="ratingblock">';

      $rater.='<div id="unit_long'.$id.'">';
      $rater.='  <ul id="unit_ul'.$id.'" class="unit-rating" style="width:'.$rating_unitwidth*$units.'px;">';
      $rater.='     <li class="current-rating" style="width:'.$rating_width.'px;">Currently '.$rating2.'/'.$units.'</li>';

      for ($ncount = 1; $ncount <= $units; $ncount++) { // loop from 1 to the number of units
           if(!$voted) { // if the user hasn't yet voted, draw the voting stars
              $rater.='<li><a href="ajaxstarrater/db.php?j='.$ncount.'&amp;q='.$id.'&amp;t='.$ip.'&amp;c='.$units.'" title="'.$ncount.' out of '.$units.'" class="r'.$ncount.'-unit rater" rel="nofollow">'.$ncount.'</a></li>';
           }
      }
      $ncount=0; // resets the count

      $rater.='  </ul>';
      $rater.='<div';
      if($voted){ $rater.=' class="voted"'; }
      $rater.='>Rating: <strong> '.$rating1.' out of '.$units.'.0 </strong> (Votes: '.$count.')';
      $rater.='</div>';
      $rater.='</div>';
      $rater.='</div>';
      return $rater;
 }
}
?>
