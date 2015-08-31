<?php
$id = $this->session->userdata('id');
$url = '\'/users/profile/'.$id.'\'';
?>
<html>
<head>
	<title>DashBoard</title>
	<style>
table {
	border-collapse: collapse;
}
table, th, td {
	border: solid 1px black;
}
.align{vertical-align: top;
	margin-right: 5px;}
	</style>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../../assets/popup.js"></script>
	<link rel="stylesheet" style="text/css" href="../../assets/popup.css"></link>
	 <link type="text/css" rel="stylesheet" href="../assets/materialize/css/materialize.min.css"  media="screen,projection"/>
 <script type="text/javascript" src="../assets/jquery-2.1.4.min.js"></script>
 <script type="text/javascript" src="../assets/materialize/js/materialize.min.js"></script>
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
		<h3>Manage Users</h3><br><br>
<?php $user_level = $this->session->userdata('user_level');
	if($user_level == 9)
		{	
			echo '<a href="/users/Adduser"><button class="btn waves-effect waves-light blue"> <span class="align">Add New User</span> <i class="tiny material-icons">add</i></button></a><br><br>';
		}

		?>

		<div class="messagepop pop">
			Are you sure you want to delete <span id='enter_user'>user</span>?<br>
			This will also delete all messages and comments.
			<br><br>
			<a id="yes" href=""><button class='btn waves-effect waves-light red confirm'>
			<span class='align'> Yes</span> <i class='tiny material-icons'>delete</i>
			</button> </a><a id="no" href="/dashboard"><button class='btn waves-effect waves-light blue'><span class='align'>No</span> <i class='tiny material-icons'>not_interested</i></button></a>
		</div>
		<br><br>
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Date Created</th>
					<th>Admin Status</th>
<?php 
	if ($this->session->userdata('user_level') == 9)
	{echo "<th>Actions</th>";}	
?>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($users as $all)
	{
		if ($all['user_level'] == 9)
		{
			$all['user_level'] = 'Admin';
		}
		else{$all['user_level'] = 'Normal';}
		if($user_level == 9)
		{
			echo "<tr><td>".$all['id']."</td><td><a href='/users/profile/".$all['id']."'>".$all['first_name']." ".$all['last_name']."</a></td>
			<td>".$all['email']."</td><td>".$all['created_at']."</td>
			<td>".$all['user_level']."</td><td>
			<button class='btn waves-effect waves-light red dynamic' deletefirstname =".$all['first_name']." deletelastname=".$all['last_name']." deleteid='".$all['id']."'><span class='align'>Delete</span> <i class='tiny material-icons'>delete</i></button>
			<a href='/users/editUser/".$all['id']."'><button class='btn waves-effect waves-light orange'><span class='align'>Edit User</span> <i class='tiny material-icons'>edit</i></button></a>
			</td></tr>";
		}
		else {
			echo "<tr><td>".$all['id']."</td><td><a href='/users/profile/".$all['id']."'>".$all['first_name']." ".$all['last_name']."</a></td>
		<td>".$all['email']."</td><td>".$all['created_at']."</td>
		<td>".$all['user_level']."</td></tr>";
		}}
?>
			</tbody>
		</table>
		</div>
<script>
$(document).ready(function(){
	delete_id = '';
	$(".btn.waves-effect.waves-light.red.dynamic").click(function(){
		console.log('i ran')
		delete_id = $(this).attr("deleteid");
		delete_name = $(this).attr("deletefirstname") + ' ' + $(this).attr("deletelastname") ;		
		url = '/dashboard/delete/' + delete_id;
		console.log(url)
		$('#yes').attr("href", url);
		$('#enter_user').text(delete_name)	
	})
});
</script>
</body>
</html>