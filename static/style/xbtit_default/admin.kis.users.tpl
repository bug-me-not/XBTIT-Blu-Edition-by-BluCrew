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
<if:form>
<form action="<tag:script />ktab=users&amp;action=edit&amp;id=<tag:uid />" name="kis" method="post">
<table class="lista" width="100%">
<tr>
	<td class="header" align="center" colspan="6"><tag:language.KIS_SEARCH /></td>
</tr>
<tr>
	<td class="header" align="center"><tag:language.KIS_RESULTS /></td>
	<td class="lista"><tag:kis.RESULTS /></td>
	<td class="header"><tag:language.KIS_INVITED_BY /></td>
	<td class="lista"><tag:kis.INVITER /></td>
</tr>
<tr>
	<td class="header" align="center"><tag:language.KIS_INVITES /></td>
	<td class="lista"><input type="text" name="invites" id="invites" value="<tag:kis.INVITES />" /></td>
	<td class="header"><tag:language.KIS_JOINED /></td>
	<td class="lista"><tag:kis.JOINED /></td>
</tr>
<tr>
	<td align="center" class="header" width="25%"><input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" /></td>
	<td align="center" class="header" width="25%"><input type="reset" name="confirm" class="btn" value="<tag:language.FRM_RESET />" /></td>
	<td align="center" class="header" width="25%"><input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CANCEL />" /></td>
	<td align="center" class="header" width="25%"></td>
</tr>
</table>
</form>
</if:form>
<form action="<tag:script />ktab=users&amp;action=search" name="kis" method="post">
<table class="lista" width="100%">
<tr>
	<td class="header" align="center" colspan="6"><tag:language.KIS_USERS /></td>
</tr>
<tr>
	<td class="header" align="center"><tag:language.KIS_SEARCH /></td>
	<td class="lista"><input type="text" size="12" name="who"/><select name="what"><option value="user"><tag:language.USER_NAME /></option><option value="id"><tag:language.ID /></option></select></td>
	<td class="header"></td>
	<td class="lista"></td>
</tr>
<tr>
	<td align="center" class="header" width="25%"><input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" /></td>
	<td align="center" class="header" width="25%"><input type="reset" name="confirm" class="btn" value="<tag:language.FRM_RESET />" /></td>
	<td align="center" class="header" width="25%"><input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CANCEL />" /></td>
	<td align="center" class="header" width="25%"></td>
</tr>
</table>
</form>