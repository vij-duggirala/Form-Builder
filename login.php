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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		 <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap" rel="stylesheet">
		 <link href="https://fonts.googleapis.com/css?family=Allura&display=swap" rel="stylesheet">   
		<meta charset="UTF-8">
		<style>
			.input {
 				}
			

			.btn{
				font-weight: bold;
				font-size: 20px;
				padding: 10px 5px 5px 5px;
				 text-decoration: none;
				    display: inline-block; 
				    background: ButtonFace; color: ButtonText;
				    border-style: solid; border-width: 2px;
				    border-color: ButtonHighlight ButtonShadow ButtonShadow ButtonHighlight;

				}
		
		
			h1 {	
				padding: 30px 20px 20px 20px;
				text-align: center;
				font-family: 'Luckiest Guy', cursive;
				color: black;
				margin: 5px;
				font-size: 5vw;
				background-color: white;

							
				
			}
			body{
				font-family: 'Luckiest Guy', cursive;
				font-weight: bold;
				font-size: 30px;
				background-color:  #1fc8db;	

			}
						
			#submit{
				font-family: 'Luckiest Guy', cursive;
				font-weight: bold;
				font-size: 30px;
			}








		</style>
	</head>
	
	<body>
		<div align="center" id="h1"><h1>FORMS</h1></div>
		<div align="center"><h2>Login</h2></div>
		<form method="post">
			<div align="center" class="input">Username: <input type="text" name="uname"></div>
			<div align="center" class="imput">Password: <input type="password" name="password"></div>
			<div align="center"><input id="submit" type="submit" value="Login"></div>
		</form>
		<br><br>
		<div align="center"><h4>If you don't have an account, please 
		<a class="btn" href="register.php">Register Here</a></h4></div>
	</body>
</html>
