<tag:pager_top />
<form method="post" action="index.php?page=takedelreport">
	<table width="95%" class="lista" align="center">
		<tr>
			<td align="center" class="header"><tag:language.REP_BY /></td>
			<td align="center" class="header"><tag:language.REP_REPORTING /></td>
			<td align="center" class="header"><tag:language.REP_TYPE /></td>
			<td align="center" class="header"><tag:language.REP_REASON /></td>
			<td align="center" class="header"><tag:language.REP_DEALT_WITH /></td>
			<td align="center" class="header"><tag:language.REP_MARK /></td>
			<if:MOD>
				<td align="center" class="header"><tag:language.DELETE /></td>
			</if:MOD>
		</tr>
		<loop:report>
			<tr>
				<td align="center" class="lista"><tag:report[].squealer /></td>
				<td align="center" class="lista"><tag:report[].reporting /></td>
				<td align="center" class="lista"><tag:report[].type /></td>
				<td align="center" class="lista"><tag:report[].reason /></td>
				<td align="center" class="lista"><b><tag:report[].dealtwith /></b></td>
				<td align="center" class="lista"><input type="checkbox" name="markreport[]" value="<tag:report[].reportid />" /></td>
				<if:MOD_DEL>
					<td align="center" class="lista"><input type="checkbox" name="delreport[]" value="<tag:report[].reportid />" /></td>
				</if:MOD_DEL>
			</tr>
		</loop:report>
		<tr><td align="center" class="lista" colspan="<tag:cols />"><center><input type="submit" value="confirm" /></center></td></tr>
	</table>
</form>
<tag:pager_bottom />