<?php
	require_once("connect.php");
	session_start();
if(isset($_POST) & !empty($_POST)){
	 $uname=$_POST['uname'];
	 $password=md5($_POST['password']);
	$query="select * from users where username='$uname' and password='$password'";
	$result=mysqli_query($connection , $query);
	$count=mysqli_num_rows($result);
	if($count!=1)
		echo "login failed";
	else{
		$_SESSION['username']=$uname;
		echo $_SESSION['username'];
		header('Location: index.php');
	}
}
if(isset($_SESSION['username']))
{	
	echo "already logged in";
	echo '<a href="logout.php">Click here to logout';} 
?>


<html>
	<head>
		<title>Login</title>
		<style>
			.input {
 				}
			

			.btn{
				}
		
			
					
			









		</style>
	</head>
	
	<body>
		<form method="post">
			<div class="input">Username: <input type="text" name="uname"></div>
			<div class="imput">Password: <input type="password" name="password"></div>
			<input class="btn" type="submit" value="Login">
		</form>
		<a class="btn" href="register.php">Register Here</a>
	</body>
</html>
