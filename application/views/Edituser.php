<?php
$id = $this->session->userdata('id');
$url = '\'/users/profile/'.$id.'\'';
$id = '\''.$user['id'].'\'';
$email = '\''.$user['email'].'\'';
$first_name = '\''.$user['first_name'].'\'';
$last_name = '\''.$user['last_name'].'\'';
$user_level = '\''.$user['user_level'].'\'';
?>
<html>
<head>
	<title>Edit user</title>
	<style>
.red{color: red;}
#border1{border: solid 1px silver;
	display: inline-block;
	width: 200px;
	margin-right: 20px;
	vertical-align: top;
	padding-left: 5px;}
#border2{border: solid 1px silver;
	display: inline-block;
	width: 200px;
	margin-right: 20px;
	vertical-align: top;
	padding-left: 5px;}
	</style>
	<link type="text/css" rel="stylesheet" href="../../assets/materialize/css/materialize.min.css"  media="screen,projection"/>
	 <script type="text/javascript" src="../../assets/jquery-2.1.4.min.js"></script>
	 <script type="text/javascript" src="../../assets/materialize/js/materialize.min.js"></script>
</head>
<body>
	<nav class="green" role="navigation">
	    <div class="nav-wrapper container">
		    <span id='logo'><a href='/dashboard'>User Dashboard</a></span>
		    <ul class="right hide-on-med-and-down">
		       <li><a href=<?= $url ?>>Profile</a></li>
		       <li><a href="/dashboard/logoff">Log off</a></li>
		    </ul>
	  	</div>
  	</nav>
 	<div id='wrapper'>
		<h3> Edit <?=$user['first_name']?> <?=$user['last_name']?></h3><br>
		<a href="/dashboard">
		<button class="btn waves-effect waves-light">
			Return to Dashboard
		</button>
		</a>
		<br><br><br>
		<div class="z-depth-5" id="border1">
			<h5>Edit User</h5>
			<span class="red">
<?php
	$errors = $this->session->flashdata('errors');
	echo $errors[1][0];
 ?>
		</span>
		<form action = "/users/update_userinfo" method="post">
			Email Address: <br>
			<input type="text" name="email" value= <?= $email ?> /><br>
			First Name: <br>
			<input type="text" name="first_name" value= <?= $first_name ?> /><br>
			Last Name: <br>
			<input type="text" name="last_name" value= <?= $last_name ?> /><br>
<?php
	if($this->session->userdata('user_level') == 9)
	{
		if ($user['user_level']== 9)
		{
			echo 'Admin Level: <br><select name="user_level" value="9">
			<option value="1">Normal</option>
			<option selected="selected" value="9">Admin</option>
			</select>';
		}
		else{
			echo 'Admin Level: <br><select name="user_level" value="9">
			<option value="1">Normal</option>
			<option value="9">Admin</option>
			</select>';
		}
	}
?>
				<br><br>
				<input type="hidden" name="id" value=<?= $id ?> />
				<center>
				<button type="submit" name='action' class="btn waves-effect waves-light orange">Save</button>
				</center>
			</form>
		</div>
		<div class="z-depth-2" id="border2" >
			<h5>Change Password</h5>
			<span class="red">
<?php
	$passworderrors = $this->session->flashdata('passworderrors');
	echo $passworderrors[1][0];
 ?>
		</span>
		<form action="/users/update_passwordinfo" method="post">
		Password: <br>
		<input type="password" name="password" placeholder='Enter password...' /><br>
		Confirm Password: <br>
		<input type="password" name="confirm_password" placeholder='Enter password...' /><br><br>
		<input type="hidden" name="id" value=<?= $id ?> />
		<center>
		<button type="submit" name='action' class="btn waves-effect waves-light orange">Update</button>
		</center>
		</form>
		</div>
	</div>
<script>
$(document).ready(function() {
    $('select').material_select();
});
</script>
</body>
</html>