<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "connectdb";
$port = 3307;
$conn = mysqli_connect($servername, $username, $password,$dbname,$port);

if(!$conn)
{
   die("Cannot connect to database".mysqli_connect_error());
}

?>

  