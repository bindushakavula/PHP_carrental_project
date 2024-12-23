<?php
if(isset($_COOKIE['user']))
{
session_start();
include 'db.php';
$userEmail = $_SESSION["email"] ?? null;
$username = "";

if ($userEmail != null) {
    $username = substr($userEmail, 0, strpos($userEmail, "@"));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>My Bookings</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">RentACar</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    Welcome, <?php echo $username; ?>! <span class="sr-only">(current)</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center">My Bookings</h2>
    <?php
   $query = "SELECT * FROM BOOKINGS, CARS WHERE CARS.number = BOOKINGS.vehicle_number AND BOOKINGS.USER_EMAIL = ?";
   $stmt = $conn->prepare($query);
   if (!$stmt) {
       die("Error: " . $conn->error);
   }
   
   $stmt->bind_param("s", $userEmail);
   if (!$stmt->execute()) {
       die("Error executing query: " . $stmt->error);
   }
   
   $result = $stmt->get_result();
   if (!$result) {
       die("Error getting result: " . $stmt->error);
   }
   
   
   

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $email = $row["user_email"];
            $vnum = $row["vehicle_number"];
            $name = $row["name"];
            $model = $row["model"];
            $img = $row["image"];
            $checkin = $row["check_in"];
            $checkout = $row["check_out"];
            $rent = $row["rent_per_hour"];
            $totalrent = $row["total_rent"];
            ?>
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <img src="<?php echo $img; ?>" class="card-img" alt="Car Image" style="height: 300px; object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $name . " " . $model; ?></h5>
                            <p class="card-text"><strong>Vehicle Number:</strong> <?php echo $vnum; ?></p>
                            <p class="card-text"><strong>Check In:</strong> <?php echo $checkin; ?></p>
                            <p class="card-text"><strong>Check Out:</strong> <?php echo $checkout; ?></p>
                            <p class="card-text"><strong>Rent Per Hour:</strong> <?php echo $rent; ?></p>
                            <p class="card-text"><strong>Total Rent:</strong> <?php echo $totalrent; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p class='text-center'>No bookings found.</p>";
    }
    $stmt->close();
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php

$conn->close();
}
?>
