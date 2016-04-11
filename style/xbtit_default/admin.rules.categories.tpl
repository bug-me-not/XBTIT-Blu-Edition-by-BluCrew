<if:rules_add>
  <form name="rules_add_new" action="<tag:frm_action />" method="post">
    <table class="lista">
      <tr>
        <td class="header"><tag:language.RULE /></td>
        <td class="lista" colspan="3"><input type="text" name="rules_name" size="40" maxlength="255" value="<tag:rules_name />" /></td>
      </tr>  
      <tr>
        <td class="header"><tag:language.CATEGORY_NAME /><tag:language.RULES_SORT /></td>
        <td class="lista" colspan="3"><input type="text" name="rules_sort" size="40" maxlength="255" value="<tag:rules_sort />" /></td>
      </tr> 
        <td class="header" align="center" colspan="4">
            <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" />&nbsp;&nbsp;&nbsp;
            <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CANCEL />" />
        </td>
      </tr>
    </table>
  </form>
<else:rules_add>
  <table class="lista" width="100%" align="center">
  <tr>
    <td class="header" align="center"><tag:language.RULES_SORT /></td>
    <td class="header" align="center"><tag:language.RULE /> <tag:language.CATEGORY_NAME /></td>
    <td class="header" align="center"><tag:language.EDIT /></td>
    <td class="header" align="center"><tag:language.DELETE /></td>
  </tr>
  <loop:categories>
  <tr>
    <td class="lista" align="center"><tag:categories[].sort_index /></td>
    <td class="lista" align="center"><tag:categories[].name /></td>
    <td class="lista" align="center"><tag:categories[].edit /></td>
    <td class="lista" align="center"><tag:categories[].delete /></td>
  </tr>
  </loop:categories>
  <tr>
    <td class="header" align="center" colspan="4"><tag:rules_add_new /></td>
  </tr>
  </table>
</if:rules_add>