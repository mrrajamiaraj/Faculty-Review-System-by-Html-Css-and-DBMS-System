<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewcademy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * from teacher";
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


.sign {
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
    width: 250px; 
    height: 50px; 
    background: #e0dede;
    justify-content: center;
    display: flex;
    margin: 10px auto;
    padding: 12px; 
    font-size: 1.1em; 
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



</style>
<body>
    <div class="main">

        <div class="sign">
            <form action="add-c.php" method="POST">
                <input type="text" name="code" placeholder="Course Code" required>
                <input type="text" name="title" placeholder="Course Title" required>
                <select name="versity" id="versity" required>
                <option value="">Select Teacher</option>
                <?php
                  if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                  echo "<option value=\"" . htmlspecialchars($row['id']) . "\">" . htmlspecialchars($row['name']) . "(" . htmlspecialchars($row['initial']) . ") </option>";
                  }
                 }
                 $conn->close();
                ?>
                </select>
                <button type="submit">Add</button>
            </form>
        </div>
    </div>
</body>
</html> 