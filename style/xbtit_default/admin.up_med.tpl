<div align='center'>
  <form name='up_med' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=up_med'>
    <table>

      <tr>
      <td class="header" align="center" colspan="4"><tag:language.UM_UPLOADER_MED /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.UM_HOW_MANY /></td>
      <td class="lista"><input type="text" name="UPD" value="<tag:config.UPD />" size="5" /></td>
      <td class="header"><tag:language.UM_BRONZE_COUNT /></td>
      <td class="lista"><input type="text" name="UPB" value="<tag:config.UPB />" size="5" /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.UM_SILVER_COUNT /></td>
      <td class="lista"><input type="text" name="UPS" value="<tag:config.UPS />" size="5" /></td>
      <td class="header"><tag:language.UM_GOLD_COUNT /></td>
      <td class="lista"><input type="text" name="UPG" value="<tag:config.UPG />" size="5" /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.UM_SHOWALL /></td>
      <td class="lista"><tag:language.UM_ALLRANKS />&nbsp;<input type="radio" name="UPC" value="true"<tag:config.UPCyes /> /><br /><tag:language.UM_UPONLY />&nbsp;<input type="radio" name="UPC" value="false"<tag:config.UPCno /> /></td>
      <td class="header"><tag:language.UM_BLOCK_LIMIT /></td>
      <td class="lista"><input type="text" name="UPBL" value="<tag:config.UPBL />" size="5" /></td>
      </tr>

      <tr>
        <td class='blocklist' align='center' colspan='4'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>
