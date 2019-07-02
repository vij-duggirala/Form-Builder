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
	</head>
	<body>
		<h1>Results</h1>
		<?php
			if(isset($ok))
			{
				$query1="select * from $uname where form_id=\"$form_id\"";
				$result1=mysqli_query($connection , $query1);
				if(!$result1)
					echo mysqli_error($connection);
				while($row1=mysqli_fetch_array($result1))
					echo "<div>Title: ".$row1['title']."<br>Description: ".$row1['description'];
				$query2="select * from $atable";
				$result2=mysqli_query($connection , $query2);
				if(!$result2)
					echo mysqli_error($connection);
				
				echo $total=mysqli_num_rows($result2);
				
				
				
				while($rowa=mysqli_fetch_array($result2))
				{
					echo "<ol>";
					echo "User: ".$rowa['user'];
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
		?>

	</body>

</html>
					



						







								
										
	







					
			
