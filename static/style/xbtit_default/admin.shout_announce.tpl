<div align='center'>
  <form name='shout_announce' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=shout_announce'>
    <table>
      <tr>
        <td class='header' align='right'><tag:language.SHOUTANN_SHOW_UP />:</td>
        <td class='lista'><input type="radio" name="shoutann_display_uploader" value="yes"<if:sdu_yes> checked="yes"</if:sdu_yes> /> <tag:language.YES /><br />
<input type="radio" name="shoutann_display_uploader" value="no"<if:sdu_no> checked="yes"</if:sdu_no> /> <tag:language.NO /></td>
      </tr>
      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>