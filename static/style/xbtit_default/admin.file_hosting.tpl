<div align='center'>
  <form name='file_hosting' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=file_hosting'>
    <table class="lista" width="100%" cellspacing="0" cellpadding="0">
      <tr>
      <td class="header" align="center" colspan="4"><tag:language.FILE_HOSTING_SETTINGS /></td></td>
      </tr>
      <tr>
      <td class="header"><tag:language.MAX_FILE_SIZE /></td>
      <td class="lista"><input type="text" name="fhost_file_limit" value="<tag:config.fhost_file_limit />" size="10" /></td>
	  <td class="header"><tag:language.DAYS_BEFORE_PRUNE /></td>
      <td class="lista"><input type="text" name="fhost_del" value="<tag:config.fhost_delete_days />" size="5" /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.MIN_ID_LEVEL1 /></td>
      <td class="lista"><input type="text" name="fhost_level_download" value="<tag:config.fhost_level_download />" size="5" /></td>
	  <td class="header"><tag:language.MIN_ID_LEVEL2 /></td>
      <td class="lista"><input type="text" name="fhost_level_upload" value="<tag:config.fhost_level_upload />" size="5" /></td>
      </tr>
      <tr>
      <td class="header"><tag:language.FHOST_PAGE_LIMIT /></td>
      <td class="lista"><input type="text" name="fhost_page_limit" value="<tag:config.fhost_page_limit />" size="5" /></td>
   	  <td class="header"><tag:language.UPLOAD /></td>
      <td class="lista" align="center"<tag:colspan />
	  <select name="fhost_upload" style="background-color:<tag:fhost_upload_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
        <option value="enabled" style="background-color:#00FF00;color:#000000;"<if:fhost_upload_enabled> selected="selected"</if:fhost_upload_enabled>><tag:language.ACP_ENABLED /></option>
	    <option value="disabled" style="background-color:#FF0000;color:#000000;"<if:fhost_upload_disabled> selected="selected"</if:fhost_upload_disabled>><tag:language.ACP_DISABLED /></option>	    
	  </select></td>
      <tr>
   	  <td class="header"><tag:language.TEXT /></td>
      <td class="lista"><input type="text" name="fhost_title" value="<tag:config.fhost_title />" size="50" /></td>	  
  </tr>	
</table>    
<br /> 
<table width="40%" cellspacing="0" cellpadding="0">
    <tr>
  <td colspan="4" align="center"><input type="submit" value="<tag:language.SUBMIT />" /></td>
  </tr>
</form>  
</table>
</div>    