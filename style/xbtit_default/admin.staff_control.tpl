<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Staff Log Of Rank Changes</h4>
</div>
<table class="table table-bordered table-hover">

<if:pagertop_enabled>
<tr>
    <td class="blocklist" align="center" colspan="6"><tag:pagertop /></td>
</tr>
</if:pagertop_enabled>

<tr>
    <td class="head" align="center"><tag:language.AUSER /></td>
    <td class="head" align="center"><tag:language.OL /></td>
    <td class="head" align="center"><tag:language.NE /></td>
    <td class="head" align="center"><tag:language.BY /></td>
    <td class="head" align="center"><tag:language.DA /></td>
    <td class="head" align="center"><tag:language.MA /></td>
</tr>

<loop:hit>
<tr>
    <td class="lista" style='text-align:center;'><tag:hit[].user /></td>
    <td class="lista" style='text-align:center;'><tag:hit[].old /></td>
    <td class="lista" style='text-align:center;'><tag:hit[].new /></td>
    <td class="lista" style='text-align:center;'><tag:hit[].by /></td>
    <td class="lista" style='text-align:center;'><tag:hit[].date /></td>
    <td class="lista" style='text-align:center;'><tag:hit[].undo /></td>
</tr>
</loop:hit>

<if:pagerbottom_enabled>
<tr>
    <td class="blocklist" align="center" colspan="6"><tag:pagerbottom /></td>
</tr>
</if:pagerbottom_enabled>

</table>
<div class="panel-footer">
</div>
</div>