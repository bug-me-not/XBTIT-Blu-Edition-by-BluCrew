<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Upload Delete</h4>
</div>
<table class="table table-bordered">
  <tr>
    <td align=right class="header"><tag:language.FILE /></td>
    <td class="lista" ><tag:torrent.filename /></td>
  </tr>
  <tr>
    <td align=right class="header"><tag:language.INFO_HASH /></td>
    <td class="lista" ><tag:torrent.info_hash /></td>
  </tr>
  <tr>
    <td align=right class="header"><tag:language.CATEGORY_FULL /></td>
    <td class="lista" ><tag:torrent.catname /></td>
  </tr>
  <tr>
    <td align=right class="header"><tag:language.DESCRIPTION /></td>
    <td class="lista" ><tag:torrent.description /></td>
  </tr>
  <tr>
    <td align=right class="header"><tag:language.SIZE /></td>
    <td class="lista" ><tag:torrent.size /></td>
  </tr>
  <tr>
    <td align=right class="header"><tag:language.ADDED /></td>
    <td class="lista" ><tag:torrent.date /></td>
  </tr>
  <if:NO_XBTT>
  <tr>
    <td align=right class="header"><tag:language.SPEED /></td>
    <td class="lista" ><tag:torrent.speed /></td>
  </tr>
  </if:NO_XBTT>
  <tr>
    <td align=right class="header"><tag:language.DOWNLOADED /></td>
    <td class="lista" ><tag:torrent.complete /></td>
  </tr>
  <tr>
    <td align=right class="header"><tag:language.PEERS /></td>
    <td class="lista" ><tag:torrent.peers /></td>
  </tr>
</table>
<form action="index.php?page=delete&amp;info_hash=<tag:torrent.info_hash />&amp;returnto=<tag:torrent.return />" name="delete" method="post"><br>
  <div align="center"><tag:language.DEL_REASON /><div class="input-group">
            <input type="text" class="form-control" name="reason" id="validate-text" size="50" maxlength="200" required="">
            <span class="input-group-addon danger"><span class="fa fa-times"></span></span>
            </div><br  /><br  />
  <input type="submit" class="btn btn-danger" name="action" value="<tag:language.FRM_DELETE />" />&nbsp;&nbsp;
  <input type="submit" class="btn btn-warning" name="action" value="<tag:language.FRM_CANCEL />" />
</div>
</form>  
<div class="panel-footer">
</div>
</div>  