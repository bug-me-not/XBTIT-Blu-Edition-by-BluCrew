<div align='center'>
  <form name='adv_pruneu' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=adv_pruneu'>
    <table>
      <tr>
        <td class='header' style='text-align:right;'><tag:language.ADV_PRUNE_MAX_VAL />:</td>
        <td class='lista'><input type="text" name="unval_num" value="<tag:unval_num />" size="4" />&nbsp;&nbsp;&nbsp;<tag:language.ADV_DAYS /></td>
      </tr>
      <tr>
        <td class='header' style='text-align:right;'><tag:language.ADV_EXEMPT_RANKS />:</td>
        <td class='lista'><tag:exempt_ranks /></td>
      </tr>
      <tr>
        <td class='header' style='text-align:right;'><tag:language.ADV_KEY />:</td>
        <td class='lista'>{member} = <tag:language.ADV_USERNAME1 /> (<span style="color:blue;font-weight:bold;"><tag:member /></span> <tag:language.ADV_USERNAME2 />)<br />{sitename} = <tag:SITENAME /><br />{siteurl} = <tag:BASEURL /><br />{warn1days} = <tag:language.ADV_SEE_BELOW /><br />{warn2days} = <tag:language.ADV_SEE_BELOW /><br />{warn3days} = <tag:language.ADV_SEE_BELOW /><br />{warnoverall} = {warn2days} + {warn3days} (<span style="color:blue;font-weight:bold;"><tag:overall_num /></span> <tag:language.ADV_PRUNE_CURRENTLY />)</td>
      </tr>
      <tr>
        <td class='header' style='text-align:right;'><tag:language.ADV_PRUNE_FIRST_WARN />:</td>
        <td class='lista'>{warn1days} = <input type="text" name="firstwarn_num" value="<tag:firstwarn_num />" size="4" />&nbsp;&nbsp;&nbsp;<tag:language.ADV_DAYS /></td>
      </tr>
      <tr>
        <td class='header' style='text-align:right;'><tag:language.ADV_PRUNE_FIRST_WARN_MSG />:</td>
        <td class='lista'><textarea name="firstwarn_msg" rows="10" cols="80"><tag:firstwarn_msg /></textarea></td>
      </tr>
      <tr>
        <td class='header' style='text-align:right;'><tag:language.ADV_PRUNE_SECOND_WARN />:</td>
        <td class='lista'>{warn2days} = <input type="text" name="secondwarn_num" value="<tag:secondwarn_num />" size="4" />&nbsp;&nbsp;&nbsp;<tag:language.ADV_DAYS /></td>
      </tr>
      <tr>
        <td class='header' style='text-align:right;'><tag:language.ADV_DEL_AFTER />:</td>
        <td class='lista'>{warn3days} = <input type="text" name="del_num" value="<tag:del_num />" size="4" />&nbsp;&nbsp;&nbsp;<tag:language.ADV_DAYS /></td>
      </tr>
      <tr>
        <td class='header' style='text-align:right;'><tag:language.ADV_PRUNE_SECOND_WARN_MSG />:</td>
        <td class='lista'><textarea name="secondwarn_msg" rows="10" cols="80"><tag:secondwarn_msg /></textarea></td>
      </tr>
      <tr>
        <td class='header' style='text-align:right;'><tag:language.ADV_PRUNE_FINAL_MSG />:</td>
        <td class='lista'><textarea name="final_msg" rows="10" cols="80"><tag:final_msg /></textarea></td>
      </tr>
      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>