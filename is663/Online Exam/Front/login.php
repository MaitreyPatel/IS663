<html lang="en">
<?php include "sessions/login_user.php";?>
<head>
<title>NJIT Online System</title>
<meta charset="utf-8">
<link href="main.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="login_front.js" type="text/JavaScript"></script>

</head>
<body>
	<div class="icon">
		<i class="fa fa-user-circle-o"></i>
	</div>
<div id="login_div">
	<form method='post' name="login" id="login" class="login-form">
		<div class="container">
			<div class="text">
				<label for="login:username"><b>UCID:</b></label>
				<input id="login:username" type="text" placeholder="Enter Username" name="login:username" class="login-form" class="login-input" required="" autofocus="">
			</div>
			<div class="text2">
				<label for="login:password"><b>Password:</b></label>
				<input id="login:password" type="password" placeholder="Enter Password" name="login:password" class="login-form" class="login-input" required="" autofocus="">
			</div>	
			<div class="button"> 
				<input style="font-size: 14px; font-weight: 400; font-family: inherit;" class="button" id ="login-btn" type="button"  value="Login" onclick="ajaxLoginFunction();">
			</div>
			<div class="checkbox">
				<input type="checkbox" checked="checked"> Remember me
			</div>
		</div>

	</form>
</div>
<div id="ajaxDiv"></div>
</body>
</html>