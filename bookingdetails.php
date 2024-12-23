<?php

include 'db.php';


$res = "SELECT * FROM bookings";
$result = mysqli_query($conn, $res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Booking Details</h2>
    <table>
        <tr>
            <th>User Email</th>
            <th>Vehicle Number</th>
            <th>Check-in DateTime</th>
            <th>Check-out DateTime</th>
            <th>Rent Per Hour</th>
            <th>Total Rent</th>
        </tr>
        <?php
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['user_email'] . "</td>";
            echo "<td>" . $row['vehicle_number'] . "</td>";
            echo "<td>" . $row['check_in'] . "</td>";
            echo "<td>" . $row['check_out'] . "</td>";
            echo "<td>" . $row['rent_per_hour'] . "</td>";
            echo "<td>" . $row['total_rent'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

<?php

mysqli_close($conn);

?>
