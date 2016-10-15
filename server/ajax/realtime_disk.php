<?php

error_reporting(E_ALL);

if( !isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) || ( $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest' ) ) {
	echo 'Direct access is prohibited';
	exit;
}

exec("iostat -x -m | awk '/sda/ { print $6, $7, $12}'", $result);
$exp = explode(' ', $result[0]);

$i=0;
$output=array();
foreach ($exp as $res){
	if ($i == 0) { $output['rMB_each_second']=trim($res); }
	if ($i == 1) { $output['wMB_each_second']=trim($res); }
	if ($i == 2) { $output['percent_utilized']=trim($res); }
$i++;	
}
echo json_encode($output);
