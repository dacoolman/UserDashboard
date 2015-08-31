<style>
#app_name{
	margin-left: 50px;
	display: inline;
}
#home{
	margin-left: 50px;
	display: inline;
	color: black;
}
#Signin{
	margin-left: 400px;
	display: inline;
}
.link{color: black;
  text-decoration: none;}
#logo{font-size: 200%;}
#wrapper{margin-left: 10px;}
</style>
<link type="text/css" rel="stylesheet" href="../assets/materialize/css/materialize.min.css"  media="screen,projection"/>
<script type="text/javascript" src="../assets/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="../assets/materialize/js/materialize.min.js"></script>

<!--Old nav bar: <h3 id="app_name">Dashboard App</h3> <h4 id="home"><a class="link" href="/">Home</a></h4><h4 id="Signin"> <a class="link" href="/signin">Sign-in</a></h4>
<hr>
!-->
<nav class="green" role="navigation">
    <div class="nav-wrapper container">
      <span id='logo'>User Dashboard</span>
      <ul class="right hide-on-med-and-down">
        <li><a href='/'>Home</a></li>
        <li><a href='/signin'>Sign-In</a></li>
      </ul>
    </div>
</nav>