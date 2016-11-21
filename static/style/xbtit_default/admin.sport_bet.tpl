<div align='center'>
  <form name='sport_bet' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=sport_bet'>
    <table>

      <tr>
       <td class="header"><tag:language.SB_MIN_IDL_2_BET /></td>
      <td class="lista"><tag:formSelect /></td>
      <td class="header"><tag:language.SB_FOR_ID /></td>
      <td class="lista"><input type="text" name="fid_bet" value="<tag:config.fid_bet />" size="7" /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.SB_MAX_BON /></td>
      <td class="lista"><input type="text" name="max_bon_bet" value="<tag:config.max_bon_bet />" size="7" /></td>
      <td class="header"><tag:language.SB_FOR_USER_ID /></td>
      <td class="lista"><input type="text" name="fid_bet_user" value="<tag:config.fid_bet_user />" size="7" /></td>
      </tr>

      <tr>
        <td class='blocklist' align='center' colspan='4'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>