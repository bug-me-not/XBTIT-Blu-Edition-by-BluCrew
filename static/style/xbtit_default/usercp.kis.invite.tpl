<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Invite Tools</h4>
</div>
<if:usetabs>
	<loop:tabs>
	<a href="<tag:script /><tag:tabs[].0 />"><button class='btn btn-sm btn-primary' type='button'><tag:tabs[].1 /></button></a>
	</loop:tabs>
</div>
</if:usetabs>
<br>
<if:usemsg>
<span class="kMessage">
	<loop:msgs>
	<div class="alert alert-danger" role="alert" ng-show="error"><tag:msgs[].1 /></div>
	</loop:msgs>
</span>
</if:usemsg>
<br>
<if:allow>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center"></h4>
</div>
<form action="<tag:script /><tag:frm_action />" method="post" name="kis">
<table class="table table-bordered"> 
<tr>
	<td class="header" width="70px" style="text-align: right; vertical-align: text-top;"><tag:language.KIS_REMAINING /></td>
	<td class="lista" align="left"><tag:kis.REMAINING /></td>
</tr>
<tr>
	<td class="header" style="text-align: right; vertical-align: text-top;"><tag:language.KIS_EMAIL /></td>
	<td class="lista" align="left"><input type="text" name="emails" value="<tag:kis.EMAILS />" size="80" /></td>
</tr>
<tr>
	<td class="header" width="70px" style="text-align: right; vertical-align: text-top;">Agreement</td>
	<td class="lista" align="left"><input id="agree" name="agree" type="checkbox" value="1"><p class='text-danger'>Please note! You are responsible for inviting this member. If you agree to this, check the box to proceed.</p></td>
</tr>
</table>
<tr>
	<td class="lista" align="center"><input type="submit" name="submit" class="btn btn-success btn-md" value="<tag:language.FRM_SEND />" />
	<input type="reset" class="btn btn-danger btn-md" value="<tag:language.FRM_RESET />" /></td>
</tr>
</form>
</if:allow>
</div>