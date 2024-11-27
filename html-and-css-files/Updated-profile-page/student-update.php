<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewcademy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];

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
        <link rel="stylesheet" href="student-update.css">
    </head>
    <body>
    <div class="review-container">
            <div class="header">
                <h2 class="header-text">Student Information</h2>
                <?php echo "<button class='update-button' onclick=\"window.location.href='/project/html-and-css-files/Student-information-up-form/student-information.php?id=$id'\">Update</button>"; ?>
            </div>
            <div class="user-info">
                <span><?php echo htmlspecialchars($row['university_name']); ?></span>
                <span> <?php echo htmlspecialchars($row['name']); ?></span>
                <span> <?php echo htmlspecialchars($row['id']); ?></span>
            </div>
            <div class="profile-card">
                <img src="pp.jpg" alt="Profile Picture" class="profile-picture">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
                <p><strong>Department:</strong> <?php echo htmlspecialchars($row['department']); ?></p>
                <p><strong>Mail:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                <p><strong>Reviews Given:</strong> <?php echo htmlspecialchars($row2['total_review']); ?></p>
                <?php echo "<button class='review-button' onclick=\"window.location.href='/project/html-and-css-files/admin%20Page/total-teachers.php?id=$id'\">Give Review</button>"; ?>
            </div>
            <button class="show-reviews" onclick="showReviews()" >Show All Reviews</button>
        </div>
    
        <div id ="review-section" class="reviews" style="display: none;">
            <h3>All Reviews</h3>
            <?php
            if ($result3->num_rows > 0) {
                while ($row3 = $result3->fetch_assoc()) {
                    echo "<div class='comment'><strong>Teacher ID:</strong> " . htmlspecialchars($row3['t_id']) . "<br>";
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
    <?php
 }
else if(isset($_POST['s_id']))
{
    $id = $_POST['s_id'];

  $sql = "SELECT * from students where id = '$id'";
  $result = $conn->query($sql);

  if(!$result->num_rows > 0)
  {
      echo "<script>alert('This does not belong to any Student'); history.back(); </script>";
      exit();
  }

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
      <link rel="stylesheet" href="student-update.css">
 </head>
 <body>
 <div class="review-container">
        <div class="header">
            <h2 class="header-text">Student Information</h2>
            
        
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
 <?php
}
 
else{
    echo "<script>alert('ID not provided!'); location.history.back();</script>";
    exit();
}
?>

