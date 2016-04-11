<div align='center'>
  <form name='protected' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=protuser'>
    <table>
      <tr>
        <td class='header' align='right'><tag:language.PROTUSER_ADD_NAMES />:</td>
        <td class='lista'><textarea name="protusers" rows="5" cols="20"><tag:banned_usernames /></textarea>
        </td>
      </tr>
      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>