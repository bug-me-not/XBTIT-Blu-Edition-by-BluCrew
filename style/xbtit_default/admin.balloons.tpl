<div align='center'>
  <form name='balloons' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=balloons'>
    <table>
      <tr>
        <td class='header' align='right'><tag:language.BALL_DEFAULT />:</td>
        <td class='lista'>
<table>
<tr>
<td><tag:language.TVDB_PRIORITY_1 /></td>
<td><select name="priority1">
<option value="1" <if:priority1_iu>selected="selected"</if:priority1_iu> ><tag:language.IMGFL_IU /></option>
<option value="2" <if:priority1_imdb>selected="selected"</if:priority1_imdb> ><tag:language.IMGFL_IMDB /></option>
<option value="3" <if:priority1_tvdb>selected="selected"</if:priority1_tvdb> ><tag:language.IMGFL_TVDB /></option>
</select></td>
</tr>
<tr>
<td><tag:language.TVDB_PRIORITY_2 /></td>
<td><select name="priority2">
<option value="1"<if:priority2_iu> selected="selected"</if:priority2_iu>><tag:language.IMGFL_IU /></option>
<option value="2"<if:priority2_imdb> selected="selected"</if:priority2_imdb>><tag:language.IMGFL_IMDB /></option>
<option value="3"<if:priority2_tvdb> selected="selected"</if:priority2_tvdb>><tag:language.IMGFL_TVDB /></option>
</select></td>
</tr>
<tr>
<td><tag:language.TVDB_PRIORITY_3 /></td>
<td><select name="priority3">
<option value="1"<if:priority3_iu> selected="selected"</if:priority3_iu>><tag:language.IMGFL_IU /></option>
<option value="2"<if:priority3_imdb> selected="selected"</if:priority3_imdb>><tag:language.IMGFL_IMDB /></option>
<option value="3"<if:priority3_tvdb> selected="selected"</if:priority3_tvdb>><tag:language.IMGFL_TVDB /></option>
</select></td>
</tr>
</table>
        </td>
      </tr>
      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>