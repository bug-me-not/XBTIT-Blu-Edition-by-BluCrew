<div align='center'>
<table width='75%'>
  <tr>
    <td class='block' align='center' colspan='2'><b><tag:language.WS_LOGS_4 />:</b> <tag:warn_user /></td>
  </tr>
<if:found_rows>
  <tr>
    <td class='header' align='center'><b><tag:language.WS_WL /></b></td>
    <td class='header' align='center'><b><tag:language.WS_NEXT_AUTO_DOWNGRADE /></b></td>
  </tr>
  <tr>
    <td class='lista' style='text-align:center'><tag:w_level /></td>
    <td class='lista' style='text-align:center'><b><tag:w_level_expire /></b></td>
  </tr>
  <tr>
    <td class='block' colspan='2'>&nbsp;</td>
  </tr>

  <if:pagertop_needed>
  <tr>
    <td class='header' colspan='2' align='center'><tag:pagertop /></td>
  </tr>
  </if:pagertop_needed>

  <loop:myloop>

  <tr>
    <td class='header' align='center'><b><tag:myloop[].type3 /></b></td>
    <td class='header' align='center'><b><tag:language.WS_NOTES /></b></td>
  </tr>
  
  <tr>
    <td class='lista'><tag:myloop[].warner_user /></td>
    <td class='lista'><tag:myloop[].type2 /> <b><tag:myloop[].date_added /></b></td>
  </tr>

  <tr>
    <td class='lista'><b><tag:myloop[].type /></b></td>
    <td class='lista'><tag:myloop[].notes /></td>
  </tr>
  </loop:myloop>

  <if:pagerbottom_needed>
  <tr>
    <td class='header' colspan='2' align='center'><tag:pagerbottom /></td>
  </tr>
  </if:pagerbottom_needed>

<else:found_rows>
  <tr>
    <td class='lista' style='text-align:center' colspan='2'><b><tag:language.WS_NOTHING_2_C /></b></td>
  </tr>
</if:found_rows>

</table>
</div>