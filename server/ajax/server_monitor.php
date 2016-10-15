<?php

error_reporting(E_ALL);

if( !isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) || ( $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest' ) ) {
	echo 'Direct access is prohibited';
	exit;
}

$hostname = php_uname('n');

if (!($os = shell_exec('/usr/bin/lsb_release -ds | cut -d= -f2 | tr -d \'"\''))) {
    if(!($os = shell_exec('cat /etc/system-release | cut -d= -f2 | tr -d \'"\''))) {
        if (!($os = shell_exec('find /etc/*-release -type f -exec cat {} \; | grep NAME | tail -n 1 | cut -d= -f2 | tr -d \'"\''))) {
            $os = 'N.A';
        }
    }
}
$os = trim($os, '"');
$os = str_replace("\n", '', $os);

if (!($kernel = shell_exec('/bin/uname -r'))) {
    $kernel = 'N.A';
}


if (!($totalSeconds = shell_exec('/usr/bin/cut -d. -f1 /proc/uptime'))) {
    $uptime = 'N.A';
}
else {
    $totalMin   = $totalSeconds / 60;
    $totalHours = $totalMin / 60;

    $days  = floor($totalHours / 24);
    $hours = floor($totalHours - ($days * 24));
    $min   = floor($totalMin - ($days * 60 * 24) - ($hours * 60));

    $uptime = '';
    if ($days != 0)
        $uptime .= $days.' day' . pluralize($days).' ';

    if ($hours != 0)
        $uptime .= $hours.' hour' . pluralize($hours).' ';

    if ($min != 0)
        $uptime .= $min.' minute' . pluralize($min);
}

if (!($upt_tmp = shell_exec('cat /proc/uptime'))) {
    $last_boot = 'N.A';
}
else {
    $upt = explode(' ', $upt_tmp);
    $last_boot = date('Y-m-d H:i:s', time() - intval($upt[0]));
}

if (!($current_users = shell_exec('who -u | awk \'{ print $1 }\' | wc -l'))){
    $current_users = 'N.A';
}

if (!($server_date = shell_exec('/bin/date'))) {
    $server_date = date('Y-m-d H:i:s');
}

## LAST LOGIN ##

$last_login = array();

if (!(exec('/usr/bin/lastlog --time 365 | /usr/bin/awk -F\' \' \'{ print $1";"$5, $4, $8, $6}\'', $users))){
    $datas[] = array(
        'user' => 'N.A',
        'date' => 'N.A',
    );
}
else{
    $max = 5;

    for ($i = 1; $i < count($users) && $i <= $max; $i++){
        list($user, $date) = explode(';', $users[$i]);

        $last_login[] = array(
            'user' => $user,
            'date' => $date,
        );
    }
}


## SWAP ##

if (!($free = shell_exec('grep SwapFree /proc/meminfo | awk \'{print $2}\''))){
    $free = 0;
}


if (!($total = shell_exec('grep SwapTotal /proc/meminfo | awk \'{print $2}\''))){
    $total = 0;
}

$used = $total - $free;

$percent_used = 100 - (round($free / $total * 100));


$swap_info = array(
    'Used'          => getSize($used * 1024),
    'Free'          => getSize($free * 1024),
    'Total'         => getSize($total * 1024),
    'Used percent'  => $percent_used,
);

## MEMORY ##

$free = 0;

if (shell_exec('cat /proc/meminfo')){
    $free    = shell_exec('grep MemFree /proc/meminfo | awk \'{print $2}\'');
    $buffers = shell_exec('grep Buffers /proc/meminfo | awk \'{print $2}\'');
    $cached  = shell_exec('grep Cached /proc/meminfo | awk \'{print $2}\'');

    $free = (int)$free + (int)$buffers + (int)$cached;
}

if (!($total = shell_exec('grep MemTotal /proc/meminfo | awk \'{print $2}\''))){
    $total = 0;
}

$used = $total - $free;

$percent_used = 100 - (round($free / $total * 100));

$memory_info = array(
    'Used'          => getSize($used * 1024),
    'Free'          => getSize($free * 1024),
    'Total'         => getSize($total * 1024),
    'Used_percent'  => $percent_used,
);


## PING ##

$ping_info = array();

