<if:usetabs>
<div class="ktabs">
	<loop:tabs>
	<span class="ktab"><a href="<tag:script /><tag:tabs[].0 />"><span class="kbutton"><tag:tabs[].1 /></span></a></span>
	</loop:tabs>
</div>
</if:usetabs>
<if:usemsg>
<span class="kMessage">
	<loop:msgs>
	<div class="k<tag:msgs[].0 />"><tag:msgs[].1 /></div>
	</loop:msgs>
</span>
</if:usemsg>
<if:doinvites>
<table class="lista">
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