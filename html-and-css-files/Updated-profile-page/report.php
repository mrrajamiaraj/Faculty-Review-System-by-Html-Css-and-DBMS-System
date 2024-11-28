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

$review_id = $_GET['id'];
$st_id = $_GET['st_id'];

$sql1 = "SELECT * from reviews where id = $review_id";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();

$sql = "SELECT r.id AS review_id, t.name AS teacher_name, r.course_name as course, r.comment as details FROM reviews r 
        JOIN teacher t ON r.t_id = t.id 
        WHERE r.id = '$review_id';";
$result = $conn->query($sql);
$row = $result->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Update Request</title>
    <link rel="stylesheet" href="/project/html-and-css-files/Student-information-up-form/student-information-up-req.css">
</head>
<body>
    <div class="update-container">
        <h2>Student Update Request</h2>
        <div class="previous-data">
        <p><strong>Review ID:</strong> <?php echo htmlspecialchars($row['review_id']); ?></p>
        <p><strong>About:</strong> <?php echo htmlspecialchars($row['teacher_name']); ?></p>
        <p><strong>On:</strong> <?php echo htmlspecialchars($row['course']); ?></p>
        <p><strong>Review Details:</strong> <?php echo htmlspecialchars($row['details']); ?></p>

        </div>
        <form action="r.php" method="POST">
    <h3>Select Information to Update</h3>
    <div class="update-options">
        <input type="hidden" name="review_id" value="<?php echo htmlspecialchars($review_id); ?>">
        <input type="hidden" name="st_id" value="<?php echo htmlspecialchars($st_id); ?>">
        <div>
        <select name="versity" id="versity" required>
                <option value="">Select Report Type</option> 
                <option value="FALSE REVIEW">FALSE REVIEW</option>
                <option value="ELLIGATIONS">ELLIGATIONS</option>
                <option value="OTHERS">OTHERS</option>
                </select> 
        </div>
    </div>
    <button type="submit" class="submit-button">Submit Update Request</button>
</form>
    </div>
    <script src="/project/html-and-css-files/Student-information-up-form/information-update.js"></script>
</body>
</html>

<?php
$conn->close();
?>
