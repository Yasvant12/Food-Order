
<?php include('Partial/menu.php'); ?>
<div class="Main-Content">
    <div class="wrapper">
        <h1>Add Admin

        </h1>
    <br>
<?php
       if(isset($_SESSION['add'])) //Checking weather the session is check or not
              {
                  echo $_SESSION['add']; //Displaying the session message
                  unset($_SESSION['add']); //Removing the session message
              }
    ?>  <br/> <br/>

        <form action="#" method="POST">
    
             <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td> <input type="text"  name="full-name" placeholder="Enter full name"> </td>
                </tr>  
                <tr>
                    <td>Username</td>
                    <td> <input type="text"  name="Username" placeholder="Enter User name"> </td>
                </tr>  
                <tr>
                    <td>Password</td>
                    <td> <input type="password"  name="password" placeholder="Enter Your Password"> </td>
                </tr>  
                <tr>
                    <td colspan="2">
                           <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
              </table>

        </form>
    </div>
</div>


<?php include('Partial/footer.php'); ?>


<?php



//1. get the data from form

if(isset($_POST['submit']))
{
  $full_name=$_POST['full-name'];
  $user=$_POST['Username'];
  $pwd=md5($_POST['password']);//Password encryption with md5

  $sql = "INSERT INTO admin__tbl (Full_name,user_name,pwd)
      VALUES (' $full_name','$user','$pwd')";

// Executing query and saving data into database

$data=mysqli_query($conn, $sql) or die(mysqli_error());

if ($data==TRUE) 
{
    $_SESSION['add']="<b>Admin Added sucessfully</b>";
    //REDIRECT PAGE TO MAIN PAGE
    header("location:".SITEURL.'Admin/manage-admin.php');
    // header("location:".SETURL.'Admin/manage-admin.php');
} else {


    $_SESSION['add']="FAIL TO ADD ADMIN";
    //REDIRECT PAGE TO Add Admin
    header("location:".SITEURL.'Admin/Add-Admin.php');
    // header("location:".SETURL.'Admin/manage-admin.php');

}
$conn->close();
}





?>