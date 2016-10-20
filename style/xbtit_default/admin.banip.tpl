<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Ban IP</h4>
</div>
<form action="<tag:frm_action />" name="ban" method="post">
  <div align="center"><p class="text-danger"><tag:language.BAN_NOTE /></p></div>
  <table class="lista" width="100%" align="center">
  <br>
    <tr>
      <td class="header" colspan="4" align="center"><tag:language.BAN_INSERT /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.BAN_FIRSTIP /></td>
      <td class="lista"><input type="text" name="firstip" size="15" /></td>
      <td class="header"><tag:language.BAN_LASTIP /></td>
      <td class="lista"><input type="text" name="lastip" size="15" /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.BAN_COMMENTS /></td>
      <td class="lista" colspan="3"><input type="text" name="comment" size="60" /></td>
    </tr>
    <tr>
      <td align="center" class="header" colspan="4">
        <input type="submit" name="write" class="btn btn-success" value="<tag:language.FRM_CONFIRM />" />&nbsp;&nbsp;&nbsp;
        <input type="submit" name="write" class="btn btn-danger" value="<tag:language.FRM_CANCEL />" />
      </td>
    </tr>
  </table>
  <br />
  <table class="lista" width="100%" align="center">
    <tr>
      <td class="head"><tag:language.BAN_ADDED /></td>
      <td class="head" align="left"><tag:language.BAN_FIRSTIP /></td>
      <td class="head" align="left"><tag:language.BAN_LASTIP /></td>
      <td class="head" align="left"><tag:language.BAN_BY /></td>
      <td class="head" align="left"><tag:language.BAN_COMMENTS /></td>
      <td class="head"><tag:language.BAN_REMOVE /></td>
    </tr>
    <if:no_records>
    <tr>
      <td colspan="6" align="center"><tag:language.BAN_NOIP /></td>
    </tr>
    <else:no_records>
    <loop:bannedip>
    <tr>
      <td class="lista"><tag:bannedip[].date /></td>
      <td class="lista" align="left"><tag:bannedip[].first_ip /></td>
      <td class="lista" align="left"><tag:bannedip[].last_ip /></td>
      <td class="lista" align="left"><tag:bannedip[].by /></td>
      <td class="lista" align="left"><tag:bannedip[].comments /></td>
      <td class="lista"><tag:bannedip[].remove /></td>
    </tr>
    </loop:bannedip>
    </if:no_records>
  </table>
  <br />
  <br />
</form>
<div class="panel-footer">
</div>
</div>