<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewcademy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * from university";
$result = $conn->query($sql);

$sql2 = "SELECT count(*) as total_uni from university"; 
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc()['total_uni'];

$sql3 = "SELECT COUNT(*) as total_teacher from teacher";
$result3 = $conn->query($sql3);
$row3 = $result3->fetch_assoc()['total_teacher'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Database</title>
    <link rel="stylesheet" href="st_uni.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Univarsity Database</h1>
        </header>

        <form action="total-teachers.php" method="POST">
            <div class="total-count">
                <p>Total Teachers: <?php echo htmlspecialchars($row3); ?></p>
                <p>Total Univarsity: <?php echo htmlspecialchars($row2); ?></p>
            </div>
             
            <div class="search">
            <label for="versity" class="dropdown-label">Select University</label>
                <select name="versity" id="versity" required>
                <option value="">-- Select an option --</option> <!-- Default placeholder -->
                <?php
                  if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                  echo "<option value=\"" . htmlspecialchars($row['name']) . "\">" . htmlspecialchars($row['name']) . "</option>";
                  }
                 }
                ?>
                </select>
                <button type="submit" class="submit">Search</button>
            </div>

        </form>
    </div>
</body>
</html>