$hosts = array('mysite.com', 'facebook.com', 'google.com', 'wikipedia.org', 'myserver.net');

foreach ($hosts as $host){

	$result = pingFsockopen($host, 80, 255) ;
 
    $ping_info[] = array(
        'host' => $host,
        'ping' => $result,
    );
}

function pingFsockopen($host, $port, $ttl) {
	
  $start = microtime(true);
  $fp = @fsockopen($host, $port, $errno, $errstr, $ttl);
  if (!$fp) {
    $latency = 0;
  }
  else {
    $latency = microtime(true) - $start;
    $latency = round($latency * 1000);
  }
  
  return $latency;
}

## SERVICES ##


$services = array(array('name' => 'Web Server', 'host' => 'localhost', 'port' => '80'), array('name' => 'Email Server (incoming)', 'host' => 'localhost', 'port' => '993'), array('name' => 'Email Server (outgoing)', 'host' => 'localhost', 'port' => '587'), array('name' => 'FTP Server', 'host' => 'localhost', 'port' => '21'), array('name' => 'Database Server', 'host' => 'localhost', 'port' => '3306'), array('name' => 'SSH Service', 'host' => 'localhost', 'port' => '22'));

$services_info = array();
foreach ($services as $service) {
		
	$host = $service['host'];
	$sock = @fsockopen($host, $service['port'], $num, $error, 5);

	if ($sock) {
		$services_info[] = array(
			'port'      => $service['port'],
			'name'      => $service['name'],
			'status'    => 1,
		);
            
		fclose($sock);
	}
	else {
		$services_info[] = array(
			'port'      => $service['port'],
			'name'      => $service['name'],
			'status'    => 0,
		);
	}
}

## DISK ##

$disk_info = array();

if (!(exec('/bin/df -T | awk -v c=`/bin/df -T | grep -bo "Type" | awk -F: \'{print $1}\'` \'{print substr($0,c);}\' | tail -n +2 | awk \'{print $1","$2","$3","$4","$5","$6}\'', $df))) {
    $disk_info[] = array(
        'total'         => 'N.A',
        'used'          => 'N.A',
        'free'          => 'N.A',
        'percent_used'  => 0,
        'mount'         => 'N.A',
    );
} else {
    $mounted_points = array();

    foreach ($df as $mounted) {
        list($type, $total, $used, $free, $percent, $mount) = explode(',', $mounted);

        if (!in_array($mount, $mounted_points)) {
            $mounted_points[] = trim($mount);

            $disk_info[] = array(
                'total'         => getSize($total * 1024),
                'used'          => getSize($used * 1024).'&nbsp;('.trim($percent).')',
                'free'          => getSize($free * 1024),
                'percent_used'  => trim($percent),
                'mount'         => $mount,
            );
        }
    }

}


## NETWORK INFO ##

$network_info    = array();
$network  = array();

$commands = array(
    'ifconfig' => array('ifconfig', '/sbin/ifconfig', '/usr/bin/ifconfig', '/usr/sbin/ifconfig'),
    'ip'       => array('ip', '/bin/ip', '/sbin/ip', '/usr/bin/ip', '/usr/sbin/ip'),
);

$getInterfaces_cmd = getInterfacesCommand($commands);

if (is_null($getInterfaces_cmd) || !(exec($getInterfaces_cmd, $getInterfaces))) {
    $network_info[] = array('inter_face' => 'N.A', 'ip' => 'N.A');
}
else
{
    foreach ($getInterfaces as $name) {
        $ip = null;

        $getIp_cmd = getIpCommand($commands, $name);        

        if (is_null($getIp_cmd) || !(exec($getIp_cmd, $ip))){
            $network[] = array(
                'name' => $name,
                'ip'   => 'N.A',
            );
        }
        else {
            if (!isset($ip[0])){
                $ip[0] = '';
			}	
            $network[] = array(
                'name' => $name,
                'ip'   => $ip[0],
            );
        }
    }

    foreach ($network as $interface) {
        exec('cat /sys/class/net/'.$interface['name'].'/statistics/tx_bytes', $getBandwidth_tx);
        exec('cat /sys/class/net/'.$interface['name'].'/statistics/rx_bytes', $getBandwidth_rx);

        $network_info[] = array(
            'inter_face' => $interface['name'],
            'ip'        => $interface['ip'],
            'transmit'  => getSize($getBandwidth_tx[0]),
            'receive'   => getSize($getBandwidth_rx[0]),
        );

        unset($getBandwidth_tx, $getBandwidth_rx);
    }
}


