<?php include('Partial/menu.php'); ?>
   
   
<div class=" Main-Content ">
       <div class="wrapper2">
              <h1>Manage order</h1>

        <br><br>
        <?php
                 if(isset($_SESSION['update']))
                 {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                 }


        ?>
        <br><br>
              <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>qty</th>
                    <th>Total</th>
                    <th>order_date</th>
                    <th>status</th>
                    <th>customer_name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>

                </tr>
                <?php 
                $sql="SELECT *FROM order_tbl ORDER BY id DESC";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                $cnt=1;
                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id=$row['id'];
                        $food=$row['food'];
                        $price=$row['price'];
                        $qty=$row['qty'];
                        $total=$row['total'];
                        $order_date=$row['order_date'];
                        $status=$row['status'];
                        $customer_name=$row['customer_name'];
                        $customer_contact=$row['customer_contact'];
                        $customer_email=$row['customer_email'];
                        $customer_address=$row['customer_address'];
                        ?>
                            <tr>
                               <td><?php echo $cnt++;?></td>
                                <td><?php echo $food;?></td>
                                <td>₹<?php echo $price;?></td>
                                <td><?php echo  $qty;?></td>
                                <td><?php echo  $total;?></td>
                                <td><?php echo   $order_date;?></td>
                                <td>
                                    <?php
                                   echo $status;
                                    ?>
                            
                            </td>
                                <td><?php echo  $customer_name; ?></td>
                                <td><?php echo  $customer_contact; ?></td>
                                <td><?php echo   $customer_email; ?></td>
                                <td><?php echo $customer_address;?></td>
                                <td>
                                <a href="<?php  echo SITEURL; ?>Admin/Update-order.php?id=<?php echo $id?>" class="btn-secondary2">Update Order</a>
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
                ?>
              </table>



             <div class="clearFix"></div>
       </div>
</div>

   
   
   <?php include('Partial/footer.php'); ?>