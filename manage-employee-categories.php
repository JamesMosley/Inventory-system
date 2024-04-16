<?php
    include "employee-dashboard.php";

    if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
        header('location: index.php');   // if not set the category is sendback to login page.
    }
?>

<?php
include 'connection.php';
$query="select * from categories"; // Fetch all the data from the table customers
$result=mysqli_query($con,$query);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Categories</title>
        <link rel="stylesheet" href="./manage-categories.css">
    </head>

    <body>
        <div class="page-header">
            <h2>Categories</h2>
            
            
        </div>
        <table class="table" id="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">
                        <div class="float-left">
                            <input type="text" placeholder="Search.." id="search" onkeyup="mySearchFunction()">
                        </div></th>
                    <th scope="col"></th>
                    <th scope="col"><button class="float-right add-new" onclick="openForm()">Add New Category</button></th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php if ($result->num_rows > 0): ?>

                <?php while($row=mysqli_fetch_array($result)): ?>

                <tr>
                    <th scope="row"><?php echo $row["0"];?></th>
                    <td><?php echo $row[1];?></td>
                    <td><?php echo $row[2];?></td>
                    <td><a onclick="editCategory('<?php echo $row['id']; ?>', '<?php echo $row['name']; ?>', '<?php echo $row['description']; ?>')" href="#" class="action-links"><i class="fa fa-fw fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a>
                        <a onclick="confirmDelete('<?php echo $row['id']; ?>', '<?php echo $row['name']; ?>')" href="#" class="action-links"><i class="fa fa-fw fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i></a></td>
                    
                </tr>

                <?php endwhile; ?>

                <?php else: ?>
                <tr>
                    <td colspan="3" rowspan="1" headers="">No Registered Categories</td>
                </tr>
                <?php endif; ?>

                <?php mysqli_free_result($result); ?>

            </tbody>
        </table>

        <div class="form-popup" id="myForm">
            <form class="form-container" action="./employee/add-category-employee.php" method="post">
            <h1>Add Category</h1>

            <label for="category"><b>Category Name</b></label>
            <input type="text" placeholder="Enter Category Name" name="category" required>

            <label for="description"><b>Description</b></label>
            <input type="text" placeholder="Enter Category Description" name="description" required>

            <button type="submit" class="btn">Add</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
            </form>
        </div>

        <div class="form-popup" id="myEditForm">
            <form class="form-container" action="./employee/edit-category-employee.php?categoryid=" method="post">
            <h1>Edit Category</h1>

            <label for="id"><b>ID</b></label>
            <input type="text" placeholder="" name="id" id="id" readonly="readonly" required>

            <label for="category"><b>Category Name</b></label>
            <input type="text" placeholder="" name="category" id="category" required>

            <label for="description"><b>Description</b></label>
            <input type="text" placeholder="" name="description" id="description" required>

            <button type="submit" class="btn">Edit</button>
            <button type="button" class="btn cancel" onclick="closeEditForm()">Cancel</button>
            </form>
        </div>

    </body>

</html>

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
    function confirmDelete(id, category) {
    if (confirm("Are you sure you want to delete Category "+ "'" + category + "'")) {
        location.replace("./employee/delete-category-employee.php?categoryid="+id);
    } else {
        location.replace("./manage-employee-categories.php");
    }}

    function editCategory(id, category, description) {
    if (confirm("Are you sure you want to Edit category "+ "'" + category + "'")) {
        openEditForm()
        document.getElementById('id').setAttribute('value', id);
        document.getElementById('category').setAttribute('value', category);
        document.getElementById('description').setAttribute('value', description);
    } else {
        location.replace("./manage-employee-categories.php");
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
</script>