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
<if:doinvites>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center"></h4>
</div>
<table class="table table-bordered"> 
<tr align="center">
	<td class="header"><tag:kis.EMAIL /></td>
	<td class="header" width="45px"><tag:kis.STATUS /></td>
	<td class="header" width="110px"><tag:kis.TIME /></td>
	<td class="header" width="1%"><tag:kis.TOKEN /></td>
	<td class="header" width="1%"><tag:kis.ACTION /></td>
</tr>
<loop:invites>
<tr>
	<td class="lista"><tag:invites[].EMAIL /></td>
	<td class="lista" style="text-align:center;"><tag:invites[].STATUS /></td>
	<td class="lista" style="text-align:center;"><tag:invites[].TIME /></td>
	<td class="lista" style="text-align:center;"><tag:invites[].TOKEN /></td>
	<td class="lista" style="text-align:center;"><tag:invites[].ACTION /></td>
</tr>
</loop:invites>
<if:dopager>
<tr>
	<td colspan="5" class="lista" style="text-align:center;"><tag:pager /></td>
</tr>
</if:dopager>
</table>
</if:doinvites>
</div>