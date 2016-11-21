<form method="post" action="<tag:frm_action />" name="image_upload">
<table width="50%" align="center">
<tr>
      <td class="header"><tag:language.ALLOW_IMAGE_UPLOAD /></td>
      <td class="lista">&nbsp;&nbsp;Yes&nbsp;<input type="radio" name="imageon" value="true"<tag:fuconfig.imageonyes /> />&nbsp;&nbsp;No&nbsp;<input type="radio" name="imageon" value="false"<tag:fuconfig.imageonno /> /></td>
      <td class="header"><tag:language.ALLOW_SCREEN_UPLOAD /></td>
      <td class="lista">&nbsp;&nbsp;Yes&nbsp;<input type="radio" name="screenon" value="true"<tag:fuconfig.screenonyes /> />&nbsp;&nbsp;No&nbsp;<input type="radio" name="screenon" value="false"<tag:fuconfig.screenonno /> /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.IMAGE_UPLOAD_DIR /></td>
      <td class="lista"><input type="text" name="uploaddir" value="<tag:fuconfig.uploaddir />" size="40" /></td>
      <td class="header"><tag:language.FILE_SIZELIMIT /></td>
      <td class="lista"><input type="text" name="file_limit" value="<tag:fuconfig.file_limit />" size="40" /></td>
    </tr>
    <tr>
      <td class="header"><tag:language.IMGUP_MAXW /></td>
      <td class="lista"><input type="text" name="imgup_maxw" value="<tag:fuconfig.imgup_maxw />" size="40" /></td>
      <td class="header"><tag:language.IMGUP_MAXH /></td>
      <td class="lista"><input type="text" name="imgup_maxh" value="<tag:fuconfig.imgup_maxh />" size="40" /></td>
    </tr>
<tr>
      <td align="center" class="header" colspan="2"><input type="submit" name="send" class="btn" value="<tag:language.FRM_CONFIRM />" /></td>
      <td align="center" class="header" colspan="2"><input type="submit" name="cancel" class="btn" value="<tag:language.FRM_CANCEL />" /></td>
    </tr>
</table>
</form>
