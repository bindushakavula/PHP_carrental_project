<?php
if(isset($_COOKIE['user']))
{
session_start();
$userEmail = $_SESSION["email"] ?? null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <script src="https://kit.fontawesome.com/15d438045a.js" crossorigin="anonymous"></script>
    <style>
       input {
        width:300px;
        padding: 10px 10px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #f8f4f4;
        border-radius: 5px;
        box-sizing: border-box;
        font-size:18px;
        }
        input[type=submit] {
        width: 55%;
        background-color: #4CAF50;
        color: white;
        padding: 10px 14px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        }
        input[type=submit]:hover {
        background-color: #45a049;
        }

        .update {
        border-radius: 15px;
        padding: 20px;
        width:700px;
        background-color: rgb(243, 242, 242);
        }
        .update {
        display:inline-block;
        }
        label{
        font-size: 20px;
        margin-left: -200px;
        }
        .left{
        float:left;
        width:350px;
        }
    </style>
</head>
<body>
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
    ?>
    <br><br>
    <center>
    <div class="update">
    <form action="updateprofile.php" method="post">
        <div class="left">
        <label for="fname" style="margin-left: -200px;">First Name:</label><br>
        <input type="text" id="fname" name="fname" value="<?php echo $fname; ?>"><br></div>
        <div class="left">
        <label for="lname" style="margin-left: -200px;">Last Name:</label><br>
        <input type="text" id="lname" name="lname" value="<?php echo $lname; ?>"><br></div><br>
        <div class="left">
        <label for="email" style="margin-left: -230px;">Email:</label><bR>
        <input type="text" id="email" name="email" value="<?php echo $userEmail; ?>" readonly><br></div>
        <div class="left">
        <label for="gender" style="margin-left: -230px;">Gender:</label><br>
        <input type="text" id="gender" name="gender" value="<?php echo $gender; ?>"><br></div><br>
        <div class="left">
        <label for="age" style="margin-left: -250px;">Age:</label><br>
        <input type="text" id="age" name="age" value="<?php echo $age; ?>"><br></div>
        <div class="left">
        <label for="license" style="margin-left: -90px;">Driving License Number:</label><br>
        <input type="text" id="license" name="license" value="<?php echo $license; ?>"><br></div>
        <div class="left">
        <label for="verificationDate" style="margin-left:-150px;">Expiration Date:</label><br>
        <input type="date" id="verificationDate" name="verificationDate" value="<?php echo $date; ?>"></div>
            
        <input type="submit" value="Update">
    </form>
    </div></center>
    <?php
    }
    $stmt->close();
    $conn->close();
}
    ?>
</body>
</html>
