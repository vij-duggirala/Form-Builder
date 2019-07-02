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
	</head>
	
	<body>
		<form method="post">
			<div>Full Name: <input type="text" name="name"></div>
			<div>Username: <input type="text" name="uname"></div>
			<div>Password: <input type="password" name="password"></div>
			<div>eMail: <input type="text" name="email"></div>
			<input type="submit" value="Register">
		</form>
		<a href="login.php">Login here</a>
	</body>
</html>
