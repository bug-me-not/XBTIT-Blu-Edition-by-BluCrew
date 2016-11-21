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
<form action="<tag:script />ktab=restore&amp;action=restore&amp;key=<tag:key />" name="kocs" method="post" enctype="multipart/form-data">
<table class="lista" width="100%" align="center">
<tr>
	<td class="header"><label for="restore"><tag:language.KOCS_RES_FILE /></label></td>
	<td class="lista" colspan="3"><input type="file" id="restore" name="restore" size="75%" /></td>
</tr>
<tr>
	<td align="center" class="header" width="25%"><input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" /></td>
	<td align="center" class="header" width="25%"><input type="reset" name="confirm" class="btn" value="<tag:language.FRM_RESET />" /></td>
	<td align="center" class="header" width="25%"><input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CANCEL />" /></td>
	<td align="center" class="header" width="25%"></td>
</tr>
</table>
</form>