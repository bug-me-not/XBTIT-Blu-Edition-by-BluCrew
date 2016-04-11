<div align='center'>
  <form name='avatar_upload' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=avatar_upload'>
    <table>
      <tr>
        <td class='header' align='right'><tag:language.MAX_FILE_SIZE />:</td>
        <td class='lista'><input type="text" id="img_file_size" name="img_file_size" value="<tag:img_file_size />" size="8" /></td>
      </tr>
      <tr>
        <td class='header' align='right'><tag:language.MAX_IMAGE_SIZE />:</td>
        <td class='lista'><tag:language.IMAGE_WIDTH /> <input type="text" id="img_size_width" name="img_size_width" value="<tag:img_size_width />" size="4" /> <tag:language.IMAGE_HEIGHT /> <input type="text" id="img_size_height" name="img_size_height" value="<tag:img_size_height />" size="4" /></td>
      </tr>
      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>
