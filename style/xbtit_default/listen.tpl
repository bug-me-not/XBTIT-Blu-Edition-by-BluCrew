<br />
<if:hanger>
<table width=50% cellpadding=5 cellspacing=1 border=0>
<tr>
<td class=block style="text-align:center;"><tag:language.USERNAME /></td><td class=block style="text-align:center;"><tag:language.PLAYER /></td>
</tr>

<loop:list>
<tr>
<td class=lista style="text-align:center;">
<a href="index.php?page=userdetails&id=<tag:list[].id />"><tag:list[].username /></a>
</td><td class=lista style="text-align:center;"><tag:list[].client /></td>
</tr>
</loop:list>
<if:hanger>
</table>
<else:hanger>
<tag:nothing />
<tag:ohdamn />
<tag:ohbeep />
<br />
</if:hanger>
<br />