<div align='center'>
  <form name='tvdb' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=tvdb'>
    <table>
      <tr>
        <td class="header" style="text-align:right;"><tag:language.TVDB_CATS /></td>
        <td class="lista"><tag:tvdb_output /></td>
      </tr>
      <tr>
        <td class="header" style="text-align:right;"><tag:language.TVDB_MIN_RATING /></td>
        <td class="lista"><input type="text" name="tvdb_img_min_rating" value="<tag:tvdb_img_min_rating />" /></td>
      </tr>
      <tr>
        <td class="header" style="text-align:right;"><tag:language.TVDB_MIN_VOTERS /></td>
        <td class="lista"><input type="text" name="tvdb_image_min_voters" value="<tag:tvdb_image_min_voters />" /></td>
      </tr>
      <if:imdb_enabled> 
      <tr>
        <td class="header" style="text-align:right;"><tag:language.TVDB_HIDE_IMDB /></td>
        <td class="lista"><input type="radio" name="tvdb_hide_imdb" value="yes"<if:yes_checked> checked="checked"</if:yes_checked> /> <tag:language.YES /> <input type="radio" name="tvdb_hide_imdb" value="no"<if:no_checked> checked="checked"</if:no_checked> /> <tag:language.NO /></td>
      </tr>
      </if:imdb_enabled>
      <tr>
        <td class="header" style="text-align:center;" colspan="2"><tag:language.TVDB_ADD_AWK /></td>
      </tr>
      <tr>
        <td class="lista" style="text-align:center;" colspan="2"><tag:language.TVDB_AWK_EXPLAIN /></td>
      </tr>
      <tr>
        <td class="header" style="text-align:right;"><tag:language.TVDB_REL_NAME /></td>
        <td class="lista"><input type="text" name="tvdb_awkward_release_name" size="60" value="" /></td>
      </tr>
      <tr>
        <td class="header" style="text-align:right;"><tag:language.TVDB_DELIM /></td>
        <td class="lista"><input type="text" name="tvdb_awkward_release_delimiter" value="" /></td>
      </tr>
      <tr>
        <td class="header" style="text-align:right;"><tag:language.TVDB_UL_TITLE /></td>
        <td class="lista"><input type="text" name="tvdb_awkward_release_seriesid" value="" /></td>
      </tr>
      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>


<if:tvdb_have_awk>
<br />
<div align="center">
  <table width="100%">
    <tr>
      <td class="header" colspan="4" style="text-align:center;"><tag:language.TVDB_CURR_AWK /></td>
    </tr>
    <tr>
      <td class="header" style="text-align:center;"><tag:language.TVDB_REL_NAME_SHORT /></td>
      <td class="header" style="text-align:center;"><tag:language.TVDB_DELIM_SHORT /></td>
      <td class="header" style="text-align:center;"><tag:language.TVDB_UL_TITLE /></td>
      <td class="header" style="text-align:center;"><tag:language.DELETE /></td>
    </tr>
    <loop:awkTitles>
    <tr>
      <td class="lista" style="text-align:center;"><tag:awkTitles[].name /></td>
      <td class="lista" style="text-align:center;"><tag:awkTitles[].delimiter /></td>
      <td class="lista" style="text-align:center;"><tag:awkTitles[].seriesid /></td>
      <td class="lista" style="text-align:center;"><a href="index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=tvdb&action=delawk&key=<tag:awkTitles[].key />"><img src="<tag:STYLEURL />/images/delete.png" alt="<tag:language.DELETE />" title="<tag:language.DELETE />" /></a></td>
    </tr>
    </loop:awkTitles>
  </table>
</div>
</if:tvdb_have_awk>
