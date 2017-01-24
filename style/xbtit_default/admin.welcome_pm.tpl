<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Welcome PM Settings</h4>
</div>
<br>
<br>
<br>
<!-- Nav tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#message" data-toggle="tab"><tag:lang.SETUP_MSG /></a></li>
    <li class=""><a href="#preview" data-toggle="tab"><tag:lang.PREVIEW_MSG /></a></li>
</ul>

<div id="myTabContent" class="tab-content"><!-- Main Content Tab Start -->
<div role="tabpanel" class="tab-pane fade in active" id="message"><!-- Tab Start -->
<form name="welcome" method="post" action="<tag:wmact />">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="header"><tag:lang.SUBJECT /></td><td class="lista"><input type="text" name="SUB" value="<tag:wmset.fm_welcome_sub />" size="60"></td></tr>
<tr>
<td class="lista" colspan="2">
<tag:wmbb />
</td>
</tr>
<tr>
<td class="header" colspan="2" style="text-align:center"><input type="submit" class="btn btn-md btn-primary" value="<tag:lang.SUBMIT />"></td>
</tr>
</table>
</form>
</div> <!-- Tab End -->

<div role="tabpanel" class="tab-pane fade" id="preview"><!-- Tab Start -->
<table width="50%" align="center" cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="header"><tag:lang.SUBJECT />:&nbsp;<tag:wmprevsub /></td>
</tr>
<td class="lista" style="text-align:center"><tag:wmprev /></td>
</tr>
</table>
</div> <!-- Tab End -->
</div> <!-- Main Tab Content End -->
<div class="panel-footer">
</div>
</div>
