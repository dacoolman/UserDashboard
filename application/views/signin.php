<html>
<head>
	<title>Sign in</title>
<style>
#red{color: red;}
#wrapper{ width: 400px;}
</style>
</head>
<body>
<div id='wrapper'>
	<h3> Sign in </h3>
	<span id="red">

<?php
$loginerrors = $this->session->flashdata('loginerrors');
echo $loginerrors[1][0];
 ?>
	</span>
	<form action="/main/user_login" method="post">
		Email Address: <br>
		<input type="text" name="email" />
		<br>
		Password: <br>
		<input type="password" name="password" />
		<br>
		<button type="submit" class="btn waves-effect waves-light" name='action'>Sign In</button>
	</form>
	<br>
	<a href="/register">Don't have an account? Register</a>
</div>
</body>
</html>