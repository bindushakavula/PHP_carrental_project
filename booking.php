<?php
include 'db.php';
if(isset($_COOKIE['user']))
{
session_start();

if (!isset($_SESSION["email"])) {

    header("Location: login.php"); 
    exit(); 
}

$userEmail = $_SESSION["email"];
$username = substr($userEmail, 0, strpos($userEmail, "@"));



$vehicleNumber = $_POST["vehicleNum"];
$rentPerHour = $_POST["rentPerHour"];
$totalRent = $_POST["totalRent"];
$checkInDateTimeStr = $_POST["checkInDateTime"];
$checkOutDateTimeStr = $_POST["checkOutDateTime"];

try {
    
    $formattedCheckInDateTime = date("Y-m-d H:i:s", strtotime($checkInDateTimeStr));
    $formattedCheckOutDateTime = date("Y-m-d H:i:s", strtotime($checkOutDateTimeStr));

    $verifyQuery = "SELECT verified FROM users WHERE email = '$userEmail'";
    $verifyResult = $conn->query($verifyQuery);

    if ($verifyResult->num_rows > 0) {
        $row = $verifyResult->fetch_assoc();
        $verifiedStatus = $row["verified"];

      
        if ($verifiedStatus == "Yes") {
            
            $insertQuery = "INSERT INTO bookings (user_email, vehicle_number, check_in, check_out, rent_per_hour, total_rent) 
                            VALUES ('$userEmail', '$vehicleNumber', '$formattedCheckInDateTime', '$formattedCheckOutDateTime', '$rentPerHour', '$totalRent')";

           
            if ($conn->query($insertQuery) === TRUE) {
               
            } else {
               
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        } else {
            
            echo "<div class='confirmation-container'>";
            echo "<p class='error-message'>User verification failed. Please verify your account before booking.</p>";
            echo "</div>";
        }
    } else {
        
        echo "<div class='confirmation-container'>";
        echo "<p class='error-message'>User not found. Please register before booking.</p>";
        echo "</div>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
        }
        .card-body p {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Booking Confirmation</h5>
            </div>
            <div class="card-body">
                <p><strong>User Email:</strong> <?php echo $userEmail; ?></p>
                <p><strong>Vehicle Number:</strong> <?php echo $vehicleNumber; ?></p>
                <p><strong>Check-in DateTime:</strong> <?php echo $formattedCheckInDateTime; ?></p>
                <p><strong>Check-out DateTime:</strong> <?php echo $formattedCheckOutDateTime; ?></p>
                <p><strong>Rent Per Hour:</strong> <?php echo $rentPerHour; ?></p>
                <p><strong>Total Rent:</strong> <?php echo $totalRent; ?></p>
            </div>
        </div>
        <div class="alert alert-success" role="alert">
            <p class="mb-0">Your booking has been confirmed. Enjoy your trip!</p>
        </div>
        <a href="userhomepage.php" class="btn btn-primary">Go to Home Page</a>
    </div>
</body>
</html>
<?php
}
?>
