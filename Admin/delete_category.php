
<?php include('../config/const.php'); ?>



<?php
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
           $id=$_GET['id'];
           $image_name=$_GET['image_name'];
           //remove physical image file availble 
           if($image_name!="")
           {
                  $path="../images/category/".$image_name;
                  //remove image
                  $remove=unlink( $path);
                  //if fail to remove then add and error message and stop the process

                  if($remove==FALSE)
                  {
                      $_SESSION['remove']="<div class='error'>Failed to Remove an image.</div>";
                      header("location:".SITEURL.'Admin/manage-category.php');
                      //stop the process
                     die();

                  }

              }
        //delete data from the database
        $query = "DELETE FROM category_tbl  WHERE id='$id' ";
        $data=mysqli_query($conn, $query);
          
        
          if($data==True){

             //creating session variable to Display message
             $_SESSION['delete-category']="<div class='sucess'>category  deleted sucessfully.</div>";

             //Redirect to manage admin page
               header("location:".SITEURL.'Admin/manage-category.php');


             }else
             {
   

                 //creating session variable to Display message
                  $_SESSION['delete-category']="<div class='error'>Fail to delete category ! Try again later./div>";
                 //Redirect to manage admin page
                 header("location:".SITEURL.'Admin/manage-category.php');


             }

    }
    else
    {
        //redirect to manage-category page
        $_SESSION['delete-category']="<div class='error'>Fail to delete category ! Try again later.</div>";
        header("location:".SITEURL.'Admin/manage-category.php');

    }

?>
