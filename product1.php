<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    echo "product ID $id updated successfully.";
} else {
    echo "product ID not provided.";
}
?>
<a href="product_details.php">Back to Display Data</a>
