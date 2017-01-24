<?php

error_reporting(E_ALL);

if( !isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) || ( $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest' ) ) {
	echo 'Direct access is prohibited';
	exit;
}

## SERVER LOCATION ##

$serverIP = $_SERVER['SERVER_ADDR']; // the IP address to query
$server_query = @unserialize(file_get_contents('http://ip-api.com/php/'.$serverIP));
if($server_query && $server_query['status'] == 'success') {
	$server_country = $server_query['country'];
}
else{
	$server_country = 'United Kingdom';
}

$server_locations_rowsArr[0] = array("c"=>array(array("v"=>$server_country),array("v"=>1)));	


$server_locations_colsArr = array(array("id"=>"", "label"=>"Country", "type"=>"string"),
		   				 		  array("id"=>"", "label"=>"Servers", "type"=>"number"),
		   		   );
	
	
$data = array("server_location"=>array("cols"=>$server_locations_colsArr, "rows"=> $server_locations_rowsArr));	
echo json_encode($data);
die();	
