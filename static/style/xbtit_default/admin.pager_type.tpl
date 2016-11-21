<div align='center'>
  <form name='pgtype' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=pgtype'>
    <table>
      <tr>
        <td class='header' align='right'><tag:language.PG_TYPE />:</td>
        <td class='lista'><input type="radio" name="pager_type" value="old"<if:pg_old> checked="yes"</if:pg_old> /> <tag:language.PG_OLD /><br />
<input type="radio" name="pager_type" value="new"<if:pg_new> checked="yes"</if:pg_new> /> <tag:language.PG_NEW /></td>
      </tr>
      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>