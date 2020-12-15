<?php

    if(isset($_POST['reg_user'])){
	
	
	include_once 'dbh.inc.php';
	
$compname = mysqli_real_escape_string($conn, $_POST['compname']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$post = mysqli_real_escape_string($conn, $_POST['post']);
$criteria = mysqli_real_escape_string($conn, $_POST['criteria']);
$phno = mysqli_real_escape_string($conn, $_POST['phno']);
$cutoff = mysqli_real_escape_string($conn, $_POST['cutoff']);


//error handlers
//check for empty fields

   if (empty($compname) || empty($address) || empty($post) || empty($criteria) || empty($phno) || empty(cutoff) ){
                 
   header("Location: ../compreg.php?signup=empty");
	exit();
   }
    else{
	 //check if input characters are valid
       if(!preg_match("/^[a-zA-Z]*$/",$compname)){
                
              
   header("Location: ../compreg.php?signup=invalid");
	exit();
   

	   }

	 else{
		$sql = "SELECT * FROM company WHERE compname='$compname'";
         $result = mysqli_query($conn, $sql);		
		 $resultCheck = mysqli_num_rows($result);
		 
		    if($resultCheck > 0){
			header("Location: ../compreg.php?signup=companytaken");
	exit();
   
		}
		else{
			$sql = "INSERT INTO company (comp_name,address,post,criteria,contact_no,cut_off) VALUES ('$compname', '$address', '$post', '$criteria', '$phno', '$cutoff');";
           		$result = mysqli_query($conn, $sql);
                 			header("Location: ../placement/footer.php");
	exit();
		}
   				
		}
	 }

	  
else{
	header("Location: ../compreg.php");
	exit();
}
	
?>
  

   