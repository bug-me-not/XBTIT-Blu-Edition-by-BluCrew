<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Download Check Settings</h4>
</div>
<div align='center'>
  <form name='dlcheck' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=dlcheck'>
    <table>
        <tr>
          <td class="header"><tag:language.SETTING_MIN_DLRATIO /></td>
          <td class="lista"><input type="text" name="mindlratio" value="<tag:config.mindlratio />" size="3" maxlength="6" /></td>
        </tr>

      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' class='btn btn-md btn-primary' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>
<div class="panel-footer">
</div>
</div>














