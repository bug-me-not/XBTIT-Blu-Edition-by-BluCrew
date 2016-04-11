<?php

if(strcmp(strtoupper(substr(PHP_OS, 0, 3)), "WIN") == 0) {
   // Windows commands
   $allowed_commands = array ('cd', 'dir', 'more webconsole.css', 'more test.html', 'copy test.html test.txt', 'more test.txt', 'del test.txt');
} else {
   // Linux, Mac OS X, etc. commands
   $allowed_commands = array ('ls -la', 'ls', 'ls -l', 'less webconsole.css', 'less test.html', 'touch test.txt', 'cp test.html test.txt', 'less test.txt', 'rm test.txt');
}


$return = array('command' => $_GET['command']);

if (!empty($_GET['command']) && in_array($_GET['command'], $allowed_commands)) {
    $result = array();
    exec($_GET['command'], $result);
    if (!empty($result)) {
        $return['result'] = $result;
    } else {
        $return['result'] = array('No output from this command. A syntax error?');
    }
} else {

    $return['result'] = $allowed_commands;
    array_unshift(
        $return['result'],
        'This demo version lets you execute shell commands only from a predefined list:'
    );
}

echo json_encode($return);

?>