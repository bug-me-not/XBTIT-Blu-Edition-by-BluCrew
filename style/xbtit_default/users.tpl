<div align="center">
  <form action="index.php" name="ricerca" method="get">
  <input type="hidden" name="page" value="users" />
    <table class="table table-bordered">
      <tr>
        <td class="block"><tag:language.FIND_USER /></td>
        <td class="block"><tag:language.USER_LEVEL /></td>
        <td class="block">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" style="width: 500px;"><input type="text" id="searchinput" name="searchtext" style="width: 210px;" maxlength="50" ondblclick="suggest_users(event.keyCode, this.value, 'user');" onkeyup="suggest_users(event.keyCode, this.value, 'user');" onkeypress="return noenter(event.keyCode);" autocomplete="off" class="form-control" value="<tag:users_search />" />
		<div id="suggcontainer" style="display: none; padding-left:0px;" align="left">
		    <div id="suggestions" style="cursor: default; position: absolute; background-color: #373737; border: 1px solid #7f9db9; border-top: 0px;"></div>
		</div>
	   <if:pun_enabled> <tag:language.PREUS_PUN /> <input type="checkbox" name="previous_usernames"<if:pun_checked> checked="checked"</if:pun_checked> /></if:pun_enabled></td>
        <td><select name="level" class="form-control">
            <option value="0" <tag:users_search_level />><tag:language.ALL /></option>
            <tag:users_search_select />
            </select>
        </td>
        <td><input type="submit" class="btn btn-primary" value="<tag:language.SEARCH />" /></td>
      </tr>
    </table>

<if:extra_staff>
<!-- Search by ip, email, pid ################################################################# -->
<a href="javascript:animatedcollapse.toggle('slideadvanced')">.:. <u>[Extra Staff Search]</u> .:.</a>
<script type="text/javascript">
animatedcollapse.addDiv('slideadvanced', 'fade=1,speed=1000,persist=1,hide=0')
animatedcollapse.ontoggle=function($, divobj, state){ }
animatedcollapse.init()
</script>
<div id="slideadvanced">
    <table class="table table-bordered">
      <tr>
        <td class="block"><tag:language.EMAIL /></td>
        <td class="block"><tag:language.LAST_IP /></td>
        <td class="block"><tag:language.PID /></td>
      </tr>
      <tr>
        <td><input type="text" name="smail" size="18" maxlength="50" value="<tag:smail />" /></td>
        <td><input type="text" name="sip" size="18" maxlength="50" value="<tag:sip />" /></td>
        <td><input type="text" name="pid" size="18" maxlength="48" value="<tag:pid />" /></td>
      </tr>
    </table>
</div>
<!-- Search by ip, email, pid # end ########################################################### -->
</if:extra_staff>
  </form>
  <tag:users_pagertop />
    <table class="table table-bordered">
      <tr>
        <td class="header" align="center"><tag:users_sort_username /></td>
        <td class="header" align="center"><tag:users_sort_userlevel /></td>
        <if:warn_enabled>
        <td class="header" align="center"><tag:language.WS_WL /></td>
        </if:warn_enabled>

        <td class="header" align="center"><tag:users_sort_joined /></td>
        <td class="header" align="center"><tag:users_sort_lastaccess /></td>
        <td class="header" align="center"><tag:users_sort_country /></td>
        <if:ip2c_enabled1>
        <td class="header" align="center"><tag:rcountry /></td>
        </if:ip2c_enabled1>
        <td class="header" align="center"><tag:users_sort_ratio /></td>
        <td class="header" align="center"><tag:users_pm /></td>
        <if:ban_button_enabled>
        <td class="header" align="center"><tag:users_ban /></td>
        </if:ban_button_enabled>
        <if:privprof_enabled>
        <td class="header" align="center"><tag:language.PP_PROFILE /></td>
        </if:privprof_enabled>
        <td class="header" align="center"><tag:users_edit /></td>
        <td class="header" align="center"><tag:users_delete /></td>
      </tr>
      <if:no_users>
        <tr>
          <td class="lista" colspan="9"><tag:language.NO_USERS_FOUND /></td>
        </tr>
      <else:no_users>
        <loop:users>
          <tr>
            <td class="lista" align="center" style="padding-left:10px;"><tag:users[].username /><if:user_img_enabled><tag:users[].user_images /></if:user_img_enabled></td>
            <td class="lista" align="center" style="text-align: center;"><tag:users[].userlevel /></td>
        <if:warn_enabled2>
        <td class="lista" align="center" style="text-align: center;"><tag:users[].warns /></td>
        </if:warn_enabled2>

            <td class="lista" align="center" style="text-align: center;"><tag:users[].joined /></td>
            <td class="lista" align="center" style="text-align: center;"><tag:users[].lastconnect /></td>
            <td class="lista" align="center" style="text-align: center;"><tag:users[].flag /></td>
            <if:ip2c_enabled2>
            <td class="lista" align="center" style="text-align: center;"><tag:users[].country /></td>
            </if:ip2c_enabled2>
            <td class="lista" align="center" style="text-align: center;"><tag:users[].ratio /></td>
            <td class="lista" align="center" style="text-align: center;"><tag:users[].pm /></td>
            <if:ban_button_enabled2>
            <td class="lista" align="center" style="text-align: center;"><tag:users[].ban /></td>
            </if:ban_button_enabled2>
            <if:privprof_enabled2>
            <td class="lista" align="center" style="text-align: center;"><tag:users[].private /></td>
            </if:privprof_enabled2>
            <td class="lista" align="center" style="text-align: center;"><tag:users[].edit /></td>
            <td class="lista" align="center" style="text-align: center;"><tag:users[].delete /></td>
          </tr>
        </loop:users>
      </if:no_users>
    </table>
</div>
<br />
