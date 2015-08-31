<html>
<head>
	<title>Register</title>
<style>
.red{color: red;}
#wrapper{ width: 400px;}
</style>
</head>
<body>
<div id='wrapper'>
	<h3>Register</h3><br>
	<span class="red">
<?php
$errors = $this->session->flashdata('errors');
echo $errors[1][0];
 ?>
	</span>
	<form action = "/main/user_register" method="post">
		Email Address: <br>
		<input type="text" name="email" /><br>
		First Name: <br>
		<input type="text" name="first_name" /><br>
		Last Name: <br>
		<input type="text" name="last_name" /><br>
		Password: <br>
		<input type="password" name="password" /><br>
		Confirm Password: <br>
		<input type="password" name="confirm_password" /><br>
		<button type="submit" class="btn waves-effect waves-light" name='action'>Register</button>
	</form>
	<a href="/signin">Already have an account? Login</a>
</div>
</body>
</html>