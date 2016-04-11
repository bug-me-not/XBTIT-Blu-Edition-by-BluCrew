<script type="text/javascript">
var TAG=jQuery.noConflict();
TAG(document).ready(function(){
    TAG("#tag_check").keyup(function(){
		var value = this.value;
		 TAG("#tload").empty().html('<img src="./images/ajax-loader.gif" />');
        TAG("#tload").load("./admin/admin.chk_tag.php?tag="+value);
    });

})
</script>
<if:import>
<table class="header" width="100%" align="center">
<tr>
<td class='lista' colspan='4' style='text-align:center;'>
<tag:language.SMILE_IMPORT />
</td>
</tr>
</table>
</if:import>
<else:import>
<if:in_edit>
<table class="header" width="100%" align="center">
<tr>
<td class='header' colspan='2'>
<tag:language.EDIT />
</td>
</tr>
<form method="POST" action="<tag:edt_frm />">
<input type="hidden" name="old_id" value="<tag:old_id />"> 
<tr>
<td class='header'><tag:language.TAG />:</td><td class='lista'><input id='tag_check' type='text' name='tag' size='6' value='<tag:tag />'><span id="tload"></span></td>
</tr>
<tr>
<td class='header'><tag:language.FILE />:</td><td class='lista'><input size='40' type='text' name='file' value='<tag:img />'></td>
</tr>
<tr>
<td class='header' style='text-align:center;' colspan='2'><input type='submit' value='<tag:language.SUBMIT />'></td>
</tr>
</form>
</table>
<else:in_edit>
<table class="header" width="100%" align="center">
<tr>
<td class='header' colspan='2'>
Add new
</td>
</tr>
<form method="POST" action="<tag:frm />" enctype="multipart/form-data"> 
<tr>
<td class='header'><tag:language.TAG />:</td><td class='lista'><input id='tag_check' type='text' name='tag' size='6'><span id="tload"></span></td>
</tr>
<tr>
<td class='header'><tag:language.FILE />:</td><td class='lista'><input type='file' name='file'></td>
</tr>
<tr>
<td class='header' style='text-align:center;' colspan='2'><input type='submit' value='<tag:language.SUBMIT />'></td>
</tr>
</form>
</table>

<table class="header" width="100%" align="center">

  <tr>

    <td class="header" colspan="5"><tag:language.SMILE_CURR /></td>

  </tr>
  <tr>

    <td class="lista" colspan="5"><tag:pager_top /></td>

  </tr>

  <tr>

    <td class="header"><b><tag:language.TAG /></b></td>

    <td class="header"><b><tag:language.FILE /></b></td>
    
    <td class="header"><b><tag:language.RESULT /></b></td>
    <td class="header"><b><tag:language.EDIT /></b></td>
    <td class="header"><b><tag:language.DELETE /></b></td>

  </tr>

  <loop:smile>

  <tr>

    <td class="lista" style="text-align:center;"><tag:smile[].code /></td>

    <td class="lista" style="text-align:center;"><tag:smile[].url /></td>
    <td class="lista" style="text-align:center;"><img border='0' src='images/smilies/<tag:smile[].url />' alt='<tag:smile[].code />' title='<tag:smile[].code />'></td>
    <td class="lista" style="text-align:center;"><a href='<tag:edt />&amp;id=<tag:smile[].url />'><tag:language.EDIT /></a></td>
    <td class="lista" style="text-align:center;"><a href='<tag:del />&amp;id=<tag:smile[].url />'><tag:language.DELETE /></a></td>

  </tr>

  </loop:smile>

  <tr>

    <td class="lista" colspan="5"><tag:pager_bottom /></td>

  </tr>

</table>
</if:in_edit>
</if:import>