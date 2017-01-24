<?php

   $allowed_commands = array ('ls -la', 'ls', 'ls -l', 'less webconsole.css', 'less test.html', 'touch test.txt', 'cp test.html test.txt', 'less test.txt', 'rm test.txt','cd');



if (!empty($_GET['command']) && in_array($_GET['command'], $allowed_commands)) {
    $result= shell_exec($_GET['command']);
} else {
    $result.= "This demo version lets you execute shell commands only from a predefined list:\n";
    $result.= implode("\n", $allowed_commands);
}
?>
