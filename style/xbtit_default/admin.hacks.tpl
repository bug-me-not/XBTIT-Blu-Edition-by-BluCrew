<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Hacks</h4>
</div>
<div align=center>
<br />
<div class="alert alert-dismissable alert-bg-white alert-info">
<button data-dismiss="alert" class="close" type="button">×</button>
<div class="icon"><i class="fa fa-info"></i></div>
<strong><tag:language.HACK_INFO /></strong>
</div>
</div>
<br /><br />
<form name="test" action="index.php?page=admin&amp;user=<tag:uid />&code=<tag:random />&do=hacks&action=read" method="post">
<table class="lista" width="100%" cellspacing="1" cellpadding="6">
  <tr>
    <td class="head"><tag:language.DESCRIPTION /></td>
    <td class="head"><tag:language.HACK_VERSION /></td>
    <td class="head"><tag:language.HACK_AUTHOR /></td>
    <td class="head"><tag:language.HACK_STATUS /></td>
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
</table>
<div class="panel-footer">
</div>
</div>

<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Mass Enable/Disable Hacks</h4>
</div>
<table class="lista" width="100%" cellspacing="1" cellpadding="6">
  <tr>
    <td class='lista' colspan='12' style='text-align:center'>
    <tag:language.HACK_SET_ABOVE />: <input type='radio' name='enable_all' value='take_no_action' checked='checked' />&nbsp;&nbsp;|&nbsp;&nbsp;
    <tag:language.HACK_EN_ALL />: <input type='radio' name='enable_all' value='enable_all' onclick="alert('<tag:language.HACK_ENABLE_ALL_WARN />')" />&nbsp;&nbsp;|&nbsp;&nbsp;
    <tag:language.HACK_DIS_ALL />: <input type='radio' name='enable_all' value='disable_all' />
    </td>
  </tr>
  <tr>
  <td colspan=4 class=blocklist align=center><input type="submit" class="btn btn-md btn-primary" value="<tag:language.SUBMIT />" /></td>
  </tr>
</form>  
</table>
</div>
<div class="panel-footer">
</div>
</div>