<?php
	require_once("connect.php");
	session_start();
	if(isset($_GET['form_id']))
	{	$set=0;
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
	</head>
	<body>
		<br><br>
		<?php require_once("connect.php");
		      $uname=$_SESSION['username'];
			   echo $uname;
			$query3="select * from $uname where form_id=\"$form_id\"";
			$res3=mysqli_query($connection , $query3);
			$row=mysqli_fetch_array($res3);
			if(!$res3)
				echo mysqli_error($connection);
		        echo '<div>Form title: '.$row['title'].'<br>Description: '.$row['description'].'<br>';
			$query4="select * from $qtable";
			$res4=mysqli_query($connection , $query4);
			if(!$res4)
				echo mysqli_error($connection);
			    
			echo "<ol>";
			while($row4=mysqli_fetch_array($res4))
				echo '<li>'.$row4['question'].' ('.$row4['type'].')</li>';
		 	echo "</ol>";
			
		?> 		
		<form method="POST">
			<div>Question: <input type="text" name="question"></div>
			<div>Type:   Text<input type="radio" name="type" value="text">    Number<input type="radio" name="type" value="number"></div> 
			<div><input type="submit" value="add" name="add"></div>
		</form>
		<?php if($set==1) {
			echo '<div>The link for the from is successfully generated. The link to be copied is<span><b> done.php?form_id='.$form_id.'</b></span></div>';
			
		} ?>

	<?php if(isset($gen)&&$gen==1) { echo '<form method="POST"><input type="submit" value="Generate Link" name="submit"></form>'; } ?> 
	</body>
</html>
