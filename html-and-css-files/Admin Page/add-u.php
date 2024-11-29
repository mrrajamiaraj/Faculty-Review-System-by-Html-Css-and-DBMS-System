<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewcademy";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$location =$_POST['location'];

$sql = "INSERT INTO university (name, location) value('$name', '$location');";
if($result= $conn->query($sql))
{
    echo "<script>alert('New University Added Successfully'); window.location.href = 'admin-page.html';</script>";
}

?>