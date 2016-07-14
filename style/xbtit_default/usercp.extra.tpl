<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Change Signature</h4>
</div>
<form method="post" action="<tag:frm_action />" name="user_extras">
<center>
<table class="table table-bordered">
<if:isSMF>
<tr>
<td class="header"><tag:language.SYNC_SIG /><br></td>
<td class="lista" width=100%><input type="checkbox" name="sigf" value="sigf" <tag:config.syncsig />/></td>

</tr>
<tr>
<td class="header"><tag:language.SYNC_AV /><br></td>
<td class="lista" width=100%><input type="checkbox" name="av" value="av" <tag:config.syncav />/></td>

</tr>
<else:isSMF>
</if:isSMF>
<tr>
<td class="header"><tag:language.SIG /></td>
<td class="lista" width=100%><textarea name="sig" rows="5" cols="60"><tag:config.sig /></textarea></td>

</tr>
<tr>
<td class="header"><tag:language.SIG_PREV /></td>
<td class="lista" width=100%><tag:sig_prev /></td>

</tr>
<tr>
			<td class="lista" colspan="2"><center>
										  <input type="submit" class="btn btn-primary" value="<tag:language.FRM_CONFIRM />">
										  &nbsp;&nbsp;&nbsp;
										  <input type="reset" class="btn btn-warning" value="<tag:language.FRM_CANCEL />">
										  </center></td>
		</tr>	
</table></form>
<div class="panel-footer">
</div>
</div>