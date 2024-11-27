<?php
// Get teacher ID from URL
$teacher_id = $_GET['id'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewcademy";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch teacher details
$query = "SELECT id, name, university FROM teacher WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$stmt->bind_result($id, $name, $university);
$stmt->fetch();

// Fetch courses the teacher is teaching
$query_courses = "SELECT c_code FROM teaches WHERE t_id = ?";
$stmt_courses = $conn->prepare($query_courses);
$stmt_courses->bind_param("i", $teacher_id);
$stmt_courses->execute();
$courses_result = $stmt_courses->get_result();

// Fetch ratings
$query_ratings = "SELECT AVG(rate_grading), AVG(rate_learning), AVG(rate_professor) FROM reviews WHERE t_id = ?";
$stmt_ratings = $conn->prepare($query_ratings);
$stmt_ratings->bind_param("i", $teacher_id);
$stmt_ratings->execute();
$stmt_ratings->bind_result($avg_grading, $avg_learning, $avg_professor);
$stmt_ratings->fetch();

// Fetch comments
$query_comments = "SELECT course_name, comment FROM reviews WHERE t_id = ?";
$stmt_comments = $conn->prepare($query_comments);
$stmt_comments->bind_param("i", $teacher_id);
$stmt_comments->execute();
$comments_result = $stmt_comments->get_result();

// Display the data in the HTML
?>
<script>
    document.getElementById('teacher-name').innerText = "<?php echo $name; ?>";
    document.getElementById('teacher-id').innerText = "<?php echo $id; ?>";
    document.getElementById('teacher-university').innerText = "<?php echo $university; ?>";
    document.getElementById('teacher-courses').innerText = "<?php while ($course = $courses_result->fetch_assoc()) { echo $course['c_code'] . ' '; } ?>";
    document.getElementById('grading-rating').innerText = "<?php echo round($avg_grading, 2); ?>";
    document.getElementById('learning-rating').innerText = "<?php echo round($avg_learning, 2); ?>";
    document.getElementById('professor-rating').innerText = "<?php echo round($avg_professor, 2); ?>";
</script>
