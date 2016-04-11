<if:NOHISTORY>
<table width=100% class="lista" border="0"><tr><td align="center" colspan="9" class="lista"><tag:language.NO_HISTORY /></td></tr></table>
<else:NOHISTORY>
<script language=javascript>
function windowunder(link)
{
  window.opener.document.location=link;
  window.close();
}
</script>
<table class="table table-bordered">
<if:pagertop_visible>
<tr>
  <td class="blocklist" style="text-align:center;" colspan="<tag:colspan />"><tag:pagertop /></td>
</tr>
</if:pagertop_visible>
<tr>
<td align=center class="header" colspan=2><tag:language.USER_NAME /></td>
<td align=center class="header"><tag:language.PEER_COUNTRY /></td>
<td align=center class="header"><tag:language.ACTIVE /></td>
<td align=center class="header"><tag:language.PEER_CLIENT /></td>
<td align=center class="header"><span style="color:red;">&#9660;</span></td>
<td align=center class="header"><span style="color:green;">&#9650;</span></td>
<td align=center class="header"><tag:language.RATIO /></td>

<if:ttimes_enabled_1>
<td align="center" class="header"><tag:language.ETH_START_DATE /></td>
<td align="center" class="header"><tag:language.ETH_COMP_DATE /></td>
<td align="center" class="header"><tag:language.ETH_LAST_ACTION /></td>
</if:ttimes_enabled_1>

<if:hnr_enabled>
<td align=center class="header"><tag:language.SEEDING_TIME /></td>
</if:hnr_enabled>
<td align=center class="header"><tag:language.FINISHED /></td>
</tr>
<!-- peers' listing -->
<loop:history>
<tr>
<td class="lista" style="text-align:left;"><tag:history[].USERNAME /></td>
<td class="lista" style="text-align:center;"><tag:history[].PM /></td>
<td class="lista" style="text-align:center;"><tag:history[].FLAG /></td>
<td class="lista" style="text-align:center;"><tag:history[].ACTIVE /></td>
<td class="lista"><tag:history[].CLIENT /></td>
<td class="lista" style="text-align:center;"><tag:history[].DOWNLOADED /></td>
<td class="lista" style="text-align:center;"><tag:history[].UPLOADED /></td>
<td class="lista" style="text-align:center;"><tag:history[].RATIO /></td>

<if:ttimes_enabled_2>
<td class="lista" style="text-align:center;"><tag:history[].started_time /></td>
<td class="lista" style="text-align:center;"><tag:history[].completed_time /></td>
<td class="lista" style="text-align:center;"><tag:history[].mtime /></td>
</if:ttimes_enabled_2>

<if:hnr_enabled2>
<td class="lista" style="text-align:center;"><tag:history[].SEEDING_TIME /></td>
</if:hnr_enabled2>
<td class="lista" style="text-align:center;"><tag:history[].FINISHED /></td>
</tr>
</loop:history>
<if:pagerbottom_visible>
<tr>
  <td class="blocklist" style="text-align:center;" colspan="<tag:colspan />"><tag:pagerbottom /></td>
</tr>
</if:pagerbottom_visible>
</table>
<tag:BACK2 />
</if:NOHISTORY>