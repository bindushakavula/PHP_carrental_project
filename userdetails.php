<?php
include 'db.php';
$res="select * from users;";
$result=mysqli_query($conn,$res);


?>

<table border='5'>
<tr>
<th>First name</th>
<th>Last Name</th>
<th>Email</th>
<th>Gender</th>
<th>Age</th>

</tr><tr>
<?php

while($row=mysqli_fetch_assoc($result))
{



?>
<td><?php echo $row['first_name']; ?></td>
<td><?php echo $row['last_name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['gender']; ?></td>
<td><?php echo $row['age']; ?></td>
</tr>
<?php

}
?>
</table>
</center>