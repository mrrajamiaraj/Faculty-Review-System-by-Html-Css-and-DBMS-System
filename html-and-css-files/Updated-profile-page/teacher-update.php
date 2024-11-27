<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewcademy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['guest_id'])){
    $t_id = 0;
    if(isset($_GET['t_id']))
    {
        $t_id = $_GET['t_id'];
    }
    else if(isset($_POST['s_id']))
    {
        $t_id = $_POST['s_id'];
    }

    $sql1 = "SELECT * from teacher where id = '$t_id' OR initial = '$t_id'";
  $result1 = $conn->query($sql1);

  if(!$result1->num_rows > 0)
  {
     echo "<script>alert('This does not belong to any teacher'); history.back(); </script>";
     exit();
  }

  $row1 = $result1->fetch_assoc();

  $sql2 = "SELECT AVG(rate_learning) as l_rating, AVG(rate_grading) as g_rating, AVG(rate_Professor) as p_rating, COUNT(*) as total_rate from reviews where t_id = {$row1['id']}";
  $result2 = $conn->query($sql2);
  $row2 = $result2->fetch_assoc();

  $sql3 = "SELECT * from reviews where t_id = {$row1['id']}";
  $result3 = $conn->query($sql3);

  $sql4 = "SELECT *
  FROM teacher t JOIN teaches th on t.id = th.t_id 
  JOIN courses c ON c.course_code = th.c_code
  WHERE t.id = '$t_id';";
  $result4 = $conn->query($sql4);
  ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Review</title>
    <link rel="stylesheet" href="teacher-update.css">
    
 </head>
 <body>
   
    <div class="professor-profile">
    <img src="teacher.jpeg" alt="Professor Picture" class="profile-picture">
    <h2> <?php echo htmlspecialchars($row1['name']) ?> </h2>
    <p>Department: <?php echo htmlspecialchars($row1['dept']) ?> </p>
    
    <p>Courses: <?php if($result4->num_rows > 0)
                             
                      {
                          while ($row4 = $result4->fetch_assoc())
                          {
                            echo htmlspecialchars($row4['course_title']) ;
                            echo ", ";
                          }
                      }
                      else {
                        echo "<p>No Course is taken by this faculty.</p>";
                    }
                      ?></p>
    <p><?php echo htmlspecialchars($row1['university_name']) ?></p>
    </div>

    <div class="container">
        
        <div class="rating-overview">
            <div class="rating-score">
                <h1><?php echo htmlspecialchars($row2['p_rating']) ?> <span>/ 5</span></h1>
                <p>Overall Quality Based on <span><?php echo htmlspecialchars($row2['total_rate']) ?></span>Ratings </p>
                <h1><?php echo htmlspecialchars($row2['l_rating']) ?> <span>/ 5</span></h1>
                <p>Rate Teaching Based on <span><?php echo htmlspecialchars($row2['total_rate']) ?></span>Ratings </p>
                <h1><?php echo htmlspecialchars($row2['g_rating']) ?> <span>/ 5</span></h1>
                <p>Rate grading Based on <span><?php echo htmlspecialchars($row2['total_rate']) ?></span>Ratings </p>
                </div>
                
            </div>
            
    
 <div class="reviews-section">
    <button class="show-reviews-button" onclick = "showReviews()" >Show All Reviews</button>
 </div>

 <div id="review-section2" class="reviews" style="display: none;">
    <h3>All Reviews</h3>
    <?php
    if ($result3->num_rows > 0) {
        while ($row3 = $result3->fetch_assoc()) {
            echo "<div class='review-box'>";
            echo "<strong>Student ID:</strong> " . htmlspecialchars($row3['s_id']) . "<br>";
            echo "<strong>About Course:</strong> " . htmlspecialchars($row3['course_name']) . "<br>";
            echo "<strong>Review:</strong> " . htmlspecialchars($row3['comment']) . "<br>";
            // Report Button
            echo "<button class='report-button' onclick='reportReview(" . $row3['id'] . ")'>Report</button>";
            echo "</div><br>";
        }
    } else {
        echo "<p>No reviews found for this student.</p>";
    }
    ?>


    <script>
    // JavaScript to show/hide review section
      function showReviews() {
      var reviewSection = document.getElementById("review-section2");
      reviewSection.style.display = reviewSection.style.display === "none" ? "block" : "none";
     }
    </script>
<script>
 function reportReview(reviewId) {
    console.log("Report button clicked for review ID: " + reviewId); // Debugging line
    if (confirm("Are you sure you want to report this review?")) {
        alert("Review " + reviewId + " has been reported.");
    }
}

</script>
 </body>
 </html>
 <?php

}
else if (isset($_GET['student_id']))
{
    $id = 0;
    $st_id = 0;
    if (isset($_GET['st_id'])){
        $id = $_GET['t_id'];
        $st_id = $_GET['st_id'];
    }
    if (isset($_POST['st_id'])){
        $id = $_POST['t_id'];
        $st_id = $_POST['st_id'];
    }
    

  $sql1 = "SELECT * from teacher where id = '$id' OR initial = '$id' ";
  $result1 = $conn->query($sql1);

  if(!$result1->num_rows > 0)
  {
      echo "<script>alert('This does not belong to any teacher'); history.back(); </script>";
      exit();
  }

  $row1 = $result1->fetch_assoc();

  $sql2 = "SELECT AVG(rate_learning) as l_rating, AVG(rate_grading) as g_rating, AVG(rate_Professor) as p_rating, COUNT(*) as total_rate from reviews where t_id = {$row1['id']}";
  $result2 = $conn->query($sql2);
  $row2 = $result2->fetch_assoc();

  $sql3 = "SELECT * from reviews where t_id = {$row1['id']} ";
  $result3 = $conn->query($sql3);

  $sql4 = "SELECT *
  FROM teacher t JOIN teaches th on t.id = th.t_id 
  JOIN courses c ON c.course_code = th.c_code
  WHERE t.id = '$id';";
  $result4 = $conn->query($sql4);
  ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Professor Review</title>
   <link rel="stylesheet" href="teacher-update.css">
 </head>
 <body>
   
    <div class="professor-profile">
    <img src="teacher.jpeg" alt="Professor Picture" class="profile-picture">
    <h2> <?php echo htmlspecialchars($row1['name']) ?> </h2>
    <p>Department: <?php echo htmlspecialchars($row1['dept']) ?> </p>
    
    <p>Courses: <?php if($result4->num_rows > 0)
                             
                      {
                          while ($row4 = $result4->fetch_assoc())
                          {
                            echo htmlspecialchars($row4['course_title']) ;
                            echo ", ";
                          }
                      }
                      else {
                        echo "<p>No Course is taken by this faculty.</p>";
                    }
                      ?></p>
    <p><?php echo htmlspecialchars($row1['university_name']) ?></p>
    </div>

    <div class="container">
        
        <div class="rating-overview">
            <div class="rating-score">
                <h1><?php echo htmlspecialchars($row2['p_rating']) ?> <span>/ 5</span></h1>
                <p>Overall Quality Based on <span><?php echo htmlspecialchars($row2['total_rate']) ?></span>Ratings </p>
                <h1><?php echo htmlspecialchars($row2['l_rating']) ?> <span>/ 5</span></h1>
                <p>Rate Teaching Based on <span><?php echo htmlspecialchars($row2['total_rate']) ?></span>Ratings </p>
                <h1><?php echo htmlspecialchars($row2['g_rating']) ?> <span>/ 5</span></h1>
                <p>Rate grading Based on <span><?php echo htmlspecialchars($row2['total_rate']) ?></span>Ratings </p>
                </div>
                <input type = "hidden">
                
            </div>
            
    
   <div class="action-buttons">
        <button class="show-reviews-button" onclick="showReviews()">Show All Reviews</button>
        <?php echo "<button class='rate-button' onclick=\"window.location.href='/project/html-and-css-files/Ratepage/rate.php?tc_id={$row1['id']}&st_id=$st_id'\"> Rate-></button>"; ?>
    </div>

    <div id="review-section2" class="reviews" style="display: none;">
        <h3>All Reviews</h3>
        <?php
        if ($result3->num_rows > 0) {
            while ($row3 = $result3->fetch_assoc()) {
                echo "<div class='review-box'>
                        <strong>Student ID:</strong> " . htmlspecialchars($row3['s_id']) . "<br>
                        <strong>About Course:</strong> " . htmlspecialchars($row3['course_name']) . "<br>
                        <strong>Review:</strong> " . htmlspecialchars($row3['comment']) . "
                      </div><br>";
            }
        } else {
            echo "<p>No reviews found for this student.</p>";
        }
        ?>
    </div>


    <script>
    // JavaScript to show/hide review section
      function showReviews() {
      var reviewSection = document.getElementById("review-section2");
      reviewSection.style.display = reviewSection.style.display === "none" ? "block" : "none";
     }
    </script>

 </body>
 </html>
 <?php
}

