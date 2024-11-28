<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviewcademy";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$old_id = $_POST['t_id'];

$sql1 = "SELECT * from teacher where id = '$old_id'";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();

$id = $row1['id'];
$name =$row1['name'];
$dept = $row1['dept'];
$versity = $row1['university_name'];

$count = 0;

if(!empty($_POST['id']))
{
    $id = $_POST['id'];
    $count = $count +1;
}

if(!empty($_POST['department']))
{
    $dept = $_POST['department'];
    $count = $count +1;
}

if(!empty($_POST['name']))
{
    $name = $_POST['name'];
    $count = $count +1;
}

if(!empty($_POST['versity']))
{
    $versity = $_POST['versity'];
    $count = $count +1;
}


if($count > 0){
    if (!empty($_POST['id']) || !empty($_POST['versity'])){
            $sql_c = "SELECT * from teacher where id = '$id' AND university_name='$versity' ";
            $result_c = $conn->query($sql_c);
            if($result_c->num_rows > 0) {
                echo "<script>alert('This ID already exists in the university.'); window.history.back(); </script>";
            }
            
        else  {
          $sql = "UPDATE teacher
                set id = '$id', name = '$name', dept = '$dept', university_name='$versity' where id = '$old_id'; ";
         if($result = $conn->query($sql)){
              echo "<script>alert('$count value(s) have been updated'); window.location.href = '/project/html-and-css-files/updated-profile-page/teacher-update.php?teacher_id=%2010002&t_id=$id'; </script>";
            } 
         else{
             echo "<script>alert('Error happened'); location.history.back()'; </script>";
            }
        }
    }
    else{
        $sql = "UPDATE teacher
                set name = '$name', dept = '$dept' where id = '$old_id'; ";
         if($result = $conn->query($sql)){
              echo "<script>alert('$count value(s) have been updated'); window.location.href = '/project/html-and-css-files/updated-profile-page/teacher-update.php?teacher_id=%2010002&t_id=$id'; </script>";
            } 
         else{
             echo "<script>alert('Error happened'); window.history.back()'; </script>";
            }
    }
    
    
    
}
else{
    echo "<script>alert('Nothing to update'); window.history.back()'; </script>";
}


$conn->close();
?>
