<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Staff Recommended Torrents Settings</h4>
</div>
<div align='center'>
  <form name='recommend' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=recommend'>
    <table>
      <tr>
        <td class='header' align='right'><tag:language.RTORR_MAX_TO_DISP />:</td>
        <td class='lista'><input type='text' name='recommended' value='<tag:recommended />' size='3' maxlength='3' /></td>
      </tr>
      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' class='btn btn-md btn-primary' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>
<div class="panel-footer">
</div>
</div>