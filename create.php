<?php
	require_once("connect.php");
	session_start();
	if(isset($_GET['uname']))
		if($_GET['uname']!=$_SESSION['username'])
			{ echo "invalid"; header('Location:index.php'); }  
 		else
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
	
?>

<html>
	<head>
		<title>Create New Form</title>

	</head>
	<body>
		<br><br>
		<form method="POST">
			<div>Form Title: <input type="text" name="title"></div>
			<div>Description: <input type="text" name="desc"></div>
			<div><input type="submit" name="submit" value="create"></div> 				
						
		</form>
	



	




	</body>
</html>
