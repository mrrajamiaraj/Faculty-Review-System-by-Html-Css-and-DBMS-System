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

// Check if the ID already exists
$sql_chk = "SELECT id FROM teacher WHERE id = '$id'";
$chk_result = $conn->query($sql_chk);

if ($chk_result->num_rows > 0) { // Corrected to use 'num_rows'
    echo "<script>alert('This ID already exists in the database!!'); window.location.href = 'add-teacher.php';</script>";
} else {
    // Insert the new teacher
    $sql = "INSERT INTO teacher (id, name, dept, university_name, initial) 
            VALUES ('$id', '$name', '$dept', '$versity', '$initial')";

    if ($conn->query($sql)) {
        echo "<script>alert('New Faculty Added Successfully'); window.location.href = 'add-teacher.php';</script>";
    } else {
        echo "<script>alert('Error adding faculty! Please try again.'); window.location.href = 'add-teacher.php';</script>";
    }
}

// Close connection
$conn->close();
?>




$conn->close();
?>