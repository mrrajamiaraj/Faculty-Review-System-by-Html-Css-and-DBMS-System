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
  // Fetch all teachers
  $sql_teachers = "SELECT id, name, dept, university_name FROM teacher";
  $result_teachers = $conn->query($sql_teachers);

  $sql = "SELECT count(id) as total_teacher FROM teacher";
  $result = $conn->query($sql);
  $row1 = $result->fetch_assoc()['total_teacher'];

  ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="delete.css">
    <style>
        .home{
    width: 40%;
    padding: 10px;
    margin-top: 20px;
    right: 50%;
    background-color: #9f1934;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    
 }
 .home:hover{
    background-color: #026798;
 }
 </style>
 </head>
 <body>
 <div class="container">
        <header>
            <h1>Teachers Database </h1>
        </header>
        
        <div class="total-count">
                <p>Total Teachers:<?php echo htmlspecialchars($row1); ?> </p>
            </div>
             
            
            <div class="teachers-list" id="teachers-list">
                <?php
                 if ($result_teachers->num_rows > 0) {
                    while ($row = $result_teachers->fetch_assoc()) {
                        echo "<div class='comment'>
                                <strong>Student ID:</strong> " . htmlspecialchars($row['id']) . "<br>
                                <strong>Student Name:</strong> " . htmlspecialchars($row['name']) . "<br>
                                <strong>Department:</strong> " . htmlspecialchars($row['dept']) . "<br>
                                <strong>University:</strong> " . htmlspecialchars($row['university_name']) . "<br><br>
                                <form action='delete.php' method='POST'>
                                    <input type='hidden' name='t_id' value='" . htmlspecialchars($row['id']) . "'>
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
            
            <button class="home" onclick="window.location.href='admin-page.html'" >Go to Admin</button>
    </div>
 </body>
 </html>