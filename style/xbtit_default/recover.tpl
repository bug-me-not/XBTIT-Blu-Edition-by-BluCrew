<script type="text/javascript">
function form_control()
  {
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
         email.innerHTML='<tag:language.ERR_INV_EMAIL />';
         alert(email.innerHTML);
         document.getElementById('email').focus();
         return false;
         }
      }

    if (document.getElementById('captcha').value.length==0)
      {
      var captcha=document.createElement('span');
      captcha.innerHTML='<tag:language.ERR_NO_CAPTCHA />';
      alert(captcha.innerHTML);
      document.getElementById('captcha').focus();
      return false;
      }

   return true;
  }
</script>
<p align="center"><tag:language.RECOVER_DESC /></p>
    <div align="center">
      <form action="<tag:recover.action />" name="recover" onsubmit="return form_control()" method="post">
        <table width="90%" class="lista" cellpadding="10">
          <tr>
        <td class="header" align="right"><tag:language.REGISTERED_EMAIL />:</td>
        <td class="lista" align="left"><input type="text" size="40" name="email" id="email" /></td>
      </tr>
      <if:CAPTCHA>
      <tr>
        <td align="right" class="header"><tag:language.IMAGE_CODE />:</td>
      <td align="left" class="lista"><input type="text" name="private_key" id="captcha" maxlength="6" size="6" value="" />&nbsp;&nbsp;<tag:recover_captcha /></td>
      </tr>
      <else:CAPTCHA>
      <tr>
         <td align="left" class="header"><tag:language.SECURITY_CODE />:</td>
         <td align="left" class="lista"><tag:scode_question /><input type="text" id="captcha" name="scode_answer" maxlength="6" size="6" value="" /></td>
      </tr>
      </if:CAPTCHA>
          <tr>
        <td colspan="2" align="center" class="header"><input type="submit" value="<tag:language.FRM_CONFIRM />" class="btn" /></td>
      </tr>
        </table>
      </form>
    </div>
<br />