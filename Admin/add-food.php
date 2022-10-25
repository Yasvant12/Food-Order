<?php include('Partial/menu.php'); ?>
<div class=" Main-Content ">
       <div class="wrapper">
              <h1>Add food</h1>
              <br><br>
              <?php
                  if(isset($_SESSION['upload']))
                  {
                     echo $_SESSION['upload'];
                     unset($_SESSION['upload']);
                    }

              ?>
              <br><br>
              <form action="" method="POST" enctype="multipart/form-data">
             <table class="tbl-30">

                      <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder="Title of the food"></td>
                       </tr>

                       <tr>
                        <td>Description: </td>
                        <td><textarea name="description"  cols="30" rows="5" placeholder="Description of the Food."></textarea></td>
                       </tr>

                       <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price"></td>
                       </tr>

                       <tr>
                        <td>Select_Image: </td>
                        <td><input type="file" name="image"></td>
                       </tr>

                       <tr>
                        <td>Category: </td>
                        <td><select name="category">
                               <?php
                                    //create PHP code to display category from Database
                                    //1. create SQL to get alll active categories from database
                                    $sql="SELECT *FROM category_tbl WHERE active='Yes'";
                                    $res=mysqli_query($conn,$sql);
                                    $count=mysqli_num_rows($res);
                                    //IF count is greater than zero, we have category else we do not have categories
                                    if($count>0)
                                    {
                                        //WE have category
                                        while($rows=mysqli_fetch_assoc($res))
                                        {
                                            $id=$rows['id'];
                                            $title=$rows['title'];
                                             ?>
                                            <option value="<?php echo $id;   ?>"> <?php  echo $title; ?></option>

                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        //WE DO NOT HAVE CATEGORY
                                        ?>
                                           <option value="0">No Cate Found</option>
                                        <?php

                                     

                                    }
                                   

                               ?>
                           
                        </select></td>
                       </tr>

                       <tr>
                        <td>Featured: </td>
                        <td><input type="radio" value="Yes" name="featured">Yes
                       <input type="radio" value="No" name="featured">No</td>
                       </tr>

                       <tr>
                        <td>Active: </td>
                        <td><input type="radio" value="Yes" name="active">Yes
                        <input type="radio" value="No" name="active">No</td>
                       </tr>
                         <tr>
                            <td colspan="2">

                            <input type="submit" name="submit" value="Add food" class="btn-primary">
                            </td>
                         </tr>

                 </table>
              </form>

<?php
    if(isset($_POST['submit']))
    {


        $title=$_POST['title'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $category=$_POST['category'];

       //For Radio button, we check weather the button is selected or not 

       if(isset($_POST['featured']))
       {

              $featured=$_POST['featured'];

       }
       else
       {
            //setting the default value

           $featured="No";
       }


       if(isset($_POST['active']))
       {

              $active=$_POST['active'];

       }
       else
       {
            //setting the default value

           $active="No";
       }
        //Uploading the image 
        //Check weather the image is selected or not set the value for image name accordingly
        if(isset($_FILES['image']['name']))
       {
        //to upload image we nedd image,source path and destinition path
        $image_name=$_FILES['image']['name'];
        if($image_name!=""){

                     //Auto rename our image
                 //Get the extension of our image (jpg,png,gf etc)
                     $ext=end(explode('.', $image_name));

                     $image_name="Food_name_".rand(0000,9999).'.'.$ext;//new image name may be "food-name-657"






                     $source_path=$_FILES['image']['tmp_name'];

                      $destination_path="../images/Food/".$image_name;

                      //Finally upload the image
                      $upload=move_uploaded_file( $source_path, $destination_path);
                    //check weather the image is uploaded or not
                    //and if the image is not uploaded then we will stop the process and redirect with error message
                     if($upload==False)
                    {
                          //set message
                            $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                            header("location:".SITEURL.'Admin/add-food.php');
                            die();
                      }

                    }
      
                    }

                 else
       {
          //dont't upload image and set image_name as blank
          $image_name="";

     }
     

      $sql2 = "INSERT INTO food_tbl SET
           title=' $title',
           description='$description',
           price='$price',
           image_name='$image_name',
           category_id='$category',
           featured='$featured',
           active='$active'
           ";

     // Executing query and saving data into database

      $data=mysqli_query($conn, $sql2) or die(mysqli_error());

       if ($data==TRUE) 
       {
            $_SESSION['add']="<div class='sucess'>FOOD ADDED SUCESSFULLY</div>";
            //REDIRECT PAGE TO MAIN PAGE
             header("location:".SITEURL.'Admin/manage-food.php');
            // header("location:".SETURL.'Admin/manage-admin.php');
        }
        else
        {


         $_SESSION['add']="<div class='error'>FAILED TO ADD Category</div>";
         //REDIRECT PAGE TO Add Admin
          header("location:".SITEURL.'Admin/add-food.php');
           // header("location:".SETURL.'Admin/manage-admin.php');

    }
$conn->close();
 }



?>





























</div>
</div>





<?php include('Partial/footer.php'); ?>