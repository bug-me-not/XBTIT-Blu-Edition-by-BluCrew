<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Add New Seedbox IP</h4>
</div>
<form method="post" enctype="multipart/form-data" action="<tag:frm_action />" name="seedip">
<br>
<center>
SeedBox IP: <input type="text" name="ip" size="40">
    &nbsp;&nbsp;&nbsp;
		<input type="submit" class="btn btn-sm btn-primary" value="<tag:language.FRM_CONFIRM />">
		&nbsp;&nbsp;&nbsp;
		<input type="reset" class="btn btn-sm btn-warning" value="<tag:language.FRM_CANCEL />">
</center>
<br>
</form>
<div class="panel-footer">
</div>
</div>

<table class="table table-bordered">
<tr>
	<td class="head"><b>Remove</b> </td>
  <td class="head"><b>Seedbox IP</b> </td>
  <td class="head"><b>Seedbox Hostname</b> </td>
  <td class="head"><b>Acive Peers</b></td>
</tr>

<loop:seedip>
  <tr>
    <td class="lista"><tag:seedip[].remove /></td>
    <td class="lista"><tag:seedip[].ip /></td>
    <td class="lista"><tag:seedip[].host /></td>
    <td class="lista"><tag:seedip[].peers /></td>
  </tr>
</loop:seedip>
</table>
