<?php
session_start();
require '..\connection.php';
$name = $_POST['name'];
$price = $_POST['price'];
$category_id = $_POST['category_id'];
$description = $_POST['description'];

    //to prevent from mysqli injection
    $name = stripcslashes($name);
    $price = stripcslashes($price);
    $category_id = stripcslashes($category_id);
    $description = mysqli_real_escape_string($con, $description);

    $sql = "INSERT INTO products(id, category_id, name, price, description) VALUES ('','$category_id','$name', '$price', '$description')";

    if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: ../manage-employee-products.php");
    } else {
    echo "Error: " . $sql . "<br>" . $con->error;
    }
?>
