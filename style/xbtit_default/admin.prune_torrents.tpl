<if:pruned_done>
<div align="center" style="font-size:12pt"><tag:prune_done_msg /></div>
<else:pruned_done>
<if:prune_list>
<script type="text/javascript">
 <!--
 function SetAllCheckBoxes(FormName, FieldName, CheckValue)
 {
   if(!document.forms[FormName])
     return;
   var objCheckBoxes = document.forms[FormName].elements[FieldName];
   if(!objCheckBoxes)
     return;
   var countCheckBoxes = objCheckBoxes.length;
   if(!countCheckBoxes)
     objCheckBoxes.checked = CheckValue;
   else
     // set the check value for all check boxes
     for(var i = 0; i < countCheckBoxes; i++)
       objCheckBoxes[i].checked = CheckValue;
 }
 // -->
</script>
<form action="<tag:frm_action />" name="prune" method="post">
  <table class="lista" width="100%">
    <tr>
      <td class="header" align="center"><tag:language.FILE_NAME /></td>
      <td class="header" align="center"><tag:language.LAST_UPDATE /></td>
      <td class="header" align="center"><tag:language.SEEDS /></td>
      <td class="header" align="center"><tag:language.LEECHERS /></td>
      <td class="header" align="center"><input type="checkbox" name="all" onclick="SetAllCheckBoxes('prune','hash[]',this.checked)" /></td>
    </tr>
    <if:no_records>
    <tr>
      <td class="lista" align="center" colspan="5"><tag:language.NO_RECORDS /></td>
    </tr>
    <else:no_records>
    <loop:torrents>
    <tr>
      <td class="lista" align="left"><tag:torrents[].filename /></td>
      <td class="lista" align="center"><tag:torrents[].lastupdate /></td>
      <td class="lista" align="center"><tag:torrents[].seeds /></td>
      <td class="lista" align="center"><tag:torrents[].leechers /></td>
      <td class="lista" align="center"><input type="checkbox" name="hash[]" value="<tag:torrents[].info_hash />" /></td>
    </tr>
    </loop:torrents>
    </if:no_records>
    <tr>
      <td class="lista" align="right" colspan="5"><input type="submit" class="btn" name="action" value="GO" /></td>
    </tr>
  </table>
</form>
<else:prune_list>
<form action="<tag:frm_action />" name="prune" method="post">
  <div align="center">
    <br />
    <tag:language.PRUNE_TORRENTS_INFO />
    <br />
    <br />
    <input type="text" name="days" value="<tag:prune_days />" size="10" maxlength="3" />
    <input type="submit" class="btn" name="action" value="View" />
  </div>
</form>
</if:prune_list>
</if:pruned_done>