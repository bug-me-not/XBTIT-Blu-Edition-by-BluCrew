<script language="javascript">
function confirmSubmit()
{
var agree=confirm("<tag:language.SENDINV_CONFIRM />");
if (agree)
	return true ;
else
	return false ;
}
</script>

<script type="text/javascript">
<!--

var newwindow;
function popusers(url)
{
  newwindow=window.open(url,'popusers','height=100,width=450');
  if (window.focus) {newwindow.focus()}
}
 -->
</script>
<table width="80%" class="lista" align="center" cellspacing="0" cellpadding="4">
  <tr>
	<td colspan="2">
	  <div style="text-align:center; padding:10px;">
	  <tag:language.INV_WELCOME />
	  <br />
	  <tag:language.PRIVATE_TRACKER_INFO />
	  </div>
	</td>
  </tr>
  <tr>
	<td class="block" colspan="2" align="center"><tag:language.INVITES_SETTINGS /></td>
  </tr>
  <form name="ptracker_active" action="<tag:frm1_action />" method="post">
  <tr>
	<td class="header">
	<tag:language.PRIVATE_TRACKER />
	</td>
	<td class="lista">
	&nbsp;<tag:language.YES />&nbsp;<input type="radio" name="ptracker" VALUE="true"<tag:invit.ptracker_on /> />
	&nbsp;<tag:language.NO />&nbsp;<input type="radio" name="ptracker" VALUE="false"<tag:invit.ptracker_off /> />
	</td>
  </tr>
  <tr>
	<td class="header">
	<tag:language.VALID_INV_MODE /><br />
	<tag:language.VALID_INV_EXPL />
	</td>
	<td class="lista">
	&nbsp;<tag:language.YES />&nbsp;<input type="radio" name="reqvalid" value="true"<tag:invit.reqvalid_on /> />
	&nbsp;<tag:language.NO />&nbsp;<input type="radio" name="reqvalid" value="false"<tag:invit.reqvalid_off /> />
	</td>
  </tr>
  <tr>
	<td class="header">
	<tag:language.RECYCLE_DATE /><br />
	<tag:language.RECYCLE_EXPL />
	</td>
	<td class="lista">
	  <input type="text" name="rec_after" size="8" maxlength="8" value="<tag:invit.recycle_after />" />
	</td>
  </tr>
  <tr>
	<td class="header" align="center" colspan="2">
	<input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" />
	</td>
  </tr>
  </form>
</table>
<br />
<table width="80%" class="lista" align="center" cellspacing="0" cellpadding="4">
  <form method="post" name="edit" action="<tag:frm_action />" >
  <tr>
    <td class="block" colspan="2" align="center"><tag:language.GIVE_INVITES_TO /></td>
  </tr>
  <tr>
    <td class="blocklist" colspan="2" align="center"><tag:language.SENDINV_EXPL /></td>
  </tr>
  <tr>
	<td class="header"><tag:language.USER /></td>
	<td class="lista"><input type="text" name="receiver" value="<tag:receiver />" size="35" maxlength="40" />&nbsp;<tag:searchuser /></td>
  </tr>
  <tr>
	<td class="header"><tag:language.RANK /></td>
	<td class="lista"><tag:group_combo /></td>
  </tr>
  <tr>
	<td class="header"><tag:language.NUM_INVITES /></td>
	<td class="lista"><input type="text" name="num_invs" size="8" maxlength="8" /></td>
  </tr>
  <tr>
	<td class="header" align="center" colspan="2">
	<input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" onclick="return confirmSubmit()" />
	</td>
  </tr>
  </form>
</table>
<br />
<table width="80%" class="lista" align="center" cellspacing="0" cellpadding="4">
  <tr>
	<td class="block" colspan="5" align="center"><tag:language.INVITES_LIST /></td>
  </tr>
  <tr>
    <td colspan="5" style="text-align:center; padding=5px;"><tag:inv_pagertop /></td>
  </tr>
  <tr>
    <td class="header" align="center"><tag:language.INVITED_BY /></td>
    <td class="header" align="center"><tag:language.SENT_TO /></td>
    <td class="header" align="center"><tag:language.HASH /></td>
    <td class="header" align="center"><tag:language.DATE_SENT /></td>
    <td class="header" align="center"><tag:language.DELETE /></td>
  </tr>
  <loop:invitees>
  <tr>
    <td class="lista"><tag:invitees[].inviter /></td>
    <td class="lista"><tag:invitees[].invitee /></td>
    <td class="lista"><tag:invitees[].hash /></td>
    <td class="lista"><tag:invitees[].time_invited /></td>
    <td class="lista"><tag:invitees[].delete /></td>
  </tr>
  </loop:invitees>
  <tr>
    <td colspan="5" style="text-align:center; padding=5px;"><tag:inv_pagerbottom /></td>
  </tr>
  </table>