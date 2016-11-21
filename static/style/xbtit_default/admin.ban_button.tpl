<div align='center'>
  <form name='ban_button' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=ban_button'>
    <table>

      <tr>
      <td class="header"><tag:language.BB_LEVEL /></td>
      <td class="lista"><tag:formSelect /></td>
      <td class="header"><tag:language.BB_DAYS /></td>
      <td class="lista"><input type="text" name="bandays" value="<tag:config.bandays />" size="10" /></td>
      </tr>

      <tr>
        <td class='blocklist' align='center' colspan='4'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>