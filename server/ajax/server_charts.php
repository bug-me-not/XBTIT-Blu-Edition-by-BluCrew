<?php

error_reporting(E_ALL);

if( !isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) || ( $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest' ) ) {
	echo 'Direct access is prohibited';
	exit;
}

## NETWORK ##

exec("sar -n DEV | grep -v Average | grep -v Linux |awk '{if ($0 ~ /[0-9]/) { print $1, $2, $4, $5 }  }'", $network_result);

$last_key = count($network_result) -1;
foreach($network_result as $key=>$value) {
	$tempnetworkarr = explode(' ', $network_result[$key]);
	$time = substr($tempnetworkarr[0], 0, -3);
	$device_name = $tempnetworkarr[1];
	$rxpck = $tempnetworkarr[2];
	$txpck = $tempnetworkarr[3];
	if ($key > 0 && $key <= $last_key-1){
		if ($device_name == 'eth0'){
			$network_rowsArr[] = array("c"=>array(array("v"=>$time),array("v"=>$rxpck),array("v"=>$txpck)));
		}	
	}
}

$network_colsArr = array(array("id"=>"", "label"=>"Time", "type"=>"string"),
				 array("id"=>"", "label"=>"eth0 Send", "type"=>"number"),
				 array("id"=>"", "label"=>"eth0 Receive", "type"=>"number")
		   );




## LOAD ##

@exec("sar -q | grep -v Average | grep -v Linux |awk '{if ($0 ~ /[0-9]/) { print $1, $4, $5, $6, $7; }  }'", $load_result);

foreach($load_result as $key=>$value) {

	$temparr = explode(' ', $load_result[$key]);
	$time = substr($temparr[0], 0, -3);
	$one_min_avg = $temparr[1];
	$five_min_avg = $temparr[2];
	$fifteen_min_avg = $temparr[3];

	if ($key > 0 && strpos($value, '.') !== false){
		$load_rowsArr[] = array("c"=>array(array("v"=>$time),array("v"=>$one_min_avg),array("v"=>$five_min_avg),array("v"=>$fifteen_min_avg)));	
	}	
}

$load_colsArr = array(array("id"=>"", "label"=>"Time", "type"=>"string"),
				 array("id"=>"", "label"=>"Load (1m)", "type"=>"number"),
				 array("id"=>"", "label"=>"Load (5m)", "type"=>"number"),
				 array("id"=>"", "label"=>"Load (15m)", "type"=>"number")
		   );
		   
		   
		   
## CPU ##

@exec("sar -u | grep -v Average | grep -v Linux |awk '{if ($0 ~ /[0-9]/) { print $1, $3, $5; }  }'",$cpu_result);

foreach($cpu_result as $key=>$value) {
	$tempcpuarr = explode(' ', $cpu_result[$key]);
	$time = substr($tempcpuarr[0], 0, -3);
	$user_info = $tempcpuarr[1];
	$system_info = $tempcpuarr[2];
	if ($key > 0 && strpos($value, '.') !== false){
		 $cpu_rowsArr[] = array("c"=>array(array("v"=>$time),array("v"=>$user_info),array("v"=>$system_info)));		
	}	
}

$cpu_colsArr = array(array("id"=>"", "label"=>"Time", "type"=>"string"),
				 array("id"=>"", "label"=>"User", "type"=>"number"),
				 array("id"=>"", "label"=>"System", "type"=>"number")
		   );				
		

## DISK ## 

@exec("sar -b | grep -v Average | grep -v Linux |awk '{if ($0 ~ /[0-9]/) { print $1, $3, $4, $5; }  }'", $disk_result);


$sar_records = count($disk_result);
$start_key = $sar_records - 7;

foreach($disk_result as $key=>$value) {
	$tempdiskarr = explode(' ', $disk_result[$key]);
	
	$time = substr($tempdiskarr[0], 0, -3);
	$disk_tps = $tempdiskarr[1];
	$disk_rtps = $tempdiskarr[2];
	$disk_wtps = $tempdiskarr[3];
	if ($key > 0 && $key >= $start_key && strpos($value, '.') !== false){
		$disk_rowsArr[] = array("c"=>array(array("v"=>$time),array("v"=>$disk_rtps),array("v"=>$disk_wtps)));		
	}	
}

