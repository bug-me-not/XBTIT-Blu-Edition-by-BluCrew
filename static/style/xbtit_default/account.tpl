<div class="panel panel-primary">
<div class="panel-heading">
<h4 class="text-center"><tag:language.WELCOME_INVITE /></h4>
</div>  

<!-- ### Password strength javascript ### -->

<script type="text/javascript" src="jscript/passwdcheck.js"></script>

<!-- ### End ### -->

<script type="text/javascript">
function form_control()
  {
    if (document.getElementById('user').value.length==0)
      {
      var user=document.createElement('span');
      user.innerHTML='<tag:language.INSERT_USERNAME />';
      alert(user.innerHTML);
      document.getElementById('user').focus();
      return false;
      }

    if (document.getElementById('want_password').value == "")
      {
      var want_password=document.createElement('span');
      want_password.innerHTML='<tag:language.INSERT_PASSWORD />';
      alert(want_password.innerHTML);
      document.getElementById('want_password').focus();
      return false;
      }

    if (document.getElementById('check_password').value == "")
      {
      var check_password=document.createElement('span');
      check_password.innerHTML='<tag:language.USER_PWD_AGAIN />';
      alert(check_password.innerHTML);
      document.getElementById('check_password').focus();
      return false;
      }

    if (document.getElementById('want_password').value !=  document.getElementById('check_password').value)
      {
      var dif_passwords=document.createElement('span');
      dif_passwords.innerHTML='<tag:language.DIF_PASSWORDS />';
      alert(dif_passwords.innerHTML);
      return false;
      }

    var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (document.getElementById('email').value == "")
      {
      var email=document.createElement('span');
      email.innerHTML='<tag:language.ERR_NO_EMAIL />';
      alert(email.innerHTML);
      document.getElementById('email').focus();
      return false;
      }
    else
      {
        if (!filter.test(document.getElementById('email').value))
         {
          var email=document.createElement('span');
          email.innerHTML='<tag:language.ERR_NO_EMAIL />';
          alert(email.innerHTML);
          document.getElementById('email').focus();
          return false;
         }
      }


    if (document.getElementById('email_again').value == "")
      {
      var email_again=document.createElement('span');
      email_again.innerHTML='<tag:language.ERR_NO_EMAIL_AGAIN />';
      alert(email_again.innerHTML);
      document.getElementById('email_again').focus();
      return false;
      }
    else
      {
        if (!filter.test(document.getElementById('email_again').value))
         {
          var email_again=document.createElement('span');
          email_again.innerHTML='<tag:language.ERR_NO_EMAIL />';
          alert(email_again.innerHTML);
          document.getElementById('email_again').focus();
          return false;
         }
      }

    if (document.getElementById('email').value !=  document.getElementById('email_again').value)
      {
      var DIF_EMAIL=document.createElement('span');
      DIF_EMAIL.innerHTML='<tag:language.DIF_EMAIL />';
      alert(DIF_EMAIL.innerHTML);
      return false;
      }

   return true;
  }
</script>

<form name="utente" method="post" onsubmit="return form_control()" action="<tag:account_form_actionlink />" >
  <input type="hidden" name="act" value="<tag:account_action />" />
  <input type="hidden" name="uid" value="<tag:account_uid />" />
  <input type="hidden" name="returnto" value="<tag:account_returnto />" />
  <if:createacc_language_disabled_1>
  <input type="hidden" name="language" value="<tag:account_IDlanguage />" />
  </if:createacc_language_disabled_1>
  <if:createacc_style_disabled_1>
  <input type="hidden" name="style" value="<tag:account_IDstyle />" />
  </if:createacc_style_disabled_1>
  <input type="hidden" name="flag" value="<tag:account_IDcountry />" />
  <input type="hidden" name="username" value="<tag:account_username />"/>
  <table width="60%" border="0" class="lista">

