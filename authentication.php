<?php
session_start();
require './connection.php';
$username = $_POST['username'];
$password = $_POST['password'];

    //to prevent from mysqli injection
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    $sql = "select *from users where username = '$username' and password = '$password'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if($count == 1){
        if($row['role'] == "admin"){
            $_SESSION['id'] = 1;
            $_SESSION['fullname'] = $row['name'];
            $_SESSION['name'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            echo '<script>alert("Login Successful")</script>';
            echo '<script>location.replace("./manage-dashboard.php")</script>';
            // header("Location: ./admin-dashboard.php");
        } elseif ($row['role'] == "employee") {
            $_SESSION['id'] = 2;
            $_SESSION['fullname'] = $row['name'];
            $_SESSION['name'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            echo '<script>alert("Login Successful")</script>';
            echo '<script>location.replace("./manage-employee-dashboard.php")</script>';
            // header("Location: ./employee-dashboard.php");
        }
    }
    else{
        echo '<script>alert("Login Unsuccessful\nPlease try again")</script>';
        echo '<script>location.replace("./index.php")</script>';
        // header("Location: .");
        exit();
    }
?>
