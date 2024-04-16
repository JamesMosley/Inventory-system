<?php
session_start();
require '.\connection.php';
$id = $_POST['id'];
$fullname = $_POST['fullname'];
$username = $_POST['username'];
$userrole = $_POST['userrole'];
$password = $_POST['psw'];

    //to prevent from mysqli injection
    $fullname = stripcslashes($fullname);
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $userrole = stripcslashes($userrole);
    $fullname = mysqli_real_escape_string($con, $fullname);
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);
    $userrole = mysqli_real_escape_string($con, $userrole);

    $sql = "select *from users where username = '$username' and password = '$password'";
    $sql = "UPDATE users SET ID='$id', name='$fullname', username='$username',password='$password', role='$userrole' WHERE ID = '$id'";

    if ($con->query($sql) === TRUE) {
        echo '<script>alert("User edit Successful")</script>';
        echo '<script>location.replace("./manage-users.php")</script>';
    } else {
    echo "Error: " . $sql . "<br>" . $con->error;
    }
?>
