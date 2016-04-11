<script type="text/javascript">
<!--

window.onload=function()
{
    document.getElementById('findusers').style.visibility="visible";
    document.edit.receiver.disabled=false;
    document.edit.levelLow.disabled=true;
    document.edit.levelHigh.disabled=true;
}

function disableThisItem(obj)
{
    var selected=document.edit.affect.options[obj.selectedIndex].value;

    if(selected=="1")
    {
        document.getElementById('findusers').style.visibility="visible";
        document.edit.receiver.disabled=false;
        document.edit.levelLow.disabled=true;
        document.edit.levelHigh.disabled=true;
    }
    if(selected=="2")
    {
        document.getElementById('findusers').style.visibility="hidden";
        document.edit.receiver.disabled=true;
        document.edit.receiver.value="";
        document.edit.levelLow.disabled=false;
        document.edit.levelHigh.disabled=false;
    }
}

function disableThisItemToo(obj)
{
    var selected=document.edit.task.options[obj.selectedIndex].value;

    if(selected=="1")
    {
        document.edit.taskText.disabled=false;
        document.edit.taskText.value="0";
    }
    if(selected=="2")
    {
        document.edit.taskText.disabled=false;
        document.edit.taskText.value="0";
    }
    if(selected=="3")
    {
        document.edit.taskText.disabled=true;
        document.edit.taskText.value="";
    }

}

var newwindow;
function popusers(url)
{    
    newwindow=window.open(url,'popusers','height=100,width=450');
    if (window.focus)
    {
        newwindow.focus()
    }
}
-->
</script>

<div align='center'>
  <form name='edit' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=fls'>
    <table>
      <tr>
        <td class='header' align='right'><tag:language.FLS_AFFECT />:</td>
        <td class='lista'>
          <select id="affect" name="affect" onchange="disableThisItem(this);" />
            <option value="1"><tag:language.FLS_INDIV /></option>
            <option value="2"><tag:language.FLS_GROUP /></option>
          </select>
        </td>
      </tr>
      <tr>
        <td class='header' align='right'><tag:language.USERNAME />:</td>
        <td class='lista'><input type="text" name="receiver" id="receiver" /><div id="findusers">&nbsp;&nbsp;<a href="javascript:popusers('searchusers.php');"><tag:language.FIND_USER /></a></div></td>
      </tr>
      <tr>
        <td class='header' align='right'><tag:language.FLS_RANK_RANGE /></td>
        <td class='lista'><tag:rankLow />&nbsp;&nbsp;<span style="font-size:large;">&rarr;</span>&nbsp;&nbsp;<tag:rankHigh /></td>
      </tr>
        <td class='header' align='right'><tag:language.FLS_OPTIONS /></td>
        <td class='lista'>
          <select id="task" name="task"  onchange="disableThisItemToo(this);" />
            <option value="1" selected="selected"><tag:language.FLS_INCREMENT_SLOTS /></option>
            <option value="2"><tag:language.FLS_SET_SLOTS_TO /></option>
            <option value="3"><tag:language.FLS_ZERO_AND_CANCEL /></option>
          </select>
          <input type="text" name="taskText" value="0" size="3" maxlength="4" />
        </td>
      </tr>
        <tr>
        <td class='header' colspan="2" style="text-align:center;"><input type="submit" name="confirm" value="<tag:language.FRM_CONFIRM />" /></td>
      </tr>
    </table>
  </form>
</div>
