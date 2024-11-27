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

if(isset($_POST['id']))
{
    $id = $_POST['id'];


$sql = "DELETE from students
        where id = '$id' ";

if($conn->query($sql))
{
    echo "<script>alert('Successfully Deleted'); window.location.href = 'delete-student.php';</script>";
}
else{
    echo "<script>alert('Student Not Deleted!!'); window.location.href = 'delete-student.php';</script>";
}
}
else if(isset($_POST['t_id']))
{
    $t_id = $_POST['t_id'];

$sql = "DELETE from teacher
        where id = '$t_id' ";

if($conn->query($sql))
{
    echo "<script>alert('Successfully deleted'); window.location.href = 'delete-teacher.php';</script>";
}
else{
    echo "<script>alert('Teacher Not Deleted!!'); window.location.href = 'delete-teacher.php';</script>";
}
}
else
{
    echo "<script>alert('Error happened!!'); window.location.href = 'delete-teacher.php';</script>";
}



$conn->close();
?>