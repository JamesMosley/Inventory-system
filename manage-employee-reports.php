<?php
    include "employee-dashboard.php";

    if (!isset($_SESSION['id'])) {         // condition Check: if session is not set. 
        header('location: index.php');   // if not set the category is sendback to login page.
    }
?>

<?php
include 'connection.php';
$query="select * from sales"; // Fetch all the data from the table customers
$result=mysqli_query($con,$query);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reports</title>
        <link rel="stylesheet" href="./manage-categories.css">
        <style>
            .new-font {
                color: black;
            }

            .btnExport {
                margin-right: 50px;
            }

            .add-new {
                margin-bottom: 20px;
            }

            .float-left, .add-new {
                margin-right: 50px;
            }
        </style>
    </head>

    <body>
        <div class="page-header">
        <h2>Sale Reports</h2>
            <div class="float-left">
                <input type="text" placeholder="Search customer.." id="search" onkeyup="mySearchFunction()">
            </div>

            <div class="float-left">
                <input type="text" placeholder="Search by date.." id="search-date" onkeyup="mySearchByDateFunction()">
            </div>

            <button class="float-right add-new"><a href="./manage-sales.php" class="new-font">Add New Sale</a></button>
            
        </div>
        <table class="table" id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Date & Time</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php if ($result->num_rows > 0): ?>

                <?php while($row=mysqli_fetch_array($result)): ?>

                <tr>
                    <th scope="row"><?php echo $row["0"];?></th>
                    <td><?php echo $row[1];?></td>
                    <td><?php
                    $customer = $row['customer_id'];
                    $query_cat="select * from customers where id=$customer";
                    $result_cat=mysqli_query($con,$query_cat);
                    $row_cat=mysqli_fetch_array($result_cat);
                    echo $row_cat["name"];
                    ?></td>
                    <td><?php echo $row[3];?></td>
                    <td>
                        <a onclick="confirmDelete('<?php echo $row['id']; ?>', '<?php echo $row['amount']; ?>')" href="#" class="action-links"><i class="fa fa-fw fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i></a></td>
                    
                </tr>

                <?php endwhile; ?>

                <?php else: ?>
                <tr>
                    <td colspan="3" rowspan="1" headers="">No Registered Categories</td>
                </tr>
                <?php endif; ?>

                <?php mysqli_free_result($result); ?>

            </tbody>

            <tfoot>
                <td><input type="button" value="Total" onclick="showTableData()" /></td>
                <td id="total"></td>
                <td></td>
                <td></td>
                <td></td>
            </tfoot>
        </table>
        <input class="float-right btnExport" type="button" id="btnExport" value="Export" onclick="download()" />
        <input class="float-right btnExport" type="button" id="btnExport" value="Export CSV" onclick="exportTableToCSV('sales.csv')" />

    </body>

</html>

<script>
    function confirmDelete(id, category) {
    if (confirm("Are you sure you want to delete Sale "+ "'" + id + "'")) {
        location.replace("./employee/delete-salereport-employee.php?saleid="+id);
    } else {
        location.replace("./manage-employee-reports.php");
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

    function mySearchByDateFunction() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search-date");
    filter = input.value.toUpperCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
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
<script src="js/jsPDF/dist/jspdf.umd.js"></script>
<script>
    function showTableData() {
        total_col = 0;
        x = document.getElementById("table").rows.length - 1;
        for (let i = 2; i < x; i++) {
            total = parseInt(document.getElementById("table").rows[i].cells[1].innerHTML);
            total_col += total;
        }

        document.getElementById("total").innerHTML = total_col;
    }

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/"
    crossorigin="anonymous"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script><!-- html2canvas 1.0.0-alpha.11 or higher version is needed -->
<script>
    function download() {
        let pdf = new jsPDF('l', 'pt', [1920, 640]);
        pdf.html(document.getElementById('table'), {
            callback: function (pdf) {
                pdf.save('sales-report.pdf');
            }
        });
    }
</script>
<script type="text/javascript">
    function downloadCSV(csv, filename) {
        var csvFile;
        var downloadLink;

        // CSV file
        csvFile = new Blob([csv], {type: "text/csv"});

        // Download link
        downloadLink = document.createElement("a");

        // File name
        downloadLink.download = filename;

        // Create a link to the file
        downloadLink.href = window.URL.createObjectURL(csvFile);

        // Hide download link
        downloadLink.style.display = "none";

        // Add the link to DOM
        document.body.appendChild(downloadLink);

        // Click download link
        downloadLink.click();
    }

    function exportTableToCSV(filename) {
        var csv = [];
        var rows = document.querySelectorAll("table tr");
        
        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");
            
            for (var j = 0; j < cols.length - 1; j++) 
                row.push(cols[j].innerText);
            
            csv.push(row.join(","));        
        }

        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    }
    </script>