## TOP FUNCTIONS ##

// TASKS //

ob_start();
passthru("/usr/bin/top -b -n 1 | head -2 | tail -1 | awk '{print $0}'");
$output_task = ob_get_clean();
if (ob_get_contents()) ob_clean();

if (strpos($output_task,'Task') !== false) {
 $output_task = str_replace("Tasks:","",$output_task);
}

$tasksArr = explode(",", $output_task);
$tasks_info = array();
foreach ($tasksArr as $t){
	$tempArr = explode(' ', trim($t));
	$tasks_info[ucfirst($tempArr[1])] = $tempArr[0];
}

// CPU // 


ob_start();
passthru("/usr/bin/top -b -n 1 | head -3 | tail -1 | awk '{print $0}'");
$output_cpu = ob_get_clean();
if (ob_get_contents()) ob_clean();

if (strpos($output_cpu,'Cpu') !== false) {
 $output_cpu = str_replace("Cpu(s):","",$output_cpu);
}

$cpuArr = explode(",", $output_cpu);
$cpu_info = array();
foreach ($cpuArr as $t){
	$tempArr = explode('%', trim($t));
	$cpu_info['percent_'.$tempArr[1]] = $tempArr[0];
}

## ENCODE ALL DATA ##

$datas = array(
	'system_info' => array(
		'hostname'      => $hostname,
		'os'            => $os,
		'kernel'        => $kernel,
		'uptime'        => $uptime,
		'last_boot'     => $last_boot,
		'current_users' => $current_users,
		'server_date'   => $server_date),
	'last_login' => $last_login,
	'swap_info' => $swap_info,
	'memory_info' => $memory_info,
	'ping_info' => $ping_info,
	'services_info' => $services_info,
	'disk_info' => $disk_info,
	'network_info' => $network_info,
	'tasks_info' => $tasks_info,
	'cpu_info' => $cpu_info
	);

echo json_encode($datas);	
die();		

########## FUNCTIONS ##########	


function getSize($filesize, $precision = 2) {
    $units = array('', 'K', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y');
    $idUnit = 0;
    foreach ($units as $idUnit => $unit) {
        if ($filesize > 1024) {
            $filesize /= 1024;
		}
        else{ 
            break;
		}	
    }
    return round($filesize, $precision).' '.$units[$idUnit].'B';
}


function whichCommand($cmds, $args = '', $returnWithArgs = true) {
    $return = '';
    foreach ($cmds as $cmd) {
        if (trim(shell_exec($cmd.$args)) != '') {
            $return = $cmd;
      
            if ($returnWithArgs) {
                $return .= $args;
			}
            break;
        }
    }
    return $return;
}


function pluralize($nb, $plural = 's', $singular = ''){
    return $nb > 1 ? $plural : $singular;
}


function getInterfacesCommand($commands){
    $ifconfig = whichCommand($commands['ifconfig'], ' | awk -F \'[/  |: ]\' \'{print $1}\' | sed -e \'/^$/d\'');

    if (!empty($ifconfig)) {
        return $ifconfig;
    }
    else{
        $ip_cmd = whichCommand($commands['ip'], ' -V', false);

        if (!empty($ip_cmd)) {
            return $ip_cmd.' -oneline link show | awk \'{print $2}\' | sed "s/://"';
        }
        else {
            return null;
        }
    }
}


function getIpCommand($commands, $interface){
    $ifconfig = whichCommand($commands['ifconfig'], ' '.$interface.' | awk \'/inet / {print $2}\' | cut -d \':\' -f2');

    if (!empty($ifconfig)) {
        return $ifconfig;
    }
    else {
        $ip_cmd = whichCommand($commands['ip'], ' -V', false);

        if (!empty($ip_cmd)) {
            return 'for family in inet inet6; do '.
               $ip_cmd.' -oneline -family $family addr show '.$interface.' | grep -v fe80 | awk \'{print $4}\' | sed "s/\/.*//"; ' .
            'done';
        }
        else{
            return null;
        }
    }
}
