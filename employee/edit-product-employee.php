<?php
session_start();
require '..\connection.php';
$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$category_id = $_POST['category_id'];
$description = $_POST['description'];

    //to prevent from mysqli injection
    $id = stripcslashes($id);
    $category_id = stripcslashes($category_id);
    $name = stripcslashes($name);
    $price = stripcslashes($price);
    $description = stripcslashes($description);
    $id = mysqli_real_escape_string($con, $id);
    $name = mysqli_real_escape_string($con, $name);
    $price = mysqli_real_escape_string($con, $price);
    $category_id = mysqli_real_escape_string($con, $category_id);
    $description = mysqli_real_escape_string($con, $description);

    $sql = "UPDATE products SET id='$id',category_id='$category_id',name='$name', price='$price', description='$description' WHERE id='$id'";

    if ($con->query($sql) === TRUE) {
        echo '<script>alert("Product edit Successful")</script>';
        echo '<script>location.replace("../manage-employee-products.php")</script>';
    } else {
    echo "Error: " . $sql . "<br>" . $con->error;
    }
?>
