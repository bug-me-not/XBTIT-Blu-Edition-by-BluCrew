<if:faq_add>
  <form name="faq_add_new" action="<tag:frm_action />" method="post">
    <table class="lista">
      <tr>
        <td class="header"><tag:language.FAQ_QUESTION /></td>
        <td class="lista" colspan="3"><input type="text" name="faq_name" size="40" maxlength="255" value="<tag:faq_name />" /></td>
      </tr> 
      <tr>
        <td class="header"><tag:language.FAQ_ANSWER /></td>
        <td class="lista" colspan="3"><tag:faq_description /></td>
      </tr>
      <tr>
        <td class="header"><tag:language.CATEGORY_NAME /></td>
        <td class="lista" colspan="3"><tag:faq_group /></td>
      </tr>
        <td class="header" align="center" colspan="4">
            <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" />&nbsp;&nbsp;&nbsp;
            <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CANCEL />" />
        </td>
      </tr>
    </table>
  </form>
<else:faq_add>
<form name="faq_search" action="<tag:frm_action />" method="post">
    <table class="lista">
      <tr>
        <td class="header">Sort by <tag:language.CATEGORY_NAME /></td>
        <td class="lista" colspan="3"><tag:groups /></td>
      </tr> 
      <td class="header" align="center" colspan="4">
            <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" />&nbsp;&nbsp;&nbsp;
       </td>
   </table>
</form>
  <table class="lista" width="100%" align="center">
  <tr>
    <td class="header" align="center"><tag:language.FAQ_QUESTION /></td>
    <td class="header" align="center"><tag:language.CATEGORY_NAME /></td>
    <td class="header" align="center"><tag:language.FAQ_ANSWER /></td>
    <td class="header" align="center"><tag:language.EDIT /></td>
    <td class="header" align="center"><tag:language.DELETE /></td>
  </tr>
  <loop:categories>
  <tr>
    <td class="lista" align="center"><tag:categories[].name /></td>
    <td class="lista" align="center"><tag:categories[].group_name /></td>
    <td class="lista" align="center" width="50%"><tag:categories[].description /></td>
    

    <td class="lista" align="center"><tag:categories[].edit /></td>
    <td class="lista" align="center"><tag:categories[].delete /></td>
  </tr>
  </loop:categories>
  <tr>
    <td class="header" align="center" colspan="5"><tag:faq_add_new /></td>
  </tr>
  </table>
</if:faq_add>