$disk_colsArr = array(array("id"=>"", "label"=>"Time", "type"=>"string"),
				 array("id"=>"", "label"=>"Read", "type"=>"number"),
				 array("id"=>"", "label"=>"Write", "type"=>"number")
		   );
		   
		   
## DISK MONTHLY / WEEKLY ##

exec('
sar -d -p -f $file | head -3 | tail -1 | awk \'{print substr($0,12,100)}\'
for file in `ls -rt /var/log/sa/sa* | grep -v sar`
do
dt=`sar -d -p -f $file | head -1 | awk \'{print $4}\'`
echo -n $dt
sar -d -p -f $file | tail -1 | sed "s/Average:  //"
done', $output);

$month_disk_arr = array();
foreach ($output as $key=>$o){
	if ($key != 0){		
		$tempArr = explode(' ', $o);		
		$tempArr = array_filter($tempArr);
		$tempArr = array_values($tempArr);
		$month_disk_arr[$key]['date'] = $tempArr[0];
		$month_disk_arr[$key]['DEV'] = $tempArr[1];
		$month_disk_arr[$key]['tps'] = $tempArr[2];
		$month_disk_arr[$key]['rd_sec/s'] = $tempArr[3];
		$month_disk_arr[$key]['wr_sec/s'] = $tempArr[4];
		$month_disk_arr[$key]['avgqu-sz'] = $tempArr[5];	
		$month_disk_arr[$key]['await'] = $tempArr[6];	
		$month_disk_arr[$key]['svctm'] = $tempArr[7];	
		$month_disk_arr[$key]['%util'] = $tempArr[8];	
	}			
}

$sar_records = count($month_disk_arr);
$weekley_start_key = $sar_records - 7;
foreach ($month_disk_arr as $key=>$d){		
	
	$disk_monthly_rowsArr[] = array("c"=>array(array("v"=>$d['date']),array("v"=>$d['rd_sec/s']),array("v"=>$d['wr_sec/s']),array("v"=>$d['avgqu-sz']),array("v"=>$d['await']),array("v"=>$d['svctm']),array("v"=>$d['%util'])));
	
	if ($key >= $weekley_start_key){
		$disk_weekly_rowsArr[] = array("c"=>array(array("v"=>$d['date']),array("v"=>$d['rd_sec/s']),array("v"=>$d['wr_sec/s']),array("v"=>$d['avgqu-sz']),array("v"=>$d['await']),array("v"=>$d['svctm']),array("v"=>$d['%util'])));		
	}
}
		   
		   
$disk_weekly_colsArr = array(array("id"=>"", "label"=>"Date", "type"=>"string"),
		   				 array("id"=>"", "label"=>"Rd sectors/s", "type"=>"number"),
		   				 array("id"=>"", "label"=>"Wt sectors/s", "type"=>"number"),
						 array("id"=>"", "label"=>"Avarge queue", "type"=>"number"),
						 array("id"=>"", "label"=>"Wait time", "type"=>"number"),
						 array("id"=>"", "label"=>"Service time", "type"=>"number"),
						 array("id"=>"", "label"=>"Util %", "type"=>"number")
		   		   );
				   
$disk_monthly_colsArr = array(array("id"=>"", "label"=>"Date", "type"=>"string"),
				   		   	  array("id"=>"", "label"=>"Rd sectors/s", "type"=>"number"),
				   		   	  array("id"=>"", "label"=>"Wt sectors/s", "type"=>"number"),
				   			  array("id"=>"", "label"=>"Avarge queue", "type"=>"number"),
				   			  array("id"=>"", "label"=>"Wait time", "type"=>"number"),
				   			  array("id"=>"", "label"=>"Service time", "type"=>"number"),
				   			  array("id"=>"", "label"=>"Util %", "type"=>"number")

);				   
				   
				   
				   
## Monthly CPU ##

exec('
sar -u -f $file | head -3 | tail -1 | awk \'{print substr($0,12,100)}\'
for file in `ls -rt /var/log/sa/sa* | grep -v sar`
do
dt=`sar -u -f $file | head -1 | awk \'{print $4}\'`
echo -n $dt
sar -u -f $file | tail -1 | sed "s/Average:  //"
done', $output_cpu);

$month_cpu_arr = array();
foreach ($output_cpu as $key=>$o){

	if ($key != 0){
		$tempArr = explode(' ', $o);
		
		$tempArr = array_filter($tempArr);
		$tempArr = array_values($tempArr);
		$month_cpu_arr[$key]['date'] = $tempArr[0];
		$month_cpu_arr[$key]['CPU'] = $tempArr[1];
		$month_cpu_arr[$key]['user'] = $tempArr[2];
		$month_cpu_arr[$key]['nice'] = $tempArr[3];
		$month_cpu_arr[$key]['system'] = $tempArr[4];
		$month_cpu_arr[$key]['iowait'] = $tempArr[5];
		$month_cpu_arr[$key]['steal'] = $tempArr[5];	
		$month_cpu_arr[$key]['idle'] = $tempArr[5];		
	}			
}

$sar_records = count($month_cpu_arr);
$weekley_start_key = $sar_records - 7;
foreach ($month_cpu_arr as $key=>$d){		
	$cpu_monthly_rowsArr[] = array("c"=>array(array("v"=>$d['date']),array("v"=>$d['user']),array("v"=>$d['system'])));		
	if ($key >= $weekley_start_key){
		$cpu_weekly_rowsArr[] = array("c"=>array(array("v"=>$d['date']),array("v"=>$d['user']),array("v"=>$d['system'])));	
	}
}
				   
				   
$cpu_weekly_colsArr = array(array("id"=>"", "label"=>"Date", "type"=>"string"),
		   				 array("id"=>"", "label"=>"User", "type"=>"number"),
		   				 array("id"=>"", "label"=>"System", "type"=>"number")
		   		   );


## RAM MONTHLY AVARAGE ##


exec('
sar -r -f $file | head -3 | tail -1 | awk \'{print substr($0,12,100)}\'
for file in `ls -rt /var/log/sa/sa* | grep -v sar`
do
dt=`sar -r -f $file | head -1 | awk \'{print $4}\'`
echo -n $dt
sar -r -f $file | tail -1 | sed "s/Average:  //"
done', $output_ram);

$month_ram_arr = array();
foreach ($output_ram as $key=>$o){
	if ($key != 0){
		$tempArr = explode(' ', $o);			
		$tempArr = array_filter($tempArr);
		$tempArr = array_values($tempArr);
		$month_ram_arr[$key]['date'] = $tempArr[0];
		$month_ram_arr[$key]['kbmemfree'] = $tempArr[1];
		$month_ram_arr[$key]['kbmemused'] = $tempArr[2];
		$month_ram_arr[$key]['%memused'] = $tempArr[3];
		$month_ram_arr[$key]['kbbuffers'] = $tempArr[4];
		$month_ram_arr[$key]['kbcached'] = $tempArr[5];	
		$month_ram_arr[$key]['kbcommit'] = $tempArr[6];	
		$month_ram_arr[$key]['%commit'] = $tempArr[7];

	}		
}

$sar_records = count($month_ram_arr);
$weekley_start_key = $sar_records - 7;
foreach ($month_ram_arr as $key=>$d){		
	$ram_monthly_rowsArr[] = array("c"=>array(array("v"=>$d['date']),array("v"=>$d['%memused']),array("v"=>$d['%commit'])));	
	if ($key >= $weekley_start_key){
		$ram_weekly_rowsArr[] = array("c"=>array(array("v"=>$d['date']),array("v"=>$d['%memused']),array("v"=>$d['%commit'])));	
	}
}


$ram_weekly_colsArr = array(array("id"=>"", "label"=>"Date", "type"=>"string"),
		   				 array("id"=>"", "label"=>"%memused", "type"=>"number"),
		   				 array("id"=>"", "label"=>"%commit", "type"=>"number")
		   		   );



## SERVER LOCATION ##

$serverIP = $_SERVER['SERVER_ADDR']; 
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



## CPU DAILY AVARAGE ## (date specific example)

$today =  date('d'); 
exec("sar -u -s 00:00:00 -e 23:59:59 -f /var/log/sa/sa".$today." | tail -1 | awk '{print $3, $5, $8}'", $cpu_daily_avarage);

unset($tempArr);
$tempArr = explode(" ", $cpu_daily_avarage[0]);
$tempArr = array_filter($tempArr);
$tempArr = array_values($tempArr);

$cpu_avArr['User'] = $tempArr[0];
$cpu_avArr['System'] = $tempArr[1];
$cpu_avArr['Idle'] = $tempArr[2];

foreach ($cpu_avArr as $key=>$value){	
	
	if ($key != 'Idle'){
	   $value = (float)$value;
	   $cpu_daily_avarage_pie_rowsArr[] = array("c"=>array(array("v"=>$key, "f"=>null),array("v"=>$value, "f"=>null)));
	
	}
}


$cpu_daily_avarage_pie_colsArr = array(array("id"=>"", "label"=>"Source", "pattern"=>"", "type"=>"string"),
		   				 array("id"=>"", "label"=>"Value", "pattern"=>"", "type"=>"number")
		   		   );


## RAM DAILY AVARAGE ##


	
exec("sar -r | tail -1 | awk '{print $2, $5, $7}'", $ram_daily_avarage);

unset($tempArr);
$tempArr = explode(" ", $ram_daily_avarage[0]);
$tempArr = array_filter($tempArr);
$tempArr = array_values($tempArr);

$ram_avArr['kbmemfree'] = $tempArr[0];
$ram_avArr['kbbuffers'] = $tempArr[1];
$ram_avArr['kbcommit'] = $tempArr[2];

foreach ($ram_avArr as $key=>$value){	
	
	   $value = (float)$value;
	   $ram_daily_avarage_pie_rowsArr[] = array("c"=>array(array("v"=>$key, "f"=>null),array("v"=>$value, "f"=>null)));
}


$ram_daily_avarage_pie_colsArr = array(array("id"=>"", "label"=>"Source", "pattern"=>"", "type"=>"string"),
		   				 array("id"=>"", "label"=>"Value", "pattern"=>"", "type"=>"number")
		   		   );


					      
## ENCODE ALL DATA IN JSON FORMAT

$data = array(
				"network"=>array("cols"=>$network_colsArr, "rows"=> $network_rowsArr),
				"load"=>array("cols"=>$load_colsArr, "rows"=> $load_rowsArr),
				"cpu"=>array("cols"=>$cpu_colsArr, "rows"=> $cpu_rowsArr),
				"disk"=>array("cols"=>$disk_colsArr, "rows"=> $disk_rowsArr),
				"disk_weekly"=>array("cols"=>$disk_weekly_colsArr, "rows"=> $disk_weekly_rowsArr),
				"disk_monthly"=>array("cols"=>$disk_monthly_colsArr, "rows"=> $disk_monthly_rowsArr),
				"cpu_weekly"=>array("cols"=>$cpu_weekly_colsArr, "rows"=> $cpu_weekly_rowsArr),
				"ram_weekly"=>array("cols"=>$ram_weekly_colsArr, "rows"=> $ram_weekly_rowsArr),
				"server_location"=>array("cols"=>$server_locations_colsArr, "rows"=> $server_locations_rowsArr),
				"cpu_pie"=> array("cols"=>$cpu_daily_avarage_pie_colsArr,"rows"=>$cpu_daily_avarage_pie_rowsArr),
				"ram_pie"=> array("cols"=>$ram_daily_avarage_pie_colsArr,"rows"=>$ram_daily_avarage_pie_rowsArr)
);



echo json_encode($data);
die();
