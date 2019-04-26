<?php
//this is the database that is used
$conn = mysqli_connect("localhost","root","","cookies");
 
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>