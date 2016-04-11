<table align="center" width="80%" class="lista">
	<tr>
		<td class="header" align="center"><tag:language.LOTT_USERNAME /></td>
		<td class="header" align="center"><tag:language.WINDATE /></td>
		<td class="header" align="center"><tag:language.PRICE /></td>
	</tr>
	<if:are_winners>
		<loop:winner>
			<tr>
				<td class="lista"><tag:winner[].winner /></td>
				<td class="lista"><tag:winner[].date /></td>
				<td class="lista"><tag:winner[].price /></td>
			</tr>
		</loop:winner>
	<else:are_winners>
		<tr>
			<td class="lista" colspan="3"><tag:language.NO_WINNERS_YET /></td>
		</tr>
	</if:are_winners>
</table>