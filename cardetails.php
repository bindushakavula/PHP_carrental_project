<?php
include 'db.php';
$res="select * from cars;";
$result=mysqli_query($conn,$res);


?>

<table border='5'>
<tr>
<th>Name</th>
<th>Model</th>
<th>Number</th>
<th>Seating Capacity</th>
<th>Rent</th>
<th>Description</th>
<th>Category</th>
<th>Image Path</th>
</tr><tr>
<?php

while($row=mysqli_fetch_assoc($result))
{



?>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['model']; ?></td>
<td><?php echo $row['number']; ?></td>
<td><?php echo $row['seating_capacity']; ?></td>
<td><?php echo $row['rent']; ?></td>
<td><?php echo $row['description']; ?></td>
<td><?php echo $row['category']; ?></td>
<td><?php echo $row['image']; ?></td>
<td><a href="editcar.php?carNumber=<?php echo $row['number']; ?>&vname=<?php echo $row['name']; ?>&vmodel=<?php echo $row['model']; ?>&scapacity=<?php echo $row['seating_capacity']; ?>&rent=<?php echo $row['rent']; ?>&description=<?php echo $row['description']; ?>&category=<?php echo $row['category']; ?>&image_path=<?php echo $row['image']; ?>">Edit</a></td>
<td><a href="deletecar.php?carNumber=<?php echo $row['number']; ?>&vname=<?php echo $row['name']; ?>&vmodel=<?php echo $row['model']; ?>&scapacity=<?php echo $row['seating_capacity']; ?>&rent=<?php echo $row['rent']; ?>&description=<?php echo $row['description']; ?>&category=<?php echo $row['category']; ?>&image_path=<?php echo $row['image']; ?>">Delete</a></td>
</tr>
<?php

}
?>
</table>
</center>