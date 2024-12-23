<!DOCTYPE html>
<html>
<head>
    <title>Update Car</title>
</head>
<body>
    <?php
   
    include 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $carNumber = $_POST['carNumber'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $seatingCapacity = $_POST['seatingCapacity'];
        $rent = $_POST['rent'];
        $category = $_POST['cars'];
        $description = $_POST['description'];
        $img = $_POST['img'];

       
        $sql = "UPDATE cars SET name='$brand', model='$model', seating_capacity='$seatingCapacity', rent='$rent', description='$description', category='$category', image='$img' WHERE number='$carNumber'";
        
        if(mysqli_query($conn,$sql))
        {
            header("Location: cardetails.php");
            exit();
        }
    } else {
       
        echo "<p>Invalid request.</p>";
    }

   
    $conn->close();
    ?>
</body>
</html>
