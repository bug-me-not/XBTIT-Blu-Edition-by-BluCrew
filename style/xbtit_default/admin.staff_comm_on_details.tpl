<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Staff Comment Settings</h4>
</div>
<div align='center'>
  <form name='scommdet' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=scommdet'>
    <table>
      <tr>
        <td class='header' align='right'><if:lro_enabled1><tag:language.SCOMM_MIN_SET_LRO /><else:lro_enabled1><tag:language.SCOMM_MIN_SET /></if:lro_enabled1>:</td>
        <td class='lista'><tag:add_notes /></td>
      </tr>
      <tr>
        <td class='header' align='right'><if:lro_enabled2><tag:language.SCOMM_MIN_ADD_LRO /><else:lro_enabled2><tag:language.SCOMM_MIN_ADD /></if:lro_enabled2>:</td>
        <td class='lista'><tag:view_notes /></td>
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