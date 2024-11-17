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
        $email = $_POST['email'];
        $department = $_POST['department'];
        $cgpa = $_POST['cgpa'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        // Password Validation
        if ($password !== $confirmPassword) {
            echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
            exit();
        }

        // Insert Data
        $query = "INSERT INTO students (id, name, email, department, cgpa, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isssds", $id, $username, $email, $department, $cgpa, $password); // Skip hashing if needed

        if ($stmt->execute()) {
            echo "<script>alert('Sign-Up Successful!'); window.location.href = 'login-form.html';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
        }

        $stmt->close();
    }

    // Handle Login
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT password FROM students WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($dbPassword);
        $stmt->fetch();

        if ($dbPassword === $password) { // Check password directly if no hashing
            echo "<script>alert('Login Successful!'); window.location.href = '/project/html-and-css-files/updated-profile-page/student-update.html';</script>";
        } else {
            echo "<script>alert('Invalid Email or Password'); window.history.back();</script>";
        }

        $stmt->close();
    }
}

$conn->close();
?>