<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewcademy";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$review_id = $_POST['review_id'];
$st_id = $_POST['st_id'];
$type = $_POST['versity'];

$sql_c = "SELECT * from reviews where id = '$review_id';";
$result_c = $conn->query($sql_c);
$row = $result_c->fetch_assoc();

$sql="INSERT INTO reports(review_id, report_type) values('$review_id', '$type');";

if($result=$conn->query($sql)){
    echo "<script>alert('Report submitted'); window.location.href = '/project/html-and-css-files/updated-profile-page/teacher-update.php?student_id=10003&st_id=$st_id&t_id={$row['t_id']}'; </script>";
}

?>