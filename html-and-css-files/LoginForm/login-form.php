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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Review System - Login</title>
    <link rel="stylesheet" type="text/css" href="login-form.css">
    <script src="login-form.js" defer></script>
</head>
<body>
    <div class="main">
        <!-- Hidden Checkbox for Toggle--> 
        <input type="checkbox" id="chk" aria-hidden="true">

        <!-- Sign Up Section -->
        <div class="sign">
            <form action="login.php" method="POST">
                <input type="hidden" name="signup" value="1">
                <label for="chk" aria-hidden="true">Sign Up</label>
                <input type="text" name="username" placeholder="Name" required>
                <select name="versity" id="versity" required>
                <option value="">Select University</option> <!-- Default placeholder -->
                <?php
                  if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                  echo "<option value=\"" . htmlspecialchars($row['name']) . "\">" . htmlspecialchars($row['name']) . "</option>";
                  }
                 }
                ?>
                </select>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="id" placeholder="ID" required>
                <input type="text" name="department" placeholder="Department" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                <p id="message" style="color: red; display: none;">Passwords do not match</p>
                <button type="submit">Sign Up</button>
                <!-- Login Page Button -->
                <button type="button" class="switch-button" onclick="toggleToLogin()">Go to Login</button>
            </form>
        </div>

        <!-- Login Section -->
        <div class="login">
            <form action="login.php" method="POST">
                <input type="hidden" name="login" value="1">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <!-- Sign Up Page Button -->
                <button type="button" class="switch-button" onclick="toggleToSignUp()">Go to Sign Up</button>
            </form>
        </div>
    </div>
</body>
</html> 