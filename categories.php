

<?php include('comman/menu.php'); ?>
<hr>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container1">
            <h2 class="text-center">Explore Foods</h2>
            

            <?php
                  //Sql for displaying category from Database
                  $sql="SELECT *FROM category_tbl  WHERE active='Yes' AND featured='Yes'";
                  $res=mysqli_query($conn,$sql);
                  $count=mysqli_num_rows($res);
                  if($count>0)
                  {  
                       
                       while($row=mysqli_fetch_assoc($res))
                       {
                        //Get the values like id,title, image_name
                            $id=$row['id'];
                            $title=$row['title'];
                           $image_name=$row['image_name'];
                        ?>
                                 <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id; ?>">
                                 <div class="box-3 float-container">
                                    <?php
                                            //checking weather the image is available or not
                                             if($image_name=="")
                                             {
                                                echo "<div class='error'>Image not Availabe.</div>";
                                             }
                                             else{
                                                ?>
                                                <img src="<?php echo SITEURL;  ?>images/category/<?php echo $image_name; ?>"class="img-responsive img-curve"  >
                                              <?php 
                                            }
                                    ?>
                               

                                 <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                 </div>
                                 </a>

                           
                        <?php

                       }


                             

                  }
                  else
                  {
                     echo "<div class='error'> Category not Added </div>";


                  }
       
       
       
       ?>

           
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
<hr>

    <?php include('comman/footer.php');             ?>