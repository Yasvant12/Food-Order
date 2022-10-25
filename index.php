<?php include('comman/menu.php');             ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
     <br><br>
    <?php
           if(isset($_SESSION['order']))
           {
                 echo $_SESSION['order'];
                 unset($_SESSION['order']);
           }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
      
       <div class="container ">
       <h2 class="text-center">Explore Foods</h2>
       <?php
                  //Sql for displaying category from Database
                  $sql="SELECT *FROM category_tbl  WHERE active='Yes' AND featured='Yes' LIMIT 3";
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

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>



            <?php
                //Getting from the database that are active features
                $sql2="SELECT *FROM   food_tbl WHERE active='Yes' AND featured='Yes' LIMIT 6";
                $res2=mysqli_query($conn,$sql2);
                $count2=mysqli_num_rows($res2);
                if( $count2>0)
                {
                   
                     while($row2=mysqli_fetch_assoc($res2)){

                        $id=$row2['id'];
                        $title=$row2['title'];
                        $image_name=$row2['image_name'];
                        $price=$row2['price'];
                        $description=$row2['description'];
                        ?>

                           <div class="food-menu-box">
                              <div class="food-menu-img">

                              <?php
                                            //checking weather the image is available or not
                                             if($image_name=="")
                                             {
                                                echo "<div class='error'>Image not Availabe.</div>";
                                             }
                                             else{
                                                ?>
                                                <img src="<?php echo SITEURL;  ?>images/Food/<?php echo $image_name; ?>"class="img-responsive img-curve"  >
                                               
                                              <?php 
                                            }
                                    ?>
                                     </div>
                                    

                             <div class="food-menu-desc">
                             <h4><?php echo  $title;  ?></h4>
                             <p class="food-price">₹<?php echo $price;  ?></p>
                             <p class="food-detail">
                               <?php echo $description;  ?>
                          </p>
                          <br>
                           <a href="<?php SITEURL; ?>order.php?food_id=<?php  echo  $id; ?>" class="btn btn-primary">Order Now</a>
                           
                             </div>
                         </div>

                        <?php


                     }



                





                }else{
                    echo"<div class='error'>FOOD IS NOT ADDED.</div>";
                }


              ?>

         
            <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('comman/footer.php');             ?>

    <!-- //https://youtu.be/ZwRuymyeKtk  Food-->