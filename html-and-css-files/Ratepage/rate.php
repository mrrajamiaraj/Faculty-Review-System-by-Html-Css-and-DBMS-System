<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewcademy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tc_id = $_GET['tc_id'];
$st_id = $_GET['st_id'];

$sql = "SELECT *
FROM teaches 
WHERE t_id = '$tc_id';";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty and Course Review</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 20px;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f4f4f9;
}

.review-container {
    width: 400px;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
}

label {
    margin: 10px 0 5px;
    display: block;
    color: #555;
}

select, .rating-box, textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.rating-box {
    display: flex;
    justify-content: space-between;
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    padding: 5px;
    position: relative;
}

.rating-box div {
    width: 18%;
    height: 40px;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: background-color 0.3s, border-color 0.3s;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9em;
    color: #666;
}

/* Tooltip styling */
.tooltip {
    visibility: hidden; /* Initially hidden */
    opacity: 0; /* Transparent */
    text-align: center;
    padding: 5px;
    font-size: 0.9em;
    color: #333;
    margin-top: 5px;
    transition: opacity 0.3s ease, visibility 0.3s ease; /* Smooth transition */
}


.radio-buttons {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

textarea {
    resize: vertical;
    height: 100px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #45a049;
}

/* Hover colors */
.rating-box div[data-value="1"]:hover { background-color: #cd9595; color: #fff; }
.rating-box div[data-value="2"]:hover { background-color: #b4c3ee; color: #fff; }
.rating-box div[data-value="3"]:hover { background-color: #dbce99; color: #333; }
.rating-box div[data-value="4"]:hover { background-color: #a6e6a1; color: #333; }
.rating-box div[data-value="5"]:hover { background-color: #b39ce5; color: #fff; }

/* Selected state colors */
.red.selected { background-color: #ef2b2b; color: #fff; }
.blue.selected { background-color: #3c68eb; color: #fff; }
.yellow.selected { background-color: #ffde58; color: #333; }
.lightgreen.selected { background-color: #1ba911; color: #333; }
.green.selected { background-color: #6a38ba; color: #fff; }

    </style>
</head>
<body>

<div class="review-container">
    <h2>Submit Your Review</h2>

<form method="POST" action="submit-review.php">
        <!-- Course Selection Dropdown -->
        <label for="course">Select Course</label>
        <select name="course" id="course">
            <option value=""></option>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=\"" . htmlspecialchars($row['c_code']) . "\">" . htmlspecialchars($row['c_code']) . "</option>";
                }
            }
            ?>
        </select>

        <!-- Professor Rating Section -->
        <label for="professorRating">Rate Your Professor</label>
        <div class="rating-box" id="professorRating">
            <div data-value="1" data-tooltip="Awful"></div>
            <div data-value="2" data-tooltip="OK"></div>
            <div data-value="3" data-tooltip="Good"></div>
            <div data-value="4" data-tooltip="Great"></div>
            <div data-value="5" data-tooltip="Awesome"></div>
        </div>
        <span class="tooltip" id="professorTooltip"></span>

        <!-- Grading Difficulty Section -->
        <label for="gradingBox">Rate Grading Difficulty</label>
        <div class="rating-box" id="gradingBox">
            <div data-value="1" data-tooltip="Very Difficult"></div>
            <div data-value="2" data-tooltip="Difficult"></div>
            <div data-value="3" data-tooltip="Moderate"></div>
            <div data-value="4" data-tooltip="Easy"></div>
            <div data-value="5" data-tooltip="Very Easy"></div>
        </div> 
        <span class="tooltip" id="gradingTooltip"></span>

        <!-- Learning Experience Section -->
        <label for="learningBox">Rate Learning Experience</label>
        <div class="rating-box" id="learningBox">
            <div data-value="1" data-tooltip="Awful"></div>
            <div data-value="2" data-tooltip="OK"></div>
            <div data-value="3" data-tooltip="Good"></div>
            <div data-value="4" data-tooltip="Great"></div>
            <div data-value="5" data-tooltip="Awesome"></div>
        </div>
        <span class="tooltip" id="learningTooltip"></span>

        <!-- Comment Section -->
        <label for="comment">Additional Comments (Mandatory)</label>
        <textarea id="comment" name="comment" rows="4" placeholder="Add your comments or feedback here..." required></textarea>

        <input type="hidden" id="professorRatingInput" name="professorRating" value="">
        <input type="hidden" id="gradingDifficultyInput" name="gradingDifficulty" value="">
        <input type="hidden" id="learningExperienceInput" name="learningExperience" value="">
        <input type="hidden" id="st_id" name="st_id" value="<?php echo $st_id; ?>">
        <input type="hidden" id="tc_id" name="tc_id" value="<?php echo $tc_id; ?>">

        <button type="submit">Submit Review</button>
    </form>
</div>

<script>
    // Capture the rating values when a user clicks on a rating div
    let professorRating = 0;
    let gradingDifficulty = 0;
    let learningExperience = 0;

    // Add event listeners for professor rating
    document.getElementById("professorRating").querySelectorAll('div').forEach(div => {
        div.addEventListener('click', function() {
            professorRating = this.getAttribute('data-value');
        });
    });

    // Add event listeners for grading difficulty
    document.getElementById("gradingBox").querySelectorAll('div').forEach(div => {
        div.addEventListener('click', function() {
            gradingDifficulty = this.getAttribute('data-value');
        });
    });

    // Add event listeners for learning experience
    document.getElementById("learningBox").querySelectorAll('div').forEach(div => {
        div.addEventListener('click', function() {
            learningExperience = this.getAttribute('data-value');
        });
    });

    // When form is submitted, the rating values will be set to hidden inputs
    document.querySelector("form").onsubmit = function() {
        // Set the hidden inputs for ratings before submitting the form
        document.getElementById('professorRatingInput').value = professorRating;
        document.getElementById('gradingDifficultyInput').value = gradingDifficulty;
        document.getElementById('learningExperienceInput').value = learningExperience;
    }
</script>

<script src="rate.js"></script>

</body>
</html>

