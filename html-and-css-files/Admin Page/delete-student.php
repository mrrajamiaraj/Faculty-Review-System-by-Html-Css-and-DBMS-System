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
$NO_id = 0000;
  // Fetch all teachers
  $sql_teachers = "SELECT id, name, department FROM students where id <> '$NO_id'";
  $result_teachers = $conn->query($sql_teachers);

  $sql = "SELECT (count(id)-1) as total_students FROM students";
  $result = $conn->query($sql);
  $row1 = $result->fetch_assoc()['total_students'];

  ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="delete.css">
 </head>
 <body>
 <div class="container">
        <header>
            <h1>Students Database </h1>
        </header>
        
        <div class="total-count">
                <p>Total Students:<?php echo htmlspecialchars($row1); ?> </p>
            </div>
             
            
            <div class="teachers-list" id="teachers-list">
                <?php
                 if ($result_teachers->num_rows > 0) {
                    while ($row = $result_teachers->fetch_assoc()) {
                        echo "<div class='comment'>
                                <strong>Student ID:</strong> " . htmlspecialchars($row['id']) . "<br>
                                <strong>Student Name:</strong> " . htmlspecialchars($row['name']) . "<br>
                                <strong>Department:</strong> " . htmlspecialchars($row['department']) . "<br><br>
                                <form action='delete.php' method='POST'>
                                    <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                                    <button type='submit' class='button'>Delete</button>
                                </form>
                              </div>";
                    }
                } else {
                    echo "<p class='comment'>No Student found for this Database.</p>";
                }
                

                 $conn->close();
                ?>
            </div>
        
    </div>
 </body>
 </html>