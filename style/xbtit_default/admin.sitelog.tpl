<table class="lista" width="100%" align="center">
  <tr>
    <td class="lista" colspan="3"><tag:pager_top /></td>
  </tr>
  <tr>
    <td class="header"><tag:language.DATE /></td>
    <td class="header"><tag:language.USER_NAME /></td>
    <td class="header"><tag:language.ACTION /></td>
  </tr>
  <loop:logs>
  <tr>
    <td <tag:logs[].class />><tag:logs[].date /></td>
    <td <tag:logs[].class />><tag:logs[].username /></td>
    <td <tag:logs[].class />><tag:logs[].action /></td>
  </tr>
  </loop:logs>
  <tr>
    <td class="lista" colspan="3"><tag:pager_bottom /></td>
  </tr>
</table>