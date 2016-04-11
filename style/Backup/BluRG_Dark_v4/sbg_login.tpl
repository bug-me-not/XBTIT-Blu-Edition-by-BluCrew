<html>
<head>
<title><tag:SITENAME /></title>
	<link rel="stylesheet" href="./alternate_login/css/single_login.css" type="text/css" />
	<link rel="stylesheet" href="./jscript/passwdcheck.css" type="text/css" />
	<script type="text/javascript" src="./jscript/jquery-1.7.min.js"></script>
	<script type="text/javascript" src="./jscript/logincollapse.js"></script>
	<!-- ### Password strength javascript ### -->

<script type="text/javascript" src="./jscript/passwdcheck.js"></script>

<!-- ### End ### -->
<STYLE type="text/css">
.okButton {
background-color: #D4D4D4;
font-color: #000000;
font-size: 9pt;
font-family: arial;
width: 70px;
height:	20px;  
}
.alertTitle {
background-color: #3C56FF;
font-family: arial;
font-size: 9pt;
color: #FFFFFF;
font-weight: bold;
}
.alertMessage {
font-family: arial;
font-size: 9pt;
color: #000000;
font-weight: normal;
}
.alertBoxStyle {
cursor: default;
filter: alpha(opacity=90);
background-color: #E4E4E4;
position: absolute;
top: 200px;
left: 200px;
width: 100px;
height: 50px;
visibility:hidden; z-index: 999;
border-style: groove;
border-width: 5px;
border-color: #FFFFFF;
text-align: center;
}
</STYLE>
<div id="alertLayer" class=alertBoxStyle></div>
<SCRIPT LANGUAGE="JavaScript">
function BrowserCheck() {
var b = navigator.appName;
if (b == "Netscape") this.b = "NS";
else if (b == "Microsoft Internet Explorer") this.b = "IE";
else this.b = b;
this.v = parseInt(navigator.appVersion);
this.NS = (this.b == "NS" && this.v>=4);
this.NS4 = (this.b == "NS" && this.v == 4);
this.NS5 = (this.b == "NS" && this.v == 5);
this.IE = (this.b == "IE" && this.v>=4);
this.IE4 = (navigator.userAgent.indexOf('MSIE 4')>0);
this.IE5 = (navigator.userAgent.indexOf('MSIE 5')>0);
if (this.IE5 || this.NS5) this.VER5 = true;
if (this.IE4 || this.NS4) this.VER4 = true;
this.OLD = (! this.VER5 && ! this.VER4) ? true : false;
this.min = (this.NS||this.IE);
}
is = new BrowserCheck();
alertBox = (is.VER5) ? document.getElementById("alertLayer").style
: (is.NS) ? document.layers["alertLayer"]
: document.all["alertLayer"].style;

function hideAlert(){
alertBox.visibility = "hidden";}

function makeAlert(aTitle,aMessage){
document.all.alertLayer.innerHTML = "<table border=0 width=100% height=100%>" +
"<tr height=5><td colspan=4 class=alertTitle>" + " " + aTitle + "</td></tr>" +
"<tr height=5><td width=5></td></tr>" +
"<tr><td width=5></td><td width=20 align=left><img src='./images/alert.png'></td><td align=center class=alertMessage>" + aMessage + "<BR></td><td width=5></td></tr>" + 
"<tr height=5><td width=5></td></tr>" +
"<tr><td width=5></td><td colspan=2 align=center><input type=button value='OK' onClick='hideAlert()' class=okButton><BR></td><td width=5></td></tr>" +
"<tr height=5><td width=5></td></tr></table>";
thisText = aMessage.length;
location = "javascript:logincollapse.toggle('login')";
if (aTitle.length > aMessage.length){ thisText = aTitle.length; }

aWidth = (thisText * 5) + 80;
aHeight = 100;
if (aWidth < 150){ aWidth = 200; }
if (aWidth > 350){ aWidth = 350; }
if (thisText > 60){ aHeight = 110; }
if (thisText > 120){ aHeight = 130; }
if (thisText > 180){ aHeight = 150; }
if (thisText > 240){ aHeight = 170; }
if (thisText > 300){ aHeight = 190; }
if (thisText > 360){ aHeight = 210; }
if (thisText > 420){ aHeight = 230; }
if (thisText > 490){ aHeight = 250; }
if (thisText > 550){ aHeight = 270; }
if (thisText > 610){ aHeight = 290; }

alertBox.width = aWidth;
alertBox.height = aHeight;
alertBox.left = (document.body.clientWidth - aWidth)/2;
alertBox.top = (document.body.clientHeight - aHeight)/2;

alertBox.visibility = "visible";
}
</SCRIPT>
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

    if (document.getElementById('email1').value == "")
      {
      var email1=document.createElement('span');
      email1.innerHTML='<tag:language.ERR_NO_EMAIL />';
      alert(email1.innerHTML);
      document.getElementById('email1').focus();
      return false;
      }
    else
      {
        if (!filter.test(document.getElementById('email1').value))
         {
          var email1=document.createElement('span');
          email.innerHTML='<tag:language.ERR_NO_EMAIL />';
          alert(email1.innerHTML);
          document.getElementById('email1').focus();
          return false;
         }
      }


    if (document.getElementById('email_again1').value == "")
      {
      var email_again1=document.createElement('span');
      email_again.innerHTML='<tag:language.ERR_NO_EMAIL_AGAIN />';
      alert(email_again1.innerHTML);
      document.getElementById('email_again1').focus();
      return false;
      }
    else
      {
        if (!filter.test(document.getElementById('email_again1').value))
         {
          var email_again=document.createElement('span');
          email_again1.innerHTML='<tag:language.ERR_NO_EMAIL />';
          alert(email_again1.innerHTML);
          document.getElementById('email_again1').focus();
          return false;
         }
      }

    if (document.getElementById('email1').value !=  document.getElementById('email_again1').value)
      {
      var DIF_EMAIL=document.createElement('span');
      DIF_EMAIL.innerHTML='<tag:language.DIF_EMAIL />';
      alert(DIF_EMAIL.innerHTML);
      return false;
      }

   return true;
  }
