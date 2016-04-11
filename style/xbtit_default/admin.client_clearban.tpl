<p align='center'><tag:language.UNBAN_MAIN /></p>
<form method='post' name='action'>
<table align='center' width=70%>
  <tr>
    <td class='header' align='center'><tag:language.PEER_CLIENT /></td>
    <td class='header' align='center'><tag:language.USER_AGENT /></td>
    <td class='header' align='center'><tag:language.PEER_ID /></td>
    <td class='header' align='center'><tag:language.PEER_ID_ASCII /></td>
    <td class='header' align='center'><tag:language.BAN_REASON /></td>
  </tr>


  <loop:client>
  <tr>
    <td class='lista'><center><tag:client[].client_name /></center></td>
    <td class='lista'><center><tag:client[].user_agent /></center></td>
    <td class='lista'><center><tag:client[].peer_id /></center></td>
    <td class='lista'><center><tag:client[].peer_id_ascii /></center></td>
    <td class='lista'><center><tag:client[].reason /></center></td>
  </tr>
  </loop:client>

</table>
<p align='center'><tag:language.CONFIRM_ACTION /></p>
<center>
<input type='submit' name='confirm' value='<tag:language.YES />'>&nbsp;<input type='submit' name='confirm' value='<tag:language.NO />'>
<center></form><br />