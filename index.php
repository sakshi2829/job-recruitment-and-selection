<?php
   include_once 'header.php';
   
   ?>
   <div class="main-wrapper">
   <h2>HOME<h2>
   
   <?php
      if(isset($_SESSION['username'])){
		 echo "You are logged in"; 
		  
	  }
	  
	  ?>
	  </div>
	  </section>
	  
	  <?php
	  
	     include_once 'footer.php';
		 
		 ?>