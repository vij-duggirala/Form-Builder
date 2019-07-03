<?php 
	require_once("connect.php");
	session_start();
	if(isset($_GET['form_id']))
	{	$count_q=0;
		if(isset($_SESSION['username']))
		{	$form_id=$_GET['form_id'];
			$arr=explode('_' , $form_id);
			$admin=$arr[0];
			$uname=$_SESSION['username'];
			$qtable=$form_id."_Q";
			$atable=$form_id."_A";
			$query0="select * from $uname where form_id=\"$form_id\"";
			$res0=mysqli_query($connection , $query0);
			$count0=mysqli_num_rows($res0);
			if(!$res0)
				echo mysqli_error($connection);
			if($count0!=0)
				echo "Not authorized";
			else
			{	 
				
				$submit=0; 
				if(isset($_POST['submit']))
				{
						$submit=1;
						$i=1;
						 $query2="insert into $atable (user) values ('$uname')";
						$res2=mysqli_query($connection, $query2);
						if(!$res2)
							echo mysqli_error($connection);
						$query11="select * from $qtable";
						$result11=mysqli_query($connection , $query11);
						$count_q=mysqli_num_rows($result11);
						while($i<=$count_q)
						{	 $q="Q_".$i;
							$ans=$_POST[$q];
							$query="update $atable set $q ='$ans' where user=\"$uname\"";
							$result=mysqli_query($connection , $query);
							if(!$result)
								echo mysqli_error($connection);
							$i=$i+1;		
						}

				}
			}
		}	
	}
?>




<html>
	<head>
		<title>Form</title>
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
			#submit{
				font-family: 'Luckiest Guy', cursive;
				font-weight: bold;
				font-size: 30px;
			}
			
			span{color: white;}	
			input { margin: 10px;}		


								
		</style>

	</head>
	
	<body>
	<div align="center" id="h1"><h1>FORMS</h1></div>
		<div align="center"><h2>Filling</h2></div>
		<span id="left"><h3><?php echo "Welcome  ".$uname; ?></h3></span><span id="right"><h3>Click here to 
		<a href="logout.php" id="logout">Logout</a></h3></span>

	<?php	
		require_once("connect.php");
		$query3="select * from $admin where form_id=\"$form_id\"";
			$result3=mysqli_query($connection, $query3);
			while($row3=mysqli_fetch_array($result3))
			{
				echo '<br><div align="center">Title: <span>'.$row3['title'].'</span><br></div><div align="center">Description: <span>'.$row3['description'].'</span></div>';
			}
		echo "<br><br><br>";
		if(isset($submit)&&$submit==0)
		{
			$query1="select * from $qtable";
			$result1=mysqli_query($connection , $query1);
			$count_q=mysqli_num_rows($result1);
			if(!$result1)
				echo mysqli_error($connection);
			
			
			while($row=mysqli_fetch_array($result1))
			{
				echo '<form method="POST">
				<div>'.$row['question'].'<br><input type="'.$row['type'].'"name="'.$row['qid'].'"></div>';
			}
			echo '<div ><input id="submit" type="submit" value="submit" name="submit"></div></form>';
		}
		else if($submit==1){		
			echo "You have filled the form successfully";
			echo '<br><div>Head to the dashboard by clicking <a href="index.php"> here </a></div>'; 
		}
	?> 
	</body>
</html>
