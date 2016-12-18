
<script type="text/javascript">
function form_control()
  {
    if (document.getElementById('want_username').value.length==0)
      {
      var want_username=document.createElement('span');
      want_username.innerHTML='<tag:language.INSERT_USERNAME />';
      alert(want_username.innerHTML);
      document.getElementById('want_username').focus();
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

   return true;
  }
</script>

<script language="Javascript">
function capLock(e){
 kc = e.keyCode?e.keyCode:e.which;
 sk = e.shiftKey?e.shiftKey:((kc == 16)?true:false);
 if(((kc >= 65 && kc <= 90) && !sk)||((kc >= 97 && kc <= 122) && sk))
  document.getElementById('divMayus').style.visibility = 'visible';
 else
  document.getElementById('divMayus').style.visibility = 'hidden';
}
</script>

<link href="css/login.css" rel="stylesheet" type="text/css" />

<body>
  <div id="head">
  </div>
  <table class="layout" id="maincontent">
    <tr>
      <td align="center" valign="middle">

        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="index.php?page=login">Log in</a></li>
          <li><a href="index.php?page=signup">Register</a></li>
        </ul>


        <span id="no-cookies" class="hidden warning">You appear to have cookies disabled.<br /><br /></span>
        <noscript><span class="warning">BluCrew requires JavaScript to function properly. Please enable JavaScript in your browser.</span>
          <br />
          <br />
        </noscript>
        <div class="rain">
          <div class="border start">
            <form method="post" onSubmit="return form_control()" action="<tag:login.action />">
              <br/>
              <br/>
              <table class="layout">
                <tr>
                  <td>Username&nbsp;</td>
                  <td colspan="2">
                    <input type="text" class="inputtext" size="40" name="uid" id="want_username" value="<tag:login.username />" maxlength="40" />
                  </td>
                </tr>
                <tr>
                  <td>Password&nbsp;</td>
                  <td colspan="2">
                    <input type="password" size="40" name="pwd" id="want_password" maxlength="40" onkeypress="capLock(event)" /><div id="divMayus" style="visibility:hidden"><img src="images/warning_caps.png"><font color="red">Caps Lock Is On!</font></div>
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    <input type="submit" class="btn" value="<tag:language.FRM_CONFIRM />" />
                    <br /> Lost your password? <a href="index.php?page=recover" class="tooltip" title="Recover your password">Recover it here!</a>
                    <br />
                    <br />
                  </td>
                </tr>
              </table>
            </form>
          </div>
        </div>
      </td>
    </tr>
  </table>
  <div id="foot">
    <span><a href="#">By BluCrew</a></span>
  </div>
</body>


