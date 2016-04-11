<script type="text/javascript">

at=new sack();


function show_wait()
{
  document.getElementById('pwd_error').style.display='none';
  document.getElementById('email_error').style.display='none';
  document.getElementById('name_error').style.display='none';
  document.getElementById('loading').style.display='block';
}

function Cancel()
{
  window.location.href='<tag:frm_cancel />';
}


function ShowUpdate()
{
  var mytext=at.response + '';
  var myout=mytext.split('|');
  document.getElementById('loading').style.display='none';
  switch (myout[1]) {
     case '0': // positive, user created
          window.location.href='<tag:insert_ok />';
       break;

     case '1': // error on username
          document.getElementById('name_error').style.display='block';
          document.getElementById('name_error').innerHTML = myout[0];
       break;

     case '2': // error on the password
          document.getElementById('pwd_error').style.display='block';
          document.getElementById('pwd_error').innerHTML = myout[0];
       break;

     case '3': // error on the email
          document.getElementById('email_error').style.display='block';
          document.getElementById('email_error').innerHTML = myout[0];
       break;

     case '4': // positive, user created
          window.location.href='<tag:insert_pb />';
       break;

     case '5': // positive, user created
          window.location.href='index.php?page=admin&user='+myout[2]+'&code='+myout[3]+'&do=ipb_new_member&essentials='+myout[4]+'&case=5';
       break;

     case '6': // positive, user created
          window.location.href='index.php?page=admin&user='+myout[2]+'&code='+myout[3]+'&do=ipb_new_member&essentials='+myout[4]+'&case=6';
       break;

  }
}

function Check_Data()
{

//  at.resetData();
  at.onLoading=show_wait;
  at.requestFile='<tag:tracker_url />/admin/admin.users.chknew.php';
  at.setVar('username',document.getElementById('username').value);
  at.setVar('pwd',document.getElementById('want_password').value);
  at.setVar('email',document.getElementById('email').value);
  at.setVar('level',document.getElementById('level').value);
  at.setVar('style',document.getElementById('style').value);
  at.setVar('language',document.getElementById('language').value);
  if (document.getElementById('emailsend').checked==true)
     at.setVar('emailsend',1);
  else
      at.setVar('emailsend',0);
  at.setVar('code','<tag:user_code />');
  at.setVar('user','<tag:user_id />');
  at.onCompletion = ShowUpdate;
  at.runAJAX();
}


function form_control()
  {
    if (document.getElementById('username').value.length==0)
      {
      var user=document.createElement('span');
      user.innerHTML="<tag:language.INSERT_USERNAME />";
      alert(user.innerHTML);
      document.getElementById('username').focus();
      return false;
      }

    if (document.getElementById('want_password').value == "")
      {
      var want_password=document.createElement('span');
      want_password.innerHTML="<tag:language.INSERT_PASSWORD />";
      alert(want_password.innerHTML);
      document.getElementById('want_password').focus();
      return false;
      }

    if (document.getElementById('check_password').value == "")
      {
      var check_password=document.createElement('span');
      check_password.innerHTML="<tag:language.USER_PWD_AGAIN />";
      alert(check_password.innerHTML);
      document.getElementById('check_password').focus();
      return false;
      }

    if (document.getElementById('want_password').value !=  document.getElementById('check_password').value)
      {
      var dif_passwords=document.createElement('span');
      dif_passwords.innerHTML="<tag:language.DIF_PASSWORDS />";
      alert(dif_passwords.innerHTML);
      return false;
      }

    var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (document.getElementById('email').value == "")
      {
      var email=document.createElement('span');
      email.innerHTML="<tag:language.ERR_NO_EMAIL />";
      alert(email.innerHTML);
      document.getElementById('email').focus();
      return false;
      }
    else
      {
        if (!filter.test(document.getElementById('email').value))
         {
          var email=document.createElement('span');
          email.innerHTML="<tag:language.ERR_NO_EMAIL />";
          alert(email.innerHTML);
          document.getElementById('email').focus();
          return false;
         }
      }


    if (document.getElementById('email_again').value == "")
      {
      var email_again=document.createElement('span');
      email_again.innerHTML="<tag:language.ERR_NO_EMAIL_AGAIN />";
      alert(email_again.innerHTML);
      document.getElementById('email_again').focus();
      return false;
      }
    else
      {
        if (!filter.test(document.getElementById('email_again').value))
         {
          var email_again=document.createElement('span');
          email_again.innerHTML="<tag:language.ERR_NO_EMAIL />";
          alert(email_again.innerHTML);
          document.getElementById('email_again').focus();
          return false;
         }
      }

    if (document.getElementById('email').value !=  document.getElementById('email_again').value)
      {
      var DIF_EMAIL=document.createElement('span');
      DIF_EMAIL.innerHTML="<tag:language.DIF_EMAIL />";
      alert(DIF_EMAIL.innerHTML);
      return false;
      }

   Check_Data();
  }


