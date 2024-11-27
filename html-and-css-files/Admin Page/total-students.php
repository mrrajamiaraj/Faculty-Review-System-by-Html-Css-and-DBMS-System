<?php
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

$uni = $_POST['versity'];

if($uni === "North South")
{
    $sql_count = "SELECT (COUNT(*)-1) as total_students FROM students where university_name = '$uni'";
  $result_count = $conn->query($sql_count);
  $total_students = $result_count->fetch_assoc()['total_students'];

  $NO_id = 0000;
  // Fetch all teachers
  $sql_teachers = "SELECT id, name, department FROM students where university_name = '$uni' AND id <> '$NO_id'";
  $result_teachers = $conn->query($sql_teachers);

  ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="total-students.css?v=1.0">
 </head>
 <body>
 <div class="container">
        <header>
            <h1>Students Database </h1>
            <h3><?php echo htmlspecialchars($uni); ?></h3>
        </header>
        
        <form action = "/project/html-and-css-files/updated-profile-page/student-update.php?" method = "POST">
            <div class="total-count">
                <p>Total Students:<?php echo htmlspecialchars($total_students); ?> </p>
            </div>
             
            <div class="search">
                   <input type="number" id="s_id" name="s_id" placeholder="Enter Student ID" required>
                   <button type="submit" class="button">Search</button>
            </div>
        

            <div class="teachers-list" id="teachers-list">
                <?php
                 if ($result_teachers->num_rows > 0) {
                      while ($row = $result_teachers->fetch_assoc()) {

                          echo "<div class='comment'><strong>Student ID:</strong> " . htmlspecialchars($row['id']) . "<br>";
                          echo "<strong>Student Name:</strong> " . htmlspecialchars($row['name']) . "<br>";
                          echo "<strong>Department:</strong> " . htmlspecialchars($row['department']) . "</div>";
                        }
                    } else {
                         echo "<pc class = 'comment'> No Student found for this Database.</p>";
                        }

                 $conn->close();
                ?>
            </div>
        </form>
    </div>
 </body>
 </html>
 <?php
}

else
{
    // Fetch total count of teachers
 $sql_count = "SELECT COUNT(*) as total_students FROM students where university_name = '$uni'";
 $result_count = $conn->query($sql_count);
 $total_students = $result_count->fetch_assoc()['total_students'];

 // Fetch all teachers
 $sql_teachers = "SELECT id, name, department FROM students where university_name = '$uni'";
 $result_teachers = $conn->query($sql_teachers);

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="total-students.css?v=1.0">
 </head>
 <body>
 <div class="container">
        <header>
            <h1>Students Database </h1>
            <h3><?php echo htmlspecialchars($uni); ?></h3>
        </header>
        
        <form action = "/project/html-and-css-files/updated-profile-page/student-update.php" method = "POST">
            <div class="total-count">
                <p>Total Students:<?php echo htmlspecialchars($total_students); ?> </p>
            </div>
             
            <div class="search">
                   <input type="number" id="s_id" name="s_id" placeholder="Enter Student ID" required>
                   <button type="submit" class="button">Search</button>
            </div>
        

            <div class="teachers-list" id="teachers-list">
                <?php
                 if ($result_teachers->num_rows > 0) {
                      while ($row = $result_teachers->fetch_assoc()) {

                          echo "<div class='comment'><strong>Student ID:</strong> " . htmlspecialchars($row['id']) . "<br>";
                          echo "<strong>Student Name:</strong> " . htmlspecialchars($row['name']) . "<br>";
                          echo "<strong>Department:</strong> " . htmlspecialchars($row['department']) . "</div>";
                        }
                    } else {
                         echo "<pc class = 'comment'> No Student found for this Database.</p>";
                        }

                 $conn->close();
                ?>
            </div>
        </form>
    </div>
 </body>
 </html>
 <?php
}

?>