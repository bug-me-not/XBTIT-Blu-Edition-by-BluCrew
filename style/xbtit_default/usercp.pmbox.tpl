<!--  MODIFIED select for deletion by gAnDo -->
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
-->
</script>
<script type="text/javascript">
<!--

var newwindow;
function popusers(url)
{
  newwindow=window.open(url,'popusers','height=100,width=450');
  if (window.focus) {newwindow.focus()}
}
 -->
</script>
<if:MSG_LIST>
<table class="table table-bordered">
<if:pagert>
   <tr>
      <td colspan='2' align='center'><tag:pagertop /></td>
   </tr>
</if:pagert>
<form action="<tag:pmbox.frm_action />" name="deleteall" method="post">
    <tr>
     <td class="header" align="center"><tag:language.READED /></td>
     <if:OUTBOX>
     <td class="header" align="center"><tag:language.RECEIVER /></td>
     <else:OUTBOX>
     <td class="header" align="center"><tag:language.SENDER /></td>
     </if:OUTBOX>
     <td class="header" align="center"><tag:language.DATE /></td>
     <td class="header" align="center"><tag:language.SUBJECT /></td>

<if:NO_MESSAGES>
    </tr>
    <tr>
      <td class="lista" colspan="5" align="center"><tag:language.NO_MESSAGES /></td>
    </tr>
<else:NO_MESSAGES>
      <td class="header" align="center"><input type="checkbox" name="all" onclick="SetAllCheckBoxes('deleteall','msg[]',this.checked)" /></td>
    </tr>
<loop:pm>
    <tr>
      <td class="lista" align="center"><tag:pm[].readed /></td>
      <td class="lista" align="center"><a href="<tag:pm[].senderid />"><tag:pm[].sendername /></a></td>
      <td class="lista" align="center"><tag:pm[].added /></td>
      <td class="lista" align="center"><a href="<tag:pm[].pmlink />"><tag:pm[].subject /></a></td>
      <td class="lista" align="center"><input type="checkbox" name="msg[]" value="<tag:pm[].msgid />" /></td>
    </tr>
</loop:pm>
    <tr>
      <td class="lista" align="right" colspan="5">
      <if:DROP><select name="todo"><option value="1"><tag:language.DELETE /></option><option value="2"><tag:language.MAR /></option></select></if:DROP>
      <input type="submit" class="btn btn-danger" name="action" value="<tag:language.DELETE_READED />" />
      &nbsp;&nbsp;&nbsp;<tag:language.MSG_DEL_ALL_PM />
      </td>
    </tr>
</if:NO_MESSAGES>
  </table>
</form>
</if:MSG_LIST>
<if:MSG_EDIT>
<form method="post" name="edit" action="<tag:pmedit.frm_action />">
  <table class="table table-bordered">
<if:PREVIEW>
    <tr>
      <td colspan="2">
        <table class="table table-bordered">
          <tr>
            <td class="block" align="center"><b><tag:language.FRM_PREVIEW /></b></td>
          </tr>
          <tr>
            <td class="header" align="center"><tag:language.SUBJECT />: <tag:pmpreview.subject /></td>
          </tr>
          <tr>
            <td class="lista" align="center"><tag:pmpreview.body /></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="2"><br /></td>
    </tr>
</if:PREVIEW>
    <tr>
      <td class="header" align="left"><tag:language.RECEIVER />:</td>
      <td class="header" align="left"><input type="text" name="receiver" value="<tag:pmedit.receiver />" size="35" maxlength="40" <tag:pmedit.readonly /> />&nbsp;&nbsp;<tag:pmedit.searchuser /></td>
    </tr>
    <tr>
      <td class="header" align="left"><tag:language.SUBJECT />:</td>
      <td class="header" align="left"><input type="text" name="subject" value="<tag:pmedit.subject />" size="35" maxlength="40" /></td>
    </tr>
    <tr>
      <td class="lista" colspan="2"><tag:pmedit.bbcode /></td>
    </tr>
    <tr>
      <td colspan="2" class="lista">
    <table align="center" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><input type="submit" class="btn btn-success" name="confirm" value="<tag:language.FRM_CONFIRM />" /></td>
        <td align="center"><input type="submit" class="btn btn-primary" name="confirm" value="<tag:language.FRM_PREVIEW />" /></td>
        <td align="center"><input type="button" class="btn btn-warning" name="confirm" onclick="javascript:window.open('<tag:pmedit.frm_cancel />','_self');" value="<tag:language.FRM_CANCEL />" /></td>
      </tr>
    </table>
      </td>
    </tr>
  </table>
</form>
</if:MSG_EDIT>

<if:MSG_READ>
  <table class="table table-bordered">
    <tr>
      <td width="30%" rowspan="2" class="lista"><a href="<tag:pmread.sender_link />"><tag:pmread.sender_name /></a><br /><tag:pmread.added /><br />(<tag:pmread.elapsed /> ago)</td>
      <td class="header"><tag:language.SUBJECT />: <tag:pmread.comment /></td>
   </tr>
   <tr>
      <td class="lista"><tag:pmread.body /></td>
   </tr>
<if:MSG_MENU>
    <tr>
      <td colspan="2" class="lista">
    <table align="center" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><input onclick="<tag:pmread.quote_link />" type="button" value="<tag:language.QUOTE />"/></td>
        <td align="center"><input onclick="<tag:pmread.answer_link />" type="button" value="<tag:language.ANSWER />"/></td>
        <td align="center"><input onclick="<tag:pmread.delete_link />" type="button" value="<tag:language.DELETE />"/></td>
      </tr>
    </table>
      </td>
    </tr>
</if:MSG_MENU>
  </table>
</if:MSG_READ>
