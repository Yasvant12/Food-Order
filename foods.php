<?php include('comman/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



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

    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php include('comman/footer.php');             ?>