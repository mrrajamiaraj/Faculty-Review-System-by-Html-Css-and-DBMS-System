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

// Fetch student ID
$old_id = $_POST['s_id'];

// Initialize update counter
$count = 0;

// Array of fields to be updated
$fields = ['name', 'email', 'department', 'password'];

// Prepare SQL statement for each field
foreach ($fields as $field) {
    if (!empty($_POST[$field])) {
        $value = htmlspecialchars($_POST[$field]);
        $sql = "UPDATE students SET $field = '$value' WHERE id = '$old_id'";

        if ($conn->query($sql)) {
            $count++;
        } else {
            echo "Error updating $field: " . $conn->error;
        }
    }
}

// Display message based on update results
if ($count > 0) {
    echo "<script>
        alert('Your $count value(s) have been updated.');
        window.location.href = '/project/html-and-css-files/updated-profile-page/student-update.php?id=$old_id';
    </script>";
} else {
    echo "<script>
        alert('No values were updated.');
        window.location.href = 'student-information.php';
    </script>";
}

$conn->close();
?>
