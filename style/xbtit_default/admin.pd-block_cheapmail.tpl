<if:opt1>
  <center><br /><tag:language.CHEAP_CONFIRM_1 /><b><span style='color:#FF0000'><tag:delete /></span></b>?<br /><b><tag:language.CHEAP_CONFIRM_2 /></b></center><br />
  <center><a href='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=block_cheapmail&delete=<tag:delete />&confirm=true'><img border='0' align='middle' src='<tag:STYLEURL />/images/delete.png'></a>&nbsp;&nbsp;&nbsp;<a href='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=block_cheapmail'><tag:language.FRM_CANCEL /></a><br /><br />
<else:opt1>
  <if:opt2>
    <center><br /><b><span style='color:#FF0000'><tag:delete /></span></b><tag:language.CHEAP_DELETED_1 /><br /><a href='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=block_cheapmail'><tag:language.CHEAP_DELETED_2 /></a><tag:language.CHEAP_DELETED_3 /></center><br />
  <else:opt2>
  <br />
  <table class="lista" width="95%" cellpadding="2" cellspacing="0" border="0" align="center">
    <tr>
      <td align="center" class="block"><strong><tag:language.CHEAP_CURRENT /></strong></td>
      <td align="center" class="block"><strong><tag:language.ADDED /></strong></td>
      <td align="center" class="block"><strong><tag:language.ADDED_BY /></strong></td>
      <td align="center" class="block"><strong><tag:language.DELETE /></strong></td>
    </tr>

    <if:haveloop>
    <loop:loop>
    <tr>
      <td align='center' class='lista'><tag:loop[].domain /></td>
      <td align='center' class='lista'><tag:loop[].added /></td>
      <td align='center' class='lista'><tag:loop[].added_by /></td>
      <td align='center' class='lista'><a href='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=block_cheapmail&delete=<tag:loop[].domain />'><img border='0' src='<tag:STYLEURL />/images/delete.png'></a></td>
    </tr>
    </loop:loop>
    </if:haveloop>

    <tr>
      <td align='center' colspan='4' class='lista'><b><tag:language.CHEAP_COUNT_1 /><span style='color:#FF0000'><tag:counter /></span><tag:language.CHEAP_COUNT_2 /></b><br /><br />
<b><tag:language.CHEAP_ADD /></b><form name='input' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=block_cheapmail' method='post'><input type='text' name='cheapmail' size='30' maxlength='100'>&nbsp;<input type='submit' name='additthen' value='Submit'></form><br /></td>
    </tr>
    </table>
    <br />
  </if:opt2>
</if:opt1>