<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewcademy";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
} else {
    echo "Database connected successfully.";
}

echo"i am here1";

echo"i am here2";
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo"i am here";

    $sql = "SELECT password FROM admin WHERE email = ?";
    $stmt_sql = $conn->prepare($sql);
    $stmt_sql->bind_param("s", $email);
    $stmt_sql->execute();

    $stmt_sql->execute();
    if ($stmt_sql->error) {
         die("Query execution failed: " . $stmt_sql->error);
    }

    $result = $stmt_sql->get_result();

    if ($result->num_rows > 0) {
        $stored_password = $result->fetch_assoc()['password'];

        // Direct comparison for non-hashed passwords
        if ($password === $stored_password) {
            echo "<script>alert('Login Successfully'); window.location.href = '/project/html-and-css-files/admin%20Page/admin-page.html';</script>";
        } else {
            echo "<script>alert('Login Failed: Incorrect Password'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Login Failed: Email Not Found'); window.history.back();</script>";
    }

    $stmt_sql->close();
    
// if (isset($_POST['admin'])) {

    
// }

$conn->close();
?>
