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



function in($file, $string) {
  $check = strpos($file, $string, 0);
  if ($check != 0) return true;
  return false;
} 

if($btit_settings["php_log_path"]=="/full/path/to/the/web/root/include/logs")
    $btit_settings["php_log_path"]=$THIS_BASEPATH."/include/logs";
	  
$action=isset($_GET["action"])?htmlentities($_GET["action"]):$action='';
$returnto = "index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=php_log";
switch($action)
{
case 'clear':

$today=date("d.m.y");
foreach (glob($btit_settings["php_log_path"]."/".$btit_settings["php_log_name"]."*.log") as $logname)
        if(!in($logname,$today))
		unlink($logname);
		header("Location: $BASEURL/$returnto");
break;

case 'save':
    
	(isset($_POST["php_log_path"]) && !empty($_POST["php_log_path"])) ? $log_settings["php_log_path"]=sql_esc(str_replace("\\", "/", $_POST["php_log_path"])) : $log_settings["php_log_path"]="";
	$log_settings["php_log_name"]=isset($_POST["php_log_name"])?sql_esc(htmlentities($_POST["php_log_name"])):$log_settings["php_log_name"]="";
	$log_settings["php_log_lines"]=isset($_POST["php_log_lines"])?sql_esc(intval(0+$_POST["php_log_lines"])):$log_settings["php_log_lines"]="";
    
	foreach($log_settings as $key=>$value)
          {
              if (is_bool($value))
               $value==true ? $value='true' : $value='false';

            $values[]="(".sqlesc($key).",".sqlesc($value).")";
        }
		$Match = "php_log_";
        quickQuery("DELETE FROM {$TABLE_PREFIX}settings WHERE `key` LIKE '%".$Match."%'") or stderr($language["ERROR"],sql_error());
        quickQuery("INSERT INTO {$TABLE_PREFIX}settings (`key`,`value`) VALUES ".implode(",",$values).";") or stderr($language["ERROR"],sql_error());
        header("Location: $BASEURL/$returnto");
break;

case '':
default;
      $new=array();
	  $j=0;
      $num_lines=$btit_settings["php_log_lines"];
      $log=$btit_settings["php_log_path"]."/".$btit_settings["php_log_name"]."_".date("d.m.y")."_.log";
      $admintpl->set("language",$language);
	  if(file_exists($log))//check first otherwise more errors
	  {
	  // Open file and read contents
      $fd=fopen($log, "r");
      $data=fread($fd, filesize($log));
      fclose($fd);
      // Create an array out of each line
      $data_array=explode("\n", $data);
      // Find the last key in the array
      $last_key=count($data_array)-1;
      // If the last line is empty revise the last key downwards until there's actually something there
      while(empty($data_array[$last_key]))
      {
      $last_key-=1;
      }
      // Figure out the first key based upon the value set for the number of lines to display
      $first_key=$last_key-($num_lines-1);
      // Start a new array to store the last X lines in
      $final_array=array();
      // Work through the array and only add the last X lines to it.
      foreach($data_array as $key => $value)
      {
      if($key >= $first_key && $key <= $last_key)
      {
      $final_array[]=$value;
      }
      }
     // Output the final data
     foreach ($final_array as $value)
     {
      $new[$j]["line"]= $value."\n";
	  $j++;
     }
	 $admintpl->set("error_logs",$new);
	 }
	 else{
	 //nothing
	 }
	  $admintpl->set("error_log_exists",(file_exists($log)?true:false),true);
	  $Match = "php_log_";
	  $loglist=get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}settings where `key` LIKE '%".$Match."%'");
	  $exp=explode("/", str_replace("\\", "/", $THIS_BASEPATH));
      $last_key=(count($exp)-1);
      unset($exp[$last_key]);
	  $exp=str_replace($find,$replace,$exp);
      $recommended=implode("/",$exp)."/xbtit-error-logs";
      $loglist["php_log_path_find"]=$recommended;
	  $admintpl->set("frm_action", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=php_log&amp;action=save");
	  $admintpl->set("config",$loglist);
	  $today=date("d.m.y");
	  $list=array();
	  $i=0;
	  foreach (glob($btit_settings["php_log_path"]."/".$btit_settings["php_log_name"]."*.log") as $logname){
	  $logname=str_replace($btit_settings["php_log_path"]."/","",$logname);
	  if(!in($logname,$today))
	  $list[$i]["file"]=$logname."<br />";
	  $i++;
	  }
	  $admintpl->set("list",$list);
	  $admintpl->set("flush","<a href='index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=php_log&amp;action=clear'>".$language["LOGS_COOLY_FLUSH"]."");
break;
}
?>