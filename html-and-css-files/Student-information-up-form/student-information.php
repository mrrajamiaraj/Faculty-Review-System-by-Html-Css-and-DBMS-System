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

$s_id = $_GET['id'];

$sql = "SELECT * FROM students WHERE id = '$s_id' ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql2 = "SELECT * from university";
$result2 = $conn->query($sql2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Update Request</title>
    <link rel="stylesheet" href="student-information-up-req.css">
</head>
<body>
    <div class="update-container">
        <h2>Student Update Request</h2>
        <div class="previous-data">
            <p><strong>User Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
            <p><strong>ID:</strong> <?php echo htmlspecialchars($row['id']); ?></p>
            <p><strong>Department:</strong> <?php echo htmlspecialchars($row['department']); ?></p>
            <p><strong>Univarsity:</strong> <?php echo htmlspecialchars($row['university_name']); ?></p>
            <p><strong>Password:</strong> <?php echo htmlspecialchars($row['password']); ?></p>
        </div>
        <form action="form-update.php" method="POST">
    <h3>Select Information to Update</h3>
    <div class="update-options">
        <input type="hidden" name="s_id" value="<?php echo htmlspecialchars($s_id); ?>">
        <div>
            <label>
                <input type="checkbox" name="updateField[]" value="username" onchange="toggleCommentBox('username-comment')"> User Name
            </label>
            <textarea id="username-comment" class="comment-box" name="name" placeholder="Enter updated User Name" style="display: none;"></textarea>
        </div>
        <div>
            <label>
                <input type="checkbox" name="updateField[]" value="email" onchange="toggleCommentBox('email-comment')"> Email
            </label>
            <textarea id="email-comment" class="comment-box" name="email" placeholder="Enter updated Email" style="display: none;"></textarea>
        </div>
        <div>
            <label>
                <input type="checkbox" name="updateField[]" value="department" onchange="toggleCommentBox('department-comment')"> Department
            </label>
            <textarea id="department-comment" class="comment-box" name="department" placeholder="Enter updated Department" style="display: none;"></textarea>
        </div>
        <div>
            <label>
                <input type="checkbox" name="updateField[]" value="password" onchange="toggleCommentBox('password-comment')"> Password
            </label>
            <textarea id="password-comment" class="comment-box" name="password" placeholder="Enter updated Password" style="display: none;"></textarea>
        </div>
    </div>
    <button type="submit" class="submit-button">Submit Update Request</button>
</form>
    </div>
    <script src="information-update.js"></script>
</body>
</html>

<?php
$conn->close();
?>
