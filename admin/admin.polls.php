<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2013  Btiteam
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

if (!defined("IN_BTIT"))
      die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");



/* Admin tool for the Ajax poller script */

// include language file
include(load_language("lang_polls.php"));


$id = "";
if(isset($_POST['ID']))$id = $_POST['ID'];    // Opened by form submission
if(isset($_GET['id']))$id = $_GET['id'];    // Opened from list
if(isset($_GET['votes']))$votes = $_GET['votes'];  // Opened from list
if(isset($_GET['voters']))$voters = $_GET['voters'];  // Opened from list
if(isset($_POST['active']))$active = $_POST['active'];  // Opened from list
if(isset($_POST['cancel']))$id = "";

if(isset($_POST['delete'])){
  $pollObj = new poll();
  $pollObj->table_prefix=$TABLE_PREFIX;
  $pollObj->deletePoll($_POST['ID']);

}

if(isset($_POST['save'])){
  $pollObj = new poll();
  $pollObj->table_prefix=$TABLE_PREFIX;


  if(empty($_POST['ID'])){ // new poll
    if(isset($_POST['pollerTitle'])){
      $id = $pollObj->createNewPoller($_POST['pollerTitle'],$_POST['userid'],$active);
      for($no=0;$no<count($_POST['pollOption']);$no++){
        if(!empty($_POST['pollOption'][$no])){
          $pollObj->addPollerOption($_POST['pollOption'][$no],$no);
        }
      }

    }else{
      $error_message = "".$language["POLL_TITLE_MISSING"]."";
    }
  }else{  // Update existing poll
    $pollObj->setId($_POST['ID']);  // Setting id
    if(isset($_POST['pollerTitle'])) $pollObj->setPollerTitle($_POST['pollerTitle']);
    if(isset($_POST['active'])) $pollObj->setPollerActive($_POST['active']);
    foreach($_POST['existing_pollOption'] as $key=>$value){
      if(!empty($_POST['existing_pollOption'][$key]))  $pollObj->setOptionData($_POST['existing_pollOption'][$key],$_POST['existing_pollOrder'][$key],$key);
    }

    $maxOrder = $pollObj->getMaxOptionOrder() + 1;
    for($no=0;$no<count($_POST['pollOption']);$no++){
      if(!empty($_POST['pollOption'][$no])){
        $pollObj->addPollerOption($_POST['pollOption'][$no],$maxOrder);
        $maxOrder++;
      }
    }

  }

  redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=poller");
  die();
}


$admintpl->set("frm_action","index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=poller");
$admintpl->set("language",$language);
$admintpl->set("poll_script","<script type=\"text/javascript\" src=\"$BASEURL/jscript/ajax-poller-admin.js\"></script>");
$polls=array();

// Show a list of all the polls
if(!isset($_POST['new']) && empty($id) && !isset($votes)){

  $block_title=$language["POLLING_SYSTEM"] . " - ".$language["CURRENT_POLLS"];

   //mysql query to select all information on polls in the database
   $res = do_sqlquery("SELECT p.*, username, prefixcolor, suffixcolor, COUNT(memberID) FROM {$TABLE_PREFIX}poller p LEFT JOIN {$TABLE_PREFIX}users u ON p.starterID=u.id LEFT JOIN {$TABLE_PREFIX}users_level ul on u.id_level=ul.id_level LEFT JOIN {$TABLE_PREFIX}poller_vote pv on p.id=pv.pollerID GROUP BY p.ID DESC",true);

   $i=0;
   while($inf = $res->fetch_array()){
      //background color for the current active poll
      $bold = "normal";
      if ($inf["active"]== "yes") $bold = "bold";

      //link color for number of votes
      $votescolor = linkcolor($inf["COUNT(memberID)"]);

      //ending date color for inactive polls
      if ($inf["endDate"] == "0")
        $endDate = "<span style=\"color:green\">".$language["POLL_STILL_ACTIVE"]."</span>";
      else
        $endDate = "<span style=\"color:red\">".get_date_time($inf["endDate"])."</span>";

      //find out how long a poll has been active
      if ($inf["endDate"] >= "1")
        {
          $lasted = $inf["endDate"]-$inf["startDate"];
          $duration = DateFormat($lasted);
        }
      else
          $duration = "<span style=\"color:green\">".$language["POLL_STILL_ACTIVE"]."</span>";

      //color for poll state (active or not)
      if ($inf["active"] == "yes")
        $active = "<span style=\"color:#009900\">".$language["YES"]."</span>";
      else
        $active = "<span style=\"color:orange\">".$language["NO"]."</span>";

      //votes per day
      $elapseddays = max(1, round( ( time() - $inf["startDate"] ) / 86400 ));
      $votes_per_day = number_format(round($inf["COUNT(memberID)"] / $elapseddays,2),2);

      //link for votes page
      if ($inf["COUNT(memberID)"] == "0")
        $vote = "<span style=\"color:".linkcolor($inf["COUNT(memberID)"])."\">".$inf["COUNT(memberID)"]."</span>";
      else
        $vote = "<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=poller&amp;votes=".$inf["ID"]."&amp;voters=".$inf["COUNT(memberID)"]."\"><span style=\"color:".linkcolor($inf["COUNT(memberID)"])."\">".$inf["COUNT(memberID)"]." (".$votes_per_day."/day)</span></a>";

      //print information row about poll
      $polls[$i]["bold"]=$bold;
      $polls[$i]["id"]=$inf["ID"];
      $polls[$i]["startdate"]=get_date_time($inf["startDate"]);
      $polls[$i]["enddate"]=$endDate;
      $polls[$i]["duration"]=$duration;
      $polls[$i]["pollertitle"]="<a href=\"index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=poller&amp;id=".$inf["ID"]."\">".$inf["pollerTitle"]."</a>";
      $polls[$i]["starter"]="<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$inf["starterID"]."_".strtr($inf["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$inf["starterID"])."'>".StripSlashes($inf["prefixcolor"].$inf["username"].$inf["suffixcolor"])."</a>";
      $polls[$i]["active"]=$active;
      $polls[$i]["vote"]=$vote;

      $i++;
   }
   $admintpl->set("show_poller",false,true);
   $admintpl->set("new_poll",false,true);
   $admintpl->set("polls",$polls);
}


