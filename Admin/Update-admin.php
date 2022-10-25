
<?php include('Partial/menu.php'); ?>

<div class=" Main-Content ">
       <div class="wrapper">
       <h1>Update Admin</h1>
       <br><br>
      <?php
     
    //   Get the id of selected admin
       $id=$_GET['id'];
    // Creating the sql query for get the details
        $sql="SELECT *FROM  admin__tbl WHERE id=$id";
       //Executing the query
        $res=mysqli_query($conn,$sql);


    if($res==True)
    {
        // Check weather the data is availabe or not
        $count=mysqli_num_rows($res);
        // Check weather we have admin data or not
        if($count==1)
        {
               $rows=mysqli_fetch_assoc($res);
               $id=$rows['id'];
               $full_name=$rows['Full_name'];
               $user=$rows['user_name'];
        }
         else{
            header("location:".SITEURL.'Admin/manage-admin.php');
         }

    }


      ?>

       <form action="#" method="POST">
    
         <table class="tbl-30">
          <tr>
             <td>Full Name</td>
             <td> <input type="text"  name="full-name" value="<?php echo $full_name; ?>"> </td>
         </tr>  
         <tr>
             <td>Username</td>
             <td> <input type="text"  name="username" value="<?php echo  $user; ?>"> </td>
         </tr>  
        
         <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
               </td>
         </tr>
     </table>

</form>


    </div>
</div>
<?php
//Check weather the updated button is click or not
if(isset($_POST['submit']))
{
    $id=$_POST['id'];
    $full_name=$_POST['full-name'];
    $user=$_POST['username'];


    $query = "UPDATE  admin__tbl SET Full_name='$full_name',user_name='$user' WHERE  id='$id' ";


$res= mysqli_query($conn,$query);
   
   
    if($res==True)
    {
        $_SESSION['update']="Admin updated sucessfully";
        //Redirect to manage page
        header("location:".SITEURL.'Admin/manage-admin.php');


    }else{
        $_SESSION['update']="Fail to updated ";
        //Redirect to manage page
        header("location:".SITEURL.'Admin/manage-admin.php');

    }
}




?>



<?php include('Partial/footer.php'); ?>
