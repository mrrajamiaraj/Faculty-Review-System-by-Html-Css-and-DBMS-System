<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewcademy";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total students
$sql_total = "SELECT COUNT(*) AS total_students FROM students";
$result_total = $conn->query($sql_total);
$total_students = ($result_total->num_rows > 0) ? $result_total->fetch_assoc()['total_students'] : 0;

// Fetch all students
$sql_students = "SELECT id, name, department FROM students";
$result_students = $conn->query($sql_students);

$students = [];
if ($result_students->num_rows > 0) {
    while ($row = $result_students->fetch_assoc()) {
        $students[] = $row;
    }
}

$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode([
    'total_students' => $total_students,
    'students' => $students,
]);
?>
