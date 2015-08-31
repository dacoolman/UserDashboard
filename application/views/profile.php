<?php
$id = $this->session->userdata('id');
$url = '\'/users/profile/'.$id.'\'';
?>
<html>
<head>
<style>
.z-depth-3{border: 1px solid silver;
	height: 40px;
	width: 650px;}
.time{
	float: right;}
.timecomment{
	float: right;}
.comment{margin-left: 50px;
}
.z-depth-1{
	border: 1px solid silver;
	height: 35px;
	width: 600px;
	margin-left: 50px;
}
.commenthead{margin-left: 50px;}
.align{vertical-align: top;}
#column1{vertical-align: top;
	display: inline-block;
	width: 300px;
	height: 100%;
	padding-right: 10px;
	border-right: 1px solid silver;}
#column2{margin-left: 15px;
	vertical-align: top;
	display: inline-block;
	width: 650px;}
	textarea{   min-width: 270px;
    width: 200px;
    height: 22px;
    line-height: 24px;
    min-height: 22px;
    overflow-y: hidden;
    padding-top: 1.1em;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;}
.textareabox{width: 100px;}
</style>
<title>Profile </title>
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
<?php
//Formatting variables to place in HTML elements
$id = '\''.$user['id'].'\'';
$myid = '\''.$this->session->userdata('id').'\'';
$url = '\'/users/update_description/'.$user['id'].'\'';
// $addmessage = '\'/users/add_message/'.$user['id'].'\'';
// $addcomment = '\'/users/add_comment/'.$user['id'].'\'';
?>

	<div id='wrapper'>	
		<div id='column1'>
			<h3> <?= $user['first_name'].' '.$user['last_name']?> </h3>
			Registered at: <?= $user['created_at']?> <br>
			User ID: <?= $user['id']?> <br>
			Email address: <?= $user['email']?> <br><br>

<?php

if ($this->session->userdata('id') == $user['id'])
{
	$editme = '\'/users/editUser/'.$user['id'].'\'';
	echo '<a href='.$editme.'><button class=\'btn waves-effect waves-light orange\'><span class=\'align\'>Edit User</span> <i class=\'tiny material-icons\'>edit</i></button></a><br><br>';
}
echo '<h5>Description:</h5>'.$user['description'];
if ($this->session->userdata('id') == $user['id'])
{
	echo '<br><br><form action='.$url.' method="post">
	<textarea name="description" placeholder="Enter Description...">'.$user['description'].'</textarea><br><br>
	<input type="hidden" name="id" value='.$id.'/>
	<button name="action" type="submit" class=\'btn waves-effect waves-light brown\'><span class=\'align\'>Update Description</span> <i class=\'tiny material-icons\'>send</i></button>
	</form>';
}
?>
		</div>
		<div id='column2'>
			<h5>Leave a message for <?= $user['first_name']?></h5>
			<form action = "/users/add_message" method="post">
				<textarea name="content" placeholder="Leave a Message..."></textarea><br><br>
				<input type="hidden" name="post_id" value = <?= $id?> />
				<button type="submit" name='action' class="btn waves-effect waves-light blue"><span class="align">Post</span> <i class="tiny material-icons">message</i></button>
			</form>
			<br>

<?php foreach($messages as $all)
{
	$userurl = '\'/users/profile/'.$all['user_id'].'\'';
	$messageid = '\''.$all['id'].'\'';
	echo "<a href=".$userurl.">".$all['first_name']." ".$all['last_name']. "</a> wrote: <span class='time'>".$all['created_at']."</span><br>
	<div class=\"z-depth-3\" class='message'>".$all['content']."</div><br>";
	foreach ($comments as $allcomments)
	{
		if ($all['id'] == $allcomments['message_id']){
			$usercommenturl = '\'/users/profile/'.$allcomments['user_id'].'\'';
			echo "<span class='commenthead'><a href=".$usercommenturl.">".$allcomments['first_name']." ".$allcomments['last_name']. "</a> wrote: <span class='timecomment'>".$allcomments['created_at']."</span></span><br>
			<div class=\"z-depth-1\">".$allcomments['contents']."</div><br>";
		}
	}
	echo "<div class='comment'><form action = '/users/add_comment' method='post'>
		<input type='hidden' name='message_id' value = ".$messageid."/>
		<input type='hidden' name='post_id' value = ".$user['id']."/>
		<input type='hidden' name='user_id' value = ".$id."/>
		<textarea name='content' placeholder='Leave a Comment...'' ></textarea><br><br>
		<button type=\"submit\" name='action' class=\"btn waves-effect waves-light blue lighten-2\"><span class=\"align\">Add Comment</span> <i class=\"tiny material-icons\">comment</i></button></form></div>";
}
?>
		</div>
	</div>
<script>
$(document).ready(function(){
	$('textarea').delegate( 'textarea', 'keyup', function (){
	    $(this).height( 0 );
	    $(this).height( this.scrollHeight );
	});
	$('textarea').find( 'textarea' ).keyup();
})
</script>
</body>
</html>