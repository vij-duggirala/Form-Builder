<?php
	require_once("connect.php");
	if(isset($_POST) & !empty($_POST)){
	$fullname=mysqli_real_escape_string($connection , $_POST['name']);
	$uname=mysqli_real_escape_string($connection , $_POST['uname']);
	$password=md5($_POST['password']);
	$email=mysqli_real_escape_string($connection , $_POST['email']);
	
	$query="INSERT INTO users (fullname, username, password, email) VALUES ('$fullname' , '$uname' , '$password' , '$email')";
	$res=mysqli_query($connection , $query);
	$query2="create table $uname ( form_id varchar(250) , title varchar(255) NOT NULL , description varchar(1000) , primary key(form_id))";
	$res2=mysqli_query($connection, $query2);
	if(!$res || !$res2)
		echo ("error:" . mysqli_error($connection));
	else
		header('Location: login.php');
		
}







?>


<html>
	<head>
		<title>Register</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		 <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap" rel="stylesheet">
		 <link href="https://fonts.googleapis.com/css?family=Allura&display=swap" rel="stylesheet">   
		<meta charset="UTF-8">
		<style>
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
		<div align="center"><h2>Register</h2></div>
		<form method="post">
			<div align="center">Full Name: <input type="text" name="name"></div>
			<div align="center">Username: <input type="text" name="uname"></div>
			<div align="center">Password: <input type="password" name="password"></div>
			<div align="center">eMail: <input type="text" name="email"></div>
			<div align="center"><input id="submit" type="submit" value="Register"></div>
		</form>
		<br><br>
		<div align="center"><h4>If you already have an account, please
		<a class="btn" href="login.php">Login here</a></h4></div>
	</body>
</html>
