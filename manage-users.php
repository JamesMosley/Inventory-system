<?php
include "admin-dashboard.php";

if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
    header('location: index.php');   // if not set the user is sendback to login page.
  }
?>

<?php
include 'connection.php';
$query="select * from users"; // Fetch all the data from the table customers
$result=mysqli_query($con,$query);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>User Management</title>
        <link rel="stylesheet" href="./manage-users.css">
    </head>

    <body>
        <div class="page-header">
            <h2>Registered Users</h2>
            
            
        </div>
        <table class="table" id="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">
                        <div class="float-left">
                            <input type="text" placeholder="Search.." id="search" onkeyup="mySearchFunction()">
                        </div>
                    </th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"><button class="float-right add-new" onclick="openForm()">Add New User</button></th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">User Name</th>
                    <th scope="col">User Role</th>
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
                    <!-- <td><?php echo $row[3];?></td> -->
                    <td class="types"><?php echo $row[4];?></td>
                    <td><a onclick="editUser('<?php echo $row['ID']; ?>', '<?php echo $row['name']; ?>', '<?php echo $row['username']; ?>', '<?php echo $row['role']; ?>')" href="#" class="action-links"><i class="fa fa-fw fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a>
                        <a onclick="confirmDelete('<?php echo $row['ID']; ?>', '<?php echo $row['name']; ?>')" href="#" class="action-links"><i class="fa fa-fw fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i></a></td>
                    
                </tr>

                <?php endwhile; ?>

                <?php else: ?>
                <tr>
                    <td colspan="3" rowspan="1" headers="">No Registered Users</td>
                </tr>
                <?php endif; ?>

                <?php mysqli_free_result($result); ?>

            </tbody>
        </table>

        <div class="form-popup" id="myForm">
            <form class="form-container" action="./add-user.php" method="post">
            <h1>Add User</h1>

            <label for="fullname"><b>Full Name</b></label>
            <input type="text" placeholder="Enter Full Name" name="fullname" required>

            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="userrole"><b>User Role</b></label>
            <select name="userrole" id="userrole" required>
                <option disabled selected value> -- select an option -- </option>
                <option value="admin">Admin</option>
                <option value="employee">Employee/ Normal User</option>
            </select>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button type="submit" class="btn">Add</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
            </form>
        </div>

        <div class="form-popup" id="myEditForm">
            <form class="form-container" action="./edit-user.php?userid=" method="post">
            <h1>Edit User</h1>

            <label for="id"><b>ID</b></label>
            <input type="text" placeholder="" name="id" id="id" readonly="readonly" required>
            
            <label for="fullname"><b>Full Name</b></label>
            <input type="text" placeholder="Enter Full Name" name="fullname" id="fullname" required>

            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" id="username" required>

            <label for="userrole"><b>User Role</b></label>
            <select name="userrole" id="userrole" required>
                <option disabled selected value> -- select an option -- </option>
                <option value="admin">Admin</option>
                <option value="employee">Employee/ Normal User</option>
            </select>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

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
    function confirmDelete(id, name) {
    if (confirm("Are you sure you want to delete user "+ "'" + name + "'")) {
        location.replace("./delete-user.php?userid="+id);
    } else {
        location.replace("./manage-users.php");
    }}

    function editUser(id, name, username, role) {
    if (confirm("Are you sure you want to Edit user "+ "'" + name + "'")) {
        openEditForm()
        document.getElementById('id').setAttribute('value', id);
        document.getElementById('fullname').setAttribute('value', name);
        document.getElementById('username').setAttribute('value', username);
        document.getElementById('userrole').setAttribute('value', role);
    } else {
        location.replace("./manage-users.php");
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