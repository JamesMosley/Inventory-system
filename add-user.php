<?php
session_start();
require '.\connection.php';
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

    $sql_ = "select *from users where username = '$username' and password = '$password'";
    $sql = "INSERT INTO users (ID, name, username, password, role) VALUES ('', '$fullname', '$username', '$password', '$userrole')";

    if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: ./manage-users.php");
    } else {
    echo "Error: " . $sql . "<br>" . $con->error;
    }
?>
