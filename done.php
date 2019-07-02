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
						echo $query2="insert into $atable (user) values ('$uname')";
						$res2=mysqli_query($connection, $query2);
						if(!$res2)
							echo mysqli_error($connection);
						$query11="select * from $qtable";
						$result11=mysqli_query($connection , $query11);
						$count_q=mysqli_num_rows($result11);
						while($i<=$count_q)
						{	echo $q="Q_".$i;
							echo $ans=$_POST[$q];
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
	</head>
	
	<body>
	<?php	
		require_once("connect.php");
		if($submit==0)
		{
			$query1="select * from $qtable";
			$result1=mysqli_query($connection , $query1);
			echo $count_q=mysqli_num_rows($result1);
			if(!$result1)
				echo mysqli_error($connection);
			$query3="select * from $admin where form_id=\"$form_id\"";
			$result3=mysqli_query($connection, $query3);
			while($row3=mysqli_fetch_array($result3))
			{
				echo '<div>Title: '.$row3['title'].'<br><div>Description: '.$row3['description'];
			}
			while($row=mysqli_fetch_array($result1))
			{
				echo '<form method="POST">
				<div>'.$row['question'].'<br><input type="'.$row['type'].'"name="'.$row['qid'].'"></div>';
			}
			echo '</div><input type="submit" value="submit" name="submit"></div></form>';
		}
		else if($submit==1)
			echo "You have filled the form successfully";
	?> 
	</body>
</html>
