<?php
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $customerName = $_POST["customerName"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Perform database connection and insertion (you may need to replace these with your database credentials)
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "test";

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO customers (customerName, address, email, phone) VALUES ('$customerName', '$address', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        $customerID = $conn->insert_id; // Get the last inserted customerID
        // Redirect to a different page after successful submission
        header("Location: sucess.php?customerID=$customerID");
        exit(); // Terminate this script after the redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
