<?php
session_start();

// initializing variables
$username = "";
$name = "";
$email = "";
$password = "";
$phonenumber = 0;
$address = "";
$gender = "";
$dob = "";
$college = "";
$branch = "";
$degree = "";
$marks = "";
$state = "";
$category = "";
$jobexperience = 0;
$company = "";
$designation = "";
$salary = 0;
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'placement');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $name = mysqli_real_escape_string($db, $_POST['Name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $phonenumber = mysqli_real_escape_string($db, $_POST['phno']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $gender = mysqli_real_escape_string($db, $_POST['gender']);
  $dob = mysqli_real_escape_string($db, $_POST['dob']);
  $college = mysqli_real_escape_string($db, $_POST['college']);
  $branch = mysqli_real_escape_string($db, $_POST['branch']);
  $degree = mysqli_real_escape_string($db, $_POST['degree']);
  $marks = mysqli_real_escape_string($db, $_POST['marks']);
  $state = mysqli_real_escape_string($db, $_POST['state']);
  $category = mysqli_real_escape_string($db, $_POST['category']);
  $jobexperience = mysqli_real_escape_string($db, $_POST['job_exp']);
  $company = mysqli_real_escape_string($db, $_POST['company']);
  $designation = mysqli_real_escape_string($db, $_POST['designation']);
  $salary = mysqli_real_escape_string($db, $_POST['salary']);
  
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
 

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM register WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database

  	$query = "INSERT INTO register (username,name,email,password,phno,address,gender,dob,college,branch,degree,marks,state,category,job_exp,company,designation,salary) 
  			  VALUES('$username', '$name', '$email', '$password', '$phonenumber', '$address', '$gender', '$dob', '$college', '$branch', '$degree', '$marks', '$state', '$category', '$jobexperience', '$company', '$designation', '$salary' )";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: placement.php');
  }
}
// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM register WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: placement.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>