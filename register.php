<?php
include 'db.php';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
   
   
    $sql="insert into users(first_name,last_name,email,password,gender,age) values('$fname','$lname','$email','$password','$gender','$age')";
        

        if(mysqli_query($conn,$sql)){
      
           header("Location: user.html");
            exit();
        } else {
          
            echo "Error";
        }

       
   


$conn->close();
?>
