<?php  
	require 'database.php';
	if (!isset($_SESSION['loggedin']))
		header("LOCATION: userLogin.php"); 

	session_start();  
	session_destroy();  
	header("location:userLogin.php");  
?> 