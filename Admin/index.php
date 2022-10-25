

<?php include('Partial/menu.php'); ?>
<!-- Menu section Ends -->



    <!-- Main Content  section start -->
<div class=" Main-Content ">
       <div class="wrapper">
              <h1>DASHBOARD</h1>
              <br><br>
              <?php
         if(isset($_SESSION['login']))
         {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
         }
         



    ?>
    <br><br>

             <div class="col-4 text-center">

             <?php
             $sql="SELECT *FROM  category_tbl;";
           $res=  mysqli_query($conn,$sql);
             $count=mysqli_num_rows($res);
             ?>
                <h1><?php echo $count; ?></h1>
                <br>
                Categories
             </div>

             <div class="col-4 text-center">
             <?php
             $sql1="SELECT *FROM  food_tbl;";
              $res2=  mysqli_query($conn,$sql1);
             $count2=mysqli_num_rows($res2);
             ?>
                <h1><?php echo $count2; ?></h1>
                <br>
               Foods 
             </div>

             <div class="col-4 text-center">
               <?php
             $sql2="SELECT *FROM  order_tbl;";
              $res3=  mysqli_query($conn,$sql2);
             $count3=mysqli_num_rows($res2);
             ?>

                <h1><?php echo $count3; ?></h1>
                <br>
                Total Orders
             </div>

             <div class="col-4 text-center">
                  <?php
                    $sql3="SELECT SUM(total) As Total FROM order_tbl ";
                    $res4=  mysqli_query($conn,$sql3);
                    $row=mysqli_fetch_assoc($res4);
                    //GET THE TOTAL REVENUE
                    $total_rev=$row['Total'];
                    ?>
                <h1>₹<?php echo $total_rev  ?></h1>
                <br>
                Revenu Generated
             </div>
             <div class="clearFix"></div>
       </div>
</div>
    <!-- Main Content  section Ends -->


    <?php include('Partial/footer.php'); ?>