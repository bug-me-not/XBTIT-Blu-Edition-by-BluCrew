<form action="<tag:frm_action />" name="add" method="post">
<table class="lista" width="100%" align="center">
<tr>
      <td class="header" colspan="4" align="center"><b><tag:language.PROX_ADD_TO_LIST /> <a href='http://www.proxy4free.com'>Proxy4all</a></b></td>
</tr>
<tr>
      <td class="header"><tag:language.PROX_PIP /></td>
      <td class="lista"><input type="text" name="tip" size="15" /></td>
</tr>
<tr>
      <td align="center" class="header" colspan="4">
      <input type="submit" name="write" class="btn" value="<tag:language.FRM_CONFIRM />" />&nbsp;&nbsp;&nbsp;
      <input type="submit" name="write" class="btn" value="<tag:language.FRM_CANCEL />" />
      </td>
    </tr>
  </table>
  <br />
  <table class="lista" width="100%" align="center">
    <tr>
      <td class="header" align="center"><tag:language.PROX_DA /></td>
      <td class="header" align="center"><tag:language.PROX_IP /></td>
      <td class="header" align="center"><tag:language.PROX_REM /></td>
    </tr>
    <if:no_records>
    <tr>
      <td colspan="6" align="center"><tag:language.PROX_NONE_YET /></td>
    </tr>
    <else:no_records>
    <loop:blacklist>
    <tr>
      <td class="lista" style="text-align:center;"><tag:blacklist[].date /></td>
      <td class="lista" style="text-align:center;"><tag:blacklist[].tip /></td>
      <td class="lista" style="text-align:center;"><tag:blacklist[].remove /></td>
    </tr>
    </loop:blacklist>
    </if:no_records>
  </table>
  <br />
  <br />
</form>
