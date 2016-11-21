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
<form action="<tag:script />ktab=award&amp;action=write" name="kis" method="post">
<table class="lista" width="100%" align="center">
<tr>
	<td class="header" align="center" colspan="6"><tag:language.KIS_AWARD /></td>
</tr>
<tr>
	<td class="header" width="15%"><label for="inv"><tag:language.KIS_AWARD_RANK /></label></td>
	<td class="lista" width="35%"><input type="text" id="inv" name="inv" size="2" value="<tag:kis.INVITES />"/><tag:kis.AWARDRANK /></td>
	<td class="header" width="10%"><label for="anon"><tag:language.KIS_SYSTEM /></label></td>
	<td class="lista" width="1%"><input type="checkbox" id="anon" name="anon" <tag:kis.ANON /> /></td>
</tr>
<tr>
	<td class="header"><label for="subject"><tag:language.SUBJECT /></label></td>
	<td class="lista" colspan="3"><input type="text" id="subject" name="subject" size="40" maxlength="40" value="<tag:kis.SUBJECT />" /></td>
</tr>
<tr>
	<td class="header"><label for="msg"><tag:language.BODY /></label></td>
	<td class="lista" colspan="3"><tag:kis.BODY /></td>
</tr>
<tr>
	<td align="center" class="header"><input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" /></td>
	<td align="center" class="header"><input type="reset" name="confirm" class="btn" value="<tag:language.FRM_RESET />" /></td>
	<td align="center" class="header" colspan="2"><input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CANCEL />" /></td>
</tr>
</table>