</script>
<script>
var checkobj

function agreesubmit(el){
checkobj=el
if (document.all||document.getElementById){
for (i=0;i<checkobj.form.length;i++){  //hunt down submit button
var tempobj=checkobj.form.elements[i]
if(tempobj.type.toLowerCase()=="submit")
tempobj.disabled=!checkobj.checked
}
}
}
function defaultagree(el){
if (!document.all&&!document.getElementById){
if (window.checkobj&&checkobj.checked)

return true
else{
alert("Please read/accept terms to submit form")
return false
}
}
}

function goToURL() {
  var i, args=goToURL.arguments; document.returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

</script>
<script>
//change two names below to your form's names
document.forms.agreeform.agreecheck.checked=false
</script>
<style>
div.scroller
{
width:100%;
height:960px;
overflow:auto;
}
</style>
</head>
<body>

<div align="center" id="buttons">
<a href="javascript:logincollapse.toggle('login')"><img src="./alternate_login/login/login.png" border="0" title="<tag:language.LOGIN />" /></a><a href="javascript:logincollapse.show('login')" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<if:offline_enabled_1>
<a href="javascript:alert('<tag:offline_msg />')"><img src="./alternate_login/login/recover.png" border="0" title="<tag:language.RECOVER />"  /></a><a href="javascript:logincollapse.show('recover')" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<else:offline_enabled_1>
<a href="javascript:logincollapse.toggle('recover')"><img src="./alternate_login/login/recover.png" border="0" title="<tag:language.RECOVER />" /></a><a href="javascript:logincollapse.show('recover')" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</if:offline_enabled_1>
<if:offline_enabled>
<a href="javascript:alert('<tag:offline_msg />')"><img src="./alternate_login/login/signup.png" border="0" title="<tag:language.SIGNUP />" /></a><a href="javascript:logincollapse.show('recover')" /></a>
<else:offline_enabled>
<a href="javascript:logincollapse.toggle('signup')"><img src="./alternate_login/login/signup.png" border="0" title="<tag:language.SIGNUP />" /></a><a href="javascript:logincollapse.show('recover')" /></a>
</if:offline_enabled>
</div>
<div class="scroller">
<if:ERR_LOGIN><div align="center"><br /><br /><span style="color:red;font-weight:bold;"><tag:ERR_LOGIN_MSG /></span></div></if:ERR_LOGIN>

<div id="imput">
<div id="login" style="display:none">
<form method="post" action="<tag:login.action />">
  <table align="center" border="0" cellpadding="4" cellspacing="1">
    <if:FALSE_USER>
    <tr>
      <td align="center" colspan="2"><span style="color:#FF0000;"><tag:login_username_incorrect /></span></td>
    </tr>
    </if:FALSE_USER>
    <if:FALSE_PASSWORD>
    <tr>
      <td align="center" colspan="2"><span style="color:#FF0000;"><tag:login_password_incorrect /></span></td>
    </tr>
    </if:FALSE_PASSWORD>
    <if:SITE_OFFLINE>
    <tr>
      <td colspan="5" style="text-align:center; font-size:12pt;"><span style="color:#FF0000;"><tag:offline_msg /></span></td>
    </tr>
    </if:SITE_OFFLINE>
    <tr>
      <td align="right"><tag:language.USER_NAME />:</td>
      <td><input type="text" size="15" name="uid" value="" maxlength="40" />
      <td align="right"><tag:language.USER_PWD />:</td>
      <td><input type="password" size="15" name="pwd" maxlength="40" />
      <td colspan="2" align="center"><input type="submit" class="btn" value="<tag:language.FRM_LOGIN />" /></td>
    </tr>
    <tr>
      <td colspan="20" align="center"><tag:language.NEED_COOKIES /><br /><br /><tag:COPYRIGHT /> | <tag:COBRA /></td>
    </tr>
  </table>
</form>
</div>
<div id="recover" style="display:none">
    <div align="center">
      <form action="<tag:recover.action />" name="recover" method="post">
        <table width="50%" class="lista" cellpadding="10">
          <tr>
        <td align="right"><tag:language.REGISTERED_EMAIL />:</td>
        <td align="left"><input type="text" size="40" name="email" id="email" /></td>
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
        <td colspan="2" align="center"><input type="submit" value="<tag:language.FRM_CONFIRM />" class="btn" /><br /><br /><tag:COPYRIGHT /> | <tag:COBRA /></td>
      </tr>
        </table>
      </form>
    </div>
</div>
</div>
<if:ERR>
<div id="signup" style="display:none">
<div align="center">
<tag:ERR_MSG />
<else:ERR>
<div id="signup" style="display:none">
<div align="center">
<form name="utente" method="post" onsubmit="return form_control()" action="<tag:account_form_actionlink />" >
  <table width="63%" border="0" class="lista">
     <if:BY_INVITATION>
  <input type="hidden" name="code" value="<tag:account_IDcode />" />
  <input type="hidden" name="inviter" value="<tag:account_IDinviter />" />
	<tr>
	  <td class="lista" colspan="2"><div style="text-align:center; padding:10px;"><tag:language.INVITATION_ONLY /><br /><tag:COPYRIGHT /> | <tag:COBRA />
</div></td>
	</tr>
  </if:BY_INVITATION>
  <if:invitation_enabled>
    <tr>
       <td align="right"><tag:language.USER_NAME />:&nbsp;&nbsp;&nbsp;</td>
       <td align="left">
 <input type="text" size="40" name="user" id="user" value="" />      
       </td>
    </tr>
    <tr>
       <td align="right"><tag:language.USER_PWD />:&nbsp;&nbsp;&nbsp;</td>
       <td align="left">
         <tag:language.SECSUI_ACC_PWD_1 />
         <li><tag:language.SECSUI_ACC_PWD_2 /> <font id="number"><tag:pass_min_char /></font> <if:pass_char_plural><tag:language.SECSUI_ACC_PWD_3A /><else:pass_char_plural><tag:language.SECSUI_ACC_PWD_3 /></if:pass_char_plural></li>
         <if:pass_lct_set><li><tag:language.SECSUI_ACC_PWD_4 /> <span style="color:blue;font-weight:bold;"><tag:pass_min_lct /></span> <if:pass_lct_plural><tag:language.SECSUI_ACC_PWD_5A /><else:pass_lct_plural><tag:language.SECSUI_ACC_PWD_5 /></if:pass_lct_plural></li></if:pass_lct_set>
         <if:pass_uct_set><li><tag:language.SECSUI_ACC_PWD_4 /> <span style="color:blue;font-weight:bold;"><tag:pass_min_uct /></span> <if:pass_uct_plural><tag:language.SECSUI_ACC_PWD_6A /><else:pass_uct_plural><tag:language.SECSUI_ACC_PWD_6 /></if:pass_uct_plural></li></if:pass_uct_set>
         <if:pass_num_set><li><tag:language.SECSUI_ACC_PWD_4 /> <span style="color:blue;font-weight:bold;"><tag:pass_min_num /></span> <if:pass_num_plural><tag:language.SECSUI_ACC_PWD_7A /><else:pass_num_plural><tag:language.SECSUI_ACC_PWD_7 /></if:pass_num_plural></li></if:pass_num_set>
         <if:pass_sym_set><li><tag:language.SECSUI_ACC_PWD_4 /> <span style="color:blue;font-weight:bold;"><tag:pass_min_sym /></span> <if:pass_sym_plural><tag:language.SECSUI_ACC_PWD_8A /><else:pass_sym_plural><tag:language.SECSUI_ACC_PWD_8 /></if:pass_sym_plural></li></if:pass_sym_set>
         <input type="password" size="40" id="want_password" name="pwd" 
           onkeyup="EvalPwdStrength(document.forms[0],this.value);"/> <!-- The textbox itself onkeyup-->       
       <br />
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
       <td align="right"><tag:language.USER_PWD_AGAIN />:&nbsp;&nbsp;&nbsp;</td>
       <td align="left"><input type="password" size="40" id="check_password" name="pwd1" /></td>
    </tr>
    <tr>
       <td align="right"><tag:language.USER_EMAIL />:&nbsp;&nbsp;&nbsp;</td>
       <td align="left"><input type="text" size="30" name="email" id="email1"/></td>
    </tr>
    <tr>
       <td align="right"><tag:language.USER_EMAIL_AGAIN />:&nbsp;&nbsp;&nbsp;</td>
       <td align="left"><input type="text" size="30" name="email_again" id="email_again1" autocomplete="off" value=""/></td>
    </tr>
    <if:birthdays_enabled>
    <tr>
       <td align="right"><tag:language.DOB />:&nbsp;&nbsp;&nbsp;</td>
       <td align="left"><input type="text" size="2" name="dobday" maxlength="2" value=""/>&nbsp;&nbsp;/&nbsp;&nbsp;<input type="text" size="2" name="dobmonth" maxlength="2" value=""/>&nbsp;&nbsp;/&nbsp;&nbsp;<input type="text" size="4" name="dobyear" maxlength="4" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<tag:language.DOB_FORMAT /></td>
    </tr>
    </if:birthdays_enabled>    
    <if:ssl_enabled>
	<tr>
       <td align="right"><tag:language.SSL /></td>
       <td><input type="checkbox" name="force"><tag:language.SSL_DESC /></td>
    </tr>
    </if:ssl_enabled>    
	<if:hide_language_disabled_2>
    <tr>
       <td align="right"><tag:language.USER_LANGUE />:&nbsp;&nbsp;&nbsp;</td>
       <td align="left"><tag:account_combo_language /></td>
    </tr>
    </if:hide_language_disabled_2>
    <if:hide_style_disabled_2>
    <tr>
       <td align="right"><tag:language.USER_STYLE />:&nbsp;&nbsp;&nbsp;</td>
       <td align="left"><tag:account_combo_style /></td>
    </tr>
    </if:hide_style_disabled_2>
    <tr>
       <td align="right"><tag:language.COUNTRY />:&nbsp;&nbsp;&nbsp;</td>
       <td align="left"><tag:account_combo_country /></td>
    </tr>
    <tr>
       <td align="right"><tag:language.TIMEZONE />:&nbsp;&nbsp;&nbsp;</td>
       <td align="left"><tag:account_combo_timezone /></td>
    </tr>
        <if:CAPTCHA_1>
    <tr>
       <td align="right" class="header"><tag:language.IMAGE_CODE />:&nbsp;&nbsp;&nbsp;</td>
       <td align="left" class="lista"><input type="text" name="private_key" maxlength="6" size="6" value="" />&nbsp;&nbsp;<tag:recover_captcha /></td>
    </tr>
    <else:CAPTCHA_1>
    <tr>
       <td align="right" class="header"><tag:language.SECURITY_CODE />:&nbsp;&nbsp;&nbsp;</td>
       <td align="left" class="lista"><tag:scode_question /><input type="text" name="scode_answer" maxlength="6" size="6" value="" /></td>
    </tr>
    </if:CAPTCHA_1>
    <tr> 
       <td align="center" colspan="2">
              <!-- input/button for confirm or delete -->
<if:agreement_enabled> 
<div align="center" id="agreestyle">
<table width=100% cellspacing=0 cellpadding=5 border=0 align=center>
<tr>
<td valign=top width=80%>
<font id="agree1"><center><tag:language.AGREE /></center><br />
          <font id="agree2"><justify><tag:ua4 /></br></br>
          <tag:ua5 /></br></br>
          <tag:ua8 /></br></br>
          <tag:ua9 /></br></br></justify>
          <center><b><font id="sitename"><tag:ua7 /><br><font id="date"><tag:ua6 /></font></center>    
<tr>
<td align="center" valign="BOTTOM">           
<form method="get" name="agreeform" onsubmit="goToURL('parent');return document.returnValue" >         
  <input name="agreecheck" type="checkbox" onClick="agreesubmit(this)">
  <b><font id="agree3"><tag:language.AGREE1 /></b></font><br /><br />
  <input type="submit" name="conferma" value="<tag:language.FRM_SIGNUP />" class="btn"  disabled onClick="return defaultagree(this)">
  <br /><br /><tag:COPYRIGHT /> | <tag:COBRA />
<else:agreement_enabled>  
              <input type="submit" name="conferma" value="<tag:language.FRM_SIGNUP />" class="btn"><br /><br /><tag:COPYRIGHT /> | <tag:COBRA />  
       </td>
    </tr>
  </table>
  </if:invitation_enabled>
  </if:agreement_enabled> 
</form>
</if:ERR>
</div>
</body>
</html>
