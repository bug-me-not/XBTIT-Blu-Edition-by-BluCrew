<br />
<form name="free" action="<tag:frm_action />" method="post">
  <table class="header" width="100%" align="center">
  		<tr>
			<td class="header" colspan="5" width="100%"align="center"><b><tag:language.FL_INFO /></b></td>
        </tr>
        

   <tr>
			<td class="header" width="20%" ><tag:language.FL_DTE /></td>


			<td class="lista"><input type="text" name="expire_date" value="<tag:expire_date />"><small><tag:language.FL_DATE_FORMAT /></small></td>
   </tr>
		
   <tr>
			<td class="header" width="20%" ><tag:language.FL_TTE /></td>
			<td class="lista"><input type="text" name="expire_time" value="<tag:expire_time />"><small><tag:language.FL_HOUR_FORMAT /></small></td>
  </tr>

  <tr>
    <td class="header" width="20%"><tag:language.FL_ENABLE /></td>
    <td class="lista"><input type="checkbox" name="free" <tag:free_checked />/></td>
  </tr>
  
		<tr>
			<td class="header" colspan="5" width="100%"align="center"><b><tag:language.FL_HAPPY_HOUR /></b></td>
        </tr>
  
      <tr>
    <td class="header" width="20%"><tag:language.FL_EN_HAPPY_HOUR /></td>
    <td class="lista"><input type="checkbox" name="happy" <tag:happy_checked />/></td>
  </tr>



  <tr>
    <td colspan="2" class="lista" style="text-align:center;"><input type="submit" class="btn" name="confirm" value="<tag:language.FRM_CONFIRM />" /></td>
  </tr>
</table>
</form>
