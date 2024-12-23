<?php
if(isset($_COOKIE['user']))
{
session_start();
include 'db.php';
$userEmail = $_SESSION["email"] ?? "";

$license = "";
$date = null;
$isVerified = false;

try {
   
    $selectQuery = "SELECT AGE, LICENSE, EXPIRATION_DATE FROM USERS WHERE EMAIL='$userEmail'";
    $result = $conn->query($selectQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ageStr = $row["AGE"];
        $license = $row["LICENSE"];
        $date = $row["EXPIRATION_DATE"];
        $age = intval($ageStr);
        
       
        $currentDate = date("Y-m-d");
        if ($date > $currentDate && $age >= 18) {
            $isVerified = true;
        }
    }

   
    if ($isVerified) {
        $updateQuery = "UPDATE USERS SET VERIFIED='Yes' WHERE EMAIL='$userEmail'";
    } else {
        $updateQuery = "UPDATE USERS SET VERIFIED='No' WHERE EMAIL='$userEmail'";
    }
    $conn->query($updateQuery);
  
    header("Location: profile.php");
    exit();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$conn->close();
}
?>
