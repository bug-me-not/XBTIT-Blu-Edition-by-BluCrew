<if:PREVIEW>
<div width="100%" align="center" class="lista">
<tag:comment_preview />
</div>
</if:PREVIEW>
<div class="panel panel-primary">
    <div class="panel-heading">
    <h4 class="text-center">Comment</h4>
    </div>
<div align="center">
  <form enctype="multipart/form-data" name="comment" method="post" action="index.php?page=offer_comment&id=<tag:comment_id />">
  <input type="hidden" name="info_hash" value="<tag:comment_id />" />
    <table class="table table-bordered">
      <tr>
      <tr>
        <td align="left" class="header"><tag:language.USER_NAME /></td>
        <td class="lista" align="left" ><input name="user" TYPE="text" size="20" value="<tag:comment_username />" maxlength="100" disabled; readonly /></td>
      </tr>
      <tr>
        <td align="left" class="header"><tag:language.COMMENT_1 />:</td>
        <td class="lista" align="left"><tag:comment_comment /></td>
      </tr>
      <tr>
        <td class="header" colspan="2" align="center">
        <input type="submit" class="btn btn-md btn-primary" name="confirm" value="<tag:language.FRM_CONFIRM />" />
        &nbsp;&nbsp;&nbsp;
        <input type="submit" class="btn btn-md btn-success" name="confirm" value="<tag:language.FRM_PREVIEW />" />
        </td>
      </tr>
    </table>
  </form>
</div>
</div>

