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
<if:allow>
<form action="<tag:script /><tag:frm_action />" method="post" name="kis">
<table class="lista" border="0" width="98%" cellspacing="1" cellpadding="2">
<tr>
	<td class="header" width="70px" style="text-align: right; vertical-align: text-top;"><tag:language.KIS_REMAINING /></td>
	<td class="lista" align="left"><tag:kis.REMAINING /></td>
</tr>
<tr>
	<td class="header" style="text-align: right; vertical-align: text-top;"><tag:language.KIS_EMAIL /></td>
	<td class="lista" align="left"><input type="text" name="emails" value="<tag:kis.EMAILS />" size="80" /></td>
</tr>
<tr>
	<td class="header" align="right"><input type="submit" name="submit" class="btn" value="<tag:language.FRM_SEND />" /></td>
	<td class="header" align="left"><input type="reset" class="btn" value="<tag:language.FRM_RESET />" /></td>
</tr>
</table>
</form>
</if:allow>