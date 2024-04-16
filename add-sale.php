<?php
session_start();
require '.\connection.php';
$customer = $_GET['customerid'];
$total_amount = $_GET['totalamount'];
$products_list = $_GET['products'];


    //to prevent from mysqli injection
    $customer = stripcslashes($customer);
    $total_amount = stripcslashes($total_amount);

    $timestamp = date('Y-m-d H:i:s');

    $sql = "INSERT INTO sales(id, amount, customer_id, date_Added) VALUES ('', '$total_amount', '$customer', '$timestamp')";

    if ($con->query($sql) === TRUE) {
        $sale_id = mysqli_insert_id($con);
        $products_arr = explode (",", $products_list);

        foreach ($products_arr as $value) {
            if ($value) {
                $sql_ = "INSERT INTO sale_products(sale_id, product_id) VALUES ('$sale_id','$value')";
                if ($con->query($sql_) === TRUE) {
                    continue;
                }
            }
        }

        header("Location: ./manage-sales.php");

    } else {
    echo "Error: " . $sql . "<br>" . $con->error;
    }
?>