<?php

include 'db.php';
$num=$_GET["carNumber"];
$sql="delete from cars where number='$num'";
if(mysqli_query($conn,$sql)){
      
    header("Location: cardetails.php");
     exit();
 } else {
   
     echo "Error";
 }

?>