<?php
session_start();
require '..\connection.php';

$sql = "DELETE FROM customers WHERE id='" . $_GET["customerid"] . "'";

if (mysqli_query($con, $sql)) {
    echo "Record deleted successfully";
    header("Location: ../manage-employee-customers.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
    header("Location: ../manage-employee-customers.php");
}

?>