<div align='center'>
  <form name='ulrights' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=ulrights'>
    <table>
      <tr>
        <td class='header' align='right'><tag:language.UPRI_EDIT />:</td>
        <td class='lista'><input type="radio" name="ulri_edit" value="yes"<if:edit_yes> checked="yes"</if:edit_yes> /> <tag:language.YES /><br />
<input type="radio" name="ulri_edit" value="no"<if:edit_no> checked="yes"</if:edit_no> /> <tag:language.NO /></td>
      </tr>
      <tr>
        <td class='header' align='right'><tag:language.UPRI_DELETE />:</td>
        <td class='lista'><input type="radio" name="ulri_delete" value="yes"<if:delete_yes> checked="yes"</if:delete_yes> /> <tag:language.YES /><br />
<input type="radio" name="ulri_delete" value="no"<if:delete_no> checked="yes"</if:delete_no> /> <tag:language.NO /></td>
      </tr>
      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>