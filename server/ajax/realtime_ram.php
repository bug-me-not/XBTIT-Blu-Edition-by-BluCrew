<?php

error_reporting(E_ALL);

if( !isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) || ( $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest' ) ) {
	echo 'Direct access is prohibited';
	exit;
}

exec('vmstat -s', $result);

$i=0;
$output=array();	
foreach ($result as $res){
	$num = preg_replace("/[^0-9]/","",$res);
	$str = preg_replace("/[^-A-Za-z?! ]/","",$res);
	$str = str_replace(" ","_", trim($str));
	$output[trim($str)]=trim($num);
$i++;	
}
echo json_encode($output);

die();