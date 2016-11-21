<div align='center'>
  <form name='random_reg' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=random_reg'>
    <table>

      <tr>
        <td class='header'><tag:language.RREG_OPEN_FOR /></td>
        <td class='lista' colspan='2'><input type='text' name='rreg_open_for' value='<tag:config.rreg_open_for />' size='5' />&nbsp;&nbsp;<tag:language.RREG_MINUTES /> <tag:language.RREG_AT_A_TIME /></td>
      </tr>

      <tr>
        <td class='header'><tag:language.RREG_RANDOM_WINDOW /></td>
        <td class='lista'>Between <input type='text' name='rreg_min' value='<tag:config.rreg_min />' size='5' /> <tag:language.WORD_AND /> <input type='text' name='rreg_max' value='<tag:config.rreg_max />' size='5' /> <tag:language.RREG_MINUTES /> <tag:language.RREG_AF_CLOSE /></td>
      </tr>

      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>