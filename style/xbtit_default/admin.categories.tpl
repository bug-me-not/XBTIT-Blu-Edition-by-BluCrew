<script language="javascript" type="text/javascript">
<!--
function update_cat(newimage,blank)
{
  if (newimage!="")
     document.cat_image.src = "<tag:image_url />" + newimage;
  else
     document.cat_image.src = blank;
}
//-->
</script>

<if:category_add>
  <form name="category_add_new" action="<tag:frm_action />" method="post">
    <table class="lista">
      <tr>
        <td class="header"><tag:language.CATEGORY_NAME /></td>
        <td class="lista" colspan="3"><input type="text" name="category_name" size="40" maxlength="20" value="<tag:category_name />" /></td>
      </tr>
      <tr>
        <td class="header"><tag:language.CATEGORY_SUB /></td>
        <td class="lista"><tag:subcat_combo /></td>
        <td class="header"><tag:language.CATEGORY_SORT_INDEX /></td>
        <td class="lista"><input  name="sort_index" value="<tag:category_sort />" size="10" maxlength="10" /></td>
      </tr>
      <tr>
        <td class="header"><tag:language.CATEGORY_IMAGE /></td>
        <td class="lista" valign="middle"><tag:image_combo /></td>
        <td class="lista" colspan="2"><img name="cat_image" src="<tag:category_image />" alt="" border="0" style="float:left;" /></td>
      </tr>
      <tr>
        <td class="header" align="center" colspan="4">
            <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" />&nbsp;&nbsp;&nbsp;
            <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CANCEL />" />
        </td>
      </tr>
    </table>
  </form>
<else:category_add>
  <table class="lista" width="100%" align="center">
  <tr>
    <td class="header" align="center"><tag:language.CATEGORY_SORT_INDEX /></td>
    <td class="header" align="center"><tag:language.CATEGORY_NAME /></td>
    <td class="header" align="center"><tag:language.CATEGORY_IMAGE /></td>
    <td class="header" align="center"><tag:language.EDIT /></td>
    <td class="header" align="center"><tag:language.DELETE /></td>
  </tr>
  <loop:categories>
  <tr>
    <td class="lista" align="center"><tag:categories[].sort_index /></td>
    <td class="lista" align="center"><tag:categories[].name /></td>
    <td class="lista" align="center"><tag:categories[].image /></td>
    <td class="lista" align="center"><tag:categories[].edit /></td>
    <td class="lista" align="center"><tag:categories[].delete /></td>
  </tr>
  </loop:categories>
  <tr>
    <td class="header" align="center" colspan="5"><tag:category_add_new /></td>
  </tr>
  </table>
</if:category_add>