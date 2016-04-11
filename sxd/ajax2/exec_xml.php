<?php


   // Linux, Mac OS X, etc. commands
   $allowed_commands = array ('ls -la', 'ls', 'ls -l', 'less webconsole.css', 'less test.html', 'touch test.txt', 'cp test.html test.txt', 'less test.txt', 'rm test.txt','sh /home/pub/sxd/backup.sh');



header('Content-Type: text/xml');
echo '<?xml version="1.0" ?>' . "\n";
echo '<exec>' . "\n";
echo '<command>' . htmlentities($_GET['command']) . '</command>' . "\n";
echo '<result>';
if (!empty($_GET['command']) && in_array($_GET['command'], $allowed_commands)) {
    $result = array();
    exec($_GET['command'], $result);
    if (!empty($result)) {
        $result = array_map('htmlentities', $result);
        echo '<line>';
        echo implode("</line>\n<line>", $result);
        echo '</line>';
    } else {
        echo '<line>No output from this command. A syntax error?</line>';
    }
} else {
    echo "<line>This demo version lets you execute shell commands only from a predefined list:</line>\n";
    echo '<line>';
    echo implode("</line>\n<line>", $allowed_commands);
    echo '</line>';
}
echo '</result>' . "\n";
echo '</exec>';
?>
