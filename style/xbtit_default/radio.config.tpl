<form method="post" action="<tag:frm_action />" name="radio_settings">
<center>
<table class="lista" width="50%" align="center">
<tr>
<td class="header">Radio IP<br></td>
<td class="lista" width=100%><input type="text" name="radip" value="<tag:config.radio_ip />" size="30" /></td>

</tr>
<tr>
<td class="header">Radio Port<br></td>
<td class="lista" width=100%><input type="text" name="radport" value="<tag:config.radio_port />" size="30" /></td>

</tr>
<tr>
<td class="header">Radio Password<br></td>
<td class="lista" width=100%><input type="password" name="radpass" value="<tag:config.radio_pass />" size="30" /></td>

</tr>
<tr>
<td class="header">Radio Shoutbox Announce<br><font color=red>Numeric in seconds</font></td>
<td class="lista" width=100%><input type="text" name="radin" value="<tag:config.radio_interval />" size="30" /></td>

</tr>
<tr>
			<td class="lista" colspan="2"><center>
										  <input type="submit" class="btn" value="<tag:language.FRM_CONFIRM />">
										  &nbsp;&nbsp;&nbsp;
										  <input type="reset" class="btn" value="<tag:language.FRM_CANCEL />">
										  </center></td>
		</tr>	
</table></form>