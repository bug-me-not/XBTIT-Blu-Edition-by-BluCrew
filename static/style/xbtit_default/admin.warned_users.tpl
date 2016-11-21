<table class="header" width="100%" align="center">
  <if:need_pager_top>
  <tr>
    <td class="lista" colspan="3" style="text-align:center;"><tag:pager_top /></td>
  </tr>
  </if:need_pager_top>
  <tr>
    <td class="header" align="center"><b><tag:language.USERNAME /></b></td>
    <td class="header" align="center"><b><tag:language.WS_WL /></b></td>
    <td class="header" align="center"><b><tag:language.WS_NEXT_AUTO_DOWNGRADE /></b></td>
  </tr>
  <loop:warns>
  <tr>
    <td class="lista" style="text-align:center;"><tag:warns[].username /></td>
    <td class="lista" style="text-align:center;"><tag:warns[].warnlevel /></td>
    <td class="lista" style="text-align:center;"><b><tag:warns[].nextexpire /></b></td>
  </tr>
  </loop:warns>
  <if:need_pager_bottom>
  <tr>
    <td class="lista" colspan="3" style="text-align:center;"><tag:pager_bottom /></td>
  </tr>
  </if:need_pager_bottom>
</table>