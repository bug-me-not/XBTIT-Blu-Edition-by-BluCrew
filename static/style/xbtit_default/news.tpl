<script type="text/javascript">
function form_control()
  {
    if (document.getElementById('title').value.length==0)
      {
      var title=document.createElement('span');
      title.innerHTML='<tag:language.ERR_NO_TITLE />';
      alert(title.innerHTML);
      document.getElementById('title').focus();
      return false;
      }

   return true;
  }
</script>
<if:ADD_EDIT>
<div align="center">
  <form action="<tag:news.action />" name="news" method="post" onsubmit="return form_control()">
    <table border="0" class="lista" width="100%">
      <tr>
    <td align="center" colspan="2" class="header"><tag:language.NEWS_INSERT />:<input type="hidden" name="action" value="<tag:news.hidden_action />"/><input type="hidden" name="id" value="<tag:news.hidden_id />"/></td>
      </tr>
      <tr>
    <td align="left" class="lista" style="font-size:10pt"><tag:language.NEWS_TITLE /></td>
    <td align="left" class="lista"><input type="text" name="title" id="title" size="40" maxlength="40" value="<tag:news.news_title />"/></td>
      </tr>
      <tr>
    <td align="left" class="lista" valign="top" style="font-size:10pt"><tag:language.NEWS_DESCRIPTION /></td>
    <td align="left" class="lista"><tag:news.bbcode /></td>
      </tr>
      <tr>
    <td align="center" class="header" colspan="2"><input type="submit" class="btn" name="conferma" value="<tag:language.FRM_CONFIRM />" />&nbsp;&nbsp;&nbsp;<input type="submit" class="btn" name="conferma" value="<tag:language.FRM_CANCEL />" /></td>
      </tr>
    </table>
  </form>
</div>
</if:ADD_EDIT>
