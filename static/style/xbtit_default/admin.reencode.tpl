<form name="reencode" action="index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=reencode" method="post">
<table class="lista" width="100%" align="center">
  <tr>
    <td class="header" align="center" width="33%"><tag:language.CATEGORY_NAME /></td>
    <td class="header" align="center" width="33%"><tag:language.CATEGORY_IMAGE /></td>
    <td class="header" align="center" width="33%"><tag:language.VIEW_REENC /></td>
  </tr>
  <loop:categories>
  <tr>
    <td class="lista" style="text-align:center"><tag:categories[].name /></td>
    <td class="lista" style="text-align:center"><tag:categories[].image /></td>
    <td class="lista" style="text-align:center"><input type="checkbox" name="<tag:categories[].id />" <tag:categories[].cat_reencode /> /></td>
  </tr>
  </loop:categories>
  <tr>
    <td class="header" align="center" colspan="3"><input type="submit" class="btn" name="new" value="<tag:language.UPDATE />" class="formButton" /></td>
  </tr>
</table>
</form>