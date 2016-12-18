<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center"><tag:language.UP_RANK_UPL /></h4>
</div>
<table class="table table-bordered table-hover">
<tr>
  <td class="head" align="center"><b><tag:language.UPLOADER /></b></td>
  <td class="head" align="center"><b><tag:language.UP_LAST_ONLINE /></b></td>
  <td class="head" align="center"><b><tag:language.UP_LAST_UPLOAD /></b></td>
  <td class="head" align="center"><b><tag:language.UP_DAYS_AGO /></b></td>
  <td class="head" align="center"><b><tag:language.UP_ACT_UPL /></b></td>
  <td class="head" align="center"><b><tag:language.PM /></b></td>
</tr>

<loop:UC>
<tr>
    <td class="lista" style="text-align:center;"><tag:UC[].username /></td>
    <td class="lista" style="text-align:center;"><tag:UC[].last /></td>
    <td class="lista" style="text-align:center;"><tag:UC[].upl /></td>
    <td class="lista" style="text-align:center;"><tag:UC[].days /></td>
    <td class="lista" style="text-align:center;"><tag:UC[].act /></td>
    <td class="lista" style="text-align:center;"><tag:UC[].pm /></td>
</tr>
</loop:UC>
</table>
<div class="panel-footer">
</div>
</div>

<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center"><tag:language.UP_RANK_OTH /></h4>
</div>
<table class="table table-bordered table-hover">
<tr>
  <td class="head" align="center"><b><tag:language.UPLOADER /></b></td>
  <td class="head" align="center"><b><tag:language.UP_LAST_ONLINE /></b></td>
  <td class="head" align="center"><b><tag:language.UP_LAST_UPLOAD /></b></td>
  <td class="head" align="center"><b><tag:language.UP_DAYS_AGO /></b></td>
  <td class="head" align="center"><b><tag:language.UP_ACT_UPL /></b></td>
  <td class="head" align="center"><b><tag:language.PM /></b></td>
</tr>

<loop:UCO>
<tr>
    <td class="lista" style="text-align:center;"><tag:UCO[].username /></td>
    <td class="lista" style="text-align:center;"><tag:UCO[].last /></td>
    <td class="lista" style="text-align:center;"><tag:UCO[].upl /></td>
    <td class="lista" style="text-align:center;"><tag:UCO[].days /></td>
    <td class="lista" style="text-align:center;"><tag:UCO[].act /></td>
    <td class="lista" style="text-align:center;"><tag:UCO[].pm /></td>
</tr>
</loop:UCO>
</table>
<div class="panel-footer">
</div>
</div>
