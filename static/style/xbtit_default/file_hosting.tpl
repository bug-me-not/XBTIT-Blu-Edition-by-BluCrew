<div align=center>
<form action=index.php name=find method=get>
<input type=hidden name=page value=file_hosting />
<table class="lista" border="0">
<tr>
<td align=center><tag:language.SEARCH_FILE /></td>
<td>&nbsp;</td>
<tr>
<td><input type="text" value="" maxlength="70" size="50" name="searchtext"></td>
<td><input type=submit value="<tag:language.SEARCH />"</td>
</tr>
</table>
</form>
</div>
<div align=center>
<tag:fhost_title />
<br />
<div align=center>
<tag:no_files />
</div>
<br />
<tag:file_hosting_pagertop />
<br />
<tag:fhost1 />
<tag:fhost2 />
<tag:fhost3 />
<loop:file_hostingloop>
<tag:file_hostingloop[].fhost_info />
</loop:file_hostingloop>
<tag:fhost4 />
<tag:fhost5 />
<tag:file_hosting_pagerbottom />
</div>
<if:fhost_upload_enabled>
<div align=center>
<br />
<tag:fhost6 />
<tag:fhost7 />
<tag:fhost8 />
<tag:fhost9 />
<tag:fhost10 />
<tag:fhost11 />
<tag:fhost12 />
</div>
</if:fhost_upload_enabled>