</script>
<form name="new_users" method="post" action="<tag:frm_action />" >
    <table width="100%" border="0" class="lista">
        <tr>
            <td class="header" align="left" ><tag:language.USER_NAME />:</td>
            <td class="lista" align="left" >
                <input type="text" style="width:90%;" id="username" name="username" maxlength="100" value=""/>
                <div id="name_error" style="display:none"></div>
            </td>
        </tr>
        <tr>
            <td align="left" class="header"><tag:language.USER_PWD />:</td>
            <td align="left" class="lista">
            <input type="password" style="width:90%;" id="want_password" name="pwd" />
            </td>
        </tr>
        <tr>
           <td align="left" class="header"><tag:language.USER_PWD_AGAIN />:</td>
           <td align="left" class="lista">
               <input type="password" style="width:90%;" id="check_password" name="pwd1" />
                <div id="pwd_error" style="display:none"></div>
           </td>
        </tr>
        <tr>
            <td align="left" class="header"><tag:language.USER_EMAIL /></td>
            <td align="left" class="lista"><input type="text" id="email" name="email" maxlength="100" value=""  style="width:90%;" /></td>
        </tr>
        <tr>
            <td align="left" class="header"><tag:language.USER_EMAIL_AGAIN />:</td>
            <td align="left" class="lista">
                <input type="text" name="email1" id="email_again" autocomplete="off" maxlength="100" value="" style="width:90%;" />
                <div id="email_error" style="display:none"></div>
            </td>
        </tr>
        <tr>
            <td align="left" class="header"><tag:language.USER_LEVEL />:</td>
            <td align="left" class="lista"><tag:rank_combo /></td>
        </tr>
    <if:add_new_user_language_enabled>        
        <tr>
            <td align="left" class="header"><tag:language.USER_LANGUE />:</td>
            <td align="left" class="lista"><tag:language_combo /></td>
        </tr>
    <else:add_new_user_language_enabled>
        <tag:lang_form />
    </if:add_new_user_language_enabled>
    <if:add_new_user_style_enabled>            
        <tr>
            <td align="left" class="header"><tag:language.USER_STYLE />:</td>
            <td align="left" class="lista"><tag:style_combo /></td>
        </tr>
    <else:add_new_user_style_enabled>
        <tag:style_form />
    </if:add_new_user_style_enabled>
        <tr>
            <td align="center" class="lista" colspan="2" style="text-align: center"><tag:language.NEW_USER_EMAIL />&nbsp;&nbsp;<input type="checkbox" id="emailsend" name="emailsend" checked="checked" /></td>
        </tr>
        <tr>
            <td align="center" class="header" colspan="2">
                <div id="loading" style="display:none;">
                <br /><img src="images/ajax-loader.gif" alt="" title="ajax-loader" /><br />
                </div>
                <input type="button" class="btn" name="confirm" value="<tag:language.FRM_CONFIRM />" onclick="form_control()" />&nbsp;&nbsp;<input type="button" class="btn" name="confirm" onclick="Cancel()" value="<tag:language.FRM_CANCEL />" />
            </td>
        </tr>
    </table>
</form>