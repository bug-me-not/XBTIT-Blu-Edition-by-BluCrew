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
<form action="<tag:script />ktab=config&amp;action=write" name="kis" method="post">
<table class="lista" width="100%" align="center">
<tr>
	<td class="header" align="center" colspan="4"><tag:language.ACP_KIS /></td>
</tr>
<tr>
	<td class="header"><tag:language.ENABLED /></td>
	<td class="lista"><input type="checkbox" id="enabled" name="enabled" <tag:kis.ENABLED /> /></td>
	<td class="header"><tag:language.KHEZ_LOGS /></td>
	<td class="lista"><input type="checkbox" id="logs" name="logs" <tag:kis.LOGS /> /></td>
</tr>
<tr>
	<td class="header" align="center" colspan="4"><tag:language.KHEZ_MAIN /></td>
</tr>
<tr>
	<td class="header"><tag:language.KIS_EXPIRE /></td>
	<td class="lista"><input type="text" name="expireAmmount" value="<tag:kis.EXPIRE_AMMOUNT />" size="6" /><tag:kis.EXPIRE_TYPE /></td>
	<td class="header"><tag:language.KIS_REG_AWARD /></td>
	<td class="lista"><input type="text" name="regAmmount" value="<tag:kis.REG_AMMOUNT />" size="12" /><tag:kis.REG_TYPE /></td>
</tr>
<tr>
	<td class="header" align="center" colspan="4"><tag:language.KHEZ_MISC /></td>
</tr>
<tr>
	<td class="header"><tag:language.KIS_PERPAGE /></td>
	<td class="lista"><input type="text" name="perpage" value="<tag:kis.PERPAGE />" size="20" /></td>
</tr>
<tr>
	<td align="center" class="header" width="25%"><input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" /></td>
	<td align="center" class="header" width="25%"><input type="reset" name="confirm" class="btn" value="<tag:language.FRM_RESET />" /></td>
	<td align="center" class="header" width="25%"><input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CANCEL />" /></td>
	<td align="center" class="header" width="25%"><input type="submit" name="confirm" class="btn" value="<tag:language.HACK_UNINSTALL />" /></td>
</tr>
</table>
</form>