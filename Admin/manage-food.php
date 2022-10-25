<?php include('Partial/menu.php'); ?>
   
   
<div class=" Main-Content ">
       <div class="wrapper">
              <h1>Manage food</h1>


              <br/>  <br/>


              <?php

                        if(isset($_SESSION['add']))
                        {
                          echo $_SESSION['add'];
                          unset($_SESSION['add']);


                         }
                         if(isset($_SESSION['delete-category']))
                         {
                           echo $_SESSION['delete-category'];
                           unset($_SESSION['delete-category']);
 
 
                          }

                          if(isset($_SESSION['delete-category']))
                          {
                            echo $_SESSION['delete-category'];
                            unset($_SESSION['delete-category']);
  
  
                           }
                           if(isset($_SESSION['remove']))
                          {
                            echo $_SESSION['remove'];
                            unset($_SESSION['remove']);
  
  
                           }
                           if(isset($_SESSION['un']))
                           {
                             echo $_SESSION['un'];
                             unset($_SESSION['un']);
   
   
                            }
                            if(isset($_SESSION['update']))
                            {
                              echo $_SESSION['update'];
                              unset($_SESSION['update']);
    
    
                             }
                             if(isset($_SESSION['Failed-remove']))
                             {
                               echo $_SESSION['Failed-remove'];
                               unset($_SESSION['Failed-remove']);
     
     
                              }
                              if(isset($_SESSION['upload']))
                              {
                                echo $_SESSION['upload'];
                                unset($_SESSION['upload']);
      
      
                               }
                               if(isset($_SESSION['no-category-found']))
                               {
                                 echo $_SESSION['no-category-found'];
                                 unset($_SESSION['no-category-found']);
       
       
                                }
                            

              ?>
              <br/>  <br/>
              <!-- Button to add admin -->
              <a href="add-food.php" class="btn-primary">Add Food</a>
              <br/>   <br/>
              <table class="tbl-full">
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                     <th>Image</th> 
                     <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>

                    <?php
                  $sql="SELECT *FROM   food_tbl";

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
                             $title=$rows['title'];
                             $price=$rows['price'];
                             $image_name=$rows['image_name'];
                             $featured =$rows['featured'];
                             $active=$rows['active'];
                            ?>
                                <tr>
                                    <td><?php echo  $cnt++;  ?></td>
                                    <td><?php echo  $title;  ?></td>
                                    <td>$<?php echo  $price;  ?></td>
                                    <td>
                                       
                                    <?php
                                        // <!-- check weather image name is avaible is not  -->
                                         if( $image_name!="")
                                          {
                                            ?>
                                                <img src=" <?php  echo SITEURL; ?>images/Food/<?php echo $image_name; ?>" width="60px">
                                            <?php
                                         }
                                         else
                                         {
                                            echo "<div class='error'>image not uploaded</div>";
                                             
                                         }
                                        
                                        
                                        
                                         ?> 
                                    
                                    </td>

                                    <td><?php echo $featured;  ?></td>
                                    <td><?php echo  $active;  ?></td>
                                    <td>
                                      <a href="<?php  echo SITEURL; ?>Admin/Update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                    <a href="<?php  echo SITEURL; ?>Admin/Delete-food.php?id=<?php echo $id; ?>& image_name=<?php echo  $image_name; ?>"class="btn-dark">Delete Food</a>
                                    </td>
                               </tr>

                            <?php

                        }
                    }
                        else{
                            //we do not have data
                            ?>
                            <tr>
                                <td colspan="6">
                                    <div class="error">No Category Added.</div>
                                </td>
                            </tr>
                            <?php
                        }
                      }
                    
                      ?>
               
            
              </table>

             <div class="clearFix"></div>
       </div>
</div>
   
   
   <?php include('Partial/footer.php'); ?>