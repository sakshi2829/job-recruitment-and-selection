<?php

    if(isset($_POST['reg_user'])){
	
	
	include_once 'dbh.inc.php';
	
$compname = mysqli_real_escape_string($conn, $_POST['compname'];
$address = mysqli_real_escape_string($conn, $_POST['address'];
$post = mysqli_real_escape_string($conn, $_POST['post'];
$criteria = mysqli_real_escape_string($conn, $_POST['criteria'];
$phno = mysqli_real_escape_string($conn, $_POST['phno'];
$cutoff = mysqli_real_escape_string($conn, $_POST['cutoff'];


//error handlers
//check for empty fields

   if (empty($compname) || empty($address) || empty($post) || empty($criteria) || empty($phno) ){
                 
   header("Location: ../reg.php?signup=empty");
	exit();
   }
   else{
	header("Location: ../reg.php");
	exit();
}
?>
   