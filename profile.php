<?php
if(isset($_COOKIE['user']))
{
session_start();
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
    <title>My Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ea4f812ebc.js" crossorigin="anonymous"></script>
    <style>
         body {
            background-color: #fbfaf7;
            font-family: Arial, sans-serif;
        }

        .card {
            max-width: 500px;
            margin: 20px auto;
            padding: 50px;
            background-color: #f0eeee;
            border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .card-text {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .btn-edit-profile {
            background-color: #fafbfb;
            color: black;
            border: 1px solid black;
        }
        .btn-edit-profile:hover {
            background-color: #ebecec;
        }

        .fa-circle-user {
            color: #c8c1c1;
            font-size: 100px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">RentACar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="userhomepage.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profile.php">My Profile <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="userbookings.php">My Bookings <span class="sr-only">(current)</span></a>
                </li>
            </ul>
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

<?php 

include 'db.php';
$stmt = $conn->prepare("SELECT * FROM USERS WHERE EMAIL=?");
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $fname = $row["first_name"];
    $lname = $row["last_name"];
    $email = $row["email"];
    $gender = $row["gender"];
    $age = $row["age"];
    $license = $row["license"];
    $date = $row["expiration_date"];
    $verified = $row["verified"];
?>

<div class="container">
    <div class="card">
        <div class="row">
            <div class="col-6">
                <i class="fa-solid fa-circle-user"></i>
            </div>
            <div class="col-6" style="margin-top: 50px;">
                <a href="editprofile.php" class="btn btn-edit-profile">Edit Profile</a>
            </div>
        </div>
        
        <div class="card-body">
            <h3 class="card-title">Name : <?php echo $fname . " " . $lname; ?></h3>
            <h4 class="card-text">Email : <?php echo $email; ?></h4>
            <h4 class="card-text">Gender : <?php echo $gender; ?></h4>
            <h4 class="card-text">Age : <?php echo $age; ?></h4>
            <?php if ($license != null && $date != null) { ?>
                <h4 class="card-text">Driving License Number: <?php echo $license; ?></h4>
                <h4 class="card-text">Expiration Date: <?php echo $date; ?></h4>
                <h4 class="card-text">Verified: <?php echo $verified; ?></h4>
            <?php } ?>
            <p><a href="userhomepage.php" style="color:black;text-decoration: none;"><span style="font-weight: bold;">Click here</span>
            </a>to go to home page.</p>
            </div>
    </div>
</div>

<?php
}
$stmt->close();
$conn->close();
}
?>

</body>
</html>

