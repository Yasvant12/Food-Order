<?php include('comman/menu.php');             ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 
            $search = mysqli_real_escape_string($conn,$_POST['search']); ?>



            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search  ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php      
            // Get the search keyword
            $search=$_POST['search'];
            //Sql Query to Get foods based on search keyword
             //$search=burger'
            //SELECT *FROM food_tbl WHERE title Like '% %'  OR description Like '%%
           

            $sql="SELECT *FROM food_tbl WHERE title Like '% $search%'  OR description Like '%$search%'";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
           
            if($count>0)
            {
                      while($row2=mysqli_fetch_assoc($res)){
                       
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
            }
            else
            {

               echo "<div class='error'>Food not found.</div>";
            }
            
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php include('comman/footer.php');             ?>