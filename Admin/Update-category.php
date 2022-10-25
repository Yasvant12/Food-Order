<?php include('Partial/menu.php'); ?>


<div class="main-content">
<div class="wrapper">
<h1>Update Category</h1>
<br><br>

    <?php

            if(isset($_GET['id'])){

                 $id=$_GET['id'];
                 $sql="SELECT *FROM category_tbl WHERE id= $id";
                 $res=mysqli_query($conn,$sql);
                 $count=mysqli_num_rows($res);
                 if($count==1){
                    //Then u get all the data
                    $row=mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $current_image=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];

                 }else{

                    //redirct to manage category
                     $_SESSION['no-category-found']="<div class='error'>Category not Found.</div>";
                     header("location:".SITEURL.'Admin/manage-category.php');
                 }

            }else{

                //redirect to manage category
               // $_SESSION['remove']="<div class='error'>Failed to Remove an image.</div>";
                header("location:".SITEURL.'Admin/manage-category.php');





            }

    ?>



<form action="" method="POST" enctype="multipart/form-data">
<table class="tbl-30">
    <tr>
        <td>Title:    </td>
        <td> <input type="text" name="title" value="<?php echo $title ?>"></td>
    </tr>

    <tr>
        <td>Current_Image:  </td>
        <td>
            
        <?php

        if( $current_image!="")
        {
            ?>
            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="60px"> 
          <?php
 
        }else{

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
        <input type="submit" name="submit" value="Update Category" class="btn-secondary">

    </td>
  </tr>
</table>



</form>
<?php
if(isset($_POST['submit'])){
  $id=$_POST['id'];
  $title=$_POST['title'];
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
                       header("location:".SITEURL.'Admin/manage-category.php');
                       die();
                       }
                          if($current_image!="")
                          {

                                 //Remove the current image if avilabe
                           $remove_path="../images/category/".$current_image;
                           $remove=unlink($remove_path);
                           //check weather the image is delete or not
                           if($remove==FALSE)
                           {
                            $_SESSION['Failed-remove']="<div class='error'> Failed to remove the current image.</div>";
                            header("location:".SITEURL.'Admin/manage-category.php');
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
  $sql2="UPDATE category_tbl SET
  title='$title',
  image_name='$image_name',
  featured='$featured',
  active='$active'
  WHERE id='$id'
  
  ";


$data=mysqli_query($conn,$sql2);

if ($data==TRUE) 
{
      $_SESSION['update']="<div class='sucess'>CATEGORY UPDATED SUCESSFULLY</div>";
     //REDIRECT PAGE TO MAIN PAGE
      header("location:".SITEURL.'Admin/manage-category.php');
     // header("location:".SETURL.'Admin/manage-admin.php');
 }
 else
 {


  $_SESSION['update']="<div class='error'>FAILED TO UPDATE CATEGORY</div>";
  //REDIRECT PAGE TO Add Admin
   header("location:".SITEURL.'Admin/add-category.php');
    // header("location:".SETURL.'Admin/manage-admin.php');

}


}



?>

















</div>
</div>

<?php include('Partial/footer.php'); ?>