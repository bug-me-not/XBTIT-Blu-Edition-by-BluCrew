  <br />
  <form name='increment' action='index.php?page=warn&amp;id=<tag:id />&amp;type=<tag:type />' method='post'>
    <table align='center'>
      <tr>
        <td class='header'><if:inc><tag:language.WS_RFW /><else:inc><tag:language.WS_RFRW /></if:inc>:</td>
        <td class='lista'><tag:testing /></td>
      </tr>
      <tr>
        <td class='header'><tag:language.WS_SEND_PM />:</td>
        <td class='lista'><select name='pm'><option value='yes' selected><tag:language.YES /></option><option value='no'><tag:language.NO /></option></select></td>
      </tr>
      <tr>
        <td class='header' colspan='2' align='center'><input type='submit' name='submit' value='<tag:language.WS_SUBMIT />'></td>
      </tr>
    </table>
  </form>