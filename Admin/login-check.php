<?php
 //Authorization  - Acess control
        //check weather the user is logout or not
if(!isset($_SESSION['user'])) 
  {
	//user is not looged in
	//redirect page to login messagw
       
     $_SESSION['no-login-message']="<div class='error text-center'>Please login to acess admin pannel..</div>";
	  //Displaying the session message
     header("location:".SITEURL.'Admin/login.php');
 }
?>
 



