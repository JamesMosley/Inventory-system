<?php
session_start();
require '.\connection.php';
$category = $_POST['category'];
$description = $_POST['description'];

    //to prevent from mysqli injection
    $category = stripcslashes($category);
    $description = stripcslashes($description);
    $category = mysqli_real_escape_string($con, $category);
    $description = mysqli_real_escape_string($con, $description);

    $sql = "INSERT INTO categories (ID, name, description) VALUES ('', '$category', '$description')";

    if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: ./manage-categories.php");
    } else {
    echo "Error: " . $sql . "<br>" . $con->error;
    }
?>
