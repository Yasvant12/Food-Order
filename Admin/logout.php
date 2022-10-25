<?php
include('../config/const.php');


session_destroy();//unset $_session['user']

header("location:".SITEURL.'Admin/login.php');


?>