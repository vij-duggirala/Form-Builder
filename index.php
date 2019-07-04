<?php
	require_once("connect.php");
	session_start();
	if(isset($_SESSION['username']))
		$uname=$_SESSION['username'];
	else
		header('Location:login.php');	
	
		
?>




<html>
	<head>
		<title>DashBoard</title>
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
			.btn{
				font-weight: bold;
				font-size: 30px;
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
						


								
		</style>

	</head>



	<body>
		<div align="center" id="h1"><h1>FORMS</h1></div>
		<div align="center"><h2>Dashboard</h2></div>
		<span id="left"><h3><?php echo "Welcome  ".$uname; ?></h3></span><span id="right"><h3>Click here to 
		<a href="logout.php" id="logout">Logout</a></h3></span>

	
	
	
	
	
	<br><br><br><br><br>
	<?php	
		$query="select * from $uname";
		$result=mysqli_query($connection, $query);
		$count=mysqli_num_rows($result);
		if($count!=0)
		{
			echo "<div align=\"left\">Your forms: </div>";
		if(!$result)
			echo mysqli_error($connection);
		echo "<ol>";
		while($row=mysqli_fetch_array($result))
		{
			echo '<li><a href="result.php?form_id='.$row['form_id'].'"> '.$row['title'].'</li>';
		}
		echo "</ol>";
		}
	?> 

	<br><br><br><div align="center"><?php echo '<a class="btn" href="create.php?uname='.$uname.'">Create NEW Form</a>'; ?></div>

	</body>




</html>
