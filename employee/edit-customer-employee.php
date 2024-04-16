<?php
session_start();
require '..\connection.php';
$id = $_POST['id'];
$customer = $_POST['customer'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$address = $_POST['address'];

    //to prevent from mysqli injection
    $id = stripcslashes($id);
    $customer = stripcslashes($customer);
    $email = stripcslashes($email);
    $telephone = stripcslashes($telephone);
    $address = stripcslashes($address);

    $id = mysqli_real_escape_string($con, $id);
    $customer = mysqli_real_escape_string($con, $customer);
    $email = mysqli_real_escape_string($con, $email);
    $telephone = mysqli_real_escape_string($con, $telephone);
    $address = mysqli_real_escape_string($con, $address);

    $sql = "select *from customers where name = '$customer' and email = '$email'";
    $sql = "UPDATE customers SET id='$id', name='$customer', email='$email', tel='$telephone', address='$address' WHERE id = '$id'";

    if ($con->query($sql) === TRUE) {
        echo '<script>alert("Customer edit Successful")</script>';
        echo '<script>location.replace("../manage-employee-customers.php")</script>';
    } else {
    echo "Error: " . $sql . "<br>" . $con->error;
    }
?>
