<?php
$id = $this->session->userdata('id');
$url = '\'/users/profile/'.$id.'\'';
?>
<html>
<head>
	<title>Add user</title>
	<style>
.red{color: red;}
#wrapper{width: 400px;}
.align{vertical-align: top;}
	</style>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
		<h3> Add a new user</h3><br>
		<a href="/dashboard">
		<button class="btn waves-effect waves-light">
			Return to Dashboard
		</button>
		</a><br><br><br>
		<span class="red">
<?php
$errors = $this->session->flashdata('errors');
echo $errors[1][0];
 ?>
		</span>
		<form action = "/users/create_user" method="post">
			Email Address: <br>
			<input type="text" name="email" placeholder='Email...' /><br>
			First Name: <br>
			<input type="text" name="first_name" placeholder='First Name...' /><br>
			Last Name: <br>
			<input type="text" name="last_name" placeholder='Last Name...' /><br>
			Password: <br>
			<input type="password" name="password" placeholder='Password...' /><br>
			Confirm Password: <br>
			<input type="password" name="confirm_password" placeholder='Confirm Password...' /><br>
			<button type="submit" name='action' class="btn waves-effect waves-light blue"><span class="align">Submit</span> <i class="tiny material-icons">send</i></button>
		</form>
	</div>
</body>
</html>