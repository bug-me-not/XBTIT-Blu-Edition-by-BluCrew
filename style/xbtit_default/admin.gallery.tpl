<link rel="stylesheet" href="./css/jquery.multiselect2side.css" type="text/css" media="screen" />
<script type="text/javascript" src="./jscript/jquery.multiselect2side.js" ></script>
<script type="text/javascript">
var $w = jQuery.noConflict();
$w(document).ready(function() {
$w(":submit").addClass("btn");
$w('#grouplist').multiselect2side({
		selectedPosition: 'left',
		moveOptions: false,
		labelsx: '',
		labeldx: '',
		autoSort: true,
		autoSortAvailable: true
});
});
</script>
<table width="60%" class="main" cellpadding="0" cellspacing="0" border="0" align="center">
<tr>

   <form name="gallery" action="<tag:frm_action />" method="post">
<td class="header" style="text-align:left;font-size:12px;">&nbsp;
      <tag:language.GALLERY_MFS /></td>
      <td class="lista" style="text-align:left;">
      <input name="mfs" id="mfs" type="text" size="10" value="<tag:settings.gallery_mfs />" />
</td>
<td class="header" style="text-align:left;font-size:12px;">&nbsp;
      <tag:language.GALLERY_PTH /></td>
      <td class="lista" style="text-align:left;width:200px;">&nbsp;
      <input name="pth" id="pth" type="text" size="10" value="<tag:settings.gallery_pth />" />
</td>
</tr>

</tr>

<tr>
<td class="header" colspan="4" style="text-align:center;">&nbsp;
      <tag:language.GALLERY_GRP />
</td>

</tr>

<tr>
<td class="lista" width="100%" valign="top" colspan="4" style="vertical-align:top;text-align:center;">
<table width="100%">
<tr>
<td class="block" width="50%" style="text-align:center;"><tag:language.GALLERY_SEL /></td><td class="block" width="50%" style="text-align:center;"><tag:language.GALLERY_NOL /></td>
</tr>
<td class="lista" colspan="3" align="center" style="text-align:center;">&nbsp;&nbsp;&nbsp;
<div class="group_contain" style="float:center;">
<tag:groupie />
</div>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="header" style="text-align:center;" colspan="4">
      <input type="submit" value="<tag:language.SUBMIT />" />
      </td></tr>
    </form>
</table>
<br />
