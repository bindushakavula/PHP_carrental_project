<?php

$servername="localhost";
$username="root";
$password="";
$dbname="carrentalphp";
$conn=mysqli_connect($servername,$username,$password,"carrentalphp");
if(!$conn)
{
echo "connection not established";
}

?>