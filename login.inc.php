<?php

session_start();

if(isset($_POST['login_user']))
{
	include 'dbh.inc.php';
	
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	
	//error handlers
	//check for empty inputs
	if (empty($username) || empty($password)){
		header("Location: ../placement.php?login=empty");
		exit();	   
	}
	else{
		$sql = "SELECT * FROM register WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck < 1){
            header("Location: ../placement.php?login=error");
		    exit();
		}else{
			if($row = mysqli_fetch_assoc($result)){
				header("Location: ../placement/header.php");
				exit();
			}
		}      
	}
}else{
	header("Location: ../placement.php?login=error");
	exit();
}
?>