<?php
session_start();
require '..\connection.php';

$sql = "DELETE FROM products WHERE id='" . $_GET["productid"] . "'";

if (mysqli_query($con, $sql)) {
    echo "Record deleted successfully";
    header("Location: ../manage-employee-products.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
    header("Location: ../manage-employee-products.php");
}

?>