
<div align="center" style="font-size:12pt"><tag:settings_done_msg /></div>

<form action="<tag:frm_action />" name="prune" method="post" enctype="multipart/form-data">
  <table class="lista" width="60%">
  <loop:settings>
    <tr>
      <td class="header" align="left"><tag:language.GOLD_PICTURE /></td>
      <td class="lista" align="left"><tag:settings[].gold_picture /></td>
    </tr>
    <tr>
      <td class="header" align="left"><tag:language.GOLD_PERCENT /></td>
      <td class="lista" align="left"><tag:settings[].gold_percent /></td>
    </tr>
    <tr>
      <td class="header" align="left"><tag:language.SILVER_PICTURE /></td>
      <td class="lista" align="left"><tag:settings[].silver_picture /></td>
     </tr>
    <tr>
      <td class="header" align="left"><tag:language.SILVER_PERCENT /></td>
      <td class="lista" align="left"><tag:settings[].silver_percent /></td>
    </tr>
    <tr>
      <td class="header" align="left"><tag:language.BRONZE_PICTURE /></td>
      <td class="lista" align="left"><tag:settings[].bronze_picture /></td>
     </tr>
    <tr>
      <td class="header" align="left"><tag:language.BRONZE_PERCENT /></td>
      <td class="lista" align="left"><tag:settings[].bronze_percent /></td>
    </tr>
     <tr>
      <td class="header" align="left"><tag:language.GOLD_LEVEL /></td>
      <td class="lista" align="left"><tag:settings[].level /><br /><tag:language.GOLD_ONLY_BASE /></td>
     </tr>
     <tr>
      <td class="header" align="left"><tag:language.GOLD_DESCRIPTION /></td>
      <td class="lista" align="left"><tag:settings[].gold_description /></td>
     </tr>
     <tr>
      <td class="header" align="left"><tag:language.SILVER_DESCRIPTION /></td>
      <td class="lista" align="left"><tag:settings[].silver_description /></td>
     </tr>
     <tr>
      <td class="header" align="left"><tag:language.BRONZE_DESCRIPTION /></td>
      <td class="lista" align="left"><tag:settings[].bronze_description /></td>
      </tr>
     <tr>
      <td class="header" align="left"><tag:language.CLASSIC_DESCRIPTION /></td>
      <td class="lista" align="left"><tag:settings[].classic_description /></td>
      </tr>

     </loop:settings>
     <tr>
     <td class="lista" align="center"></td>
      <td class="lista" align="right" colspan="5"><input type="submit" class="btn" name="action" value="GO" /></td>
    </tr>
  </table>
</form>
