<div align="center">
<tag:language.STYLE_NOTE />
</div>
<if:style_add>
  <form name="language_add_new" action="<tag:frm_action />" method="post">
    <table class="lista">
      <tr>
        <td class="header">
            <tag:language.STYLE_FOLDER />
        </td>
        <td class="lista">
            <tag:style_combo />
        </td>
      </tr>
      <tr>
        <td class="header">
            <tag:language.STYLE_NAME />
        </td>
        <td class="lista">
            <input type="text" name="style_name" size="40" maxlength="20" value="<tag:style_name />" />
        </td>
      </tr>
      <tr>
        <td class="header"><tag:language.STYLE_TYPE /></td>
        <td class="lista"><tag:style_type /></td>
      </tr>
      <tr>
        <td class="header" align="center" colspan="2">
            <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" />&nbsp;&nbsp;&nbsp;
            <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CANCEL />" />
        </td>
      </tr>
    </table>
  </form>
<else:style_add>
  <table class="lista" width="100%" align="center">
  <tr>
    <td class="header" align="center"><tag:language.STYLE_NAME /></td>
    <td class="header" align="center"><tag:language.STYLE_URL /></td>
    <td class="header" align="center"><tag:language.STYLE_TYPE /></td>
    <td class="header" align="center"><tag:language.MEMBERS /></td>
    <td class="header" align="center"><tag:language.EDIT /></td>
    <td class="header" align="center"><tag:language.DELETE /></td>
  </tr>
  <loop:styles>
  <tr>
    <td class="lista" align="center"><tag:styles[].style /></td>
    <td class="lista" align="center"><tag:styles[].style_url /></td>
    <td class="lista" align="center"><tag:styles[].style_type /></td>
    <td class="lista" align="center"><tag:styles[].style_users /></td>
    <td class="lista" align="center"><tag:styles[].edit /></td>
    <td class="lista" align="center"><tag:styles[].delete /></td>
  </tr>
  </loop:styles>
  <tr>
    <td class="header" align="center" colspan="6"><tag:style_add_new /></td>
  </tr>
  </table>
</if:style_add>