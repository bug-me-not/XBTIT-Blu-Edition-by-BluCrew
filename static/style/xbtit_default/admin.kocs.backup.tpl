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
<form action="<tag:script />ktab=backup&amp;action=download&amp;key=<tag:key />" name="kocs" method="post">
<table class="lista" width="100%" align="center">
<tr>
	<td class="header" align="center" colspan="4"><tag:language.KOCS_BAK /></td>
</tr>
<tr>
	<td class="header"><label for="prefix"><tag:language.KOCS_PREFIX /></label></td>
	<td class="lista"><input type="text" id="prefix" name="prefix" value="<tag:kocs.PREFIX />" size="20" /></td>
	<td class="header"><label for="backupType"><tag:language.KOCS_BAK_TYPE /></label></td>
	<td class="lista"><select id="backupType" name="backupType"><option value="1"><tag:language.KOCS_BAK_DATA /></option><option value="2"><tag:language.KOCS_BAK_STRUCT /></option><option value="3" selected="selected"><tag:language.KOCS_BAK_BOTH /></option></select></td>
</tr>
<tr>
	<td class="header"><label for="comment"><tag:language.KOCS_BAK_COM /></label></td>
	<td class="lista"><input type="checkbox" id="comment" name="comment" /></td>
	<td class="header"><label for="compress"><tag:language.KOCS_PAK /></label></td>
	<td class="lista"><tag:kocs.COMPRESS /></td>
</tr>
<tr>
	<td class="header" align="center" colspan="2"><tag:language.KOCS_DATA /></td>
	<td class="header" align="center" colspan="2"><tag:language.KOCS_STRU /></td>
</tr>
<tr>
	<td class="header"><label for="dataType"><tag:language.KOCS_DATA_XTRA /></label></td>
	<td class="lista"><select id="dataType" name="dataType"><option value="1"><tag:language.KOCS_DATA_INS /></option><option value="2" selected="selected"><tag:language.KOCS_DATA_REP /></option></select></td>
	<td class="header"><label for="strcutureType"><tag:language.KOCS_STRU_XTRA /></label></td>
	<td class="lista"><select id="strcutureType" name="structureType"><option value="1"><tag:language.KOCS_STRU_NONE /></option><option value="2"><tag:language.KOCS_STRU_DROP /></option><option value="3" selected="selected"><tag:language.KOCS_STRU_IFNOT /></option></select></td>
</tr>
<tr>
	<td align="center" class="header" width="25%"><input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" /></td>
	<td align="center" class="header" width="25%"><input type="reset" name="confirm" class="btn" value="<tag:language.FRM_RESET />" /></td>
	<td align="center" class="header" width="25%"><input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CANCEL />" /></td>
	<td align="center" class="header" width="25%"></td>
</tr>
</table>
</form>