<div align='center'>
  <form name='requests' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=requests'>
    <table>
      <tr>
      <td class="header" align="center" colspan="4"><tag:language.TRAV_REQ_SET /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.TRAV_REQ_HO /></td>
      <td class="lista">&nbsp;&nbsp;enable&nbsp;<input type="radio" name="req_onoff" value="true"<tag:config.req_onoffyes /> />&nbsp;&nbsp;disabled&nbsp;<input type="radio" name="req_onoff" value="false"<tag:config.req_onoffno /> /></td>
      <td class="header"><tag:language.TRAV_REQ_IB /></td>
      <td class="lista"><input type="text" name="req_number" value="<tag:config.req_number />" size="4" /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.TRAV_DUFRAP /></td>
      <td class="lista"><input type="text" name="req_prune" value="<tag:config.req_prune />" size="4" /></td>
      <td class="header"><tag:language.TRAV_REQ_PP /></td>
      <td class="lista"><input type="text" name="req_page" value="<tag:config.req_page />" size="4" /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.TRAV_ARIS /></td>
      <td class="lista">&nbsp;&nbsp;enable&nbsp;<input type="radio" name="req_shout" value="true"<tag:config.req_shoutyes /> />&nbsp;&nbsp;disabled&nbsp;<input type="radio" name="req_shout" value="false"<tag:config.req_shoutno /> /></td>
      <td class="header"><tag:language.TRAV_MRU /></td>
      <td class="lista">&nbsp;&nbsp;enable&nbsp;<input type="radio" name="req_maxon" value="true"<tag:config.req_maxonyes /> />&nbsp;&nbsp;disabled&nbsp;<input type="radio" name="req_maxon" value="false"<tag:config.req_maxonno /> /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.TRAV_MNOR /></td>
      <td class="lista" colspan=3><input type="text" name="req_max" value="<tag:config.req_max />" size="4" /></td>
      </tr>
      <tr>
      <td class="header" align="center" colspan="4"><tag:language.TRAV_RRFFAR /></td>
      </tr>
      <tr>
   	  <td class="header"><tag:language.TRAV_RRS /></td>
      <td class="lista">&nbsp;&nbsp;enable&nbsp;<input type="radio" name="req_rwon" value="true"<tag:config.req_rwonyes /> />&nbsp;&nbsp;disabled&nbsp;<input type="radio" name="req_rwon" value="false"<tag:config.req_rwonno /> /></td>
      <td class="header"><tag:language.TRAV_RIUOS /></td>
      <td class="lista">&nbsp;&nbsp;bytes&nbsp;<input type="radio" name="req_sbmb" value="true"<tag:config.req_sbmbyes /> />&nbsp;&nbsp;seedbonus&nbsp;<input type="radio" name="req_sbmb" value="false"<tag:config.req_sbmbno /> /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.TRAV_AIB /></td>
      <td class="lista"><input type="text" name="req_mb" value="<tag:config.req_mb />" size="6" /></td>
      <td class="header"><tag:language.TRAV_SBP /></td>
      <td class="lista"><input type="text" name="req_sb" value="<tag:config.req_sb />" size="4" /></td>
      </tr>
      <tr>
        <td class='blocklist' align='center' colspan='4'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>














