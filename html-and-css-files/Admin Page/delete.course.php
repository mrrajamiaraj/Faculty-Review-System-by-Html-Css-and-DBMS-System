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

$sql="SELECT * from courses";
$result = $conn->query($sql);

$sql1="SELECT count(*) as total_report from courses";
$result1 = $conn->query($sql1);
$row1= $result1->fetch_assoc()['total_report'];






?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Complains</title>
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
            <h1>Courses Database </h1>
        </header>
        
        <div class="total-count">
                <p>Total Courses:<?php echo htmlspecialchars($row1); ?> </p>
            </div>
             
            
            <div class="teachers-list" id="teachers-list">
                <?php
                 if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='comment'>
                                <strong>Course Code:</strong> " . htmlspecialchars($row['course_code']) . "<br>
                                <strong>Title: </strong> " . htmlspecialchars($row['course_title']) . "<br><br>
                                <form action='delete-c.php' method='POST'>
                                    <input type='hidden' name='id' value='" . htmlspecialchars($row['course_code']) . "'>
                                    <button type='submit' class='button'>Delete course</button>
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

    </div>
</body>
</html>