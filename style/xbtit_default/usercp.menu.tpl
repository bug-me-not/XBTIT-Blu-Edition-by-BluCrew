<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Menu</h4>
</div>
<div class="panel-body">
<table class="table table-bordered">
  <loop:usercp_menu>
  <tr>
    <td class="head">
        <tag:usercp_menu[].title />
    </td>
  </tr>
  <loop:usercp_menu[].menu>
  <tr>
    <td class="lista">
        <a href="<tag:usercp_menu[].menu[].url />"><tag:usercp_menu[].menu[].description /></a>
    </td>
  </tr>
  </loop:usercp_menu[].menu>
  </loop:usercp_menu>
</table>
</div>
</div>