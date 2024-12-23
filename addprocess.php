<?php
include 'db.php';

    $brand = $_POST['name'];
    $model = $_POST['model'];
    $carNumber = $_POST['number'];
    $seatingCapacity = $_POST['seating'];
    $rent = $_POST['rent'];
    $description = $_POST['description'];
    $category = $_POST['cars'];
    $img=$_POST['img'];
   
    $sql="insert into cars(name,model,number,seating_capacity,rent,description,category,image) values('$brand','$model','$carNumber','$seatingCapacity','$rent','$description','$category','$img')";
        

        if(mysqli_query($conn,$sql)){
      
           header("Location: cardetails.php");
            exit();
        } else {
          
            echo "Error";
        }

       
   


$conn->close();
?>
