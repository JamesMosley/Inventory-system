<?php
if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
  header('location: index.php');   // if not set the category is sendback to login page.
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./navigation.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#"><i class="fa fa-fw fa-bars"></i> Ezam Technologies</a>
      <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> -->
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <!-- <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li> -->
        </ul>
      </div>
      <div class="dropdown float-right">
        <div class="dropdown">
          <a onclick="myFunction()" class="dropbtn nav-link dropdown-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg>
            <?php echo $_SESSION["fullname"]; ?>
          </a>
          <div id="myDropdown" class="dropdown-content">
            <a href="./logout.php">Logout</a>
          </div>
        </div>
      </div>
    </nav>

    <!-- The sidebar -->
    <div class="sidebar">
      <a href="./manage-employee-dashboard.php"><i class="fa fa-fw fa-home"></i> Dashboard</a>
      <!-- <a href="#services"><i class="fa fa-fw fa-users"></i> User Management</a> -->
      <a href="./manage-employee-categories.php"><i class="fa fa-fw fa-table"></i> Categories</a>
      <a href="./manage-employee-products.php"><i class="fa fa-fw fa-list"></i> Products</a>
      <a href="./manage-employee-customers.php"><i class="fa fa-fw fa-list"></i> Customers</a>
      <a href="./manage-employee-sales.php"><i class="fa fa-fw fa-money"></i> Sales</a>
      <a href="./manage-employee-reports.php"><i class="fa fa-fw fa-folder-open"></i> Reports</a>
    </div>

  </body>
  <script>
    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>
</html>