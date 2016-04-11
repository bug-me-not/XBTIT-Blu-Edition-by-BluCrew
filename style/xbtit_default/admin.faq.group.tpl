<if:faq_add>
  <form name="faq_add_new" action="<tag:frm_action />" method="post">
    <table class="lista">
      <tr>
        <td class="header"><tag:language.FAQ_NAME /></td>
        <td class="lista" colspan="3"><input type="text" name="faq_name" size="40" maxlength="255" value="<tag:faq_name />" /></td>
      </tr> 
      <tr>
        <td class="header"><tag:language.FAQ_TEXT /></td>
        <td class="lista" colspan="3"><textarea name="faq_description" style="width:500px; height:150px;"><tag:faq_description /></textarea></td>
      </tr>
      <tr>
        <td class="header"><tag:language.FAQ_SORT_INDEX /></td>
        <td class="lista"><input  name="sort_index" value="<tag:faq_sort />" size="10" maxlength="10" /></td>
      </tr>
        <td class="header" align="center" colspan="4">
            <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" />&nbsp;&nbsp;&nbsp;
            <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CANCEL />" />
        </td>
      </tr>
    </table>
  </form>
<else:faq_add>
  <table class="lista" width="100%" align="center">
  <tr>
    <td class="header" align="center"><tag:language.FAQ_SORT_INDEX /></td>
    <td class="header" align="center"><tag:language.FAQ_NAME /></td>

    <td class="header" align="center"><tag:language.EDIT /></td>
    <td class="header" align="center"><tag:language.DELETE /></td>
  </tr>
  <loop:faq>
  <tr>
    <td class="lista" align="center"><tag:faq[].sort_index /></td>
    <td class="lista" align="center"><tag:faq[].name /></td>

    <td class="lista" align="center"><tag:faq[].edit /></td>
    <td class="lista" align="center"><tag:faq[].delete /></td>
  </tr>
  </loop:faq>
  <tr>
    <td class="header" align="center" colspan="5"><tag:faq_add_new /></td>
  </tr>
  </table>
</if:faq_add>