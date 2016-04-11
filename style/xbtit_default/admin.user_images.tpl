<div align='center'>
  <form name='user_images' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=user_images'>
    <table>

      <loop:user_images>
      <tr>
        <td class='header' align='right'><tag:language.IMAGE /> <tag:user_images[].number /> - <tag:language.IMAGE />:</td>
        <td class='lista'><input type="text" name="<tag:user_images[].key />_img" value="<tag:user_images[].img />" size="30" /></td>
        <td class='header' align='right'><tag:language.IMAGE /> <tag:user_images[].number /> - <tag:language.TITLE />:</td>
        <td class='lista'><input type="text" name="<tag:user_images[].key />_tit" value="<tag:user_images[].desc />" size="30" /></td>
      </tr>
      </loop:user_images>
      <tr>
        <td class='blocklist' align='center' colspan='4'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>