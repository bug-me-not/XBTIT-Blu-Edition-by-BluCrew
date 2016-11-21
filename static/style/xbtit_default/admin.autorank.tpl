<tag:language.AUTORANK_MAIN_1 />
<br /><br />
<form name='frm_autorank' method='post' action='<tag:autorank_action />'>
  <table>
    <tr>
      <td class='header'><tag:language.AUTORANK_MAIN_2 /></td>
      <td class='lista'><input type='text' name='fullcheck' value='<tag:autorank_fullcheck />' maxlength='2' size='1' /><span style='font-size:125%'><b>:00</b></span></td>
    </tr>
    <tr>
      <td class='header'><tag:language.AUTORANK_SEND_PM /></td>
      <td class='lista'>
      
      
      	  <select name="send_pm" style="background-color:<tag:startcol />;color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
	    <option value="no" style="background-color:#FF0000;color:#000000;"<if:selected1> selected</if:selected1>><tag:language.NO /></option>
        <option value="yes" style="background-color:#00FF00;color:#000000;"<if:selected2> selected</if:selected2>><tag:language.YES /></option>

	  </select>
      
      
      </td>
    </tr>
    <tr>
      <td class='header' colspan='2' align='center'><input type='submit' name='submit' value='<tag:language.SUBMIT />' /></td>
    </tr>
  </table>
</form>
<tag:language.AUTORANK_MAIN_3 /> <a href='<tag:autorank_main />'><tag:language.AUTORANK_MAIN_4 /></a><br /><br />