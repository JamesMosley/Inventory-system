<?php
session_start();
require '..\connection.php';

$sql = "DELETE FROM categories WHERE id='" . $_GET["categoryid"] . "'";

if (mysqli_query($con, $sql)) {
    echo "Record deleted successfully";
    header("Location: ../manage-employee-categories.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
    header("Location: ../manage-employee-categories.php");
}

?>