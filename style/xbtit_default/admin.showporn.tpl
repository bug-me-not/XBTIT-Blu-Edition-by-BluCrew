<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Show/Hide Porn Settings</h4>
</div>
<div align='center'>
  <form name='showporn' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=showporn'>
    <table>
      <tr>
        <td class='header' align='right'><if:cat_count_is_1><tag:language.SP_PORN_CAT /><else:cat_count_is_1><tag:language.SP_PORN_CATS /></if:cat_count_is_1>:</td>
        <td class='lista'><input type='text' name='porncat' value='<tag:porncat />'</td>
      </tr>
      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' class='btn btn-md btn-primary' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
    <br /><p class="text-warning"><tag:language.SP_MULTI_CAT /></p>
  </form>
</div>
<div class="panel-footer">
</div>
</div>