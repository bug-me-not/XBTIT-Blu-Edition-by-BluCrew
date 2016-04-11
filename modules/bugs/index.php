<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
//    This file is part of xbtit DT FM.
//
// Report a bug by DiemThuy Dec 2011 , based on a TBDEV hack
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

ob_start();
dbconn();
global $CURUSER, $TABLE_PREFIX, $_SERVER , $SITENAME;

$HTML = "";

$action = (isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : ''));
//Here we see the bug problem.
if ($action == 'viewbug') {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if ($CURUSER["admin_access"]=="no") stderr("{$language['stderr_error']}", "{$language['stderr_only_coder']}");
$id = isset($_POST["id"]) ? $_POST["id"] : '';
$status = isset($_POST["status"]) ? $_POST["status"] : '';
if ($status == 'na') stderr("{$language['stderr_error']}", "{$language['stderr_no_na']}");
if (!$id || !is_valid_id($id)) stderr("{$language['stderr_error']}", "{$language['stderr_invalid_id']}");
$query = do_sqlquery("SELECT b.*, u.username FROM {$TABLE_PREFIX}bugs AS b LEFT JOIN {$TABLE_PREFIX}users AS u ON b.sender = u.id WHERE b.id = {$id}") or sqlerr(__FILE__, __LINE__);
while ($q = $query->fetch_assoc()) {
switch ($status) {
case 'fixed':
$msg = sqlesc("Hello {$q['username']}.\n\nYour bug: [b]{$q['title']}[/b] has been treated by our coder, and is done.\n\nWe would like to thank you and therefore we have added [b]5 GB[/b] to your upload ammount :).\n\nBest regards, {$SITENAME}'s coders.\n");
$uq = "UPDATE {$TABLE_PREFIX}users SET uploaded = uploaded +". 1024*1024*1024*5 ." WHERE id = {$q['sender']}";
break;
case 'ignored':
$msg = sqlesc("Hello {$q['username']}.\n\nYour bug: [b]{$q['title']}[/b] has been ignored by one of our coder.\n\nPossibly it was not a bug.\n\nBest regards, {$SITENAME}'s coders.\n");
$uq = "";
break;
}
quickQuery($uq);

send_pm(0,$q['sender'],sqlesc('Status update for your reported bug'),$msg);

quickQuery("UPDATE {$TABLE_PREFIX}bugs SET status='{$status}', staff='{$CURUSER['uid']}' WHERE id = {$id}");
}
redirect("index.php?page=modules&module=bugs&action=viewbug&id={$id}");

}
$id = isset($_GET["id"]) ? $_GET["id"] : '';
if (!$id || !is_valid_id($id)) stderr("{$language['stderr_error']}", "{$language['stderr_invalid_id']}");
if ($CURUSER["admin_access"]=="no") stderr("{$language['stderr_error']}", 'Only staff can view bugs.');
$as = do_sqlquery("SELECT b.*, u.username, u.id_level, staff.username AS st, staff.id_level AS stclass FROM {$TABLE_PREFIX}bugs AS b LEFT JOIN {$TABLE_PREFIX}users AS u ON b.sender = u.id LEFT JOIN {$TABLE_PREFIX}users AS staff ON b.staff = staff.id WHERE b.id = {$id}") or sqlerr(__FILE__, __LINE__);
while ($a = $as->fetch_assoc()) {
$title = htmlspecialchars($a['title']);
$added = date("d/m/Y H:i:s",$a['added']-$offset);

$xx=$a['id_level'];
$res4 = do_sqlquery("SELECT level FROM {$TABLE_PREFIX}users_level WHERE id_level ='$xx'");
$arr4 = $res4->fetch_assoc();
$strank = $arr4[level];

$addedby = "<a href='index.php?page=userdetails&id={$a['sender']}'>{$a['username']}</a> <i>(".$strank.")</i>";
switch ($a['priority']) {
case 'low':
$priority = "<font color='green'>{$language['low']}</font>";
break;
case 'high':
$priority = "<font color='red'>{$language['high']}</font>";
break;
case 'veryhigh':
$priority = "<font color='red'><b><u>{$language['veryhigh']}</u></b></font>";
break;
}
$problem = htmlspecialchars($a['problem']);
switch ($a['status']) {
case 'fixed':
$status = "<font color='green'><b>{$language['fixed']}</b></font>";
break;
case 'ignored':
$status = "<font color='#FF8C00'><b>{$language['ignored']}</b></font>";
break;
default:
$status = "<select name='status'>
<option value='na'>{$language['select_one']}</option>
<option value='fixed'>{$language['fix_problem']}</option>
<option value='ignored'>{$language['ignore_problem']}</option>
</select>";
}
switch ($a['id_level']) {
case 0:
$by = "";
break;
default:

$yy=$a['stclass'];
$res3 = do_sqlquery("SELECT level FROM {$TABLE_PREFIX}users_level WHERE id_level ='$yy'");
$arr3 = $res3->fetch_assoc();
$strankk = $arr3[level];
if ($strankk =="")
$dt="Nobody Yet";
else
$dt=$strankk;

$by = "<a href='index.php?page=userdetails&id={$a['staff']}'>{$a['st']}</a> <i>(".$dt.")</i>";
break;
}
$HTML .= "<form method='post' action='index.php?page=modules&amp;module=bugs&action=viewbug'>
<input type='hidden' name='id' value='{$a['id']}'/>
<table cellpadding='5' cellspacing='0' border='0' align='center'>
<tr><td class='rowhead'>{$language['title']}:</td><td>{$title}</td></tr>
<tr><td class='rowhead'>{$language['added']} / {$language['by']}</td><td>{$added} / {$addedby}</td></tr>
<tr><td class='rowhead'>{$language['priority']}</td><td>{$priority}</td></tr>
<tr><td class='rowhead'>{$language['problem_bug']}</td><td><textarea cols='60' rows='10' readonly='readonly'>{$problem}</textarea></td></tr>
<tr><td class='rowhead'>{$language['status']} / {$language['by']}</td><td>{$status} - {$by}</td></tr>";
if ($a['status'] == 'na') {
$HTML .= "<tr><td colspan='2' align='center'><input type='submit' value='{$language['submit_btn_fix']}' class='btn'/></td></tr>\n";
}
}
$HTML .= "</table></form><a href='index.php?page=modules&amp;module=bugs&action=bugs'>{$language['go_back']}</a>\n";
}
//This is staffs page
elseif ($action == 'bugs') {
if ($CURUSER["admin_access"]=="no") stderr("{$language['stderr_error']}", "{$language['stderr_only_staff_can_view']}");

$cc = 1;
$perpage = 3;
$pager = pager($perpage, $cc, 'index.php?page=modules&amp;module=bugs&action=bugs&amp;');
$res = do_sqlquery("SELECT b.*, u.username, staff.username AS staffusername FROM {$TABLE_PREFIX}bugs AS b LEFT JOIN {$TABLE_PREFIX}users AS u ON b.sender = u.id LEFT JOIN {$TABLE_PREFIX}users AS staff ON b.staff = staff.id ORDER BY b.id DESC {$pager['limit']}") or sqlerr(__FILE__, __LINE__);
$r = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}bugs WHERE status = 'na'");
if (sql_num_rows($res) > 0) {
$count = sql_num_rows($r);

$HTML .= "
<!--<h1 align='center'>There is <font color='#FF0000'>{$count}</font> new bug".($count > 1 ? "s" : "").". Please check them.</h1>-->
<h1 align='center'>".sprintf($language['h1_count_bugs'], $count, ($count > 1 ? "s" : ""))."</h1>
<font class='small' style='font-weight:bold;'>{$language['delete_when']}</font><br/>
<table cellpadding='10' cellspacing='0' border='0' align='center'><tr>
<td class='colhead' align='center'>{$language['title']}</td>
<td class='colhead' align='center'>{$language['added']} / {$language['by']}</td>
<td class='colhead' align='center'>{$language['priority']}</td>
<td class='colhead' align='center'>{$language['status']}</td>
<td class='colhead' align='center'>{$language['coder']}</td>
</tr>";
while ($q = $res->fetch_assoc()) {
switch ($q['priority']) {
case 'low':
$priority = "<font color='green'>{$language['low']}</font>";
break;
case 'high':
$priority = "<font color='red'>{$language['high']}</font>";
break;
case 'veryhigh':
$priority = "<font color='red'><b><u>{$language['veryhigh']}</u></b></font>";
break;
}
switch ($q['status']) {
case 'fixed':
$status = "<font color='green'><b>{$language['fixed']}</b></font>";
break;
case 'ignored':
$status = "<font color='#FF8C00'><b>{$language['ignored']}</b></font>";
break;
default:
$status = "<font color='black'><b>N/A</b></font>";
break;
}
$HTML .= "<tr>
<td align='center'><a href='index.php?page=modules&amp;module=bugs&action=viewbug&amp;id={$q['id']}'>".htmlspecialchars($q['title'])."</a></td>
<td align='center' nowrap='nowrap'>".date("d/m/Y H:i:s",$q['added']-$offset)." / <a href='index.php?page=userdetails&id={$q['sender']}'>{$q['username']}</a></td>
<td align='center'>{$priority}</td>
<td align='center'>{$status}</td>
<td align='center'>".($q['status'] != 'na' ? "<a href='index.php?page=userdetails&id={$q['staff']}'>{$q['staffusername']}</a>" : "---")."</td>
</tr>";
}
$HTML .= "</table>";

}
else
$HTML .= "{$language['no_bugs']}";
}
//Here we have our add function xD otherwise we wont receive any bugs :]
elseif ($action == 'add') {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$title = $_POST['title'];
$priority = $_POST['priority'];
$problem = $_POST['problem'];
if (empty($title) || empty($priority) || empty($problem))
stderr("{$language['stderr_error']}", "{$language['stderr_missing']}");

/*
if (strlen($problem) < 20)
stderr("{$language['stderr_error']}", "{$language['stderr_problem_20']}");
if (strlen($title) < 10)
stderr("{$language['stderr_error']}", "{$language['stderr_title_10']}");
*/

$q = do_sqlquery("INSERT INTO {$TABLE_PREFIX}bugs (title, priority, problem, sender, added) VALUES (".sqlesc($title).", ".sqlesc($priority).", ".sqlesc($problem).", {$CURUSER['uid']}, ".time().")") or sqlerr(__FILE__, __LINE__);
if ($q)
stderr("{$language['stderr_sucess']}", sprintf($language['stderr_sucess_2'], $priority));
else
stderr("{$language['stderr_error']}", "{$language['stderr_something_is_wrong']}");
}
}
else
//Default page :]
$HTML .= "<form method='post' action='index.php?page=modules&amp;module=bugs&action=add'>
<table cellpadding='5' cellspacing='0' border='0' align='center'>
<tr><td class='rowhead'>{$language['title']}:</td><td><input type='text' name='title' size='60'/><br/>{$language['proper_title']}</td></tr>
<tr><td class='rowhead'>{$language['problem_bug']}:</td><td><textarea cols='60' rows='10' name='problem'></textarea><br/>{$language['describe_problem']}</td></tr>
<tr><td class='rowhead'>{$language['priority']}:</td><td><select name='priority'>
<option value='0'>{$language['select_one']}</option>
<option value='low'>{$language['low']}</option>
<option value='high'>{$language['high']}</option>
<option value='veryhigh'>{$language['veryhigh']}</option>
</select>
<br/>{$language['only_veryhigh_when']}</td></tr>
<tr><td colspan='2' align='center'><input type='submit' value='{$language['submit_btn_send']}' class='btn'/></td></tr>
</table></form>";


print $HTML ;

global $module_out;

$module_out=ob_get_contents();
ob_end_clean();
?>
