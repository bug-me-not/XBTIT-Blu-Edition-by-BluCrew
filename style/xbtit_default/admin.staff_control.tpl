<div align="center"><b><tag:language.SC /></b></div>

<table class="header" width="85%" align="center">

<if:pagertop_enabled>
<tr>
    <td class="blocklist" align="center" colspan="6"><tag:pagertop /></td>
</tr>
</if:pagertop_enabled>

<tr>
    <td class="header" align="center"><tag:language.AUSER /></td>
    <td class="header" align="center"><tag:language.OL /></td>
    <td class="header" align="center"><tag:language.NE /></td>
    <td class="header" align="center"><tag:language.BY /></td>
    <td class="header" align="center"><tag:language.DA /></td>
    <td class="header" align="center"><tag:language.MA /></td>
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