<div align='center'>
  <form name='user_notes' method='post' action='index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=user_notes'>
    <table>

      <tr>
      <td class="header" align="center" colspan="2"><tag:language.UN_AUTONOTE />:</td>
      </tr>

      <tr>
        <td class="header"><tag:language.UN_INVITE /></td>
        <td class="lista">
          <select name="un_invite" style="background-color:<tag:config.un_invite_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
            <option value="enabled" style="background-color:#00FF00;color:#000000;" <tag:config.un_invite_1 />><tag:language.UN_ENABLED /></option>
	        <option value="disabled" style="background-color:#FF0000;color:#000000;" <tag:config.un_invite_2 />><tag:language.UN_DISABLED /></option>
	      </select>
	    </td>
      </tr>

      <tr>
        <td class="header"><tag:language.UN_BONUS /></td>
        <td class="lista">
          <select name="un_bonus" style="background-color:<tag:config.un_bonus_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
            <option value="enabled" style="background-color:#00FF00;color:#000000;" <tag:config.un_bonus_1 />><tag:language.UN_ENABLED /></option>
	        <option value="disabled" style="background-color:#FF0000;color:#000000;" <tag:config.un_bonus_2 />><tag:language.UN_DISABLED /></option>
	      </select>
	    </td>
      </tr>

      <tr>
        <td class="header"><tag:language.UN_DONATE /></td>
        <td class="lista">
          <select name="un_donate" style="background-color:<tag:config.un_donate_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
            <option value="enabled" style="background-color:#00FF00;color:#000000;" <tag:config.un_donate_1 />><tag:language.UN_ENABLED /></option>
	        <option value="disabled" style="background-color:#FF0000;color:#000000;" <tag:config.un_donate_2 />><tag:language.UN_DISABLED /></option>
	      </select>
	    </td>
      </tr>

      <tr>
        <td class="header"><tag:language.UN_WARN /></td>
        <td class="lista">
          <select name="un_warn" style="background-color:<tag:config.un_warn_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
            <option value="enabled" style="background-color:#00FF00;color:#000000;" <tag:config.un_warn_1 />><tag:language.UN_ENABLED /></option>
	        <option value="disabled" style="background-color:#FF0000;color:#000000;" <tag:config.un_warn_2 />><tag:language.UN_DISABLED /></option>
	      </select>
	    </td>
      </tr>

      <tr>
        <td class="header"><tag:language.UN_AUTORANK /></td>
        <td class="lista">
          <select name="un_autorank" style="background-color:<tag:config.un_autorank_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
            <option value="enabled" style="background-color:#00FF00;color:#000000;" <tag:config.un_autorank_1 />><tag:language.UN_ENABLED /></option>
	        <option value="disabled" style="background-color:#FF0000;color:#000000;" <tag:config.un_autorank_2 />><tag:language.UN_DISABLED /></option>
	      </select>
	    </td>
      </tr>

      <tr>
        <td class="header"><tag:language.UN_BOOTED /></td>
        <td class="lista">
          <select name="un_booted" style="background-color:<tag:config.un_booted_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
            <option value="enabled" style="background-color:#00FF00;color:#000000;" <tag:config.un_booted_1 />><tag:language.UN_ENABLED /></option>
	        <option value="disabled" style="background-color:#FF0000;color:#000000;" <tag:config.un_booted_2 />><tag:language.UN_DISABLED /></option>
	      </select>
	    </td>
      </tr>

      <tr>
        <td class="header"><tag:language.UN_SBBAN /></td>
        <td class="lista">
          <select name="un_sbban" style="background-color:<tag:config.un_sbban_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
            <option value="enabled" style="background-color:#00FF00;color:#000000;" <tag:config.un_sbban_1 />><tag:language.UN_ENABLED /></option>
	        <option value="disabled" style="background-color:#FF0000;color:#000000;" <tag:config.un_sbban_2 />><tag:language.UN_DISABLED /></option>
	      </select>
	    </td>
      </tr>

      <tr>
        <td class="header"><tag:language.UN_BANBUT /></td>
        <td class="lista">
          <select name="un_banbut" style="background-color:<tag:config.un_banbut_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
            <option value="enabled" style="background-color:#00FF00;color:#000000;" <tag:config.un_banbut_1 />><tag:language.UN_ENABLED /></option>
	        <option value="disabled" style="background-color:#FF0000;color:#000000;" <tag:config.un_banbut_2 />><tag:language.UN_DISABLED /></option>
	      </select>
	    </td>
      </tr>

      <tr>
        <td class="header"><tag:language.UN_NOTESPERPAGE /></td>
        <td class="lista"><input type="text" name="un_notesperpage" value="<tag:config.un_notesperpage />" size="9" maxlength="4" /></td>
      </tr>

      <tr>
        <td class='blocklist' align='center' colspan='2'><input type='submit' name='submit' value='<tag:language.SUBMIT />'></td>
      </tr>
    </table>
  </form>
</div>