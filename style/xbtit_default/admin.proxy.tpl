<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">User Behind Proxy</h4>
</div>
<table class="table table-bordered">
<tr>
<td class="head" align="center"><b><tag:language.USERNAME /></b></td>
<td class="head" align="center"><b><tag:language.EMAIL /></b></td>
<td class="head" align="center"><b><tag:language.USER_LASTACCESS /></b></td>
<td class="head" align="center"><b><tag:language.PROX_ALL_DL /></b></td>
<td class="head" align="center"><b><tag:language.PROX_PUNISH /></b></td>
</tr>
  
<loop:proxy>
<tr>
<td class="lista" style="text-align:center;"><tag:proxy[].username /></td>
<td class="lista" style="text-align:center;"><tag:proxy[].email /></td>
<td class="lista" style="text-align:center;"><tag:proxy[].last /></td>
<td class="lista" style="text-align:center;"><tag:proxy[].allow /></td>
<td class="lista" style="text-align:center;"><tag:proxy[].change /></td>
</tr>
</loop:proxy>
</table>
<div class="panel-footer">
</div>
</div>