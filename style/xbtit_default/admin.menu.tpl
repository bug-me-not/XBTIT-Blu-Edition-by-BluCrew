<table class="table table-bordered table-hover">
  <loop:admin_menu>
  <tr>
    <td class="head">
        <tag:admin_menu[].title />
    </td>
  </tr>
  <loop:admin_menu[].menu>
  <tr>
    <td class="lista" valign="middle" style="padding-left:10px;overflow:auto;">
        <a href="<tag:admin_menu[].menu[].url />"><tag:admin_menu[].menu[].description /></a>
    </td>
  </tr>
  </loop:admin_menu[].menu>
  </loop:admin_menu>
</table>