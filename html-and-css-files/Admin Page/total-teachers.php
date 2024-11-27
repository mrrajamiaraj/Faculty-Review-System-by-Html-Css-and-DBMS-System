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

if (isset($_GET['id'])){
 $st_id = $_GET['id'];


 $sql = "SELECT university_name from students where id = '$st_id'";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc()['university_name'];
 // Fetch total count of teachers
 $sql_count = "SELECT COUNT(*) as total_teachers FROM teacher where university_name = '$row'";
 $result_count = $conn->query($sql_count);
 $total_teachers = $result_count->fetch_assoc()['total_teachers'];

  // Fetch all teachers
 $sql_teachers = "SELECT id, name, dept, initial FROM teacher where university_name = '$row'";
 $result_teachers = $conn->query($sql_teachers);
 
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="total-teachers.css">
 </head>
 <body>
 <div class="container">
        <header>
            <h1>Teacher Database</h1>
        </header>

        <form action = "/project/html-and-css-files/updated-profile-page/teacher-update.php?student_id= 10003" method = "POST">
            <div class="total-count">
                <p>Total Teachers:<?php echo htmlspecialchars($total_teachers); ?> </p>
            </div>
             
            <div class="search">
                <input type="text" id="id" name="t_id" placeholder="Enter Teacher ID/ INITIAL" required>
                <input type="hidden" id="st_id" name="st_id" value="<?php echo $st_id; ?>">
                <button type="submit" class="button">Search</button>
            </div>

            <div class="teachers-list" id="teachers-list">
                <?php
                 if ($result_teachers->num_rows > 0) {
                      while ($row = $result_teachers->fetch_assoc()) {

                        echo "<a href='/project/html-and-css-files/updated-profile-page/teacher-update.php?student_id=10003&st_id=" . $st_id . "&t_id=" . $row['id'] . "' style='text-decoration: none; color: inherit;'>"; // Start the link
                          echo "<div class='comment' style='cursor: pointer;'><strong>Teacher ID:</strong> " . htmlspecialchars($row['id']) . "<br>";
                          echo "<strong>Teacher Name:</strong> " . htmlspecialchars($row['name']) . "<br>";
                          echo "<strong>Initial:</strong> " . htmlspecialchars($row['initial']) . "<br>";
                          echo "<strong>Department:</strong> " . htmlspecialchars($row['dept']) . "</div>";
                          echo "</a>";
                        }
                    } else {
                         echo "<pc class = 'comment'>No faculty found for this Database.</p>";
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
else{

    $uni = $_POST['versity'];
 // Fetch total count of teachers
 $sql_count = "SELECT COUNT(*) as total_teachers FROM teacher where university_name = '$uni' ";
 $result_count = $conn->query($sql_count);
 $total_teachers = $result_count->fetch_assoc()['total_teachers'];

 // Fetch all teachers
 $sql_teachers = "SELECT id, name, dept, initial FROM teacher where university_name = '$uni'";
 $result_teachers = $conn->query($sql_teachers);

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="total-teachers.css">
 </head>
 <body>
 <div class="container">
        <header>
            <h1>Teacher Database</h1>
            <h3><?php echo htmlspecialchars($uni); ?></h3>
        </header>

        <form action = "/project/html-and-css-files/updated-profile-page/teacher-update.php?teacher_id= 10002" method = "POST">
            <div class="total-count">
                <p>Total Teachers:<?php echo htmlspecialchars($total_teachers); ?> </p>
            </div>
             
            <div class="search">
                <input type="text" id="s_id" name="s_id" placeholder="Enter Teacher ID/INITIAL" required>
                <button type="submit" class="button">Search</button>
            </div>

            <div class="teachers-list" id="teachers-list">
                <?php
                 if ($result_teachers->num_rows > 0) {
                      while ($row = $result_teachers->fetch_assoc()) {

                          echo "<a href='/project/html-and-css-files/updated-profile-page/teacher-update.php?teacher_id= 10002&t_id={$row['id']}' style='text-decoration: none; color: inherit;'>"; // Start the link
                          echo "<div class='comment' style='cursor: pointer;'><strong>Teacher ID:</strong> " . htmlspecialchars($row['id']) . "<br>";
                          echo "<strong>Teacher Name:</strong> " . htmlspecialchars($row['name']) . "<br>";
                          echo "<strong>Initial:</strong> " . htmlspecialchars($row['initial']) . "<br>";
                          echo "<strong>Department:</strong> " . htmlspecialchars($row['dept']) . "</div>";
                          echo "</a>";
                        
                        }
                    } else {
                         echo "<pc class = 'comment'>No faculty found for this University.</p>";
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


