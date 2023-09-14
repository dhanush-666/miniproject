<?php
if (isset($_GET["id"])) {
    $supplier_id = $_GET["id"];
    echo "Supplier ID $supplier_id updated successfully.";
} else {
    echo "Supplier ID not provided.";
}
?>
<a href="supplier_details.php">Back to Display Data</a>
