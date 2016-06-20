<?php

if($_GET['tester']!="akljhdaksljhdkjlashdkljasdjlkahsdkjlashdshjalhdsaj")
	die("blah blah blah");

require dirname(__FILE__).'/include/functions.php';

$res = do_sqlquery('SELECT u.id, u.warn_lev FROM blurg_users u LEFT JOIN blurg_warn_logs w ON w.uid=u.id WHERE u.warn_lev > 0 && (w.notes LIKE "%13th June 2016%" OR w.notes LIKE "%12th June 2016%" OR w.notes LIKE "%11th June 2016%" OR w.notes LIKE "%10th June 2016%" OR w.notes LIKE "%9th June 2016%" OR w.notes LIKE "%8th June 2016%" OR w.notes LIKE "%7th June 2016%"OR w.notes LIKE "%6th June 2016%" OR w.notes LIKE "%5th June 2016%" OR w.notes LIKE "%4th June 2016%") GROUP BY u.id ORDER BY w.date_added DESC');

echo "hnr: ". sql_num_rows($res);

echo "\n\n\n<table><tr><td>ID</td><td>Warn</td><td>Run</td></tr>";
while($hnr = $res->fetch_assoc())
{
	$id = $hnr['id'];
	$warn = $hnr['warn_lev'];

	echo "<tr><td>{$id}</td><td>{$warn}</td>";

	quickquery("INSERT INTO blurg_warn_logs (uid,notes,contact,date_added,type,added_by) VALUES ({$id},'Per Gaart','none',NOW(),'desc',23027)") or die("error");
	quickquery("UPDATE blurg_users SET warn_lev= warn_lev-1 WHERE id =".$id) or die("error1");
	echo "<td>run<td></tr>";
}

echo "</table>";


$res = do_sqlquery('SELECT u.id, u.warn_lev FROM blurg_users u LEFT JOIN blurg_warn_logs w ON w.uid=u.id WHERE u.warn_lev > 0 && (w.notes LIKE "%13th June 2016%" OR w.notes LIKE "%12th June 2016%" OR w.notes LIKE "%11th June 2016%" OR w.notes LIKE "%10th June 2016%" OR w.notes LIKE "%9th June 2016%" OR w.notes LIKE "%8th June 2016%" OR w.notes LIKE "%7th June 2016%"OR w.notes LIKE "%6th June 2016%" OR w.notes LIKE "%5th June 2016%" OR w.notes LIKE "%4th June 2016%") GROUP BY u.id ORDER BY w.date_added DESC');

echo "\n\n\nhnr: ". sql_num_rows($res);
?>