<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    // Perform database connection and delete the supplier record
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "test";

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM suppliers WHERE id = $id"; // Replace 'suppliers' with your actual table name
    if ($conn->query($sql) === TRUE) {
        header("Location:supplier_details.php");    } else {
        echo "Error deleting supplier: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid ID";
}
?>
