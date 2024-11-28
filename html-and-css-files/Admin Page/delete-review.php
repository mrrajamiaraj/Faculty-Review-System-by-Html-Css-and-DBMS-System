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

$review_id = $_POST['id'];
$report_id = $_POST['rep_id'];

// Correct DELETE syntax
$sql = "DELETE FROM reviews WHERE id = '$review_id'";
$sql1 = "DELETE FROM reports WHERE report_id = '$report_id'";

if ($conn->query($sql)) {
    if ($conn->query($sql1)) {
        echo "<script>alert('Successfully deleted'); window.location.href = 'show-report.php';</script>";
    } else {
        echo "<script>alert('Cannot delete the report. Error happened!'); window.location.href = 'show-report.php';</script>";
    }
} else {
    echo "<script>alert('Cannot delete the review. Error happened!'); window.location.href = 'show-report.php';</script>";
}

$conn->close();
?>
