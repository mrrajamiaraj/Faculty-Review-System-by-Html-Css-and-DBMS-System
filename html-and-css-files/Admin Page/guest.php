<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewcademy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_count = "SELECT COUNT(*) as total_teachers FROM teacher";
 $result_count = $conn->query($sql_count);
 $total_teachers = $result_count->fetch_assoc()['total_teachers'];

 // Fetch all teachers
 $sql_teachers = "SELECT id, name, dept, initial, university_name FROM teacher";
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

        <form action = "/project/html-and-css-files/updated-profile-page/teacher-update.php?guest_id= 10001" method = "POST">
            <div class="total-count">
                <p>Total Teachers:<?php echo htmlspecialchars($total_teachers); ?> </p>
            </div>
             
            <div class="search">
                <input type="text" id="s_id" name="s_id" placeholder="Enter Intial" required>
                <button type="submit" class="button">Search</button>
            </div>

            <div class="teachers-list" id="teachers-list">
                <?php
                 if ($result_teachers->num_rows > 0) {
                      while ($row = $result_teachers->fetch_assoc()) {

                        echo "<a href='/project/html-and-css-files/updated-profile-page/teacher-update.php?guest_id= 10001&t_id={$row['id']}' style='text-decoration: none; color: inherit;'>"; // Start the link
                        echo "<div class='comment' style='cursor: pointer;'><strong>Teacher ID:</strong> " . htmlspecialchars($row['id']) . "<br>";
                        echo "<strong>Teacher Name:</strong> " . htmlspecialchars($row['name']) . "<br>";
                        echo "<strong>Initial:</strong> " . htmlspecialchars($row['initial']) . "<br>";
                        echo "<strong>University:</strong> " . htmlspecialchars($row['university_name']) . "<br>";
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