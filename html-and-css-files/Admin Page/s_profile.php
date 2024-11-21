<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewcademy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['s_id'];

$sql = "SELECT * from students where id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql2 = "SELECT count(*) as total_review from reviews where s_id = '$id'";
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();

$sql3 = "SELECT * from reviews where s_id = '$id'";
$result3 = $conn->query($sql3);

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
    margin: 0;
    padding: 0;
    background: linear-gradient(to bottom, #094db4, #7fabdd);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.review-container {
    width: 90%;
    max-width: 800px;
    background-color: #e3edef;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.header-text {
    font-size: 24px;
    color: rgb(10, 11, 27);
}

.review-button{
    background-color: indigo;
    color: white;
    width: 160px;
    height: 50px;
    right: 50px;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    font-size: 14px;
    cursor: pointer;
}
.review-button:hover{
    background-color: #9a1d0c;
}

.update-button {
    background-color: #ff3c00;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    font-size: 14px;
    cursor: pointer;
}

.update-button:hover {
    background-color: #9a1d0c;
}

.user-info {
    display: flex;
    justify-content: space-between;
    background-color: #08213b;
    color: white;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
    font-size: 16px;
}

.profile-card {
    background-color: #d9dcdf;
    border: 2px solid #0288d1;
    border-radius: 10px;
    padding: 20px;
    font-size: 16px;
    color: rgb(0, 0, 0);
    text-align: center;
}

.profile-picture {
    width: 120px;
    height: 120px;
    border: 2px solid #0288d1;
    border-radius: 50%;
    margin: 0 auto 20px;
    object-fit: cover;
    display: block;
}

.show-reviews {
    width: 100%;
    padding: 10px;
    margin-top: 20px;
    background-color: #0251d1;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
}

.show-reviews:hover {
    background-color: #026798;
}
</style>
</head>
<body>
<div class="review-container">
        <div class="header">
            <h2 class="header-text">Student Information</h2>
            <button class="update-button">Update</button>
        </div>
        <div class="user-info">
            <span>Facebook</span>
            <span>User Name: <?php echo htmlspecialchars($row['name']); ?></span>
            <span>User ID: <?php echo htmlspecialchars($row['id']); ?></span>
        </div>
        <div class="profile-card">
            <img src="pp.jpg" alt="Profile Picture" class="profile-picture">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
            <p><strong>Department:</strong> <?php echo htmlspecialchars($row['department']); ?></p>
            <p><strong>Mail:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
            <p><strong>Reviews Given:</strong> <?php echo htmlspecialchars($row2['total_review']); ?></p>
        </div>
        <button class="show-reviews" onclick="showReviews()" >Show All Reviews</button>
    </div>

    <div id ="review-section" class="reviews" style="display: none;">
        <h3>All Reviews</h3>
        <?php
        if ($result3->num_rows > 0) {
            while ($row3 = $result3->fetch_assoc()) {
                echo "<div class='comment'><strong>Student ID:</strong> " . htmlspecialchars($row3['s_id']) . "<br>";
                echo "<strong>Teacher ID:</strong> " . htmlspecialchars($row3['t_id']) . "<br>";
                echo "<strong>About Course:</strong> " . htmlspecialchars($row3['course_name']) . "<br>";
                echo "<strong>Review:</strong> " . htmlspecialchars($row3['comment']) . "</div><br>";
            }
        } else {
            echo "<p>No reviews found for this student.</p>";
        }
        $conn->close();
        ?>
    </div>


    <script>
    // JavaScript to show/hide review section
      function showReviews() {
      var reviewSection = document.getElementById("review-section");
      reviewSection.style.display = reviewSection.style.display === "none" ? "block" : "none";
     }
    </script>

</body>
</html>