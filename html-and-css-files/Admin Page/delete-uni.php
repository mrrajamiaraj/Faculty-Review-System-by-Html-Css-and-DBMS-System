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

// Correct DELETE syntax
$sql = "DELETE FROM university WHERE id = '$id'";

if ($conn->query($sql)) {
    echo "<script>alert('Successfully deleted'); window.location.href = 'show-uni.php';</script>";
} else {
    echo "<script>alert('Cannot delete the University. Error happened!'); window.location.href = 'show-uni.php';</script>";
}

$conn->close();
?>
