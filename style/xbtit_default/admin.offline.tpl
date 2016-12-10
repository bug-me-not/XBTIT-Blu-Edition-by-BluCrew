<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Take Site Offline For Maintenance?</h4>
</div>
<br />
<form name="frm_offline" action="<tag:form_action />" method="post">
<table class="lista" cellpadding="4" cellspacing="0" width="100%">
<center><p class="text-success">Site Will Still Be Availible To Staff</p></center>
  <tr>
    <td class="header" width="20%"><tag:language.OFFLINE_SETTING /></td>
    <td class="lista"><input type="checkbox" name="offline" <tag:offline_checked />/></td>
  </tr>
  <tr>
    <td class="header" width="20%" valign="top"><tag:language.OFFLINE_MESSAGE /></td>
    <td class="lista" align="left"><textarea name="offline_msg" rows="3" style="width:95%"><tag:offline_message /></textarea></td>
  </tr>
  <tr>
    <td colspan="2" class="lista" style="text-align:center;"><input type="submit" class="btn btn-md btn-primary" name="confirm" value="<tag:language.FRM_CONFIRM />" /></td>
  </tr>
</table>
</form>
<div class="panel-footer">
</div>
</div>