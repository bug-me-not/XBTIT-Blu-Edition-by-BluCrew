<form name="featured" action="<tag:frm_action />" method="post">
<loop:CURRENT>
<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center"><tag:language.CURRENT_FEATURE /></h4>
</div>
<h2><b><center><tag:CURRENT[].name /></a></b></center>
Category:<tag:CURRENT[].cat />
<tag:CURRENT[].sl />
</div>
</loop:CURRENT>


<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center"><tag:language.LST_TORRENTS /></h4>
</div>
<table class="table table-bordered">
<loop:TORRENT>
<tag:TORRENT[].hash /> <tag:TORRENT[].name />
</loop:TORRENT>
</table>
<div class="panel-footer">
</div>
</div>

<div align="center">
  <input type="submit" name="confirm" class="btn btn-md btn-primary" value="<tag:language.FRM_CONFIRM />" />
  &nbsp;&nbsp;
  <input type="submit" name="confirm" class="btn btn-md btn-warning" value="<tag:language.FRM_CANCEL />" />
</div>
</form>


