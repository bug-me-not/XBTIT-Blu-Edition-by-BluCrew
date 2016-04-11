<?php
require"include/functions.php";
dbconn(false);
global $CURUSER;

if($CURUSER["delete_users"]=="yes"){

   $allowed_commands = array ('ls', 'ls -l','sh sxd/backup.sh');

if (!empty($_GET['command']) && in_array($_GET['command'], $allowed_commands)) {
    echo shell_exec($_GET['command']);

} else {
echo"This demo version lets you execute shell commands only from a predefined list:\n";
    echo implode("\n", $allowed_commands);
    
}
}else{
die("You dont have the Permissions!");
}
?>