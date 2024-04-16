<?php
session_start();
require '..\connection.php';
$customer = $_POST['customer'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$address = $_POST['address'];


    //to prevent from mysqli injection
    $customer = stripcslashes($customer);
    $email = stripcslashes($email);
    $telephone = mysqli_real_escape_string($con, $telephone);
    $address = mysqli_real_escape_string($con, $address);

    $sql = "INSERT INTO customers(id, name, email, tel, address) VALUES ('','$customer','$email','$telephone','$address')";

    if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: ../manage-employee-customers.php");
    } else {
    echo "Error: " . $sql . "<br>" . $con->error;
    }
?>
