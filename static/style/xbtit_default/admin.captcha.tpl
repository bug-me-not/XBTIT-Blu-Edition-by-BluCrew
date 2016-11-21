<form method="post" action="index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=comment_captcha">
<table width="80%" cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
<td class="information" colspan="2" style="text-align:center;"><tag:language.CAPTCHA_DESC /></td>
</tr>
<tr>
<td class="header"><tag:language.CAPTCHA_PRIV /></td><td class="lista"><input type="text" size="40" value="<tag:priv_key />" name="privkey"></td>
</tr>
<tr>
<td class="header"><tag:language.CAPTCHA_PUB /></td><td class="lista"><input type="text" size="40" value="<tag:pub_key />" name="pubkey"></td>
</tr>
<tr>
<td class="header" colspan="2" style="text-align:center;"><input type="submit" class="btn" value="<tag:language.SUBMIT />"></td>
</tr>
</table>
