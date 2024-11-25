<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewcademy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['st_id']))
{
    $id = $_POST['id'];
  $st_id = $_POST['st_id'];
  

  $sql1 = "SELECT * from teacher where id = '$id'";
  $result1 = $conn->query($sql1);

  if(!$result1->num_rows > 0)
  {
      echo "<script>alert('This does not belong to any teacher'); history.back(); </script>";
      exit();
  }

  $row1 = $result1->fetch_assoc();

  $sql2 = "SELECT AVG(rate_learning) as l_rating, AVG(rate_grading) as g_rating, AVG(rate_Professor) as p_rating, COUNT(*) as total_rate from reviews where t_id = '$id'";
  $result2 = $conn->query($sql2);
  $row2 = $result2->fetch_assoc();

  $sql3 = "SELECT * from reviews where t_id = '$id'";
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
  <style>
        
 * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
 }

 body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e); /* Theme background */
    color: #333;
    padding: 20px;
 }

  .professor-profile {
    text-align: center;
    margin-bottom: 30px;
 }

 .profile-picture {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
    border: 2px solid #007bff;
 }

 .professor-profile h2 {
    font-size: 1.5rem;
    color: white;
    margin-bottom: 5px;
 }

 .professor-profile p {
    font-size: 1rem;
    color: white;
    margin-bottom: 5px;
 }

 .update-button {
    background-color: #ff9800;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    font-size: 14px;
    cursor: pointer;
 }

 .update-button:hover {
    background-color: #e68900;
 }
 .container {
    max-width: 1200px;
    margin: auto;
    background: #fff;
    display: flex;
    flex-wrap: wrap;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
 }


 .rating-overview {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-bottom: 30px;
 }

 .rating-score {
    flex: 1;
    min-width: 300px;
 }

 .rating-score h1 {
    font-size: 4rem;
    margin-bottom: 10px;
    color: #000;
 }

 .rating-score span {
    font-size: 1.5rem;
    color: #666;
 }

 .rating-score h2 {
    font-size: 2rem;
    margin: 10px 0;
    color: #333;
 }

 .rating-score a {
    color: #0066cc;
    text-decoration: none;
 }

 .rating-score a:hover {
    text-decoration: underline;
 }

 .rating-details {
    display: flex;
    justify-content: space-around;
    margin: 20px 0;
 }

 .detail h3 {
    font-size: 2rem;
    margin-bottom: 5px;
    color: #000;
 }

 .detail p {
    font-size: 0.9rem;
    color: #666;
 }

 .actions {
    display: flex;
    gap: 10px;
    margin-top: 20px;
 }

 button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
 }

 .rate-button {
    background-color: #007bff;
    color: #fff;
    width: 150px;
    height:40px;
    right: 30px;
 }

 .rate-button:hover {
    background-color: #0056b3;
 }

 .compare-button {
    background-color: transparent;
    color: #007bff;
    border: 2px solid #007bff;
 }

 .compare-button:hover {
    background-color: #007bff;
    color: #fff;
 }

 .rating-distribution {
    flex: 1;
    min-width: 250px; /* Slightly smaller width */
    max-width: 400px; /* Prevent it from growing too large */
    background: #f9f9f9;
    padding: 15px; /* Reduced padding */
    border: 1px solid #ddd; /* Subtle border */
    border-radius: 8px; /* Slightly rounded corners */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    height: 200px; /* Adjust based on content */
    margin: 0 auto; /* Center it within the parent container */
 }



 .rating-distribution h3 {
    text-align: center; /* Center-align the heading */
    font-size: 1.5rem;
    margin-bottom: 20px;
 }

 .rating-distribution ul {
    list-style: none;
    padding: 0;
 }

 .rating-distribution li {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
 }

 .rating-distribution .bar {
    flex: 1;
    height: 10px;
    margin: 0 10px;
    background-color: #007bff;
    border-radius: 5px;
 }

 .reviews-section {
    display: flex;
    flex-direction: column; /* Arrange items vertically */
    align-items: flex-end; /* Align to the right */
    gap: 30px; /* Increase the gap between buttons */
    margin-left: auto; /* Push to the far right */
 }

 /* Style for both buttons */
 .show-reviews-button, .rate-button {
    background-color: #673ab7;
    width: 200px; /* Increase width */
    height: 60px; /* Increase height */
    font-size: 18px; /* Make text larger */
    font-weight: bold;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 15px 25px; /* Default size */
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
 }

 /* Hover effect */
 .show-reviews-button:hover, .rate-button:hover {
    background-color: #311b92;
 }

 /* Optional: Clean up anchor-wrapped buttons */
 .reviews-section a {
    text-decoration: none;
 }



 @media (max-width: 768px) {
    .rating-overview {
        flex-direction: column;
    }

    .rating-score, .rating-distribution {
        margin-bottom: 20px;
    }
 }

    </style>
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
            
    
 <div class="reviews-section">
    <button class="show-reviews-button" onclick = "showReviews()" >Show All Reviews</button>
    <?php echo "<button class='rate-button' onclick=\"window.location.href='/project/html-and-css-files/Ratepage/rate.php?tc_id=$id&st_id=$st_id'\"> Rate-></button>"; ?>
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

