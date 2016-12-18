<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2015  Btiteam
//
//    This file is part of xbtit DT FM.
//
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

//Free RAM Fuction
function get_memory() {
  foreach(file('/proc/meminfo') as $ri)
    $m[strtok($ri, ':')] = strtok('');
  return 100 - round(($m['MemFree'] + $m['Buffers'] + $m['Cached']) / $m['MemTotal'] * 100);
}

//Ping Function
function get_ping($ip=NULL) {
$ip = $_SERVER['REMOTE_ADDR'];
$exec = exec("ping -c 3 -s 64 -t 64 ".$ip);
$array = explode("/", end(explode("=", $exec )) );
return ceil($array[1]) . 'ms';
}

//Server IP Function
function get_ip() {
  echo $_SERVER['SERVER_ADDR'];
}

//HDD Free Space Function
function get_hdd() {
	exec("df -h",$a);
if ($start=strpos($a[1], '%')) {
$b = substr($a[1], $start-2, 3);
echo $b;
unset ($a, $b);
}
else
echo 'Error getting HDD space';
}

//CPU Model Info Function
function get_cpuinfo() {
	exec("cat /proc/cpuinfo | grep 'model name'",$a);
if ($start=strpos($a[0], ':')) {
$end=strlen($a[0])-$start;
$b = substr($a[0], $start+1, $end);
echo $b;
unset ($a, $b);
}
else
echo 'Error getting cpuinfo';
}

//Load test Function
function get_load() {
	exec("uptime",$load);
if ($start=strpos($load[0], 'age:')) {
$end=strlen($load[0])-$start;
$b = substr($load[0], $start+5, $end);
echo $b;
unset ($a, $b);
}
else
echo "Error getting load";
}

//Uptime Function
function get_uptime() {	
$uptime = shell_exec("cut -d. -f1 /proc/uptime");
$days = floor($uptime/60/60/24);
$hours = $uptime/60/60%24;
$mins = $uptime/60%60;
$secs = $uptime%60;
echo "$days days $hours hours $mins minutes and $secs seconds";
}

//Speedtest Function
function get_speedtest() {
exec("/usr/bin/wget -O /dev/null http://cachefly.cachefly.net/1mb.test 2>&1",$output);
end($output);
$a=prev($output);
if ($start=strpos($a, '(')) 
if ($end=strpos(substr($a,$start+1), ')')) {
$b = substr($a, $start+1, $end);
echo $b;
unset ($a, $b);
}
else
echo 'Error running speedtest';
}
?>