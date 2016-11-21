<style>
div.scroller
{
width:75%;
height:600px;
overflow:auto;
}
</style>
<div align=center>
<br />
<tag:language.HACK_INFO />
<br /><br />
<form name="test" action="index.php?page=admin&amp;user=<tag:uid />&code=<tag:random />&do=hacks&action=read" method="post">
<div class="scroller">
<table class="lista" width="75%" cellspacing="1" cellpadding="6">
  <tr>
    <td class="header"><tag:language.DESCRIPTION /></td>
    <td class="header"><tag:language.HACK_VERSION /></td>
    <td class="header"><tag:language.HACK_AUTHOR /></td>
    <td class="header"><tag:language.HACK_STATUS /></td>
  </tr>

  <cloop:hack>  
  <case:enabled>
  <tr>
    <td class="lista"><tag:hack[].longname /></td>
    <td class="lista"><tag:hack[].version /></td>
    <td class="lista"><tag:hack[].author /></td>
    <td class="lista">
	  <select name="<tag:hack[].shortname />" style="background-color:#00FF00;color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
        <option value="enabled"  style="background-color:#00FF00;color:#000000;" selected><tag:language.HACK_ENABLED /></option>
	    <option value="disabled" style="background-color:#FF0000;color:#000000;"><tag:language.HACK_DISABLED /></option>
	  </select>
	</td>
  </tr>
  </case:enabled>
  <case:disabled>
  <tr>
    <td class="lista"><tag:hack[].longname /></td>
    <td class="lista"><tag:hack[].version /></td>
    <td class="lista"><tag:hack[].author /></td>
    <td class="lista">
	  <select name="<tag:hack[].shortname />" style="background-color:#FF0000;color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
        <option value="enabled" style="background-color:#00FF00;color:#000000;"><tag:language.HACK_ENABLED /></option>
	    <option value="disabled" style="background-color:#FF0000;color:#000000;" selected><tag:language.HACK_DISABLED /></option>
	  </select>
	</td>
  </tr>
  </case:disabled>
  </cloop:hack>
</table></div>
<table class="lista" width="75%" cellspacing="1" cellpadding="6">
    <tr>
    <td class='header' colspan='4' align='center'><b><tag:language.HACK_EN_DIS_ALL /></b></td>
  </tr>
  <tr>
    <td class='lista' colspan='4' style='text-align:center'>
    <tag:language.HACK_SET_ABOVE />: <input type='radio' name='enable_all' value='take_no_action' checked='checked' />&nbsp;&nbsp;|&nbsp;&nbsp;
    <tag:language.HACK_EN_ALL />: <input type='radio' name='enable_all' value='enable_all' onclick="alert('<tag:language.HACK_ENABLE_ALL_WARN />')" />&nbsp;&nbsp;|&nbsp;&nbsp;
    <tag:language.HACK_DIS_ALL />: <input type='radio' name='enable_all' value='disable_all' />
    </td>
  </tr>
  <tr>
  <td colspan=4 class=blocklist align=center><input type="submit" value="<tag:language.SUBMIT />" /></td>
  </tr>
</form>  
</table>
<br /><br />
<tag:language.HACK_INFO_2 />
<br /><br />
</div>
