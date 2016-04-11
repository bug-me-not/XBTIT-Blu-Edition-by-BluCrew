<div align='center'>
  <form name='tmod_set' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=tmod_set'>
    <table>

      <tr>
        <td class="header"><tag:language.TMOD_SEND_PM /></td>
        <td class="lista">
          <select name="mod_app_pm" style="background-color:<tag:config.mod_app_pm_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
            <option value="yes" style="background-color:#00FF00;color:#000000;" <tag:config.mod_app_pm_1 />><tag:language.YES /></option>
	        <option value="no" style="background-color:#FF0000;color:#000000;" <tag:config.mod_app_pm_2 />><tag:language.NO /></option>
	      </select>
	    </td>
      </tr>
      <tr>
        <td class="header"><tag:language.TMOD_SHOW_APPROVER /></td>
        <td class="lista">
          <select name="mod_app_sa" style="background-color:<tag:config.mod_app_sa_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
            <option value="yes" style="background-color:#00FF00;color:#000000;" <tag:config.mod_app_sa_1 />><tag:language.YES /></option>
	        <option value="no" style="background-color:#FF0000;color:#000000;" <tag:config.mod_app_sa_2 />><tag:language.NO /></option>
	      </select>
	    </td>
      </tr>

      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>