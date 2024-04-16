<?php
include "admin-dashboard.php";

if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
    header('location: index.php');   // if not set the session ID, sendback to login page.
  }
?>

<?php
include 'connection.php';
$query="select * from products"; // Fetch all the data from the table customers
$result=mysqli_query($con,$query);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
        <link rel="stylesheet" href="./manage-categories.css">
    </head>

    <body>
        <div class="page-header">
            <h2>Products</h2>
            
            
        </div>
        <table class="table" id="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">
                        <div class="float-left">
                            <input type="text" placeholder="Search by name.." id="search" onkeyup="mySearchFunction()">
                        </div>
                    </th>
                    <th scope="col">
                        <div class="float-left">
                            <input type="text" placeholder="Search by category.." id="search_cat" onkeyup="mySearchByCatFunction()">
                        </div>
                    </th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"><button class="float-right add-new" onclick="openForm()">Add New Product</button></th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price (KES)</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php if ($result->num_rows > 0): ?>

                <?php while($row=mysqli_fetch_array($result)): ?>

                <tr>
                    <th scope="row"><?php echo $row["id"];?></th>
                    <td><?php echo $row["name"];?></td>
                    <td><?php
                    $category = $row['category_id'];
                    $query_cat="select * from categories where id=$category";
                    $result_cat=mysqli_query($con,$query_cat);
                    $row_cat=mysqli_fetch_array($result_cat);
                    echo $row_cat["name"];
                    ?></td>
                    <td><?php echo $row["price"];?></td>
                    <td><?php echo $row["description"];?></td>
                    <td><a onclick="editProduct('<?php echo $row['id']; ?>', '<?php echo $row['name']; ?>', '<?php echo $row['category_id']; ?>', '<?php echo $row['price']; ?>', '<?php echo $row['description']; ?>')" href="#" class="action-links"><i class="fa fa-fw fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a>
                        <a onclick="confirmDelete('<?php echo $row['id']; ?>', '<?php echo $row['name']; ?>')" href="#" class="action-links"><i class="fa fa-fw fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i></a></td>
                    
                </tr>

                <?php endwhile; ?>

                <?php else: ?>
                <tr>
                    <td colspan="3" rowspan="1" headers="">No Registered Products</td>
                </tr>
                <?php endif; ?>

                <?php mysqli_free_result($result); ?>

            </tbody>
        </table>

        <div class="form-popup" id="myForm">

            <form class="form-container" action="./add-product.php" method="post">
            <h1>Add Product</h1>

            <label for="name"><b>Product Name</b></label>
            <input type="text" placeholder="" name="name" id="name" required>

            
            <label for="category_id"><b>Category</b></label>
            <select type="text" placeholder="" name="category_id" id="category_id" required>
                <option value="">--Select--</option>
            
                <?php ob_start();
                $query_cat="select * from categories";
                $result_cat=mysqli_query($con,$query_cat);
                while($cat_options=mysqli_fetch_array($result_cat)): 
                ?>
                <option value="<?php echo $cat_options['id']; ?>"><?php echo $cat_options['name']; ?></option>
                <?php endwhile; ?>

            </select>

            <label for="price"><b>Price (KES)</b></label>
            <input type="text" placeholder="" name="price" id="price" required>            

            <label for="description"><b>Description</b></label>
            <input type="text" placeholder="" name="description" id="description" required>

            <button type="submit" class="btn">Add</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
            </form>

        </div>

        <div class="form-popup" id="myEditForm">
            <form class="form-container" action="./edit-product.php?productid=" method="post">
            <h1>Edit Product</h1>

            <label for="id"><b>ID</b></label>
            <input type="text" placeholder="" name="id" id="id" readonly="readonly" required>

            <label for="name"><b>Product Name</b></label>
            <input type="text" placeholder="" name="name" id="name" required>

            <label for="category_id"><b>Category</b></label>
            <select type="text" placeholder="" name="category_id" id="category_id" required>
                <option value="">--Select--</option>
            
                <?php ob_start();
                $query_cat="select * from categories";
                $result_cat=mysqli_query($con,$query_cat);
                while($cat_options=mysqli_fetch_array($result_cat)): 
                ?>
                <option value="<?php echo $cat_options['id']; ?>"><?php echo $cat_options['name']; ?></option>
                <?php endwhile; ?>

            </select>

            <label for="price"><b>Price (KES)</b></label>
            <input type="text" placeholder="" name="price" id="price" required>

            <label for="description"><b>Description</b></label>
            <input type="text" placeholder="" name="description" id="description" required>

            <button type="submit" class="btn">Edit</button>
            <button type="button" class="btn cancel" onclick="closeEditForm()">Cancel</button>
            </form>
        </div>

        <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function openEditForm() {
            document.getElementById("myEditForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }

        function closeEditForm() {
            document.getElementById("myEditForm").style.display = "none";
        }
        </script>
        <script>
            function confirmDelete(id, product) {
            if (confirm("Are you sure you want to delete product "+ "'" + product + "'")) {
                location.replace("./delete-product.php?productid="+id);
            } else {
                location.replace("./manage-products.php");
            }}

            function editProduct(id, name, category_id, price, description) {
            if (confirm("Are you sure you want to Edit product "+ "'" + name + "'")) {
                openEditForm()
                document.getElementById('id').setAttribute('value', id);
                document.getElementById('name').setAttribute('value', name);
                document.getElementById('price').setAttribute('value', price);
                document.getElementById('category_id').setAttribute('value', category_id);
                document.getElementById('description').setAttribute('value', description);
            } else {
                location.replace("./manage-products.php");
            }}

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>
        <script>
            function mySearchFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }
            }
            }

            function mySearchByCatFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search_cat");
            filter = input.value.toUpperCase();
            table = document.getElementById("table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }
            }
            }
        </script>

    </body>

</html>