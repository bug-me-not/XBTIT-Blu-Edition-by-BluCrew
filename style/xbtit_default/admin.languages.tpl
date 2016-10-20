
<if:language_add>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">New Language</h4>
</div>
  <form name="language_add_new" action="<tag:frm_action />" method="post">
    <table class="lista">
      <tr>
        <td class="header">
            <tag:language.LANGUAGE_ADD />
        </td>
        <td class="lista">
            <tag:lang_combo />
        </td>
      </tr>
      <tr>
        <td class="header">
            <tag:language.LANGUAGE />
        </td>
        <td class="lista">
            <input type="text" name="new_language" size="40" maxlength="20" />
        </td>
      </tr>
      <tr>
        <td class="header" align="center" colspan="2">
            <input type="submit" name="confirm" class="btn btn-success" value="<tag:language.FRM_CONFIRM />" />&nbsp;&nbsp;&nbsp;
            <input type="submit" name="confirm" class="btn btn-danger" value="<tag:language.FRM_CANCEL />" />
        </td>
      </tr>
    </table>
  </form>
<div class="panel-footer">
</div>
</div>
<else:language_add>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Site Languages</h4>
</div>
  <table class="lista" width="100%" align="center">
  <tr>
    <td class="head" align="center"><tag:language.LANGUAGE /></td>
    <td class="head" align="center"><tag:language.URL /></td>
    <td class="head" align="center"><tag:language.MEMBERS /></td>
  </tr>
  <loop:languages>
  <tr>
    <td class="lista" align="center"><tag:languages[].language /></td>
    <td class="lista" align="center"><tag:languages[].language_url /></td>
    <td class="lista" align="center"><tag:languages[].language_users /></td>
  </tr>
  </loop:languages>
  <tr>
  <br>
    <td class="header" align="center" colspan="3"><tag:lang_add_new /></td>
  </tr>
  </table>
  <div class="panel-footer">
</div>
</div>
</if:language_add>