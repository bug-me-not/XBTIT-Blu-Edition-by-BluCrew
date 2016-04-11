<div align='center'>
  <form name='img_in_shout' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=img_in_shout'>
    <table>

      <tr>
      <td class="header" align="center" colspan="4"><tag:language.IMGSB_SETTINGS /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.IMGSB_AFTER /></td>
      <td class="lista"><input type="text" name="don_chat" value="<tag:config.don_chat />" size="5" /></td>
      <td class="header"><tag:language.IMGSB_TYPE /></td>
      <td class="lista"><tag:language.IMGSB_IMAGES />&nbsp;<input type="radio" name="type_chat" value="image" <tag:config.chat_checked1 /> />&nbsp;&nbsp;<tag:language.IMGSB_TEXT />&nbsp;<input type="radio" name="type_chat" value="text"<tag:config.chat_checked2 /> />&nbsp;&nbsp;<tag:language.IMGSB_BOTH />&nbsp;<input type="radio" name="type_chat" value="both"<tag:config.chat_checked3 /> /></td>
      </tr>

      <tr>
        <td class='blocklist' align='center' colspan='4'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>
