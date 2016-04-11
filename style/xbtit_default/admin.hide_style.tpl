<div align=center>
<div align=center>
<form name="hide_style" action="index.php?page=admin&user=<tag:uid />&code=<tag:random />&do=hide_style" method="post">
<table class="lista" width="45%" cellspacing="4" cellpadding="6">
  <tr>
    <td class="header"><tag:language.ACP_HIDE_STYLE /></td>
    <td class="header"><tag:language.STATUS_STYLE /></td>
  </tr>
  <tr>
    <td class="lista"><tag:language.ACP_USERCP_STYLE /></td>
    <td class="lista">
	  <select name="usercp_style" style="background-color:<tag:usercp_style_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
        <option value="enabled" style="background-color:#00FF00;color:#000000;"<if:usercp_style_enabled> selected="selected"</if:usercp_style_enabled>><tag:language.ACP_VISIBLE /></option>
	    <option value="disabled" style="background-color:#FF0000;color:#000000;"<if:usercp_style_disabled> selected="selected"</if:usercp_style_disabled>><tag:language.ACP_HIDDEN /></option>
	  </select>
	</td>
  </tr>
  <tr>
    <td class="lista"><tag:language.ACP_USERINFO_STYLE /></td>
    <td class="lista">
	  <select name="userinfo_style" style="background-color:<tag:userinfo_style_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
        <option value="enabled" style="background-color:#00FF00;color:#000000;"<if:userinfo_style_enabled> selected="selected"</if:userinfo_style_enabled>><tag:language.ACP_VISIBLE /></option>
	    <option value="disabled" style="background-color:#FF0000;color:#000000;"<if:userinfo_style_disabled> selected="selected"</if:userinfo_style_disabled>><tag:language.ACP_HIDDEN /></option>	    
	  </select>
	</td>
  </tr>
  <tr>
    <td class="lista"><tag:language.ACP_MAINUSERTOOLBAR_STYLE /></td>
    <td class="lista">
	  <select name="usertoolbar_style" style="background-color:<tag:usertoolbar_style_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
        <option value="enabled" style="background-color:#00FF00;color:#000000;"<if:usertoolbar_style_enabled> selected="selected"</if:usertoolbar_style_enabled>><tag:language.ACP_VISIBLE /></option>
	    <option value="disabled" style="background-color:#FF0000;color:#000000;"<if:usertoolbar_style_disabled> selected="selected"</if:usertoolbar_style_disabled>><tag:language.ACP_HIDDEN /></option>    
	  </select>
	</td>
  </tr>
  <tr>
    <td class="lista"><tag:language.ACP_CREATEACC_STYLE /></td>
    <td class="lista">
	  <select name="createacc_style" style="background-color:<tag:createacc_style_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
        <option value="enabled" style="background-color:#00FF00;color:#000000;"<if:createacc_style_enabled> selected="selected"</if:createacc_style_enabled>><tag:language.ACP_VISIBLE /></option>
	    <option value="disabled" style="background-color:#FF0000;color:#000000;"<if:createacc_style_disabled> selected="selected"</if:createacc_style_disabled>><tag:language.ACP_HIDDEN /></option>    
	  </select>
	</td>
  </tr> 
<if:add_new_users_in_adminCP_enabled>  
  <tr>
    <td class="lista"><tag:language.ACP_ADDNEWUSER_STYLE /></td>
    <td class="lista">
	  <select name="add_new_user_style" style="background-color:<tag:add_new_user_style_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
        <option value="enabled" style="background-color:#00FF00;color:#000000;"<if:add_new_user_style_enabled> selected="selected"</if:add_new_user_style_enabled>><tag:language.ACP_VISIBLE /></option>
	    <option value="disabled" style="background-color:#FF0000;color:#000000;"<if:add_new_user_style_disabled> selected="selected"</if:add_new_user_style_disabled>><tag:language.ACP_HIDDEN /></option>    
	  </select>
	</td>
  </tr>
</if:add_new_users_in_adminCP_enabled>
<if:alternate_login_enabled>
<if:single>
  <tr>
    <td class="lista"><tag:language.ACP_SBGLOGIN_STYLE /></td>
    <td class="lista">
	  <select name="sbg_login_style" style="background-color:<tag:sbg_login_style_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
        <option value="enabled" style="background-color:#00FF00;color:#000000;"<if:sbg_login_style_enabled> selected="selected"</if:sbg_login_style_enabled>><tag:language.ACP_VISIBLE /></option>
	    <option value="disabled" style="background-color:#FF0000;color:#000000;"<if:sbg_login_style_disabled> selected="selected"</if:sbg_login_style_disabled>><tag:language.ACP_HIDDEN /></option>    
	  </select>
	</td>
  </tr>
</if:single>
<if:rotating> 
  <tr>
    <td class="lista"><tag:language.ACP_RBGLOGIN_STYLE /></td>
    <td class="lista">
	  <select name="rbg_login_style" style="background-color:<tag:rbg_login_style_color />color:#000000;"  onchange="this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor" />
        <option value="enabled" style="background-color:#00FF00;color:#000000;"<if:rbg_login_style_enabled> selected="selected"</if:rbg_login_style_enabled>><tag:language.ACP_VISIBLE /></option>
	    <option value="disabled" style="background-color:#FF0000;color:#000000;"<if:rbg_login_style_disabled> selected="selected"</if:rbg_login_style_disabled>><tag:language.ACP_HIDDEN /></option>    
	  </select>
	</td>
  </tr>
</if:rotating> 
</if:alternate_login_enabled>
</table>
<table class="lista" width="45%" cellspacing="0" cellpadding="0">
    <tr>
    <td class='header' colspan='4' align='center'><b><tag:language.EN_DIS_STYLE /></b></td>
  </tr>
  <tr>
    <td class='lista' colspan='4' style='text-align:center'>
    <tag:language.SET_ABOVE />: <input type='radio' name='enable_all' value='take_no_action' checked='checked' />&nbsp;&nbsp;|&nbsp;&nbsp;
    <tag:language.EN_ALL />: <input type='radio' name='enable_all' value='enable_all' />&nbsp;&nbsp;|&nbsp;&nbsp;
    <tag:language.DIS_ALL />: <input type='radio' name='enable_all' value='disable_all' />
    </td>
  </tr>
  <tr>
  <td colspan=4 class=header align=center><input type="submit" value="<tag:language.SUBMIT />" /></td>
  </tr>
</form>  
</table>
</div>