<if:db_status>
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
      document.forms[FormName].elements['all_up'].checked = CheckValue;
      document.forms[FormName].elements['all_down'].checked = CheckValue;
 }
 -->
</script>
<form name="dbutil" action="<tag:frm_action />" method="post">
  <table class="lista" cellspacing="1" cellpadding="0" align="center" border="0" width="100%">
    <tr>
      <td align="center" class="header"><input type="checkbox" name="all_up" onclick="SetAllCheckBoxes('dbutil','tname[]',this.checked)" /></td>
      <td align="center" class="header"><tag:language.DBUTILS_TABLENAME /></td>
      <td align="center" class="header"><tag:language.DBUTILS_RECORDS /></td>
      <td align="center" class="header"><tag:language.DBUTILS_DATALENGTH /></td>
      <td align="center" class="header"><tag:language.DBUTILS_OVERHEAD /></td>
    </tr>
    <loop:tables>
    <tr>
      <td class="lista" align="center"><input type="checkbox" name="tname[]" value="<tag:tables[].name />" /></td>
      <td class="lista"><tag:tables[].name /></td>
      <td class="lista" align="right"><tag:tables[].rows /></td>
      <td class="lista" align="right"><tag:tables[].length /></td>
      <td class="lista" align="right"><tag:tables[].overhead /></td>
    </tr>
    </loop:tables>
    <tr>
      <td align="center" class="lista"><input type="checkbox" name="all_down" onclick="SetAllCheckBoxes('dbutil','tname[]',this.checked)" /></td>
      <td align="center" class="lista"><tag:table_count />&nbsp;<tag:language.DBUTILS_TABLES /></td>
      <td align="right" class="lista"><tag:table_records />&nbsp;<tag:language.DBUTILS_RECORDS /></td>
      <td align="right" class="lista"><tag:table_bytes /></td>
      <td align="right" class="lista"><tag:table_overhead /></td>
    </tr>
    <tr>
    <td colspan="5">
      &nbsp;&nbsp;If checked:&nbsp;&nbsp;
      <input type="submit" name="doit" class="btn" value="<tag:language.DBUTILS_REPAIR />" />&nbsp;&nbsp;
      <input type="submit" name="doit" class="btn" value="<tag:language.DBUTILS_OPTIMIZE />" />&nbsp;&nbsp;
      <input type="submit" name="doit" class="btn" value="<tag:language.DBUTILS_ANALYSE />" />&nbsp;&nbsp;
      <input type="submit" name="doit" class="btn" value="<tag:language.DBUTILS_CHECK />" />&nbsp;&nbsp;
      <!--
      <input type="submit" name="doit" class="btn" value="<tag:language.DBUTILS_DELETE />" onclick="return confirm('Warning, this will delete selected tables!')" />
      -->
    </td>
    </tr>
  </table>
</form>
<else:db_status>
<if:table_result>
<table class="lista" cellspacing="1" cellpadding="0" align="center" border="0" width="100%">
  <tr>
    <td align="center" class="header"><tag:language.DBUTILS_TABLENAME /></td>
    <td align="center" class="header"><tag:language.DBUTILS_OPERATION /></td>
    <td align="center" class="header"><tag:language.DBUTILS_INFO /></td>
    <td align="center" class="header"><tag:language.DBUTILS_STATUS /></td>
  </tr>
  <loop:results>
  <tr>
    <td class="lista"><tag:results[].table /></td>
    <td class="lista" align="center"><tag:results[].operation /></td>
    <td class="lista" align="center"><tag:results[].info /></td>
    <td class="lista" align="right"><tag:results[].status /></td>
  </tr>
  </loop:results>
</table>
</if:table_result>
</if:db_status>