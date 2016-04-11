<script type="text/javascript" src="jscript/btit_functions.js"></script>
<div align='center'>
  <form name='config' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=apply_membership'>
    <table class="lista" width="100%" cellspacing="0" cellpadding="0">
      <tr>
      <td class="header"><tag:language.ACP_STAFF_ID /></td>
      <td class="lista"><input type="text" name="apply_id" value="<tag:config.apply_id />" size="4" /></td>
      <td class="header"><tag:language.ACP_SEND_STAFF /></td>
            <td class="lista" align="center"<tag:colspan />
	  <select name="apply_all" style="background-color:<tag:apply_all_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
        <option value="enabled" style="background-color:#00FF00;color:#000000;"<if:apply_all_enabled> selected="selected"</if:apply_all_enabled>><tag:language.ACP_ENABLED /></option>
	    <option value="disabled" style="background-color:#FF0000;color:#000000;"<if:apply_all_disabled> selected="selected"</if:apply_all_disabled>><tag:language.ACP_DISABLED /></option>	    
	  </select></td>
</table>
<br />
<div align='center'>
  <form name='config' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=apply_membership'>
  <table class="lista" width="100%" align="center">
      <tr>
      <td class="header" align="center" colspan="4"><tag:language.ACP_APPLY_RULES /></td>
      </tr>
      <tr>
      <td class="header" valign="top" colspan="1"><tag:language.ACP_TEXT_BOX /></td>
      <td class="lista" colspan="3"><textarea name="apply_rules_text" rows="3" cols="60"><tag:config.apply_rules_text /></textarea></td>
      </tr>
      <tr>
      </tr>
  </table>
</form>    
<br /> 
<table width="40%" cellspacing="0" cellpadding="0">
    <tr>
  <td colspan="4" align="center"><input type="submit" value="<tag:language.SUBMIT />" /></td>
  </tr>
</form>  
</table>
</div>    