<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">User Birthday/Age Settings</h4>
</div>
<if:firstview>
<center>
<table width=25%>
  <tr>
    <form method="post" action="index.php?page=admin&amp;user=<tag:uid />&amp;code=<tag:random />&amp;do=birthday">
    <td class="header"><tag:language.BIRTHDAY_LOWER_LIMIT />:</td>
    <td class="lista"><center><input type="text" size="5" name="minage" maxlength="2" value="<tag:birthday_lower_limit />"/></center></td>
  </tr>
  <tr>
    <td class="header"><tag:language.BIRTHDAY_UPPER_LIMIT />:</td>
    <td class="lista"><center><input type="text" size="5" name="maxage" maxlength="3" value="<tag:birthday_upper_limit />"/></center></td>
  </tr>
  <tr>
    <td class="header"><tag:language.BIRTHDAY_BONUS />:</td>
    <td class="lista"><center><input type="text" size="5" name="bonus" maxlength="5" value="<tag:birthday_bonus />"/></center></td>
  </tr>
  <tr>
    <td class="header" colspan="2" align="center"><input type="submit" class="btn btn-md btn-primary" value="<tag:language.UPDATE />" name="action"></td>
  </tr>
</table>
</center>
<else:firstview>
<tag:language.BIRTHDAY_UPDATED />
</if:firstview>
<div class="panel-footer">
</div>
</div>
