<p>
<if:firstview>
<table width=33%>
  <tr>
    <form method="post" action="index.php?page=admin&amp;user=<tag:uid />&amp;code=<tag:random />&amp;do=birthday">
    <td class="header"><tag:language.BIRTHDAY_LOWER_LIMIT />:</td>
    <td class="lista"><center><input type="text" size="2" name="minage" maxlength="2" value="<tag:birthday_lower_limit />"/></center></td>
  </tr>
  <tr>
    <td class="header"><tag:language.BIRTHDAY_UPPER_LIMIT />:</td>
    <td class="lista"><center><input type="text" size="2" name="maxage" maxlength="3" value="<tag:birthday_upper_limit />"/></center></td>
  </tr>
  <tr>
    <td class="header"><tag:language.BIRTHDAY_BONUS />:</td>
    <td class="lista"><center><input type="text" size="2" name="bonus" maxlength="5" value="<tag:birthday_bonus />"/></center></td>
  </tr>
  <tr>
    <td class="header" colspan="2" align="center"><input type="submit" value="<tag:language.UPDATE />" name="action"></td>
  </tr>
</table>
<else:firstview>
<tag:language.BIRTHDAY_UPDATED />
</if:firstview>
</p><br />