else if (isset($_GET['teacher_id'])){
    $t_id = 0;
    if(isset($_GET['t_id']))
    {
        $t_id = $_GET['t_id'];
    }
    else if(isset($_POST['s_id']))
    {
        $t_id = $_POST['s_id'];
    }

  $sql1 = "SELECT * from teacher where id = '$t_id' OR initial = '$t_id'";
  $result1 = $conn->query($sql1);

  if(!$result1->num_rows > 0)
  {
     echo "<script>alert('This does not belong to any teacher'); history.back(); </script>";
     exit();
  }

  $row1 = $result1->fetch_assoc();

  $sql2 = "SELECT AVG(rate_learning) as l_rating, AVG(rate_grading) as g_rating, AVG(rate_Professor) as p_rating, COUNT(*) as total_rate from reviews where t_id = {$row1['id']}";
  $result2 = $conn->query($sql2);
  $row2 = $result2->fetch_assoc();

  $sql3 = "SELECT * from reviews where t_id = {$row1['id']}";
  $result3 = $conn->query($sql3);

  $sql4 = "SELECT *
  FROM teacher t JOIN teaches th on t.id = th.t_id 
  JOIN courses c ON c.course_code = th.c_code
  WHERE t.id = '$t_id';";
  $result4 = $conn->query($sql4);
  ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Review</title>
    <link rel="stylesheet" href="teacher-update.css">
    
 </head>
 <body>
   
    <div class="professor-profile">
    <img src="teacher.jpeg" alt="Professor Picture" class="profile-picture">
    <h2> <?php echo htmlspecialchars($row1['name']) ?> </h2>
    <p>Department: <?php echo htmlspecialchars($row1['dept']) ?> </p>
    
    <p>Courses: <?php if($result4->num_rows > 0)
                             
                      {
                          while ($row4 = $result4->fetch_assoc())
                          {
                            echo htmlspecialchars($row4['course_title']) ;
                            echo ", ";
                          }
                      }
                      else {
                        echo "<p>No Course is taken by this faculty.</p>";
                    }
                      ?></p>
    <p><?php echo htmlspecialchars($row1['university_name']) ?></p>
    <button class="update-button">Update Info</button>
    </div>

    <div class="container">
        
        <div class="rating-overview">
            <div class="rating-score">
                <h1><?php echo htmlspecialchars($row2['p_rating']) ?> <span>/ 5</span></h1>
                <p>Overall Quality Based on <span><?php echo htmlspecialchars($row2['total_rate']) ?></span>Ratings </p>
                <h1><?php echo htmlspecialchars($row2['l_rating']) ?> <span>/ 5</span></h1>
                <p>Rate Teaching Based on <span><?php echo htmlspecialchars($row2['total_rate']) ?></span>Ratings </p>
                <h1><?php echo htmlspecialchars($row2['g_rating']) ?> <span>/ 5</span></h1>
                <p>Rate grading Based on <span><?php echo htmlspecialchars($row2['total_rate']) ?></span>Ratings </p>
                </div>
                
            </div>
            
    
 <div class="reviews-section">
    <button class="show-reviews-button" onclick = "showReviews()" >Show All Reviews</button>
 </div>

 <div id ="review-section2" class="reviews" style="display: none;">
        <h3>All Reviews</h3>
        <?php
        if ($result3->num_rows > 0) {
            while ($row3 = $result3->fetch_assoc()) {
                echo "<div class='comment'><strong>Student ID:</strong> " . htmlspecialchars($row3['s_id']) . "<br>";
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
      var reviewSection = document.getElementById("review-section2");
      reviewSection.style.display = reviewSection.style.display === "none" ? "block" : "none";
     }
    </script>

 </body>
 </html>
 <?php
}
?>
