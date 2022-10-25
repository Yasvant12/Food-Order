
<?php include('Partial/menu.php'); ?>

<div class=" Main-Content ">
       <div class="wrapper">
       <h1>Change Password</h1>
       <br><br>
      <?php
      if(isset($_GET['id']))
      {
          $id=$_GET['id'];
      }
   
      ?>

       <form action="#" method="POST">
    
         <table class="tbl-30">
          <tr>
             <td>Current Password</td>
             <td> <input type="Password"  name="current_password" placeholder="Current Password"> </td>
         </tr>  
         <tr>
             <td>New Password</td>
             <td> <input type="Password"  name="new_password" placeholder="New Password"> </td>
         </tr>  
         <tr>
             <td>Confirm Password</td>
             <td> <input type="Password"  name="confirm_password" placeholder="Confirm Password"> </td>
         </tr>  
        
         <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">
               </td>
         </tr>
     </table>

</form>


    </div>
</div>


<?php

//Check weather the submit  button is click or not

if(isset($_POST['submit']))
{
    // 1.Get the data from the form 

    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);


    // Check weather the user with current id and current password with Exists or not

    $query="SELECT *FROM  admin__tbl WHERE id=$id AND pwd='$current_password'";




     $res= mysqli_query($conn,$query);
   
   
    if($res==True)
    {

        $count=mysqli_num_rows($res);

        if($count==1)
        {
            //user exit and password can be changed

            //Check weather new password and confirm work or not
            if($new_password== $confirm_password)
            {

                //Update the password

                $sql="UPDATE  admin__tbl SET pwd='$new_password' WHERE  id='$id' ";

                $res2= mysqli_query($conn,$sql);

                if($res2==True)
                {
                    $_SESSION['password-changed']="<div class='sucess'> Password Changed sucessfully </div>";

                    header("location:".SITEURL.'Admin/manage-admin.php');

                }
                else
                {
                           
                    $_SESSION['password-changed']="<div class='error'> Fail to change the password </div>";

                    header("location:".SITEURL.'Admin/manage-admin.php');

                }

            }
            else
            {
                    //Redirect page with error message

                    $_SESSION['password-not-match']="<div class='error'>Password not match</div>";

                    header("location:".SITEURL.'Admin/manage-admin.php');

            }
        }
    

        else
        {
             //user does'nt exist set message and redirect

            $_SESSION['user-not-found']="<div class='error'>User not Found</div>";

            header("location:".SITEURL.'Admin/manage-admin.php');

           
        }
    }
}
    
?>

<?php include('Partial/footer.php'); ?>
