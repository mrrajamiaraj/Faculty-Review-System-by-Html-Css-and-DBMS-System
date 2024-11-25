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
    <script src="login-form.js" defer></script>
</head>
<style>
    
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    font-family: sans-serif;
    background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
}

.main {
    width: 350px;
    height: 700px; /* Adjusted height for dropdown */
    background: url("1.jpg") no-repeat center / cover;
    border-radius: 10px;
    box-shadow: 5px 20px 50px #000;
    overflow: hidden;
    position: relative;
}

#chk {
    display: none;
}

.sign,
.login {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    transition: transform 0.6s ease-in-out;
    backface-visibility: hidden;
}

.sign {
    z-index: 2;
    transform: rotateY(0);
}

.login {
    background: url("1.jpg") no-repeat center / cover;/* Change this to your desired color */
    transform: translateY(100%);
    z-index: 1;
}

#chk:checked ~ .login {
    transform: translateY(0);
    z-index: 2;
}

#chk:checked ~ .sign {
    transform: translateY(-100%);
    z-index: 1;
}

label {
    color: #fff;
    font-size: 2.3em;
    justify-content: center;
    display: flex;
    margin: 20px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.5s ease-in-out;
}

.dropdown-label {
    color: #fff;
    font-size: 1em;
    margin-top: 10px;
    margin-bottom: 5px;
}

input,
select {
    width: 250px; /* Adjusted from 80% for wider inputs */
    height: 40px; /* Increased height */
    background: #e0dede;
    justify-content: center;
    display: flex;
    margin: 10px auto;
    padding: 12px; /* Slightly increased padding */
    font-size: 1.1em; /* Increased font size */
    border: none;
    outline: none;
    border-radius: 5px;
}

button {
    width: 80%;
    height: 40px;
    margin: 10px auto;
    justify-content: center;
    display: block;
    color: #fff;
    background: #573b8a;
    font-size: 1em;
    font-weight: bold;
    outline: none;
    border: none;
    border-radius: 5px;
    transition: 0.2s ease-in;
    cursor: pointer;
}

button:hover {
    background: #6d44b8;
}

#message {
    color: #ff4d4d;
    font-size: 0.9em;
    text-align: center;
    margin-top: 10px;
    display: none;
    font-weight: bold;
    font-family: Arial, sans-serif;
}

.switch-button {
    background: transparent;
    color: #fff;
    border: 2px solid #573b8a;
    margin-top: 10px;
    transition: 0.2s ease-in-out;
}

.switch-button:hover {
    background: #573b8a;
    color: #fff;
}



</style>
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
                <!-- Course Selection Dropdown -->
                <label for="versity" class="dropdown-label">Select University</label>
                <select name="versity" id="versity">
                    <option value=""></option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"" . htmlspecialchars($row['name']) . "\">" . htmlspecialchars($row['name']) . "</option>";
                        }
                    }
                    ?>
                </select>
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
                <input type="id" name="id" placeholder="ID" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <!-- Sign Up Page Button -->
                <button type="button" class="switch-button" onclick="toggleToSignUp()">Go to Sign Up</button>
            </form>
        </div>
    </div>
</body>
</html> 