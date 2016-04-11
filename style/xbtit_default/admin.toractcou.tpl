<div align='center'>
  <form name='archive' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=toractcou'>
    <table>
      <if:downTorrEnabled1>
      <tr>
        <td class='header' align='right'><tag:language.TAC_SNATCHED_PREFIX />:</td>
        <td class='lista'><input type="text" name="snatched_prefixcolor" value="<tag:settings.snatched_prefixcolor />" size="40" /></td>
      </tr>
      <tr>
        <td class='header' align='right'><tag:language.TAC_SNATCHED_SUFFIX />:</td>
        <td class='lista'><input type="text" name="snatched_suffixcolor" value="<tag:settings.snatched_suffixcolor />" size="40" /></td>
      </tr>
      </if:downTorrEnabled1>
      <tr>
        <td class='header' align='right'><tag:language.TAC_LEECHING_PREFIX />:</td>
        <td class='lista'><input type="text" name="leeching_prefixcolor" value="<tag:settings.leeching_prefixcolor />" size="40" /></td>
      </tr>
      <tr>
        <td class='header' align='right'><tag:language.TAC_LEECHING_SUFFIX />:</td>
        <td class='lista'><input type="text" name="leeching_suffixcolor" value="<tag:settings.leeching_suffixcolor />" size="40" /></td>
      </tr>
      <tr>
        <td class='header' align='right'><tag:language.TAC_SEEDING_PREFIX />:</td>
        <td class='lista'><input type="text" name="seeding_prefixcolor" value="<tag:settings.seeding_prefixcolor />" size="40" /></td>
      </tr>
      <tr>
        <td class='header' align='right'><tag:language.TAC_SEEDING_SUFFIX />:</td>
        <td class='lista'><input type="text" name="seeding_suffixcolor" value="<tag:settings.seeding_suffixcolor />" size="40" /></td>
      </tr>
      <if:downTorrEnabled2>
      <tr>
        <td class='header' align='right'><tag:language.TAC_HIDE_DOWN_IMG />:</td>
        <td class='lista'><tag:language.YES /> <input type="radio" name="hide_down_img" value="yes" <if:checkedYes>checked</if:checkedYes> />&nbsp;&nbsp;&nbsp;&nbsp;<tag:language.NO /> <input type="radio" name="hide_down_img" value="no" <if:checkedNo>checked</if:checkedNo> /></td>
      </tr>
      </if:downTorrEnabled2>
      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />' /></td>
      </tr>
    </table>
  </form>
</div>