/***
* Show a new poll or edit a poll
***/

if(isset($_POST['new']) || !empty($id))
{

  $pollObj = new poll();
  $pollObj->table_prefix=$TABLE_PREFIX;

  if(!empty($id)){
    $pollObj->getDataById($id);
    $pollerOptions = $pollObj->getOptionsAsArray();
    $votes = $pollObj->getVotesAsArray();
    $title = "".$pollObj->pollerTitle."";
    if($pollObj->active == "yes")
      $check1 = "checked=\"checked\"";
    else
      $check1 = "";

    if($pollObj->active == "no")
      $check2 = "checked=\"checked\"";
    else
      $check2 = "";

  }else{
    $pollerOptions = array();
    $votes = array();
    $title = unesc($language["POLL_START_NEW"]);
      $check1 = "checked=\"checked\"";
      $check2 = "";
  }


  $block_title=$language["POLLING_SYSTEM"] . " - $title";

  $admintpl->set("poll_id",$pollObj->ID);
  $admintpl->set("poll_user_id",$CURUSER["uid"]);
  $admintpl->set("poll_title",$pollObj->pollerTitle);
  $admintpl->set("checked_active_yes",$check1);
  $admintpl->set("checked_active_no",$check2);


    if(!isset($_POST['new']))
    $i=0;
    foreach($pollerOptions as $key=>$value)
      {

        $polls[$i]["key"]=$key;
        $polls[$i]["option_0"]=$pollerOptions[$key][0];
        $polls[$i]["option_1"]=$pollerOptions[$key][1];
        $polls[$i]["votes"]=(isset($votes[$key])?$votes[$key]:0);
        $i++;

      }

    if(empty($id))
      {
        $countInputs = 10;
      }
    else
      {
        $countInputs = 3;
      }

    $newpolls=array();
    for($no=0;$no<$countInputs;$no++)
        $newpolls[$no]["no"]=$no;

    if(!empty($id))
       $admintpl->set("poll_delete",true,true);
    else
       $admintpl->set("poll_delete",false,true);

   $admintpl->set("show_poller",false,true);
   $admintpl->set("new_poll",true,true);
   $admintpl->set("polls",$polls);
   $admintpl->set("new_polls",$newpolls);
}


/***
* Show poll voters
***/

if(isset($votes) && !isset($_POST['new']) && empty($id))
  {

    //Per Page Listing Limitation Start - 7:29 PM 3/22/2007
    $count = $voters;
    $perpage = $GLOBALS["votesppage"];
    list($pagertop, $pagerbottom, $limit) = pager($perpage, $count,  "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=poller&amp;votes=".$votes."&amp;voters=".$voters."&amp;".$addparams);
    //Per Page Listing Limitation Stop


    //mysql query to select all information on polls in the database
    $resource = do_sqlquery("SELECT pv.*, username, prefixcolor, suffixcolor, optionText, defaultChecked FROM {$TABLE_PREFIX}poller_vote pv LEFT JOIN {$TABLE_PREFIX}users u ON pv.memberID=u.id LEFT JOIN {$TABLE_PREFIX}users_level ul on u.id_level=ul.id_level LEFT JOIN {$TABLE_PREFIX}poller_option po on pv.optionID=po.ID WHERE pv.pollerID='".$votes."' GROUP BY pv.voteDate ".$limit."",true);

    $block_title=$language["POLLING_SYSTEM"]." - ".$language["POLL_VOTERS"];

    //Per Page Listing Limitation Start - 7:35 PM 3/22/2007
    if ($count > $perpage)
      $admintpl->set("poll_pager_top",$pagertop);
      else
        $admintpl->set("poll_pager_top","");
    //Per Page Listing Limitation Stop

    $i=0;
    while($results = $resource->fetch_assoc())
      {
        //background color for checked poll option
        $bold = "normal";
        if ($CURUSER["uid"] == $results["memberID"]) $bold = "bold";

        //
        if (!$results["username"])
          $user = $language["POLL_ACCOUNT_DEL"];
        else
          $user = "<a href='".(($btit_settings["fmhack_SEO_panel"]=="enabled" && $res_seo["activated_user"]=="true")?$results["memberID"]."_".strtr($results["username"], $res_seo["str"], $res_seo["strto"]).".html":"index.php?page=userdetails&id=".$results["memberID"])."'>".StripSlashes($results["prefixcolor"].$results["username"].$results["suffixcolor"])."</a>";

        //print rows with voters
        $polls[$i]["option_text"]=$results["optionText"];
        $polls[$i]["ip_address"]=long2ip($results["ipAddress"]);
        $polls[$i]["vote_date"]=get_date_time($results["voteDate"]);
        $polls[$i]["user"]=$user;
        $polls[$i]["bold"]=$bold;

        $i++;

      }

      //Per Page Listing Limitation Start - 7:35 PM 3/22/2007
      if ($count > $perpage)
        $admintpl->set("poll_pager_bottom",$pagerbottom);
      else
        $admintpl->set("poll_pager_bottom","");
          //Per Page Listing Limitation Stop


       $admintpl->set("show_poller",true,true);
       $admintpl->set("new_poll",false,true);
       $admintpl->set("polls",$polls);
  }

?>
