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

class poll {
  var $ID;
  var $pollerTitle;
  var $table_prefix;

  function poll() {
    global $TABLE_PREFIX;
    $this->ID='';
    $this->pollerTitle='';
    $this->table_prefix=$TABLE_PREFIX;
  }

  function setId($id) {
    $this->ID=$id;
  }

  function getDataById($id) {
    $res = do_sqlquery("select * from {$this->table_prefix}poller where ID='$id'");
    if($inf = $res->fetch_array()) {
      $this->ID = $inf['ID'];
      $this->pollerTitle = $inf['pollerTitle'];
      $this->active = $inf['active'];
    }
  }

  /* This method returns poller options as an associative array */
  function getOptionsAsArray() {
    $retArray = array();
    $res = do_sqlquery("select * from {$this->table_prefix}poller_option where pollerID='".$this->ID."' order by pollerOrder");
    while($inf = $res->fetch_array())
      $retArray[$inf['ID']] = array($inf['optionText'],$inf['pollerOrder']);
    return $retArray;
  }

  /* This method returns number of votes as an associative array */
  function getVotesAsArray() {
    $retArray = array();
    $res = do_sqlquery("select v.optionID,count(v.ID) as countVotes from {$this->table_prefix}poller_vote v,{$this->table_prefix}poller_option o where v.optionID = o.ID and o.pollerID = '".$this->ID."' group by v.optionID");
    while($inf = $res->fetch_array())
      $retArray[$inf['optionID']] = $inf['countVotes'];
    return $retArray;
  }

  /* Create new poller and return ID of new poller */
  function createNewPoller($pollerTitle,$userid,$active) {
    global $db;

    $pollerTitle=sql_esc($pollerTitle);

    if ($active == 'yes') {
      quickQuery("UPDATE {$this->table_prefix}poller SET active='no', endDate=UNIX_TIMESTAMP() WHERE poller.active='yes'");
      quickQuery("insert into {$this->table_prefix}poller(pollerTitle,starterID,active,startDate)values('$pollerTitle','$userid','yes',UNIX_TIMESTAMP())") or die(sql_error());
    } elseif  ($active == 'no')
      quickQuery("insert into {$this->table_prefix}poller(pollerTitle,endDate,starterID,active,startDate)values('$pollerTitle',UNIX_TIMESTAMP(),'$userid','no',UNIX_TIMESTAMP())") or die(sql_error());

    $this->ID=sql_insert_id();
    return $this->ID;
  }

  /* Add poller options */
  function addPollerOption($optionText,$pollerOrder) {
    $optionText=sql_esc($optionText);
    quickQuery("insert into {$this->table_prefix}poller_option(pollerID,optionText,pollerOrder)values('".$this->ID."','".$optionText."','".$pollerOrder."')") or die(sql_error());
    return sql_insert_id();
  }

  /* Delete a poll, options in the poll and votes */
  function deletePoll($pollId) {
    quickQuery("delete from {$this->table_prefix}poller where ID='$pollId'");
    $res = do_sqlquery("select * from {$this->table_prefix}poller_option where pollerID='".$pollId."'");
    while($inf = $res->fetch_array()) {
      quickQuery("delete from {$this->table_prefix}poller_vote where optionID='".$inf['ID']."'");
      quickQuery("delete from {$this->table_prefix}poller_option where ID='".$inf['ID']."'");
    }
  }

  /* Updating poll title */
  function setPollerTitle($pollerTitle) {
    $pollerTitle=sql_esc($pollerTitle);
    quickQuery("update {$this->table_prefix}poller set pollerTitle='$pollerTitle' where ID='".$this->ID."'");
  }

  function setPollerActive($pollerActive) {
    if ($pollerActive == 'yes')
      quickQuery("UPDATE {$this->table_prefix}poller SET endDate=UNIX_TIMESTAMP(), active='no' WHERE poller.active='yes'");
    quickQuery("UPDATE {$this->table_prefix}poller SET endDate='0', active='$pollerActive' WHERE ID='".$this->ID."'");
  }

  /* Update option label */
  function setOptionData($newText,$order,$optionId) {
    $newText=sql_esc($newText);
    quickQuery("update {$this->table_prefix}poller_option set optionText='".$newText."',pollerOrder='$order' where ID='".$optionId."'");
  }

  /* Get position of the last option, i.e. to append a new option at the bottom of the list */
  function getMaxOptionOrder() {
    $res = do_sqlquery("select max(pollerOrder) as maxOrder from {$this->table_prefix}poller_option where pollerID='".$this->ID."'") or die(sql_error());
    if($inf = $res->fetch_array())
      return $inf['maxOrder'];
    return 0;
  }
}
?>
