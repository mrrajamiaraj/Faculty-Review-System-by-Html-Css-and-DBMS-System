<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewcademy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle Sign Up
    if (isset($_POST['signup'])) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $versity = $_POST['versity'];
        $email = $_POST['email'];
        $department = $_POST['department'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $type = "student";

        // Password Validation
        if ($password !== $confirmPassword) {
            echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
            exit();
        }

        $sql_chk = "SELECT id, university_name FROM students where id = '$id' AND university_name ='$versity'";
        $chk_result = $conn->query($sql_chk);

        if($chk_result-> num_rows > 0 )
        {
            echo "<script>alert('This Id Already Exist In This University!!!'); window.location.href = 'login-form.php';</script>";
        }
        else
        {
            $sql_check2 = "SELECT email FROM students WHERE email = '$email'";
            $chk_reult2 = $conn->query($sql_check2);

            if($chk_reult2 -> num_rows > 0)
            {
                echo "<script>alert('This email has already been used!!! Try new one'); window.location.href = 'login-form.php';</script>";
            }
            else
            {
                $query = "INSERT INTO students (id, name, email, department, password, type, university_name) VALUES ('$id','$username', '$email', '$department', '$password', '$type', '$versity')";

                if ($conn->query($query)) {
                  echo "<script>alert('Sign-Up Successful!'); window.location.href = 'login-form.php';</script>";
                } else {
                   echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
                }
            }

        }

        // Insert Data
    }

    // Handle Login
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM students WHERE email = '$email'";
        $result = $conn->query($query);

        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();

            if($row['type'] === "student"){
                if ($row['password'] === $password) { // Check password directly if no hashing
                    echo "<script>alert('Welcome {$row['name']}');</script>";
                    header("Location: /project/html-and-css-files/Updated-profile-page/student-update.php?id={$row['id']}");
                    exit();
                } else {
                    echo "<script>alert('Invalid Password'); window.history.back();</script>";
                }
            }
            else if($row['type'] === "admin"){
                if ($row['password'] === $password) { // Check password directly if no hashing
                    echo "<script>alert('Welcome {$row['name']}');</script>";
                    header("Location: /project/html-and-css-files/Admin%20page/admin-page.html");
                    exit();
                } else {
                    echo "<script>alert('Invalid Password'); window.history.back();</script>";
                }
            }

            
        }
        else
        {
            echo "<script>alert('Invalid ID'); window.history.back();</script>";
        }

    }
}

$conn->close();
?>