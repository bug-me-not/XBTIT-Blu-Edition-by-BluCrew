<script type="text/javascript">
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
</script>

<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center">Message Spy</h4>
</div>
<form name="delpm" action="<tag:frmdel />" method="post">
<table class="table table-bordered table-hover">
  <if:pager_needed_1>
  <tr>
    <td class="lista" colspan="8"><tag:pager_top /></td>
  </tr>
  </if:pager_needed_1>
  <tr>
    <td class="head"><b><tag:language.SENDER /></b></td>
    <td class="head"><b><tag:language.RECEIVER /></b></td>
    <td class="head"><b><tag:language.SUBJECT /></b></td>
    <td class="head"><b><tag:language.MESSAGE /></b></td>
    <td class="head"><b><tag:language.DATE_SENT /></b></td>
    <td class="head"><b><tag:language.READED /></b></td>
    <td class="head"><b><tag:language.DELETE /></b></td>
    <td class='head'><input type=checkbox name=all onclick=SetAllCheckBoxes('delpm','pm[]',this.checked)></td>
  </tr>
  <loop:spy>
  <tr>
    <td class="lista"><tag:spy[].sender /></td>
    <td class="lista"><tag:spy[].receiver /></td>
    <td class="lista"><tag:spy[].subject /></td>
    <td class="lista"><tag:spy[].msg /></td>
    <td class="lista"><tag:spy[].added /></td>
    <td class="lista"><tag:spy[].readed /></td>
    <td class="lista"><tag:spy[].delete /></td>
    <td class='lista' style='text-align:center;'><input type='checkbox' name='pm[]' value='<tag:spy[].id />'></td>
  </tr>
  </loop:spy>
  <if:pager_needed_2>
  <tr>
    <td class="lista" colspan="8"><tag:pager_bottom /></td>
  </tr>
  </if:pager_needed_2>
  <tr>
  <td class="lista" colspan="4" style="text-align:left;"><a title="Empty" class="btn btn-md btn-danger" href="<tag:flushurl />"><tag:language.SPY_TRUNCATE /></a></td>
  <td class="lista" colspan="4" style="text-align:right;"><input onclick="return confirm('<tag:language.DELETE_CONFIRM />')" class="btn btn-md btn-warning" type=submit name=action value=<tag:language.DELETE />>&nbsp;</td>
  </td>
  </tr>
</table>
</form>
<div class="panel-footer">
</div>
</div>