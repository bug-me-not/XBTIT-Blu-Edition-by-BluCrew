<table align="center" width="80%" class="lista">
	<tr><td class="lista" width="80%" align="center"><a href="<tag:last_winners />"><tag:language.LOTT_VIEW_LAST_WINNERS /></a></td></tr>
	<tr><td class="lista" width="80%" align="left">
	<ul>
	<li><tag:language.LOTT_TICK_MSG1 /></li>
	<li><tag:language.LOTT_TICK_MSG2 /> <tag:min_upload_cost /> <tag:language.LOTT_TICK_MSG3 /></li>
	<li><tag:language.LOTT_TICK_MSG4 /></li>
	<li><tag:language.LOTT_TICK_MSG5 /></li>
	<li><tag:expire_date /></li>
	<li><tag:language.LOTT_TICK_MSG7 /> <tag:number_winners /> <tag:language.LOTT_TICK_MSG8 /> <tag.amount_to_win /> <tag:language.LOTT_TICK_MSG9 /></li>
	<li><tag:language.LOTT_TICK_MSG10 /></li>
	<li><tag:language.LOTT_TICK_MSG11 /></li>
	<tag:own_ticket_numbers />
	</ul>
	<center><tag:language.LOTT_TICK_MSG13 /></center>
	<hr>
	<table align="center" width="40%" class="frame" border="1" cellspacing="0" cellpadding="10">
		<tr>
			<td align="center">
			<table width="100%" class="table" class="main" border="1" cellspacing="0" cellpadding="5">
				<tr>
					<td class="tableb"><tag:language.LOTT_TOTAL_IN_POT /></td>
					<td class="tableb"><tag:amount_in_pot /></td>
				</tr>
				<tr>
					<td class="tableb"><tag:language.LOTT_TOTAL_TICKETS_SELLED /></td>
					<td class="tableb" align="right"><tag:amount_purchased_total /> <tag:language.LOTT_TICKETS /></td>
				</tr>
				<tr>
					<td class="tableb"><tag:language.LOTT_YOUR_TICKETS /></td>
					<td class="tableb" align="right"><tag:amount_purchased_you /> <tag:language.LOTT_TICKETS /></td>
				</tr>
				<tr>
					<td class="tableb"><tag:language.LOTT_PURCHASEABLE /></td>
					<td class="tableb" align="right"><tag:amount_can_buy /> <tag:language.LOTT_TICKETS /></td>
				</tr>
			</table>
			</td>
		</tr>
	</table>
	<br />
	<hr />
	<br />
	<center>
	<if:competition_closed>
		<h1><font color=red><tag:language.LOTT_COMP_CLOSED /></font></h1>
	</if:competition_closed>
	
	<if:can_purchase>
	<if:need_upload>
		<font color="red"><b><tag:language.LOTT_NEED_UPLOAD /></b></font>
	<else:need_upload>
		<form method="post" action="<tag:frm_action />">
			<tag:language.LOTT_PURCHASE /><input type="text" name="number">
			<tag:language.LOTT_TICKETS /><input type="submit" class="btn" value="<tag:language.LOTT_PURCHASE />">
		</form>
	</if:need_upload>
	</if:can_purchase>
	</center>
</td></tr>
</table>
<br />