else{
    $t_id = $_POST['s_id'];

  $sql1 = "SELECT * from teacher where id = '$t_id'";
  $result1 = $conn->query($sql1);

  if(!$result1->num_rows > 0)
  {
     echo "<script>alert('This does not belong to any teacher'); history.back(); </script>";
     exit();
  }

  $row1 = $result1->fetch_assoc();

  $sql2 = "SELECT AVG(rate_learning) as l_rating, AVG(rate_grading) as g_rating, AVG(rate_Professor) as p_rating, COUNT(*) as total_rate from reviews where t_id = '$t_id'";
  $result2 = $conn->query($sql2);
  $row2 = $result2->fetch_assoc();

  $sql3 = "SELECT * from reviews where t_id = '$t_id'";
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
    <style>
        
 * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
 }

 body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e); /* Theme background */
    color: #333;
    padding: 20px;
 }

 .professor-profile {
    text-align: center;
    margin-bottom: 30px;
 }

 .profile-picture {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
    border: 2px solid #007bff;
 }

 .professor-profile h2 {
    font-size: 1.5rem;
    color: white;
    margin-bottom: 5px;
 }

 .professor-profile p {
    font-size: 1rem;
    color: white;
    margin-bottom: 5px;
 }

 .update-button {
    background-color: #ff9800;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    font-size: 14px;
    cursor: pointer;
 }

 .update-button:hover {
    background-color: #e68900;
 }
 .container {
    max-width: 1200px;
    margin: auto;
    background: #fff;
    display: flex;
    flex-wrap: wrap;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
 }


 .rating-overview {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-bottom: 30px;
 }

 .rating-score {
    flex: 1;
    min-width: 300px;
 }

 .rating-score h1 {
    font-size: 4rem;
    margin-bottom: 10px;
    color: #000;
 }

 .rating-score span {
    font-size: 1.5rem;
    color: #666;
 }

 .rating-score h2 {
    font-size: 2rem;
    margin: 10px 0;
    color: #333;
 }

 .rating-score a {
    color: #0066cc;
    text-decoration: none;
 }

 .rating-score a:hover {
    text-decoration: underline;
 }

 .rating-details {
    display: flex;
    justify-content: space-around;
    margin: 20px 0;
 }

 .detail h3 {
    font-size: 2rem;
    margin-bottom: 5px;
    color: #000;
 }

 .detail p {
    font-size: 0.9rem;
    color: #666;
 }

 .actions {
    display: flex;
    gap: 10px;
    margin-top: 20px;
 }

 button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
 }

 .rate-button {
    background-color: #007bff;
    color: #fff;
    width: 150px;
    height:40px;
    right: 30px;
 }

 .rate-button:hover {
    background-color: #0056b3;
 }

 .compare-button {
    background-color: transparent;
    color: #007bff;
    border: 2px solid #007bff;
 }

 .compare-button:hover {
    background-color: #007bff;
    color: #fff;
 }

 .rating-distribution {
    flex: 1;
    min-width: 250px; /* Slightly smaller width */
    max-width: 400px; /* Prevent it from growing too large */
    background: #f9f9f9;
    padding: 15px; /* Reduced padding */
    border: 1px solid #ddd; /* Subtle border */
    border-radius: 8px; /* Slightly rounded corners */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    height: 200px; /* Adjust based on content */
    margin: 0 auto; /* Center it within the parent container */
 }



 .rating-distribution h3 {
    text-align: center; /* Center-align the heading */
    font-size: 1.5rem;
    margin-bottom: 20px;
 }

 .rating-distribution ul {
    list-style: none;
    padding: 0;
 }

 .rating-distribution li {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
 }

 .rating-distribution .bar {
    flex: 1;
    height: 10px;
    margin: 0 10px;
    background-color: #007bff;
    border-radius: 5px;
 }

 .reviews-section {
    display: flex;
    flex-direction: column; /* Arrange items vertically */
    align-items: flex-end; /* Align to the right */
    gap: 30px; /* Increase the gap between buttons */
    margin-left: auto; /* Push to the far right */
 }

 /* Style for both buttons */
 .show-reviews-button, .rate-button {
    background-color: #673ab7;
    width: 200px; /* Increase width */
    height: 60px; /* Increase height */
    font-size: 18px; /* Make text larger */
    font-weight: bold;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 15px 25px; /* Default size */
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
 }

 /* Hover effect */
 .show-reviews-button:hover, .rate-button:hover {
    background-color: #311b92;
 }

 /* Optional: Clean up anchor-wrapped buttons */
 .reviews-section a {
    text-decoration: none;
 }



 @media (max-width: 768px) {
    .rating-overview {
        flex-direction: column;
    }

    .rating-score, .rating-distribution {
        margin-bottom: 20px;
    }
 }

    </style>
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
<!-- document.getElementById('submitBtn').addEventListener('click', function () {
                          const value = document.getElementById('textField').value;
                          alert('You entered: '' + value);
                          echo "
                      <!DOCTYPE html>
                      <html lang='en'>
                      <head>
                          <meta charset='UTF-8'>
                          <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                          <title>Dynamic Text Field</title>
                          <style>
                          .hidden {
                              display: none;
                            }
                          .container {
                              text-align: center;
                              margin-top: 50px;
                            }
                          button {
                              padding: 10px 20px;
                              font-size: 16px;
                              cursor: pointer;
                            }
                          .text-field {
                              margin-top: 10px;
                           }
                          </style>
                        </head>
                        <body>
                         <div class='container'>
                         <button id='addFieldBtn'>Add Text Field</button>
                         <div id='dynamicField' class='hidden'>
                         <form action = 'report-submit.php' method = 'POST'>
                         <input type='hidden' name='r_id' class='hidden value' value='<?php echo $row3['id']; ?>'>
                         <label for='versity' class='dropdown-label'>Select University</label>
                         <select name='versity' id='versity'>
                         <option value='False Review'>False Review</option>
                         <option value='Not Authenic'>Not Authenic</option>
                         <option value='Others'>Others</option>
                         </select>
                         </form>
                          </div>
                         </div>

                        <script>
                          document.getElementById('addFieldBtn').addEventListener('click', function () {
                         // Show the dynamic field and submit button
                          document.getElementById('dynamicField').classList.remove('hidden');
                         });

                         
                       </script>
                       </body>
                       </html>
                       ";
                         }); -->
