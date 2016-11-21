<form name='warnset' action='index.php?page=admin&user=<tag:CURUSER.uid />&code=<tag:CURUSER.random />&do=warn_settings' method='post'>
  <table align=center>
    <tr>
      <td class='header'><b><tag:language.WS_MAX_WL />:</b></td>
      <td class='lista'><input type='text' name='warn_max' value='<tag:btit_settings.warn_max />' size='4' maxlength='4' /></td>
    </tr>
    <tr>
      <td class='header'><b><tag:language.WS_AUTO_DOWN />:</b></td>
      <td class='lista'><input type='checkbox' name='warn_auto_down_enable' <if:wad_enabled>checked='checked'</if:wad_enabled> /></td>
    </tr>
    <tr>
      <td class='header'><b><tag:language.WS_AUTO_DOWN_INT />:</b></td>
      <td class='lista'><input type='text' name='warn_auto_decrease' value='<tag:btit_settings.warn_auto_decrease />' size='4' maxlength='4' /></td>
    </tr>
    <if:booted_enabled>
    <tr>
      <td class='header'><b><tag:language.WS_BOOT_AT_MAX />:</b></td>
      <td class='lista'><input type='radio' name='warn_bantype' value='boot_at_max'<if:bam_checked>checked='checked'</if:bam_checked> />&nbsp;&nbsp;&nbsp;<tag:language.FOR />&nbsp;&nbsp;<input type='text' name='warn_booted_days' value='<tag:btit_settings.warn_booted_days />' size='4' maxlength='4' />&nbsp;&nbsp;<tag:language.WS_DEC_IN_DAYS_2 /></td>
    </tr>
    </if:booted_enabled>
    <tr>
      <td class='header'><b><tag:language.WS_TAKE_NO_ACTION_AT_MAX />:</b></td>
      <td class='lista'><input type='radio' name='warn_bantype' value='no_action_at_max' <if:tna_checked>checked='checked'</if:tna_checked> /></td>
    </tr>
    <tr>
      <td class='header' colspan='2' align='center'><input type='submit' name='submit' value='<tag:language.WS_SUBMIT />' /></td>
    </tr>

  </table>
</form>