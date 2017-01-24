<table align="center" width="600" class="lista">
<tr>
  <td class="header"><tag:language.LOTT_ID /></td>
  <td class="header"><tag:language.LOTT_NUMBER_OF_TICKETS /></td>
  <td class="header"><tag:language.LOTT_USERNAME /></td>
  <td class="header"><tag:language.UPLOADED /></td>
  <td class="header"><tag:language.DOWNLOADED /></td>
</tr>
<if:no_tickets>
<tr>
	<td colspan="5" class="lista"><tag:language.NO_TICKET_SOLD /></td>
</tr>
<else:no_tickets>
<loop:ticket>
<tr>
	<td class="lista"><tag:ticket[].id /></td>
	<td class="lista"><tag:ticket[].number_tickets /></td>
	<td class="lista"><tag:ticket[].username /></td>
	<td class="lista"><tag:ticket[].download /></td>
	<td class="lista"><tag:ticket[].upload /></td>
</tr>
</loop:ticket>
</if:no_tickets>
</table>
<br />
<a href="<tag:back />"><tag:language.BACK_TO_LOTTERY /></a>