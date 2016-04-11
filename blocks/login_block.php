<?php
global $CURUSER;
?>

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
            <form class="auth_form" name="login" id="loginform" method="post" action="login.php">
              <br/>
              <br/>
              <table class="layout">
                <tr>
                  <td>Username&nbsp;</td>
                  <td colspan="2">
                    <input type="text" name="username" id="username" class="inputtext" required maxlength="20" pattern="[A-Za-z0-9\s_áàảãạăắằẳẵặâấầẩẫậđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựÁÀẢÃẠĂẮẰẲẴẶÂẤẦẨẪẬĐÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰ?]{1,20}"
                    autofocus="autofocus" placeholder="Username" />
                  </td>
                </tr>
                <tr>
                  <td>Password&nbsp;</td>
                  <td colspan="2">
                    <input type="password" name="password" id="password" class="inputtext" required maxlength="100" pattern=".{6,100}" placeholder="Password" />
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    <input type="checkbox" id="keeplogged" name="keeplogged" value="1" />
                    <label for="keeplogged">Remember me</label>
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    <input type="submit" name="login" value="Log in" class="submit" />
                    <br /> Lost your password? <a href="index.php?page=recover" class="tooltip" title="Recover your password">Recover it here!</a>
                    <br />
                    <br />

                  </td>

                </tr>
              </table>
            </form>
          </div>
        </div>
        <script type="text/javascript">
          cookie.set('cookie_test', 1, 1);
          if (cookie.get('cookie_test') != null) {
            cookie.del('cookie_test');
          } else {
            $('#no-cookies').gshow();
          }

        </script>
      </td>
    </tr>
  </table>
  <div id="foot">
    <span><a href="#">By BluCrew</a></span>
  </div>
  <script>
    $(function() {
      $(".meter > span").each(function() {
        $(this)
          .data("origWidth", $(this).width())
          .width(0)
          .animate({
            width: $(this).data("origWidth")
          }, 1200);
      });
    });

  </script>
</body>


<?php

block_end();

?>
