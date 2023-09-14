<?php
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];

    // Database configuration
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "test";

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO products (product_name, product_price) VALUES ('$product_name', '$product_price')";

    if ($conn->query($sql) === TRUE) {
        $productID = $conn->insert_id; // Get the last inserted productID
        header("Location: product_details.php?productID=$productID");
       // header("Location: success.php?productID=$productID");
        exit(); // Terminate this script after the redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
