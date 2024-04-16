<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"inventory");
$sql="SELECT * FROM products WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);


while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['id'] . "</td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['price'] . "</td>";
  echo "<td contenteditable='true'>" . 1 . "</td>";
  echo "<td><a onclick='onClickRemove(this)' href='#' class='action-links'><i class='fa fa-fw fa-trash' data-bs-toggle='tooltip' data-bs-placement='top' title='Delete'></i></a></td></td>";
  echo "</tr>";
}
echo '<script type="text/javascript">showTableData();</script>';

mysqli_close($con);
?>