<form method="post" name="password" action="<tag:pwd.frm_action />">
  <table class="lista" width="100%" align="center">
    <tr>
      <td class="header" align="left"><tag:language.OLD_PWD />:</td>
      <td class="lista"><input type="password" name="old_pwd" size="40" maxlength="40" /></td>
    </tr>
    <tr>
      <td class="header" align="left"><tag:language.USER_PWD />:</td>
      <td class="lista">
        <tag:language.SECSUI_ACC_PWD_1 /><br />
        <li><tag:language.SECSUI_ACC_PWD_2 /> <span style="color:blue;font-weight:bold;"><tag:pass_min_char /></span> <if:pass_char_plural><tag:language.SECSUI_ACC_PWD_3A /><else:pass_char_plural><tag:language.SECSUI_ACC_PWD_3 /></if:pass_char_plural></li>
        <if:pass_lct_set><li><tag:language.SECSUI_ACC_PWD_4 /> <span style="color:blue;font-weight:bold;"><tag:pass_min_lct /></span> <if:pass_lct_plural><tag:language.SECSUI_ACC_PWD_5A /><else:pass_lct_plural><tag:language.SECSUI_ACC_PWD_5 /></if:pass_lct_plural></li></if:pass_lct_set>
        <if:pass_uct_set><li><tag:language.SECSUI_ACC_PWD_4 /> <span style="color:blue;font-weight:bold;"><tag:pass_min_uct /></span> <if:pass_uct_plural><tag:language.SECSUI_ACC_PWD_6A /><else:pass_uct_plural><tag:language.SECSUI_ACC_PWD_6 /></if:pass_uct_plural></li></if:pass_uct_set>
        <if:pass_num_set><li><tag:language.SECSUI_ACC_PWD_4 /> <span style="color:blue;font-weight:bold;"><tag:pass_min_num /></span> <if:pass_num_plural><tag:language.SECSUI_ACC_PWD_7A /><else:pass_num_plural><tag:language.SECSUI_ACC_PWD_7 /></if:pass_num_plural></li></if:pass_num_set>
        <if:pass_sym_set><li><tag:language.SECSUI_ACC_PWD_4 /> <span style="color:blue;font-weight:bold;"><tag:pass_min_sym /></span> <if:pass_sym_plural><tag:language.SECSUI_ACC_PWD_8A /><else:pass_sym_plural><tag:language.SECSUI_ACC_PWD_8 /></if:pass_sym_plural></li></if:pass_sym_set>
        <input type="password" name="new_pwd" size="40" maxlength="40" />
      </td>
    </tr>
    <tr>
      <td class="header" align="left"><tag:language.USER_PWD_AGAIN />:</td>
      <td class="lista"><input type="password" name="new_pwd1" size="40" maxlength="40" /></td>
    </tr>

    <tr>
      <td align="center" class="header" colspan="2">
    <table align="center" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><input type="submit" class="btn" name="confirm" value="<tag:language.FRM_CONFIRM />"/></td>
        <td align="center"><input type="button" class="btn" name="confirm" onclick="javascript:window.open('<tag:pwd.frm_cancel />','_self');" value="<tag:language.FRM_CANCEL />"/></td>
      </tr>
    </table>
      </td>
    </tr>
  </table>
</form>