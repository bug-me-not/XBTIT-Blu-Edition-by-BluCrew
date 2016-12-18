<if:updated>
<div align="center">
<br />
  <table border="1" width="750" cellspacing="0" cellpadding="0" style="border-color:#00C900" >
    <tr>
       <td class="success" valign="bottom" align="center">
       <tag:language.GIFTS_SUCCES />
       </td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" align="center">
        <br />
        <tag:language.GIFTS_UPDATE_SUCCES />
        <br />
        <br />        
      </td>
    </tr>
  </table>
</div>
<br />
<br />
<else:updated>
</if:updated>
<form method="post" action="<tag:frm_action />" name="gift">
	<table cellspacing="0" cellpadding="5" class="lista" align="center">
	<tr>
			<tr>
			<td class="header" colspan="2"><center><tag:language.GIFTS_WHO /></center></td>
		</tr>
	<td width="90%" class="header"><tag:language.GIFTS_SELECT /></td>
	<td class="lista">          <input type="radio" name="selecta" value="1"><tag:language.GIFTS_NAME />
								<input type="radio" name="selecta" value="2"><tag:language.GIFTS_RANK />
								<input type="radio" name="selecta" value="3"><tag:language.GIFTS_ALL />
								</td></tr>
								
										<tr>
			<td class="header"><tag:language.GIFTS_ACTION /></td>
			<td class="lista">	<input type="radio" name="selectb" value="1"><tag:language.GIFTS_INV />
								<input type="radio" name="selectb" value="2"><tag:language.GIFTS_SB />

			</td>
		</tr>
		<tr>
			<td class="header"><tag:language.GIFTS_USER_NAME /></td>
			<td class="lista"><input type="text" name="username" size="40"></td>
		</tr>
		<tr>
			<td class="header"><tag:language.GIFTS_IF_RANK /></td>
			<td class="lista"><tag:rank_combo /></td>
		</tr>
		<tr>
			<td class="header" colspan="2"><center><tag:language.GIFTS_NUMBER /></center></td>
		</tr>

		<tr>
			<td class="header"><tag:language.GIFTS_WHAT /></td>
			<td class="lista"><input type="text" name="what" size="10"></td>
		</tr>
		<tr>
			<td class="header" colspan="2"><center><tag:language.GIFT_CUSTOM /></center></td>
		</tr>
				<tr>
			<td class="header"><tag:language.GIFT_TEXT /></td>
			<td class="lista"><textarea cols="80" rows="4" name="custom" ></textarea></td>
		</tr>
		<tr>
			<td class="lista" colspan="2"><center><input type="submit" value="<tag:language.FRM_CONFIRM />"></center></td>
		</tr>
	</table>
</form>