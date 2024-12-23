<?php
session_start();
if(isset($_COOKIE['user']))
{

if (!isset($_SESSION["email"])) {
    
    header("Location: user.php");
    exit(); 
}

$userEmail = $_SESSION["email"];

include 'db.php';

$vehicleNum = $_GET['vnum'] ?? '';
$rentPerHour = $_GET['rent'] ?? '';

if (!empty($vehicleNum) && !empty($rentPerHour)) {
   
    $verifyQuery = "SELECT verified FROM users WHERE email = ?";
    $verifyStmt = $conn->prepare($verifyQuery);
    $verifyStmt->bind_param("s", $userEmail);
    $verifyStmt->execute();
    $verifyResult = $verifyStmt->get_result();

    if ($verifyResult->num_rows > 0) {
        $user = $verifyResult->fetch_assoc();
        if ($user['verified'] === 'Yes') {
            $carQuery = "SELECT * FROM cars WHERE number = ?";
            $carStmt = $conn->prepare($carQuery);
            $carStmt->bind_param("s", $vehicleNum);
            $carStmt->execute();
            $carResult = $carStmt->get_result();

            if ($carResult->num_rows > 0) {
                $car = $carResult->fetch_assoc();
                $name = $car["name"];
                $model = $car["model"];
                $scapacity = $car["seating_capacity"];
                $description = $car["description"];
                $img = $car["image"];
                ?>

                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Rent Car</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
                </head>
                <body>
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="<?php echo $img; ?>" alt="Car Image" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h2><?php echo $name . " " . $model; ?></h2>
                            <p>Vehicle Number: <?php echo $vehicleNum; ?></p>
                            <p>Seating Capacity: <?php echo $scapacity; ?></p>
                            <p>Rent per hour: <?php echo $rentPerHour; ?></p>
                            <form action="booking.php" method="POST">
                                <input type="hidden" name="vehicleNum" value="<?php echo $vehicleNum; ?>">
                                <input type="hidden" name="rentPerHour" value="<?php echo $rentPerHour; ?>">
                                <div class="form-group">
                                    <label for="checkInDateTime">Check-in Date and Time:</label>
                                    <input type="datetime-local" id="checkInDateTime" name="checkInDateTime" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="checkOutDateTime">Check-out Date and Time:</label>
                                    <input type="datetime-local" id="checkOutDateTime" name="checkOutDateTime" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="totalRent">Total Rent:</label>
                                    <input type="text" id="totalRent" name="totalRent" class="form-control" readonly>
                                </div>
                                <button type="button" onclick="calculateRent()" class="btn btn-primary">Calculate Rent</button>
                                <button type="submit" class="btn btn-primary">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    function calculateRent() {
                        var checkInDateTime = new Date(document.getElementById("checkInDateTime").value);
                        var checkOutDateTime = new Date(document.getElementById("checkOutDateTime").value);
                        var rentPerHour = <?php echo $rentPerHour; ?>;

                        var timeDiff = checkOutDateTime.getTime() - checkInDateTime.getTime();
                        var hours = Math.ceil(timeDiff / (1000 * 60 * 60));
                        var totalRent = hours * rentPerHour;

                        document.getElementById("totalRent").value = totalRent;
                    }
                </script>
                </body>
                </html>

                <?php
            } else {
                echo "Car details not found.";
            }
        } else {
            header("Location: profile.php");
            exit();
        }
    } else {
        echo "User details not found.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
}
?>

