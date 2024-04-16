<?php
    include "employee-dashboard.php";

    if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
        header('location: index.php');   // if not set the id is sendback to login page.
    }
?>

<?php
include 'connection.php';
$query="select * from customers"; // Fetch all the data from the table customers
$result=mysqli_query($con,$query);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Customers</title>
        <link rel="stylesheet" href="./manage-categories.css">
    </head>

    <body>
        <div class="page-header">
            <h2>Customers</h2>
            
            
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
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"><button class="float-right add-new" onclick="openForm()">Add New Customer</button></th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Address</th>
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
                    <td><?php echo $row[3];?></td>
                    <td><?php echo $row[4];?></td>
                    <td><a onclick="editCustomer('<?php echo $row['id']; ?>', '<?php echo $row['name']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['tel']; ?>', '<?php echo $row['address']; ?>')" href="#" class="action-links"><i class="fa fa-fw fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a>
                        <a onclick="confirmDelete('<?php echo $row['id']; ?>', '<?php echo $row['name']; ?>')" href="#" class="action-links"><i class="fa fa-fw fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i></a></td>
                    
                </tr>

                <?php endwhile; ?>

                <?php else: ?>
                <tr>
                    <td colspan="3" rowspan="1" headers="">No Registered Customers</td>
                </tr>
                <?php endif; ?>

                <?php mysqli_free_result($result); ?>

            </tbody>
        </table>

        <div class="form-popup" id="myForm">
            <form class="form-container" action="./employee/add-customer-employee.php" method="post">
            <h1>Add Customer</h1>

            <label for="customer"><b>Customer Name</b></label>
            <input type="text" placeholder="Enter Customer Name" name="customer" required>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Customer Email" name="email" required>

            <label for="telephone"><b>Telephone</b></label>
            <input type="text" placeholder="Enter Customer Telephone" name="telephone" required>

            <label for="description"><b>Address</b></label>
            <input type="text" placeholder="Enter Customer Address" name="address" required>

            <button type="submit" class="btn">Add</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
            </form>
        </div>

        <div class="form-popup" id="myEditForm">
            <form class="form-container" action="./employee/edit-customer-employee.php?customerid=" method="post">
            <h1>Edit Customer</h1>

            <label for="id"><b>ID</b></label>
            <input type="text" placeholder="" name="id" id="id" readonly="readonly" required>

            <label for="customer"><b>Customer Name</b></label>
            <input type="text" placeholder="" name="customer" id="customer" required>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Customer Email" name="email" required>

            <label for="telephone"><b>Telephone</b></label>
            <input type="text" placeholder="Enter Customer Telephone" name="telephone" required>

            <label for="description"><b>Address</b></label>
            <input type="text" placeholder="Enter Customer Address" name="address" required>

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
    function confirmDelete(id, customer) {
    if (confirm("Are you sure you want to delete Customer "+ "'" + customer + "'")) {
        location.replace("./employee/delete-customer-employee.php?customerid="+id);
    } else {
        location.replace("./manage-employee-customers.php");
    }}

    function editCustomer(id, customer, email, telephone, address) {
    if (confirm("Are you sure you want to Edit customer "+ "'" + customer + "'")) {
        openEditForm()
        document.getElementById('id').setAttribute('value', id);
        document.getElementById('customer').setAttribute('value', customer);
        document.getElementById('email').setAttribute('value', email);
        document.getElementById('telephone').setAttribute('value', telephone);
        document.getElementById('address').setAttribute('value', address);
    } else {
        location.replace("./manage-employee-customers.php");
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