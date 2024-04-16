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


function confirmDelete(id, product) {
if (confirm("Are you sure you want to delete product "+ "'" + product + "'")) {
    location.replace("./delete-product.php?productid="+id);
} else {
    location.replace("./manage-products.php");
}}

function editProduct(id, name, category_id, description) {
if (confirm("Are you sure you want to Edit product "+ "'" + name + "'")) {
    openEditForm()
    document.getElementById('id').setAttribute('value', id);
    document.getElementById('name').setAttribute('value', name);
    document.getElementById('category_id').setAttribute('value', category_id);
    document.getElementById('description').setAttribute('value', description);
} else {
    location.replace("./manage-products.php");
}}

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
