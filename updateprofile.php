<?php
if(isset($_COOKIE['user']))
{
session_start();
include 'db.php';
$userEmail = $_SESSION["email"] ?? null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $license = $_POST["license"];
    $dateStr = $_POST["verificationDate"];

    $date = date("Y-m-d", strtotime($dateStr));

    
    $updateQuery = "UPDATE USERS SET first_name=?, last_name=?, GENDER=?, AGE=?, LICENSE=?, EXPIRATION_DATE=? WHERE EMAIL=?";
    $stmt = $conn->prepare($updateQuery);
    if (!$stmt) {
        die("Error: " . $conn->error); 
    }
    
    $stmt->bind_param("sssssss", $fname, $lname, $gender, $age, $license, $date, $userEmail);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: validate.php");
        exit();
    } else {
        echo "<p>Failed to update user details.</p>";
    }

    $stmt->close();
    $conn->close();
}
}
?>
