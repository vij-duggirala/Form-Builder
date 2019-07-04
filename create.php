<?php
	require_once("connect.php");
	session_start();
	if(isset($_SESSION['username']))
	{	
		if(isset($_GET['uname'])){
			if($_GET['uname']!=$_SESSION['username'])
				{ echo "invalid"; header('Location:index.php'); }  
	 		else
			{
				$uname=$_SESSION['username'];
				if(isset($_POST['submit']))
				{		
						$uname=$_GET['uname'];
						$desc=$_POST['desc'];
						$title=$_POST['title'];
						
						$query0="select * from $uname";
						$res0=mysqli_query($connection, $query0);
						$count=mysqli_num_rows($res0);
						$count=$count+1;
						$form_id=$uname."_".$count;
						

						$query1="insert into $uname (form_id, title , description ) values ( '$form_id', '$title' , '$desc')";
						$res1=mysqli_query($connection , $query1);
			
						$qtable=$form_id."_Q";
						$query2="create table $qtable(qid varchar(250) NOT NULL primary key, question varchar(1000), type varchar(20) )";
						$res2=mysqli_query($connection , $query2);


						$atable=$form_id."_A";
						$query3="create table $atable ( user varchar(250) NOT NULL)";
						$res3=mysqli_query($connection , $query3);

						if(!$res0 || !$res1 || !$res2 || !$res3)
							echo mysqli_error($connection);
			
							
						$location="add.php?form_id=$form_id";
						header("Location:$location");
				}			
			}	}
		else
			header('Location:index.php');
	}
	else
		header('Location:login.php');


?>

<html>
	<head>
		<title>Create New Form</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		 <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap" rel="stylesheet">
		 <link href="https://fonts.googleapis.com/css?family=Allura&display=swap" rel="stylesheet">   
		<meta charset="UTF-8">	
		<style>
			#left{ 
					display: inline;
					float: left;
				}
			#right{
				display: inline;
				float: right;
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
			h3
			{
				padding: 30px 20px 20px 20px;
				text-align: center;
				font-family: 'Luckiest Guy', cursive;
				color: black;
				margin: 5px;
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
		<div align="center"><h2>Create New Form</h2></div>
		<span id="left"><h3><?php echo "Welcome  ".$uname; ?></h3></span><span id="right"><h3>Click here to 
		<a href="logout.php" id="logout">Logout</a></h3></span>

	
		<br><br><br><br><br><br><br>
		<form method="POST">
			<div align="center">Form Title: <input type="text" name="title"></div>
			<div align="center">Description: <input type="text" name="desc"></div>
			<div align="center"><input id="submit" type="submit" name="submit" value="create"></div> 				
						
		</form>
	



	




	</body>
</html>