<table class="table table-bordered"> 
    <tr>
       <td align="left" class="header"><tag:language.USER_NAME />:</td>
       <td align="left" class="lista">
       <if:DEL>
         <input type="text" size="40" name="user" id="user" class="form-control" value="<tag:dati.username />" "readonly" />
       <else:DEL>
         <input type="text" size="40" name="user" id="user" class="form-control"  value="<tag:dati.username />" />
       </if:DEL>
       </td>
    </tr>
    <if:DISPLAY_FULL>

    <tr>
       <td align="left" class="header"><tag:language.USER_PWD />:</td>
       <td align="left" class="lista">
         <tag:language.SECSUI_ACC_PWD_1 /><br />
         <li><tag:language.SECSUI_ACC_PWD_2 /> <span style="color:blue;font-weight:bold;"><tag:pass_min_char /></span> <if:pass_char_plural><tag:language.SECSUI_ACC_PWD_3A /><else:pass_char_plural><tag:language.SECSUI_ACC_PWD_3 /></if:pass_char_plural></li>
         <if:pass_lct_set><li><tag:language.SECSUI_ACC_PWD_4 /> <span style="color:blue;font-weight:bold;"><tag:pass_min_lct /></span> <if:pass_lct_plural><tag:language.SECSUI_ACC_PWD_5A /><else:pass_lct_plural><tag:language.SECSUI_ACC_PWD_5 /></if:pass_lct_plural></li></if:pass_lct_set>
         <if:pass_uct_set><li><tag:language.SECSUI_ACC_PWD_4 /> <span style="color:blue;font-weight:bold;"><tag:pass_min_uct /></span> <if:pass_uct_plural><tag:language.SECSUI_ACC_PWD_6A /><else:pass_uct_plural><tag:language.SECSUI_ACC_PWD_6 /></if:pass_uct_plural></li></if:pass_uct_set>
         <if:pass_num_set><li><tag:language.SECSUI_ACC_PWD_4 /> <span style="color:blue;font-weight:bold;"><tag:pass_min_num /></span> <if:pass_num_plural><tag:language.SECSUI_ACC_PWD_7A /><else:pass_num_plural><tag:language.SECSUI_ACC_PWD_7 /></if:pass_num_plural></li></if:pass_num_set>
         <if:pass_sym_set><li><tag:language.SECSUI_ACC_PWD_4 /> <span style="color:blue;font-weight:bold;"><tag:pass_min_sym /></span> <if:pass_sym_plural><tag:language.SECSUI_ACC_PWD_8A /><else:pass_sym_plural><tag:language.SECSUI_ACC_PWD_8 /></if:pass_sym_plural></li></if:pass_sym_set>
         <input type="password" size="40" class="form-control"  id="want_password" name="pwd" 
           onkeyup="EvalPwdStrength(document.forms[0],this.value);"/><br /> <!-- The textbox itself onkeyup-->

       
       
           <!-- ### Password strength tables and columns ### -->
           <div id="pwdstrenght" style="display:none;">
           <table border="0" width="268px" align="left">
             <tr>
                <td id="idSM1" class="pwdChkCon0" align="center" width="25%">
                <span id="idSMT1" style="display: none;"><tag:language.WEEK /></span>
                </td>

                <td id="idSM2" class="pwdChkCon0" align="center" width="25%">
                <span id="idSMT0" style="display: none;"><!-- NOT RATED --></span>
                <span id="idSMT2" style="display: none;"><tag:language.MEDIUM /></span>
                </td>

                <td id="idSM3" class="pwdChkCon0" align="center" width="25%">
                <span id="idSMT3" style="display: none;"><tag:language.SAFE /></span>
                </td>

                <td id="idSM4" class="pwdChkCon0" align="center" width="25%">
                <span id="idSMT4" style="display: none;"><tag:language.STRONG /></span>
                </td>
             </tr>
           </table>
           </div>

           <!-- ### End ### -->

    </td>
  </tr>

    <tr>
       <td align="left" class="header"><tag:language.USER_PWD_AGAIN />:</td>
       <td align="left" class="lista"><input type="password" size="40" class="form-control"  id="check_password" name="pwd1" /></td>
    </tr>
    <tr>
       <td align="left" class="header"><tag:language.USER_EMAIL />:</td>
       <td align="left" class="lista"><input type="text" size="30" name="email" class="form-control"  id="email" placeholder="Use A Valid Email!" value="<tag:dati.email />"/></td>
    </tr>
    <tr>
       <td align="left" class="header"><tag:language.USER_EMAIL_AGAIN />:</td>
       <td align="left" class="lista"><input type="text" size="30" name="email_again" class="form-control" placeholder="Use A Valid Email!" id="email_again" autocomplete="off" value="<tag:dati.email />"/></td>
    </tr>

    <if:birthdays_enabled>
    <tr>
       <td align="left" class="header"><tag:language.DOB />:</td>
       <td align="left" class="lista"><input type="text" size="2" name="dobday" class="form-control" maxlength="2" value=""/>&nbsp;&nbsp;/&nbsp;&nbsp;<input type="text" size="2" name="dobmonth" class="form-control" maxlength="2" value=""/>&nbsp;&nbsp;/&nbsp;&nbsp;<input type="text" size="4" name="dobyear" class="form-control"  maxlength="4" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<tag:language.DOB_FORMAT /></td>
    </tr>
    </if:birthdays_enabled>
    
    <if:ssl_enabled>
	<tr>
       <td align="left" class="header"><tag:language.SSL /></td>
       <td class="lista"><input type="checkbox" name="force" checked><tag:language.SSL_DESC /></td>
    </tr>
    </if:ssl_enabled>
    
	  <if:createacc_language_enabled>
    <tr>
       <td align="left" class="header"><tag:language.USER_LANGUE />:</td>
       <td align="left" class="lista"><tag:account_combo_language /></td>
    </tr>
    </if:createacc_language_enabled>
    <if:createacc_style_enabled>
    <tr>
       <td align="left" class="header"><tag:language.USER_STYLE />:</td>
       <td align="left" class="lista"><tag:account_combo_style /></td>
    </tr>
    </if:createacc_style_enabled>
    <tr>
       <td align="left" class="header"><tag:language.COUNTRY />:</td>
       <td align="left" class="lista"><tag:account_combo_country /></td>
    </tr>
    <tr>
       <td align="left" class="header"><tag:language.TIMEZONE />:</td>
       <td align="left" class="lista"><tag:account_combo_timezone /></td>
       <if:kis>
          <tr>
       <td align="left" class="header"><tag:language.KIS_TOKEN />:</td>
       <td align="left" class="lista"><input type="text" name="token" maxlength="40" size="40" class="form-control" value="<tag:kistoken />" /></td>
         </tr>
       </if:kis>
    </tr>
    <if:CAPTCHA>
    <tr>
       <td align="left" class="header"><tag:language.IMAGE_CODE />:</td>
       <td align="left" class="lista"><input type="text" name="private_key" maxlength="6" class="form-control" size="6" value="" />&nbsp;&nbsp;<tag:account_captcha /></td>
    </tr>
    <else:CAPTCHA>
    <tr>
       <td align="left" class="header"><tag:language.SECURITY_CODE />:</td>
       <td align="left" class="lista"><tag:scode_question /><input type="text" name="scode_answer" class="form-control" maxlength="6" size="6" value="" /></td>
    </tr>
    </if:CAPTCHA>

    <div class="alert alert-dismissable alert-bg-white alert-danger">
    <button data-dismiss="alert" class="close" type="button">×</button>
    <div class="icon"><i class="fa fa-exclamation-triangle"></i></div>
    <strong>USE A VALID EMAIL OR YOU WILL NOT BE ABLE TO VALIDATE YOUR ACCOUNT!!!</strong>
    </div>
    </div>

    <div class="alert alert-dismissable alert-bg-white alert-warning">
    <button data-dismiss="alert" class="close" type="button">×</button>
    <div class="icon"><i class="fa fa-exclamation-triangle"></i></div>
    <strong>USERNAME MUST (NOT) CONTAIN ONLY NUMBERS OR YOUR ACCOUNT WILL BE DISABLED!!!</strong>
    </div>
    </div>

    </table>

    <tr>
       <td align="center" class="header" colspan="2">
              <!-- input/button for confirm or delete -->
              <tag:account_from_delete_confirm />
       </td>
    </tr>
  </if:DISPLAY_FULL>
  </table>
</form>
</div>