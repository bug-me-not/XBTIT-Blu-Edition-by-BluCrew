<table class='lista' align='center'>
<tr align=center><td class=header width=90><tag:language.USER_NAME /></td>
<td class=header><tag:language.EMAIL /></td>
<td class=header><tag:language.USER_JOINED /></td>
<td class=header><tag:language.USER_LASTACCESS /></td>
<td class=header><tag:language.DOWNLOADED /></td>
<td class=header><tag:language.UPLOADED /></td>
<td class=header><tag:language.RATIO /></td>
<td class=header><tag:language.LAST_IP /></td></tr>

<loop:users>
<tr>
<td align=left  class=lista><b><a href='index.php?page=userdetails&id=<tag:users[].ID />'><tag:users[].USER_NAME /></b></a></td>
<td align=center class=lista><tag:users[].EMAIL /></td>
<td align=center class=lista><tag:users[].ADDED /></td>
<td align=center class=lista><tag:users[].LAST_ACCESS /></td>
<td align=center class=lista><tag:users[].DOWNLOADED /></td>
<td align=center class=lista><tag:users[].UPLOADED /></td>
<td align=center class=lista><tag:users[].RATIO /></td>
<td align=center class=lista><tag:users[].IP /></td></tr>
</loop:users>

</table>