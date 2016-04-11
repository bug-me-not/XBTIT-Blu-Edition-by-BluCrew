<!-- begin category checks -->
<script type="text/javascript">
<!--
function AddCategories()
      {
      var catadd="";
      for (i=0;i<document.tcategories.elements.length;i++)
        {
          if (document.tcategories.elements[i].checked)
             catadd+=";"+document.tcategories.elements[i].value;
      }
      // create hidden field
      if (catadd.length>0)
        {
        var field = document.createElement("input");
        field.setAttribute("type","hidden");
        field.setAttribute("value",catadd.substr(1));
        field.setAttribute("name","category");
        document.torrent_search.appendChild(field);
      }
}
-->
</script>
<form method="post" action="<tag:frm_action />" name="imageflow_settings">
<center>
<table class="lista" width="50%" align="center">
<tr>
<td class="header"><tag:language.FLOW_LIM /><br></td>
<td class="lista" width=100%><input type="text" name="imageflow_limit" value="<tag:config.imageflow_limit />" size="30" /></td>

</tr>
<tr>
<td class="header"><tag:language.FLOW_CATS /><br></td>
<td class="lista" width=100%><table>
  <tr>
    <td><tag:category_checks /></td>
  </tr>
</table></td>
<tr>
<td class="header"><tag:language.IMGFL_PRIORITY /></td>
<td class="lista">
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
<td class="lista" colspan="2"><center>
<input type="submit" class="btn" value="<tag:language.FRM_CONFIRM />">
&nbsp;&nbsp;&nbsp;
<input type="reset" class="btn" value="<tag:language.FRM_CANCEL />">
</center></td>
</tr>	
</table></form>
