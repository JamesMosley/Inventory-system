<?php
session_start();
require '.\connection.php';

$sql = "DELETE FROM users WHERE ID='" . $_GET["userid"] . "'";

if (mysqli_query($con, $sql)) {
    echo "Record deleted successfully";
    header("Location: ./manage-users.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
    header("Location: ./manage-users.php");
}

?>