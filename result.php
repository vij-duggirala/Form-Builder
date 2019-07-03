<?php
	require_once("connect.php");
	session_start();
	if(isset($_SESSION['username']))
	{
		$uname=$_SESSION['username'];
		if(isset($_GET['form_id']))
		{	
			$form_id=$_GET['form_id'];
			$arr=explode('_' , $form_id);
			$admin=$arr[0];
			//if($admin!=$uname)
			//	echo "Permission denied";
			//else
			//{	
				$ok=1;	
				$qtable=$form_id."_Q";
				$atable=$form_id."_A";
		//	}
		}
	}
?>


<html>
	<head>
		<title>Results</title>
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
		<div align="center"><h2>Resluts</h2></div>
		<span id="left"><h3><?php echo "Welcome  ".$uname; ?></h3></span><span id="right"><h3>Click here to 
		<a href="logout.php" id="logout">Logout</a></h3></span>

		
		<?php
			if(isset($ok))
			{
				$query1="select * from $uname where form_id=\"$form_id\"";
				$result1=mysqli_query($connection , $query1);
				if(!$result1)
					echo mysqli_error($connection);
				while($row1=mysqli_fetch_array($result1)){
					echo "<div align='center'>Title: <span>".$row1['title']."</span></div><div align='center'>Description: <span>".$row1['description']."</span></div>";
					echo "<div align='center'>Link: <span><b>done.php?form_id=".$row1['form_id']."</b></span></div>";
				}
				echo "<br><br>";
				$query2="select * from $atable";
				$result2=mysqli_query($connection , $query2);
				if(!$result2)
					echo mysqli_error($connection);
				
				$total=mysqli_num_rows($result2);
				
				
				
				while($rowa=mysqli_fetch_array($result2))
				{
					echo "<ol>";
					echo "<span>User: ".$rowa['user']."</span>";
					$query3="select * from $qtable";
				$result3=mysqli_query($connection , $query3);
				if(!$result3)
					echo mysqli_error($connection);

					while($rowq=mysqli_fetch_array($result3))
					{
						
						$q=$rowq['qid'];
						echo "<li>".$rowq['question']."  ".$rowa[$q]."</li>";
					}
					
					echo "</ol>";
				}	
			
			}
		echo '<br><div align="center">Head to the dashboard by clicking <a href="index.php"> here </a></div>'; 
		?>

	</body>

</html>
					



						







								
										
	







					
			
