<?php
session_start();

// Create constant to store  Non Repeating value
define('SITEURL','http://localhost/res/');
define('LOCALHOST','localhost');
define('USERNAME','root');
define('PASSWORD','');
define('DBNAME','food-order');
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "res";

// Create connection
    $conn = mysqli_connect(LOCALHOST, USERNAME, PASSWORD, DBNAME);
// Check connection
if (!$conn) {
  die("Connection failed: " .  mysqli_connect_error());
}
?>
