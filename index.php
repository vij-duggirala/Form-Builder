<?php
	require_once("connect.php");
	session_start();
	echo welcome."  ". $_SESSION['username'];
	$uname=$_SESSION['username'];
?>




<html>
	<head>
		<title>DashBoard</title>
		<style>
			#logout{ border: 2px solid black; padding: 5px 5px 5px 5px; background: red; text-decoration: none; }
		</style>

	</head>



	<body>
	
	

	
	
	<?php echo '<a href="create.php?uname='.$uname.'">Create New</a>'; ?>
	<a href="logout.php" id="logout">Logout</a>
	<br>Your forms:
	<?php	
		$query="select * from $uname";
		$result=mysqli_query($connection, $query);
		if(!$result)
			echo mysqli_error($connection);
		echo "<ol>";
		while($row=mysqli_fetch_array($result))
		{
			echo '<li><a href="result.php?form_id='.$row['form_id'].'"> '.$row['title'].'</li>';
		}
		echo "</ol>";
	?> 

	</body>




</html>
