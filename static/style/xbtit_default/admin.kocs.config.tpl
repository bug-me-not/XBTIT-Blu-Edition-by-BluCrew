<if:usetabs>
<div class="ktabs">
	<loop:tabs>
	<span class="ktab"><a href="<tag:script /><tag:tabs[].0 />&amp;key=<tag:key />"><span class="kbutton"><tag:tabs[].1 /></span></a></span>
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
<form action="<tag:script />ktab=config&amp;action=write&amp;key=<tag:key />" name="kocs" method="post">
<table class="lista" width="100%" align="center">
<tr>
	<td class="header" align="center" colspan="4"><tag:language.KHEZ_MAIN /></td>
</tr>
<tr>
	<td class="header"><label for="logs"><tag:language.KHEZ_LOGS /></label></td>
	<td class="lista"><input type="checkbox" id="logs" name="logs" <tag:kocs.LOGS /> /></td>
	<td class="header"><label for="check"><tag:language.KOCS_DOKEY /></label></td>
	<td class="lista"><input type="checkbox" id="check" name="check" <tag:kocs.KEYCHECK /> /></td>
</tr>
<tr>
	<td class="header" align="center" colspan="4"><tag:language.KOCS_PASS_CH /></td>
</tr>
<tr>
	<td class="header"><label for="key1"><tag:language.KOCS_PASS_NEW /></label></td>
	<td class="lista"><input type="text" id="key1" name="key1" size="20" /></td>
	<td class="header"><label for="key2"><tag:language.KOCS_PASS_NEW_CONF /></label></td>
	<td class="lista"><input type="text" id="key2" name="key2" size="20" /></td>
</tr>
<tr>
	<td align="center" class="header" width="25%"><input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" /></td>
	<td align="center" class="header" width="25%"><input type="reset" name="confirm" class="btn" value="<tag:language.FRM_RESET />" /></td>
	<td align="center" class="header" width="25%"><input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CANCEL />" /></td>
	<td align="center" class="header" width="25%"><input type="submit" name="confirm" class="btn" value="<tag:language.HACK_UNINSTALL />" /></td>
</tr>
</table>
</form>