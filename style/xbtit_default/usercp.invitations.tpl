<if:read_invitations>
<table width="100%" align="center">
<div class="panel panel-primary">
<div class="panel-heading">
<div align="center">
<div style="text-align:center; padding:10px;"><h2><tag:language.WELCOME_UCP_INVITE /></h2></div>
</div>
</div>
</div>

<tr>
<td align="center" class="lista"><div style="text-align:center; padding:10px;"><tag:sendnew_inv /></div></td>
</tr>

    <tr>
      <td>
	  	 <table class="table table-bordered">
	  	  <tr>
	  		<td align="center" class="block" colspan="4"><tag:language.SENT_INVITATIONS />&nbsp;(<tag:sent_inv />)</td>
	  	  </tr>
	  	  <tr>
	   	    <td align="left" class="header"><tag:language.EMAIL /></td>
       	    <td align="left" class="header"><tag:language.INFO_HASH /></td>
       	    <td align="left" class="header"><tag:language.DATE_SENT /></td>
       	    <td align="left" class="header"><tag:language.CONFIRMED /></td>
       	  </tr>
	  	  <if:invs_sent>
       	  <loop:tobe_users>
	  	  <tr>
	   	    <td align="left" class="lista"><tag:tobe_users[].invitee /></td>
       	    <td align="left" class="lista"><tag:tobe_users[].infohash /></td>
       	    <td align="left" class="lista"><tag:tobe_users[].send_date /></td>
       	    <td align="left" class="lista"><tag:tobe_users[].confirmed /></td>
       	  </tr>
       	  </loop:tobe_users>
       	  <else:invs_sent>
	  	  <tr>
	  		<td align="center" class="lista" colspan="4"><tag:language.NO_INVITATIONS_OUT /></td>
	  	  </tr>       	  
       	  </if:invs_sent>
       	</table>
	  </td>
	</tr>
	<tr>
	  <td>
		<table class="table table-bordered">
		  <tr>
			<td align="center" class="block" colspan="6"><tag:language.MEMBERS_INVITED_BY />&nbsp;(<tag:number_confirmed />)</td>
		  </tr>
		  <tr>
			<td colspan="6" style="text-align:center; padding=5px;"><tag:inv_pagertop /></td>
		  </tr>
	  	  <tr>
	   	    <td align="left" class="header"><tag:language.USER_NAME /></td>
       	    <td align="left" class="header"><tag:language.EMAIL /></td>
       	    <td align="left" class="header"><tag:language.UPLOADED /></td>
       	    <td align="left" class="header"><tag:language.DOWNLOADED /></td>
       	    <td align="left" class="header"><tag:language.STATUS /></td>
       	    <td align="left" class="header"><tag:language.FRM_CONFIRM /></td>
       	  </tr>
      	<if:to_confirm>
      	  <form method="post" action="<tag:frm1_target />">
       	<loop:invitees>
	  	  <tr>
	   	    <td align="left" class="lista"><tag:invitees[].username /></td>
       	    <td align="left" class="lista"><tag:invitees[].email /></td>
       	    <td align="left" class="lista"><tag:invitees[].uploaded /></td>
       	    <td align="left" class="lista"><tag:invitees[].downloaded /></td>
       	    <td align="left" class="lista"><tag:invitees[].status /></td>
       	    <td align="left" class="lista"><tag:invitees[].frm_chk /></td>
       	  </tr>
       	</loop:invitees>
		  <tr>
			<td colspan="6" style="text-align:center; padding=5px;"><tag:inv_pagerbottom /></td>
		  </tr>
       	<if:confirm_btn>
	  	  <tr>
	  	 	<td align="center" class="lista" colspan="6"><div style="text-align:center;"><input type="submit" class="btn btn-primary" value="<tag:language.FRM_CONFIRM />" style=''></div></td>
	  	  </tr>
       	</if:confirm_btn>
       	  </form>
       	<else:to_confirm>
	  	  <tr>
	  		<td align="center" class="lista" colspan="6"><tag:language.NO_NEED_CONFIRM_YET /></td>
	  	  </tr>       	  
      	</if:to_confirm>
       	</table>
	  </td>
	</tr>
  </table>
</if:read_invitations>

<if:new_invitation>
 <div class="panel panel-primary">
  <div class="panel-heading">
  <div align="center">
 <div style="text-align:center; padding:10px;"><h2><tag:language.INVITE_SOMEONE_TO />&nbsp;<tag:invnum /></h2></div>
	</div>
    </div>
    </div>
  <table class="table table-bordered">
  <form method="post" action="<tag:frm2_target />">
  <input type="hidden" name="hash" value="<tag:inv_hash />">
  <input type="hidden" name="invitername" value="<tag:invitername />">
	<tr>
	  <td align="left" class="header"><tag:language.EMAIL /></td><td class="lista"><input type="text" size="40" name="email"></td>
	</tr>
	<tr>
	  <td align="left" class="header"><tag:language.MESSAGE /></td><td class="lista"><textarea name="body" rows="6" cols="80"></textarea></td>
	</tr>
	<tr>
	  <td align="center" class="lista" colspan="2"><input type="submit" class="btn btn-primary" value="<tag:language.FRM_CONFIRM />" style=''></td>
	</tr>
  </form>
  </table>
</if:new_invitation>