<?php
session_start();

$admin_username = "bindusha@gmail.com";
$admin_password = "bindu";

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === $admin_username && $password === $admin_password) {
        
        $_SESSION["adminEmail"] = $email; 
        header("Location: admindashboard.php");
        exit();
    } else {
        $_SESSION["adminErrorMessage"] = "Invalid admin credentials";
        header("Location: adminlogin.php"); 
        exit();
    }
} else {
    echo "Invalid request!";
}
?>
