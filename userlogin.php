<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
       
        if (mysqli_num_rows($result) > 0) {
           
            $row = mysqli_fetch_assoc($result);
            $fname = $row['first_name'];
            $lname = $row['last_name'];
            $age = $row['age'];
            $gender = $row['gender'];

            setcookie("user",$email,time()+3600,"/","",0);
         
            session_start();
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['email'] = $email;
            $_SESSION['age'] = $age;
            $_SESSION['gender'] = $gender;

            header("Location: userhomepage.php");
            exit();
        } else {
        
            $_SESSION['userErrorMessage'] = "Invalid email or password. Please try again.";
            header("Location: user.jsp");
            exit();
        }
    } else {
      
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
   
    header("Location: user.jsp");
    exit();
}

mysqli_close($conn);
?>
