<if:updated>
<div align="center">
<br />
  <table border="1" width="500" cellspacing="0" cellpadding="0" style="border-color:#00C900" >
    <tr>
       <td class="success" valign="bottom" align="center">
       <tag:language.RATIO_SUCCES />
       </td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" align="center">
        <br />
        <tag:language.RATIO_UPDATE_SUCCES />
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
<form method="post" action="<tag:frm_action />" name="ratio_change">
	<table cellspacing="0" cellpadding="5" class="lista" align="center">
		<tr>
			<td class="header" colspan="2"><tag:language.RATIO_HEADER /></td>
		</tr>
		<tr>
			<td class="header"><tag:language.RATIO_USERNAME /></td>
			<td class="lista"><input type="text" name="username" size="40"></td>
		</tr>
		<tr>
			<td class="header"><tag:language.RATIO_UPLOADED /></td>
			<td class="lista"><input type="text" name="uploaded" size="40"></td>
		</tr>
		<tr>
			<td class="header"><tag:language.RATIO_DOWNLOADED /></td>
			<td class="lista"><input type="text" name="downloaded" size="40"></td>
		</tr>
		<tr>
			<td width="58" class="header"><tag:language.RATIO_INPUT_MEASURE /></td>
			<td class="lista">	<input type="radio" name="bytes" value="1"><tag:language.RATIO_BYTES />
								<input type="radio" name="bytes" value="2"><tag:language.RATIO_K_BYTES />
								<input type="radio" name="bytes" value="3"><tag:language.RATIO_M_BYTES />
								<input type="radio" name="bytes" value="4"><tag:language.RATIO_G_BYTES />
								<input type="radio" name="bytes" value="5"><tag:language.RATIO_T_BYTES />
			</td>
		</tr>
		<tr>
			<td class="header"><tag:language.RATIO_ACTION /></td>
			<td class="lista">	<input type="radio" name="what" value="1"><tag:language.RATIO_ADD />
								<input type="radio" name="what" value="2"><tag:language.RATIO_REMOVE />
								<input type="radio" name="what" value="3"><tag:language.RATIO_REPLACE />
			</td>
		</tr>
		<tr>
			<td class="lista" colspan="2"><center><input type="submit" value="<tag:language.FRM_CONFIRM />"></center></td>
		</tr>
	</table>
</form>