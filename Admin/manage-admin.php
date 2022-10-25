
<?php include('Partial/menu.php'); ?>

 <!-- Main Content  section start -->
<div class=" Main-Content ">
       <div class="wrapper">

              <h1>Manage Admin</h1>

              <br/>
              <?php
              if(isset($_SESSION['add']))
              {
                  echo $_SESSION['add']; //Displaying the session message
                  unset($_SESSION['add']); //Removing the session message
              }
              if(isset($_SESSION['delete']))
              {
                echo $_SESSION['delete']; //Displaying the session message
                unset($_SESSION['delete']); 
              }
              if(isset($_SESSION['update']))
              {
                echo $_SESSION['update']; //Displaying the session message
                unset($_SESSION['update']); 
              }

              if(isset($_SESSION['user-not-found']))
              {
                echo $_SESSION['user-not-found']; //Displaying the session message
                unset($_SESSION['user-not-found']); 
              }

              
              if(isset($_SESSION['password-not-match']))
              {
                echo $_SESSION['password-not-match']; //Displaying the session message
                unset($_SESSION['password-not-match']); 
              }
              if(isset($_SESSION['password-changed']))
              {
                echo $_SESSION['password-changed']; //Displaying the session message
                unset($_SESSION['password-changed']); 
              }
             




             

              ?>  <br/> <br/>
              <!-- Button to add admin -->
              <a href="Add-Admin.php" class="btn-primary">Add Admin</a>
              <br/><br/>
              <table class="tbl-full">
                <tr>
                    <th>Sr No</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                    

                </tr>
                  <?php
                  $sql="SELECT *FROM   admin__tbl";

                  //Execute the query
                  $res=mysqli_query($conn,$sql);
                  if($res==True)
                  {
                    $cnt=1;

                    //count rows to check weather we have data in database or not

                    $count=mysqli_num_rows($res);
                      if($count>0)
                      {
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            $id=$rows['id'];
                            $full_name=$rows['Full_name'];
                            $user=$rows['user_name'];
                            $pwd=$rows['pwd'];
                            ?>
                                    <tr>
                                    <td><?php echo $cnt++;  ?></td>
                                    <td><?php echo $full_name;  ?></td>
                                    <td><?php echo $user;  ?></td>
                                    <td> <a href="<?php  echo SITEURL; ?>Admin/Update-Password.php?id=<?php echo $id?>" class="btn-primary">Change Password</a>
                                      <a href="<?php  echo SITEURL; ?>Admin/Update-admin.php?id=<?php echo $id?>" class="btn-secondary">Update Admin</a>
                                   <a href="<?php  echo SITEURL; ?>Admin/delete_admin.php?id=<?php echo $id?>"    class="btn-dark">Delete Admin</a>
                               </td>
                               </tr>

                            <?php

                        }
                      }
                    }
                      ?>
               
              </table>


             <div class="clearFix"></div>
       </div>
</div>
    <!-- Main Content  section Ends -->



<?php include('Partial/footer.php'); ?>