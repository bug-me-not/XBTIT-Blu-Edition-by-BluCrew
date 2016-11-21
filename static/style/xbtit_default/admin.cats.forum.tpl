<table class="lista" width="100%" align="center">
  <tr>
    <td align="center" colspan="3">
	  <table class="lista" width="100%" align="center">
	  <form name="<tag:categories[].frm_number />" action="<tag:frm1_action />" method="post">
		<tr>
    	  <td align="center" colspan="2"><tag:language.AUTOTOPIC_MESS1 /></td>
  		</tr>
	    <tr>
		  <td class="header" width="50%"><tag:language.AUTOTOPIC_ACTIVE /></td>
          <td class="lista" width="50%">&nbsp;<tag:language.YES />&nbsp;<input type="radio" name="autotopic" value="true"<tag:config.topicon /> />&nbsp;<tag:language.NO />&nbsp;<input type="radio" name="autotopic" value="false"<tag:config.topicoff /> /></td>
		</tr>
	    <tr>
		  <td class="header" width="50%"><tag:language.AUTOTOPIC_PREFIX /></td>
          <td class="lista" width="50%"><input type="text" name="tagtopic" size="40" value="<tag:config.smftag />"></td>
		</tr>
		<tr>
    	  <td class="header" align="center" colspan="2"><input type="submit" class="btn" value="<tag:language.FRM_CONFIRM />" /></td>
  		</tr>
	  </form>
	  </table>
	</td>
  </tr>
  <tr>
	<td align="center" colspan="3"><tag:language.AUTOTOPIC_MESS2 /></td>
  </tr>
  <tr>
    <td class="header" align="center" width="33%"><tag:language.CATEGORY_NAME /></td>
    <td class="header" align="center" width="33%"><tag:language.CATEGORY_IMAGE /></td>
    <td class="header" align="center" width="33%"><tag:language.FORUM /></td>
  </tr>
  <loop:categories>
<form name="<tag:categories[].frm_number />" action="<tag:frm2_action />" method="post">
  <tr>
    <td class="lista" align="center"><tag:categories[].name /></td>
    <td class="lista" align="center"><tag:categories[].image /></td>
    <td class="lista" align="center"><tag:categories[].smf_select /></td>
  </tr>
  </form>
  </loop:categories>
  <tr>
    <td class="header" align="center" colspan="3"><!--<input type="submit" class="btn" name="new" value="<tag:language.UPDATE />" class="formButton" />--!></td>
  </tr>
  </table>