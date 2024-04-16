<?php
    include "employee-dashboard.php";
    include "connection.php";

    if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
        header('location: index.php');   // if not set the category is sendback to login page.
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./dashboards.css">
  </head>

  <body>
    <div class="main-container">
        <div class="page-header">
            <h2>Dashboard</h2>
        </div>

        <div class="row">

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Categories</h5>
                        <p class="card-text">
                            <span id="card-text-number">
                            <?php
                            $total_categories_query = "SELECT * FROM categories";
                            $total_categories_result = mysqli_query($con, $total_categories_query);
                            $total_categories = mysqli_num_rows($total_categories_result);
                            printf("%d\n", $total_categories);
                            ?>
                            </span>
                            <br>
                            <!-- <span id="card-text-text">Registered Categories</span> -->
                        </p>
                        <a href="./manage-employee-categories.php" class="btn btn-primary">Go to Categories</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Products</h5>
                        <p class="card-text">
                            <span id="card-text-number">
                            <?php
                            $total_products_query = "SELECT * FROM products";
                            $total_products_result = mysqli_query($con, $total_products_query);
                            $total_products = mysqli_num_rows($total_products_result);
                            printf("%d\n", $total_products);
                            ?>
                            </span>
                            <br>
                            <!-- <span id="card-text-text">Registered Products</span> -->
                        </p>
                        <a href="./manage-employee-products.php" class="btn btn-primary">Go to Products</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Customers</h5>
                        <p class="card-text">
                            <span id="card-text-number">
                            <?php
                            $total_customers_query = "SELECT * FROM customers";
                            $total_customers_result = mysqli_query($con, $total_customers_query);
                            $total_customers = mysqli_num_rows($total_customers_result);
                            printf("%d\n", $total_customers);
                            ?>
                            </span>
                            <br>
                            <!-- <span id="card-text-text">Registered Products</span> -->
                        </p>
                        <a href="./manage-employee-customers.php" class="btn btn-primary">Go to Customers</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sales</h5>
                        <p class="card-text">
                            <span id="card-text-number">
                            <?php
                            $total_products_query = "SELECT * FROM sales";
                            $total_products_result = mysqli_query($con, $total_products_query);
                            $total_products = mysqli_num_rows($total_products_result);
                            printf("%d\n", $total_products);
                            ?>
                            </span>
                            <br>
                            <!-- <span id="card-text-text">Registered Products</span> -->
                        </p>
                        <a href="./manage-employee-sales.php" class="btn btn-primary">Go to Sales</a>
                    </div>
                </div>
            </div>

        </div>
        
    </div>
  </body>
</html>