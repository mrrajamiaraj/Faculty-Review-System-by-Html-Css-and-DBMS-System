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

// Fetch data from POST
$name = $_POST['name'];
$id = $_POST['id'];
$dept = $_POST['dept'];
$versity = $_POST['versity'];
$initial = $_POST['initial'];


$sql_chk = "SELECT id FROM teacher WHERE id = '$id'";
$chk_result = $conn->query($sql_chk);

if ($chk_result->num_rows > 0) { 
    echo "<script>alert('This ID already exists in the database!!'); window.location.href = 'add-teacher.php';</script>";
} else {
    
    $sql = "INSERT INTO teacher (id, name, dept, university_name, initial) 
            VALUES ('$id', '$name', '$dept', '$versity', '$initial')";

    if ($conn->query($sql)) {
        echo "<script>alert('New Faculty Added Successfully'); window.location.href = 'admin-page.html';</script>";
    } else {
        echo "<script>alert('Error adding faculty! Please try again.'); window.location.href = 'add-teacher.php';</script>";
    }
}


$conn->close();
?>
