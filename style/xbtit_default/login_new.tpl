<!DOCTYPE html>
<html lang="en">
<head>
	<title>BluPortal</title>
	<script type="text/javascript" src="jscript/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="jscript/script.js"></script>
	<script type="text/javascript" src="jscript/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="css/newlogin.css">
	<link rel="stylesheet" href="css/jquery-ui.min.css">
	<meta charset="UTF-8">
</head>
<body>
	<center><h1>You Have Reached The BluPortal</h1></center><br>
	<div id="formContainer" class="<tag:div_setting />">
		<div id="errormes" style="display:none;" title="<tag:title />"><tag:error_message /></div>
		<form id="login" method="post" onsubmit="return login_control()" action="<tag:login.action />">
			<a href="#" id="flipToRecover" class="flipLink">Forgot?</a>
			<input name="uid" id="loginEmail" maxlength="40" placeholder="Username" type="text">
			<input name="pwd" id="loginPass" placeholder="Password" type="password">
			<input name="submit" value="Login" type="submit">
		</form>
		<form id="recover" name="recover" method="post" action="<tag:recover.action />">
			<a href="#" id="flipToLogin" class="flipLink">Forgot?</a>
			<input name="email" id="recoverEmail" placeholder="Your Email" type="text">
			<div id='captcha'>
			<if:CAPTCHA>
				<tag:recover_captcha />
				<input type="text" name="private_key" id="captcha" placeholder="Captcha" maxlength="6" size="6" value="" />
			<else:CAPTCHA>
				<tag:scode_question />
				<input type="text" id="captcha" name="scode_answer" placeholder="Captcha" maxlength="6" size="6" value="" />
			</if:CAPTCHA>
			</div> 
			<input name="submit" value="Recover" type="submit" class="btn">
		</form>
	</div>
	<div class="button"><a href="index.php?page=signup">Not A Member?</a></div>
	<div class="button"><a href="index.php?page=contact">Contact Us</a></div>
</body>
<footer>
	<a href="http://v2.blu-bits.com/BluCrew/index.html"><h2>By: BluCrew <tag:year /></h2></a>
</footer>
</html>