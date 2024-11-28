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

$code = $_POST['id'];

// Correct DELETE syntax
$sql = "DELETE FROM courses WHERE course_code = '$code'";

if ($conn->query($sql)) {
    echo "<script>alert('Successfully deleted'); window.location.href = 'delete.course.php';</script>";
} else {
    echo "<script>alert('Cannot delete the course. Error happened!'); window.location.href = 'delete.course.php';</script>";
}

$conn->close();
?>
