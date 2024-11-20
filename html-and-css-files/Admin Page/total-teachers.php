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

// Fetch total count of teachers
$sql_count = "SELECT COUNT(*) as total_teachers FROM teacher";
$result_count = $conn->query($sql_count);
$total_teachers = $result_count->fetch_assoc()['total_teachers'];

// Fetch all teachers
$sql_teachers = "SELECT id, name, deptt FROM teacher";
$result_teachers = $conn->query($sql_teachers);

$teachers_data = [];
if ($result_teachers->num_rows > 0) {
    while ($row = $result_teachers->fetch_assoc()) {
        $teachers_data[] = $row;
    }
}

// Send data as JSON
echo json_encode([
    "total_teachers" => $total_teachers,
    "teachers" => $teachers_data,
]);

$conn->close();
?>
