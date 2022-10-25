<?php include('comman/menu.php');?>
<?php
        if(isset($_GET['category_id']))
        {
            $category_id=$_GET['category_id'];
            //Get the category title based on category ID
            $sql="SELECT title FROM category_tbl WHERE id= $category_id";
            $r=mysqli_query($conn,$sql);
            $count=mysqli_fetch_assoc($r);
            $category_title=$count['title'];
        
        }
        else
        {
            header("location:".SITEURL);

        }


?>




    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php  echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
               //create sql query to get foods based on selected category

               $sql2="SELECT *FROM food_tbl WHERE category_id=$category_id";
               $res2=mysqli_query($conn,$sql2);
               //count the rows

               $count2=mysqli_num_rows($res2);
               if($count2>0)
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
                                else
                                {
                                 ?>
                                    <img src="<?php echo SITEURL;  ?>images/Food/<?php echo $image_name; ?>"class="img-responsive img-curve"  >
                                               
                                 <?php 
                                 }
                              ?>
                         </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">₹<?php echo $price;  ?></p>
                            <p class="food-detail">
                            <?php echo   $description;  ?>
                            </p>
                            <br>

                           <a href="<?php SITEURL; ?>order.php?food_id=<?php  echo  $id; ?>" class="btn btn-primary">Order Now</a>
                      </div>
                   </div>

                         <?php
                    }
                }
                 else{
                 echo "<div class='error'>Food is not Added.</div>";

                 }
               


           ?>

           

                

           

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php include('comman/footer.php');             ?>