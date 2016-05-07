

<form name="featured" action="<tag:frm_action />" method="post">
<br />
<table width=100% border=0>
<tr><td><center><b><h1><tag:language.CURRENT_FEATURE /></h1></b>
</td></tr>
<tr><td><table width=99% border=0>
<loop:CURRENT>
<td colspan=3 class="lista">

	<h2>	<b><center><tag:CURRENT[].name /></a></b></center>
</td></tr>
<tr><td class="lista">
<tag:CURRENT[].cat />
<tag:CURRENT[].sl />
</td>
<td class="lista">
<tag:CURRENT[].desc />
</td>
<td class="lista">
<center>
<tag:CURRENT[].pie />
</td></tr>
</loop:CURRENT>
</table>
</td></tr>
<tr><td>&nbsp</td></tr>
<tr><td><table width=100% border=0>
<tr><td><center><b><h1><tag:language.LST_TORRENTS />
</td></tr>
<loop:TORRENT>
<tag:TORRENT[].hash /> <tag:TORRENT[].name />
</loop:TORRENT>
</table>
</tr></td></table>
<div align="center">
  <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CONFIRM />" />
  &nbsp;&nbsp;
  <input type="submit" name="confirm" class="btn" value="<tag:language.FRM_CANCEL />" />
</div>
</form>
<br />

