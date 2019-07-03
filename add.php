<?php
	require_once("connect.php");
	session_start();
	if(isset($_GET['form_id']))
	{	$set=0;
		$uname=$_SESSION['username'];
		$form_id=$_GET['form_id'];
		$qtable=$form_id."_Q";
		$atable=$form_id."_A";
		if(isset($_POST['add']))
		{		
			$question=mysqli_real_escape_string($connection , $_POST['question']);
			$type=$_POST['type'];
			
			
			$query0="select * from $qtable";
			$res0=mysqli_query($connection , $query0);
			$count = mysqli_num_rows($res0);
			
			
			
					
			$count=$count+1;
			$qid="Q_".$count;
	
			if($count>0)
				$gen=1;

			$query1="insert into $qtable ( qid, question ,type ) values( '$qid' , '$question' , '$type' )";		
			$res1=mysqli_query($connection , $query1);
	
			$query2="alter table $atable add $qid varchar(2000)";
			$res2=mysqli_query($connection , $query2);
			

	
			if(!$res0 || !$res1 || !$res2)
				echo mysqli_error($connection); 
		}
		
		if(isset($_POST['submit']))
		{
			$set=1;$gen=0;
		}	

			
				
	}		

?>

<html>
	<head>
		<title>Add Questions</title>
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
			span{
				color: white;
			}
							
			#submit{
				font-family: 'Luckiest Guy', cursive;
				font-weight: bold;
				font-size: 30px;
			}

			  input[type=radio] {
				    width: 20px;
				    height: 20px;
				}

								
		</style>
	</head>
	<body>
		<div align="center" id="h1"><h1>FORMS</h1></div>
		<div align="center"><h2>Create New Form</h2></div>
		<span id="left"><h3><?php echo "Welcome  ".$uname; ?></h3></span><span id="right"><h3>Click here to 
		<a href="logout.php" id="logout">Logout</a></h3></span>

	
		<br><br><br><br><br>
		<?php require_once("connect.php");
		      $uname=$_SESSION['username'];
			    $uname;
			$query3="select * from $uname where form_id=\"$form_id\"";
			$res3=mysqli_query($connection , $query3);
			$row=mysqli_fetch_array($res3);
			if(!$res3)
				echo mysqli_error($connection);
		        echo '<div align="center">Form title: <span>'.$row['title'].'</span></div><div align="center">Description: <span>'.$row['description'].'</span></div><br>';
			if(isset($gen)&&$gen==1) { echo '<form method="POST"><div align="center"><input id="submit" type="submit" value="Generate Link" name="submit"></div></form>'; }
			$query4="select * from $qtable";
			$res4=mysqli_query($connection , $query4);
			if(!$res4)
				echo mysqli_error($connection);
			    
			echo "<ol>";
			while($row4=mysqli_fetch_array($res4))
				echo '<li><span>'.$row4['question'].'</span> ('.$row4['type'].')</li>';
		 	echo "</ol>";
			
		?> 
		<?php if($set!=1){		
		echo '<form method="POST">
			<div>Question: <input type="text" name="question"></div>
			<div>Type:    &nbsp;&nbsp;&nbsp;       Text<input type="radio" name="type" value="text">    &nbsp;&nbsp;&nbsp;      Number<input type="radio" name="type" value="number"></div> 
			<div><input id="submit" type="submit" value="add" name="add"></div>
		</form>';
		}
		?>
		<?php if($set==1) {
			echo '<div>The link for the from is successfully generated. The link to be copied is &nbsp; <span><b> done.php?form_id='.$form_id.'</b></span></div>';
			echo '<br><div>Head to the dashboard by clicking <a href="index.php"> here </a></div>'; 
			
		} ?>

	<?php  ?> 
	</body>
</html>
