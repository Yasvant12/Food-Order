<?php include('Partial/menu.php'); ?>


<div class="main-content">
<div class="wrapper">
<h1>Update Food</h1>
<br><br>

    <?php

            if(isset($_GET['id'])){

                 $id=$_GET['id'];
                 $sql="SELECT *FROM food_tbl WHERE id= $id";
                 $res=mysqli_query($conn,$sql);
                 $count=mysqli_num_rows($res);
                 if($count==1){
                    //Then u get all the data
                    $row=mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $current_image=$row['image_name'];
                    $current_category=$row['category_id'];
                    $featured=$row['featured'];
                    $active=$row['active'];

                 }else{

                    //redirct to manage category
                     $_SESSION['no-category-found']="<div class='error'>Category not Found.</div>";
                     header("location:".SITEURL.'Admin/manage-food.php');
                 }

            }else{

                //redirect to manage category
               // $_SESSION['remove']="<div class='error'>Failed to Remove an image.</div>";
                header("location:".SITEURL.'Admin/manage-food.php');

            }

    ?>



<form action="" method="POST" enctype="multipart/form-data">
     <table class="tbl-30">
        <tr>
                <td>Title:    </td>
                 <td> <input type="text" name="title" value="<?php echo $title ?>"></td>
         </tr>



        <tr>
            <td>Description: </td>
            <td><textarea name="description"  cols="30" rows="5" ><?php echo $description; ?></textarea></td>
         </tr>

        <tr>
         <td>Price: </td>
         <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
        </tr>



        <tr>
                <td>Current_Image:  </td>
                 <td>
            
             <?php

                 if( $current_image!="")
                 {
                     ?>
                        <img src="<?php echo SITEURL; ?>images/Food/<?php echo $current_image; ?>" width="60px"> 
                     <?php
 
                 }
                 else
                 {

                     echo "<div class='error'>Image not Found</div>";
                 }

                 ?>
                    <!-- <input type="file" name="image" >  -->
            </td>
         </tr>

            <tr>
                 <td>New_Image:  </td>
            <td> 
                <input type="file" name="image" > 
            </td>
         </tr>
                   <tr>
                        <td>Category: </td>
                        <td><select name="category">
                               <?php
                                    //create PHP code to display category from Database
                                    //1. create SQL to get alll active categories from database
                                    $sql3="SELECT *FROM food_tbl WHERE active='Yes'";
                                    $res4=mysqli_query($conn,$sql3);
                                    $count6=mysqli_num_rows($res4);
                                    //IF count is greater than zero, we have category else we do not have categories
                                    if($count6>0)
                                    {
                                        //WE have category
                                        while($rows4=mysqli_fetch_assoc($res4))
                                        {
                                            $c_id=$rows4['id'];
                                            $c_title=$rows4['title'];
                                             ?>
                                            <option <?php   if($current_category==$c_id) echo"selected";   ?>value="<?php echo $c_id;   ?>"> <?php  echo $c_title; ?></option>

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
        <td>Featured:</td>
        <td> <input <?php if( $active=='Yes'){echo "checked";}   ?>  type="radio" name="featured" value="Yes">Yes
        <input <?php if( $active=='No'){echo "checked";}    ?> type="radio" name="featured" value="No">No</td>
    </tr>

    <tr>
        <td>Active:</td>
        <td> <input  <?php if($featured=='Yes'){echo "checked";}   ?> type="radio" name="Active" value="Yes">Yes
        <input type="radio" name="Active" value="Yes">No</td>
    </tr>
   <tr>
    <td colspan="2">
        <input type="hidden" name="current_image" value="<?php  echo $current_image; ?>">
        <input type="hidden" name="id" value="<?php echo $id   ?>">
        <input type="submit" name="submit" value="Update Food" class="btn-secondary">

    </td>
  </tr>
</table>



</form>
<?php
if(isset($_POST['submit'])){
  $id=$_POST['id'];
  $title=$_POST['title'];
  $description=$_POST['description'];
  $price=$_POST['price'];
  $current_image=$_POST['current_image'];
  $featured=$_POST['featured'];
  $active=$_POST['Active'];

  //Updating new image
            if(isset($_FILES['image']['name']))
             {
               
                $image_name=$_FILES['image']['name'];
                if($image_name!="")
                {
                         //Image Available
                        //Upload the new image
                         //Remove the current image

                          //Auto rename our image
                         //Get the extension of our image (jpg,png,gf etc)
                           $ext=end(explode('.', $image_name));

                           $image_name="Food_category_".rand(0000,9999).'.'.$ext;





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
                       header("location:".SITEURL.'Admin/manage-food.php');
                       die();
                       }
                          if($current_image!="")
                          {

                                 //Remove the current image if avilabe
                           $remove_path="../images/Food/".$current_image;
                           $remove=unlink($remove_path);
                           //check weather the image is delete or not
                           if($remove==FALSE)
                           {
                            $_SESSION['Failed-remove']="<div class='error'> Failed to remove the current image.</div>";
                            header("location:".SITEURL.'Admin/manage-food.php');
                            die();
                           }


                          }

                   }
                   else
                   {
                        $image_name=$current_image;
                   }
 
             }

             else
             {
                     //dont't upload image and set image_name as blank
                     $image_name=$current_image;

             }

  //update the database

   $sql2 = "UPDATE food_tbl SET
   title=' $title',
   description='$description',
   price='$price',
   image_name='$image_name',
   category_id='$category',
   featured='$featured',
   active='$active'
   WHERE id=$id
   ";



$data=mysqli_query($conn,$sql2);

if ($data==TRUE) 
{
      $_SESSION['update']="<div class='sucess'>CATEGORY UPDATED SUCESSFULLY</div>";
     //REDIRECT PAGE TO MAIN PAGE
      header("location:".SITEURL.'Admin/manage-food.php');
     // header("location:".SETURL.'Admin/manage-admin.php');
 }
 else
 {


  $_SESSION['update']="<div class='error'>FAILED TO UPDATE CATEGORY</div>";
  //REDIRECT PAGE TO Add Admin
   header("location:".SITEURL.'Admin/add-food.php');
    // header("location:".SETURL.'Admin/manage-admin.php');

}


}



?>
</div>
</div>

<?php include('Partial/footer.php'); ?>