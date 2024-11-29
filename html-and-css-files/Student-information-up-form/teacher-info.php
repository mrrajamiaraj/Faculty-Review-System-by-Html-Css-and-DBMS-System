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

$t_id = $_GET['id'];

$sql = "SELECT * FROM teacher WHERE id = '$t_id' ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql3 = "SELECT * from university";
$result3 = $conn->query($sql3);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Update Request</title>
    <link rel="stylesheet" href="student-information-up-req.css">
</head>
<body>
    <div class="update-container">
        <h2>Student Update Request</h2>
        <div class="previous-data">
            <p><strong>User Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
            <p><strong>ID:</strong> <?php echo htmlspecialchars($row['id']); ?></p>
            <p><strong>Department:</strong> <?php echo htmlspecialchars($row['dept']); ?></p>
            <p><strong>Univarsity:</strong> <?php echo htmlspecialchars($row['university_name']); ?></p>
            <p><strong>Password:</strong> <?php echo htmlspecialchars($row['initial']); ?></p>
        </div>
        <form action="tform-update.php" method="POST">
    <h3>Select Information to Update</h3>
    <div class="update-options">
        <input type="hidden" name="t_id" value="<?php echo htmlspecialchars($t_id); ?>">
        <div>
            <label>
                <input type="checkbox" name="name" value="username" onchange="toggleCommentBox('username-comment')"> User Name
            </label>
            <textarea id="username-comment" class="comment-box" name="name" placeholder="Enter updated User Name" style="display: none;"></textarea>
        </div>
        <div>
            <label>
                <input type="checkbox" name="id" value="id" onchange="toggleCommentBox('id-comment')"> ID
            </label>
            <textarea id="id-comment" class="comment-box" name="id" placeholder="Enter updated ID" style="display: none;"></textarea>
        </div>
        <div>
            <label>
                <input type="checkbox" name="department" value="department" onchange="toggleCommentBox('department-comment')"> Department
            </label>
            <textarea id="department-comment" class="comment-box" name="department" placeholder="Enter updated Department" style="display: none;"></textarea>
        </div>
        <div>
        <select name="versity" id="versity" >
                <option value="">Select University</option> 
                <?php
                  if ($result3->num_rows > 0) {
                  while ($row3 = $result3->fetch_assoc()) {
                  echo "<option value=\"" . htmlspecialchars($row3['name']) . "\">" . htmlspecialchars($row3['name']) . "</option>";
                  }
                 }
                ?>
                </select> 
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
