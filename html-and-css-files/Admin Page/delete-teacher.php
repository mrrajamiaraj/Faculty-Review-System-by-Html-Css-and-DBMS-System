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


 .button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #673ab7;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
 }

 .button:hover {
    background-color: #311b92;
 }

 .comment{
    background: #d1c4e9;
    border: 2px solid #673ab7;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    font-size: 18px;
    margin-bottom: 20px;
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
        
    </div>
 </body>
 </html>