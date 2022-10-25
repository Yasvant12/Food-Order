<?php include('../config/const.php');  ?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login  - Food order System</title>
    <link rel="stylesheet" href="Admin.css">
</head>
<body>
<div class="login">
    <h1 class="text-center">Login</h1>
    <?php

    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
    }
    ?>
    <br><br>


      <?php
         if(isset($_SESSION['login']))
         {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
         }
       
         if(isset($_SESSION['no-login-message']))
         {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
         }
  

    ?>
    <br><br>
    <!-- Login form start here -->
     <form action="" method="POST" class="text-center">
        Username:<br>
        <input type="text" name="username" placeholder="Enter Username"><br><br>
        Password:<br>
        <input type="password" name="password" placeholder="Enter Password"><br><br>
        <input type="submit" name="submit" value="Login" class="btn-primary">
        <br><br>

     </form>


    <!-- Login form End here -->
    <p   class="text-center">Created by :  <a href="#">Yasvant Kumar Gupta</a> </p>

</div>             




</body>
</html>

<?php
//check weather the submit button is click or not

if(isset($_POST['submit']))
{
     $username= mysqli_real_escape_string($conn,$_POST['username']);
     $raw_password=md5($_POST['password']);
     $password=mysqli_real_escape_string($conn,$raw_password);
     //2.SQL to check weather the user with username and password exist or not
      $sql="SELECT * FROM admin__tbl WHERE user_name='$username' AND pwd='$password'";
      
     //Execute the query

      $res=mysqli_query($conn,$sql);
    
       
     //4.count rows to check weather the user exist or not 
     $count=mysqli_num_rows($res);
     echo $count;

     if($count==1)
    {
        $_SESSION['login']="<div class='sucess text-center'> Login Sucessfull.</div>";
        //redirect to dashboard or home page
        $_SESSION['user']=$username;
       
        header("location:".SITEURL.'Admin/');
    }else{
        $_SESSION['login']="<div class='error text-center'> Username or Password did not match.</div>";
        //redirect to dashboard or home page

        header("location:".SITEURL.'Admin/login.php');
    }

}



?>