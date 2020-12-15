<?php

if(isset($_POST['reg_user'])){
	
	
	include_once 'dbh.inc.php';
	
$username = mysqli_real_escape_string($conn, $_POST['username'];
$name = mysqli_real_escape_string($conn, $_POST['name'];
$email = mysqli_real_escape_string($conn, $_POST['email'];
$password = mysqli_real_escape_string($conn, $_POST['password'];
$phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber'];
$address = mysqli_real_escape_string($conn, $_POST['address'];
$gender = mysqli_real_escape_string($conn, $_POST['gender'];
$dob = mysqli_real_escape_string($conn, $_POST['dob'];
$college = mysqli_real_escape_string($conn, $_POST['college'];
$branch = mysqli_real_escape_string($conn, $_POST['branch'];
$degree = mysqli_real_escape_string($conn, $_POST['degree'];
$marks = mysqli_real_escape_string($conn, $_POST['marks'];
$state = mysqli_real_escape_string($conn, $_POST['state'];
$category = mysqli_real_escape_string($conn, $_POST['category'];
$jobexperience = mysqli_real_escape_string($conn, $_POST['jobexperience'];
$company = mysqli_real_escape_string($conn, $_POST['company'];
$designation = mysqli_real_escape_string($conn, $_POST['designation'];
$salary = mysqli_real_escape_string($conn, $_POST['salary'];

//error handlers
//check for empty fields

   if (empty($username) || empty($name) || empty($email) || empty($password) || empty($phonenumber) || empty($address) || empty($gender) || empty($dob) || empty($college) || empty($branch) || empty($degree) || !empty($marks) || empty($state) || empty($category) || empty($jobexperience) ){
                 
   header("Location: ../reg.php?signup=empty");
	exit();
   
   }
   else{
	 //check if input characters are valid
       if(!preg_match("/^[a-zA-Z]*$/",$username)){
                
              
   header("Location: ../reg.php?signup=invalid");
	exit();
   

	   }
else{
   //check if email is valid
     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		               
   header("Location: ../reg.php?signup=invalid email");
	exit();
   
	 }
	 else{
		$sql = "SELECT * FROM register WHERE email='$email'";
         $result = mysqli_query($conn, $sql);		
		 $resultCheck = mysqli_num_rows($result);
		 
		    if($resultCheck > 0){
			header("Location: ../reg.php?signup=usertaken");
	exit();
   
		}
		else{
			$sql = "INSERT INTO register (username,Name,email,password,phno,address,gender,dob,college,branch,degree,marks,state,category,job_exp,company,designation,salary) VALUES ('$username', '$name', '$email', '$password', '$phonenumber', '$address', '$gender', '$dob', '$college', '$branch', '$degree', '$marks', '$state', '$category', '$jobexperience', '$company', '$designation', '$salary');"
           		$result = mysqli_query($conn, $sql);
                 			header("Location: ../placement/log1.php");
	exit();
		}
   				
		}
	 }

}	
	    
   }
else{
	header("Location: ../reg.php");
	exit();
}
?>