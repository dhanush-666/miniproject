<?php
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $name = $_POST["name"];
    $supplier_address = $_POST["supplier_address"];
    $supplier_phoneno = $_POST["supplier_phoneno"];
    $supplier_productname = $_POST["supplier_productname"];
    $product_price = $_POST["product_price"];

    // Perform database connection and insertion (replace with your database credentials)
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "test";

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO suppliers (name, supplier_address, supplier_phoneno, supplier_productname, product_price) VALUES ('$name', '$supplier_address', '$supplier_phoneno', '$supplier_productname', '$product_price')";

    if ($conn->query($sql) === TRUE) {
        $supplierID = $conn->insert_id; // Get the last inserted supplier ID
        // Redirect to a different page after successful submission
        header("Location: supplier_details.php?supplierID=$supplierID");
        exit(); // Terminate this script after the redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
