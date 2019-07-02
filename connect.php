<?php
	$connection=mysqli_connect('localhost' , 'vij' , 'ajkds');
	$db=mysqli_select_db($connection , 'form');
	if(!$connection)
		die("Database Connection failed" . mysqli_error($connection));
	if(!$db){
		$sql="create database form";
		$dbcreate=mysqli_query($connection , $sql);
	}
	$q="create table if not exists users ( fullname varchar(255) , username varchar(255) NOT NULL , password varchar(255) , email varchar(255) , primary key(username) )";
	$r=mysqli_query($connection , $q);

?>
