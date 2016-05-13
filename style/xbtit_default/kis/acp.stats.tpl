<if:usetabs>
<div class="ktabs">
	<loop:tabs>
	<span class="ktab"><a href="<tag:script /><tag:tabs[].0 />"><span class="kbutton"><tag:tabs[].1 /></span></a></span>
	</loop:tabs>
</div>
</if:usetabs>
<form action="<tag:script />ktab=stats&amp;force=1" name="kis" method="post">
<table class="lista" width="100%">
<tr>
	<td class="header" align="center" colspan="6"><tag:language.KIS_STS_GEN /></td>
</tr>
<tr>
	<td class="header"><tag:language.KIS_INV_REC /></td>
	<td class="lista"><tag:kis.REGISTERED /></td>
	<td class="header"><tag:language.MEMBERS /></td>
	<td class="lista"><tag:kis.MEMBERS /></td>
	<td class="header"><tag:language.KIS_INV_RATIO /></td>
	<td class="lista"><tag:kis.RATIO />%</td>
</tr>
<tr>
	<td class="header"><tag:language.KIS_INV_PEN /></td>
	<td class="lista"><tag:kis.PENDING /></td>
	<td class="header"><tag:language.KIS_UNUSED /></td>
	<td class="lista"><tag:kis.UNUSED /></td>
	<td class="header"><tag:language.KIS_NO_INV /></td>
	<td class="lista"><tag:kis.NOINVITES /></td>
</tr>
<tr>
	<td align="center" class="header" colspan="6"><input type="submit" name="confirm" class="btn" value="<tag:language.KHEZ_FORCE />" /></td>
</tr>
</table>
</form>