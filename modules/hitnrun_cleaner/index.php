<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2014  Btiteam
//
// This file is part of xbtit DT FM.
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
$action=isset($_GET["action"])?htmlentities($_GET["action"]):$action='';
$user=isset($_GET["user"]) && is_numeric($_GET["user"])?intval(0+$_GET["user"]):$user=0;
if($CURUSER["delete_users"]!="yes")
die();
switch($action)
{
case 'all':
information_msg("Hold on","Are you sure you want to empty all hit n runs? <a href='index.php?page=modules&amp;module=hitnrun_cleaner&amp;action=all_yes'>Yes</a>&nbsp;<a href='javascript:history.back();'>No</a>");
break;
case 'user_all':
if($user>0)
{
do_sqlquery("UPDATE `{$TABLE_PREFIX}history` SET `hit`='no' WHERE `uid`=".$user.";",true);
header("refresh:6;url=index.php?page=modules&module=hitnrun_cleaner");
success_msg("Done","The user should have none now!");
}
break;
case 'all_yes':
do_sqlquery("UPDATE `{$TABLE_PREFIX}history` SET `hit`='no' WHERE `uid`>1;",true);
header("refresh:6;url=index.php?page=modules&module=hitnrun_cleaner");
success_msg("Done","All hit n runs cleared! :O");
break;
case '':
?>
<script type="text/javascript">
$(document).ready(function(){
    $("#uid_check").keyup(function(){
		var value = this.value;
		 $("#uload").empty().html('<img src="./modules/hitnrun_cleaner/loader.gif" />');
        $("#uload").load("./modules/hitnrun_cleaner/uload.php?user="+value);
    });

})
</script>
<?php
echo'
<center>
<form method="get" action="index.php">
<input type="hidden" name="page" value="modules">
<input type="hidden" name="module" value="hitnrun_cleaner">
<input type="hidden" name="action" value="user_all">
<table class="table table-bordered">
<p class= "text-warning">Delete A Users Hit & Runs</p>
<td class="lista" style="text-align:center;">Userid:<input id="uid_check" type="text" size="10" name="user" class="form-control">&nbsp;&nbsp;&nbsp;&nbsp;<span id="uload"></span></td>
</tr>
<tr>
<td class="lista" style="text-align:center;"><input type="submit" class="btn btn-primary" value="GO"></td>
</tr>
</table>
</form>
</center>';

if ($CURUSER["admin_access"]=="yes"){

echo'
<center>
<br /><table class="table table-bordered">
<p class= "text-danger">Delete All Users Hit & Runs</p>
</tr>
<td class="lista" style="text-align:center;"><a href="index.php?page=modules&amp;module=hitnrun_cleaner&amp;action=all"><button class="btn btn-primary">GO</button></a></td>
</tr>
</table>
<br />
</center>';
}
default;
break;
}
$module_out=ob_get_contents();
ob_end_clean();
?>