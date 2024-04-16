<?php
session_start();
include "admin-navigation.php";

if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
    header('location: index.php');   // if not set the user is sendback to login page.
  }
?>