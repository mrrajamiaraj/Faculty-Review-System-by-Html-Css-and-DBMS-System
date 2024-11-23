<?php
// Database connection
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

// Capture the form values
$tc_id = $_POST['tc_id']; // Teacher ID from URL (GET)
$st_id = $_POST['st_id']; // Student ID from URL (GET)

$course = $_POST['course']; // Course selected from dropdown
$professorRating = $_POST['professorRating']; // Rating for Professor
$gradingDifficulty = $_POST['gradingDifficulty']; // Rating for Grading Difficulty
$learningExperience = $_POST['learningExperience']; // Rating for Learning Experience
$comment = $_POST['comment']; // Comment

// Prepare SQL query to insert data into the 'reviews' table
$sql = "INSERT INTO reviews (s_id, t_id, course_name, rate_grading, rate_learning, rate_professor, comment)
        VALUES ('$st_id', '$tc_id', '$course','$gradingDifficulty', '$learningExperience', '$professorRating', '$comment')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Review submitted successfully!');  window.location.href='/project/html-and-css-files/Ratepage/rate.php?tc_id=$tc_id&st_id=$st_id'; </script>";
} else {
    echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
}

// Close the connection
$conn->close();
?>