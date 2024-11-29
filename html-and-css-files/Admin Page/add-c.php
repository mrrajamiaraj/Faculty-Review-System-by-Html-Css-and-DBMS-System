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

$code = $_POST['code'];
$title = $_POST['title'];
$t_id = $_POST['versity']; 


$sql = "INSERT INTO courses (course_code, course_title) VALUES ('$code', '$title');";
$sql1 = "INSERT INTO teaches (c_code, t_id) VALUES ('$code', '$t_id');";


$sql2 = "SELECT * FROM courses WHERE course_code = '$code';";
$result2 = $conn->query($sql2);


$sql3 = "SELECT * FROM teaches WHERE c_code = '$code' AND t_id = '$t_id';";
$result3 = $conn->query($sql3);

if ($result2->num_rows > 0) {
    echo "<script>alert('This course already exists'); window.history.back();</script>";
} else {
    if ($result3->num_rows > 0) {
        echo "<script>alert('This faculty already takes this course'); window.history.back();</script>";
    } else {
        // Insert into `courses` and `teaches` tables
        if ($conn->query($sql) && $conn->query($sql1)) {
            echo "<script>alert('New course and assignment added successfully'); window.location.href = 'admin-page.html';</script>";
        } else {
            echo "<script>alert('Error occurred during insertion'); window.history.back();</script>";
        }
    }
}

$conn->close();
?>
