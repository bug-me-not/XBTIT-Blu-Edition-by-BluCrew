<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Requests Section Settings</h4>
</div>
<div align='center'>
  <form name='requests' method='post' action='index.php?page=admin&amp;user=<tag:uid />&amp;code=<tag:random />&amp;do=requests'>
    <table>
      <tr>
      <td class="header" align="center" colspan="4"><tag:language.TRAV_REQ_SET /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.TRAV_REQ_HO /></td>
      <td class="lista">&nbsp;&nbsp;enable&nbsp;<input type="radio" name="req_onoff" value="true"<tag:config.req_onoffyes /> />&nbsp;&nbsp;disabled&nbsp;<input type="radio" name="req_onoff" value="false"<tag:config.req_onoffno /> /></td>
      <td class="header"><tag:language.TRAV_ARIS /></td>
      <td class="lista">&nbsp;&nbsp;enable&nbsp;<input type="radio" name="req_shout" value="true"<tag:config.req_shoutyes /> />&nbsp;&nbsp;disabled&nbsp;<input type="radio" name="req_shout" value="false"<tag:config.req_shoutno /> /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.TRAV_MILTPR /></td>
      <td class="lista"><input type="text" name="req_level" value="<tag:config.req_level />" size="4" /></td>
      <td class="header"><tag:language.TRAV_DUFRAP /></td>
      <td class="lista"><input type="text" name="req_prune" value="<tag:config.req_prune />" size="4" /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.TRAV_REQ_PP /></td>
      <td class="lista"><input type="text" name="req_page" value="<tag:config.req_page />" size="4" /></td>
      <td class="header"><tag:language.TRAV_REQ_IB /></td>
      <td class="lista"><input type="text" name="req_limit" value="<tag:config.req_limit />" size="4" /></td>
      </tr>
      <br>
      <br>
      <tr>
      <td class="header" align="center" colspan="4"><tag:language.TRAV_RRFFAR /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.TRAV_MBON /></td>
      <td class="lista"><input type="text" name="req_bon" value="<tag:config.req_bon />" size="6" /></td>
      <td class="header"><tag:language.TRAV_TAX /></td>
      <td class="lista"><input type="text" name="req_tax" value="<tag:config.req_tax />" size="4" /></td>
      </tr>
      <tr>
        <td class='blocklist' align='center' colspan='4'><input type='submit' class='btn btn-md btn-primary' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>
<div class="panel-footer">
</div>
</div>














