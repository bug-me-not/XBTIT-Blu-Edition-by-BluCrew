

<if:warn_add>
  <form name="warn_add_new" action="<tag:frm_action />" method="post">
    <table class="lista">
      <tr>
        <td class="header"><tag:language.WARN_TITLE /></td>
        <td class="lista" colspan="3">
        <input type="text" name="warn_title" size="40" maxlength="20" value="<tag:warn_title />" /></td>
      </tr>
    <tr>
        <td class="header"><tag:language.WARN_TEXT /></td>
        <td class="lista" colspan="3">
        <textarea name="warn_text"><tag:warn_text /></textarea><br/>
      </tr>
      <tr>
        <td class="header" align="center" colspan="4">
            <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" />&nbsp;&nbsp;&nbsp;
            <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CANCEL />" />
        </td>
      </tr>
    </table>
  </form>
<else:warn_add>
  <table class="lista" width="100%" align="center">
  <tr>
    <td class="header" align="center"><tag:language.WARN_TITLE /></td>
    <td class="header" align="center"><tag:language.WARN_TEXT /></td>
    <td class="header" align="center"><tag:language.EDIT /></td>
    <td class="header" align="center"><tag:language.DELETE /></td>
  </tr>
  <loop:warn>
  <tr>
    <td class="lista" align="center"><tag:warn[].title /></td>
    <td class="lista" align="center"><tag:warn[].text /></td>
    <td class="lista" align="center"><tag:warn[].edit /></td>
    <td class="lista" align="center"><tag:warn[].delete /></td>
  </tr>
  </loop:warn>
  <tr>
    <td class="header" align="center" colspan="5"><tag:warn_add_new /></td>
  </tr>
  </table>
</if:warn_add>