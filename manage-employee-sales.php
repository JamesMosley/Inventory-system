<?php
include "employee-dashboard.php";

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
        <title>Sales</title>
        <link rel="stylesheet" href="./manage-categories.css">
        <link rel="stylesheet" href="./manage-sales.css">

        <style>
            .customer-form {
                margin-left: 350px;
                margin-top: 50px;
                display: none;
            }

            .total_text {
                display: none;
            }

            .add-sale, .customer-display {
                margin-right: 50px;
            }

            .customer-display {
                display: none;
            }

            .select {
                position: relative;
                font-family: Arial;
            }

            .select select {
                width: 30%;
                height: 35px;
                border-radius: 25px;
            }

            .add-btn {
                height: 35px;
                border-radius: 25px;
                cursor: pointer;
            }

            .new-font {
                color: black;
                text-decoration: none;
            }

            .btnExport {
                margin-top: 5px;
                margin-left: 50px;
            }
        </style>
    </head>
    
    <body>
        <div class="page-header">
            <h2>New Sale</h2>
            <h3>Select Customer</h3>
        
        </div>

        <div class="page-main select">
            <select type="text" placeholder="" name="customer_id" id="customer_id" onchange=“displayCustomer(this)”>
                <option value="" selected disabled>--Select customer--</option>
            
                <?php ob_start();
                $query_cus="select * from customers";
                $result_cus=mysqli_query($con,$query_cus);
                while($cus_options=mysqli_fetch_array($result_cus)): 
                ?>
                <option value="<?php echo $cus_options['id']; ?>"><?php echo $cus_options['name']; ?></option>
                <?php endwhile; ?>

            </select>
            <button class="add-btn" type="button" id="addBtn"><a href="./manage-employee-customers.php" class="new-font">Add New Customer</a></button>
        </div>
        <div>&nbsp</div>

        <div class="page-main select select-cust">
            <h3>Select Products</h3>
            <select type="text" placeholder="" name="category_id" id="category_id" required>
                <option value="" selected disabled>--Select products--</option>
            
                <?php ob_start();
                $query_cat="select * from products";
                $result_cat=mysqli_query($con,$query_cat);
                while($cat_options=mysqli_fetch_array($result_cat)): 
                ?>
                <option value="<?php echo $cat_options['id']; ?>"><?php echo $cat_options['name']; ?></option>
                <?php endwhile; ?>

            </select>
            <button class="add-btn" type="button" id="addBtn" onclick="getOption()">Select</button>
        </div>
        <div>&nbsp</div>

        <table class="table" id="table">
            <thead>
                <tr>
                    <th scope="col">Product ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col" id="prices">Price (KES)</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="tbody">
                
            </tbody>
            <tfoot>
                <td class="total_text" id="total_text">Total</td>
                <td></td>
                <td id="total"></td>
                <td></td>
                <td></td>
            </tfoot>
        </table>

        <div class="page-main continue">
            <button class="float-left btn" onclick="getCustomer()">View Total</button>
            <input class="float-left btnExport" type="button" id="btnExport" value="Export" onclick="download()" />
            <button class="float-right btn add-sale" onclick="addSale()">COMPLETE SALE</button>
        </div>

        <script>
            function getOption() {
                selectElement = document.querySelector('#category_id');
                output = selectElement.value;
                showUser(output);
            }

            function showUser(str) {
                if (str=="") {
                    return;
                }
                var xmlhttp=new XMLHttpRequest();
                xmlhttp.onreadystatechange=function() {
                    if (this.readyState==4 && this.status==200) {
                    document.getElementById("tbody").innerHTML+=this.responseText;
                    }
                }
                xmlhttp.open("GET","getproduct.php?q="+str,true);
                xmlhttp.send();
            }

            function getCustomer(select) {
                showTableData();
                // document.getElementById("customer-form").style.display = "block";
            }

            function onClickRemove(deleteButton) {
                let row = deleteButton.parentElement.parentElement;
                row.parentNode.removeChild(row);
                showTableData();
            }

            function showTableData() {
                total_col = 0;
                x = document.getElementById("table").rows.length - 1;
                for (let i = 1; i < x; i++) {
                    total = parseInt(document.getElementById("table").rows[i].cells[2].innerHTML) * parseInt(document.getElementById("table").rows[i].cells[3].innerHTML);
                    total_col += total;
                    document.getElementById("total").innerHTML = total_col;
                    document.getElementById("total_text").style.display = "block";
                }
            }

            function addSale() {
                customer = document.querySelector('#customer_id');
                customer_id = customer.value;
                total_amount = document.getElementById("total").innerHTML

                all_products = ""
                y = document.getElementById("table").rows.length - 1;
                for (let i = 1; i < y; i++) {
                    product_id = document.getElementById("table").rows[i].cells[0].innerHTML;
                    all_products = all_products + "," + product_id;
                }
                
                location.replace("./employee/add-sale-employee.php?customerid="+customer_id+"&totalamount="+total_amount+"&products="+all_products);
            }
            
        </script>
    
    </body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/"
    crossorigin="anonymous"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script><!-- html2canvas 1.0.0-alpha.11 or higher version is needed -->
<script>
    function download() {
        let pdf = new jsPDF('l', 'pt', [1920, 640]);
        pdf.html(document.getElementById('table'), {
            callback: function (pdf) {
                pdf.save('sale-receipt.pdf');
            }
        });
    }
</script>