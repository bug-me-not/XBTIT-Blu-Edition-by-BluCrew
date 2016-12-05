<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Failed Logins</h4>
</div>
<table class="table table-bordered">
  <tr>
    <td class="head" style="text-align:center;"><b><tag:language.LOGLOG_IP /></b></td>
    <td class="head" style="text-align:center;"><b><tag:language.LOGLOG_FAIL /></b></td>
    <td class="head" style="text-align:center;"><b><tag:language.LOGLOG_REM /></b></td>
    <td class="head" style="text-align:center;"><b><tag:language.LOGLOG_UNIK /></b></td>
  </tr>
  <loop:loglog>
  <tr>
    <td class="lista" style="text-align:center;"><tag:loglog[].IP /></td>
    <td class="lista" style="text-align:center;"><tag:loglog[].Failed /></td>
    <td class="lista" style="text-align:center;"><tag:loglog[].Remaining /></td>
    <td class="lista" style="text-align:center;"><tag:loglog[].Username /></td>
  </tr>
  </loop:loglog>
</table>
<div class="panel-footer">
</div>
</div>