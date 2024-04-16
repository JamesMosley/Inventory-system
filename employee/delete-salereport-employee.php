<?php
session_start();
require '..\connection.php';

$sql = "DELETE FROM sales WHERE id='" . $_GET["saleid"] . "'";
$sql_ = "DELETE FROM sale_products WHERE sale_id='" . $_GET["saleid"] . "'";

if (mysqli_query($con, $sql) && mysqli_query($con, $sql_)) {
    echo "Record deleted successfully";
    header("Location: ../manage-employee-reports.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
    header("Location: ../manage-employee-reports.php");
}

?>