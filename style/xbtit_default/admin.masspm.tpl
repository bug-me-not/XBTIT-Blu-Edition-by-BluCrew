<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Mass Private Mail</h4>
</div>
<if:masspm_post>
<table class="lista" width="100%" align="center" cellpadding="2">
  <tr>
    <td colspan="2" class="header" align="center"><p class="text-success"><tag:language.MASS_SENT /></p></td>
  </tr>
  <tr>
    <td class="header"><tag:language.SUBJECT /></td>
    <td class="lista"><tag:masspm.subject /></td>
  </tr>
  <tr>
    <td class="header"><tag:language.BODY /></td>
    <td class="lista"><tag:masspm.body /></td></tr>
  <tr>
    <td class="header"><tag:language.MASSPM_INFO /></td>
    <td><tag:masspm.info /></td>
  </tr>
</table>
<else:masspm_post>
<form method="post" name="masspm" action="<tag:frm_action />">
  <if:frm_error>
  <table class="lista" width="100%" align="center">
    <tr>
      <td class="lista" align="center" style="color:red; font-weight:bold;"><tag:language.MASS_PM_ERROR /></td>
    </tr>
  </table>
  </if:frm_error>
  <table class="lista" align="center" cellpadding="2">
    <tr>
      <td colspan="2" class="header" align="center"><p class="text-warning"><tag:language.WHO_PM /></p></td>
    </tr>
    <tr>
      <td class="header"><tag:language.RATIO_FROM />&nbsp;<tag:language.USER_LEVEL /></td>
      <td class="lista"><tag:masspm.combo_from_group /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.RATIO_TO />&nbsp;<tag:language.USER_LEVEL /></td>
      <td class="lista"><tag:masspm.combo_to_group /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.RATIO /></td>
      <td class="lista"><tag:masspm.combo_from_ratio /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.RATIO /></td>
      <td class="lista"><tag:masspm.combo_pick_ratio /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.SUBJECT /></td>
      <td class="lista"><input type="text" name="subject" size="40" maxlength="40" /></td>
    </tr>
    <tr>
      <td colspan="2" class="lista"><tag:masspm.body /></td>
    </tr>
    <tr>
      <td colspan="2" class="header" align="center"><input type="submit" name="masspm" class="btn btn-success" value="<tag:language.FRM_CONFIRM />" /></td>
    </tr>
  </table>
</form>
</if:masspm_post>
<div class="panel-footer">
</div>
</div>