<div align='center'>
  <form name='archive' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=archive'>
    <table>
      <tr>
        <td class='header' align='right'><tag:language.ARC_OLDER_THAN />:</td>
        <td class='lista'><input type="text" name="quantity" value="<tag:quantity />" size="3" maxlength="2" />&nbsp;
          <select name="timeframe">
            <option value="1"<if:selected1> selected="selected"</if:selected1>><tag:language.ARC_HOURS /></option>
            <option value="2"<if:selected2> selected="selected"</if:selected2>><tag:language.ARC_DAYS /></option>
            <option value="3"<if:selected3> selected="selected"</if:selected3>><tag:language.ARC_WEEKS /></option>
          </select>
        </td>
      </tr>
      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>