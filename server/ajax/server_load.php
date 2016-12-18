<?Php

error_reporting(E_ALL);

if( !isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) || ( $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest' ) ) {
	echo 'Direct access is prohibited';
	exit;
}

$load_tmp = shell_exec('cat /proc/loadavg | awk \'{print $1","$2","$3}\'');

if ($load_temp = '') {
    $load = array(0, 0, 0);
}
else{
	$cores = getCpuCoresNumber();	
    $load_exp = explode(',', $load_tmp);
	
    $load = array_map(
        function ($value, $cores) {			
            $v = (int)($value * 100 / $cores);
            if ($v > 100){
            	$v = 100;
            }
            return $v;
        }, 
        $load_exp,
        array_fill(0, 3, $cores)
    );
}


$loadArr['1_min'] = $load[0];
$loadArr['5_min'] = $load[1];
$loadArr['15_min'] = $load[2];

echo json_encode($loadArr);	
die();

function getCpuCoresNumber() {
    if (!($num_cores = shell_exec('/bin/grep -c ^processor /proc/cpuinfo'))) {
        if (!($num_cores = trim(shell_exec('/usr/bin/nproc')))){
            $num_cores = 1;
        }
    }
    if ((int)$num_cores <= 0){
        $num_cores = 1;
	}	
    return (int)$num_cores;
}
