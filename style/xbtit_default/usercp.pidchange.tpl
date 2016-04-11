<form method="post" name="pid" action="<tag:pid_c.frm_action />">
  <table class="lista" width="100%" align="center">
 <if:IS_PEER>
    <tr>
      <td class="header" align="center" colspan="2"><tag:pid_c.ispeer /></td>
    </tr>
 </if:IS_PEER>
    <tr>
      <td class="header"><tag:language.PID />:</td>
      <td class="lista"><tag:pid_c.userpid /></td>
    </tr>
    <tr>
      <td class="header" align="center" colspan="2">
    <table align="center" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><input type="submit" class="btn" name="confirm" <tag:pid_c.reset_disabled /> value="Reset PID" /></td>
        <td align="center"><input type="button" class="btn" name="confirm" onclick="javascript:window.open('<tag:pid_c.frm_cancel />','_self');" value="<tag:language.FRM_CANCEL />" /></td>
      </tr>
    </table>
      </td>
   </tr>
  </table>
</form>