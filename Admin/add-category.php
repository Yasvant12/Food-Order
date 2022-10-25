<?php include('Partial/menu.php'); ?>

<div class="main-content">
<div class="wrapper">
<h1>Add Category</h1>
<br><br>


    <?php
          if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset( $_SESSION['add']);

          }
          if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset( $_SESSION['upload']);

          }
     


     ?>
     <br><br>
<!-- Add Category form  -->


<form action="" method="POST" enctype="multipart/form-data">
<table class="tbl-30">
    <tr>
        <td>Title:    </td>
        <td> <input type="text" name="title" placeholder="Category title"></td>
    </tr>

    <tr>
        <td>Select_Image:  </td>
        <td> 
        <input type="file" name="image" > 
        </td>
    </tr>

    <tr>
        <td>Featured:</td>
        <td> <input type="radio" name="featured" value="Yes">Yes
        <input type="radio" name="featured" value="Yes">No</td>
    </tr>

    <tr>
        <td>Active:</td>
        <td> <input type="radio" name="Active" value="Yes">Yes
        <input type="radio" name="Active" value="Yes">No</td>
    </tr>
   <tr>
    <td colspan="2">
        <input type="submit" name="submit" value="Add Category" class="btn-secondary">

    </td>
  </tr>
</table>



</form>
<!-- Add category from ends -->


<?php
    if(isset($_POST['submit']))
    {


        $title=$_POST['title'];

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


       if(isset($_POST['Active']))
       {

              $Active=$_POST['Active'];

       }
       else
       {
            //setting the default value

           $Active="No";
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

                     $image_name="Food_category_".rand(000,999).'.'.$ext;





                     $source_path=$_FILES['image']['tmp_name'];

                      $destination_path="../images/category/".$image_name;

                      //Finally upload the image
                      $upload=move_uploaded_file( $source_path, $destination_path);
                    //check weather the image is uploaded or not
                    //and if the image is not uploaded then we will stop the process and redirect with error message
                     if($upload==False)
                    {
                          //set message
                            $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                            header("location:".SITEURL.'Admin/add-category.php');
                            die();
                      }

                    }
      
                    }

                 else
       {
          //dont't upload image and set image_name as blank
          $image_name="";

     }
     

      $sql = "INSERT INTO category_tbl SET
           title=' $title',
           image_name='$image_name',
           featured='$featured',
           active='$Active'
           ";

     // Executing query and saving data into database

      $data=mysqli_query($conn, $sql) or die(mysqli_error());

       if ($data==TRUE) 
       {
            $_SESSION['add']="<div class='sucess'>CATEGORY ADDED SUCESSFULLY</div>";
            //REDIRECT PAGE TO MAIN PAGE
             header("location:".SITEURL.'Admin/manage-category.php');
            // header("location:".SETURL.'Admin/manage-admin.php');
        }
        else
        {


         $_SESSION['add']="<div class='error'>FAILED TO ADD Category</div>";
         //REDIRECT PAGE TO Add Admin
          header("location:".SITEURL.'Admin/add-category.php');
           // header("location:".SETURL.'Admin/manage-admin.php');

    }
$conn->close();
 }



?>



</div>
</div>
<?php include('Partial/footer.php'); ?>