<?php
if (isset($_GET["id"])) {
    $customerId = $_GET["id"];
    echo "cutomer ID $customerId updated successfully.";
} else {
    echo "customer ID not provided.";
}
?>
<a href="sucess.php">Back to Display Data</a>
