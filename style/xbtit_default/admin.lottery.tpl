<form method="post" action="<tag:frm_action />" name="lottery_settings">
	<table cellspacing="0" cellpadding="5" class="lista" align="center" width="450">
		<tr>
			<td class="header" colspan="2"><tag:language.LOTT_SETTINGS /></td>
		</tr>
		<tr>
			<td class="header" width="180" align="left"><tag:language.EXPIRE_DATE />
														<br />
							  							<small><i><tag:language.EXPIRE_DATE_VIEW /></i></small></td>
			<td class="lista"><input type="text" name="expire_date" size="10" value="<tag:expire_date />"></td>
		</tr>
		<tr>
			<td class="header" width="180" align="left"><tag:language.EXPIRE_TIME /></td>
			<td class="lista"><input type="text" name="expire_time" size="5" value="<tag:expire_time />">&nbsp;<tag:language.EXPIRE_TIME_VIEW /></td>
		</tr>
		<tr>
			<td class="header" width="180" align="left"><tag:language.NUM_WINNERS /></td>
			<td class="lista"><input type="text" name="number_winners" size="5" value="<tag:number_winners />"></td>
		</tr>
		<tr>
			<td class="header" width="180" align="left"><tag:language.TICKET_COST /></td>
			<td class="lista"><input type="text" name="amount_to_pay" size="10" value="<tag:amount_to_pay />">&nbsp;MB</td>
		</tr>
		<tr>
			<td class="header" width="180" align="left"><tag:language.MIN_WIN /></td>
			<td class="lista"><input type="text" name="min_amout_to_win" size="10" value="<tag:amount_to_win />">&nbsp;GB</td>
		</tr>
		<tr>
			<td class="header" width="180" align="left"><tag:language.MAX_BUY /></td>
			<td class="lista"><input type="text" name="limit_buy" size="5" value="<tag:limit_to_buy />"></td>
		</tr>
		<tr>
			<td class="header" width="180" align="left"><tag:language.LOTT_SENDER_ID /></td>
			<td class="lista"><input type="text" name="sender_id" size="1" value="<tag:sender_id />"></td>
		</tr>
		<tr>
			<td class="header" width="180" align="left"><tag:language.LOTTERY_STATUS /></td>
			<td class="lista"><input type="checkbox" name="enabled" value="enabled" <tag:lottery_enabled /> /></td>
		</tr>
		<tr>
			<td class="lista" colspan="2"><center>
										  <input type="submit" class="btn" value="<tag:language.FRM_CONFIRM />">
										  &nbsp;&nbsp;&nbsp;
										  <input type="reset" class="btn" value="<tag:language.FRM_CANCEL />">
										  </center></td>
		</tr>	
	</table>
</form>

<center><a href="<tag:view_selled_tickets />"><tag:language.VIEW_SELLED /></a></center>