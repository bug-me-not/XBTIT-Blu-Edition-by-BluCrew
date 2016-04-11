<form method="post" enctype="multipart/form-data" action="<tag:frm_action />" name="seedip">
  <table class="header" width="100%" align="center">

		<tr>
			<td class="header" colspan="5" width="100%"align="center"><b>Add new Seedbox</b></td>
        </tr>

        <tr>
  			<td class="header" width="20%" align="left"><b>Seedbox IP Address</b></td>
			<td class="lista"><input type="text" name="ip" size="40"></td>
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
  <table class="header" width="100%" align="center">


    <tr>
	<td class="header"><b>Remove</b> </td>
    <td class="header"><b>Seedbox IP</b> </td>
    <td class="header"><b>Seedbox Hostname</b> </td>
    <td class="header"><b>Acive Peers</b></td>
  </tr>

    <loop:seedip>
  <tr>
    <td class="lista"><tag:seedip[].remove /></td>
    <td class="lista"><tag:seedip[].ip /></td>
    <td class="lista"><tag:seedip[].host /></td>
    <td class="lista"><tag:seedip[].peers /></td>
  </tr>
  </loop:seedip>


 </table>