<if:is_edit>
<br />
<table width='20%' class='lista' cellpadding=1 align=center>
<tr>
<td class=block colspan=4><center><tag:language.EDIT_STYLE_BRIDGE /></center></td></tr>
<form method='post' action='<tag:edit_poster />'>
<input type='hidden' name='id' value='<tag:ed.id />'>
<td class=header><tag:language.EDITXB_STYLE_BRIDGE /></td><td class=lista width=40><input type='text' name='xbtit_theme' size='5' maxlength='10' value='<tag:ed.xbtit />'></td>
<td class=header><tag:language.EDITSM_STYLE_BRIDGE /></td><td class=lista width=40><input type='text' name='smf_theme' size='5' maxlength='10' value='<tag:ed.smf />'></td></tr>
<tr>
<td class=header colspan=4><center><input class=btn type=submit value='<tag:language.EDITBTN_STYLE_BRIDGE />'></center></td></tr>
</table>
</form>
<br />
<center><a href='javascript:history.back();'><tag:language.BACK />
<else:is_edit>
<table width='100%' class='lista'>
<tr>
<td>
<table width='100%' class='lista'>
<tr>
<td colspan=2 class=block><center><tag:language.HEADXB_STYLE_BRIDGE /></center></td></tr><tr>
<td class=header><tag:language.HEADID_STYLE_BRIDGE /></td><td class=header><tag:language.HEADSTYLE_STYLE_BRIDGE /></td></tr>
<loop:btitlist>
<tr>
<td class=lista>
<tag:btitlist[].id />
</td>
<td class=lista>
<tag:btitlist[].style />
</td>
</tr>
</loop:btitlist>
</table>
</td>
<td valign=top>
<table width='100%' class='lista'>
<tr>
<td colspan=2 class=block><center><tag:language.HEADSM_STYLE_BRIDGE /></center></td></tr><tr>
<td class=header><tag:language.HEADID_STYLE_BRIDGE /></td><td class=header><tag:language.HEADSTYLE_STYLE_BRIDGE /></td></tr>
<loop:smflist>
<tr>
<td class=lista>
<tag:smflist[].ID_THEME />
</td>
<td class=lista>
<tag:smflist[].name />
</td>
</tr>
</loop:smflist>
</table>
</td>
</tr>
</table>

<br />
<table width='100%' class='lista'align=center>
<tr>
<td class=block colspan=3><center><tag:language.HEADCURR_STYLE_BRIDGE /></center></td></tr>
<tr>
<td class=header><center><tag:language.HEADXB_STYLE_BRIDGE /></center></td><td class=header><center><tag:language.HEADSM_STYLE_BRIDGE /></center></td><td class=header><center><tag:language.EDDEL_STYLE_BRIDGE /></center></td></tr>
<loop:list>
<tr>
<td class=lista><center>
<tag:list[].xbtit />:&nbsp;<tag:list[].xbtitname /></center>
</td>
<td class=lista><center>
<tag:list[].smf />:&nbsp;<tag:list[].smfname /></center>
</td>
<td class=lista><center>
<tag:list[].edity /></center>
</td>
</loop:list>
</table>
<br />
<table width='20%' class='lista' cellpadding=1 align=center>
<tr>
<td class=block colspan=4><center><tag:language.INSERT_STYLE_BRIDGE /></center></td></tr>
<form method='post' action='<tag:form_poster />'>
<td class=header><tag:language.EDITXB_STYLE_BRIDGE /></td><td class=lista width=40><input type='text' name='xbtit_theme' size='5' maxlength='10'></td>
<td class=header><tag:language.EDITSM_STYLE_BRIDGE /></td><td class=lista width=40><input type='text' name='smf_theme' size='5' maxlength='10'></td></tr>
<tr>
<td class=header colspan=4><center><input class=btn type=submit value='<tag:language.EDITBTN_STYLE_BRIDGE />'></center></td></tr>
</table>
</form>
</if:is_edit>
