<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewcademy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
echo "id is $id";

$sql = "DELETE from students
        where id = '$id' ";

if($conn->query($sql))
{
    echo "<script>alert('Successfully deleted'); window.location.href = 'delete-student.php';</script>";
}
else{
    echo "<script>alert('Error!!'); window.location.href = 'delete-student.php';</script>";
}

$conn->close();
?>