<?php
session_start();
require '.\connection.php';
$id = $_POST['id'];
$category = $_POST['category'];
$description = $_POST['description'];

    //to prevent from mysqli injection
    $id = stripcslashes($id);
    $category = stripcslashes($category);
    $description = stripcslashes($description);
    $id = mysqli_real_escape_string($con, $id);
    $category = mysqli_real_escape_string($con, $category);
    $description = mysqli_real_escape_string($con, $description);

    $sql = "select *from categories where name = '$category' and description = '$description'";
    $sql = "UPDATE categories SET ID='$id', name='$category', description='$description' WHERE ID = '$id'";

    if ($con->query($sql) === TRUE) {
        echo '<script>alert("Category edit Successful")</script>';
        echo '<script>location.replace("./manage-categories.php")</script>';
    } else {
    echo "Error: " . $sql . "<br>" . $con->error;
    }
?>
