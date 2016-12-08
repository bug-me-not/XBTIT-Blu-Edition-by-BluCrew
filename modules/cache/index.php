<?php
/////////////////////////////////////////////////////////////////////////////////////
//
//  Cache Module
//
////////////////////////////////////////////////////////////////////////////////////
ob_start();
global $CURUSER;
if($CURUSER["delete_users"]!="yes")
die("non direct access!");

$act=isset($_GET["action"])?htmlspecialchars($_GET["action"]):$act='';


$returnto = "index.php?page=modules&module=cache";

if($act == 'send')
{
	$settings["cache_version"]=isset($_POST["cache_version"])?intval(0+$_POST["cache_version"]):$settings["cache_version"]=1;
	$settings["cache_duration"]=isset($_POST["cache_duration"])?intval(0+$_POST["cache_duration"]):$settings["cache_version"]=0;
	
    
	foreach($settings as $key=>$value)
          {
              if (is_bool($value))
               $value==true ? $value='true' : $value='false';

            $values[]="(".sqlesc($key).",".sqlesc($value).")";
        }
		$Match = "cache_";
        do_sqlquery("DELETE FROM {$TABLE_PREFIX}settings WHERE `key` LIKE '%".$Match."%'",true);
        do_sqlquery("INSERT INTO {$TABLE_PREFIX}settings (`key`,`value`) VALUES ".implode(",",$values).";",true);
        header("Location: $BASEURL/$returnto");		
}
else
{
    $Match = "cache_";
	$btit_settings=get_fresh_config("SELECT `key`,`value` FROM {$TABLE_PREFIX}settings where `key` LIKE '%".$Match."%'");
	if (class_exists('Memcache')) {  
    $memcache = new Memcache;  
    $isMemcacheAvailable = @$memcache->connect('localhost');  
} 
if ($isMemcacheAvailable) 
        $memcache = new Memcache;//test we can connect!

if(class_exists('Memcache') && function_exists('memcache_connect') && extension_loaded('memcache') && $memcache->connect('localhost', 11211)){
$use_mem='<div class="alert alert-dismissable alert-bg-white alert-success">
<button data-dismiss="alert" class="close" type="button">×</button>
<div class="icon"><i class="fa fa-check"></i></div>
<strong><p class="text-success">Memcached is enabled and running on your server! <img src="images/smilies/thumbsup.gif"></p></strong>
</div>
</div>';
$disabled='';
}else{
$use_mem='<div class="alert alert-dismissable alert-bg-white alert-danger">
<button data-dismiss="alert" class="close" type="button">×</button>
<div class="icon"><i class="fa fa-times"></i></div>
<strong><p class="text-danger">Memcached is not enabled or running on this server! <img src="images/smilies/sad.gif"></p></strong>
</div>
</div>';
$disabled='disabled';
}


echo'<div align="center" style="align:center;">'.$use_mem.'</div>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Cache Settings</h4>
</div>
<form method="post" action="index.php?page=modules&amp;module=cache&amp;action=send">
<table class="table table-bordered">
<tr>
<td class="block" colspan="2" style="text-align:center">Cache Settings</td></tr>
<tr>
<td class=header>'.$language["CACHE_SITE"].'</td><td class="lista"><input type="text" name="cache_duration" value="'.$btit_settings["cache_duration"].'" size="10" /></td></tr>
<tr>
<td class=header>Cache Type (1:File 2:Memcached):</td><td class="lista"><input type="text" name="cache_version" value="'.$btit_settings["cache_version"].'" size="10" '.$disabled.'/></td></tr></table>
<div class="panel-footer">
</div>
</div>
<tr>
<td colspan="2" class="header" style="text-align:center;"><input type="submit" class="btn btn-md btn-success" value="'.$language["SUBMIT"].'"></td>
</tr></form>';
	
}
$module_out=ob_get_contents();
ob_end_clean();
?>