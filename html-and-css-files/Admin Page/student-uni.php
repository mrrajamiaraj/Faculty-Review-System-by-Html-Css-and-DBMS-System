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

$sql3 = "SELECT (COUNT(*)-1) as total_teacher from students";
$result3 = $conn->query($sql3);
$row3 = $result3->fetch_assoc()['total_teacher'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Database</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to bottom, #673ab7, #d1c4e9);
    color: #311b92;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

.container {
    width: 100%;
    max-width: 800px;
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

header {
    background-color: #673ab7;
    color: white;
    padding: 15px;
    border-radius: 5px;
    font-size: 24px;
    text-align: center;
    margin-bottom: 20px;
}

.total-count {
    background: #d1c4e9;
    border: 2px solid #673ab7;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    font-size: 18px;
    margin-bottom: 20px;
}

.search {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.dropdown-label {
    font-size: 16px;
    color: #311b92;
    font-weight: bold;
    margin-bottom: 5px;
}

.search select {
    width: 100%;
    max-width: 300px;
    padding: 10px;
    font-size: 16px;
    border: 2px solid #673ab7;
    border-radius: 5px;
    background-color: #ede7f6;
    color: #311b92;
    appearance: none; /* Hides the default dropdown arrow */
    background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="%23673ab7"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>');
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 20px;
}

.search select:focus {
    outline: none;
    border-color: #311b92;
    box-shadow: 0 0 5px rgba(49, 27, 146, 0.5);
}

.search button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #673ab7;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.search button:hover {
    background-color: #311b92;
}

.teachers-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.teacher-box {
    background: #ede7f6;
    border: 2px solid #673ab7;
    border-radius: 10px;
    padding: 15px;
    font-size: 16px;
    color: #311b92;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}


    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Univarsity Database</h1>
        </header>

        <form action="total-students.php" method="POST">
            <div class="total-count">
                <p>Total Students: <?php echo htmlspecialchars($row3); ?></p>
                <p>Total Univarsity: <?php echo htmlspecialchars($row2); ?></p>
            </div>
             
            <div class="search">
            <label for="versity" class="dropdown-label">Select University</label>
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