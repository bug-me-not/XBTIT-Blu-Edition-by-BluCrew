<form action="<tag:frm_action />" name="requests" method="post">
  <table class="lista" width="100%" align="center">
  <if:nodb>
    <tr>
      <td class="lista" colspan="4" style="color:red;text-align:center;"><tag:language.REQUESTS_NO_DB /><br /><tag:xtd.URL /></td>
    </tr>
  <else:nodb>
    <if:config>
    <tr>
      <td class="lista" colspan="4" style="color:green;text-align:center;"><tag:language.CONFIG_SAVED /></td>
    </tr>
    </if:config>
    <tr>
      <td class="header" align="center" colspan="4"><tag:language.KHEZ_MAIN /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.ENABLED /></td>
      <td class="lista" colspan="3"><input type="checkbox" name="enabled" <tag:xtd.ENABLED /> /></td>
    </tr>
    <tr>
       <td class="header" align="center" colspan="4"><tag:language.XTD_ACP /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.XTD_IMG /></td>
      <td class="lista"><input type="text" name="img" value="<tag:xtd.IMG />" size="20" /></td>
      <td class="header"><tag:language.XTD_URL /></td>
      <td class="lista"><input type="text" name="url" value="<tag:xtd.URL />" size="20" /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.XTD_CHARS /></td>
      <td class="lista"><input type="text" name="chars" value="<tag:xtd.CHARS />" size="20" /></td>
      <td class="header">&nbsp;</td>
      <td class="lista">&nbsp;</td>
    </tr>
		<tr>
      <td class="header"><tag:language.XTD_FILE /></td>
      <td class="lista" colspan="3"><input type="text" name="file" value="<tag:xtd.FILE />" size="90" /></td>
		</tr>
    <tr>
      <td class="header"><tag:language.XTD_CASE /></td>
      <td class="lista"><input type="checkbox" name="case" <tag:xtd.CASE /> /></td>
      <td class="header"><tag:language.XTD_SEARCH /></td>
      <td class="lista"><tag:xtd.LOC /></td>
    </tr>
    <tr>
      <td align="center" class="header" colspan="2" width="50%"><input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" /></td>
      <td align="center" class="header" colspan="2" width="50%"><input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CANCEL />" /></td>
    </tr>
  </if:nodb>
  </table>
</form>