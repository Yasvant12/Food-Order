
<?php include('../config/const.php'); ?>
<?php include('Partial/menu.php'); ?>


<?php
    
    $id=$_GET['id'];

$query = "DELETE FROM admin__tbl  WHERE id='$id' ";

$data=mysqli_query($conn, $query);

if($data==True){

//creating session variable to Display message
$_SESSION['delete']="<div class='sucess'>Admin deleted sucessfully.</div>";

//Redirect to manage admin page
header("location:".SITEURL.'Admin/manage-admin.php');


}else{
   

//creating session variable to Display message
$_SESSION['delete']="<div class='error'>Fail to delete admin ! Try again later./div>";
//Redirect to manage admin page
header("location:".SITEURL.'Admin/manage-admin.php');


}



?>